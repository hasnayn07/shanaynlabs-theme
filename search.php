<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main">
    <section class="section archive-page" aria-labelledby="search-heading">
        <div class="container">
            <header class="section-header">
                <p class="eyebrow"><?php esc_html_e('Search', 'shanayn-labs'); ?></p>
                <h1 id="search-heading">
                    <?php
                    printf(
                        /* translators: %s: Search query. */
                        esc_html__('Search results for: %s', 'shanayn-labs'),
                        esc_html(get_search_query())
                    );
                    ?>
                </h1>
            </header>

            <div class="search-panel">
                <?php get_search_form(); ?>
            </div>

            <?php if (have_posts()) : ?>
                <div class="grid grid-3 archive-grid">
                    <?php
                    while (have_posts()) :
                        the_post();

                        $post_type = get_post_type();
                        $post_type_object = get_post_type_object($post_type);
                        $post_type_label = $post_type_object && !empty($post_type_object->labels->singular_name)
                            ? $post_type_object->labels->singular_name
                            : __('Result', 'shanayn-labs');
                        $result_excerpt = wp_trim_words(wp_strip_all_tags(get_the_excerpt()), 22);
                        ?>
                        <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('card archive-card'); ?>>
                            <div class="card-body">
                                <p class="card-kicker"><?php echo esc_html($post_type_label); ?></p>

                                <h2 class="card-title">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </h2>

                                <?php if ($result_excerpt) : ?>
                                    <p class="card-text"><?php echo esc_html($result_excerpt); ?></p>
                                <?php endif; ?>

                                <a href="<?php echo esc_url(get_permalink()); ?>" class="text-link">
                                    <?php esc_html_e('View Result', 'shanayn-labs'); ?>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                the_posts_pagination(
                    array(
                        'mid_size' => 1,
                        'prev_text' => esc_html__('Previous', 'shanayn-labs'),
                        'next_text' => esc_html__('Next', 'shanayn-labs'),
                    )
                );
                ?>
            <?php else : ?>
                <div class="card search-empty">
                    <div class="card-body">
                        <h2 class="card-title"><?php esc_html_e('No results found.', 'shanayn-labs'); ?></h2>
                        <p class="card-text"><?php esc_html_e('Try a different keyword, or explore Services and Work from the navigation.', 'shanayn-labs'); ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
