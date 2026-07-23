<?php
/**
 * Theme settings.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return contact settings fields.
 *
 * @return array
 */
function shanaynlabs_get_contact_settings_fields() {
    return array(
        'shanaynlabs_contact_emails' => array(
            'label' => __('Emails', 'shanayn-labs'),
            'type' => 'textarea',
            'description' => __('One email per line.', 'shanayn-labs'),
        ),
        'shanaynlabs_contact_phones' => array(
            'label' => __('Phone Numbers', 'shanayn-labs'),
            'type' => 'textarea',
            'description' => __('One phone number per line.', 'shanayn-labs'),
        ),
        'shanaynlabs_contact_whatsapp' => array(
            'label' => __('WhatsApp Numbers', 'shanayn-labs'),
            'type' => 'textarea',
            'description' => __('One WhatsApp number per line.', 'shanayn-labs'),
        ),
        'shanaynlabs_business_hours' => array(
            'label' => __('Business Hours', 'shanayn-labs'),
            'type' => 'textarea',
        ),
        'shanaynlabs_response_time' => array(
            'label' => __('Response Time Text', 'shanayn-labs'),
            'type' => 'text',
        ),
        'shanaynlabs_contact_hero_eyebrow' => array(
            'label' => __('Contact Hero Eyebrow', 'shanayn-labs'),
            'type' => 'text',
            'default' => __('CONTACT SHANAYN LABS', 'shanayn-labs'),
        ),
        'shanaynlabs_contact_hero_heading' => array(
            'label' => __('Contact Hero Heading', 'shanayn-labs'),
            'type' => 'text',
            'default' => __("Let's talk about what your business needs next.", 'shanayn-labs'),
        ),
        'shanaynlabs_contact_hero_description' => array(
            'label' => __('Contact Hero Description', 'shanayn-labs'),
            'type' => 'textarea',
            'default' => __('Share your project details, ask a question, or book a conversation about your website, marketing, software, automation, or AI workflow.', 'shanayn-labs'),
        ),
        'shanaynlabs_contact_details_heading' => array(
            'label' => __('Contact Details Heading', 'shanayn-labs'),
            'type' => 'text',
        ),
        'shanaynlabs_contact_details_description' => array(
            'label' => __('Contact Details Description', 'shanayn-labs'),
            'type' => 'textarea',
        ),
    );
}

/**
 * Return company social link settings fields.
 *
 * @return array
 */
function shanaynlabs_get_company_social_settings_fields() {
    return array(
        'shanaynlabs_social_linkedin' => array(
            'label' => __('LinkedIn URL', 'shanayn-labs'),
            'type' => 'url',
            'description' => __('Example: https://www.linkedin.com/company/shanaynlabs', 'shanayn-labs'),
        ),
        'shanaynlabs_social_instagram' => array(
            'label' => __('Instagram URL', 'shanayn-labs'),
            'type' => 'url',
            'description' => __('Example: https://www.instagram.com/shanaynlabs', 'shanayn-labs'),
        ),
        'shanaynlabs_social_twitter' => array(
            'label' => __('Twitter / X URL', 'shanayn-labs'),
            'type' => 'url',
            'description' => __('Example: https://x.com/shanaynlabs', 'shanayn-labs'),
        ),
        'shanaynlabs_social_facebook' => array(
            'label' => __('Facebook URL', 'shanayn-labs'),
            'type' => 'url',
            'description' => __('Example: https://www.facebook.com/shanaynlabs', 'shanayn-labs'),
        ),
        'shanaynlabs_social_youtube' => array(
            'label' => __('YouTube URL', 'shanayn-labs'),
            'type' => 'url',
            'description' => __('Example: https://www.youtube.com/@shanaynlabs', 'shanayn-labs'),
        ),
    );
}

/**
 * Return inquiry form settings fields.
 *
 * @return array
 */
function shanaynlabs_get_inquiry_form_settings_fields() {
    return array(
        'shanaynlabs_inquiry_form_heading' => array(
            'label' => __('Form Heading', 'shanayn-labs'),
            'type' => 'text',
            'default' => __('Project Inquiry', 'shanayn-labs'),
        ),
        'shanaynlabs_inquiry_form_description' => array(
            'label' => __('Form Description', 'shanayn-labs'),
            'type' => 'textarea',
            'default' => __('Tell us what you want to build, improve, or automate.', 'shanayn-labs'),
        ),
        'shanaynlabs_inquiry_service_options' => array(
            'label' => __('Service Interest Options', 'shanayn-labs'),
            'type' => 'textarea',
            'description' => __('One option per line.', 'shanayn-labs'),
            'default' => "Website Design\nWordPress Development\nEcommerce Store\nShopify Store\nSEO\nSocial Media Management\nPerformance Marketing\nCustom Software\nWeb Application\nBusiness Dashboard\nCRM System\nPOS System\nAI Automation\nAI Workflow",
        ),
        'shanaynlabs_inquiry_project_type_options' => array(
            'label' => __('Project Type Options', 'shanayn-labs'),
            'type' => 'textarea',
            'description' => __('One option per line.', 'shanayn-labs'),
            'default' => "New Website\nWebsite Redesign\nEcommerce Website\nMarketing System\nSoftware Product\nBusiness Dashboard\nAutomation Workflow\nAI Workflow\nOngoing Support",
        ),
        'shanaynlabs_inquiry_budget_options' => array(
            'label' => __('Budget Range Options', 'shanayn-labs'),
            'type' => 'textarea',
            'description' => __('One option per line.', 'shanayn-labs'),
            'default' => "Not sure yet\nUnder $500\n$500 - $1,000\n$1,000 - $3,000\n$3,000 - $5,000\n$5,000+",
        ),
        'shanaynlabs_inquiry_submit_text' => array(
            'label' => __('Submit Button Text', 'shanayn-labs'),
            'type' => 'text',
            'default' => __('Send Project Inquiry', 'shanayn-labs'),
        ),
        'shanaynlabs_inquiry_success_message' => array(
            'label' => __('Success Message', 'shanayn-labs'),
            'type' => 'text',
            'default' => __('Thank you. Your inquiry has been received.', 'shanayn-labs'),
        ),
        'shanaynlabs_inquiry_error_message' => array(
            'label' => __('Invalid/Error Message', 'shanayn-labs'),
            'type' => 'text',
            'default' => __('Please fill in the required fields correctly.', 'shanayn-labs'),
        ),
    );
}

/**
 * Sanitize a contact setting value.
 *
 * @param mixed $value Submitted value.
 * @param array $field Field definition.
 * @return string
 */
function shanaynlabs_sanitize_contact_setting($value, $field) {
    if (is_array($value)) {
        $value = '';
    }

    $value = wp_unslash($value);

    if ('url' === $field['type']) {
        return esc_url_raw($value);
    }

    if ('textarea' === $field['type']) {
        return sanitize_textarea_field($value);
    }

    return sanitize_text_field($value);
}

/**
 * Register settings page and fields.
 */
function shanaynlabs_register_contact_settings() {
    add_settings_section(
        'shanaynlabs_contact_details_section',
        __('Contact Details', 'shanayn-labs'),
        '__return_false',
        'shanaynlabs-contact-details'
    );

    add_settings_section(
        'shanaynlabs_company_social_links_section',
        __('Company Social Links', 'shanayn-labs'),
        '__return_false',
        'shanaynlabs-contact-details'
    );

    add_settings_section(
        'shanaynlabs_inquiry_form_settings_section',
        __('Inquiry Form Settings', 'shanayn-labs'),
        '__return_false',
        'shanaynlabs-contact-details'
    );

    $settings_sections = array(
        'shanaynlabs_contact_details_section' => shanaynlabs_get_contact_settings_fields(),
        'shanaynlabs_company_social_links_section' => shanaynlabs_get_company_social_settings_fields(),
        'shanaynlabs_inquiry_form_settings_section' => shanaynlabs_get_inquiry_form_settings_fields(),
    );

    foreach ($settings_sections as $section_id => $fields) {
        foreach ($fields as $option_key => $field) {
        register_setting(
            'shanaynlabs_contact_details',
            $option_key,
            array(
                'type' => 'string',
                'sanitize_callback' => static function ($value) use ($field) {
                    return shanaynlabs_sanitize_contact_setting($value, $field);
                },
                'default' => isset($field['default']) ? $field['default'] : '',
            )
        );

        add_settings_field(
            $option_key,
            $field['label'],
            'shanaynlabs_render_contact_setting_field',
            'shanaynlabs-contact-details',
            $section_id,
            array(
                'option_key' => $option_key,
                'field' => $field,
            )
        );
        }
    }
}
add_action('admin_init', 'shanaynlabs_register_contact_settings');

/**
 * Register settings admin menu.
 */
function shanaynlabs_register_settings_page() {
    add_menu_page(
        __('Contact Details', 'shanayn-labs'),
        __('ShanaynLabs Settings', 'shanayn-labs'),
        'manage_options',
        'shanaynlabs-contact-details',
        'shanaynlabs_render_contact_settings_page',
        'dashicons-admin-generic',
        59
    );
}
add_action('admin_menu', 'shanaynlabs_register_settings_page');

/**
 * Render a settings field.
 *
 * @param array $args Field args.
 */
function shanaynlabs_render_contact_setting_field($args) {
    $option_key = $args['option_key'];
    $field = $args['field'];
    $value = get_option($option_key, isset($field['default']) ? $field['default'] : '');

    if ('textarea' === $field['type']) {
        ?>
        <textarea
            class="large-text"
            rows="5"
            id="<?php echo esc_attr($option_key); ?>"
            name="<?php echo esc_attr($option_key); ?>"
        ><?php echo esc_textarea($value); ?></textarea>
        <?php
    } else {
        ?>
        <input
            type="<?php echo esc_attr($field['type']); ?>"
            class="regular-text"
            id="<?php echo esc_attr($option_key); ?>"
            name="<?php echo esc_attr($option_key); ?>"
            value="<?php echo esc_attr($value); ?>"
        >
        <?php
    }

    if (!empty($field['description'])) {
        ?>
        <p class="description"><?php echo esc_html($field['description']); ?></p>
        <?php
    }
}

/**
 * Render settings page.
 */
function shanaynlabs_render_contact_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Contact Details', 'shanayn-labs'); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('shanaynlabs_contact_details');
            do_settings_sections('shanaynlabs-contact-details');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
