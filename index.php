<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : ?>
                <?php the_post(); ?>

                <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class(); ?>>
                    <h1><?php echo esc_html(get_the_title()); ?></h1>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <h1><?php esc_html_e('Shanayn Labs', 'shanayn-labs'); ?></h1>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
