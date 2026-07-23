<?php
/**
 * Work pillar archive template.
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

$current_pillar_slug = sanitize_key(get_query_var('shanaynlabs_work_pillar'));
$work_pillar_routes  = function_exists('shanaynlabs_get_work_pillar_routes') ? shanaynlabs_get_work_pillar_routes() : array();

if (!isset($work_pillar_routes[$current_pillar_slug])) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    nocache_headers();
    include get_query_template('404');
    exit;
}

$current_pillar = $work_pillar_routes[$current_pillar_slug];
$contact_url    = home_url('/contact/');
$work_url       = home_url('/work/');
$work_query     = new WP_Query(
    array(
        'post_type'      => 'shanaynlabs_work',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'tax_query'      => array(
            array(
                'taxonomy' => 'service-pillar',
                'field'    => 'slug',
                'terms'    => $current_pillar_slug,
            ),
        ),
    )
);

get_header();
?>

<main id="main-content" class="site-main work-pillar-page work-pillar-page--<?php echo esc_attr($current_pillar_slug); ?>">
    <section class="work-pillar-hero" aria-labelledby="work-pillar-heading">
        <div class="container work-pillar-hero-inner">
            <p class="work-pillar-eyebrow"><?php echo esc_html($current_pillar['eyebrow']); ?></p>
            <h1 id="work-pillar-heading" class="work-pillar-title"><?php echo esc_html($current_pillar['heading']); ?></h1>
            <p class="work-pillar-description"><?php echo esc_html($current_pillar['description']); ?></p>
        </div>
    </section>

    <section class="work-pillar-browser" aria-labelledby="work-pillar-browser-heading">
        <div class="container">
            <nav class="work-pillar-nav" aria-label="<?php echo esc_attr__('Work category navigation', 'shanayn-labs'); ?>">
                <a class="work-pillar-nav-link" href="<?php echo esc_url($work_url); ?>"><?php esc_html_e('All Work', 'shanayn-labs'); ?></a>
                <?php foreach ($work_pillar_routes as $pillar_slug => $pillar_data) : ?>
                    <a
                        class="work-pillar-nav-link<?php echo $current_pillar_slug === $pillar_slug ? ' is-active' : ''; ?>"
                        href="<?php echo esc_url(home_url('/work/' . $pillar_slug . '/')); ?>"
                        <?php echo $current_pillar_slug === $pillar_slug ? 'aria-current="page"' : ''; ?>
                    >
                        <?php echo esc_html($pillar_data['label']); ?>
                    </a>
                <?php endforeach; ?>
            </nav>

            <header class="work-pillar-section-header">
                <p class="work-pillar-eyebrow"><?php esc_html_e('Selected Projects', 'shanayn-labs'); ?></p>
                <h2 id="work-pillar-browser-heading"><?php echo esc_html($current_pillar['label']); ?></h2>
            </header>

            <?php if ($work_query->have_posts()) : ?>
                <div class="work-pillar-grid">
                    <?php while ($work_query->have_posts()) : ?>
                        <?php
                        $work_query->the_post();

                        $work_id          = get_the_ID();
                        $service_tags_raw = get_post_meta($work_id, '_shanaynlabs_work_service_tags', true);
                        $result_summary   = get_post_meta($work_id, '_shanaynlabs_result_summary', true);
                        $tag_lines        = preg_split('/\r\n|\r|\n/', (string) $service_tags_raw);
                        $tags             = array();

                        if (is_array($tag_lines)) {
                            foreach ($tag_lines as $tag_line) {
                                $tag_line = sanitize_text_field($tag_line);

                                if ('' !== $tag_line) {
                                    $tags[] = $tag_line;
                                }
                            }
                        }

                        $visible_tags = array_slice(array_unique($tags), 0, 3);
                        ?>
                        <article id="post-<?php echo esc_attr($work_id); ?>" <?php post_class('work-pillar-card', $work_id); ?>>
                            <a class="work-pillar-card-media" href="<?php echo esc_url(get_permalink($work_id)); ?>" aria-label="<?php echo esc_attr(sprintf(__('View project: %s', 'shanayn-labs'), get_the_title($work_id))); ?>">
                                <?php if (has_post_thumbnail($work_id)) : ?>
                                    <?php
                                    echo get_the_post_thumbnail(
                                        $work_id,
                                        'large',
                                        array(
                                            'class' => 'work-pillar-card-image',
                                            'alt'   => esc_attr(get_the_title($work_id)),
                                        )
                                    );
                                    ?>
                                <?php else : ?>
                                    <span class="work-pillar-card-fallback" aria-hidden="true">
                                        <span><?php echo esc_html($current_pillar['label']); ?></span>
                                    </span>
                                <?php endif; ?>
                            </a>

                            <div class="work-pillar-card-content">
                                <?php if ($visible_tags) : ?>
                                    <div class="work-pillar-card-tags">
                                        <?php foreach ($visible_tags as $tag) : ?>
                                            <span><?php echo esc_html($tag); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="work-pillar-card-title">
                                    <a href="<?php echo esc_url(get_permalink($work_id)); ?>"><?php echo esc_html(get_the_title($work_id)); ?></a>
                                </h3>

                                <?php if (!empty($result_summary)) : ?>
                                    <p class="work-pillar-card-summary"><?php echo esc_html(wp_trim_words(wp_strip_all_tags($result_summary), 18, '...')); ?></p>
                                <?php endif; ?>

                                <a class="work-pillar-card-link" href="<?php echo esc_url(get_permalink($work_id)); ?>">
                                    <?php esc_html_e('View Project', 'shanayn-labs'); ?>
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <article class="work-pillar-empty">
                    <h2><?php esc_html_e('Projects are being prepared.', 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('This work category will be updated as more selected projects are published from the WordPress dashboard.', 'shanayn-labs'); ?></p>
                    <a class="work-pillar-empty-link" href="<?php echo esc_url($contact_url); ?>">
                        <?php esc_html_e('Start a project conversation', 'shanayn-labs'); ?>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </article>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>

    <section class="work-pillar-cta" aria-labelledby="work-pillar-cta-heading">
        <div class="container work-pillar-cta-inner">
            <p class="work-pillar-eyebrow"><?php esc_html_e('Ready to build next?', 'shanayn-labs'); ?></p>
            <h2 id="work-pillar-cta-heading"><?php esc_html_e('Let’s shape a system around your business goals.', 'shanayn-labs'); ?></h2>
            <a href="<?php echo esc_url($contact_url); ?>" class="work-pillar-cta-link">
                <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                <span aria-hidden="true">&rarr;</span>
            </a>
        </div>
    </section>
</main>

<?php get_footer(); ?>
