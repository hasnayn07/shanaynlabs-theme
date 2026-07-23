<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$contact_url = home_url('/contact/');
$work_archive_url = home_url('/work/');
?>

<main id="main-content" class="site-main single-work-page">
    <?php while (have_posts()) : ?>
        <?php
        the_post();

        $client_name = get_post_meta(get_the_ID(), '_shanaynlabs_client_name', true);
        $project_type = get_post_meta(get_the_ID(), '_shanaynlabs_project_type', true);
        $project_url = get_post_meta(get_the_ID(), '_shanaynlabs_project_url', true);
        $service_tags_raw = get_post_meta(get_the_ID(), '_shanaynlabs_work_service_tags', true);
        $pillar_terms = get_the_terms(get_the_ID(), 'service-pillar');
        $service_pillar_label = '';
        $tag_lines = preg_split('/\r\n|\r|\n/', (string) $service_tags_raw);
        $service_tags = array();

        if (!is_wp_error($pillar_terms) && !empty($pillar_terms)) {
            $service_pillar_label = $pillar_terms[0]->name;
        }

        if (is_array($tag_lines)) {
            foreach ($tag_lines as $tag_line) {
                $tag_line = sanitize_text_field($tag_line);

                if ('' !== $tag_line) {
                    $service_tags[] = $tag_line;
                }
            }
        }
        ?>

        <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('section single-entry'); ?>>
            <div class="container">
                <header class="single-header single-work-hero">
                    <?php if ($service_pillar_label) : ?>
                        <p class="single-work-eyebrow">
                            <?php echo esc_html($service_pillar_label); ?>
                        </p>
                    <?php endif; ?>

                    <h1 class="single-work-title"><?php echo esc_html(get_the_title()); ?></h1>

                    <?php if (has_excerpt()) : ?>
                        <p class="single-work-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 36, '...')); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($service_tags)) : ?>
                        <div class="single-work-tags">
                            <?php foreach ($service_tags as $service_tag) : ?>
                                <span class="single-work-tag"><?php echo esc_html($service_tag); ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($project_url) : ?>
                        <div class="single-work-actions">
                            <a href="<?php echo esc_url($project_url); ?>" class="btn-primary">
                                <?php esc_html_e('Visit Website', 'shanayn-labs'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </header>

                <section class="single-work-preview" aria-label="<?php esc_attr_e('Project preview', 'shanayn-labs'); ?>">
                    <div class="single-work-preview-frame">
                        <div class="single-work-browser-bar" aria-hidden="true">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <?php if (has_post_thumbnail()) : ?>
                            <?php
                            echo get_the_post_thumbnail(
                                get_the_ID(),
                                'large',
                                array(
                                    'class' => 'single-work-featured-image',
                                    'alt'   => esc_attr(get_the_title()),
                                )
                            );
                            ?>
                        <?php else : ?>
                            <div class="single-work-preview-fallback" aria-hidden="true">
                                <span><?php esc_html_e('Project Preview', 'shanayn-labs'); ?></span>
                                <?php if ($service_pillar_label) : ?>
                                    <strong><?php echo esc_html($service_pillar_label); ?></strong>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>

                <?php if ($client_name || $service_pillar_label || $project_type || !empty($service_tags) || $project_url) : ?>
                    <section class="single-work-details" aria-label="<?php esc_attr_e('Project details', 'shanayn-labs'); ?>">
                        <?php if ($client_name) : ?>
                            <div class="single-work-detail-item">
                                <p class="single-work-detail-label"><?php esc_html_e('Client', 'shanayn-labs'); ?></p>
                                <p class="single-work-detail-value"><?php echo esc_html($client_name); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($service_pillar_label) : ?>
                            <div class="single-work-detail-item">
                                <p class="single-work-detail-label"><?php esc_html_e('Service', 'shanayn-labs'); ?></p>
                                <p class="single-work-detail-value"><?php echo esc_html($service_pillar_label); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($project_type) : ?>
                            <div class="single-work-detail-item">
                                <p class="single-work-detail-label"><?php esc_html_e('Project Type', 'shanayn-labs'); ?></p>
                                <p class="single-work-detail-value"><?php echo esc_html($project_type); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($service_tags)) : ?>
                            <div class="single-work-detail-item">
                                <p class="single-work-detail-label"><?php esc_html_e('Scope', 'shanayn-labs'); ?></p>
                                <p class="single-work-detail-value"><?php echo esc_html(implode(', ', $service_tags)); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($project_url) : ?>
                            <div class="single-work-detail-item">
                                <p class="single-work-detail-label"><?php esc_html_e('Project Link', 'shanayn-labs'); ?></p>
                                <p class="single-work-detail-value">
                                    <a href="<?php echo esc_url($project_url); ?>"><?php echo esc_html($project_url); ?></a>
                                </p>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>

                <section class="single-work-content">
                    <div class="single-work-content-inner">
                        <div class="entry-content work-case-study-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>

                <section class="single-work-cta" aria-labelledby="single-work-cta-title">
                    <div class="single-work-cta-inner">
                        <p class="single-work-cta-kicker"><?php esc_html_e('READY TO BUILD SOMETHING SIMILAR?', 'shanayn-labs'); ?></p>
                        <h2 id="single-work-cta-title" class="single-work-cta-title">
                            <?php esc_html_e('Need a system like this for your business?', 'shanayn-labs'); ?>
                        </h2>
                        <p class="single-work-cta-description">
                            <?php esc_html_e("Let's discuss your website, marketing, software, or AI workflow and build something that solves a real business problem.", 'shanayn-labs'); ?>
                        </p>
                        <div class="single-work-cta-actions">
                            <a class="btn single-work-cta-button" href="<?php echo esc_url($contact_url); ?>">
                                <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                            <a class="single-work-cta-secondary" href="<?php echo esc_url($work_archive_url); ?>">
                                <?php esc_html_e('View More Work', 'shanayn-labs'); ?>
                                <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </section>
            </div>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
