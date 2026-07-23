<?php
/**
 * Theme assets.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

function shanaynlabs_enqueue_assets() {
    wp_enqueue_style(
        'shanaynlabs-main',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        shanaynlabs_asset_version('assets/css/main.css')
    );

    wp_enqueue_script(
        'shanaynlabs-main',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        shanaynlabs_asset_version('assets/js/main.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'shanaynlabs_enqueue_assets');
