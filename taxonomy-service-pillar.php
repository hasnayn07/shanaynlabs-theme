<?php
if (!defined('ABSPATH')) {
    exit;
}

$current_term = get_queried_object();
$term_slug = isset($current_term->slug) ? $current_term->slug : '';
$term_name = isset($current_term->name) ? $current_term->name : '';
$term_description = isset($current_term->description) ? $current_term->description : '';
$term_id = isset($current_term->term_id) ? absint($current_term->term_id) : 0;

$pillar_pricing_query = null;

if ($term_id) {
    $pillar_pricing_query = new WP_Query(
        array(
            'post_type' => 'shanayn_package',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'service-pillar',
                    'field' => 'term_id',
                    'terms' => $term_id,
                ),
            ),
            'meta_query' => array(
                'relation' => 'OR',
                'package_order_clause' => array(
                    'key' => '_shanayn_package_order',
                    'compare' => 'EXISTS',
                    'type' => 'NUMERIC',
                ),
                array(
                    'key' => '_shanayn_package_order',
                    'compare' => 'NOT EXISTS',
                ),
            ),
            'orderby' => array(
                'package_order_clause' => 'ASC',
                'menu_order' => 'ASC',
                'title' => 'ASC',
            ),
            'no_found_rows' => true,
            'ignore_sticky_posts' => true,
        )
    );
}

$render_pillar_pricing_section = static function () use (&$pillar_pricing_query, $term_slug) {
    if (!($pillar_pricing_query instanceof WP_Query) || !$pillar_pricing_query->have_posts()) {
        return;
    }

    $pricing_heading = __('Choose the right package for your next digital system.', 'shanayn-labs');
    $pricing_description = __('Each package can be adjusted around your goals, scope, and timeline. Start with the option that best matches where your business is right now.', 'shanayn-labs');

    if ('digital-presence' === $term_slug) {
        $pricing_heading = __('Choose the right website package for your business.', 'shanayn-labs');
        $pricing_description = __('From focused landing pages to full website systems, each package is designed to help your business look trusted, explain services clearly, and convert visitors into inquiries.', 'shanayn-labs');
    }
    ?>
    <section class="pillar-pricing-section" aria-labelledby="pillar-pricing-heading" data-animate>
        <div class="container pillar-pricing-inner">
            <header class="pillar-pricing-header">
                <p class="pillar-pricing-eyebrow"><?php esc_html_e('PRICING PACKAGES', 'shanayn-labs'); ?></p>
                <h2 id="pillar-pricing-heading" class="pillar-pricing-title"><?php echo esc_html($pricing_heading); ?></h2>
                <p class="pillar-pricing-description"><?php echo esc_html($pricing_description); ?></p>
            </header>

            <div class="pillar-pricing-grid">
                <?php
                while ($pillar_pricing_query->have_posts()) :
                    $pillar_pricing_query->the_post();

                    $package_id = get_the_ID();
                    $tier = get_post_meta($package_id, '_shanayn_package_tier', true);
                    $allowed_tiers = array('silver', 'gold', 'platinum');

                    if (!in_array($tier, $allowed_tiers, true)) {
                        $tier = 'silver';
                    }

                    $tier_labels = array(
                        'silver' => __('Silver', 'shanayn-labs'),
                        'gold' => __('Gold', 'shanayn-labs'),
                        'platinum' => __('Platinum', 'shanayn-labs'),
                    );

                    $package_title = get_the_title();
                    if (empty($package_title)) {
                        $package_title = $tier_labels[$tier];
                    }

                    $price = get_post_meta($package_id, '_shanayn_package_price', true);
                    $price_note = get_post_meta($package_id, '_shanayn_package_price_note', true);
                    $description = get_post_meta($package_id, '_shanayn_package_description', true);

                    if (empty($description)) {
                        $description = wp_trim_words(wp_strip_all_tags(get_the_content()), 22, '...');
                    }

                    $features_raw = get_post_meta($package_id, '_shanayn_package_features', true);
                    $features = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $features_raw)));
                    $cta_text = get_post_meta($package_id, '_shanayn_package_cta_text', true);
                    $cta_url = get_post_meta($package_id, '_shanayn_package_cta_url', true);
                    $is_featured = '1' === get_post_meta($package_id, '_shanayn_package_featured', true);

                    if (empty($cta_text)) {
                        $cta_text = __('Book a Call', 'shanayn-labs');
                    }

                    if (empty($cta_url)) {
                        $cta_url = home_url('/contact/');
                    } elseif (0 === strpos($cta_url, '/')) {
                        $cta_url = home_url($cta_url);
                    }
                    ?>
                    <article class="pillar-pricing-card pillar-pricing-card-<?php echo esc_attr($tier); ?> <?php echo $is_featured ? 'is-featured' : ''; ?>">
                        <?php if ($is_featured) : ?>
                            <span class="pillar-pricing-badge"><?php esc_html_e('Recommended', 'shanayn-labs'); ?></span>
                        <?php endif; ?>

                        <p class="pillar-pricing-tier"><?php echo esc_html($tier_labels[$tier]); ?></p>
                        <h3 class="pillar-pricing-card-title"><?php echo esc_html($package_title); ?></h3>

                        <?php if (!empty($price)) : ?>
                            <p class="pillar-pricing-price"><?php echo esc_html($price); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($price_note)) : ?>
                            <p class="pillar-pricing-price-note"><?php echo esc_html($price_note); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($description)) : ?>
                            <p class="pillar-pricing-card-description"><?php echo esc_html($description); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($features)) : ?>
                            <ul class="pillar-pricing-features">
                                <?php foreach ($features as $feature) : ?>
                                    <li class="pillar-pricing-feature">
                                        <span aria-hidden="true"></span>
                                        <?php echo esc_html($feature); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <a class="pillar-pricing-cta" href="<?php echo esc_url($cta_url); ?>">
                            <?php echo esc_html($cta_text); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php
    wp_reset_postdata();
};

get_header();
?>

<main id="main-content" class="site-main pillar-page">
    <?php if ('digital-presence' === $term_slug) : ?>
        <section class="digital-presence-hero" aria-labelledby="digital-presence-hero-heading" data-animate>
            <div class="container digital-presence-hero-inner">
                <header class="digital-presence-hero-copy">
                    <p class="digital-presence-hero-eyebrow"><?php esc_html_e('01 / DIGITAL PRESENCE', 'shanayn-labs'); ?></p>
                    <h1 id="digital-presence-hero-heading" class="digital-presence-hero-title"><?php esc_html_e('Premium websites built to make your business look trusted.', 'shanayn-labs'); ?></h1>
                    <p class="digital-presence-hero-description"><?php esc_html_e('We design and build websites, landing pages, and online stores that present your business clearly, build credibility, and turn visitors into inquiries or customers.', 'shanayn-labs'); ?></p>

                    <div class="digital-presence-hero-actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/work/')); ?>" class="btn-secondary">
                            <?php esc_html_e('View Work', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </header>

                <div class="digital-presence-hero-visual" aria-hidden="true">
                    <div class="dp-floating-labels">
                        <span class="dp-floating-label dp-floating-label-design"><?php esc_html_e('Website Design', 'shanayn-labs'); ?></span>
                        <span class="dp-floating-label dp-floating-label-wordpress"><?php esc_html_e('WordPress', 'shanayn-labs'); ?></span>
                        <span class="dp-floating-label dp-floating-label-landing"><?php esc_html_e('Landing Pages', 'shanayn-labs'); ?></span>
                        <span class="dp-floating-label dp-floating-label-ecommerce"><?php esc_html_e('Ecommerce', 'shanayn-labs'); ?></span>
                        <span class="dp-floating-label dp-floating-label-conversion"><?php esc_html_e('Conversion UX', 'shanayn-labs'); ?></span>
                    </div>

                    <div class="dp-website-mockup">
                        <div class="dp-browser-window">
                            <div class="dp-browser-topbar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                            <div class="dp-browser-body">
                                <div class="dp-browser-hero">
                                    <div class="dp-browser-hero-copy">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="dp-browser-hero-card"></div>
                                </div>

                                <div class="dp-browser-services">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                                <div class="dp-browser-lower">
                                    <div class="dp-browser-content">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>

                                    <div class="dp-browser-form">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <strong></strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dp-mobile-preview">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="digital-presence-overview" aria-labelledby="digital-presence-overview-heading" data-animate>
            <div class="container digital-presence-overview-inner">
                <h2 id="digital-presence-overview-heading" class="digital-presence-overview-statement"><?php esc_html_e('Your website is often the first place people judge your business.', 'shanayn-labs'); ?></h2>

                <div class="digital-presence-overview-points" role="list">
                    <div class="digital-presence-overview-point" role="listitem">
                        <span class="digital-presence-overview-dot" aria-hidden="true"></span>
                        <p class="digital-presence-overview-text"><?php esc_html_e('It should look professional.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="digital-presence-overview-point" role="listitem">
                        <span class="digital-presence-overview-dot" aria-hidden="true"></span>
                        <p class="digital-presence-overview-text"><?php esc_html_e('It should explain your services clearly.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="digital-presence-overview-point" role="listitem">
                        <span class="digital-presence-overview-dot" aria-hidden="true"></span>
                        <p class="digital-presence-overview-text"><?php esc_html_e('It should guide visitors toward action.', 'shanayn-labs'); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="dp-build-section" aria-labelledby="dp-build-heading" data-animate>
            <div class="container">
                <header class="dp-build-header">
                    <p class="dp-build-eyebrow"><?php esc_html_e('WHAT WE BUILD', 'shanayn-labs'); ?></p>
                    <h2 id="dp-build-heading"><?php esc_html_e('Digital presence services shaped around how your business needs to show up online.', 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('From websites and landing pages to online stores and conversion-focused UX, each service is designed to make your business clearer, more credible, and easier to act on.', 'shanayn-labs'); ?></p>
                </header>

                <div class="dp-build-layout">
                    <div class="dp-build-selector" role="tablist" aria-label="<?php echo esc_attr__('Digital Presence services', 'shanayn-labs'); ?>">
                        <button id="dp-build-tab-website-design" class="dp-build-selector-item is-active" type="button" role="tab" aria-selected="true" aria-controls="dp-build-panel-website-design" data-build-preview="website-design">
                            <span class="dp-build-selector-number"><?php esc_html_e('01', 'shanayn-labs'); ?></span>
                            <span class="dp-build-selector-content">
                                <span class="dp-build-selector-title"><?php esc_html_e('Website Design', 'shanayn-labs'); ?></span>
                                <span class="dp-build-selector-text"><?php esc_html_e('Clean, premium website experiences for modern businesses.', 'shanayn-labs'); ?></span>
                            </span>
                        </button>

                        <button id="dp-build-tab-wordpress" class="dp-build-selector-item" type="button" role="tab" aria-selected="false" aria-controls="dp-build-panel-wordpress" tabindex="-1" data-build-preview="wordpress">
                            <span class="dp-build-selector-number"><?php esc_html_e('02', 'shanayn-labs'); ?></span>
                            <span class="dp-build-selector-content">
                                <span class="dp-build-selector-title"><?php esc_html_e('WordPress Websites', 'shanayn-labs'); ?></span>
                                <span class="dp-build-selector-text"><?php esc_html_e('Flexible CMS websites your team can manage and grow.', 'shanayn-labs'); ?></span>
                            </span>
                        </button>

                        <button id="dp-build-tab-landing-pages" class="dp-build-selector-item" type="button" role="tab" aria-selected="false" aria-controls="dp-build-panel-landing-pages" tabindex="-1" data-build-preview="landing-pages">
                            <span class="dp-build-selector-number"><?php esc_html_e('03', 'shanayn-labs'); ?></span>
                            <span class="dp-build-selector-content">
                                <span class="dp-build-selector-title"><?php esc_html_e('Landing Pages', 'shanayn-labs'); ?></span>
                                <span class="dp-build-selector-text"><?php esc_html_e('Focused pages built to turn attention into inquiries or sales.', 'shanayn-labs'); ?></span>
                            </span>
                        </button>

                        <button id="dp-build-tab-ecommerce" class="dp-build-selector-item" type="button" role="tab" aria-selected="false" aria-controls="dp-build-panel-ecommerce" tabindex="-1" data-build-preview="ecommerce">
                            <span class="dp-build-selector-number"><?php esc_html_e('04', 'shanayn-labs'); ?></span>
                            <span class="dp-build-selector-content">
                                <span class="dp-build-selector-title"><?php esc_html_e('Ecommerce Stores', 'shanayn-labs'); ?></span>
                                <span class="dp-build-selector-text"><?php esc_html_e('Online stores designed for product discovery, carts, and checkout.', 'shanayn-labs'); ?></span>
                            </span>
                        </button>

                        <button id="dp-build-tab-shopify" class="dp-build-selector-item" type="button" role="tab" aria-selected="false" aria-controls="dp-build-panel-shopify" tabindex="-1" data-build-preview="shopify">
                            <span class="dp-build-selector-number"><?php esc_html_e('05', 'shanayn-labs'); ?></span>
                            <span class="dp-build-selector-content">
                                <span class="dp-build-selector-title"><?php esc_html_e('Shopify Stores', 'shanayn-labs'); ?></span>
                                <span class="dp-build-selector-text"><?php esc_html_e('Modern Shopify storefronts built for selling and managing products.', 'shanayn-labs'); ?></span>
                            </span>
                        </button>

                        <button id="dp-build-tab-redesign" class="dp-build-selector-item" type="button" role="tab" aria-selected="false" aria-controls="dp-build-panel-redesign" tabindex="-1" data-build-preview="redesign">
                            <span class="dp-build-selector-number"><?php esc_html_e('06', 'shanayn-labs'); ?></span>
                            <span class="dp-build-selector-content">
                                <span class="dp-build-selector-title"><?php esc_html_e('Website Redesign', 'shanayn-labs'); ?></span>
                                <span class="dp-build-selector-text"><?php esc_html_e('Upgrade outdated websites into clearer, faster, more trusted experiences.', 'shanayn-labs'); ?></span>
                            </span>
                        </button>

                        <button id="dp-build-tab-ux" class="dp-build-selector-item" type="button" role="tab" aria-selected="false" aria-controls="dp-build-panel-ux" tabindex="-1" data-build-preview="ux">
                            <span class="dp-build-selector-number"><?php esc_html_e('07', 'shanayn-labs'); ?></span>
                            <span class="dp-build-selector-content">
                                <span class="dp-build-selector-title"><?php esc_html_e('Conversion-Focused UX', 'shanayn-labs'); ?></span>
                                <span class="dp-build-selector-text"><?php esc_html_e('User journeys designed to guide visitors toward meaningful action.', 'shanayn-labs'); ?></span>
                            </span>
                        </button>
                    </div>

                    <div class="dp-build-preview" aria-live="polite">
                        <div id="dp-build-panel-website-design" class="dp-build-preview-panel is-active dp-build-preview-website" role="tabpanel" aria-labelledby="dp-build-tab-website-design">
                            <div class="dp-preview-browser" aria-hidden="true">
                                <div class="dp-preview-topbar"><span></span><span></span><span></span></div>
                                <div class="dp-preview-nav"><span></span><span></span><span></span><span></span></div>
                                <div class="dp-preview-hero-block"><span></span><span></span><strong></strong></div>
                                <div class="dp-preview-service-grid"><span></span><span></span><span></span></div>
                                <div class="dp-preview-content-row"><span></span><span></span></div>
                            </div>
                        </div>

                        <div id="dp-build-panel-wordpress" class="dp-build-preview-panel dp-build-preview-wordpress" role="tabpanel" aria-labelledby="dp-build-tab-wordpress" hidden>
                            <div class="dp-preview-cms" aria-hidden="true">
                                <div class="dp-preview-cms-bar"><strong><?php esc_html_e('CMS', 'shanayn-labs'); ?></strong><span></span></div>
                                <div class="dp-preview-cms-layout">
                                    <div class="dp-preview-cms-blocks"><span></span><span></span><span></span><span></span></div>
                                    <div class="dp-preview-cms-sidebar"><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="dp-build-panel-landing-pages" class="dp-build-preview-panel dp-build-preview-landing" role="tabpanel" aria-labelledby="dp-build-tab-landing-pages" hidden>
                            <div class="dp-preview-landing-page" aria-hidden="true">
                                <div class="dp-preview-landing-copy"><span></span><span></span><strong></strong></div>
                                <div class="dp-preview-lead-form"><span></span><span></span><span></span><strong></strong></div>
                                <div class="dp-preview-trust-chips"><span></span><span></span><span></span></div>
                            </div>
                        </div>

                        <div id="dp-build-panel-ecommerce" class="dp-build-preview-panel dp-build-preview-ecommerce" role="tabpanel" aria-labelledby="dp-build-tab-ecommerce" hidden>
                            <div class="dp-preview-shop" aria-hidden="true">
                                <div class="dp-preview-shop-steps"><span></span><span></span><span></span></div>
                                <div class="dp-preview-products"><span></span><span></span><span></span><span></span></div>
                                <div class="dp-preview-cart"><strong></strong><span></span><span></span></div>
                            </div>
                        </div>

                        <div id="dp-build-panel-shopify" class="dp-build-preview-panel dp-build-preview-shopify" role="tabpanel" aria-labelledby="dp-build-tab-shopify" hidden>
                            <div class="dp-preview-storefront" aria-hidden="true">
                                <div class="dp-preview-storefront-label"><?php esc_html_e('Storefront', 'shanayn-labs'); ?></div>
                                <div class="dp-preview-filter-chip"></div>
                                <div class="dp-preview-store-products"><span></span><span></span><span></span></div>
                                <div class="dp-preview-mini-cart"><span></span><strong></strong></div>
                            </div>
                        </div>

                        <div id="dp-build-panel-redesign" class="dp-build-preview-panel dp-build-preview-redesign" role="tabpanel" aria-labelledby="dp-build-tab-redesign" hidden>
                            <div class="dp-preview-redesign-split" aria-hidden="true">
                                <div class="dp-preview-before"><strong><?php esc_html_e('Before', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                <div class="dp-preview-after"><strong><?php esc_html_e('After', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                            </div>
                        </div>

                        <div id="dp-build-panel-ux" class="dp-build-preview-panel dp-build-preview-ux" role="tabpanel" aria-labelledby="dp-build-tab-ux" hidden>
                            <div class="dp-preview-journey" aria-hidden="true">
                                <div class="dp-preview-journey-node"><span></span><strong></strong></div>
                                <div class="dp-preview-journey-arrow"></div>
                                <div class="dp-preview-journey-node"><span></span><strong></strong></div>
                                <div class="dp-preview-journey-arrow"></div>
                                <div class="dp-preview-journey-node is-goal"><span></span><strong></strong></div>
                                <div class="dp-preview-trust-block"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="dp-website-system" aria-labelledby="dp-website-system-heading" data-animate>
            <div class="container dp-website-system-inner">
                <header class="dp-website-system-header">
                    <p class="dp-website-system-eyebrow"><?php esc_html_e('OUR WEBSITE SYSTEM', 'shanayn-labs'); ?></p>
                    <h2 id="dp-website-system-heading" class="dp-website-system-title"><?php esc_html_e('A structured process for websites that look clear, trusted, and ready to convert.', 'shanayn-labs'); ?></h2>
                    <p class="dp-website-system-description"><?php esc_html_e('Every website project follows a focused system — from understanding the business to planning, designing, building, and launching the final experience.', 'shanayn-labs'); ?></p>
                </header>

                <div class="dp-system-timeline" role="list" aria-label="<?php echo esc_attr__('Digital Presence website system', 'shanayn-labs'); ?>">
                    <span class="dp-system-line" aria-hidden="true"></span>

                    <div class="dp-system-step" role="listitem" tabindex="0">
                        <span class="dp-system-point" aria-hidden="true">
                            <span class="dp-system-number"><?php esc_html_e('01', 'shanayn-labs'); ?></span>
                        </span>
                        <h3 class="dp-system-step-title"><?php esc_html_e('Positioning', 'shanayn-labs'); ?></h3>
                        <p class="dp-system-step-text"><?php esc_html_e('We understand your business, audience, services, and goals.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="dp-system-step" role="listitem" tabindex="0">
                        <span class="dp-system-point" aria-hidden="true">
                            <span class="dp-system-number"><?php esc_html_e('02', 'shanayn-labs'); ?></span>
                        </span>
                        <h3 class="dp-system-step-title"><?php esc_html_e('Structure', 'shanayn-labs'); ?></h3>
                        <p class="dp-system-step-text"><?php esc_html_e('We plan pages, sections, user flow, and conversion points.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="dp-system-step" role="listitem" tabindex="0">
                        <span class="dp-system-point" aria-hidden="true">
                            <span class="dp-system-number"><?php esc_html_e('03', 'shanayn-labs'); ?></span>
                        </span>
                        <h3 class="dp-system-step-title"><?php esc_html_e('Design', 'shanayn-labs'); ?></h3>
                        <p class="dp-system-step-text"><?php esc_html_e('We create a clean visual direction that fits your brand.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="dp-system-step" role="listitem" tabindex="0">
                        <span class="dp-system-point" aria-hidden="true">
                            <span class="dp-system-number"><?php esc_html_e('04', 'shanayn-labs'); ?></span>
                        </span>
                        <h3 class="dp-system-step-title"><?php esc_html_e('Build', 'shanayn-labs'); ?></h3>
                        <p class="dp-system-step-text"><?php esc_html_e('We develop a responsive, fast, and easy-to-manage website.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="dp-system-step" role="listitem" tabindex="0">
                        <span class="dp-system-point" aria-hidden="true">
                            <span class="dp-system-number"><?php esc_html_e('05', 'shanayn-labs'); ?></span>
                        </span>
                        <h3 class="dp-system-step-title"><?php esc_html_e('Launch', 'shanayn-labs'); ?></h3>
                        <p class="dp-system-step-text"><?php esc_html_e('We test, refine, and prepare the website for real users.', 'shanayn-labs'); ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="dp-use-cases" aria-labelledby="dp-use-cases-heading" data-animate>
            <div class="container dp-use-cases-inner">
                <header class="dp-use-cases-header">
                    <p class="dp-use-cases-eyebrow"><?php esc_html_e('BEST FOR', 'shanayn-labs'); ?></p>
                    <h2 id="dp-use-cases-heading" class="dp-use-cases-title"><?php esc_html_e('When your digital presence needs to work harder.', 'shanayn-labs'); ?></h2>
                    <p class="dp-use-cases-description"><?php esc_html_e('This service pillar is built for businesses that need a clearer website, stronger credibility, better service presentation, and a smoother path from visitor to inquiry.', 'shanayn-labs'); ?></p>
                </header>

                <div class="dp-use-cases-panel" role="list" aria-label="<?php echo esc_attr__('Digital Presence use cases and outcomes', 'shanayn-labs'); ?>">
                    <div class="dp-use-cases-head" aria-hidden="true">
                        <span><?php esc_html_e('You need this if...', 'shanayn-labs'); ?></span>
                        <span></span>
                        <span><?php esc_html_e('Digital Presence helps with...', 'shanayn-labs'); ?></span>
                    </div>

                    <div class="dp-use-cases-row" role="listitem" tabindex="0">
                        <p class="dp-use-cases-need"><?php esc_html_e('Your website looks outdated', 'shanayn-labs'); ?></p>
                        <span class="dp-use-cases-arrow" aria-hidden="true"><?php esc_html_e('→', 'shanayn-labs'); ?></span>
                        <div class="dp-use-cases-solution">
                            <p class="dp-use-cases-solution-text"><?php esc_html_e('Modern redesign', 'shanayn-labs'); ?></p>
                        </div>
                    </div>

                    <div class="dp-use-cases-row" role="listitem" tabindex="0">
                        <p class="dp-use-cases-need"><?php esc_html_e('People do not understand your services', 'shanayn-labs'); ?></p>
                        <span class="dp-use-cases-arrow" aria-hidden="true"><?php esc_html_e('→', 'shanayn-labs'); ?></span>
                        <div class="dp-use-cases-solution">
                            <p class="dp-use-cases-solution-text"><?php esc_html_e('Clear page structure', 'shanayn-labs'); ?></p>
                        </div>
                    </div>

                    <div class="dp-use-cases-row" role="listitem" tabindex="0">
                        <p class="dp-use-cases-need"><?php esc_html_e('You need more inquiries', 'shanayn-labs'); ?></p>
                        <span class="dp-use-cases-arrow" aria-hidden="true"><?php esc_html_e('→', 'shanayn-labs'); ?></span>
                        <div class="dp-use-cases-solution">
                            <p class="dp-use-cases-solution-text"><?php esc_html_e('Strong CTA and lead flow', 'shanayn-labs'); ?></p>
                        </div>
                    </div>

                    <div class="dp-use-cases-row" role="listitem" tabindex="0">
                        <p class="dp-use-cases-need"><?php esc_html_e('You sell products online', 'shanayn-labs'); ?></p>
                        <span class="dp-use-cases-arrow" aria-hidden="true"><?php esc_html_e('→', 'shanayn-labs'); ?></span>
                        <div class="dp-use-cases-solution">
                            <p class="dp-use-cases-solution-text"><?php esc_html_e('Ecommerce website', 'shanayn-labs'); ?></p>
                        </div>
                    </div>

                    <div class="dp-use-cases-row" role="listitem" tabindex="0">
                        <p class="dp-use-cases-need"><?php esc_html_e('You need a professional brand image', 'shanayn-labs'); ?></p>
                        <span class="dp-use-cases-arrow" aria-hidden="true"><?php esc_html_e('→', 'shanayn-labs'); ?></span>
                        <div class="dp-use-cases-solution">
                            <p class="dp-use-cases-solution-text"><?php esc_html_e('Premium visual presence', 'shanayn-labs'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        $dp_featured_work_post = null;

        if (function_exists('shanaynlabs_get_featured_work')) {
            $dp_featured_work_query = shanaynlabs_get_featured_work(1);

            if ($dp_featured_work_query instanceof WP_Query && $dp_featured_work_query->have_posts()) {
                $dp_featured_work_post = $dp_featured_work_query->posts[0];
            }
        }

        if (!$dp_featured_work_post) {
            $dp_featured_work_query = new WP_Query(
                array(
                    'post_type' => 'shanaynlabs_work',
                    'post_status' => 'publish',
                    'posts_per_page' => 1,
                    'meta_query' => array(
                        array(
                            'key' => '_shanaynlabs_featured_work',
                            'value' => '1',
                            'compare' => '=',
                        ),
                    ),
                    'no_found_rows' => true,
                    'ignore_sticky_posts' => true,
                )
            );

            if ($dp_featured_work_query->have_posts()) {
                $dp_featured_work_post = $dp_featured_work_query->posts[0];
            }
        }

        $dp_featured_work_id = $dp_featured_work_post ? $dp_featured_work_post->ID : 0;
        $dp_featured_work_label = __('FEATURED DIGITAL PRESENCE WORK', 'shanayn-labs');
        $dp_featured_work_title = __('Lead generation website system', 'shanayn-labs');
        $dp_featured_work_description = __('A clear website structure designed to present services professionally, build trust, and support customer inquiries.', 'shanayn-labs');
        $dp_featured_work_url = home_url('/work/');
        $dp_featured_work_has_image = false;
        $dp_featured_work_image = '';

        if ($dp_featured_work_id) {
            $dp_project_type = get_post_meta($dp_featured_work_id, '_shanaynlabs_project_type', true);
            $dp_result_summary = get_post_meta($dp_featured_work_id, '_shanaynlabs_result_summary', true);
            $dp_project_url = get_post_meta($dp_featured_work_id, '_shanaynlabs_project_url', true);

            if (!empty($dp_project_type)) {
                $dp_featured_work_label = $dp_project_type;
            }

            $dp_featured_work_title = get_the_title($dp_featured_work_id);

            if (!empty($dp_result_summary)) {
                $dp_featured_work_description = $dp_result_summary;
            } elseif (has_excerpt($dp_featured_work_id)) {
                $dp_featured_work_description = get_the_excerpt($dp_featured_work_id);
            } elseif (!empty($dp_featured_work_post->post_content)) {
                $dp_featured_work_description = wp_trim_words(wp_strip_all_tags($dp_featured_work_post->post_content), 24, '...');
            }

            $dp_featured_work_url = !empty($dp_project_url) ? $dp_project_url : get_permalink($dp_featured_work_id);

            if (has_post_thumbnail($dp_featured_work_id)) {
                $dp_featured_work_has_image = true;
                $dp_thumbnail_id = get_post_thumbnail_id($dp_featured_work_id);
                $dp_thumbnail_alt = get_post_meta($dp_thumbnail_id, '_wp_attachment_image_alt', true);

                if (empty($dp_thumbnail_alt)) {
                    $dp_thumbnail_alt = sprintf(
                        /* translators: %s: project title */
                        __('%s website project preview', 'shanayn-labs'),
                        $dp_featured_work_title
                    );
                }

                $dp_featured_work_image = get_the_post_thumbnail(
                    $dp_featured_work_id,
                    'large',
                    array(
                        'class' => 'dp-work-image',
                        'alt' => $dp_thumbnail_alt,
                        'loading' => 'lazy',
                    )
                );
            }
        }

        wp_reset_postdata();
        ?>
        <section class="dp-featured-work" aria-labelledby="dp-featured-work-heading" data-animate>
            <div class="container dp-featured-work-inner">
                <article class="dp-featured-work-card">
                    <div class="dp-featured-work-content">
                        <p class="dp-featured-work-label"><?php echo esc_html($dp_featured_work_label); ?></p>
                        <h2 id="dp-featured-work-heading" class="dp-featured-work-title"><?php echo esc_html($dp_featured_work_title); ?></h2>
                        <p class="dp-featured-work-description"><?php echo esc_html($dp_featured_work_description); ?></p>

                        <div class="dp-featured-work-tags" aria-label="<?php echo esc_attr__('Project focus areas', 'shanayn-labs'); ?>">
                            <span class="dp-featured-work-tag"><?php esc_html_e('Website Strategy', 'shanayn-labs'); ?></span>
                            <span class="dp-featured-work-tag"><?php esc_html_e('Service Pages', 'shanayn-labs'); ?></span>
                            <span class="dp-featured-work-tag"><?php esc_html_e('Lead Flow', 'shanayn-labs'); ?></span>
                            <span class="dp-featured-work-tag"><?php esc_html_e('Responsive Design', 'shanayn-labs'); ?></span>
                        </div>

                        <a class="dp-featured-work-cta" href="<?php echo esc_url($dp_featured_work_url); ?>">
                            <?php esc_html_e('View project', 'shanayn-labs'); ?>
                            <span aria-hidden="true"><?php esc_html_e('→', 'shanayn-labs'); ?></span>
                        </a>
                    </div>

                    <div class="dp-featured-work-visual">
                        <div class="dp-work-browser">
                            <div class="dp-work-browser-bar" aria-hidden="true">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="dp-work-browser-content">
                                <?php if ($dp_featured_work_has_image && !empty($dp_featured_work_image)) : ?>
                                    <?php echo $dp_featured_work_image; ?>
                                <?php else : ?>
                                    <div class="dp-work-fallback-preview" aria-hidden="true">
                                        <div class="dp-work-fallback-hero"><span></span><span></span><strong></strong></div>
                                        <div class="dp-work-fallback-services"><span></span><span></span><span></span></div>
                                        <div class="dp-work-fallback-lower"><span></span><strong></strong></div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <?php
        // Pricing section renders only when packages exist for the current service pillar.
        $render_pillar_pricing_section();
        ?>

        <section class="dp-final-cta" aria-labelledby="dp-final-cta-heading" data-animate>
            <div class="dp-final-cta-grid" aria-hidden="true"></div>
            <span class="dp-final-cta-glow" aria-hidden="true"></span>

            <div class="container dp-final-cta-inner">
                <div class="dp-final-cta-content">
                    <p class="dp-final-cta-kicker"><?php esc_html_e('READY TO IMPROVE YOUR DIGITAL PRESENCE?', 'shanayn-labs'); ?></p>
                    <h2 id="dp-final-cta-heading" class="dp-final-cta-title"><?php esc_html_e("Let's build a website that makes your business look clear, trusted, and ready to grow.", 'shanayn-labs'); ?></h2>
                    <p class="dp-final-cta-description"><?php esc_html_e('Start with a focused conversation about your current website, goals, and the digital presence your business needs.', 'shanayn-labs'); ?></p>

                    <div class="dp-final-cta-actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary dp-final-cta-button">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </div>

                <div class="dp-final-cta-visual" aria-hidden="true">
                    <div class="dp-final-cta-window">
                        <div class="dp-final-cta-window-bar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="dp-final-cta-window-content">
                            <div class="dp-final-cta-window-hero"><span></span><strong></strong></div>
                            <div class="dp-final-cta-window-rows"><span></span><span></span><span></span></div>
                            <div class="dp-final-cta-window-action"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php elseif ('growth-engine' === $term_slug) : ?>
        <section class="ge-hero" aria-labelledby="ge-hero-heading" data-animate>
            <div class="container ge-hero-inner">
                <header class="ge-hero-content">
                    <p class="ge-hero-eyebrow"><?php esc_html_e('02 / GROWTH ENGINE', 'shanayn-labs'); ?></p>
                    <h1 id="ge-hero-heading" class="ge-hero-title"><?php esc_html_e('Marketing systems built to bring attention, trust, and qualified leads.', 'shanayn-labs'); ?></h1>
                    <p class="ge-hero-description"><?php esc_html_e('We help businesses grow through SEO, content, social media, paid campaigns, analytics, and lead-focused digital strategies.', 'shanayn-labs'); ?></p>

                    <div class="ge-hero-actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary ge-hero-primary">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/work/')); ?>" class="btn-secondary ge-hero-secondary">
                            <?php esc_html_e('View Work', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </header>

                <div class="ge-hero-visual" aria-hidden="true">
                    <span class="ge-dashboard-glow"></span>

                    <div class="ge-floating-labels">
                        <span class="ge-floating-label ge-floating-label-seo"><?php esc_html_e('SEO', 'shanayn-labs'); ?></span>
                        <span class="ge-floating-label ge-floating-label-social"><?php esc_html_e('Social Media', 'shanayn-labs'); ?></span>
                        <span class="ge-floating-label ge-floating-label-ads"><?php esc_html_e('Meta Ads', 'shanayn-labs'); ?></span>
                        <span class="ge-floating-label ge-floating-label-content"><?php esc_html_e('Content', 'shanayn-labs'); ?></span>
                        <span class="ge-floating-label ge-floating-label-analytics"><?php esc_html_e('Analytics', 'shanayn-labs'); ?></span>
                        <span class="ge-floating-label ge-floating-label-leads"><?php esc_html_e('Lead Generation', 'shanayn-labs'); ?></span>
                    </div>

                    <div class="ge-dashboard">
                        <div class="ge-dashboard-header">
                            <span><?php esc_html_e('Growth dashboard', 'shanayn-labs'); ?></span>
                            <strong><?php esc_html_e('Marketing system', 'shanayn-labs'); ?></strong>
                        </div>

                        <div class="ge-dashboard-grid">
                            <div class="ge-dashboard-card ge-traffic-chart">
                                <div class="ge-dashboard-card-head">
                                    <span><?php esc_html_e('Website Traffic', 'shanayn-labs'); ?></span>
                                    <strong><?php esc_html_e('Traffic Trend', 'shanayn-labs'); ?></strong>
                                </div>
                                <svg viewBox="0 0 260 112" focusable="false">
                                    <path class="ge-chart-grid" d="M14 88H246M14 58H246M14 28H246"></path>
                                    <path class="ge-chart-line" d="M16 84C42 78 50 56 76 61C104 66 111 42 138 45C168 49 179 25 210 31C226 34 235 25 246 20"></path>
                                </svg>
                            </div>

                            <div class="ge-dashboard-card ge-lead-panel">
                                <div class="ge-dashboard-card-head">
                                    <span><?php esc_html_e('Lead Sources', 'shanayn-labs'); ?></span>
                                </div>
                                <div class="ge-lead-source-list">
                                    <span><em><?php esc_html_e('SEO', 'shanayn-labs'); ?></em></span>
                                    <span><em><?php esc_html_e('Social', 'shanayn-labs'); ?></em></span>
                                    <span><em><?php esc_html_e('Ads', 'shanayn-labs'); ?></em></span>
                                    <span><em><?php esc_html_e('Direct', 'shanayn-labs'); ?></em></span>
                                </div>
                            </div>

                            <div class="ge-dashboard-card ge-calendar-panel">
                                <div class="ge-dashboard-card-head">
                                    <span><?php esc_html_e('Content Calendar', 'shanayn-labs'); ?></span>
                                </div>
                                <div class="ge-calendar-grid">
                                    <span></span><span></span><span></span><span></span>
                                    <span></span><span></span><span></span><span></span>
                                </div>
                            </div>

                            <div class="ge-dashboard-card ge-campaign-panel">
                                <div class="ge-dashboard-card-head">
                                    <span><?php esc_html_e('Campaigns', 'shanayn-labs'); ?></span>
                                    <strong><?php esc_html_e('Reach + Leads', 'shanayn-labs'); ?></strong>
                                </div>
                                <div class="ge-campaign-bars">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>

                            <div class="ge-dashboard-card ge-profile-panel">
                                <div class="ge-dashboard-card-head">
                                    <span><?php esc_html_e('Business Profile', 'shanayn-labs'); ?></span>
                                </div>
                                <div class="ge-profile-lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>

                            <div class="ge-dashboard-card ge-social-preview">
                                <div class="ge-dashboard-card-head">
                                    <span><?php esc_html_e('Social Content', 'shanayn-labs'); ?></span>
                                </div>
                                <div class="ge-social-post">
                                    <span></span>
                                    <strong></strong>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ge-overview" aria-labelledby="ge-overview-heading" data-animate>
            <div class="container ge-overview-inner">
                <div class="ge-overview-band">
                    <h2 id="ge-overview-heading" class="ge-overview-statement"><?php esc_html_e('Growth does not come from random posting. It comes from a clear system.', 'shanayn-labs'); ?></h2>

                    <div class="ge-overview-points" role="list">
                        <div class="ge-overview-point" role="listitem">
                            <span class="ge-overview-dot" aria-hidden="true"></span>
                            <p class="ge-overview-point-text"><?php esc_html_e('Be visible where customers search.', 'shanayn-labs'); ?></p>
                        </div>

                        <div class="ge-overview-point" role="listitem">
                            <span class="ge-overview-dot" aria-hidden="true"></span>
                            <p class="ge-overview-point-text"><?php esc_html_e('Create content that builds trust.', 'shanayn-labs'); ?></p>
                        </div>

                        <div class="ge-overview-point" role="listitem">
                            <span class="ge-overview-dot" aria-hidden="true"></span>
                            <p class="ge-overview-point-text"><?php esc_html_e('Track what brings real leads.', 'shanayn-labs'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ge-build" aria-labelledby="ge-build-heading" data-animate>
            <div class="container ge-build-inner">
                <header class="ge-build-header">
                    <p class="ge-build-eyebrow"><?php esc_html_e('WHAT WE BUILD', 'shanayn-labs'); ?></p>
                    <h2 id="ge-build-heading" class="ge-build-title"><?php esc_html_e('Growth systems built around visibility, trust, campaigns, and measurable leads.', 'shanayn-labs'); ?></h2>
                    <p class="ge-build-description"><?php esc_html_e('From SEO and content to ads, analytics, local visibility, and email campaigns, we build growth systems that help businesses attract attention and turn it into real opportunities.', 'shanayn-labs'); ?></p>
                </header>

                <div class="ge-build-layout">
                    <div class="ge-build-selector" role="tablist" aria-label="<?php echo esc_attr__('Growth Engine services', 'shanayn-labs'); ?>">
                        <?php
                        $growth_services = array(
                            array('key' => 'seo', 'number' => '01', 'title' => __('SEO', 'shanayn-labs'), 'text' => __('Improve search visibility and organic traffic.', 'shanayn-labs')),
                            array('key' => 'social', 'number' => '02', 'title' => __('Social Media Management', 'shanayn-labs'), 'text' => __('Build a consistent, professional brand presence.', 'shanayn-labs')),
                            array('key' => 'meta-ads', 'number' => '03', 'title' => __('Meta Ads', 'shanayn-labs'), 'text' => __('Run focused campaigns for leads, awareness, and sales.', 'shanayn-labs')),
                            array('key' => 'content-strategy', 'number' => '04', 'title' => __('Content Strategy', 'shanayn-labs'), 'text' => __('Plan content around audience, trust, and conversion.', 'shanayn-labs')),
                            array('key' => 'gbp', 'number' => '05', 'title' => __('Google Business Profile', 'shanayn-labs'), 'text' => __('Improve local visibility and customer discovery.', 'shanayn-labs')),
                            array('key' => 'analytics', 'number' => '06', 'title' => __('Web Analytics', 'shanayn-labs'), 'text' => __('Track performance, traffic, leads, and user behavior.', 'shanayn-labs')),
                            array('key' => 'email', 'number' => '07', 'title' => __('Email Marketing', 'shanayn-labs'), 'text' => __('Nurture leads and customers with structured campaigns.', 'shanayn-labs')),
                        );
                        ?>
                        <?php foreach ($growth_services as $index => $growth_service) : ?>
                            <button
                                id="ge-build-tab-<?php echo esc_attr($growth_service['key']); ?>"
                                class="ge-build-selector-button <?php echo 0 === $index ? 'is-active' : ''; ?>"
                                type="button"
                                role="tab"
                                aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                                aria-controls="ge-preview-<?php echo esc_attr($growth_service['key']); ?>"
                                <?php echo 0 === $index ? '' : 'tabindex="-1"'; ?>
                                data-growth-service="<?php echo esc_attr($growth_service['key']); ?>"
                            >
                                <span class="ge-build-selector-indicator" aria-hidden="true"></span>
                                <span class="ge-build-selector-index"><?php echo esc_html($growth_service['number']); ?></span>
                                <span class="ge-build-selector-content">
                                    <span class="ge-build-selector-title"><?php echo esc_html($growth_service['title']); ?></span>
                                    <span class="ge-build-selector-text"><?php echo esc_html($growth_service['text']); ?></span>
                                </span>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <div class="ge-build-preview-wrap">
                        <div id="ge-preview-seo" class="ge-build-preview ge-preview-seo is-active" role="tabpanel" aria-labelledby="ge-build-tab-seo">
                            <div class="ge-build-preview-card">
                                <h3 class="ge-build-preview-title"><?php esc_html_e('Search Visibility', 'shanayn-labs'); ?></h3>
                                <div class="ge-build-preview-grid">
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Keyword Map', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Page Score', 'shanayn-labs'); ?></strong><em></em><span></span></div>
                                    <div class="ge-build-mini-panel ge-build-wide"><strong><?php esc_html_e('Organic Traffic', 'shanayn-labs'); ?></strong><svg viewBox="0 0 240 80"><path d="M8 62C38 58 46 42 74 47C104 53 112 29 142 34C174 39 184 18 232 22"></path></svg></div>
                                </div>
                            </div>
                        </div>

                        <div id="ge-preview-social" class="ge-build-preview ge-preview-social" role="tabpanel" aria-labelledby="ge-build-tab-social" hidden>
                            <div class="ge-build-preview-card">
                                <h3 class="ge-build-preview-title"><?php esc_html_e('Weekly Calendar', 'shanayn-labs'); ?></h3>
                                <div class="ge-build-preview-grid">
                                    <div class="ge-build-mini-panel ge-calendar-mini"><strong><?php esc_html_e('Approved / Scheduled', 'shanayn-labs'); ?></strong><span></span><span></span><span></span><span></span></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Post Preview', 'shanayn-labs'); ?></strong><em></em><span></span></div>
                                    <div class="ge-build-mini-panel ge-platforms"><strong><?php esc_html_e('Instagram', 'shanayn-labs'); ?></strong><strong><?php esc_html_e('Facebook', 'shanayn-labs'); ?></strong><strong><?php esc_html_e('LinkedIn', 'shanayn-labs'); ?></strong></div>
                                </div>
                            </div>
                        </div>

                        <div id="ge-preview-meta-ads" class="ge-build-preview ge-preview-meta" role="tabpanel" aria-labelledby="ge-build-tab-meta-ads" hidden>
                            <div class="ge-build-preview-card">
                                <h3 class="ge-build-preview-title"><?php esc_html_e('Campaign Focus', 'shanayn-labs'); ?></h3>
                                <div class="ge-build-preview-grid">
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Budget Control', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Audience Segment', 'shanayn-labs'); ?></strong><em></em><span></span></div>
                                    <div class="ge-build-mini-panel ge-build-wide ge-objectives"><strong><?php esc_html_e('Leads / Awareness / Sales', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="ge-preview-content-strategy" class="ge-build-preview ge-preview-content" role="tabpanel" aria-labelledby="ge-build-tab-content-strategy" hidden>
                            <div class="ge-build-preview-card">
                                <h3 class="ge-build-preview-title"><?php esc_html_e('Content Pillars', 'shanayn-labs'); ?></h3>
                                <div class="ge-build-preview-grid">
                                    <div class="ge-build-mini-panel ge-platforms"><strong><?php esc_html_e('Trust', 'shanayn-labs'); ?></strong><strong><?php esc_html_e('Education', 'shanayn-labs'); ?></strong><strong><?php esc_html_e('Offers', 'shanayn-labs'); ?></strong></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Topic Pipeline', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                    <div class="ge-build-mini-panel ge-build-wide ge-calendar-mini"><strong><?php esc_html_e('Monthly Plan', 'shanayn-labs'); ?></strong><span></span><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="ge-preview-gbp" class="ge-build-preview ge-preview-gbp" role="tabpanel" aria-labelledby="ge-build-tab-gbp" hidden>
                            <div class="ge-build-preview-card">
                                <h3 class="ge-build-preview-title"><?php esc_html_e('Business Profile', 'shanayn-labs'); ?></h3>
                                <div class="ge-build-preview-grid">
                                    <div class="ge-build-mini-panel ge-build-wide"><strong><?php esc_html_e('Local Visibility', 'shanayn-labs'); ?></strong><em></em><span></span></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Reviews', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Calls / Direction Clicks', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="ge-preview-analytics" class="ge-build-preview ge-preview-analytics" role="tabpanel" aria-labelledby="ge-build-tab-analytics" hidden>
                            <div class="ge-build-preview-card">
                                <h3 class="ge-build-preview-title"><?php esc_html_e('Traffic Sources', 'shanayn-labs'); ?></h3>
                                <div class="ge-build-preview-grid">
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Conversion Path', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Lead Events', 'shanayn-labs'); ?></strong><em></em><span></span></div>
                                    <div class="ge-build-mini-panel ge-build-wide ge-objectives"><strong><?php esc_html_e('Source → Page → Form → Lead', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="ge-preview-email" class="ge-build-preview ge-preview-email" role="tabpanel" aria-labelledby="ge-build-tab-email" hidden>
                            <div class="ge-build-preview-card">
                                <h3 class="ge-build-preview-title"><?php esc_html_e('Campaign Flow', 'shanayn-labs'); ?></h3>
                                <div class="ge-build-preview-grid">
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Welcome Email', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="ge-build-mini-panel"><strong><?php esc_html_e('Nurture Sequence', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="ge-build-mini-panel ge-build-wide ge-objectives"><strong><?php esc_html_e('Lead Segment / Customer Follow-up', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <a class="ge-build-cta" href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <?php esc_html_e('Discuss growth system', 'shanayn-labs'); ?>
                            <span aria-hidden="true"><?php esc_html_e('→', 'shanayn-labs'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="ge-framework" aria-labelledby="ge-framework-heading" data-animate>
            <div class="container ge-framework-inner">
                <header class="ge-framework-header">
                    <p class="ge-framework-eyebrow"><?php esc_html_e('GROWTH SYSTEM FRAMEWORK', 'shanayn-labs'); ?></p>
                    <h2 id="ge-framework-heading" class="ge-framework-title"><?php esc_html_e('A connected path from visibility to measurable growth.', 'shanayn-labs'); ?></h2>
                    <p class="ge-framework-description"><?php echo esc_html__('Growth works best when every step connects', 'shanayn-labs') . ' &mdash; ' . esc_html__('from being discovered to building trust, driving traffic, generating leads, and improving with real data.', 'shanayn-labs'); ?></p>
                </header>

                <?php
                $growth_framework_stages = array(
                    array(
                        'number' => '01',
                        'title'  => __('Visibility', 'shanayn-labs'),
                        'text'   => __('We help your business appear where your audience is searching and spending time.', 'shanayn-labs'),
                        'icon'   => 'visibility',
                    ),
                    array(
                        'number' => '02',
                        'title'  => __('Trust', 'shanayn-labs'),
                        'text'   => __('We create content, pages, and campaigns that make your brand look credible.', 'shanayn-labs'),
                        'icon'   => 'trust',
                    ),
                    array(
                        'number' => '03',
                        'title'  => __('Traffic', 'shanayn-labs'),
                        'text'   => __('We drive relevant visitors through SEO, social platforms, and paid campaigns.', 'shanayn-labs'),
                        'icon'   => 'traffic',
                    ),
                    array(
                        'number' => '04',
                        'title'  => __('Leads', 'shanayn-labs'),
                        'text'   => __('We guide visitors toward calls, forms, messages, and purchase actions.', 'shanayn-labs'),
                        'icon'   => 'leads',
                    ),
                    array(
                        'number' => '05',
                        'title'  => __('Improvement', 'shanayn-labs'),
                        'text'   => __('We track results and improve based on real performance data.', 'shanayn-labs'),
                        'icon'   => 'improvement',
                    ),
                );
                ?>

                <div class="ge-framework-path" role="list" aria-label="<?php echo esc_attr__('Growth Engine framework stages', 'shanayn-labs'); ?>">
                    <?php foreach ($growth_framework_stages as $growth_framework_stage) : ?>
                        <article class="ge-framework-stage" role="listitem">
                            <span class="ge-framework-stage-point" aria-hidden="true">
                                <span class="ge-framework-stage-number"><?php echo esc_html($growth_framework_stage['number']); ?></span>
                            </span>
                            <span class="ge-framework-stage-icon ge-framework-stage-icon-<?php echo esc_attr($growth_framework_stage['icon']); ?>" aria-hidden="true">
                                <?php if ('visibility' === $growth_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><circle cx="10.5" cy="10.5" r="5.5"></circle><path d="M15 15l5 5"></path></svg>
                                <?php elseif ('trust' === $growth_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><path d="M12 3l7 3v5c0 4.4-2.8 7.8-7 10-4.2-2.2-7-5.6-7-10V6l7-3z"></path><path d="M8.8 12l2.1 2.1 4.5-4.8"></path></svg>
                                <?php elseif ('traffic' === $growth_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><path d="M4 17c3.2-5.8 8.2-7.4 15-7.4"></path><path d="M15.5 6.4L20 9.6l-4.5 3.2"></path></svg>
                                <?php elseif ('leads' === $growth_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><path d="M5 5h14v10H9l-4 4V5z"></path><path d="M8.5 8.5h7"></path><path d="M8.5 11.5h4.5"></path></svg>
                                <?php else : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><path d="M18.5 9A7 7 0 1 0 19 15"></path><path d="M18.5 4v5h-5"></path><path d="M15 15h4.5v4.5"></path></svg>
                                <?php endif; ?>
                            </span>
                            <div class="ge-framework-stage-content">
                                <h3 class="ge-framework-stage-title"><?php echo esc_html($growth_framework_stage['title']); ?></h3>
                                <p class="ge-framework-stage-text"><?php echo esc_html($growth_framework_stage['text']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="ge-use-cases" aria-labelledby="ge-use-cases-heading" data-animate>
            <div class="container ge-use-cases-inner">
                <header class="ge-use-cases-header">
                    <p class="ge-use-cases-eyebrow"><?php esc_html_e('BEST FOR', 'shanayn-labs'); ?></p>
                    <h2 id="ge-use-cases-heading" class="ge-use-cases-title"><?php esc_html_e('When your marketing needs structure, clarity, and better results.', 'shanayn-labs'); ?></h2>
                    <p class="ge-use-cases-description"><?php esc_html_e('Growth Engine is built for businesses that need stronger visibility, consistent content, clearer campaigns, and better tracking around what actually brings leads.', 'shanayn-labs'); ?></p>
                </header>

                <?php
                $growth_use_cases = array(
                    array(
                        'need'     => __('People are not finding your business', 'shanayn-labs'),
                        'solution' => __('SEO and local visibility', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('Your social media looks inactive', 'shanayn-labs'),
                        'solution' => __('Consistent content system', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('You need more qualified inquiries', 'shanayn-labs'),
                        'solution' => __('Lead-focused campaigns', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('You are running ads without clarity', 'shanayn-labs'),
                        'solution' => __('Campaign tracking and optimization', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('You do not know what marketing is working', 'shanayn-labs'),
                        'solution' => __('Analytics and reporting', 'shanayn-labs'),
                    ),
                );
                ?>

                <div class="ge-use-cases-panel" role="list" aria-label="<?php echo esc_attr__('Growth Engine use cases and solutions', 'shanayn-labs'); ?>">
                    <div class="ge-use-cases-head" aria-hidden="true">
                        <span><?php esc_html_e('You need this if...', 'shanayn-labs'); ?></span>
                        <span></span>
                        <span><?php esc_html_e('Growth Engine helps with...', 'shanayn-labs'); ?></span>
                    </div>

                    <?php foreach ($growth_use_cases as $growth_use_case) : ?>
                        <div class="ge-use-cases-row" role="listitem" tabindex="0">
                            <p class="ge-use-cases-need"><?php echo esc_html($growth_use_case['need']); ?></p>
                            <span class="ge-use-cases-arrow" aria-hidden="true">&rarr;</span>
                            <div class="ge-use-cases-solution">
                                <p class="ge-use-cases-solution-text"><?php echo esc_html($growth_use_case['solution']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php
        $ge_featured_work_post = null;
        $ge_featured_work_query = new WP_Query(
            array(
                'post_type' => 'shanaynlabs_work',
                'post_status' => 'publish',
                'posts_per_page' => 10,
                'meta_query' => array(
                    array(
                        'key' => '_shanaynlabs_featured_work',
                        'value' => '1',
                        'compare' => '=',
                    ),
                ),
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );

        if ($ge_featured_work_query->have_posts()) {
            $ge_growth_terms = array('growth', 'marketing', 'seo', 'social', 'lead', 'campaign');

            foreach ($ge_featured_work_query->posts as $ge_work_candidate) {
                $ge_candidate_type = strtolower((string) get_post_meta($ge_work_candidate->ID, '_shanaynlabs_project_type', true));

                foreach ($ge_growth_terms as $ge_growth_term) {
                    if (false !== strpos($ge_candidate_type, $ge_growth_term)) {
                        $ge_featured_work_post = $ge_work_candidate;
                        break 2;
                    }
                }
            }

            if (!$ge_featured_work_post) {
                $ge_featured_work_post = $ge_featured_work_query->posts[0];
            }
        }

        $ge_featured_work_id = $ge_featured_work_post ? $ge_featured_work_post->ID : 0;
        $ge_featured_work_label = __('FEATURED GROWTH WORK', 'shanayn-labs');
        $ge_featured_work_title = __('Local visibility and lead generation system', 'shanayn-labs');
        $ge_featured_work_description = __('A structured growth setup designed to improve digital visibility, organize content, and support customer inquiries through search and social channels.', 'shanayn-labs');
        $ge_featured_work_url = home_url('/work/');
        $ge_featured_work_has_image = false;
        $ge_featured_work_image = '';
        $ge_featured_work_tags = array(
            __('SEO', 'shanayn-labs'),
            __('Content Planning', 'shanayn-labs'),
            __('Social Presence', 'shanayn-labs'),
            __('Lead Flow', 'shanayn-labs'),
            __('Analytics', 'shanayn-labs'),
        );

        if ($ge_featured_work_id) {
            $ge_project_type = get_post_meta($ge_featured_work_id, '_shanaynlabs_project_type', true);
            $ge_result_summary = get_post_meta($ge_featured_work_id, '_shanaynlabs_result_summary', true);
            $ge_project_url = get_post_meta($ge_featured_work_id, '_shanaynlabs_project_url', true);

            if (!empty($ge_project_type)) {
                $ge_featured_work_label = $ge_project_type;
            }

            $ge_featured_work_title = get_the_title($ge_featured_work_id);

            if (!empty($ge_result_summary)) {
                $ge_featured_work_description = $ge_result_summary;
            } elseif (has_excerpt($ge_featured_work_id)) {
                $ge_featured_work_description = get_the_excerpt($ge_featured_work_id);
            } elseif (!empty($ge_featured_work_post->post_content)) {
                $ge_featured_work_description = wp_trim_words(wp_strip_all_tags($ge_featured_work_post->post_content), 24, '...');
            }

            $ge_featured_work_url = !empty($ge_project_url) ? $ge_project_url : get_permalink($ge_featured_work_id);

            if (has_post_thumbnail($ge_featured_work_id)) {
                $ge_featured_work_has_image = true;
                $ge_thumbnail_id = get_post_thumbnail_id($ge_featured_work_id);
                $ge_thumbnail_alt = get_post_meta($ge_thumbnail_id, '_wp_attachment_image_alt', true);

                if (empty($ge_thumbnail_alt)) {
                    $ge_thumbnail_alt = sprintf(
                        /* translators: %s: project title */
                        __('%s project preview', 'shanayn-labs'),
                        $ge_featured_work_title
                    );
                }

                $ge_featured_work_image = get_the_post_thumbnail(
                    $ge_featured_work_id,
                    'large',
                    array(
                        'class' => 'ge-growth-dashboard-image',
                        'alt' => $ge_thumbnail_alt,
                        'loading' => 'lazy',
                    )
                );
            }
        }

        wp_reset_postdata();
        ?>

        <section class="ge-featured-work" aria-labelledby="ge-featured-work-heading" data-animate>
            <div class="container ge-featured-work-inner">
                <article class="ge-featured-work-card">
                    <div class="ge-featured-work-content">
                        <p class="ge-featured-work-label"><?php echo esc_html($ge_featured_work_label); ?></p>
                        <h2 id="ge-featured-work-heading" class="ge-featured-work-title"><?php echo esc_html($ge_featured_work_title); ?></h2>
                        <p class="ge-featured-work-description"><?php echo esc_html($ge_featured_work_description); ?></p>

                        <div class="ge-featured-work-tags" aria-label="<?php echo esc_attr__('Growth work focus areas', 'shanayn-labs'); ?>">
                            <?php foreach ($ge_featured_work_tags as $ge_featured_work_tag) : ?>
                                <span class="ge-featured-work-tag"><?php echo esc_html($ge_featured_work_tag); ?></span>
                            <?php endforeach; ?>
                        </div>

                        <a class="ge-featured-work-cta" href="<?php echo esc_url($ge_featured_work_url); ?>">
                            <?php esc_html_e('View project', 'shanayn-labs'); ?>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>

                    <div class="ge-featured-work-visual">
                        <div class="ge-growth-dashboard">
                            <div class="ge-growth-dashboard-frame">
                                <div class="ge-growth-dashboard-header" aria-hidden="true">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <strong><?php esc_html_e('Growth Preview', 'shanayn-labs'); ?></strong>
                                </div>

                                <div class="ge-growth-dashboard-content">
                                    <?php if ($ge_featured_work_has_image && !empty($ge_featured_work_image)) : ?>
                                        <?php echo $ge_featured_work_image; ?>
                                    <?php else : ?>
                                        <div class="ge-growth-dashboard-fallback" aria-hidden="true">
                                            <div class="ge-growth-mini-panel ge-growth-chart">
                                                <strong><?php esc_html_e('Traffic Trend', 'shanayn-labs'); ?></strong>
                                                <svg viewBox="0 0 260 92"><path d="M10 70C38 66 52 50 78 54C106 58 118 34 148 38C178 42 194 22 250 24"></path></svg>
                                            </div>
                                            <div class="ge-growth-mini-panel ge-growth-calendar">
                                                <strong><?php esc_html_e('Content Plan', 'shanayn-labs'); ?></strong>
                                                <span></span><span></span><span></span><span></span>
                                            </div>
                                            <div class="ge-growth-mini-panel ge-growth-source-panel">
                                                <strong><?php esc_html_e('Inquiry Sources', 'shanayn-labs'); ?></strong>
                                                <em></em><em></em><em></em>
                                            </div>
                                            <div class="ge-growth-mini-panel ge-growth-campaign-panel">
                                                <strong><?php esc_html_e('Campaign Overview', 'shanayn-labs'); ?></strong>
                                                <span></span><span></span>
                                            </div>
                                            <div class="ge-growth-mini-panel ge-growth-local-card">
                                                <strong><?php esc_html_e('Local Visibility', 'shanayn-labs'); ?></strong>
                                                <span></span><span></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <?php
        // Pricing section renders only when packages exist for the current service pillar.
        $render_pillar_pricing_section();
        ?>

        <section class="ge-final-cta" aria-labelledby="ge-final-cta-heading" data-animate>
            <span class="ge-final-cta-grid" aria-hidden="true"></span>
            <span class="ge-final-cta-glow" aria-hidden="true"></span>

            <div class="container ge-final-cta-inner">
                <div class="ge-final-cta-content">
                    <p class="ge-final-cta-kicker"><?php esc_html_e('READY TO BUILD YOUR GROWTH ENGINE?', 'shanayn-labs'); ?></p>
                    <h2 id="ge-final-cta-heading" class="ge-final-cta-title"><?php esc_html_e("Let's create a marketing system that brings clarity, visibility, and better leads.", 'shanayn-labs'); ?></h2>
                    <p class="ge-final-cta-description"><?php esc_html_e('Start with a focused conversation about your current marketing, audience, and the growth system your business needs.', 'shanayn-labs'); ?></p>

                    <div class="ge-final-cta-actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary ge-final-cta-button">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </div>

                <div class="ge-final-cta-visual" aria-hidden="true">
                    <div class="ge-final-analytics">
                        <div class="ge-final-analytics-header">
                            <span></span>
                            <span></span>
                            <span></span>
                            <strong><?php esc_html_e('Growth Console', 'shanayn-labs'); ?></strong>
                        </div>
                        <div class="ge-final-analytics-chart">
                            <strong><?php esc_html_e('Traffic Trend', 'shanayn-labs'); ?></strong>
                            <svg viewBox="0 0 280 96" focusable="false"><path d="M8 72C38 68 52 56 78 58C108 61 124 38 154 42C185 46 202 24 272 25"></path></svg>
                        </div>
                        <div class="ge-final-analytics-row">
                            <span><?php esc_html_e('Lead Sources', 'shanayn-labs'); ?></span>
                            <em></em>
                        </div>
                        <div class="ge-final-analytics-row">
                            <span><?php esc_html_e('Campaign Status', 'shanayn-labs'); ?></span>
                            <em></em>
                        </div>
                        <div class="ge-final-analytics-row">
                            <span><?php esc_html_e('Conversion Path', 'shanayn-labs'); ?></span>
                            <em></em>
                        </div>
                    </div>

                    <span class="ge-final-content-shape ge-final-content-shape-calendar"></span>
                    <span class="ge-final-content-shape ge-final-content-shape-post"></span>
                    <span class="ge-final-calendar-shape"></span>
                </div>
            </div>
        </section>
    <?php elseif ('software-intelligence' === $term_slug) : ?>
        <section class="si-hero" aria-labelledby="si-hero-heading" data-animate>
            <div class="container si-hero-inner">
                <div class="si-hero-content">
                    <p class="si-hero-eyebrow"><?php esc_html_e('03 / SOFTWARE INTELLIGENCE', 'shanayn-labs'); ?></p>
                    <h1 id="si-hero-heading" class="si-hero-title"><?php esc_html_e('Custom software and AI systems built around real business operations.', 'shanayn-labs'); ?></h1>
                    <p class="si-hero-description"><?php esc_html_e('We build dashboards, CRM systems, automation tools, internal software, and AI workflows that help businesses manage data, reduce manual work, and make better decisions.', 'shanayn-labs'); ?></p>

                    <div class="si-hero-actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/work/')); ?>" class="btn-secondary">
                            <?php esc_html_e('View Work', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </div>

                <div class="si-hero-visual" aria-hidden="true">
                    <div class="si-dashboard">
                        <div class="si-dashboard-shell">
                            <div class="si-dashboard-topbar">
                                <span></span>
                                <span></span>
                                <span></span>
                                <strong><?php esc_html_e('Operations Intelligence', 'shanayn-labs'); ?></strong>
                            </div>

                            <div class="si-kpi-grid">
                                <div class="si-kpi-card">
                                    <span><?php esc_html_e('Open Tasks', 'shanayn-labs'); ?></span>
                                    <strong><?php esc_html_e('24', 'shanayn-labs'); ?></strong>
                                </div>
                                <div class="si-kpi-card">
                                    <span><?php esc_html_e('CRM Leads', 'shanayn-labs'); ?></span>
                                    <strong><?php esc_html_e('18', 'shanayn-labs'); ?></strong>
                                </div>
                                <div class="si-kpi-card">
                                    <span><?php esc_html_e('Automations', 'shanayn-labs'); ?></span>
                                    <strong><?php esc_html_e('12', 'shanayn-labs'); ?></strong>
                                </div>
                            </div>

                            <div class="si-dashboard-grid">
                                <div class="si-panel si-crm-pipeline">
                                    <div class="si-panel-heading">
                                        <span><?php esc_html_e('CRM Pipeline', 'shanayn-labs'); ?></span>
                                        <em></em>
                                    </div>
                                    <div class="si-pipeline-lanes">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                                <div class="si-panel si-ai-panel">
                                    <div class="si-panel-heading">
                                        <span><?php esc_html_e('AI Assistant', 'shanayn-labs'); ?></span>
                                        <em></em>
                                    </div>
                                    <div class="si-ai-lines">
                                        <span></span>
                                        <span></span>
                                        <strong></strong>
                                    </div>
                                </div>

                                <div class="si-panel si-automation-flow">
                                    <div class="si-panel-heading">
                                        <span><?php esc_html_e('Automation Flow', 'shanayn-labs'); ?></span>
                                        <em></em>
                                    </div>
                                    <div class="si-flow-nodes">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                                <div class="si-panel si-task-board">
                                    <div class="si-panel-heading">
                                        <span><?php esc_html_e('Task Board', 'shanayn-labs'); ?></span>
                                        <em></em>
                                    </div>
                                    <div class="si-task-columns">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>

                                <div class="si-panel si-reporting-graph">
                                    <div class="si-panel-heading">
                                        <span><?php esc_html_e('Reporting Graph', 'shanayn-labs'); ?></span>
                                        <em></em>
                                    </div>
                                    <svg viewBox="0 0 240 80" focusable="false"><path d="M8 62C38 58 48 44 74 47C104 51 112 30 142 34C172 38 188 20 232 22"></path></svg>
                                </div>

                                <div class="si-panel si-api-nodes">
                                    <div class="si-panel-heading">
                                        <span><?php esc_html_e('API Nodes', 'shanayn-labs'); ?></span>
                                        <em></em>
                                    </div>
                                    <div class="si-api-map">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <span class="si-floating-label si-floating-label-crm"><?php esc_html_e('CRM', 'shanayn-labs'); ?></span>
                    <span class="si-floating-label si-floating-label-dashboards"><?php esc_html_e('Dashboards', 'shanayn-labs'); ?></span>
                    <span class="si-floating-label si-floating-label-ai"><?php esc_html_e('AI Automation', 'shanayn-labs'); ?></span>
                    <span class="si-floating-label si-floating-label-tools"><?php esc_html_e('Internal Tools', 'shanayn-labs'); ?></span>
                    <span class="si-floating-label si-floating-label-workflows"><?php esc_html_e('Workflow Systems', 'shanayn-labs'); ?></span>
                    <span class="si-floating-label si-floating-label-api"><?php esc_html_e('API Integrations', 'shanayn-labs'); ?></span>
                </div>
            </div>
        </section>

        <section class="si-overview" aria-labelledby="si-overview-heading" data-animate>
            <div class="container si-overview-inner">
                <div class="si-overview-band">
                    <h2 id="si-overview-heading" class="si-overview-statement"><?php esc_html_e('When operations depend on scattered tools and manual work, growth becomes harder to manage.', 'shanayn-labs'); ?></h2>

                    <div class="si-overview-points" role="list">
                        <span class="si-overview-line" aria-hidden="true"></span>

                        <div class="si-overview-point" role="listitem">
                            <span class="si-overview-dot" aria-hidden="true"></span>
                            <p class="si-overview-point-text"><?php esc_html_e('Centralize business data.', 'shanayn-labs'); ?></p>
                        </div>

                        <div class="si-overview-point" role="listitem">
                            <span class="si-overview-dot" aria-hidden="true"></span>
                            <p class="si-overview-point-text"><?php esc_html_e('Automate repetitive tasks.', 'shanayn-labs'); ?></p>
                        </div>

                        <div class="si-overview-point" role="listitem">
                            <span class="si-overview-dot" aria-hidden="true"></span>
                            <p class="si-overview-point-text"><?php esc_html_e('Build systems around real workflows.', 'shanayn-labs'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="si-build" aria-labelledby="si-build-heading" data-animate>
            <div class="container si-build-inner">
                <header class="si-build-header">
                    <p class="si-build-eyebrow"><?php esc_html_e('WHAT WE BUILD', 'shanayn-labs'); ?></p>
                    <h2 id="si-build-heading" class="si-build-title"><?php esc_html_e('Software and AI systems designed around how your business actually works.', 'shanayn-labs'); ?></h2>
                    <p class="si-build-description"><?php esc_html_e('From dashboards and CRM systems to automation workflows, POS systems, AI assistants, and API integrations, we build practical systems that help businesses manage data, reduce manual work, and operate with more clarity.', 'shanayn-labs'); ?></p>
                </header>

                <?php
                $software_services = array(
                    array('key' => 'custom-software', 'number' => '01', 'title' => __('Custom Software', 'shanayn-labs'), 'text' => __('Tailored systems built around your business workflow.', 'shanayn-labs')),
                    array('key' => 'web-applications', 'number' => '02', 'title' => __('Web Applications', 'shanayn-labs'), 'text' => __('Responsive platforms for users, teams, and customers.', 'shanayn-labs')),
                    array('key' => 'dashboards', 'number' => '03', 'title' => __('Business Dashboards', 'shanayn-labs'), 'text' => __('Clear reporting systems for tracking performance and activity.', 'shanayn-labs')),
                    array('key' => 'crm', 'number' => '04', 'title' => __('CRM Systems', 'shanayn-labs'), 'text' => __('Tools for managing leads, customers, follow-ups, and pipelines.', 'shanayn-labs')),
                    array('key' => 'pos', 'number' => '05', 'title' => __('POS Systems', 'shanayn-labs'), 'text' => __('Sales, inventory, customer, and transaction management.', 'shanayn-labs')),
                    array('key' => 'ai-automation', 'number' => '06', 'title' => __('AI Automation', 'shanayn-labs'), 'text' => __('AI-powered workflows for repetitive tasks and internal support.', 'shanayn-labs')),
                    array('key' => 'ai-chatbots', 'number' => '07', 'title' => __('AI Chatbots', 'shanayn-labs'), 'text' => __('Smart assistants for customer support, FAQs, and lead capture.', 'shanayn-labs')),
                    array('key' => 'api-integrations', 'number' => '08', 'title' => __('API Integrations', 'shanayn-labs'), 'text' => __('Connect your tools, platforms, and data into one workflow.', 'shanayn-labs')),
                );
                ?>

                <div class="si-build-layout">
                    <div class="si-build-selector" role="tablist" aria-label="<?php echo esc_attr__('Software Intelligence services', 'shanayn-labs'); ?>">
                        <?php foreach ($software_services as $index => $software_service) : ?>
                            <button
                                id="si-build-tab-<?php echo esc_attr($software_service['key']); ?>"
                                class="si-build-selector-button <?php echo 0 === $index ? 'is-active' : ''; ?>"
                                type="button"
                                role="tab"
                                aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                                aria-controls="si-preview-<?php echo esc_attr($software_service['key']); ?>"
                                <?php echo 0 === $index ? '' : 'tabindex="-1"'; ?>
                                data-software-service="<?php echo esc_attr($software_service['key']); ?>"
                            >
                                <span class="si-build-selector-indicator" aria-hidden="true"></span>
                                <span class="si-build-selector-index"><?php echo esc_html($software_service['number']); ?></span>
                                <span class="si-build-selector-content">
                                    <span class="si-build-selector-title"><?php echo esc_html($software_service['title']); ?></span>
                                    <span class="si-build-selector-text"><?php echo esc_html($software_service['text']); ?></span>
                                </span>
                            </button>
                        <?php endforeach; ?>
                    </div>

                    <div class="si-build-preview-wrap">
                        <div id="si-preview-custom-software" class="si-build-preview si-preview-custom-software is-active" role="tabpanel" aria-labelledby="si-build-tab-custom-software">
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('Modular Business App', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid">
                                    <div class="si-build-mini-panel si-build-wide"><strong><?php esc_html_e('Operations Dashboard', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Workflow Modules', 'shanayn-labs'); ?></strong><em></em></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Team Actions', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="si-preview-web-applications" class="si-build-preview si-preview-web-applications" role="tabpanel" aria-labelledby="si-build-tab-web-applications" hidden>
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('User Portal', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid">
                                    <div class="si-build-mini-panel si-build-wide si-build-nav"><strong><?php esc_html_e('Portal Navigation', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Account Cards', 'shanayn-labs'); ?></strong><em></em></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('User Actions', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="si-preview-dashboards" class="si-build-preview si-preview-dashboards" role="tabpanel" aria-labelledby="si-build-tab-dashboards" hidden>
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('Reporting Center', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid">
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('KPI Cards', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Filters', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="si-build-mini-panel si-build-wide"><strong><?php esc_html_e('Performance Graph', 'shanayn-labs'); ?></strong><svg viewBox="0 0 240 80"><path d="M8 62C36 58 48 44 76 48C108 52 118 28 150 34C180 39 194 20 232 22"></path></svg></div>
                                </div>
                            </div>
                        </div>

                        <div id="si-preview-crm" class="si-build-preview si-preview-crm" role="tabpanel" aria-labelledby="si-build-tab-crm" hidden>
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('Lead Management', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid">
                                    <div class="si-build-mini-panel si-build-pipeline"><strong><?php esc_html_e('Lead Pipeline', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Customer Profile', 'shanayn-labs'); ?></strong><em></em></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Follow-up Status', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="si-preview-pos" class="si-build-preview si-preview-pos" role="tabpanel" aria-labelledby="si-build-tab-pos" hidden>
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('Sales Workspace', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid">
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Sales Screen', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Inventory Table', 'shanayn-labs'); ?></strong><span></span><span></span><span></span></div>
                                    <div class="si-build-mini-panel si-build-wide"><strong><?php esc_html_e('Receipt Panel', 'shanayn-labs'); ?></strong><em></em></div>
                                </div>
                            </div>
                        </div>

                        <div id="si-preview-ai-automation" class="si-build-preview si-preview-ai-automation" role="tabpanel" aria-labelledby="si-build-tab-ai-automation" hidden>
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('AI Workflow', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid si-build-flow">
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Input', 'shanayn-labs'); ?></strong><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('AI Action', 'shanayn-labs'); ?></strong><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Approval', 'shanayn-labs'); ?></strong><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Output', 'shanayn-labs'); ?></strong><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="si-preview-ai-chatbots" class="si-build-preview si-preview-ai-chatbots" role="tabpanel" aria-labelledby="si-build-tab-ai-chatbots" hidden>
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('Support Assistant', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid">
                                    <div class="si-build-mini-panel si-build-chat si-build-wide"><strong><?php esc_html_e('Chat Interface', 'shanayn-labs'); ?></strong><span></span><span></span><em></em></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Support Reply', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Lead Capture', 'shanayn-labs'); ?></strong><span></span><span></span></div>
                                </div>
                            </div>
                        </div>

                        <div id="si-preview-api-integrations" class="si-build-preview si-preview-api-integrations" role="tabpanel" aria-labelledby="si-build-tab-api-integrations" hidden>
                            <div class="si-build-preview-card">
                                <h3 class="si-build-preview-title"><?php esc_html_e('Connected Workflow', 'shanayn-labs'); ?></h3>
                                <div class="si-build-preview-grid si-build-api-map">
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('CRM', 'shanayn-labs'); ?></strong><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Payments', 'shanayn-labs'); ?></strong><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Inventory', 'shanayn-labs'); ?></strong><span></span></div>
                                    <div class="si-build-mini-panel"><strong><?php esc_html_e('Reporting', 'shanayn-labs'); ?></strong><span></span></div>
                                </div>
                            </div>
                        </div>

                        <a class="si-build-cta" href="<?php echo esc_url(home_url('/contact/')); ?>">
                            <?php esc_html_e('Discuss a software system', 'shanayn-labs'); ?>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="si-framework" aria-labelledby="si-framework-heading" data-animate>
            <div class="container si-framework-inner">
                <header class="si-framework-header">
                    <p class="si-framework-eyebrow"><?php esc_html_e('INTELLIGENCE SYSTEM FRAMEWORK', 'shanayn-labs'); ?></p>
                    <h2 id="si-framework-heading" class="si-framework-title"><?php esc_html_e('A practical software process built around workflows, data, and intelligence.', 'shanayn-labs'); ?></h2>
                    <p class="si-framework-description"><?php esc_html_e('We design software systems by understanding how your business works, structuring the right data, building usable interfaces, and adding automation or AI where it creates real value.', 'shanayn-labs'); ?></p>
                </header>

                <?php
                $intelligence_framework_stages = array(
                    array(
                        'number' => '01',
                        'title'  => __('Workflow', 'shanayn-labs'),
                        'text'   => __('We understand how your business currently works and where friction exists.', 'shanayn-labs'),
                        'icon'   => 'workflow',
                    ),
                    array(
                        'number' => '02',
                        'title'  => __('Data', 'shanayn-labs'),
                        'text'   => __('We identify what information needs to be collected, managed, and reported.', 'shanayn-labs'),
                        'icon'   => 'data',
                    ),
                    array(
                        'number' => '03',
                        'title'  => __('Interface', 'shanayn-labs'),
                        'text'   => __('We design clean dashboards, panels, and tools for users to work faster.', 'shanayn-labs'),
                        'icon'   => 'interface',
                    ),
                    array(
                        'number' => '04',
                        'title'  => __('Automation', 'shanayn-labs'),
                        'text'   => __('We reduce repetitive tasks with smart workflows and integrations.', 'shanayn-labs'),
                        'icon'   => 'automation',
                    ),
                    array(
                        'number' => '05',
                        'title'  => __('Intelligence', 'shanayn-labs'),
                        'text'   => __('We add AI, reporting, and insights where they create real business value.', 'shanayn-labs'),
                        'icon'   => 'intelligence',
                    ),
                );
                ?>

                <div class="si-framework-flow" role="list" aria-label="<?php echo esc_attr__('Software Intelligence system framework', 'shanayn-labs'); ?>">
                    <span class="si-framework-line" aria-hidden="true"></span>
                    <span class="si-framework-loop" aria-hidden="true"></span>

                    <?php foreach ($intelligence_framework_stages as $intelligence_framework_stage) : ?>
                        <article class="si-framework-stage si-framework-stage-<?php echo esc_attr($intelligence_framework_stage['icon']); ?>" role="listitem">
                            <span class="si-framework-stage-number"><?php echo esc_html($intelligence_framework_stage['number']); ?></span>
                            <span class="si-framework-stage-icon" aria-hidden="true">
                                <?php if ('workflow' === $intelligence_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><path d="M4 7h5v5H4z"></path><path d="M15 7h5v5h-5z"></path><path d="M9 9.5h6"></path><path d="M12 12v5"></path><path d="M9.5 17h5"></path></svg>
                                <?php elseif ('data' === $intelligence_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><ellipse cx="12" cy="6" rx="7" ry="3"></ellipse><path d="M5 6v6c0 1.7 3.1 3 7 3s7-1.3 7-3V6"></path><path d="M5 12v6c0 1.7 3.1 3 7 3s7-1.3 7-3v-6"></path></svg>
                                <?php elseif ('interface' === $intelligence_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><rect x="4" y="5" width="16" height="14" rx="2"></rect><path d="M4 9h16"></path><path d="M8 13h4"></path><path d="M8 16h8"></path></svg>
                                <?php elseif ('automation' === $intelligence_framework_stage['icon']) : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><path d="M6 12a6 6 0 0 1 10-4.5"></path><path d="M16 4v4h-4"></path><path d="M18 12a6 6 0 0 1-10 4.5"></path><path d="M8 20v-4h4"></path></svg>
                                <?php else : ?>
                                    <svg viewBox="0 0 24 24" focusable="false"><path d="M12 3l1.5 5 4.5 2-4.5 2L12 17l-1.5-5L6 10l4.5-2L12 3z"></path><path d="M18 15l.8 2.2L21 18l-2.2.8L18 21l-.8-2.2L15 18l2.2-.8L18 15z"></path></svg>
                                <?php endif; ?>
                            </span>
                            <div class="si-framework-stage-content">
                                <h3 class="si-framework-stage-title"><?php echo esc_html($intelligence_framework_stage['title']); ?></h3>
                                <p class="si-framework-stage-text"><?php echo esc_html($intelligence_framework_stage['text']); ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="si-use-cases" aria-labelledby="si-use-cases-heading" data-animate>
            <div class="container si-use-cases-inner">
                <header class="si-use-cases-header">
                    <p class="si-use-cases-eyebrow"><?php esc_html_e('BEST FOR', 'shanayn-labs'); ?></p>
                    <h2 id="si-use-cases-heading" class="si-use-cases-title"><?php esc_html_e('When your business needs better systems, not more manual work.', 'shanayn-labs'); ?></h2>
                    <p class="si-use-cases-description"><?php esc_html_e('Software Intelligence is built for businesses that need clearer data, connected tools, automated workflows, and practical AI systems around real operations.', 'shanayn-labs'); ?></p>
                </header>

                <?php
                $software_use_cases = array(
                    array(
                        'need'     => __('Your team works in spreadsheets', 'shanayn-labs'),
                        'solution' => __('Custom dashboards and internal tools', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('Customer follow-ups are hard to manage', 'shanayn-labs'),
                        'solution' => __('CRM and workflow tracking', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('Inventory or sales are difficult to control', 'shanayn-labs'),
                        'solution' => __('POS and management systems', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('Reports take too much manual effort', 'shanayn-labs'),
                        'solution' => __('Business dashboards and automation', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('Your tools do not connect properly', 'shanayn-labs'),
                        'solution' => __('API integrations', 'shanayn-labs'),
                    ),
                    array(
                        'need'     => __('You want to use AI practically', 'shanayn-labs'),
                        'solution' => __('AI automation and smart workflows', 'shanayn-labs'),
                    ),
                );
                ?>

                <div class="si-use-cases-panel" role="list" aria-label="<?php echo esc_attr__('Software Intelligence use cases and solutions', 'shanayn-labs'); ?>">
                    <div class="si-use-cases-head" aria-hidden="true">
                        <span><?php esc_html_e('You need this if...', 'shanayn-labs'); ?></span>
                        <span></span>
                        <span><?php esc_html_e('Software Intelligence helps with...', 'shanayn-labs'); ?></span>
                    </div>

                    <?php foreach ($software_use_cases as $software_use_case) : ?>
                        <div class="si-use-cases-row" role="listitem" tabindex="0">
                            <p class="si-use-cases-need"><?php echo esc_html($software_use_case['need']); ?></p>
                            <span class="si-use-cases-arrow" aria-hidden="true">&rarr;</span>
                            <div class="si-use-cases-solution">
                                <p class="si-use-cases-solution-text"><?php echo esc_html($software_use_case['solution']); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <?php
        $si_featured_work_post = null;
        $si_featured_work_query = new WP_Query(
            array(
                'post_type' => 'shanaynlabs_work',
                'post_status' => 'publish',
                'posts_per_page' => 10,
                'meta_query' => array(
                    array(
                        'key' => '_shanaynlabs_featured_work',
                        'value' => '1',
                        'compare' => '=',
                    ),
                ),
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );

        if ($si_featured_work_query->have_posts()) {
            $si_software_terms = array('software', 'dashboard', 'dashboards', 'crm', 'pos', 'automation', 'ai', 'internal tool', 'internal tools');

            foreach ($si_featured_work_query->posts as $si_work_candidate) {
                $si_candidate_type = get_post_meta($si_work_candidate->ID, '_shanaynlabs_project_type', true);
                $si_candidate_result = get_post_meta($si_work_candidate->ID, '_shanaynlabs_result_summary', true);
                $si_candidate_text = strtolower(
                    wp_strip_all_tags(
                        $si_candidate_type . ' ' . $si_candidate_result . ' ' . get_the_title($si_work_candidate->ID)
                    )
                );

                foreach ($si_software_terms as $si_software_term) {
                    if (preg_match('/\b' . preg_quote($si_software_term, '/') . '\b/', $si_candidate_text)) {
                        $si_featured_work_post = $si_work_candidate;
                        break 2;
                    }
                }
            }

            if (!$si_featured_work_post) {
                $si_featured_work_post = $si_featured_work_query->posts[0];
            }
        }

        $si_featured_work_id = $si_featured_work_post ? $si_featured_work_post->ID : 0;
        $si_featured_work_label = __('FEATURED SOFTWARE INTELLIGENCE WORK', 'shanayn-labs');
        $si_featured_work_title = __('Business operations dashboard', 'shanayn-labs');
        $si_featured_work_description = __('A structured internal system designed to organize customer activity, sales data, reporting, and daily business workflows in one clean interface.', 'shanayn-labs');
        $si_featured_work_url = home_url('/work/');
        $si_featured_work_has_image = false;
        $si_featured_work_image = '';
        $si_featured_work_tags = array(
            __('CRM', 'shanayn-labs'),
            __('Dashboard', 'shanayn-labs'),
            __('Workflow Automation', 'shanayn-labs'),
            __('Reporting', 'shanayn-labs'),
            __('Internal Tools', 'shanayn-labs'),
        );

        if ($si_featured_work_id) {
            $si_project_type = get_post_meta($si_featured_work_id, '_shanaynlabs_project_type', true);
            $si_result_summary = get_post_meta($si_featured_work_id, '_shanaynlabs_result_summary', true);
            $si_project_url = get_post_meta($si_featured_work_id, '_shanaynlabs_project_url', true);

            if (!empty($si_project_type)) {
                $si_featured_work_label = $si_project_type;
            }

            $si_featured_work_title = get_the_title($si_featured_work_id);

            if (!empty($si_result_summary)) {
                $si_featured_work_description = $si_result_summary;
            } elseif (has_excerpt($si_featured_work_id)) {
                $si_featured_work_description = get_the_excerpt($si_featured_work_id);
            } elseif (!empty($si_featured_work_post->post_content)) {
                $si_featured_work_description = wp_trim_words(wp_strip_all_tags($si_featured_work_post->post_content), 24, '...');
            }

            if (!empty($si_project_url)) {
                $si_featured_work_url = 0 === strpos($si_project_url, '/') ? home_url($si_project_url) : $si_project_url;
            } else {
                $si_featured_work_url = get_permalink($si_featured_work_id);
            }

            if (has_post_thumbnail($si_featured_work_id)) {
                $si_featured_work_has_image = true;
                $si_thumbnail_id = get_post_thumbnail_id($si_featured_work_id);
                $si_thumbnail_alt = get_post_meta($si_thumbnail_id, '_wp_attachment_image_alt', true);

                if (empty($si_thumbnail_alt)) {
                    $si_thumbnail_alt = sprintf(
                        /* translators: %s: project title */
                        __('%s software project preview', 'shanayn-labs'),
                        $si_featured_work_title
                    );
                }

                $si_featured_work_image = get_the_post_thumbnail(
                    $si_featured_work_id,
                    'large',
                    array(
                        'class' => 'si-software-dashboard-image',
                        'alt' => $si_thumbnail_alt,
                        'loading' => 'lazy',
                    )
                );
            }
        }

        wp_reset_postdata();
        ?>

        <section class="si-featured-work" aria-labelledby="si-featured-work-heading" data-animate>
            <div class="container si-featured-work-inner">
                <article class="si-featured-work-card">
                    <div class="si-featured-work-content">
                        <p class="si-featured-work-label"><?php echo esc_html($si_featured_work_label); ?></p>
                        <h2 id="si-featured-work-heading" class="si-featured-work-title"><?php echo esc_html($si_featured_work_title); ?></h2>
                        <p class="si-featured-work-description"><?php echo esc_html($si_featured_work_description); ?></p>

                        <div class="si-featured-work-tags" aria-label="<?php echo esc_attr__('Software work focus areas', 'shanayn-labs'); ?>">
                            <?php foreach ($si_featured_work_tags as $si_featured_work_tag) : ?>
                                <span class="si-featured-work-tag"><?php echo esc_html($si_featured_work_tag); ?></span>
                            <?php endforeach; ?>
                        </div>

                        <a class="si-featured-work-cta" href="<?php echo esc_url($si_featured_work_url); ?>">
                            <?php esc_html_e('View project', 'shanayn-labs'); ?>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>

                    <div class="si-featured-work-visual">
                        <div class="si-software-dashboard">
                            <div class="si-software-dashboard-frame">
                                <div class="si-software-dashboard-header" aria-hidden="true">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <strong><?php esc_html_e('Operations Preview', 'shanayn-labs'); ?></strong>
                                </div>

                                <div class="si-software-dashboard-content">
                                    <?php if ($si_featured_work_has_image && !empty($si_featured_work_image)) : ?>
                                        <?php echo $si_featured_work_image; ?>
                                    <?php else : ?>
                                        <div class="si-software-dashboard-fallback" aria-hidden="true">
                                            <div class="si-software-panel si-software-home-screen">
                                                <strong><?php esc_html_e('Dashboard Home', 'shanayn-labs'); ?></strong>
                                                <span></span><span></span><span></span>
                                            </div>
                                            <div class="si-software-panel si-software-kpis">
                                                <strong><?php esc_html_e('KPI Cards', 'shanayn-labs'); ?></strong>
                                                <div><span></span><span></span><span></span></div>
                                            </div>
                                            <div class="si-software-panel si-software-customer-table">
                                                <strong><?php esc_html_e('Customer Table', 'shanayn-labs'); ?></strong>
                                                <em></em><em></em><em></em><em></em>
                                            </div>
                                            <div class="si-software-panel si-software-activity">
                                                <strong><?php esc_html_e('Activity Timeline', 'shanayn-labs'); ?></strong>
                                                <span></span><span></span><span></span>
                                            </div>
                                            <div class="si-software-panel si-software-automation">
                                                <strong><?php esc_html_e('Automation Status', 'shanayn-labs'); ?></strong>
                                                <span></span><span></span>
                                            </div>
                                            <div class="si-software-panel si-software-ai-panel">
                                                <strong><?php esc_html_e('AI Assistant', 'shanayn-labs'); ?></strong>
                                                <span></span><span></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <?php
        // Pricing section renders only when packages exist for the current service pillar.
        $render_pillar_pricing_section();
        ?>

        <section class="si-final-cta" aria-labelledby="si-final-cta-heading" data-animate>
            <span class="si-final-cta-grid" aria-hidden="true"></span>
            <span class="si-final-cta-glow" aria-hidden="true"></span>
            <span class="si-final-workflow-line" aria-hidden="true"></span>

            <div class="container si-final-cta-inner">
                <div class="si-final-cta-content">
                    <p class="si-final-cta-kicker"><?php esc_html_e('READY TO BUILD SMARTER OPERATIONS?', 'shanayn-labs'); ?></p>
                    <h2 id="si-final-cta-heading" class="si-final-cta-title"><?php esc_html_e("Let's create software that helps your business work faster, cleaner, and smarter.", 'shanayn-labs'); ?></h2>
                    <p class="si-final-cta-description"><?php esc_html_e('Start with a focused conversation about your workflow, current tools, and the system your business actually needs.', 'shanayn-labs'); ?></p>

                    <div class="si-final-cta-actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary si-final-cta-button">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </div>

                <div class="si-final-cta-visual" aria-hidden="true">
                    <div class="si-final-nodes">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <div class="si-final-dashboard">
                        <div class="si-final-dashboard-header">
                            <span></span>
                            <span></span>
                            <span></span>
                            <strong><?php esc_html_e('Operations System', 'shanayn-labs'); ?></strong>
                        </div>
                        <div class="si-final-dashboard-body">
                            <div class="si-final-kpi-row">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="si-final-reporting-line">
                                <svg viewBox="0 0 260 86" focusable="false">
                                    <path d="M10 62C42 60 52 45 80 48C112 52 119 26 150 31C182 36 198 17 250 20"></path>
                                </svg>
                            </div>
                            <div class="si-final-workflow-status">
                                <strong><?php esc_html_e('Workflow Status', 'shanayn-labs'); ?></strong>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="si-final-ai-block">
                                <strong><?php esc_html_e('AI Assistant', 'shanayn-labs'); ?></strong>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php else : ?>
        <section class="pillar-fallback-hero" aria-labelledby="pillar-fallback-heading" data-animate>
            <div class="container pillar-fallback-inner">
                <p class="pillar-fallback-eyebrow"><?php esc_html_e('SERVICE PILLAR', 'shanayn-labs'); ?></p>
                <h1 id="pillar-fallback-heading"><?php echo esc_html($term_name); ?></h1>
                <?php if (!empty($term_description)) : ?>
                    <p><?php echo esc_html(wp_strip_all_tags($term_description)); ?></p>
                <?php endif; ?>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary">
                    <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                </a>
            </div>
        </section>

        <?php
        // Pricing section renders only when packages exist for the current service pillar.
        $render_pillar_pricing_section();
        ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
