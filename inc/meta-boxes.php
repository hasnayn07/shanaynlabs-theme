<?php
/**
 * Admin meta boxes.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Return meta box field definitions.
 *
 * @return array
 */
function shanaynlabs_get_meta_box_fields() {
    return array(
        'shanaynlabs_service' => array(
            'title' => __('Service Details', 'shanayn-labs'),
            'fields' => array(
                '_shanaynlabs_short_label' => array(
                    'label' => __('Short Label', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_service_icon_text' => array(
                    'label' => __('Service Icon Text', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_primary_cta_text' => array(
                    'label' => __('Primary CTA Text', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_primary_cta_url' => array(
                    'label' => __('Primary CTA URL', 'shanayn-labs'),
                    'type' => 'url',
                ),
                '_shanaynlabs_featured_service' => array(
                    'label' => __('Featured Service', 'shanayn-labs'),
                    'type' => 'checkbox',
                ),
            ),
        ),
        'shanaynlabs_work' => array(
            'title' => __('Work Details', 'shanayn-labs'),
            'fields' => array(
                '_shanaynlabs_client_name' => array(
                    'label' => __('Client Name', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_project_type' => array(
                    'label' => __('Project Type', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_result_summary' => array(
                    'label' => __('Result Summary', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_work_service_tags' => array(
                    'label' => __('Work Service Tags', 'shanayn-labs'),
                    'type' => 'textarea',
                    'description' => __('Enter one tag per line.', 'shanayn-labs'),
                ),
                '_shanaynlabs_project_url' => array(
                    'label' => __('Project URL', 'shanayn-labs'),
                    'type' => 'url',
                ),
                '_shanaynlabs_featured_work' => array(
                    'label' => __('Featured Work', 'shanayn-labs'),
                    'type' => 'checkbox',
                ),
            ),
        ),
        'shanaynlabs_product' => array(
            'title' => __('Product Details', 'shanayn-labs'),
            'fields' => array(
                '_shanaynlabs_product_type' => array(
                    'label' => __('Product Type', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_product_features' => array(
                    'label' => __('Product Features', 'shanayn-labs'),
                    'type' => 'textarea',
                    'description' => __('Enter one feature/tag per line.', 'shanayn-labs'),
                ),
                '_shanaynlabs_product_status' => array(
                    'label' => __('Product Status', 'shanayn-labs'),
                    'type' => 'select',
                    'options' => array(
                        'available' => __('Available', 'shanayn-labs'),
                        'in-development' => __('In Development', 'shanayn-labs'),
                        'coming-soon' => __('Coming Soon', 'shanayn-labs'),
                        'private-demo' => __('Private Demo', 'shanayn-labs'),
                        'custom-build' => __('Custom Build', 'shanayn-labs'),
                    ),
                ),
                '_shanaynlabs_demo_url' => array(
                    'label' => __('Demo URL', 'shanayn-labs'),
                    'type' => 'url',
                ),
                '_shanaynlabs_cta_text' => array(
                    'label' => __('CTA Text', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_featured_product' => array(
                    'label' => __('Featured Product', 'shanayn-labs'),
                    'type' => 'checkbox',
                ),
            ),
        ),
        'shanaynlabs_industry' => array(
            'title' => __('Industry Details', 'shanayn-labs'),
            'fields' => array(
                '_shanaynlabs_industry_short_description' => array(
                    'label' => __('Industry Short Description', 'shanayn-labs'),
                    'type' => 'textarea',
                    'description' => __('Write a short 2-3 line description.', 'shanayn-labs'),
                ),
                '_shanaynlabs_industry_icon_text' => array(
                    'label' => __('Industry Icon Text', 'shanayn-labs'),
                    'type' => 'text',
                    'description' => __('Use a short icon text, emoji, or initials. Example: Retail, 🛒, Health, 🏥', 'shanayn-labs'),
                ),
                '_shanaynlabs_featured_industry' => array(
                    'label' => __('Featured Industry', 'shanayn-labs'),
                    'type' => 'checkbox',
                    'description' => __('Show this industry on the homepage.', 'shanayn-labs'),
                ),
            ),
        ),
        'shanayn_testimonial' => array(
            'title' => __('Testimonial Details', 'shanayn-labs'),
            'fields' => array(
                '_shanaynlabs_testimonial_client_name' => array(
                    'label' => __('Client Name', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_client_role_company' => array(
                    'label' => __('Client Role / Company', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_rating' => array(
                    'label' => __('Rating', 'shanayn-labs'),
                    'type' => 'number',
                    'min' => 1,
                    'max' => 5,
                ),
                '_shanaynlabs_featured_testimonial' => array(
                    'label' => __('Featured Testimonial', 'shanayn-labs'),
                    'type' => 'checkbox',
                ),
            ),
        ),
        'shanaynlabs_team' => array(
            'title' => __('Team Member Details', 'shanayn-labs'),
            'fields' => array(
                '_shanaynlabs_team_role' => array(
                    'label' => __('Role', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_team_bio' => array(
                    'label' => __('Short Bio', 'shanayn-labs'),
                    'type' => 'textarea',
                    'description' => __('Short professional bio, 2-3 lines.', 'shanayn-labs'),
                ),
                '_shanaynlabs_team_expertise' => array(
                    'label' => __('Expertise Tags', 'shanayn-labs'),
                    'type' => 'textarea',
                    'description' => __('One expertise tag per line.', 'shanayn-labs'),
                ),
                '_shanaynlabs_team_linkedin' => array(
                    'label' => __('LinkedIn URL', 'shanayn-labs'),
                    'type' => 'url',
                ),
                '_shanaynlabs_team_custom_link' => array(
                    'label' => __('Custom Link', 'shanayn-labs'),
                    'type' => 'url',
                ),
                '_shanaynlabs_team_is_founder' => array(
                    'label' => __('Founding Member', 'shanayn-labs'),
                    'type' => 'checkbox',
                ),
                '_shanaynlabs_team_order' => array(
                    'label' => __('Display Order', 'shanayn-labs'),
                    'type' => 'number',
                    'min' => 0,
                ),
            ),
        ),
        'shanaynlabs_location' => array(
            'title' => __('Office Location Details', 'shanayn-labs'),
            'fields' => array(
                '_shanaynlabs_location_address' => array(
                    'label' => __('Address', 'shanayn-labs'),
                    'type' => 'textarea',
                ),
                '_shanaynlabs_location_city' => array(
                    'label' => __('City / Area', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_location_email' => array(
                    'label' => __('Email', 'shanayn-labs'),
                    'type' => 'email',
                ),
                '_shanaynlabs_location_phone' => array(
                    'label' => __('Phone', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_location_whatsapp' => array(
                    'label' => __('WhatsApp', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanaynlabs_location_map_link' => array(
                    'label' => __('Google Map Link', 'shanayn-labs'),
                    'type' => 'url',
                ),
                '_shanaynlabs_location_map_embed' => array(
                    'label' => __('Google Map Embed', 'shanayn-labs'),
                    'type' => 'textarea',
                ),
                '_shanaynlabs_location_hours' => array(
                    'label' => __('Business Hours', 'shanayn-labs'),
                    'type' => 'textarea',
                ),
                '_shanaynlabs_location_featured' => array(
                    'label' => __('Featured Location', 'shanayn-labs'),
                    'type' => 'checkbox',
                ),
                '_shanaynlabs_location_order' => array(
                    'label' => __('Display Order', 'shanayn-labs'),
                    'type' => 'number',
                    'min' => 0,
                ),
            ),
        ),
        'shanayn_package' => array(
            'title' => __('Pricing Package Details', 'shanayn-labs'),
            'fields' => array(
                '_shanayn_package_tier' => array(
                    'label' => __('Package Tier', 'shanayn-labs'),
                    'type' => 'select',
                    'options' => array(
                        'silver' => __('Silver', 'shanayn-labs'),
                        'gold' => __('Gold', 'shanayn-labs'),
                        'platinum' => __('Platinum', 'shanayn-labs'),
                    ),
                ),
                '_shanayn_package_price' => array(
                    'label' => __('Price Text', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanayn_package_price_note' => array(
                    'label' => __('Price Note', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanayn_package_description' => array(
                    'label' => __('Short Description', 'shanayn-labs'),
                    'type' => 'textarea',
                ),
                '_shanayn_package_features' => array(
                    'label' => __('Included Features', 'shanayn-labs'),
                    'type' => 'textarea',
                    'description' => __('Enter one feature per line.', 'shanayn-labs'),
                ),
                '_shanayn_package_cta_text' => array(
                    'label' => __('CTA Text', 'shanayn-labs'),
                    'type' => 'text',
                ),
                '_shanayn_package_cta_url' => array(
                    'label' => __('CTA URL', 'shanayn-labs'),
                    'type' => 'url',
                ),
                '_shanayn_package_featured' => array(
                    'label' => __('Featured / Recommended Package', 'shanayn-labs'),
                    'type' => 'checkbox',
                ),
                '_shanayn_package_order' => array(
                    'label' => __('Sort Order', 'shanayn-labs'),
                    'type' => 'number',
                    'min' => 0,
                ),
            ),
        ),
    );
}

/**
 * Add custom meta boxes.
 */
function shanaynlabs_add_meta_boxes() {
    foreach (shanaynlabs_get_meta_box_fields() as $post_type => $box) {
        add_meta_box(
            'shanaynlabs_details',
            $box['title'],
            'shanaynlabs_render_meta_box',
            $post_type,
            'normal',
            'default'
        );
    }
}
add_action('add_meta_boxes', 'shanaynlabs_add_meta_boxes');

/**
 * Render a meta box.
 *
 * @param WP_Post $post Current post object.
 */
function shanaynlabs_render_meta_box($post) {
    $post_type = get_post_type($post);
    $boxes = shanaynlabs_get_meta_box_fields();

    if (!isset($boxes[$post_type])) {
        return;
    }

    wp_nonce_field('shanaynlabs_save_meta_box', 'shanaynlabs_meta_box_nonce');
    ?>
    <table class="form-table" role="presentation">
        <tbody>
            <?php foreach ($boxes[$post_type]['fields'] as $meta_key => $field) : ?>
                <?php
                $value = get_post_meta($post->ID, $meta_key, true);
                $field_id = str_replace('_', '-', ltrim($meta_key, '_'));
                ?>
                <tr>
                    <th scope="row">
                        <label for="<?php echo esc_attr($field_id); ?>">
                            <?php echo esc_html($field['label']); ?>
                        </label>
                    </th>
                    <td>
                        <?php if ('checkbox' === $field['type']) : ?>
                            <label>
                                <input
                                    type="checkbox"
                                    id="<?php echo esc_attr($field_id); ?>"
                                    name="<?php echo esc_attr($meta_key); ?>"
                                    value="1"
                                    <?php checked('1', $value); ?>
                                >
                                <?php esc_html_e('Yes', 'shanayn-labs'); ?>
                            </label>
                            <?php if (!empty($field['description'])) : ?>
                                <p class="description"><?php echo esc_html($field['description']); ?></p>
                            <?php endif; ?>
                        <?php elseif ('select' === $field['type']) : ?>
                            <select
                                id="<?php echo esc_attr($field_id); ?>"
                                name="<?php echo esc_attr($meta_key); ?>"
                            >
                                <?php foreach ($field['options'] as $option_value => $option_label) : ?>
                                    <option value="<?php echo esc_attr($option_value); ?>" <?php selected($value, $option_value); ?>>
                                        <?php echo esc_html($option_label); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        <?php elseif ('textarea' === $field['type']) : ?>
                            <textarea
                                class="large-text"
                                rows="5"
                                id="<?php echo esc_attr($field_id); ?>"
                                name="<?php echo esc_attr($meta_key); ?>"
                            ><?php echo esc_textarea($value); ?></textarea>
                            <?php if (!empty($field['description'])) : ?>
                                <p class="description"><?php echo esc_html($field['description']); ?></p>
                            <?php endif; ?>
                        <?php elseif ('number' === $field['type']) : ?>
                            <input
                                type="number"
                                class="small-text"
                                id="<?php echo esc_attr($field_id); ?>"
                                name="<?php echo esc_attr($meta_key); ?>"
                                value="<?php echo esc_attr($value); ?>"
                                min="<?php echo esc_attr($field['min']); ?>"
                                <?php if (isset($field['max'])) : ?>
                                    max="<?php echo esc_attr($field['max']); ?>"
                                <?php endif; ?>
                            >
                        <?php else : ?>
                            <input
                                type="<?php echo esc_attr($field['type']); ?>"
                                class="regular-text"
                                id="<?php echo esc_attr($field_id); ?>"
                                name="<?php echo esc_attr($meta_key); ?>"
                                value="<?php echo esc_attr($value); ?>"
                            >
                            <?php if (!empty($field['description'])) : ?>
                                <p class="description"><?php echo esc_html($field['description']); ?></p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
}

/**
 * Save custom meta box values.
 *
 * @param int $post_id Current post ID.
 */
function shanaynlabs_save_meta_boxes($post_id) {
    if (!isset($_POST['shanaynlabs_meta_box_nonce'])) {
        return;
    }

    $nonce = wp_unslash($_POST['shanaynlabs_meta_box_nonce']);

    if (is_array($nonce)) {
        return;
    }

    $nonce = sanitize_text_field($nonce);

    if (!wp_verify_nonce($nonce, 'shanaynlabs_save_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (wp_is_post_revision($post_id)) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $post_type = get_post_type($post_id);
    $boxes = shanaynlabs_get_meta_box_fields();

    if (!isset($boxes[$post_type])) {
        return;
    }

    foreach ($boxes[$post_type]['fields'] as $meta_key => $field) {
        if ('checkbox' === $field['type']) {
            update_post_meta($post_id, $meta_key, isset($_POST[$meta_key]) ? '1' : '');
            continue;
        }

        if (!isset($_POST[$meta_key])) {
            delete_post_meta($post_id, $meta_key);
            continue;
        }

        $raw_value = wp_unslash($_POST[$meta_key]);

        if (is_array($raw_value)) {
            $raw_value = '';
        }

        if ('url' === $field['type']) {
            $value = esc_url_raw($raw_value);
        } elseif ('email' === $field['type']) {
            $value = sanitize_email($raw_value);
        } elseif ('number' === $field['type']) {
            $value = absint($raw_value);
            if (isset($field['min'])) {
                $value = max(absint($field['min']), $value);
            }
            if (isset($field['max'])) {
                $value = min(absint($field['max']), $value);
            }
        } elseif ('textarea' === $field['type']) {
            $value = sanitize_textarea_field($raw_value);
        } elseif ('select' === $field['type']) {
            $value = sanitize_key($raw_value);
            if (!isset($field['options'][$value])) {
                $option_keys = array_keys($field['options']);
                $value = (string) reset($option_keys);
            }
        } else {
            $value = sanitize_text_field($raw_value);
        }

        update_post_meta($post_id, $meta_key, $value);
    }
}
add_action('save_post', 'shanaynlabs_save_meta_boxes');
