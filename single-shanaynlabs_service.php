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

        $service_id = get_the_ID();
        $service_pillars = get_the_terms($service_id, 'service-pillar');
        $current_pillar = null;

        if (!empty($service_pillars) && !is_wp_error($service_pillars)) {
            $current_pillar = $service_pillars[0];
        }

        $pillar_slug = $current_pillar ? $current_pillar->slug : 'digital-presence';
        $allowed_pillars = array('digital-presence', 'growth-engine', 'software-intelligence');

        if (!in_array($pillar_slug, $allowed_pillars, true)) {
            $pillar_slug = 'digital-presence';
        }

        $pillar_label = $current_pillar ? $current_pillar->name : __('Digital Presence', 'shanayn-labs');

        $pillar_content = array(
            'digital-presence' => array(
                'problem' => __('A clear digital presence helps customers understand who you are, what you offer, and why they should trust your business.', 'shanayn-labs'),
                'what_we_do' => array(
                    __('Website strategy', 'shanayn-labs'),
                    __('Page structure', 'shanayn-labs'),
                    __('Responsive design', 'shanayn-labs'),
                    __('Conversion-focused sections', 'shanayn-labs'),
                    __('SEO foundation', 'shanayn-labs'),
                    __('Contact flow setup', 'shanayn-labs'),
                ),
                'process' => array(
                    __('Discover', 'shanayn-labs'),
                    __('Structure', 'shanayn-labs'),
                    __('Design', 'shanayn-labs'),
                    __('Launch', 'shanayn-labs'),
                ),
                'benefits' => array(
                    __('Clearer brand presentation', 'shanayn-labs'),
                    __('Better service explanation', 'shanayn-labs'),
                    __('Stronger trust', 'shanayn-labs'),
                    __('More inquiry-ready pages', 'shanayn-labs'),
                ),
                'cta_kicker' => __('Ready to improve your digital presence?', 'shanayn-labs'),
            ),
            'growth-engine' => array(
                'problem' => __('Growth becomes easier when marketing activity is connected, consistent, and measured around real leads.', 'shanayn-labs'),
                'what_we_do' => array(
                    __('SEO planning', 'shanayn-labs'),
                    __('Content system', 'shanayn-labs'),
                    __('Social media structure', 'shanayn-labs'),
                    __('Campaign setup', 'shanayn-labs'),
                    __('Analytics tracking', 'shanayn-labs'),
                    __('Lead flow improvement', 'shanayn-labs'),
                ),
                'process' => array(
                    __('Audit', 'shanayn-labs'),
                    __('Strategy', 'shanayn-labs'),
                    __('Execute', 'shanayn-labs'),
                    __('Optimize', 'shanayn-labs'),
                ),
                'benefits' => array(
                    __('Better visibility', 'shanayn-labs'),
                    __('More consistent content', 'shanayn-labs'),
                    __('Clearer campaigns', 'shanayn-labs'),
                    __('Improved lead tracking', 'shanayn-labs'),
                ),
                'cta_kicker' => __('Ready to build your growth engine?', 'shanayn-labs'),
            ),
            'software-intelligence' => array(
                'problem' => __('Better systems help teams reduce manual work, manage data clearly, and operate with more control.', 'shanayn-labs'),
                'what_we_do' => array(
                    __('Workflow mapping', 'shanayn-labs'),
                    __('Dashboard planning', 'shanayn-labs'),
                    __('CRM or internal tool structure', 'shanayn-labs'),
                    __('Automation logic', 'shanayn-labs'),
                    __('Reporting setup', 'shanayn-labs'),
                    __('AI workflow planning', 'shanayn-labs'),
                ),
                'process' => array(
                    __('Map', 'shanayn-labs'),
                    __('Design', 'shanayn-labs'),
                    __('Build', 'shanayn-labs'),
                    __('Improve', 'shanayn-labs'),
                ),
                'benefits' => array(
                    __('Less manual work', 'shanayn-labs'),
                    __('Cleaner data', 'shanayn-labs'),
                    __('Faster workflows', 'shanayn-labs'),
                    __('Better reporting', 'shanayn-labs'),
                ),
                'cta_kicker' => __('Ready to build smarter operations?', 'shanayn-labs'),
            ),
        );

        $current_content = $pillar_content[$pillar_slug];
        $hero_description = has_excerpt($service_id) ? get_the_excerpt($service_id) : wp_trim_words(wp_strip_all_tags(get_the_content(null, false, $service_id)), 28, '...');

        $featured_work_query = new WP_Query(
            array(
                'post_type' => 'shanaynlabs_work',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'meta_query' => array(
                    array(
                        'key' => '_shanaynlabs_featured_work',
                        'value' => '1',
                        'compare' => '=',
                    ),
                ),
                'no_found_rows' => true,
                'ignore_sticky_posts' => true,
            )
        );

        $related_services_query = null;

        if ($current_pillar) {
            $related_services_query = new WP_Query(
                array(
                    'post_type' => 'shanaynlabs_service',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'post__not_in' => array($service_id),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'service-pillar',
                            'field' => 'term_id',
                            'terms' => $current_pillar->term_id,
                        ),
                    ),
                    'orderby' => array(
                        'menu_order' => 'ASC',
                        'title' => 'ASC',
                    ),
                    'no_found_rows' => true,
                    'ignore_sticky_posts' => true,
                )
            );
        }
        ?>

        <article id="post-<?php echo esc_attr($service_id); ?>" <?php post_class('service-single service-single--' . sanitize_html_class($pillar_slug)); ?>>
            <section class="service-single-hero" aria-labelledby="service-single-heading">
                <div class="container service-single-hero__inner">
                    <div class="service-single-hero__content">
                        <p class="service-single-eyebrow"><?php echo esc_html($pillar_label); ?></p>
                        <h1 id="service-single-heading" class="service-single-hero__title"><?php echo esc_html(get_the_title()); ?></h1>

                        <?php if (!empty($hero_description)) : ?>
                            <p class="service-single-hero__description"><?php echo esc_html($hero_description); ?></p>
                        <?php endif; ?>

                        <div class="service-single-actions">
                            <a class="btn-primary service-single-button" href="<?php echo esc_url(home_url('/contact/')); ?>">
                                <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                            </a>
                            <a class="btn-secondary service-single-button service-single-button--secondary" href="<?php echo esc_url(home_url('/work/')); ?>">
                                <?php esc_html_e('View Work', 'shanayn-labs'); ?>
                            </a>
                        </div>
                    </div>

                    <div class="service-single-hero__visual">
                        <?php if (has_post_thumbnail($service_id)) : ?>
                            <figure class="service-single-media">
                                <?php
                                echo get_the_post_thumbnail(
                                    $service_id,
                                    'large',
                                    array(
                                        'class' => 'service-single-media__image',
                                        'alt' => esc_attr(get_the_title()),
                                        'loading' => 'eager',
                                    )
                                );
                                ?>
                            </figure>
                        <?php else : ?>
                            <div class="service-single-fallback service-single-fallback--<?php echo esc_attr($pillar_slug); ?>" aria-hidden="true">
                                <div class="service-single-fallback__bar"><span></span><span></span><span></span></div>
                                <div class="service-single-fallback__body">
                                    <div class="service-single-fallback__primary"></div>
                                    <div class="service-single-fallback__row"><span></span><span></span><span></span></div>
                                    <div class="service-single-fallback__grid"><span></span><span></span><span></span><span></span></div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <section class="service-single-problem" aria-labelledby="service-single-problem-heading">
                <div class="container service-single-problem__inner">
                    <p class="service-single-section-label"><?php esc_html_e('Why It Matters', 'shanayn-labs'); ?></p>
                    <h2 id="service-single-problem-heading" class="service-single-section-title"><?php esc_html_e('A focused service should solve a real business problem.', 'shanayn-labs'); ?></h2>
                    <p class="service-single-problem__text"><?php echo esc_html($current_content['problem']); ?></p>
                </div>
            </section>

            <section class="service-single-content-section" aria-labelledby="service-single-content-heading">
                <div class="container service-single-content-grid">
                    <aside class="service-single-content-aside">
                        <p class="service-single-section-label"><?php esc_html_e('Service Detail', 'shanayn-labs'); ?></p>
                        <h2 id="service-single-content-heading" class="service-single-section-title"><?php esc_html_e('What this service includes.', 'shanayn-labs'); ?></h2>
                    </aside>

                    <div class="entry-content service-single-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>

            <section class="service-single-list-section" aria-labelledby="service-single-what-heading">
                <div class="container service-single-split">
                    <div>
                        <p class="service-single-section-label"><?php esc_html_e('What We Do', 'shanayn-labs'); ?></p>
                        <h2 id="service-single-what-heading" class="service-single-section-title"><?php esc_html_e('Practical work shaped around the service goal.', 'shanayn-labs'); ?></h2>
                    </div>

                    <div class="service-single-chip-grid">
                        <?php foreach ($current_content['what_we_do'] as $item) : ?>
                            <span class="service-single-chip"><?php echo esc_html($item); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="service-single-process" aria-labelledby="service-single-process-heading">
                <div class="container">
                    <header class="service-single-section-header">
                        <p class="service-single-section-label"><?php esc_html_e('Process', 'shanayn-labs'); ?></p>
                        <h2 id="service-single-process-heading" class="service-single-section-title"><?php esc_html_e('A simple path from clarity to execution.', 'shanayn-labs'); ?></h2>
                    </header>

                    <div class="service-single-process__steps">
                        <?php foreach ($current_content['process'] as $index => $step) : ?>
                            <div class="service-single-process__step">
                                <span><?php echo esc_html(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                                <strong><?php echo esc_html($step); ?></strong>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

            <section class="service-single-benefits" aria-labelledby="service-single-benefits-heading">
                <div class="container service-single-split">
                    <div>
                        <p class="service-single-section-label"><?php esc_html_e('Benefits', 'shanayn-labs'); ?></p>
                        <h2 id="service-single-benefits-heading" class="service-single-section-title"><?php esc_html_e('Built to make the next step easier for your business.', 'shanayn-labs'); ?></h2>
                    </div>

                    <ul class="service-single-benefits__list">
                        <?php foreach ($current_content['benefits'] as $benefit) : ?>
                            <li><?php echo esc_html($benefit); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

            <?php if ($featured_work_query->have_posts()) : ?>
                <section class="service-single-work" aria-labelledby="service-single-work-heading">
                    <div class="container">
                        <?php
                        $featured_work_query->the_post();

                        $work_id = get_the_ID();
                        $project_type = get_post_meta($work_id, '_shanaynlabs_project_type', true);
                        $result_summary = get_post_meta($work_id, '_shanaynlabs_result_summary', true);
                        $project_url = get_post_meta($work_id, '_shanaynlabs_project_url', true);
                        $work_url = !empty($project_url) ? $project_url : get_permalink($work_id);
                        $work_description = !empty($result_summary) ? $result_summary : (has_excerpt($work_id) ? get_the_excerpt($work_id) : wp_trim_words(wp_strip_all_tags(get_the_content(null, false, $work_id)), 22, '...'));
                        ?>

                        <article class="service-single-work__card">
                            <div class="service-single-work__content">
                                <p class="service-single-section-label"><?php esc_html_e('Featured Work', 'shanayn-labs'); ?></p>
                                <?php if (!empty($project_type)) : ?>
                                    <p class="service-single-work__type"><?php echo esc_html($project_type); ?></p>
                                <?php endif; ?>
                                <h2 id="service-single-work-heading" class="service-single-work__title"><?php echo esc_html(get_the_title($work_id)); ?></h2>
                                <p class="service-single-work__text"><?php echo esc_html($work_description); ?></p>
                                <a class="service-single-text-link" href="<?php echo esc_url($work_url); ?>">
                                    <?php esc_html_e('View project', 'shanayn-labs'); ?>
                                    <span aria-hidden="true">&rarr;</span>
                                </a>
                            </div>

                            <?php if (has_post_thumbnail($work_id)) : ?>
                                <div class="service-single-work__media">
                                    <?php
                                    echo get_the_post_thumbnail(
                                        $work_id,
                                        'medium_large',
                                        array(
                                            'class' => 'service-single-work__image',
                                            'alt' => esc_attr(get_the_title($work_id)),
                                            'loading' => 'lazy',
                                        )
                                    );
                                    ?>
                                </div>
                            <?php endif; ?>
                        </article>

                        <?php wp_reset_postdata(); ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($related_services_query instanceof WP_Query && $related_services_query->have_posts()) : ?>
                <section class="service-single-related" aria-labelledby="service-single-related-heading">
                    <div class="container">
                        <header class="service-single-section-header">
                            <p class="service-single-section-label"><?php esc_html_e('Related Services', 'shanayn-labs'); ?></p>
                            <h2 id="service-single-related-heading" class="service-single-section-title"><?php esc_html_e('More ways to build the same system.', 'shanayn-labs'); ?></h2>
                        </header>

                        <div class="service-single-related__grid">
                            <?php while ($related_services_query->have_posts()) : ?>
                                <?php
                                $related_services_query->the_post();
                                $related_description = has_excerpt(get_the_ID()) ? get_the_excerpt(get_the_ID()) : wp_trim_words(wp_strip_all_tags(get_the_content(null, false, get_the_ID())), 18, '...');
                                ?>
                                <article class="service-single-related__card">
                                    <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
                                    <?php if (!empty($related_description)) : ?>
                                        <p><?php echo esc_html($related_description); ?></p>
                                    <?php endif; ?>
                                    <a class="service-single-text-link" href="<?php echo esc_url(get_permalink()); ?>">
                                        <?php esc_html_e('Explore service', 'shanayn-labs'); ?>
                                        <span aria-hidden="true">&rarr;</span>
                                    </a>
                                </article>
                            <?php endwhile; ?>
                        </div>

                        <?php wp_reset_postdata(); ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="service-single-cta" aria-labelledby="service-single-cta-heading">
                <div class="container service-single-cta__inner">
                    <p class="service-single-cta__kicker"><?php echo esc_html($current_content['cta_kicker']); ?></p>
                    <h2 id="service-single-cta-heading" class="service-single-cta__title"><?php esc_html_e("Let's build the right system for your business.", 'shanayn-labs'); ?></h2>
                    <p class="service-single-cta__description"><?php esc_html_e('Start with a focused conversation about your goals, current challenges, and what your business needs next.', 'shanayn-labs'); ?></p>
                    <a class="btn-primary service-single-cta__button" href="<?php echo esc_url(home_url('/contact/')); ?>">
                        <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                    </a>
                </div>
            </section>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
