<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main">
    <section class="section archive-page" aria-labelledby="not-found-heading">
        <div class="container">
            <div class="section-header">
                <p class="eyebrow"><?php esc_html_e('404', 'shanayn-labs'); ?></p>
                <h1 id="not-found-heading"><?php esc_html_e('This page could not be found.', 'shanayn-labs'); ?></h1>
                <p><?php esc_html_e('The page may have moved, or the URL may be incorrect. Start with one of the links below.', 'shanayn-labs'); ?></p>
            </div>

            <div class="button-group">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-primary">
                    <?php esc_html_e('Go Home', 'shanayn-labs'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn-secondary">
                    <?php esc_html_e('View Services', 'shanayn-labs'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-secondary">
                    <?php esc_html_e('Contact Us', 'shanayn-labs'); ?>
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
