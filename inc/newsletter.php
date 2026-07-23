<?php
/**
 * Newsletter subscriber handling.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('shanaynlabs_register_subscriber_post_type')) {
    /**
     * Register backend-only Newsletter Subscribers.
     */
    function shanaynlabs_register_subscriber_post_type() {
        register_post_type(
            'shanayn_subscriber',
            array(
                'labels' => array(
                    'name' => __('Newsletter Subscribers', 'shanayn-labs'),
                    'singular_name' => __('Newsletter Subscriber', 'shanayn-labs'),
                    'menu_name' => __('Newsletter Subscribers', 'shanayn-labs'),
                    'add_new_item' => __('Add New Subscriber', 'shanayn-labs'),
                    'edit_item' => __('Edit Subscriber', 'shanayn-labs'),
                ),
                'public' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'show_in_rest' => true,
                'publicly_queryable' => false,
                'exclude_from_search' => true,
                'has_archive' => false,
                'rewrite' => false,
                'supports' => array('title'),
                'menu_icon' => 'dashicons-email-alt2',
                'menu_position' => 28,
            )
        );
    }
}
add_action('init', 'shanaynlabs_register_subscriber_post_type');

if (!function_exists('shanaynlabs_newsletter_redirect')) {
    /**
     * Redirect back to the current page with newsletter status.
     *
     * @param string $status Newsletter status.
     * @param string $redirect_to Redirect URL.
     */
    function shanaynlabs_newsletter_redirect($status, $redirect_to = '') {
        $redirect_to = $redirect_to ? esc_url_raw($redirect_to) : wp_get_referer();

        if (!$redirect_to) {
            $redirect_to = home_url('/');
        }

        wp_safe_redirect(add_query_arg('newsletter', sanitize_key($status), remove_query_arg('newsletter', $redirect_to)));
        exit;
    }
}

if (!function_exists('shanaynlabs_handle_newsletter_subscribe')) {
    /**
     * Handle newsletter subscription form.
     */
    function shanaynlabs_handle_newsletter_subscribe() {
        $redirect_to = isset($_POST['redirect_to']) ? esc_url_raw(wp_unslash($_POST['redirect_to'])) : '';

        if (
            !isset($_POST['shanaynlabs_newsletter_nonce'])
            || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['shanaynlabs_newsletter_nonce'])), 'shanaynlabs_newsletter_subscribe')
        ) {
            shanaynlabs_newsletter_redirect('invalid', $redirect_to);
        }

        $email = isset($_POST['newsletter_email']) ? strtolower(sanitize_email(wp_unslash($_POST['newsletter_email']))) : '';

        if (!$email || !is_email($email)) {
            shanaynlabs_newsletter_redirect('invalid', $redirect_to);
        }

        $existing_subscriber = new WP_Query(
            array(
                'post_type' => 'shanayn_subscriber',
                'post_status' => array('publish', 'draft', 'pending', 'private'),
                'posts_per_page' => 1,
                'meta_key' => '_shanaynlabs_subscriber_email',
                'meta_value' => $email,
                'fields' => 'ids',
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );

        if ($existing_subscriber->have_posts()) {
            wp_reset_postdata();
            shanaynlabs_newsletter_redirect('exists', $redirect_to);
        }

        wp_reset_postdata();

        $subscriber_id = wp_insert_post(
            array(
                'post_type' => 'shanayn_subscriber',
                'post_status' => 'publish',
                'post_title' => $email,
            ),
            true
        );

        if (is_wp_error($subscriber_id) || !$subscriber_id) {
            shanaynlabs_newsletter_redirect('invalid', $redirect_to);
        }

        update_post_meta($subscriber_id, '_shanaynlabs_subscriber_email', $email);

        shanaynlabs_newsletter_redirect('success', $redirect_to);
    }
}
add_action('admin_post_shanaynlabs_newsletter_subscribe', 'shanaynlabs_handle_newsletter_subscribe');
add_action('admin_post_nopriv_shanaynlabs_newsletter_subscribe', 'shanaynlabs_handle_newsletter_subscribe');
