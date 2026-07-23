<?php
/**
 * Theme helper functions.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return a stable asset version, using filemtime when available.
 *
 * @param string $relative_path Asset path relative to the theme directory.
 * @return string
 */
if (!function_exists('shanaynlabs_asset_version')) {
    function shanaynlabs_asset_version($relative_path) {
        $asset_path = get_template_directory() . '/' . ltrim($relative_path, '/');

        if (file_exists($asset_path)) {
            return (string) filemtime($asset_path);
        }

        return (string) wp_get_theme()->get('Version');
    }
}

if (!function_exists('shanaynlabs_get_featured_content')) {
    /**
     * Fetch featured content for a ShanaynLabs post type.
     *
     * @param string $post_type Internal post type name.
     * @param string $meta_key Featured meta key.
     * @param int    $limit Number of posts to fetch.
     * @param array  $orderby Query orderby arguments.
     * @return WP_Query
     */
    function shanaynlabs_get_featured_content($post_type, $meta_key, $limit, $orderby = array('date' => 'DESC')) {
        $limit = absint($limit);

        if (0 === $limit) {
            $limit = 3;
        }

        return new WP_Query(
            array(
                'post_type' => $post_type,
                'post_status' => 'publish',
                'posts_per_page' => $limit,
                'meta_query' => array(
                    array(
                        'key' => $meta_key,
                        'value' => '1',
                        'compare' => '=',
                    ),
                ),
                'orderby' => $orderby,
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );
    }
}

if (!function_exists('shanaynlabs_get_featured_services')) {
    /**
     * Fetch featured Services.
     *
     * @param int $limit Number of services to fetch.
     * @return WP_Query
     */
    function shanaynlabs_get_featured_services($limit = 3) {
        return shanaynlabs_get_featured_content(
            'shanaynlabs_service',
            '_shanaynlabs_featured_service',
            $limit,
            array(
                'menu_order' => 'ASC',
                'date' => 'DESC',
            )
        );
    }
}

if (!function_exists('shanaynlabs_get_featured_work')) {
    /**
     * Fetch featured Work.
     *
     * @param int $limit Number of projects to fetch.
     * @return WP_Query
     */
    function shanaynlabs_get_featured_work($limit = 3) {
        return shanaynlabs_get_featured_content(
            'shanaynlabs_work',
            '_shanaynlabs_featured_work',
            $limit
        );
    }
}

if (!function_exists('shanaynlabs_get_featured_products')) {
    /**
     * Fetch featured Products.
     *
     * @param int $limit Number of products to fetch.
     * @return WP_Query
     */
    function shanaynlabs_get_featured_products($limit = 3) {
        return shanaynlabs_get_featured_content(
            'shanaynlabs_product',
            '_shanaynlabs_featured_product',
            $limit
        );
    }
}

if (!function_exists('shanaynlabs_get_featured_industries')) {
    /**
     * Fetch featured Industries, falling back to latest Industries.
     *
     * @param int $limit Number of industries to fetch.
     * @return WP_Query
     */
    function shanaynlabs_get_featured_industries($limit = 6) {
        $featured_industries = shanaynlabs_get_featured_content(
            'shanaynlabs_industry',
            '_shanaynlabs_featured_industry',
            $limit
        );

        if ($featured_industries->have_posts()) {
            return $featured_industries;
        }

        return new WP_Query(
            array(
                'post_type' => 'shanaynlabs_industry',
                'post_status' => 'publish',
                'posts_per_page' => absint($limit) ? absint($limit) : 6,
                'orderby' => array(
                    'date' => 'DESC',
                ),
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );
    }
}

if (!function_exists('shanaynlabs_get_featured_testimonials')) {
    /**
     * Fetch featured Testimonials.
     *
     * @param int $limit Number of testimonials to fetch.
     * @return WP_Query
     */
    function shanaynlabs_get_featured_testimonials($limit = 3) {
        return shanaynlabs_get_featured_content(
            'shanayn_testimonial',
            '_shanaynlabs_featured_testimonial',
            $limit
        );
    }
}

if (!function_exists('shanaynlabs_split_lines')) {
    /**
     * Split textarea content into clean lines.
     *
     * @param string $value Textarea value.
     * @return array
     */
    function shanaynlabs_split_lines($value) {
        $lines = preg_split('/\r\n|\r|\n/', (string) $value);

        if (!is_array($lines)) {
            return array();
        }

        $lines = array_map('trim', $lines);
        $lines = array_filter(
            $lines,
            static function ($line) {
                return '' !== $line;
            }
        );

        return array_values($lines);
    }
}

if (!function_exists('shanaynlabs_get_contact_emails')) {
    /**
     * Return contact emails.
     *
     * @return array
     */
    function shanaynlabs_get_contact_emails() {
        return array_values(array_filter(array_map('sanitize_email', shanaynlabs_split_lines(get_option('shanaynlabs_contact_emails', '')))));
    }
}

if (!function_exists('shanaynlabs_get_contact_phones')) {
    /**
     * Return contact phone numbers.
     *
     * @return array
     */
    function shanaynlabs_get_contact_phones() {
        return array_map('sanitize_text_field', shanaynlabs_split_lines(get_option('shanaynlabs_contact_phones', '')));
    }
}

if (!function_exists('shanaynlabs_get_contact_whatsapp')) {
    /**
     * Return contact WhatsApp numbers.
     *
     * @return array
     */
    function shanaynlabs_get_contact_whatsapp() {
        return array_map('sanitize_text_field', shanaynlabs_split_lines(get_option('shanaynlabs_contact_whatsapp', '')));
    }
}

if (!function_exists('shanaynlabs_get_social_links')) {
    /**
     * Return social links.
     *
     * @return array
     */
    function shanaynlabs_get_social_links() {
        $social_fields = array(
            'linkedin' => array(
                'label' => __('LinkedIn', 'shanayn-labs'),
                'option' => 'shanaynlabs_social_linkedin',
            ),
            'instagram' => array(
                'label' => __('Instagram', 'shanayn-labs'),
                'option' => 'shanaynlabs_social_instagram',
            ),
            'twitter' => array(
                'label' => __('Twitter / X', 'shanayn-labs'),
                'option' => 'shanaynlabs_social_twitter',
            ),
            'facebook' => array(
                'label' => __('Facebook', 'shanayn-labs'),
                'option' => 'shanaynlabs_social_facebook',
            ),
            'youtube' => array(
                'label' => __('YouTube', 'shanayn-labs'),
                'option' => 'shanaynlabs_social_youtube',
            ),
        );
        $social_links = array();

        foreach ($social_fields as $key => $field) {
            $url = esc_url_raw(get_option($field['option'], ''));

            if ($url) {
                $social_links[] = array(
                    'label' => $field['label'],
                    'url' => $url,
                    'key' => $key,
                );
            }
        }

        return $social_links;
    }
}

if (!function_exists('shanaynlabs_get_office_locations')) {
    /**
     * Fetch Office Locations.
     *
     * @param int $limit Number of office locations to fetch.
     * @return WP_Query
     */
    function shanaynlabs_get_office_locations($limit = -1) {
        return new WP_Query(
            array(
                'post_type' => 'shanaynlabs_location',
                'post_status' => 'publish',
                'posts_per_page' => intval($limit),
                'meta_query' => array(
                    'relation' => 'OR',
                    'location_order_clause' => array(
                        'key' => '_shanaynlabs_location_order',
                        'compare' => 'EXISTS',
                        'type' => 'NUMERIC',
                    ),
                    array(
                        'key' => '_shanaynlabs_location_order',
                        'compare' => 'NOT EXISTS',
                    ),
                ),
                'orderby' => array(
                    'location_order_clause' => 'ASC',
                    'date' => 'DESC',
                ),
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );
    }
}

if (!function_exists('shanaynlabs_get_inquiry_default_options')) {
    /**
     * Return default inquiry option lists.
     *
     * @param string $key Option list key.
     * @return array
     */
    function shanaynlabs_get_inquiry_default_options($key) {
        $defaults = array(
            'service' => array(
                __('Website Design', 'shanayn-labs'),
                __('WordPress Development', 'shanayn-labs'),
                __('Ecommerce Store', 'shanayn-labs'),
                __('Shopify Store', 'shanayn-labs'),
                __('SEO', 'shanayn-labs'),
                __('Social Media Management', 'shanayn-labs'),
                __('Performance Marketing', 'shanayn-labs'),
                __('Custom Software', 'shanayn-labs'),
                __('Web Application', 'shanayn-labs'),
                __('Business Dashboard', 'shanayn-labs'),
                __('CRM System', 'shanayn-labs'),
                __('POS System', 'shanayn-labs'),
                __('AI Automation', 'shanayn-labs'),
                __('AI Workflow', 'shanayn-labs'),
            ),
            'project_type' => array(
                __('New Website', 'shanayn-labs'),
                __('Website Redesign', 'shanayn-labs'),
                __('Ecommerce Website', 'shanayn-labs'),
                __('Marketing System', 'shanayn-labs'),
                __('Software Product', 'shanayn-labs'),
                __('Business Dashboard', 'shanayn-labs'),
                __('Automation Workflow', 'shanayn-labs'),
                __('AI Workflow', 'shanayn-labs'),
                __('Ongoing Support', 'shanayn-labs'),
            ),
            'budget' => array(
                __('Not sure yet', 'shanayn-labs'),
                __('Under $500', 'shanayn-labs'),
                __('$500 - $1,000', 'shanayn-labs'),
                __('$1,000 - $3,000', 'shanayn-labs'),
                __('$3,000 - $5,000', 'shanayn-labs'),
                __('$5,000+', 'shanayn-labs'),
            ),
        );

        return isset($defaults[$key]) ? $defaults[$key] : array();
    }
}

if (!function_exists('shanaynlabs_get_inquiry_text_setting')) {
    /**
     * Return inquiry text setting with fallback.
     *
     * @param string $option_key Option key.
     * @param string $fallback Fallback value.
     * @return string
     */
    function shanaynlabs_get_inquiry_text_setting($option_key, $fallback) {
        $value = trim((string) get_option($option_key, ''));

        if ('' === $value) {
            return $fallback;
        }

        return sanitize_text_field($value);
    }
}

if (!function_exists('shanaynlabs_get_inquiry_option_list')) {
    /**
     * Return inquiry option list with fallback.
     *
     * @param string $option_key Option key.
     * @param string $default_key Default list key.
     * @return array
     */
    function shanaynlabs_get_inquiry_option_list($option_key, $default_key) {
        $options = array_map('sanitize_text_field', shanaynlabs_split_lines(get_option($option_key, '')));

        if (empty($options)) {
            return shanaynlabs_get_inquiry_default_options($default_key);
        }

        return $options;
    }
}

if (!function_exists('shanaynlabs_get_inquiry_form_heading')) {
    /**
     * Return inquiry form heading.
     *
     * @return string
     */
    function shanaynlabs_get_inquiry_form_heading() {
        return shanaynlabs_get_inquiry_text_setting('shanaynlabs_inquiry_form_heading', __('Project Inquiry', 'shanayn-labs'));
    }
}

if (!function_exists('shanaynlabs_get_inquiry_form_description')) {
    /**
     * Return inquiry form description.
     *
     * @return string
     */
    function shanaynlabs_get_inquiry_form_description() {
        return shanaynlabs_get_inquiry_text_setting('shanaynlabs_inquiry_form_description', __('Tell us what you want to build, improve, or automate.', 'shanayn-labs'));
    }
}

if (!function_exists('shanaynlabs_get_inquiry_service_options')) {
    /**
     * Return service interest options.
     *
     * @return array
     */
    function shanaynlabs_get_inquiry_service_options() {
        return shanaynlabs_get_inquiry_option_list('shanaynlabs_inquiry_service_options', 'service');
    }
}

if (!function_exists('shanaynlabs_get_inquiry_project_type_options')) {
    /**
     * Return project type options.
     *
     * @return array
     */
    function shanaynlabs_get_inquiry_project_type_options() {
        return shanaynlabs_get_inquiry_option_list('shanaynlabs_inquiry_project_type_options', 'project_type');
    }
}

if (!function_exists('shanaynlabs_get_inquiry_budget_options')) {
    /**
     * Return budget range options.
     *
     * @return array
     */
    function shanaynlabs_get_inquiry_budget_options() {
        return shanaynlabs_get_inquiry_option_list('shanaynlabs_inquiry_budget_options', 'budget');
    }
}

if (!function_exists('shanaynlabs_get_inquiry_submit_text')) {
    /**
     * Return submit button text.
     *
     * @return string
     */
    function shanaynlabs_get_inquiry_submit_text() {
        return shanaynlabs_get_inquiry_text_setting('shanaynlabs_inquiry_submit_text', __('Send Project Inquiry', 'shanayn-labs'));
    }
}

if (!function_exists('shanaynlabs_get_inquiry_success_message')) {
    /**
     * Return inquiry success message.
     *
     * @return string
     */
    function shanaynlabs_get_inquiry_success_message() {
        return shanaynlabs_get_inquiry_text_setting('shanaynlabs_inquiry_success_message', __('Thank you. Your inquiry has been received.', 'shanayn-labs'));
    }
}

if (!function_exists('shanaynlabs_get_inquiry_error_message')) {
    /**
     * Return inquiry error message.
     *
     * @return string
     */
    function shanaynlabs_get_inquiry_error_message() {
        return shanaynlabs_get_inquiry_text_setting('shanaynlabs_inquiry_error_message', __('Please fill in the required fields correctly.', 'shanayn-labs'));
    }
}

if (!function_exists('shanaynlabs_get_team_members')) {
    /**
     * Fetch Team Members.
     *
     * @param array $args Query arguments.
     * @return WP_Query
     */
    function shanaynlabs_get_team_members($args = array()) {
        $defaults = array(
            'founders_only' => false,
            'non_founders_only' => false,
            'limit' => -1,
        );
        $args = wp_parse_args($args, $defaults);

        $query_args = array(
            'post_type' => 'shanaynlabs_team',
            'post_status' => 'publish',
            'posts_per_page' => intval($args['limit']),
            'meta_key' => '_shanaynlabs_team_order',
            'orderby' => array(
                'meta_value_num' => 'ASC',
                'date' => 'DESC',
            ),
            'no_found_rows' => true,
            'ignore_sticky_posts' => true,
        );

        if (!empty($args['founders_only'])) {
            $query_args['meta_query'] = array(
                array(
                    'key' => '_shanaynlabs_team_is_founder',
                    'value' => '1',
                    'compare' => '=',
                ),
            );
        } elseif (!empty($args['non_founders_only'])) {
            $query_args['meta_query'] = array(
                'relation' => 'OR',
                array(
                    'key' => '_shanaynlabs_team_is_founder',
                    'compare' => 'NOT EXISTS',
                ),
                array(
                    'key' => '_shanaynlabs_team_is_founder',
                    'value' => '1',
                    'compare' => '!=',
                ),
            );
        }

        return new WP_Query($query_args);
    }
}

if (!function_exists('shanaynlabs_get_founding_team_members')) {
    /**
     * Fetch founding Team Members.
     *
     * @param int $limit Number of team members to fetch.
     * @return WP_Query
     */
    function shanaynlabs_get_founding_team_members($limit = -1) {
        return shanaynlabs_get_team_members(
            array(
                'founders_only' => true,
                'limit' => $limit,
            )
        );
    }
}

if (!function_exists('shanaynlabs_render_project_inquiry_section')) {
    /**
     * Render the reusable Start Your Project inquiry section.
     *
     * @param array $args Section arguments.
     */
    function shanaynlabs_render_project_inquiry_section($args = array()) {
        $defaults = array(
            'id' => 'project-inquiry',
            'heading' => __("Let's build the system your business actually needs.", 'shanayn-labs'),
        );
        $args = wp_parse_args($args, $defaults);

        $section_id = sanitize_html_class($args['id']);
        $heading_id = $section_id . '-heading';
        $inquiry_status = isset($_GET['inquiry']) ? sanitize_key(wp_unslash($_GET['inquiry'])) : '';
        $redirect_url = home_url('/contact/');

        if (isset($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'])) {
            $http_host = sanitize_text_field(wp_unslash($_SERVER['HTTP_HOST']));
            $request_uri = sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']));
            $redirect_url = remove_query_arg(array('inquiry', 'contact_status'), set_url_scheme('http://' . $http_host . $request_uri));
        }

        $form_heading = shanaynlabs_get_inquiry_form_heading();
        $form_description = shanaynlabs_get_inquiry_form_description();
        $service_options = shanaynlabs_get_inquiry_service_options();
        $project_types = shanaynlabs_get_inquiry_project_type_options();
        $budget_options = shanaynlabs_get_inquiry_budget_options();
        $submit_text = shanaynlabs_get_inquiry_submit_text();
        $success_message = shanaynlabs_get_inquiry_success_message();
        $error_message = shanaynlabs_get_inquiry_error_message();
        ?>
        <section id="<?php echo esc_attr($section_id); ?>" class="section project-inquiry" aria-labelledby="<?php echo esc_attr($heading_id); ?>" data-animate>
            <div class="container project-inquiry-inner">
                <div class="project-inquiry-content">
                    <p class="project-inquiry-kicker"><?php esc_html_e('START A CONVERSATION', 'shanayn-labs'); ?></p>
                    <h2 id="<?php echo esc_attr($heading_id); ?>"><?php echo esc_html($args['heading']); ?></h2>
                    <p class="project-inquiry-lede">
                        <?php esc_html_e("Share a few details about your business and we'll help you define the right website, marketing, software, or AI system.", 'shanayn-labs'); ?>
                    </p>

                    <ul class="project-inquiry-trust" aria-label="<?php echo esc_attr__('What to expect', 'shanayn-labs'); ?>">
                        <li><?php esc_html_e('Clear project direction', 'shanayn-labs'); ?></li>
                        <li><?php esc_html_e('Practical recommendations', 'shanayn-labs'); ?></li>
                        <li><?php esc_html_e('Focused business-first approach', 'shanayn-labs'); ?></li>
                    </ul>

                    <p class="project-inquiry-response"><?php esc_html_e('We usually respond within 24 hours.', 'shanayn-labs'); ?></p>

                    <div class="project-inquiry-pills" aria-label="<?php echo esc_attr__('Project types', 'shanayn-labs'); ?>">
                        <?php foreach ($project_types as $project_type_label) : ?>
                            <span><?php echo esc_html($project_type_label); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="project-inquiry-card">
                    <h3><?php echo esc_html($form_heading); ?></h3>
                    <p class="project-inquiry-card-description"><?php echo esc_html($form_description); ?></p>

                    <?php if ('success' === $inquiry_status) : ?>
                        <div class="form-notice form-notice-success" role="status">
                            <?php echo esc_html($success_message); ?>
                        </div>
                    <?php elseif (in_array($inquiry_status, array('invalid', 'error'), true)) : ?>
                        <div class="form-notice form-notice-error" role="alert">
                            <?php echo esc_html($error_message); ?>
                        </div>
                    <?php endif; ?>

                    <form class="project-inquiry-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" aria-label="<?php echo esc_attr__('Project inquiry form', 'shanayn-labs'); ?>">
                        <input type="hidden" name="action" value="shanaynlabs_contact_form">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_url); ?>">
                        <input type="hidden" name="shanaynlabs_form_started_at" value="<?php echo esc_attr(time()); ?>">
                        <?php wp_nonce_field('shanaynlabs_contact_form', 'shanaynlabs_contact_nonce'); ?>

                        <div class="honeypot-field" aria-hidden="true">
                            <label for="<?php echo esc_attr($section_id); ?>-website"><?php esc_html_e('Website', 'shanayn-labs'); ?></label>
                            <input id="<?php echo esc_attr($section_id); ?>-website" name="shanaynlabs_company_website" type="text" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="project-inquiry-field">
                            <label for="<?php echo esc_attr($section_id); ?>-full-name"><?php esc_html_e('Full Name', 'shanayn-labs'); ?></label>
                            <input id="<?php echo esc_attr($section_id); ?>-full-name" name="full_name" type="text" autocomplete="name" required>
                        </div>

                        <div class="project-inquiry-field">
                            <label for="<?php echo esc_attr($section_id); ?>-business-name"><?php esc_html_e('Business Name', 'shanayn-labs'); ?></label>
                            <input id="<?php echo esc_attr($section_id); ?>-business-name" name="business_name" type="text" autocomplete="organization">
                        </div>

                        <div class="project-inquiry-field">
                            <label for="<?php echo esc_attr($section_id); ?>-email-address"><?php esc_html_e('Email Address', 'shanayn-labs'); ?></label>
                            <input id="<?php echo esc_attr($section_id); ?>-email-address" name="email_address" type="email" autocomplete="email" required>
                        </div>

                        <div class="project-inquiry-field">
                            <label for="<?php echo esc_attr($section_id); ?>-phone-whatsapp"><?php esc_html_e('Phone / WhatsApp', 'shanayn-labs'); ?></label>
                            <input id="<?php echo esc_attr($section_id); ?>-phone-whatsapp" name="phone_whatsapp" type="tel" autocomplete="tel">
                        </div>

                        <div class="project-inquiry-field project-inquiry-field-wide">
                            <label for="<?php echo esc_attr($section_id); ?>-service-interest"><?php esc_html_e('Service Interest', 'shanayn-labs'); ?></label>
                            <select id="<?php echo esc_attr($section_id); ?>-service-interest" name="service_interest">
                                <?php foreach ($service_options as $service_option) : ?>
                                    <option value="<?php echo esc_attr($service_option); ?>"><?php echo esc_html($service_option); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <fieldset class="project-inquiry-field project-inquiry-field-wide project-inquiry-checks">
                            <legend><?php esc_html_e('Project Type', 'shanayn-labs'); ?></legend>
                            <div class="project-inquiry-check-grid">
                                <?php foreach ($project_types as $project_type_label) : ?>
                                    <label>
                                        <input type="checkbox" name="project_type[]" value="<?php echo esc_attr($project_type_label); ?>">
                                        <span><?php echo esc_html($project_type_label); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </fieldset>

                        <div class="project-inquiry-field project-inquiry-field-wide">
                            <label for="<?php echo esc_attr($section_id); ?>-budget-range"><?php esc_html_e('Budget Range', 'shanayn-labs'); ?></label>
                            <select id="<?php echo esc_attr($section_id); ?>-budget-range" name="budget_range">
                                <?php foreach ($budget_options as $budget_option) : ?>
                                    <option value="<?php echo esc_attr($budget_option); ?>"><?php echo esc_html($budget_option); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="project-inquiry-field project-inquiry-field-wide">
                            <label for="<?php echo esc_attr($section_id); ?>-project-details"><?php esc_html_e('Project Details', 'shanayn-labs'); ?></label>
                            <textarea id="<?php echo esc_attr($section_id); ?>-project-details" name="message" rows="5" required></textarea>
                        </div>

                        <button class="project-inquiry-submit" type="submit">
                            <?php echo esc_html($submit_text); ?>
                            <span aria-hidden="true">&rarr;</span>
                        </button>

                    </form>
                </div>
            </div>
        </section>
        <?php
    }
}
