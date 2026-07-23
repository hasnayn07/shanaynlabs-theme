<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main single-post-page">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php
            the_post();

            $post_id = get_the_ID();
            $post_excerpt = has_excerpt($post_id) ? get_the_excerpt($post_id) : '';
            $post_has_content = '' !== trim((string) get_post_field('post_content', $post_id));
            ?>

            <article id="post-<?php echo esc_attr($post_id); ?>" <?php post_class('single-post-article'); ?>>
                <header class="single-post-hero" data-animate>
                    <div class="container single-post-hero-inner">
                        <p class="single-post-kicker"><?php esc_html_e('INSIGHT', 'shanayn-labs'); ?></p>
                        <p class="single-post-meta"><?php echo esc_html(get_the_date()); ?></p>
                        <h1 class="single-post-title"><?php echo esc_html(get_the_title()); ?></h1>

                        <?php if (!empty($post_excerpt)) : ?>
                            <p class="single-post-excerpt"><?php echo esc_html($post_excerpt); ?></p>
                        <?php endif; ?>
                    </div>
                </header>

                <?php if (has_post_thumbnail($post_id)) : ?>
                    <section class="single-post-image-section" data-animate>
                        <div class="container single-post-image-inner">
                            <?php
                            echo get_the_post_thumbnail(
                                $post_id,
                                'large',
                                array(
                                    'class' => 'single-post-featured-image',
                                    'alt' => esc_attr(get_the_title()),
                                    'loading' => 'eager',
                                )
                            );
                            ?>
                        </div>
                    </section>
                <?php endif; ?>

                <section class="single-post-content-section">
                    <div class="container single-post-content-wrap">
                        <div class="single-post-content">
                            <?php if ($post_has_content) : ?>
                                <?php the_content(); ?>
                            <?php elseif (is_user_logged_in() && current_user_can('edit_post', $post_id)) : ?>
                                <p class="single-post-empty-content"><?php esc_html_e('No post content added yet.', 'shanayn-labs'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </article>

            <?php
            $latest_posts_query = new WP_Query(
                array(
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'post__not_in' => array($post_id),
                    'no_found_rows' => true,
                    'ignore_sticky_posts' => true,
                )
            );
            ?>

            <?php if ($latest_posts_query->have_posts()) : ?>
                <section class="single-post-related" aria-labelledby="single-post-related-heading" data-animate>
                    <div class="container">
                        <header class="single-post-section-header">
                            <p class="single-post-kicker"><?php esc_html_e('LATEST ARTICLES', 'shanayn-labs'); ?></p>
                            <h2 id="single-post-related-heading"><?php esc_html_e('More insights from ShanaynLabs', 'shanayn-labs'); ?></h2>
                        </header>

                        <div class="single-post-related-grid">
                            <?php while ($latest_posts_query->have_posts()) : ?>
                                <?php
                                $latest_posts_query->the_post();
                                $related_excerpt = has_excerpt(get_the_ID()) ? get_the_excerpt(get_the_ID()) : wp_trim_words(wp_strip_all_tags(get_post_field('post_content', get_the_ID())), 20, '...');
                                ?>

                                <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('single-post-card'); ?>>
                                    <a class="single-post-card-media" href="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <?php
                                            echo get_the_post_thumbnail(
                                                get_the_ID(),
                                                'medium_large',
                                                array(
                                                    'class' => 'single-post-card-image',
                                                    'alt' => esc_attr(get_the_title()),
                                                    'loading' => 'lazy',
                                                )
                                            );
                                            ?>
                                        <?php else : ?>
                                            <span class="single-post-card-placeholder" aria-hidden="true">
                                                <span></span><span></span><span></span>
                                            </span>
                                        <?php endif; ?>
                                    </a>

                                    <div class="single-post-card-body">
                                        <p class="single-post-meta"><?php echo esc_html(get_the_date()); ?></p>
                                        <h3 class="single-post-card-title">
                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                        </h3>
                                        <?php if (!empty($related_excerpt)) : ?>
                                            <p class="single-post-card-excerpt"><?php echo esc_html($related_excerpt); ?></p>
                                        <?php endif; ?>
                                        <a class="single-post-text-link" href="<?php echo esc_url(get_permalink()); ?>">
                                            <?php esc_html_e('Read article', 'shanayn-labs'); ?>
                                            <span aria-hidden="true">&rarr;</span>
                                        </a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <?php wp_reset_postdata(); ?>

            <section class="single-post-final-cta" aria-labelledby="single-post-final-cta-heading" data-animate>
                <div class="container single-post-final-cta-inner">
                    <p class="single-post-kicker"><?php esc_html_e('READY TO BUILD SOMETHING PRACTICAL?', 'shanayn-labs'); ?></p>
                    <h2 id="single-post-final-cta-heading"><?php esc_html_e("Let's turn your website, marketing, software, or AI idea into a real business system.", 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('Start with a focused conversation about your goals, current challenges, and what your business needs next.', 'shanayn-labs'); ?></p>
                    <a class="btn-primary single-post-final-cta-button" href="<?php echo esc_url(home_url('/contact/')); ?>">
                        <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                    </a>
                </div>
            </section>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
