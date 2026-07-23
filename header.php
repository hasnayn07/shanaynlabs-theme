<?php
if (!defined('ABSPATH')) {
    exit;
}

$shanaynlabs_nav_items = array(
    array(
        'label' => __('Services', 'shanayn-labs'),
        'url' => home_url('/services/'),
        'active' => is_post_type_archive('shanaynlabs_service') || is_singular('shanaynlabs_service'),
        'has_dropdown' => true,
        'dropdown' => 'services',
    ),
    array(
        'label' => __('Products', 'shanayn-labs'),
        'url' => home_url('/products/'),
        'active' => is_post_type_archive('shanaynlabs_product') || is_singular('shanaynlabs_product'),
        'has_dropdown' => true,
        'dropdown' => 'products',
    ),
    array(
        'label' => __('Work', 'shanayn-labs'),
        'url' => home_url('/work/'),
        'active' => is_post_type_archive('shanaynlabs_work') || is_singular('shanaynlabs_work'),
        'has_dropdown' => true,
        'dropdown' => 'work',
    ),
);

$shanaynlabs_service_dropdown_items = array(
    array(
        'title' => __('Digital Presence', 'shanayn-labs'),
        'text' => __('Websites, ecommerce stores, landing pages, SEO setup, analytics.', 'shanayn-labs'),
        'url' => home_url('/service-pillar/digital-presence/'),
        'links' => array(
            __('WordPress Websites', 'shanayn-labs'),
            __('Ecommerce Stores', 'shanayn-labs'),
            __('Shopify Stores', 'shanayn-labs'),
            __('Landing Pages', 'shanayn-labs'),
            __('SEO Setup', 'shanayn-labs'),
        ),
    ),
    array(
        'title' => __('Growth Engine', 'shanayn-labs'),
        'text' => __('Social media, content, ads, lead generation, conversion systems.', 'shanayn-labs'),
        'url' => home_url('/service-pillar/growth-engine/'),
        'links' => array(
            __('Social Media Management', 'shanayn-labs'),
            __('Content Production', 'shanayn-labs'),
            __('Meta Ads', 'shanayn-labs'),
            __('Lead Generation', 'shanayn-labs'),
            __('Email Marketing', 'shanayn-labs'),
        ),
    ),
    array(
        'title' => __('Software Intelligence', 'shanayn-labs'),
        'text' => __('Software, dashboards, automation, CRM, POS, and AI workflows.', 'shanayn-labs'),
        'url' => home_url('/service-pillar/software-intelligence/'),
        'links' => array(
            __('Custom Software', 'shanayn-labs'),
            __('CRM / POS Systems', 'shanayn-labs'),
            __('Dashboards', 'shanayn-labs'),
            __('AI Automation', 'shanayn-labs'),
            __('AI Chatbots', 'shanayn-labs'),
        ),
    ),
);

$shanaynlabs_work_dropdown_items = array(
    array(
        'title' => __('Digital Presence', 'shanayn-labs'),
        'text' => __('Websites, ecommerce, SEO, and digital presence projects.', 'shanayn-labs'),
        'url' => home_url('/work/digital-presence/'),
    ),
    array(
        'title' => __('Growth Engine', 'shanayn-labs'),
        'text' => __('Marketing, content, ads, and lead generation systems.', 'shanayn-labs'),
        'url' => home_url('/work/growth-engine/'),
    ),
    array(
        'title' => __('Software Intelligence', 'shanayn-labs'),
        'text' => __('Dashboards, systems, automation, and AI workflows.', 'shanayn-labs'),
        'url' => home_url('/work/software-intelligence/'),
    ),
);

$shanaynlabs_dropdown_products = new WP_Query(
    array(
        'post_type' => 'shanaynlabs_product',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
    )
);

$shanaynlabs_logo_url = '';
$shanaynlabs_logo_path = get_template_directory() . '/assets/images/logo-primary.svg';
$shanaynlabs_uploaded_logo_path = WP_CONTENT_DIR . '/uploads/2026/07/shanaynlabsprimarylogo.png';

if (file_exists($shanaynlabs_logo_path)) {
    $shanaynlabs_logo_url = get_template_directory_uri() . '/assets/images/logo-primary.svg';
} elseif (file_exists($shanaynlabs_uploaded_logo_path)) {
    $shanaynlabs_logo_url = content_url('/uploads/2026/07/shanaynlabsprimarylogo.png');
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main-content">
    <?php esc_html_e('Skip to content', 'shanayn-labs'); ?>
</a>

<header class="site-header">
    <div class="container header-inner">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php echo esc_attr__('Go to homepage', 'shanayn-labs'); ?>">
            <?php if ($shanaynlabs_logo_url) : ?>
                <img
                    class="site-logo-img"
                    src="<?php echo esc_url($shanaynlabs_logo_url); ?>"
                    alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
                    width="52"
                    height="52"
                >
            <?php else : ?>
                <span class="site-logo-text"><?php echo esc_html(get_bloginfo('name')); ?></span>
            <?php endif; ?>
        </a>

        <nav id="primary-menu" class="site-nav" aria-label="<?php echo esc_attr__('Primary menu', 'shanayn-labs'); ?>" data-site-nav>
            <ul class="primary-menu">
                <?php foreach ($shanaynlabs_nav_items as $nav_item) : ?>
                    <li class="<?php echo esc_attr(trim('header-nav-item ' . ($nav_item['active'] ? 'current-menu-item ' : '') . (!empty($nav_item['has_dropdown']) ? 'has-header-dropdown has-dropdown' : ''))); ?>">
                        <a class="primary-menu-link" href="<?php echo esc_url($nav_item['url']); ?>" <?php echo $nav_item['active'] ? 'aria-current="page"' : ''; ?>>
                            <span><?php echo esc_html($nav_item['label']); ?></span>
                            <?php if (!empty($nav_item['has_dropdown'])) : ?>
                                <svg class="primary-menu-caret" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                                    <path d="M4.5 6.25 8 9.75l3.5-3.5" />
                                </svg>
                            <?php endif; ?>
                        </a>

                        <?php if (!empty($nav_item['dropdown'])) : ?>
                            <div class="header-dropdown header-dropdown--<?php echo esc_attr($nav_item['dropdown']); ?>" aria-label="<?php echo esc_attr($nav_item['label']); ?>">
                                <div class="header-dropdown-panel">
                                    <?php if ('services' === $nav_item['dropdown']) : ?>
                                        <div class="header-dropdown-columns header-dropdown-services-grid">
                                            <?php foreach ($shanaynlabs_service_dropdown_items as $dropdown_item) : ?>
                                                <div class="header-dropdown-column">
                                                    <a class="header-dropdown-column-head" href="<?php echo esc_url($dropdown_item['url']); ?>">
                                                        <span class="header-dropdown-title"><?php echo esc_html($dropdown_item['title']); ?></span>
                                                    </a>

                                                    <?php if (!empty($dropdown_item['links'])) : ?>
                                                        <div class="header-dropdown-link-list">
                                                            <?php foreach ($dropdown_item['links'] as $service_link_label) : ?>
                                                                <a href="<?php echo esc_url($dropdown_item['url']); ?>">
                                                                    <?php echo esc_html($service_link_label); ?>
                                                                </a>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <a class="header-dropdown-footer" href="<?php echo esc_url(home_url('/services/')); ?>">
                                            <?php esc_html_e('View all services', 'shanayn-labs'); ?>
                                            <span aria-hidden="true">-&gt;</span>
                                        </a>
                                    <?php elseif ('products' === $nav_item['dropdown']) : ?>
                                        <div class="header-dropdown-products-layout">
                                            <div class="header-dropdown-product-list">
                                                <?php if ($shanaynlabs_dropdown_products->have_posts()) : ?>
                                                    <?php
                                                    while ($shanaynlabs_dropdown_products->have_posts()) :
                                                        $shanaynlabs_dropdown_products->the_post();
                                                        $product_type = get_post_meta(get_the_ID(), '_shanaynlabs_product_type', true);
                                                        ?>
                                                        <a class="header-dropdown-product-row" href="<?php echo esc_url(get_permalink()); ?>">
                                                            <span>
                                                                <strong><?php echo esc_html(wp_trim_words(get_the_title(), 7)); ?></strong>
                                                                <?php if ($product_type) : ?>
                                                                    <em><?php echo esc_html($product_type); ?></em>
                                                                <?php endif; ?>
                                                            </span>
                                                        </a>
                                                    <?php endwhile; ?>
                                                    <?php wp_reset_postdata(); ?>
                                                <?php else : ?>
                                                    <span class="header-dropdown-empty">
                                                        <?php esc_html_e('Products are being prepared.', 'shanayn-labs'); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <div class="header-dropdown-aside">
                                                <span class="header-dropdown-aside-label"><?php esc_html_e('Products', 'shanayn-labs'); ?></span>
                                                <strong><?php esc_html_e('Practical software systems for business workflows.', 'shanayn-labs'); ?></strong>
                                                <p><?php esc_html_e('Explore tools built for operations, reporting, automation, and smarter daily work.', 'shanayn-labs'); ?></p>
                                            </div>
                                        </div>

                                        <a class="header-dropdown-footer" href="<?php echo esc_url(home_url('/products/')); ?>">
                                            <?php esc_html_e('View all products', 'shanayn-labs'); ?>
                                            <span aria-hidden="true">-&gt;</span>
                                        </a>
                                    <?php elseif ('work' === $nav_item['dropdown']) : ?>
                                        <div class="header-dropdown-columns header-dropdown-work-grid">
                                            <?php foreach ($shanaynlabs_work_dropdown_items as $dropdown_item) : ?>
                                                <div class="header-dropdown-column">
                                                    <span class="header-dropdown-title"><?php echo esc_html($dropdown_item['title']); ?></span>
                                                    <span class="header-dropdown-text"><?php echo esc_html($dropdown_item['text']); ?></span>
                                                    <a class="header-dropdown-column-link" href="<?php echo esc_url($dropdown_item['url']); ?>">
                                                        <?php
                                                        if ('Digital Presence' === $dropdown_item['title']) {
                                                            esc_html_e('View digital presence work', 'shanayn-labs');
                                                        } elseif ('Growth Engine' === $dropdown_item['title']) {
                                                            esc_html_e('View growth engine work', 'shanayn-labs');
                                                        } else {
                                                            esc_html_e('View software intelligence work', 'shanayn-labs');
                                                        }
                                                        ?>
                                                        <span aria-hidden="true">-&gt;</span>
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                        <a class="header-dropdown-footer" href="<?php echo esc_url(home_url('/work/')); ?>">
                                            <?php esc_html_e('View all work', 'shanayn-labs'); ?>
                                            <span aria-hidden="true">-&gt;</span>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>

        </nav>

        <div class="header-actions">
            <button
                class="menu-toggle mobile-menu-toggle"
                type="button"
                aria-label="<?php echo esc_attr__('Open menu', 'shanayn-labs'); ?>"
                aria-expanded="false"
                aria-controls="primary-menu"
                data-menu-toggle
            >
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </button>

            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="header-cta header-cta-desktop">
                <span class="header-cta-label"><?php esc_html_e("Let's Talk", 'shanayn-labs'); ?></span>
                <span class="header-cta-arrow" aria-hidden="true">&nearr;</span>
            </a>

        </div>
    </div>
</header>
