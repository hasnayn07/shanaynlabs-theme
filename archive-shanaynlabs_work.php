<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('shanaynlabs_render_work_browser_card')) {
    /**
     * Render a minimal work browser project card.
     *
     * @param WP_Post $post   Post object.
     * @param string  $pillar Pillar label.
     */
    function shanaynlabs_render_work_browser_card($post, $pillar) {
        $post_id = $post->ID;
        $project_url = get_post_meta($post_id, '_shanaynlabs_project_url', true);
        $service_tags_raw = get_post_meta($post_id, '_shanaynlabs_work_service_tags', true);
        $card_url = $project_url ? $project_url : get_permalink($post_id);
        $tag_lines = preg_split('/\r\n|\r|\n/', (string) $service_tags_raw);
        $tags = array();

        if (is_array($tag_lines)) {
            foreach ($tag_lines as $tag_line) {
                $tag_line = sanitize_text_field($tag_line);

                if ('' !== $tag_line) {
                    $tags[] = $tag_line;
                }
            }
        }

        $visible_tags = array_slice($tags, 0, 3);
        $extra_tags = max(0, count($tags) - count($visible_tags));
        ?>
        <article id="post-<?php echo esc_attr($post_id); ?>" <?php post_class('work-card', $post_id); ?>>
            <a class="work-card-link-wrap" href="<?php echo esc_url($card_url); ?>" aria-label="<?php echo esc_attr(sprintf(__('View project: %s', 'shanayn-labs'), get_the_title($post_id))); ?>">
                <?php if (has_post_thumbnail($post_id)) : ?>
                    <?php
                    echo get_the_post_thumbnail(
                        $post_id,
                        'large',
                        array(
                            'class' => 'work-card-image',
                            'alt'   => esc_attr(get_the_title($post_id)),
                        )
                    );
                    ?>
                <?php else : ?>
                    <div class="work-card-image work-card-image-fallback" aria-hidden="true">
                        <span><?php echo esc_html($pillar); ?></span>
                    </div>
                <?php endif; ?>

                <div class="work-card-overlay">
                    <?php if ($visible_tags || $extra_tags) : ?>
                        <div class="work-card-tags">
                            <?php foreach ($visible_tags as $tag) : ?>
                                <span class="work-card-tag"><?php echo esc_html($tag); ?></span>
                            <?php endforeach; ?>
                            <?php if ($extra_tags > 0) : ?>
                                <span class="work-card-tag work-card-tag-more">
                                    <?php
                                    /* translators: %d is the number of additional work tags. */
                                    echo esc_html(sprintf(__('+%d', 'shanayn-labs'), $extra_tags));
                                    ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="work-card-overlay-content">
                        <h3 class="work-card-title"><?php echo esc_html(get_the_title($post_id)); ?></h3>
                        <span class="work-card-link">
                            <?php esc_html_e('View project', 'shanayn-labs'); ?>
                            <span aria-hidden="true">&rarr;</span>
                        </span>
                    </div>
                </div>
            </a>
        </article>
        <?php
    }
}

$contact_url = home_url('/contact/');
$services_url = home_url('/services/');
$work_pillars = array(
    'digital-presence' => array(
        'name' => __('Digital Presence', 'shanayn-labs'),
    ),
    'growth-engine' => array(
        'name' => __('Growth Engine', 'shanayn-labs'),
    ),
    'software-intelligence' => array(
        'name' => __('Software Intelligence', 'shanayn-labs'),
    ),
);
$work_queries = array();

foreach ($work_pillars as $pillar_slug => $pillar) {
    $work_queries[$pillar_slug] = new WP_Query(
        array(
            'post_type'      => 'shanaynlabs_work',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'tax_query'      => array(
                array(
                    'taxonomy' => 'service-pillar',
                    'field'    => 'slug',
                    'terms'    => $pillar_slug,
                ),
            ),
        )
    );
}

get_header();
?>

<main id="main-content" class="site-main work-page">
    <section class="section archive-page" aria-labelledby="work-archive-heading">
        <div class="container">
            <section class="work-hero" aria-labelledby="work-archive-heading">
                <div class="work-hero-inner">
                    <div class="work-hero-content" data-animate>
                        <p class="work-hero-eyebrow"><?php esc_html_e('WORK', 'shanayn-labs'); ?></p>
                        <h1 id="work-archive-heading" class="work-hero-title">
                            <?php esc_html_e('Selected systems built for business clarity, growth, and smarter operations.', 'shanayn-labs'); ?>
                        </h1>
                        <p class="work-hero-description">
                            <?php esc_html_e('Explore projects across websites, marketing systems, software, dashboards, automation, and AI workflows - each designed around real business goals.', 'shanayn-labs'); ?>
                        </p>
                        <p class="work-hero-trust">
                            <?php esc_html_e('Digital Presence', 'shanayn-labs'); ?>
                            <span aria-hidden="true">&bull;</span>
                            <?php esc_html_e('Growth Engine', 'shanayn-labs'); ?>
                            <span aria-hidden="true">&bull;</span>
                            <?php esc_html_e('Software Intelligence', 'shanayn-labs'); ?>
                        </p>
                    </div>

                    <div class="work-hero-visual" aria-hidden="true" data-animate>
                        <div class="work-preview-stack">
                            <article class="work-preview-card work-preview-card-presence">
                                <div class="work-preview-card-header">
                                    <p><?php esc_html_e('Website System', 'shanayn-labs'); ?></p>
                                    <h2 class="work-preview-card-title"><?php esc_html_e('Digital Presence', 'shanayn-labs'); ?></h2>
                                </div>
                                <div class="work-preview-card-visual work-preview-website">
                                    <div class="work-preview-browser-bar">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="work-preview-website-layout">
                                        <div class="work-preview-website-sidebar"></div>
                                        <div class="work-preview-website-content">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <article class="work-preview-card work-preview-card-growth">
                                <div class="work-preview-card-header">
                                    <p><?php esc_html_e('Growth System', 'shanayn-labs'); ?></p>
                                    <h2 class="work-preview-card-title"><?php esc_html_e('Growth Engine', 'shanayn-labs'); ?></h2>
                                </div>
                                <div class="work-preview-card-visual work-preview-analytics">
                                    <div class="work-preview-chart">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="work-preview-metrics">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </article>

                            <article class="work-preview-card work-preview-card-software">
                                <div class="work-preview-card-header">
                                    <p><?php esc_html_e('Software System', 'shanayn-labs'); ?></p>
                                    <h2 class="work-preview-card-title"><?php esc_html_e('Software Intelligence', 'shanayn-labs'); ?></h2>
                                </div>
                                <div class="work-preview-card-visual work-preview-software">
                                    <div class="work-preview-workflow-nodes">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="work-preview-workflow-panel">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </section>

            <section class="work-browser" aria-labelledby="work-browser-heading" data-work-browser>
                <div class="work-browser-header">
                    <p class="work-hero-eyebrow"><?php esc_html_e('SELECTED WORK', 'shanayn-labs'); ?></p>
                    <h2 id="work-browser-heading"><?php esc_html_e('Explore projects by service system.', 'shanayn-labs'); ?></h2>
                </div>

                <div class="work-pillar-selector" role="tablist" aria-label="<?php esc_attr_e('Work service pillar selector', 'shanayn-labs'); ?>">
                    <?php $button_index = 0; ?>
                    <?php foreach ($work_pillars as $pillar_slug => $pillar) : ?>
                        <?php $is_active = 'digital-presence' === $pillar_slug; ?>
                        <button
                            type="button"
                            class="work-pillar-button<?php echo $is_active ? ' is-active' : ''; ?>"
                            id="<?php echo esc_attr('work-tab-' . $pillar_slug); ?>"
                            data-work-pillar="<?php echo esc_attr($pillar_slug); ?>"
                            role="tab"
                            aria-selected="<?php echo $is_active ? 'true' : 'false'; ?>"
                            aria-controls="<?php echo esc_attr('work-project-panel-' . $pillar_slug); ?>"
                            tabindex="<?php echo 0 === $button_index ? '0' : '-1'; ?>"
                        >
                            <span class="work-pillar-button-title"><?php echo esc_html($pillar['name']); ?></span>
                        </button>
                        <?php $button_index++; ?>
                    <?php endforeach; ?>
                </div>

                <?php foreach ($work_pillars as $pillar_slug => $pillar) : ?>
                    <?php
                    $panel_query = $work_queries[$pillar_slug];
                    $is_active = 'digital-presence' === $pillar_slug;
                    ?>
                    <section
                        id="<?php echo esc_attr('work-project-panel-' . $pillar_slug); ?>"
                        class="work-project-panel<?php echo $is_active ? ' is-active' : ''; ?>"
                        data-work-panel="<?php echo esc_attr($pillar_slug); ?>"
                        role="tabpanel"
                        aria-labelledby="<?php echo esc_attr('work-tab-' . $pillar_slug); ?>"
                        <?php if (!$is_active) : ?>
                            hidden
                        <?php endif; ?>
                    >
                        <div class="work-project-grid">
                            <?php if ($panel_query->have_posts()) : ?>
                                <?php while ($panel_query->have_posts()) : ?>
                                    <?php $panel_query->the_post(); ?>
                                    <?php shanaynlabs_render_work_browser_card(get_post(), $pillar['name']); ?>
                                <?php endwhile; ?>
                            <?php else : ?>
                                <article class="work-empty-card">
                                    <h3>
                                        <?php
                                        /* translators: %s is a service pillar name. */
                                        echo esc_html(sprintf(__('More %s work is being prepared.', 'shanayn-labs'), $pillar['name']));
                                        ?>
                                    </h3>
                                    <a class="work-card-link" href="<?php echo esc_url($contact_url); ?>">
                                        <?php esc_html_e('Book a call', 'shanayn-labs'); ?>
                                        <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </article>
                            <?php endif; ?>
                        </div>
                    </section>
                    <?php wp_reset_postdata(); ?>
                <?php endforeach; ?>
            </section>

            <?php
            shanaynlabs_render_project_inquiry_section(
                array(
                    'heading' => __('Want to build something similar?', 'shanayn-labs'),
                )
            );
            ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
