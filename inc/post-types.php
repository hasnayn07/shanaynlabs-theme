<?php
/**
 * Custom post types and taxonomies.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register ShanaynLabs custom post types.
 */
function shanaynlabs_register_post_types() {
    register_post_type(
        'shanaynlabs_service',
        array(
            'labels' => array(
                'name' => __('Services', 'shanayn-labs'),
                'singular_name' => __('Service', 'shanayn-labs'),
                'menu_name' => __('Services', 'shanayn-labs'),
                'name_admin_bar' => __('Service', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Service', 'shanayn-labs'),
                'edit_item' => __('Edit Service', 'shanayn-labs'),
                'new_item' => __('New Service', 'shanayn-labs'),
                'view_item' => __('View Service', 'shanayn-labs'),
                'search_items' => __('Search Services', 'shanayn-labs'),
                'not_found' => __('No services found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No services found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Services', 'shanayn-labs'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-admin-tools',
            'rewrite' => array(
                'slug' => 'services',
                'with_front' => false,
            ),
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
            'show_in_rest' => true,
        )
    );

    register_post_type(
        'shanaynlabs_work',
        array(
            'labels' => array(
                'name' => __('Work', 'shanayn-labs'),
                'singular_name' => __('Work', 'shanayn-labs'),
                'menu_name' => __('Work', 'shanayn-labs'),
                'name_admin_bar' => __('Work', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Project', 'shanayn-labs'),
                'edit_item' => __('Edit Project', 'shanayn-labs'),
                'new_item' => __('New Project', 'shanayn-labs'),
                'view_item' => __('View Project', 'shanayn-labs'),
                'search_items' => __('Search Work', 'shanayn-labs'),
                'not_found' => __('No work found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No work found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Work', 'shanayn-labs'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-portfolio',
            'rewrite' => array(
                'slug' => 'work',
                'with_front' => false,
            ),
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
            'show_in_rest' => true,
        )
    );

    register_post_type(
        'shanaynlabs_product',
        array(
            'labels' => array(
                'name' => __('Products', 'shanayn-labs'),
                'singular_name' => __('Product', 'shanayn-labs'),
                'menu_name' => __('Products', 'shanayn-labs'),
                'name_admin_bar' => __('Product', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Product', 'shanayn-labs'),
                'edit_item' => __('Edit Product', 'shanayn-labs'),
                'new_item' => __('New Product', 'shanayn-labs'),
                'view_item' => __('View Product', 'shanayn-labs'),
                'search_items' => __('Search Products', 'shanayn-labs'),
                'not_found' => __('No products found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No products found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Products', 'shanayn-labs'),
            ),
            'public' => true,
            'has_archive' => true,
            'menu_icon' => 'dashicons-products',
            'rewrite' => array(
                'slug' => 'products',
                'with_front' => false,
            ),
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
            'show_in_rest' => true,
        )
    );

    register_post_type(
        'shanaynlabs_industry',
        array(
            'labels' => array(
                'name' => __('Industries', 'shanayn-labs'),
                'singular_name' => __('Industry', 'shanayn-labs'),
                'menu_name' => __('Industries', 'shanayn-labs'),
                'name_admin_bar' => __('Industry', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Industry', 'shanayn-labs'),
                'edit_item' => __('Edit Industry', 'shanayn-labs'),
                'new_item' => __('New Industry', 'shanayn-labs'),
                'view_item' => __('View Industry', 'shanayn-labs'),
                'search_items' => __('Search Industries', 'shanayn-labs'),
                'not_found' => __('No industries found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No industries found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Industries', 'shanayn-labs'),
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'rewrite' => false,
            'query_var' => false,
            'menu_icon' => 'dashicons-location-alt',
            'supports' => array('title', 'excerpt', 'thumbnail'),
            'capability_type' => 'post',
            'map_meta_cap' => true,
        )
    );

    register_post_type(
        'shanayn_testimonial',
        array(
            'labels' => array(
                'name' => 'Testimonials',
                'singular_name' => 'Testimonial',
                'menu_name' => 'Testimonials',
                'name_admin_bar' => 'Testimonial',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Testimonial',
                'edit_item' => 'Edit Testimonial',
                'new_item' => 'New Testimonial',
                'view_item' => 'View Testimonial',
                'search_items' => 'Search Testimonials',
                'not_found' => 'No testimonials found',
                'not_found_in_trash' => 'No testimonials found in Trash',
                'all_items' => 'All Testimonials',
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'rewrite' => false,
            'query_var' => false,
            'menu_icon' => 'dashicons-format-quote',
            'menu_position' => 26,
            'supports' => array('title', 'editor', 'thumbnail'),
            'capability_type' => 'post',
            'map_meta_cap' => true,
        )
    );

    register_post_type(
        'shanaynlabs_team',
        array(
            'labels' => array(
                'name' => __('Team Members', 'shanayn-labs'),
                'singular_name' => __('Team Member', 'shanayn-labs'),
                'menu_name' => __('Team Members', 'shanayn-labs'),
                'name_admin_bar' => __('Team Member', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Team Member', 'shanayn-labs'),
                'edit_item' => __('Edit Team Member', 'shanayn-labs'),
                'new_item' => __('New Team Member', 'shanayn-labs'),
                'view_item' => __('View Team Member', 'shanayn-labs'),
                'search_items' => __('Search Team Members', 'shanayn-labs'),
                'not_found' => __('No team members found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No team members found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Team Members', 'shanayn-labs'),
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'rewrite' => false,
            'query_var' => false,
            'menu_icon' => 'dashicons-groups',
            'menu_position' => 28,
            'supports' => array('title', 'thumbnail'),
            'capability_type' => 'post',
            'map_meta_cap' => true,
        )
    );

    register_post_type(
        'shanaynlabs_location',
        array(
            'labels' => array(
                'name' => __('Office Locations', 'shanayn-labs'),
                'singular_name' => __('Office Location', 'shanayn-labs'),
                'menu_name' => __('Office Locations', 'shanayn-labs'),
                'name_admin_bar' => __('Office Location', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Office Location', 'shanayn-labs'),
                'edit_item' => __('Edit Office Location', 'shanayn-labs'),
                'new_item' => __('New Office Location', 'shanayn-labs'),
                'view_item' => __('View Office Location', 'shanayn-labs'),
                'search_items' => __('Search Office Locations', 'shanayn-labs'),
                'not_found' => __('No office locations found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No office locations found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Office Locations', 'shanayn-labs'),
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'rewrite' => false,
            'query_var' => false,
            'menu_icon' => 'dashicons-building',
            'menu_position' => 29,
            'supports' => array('title'),
            'capability_type' => 'post',
            'map_meta_cap' => true,
        )
    );

    register_post_type(
        'shanayn_inquiry',
        array(
            'labels' => array(
                'name' => __('Project Inquiries', 'shanayn-labs'),
                'singular_name' => __('Project Inquiry', 'shanayn-labs'),
                'menu_name' => __('Project Inquiries', 'shanayn-labs'),
                'name_admin_bar' => __('Project Inquiry', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Inquiry', 'shanayn-labs'),
                'edit_item' => __('View Inquiry', 'shanayn-labs'),
                'new_item' => __('New Inquiry', 'shanayn-labs'),
                'view_item' => __('View Inquiry', 'shanayn-labs'),
                'search_items' => __('Search Project Inquiries', 'shanayn-labs'),
                'not_found' => __('No project inquiries found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No project inquiries found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Project Inquiries', 'shanayn-labs'),
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => false,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'rewrite' => false,
            'query_var' => false,
            'menu_icon' => 'dashicons-feedback',
            'menu_position' => 30,
            'supports' => array('title'),
            'capability_type' => 'post',
            'map_meta_cap' => true,
        )
    );

    register_post_type(
        'shanayn_package',
        array(
            'labels' => array(
                'name' => __('Pricing Packages', 'shanayn-labs'),
                'singular_name' => __('Pricing Package', 'shanayn-labs'),
                'menu_name' => __('Pricing Packages', 'shanayn-labs'),
                'name_admin_bar' => __('Pricing Package', 'shanayn-labs'),
                'add_new' => __('Add New', 'shanayn-labs'),
                'add_new_item' => __('Add New Pricing Package', 'shanayn-labs'),
                'edit_item' => __('Edit Pricing Package', 'shanayn-labs'),
                'new_item' => __('New Pricing Package', 'shanayn-labs'),
                'view_item' => __('View Pricing Package', 'shanayn-labs'),
                'search_items' => __('Search Pricing Packages', 'shanayn-labs'),
                'not_found' => __('No pricing packages found.', 'shanayn-labs'),
                'not_found_in_trash' => __('No pricing packages found in Trash.', 'shanayn-labs'),
                'all_items' => __('All Pricing Packages', 'shanayn-labs'),
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => false,
            'has_archive' => false,
            'rewrite' => false,
            'query_var' => false,
            'menu_icon' => 'dashicons-money-alt',
            'menu_position' => 27,
            'supports' => array('title', 'editor', 'page-attributes'),
            'capability_type' => 'post',
            'map_meta_cap' => true,
        )
    );
}
add_action('init', 'shanaynlabs_register_post_types');

/**
 * Register service taxonomies.
 */
function shanaynlabs_register_taxonomies() {
    register_taxonomy(
        'service-pillar',
        array('shanaynlabs_service', 'shanaynlabs_work', 'shanayn_package'),
        array(
            'labels' => array(
                'name' => __('Service Pillars', 'shanayn-labs'),
                'singular_name' => __('Service Pillar', 'shanayn-labs'),
                'menu_name' => __('Service Pillars', 'shanayn-labs'),
                'all_items' => __('All Service Pillars', 'shanayn-labs'),
                'edit_item' => __('Edit Service Pillar', 'shanayn-labs'),
                'view_item' => __('View Service Pillar', 'shanayn-labs'),
                'update_item' => __('Update Service Pillar', 'shanayn-labs'),
                'add_new_item' => __('Add New Service Pillar', 'shanayn-labs'),
                'new_item_name' => __('New Service Pillar Name', 'shanayn-labs'),
                'search_items' => __('Search Service Pillars', 'shanayn-labs'),
                'popular_items' => __('Popular Service Pillars', 'shanayn-labs'),
                'not_found' => __('No service pillars found.', 'shanayn-labs'),
            ),
            'public' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            'rewrite' => array(
                'slug' => 'service-pillar',
                'with_front' => false,
            ),
        )
    );

    register_taxonomy(
        'shanayn_product_category',
        array('shanaynlabs_product'),
        array(
            'labels' => array(
                'name' => __('Product Categories', 'shanayn-labs'),
                'singular_name' => __('Product Category', 'shanayn-labs'),
                'menu_name' => __('Product Categories', 'shanayn-labs'),
                'all_items' => __('All Product Categories', 'shanayn-labs'),
                'edit_item' => __('Edit Product Category', 'shanayn-labs'),
                'view_item' => __('View Product Category', 'shanayn-labs'),
                'update_item' => __('Update Product Category', 'shanayn-labs'),
                'add_new_item' => __('Add New Product Category', 'shanayn-labs'),
                'new_item_name' => __('New Product Category Name', 'shanayn-labs'),
                'search_items' => __('Search Product Categories', 'shanayn-labs'),
                'popular_items' => __('Popular Product Categories', 'shanayn-labs'),
                'not_found' => __('No product categories found.', 'shanayn-labs'),
            ),
            'public' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
            'rewrite' => array(
                'slug' => 'product-category',
                'with_front' => false,
            ),
        )
    );
}
add_action('init', 'shanaynlabs_register_taxonomies');
