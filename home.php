<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$paged = max(1, absint(get_query_var('paged')), absint(get_query_var('page')));
$posts_per_page = (int) get_option('posts_per_page');

if ($posts_per_page < 1) {
    $posts_per_page = 6;
}

$featured_post_query = new WP_Query(
    array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'no_found_rows' => true,
        'ignore_sticky_posts' => true,
    )
);

$featured_post_id = 0;

if ($featured_post_query->have_posts()) {
    $featured_post_id = (int) $featured_post_query->posts[0]->ID;
}

$articles_query = new WP_Query(
    array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'post__not_in' => $featured_post_id ? array($featured_post_id) : array(),
        'ignore_sticky_posts' => true,
    )
);
?>

<main id="main-content" class="site-main blog-page">
    <section class="blog-hero" aria-labelledby="blog-hero-heading" data-animate>
        <div class="container blog-hero-inner">
            <div class="blog-hero-copy">
                <p class="blog-eyebrow"><?php esc_html_e('INSIGHTS', 'shanayn-labs'); ?></p>
                <h1 id="blog-hero-heading" class="blog-hero-title"><?php esc_html_e('Ideas on websites, growth, software, and AI systems.', 'shanayn-labs'); ?></h1>
                <p class="blog-hero-description"><?php esc_html_e('Practical guides and thoughts for businesses that want to improve their digital presence, marketing, operations, and automation.', 'shanayn-labs'); ?></p>
            </div>

            <div class="blog-hero-visual" aria-hidden="true">
                <span class="blog-hero-orbit"></span>
                <div class="blog-hero-note blog-hero-note-web">
                    <strong><?php esc_html_e('Websites', 'shanayn-labs'); ?></strong>
                    <span></span><span></span>
                </div>
                <div class="blog-hero-note blog-hero-note-growth">
                    <strong><?php esc_html_e('Growth', 'shanayn-labs'); ?></strong>
                    <span></span><span></span>
                </div>
                <div class="blog-hero-note blog-hero-note-systems">
                    <strong><?php esc_html_e('Systems', 'shanayn-labs'); ?></strong>
                    <span></span><span></span>
                </div>
            </div>
        </div>
    </section>

    <?php if ($featured_post_query->have_posts()) : ?>
        <section class="blog-featured" aria-labelledby="blog-featured-heading" data-animate>
            <div class="container">
                <?php
                $featured_post_query->the_post();
                $featured_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 28, '...');
                ?>

                <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('blog-featured-card'); ?>>
                    <div class="blog-featured-content">
                        <p class="blog-eyebrow"><?php esc_html_e('FEATURED ARTICLE', 'shanayn-labs'); ?></p>
                        <p class="blog-post-date"><?php echo esc_html(get_the_date()); ?></p>
                        <h2 id="blog-featured-heading" class="blog-featured-title">
                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                        </h2>
                        <?php if (!empty($featured_excerpt)) : ?>
                            <p class="blog-featured-excerpt"><?php echo esc_html($featured_excerpt); ?></p>
                        <?php endif; ?>
                        <a class="blog-text-link" href="<?php echo esc_url(get_permalink()); ?>">
                            <?php esc_html_e('Read article', 'shanayn-labs'); ?>
                            <span aria-hidden="true">&rarr;</span>
                        </a>
                    </div>

                    <div class="blog-featured-media">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php
                            echo get_the_post_thumbnail(
                                get_the_ID(),
                                'large',
                                array(
                                    'class' => 'blog-featured-image',
                                    'alt' => esc_attr(get_the_title()),
                                    'loading' => 'lazy',
                                )
                            );
                            ?>
                        <?php else : ?>
                            <div class="blog-image-placeholder blog-image-placeholder-featured" aria-hidden="true">
                                <span></span><span></span><span></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>

                <?php wp_reset_postdata(); ?>
            </div>
        </section>
    <?php endif; ?>

    <section class="blog-latest" aria-labelledby="blog-latest-heading" data-animate>
        <div class="container">
            <header class="blog-section-header">
                <p class="blog-eyebrow"><?php esc_html_e('LATEST ARTICLES', 'shanayn-labs'); ?></p>
                <h2 id="blog-latest-heading"><?php esc_html_e('Fresh thinking for practical digital systems.', 'shanayn-labs'); ?></h2>
            </header>

            <?php if ($articles_query->have_posts()) : ?>
                <div class="blog-grid">
                    <?php while ($articles_query->have_posts()) : ?>
                        <?php
                        $articles_query->the_post();
                        $article_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 20, '...');
                        ?>

                        <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('blog-card'); ?>>
                            <a class="blog-card-media" href="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php
                                    echo get_the_post_thumbnail(
                                        get_the_ID(),
                                        'medium_large',
                                        array(
                                            'class' => 'blog-card-image',
                                            'alt' => esc_attr(get_the_title()),
                                            'loading' => 'lazy',
                                        )
                                    );
                                    ?>
                                <?php else : ?>
                                    <span class="blog-image-placeholder blog-card-placeholder" aria-hidden="true">
                                        <span></span><span></span><span></span>
                                    </span>
                                <?php endif; ?>
                            </a>

                            <div class="blog-card-body">
                                <p class="blog-post-date"><?php echo esc_html(get_the_date()); ?></p>
                                <h3 class="blog-card-title">
                                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                </h3>
                                <?php if (!empty($article_excerpt)) : ?>
                                    <p class="blog-card-excerpt"><?php echo esc_html($article_excerpt); ?></p>
                                <?php endif; ?>
                                <a class="blog-text-link" href="<?php echo esc_url(get_permalink()); ?>">
                                    <?php esc_html_e('Read article', 'shanayn-labs'); ?>
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                $original_wp_query = $GLOBALS['wp_query'];
                $GLOBALS['wp_query'] = $articles_query;

                the_posts_pagination(
                    array(
                        'class' => 'blog-pagination',
                        'mid_size' => 1,
                        'prev_text' => __('Previous', 'shanayn-labs'),
                        'next_text' => __('Next', 'shanayn-labs'),
                    )
                );

                $GLOBALS['wp_query'] = $original_wp_query;
                ?>

                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p class="blog-empty"><?php esc_html_e('No additional articles are available yet.', 'shanayn-labs'); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="blog-final-cta" aria-labelledby="blog-final-cta-heading" data-animate>
        <div class="container blog-final-cta-inner">
            <p class="blog-eyebrow"><?php esc_html_e('NEED A DIGITAL SYSTEM BEHIND YOUR IDEAS?', 'shanayn-labs'); ?></p>
            <h2 id="blog-final-cta-heading"><?php esc_html_e("Let's turn your website, marketing, software, or AI idea into a practical business system.", 'shanayn-labs'); ?></h2>
            <a class="btn-primary blog-final-cta-button" href="<?php echo esc_url(home_url('/contact/')); ?>">
                <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
            </a>
        </div>
    </section>
</main>

<?php
wp_reset_postdata();
get_footer();
