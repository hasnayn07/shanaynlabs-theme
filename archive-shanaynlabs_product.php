<?php
if (!defined('ABSPATH')) {
    exit;
}

$featured_product_query = new WP_Query(
    array(
        'post_type'      => 'shanaynlabs_product',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'meta_query'     => array(
            array(
                'key'   => '_shanaynlabs_featured_product',
                'value' => '1',
            ),
        ),
    )
);

$product_explorer_query = new WP_Query(
    array(
        'post_type'      => 'shanaynlabs_product',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    )
);

$product_categories = get_terms(
    array(
        'taxonomy'   => 'shanayn_product_category',
        'hide_empty' => true,
    )
);

$contact_url = home_url('/contact/');
$services_url = home_url('/services/');

get_header();
?>

<main id="main-content" class="site-main products-page">
    <section class="section archive-page" aria-labelledby="products-archive-heading">
        <div class="container">
            <section class="products-hero" aria-labelledby="products-archive-heading">
                <div class="products-hero-inner">
                    <div class="products-hero-content" data-animate>
                        <p class="eyebrow"><?php esc_html_e('PRODUCTS', 'shanayn-labs'); ?></p>
                        <h1 id="products-archive-heading">
                            <?php esc_html_e('Software and AI products built for smarter business operations.', 'shanayn-labs'); ?>
                        </h1>
                        <p class="hero-text">
                            <?php esc_html_e('Explore ready-built systems, dashboards, CRMs, automation tools, and AI products that can be customized for real business workflows.', 'shanayn-labs'); ?>
                        </p>
                    </div>

                    <div class="products-hero-visual" aria-hidden="true" data-animate>
                        <div class="products-hero-surface">
                            <div class="products-hero-surface-bar">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <div class="products-hero-surface-body">
                                <div class="products-hero-metrics">
                                    <div class="products-hero-metric">
                                        <small><?php esc_html_e('Workflows', 'shanayn-labs'); ?></small>
                                        <strong><?php esc_html_e('18 Active', 'shanayn-labs'); ?></strong>
                                    </div>
                                    <div class="products-hero-metric">
                                        <small><?php esc_html_e('Automation', 'shanayn-labs'); ?></small>
                                        <strong><?php esc_html_e('92% Synced', 'shanayn-labs'); ?></strong>
                                    </div>
                                    <div class="products-hero-metric">
                                        <small><?php esc_html_e('AI Assist', 'shanayn-labs'); ?></small>
                                        <strong><?php esc_html_e('Live Actions', 'shanayn-labs'); ?></strong>
                                    </div>
                                </div>

                                <div class="products-hero-dashboard">
                                    <div class="products-hero-chart">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="products-hero-panels">
                                        <div class="products-hero-panel">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="products-hero-flow">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ($featured_product_query->have_posts()) : ?>
                <?php while ($featured_product_query->have_posts()) : ?>
                    <?php
                    $featured_product_query->the_post();

                    $product_type = get_post_meta(get_the_ID(), '_shanaynlabs_product_type', true);
                    $product_status = get_post_meta(get_the_ID(), '_shanaynlabs_product_status', true);
                    $demo_url = get_post_meta(get_the_ID(), '_shanaynlabs_demo_url', true);
                    $product_features_raw = get_post_meta(get_the_ID(), '_shanaynlabs_product_features', true);
                    $product_category_terms = get_the_terms(get_the_ID(), 'shanayn_product_category');
                    $product_category_label = '';
                    $product_feature_lines = preg_split('/\r\n|\r|\n/', (string) $product_features_raw);
                    $product_features = array();

                    if (!is_wp_error($product_category_terms) && !empty($product_category_terms)) {
                        $product_category_label = $product_category_terms[0]->name;
                    }

                    if (is_array($product_feature_lines)) {
                        foreach ($product_feature_lines as $product_feature_line) {
                            $product_feature_line = sanitize_text_field($product_feature_line);

                            if ('' !== $product_feature_line) {
                                $product_features[] = $product_feature_line;
                            }
                        }
                    }
                    ?>
                    <section class="featured-product" aria-labelledby="featured-product-title">
                        <div class="featured-product-inner">
                            <div class="featured-product-content">
                                <?php if ($product_category_label || $product_status) : ?>
                                    <p class="card-kicker">
                                        <?php if ($product_category_label) : ?>
                                            <?php echo esc_html($product_category_label); ?>
                                        <?php endif; ?>
                                        <?php if ($product_category_label && $product_status) : ?>
                                            <span aria-hidden="true"> / </span>
                                        <?php endif; ?>
                                        <?php if ($product_status) : ?>
                                            <?php echo esc_html($product_status); ?>
                                        <?php endif; ?>
                                    </p>
                                <?php endif; ?>

                                <h2 id="featured-product-title"><?php echo esc_html(get_the_title()); ?></h2>

                                <?php if (has_excerpt()) : ?>
                                    <p class="hero-text"><?php echo esc_html(get_the_excerpt()); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($product_features)) : ?>
                                    <div class="featured-product-tags">
                                        <?php foreach ($product_features as $product_feature) : ?>
                                            <span><?php echo esc_html($product_feature); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="featured-product-actions">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="btn-primary">
                                        <?php esc_html_e('View Product', 'shanayn-labs'); ?>
                                    </a>

                                    <?php if ($demo_url) : ?>
                                        <a href="<?php echo esc_url($demo_url); ?>" class="text-link">
                                            <?php esc_html_e('Request Demo', 'shanayn-labs'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="featured-product-preview">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php
                                        echo get_the_post_thumbnail(
                                            get_the_ID(),
                                            'large',
                                            array(
                                                'class' => 'archive-card-image',
                                                'alt'   => esc_attr(get_the_title()),
                                            )
                                        );
                                        ?>
                                    </a>
                                <?php else : ?>
                                    <div class="featured-product-preview-fallback" aria-hidden="true">
                                        <div class="featured-product-preview-bar">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                        <div class="featured-product-preview-body">
                                            <div class="featured-product-preview-panel">
                                                <span></span>
                                                <strong><?php echo esc_html($product_type ? $product_type : __('Product System', 'shanayn-labs')); ?></strong>
                                            </div>
                                            <div class="featured-product-preview-grid">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                            <div class="featured-product-preview-flow">
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php endif; ?>

            <?php if ($product_explorer_query->have_posts()) : ?>
                <section class="product-explorer" aria-labelledby="product-explorer-heading" data-product-explorer>
                    <div class="section-header products-showcase-header">
                        <div>
                            <p class="eyebrow"><?php esc_html_e('PRODUCT EXPLORER', 'shanayn-labs'); ?></p>
                            <h2 id="product-explorer-heading"><?php esc_html_e('Browse products by system type.', 'shanayn-labs'); ?></h2>
                        </div>
                    </div>

                    <div class="product-filter-menu" role="tablist" aria-label="<?php esc_attr_e('Product category filters', 'shanayn-labs'); ?>">
                        <button
                            type="button"
                            class="product-filter-button is-active"
                            data-product-filter="all"
                            role="tab"
                            aria-selected="true"
                            tabindex="0"
                        >
                            <?php esc_html_e('Show All', 'shanayn-labs'); ?>
                        </button>

                        <?php if (!is_wp_error($product_categories) && !empty($product_categories)) : ?>
                            <?php foreach ($product_categories as $product_category) : ?>
                                <button
                                    type="button"
                                    class="product-filter-button"
                                    data-product-filter="<?php echo esc_attr($product_category->slug); ?>"
                                    role="tab"
                                    aria-selected="false"
                                    tabindex="-1"
                                >
                                    <?php echo esc_html($product_category->name); ?>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="product-grid" data-product-grid>
                        <?php while ($product_explorer_query->have_posts()) : ?>
                            <?php
                            $product_explorer_query->the_post();

                            $product_status = get_post_meta(get_the_ID(), '_shanaynlabs_product_status', true);
                            $demo_url = get_post_meta(get_the_ID(), '_shanaynlabs_demo_url', true);
                            $product_features_raw = get_post_meta(get_the_ID(), '_shanaynlabs_product_features', true);
                            $product_feature_lines = preg_split('/\r\n|\r|\n/', (string) $product_features_raw);
                            $product_features = array();
                            $product_terms = get_the_terms(get_the_ID(), 'shanayn_product_category');
                            $product_term_names = array();
                            $product_term_slugs = array();
                            $primary_product_category = '';
                            $primary_product_category_slug = 'uncategorized';
                            $primary_link_text = __('View Product', 'shanayn-labs');

                            if (!is_wp_error($product_terms) && !empty($product_terms)) {
                                foreach ($product_terms as $product_term) {
                                    $product_term_names[] = $product_term->name;
                                    $product_term_slugs[] = $product_term->slug;
                                }

                                $primary_product_category = $product_terms[0]->name;
                                $primary_product_category_slug = $product_terms[0]->slug;
                            }

                            if (is_array($product_feature_lines)) {
                                foreach ($product_feature_lines as $product_feature_line) {
                                    $product_feature_line = sanitize_text_field($product_feature_line);

                                    if ('' !== $product_feature_line) {
                                        $product_features[] = $product_feature_line;
                                    }
                                }
                            }

                            $visible_product_features = array_slice($product_features, 0, 3);
                            $extra_product_features = max(0, count($product_features) - count($visible_product_features));

                            if ('coming-soon' === sanitize_title($product_status)) {
                                $primary_link_text = __('Request Info', 'shanayn-labs');
                            }
                            ?>
                            <article
                                id="post-<?php echo esc_attr(get_the_ID()); ?>"
                                <?php post_class('product-card', get_the_ID()); ?>
                                data-product-card
                                data-product-category="<?php echo esc_attr(implode(' ', $product_term_slugs)); ?>"
                                data-product-primary-category="<?php echo esc_attr($primary_product_category_slug); ?>"
                            >
                                <div class="product-card-preview">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php
                                            echo get_the_post_thumbnail(
                                                get_the_ID(),
                                                'large',
                                                array(
                                                    'class' => 'product-card-image',
                                                    'alt'   => esc_attr(get_the_title()),
                                                )
                                            );
                                            ?>
                                        <?php else : ?>
                                            <div class="product-card-fallback" aria-hidden="true">
                                                <div class="product-card-fallback-bar">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                                <div class="product-card-fallback-body">
                                                    <span></span>
                                                    <strong><?php echo esc_html($primary_product_category ? $primary_product_category : __('Product System', 'shanayn-labs')); ?></strong>
                                                    <div class="product-card-fallback-grid">
                                                        <span></span>
                                                        <span></span>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="product-card-content">
                                    <?php if ($primary_product_category || $product_status) : ?>
                                        <div class="product-card-meta">
                                            <?php if ($primary_product_category) : ?>
                                                <p class="card-kicker"><?php echo esc_html($primary_product_category); ?></p>
                                            <?php endif; ?>
                                            <?php if ($product_status) : ?>
                                                <span class="product-card-status"><?php echo esc_html($product_status); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <h3 class="card-title">
                                        <a href="<?php echo esc_url(get_permalink()); ?>">
                                            <?php echo esc_html(get_the_title()); ?>
                                        </a>
                                    </h3>

                                    <?php if (has_excerpt()) : ?>
                                        <p class="card-text"><?php echo esc_html(get_the_excerpt()); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($visible_product_features) || $extra_product_features > 0) : ?>
                                        <div class="product-card-tags">
                                            <?php foreach ($visible_product_features as $visible_product_feature) : ?>
                                                <span><?php echo esc_html($visible_product_feature); ?></span>
                                            <?php endforeach; ?>
                                            <?php if ($extra_product_features > 0) : ?>
                                                <span><?php echo esc_html(sprintf(__('+%d', 'shanayn-labs'), $extra_product_features)); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="featured-product-actions">
                                        <a href="<?php echo esc_url(get_permalink()); ?>" class="text-link">
                                            <?php echo esc_html($primary_link_text); ?>
                                        </a>

                                        <?php if ($demo_url) : ?>
                                            <a href="<?php echo esc_url($demo_url); ?>" class="text-link">
                                                <?php esc_html_e('Request Demo', 'shanayn-labs'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                    <div class="product-load-more-wrap" data-product-load-more-wrap>
                        <button type="button" class="product-load-more" data-product-load-more>
                            <?php esc_html_e('Load More', 'shanayn-labs'); ?>
                        </button>
                    </div>
                </section>
            <?php endif; ?>

            <section class="products-final-cta" aria-labelledby="products-final-cta-title">
                <div class="products-final-cta-inner">
                    <p class="eyebrow"><?php esc_html_e('READY TO CUSTOMIZE A SYSTEM?', 'shanayn-labs'); ?></p>
                    <h2 id="products-final-cta-title"><?php esc_html_e("Let's shape a product around your business workflow.", 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('Start with a focused conversation about your operations, team, customers, and the software system you need.', 'shanayn-labs'); ?></p>
                    <div class="products-final-cta-actions">
                        <a class="btn-primary" href="<?php echo esc_url($contact_url); ?>">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                        <a class="text-link" href="<?php echo esc_url($services_url); ?>">
                            <?php esc_html_e('Explore Services', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </section>
</main>

<?php get_footer(); ?>

