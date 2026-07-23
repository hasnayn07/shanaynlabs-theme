<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main single-product-page">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php
            the_post();

            $product_id = get_the_ID();
            $product_type = get_post_meta($product_id, '_shanaynlabs_product_type', true);
            $product_status = get_post_meta($product_id, '_shanaynlabs_product_status', true);
            $demo_url = get_post_meta($product_id, '_shanaynlabs_demo_url', true);
            $product_features_raw = get_post_meta($product_id, '_shanaynlabs_product_features', true);
            $product_category_terms = get_the_terms($product_id, 'shanayn_product_category');
            $product_category_label = '';
            $product_features = array();
            $product_info_items = array();
            $product_feature_lines = preg_split('/\r\n|\r|\n|,/', (string) $product_features_raw);
            $primary_action_url = $demo_url ? $demo_url : home_url('/contact/');
            $primary_action_label = $demo_url ? __('Request Demo', 'shanayn-labs') : __('Book a Call', 'shanayn-labs');
            $product_preview_image = '';

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

                $product_features = array_values(array_unique($product_features));
            }

            if ($product_type) {
                $product_info_items[] = array(
                    'label' => __('TYPE', 'shanayn-labs'),
                    'value' => $product_type,
                );
            }

            if ($product_status) {
                $product_info_items[] = array(
                    'label' => __('STATUS', 'shanayn-labs'),
                    'value' => $product_status,
                );
            }

            if ($product_category_label) {
                $product_info_items[] = array(
                    'label' => __('CATEGORY', 'shanayn-labs'),
                    'value' => $product_category_label,
                );
            }

            if ($demo_url) {
                $product_info_items[] = array(
                    'label' => __('DEMO', 'shanayn-labs'),
                    'value' => __('Private Demo', 'shanayn-labs'),
                );
            }

            if (has_post_thumbnail($product_id)) {
                $product_preview_image = get_the_post_thumbnail(
                    $product_id,
                    'large',
                    array(
                        'class' => 'single-product-preview-image',
                        'alt' => esc_attr(get_the_title()),
                    )
                );
            }
            ?>

            <article id="post-<?php echo esc_attr($product_id); ?>" <?php post_class('single-product-article'); ?>>
                <section class="single-product-hero" aria-labelledby="single-product-title">
                    <div class="container single-product-hero-inner">
                        <header class="single-product-hero-content">
                            <?php if ($product_category_label || $product_status) : ?>
                                <div class="single-product-eyebrow">
                                    <?php if ($product_category_label) : ?>
                                        <span><?php echo esc_html($product_category_label); ?></span>
                                    <?php endif; ?>

                                    <?php if ($product_status) : ?>
                                        <span class="single-product-status"><?php echo esc_html($product_status); ?></span>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <h1 id="single-product-title" class="single-product-title"><?php echo esc_html(get_the_title()); ?></h1>

                            <?php if (has_excerpt($product_id)) : ?>
                                <p class="single-product-excerpt"><?php echo esc_html(get_the_excerpt($product_id)); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($product_features)) : ?>
                                <div class="single-product-tags" aria-label="<?php esc_attr_e('Product features', 'shanayn-labs'); ?>">
                                    <?php foreach ($product_features as $product_feature) : ?>
                                        <span><?php echo esc_html($product_feature); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <div class="single-product-actions">
                                <a class="btn-primary" href="<?php echo esc_url($primary_action_url); ?>">
                                    <?php echo esc_html($primary_action_label); ?>
                                </a>
                            </div>
                        </header>
                    </div>
                </section>

                <section class="single-product-preview" aria-label="<?php esc_attr_e('Product preview', 'shanayn-labs'); ?>">
                    <div class="container">
                        <div class="single-product-preview-frame">
                            <?php if (!empty($product_preview_image)) : ?>
                                <?php echo $product_preview_image; ?>
                            <?php else : ?>
                                <div class="single-product-preview-fallback">
                                    <span><?php esc_html_e('Product System Preview', 'shanayn-labs'); ?></span>
                                    <strong><?php echo esc_html(get_the_title()); ?></strong>
                                    <?php if ($product_category_label) : ?>
                                        <p><?php echo esc_html($product_category_label); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($product_info_items)) : ?>
                            <div class="single-product-info-strip" aria-label="<?php esc_attr_e('Product details', 'shanayn-labs'); ?>">
                                <?php foreach ($product_info_items as $product_info_item) : ?>
                                    <div class="single-product-info-item">
                                        <span class="single-product-info-label"><?php echo esc_html($product_info_item['label']); ?></span>
                                        <strong class="single-product-info-value"><?php echo esc_html($product_info_item['value']); ?></strong>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <section class="single-product-content">
                    <div class="container single-product-content-inner">
                        <div class="product-content-body">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>

                <section class="single-product-cta" aria-labelledby="single-product-cta-title">
                    <div class="container single-product-cta-inner">
                        <p class="single-product-cta-kicker"><?php esc_html_e('READY TO SEE HOW THIS PRODUCT FITS YOUR BUSINESS?', 'shanayn-labs'); ?></p>
                        <h2 id="single-product-cta-title" class="single-product-cta-title"><?php esc_html_e("Let's shape this system around your workflow.", 'shanayn-labs'); ?></h2>
                        <p class="single-product-cta-description"><?php esc_html_e('Start with a focused conversation about your operations, team, customers, and the software system you need.', 'shanayn-labs'); ?></p>

                        <div class="single-product-cta-actions">
                            <a class="btn-primary" href="<?php echo esc_url($primary_action_url); ?>">
                                <?php echo esc_html($primary_action_label); ?>
                            </a>
                            <a class="text-link" href="<?php echo esc_url(home_url('/products/')); ?>">
                                <?php esc_html_e('View All Products', 'shanayn-labs'); ?>
                            </a>
                        </div>
                    </div>
                </section>
            </article>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
