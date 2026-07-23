<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main home-page">
    <section id="hero" class="hero-section hero-orbit" aria-labelledby="hero-heading">
        <div class="container hero-orbit-layout">
            <div class="hero-orbit-stage" aria-label="<?php echo esc_attr__('Tech and Business Operating System animation showing websites, marketing, software, AI, automation, agents, analytics, and growth orbiting the ShanaynLabs core.', 'shanayn-labs'); ?>" data-animate>
                <div class="orbit-panel">
                    <svg class="orbit-rings" viewBox="0 0 760 560" aria-hidden="true" focusable="false">
                        <circle class="orbit-ring orbit-ring-one" cx="380" cy="280" r="118" />
                        <circle class="orbit-ring orbit-ring-two" cx="380" cy="280" r="188" />
                        <circle class="orbit-ring orbit-ring-three" cx="380" cy="280" r="252" />
                        <path class="orbit-flow orbit-flow-one" d="M132 280 C210 104 548 104 628 280 C548 456 210 456 132 280Z" />
                        <path class="orbit-flow orbit-flow-two" d="M212 145 C378 54 604 170 584 330 C564 490 232 496 176 318 C148 228 170 176 212 145Z" />
                    </svg>

                    <div class="orbit-core">
                        <strong><?php esc_html_e("Shanayn's System", 'shanayn-labs'); ?></strong>
                    </div>

                    <div class="orbit-track orbit-track-one" aria-hidden="true">
                        <div class="orbit-node node-websites"><span><?php esc_html_e('Websites', 'shanayn-labs'); ?></span></div>
                        <div class="orbit-node node-marketing"><span><?php esc_html_e('Marketing', 'shanayn-labs'); ?></span></div>
                        <div class="orbit-node node-software"><span><?php esc_html_e('Software', 'shanayn-labs'); ?></span></div>
                    </div>

                    <div class="orbit-track orbit-track-two" aria-hidden="true">
                        <div class="orbit-node node-ai"><span><?php esc_html_e('AI', 'shanayn-labs'); ?></span></div>
                        <div class="orbit-node node-automation"><span><?php esc_html_e('Automation', 'shanayn-labs'); ?></span></div>
                        <div class="orbit-node node-agents"><span><?php esc_html_e('Agents', 'shanayn-labs'); ?></span></div>
                    </div>

                    <div class="orbit-track orbit-track-three" aria-hidden="true">
                        <div class="orbit-node node-analytics"><span><?php esc_html_e('Analytics', 'shanayn-labs'); ?></span></div>
                        <div class="orbit-node node-growth"><span><?php esc_html_e('Growth', 'shanayn-labs'); ?></span></div>
                    </div>

                    <span class="orbit-particle particle-one" aria-hidden="true"></span>
                    <span class="orbit-particle particle-two" aria-hidden="true"></span>
                    <span class="orbit-particle particle-three" aria-hidden="true"></span>
                </div>
            </div>

            <div class="hero-copy" data-animate>
                <p class="eyebrow hero-animate"><?php echo esc_html(get_bloginfo('name')); ?></p>
                <h1 id="hero-heading" class="hero-title hero-animate hero-animate-delay-1"><?php esc_html_e('Build a digital presence that actually brings business.', 'shanayn-labs'); ?></h1>
                <p class="hero-text hero-animate hero-animate-delay-2">
                    <?php esc_html_e('Websites, software, automations, and AI agents built to help businesses grow with structure.', 'shanayn-labs'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary hero-cta hero-animate hero-animate-delay-3">
                    <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                </a>
            </div>
        </div>
    </section>

    <section id="services" class="section service-pillars-section" aria-labelledby="services-heading">
        <div class="container">
            <div class="section-header" data-animate>
                <p class="eyebrow"><?php esc_html_e('SERVICES', 'shanayn-labs'); ?></p>
                <h2 id="services-heading"><?php esc_html_e('Three systems your business needs to build, grow, and scale.', 'shanayn-labs'); ?></h2>
                <p><?php esc_html_e('ShanaynLabs connects digital presence, marketing execution, and software intelligence into practical systems that help businesses look credible, generate demand, and operate smarter.', 'shanayn-labs'); ?></p>
            </div>

            <div class="pillar-grid premium-pillars">
                <article class="pillar-card pillar-card-presence" tabindex="0" data-animate>
                    <span class="service-number"><?php esc_html_e('01', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Digital Presence', 'shanayn-labs'); ?></h3>
                    <div class="pillar-details">
                        <p><?php esc_html_e('We design and develop websites, ecommerce stores, and landing pages that make your business look credible and turn visitors into inquiries.', 'shanayn-labs'); ?></p>
                        <div class="chip-list">
                            <span><?php esc_html_e('WordPress Websites', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Ecommerce Stores', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Shopify Stores', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Landing Pages', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('SEO Setup', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Analytics & Tracking', 'shanayn-labs'); ?></span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="text-link pillar-link"><?php esc_html_e('Build your presence', 'shanayn-labs'); ?></a>
                    </div>
                </article>

                <article class="pillar-card pillar-card-growth" tabindex="0" data-animate>
                    <span class="service-number"><?php esc_html_e('02', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Growth Engine', 'shanayn-labs'); ?></h3>
                    <div class="pillar-details">
                        <p><?php esc_html_e('We create content, campaigns, and lead-generation systems that keep your business visible and turn attention into measurable action.', 'shanayn-labs'); ?></p>
                        <div class="chip-list">
                            <span><?php esc_html_e('Social Media Management', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Content Production', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Lead Generation', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Meta Ads', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Email Marketing', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Conversion Optimization', 'shanayn-labs'); ?></span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="text-link pillar-link"><?php esc_html_e('Grow your audience', 'shanayn-labs'); ?></a>
                    </div>
                </article>

                <article class="pillar-card pillar-card-intelligence" tabindex="0" data-animate>
                    <span class="service-number"><?php esc_html_e('03', 'shanayn-labs'); ?></span>
                    <h3><?php esc_html_e('Software Intelligence', 'shanayn-labs'); ?></h3>
                    <div class="pillar-details">
                        <p><?php esc_html_e('We build custom software, dashboards, automations, and AI agents that reduce manual work and give your business more control.', 'shanayn-labs'); ?></p>
                        <div class="chip-list">
                            <span><?php esc_html_e('Custom Software', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Web Apps', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('SaaS MVPs', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Dashboards', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Automation Workflows', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('AI Agents', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Generative AI', 'shanayn-labs'); ?></span>
                        </div>
                        <a href="<?php echo esc_url(home_url('/services/')); ?>" class="text-link pillar-link"><?php esc_html_e('Automate your workflow', 'shanayn-labs'); ?></a>
                    </div>
                </article>
            </div>

        </div>
    </section>

    <?php
    $capability_marquee_rows = array(
        array(
            'class' => '',
            'items' => array(
                array('label' => __('WordPress Websites', 'shanayn-labs'), 'slug' => 'wordpress-websites', 'dot' => 'blue'),
                array('label' => __('Landing Pages', 'shanayn-labs'), 'slug' => 'landing-pages', 'dot' => 'blue'),
                array('label' => __('Ecommerce Stores', 'shanayn-labs'), 'slug' => 'ecommerce-stores', 'dot' => 'blue'),
                array('label' => __('Shopify Stores', 'shanayn-labs'), 'slug' => 'shopify-stores', 'dot' => 'blue'),
                array('label' => __('SEO', 'shanayn-labs'), 'slug' => 'seo', 'dot' => 'green'),
                array('label' => __('Google Business Profile', 'shanayn-labs'), 'slug' => 'google-business-profile', 'dot' => 'green'),
                array('label' => __('Social Media Management', 'shanayn-labs'), 'slug' => 'social-media-management', 'dot' => 'green'),
                array('label' => __('Meta Ads', 'shanayn-labs'), 'slug' => 'meta-ads', 'dot' => 'green'),
                array('label' => __('Content Strategy', 'shanayn-labs'), 'slug' => 'content-strategy', 'dot' => 'green'),
                array('label' => __('Email Marketing', 'shanayn-labs'), 'slug' => 'email-marketing', 'dot' => 'green'),
                array('label' => __('Web Analytics', 'shanayn-labs'), 'slug' => 'web-analytics', 'dot' => 'green'),
            ),
        ),
        array(
            'class' => ' marquee-row-reverse',
            'items' => array(
                array('label' => __('Custom Software', 'shanayn-labs'), 'slug' => 'custom-software', 'dot' => 'blue'),
                array('label' => __('Web Applications', 'shanayn-labs'), 'slug' => 'web-applications', 'dot' => 'blue'),
                array('label' => __('Business Dashboards', 'shanayn-labs'), 'slug' => 'business-dashboards', 'dot' => 'blue'),
                array('label' => __('CRM Systems', 'shanayn-labs'), 'slug' => 'crm-systems', 'dot' => 'blue'),
                array('label' => __('POS Systems', 'shanayn-labs'), 'slug' => 'pos-systems', 'dot' => 'blue'),
                array('label' => __('AI Automation', 'shanayn-labs'), 'slug' => 'ai-automation', 'dot' => 'purple'),
                array('label' => __('AI Chatbots', 'shanayn-labs'), 'slug' => 'ai-chatbots', 'dot' => 'purple'),
                array('label' => __('Workflow Automation', 'shanayn-labs'), 'slug' => 'workflow-automation', 'dot' => 'purple'),
                array('label' => __('Internal Tools', 'shanayn-labs'), 'slug' => 'internal-tools', 'dot' => 'purple'),
                array('label' => __('API Integrations', 'shanayn-labs'), 'slug' => 'api-integrations', 'dot' => 'purple'),
                array('label' => __('SaaS MVPs', 'shanayn-labs'), 'slug' => 'saas-mvps', 'dot' => 'blue'),
            ),
        ),
    );
    ?>
    <section id="capabilities" class="capabilities-marquee-section" aria-label="<?php echo esc_attr__('ShanaynLabs capabilities', 'shanayn-labs'); ?>">
        <div class="capabilities-marquee">
            <?php foreach ($capability_marquee_rows as $marquee_row) : ?>
                <div class="marquee-row<?php echo esc_attr($marquee_row['class']); ?>">
                    <div class="marquee-track">
                        <?php for ($group_index = 0; $group_index < 2; $group_index++) : ?>
                            <div class="marquee-group" <?php echo 1 === $group_index ? 'aria-hidden="true"' : ''; ?>>
                                <?php foreach ($marquee_row['items'] as $capability_item) : ?>
                                    <a class="capability-chip" href="<?php echo esc_url(home_url('/services/' . $capability_item['slug'] . '/')); ?>">
                                        <span class="capability-dot capability-dot-<?php echo esc_attr($capability_item['dot']); ?>" aria-hidden="true"></span>
                                        <span><?php echo esc_html($capability_item['label']); ?></span>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section id="work" class="section work-showcase section-dark" aria-labelledby="work-heading">
        <div class="container">
            <div class="section-header split-header work-showcase-header" data-animate>
                <div>
                    <p class="eyebrow"><?php esc_html_e('FEATURED WORK', 'shanayn-labs'); ?></p>
                    <h2 id="work-heading"><?php esc_html_e('Proof that strategy, design, and execution can work together.', 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('A look at the websites, systems, and digital foundations we build to help businesses become clearer, faster, and more conversion-ready.', 'shanayn-labs'); ?></p>
                </div>
                <a href="<?php echo esc_url(home_url('/work/')); ?>" class="arrow-link work-showcase-link"><?php esc_html_e('Explore all work', 'shanayn-labs'); ?></a>
            </div>

            <?php
            $featured_work = shanaynlabs_get_featured_work(4);
            $work_items     = array();
            $fallback_cases = array(
                array(
                    'project_type'   => __('Local Services', 'shanayn-labs'),
                    'title'          => __('Lead generation website system', 'shanayn-labs'),
                    'client_name'    => __('Service Business', 'shanayn-labs'),
                    'result_summary' => __('Clearer positioning and better inquiry flow.', 'shanayn-labs'),
                    'excerpt'        => __('A conversion-focused website structure designed to present services clearly, build trust, and support customer inquiries.', 'shanayn-labs'),
                    'permalink'      => home_url('/work/'),
                    'project_url'    => '',
                    'tags'           => array(
                        __('Website Strategy', 'shanayn-labs'),
                        __('Service Pages', 'shanayn-labs'),
                        __('Lead Flow', 'shanayn-labs'),
                    ),
                ),
                array(
                    'project_type'   => __('Ecommerce', 'shanayn-labs'),
                    'title'          => __('Ecommerce product foundation', 'shanayn-labs'),
                    'client_name'    => __('Product Business', 'shanayn-labs'),
                    'result_summary' => __('Cleaner product discovery and stronger catalog structure.', 'shanayn-labs'),
                    'excerpt'        => __('A structured ecommerce experience designed around product organization, search visibility, and conversion-ready pages.', 'shanayn-labs'),
                    'permalink'      => home_url('/work/'),
                    'project_url'    => '',
                    'tags'           => array(
                        __('Product Catalog', 'shanayn-labs'),
                        __('Ecommerce UX', 'shanayn-labs'),
                        __('SEO Foundation', 'shanayn-labs'),
                    ),
                ),
                array(
                    'project_type'   => __('Operations', 'shanayn-labs'),
                    'title'          => __('Customer workflow dashboard', 'shanayn-labs'),
                    'client_name'    => __('Internal Operations', 'shanayn-labs'),
                    'result_summary' => __('Better visibility into tasks, customers, and follow-ups.', 'shanayn-labs'),
                    'excerpt'        => __('A lightweight dashboard concept for tracking requests, automating steps, and reducing manual follow-up gaps.', 'shanayn-labs'),
                    'permalink'      => home_url('/work/'),
                    'project_url'    => '',
                    'tags'           => array(
                        __('Dashboard', 'shanayn-labs'),
                        __('Workflow', 'shanayn-labs'),
                        __('Automation', 'shanayn-labs'),
                    ),
                ),
                array(
                    'project_type'   => __('Software', 'shanayn-labs'),
                    'title'          => __('Business operations system', 'shanayn-labs'),
                    'client_name'    => __('Growing Business', 'shanayn-labs'),
                    'result_summary' => __('Cleaner data, stronger workflows, and better reporting.', 'shanayn-labs'),
                    'excerpt'        => __('A practical software system concept designed to connect customer activity, daily tasks, and business visibility.', 'shanayn-labs'),
                    'permalink'      => home_url('/work/'),
                    'project_url'    => '',
                    'tags'           => array(
                        __('Software', 'shanayn-labs'),
                        __('Reporting', 'shanayn-labs'),
                        __('Operations', 'shanayn-labs'),
                    ),
                ),
            );

            $build_work_tags = static function ($project_type, $slot) {
                $base_tags = array(
                    0 => array('Conversion', 'Structure', 'Delivery'),
                    1 => array('Discovery', 'Pages', 'Experience'),
                    2 => array('Workflow', 'Visibility', 'Systems'),
                );
                $tags = $base_tags[$slot] ?? array('Strategy', 'Execution', 'Systems');

                if ($project_type) {
                    array_unshift($tags, $project_type);
                }

                return array_slice(array_unique($tags), 0, 3);
            };

            if ($featured_work->have_posts()) :
                while ($featured_work->have_posts()) :
                    $featured_work->the_post();
                    $work_items[] = array(
                        'project_type'   => get_post_meta(get_the_ID(), '_shanaynlabs_project_type', true),
                        'title'          => get_the_title(),
                        'client_name'    => get_post_meta(get_the_ID(), '_shanaynlabs_client_name', true),
                        'result_summary' => get_post_meta(get_the_ID(), '_shanaynlabs_result_summary', true),
                        'excerpt'        => has_excerpt() ? get_the_excerpt() : '',
                        'permalink'      => get_permalink(),
                        'project_url'    => get_post_meta(get_the_ID(), '_shanaynlabs_project_url', true),
                        'thumbnail'      => has_post_thumbnail() ? get_the_post_thumbnail(
                            get_the_ID(),
                            'large',
                            array(
                                'class' => 'work-proof-image',
                                'alt' => esc_attr(get_the_title()),
                            )
                        ) : '',
                    );
                endwhile;
                wp_reset_postdata();
            endif;

            $item_count = count($work_items);
            while ($item_count < 4) {
                $work_items[] = $fallback_cases[$item_count];
                $item_count++;
            }

            foreach ($work_items as $work_item_index => $work_item) {
                if (empty($work_item['tags'])) {
                    $work_items[$work_item_index]['tags'] = $build_work_tags(
                        isset($work_item['project_type']) ? $work_item['project_type'] : '',
                        $work_item_index
                    );
                }
            }

            $work_items = array_slice($work_items, 0, 4);
            ?>

            <div class="work-proof-layout work-proof-grid">
                <?php foreach ($work_items as $work_item) : ?>
                    <article class="work-proof-card premium-card-dark" data-animate>
                        <a class="work-proof-media" href="<?php echo esc_url($work_item['permalink']); ?>" aria-label="<?php echo esc_attr($work_item['title']); ?>">
                            <?php if (!empty($work_item['thumbnail'])) : ?>
                                <?php echo $work_item['thumbnail']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <?php else : ?>
                                <span class="work-proof-media-fallback" aria-hidden="true">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            <?php endif; ?>
                        </a>

                        <div class="work-proof-card-body">
                            <?php if (!empty($work_item['project_type'])) : ?>
                                <p class="work-proof-kicker"><?php echo esc_html($work_item['project_type']); ?></p>
                            <?php endif; ?>

                            <h3>
                                <a href="<?php echo esc_url($work_item['permalink']); ?>">
                                    <?php echo esc_html($work_item['title']); ?>
                                </a>
                            </h3>

                            <?php if (!empty($work_item['result_summary'])) : ?>
                                <p class="work-proof-result"><?php echo esc_html($work_item['result_summary']); ?></p>
                            <?php endif; ?>

                            <?php if (!empty($work_item['excerpt'])) : ?>
                                <p class="work-proof-excerpt"><?php echo esc_html(wp_trim_words(wp_strip_all_tags($work_item['excerpt']), 18, '...')); ?></p>
                            <?php endif; ?>

                            <div class="work-proof-tags">
                                <?php foreach ($work_item['tags'] as $work_tag) : ?>
                                    <span><?php echo esc_html($work_tag); ?></span>
                                <?php endforeach; ?>
                            </div>

                            <div class="work-proof-actions">
                                <a href="<?php echo esc_url($work_item['permalink']); ?>" class="arrow-link"><?php esc_html_e('View case study', 'shanayn-labs'); ?></a>
                                <?php if (!empty($work_item['project_url'])) : ?>
                                    <a href="<?php echo esc_url($work_item['project_url']); ?>" class="arrow-link"><?php esc_html_e('Visit project', 'shanayn-labs'); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="products" class="section products-section" aria-labelledby="products-heading">
        <div class="container">
            <div class="section-header split-header products-showcase-header" data-animate>
                <div>
                    <p class="eyebrow"><?php esc_html_e('PRODUCTS', 'shanayn-labs'); ?></p>
                    <h2 id="products-heading"><?php esc_html_e('Software products framed as', 'shanayn-labs'); ?><br><span class="products-heading-break"><?php esc_html_e('business solutions.', 'shanayn-labs'); ?></span></h2>
                    <p><?php esc_html_e('Practical systems for businesses that need better control, faster workflows, and smarter digital operations.', 'shanayn-labs'); ?></p>
                </div>
                <a href="<?php echo esc_url(home_url('/products/')); ?>" class="arrow-link products-showcase-link"><?php esc_html_e('Explore product systems', 'shanayn-labs'); ?></a>
            </div>

            <?php
            $featured_products = shanaynlabs_get_featured_products(3);
            $product_items      = array();
            $fallback_products  = array(
                array(
                    'title'       => __('POS & CRM Systems', 'shanayn-labs'),
                    'type'        => __('Operations System', 'shanayn-labs'),
                    'description' => __('Manage sales, customers, inventory, and daily operations.', 'shanayn-labs'),
                    'permalink'   => home_url('/products/'),
                    'demo_url'    => '',
                    'cta_text'    => '',
                    'preview'     => 'pos',
                ),
                array(
                    'title'       => __('Business Dashboards', 'shanayn-labs'),
                    'type'        => __('Reporting System', 'shanayn-labs'),
                    'description' => __('Track performance, reports, KPIs, and business activity.', 'shanayn-labs'),
                    'permalink'   => home_url('/products/'),
                    'demo_url'    => '',
                    'cta_text'    => '',
                    'preview'     => 'dashboard',
                ),
                array(
                    'title'       => __('AI Workflow Kits', 'shanayn-labs'),
                    'type'        => __('AI Automation', 'shanayn-labs'),
                    'description' => __('Automate content, support, tasks, and internal processes.', 'shanayn-labs'),
                    'permalink'   => home_url('/products/'),
                    'demo_url'    => '',
                    'cta_text'    => '',
                    'preview'     => 'ai',
                ),
            );

            $detect_product_preview = static function ($title, $type, $index) {
                $haystack = strtolower(trim($title . ' ' . $type));

                if (false !== strpos($haystack, 'pos') || false !== strpos($haystack, 'crm') || false !== strpos($haystack, 'sales') || false !== strpos($haystack, 'inventory')) {
                    return 'pos';
                }

                if (false !== strpos($haystack, 'dashboard') || false !== strpos($haystack, 'report') || false !== strpos($haystack, 'kpi') || false !== strpos($haystack, 'analytic')) {
                    return 'dashboard';
                }

                if (false !== strpos($haystack, 'ai') || false !== strpos($haystack, 'workflow') || false !== strpos($haystack, 'automation') || false !== strpos($haystack, 'agent')) {
                    return 'ai';
                }

                return 0 === $index ? 'pos' : (1 === $index ? 'dashboard' : 'ai');
            };

            if ($featured_products->have_posts()) :
                $product_index = 0;
                while ($featured_products->have_posts()) :
                    $featured_products->the_post();
                    $product_type = get_post_meta(get_the_ID(), '_shanaynlabs_product_type', true);
                    $demo_url = get_post_meta(get_the_ID(), '_shanaynlabs_demo_url', true);
                    $cta_text = get_post_meta(get_the_ID(), '_shanaynlabs_cta_text', true);
                    $description = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 18, '...');

                    $product_items[] = array(
                        'title'       => get_the_title(),
                        'type'        => $product_type ? $product_type : __('Product System', 'shanayn-labs'),
                        'description' => $description ? $description : __('Practical digital tooling designed around operations, reporting, and better workflows.', 'shanayn-labs'),
                        'permalink'   => get_permalink(),
                        'demo_url'    => $demo_url,
                        'cta_text'    => $cta_text,
                        'preview'     => $detect_product_preview(get_the_title(), $product_type, $product_index),
                    );
                    $product_index++;
                endwhile;
                wp_reset_postdata();
            endif;

            while (count($product_items) < 3) {
                $product_items[] = $fallback_products[count($product_items)];
            }
            ?>

            <div class="products-showcase" data-products-showcase data-animate>
                <div class="product-selector" role="tablist" aria-label="<?php echo esc_attr__('Product systems', 'shanayn-labs'); ?>">
                    <?php foreach ($product_items as $product_index => $product_item) : ?>
                        <button
                            type="button"
                            class="product-selector-item<?php echo 0 === $product_index ? ' is-active' : ''; ?>"
                            id="<?php echo esc_attr('product-tab-' . $product_index); ?>"
                            role="tab"
                            aria-selected="<?php echo 0 === $product_index ? 'true' : 'false'; ?>"
                            aria-controls="<?php echo esc_attr('product-panel-' . $product_index); ?>"
                            tabindex="<?php echo 0 === $product_index ? '0' : '-1'; ?>"
                            data-product-target="<?php echo esc_attr('product-panel-' . $product_index); ?>"
                        >
                            <span class="product-selector-item__number"><?php echo esc_html(str_pad((string) ($product_index + 1), 2, '0', STR_PAD_LEFT)); ?></span>
                            <span class="product-selector-item__content">
                                <strong><?php echo esc_html($product_item['title']); ?></strong>
                                <span><?php echo esc_html($product_item['description']); ?></span>
                            </span>
                            <span class="product-selector-item__arrow" aria-hidden="true">&rarr;</span>
                        </button>
                    <?php endforeach; ?>
                </div>

                <div class="product-preview">
                    <?php foreach ($product_items as $product_index => $product_item) : ?>
                        <section
                            class="product-preview-panel<?php echo 0 === $product_index ? ' is-active' : ''; ?>"
                            id="<?php echo esc_attr('product-panel-' . $product_index); ?>"
                            role="tabpanel"
                            aria-labelledby="<?php echo esc_attr('product-tab-' . $product_index); ?>"
                            <?php echo 0 === $product_index ? '' : 'hidden'; ?>
                        >
                            <div class="product-preview-panel__header">
                                <p class="product-preview-panel__eyebrow"><?php echo esc_html($product_item['type']); ?></p>
                                <h3><?php echo esc_html($product_item['title']); ?></h3>
                                <p><?php echo esc_html($product_item['description']); ?></p>
                            </div>

                            <?php if ('dashboard' === $product_item['preview']) : ?>
                                <div class="product-preview-canvas product-preview-canvas-dashboard" aria-hidden="true">
                                    <div class="product-ui-window">
                                        <div class="product-ui-window__bar"><span></span><span></span><span></span></div>
                                        <div class="product-ui-window__body">
                                            <div class="product-ui-kpis">
                                                <div class="product-ui-kpi"><small><?php esc_html_e('Revenue Overview', 'shanayn-labs'); ?></small><strong><?php esc_html_e('Monthly Growth', 'shanayn-labs'); ?></strong></div>
                                                <div class="product-ui-kpi"><small><?php esc_html_e('KPI Tracking', 'shanayn-labs'); ?></small><strong><?php esc_html_e('Performance Snapshot', 'shanayn-labs'); ?></strong></div>
                                                <div class="product-ui-kpi"><small><?php esc_html_e('Monthly Report', 'shanayn-labs'); ?></small><strong><?php esc_html_e('Active Metrics', 'shanayn-labs'); ?></strong></div>
                                            </div>
                                            <div class="product-ui-grid">
                                                <div class="product-ui-chart">
                                                    <div class="product-ui-chart__line"></div>
                                                    <div class="product-ui-chart__bars"><span></span><span></span><span></span><span></span><span></span></div>
                                                </div>
                                                <div class="product-ui-feed">
                                                    <div class="product-ui-feed__row"></div>
                                                    <div class="product-ui-feed__row short"></div>
                                                    <div class="product-ui-feed__row"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php elseif ('ai' === $product_item['preview']) : ?>
                                <div class="product-preview-canvas product-preview-canvas-ai" aria-hidden="true">
                                    <div class="product-ui-window">
                                        <div class="product-ui-window__bar"><span></span><span></span><span></span></div>
                                        <div class="product-ui-window__body">
                                            <div class="product-ui-assistant">
                                                <div class="product-ui-assistant__card">
                                                    <small><?php esc_html_e('AI Assistant', 'shanayn-labs'); ?></small>
                                                    <strong><?php esc_html_e('Generate Draft', 'shanayn-labs'); ?></strong>
                                                </div>
                                                <div class="product-ui-assistant__flow">
                                                    <span><?php esc_html_e('Review Step', 'shanayn-labs'); ?></span>
                                                    <span><?php esc_html_e('Approval Flow', 'shanayn-labs'); ?></span>
                                                    <span><?php esc_html_e('Task Automation', 'shanayn-labs'); ?></span>
                                                </div>
                                            </div>
                                            <div class="product-ui-automation">
                                                <div class="product-ui-node is-primary"></div>
                                                <div class="product-ui-node"></div>
                                                <div class="product-ui-node"></div>
                                                <div class="product-ui-node"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="product-preview-canvas product-preview-canvas-pos" aria-hidden="true">
                                    <div class="product-ui-window">
                                        <div class="product-ui-window__bar"><span></span><span></span><span></span></div>
                                        <div class="product-ui-window__body">
                                            <div class="product-ui-kpis">
                                                <div class="product-ui-kpi"><small><?php esc_html_e('Today\'s Sales', 'shanayn-labs'); ?></small><strong><?php esc_html_e('Sales Overview', 'shanayn-labs'); ?></strong></div>
                                                <div class="product-ui-kpi"><small><?php esc_html_e('Customers', 'shanayn-labs'); ?></small><strong><?php esc_html_e('Active Accounts', 'shanayn-labs'); ?></strong></div>
                                            </div>
                                            <div class="product-ui-grid">
                                                <div class="product-ui-table">
                                                    <div class="product-ui-table__head"></div>
                                                    <div class="product-ui-table__row"></div>
                                                    <div class="product-ui-table__row short"></div>
                                                    <div class="product-ui-table__row"></div>
                                                </div>
                                                <div class="product-ui-sidepanels">
                                                    <div class="product-ui-panel-card">
                                                        <small><?php esc_html_e('Recent Orders', 'shanayn-labs'); ?></small>
                                                        <strong><?php esc_html_e('Invoice Draft', 'shanayn-labs'); ?></strong>
                                                    </div>
                                                    <div class="product-ui-statuses">
                                                        <span><?php esc_html_e('Inventory', 'shanayn-labs'); ?></span>
                                                        <span><?php esc_html_e('Pending', 'shanayn-labs'); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </section>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </section>

    <section id="process" class="section process-section" aria-labelledby="process-heading" data-animate>
        <div class="container">
            <?php
            $process_steps = array(
                array(
                    'number'      => '01',
                    'title'       => __('Discover', 'shanayn-labs'),
                    'description' => __('We understand your business, goals, audience, and the operational gaps your digital system needs to solve.', 'shanayn-labs'),
                    'icon'        => '<svg viewBox="0 0 24 24" role="presentation" focusable="false"><circle cx="11" cy="11" r="6.5"></circle><path d="M16 16L21 21"></path><path d="M11 7.5V11L13.5 12.5"></path></svg>',
                ),
                array(
                    'number'      => '02',
                    'title'       => __('Design', 'shanayn-labs'),
                    'description' => __('We shape the structure, user journey, interfaces, and conversion flow before development begins.', 'shanayn-labs'),
                    'icon'        => '<svg viewBox="0 0 24 24" role="presentation" focusable="false"><rect x="4" y="5" width="16" height="14" rx="2"></rect><path d="M4 10H20"></path><path d="M9 10V19"></path><path d="M12 14H17"></path></svg>',
                ),
                array(
                    'number'      => '03',
                    'title'       => __('Build', 'shanayn-labs'),
                    'description' => __('We develop the website, platform, automation, or software system with clean execution and practical functionality.', 'shanayn-labs'),
                    'icon'        => '<svg viewBox="0 0 24 24" role="presentation" focusable="false"><path d="M8 8L4 12L8 16"></path><path d="M16 8L20 12L16 16"></path><path d="M10 19L14 5"></path></svg>',
                ),
                array(
                    'number'      => '04',
                    'title'       => __('Launch', 'shanayn-labs'),
                    'description' => __('We test, refine, deploy, and prepare the final system for real-world use.', 'shanayn-labs'),
                    'icon'        => '<svg viewBox="0 0 24 24" role="presentation" focusable="false"><path d="M12 4L16 8L13.5 17H10.5L8 8L12 4Z"></path><path d="M9 15L6 19"></path><path d="M15 15L18 19"></path><path d="M10 8H14"></path></svg>',
                ),
                array(
                    'number'      => '05',
                    'title'       => __('Grow', 'shanayn-labs'),
                    'description' => __('We monitor, improve, and support long-term performance so the system keeps creating value.', 'shanayn-labs'),
                    'icon'        => '<svg viewBox="0 0 24 24" role="presentation" focusable="false"><path d="M4 17L9 12L13 15L20 8"></path><path d="M20 8H15"></path><path d="M20 8V13"></path><path d="M4 20H20"></path></svg>',
                ),
            );
            ?>

            <div class="process-layout">
                <div class="process-copy">
                    <div class="section-header process-section-header">
                        <p class="eyebrow"><?php esc_html_e('PROCESS', 'shanayn-labs'); ?></p>
                        <h2 id="process-heading"><?php esc_html_e('A clear path from idea to working system.', 'shanayn-labs'); ?></h2>
                        <p><?php esc_html_e('Every project follows a structured process - from understanding the problem to designing, building, launching, and improving the final solution.', 'shanayn-labs'); ?></p>
                    </div>
                    <p class="process-support"><?php esc_html_e('Each phase connects strategy, interface, engineering, and iteration so the final system is practical from day one.', 'shanayn-labs'); ?></p>
                    <ol class="process-copy-list" aria-label="<?php echo esc_attr__('Process steps', 'shanayn-labs'); ?>">
                        <?php foreach ($process_steps as $process_step) : ?>
                            <li>
                                <span><?php echo esc_html($process_step['number']); ?></span>
                                <strong><?php echo esc_html($process_step['title']); ?></strong>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <div class="process-orbit-wrap" aria-label="<?php echo esc_attr__('Circular process from discovery to growth', 'shanayn-labs'); ?>">
                    <div class="process-orbit">
                        <svg class="process-orbit-svg" viewBox="0 0 560 560" aria-hidden="true" focusable="false">
                            <circle class="process-orbit-guide process-orbit-guide-outer" cx="280" cy="280" r="210"></circle>
                            <circle class="process-orbit-guide process-orbit-guide-inner" cx="280" cy="280" r="142"></circle>
                            <path class="process-orbit-path" d="M 113 280 A 167 167 0 1 1 113.1 280"></path>
                            <path class="process-orbit-cross process-orbit-cross-a" d="M142 178 C212 112 350 112 418 178"></path>
                            <path class="process-orbit-cross process-orbit-cross-b" d="M142 382 C212 448 350 448 418 382"></path>
                        </svg>

                        <div class="process-center">
                            <span><?php esc_html_e('Working', 'shanayn-labs'); ?></span>
                            <strong><?php esc_html_e('System', 'shanayn-labs'); ?></strong>
                        </div>

                        <?php foreach ($process_steps as $process_index => $process_step) : ?>
                            <article class="process-node process-node-<?php echo esc_attr((string) ($process_index + 1)); ?>" style="--process-step-index: <?php echo esc_attr((string) $process_index); ?>;" tabindex="0">
                                <span class="process-node-icon" aria-hidden="true">
                                    <?php echo $process_step['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </span>
                                <span class="process-node-number"><?php echo esc_html($process_step['number']); ?></span>
                                <h3 class="process-node-title"><?php echo esc_html($process_step['title']); ?></h3>
                                <p><?php echo esc_html($process_step['description']); ?></p>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </div>

                <ol class="process-mobile-timeline" aria-label="<?php echo esc_attr__('Process timeline', 'shanayn-labs'); ?>">
                    <?php foreach ($process_steps as $process_index => $process_step) : ?>
                        <li class="process-mobile-step" style="--process-step-index: <?php echo esc_attr((string) $process_index); ?>;">
                            <span class="process-mobile-marker">
                                <span class="process-node-icon" aria-hidden="true">
                                    <?php echo $process_step['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </span>
                                <span class="process-node-number"><?php echo esc_html($process_step['number']); ?></span>
                            </span>
                            <div>
                                <h3><?php echo esc_html($process_step['title']); ?></h3>
                                <p><?php echo esc_html($process_step['description']); ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </div>
    </section>

    <section id="industries" class="section industries-section" aria-labelledby="industries-heading">
        <div class="container">
            <div class="section-header split-header" data-animate>
                <div>
                    <p class="eyebrow"><?php esc_html_e('INDUSTRIES', 'shanayn-labs'); ?></p>
                    <h2 id="industries-heading"><?php esc_html_e('Industries we help build smarter digital systems for.', 'shanayn-labs'); ?></h2>
                    <p><?php esc_html_e('We connect websites, marketing, software, and automation around the way each business actually operates.', 'shanayn-labs'); ?></p>
                </div>
            </div>
            <?php
            $featured_industries = shanaynlabs_get_featured_industries(6);

            $get_industry_badge = static function ($title) {
                $title_words = preg_split('/\s+/', trim((string) $title));
                $badge       = '';

                if (!empty($title_words)) {
                    foreach (array_slice($title_words, 0, 2) as $title_word) {
                        $clean_word = preg_replace('/[^A-Za-z0-9]/', '', $title_word);

                        if ($clean_word) {
                            $badge .= strtoupper(substr($clean_word, 0, 1));
                        }
                    }
                }

                return $badge ? $badge : strtoupper(substr((string) $title, 0, 2));
            };

            $render_industry_card = static function ($title, $description, $icon_text = '') use ($get_industry_badge) {
                static $industry_card_index = 0;

                if (!$icon_text) {
                    $icon_text = $get_industry_badge($title);
                }

                $description = wp_trim_words(wp_strip_all_tags((string) $description), 28, '...');
                ?>
                <article class="industry-slide-card industry-card" style="--industry-card-index: <?php echo esc_attr((string) $industry_card_index); ?>;">
                    <div class="industry-card-topline">
                        <span class="industry-card-icon-text" aria-hidden="true"><?php echo esc_html($icon_text); ?></span>
                    </div>
                    <div class="industry-card-body">
                        <h3 class="industry-card-title"><?php echo esc_html($title); ?></h3>
                        <p class="industry-card-description"><?php echo esc_html($description); ?></p>
                    </div>
                </article>
                <?php
                $industry_card_index++;
            };
            ?>
            <?php if ($featured_industries->have_posts()) : ?>
                <div class="industries-carousel" data-industries-slider aria-label="<?php echo esc_attr__('Industries carousel', 'shanayn-labs'); ?>" data-animate>
                    <div class="industries-carousel__controls">
                        <button type="button" class="industries-carousel__arrow" data-industries-prev aria-label="<?php echo esc_attr__('Previous industries', 'shanayn-labs'); ?>">
                            <span aria-hidden="true">&larr;</span>
                        </button>
                        <button type="button" class="industries-carousel__arrow" data-industries-next aria-label="<?php echo esc_attr__('Next industries', 'shanayn-labs'); ?>">
                            <span aria-hidden="true">&rarr;</span>
                        </button>
                    </div>
                    <div class="industries-carousel__viewport" data-industries-viewport tabindex="0">
                        <div class="industries-carousel__track">
                            <?php while ($featured_industries->have_posts()) : ?>
                                <?php
                                $featured_industries->the_post();
                                $industry_title = get_the_title();
                                $industry_description = get_post_meta(get_the_ID(), '_shanaynlabs_industry_short_description', true);
                                $industry_icon_text = get_post_meta(get_the_ID(), '_shanaynlabs_industry_icon_text', true);
                                $industry_description = $industry_description ? $industry_description : get_the_excerpt();
                                $industry_description = $industry_description ? $industry_description : __('Digital systems built around operations, acquisition, and smarter delivery.', 'shanayn-labs');
                                $render_industry_card($industry_title, $industry_description, $industry_icon_text);
                                ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section id="testimonials" class="section testimonials-section" aria-labelledby="testimonials-heading" data-animate>
        <div class="container">
            <div class="section-header testimonials-header">
                <p class="eyebrow"><?php esc_html_e('TESTIMONIALS', 'shanayn-labs'); ?></p>
                <h2 id="testimonials-heading"><?php esc_html_e('What clients say about working with ShanaynLabs.', 'shanayn-labs'); ?></h2>
                <p><?php esc_html_e('A few words from businesses that trusted us to structure, design, and improve their digital presence.', 'shanayn-labs'); ?></p>
            </div>

            <?php
            $featured_testimonials = shanaynlabs_get_featured_testimonials(3);
            $render_testimonial_card = static function ($quote, $client_name, $client_role_company, $rating = 0, $index = 0) {
                $rating = absint($rating);
                $rating = $rating ? min(5, max(1, $rating)) : 0;
                ?>
                <figure class="testimonial-card" style="--testimonial-index: <?php echo esc_attr((string) $index); ?>;">
                    <span class="testimonial-quote-mark" aria-hidden="true">&ldquo;</span>
                    <span class="testimonial-quote-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" role="presentation" focusable="false">
                            <path d="M9 7H5.8C4.8 7 4 7.8 4 8.8V12C4 15.3 5.6 17.3 8.8 18"></path>
                            <path d="M20 7H16.8C15.8 7 15 7.8 15 8.8V12C15 15.3 16.6 17.3 19.8 18"></path>
                        </svg>
                    </span>
                    <?php if ($quote) : ?>
                        <blockquote class="testimonial-text"><?php echo wp_kses_post(wpautop($quote)); ?></blockquote>
                    <?php endif; ?>
                    <figcaption class="testimonial-meta">
                        <?php if ($client_name) : ?>
                            <strong><?php echo esc_html($client_name); ?></strong>
                        <?php endif; ?>
                        <?php if ($client_role_company) : ?>
                            <span class="testimonial-role"><?php echo esc_html($client_role_company); ?></span>
                        <?php endif; ?>
                    </figcaption>
                    <?php if ($rating) : ?>
                        <div class="testimonial-stars" aria-label="<?php echo esc_attr(sprintf(__('%d out of 5 rating', 'shanayn-labs'), $rating)); ?>">
                            <span aria-hidden="true">
                                <?php for ($star_index = 1; $star_index <= 5; $star_index++) : ?>
                                    <span class="testimonial-star<?php echo $star_index <= $rating ? ' is-filled' : ''; ?>">&#9733;</span>
                                <?php endfor; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </figure>
                <?php
            };
            ?>

            <div class="testimonials-grid">
                <?php if ($featured_testimonials->have_posts()) : ?>
                    <?php $testimonial_index = 0; ?>
                    <?php while ($featured_testimonials->have_posts()) : ?>
                        <?php
                        $featured_testimonials->the_post();
                        $client_name = get_post_meta(get_the_ID(), '_shanaynlabs_testimonial_client_name', true);
                        $client_role_company = get_post_meta(get_the_ID(), '_shanaynlabs_client_role_company', true);
                        $rating_meta = get_post_meta(get_the_ID(), '_shanaynlabs_rating', true);
                        $review_text = has_excerpt() ? get_the_excerpt() : get_the_content();
                        $render_testimonial_card(
                            $review_text,
                            $client_name ? $client_name : get_the_title(),
                            $client_role_company,
                            '' !== $rating_meta ? $rating_meta : 0,
                            $testimonial_index
                        );
                        $testimonial_index++;
                        ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <?php
                    $fallback_testimonials = array(
                        array(
                            'quote' => __('ShanaynLabs helped us organize our digital presence with a clean, professional structure that made our services easier to understand.', 'shanayn-labs'),
                            'role' => __('Founder, Service Business', 'shanayn-labs'),
                            'rating' => 5,
                        ),
                        array(
                            'quote' => __('The process felt clear from start to finish. The final website looked professional, loaded smoothly, and matched our business direction.', 'shanayn-labs'),
                            'role' => __('Operations Lead, Local Business', 'shanayn-labs'),
                            'rating' => 5,
                        ),
                        array(
                            'quote' => __('They helped turn scattered ideas into a structured digital system with better pages, clearer content, and a more polished experience.', 'shanayn-labs'),
                            'role' => __('Managing Partner, Growing Brand', 'shanayn-labs'),
                            'rating' => 5,
                        ),
                    );

                    foreach ($fallback_testimonials as $fallback_index => $fallback_testimonial) {
                        $render_testimonial_card($fallback_testimonial['quote'], '', $fallback_testimonial['role'], $fallback_testimonial['rating'], $fallback_index);
                    }
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php
    shanaynlabs_render_project_inquiry_section(
        array(
            'id' => 'contact',
            'heading' => __("Let's build the system your business actually needs.", 'shanayn-labs'),
        )
    );
    ?>
</main>

<?php get_footer(); ?>
