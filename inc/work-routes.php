<?php
/**
 * Work pillar routes.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get the supported work pillar route data.
 *
 * @return array
 */
function shanaynlabs_get_work_pillar_routes() {
    return array(
        'digital-presence' => array(
            'eyebrow'     => __('Digital Presence Work', 'shanayn-labs'),
            'heading'     => __('Website and digital presence projects', 'shanayn-labs'),
            'description' => __('Explore selected websites, ecommerce stores, SEO setups, and digital presence systems built by ShanaynLabs.', 'shanayn-labs'),
            'label'       => __('Digital Presence', 'shanayn-labs'),
        ),
        'growth-engine' => array(
            'eyebrow'     => __('Growth Engine Work', 'shanayn-labs'),
            'heading'     => __('Marketing and growth system projects', 'shanayn-labs'),
            'description' => __('Explore selected lead generation, social media, SEO, analytics, and performance marketing work.', 'shanayn-labs'),
            'label'       => __('Growth Engine', 'shanayn-labs'),
        ),
        'software-intelligence' => array(
            'eyebrow'     => __('Software Intelligence Work', 'shanayn-labs'),
            'heading'     => __('Software, automation, and AI projects', 'shanayn-labs'),
            'description' => __('Explore selected dashboards, business systems, automation workflows, and AI-powered tools.', 'shanayn-labs'),
            'label'       => __('Software Intelligence', 'shanayn-labs'),
        ),
    );
}

/**
 * Add rewrite rules for work pillar subpages.
 */
function shanaynlabs_add_work_pillar_rewrite_rules() {
    add_rewrite_rule(
        '^work/(digital-presence|growth-engine|software-intelligence)/?$',
        'index.php?shanaynlabs_work_pillar=$matches[1]',
        'top'
    );
}
add_action('init', 'shanaynlabs_add_work_pillar_rewrite_rules');

/**
 * Register work pillar query var.
 *
 * @param array $vars Query vars.
 * @return array
 */
function shanaynlabs_add_work_pillar_query_var($vars) {
    $vars[] = 'shanaynlabs_work_pillar';

    return $vars;
}
add_filter('query_vars', 'shanaynlabs_add_work_pillar_query_var');

/**
 * Route work pillar requests to the custom template.
 *
 * @param string $template Current template path.
 * @return string
 */
function shanaynlabs_load_work_pillar_template($template) {
    $pillar_slug = get_query_var('shanaynlabs_work_pillar');

    if (!$pillar_slug) {
        return $template;
    }

    $pillar_routes = shanaynlabs_get_work_pillar_routes();

    if (!isset($pillar_routes[$pillar_slug])) {
        return $template;
    }

    $work_pillar_template = locate_template('template-work-pillar.php');

    if ($work_pillar_template) {
        return $work_pillar_template;
    }

    return $template;
}
add_filter('template_include', 'shanaynlabs_load_work_pillar_template');
