<?php
/**
 * Contact form handling.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('shanaynlabs_contact_redirect')) {
    /**
     * Redirect back to the contact page with a status.
     *
     * @param string $status Submission status.
     * @param string $redirect_to Redirect URL.
     */
    function shanaynlabs_contact_redirect($status, $redirect_to = '') {
        $redirect_to = $redirect_to ? wp_validate_redirect($redirect_to, home_url('/contact/')) : home_url('/contact/');

        wp_safe_redirect(
            add_query_arg(
                array(
                    'inquiry' => $status,
                    'contact_status' => 'success' === $status ? 'success' : 'error',
                ),
                remove_query_arg(array('inquiry', 'contact_status'), $redirect_to)
            )
        );
        exit;
    }
}

if (!function_exists('shanaynlabs_get_request_ip')) {
    /**
     * Return a sanitized request IP address.
     *
     * @return string
     */
    function shanaynlabs_get_request_ip() {
        return isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : '';
    }
}

if (!function_exists('shanaynlabs_get_request_user_agent')) {
    /**
     * Return a sanitized request user agent.
     *
     * @return string
     */
    function shanaynlabs_get_request_user_agent() {
        return isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT'])) : '';
    }
}

if (!function_exists('shanaynlabs_text_exceeds_limit')) {
    /**
     * Check if text exceeds a byte-safe field limit.
     *
     * @param string $value Text value.
     * @param int    $limit Maximum length.
     * @return bool
     */
    function shanaynlabs_text_exceeds_limit($value, $limit) {
        return strlen((string) $value) > absint($limit);
    }
}

if (!function_exists('shanaynlabs_contact_rate_limit_key')) {
    /**
     * Build hashed transient key for IP-based rate limiting.
     *
     * @param string $ip Request IP address.
     * @return string
     */
    function shanaynlabs_contact_rate_limit_key($ip) {
        return 'shanaynlabs_inquiry_rate_' . substr(hash('sha256', wp_salt('auth') . '|' . $ip), 0, 32);
    }
}

if (!function_exists('shanaynlabs_contact_rate_limit_exceeded')) {
    /**
     * Determine whether an IP has submitted too many inquiries.
     *
     * @param string $ip Request IP address.
     * @return bool
     */
    function shanaynlabs_contact_rate_limit_exceeded($ip) {
        if ('' === $ip) {
            return false;
        }

        $count = absint(get_transient(shanaynlabs_contact_rate_limit_key($ip)));

        return $count >= 3;
    }
}

if (!function_exists('shanaynlabs_increment_contact_rate_limit')) {
    /**
     * Increment the IP-based inquiry rate limit counter.
     *
     * @param string $ip Request IP address.
     */
    function shanaynlabs_increment_contact_rate_limit($ip) {
        if ('' === $ip) {
            return;
        }

        $key = shanaynlabs_contact_rate_limit_key($ip);
        $count = absint(get_transient($key));

        set_transient($key, $count + 1, 10 * MINUTE_IN_SECONDS);
    }
}

if (!function_exists('shanaynlabs_save_project_inquiry')) {
    /**
     * Save project inquiry data in the WordPress admin.
     *
     * @param array $inquiry Inquiry data.
     * @return int|WP_Error
     */
    function shanaynlabs_save_project_inquiry($inquiry) {
        $submitted_at = !empty($inquiry['submitted_at']) ? $inquiry['submitted_at'] : current_time('mysql');
        $post_title = sprintf(
            /* translators: 1: inquiry name, 2: submitted date */
            __('Project Inquiry - %1$s - %2$s', 'shanayn-labs'),
            $inquiry['name'],
            $submitted_at
        );

        $inquiry_id = wp_insert_post(
            array(
                'post_type' => 'shanayn_inquiry',
                'post_status' => 'publish',
                'post_title' => $post_title,
            ),
            true
        );

        if (is_wp_error($inquiry_id) || !$inquiry_id) {
            return $inquiry_id;
        }

        $meta = array(
            '_shanaynlabs_inquiry_name' => $inquiry['name'],
            '_shanaynlabs_inquiry_business_name' => $inquiry['business_name'],
            '_shanaynlabs_inquiry_email' => $inquiry['email'],
            '_shanaynlabs_inquiry_phone' => $inquiry['phone'],
            '_shanaynlabs_inquiry_service_interest' => $inquiry['service_interest'],
            '_shanaynlabs_inquiry_project_type' => $inquiry['project_type'],
            '_shanaynlabs_inquiry_budget' => $inquiry['budget'],
            '_shanaynlabs_inquiry_project_timeline' => $inquiry['project_timeline'],
            '_shanaynlabs_inquiry_website_social_link' => $inquiry['website_social_link'],
            '_shanaynlabs_inquiry_message' => $inquiry['message'],
            '_shanaynlabs_inquiry_page_url' => $inquiry['page_url'],
            '_shanaynlabs_inquiry_ip' => $inquiry['ip'],
            '_shanaynlabs_inquiry_user_agent' => $inquiry['user_agent'],
            '_shanaynlabs_inquiry_submitted_at' => $submitted_at,
            '_shanaynlabs_inquiry_payload_json' => wp_json_encode(
                array(
                    'name' => $inquiry['name'],
                    'business_name' => $inquiry['business_name'],
                    'email' => $inquiry['email'],
                    'phone' => $inquiry['phone'],
                    'service_interest' => $inquiry['service_interest'],
                    'project_type' => isset($inquiry['project_type_values']) ? $inquiry['project_type_values'] : array(),
                    'budget' => $inquiry['budget'],
                    'project_timeline' => $inquiry['project_timeline'],
                    'website_social_link' => $inquiry['website_social_link'],
                    'message' => $inquiry['message'],
                    'page_url' => $inquiry['page_url'],
                    'ip' => $inquiry['ip'],
                    'submitted_at' => $submitted_at,
                )
            ),
        );

        foreach ($meta as $meta_key => $meta_value) {
            update_post_meta($inquiry_id, $meta_key, $meta_value);
        }

        return $inquiry_id;
    }
}

if (!function_exists('shanaynlabs_send_project_inquiry_email')) {
    /**
     * Send project inquiry notification email.
     *
     * @param array $inquiry Inquiry data.
     * @return bool
     */
    function shanaynlabs_send_project_inquiry_email($inquiry) {
        $contact_emails = function_exists('shanaynlabs_get_contact_emails') ? shanaynlabs_get_contact_emails() : array();
        $to = !empty($contact_emails[0]) && is_email($contact_emails[0]) ? $contact_emails[0] : get_option('admin_email');
        $subject = 'New Project Inquiry - ShanaynLabs';
        $fields = array(
            array('label' => __('Name', 'shanayn-labs'), 'value' => $inquiry['name'], 'multiline' => false),
            array('label' => __('Business Name', 'shanayn-labs'), 'value' => $inquiry['business_name'], 'multiline' => false),
            array('label' => __('Email', 'shanayn-labs'), 'value' => $inquiry['email'], 'multiline' => false),
            array('label' => __('Phone / WhatsApp', 'shanayn-labs'), 'value' => $inquiry['phone'], 'multiline' => false),
            array('label' => __('Service Interest', 'shanayn-labs'), 'value' => $inquiry['service_interest'], 'multiline' => false),
            array('label' => __('Project Type', 'shanayn-labs'), 'value' => $inquiry['project_type'], 'multiline' => false),
            array('label' => __('Budget Range', 'shanayn-labs'), 'value' => $inquiry['budget'], 'multiline' => false),
            array('label' => __('Project Timeline', 'shanayn-labs'), 'value' => $inquiry['project_timeline'], 'multiline' => false),
            array('label' => __('Website / Social Link', 'shanayn-labs'), 'value' => $inquiry['website_social_link'], 'multiline' => false),
            array('label' => __('Message', 'shanayn-labs'), 'value' => $inquiry['message'], 'multiline' => true),
            array('label' => __('Page URL', 'shanayn-labs'), 'value' => $inquiry['page_url'], 'multiline' => false),
            array('label' => __('Submitted At', 'shanayn-labs'), 'value' => $inquiry['submitted_at'], 'multiline' => false),
        );

        $body = '<h2>' . esc_html__('New Project Inquiry', 'shanayn-labs') . '</h2>';
        $body .= '<table cellpadding="8" cellspacing="0" border="0" style="border-collapse:collapse;width:100%;max-width:720px;">';

        foreach ($fields as $field) {
            $body .= '<tr>';
            $body .= '<th align="left" valign="top" style="border-bottom:1px solid #e5e7eb;width:180px;">' . esc_html($field['label']) . '</th>';
            $body .= '<td valign="top" style="border-bottom:1px solid #e5e7eb;">' . (!empty($field['multiline']) ? nl2br(esc_html($field['value'])) : esc_html($field['value'])) . '</td>';
            $body .= '</tr>';
        }

        $body .= '</table>';

        $headers = array('Content-Type: text/html; charset=UTF-8');

        if (is_email($inquiry['email'])) {
            $reply_name = str_replace(array("\r", "\n"), '', $inquiry['name']);
            $headers[] = 'Reply-To: ' . $reply_name . ' <' . $inquiry['email'] . '>';
        }

        return wp_mail($to, $subject, $body, $headers);
    }
}

if (!function_exists('shanaynlabs_get_posted_contact_field')) {
    /**
     * Safely read a posted contact form field.
     *
     * @param string $key Field key.
     * @return string
     */
    function shanaynlabs_get_posted_contact_field($key) {
        if (!isset($_POST[$key])) {
            return '';
        }

        $value = wp_unslash($_POST[$key]);

        if (is_array($value)) {
            return '';
        }

        return $value;
    }
}

if (!function_exists('shanaynlabs_get_posted_contact_array')) {
    /**
     * Safely read a posted contact form array field.
     *
     * @param string $key Field key.
     * @return array
     */
    function shanaynlabs_get_posted_contact_array($key) {
        if (!isset($_POST[$key])) {
            return array();
        }

        $value = wp_unslash($_POST[$key]);

        if (!is_array($value)) {
            return array(sanitize_text_field($value));
        }

        return array_filter(array_map('sanitize_text_field', $value));
    }
}

if (!function_exists('shanaynlabs_handle_contact_form')) {
    /**
     * Handle contact form submissions.
     */
    function shanaynlabs_handle_contact_form() {
        $nonce = sanitize_text_field(shanaynlabs_get_posted_contact_field('shanaynlabs_contact_nonce'));
        $redirect_to = esc_url_raw(shanaynlabs_get_posted_contact_field('redirect_to'));

        if (!$nonce || !wp_verify_nonce($nonce, 'shanaynlabs_contact_form')) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        $honeypot = sanitize_text_field(shanaynlabs_get_posted_contact_field('shanaynlabs_company_website'));
        $legacy_honeypot = sanitize_text_field(shanaynlabs_get_posted_contact_field('contact_website'));

        if ('' !== $honeypot || '' !== $legacy_honeypot) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        $started_at = absint(shanaynlabs_get_posted_contact_field('shanaynlabs_form_started_at'));
        $current_time = time();

        if ($started_at && $current_time - $started_at < 3) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        $full_name = sanitize_text_field(shanaynlabs_get_posted_contact_field('full_name'));
        $email = sanitize_email(shanaynlabs_get_posted_contact_field('email_address'));
        $company = sanitize_text_field(shanaynlabs_get_posted_contact_field('business_name'));
        $legacy_company = sanitize_text_field(shanaynlabs_get_posted_contact_field('company_website'));
        $phone_whatsapp = sanitize_text_field(shanaynlabs_get_posted_contact_field('phone_whatsapp'));
        $service_interest = sanitize_text_field(shanaynlabs_get_posted_contact_field('service_interest'));
        $project_type_values = shanaynlabs_get_posted_contact_array('project_type');
        $budget_range = sanitize_text_field(shanaynlabs_get_posted_contact_field('budget_range'));
        $project_timeline = sanitize_text_field(shanaynlabs_get_posted_contact_field('project_timeline'));
        $website_social_link = esc_url_raw(shanaynlabs_get_posted_contact_field('website_social_link'));
        $message = sanitize_textarea_field(shanaynlabs_get_posted_contact_field('message'));
        $request_ip = shanaynlabs_get_request_ip();

        if (!$company && $legacy_company) {
            $company = $legacy_company;
        }

        if (shanaynlabs_contact_rate_limit_exceeded($request_ip)) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        if (!$full_name || !$message || !is_email($email)) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        if (
            shanaynlabs_text_exceeds_limit($full_name, 120) ||
            shanaynlabs_text_exceeds_limit($company, 160) ||
            shanaynlabs_text_exceeds_limit($email, 190) ||
            shanaynlabs_text_exceeds_limit($phone_whatsapp, 60) ||
            shanaynlabs_text_exceeds_limit($service_interest, 160) ||
            shanaynlabs_text_exceeds_limit($budget_range, 120) ||
            shanaynlabs_text_exceeds_limit($project_timeline, 120) ||
            shanaynlabs_text_exceeds_limit($website_social_link, 300) ||
            shanaynlabs_text_exceeds_limit($message, 3000)
        ) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        if (
            $website_social_link &&
            !wp_http_validate_url($website_social_link)
        ) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        if (count($project_type_values) > 10) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        foreach ($project_type_values as $project_type_value) {
            if (shanaynlabs_text_exceeds_limit($project_type_value, 160)) {
                shanaynlabs_contact_redirect('invalid', $redirect_to);
            }
        }

        $service_options = function_exists('shanaynlabs_get_inquiry_service_options') ? shanaynlabs_get_inquiry_service_options() : array();
        $service_options = array_unique(
            array_merge(
                $service_options,
                array(
                    'Website / Digital Presence',
                    'Marketing / Growth',
                    'Software / Dashboard',
                    'AI / Automation',
                    'Not sure yet',
                )
            )
        );
        $project_type_options = function_exists('shanaynlabs_get_inquiry_project_type_options') ? shanaynlabs_get_inquiry_project_type_options() : array();
        $project_type_options = array_unique(
            array_merge(
                $project_type_options,
                array(
                    'Website',
                    'Marketing',
                    'Software',
                    'AI',
                    'Automation',
                )
            )
        );
        $budget_options = function_exists('shanaynlabs_get_inquiry_budget_options') ? shanaynlabs_get_inquiry_budget_options() : array();
        $budget_options = array_unique(
            array_merge(
                $budget_options,
                array(
                    'Under $1,000',
                    '$1,000 - $3,000',
                    '$3,000 - $7,500',
                    '$7,500+',
                )
            )
        );

        if ($service_interest && !in_array($service_interest, $service_options, true)) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        if ($budget_range && !in_array($budget_range, $budget_options, true)) {
            shanaynlabs_contact_redirect('invalid', $redirect_to);
        }

        foreach ($project_type_values as $project_type_value) {
            if (!in_array($project_type_value, $project_type_options, true)) {
                shanaynlabs_contact_redirect('invalid', $redirect_to);
            }
        }

        $project_type = !empty($project_type_values) ? implode(', ', $project_type_values) : '';
        $submitted_at = current_time('mysql');
        $page_url = $redirect_to ? $redirect_to : wp_get_referer();
        $inquiry = array(
            'name' => $full_name,
            'business_name' => $company,
            'email' => $email,
            'phone' => $phone_whatsapp,
            'service_interest' => $service_interest,
            'project_type' => $project_type,
            'project_type_values' => $project_type_values,
            'budget' => $budget_range,
            'project_timeline' => $project_timeline,
            'website_social_link' => $website_social_link,
            'message' => $message,
            'page_url' => esc_url_raw($page_url),
            'ip' => $request_ip,
            'user_agent' => shanaynlabs_get_request_user_agent(),
            'submitted_at' => $submitted_at,
        );

        $inquiry_id = shanaynlabs_save_project_inquiry($inquiry);

        if (is_wp_error($inquiry_id) || !$inquiry_id) {
            shanaynlabs_contact_redirect('error', $redirect_to);
        }

        shanaynlabs_increment_contact_rate_limit($request_ip);
        shanaynlabs_send_project_inquiry_email($inquiry);

        shanaynlabs_contact_redirect('success', $redirect_to);
    }
}
add_action('admin_post_shanaynlabs_contact_form', 'shanaynlabs_handle_contact_form');
add_action('admin_post_nopriv_shanaynlabs_contact_form', 'shanaynlabs_handle_contact_form');

if (!function_exists('shanaynlabs_project_inquiry_columns')) {
    /**
     * Set admin list columns for Project Inquiries.
     *
     * @param array $columns Existing columns.
     * @return array
     */
    function shanaynlabs_project_inquiry_columns($columns) {
        return array(
            'cb' => isset($columns['cb']) ? $columns['cb'] : '<input type="checkbox" />',
            'inquiry_name' => __('Name', 'shanayn-labs'),
            'inquiry_email' => __('Email', 'shanayn-labs'),
            'inquiry_service_interest' => __('Service Interest', 'shanayn-labs'),
            'inquiry_budget' => __('Budget', 'shanayn-labs'),
            'date' => __('Date', 'shanayn-labs'),
        );
    }
}
add_filter('manage_shanayn_inquiry_posts_columns', 'shanaynlabs_project_inquiry_columns');

if (!function_exists('shanaynlabs_project_inquiry_column_content')) {
    /**
     * Render Project Inquiry admin list column content.
     *
     * @param string $column Column key.
     * @param int    $post_id Post ID.
     */
    function shanaynlabs_project_inquiry_column_content($column, $post_id) {
        switch ($column) {
            case 'inquiry_name':
                $name = get_post_meta($post_id, '_shanaynlabs_inquiry_name', true);
                $name = $name ? $name : get_the_title($post_id);
                $edit_link = get_edit_post_link($post_id);

                if ($edit_link) {
                    echo '<a href="' . esc_url($edit_link) . '"><strong>' . esc_html($name) . '</strong></a>';
                } else {
                    echo esc_html($name);
                }
                break;

            case 'inquiry_email':
                echo esc_html(get_post_meta($post_id, '_shanaynlabs_inquiry_email', true));
                break;

            case 'inquiry_service_interest':
                echo esc_html(get_post_meta($post_id, '_shanaynlabs_inquiry_service_interest', true));
                break;

            case 'inquiry_budget':
                echo esc_html(get_post_meta($post_id, '_shanaynlabs_inquiry_budget', true));
                break;
        }
    }
}
add_action('manage_shanayn_inquiry_posts_custom_column', 'shanaynlabs_project_inquiry_column_content', 10, 2);

if (!function_exists('shanaynlabs_register_project_inquiry_meta_box')) {
    /**
     * Register read-only Project Inquiry details meta box.
     */
    function shanaynlabs_register_project_inquiry_meta_box() {
        add_meta_box(
            'shanaynlabs-inquiry-details',
            __('Inquiry Details', 'shanayn-labs'),
            'shanaynlabs_render_project_inquiry_meta_box',
            'shanayn_inquiry',
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes_shanayn_inquiry', 'shanaynlabs_register_project_inquiry_meta_box');

if (!function_exists('shanaynlabs_render_project_inquiry_meta_box')) {
    /**
     * Render read-only Project Inquiry details.
     *
     * @param WP_Post $post Inquiry post.
     */
    function shanaynlabs_render_project_inquiry_meta_box($post) {
        $fields = array(
            array('label' => __('Name', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_name', true), 'type' => 'text'),
            array('label' => __('Business Name', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_business_name', true), 'type' => 'text'),
            array('label' => __('Email', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_email', true), 'type' => 'text'),
            array('label' => __('Phone / WhatsApp', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_phone', true), 'type' => 'text'),
            array('label' => __('Service Interest', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_service_interest', true), 'type' => 'text'),
            array('label' => __('Project Type', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_project_type', true), 'type' => 'text'),
            array('label' => __('Budget Range', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_budget', true), 'type' => 'text'),
            array('label' => __('Project Timeline', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_project_timeline', true), 'type' => 'text'),
            array('label' => __('Website / Social Link', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_website_social_link', true), 'type' => 'url'),
            array('label' => __('Message', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_message', true), 'type' => 'multiline'),
            array('label' => __('Page URL', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_page_url', true), 'type' => 'url'),
            array('label' => __('Submitted At', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_submitted_at', true), 'type' => 'text'),
            array('label' => __('IP Address', 'shanayn-labs'), 'value' => get_post_meta($post->ID, '_shanaynlabs_inquiry_ip', true), 'type' => 'text'),
        );
        ?>
        <table class="widefat striped">
            <tbody>
                <?php foreach ($fields as $field) : ?>
                    <tr>
                        <th scope="row" style="width: 180px;"><?php echo esc_html($field['label']); ?></th>
                        <td>
                            <?php if ('multiline' === $field['type']) : ?>
                                <?php echo nl2br(esc_html($field['value'])); ?>
                            <?php elseif ('url' === $field['type'] && $field['value']) : ?>
                                <a href="<?php echo esc_url($field['value']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($field['value']); ?></a>
                            <?php else : ?>
                                <?php echo esc_html($field['value']); ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
    }
}
