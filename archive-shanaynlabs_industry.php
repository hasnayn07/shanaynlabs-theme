<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main">
    <section class="section archive-page" aria-labelledby="industries-archive-heading">
        <div class="container">
            <header class="section-header">
                <p class="eyebrow"><?php esc_html_e('Industries', 'shanayn-labs'); ?></p>
                <h1 id="industries-archive-heading"><?php esc_html_e('Digital systems for focused industries.', 'shanayn-labs'); ?></h1>
                <p><?php esc_html_e('Browse industries where ShanaynLabs helps teams improve visibility, operations, and growth systems.', 'shanayn-labs'); ?></p>
            </header>

            <?php if (have_posts()) : ?>
                <div class="grid grid-3 archive-grid">
                    <?php while (have_posts()) : ?>
                        <?php
                        the_post();

                        $industry_description = get_post_meta(get_the_ID(), '_shanaynlabs_industry_short_description', true);
                        ?>
                        <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('card archive-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php echo esc_url(get_permalink()); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                    <?php
                                    echo get_the_post_thumbnail(
                                        get_the_ID(),
                                        'medium_large',
                                        array(
                                            'class' => 'archive-card-image',
                                            'alt' => esc_attr(get_the_title()),
                                        )
                                    );
                                    ?>
                                </a>
                            <?php endif; ?>

                            <div class="card-body">
                                <p class="card-kicker"><?php esc_html_e('Industry', 'shanayn-labs'); ?></p>

                                <h2 class="card-title">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                        <?php echo esc_html(get_the_title()); ?>
                                    </a>
                                </h2>

                                <?php if ($industry_description) : ?>
                                    <p class="card-text"><?php echo esc_html($industry_description); ?></p>
                                <?php elseif (has_excerpt()) : ?>
                                    <p class="card-text"><?php echo esc_html(get_the_excerpt()); ?></p>
                                <?php endif; ?>

                                <a href="<?php echo esc_url(get_permalink()); ?>" class="text-link">
                                    <?php esc_html_e('Learn More', 'shanayn-labs'); ?>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e('No industries are available yet.', 'shanayn-labs'); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
