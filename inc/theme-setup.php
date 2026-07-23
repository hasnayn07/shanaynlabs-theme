<?php
/**
 * Theme setup.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

function shanaynlabs_theme_setup() {
    load_theme_textdomain('shanayn-labs', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support(
        'custom-logo',
        array(
            'height' => 80,
            'width' => 240,
            'flex-height' => true,
            'flex-width' => true,
        )
    );
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'shanayn-labs'),
        )
    );
}
add_action('after_setup_theme', 'shanaynlabs_theme_setup');
