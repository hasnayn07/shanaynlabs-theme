<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main">
    <?php while (have_posts()) : ?>
        <?php
        the_post();

        $industry_description = get_post_meta(get_the_ID(), '_shanaynlabs_industry_short_description', true);
        ?>

        <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('section single-entry'); ?>>
            <div class="container">
                <header class="single-header">
                    <p class="eyebrow"><?php esc_html_e('Industry', 'shanayn-labs'); ?></p>

                    <h1><?php echo esc_html(get_the_title()); ?></h1>

                    <?php if ($industry_description) : ?>
                        <p class="hero-text"><?php echo esc_html($industry_description); ?></p>
                    <?php elseif (has_excerpt()) : ?>
                        <p class="hero-text"><?php echo esc_html(get_the_excerpt()); ?></p>
                    <?php endif; ?>
                </header>

                <?php if (has_post_thumbnail()) : ?>
                    <figure class="single-media">
                        <?php
                        echo get_the_post_thumbnail(
                            get_the_ID(),
                            'large',
                            array(
                                'class' => 'single-featured-image',
                                'alt' => esc_attr(get_the_title()),
                            )
                        );
                        ?>
                    </figure>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
