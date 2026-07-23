<?php
/**
 * Template Name: About
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main about-page">
    <section class="about-hero" aria-labelledby="about-hero-heading">
        <div class="container about-hero-inner">
            <div class="about-hero-content">
                <p class="eyebrow"><?php esc_html_e('ABOUT SHANAYN LABS', 'shanayn-labs'); ?></p>
                <h1 id="about-hero-heading"><?php esc_html_e('A digital systems company built for modern businesses.', 'shanayn-labs'); ?></h1>
                <p>
                    <?php esc_html_e('We help businesses build premium websites, growth systems, software, automation, and AI workflows with a clear focus on business outcomes.', 'shanayn-labs'); ?>
                </p>
            </div>

            <div class="about-hero-visual" aria-hidden="true">
                <div class="about-system-visual">
                    <span class="about-system-node about-system-node-websites"><?php esc_html_e('Websites', 'shanayn-labs'); ?></span>
                    <span class="about-system-node about-system-node-growth"><?php esc_html_e('Growth', 'shanayn-labs'); ?></span>
                    <span class="about-system-core"></span>
                    <span class="about-system-node about-system-node-software"><?php esc_html_e('Software', 'shanayn-labs'); ?></span>
                    <span class="about-system-node about-system-node-ai"><?php esc_html_e('AI', 'shanayn-labs'); ?></span>
                </div>
            </div>
        </div>
    </section>

    <section class="section about-mission" aria-labelledby="about-mission-heading">
        <div class="container about-mission-inner">
            <div class="about-mission-statement">
                <p class="eyebrow"><?php esc_html_e('OUR MISSION', 'shanayn-labs'); ?></p>
                <h2 id="about-mission-heading">
                    <?php esc_html_e('Our mission is to build digital systems that help businesses look trusted, operate smarter, and grow with clarity.', 'shanayn-labs'); ?>
                </h2>
            </div>

            <div class="about-mission-copy">
                <p>
                    <?php esc_html_e('Shanayn Labs brings together design, development, marketing, automation, and AI to create practical systems for businesses that need more than just a website or random digital activity.', 'shanayn-labs'); ?>
                </p>
            </div>
        </div>
    </section>

    <section class="section about-beliefs" aria-labelledby="about-beliefs-heading">
        <div class="container">
            <div class="about-beliefs-header">
                <h2 id="about-beliefs-heading"><?php esc_html_e('Built on clarity, systems, and practical execution.', 'shanayn-labs'); ?></h2>
            </div>

            <div class="about-belief-grid">
                <article class="about-belief-item">
                    <span><?php esc_html_e('01', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Clarity First', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('We believe every digital project should start with clear business goals, audience understanding, and a proper structure.', 'shanayn-labs'); ?></p>
                </article>

                <article class="about-belief-item">
                    <span><?php esc_html_e('02', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Systems Over Random Work', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('Websites, marketing, software, and AI work better when they are connected as one business system.', 'shanayn-labs'); ?></p>
                </article>

                <article class="about-belief-item">
                    <span><?php esc_html_e('03', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Practical Innovation', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('We use modern tools and AI where they create real value, not just because they look impressive.', 'shanayn-labs'); ?></p>
                </article>
            </div>
        </div>
    </section>

    <section class="section about-founders" aria-labelledby="about-founders-heading">
        <div class="container">
            <div class="section-header">
                <p class="eyebrow"><?php esc_html_e('FOUNDING TEAM', 'shanayn-labs'); ?></p>
                <h2 id="about-founders-heading"><?php esc_html_e('Built by people who care about systems, design, and execution.', 'shanayn-labs'); ?></h2>
                <p><?php esc_html_e('Meet the founding members behind ShanaynLabs - focused on building digital presence, growth systems, software, and AI workflows for practical business outcomes.', 'shanayn-labs'); ?></p>
            </div>

            <?php
            $founding_team = shanaynlabs_get_founding_team_members();
            $get_founder_initials = static function ($name) {
                $name_parts = preg_split('/\s+/', trim((string) $name));
                $initials = '';

                if (!empty($name_parts)) {
                    foreach (array_slice($name_parts, 0, 2) as $name_part) {
                        $clean_part = preg_replace('/[^A-Za-z0-9]/', '', $name_part);

                        if ($clean_part) {
                            $initials .= strtoupper(substr($clean_part, 0, 1));
                        }
                    }
                }

                return $initials ? $initials : strtoupper(substr((string) $name, 0, 2));
            };
            ?>

            <?php if ($founding_team->have_posts()) : ?>
                <div class="about-founders-grid">
                    <?php while ($founding_team->have_posts()) : ?>
                        <?php
                        $founding_team->the_post();

                        $founder_name = get_the_title();
                        $founder_role = get_post_meta(get_the_ID(), '_shanaynlabs_team_role', true);
                        $founder_bio = get_post_meta(get_the_ID(), '_shanaynlabs_team_bio', true);
                        $founder_expertise_raw = get_post_meta(get_the_ID(), '_shanaynlabs_team_expertise', true);
                        $founder_linkedin = get_post_meta(get_the_ID(), '_shanaynlabs_team_linkedin', true);
                        $founder_custom_link = get_post_meta(get_the_ID(), '_shanaynlabs_team_custom_link', true);
                        $founder_expertise_lines = preg_split('/\r\n|\r|\n/', (string) $founder_expertise_raw);
                        $founder_expertise = array();

                        if (is_array($founder_expertise_lines)) {
                            foreach ($founder_expertise_lines as $founder_expertise_line) {
                                $founder_expertise_line = sanitize_text_field($founder_expertise_line);

                                if ('' !== $founder_expertise_line) {
                                    $founder_expertise[] = $founder_expertise_line;
                                }
                            }
                        }
                        ?>
                        <article class="about-founder-card">
                            <div class="about-founder-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php
                                    echo get_the_post_thumbnail(
                                        get_the_ID(),
                                        'large',
                                        array(
                                            'alt' => esc_attr($founder_name),
                                        )
                                    );
                                    ?>
                                <?php else : ?>
                                    <span class="about-founder-avatar" aria-hidden="true"><?php echo esc_html($get_founder_initials($founder_name)); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="about-founder-content">
                                <h3><?php echo esc_html($founder_name); ?></h3>

                                <?php if ($founder_role) : ?>
                                    <p class="about-founder-role"><?php echo esc_html($founder_role); ?></p>
                                <?php endif; ?>

                                <?php if ($founder_bio) : ?>
                                    <p class="about-founder-bio"><?php echo esc_html($founder_bio); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($founder_expertise)) : ?>
                                    <div class="about-founder-tags" aria-label="<?php echo esc_attr__('Expertise', 'shanayn-labs'); ?>">
                                        <?php foreach ($founder_expertise as $founder_expertise_item) : ?>
                                            <span><?php echo esc_html($founder_expertise_item); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($founder_linkedin || $founder_custom_link) : ?>
                                    <div class="about-founder-links">
                                        <?php if ($founder_linkedin) : ?>
                                            <a href="<?php echo esc_url($founder_linkedin); ?>" target="_blank" rel="noopener noreferrer">
                                                <?php esc_html_e('LinkedIn', 'shanayn-labs'); ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($founder_custom_link) : ?>
                                            <a href="<?php echo esc_url($founder_custom_link); ?>" target="_blank" rel="noopener noreferrer">
                                                <?php esc_html_e('Profile', 'shanayn-labs'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            <?php else : ?>
                <div class="about-founders-empty">
                    <p><?php esc_html_e('Founding team profiles are being prepared.', 'shanayn-labs'); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php $core_team = shanaynlabs_get_team_members(array('non_founders_only' => true)); ?>
    <?php if ($core_team->have_posts()) : ?>
        <section class="section about-core-team" aria-labelledby="about-core-team-heading">
            <div class="container">
                <div class="section-header">
                    <p class="eyebrow"><?php esc_html_e('CORE TEAM', 'shanayn-labs'); ?></p>
                    <h2 id="about-core-team-heading"><?php esc_html_e('A focused team across design, development, growth, software, and AI.', 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('Our core team supports projects with practical execution across strategy, design, development, marketing, automation, and ongoing improvement.', 'shanayn-labs'); ?></p>
                </div>

                <div class="about-team-grid">
                    <?php while ($core_team->have_posts()) : ?>
                        <?php
                        $core_team->the_post();

                        $team_member_name = get_the_title();
                        $team_member_role = get_post_meta(get_the_ID(), '_shanaynlabs_team_role', true);
                        $team_member_bio = get_post_meta(get_the_ID(), '_shanaynlabs_team_bio', true);
                        $team_member_expertise_raw = get_post_meta(get_the_ID(), '_shanaynlabs_team_expertise', true);
                        $team_member_linkedin = get_post_meta(get_the_ID(), '_shanaynlabs_team_linkedin', true);
                        $team_member_custom_link = get_post_meta(get_the_ID(), '_shanaynlabs_team_custom_link', true);
                        $team_member_expertise_lines = preg_split('/\r\n|\r|\n/', (string) $team_member_expertise_raw);
                        $team_member_expertise = array();

                        if (is_array($team_member_expertise_lines)) {
                            foreach ($team_member_expertise_lines as $team_member_expertise_line) {
                                $team_member_expertise_line = sanitize_text_field($team_member_expertise_line);

                                if ('' !== $team_member_expertise_line) {
                                    $team_member_expertise[] = $team_member_expertise_line;
                                }
                            }
                        }
                        ?>
                        <article class="about-team-card">
                            <div class="about-team-image">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php
                                    echo get_the_post_thumbnail(
                                        get_the_ID(),
                                        'medium_large',
                                        array(
                                            'alt' => esc_attr($team_member_name),
                                        )
                                    );
                                    ?>
                                <?php else : ?>
                                    <span class="about-team-avatar" aria-hidden="true"><?php echo esc_html($get_founder_initials($team_member_name)); ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="about-team-content">
                                <h3><?php echo esc_html($team_member_name); ?></h3>

                                <?php if ($team_member_role) : ?>
                                    <p class="about-team-role"><?php echo esc_html($team_member_role); ?></p>
                                <?php endif; ?>

                                <?php if ($team_member_bio) : ?>
                                    <p class="about-team-bio"><?php echo esc_html($team_member_bio); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($team_member_expertise)) : ?>
                                    <div class="about-team-tags" aria-label="<?php echo esc_attr__('Expertise', 'shanayn-labs'); ?>">
                                        <?php foreach ($team_member_expertise as $team_member_expertise_item) : ?>
                                            <span><?php echo esc_html($team_member_expertise_item); ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($team_member_linkedin || $team_member_custom_link) : ?>
                                    <div class="about-team-links">
                                        <?php if ($team_member_linkedin) : ?>
                                            <a href="<?php echo esc_url($team_member_linkedin); ?>" target="_blank" rel="noopener noreferrer">
                                                <?php esc_html_e('LinkedIn', 'shanayn-labs'); ?>
                                            </a>
                                        <?php endif; ?>
                                        <?php if ($team_member_custom_link) : ?>
                                            <a href="<?php echo esc_url($team_member_custom_link); ?>" target="_blank" rel="noopener noreferrer">
                                                <?php esc_html_e('Profile', 'shanayn-labs'); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="section about-process" aria-labelledby="about-process-heading">
        <div class="container">
            <div class="section-header">
                <p class="eyebrow"><?php esc_html_e('HOW WE WORK', 'shanayn-labs'); ?></p>
                <h2 id="about-process-heading"><?php esc_html_e('A clear process from idea to execution.', 'shanayn-labs'); ?></h2>
            </div>

            <ol class="about-process-timeline">
                <li class="about-process-step">
                    <span><?php esc_html_e('01', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Understand', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('We learn the business, audience, goals, and current problems.', 'shanayn-labs'); ?></p>
                </li>

                <li class="about-process-step">
                    <span><?php esc_html_e('02', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Plan', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('We define the right structure, strategy, and execution path.', 'shanayn-labs'); ?></p>
                </li>

                <li class="about-process-step">
                    <span><?php esc_html_e('03', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Design', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('We create clean, premium, and user-focused digital experiences.', 'shanayn-labs'); ?></p>
                </li>

                <li class="about-process-step">
                    <span><?php esc_html_e('04', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Build', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('We develop reliable websites, systems, automation, and software.', 'shanayn-labs'); ?></p>
                </li>

                <li class="about-process-step">
                    <span><?php esc_html_e('05', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Improve', 'shanayn-labs'); ?></h3>
                    <p><?php esc_html_e('We refine with SEO, analytics, content, and performance updates.', 'shanayn-labs'); ?></p>
                </li>
            </ol>
        </div>
    </section>

    <?php $company_social_links = function_exists('shanaynlabs_get_social_links') ? shanaynlabs_get_social_links() : array(); ?>
    <?php if (!empty($company_social_links)) : ?>
        <section class="section about-socials" aria-labelledby="about-socials-heading">
            <div class="container">
                <div class="about-socials-inner">
                    <div class="about-socials-content">
                        <p class="eyebrow"><?php esc_html_e('Connect With Us', 'shanayn-labs'); ?></p>
                        <h2 id="about-socials-heading"><?php esc_html_e('Follow ShanaynLabs across the web', 'shanayn-labs'); ?></h2>
                        <p><?php esc_html_e('Stay connected with our latest work, insights, updates, and digital product ideas.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="about-socials-links" aria-label="<?php echo esc_attr__('ShanaynLabs social links', 'shanayn-labs'); ?>">
                        <?php foreach ($company_social_links as $social_link) : ?>
                            <?php
                            if (!is_array($social_link)) {
                                continue;
                            }

                            $social_label = isset($social_link['label']) ? $social_link['label'] : '';
                            $social_url = isset($social_link['url']) ? $social_link['url'] : '';
                            $social_key = isset($social_link['key']) ? sanitize_html_class($social_link['key']) : 'social';

                            if (!$social_label || !$social_url) {
                                continue;
                            }
                            ?>
                            <a class="about-social-link about-social-link--<?php echo esc_attr($social_key); ?>" href="<?php echo esc_url($social_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(sprintf(__('Follow ShanaynLabs on %s', 'shanayn-labs'), $social_label)); ?>">
                                <span class="about-social-icon" aria-hidden="true">
                                    <?php if ('linkedin' === $social_key) : ?>
                                        <svg viewBox="0 0 24 24" focusable="false">
                                            <path fill="currentColor" d="M6.7 19H3.4V8.8h3.3V19ZM5.1 7.4c-1 0-1.8-.8-1.8-1.8s.8-1.7 1.8-1.7 1.8.8 1.8 1.7-.8 1.8-1.8 1.8ZM20.7 19h-3.3v-5.4c0-1.3-.5-2.2-1.7-2.2-.9 0-1.4.6-1.7 1.2-.1.2-.1.5-.1.8V19h-3.3V8.8h3.2v1.4c.5-.7 1.4-1.7 3.3-1.7 2.4 0 3.6 1.6 3.6 4.8V19Z"></path>
                                        </svg>
                                    <?php elseif ('instagram' === $social_key) : ?>
                                        <svg viewBox="0 0 24 24" focusable="false">
                                            <rect x="4.2" y="4.2" width="15.6" height="15.6" rx="4.4"></rect>
                                            <circle cx="12" cy="12" r="3.6"></circle>
                                            <circle cx="16.8" cy="7.2" r="0.8" fill="currentColor" stroke="none"></circle>
                                        </svg>
                                    <?php elseif ('twitter' === $social_key) : ?>
                                        <svg viewBox="0 0 24 24" focusable="false">
                                            <path d="M5 5l14 14"></path>
                                            <path d="M19 5 5 19"></path>
                                        </svg>
                                    <?php elseif ('facebook' === $social_key) : ?>
                                        <svg viewBox="0 0 24 24" focusable="false">
                                            <path fill="currentColor" d="M14.2 8.2V6.9c0-.7.5-.9 1-.9h2V3h-2.8c-3 0-3.8 1.9-3.8 3.8v1.4H8.2v3.2h2.4V21h3.6v-9.6h2.8l.5-3.2h-3.3Z"></path>
                                        </svg>
                                    <?php elseif ('youtube' === $social_key) : ?>
                                        <svg viewBox="0 0 24 24" focusable="false">
                                            <rect x="3.8" y="6.4" width="16.4" height="11.2" rx="3.1"></rect>
                                            <path fill="currentColor" stroke="none" d="m10.6 9.3 4.5 2.7-4.5 2.7V9.3Z"></path>
                                        </svg>
                                    <?php else : ?>
                                        <svg viewBox="0 0 24 24" focusable="false">
                                            <path d="M7 17L17 7"></path>
                                            <path d="M9 7h8v8"></path>
                                        </svg>
                                    <?php endif; ?>
                                </span>
                                <span class="screen-reader-text"><?php echo esc_html($social_label); ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="section about-cta" aria-labelledby="about-cta-heading">
        <div class="container">
            <div class="about-cta-inner">
                <span class="about-cta-glow" aria-hidden="true"></span>
                <div class="about-cta-content">
                    <p class="eyebrow"><?php esc_html_e('READY TO WORK TOGETHER?', 'shanayn-labs'); ?></p>
                    <h2 id="about-cta-heading"><?php esc_html_e("Let's build a digital system your business can grow with.", 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('Start with a focused conversation about your website, marketing, software, or AI workflow.', 'shanayn-labs'); ?></p>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary">
                        <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <?php if (trim(get_the_content())) : ?>
                <section class="section about-page-placeholder">
                    <div class="container">
                        <h1><?php the_title(); ?></h1>

                        <div class="about-page-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
