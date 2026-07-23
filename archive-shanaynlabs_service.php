<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main-content" class="site-main">
    <section class="services-hero" aria-labelledby="services-archive-heading">
        <div class="container">
            <div class="services-hero-layout">
                <header class="services-hero-copy">
                    <p class="eyebrow"><?php esc_html_e('SERVICES', 'shanayn-labs'); ?></p>
                    <h1 id="services-archive-heading"><?php esc_html_e('Digital systems built to help your business look better, grow faster, and operate smarter.', 'shanayn-labs'); ?></h1>
                    <p><?php esc_html_e('From websites and marketing to software, dashboards, automation, and AI workflows — ShanaynLabs builds connected systems around real business needs.', 'shanayn-labs'); ?></p>
                    <div class="services-hero-actions">
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn-primary">
                            <?php esc_html_e('Book a Call', 'shanayn-labs'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/work/')); ?>" class="btn-secondary">
                            <?php esc_html_e('View Work', 'shanayn-labs'); ?>
                        </a>
                    </div>
                </header>

                <div class="services-hero-visual" aria-hidden="true">
                    <div class="services-system-stack">
                        <span class="services-system-line services-system-line-one"></span>
                        <span class="services-system-line services-system-line-two"></span>

                        <div class="services-system-layer services-system-layer-one">
                            <span class="services-system-dot"></span>
                            <div>
                                <p>01</p>
                                <h2><?php esc_html_e('Digital Presence', 'shanayn-labs'); ?></h2>
                                <div class="services-system-chips">
                                    <span><?php esc_html_e('Websites', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('SEO', 'shanayn-labs'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="services-system-layer services-system-layer-two">
                            <span class="services-system-dot services-system-dot-green"></span>
                            <div>
                                <p>02</p>
                                <h2><?php esc_html_e('Growth Engine', 'shanayn-labs'); ?></h2>
                                <div class="services-system-chips">
                                    <span><?php esc_html_e('Content', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('Ads', 'shanayn-labs'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="services-system-layer services-system-layer-three">
                            <span class="services-system-dot services-system-dot-purple"></span>
                            <div>
                                <p>03</p>
                                <h2><?php esc_html_e('Software Intelligence', 'shanayn-labs'); ?></h2>
                                <div class="services-system-chips">
                                    <span><?php esc_html_e('Automation', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('AI', 'shanayn-labs'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $service_system_steps = array(
        array(
            'number' => '01',
            'title' => __('Digital Presence', 'shanayn-labs'),
            'text' => __('Build trust and convert visitors.', 'shanayn-labs'),
            'url' => home_url('/service-pillar/digital-presence/'),
            'icon' => 'presence',
        ),
        array(
            'number' => '02',
            'title' => __('Growth Engine', 'shanayn-labs'),
            'text' => __('Bring attention, traffic, and leads.', 'shanayn-labs'),
            'url' => home_url('/service-pillar/growth-engine/'),
            'icon' => 'growth',
        ),
        array(
            'number' => '03',
            'title' => __('Software Intelligence', 'shanayn-labs'),
            'text' => __('Automate operations and scale workflows.', 'shanayn-labs'),
            'url' => home_url('/service-pillar/software-intelligence/'),
            'icon' => 'software',
        ),
    );
    ?>
    <section class="service-system-overview" aria-label="<?php echo esc_attr__('Service system overview', 'shanayn-labs'); ?>" data-animate>
        <div class="container service-system-inner">
            <div class="service-system-track">
                <?php foreach ($service_system_steps as $service_step) : ?>
                    <div class="service-system-step service-system-step-<?php echo esc_attr($service_step['icon']); ?>">
                        <a href="<?php echo esc_url($service_step['url']); ?>" class="service-system-step-link">
                            <span class="service-system-point">
                                <span class="service-system-number"><?php echo esc_html($service_step['number']); ?></span>
                            </span>

                            <span class="service-system-icon" aria-hidden="true">
                                <?php if ('presence' === $service_step['icon']) : ?>
                                    <svg viewBox="0 0 32 32" focusable="false">
                                        <rect x="5" y="7" width="22" height="17" rx="3"></rect>
                                        <path d="M5 12h22M10 18h6M10 21h10"></path>
                                    </svg>
                                <?php elseif ('growth' === $service_step['icon']) : ?>
                                    <svg viewBox="0 0 32 32" focusable="false">
                                        <path d="M6 23h20M9 20l5-5 4 3 6-8"></path>
                                        <path d="M20 10h4v4"></path>
                                    </svg>
                                <?php else : ?>
                                    <svg viewBox="0 0 32 32" focusable="false">
                                        <circle cx="9" cy="16" r="3"></circle>
                                        <circle cx="22" cy="9" r="3"></circle>
                                        <circle cx="23" cy="23" r="3"></circle>
                                        <path d="M12 15l7-5M12 17l8 5"></path>
                                    </svg>
                                <?php endif; ?>
                            </span>

                            <span class="service-system-title"><?php echo esc_html($service_step['title']); ?></span>
                            <span class="service-system-text"><?php echo esc_html($service_step['text']); ?></span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php
    $digital_presence_pills = array(
        array(
            'label' => __('WordPress Websites', 'shanayn-labs'),
            'highlight' => 'hero',
        ),
        array(
            'label' => __('Landing Pages', 'shanayn-labs'),
            'highlight' => 'form',
        ),
        array(
            'label' => __('Ecommerce Stores', 'shanayn-labs'),
            'highlight' => 'products',
        ),
        array(
            'label' => __('Shopify Stores', 'shanayn-labs'),
            'highlight' => 'mobile',
        ),
        array(
            'label' => __('Service Pages', 'shanayn-labs'),
            'highlight' => 'services',
        ),
        array(
            'label' => __('Website Redesign', 'shanayn-labs'),
            'highlight' => 'redesign',
        ),
        array(
            'label' => __('Conversion-Focused UX', 'shanayn-labs'),
            'highlight' => 'conversion',
        ),
    );
    ?>
    <section class="digital-presence-section" aria-labelledby="digital-presence-heading" data-animate>
        <div class="container digital-presence-inner">
            <div class="digital-presence-copy">
                <p class="digital-presence-eyebrow"><?php esc_html_e('01 / DIGITAL PRESENCE', 'shanayn-labs'); ?></p>
                <h2 id="digital-presence-heading" class="digital-presence-title"><?php esc_html_e('Premium websites and digital experiences that make your business look trusted.', 'shanayn-labs'); ?></h2>
                <p class="digital-presence-description"><?php esc_html_e('We design and build websites, landing pages, and online stores that help businesses present their services clearly, build credibility, and convert visitors into inquiries or customers.', 'shanayn-labs'); ?></p>

                <div class="digital-presence-pills" aria-label="<?php echo esc_attr__('Digital Presence services', 'shanayn-labs'); ?>">
                    <?php foreach ($digital_presence_pills as $presence_pill) : ?>
                        <button class="digital-presence-pill" type="button" data-highlight="<?php echo esc_attr($presence_pill['highlight']); ?>">
                            <span aria-hidden="true"></span>
                            <?php echo esc_html($presence_pill['label']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="digital-presence-visual" aria-hidden="true">
                <div class="dp-mockup">
                    <div class="dp-mockup-browser">
                        <div class="dp-mockup-topbar">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <div class="dp-mockup-body">
                            <div class="dp-mockup-hero">
                                <div class="dp-mockup-hero-copy">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="dp-mockup-hero-cta"></div>
                            </div>

                            <div class="dp-mockup-services">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>

                            <div class="dp-mockup-lower">
                                <div class="dp-mockup-products">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>

                                <div class="dp-mockup-form">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dp-mockup-mobile">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $growth_engine_pills = array(
        array('label' => __('SEO', 'shanayn-labs'), 'highlight' => 'analytics'),
        array('label' => __('Google Business Profile', 'shanayn-labs'), 'highlight' => 'profile'),
        array('label' => __('Social Media Management', 'shanayn-labs'), 'highlight' => 'calendar'),
        array('label' => __('Meta Ads', 'shanayn-labs'), 'highlight' => 'campaigns'),
        array('label' => __('Content Strategy', 'shanayn-labs'), 'highlight' => 'calendar'),
        array('label' => __('Email Marketing', 'shanayn-labs'), 'highlight' => 'campaigns'),
        array('label' => __('Web Analytics', 'shanayn-labs'), 'highlight' => 'analytics'),
        array('label' => __('Lead Generation', 'shanayn-labs'), 'highlight' => 'leads'),
    );
    ?>
    <section class="growth-engine-section" aria-labelledby="growth-engine-heading" data-animate>
        <div class="container growth-engine-inner">
            <div class="growth-engine-visual" aria-hidden="true">
                <div class="ge-command-center">
                    <div class="ge-panel ge-analytics-panel">
                        <div class="ge-panel-header">
                            <span><?php esc_html_e('Traffic', 'shanayn-labs'); ?></span>
                            <strong><?php esc_html_e('4 channels', 'shanayn-labs'); ?></strong>
                        </div>
                        <svg class="ge-graph" viewBox="0 0 240 92" focusable="false">
                            <path class="ge-graph-grid" d="M8 74H232M8 48H232M8 22H232"></path>
                            <path class="ge-graph-line" d="M10 70C38 62 50 40 76 46C104 53 114 29 142 34C172 39 184 18 230 22"></path>
                        </svg>
                    </div>

                    <div class="ge-panel ge-calendar-panel">
                        <div class="ge-panel-header">
                            <span><?php esc_html_e('Content', 'shanayn-labs'); ?></span>
                            <strong><?php esc_html_e('12 posts', 'shanayn-labs'); ?></strong>
                        </div>
                        <div class="ge-calendar-grid">
                            <span class="ge-content-card"><?php esc_html_e('Social', 'shanayn-labs'); ?></span>
                            <span class="ge-content-card"><?php esc_html_e('Content', 'shanayn-labs'); ?></span>
                            <span class="ge-content-card"><?php esc_html_e('Email', 'shanayn-labs'); ?></span>
                            <span class="ge-content-card"><?php esc_html_e('Ads', 'shanayn-labs'); ?></span>
                        </div>
                    </div>

                    <div class="ge-panel ge-campaign-panel">
                        <div class="ge-panel-header">
                            <span><?php esc_html_e('Campaigns', 'shanayn-labs'); ?></span>
                            <strong><?php esc_html_e('6 campaigns', 'shanayn-labs'); ?></strong>
                        </div>
                        <div class="ge-campaign-list">
                            <span class="ge-campaign-tag"><?php esc_html_e('Meta Ads', 'shanayn-labs'); ?><em><?php esc_html_e('Active', 'shanayn-labs'); ?></em></span>
                            <span class="ge-campaign-tag"><?php esc_html_e('SEO', 'shanayn-labs'); ?><em><?php esc_html_e('Optimize', 'shanayn-labs'); ?></em></span>
                            <span class="ge-campaign-tag"><?php esc_html_e('Email', 'shanayn-labs'); ?><em><?php esc_html_e('Review', 'shanayn-labs'); ?></em></span>
                        </div>
                    </div>

                    <div class="ge-panel ge-leads-panel">
                        <div class="ge-panel-header">
                            <span><?php esc_html_e('Leads', 'shanayn-labs'); ?></span>
                            <strong><?php esc_html_e('24 leads', 'shanayn-labs'); ?></strong>
                        </div>
                        <div class="ge-lead-list">
                            <span class="ge-lead-bar ge-lead-bar-organic"><em><?php esc_html_e('Organic', 'shanayn-labs'); ?></em></span>
                            <span class="ge-lead-bar ge-lead-bar-social"><em><?php esc_html_e('Social', 'shanayn-labs'); ?></em></span>
                            <span class="ge-lead-bar ge-lead-bar-paid"><em><?php esc_html_e('Paid', 'shanayn-labs'); ?></em></span>
                            <span class="ge-lead-bar ge-lead-bar-email"><em><?php esc_html_e('Email', 'shanayn-labs'); ?></em></span>
                        </div>
                    </div>

                    <div class="ge-panel ge-profile-card">
                        <div class="ge-panel-header">
                            <span><?php esc_html_e('Visibility', 'shanayn-labs'); ?></span>
                            <strong><?php esc_html_e('Business Profile', 'shanayn-labs'); ?></strong>
                        </div>
                        <div class="ge-profile-rating">
                            <span></span><span></span><span></span><span></span><span></span>
                        </div>
                        <p><?php esc_html_e('Local visibility system', 'shanayn-labs'); ?></p>
                    </div>
                </div>
            </div>

            <div class="growth-engine-copy">
                <p class="growth-engine-eyebrow"><?php esc_html_e('02 / GROWTH ENGINE', 'shanayn-labs'); ?></p>
                <h2 id="growth-engine-heading" class="growth-engine-title"><?php esc_html_e('Marketing systems designed to bring consistent attention and qualified leads.', 'shanayn-labs'); ?></h2>
                <p class="growth-engine-description"><?php esc_html_e('We help businesses build visibility through SEO, social media, content, paid campaigns, analytics, email marketing, and local growth systems.', 'shanayn-labs'); ?></p>

                <div class="growth-engine-pills" aria-label="<?php echo esc_attr__('Growth Engine services', 'shanayn-labs'); ?>">
                    <?php foreach ($growth_engine_pills as $growth_pill) : ?>
                        <button class="growth-engine-pill" type="button" data-growth-highlight="<?php echo esc_attr($growth_pill['highlight']); ?>">
                            <span aria-hidden="true"></span>
                            <?php echo esc_html($growth_pill['label']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    $software_intelligence_pills = array(
        array('label' => __('Custom Software', 'shanayn-labs'), 'highlight' => 'dashboard'),
        array('label' => __('Web Applications', 'shanayn-labs'), 'highlight' => 'tasks'),
        array('label' => __('Business Dashboards', 'shanayn-labs'), 'highlight' => 'kpi'),
        array('label' => __('CRM Systems', 'shanayn-labs'), 'highlight' => 'crm'),
        array('label' => __('POS Systems', 'shanayn-labs'), 'highlight' => 'integrations'),
        array('label' => __('AI Automation', 'shanayn-labs'), 'highlight' => 'ai'),
        array('label' => __('AI Chatbots', 'shanayn-labs'), 'highlight' => 'ai'),
        array('label' => __('Workflow Automation', 'shanayn-labs'), 'highlight' => 'automation'),
        array('label' => __('Internal Tools', 'shanayn-labs'), 'highlight' => 'tasks'),
        array('label' => __('API Integrations', 'shanayn-labs'), 'highlight' => 'integrations'),
        array('label' => __('SaaS MVPs', 'shanayn-labs'), 'highlight' => 'dashboard'),
    );
    ?>
    <section class="software-intelligence-section" aria-labelledby="software-intelligence-heading" data-animate>
        <div class="container software-intelligence-inner">
            <div class="software-intelligence-copy">
                <p class="software-intelligence-eyebrow"><?php esc_html_e('03 / SOFTWARE INTELLIGENCE', 'shanayn-labs'); ?></p>
                <h2 id="software-intelligence-heading" class="software-intelligence-title"><?php esc_html_e('Custom software, dashboards, and AI workflows built around your operations.', 'shanayn-labs'); ?></h2>
                <p class="software-intelligence-description"><?php esc_html_e('We build practical software systems that help businesses manage data, automate repetitive tasks, improve workflows, and make better decisions.', 'shanayn-labs'); ?></p>

                <div class="software-intelligence-pills" aria-label="<?php echo esc_attr__('Software Intelligence services', 'shanayn-labs'); ?>">
                    <?php foreach ($software_intelligence_pills as $software_pill) : ?>
                        <button class="software-intelligence-pill" type="button" data-software-highlight="<?php echo esc_attr($software_pill['highlight']); ?>">
                            <span aria-hidden="true"></span>
                            <?php echo esc_html($software_pill['label']); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="software-intelligence-visual" aria-hidden="true">
                <div class="si-dashboard">
                    <div class="si-dashboard-shell">
                        <div class="si-dashboard-topbar">
                            <span><?php esc_html_e('Operations OS', 'shanayn-labs'); ?></span>
                            <em><?php esc_html_e('Connect', 'shanayn-labs'); ?></em>
                        </div>

                        <div class="si-kpi-grid">
                            <span class="si-kpi-card"><strong><?php esc_html_e('Track', 'shanayn-labs'); ?></strong><em><?php esc_html_e('Data', 'shanayn-labs'); ?></em></span>
                            <span class="si-kpi-card"><strong><?php esc_html_e('Manage', 'shanayn-labs'); ?></strong><em><?php esc_html_e('Teams', 'shanayn-labs'); ?></em></span>
                            <span class="si-kpi-card"><strong><?php esc_html_e('Report', 'shanayn-labs'); ?></strong><em><?php esc_html_e('Insights', 'shanayn-labs'); ?></em></span>
                            <span class="si-kpi-card"><strong><?php esc_html_e('Scale', 'shanayn-labs'); ?></strong><em><?php esc_html_e('Flows', 'shanayn-labs'); ?></em></span>
                        </div>

                        <div class="si-dashboard-grid">
                            <div class="si-panel si-crm-table">
                                <div class="si-panel-heading">
                                    <span><?php esc_html_e('CRM Table', 'shanayn-labs'); ?></span>
                                    <em><?php esc_html_e('Manage', 'shanayn-labs'); ?></em>
                                </div>
                                <div class="si-crm-row si-crm-head">
                                    <span><?php esc_html_e('Client', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('Status', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('Value', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('Owner', 'shanayn-labs'); ?></span>
                                </div>
                                <div class="si-crm-row">
                                    <span><?php esc_html_e('Atlas Co', 'shanayn-labs'); ?></span>
                                    <span class="si-status-chip"><?php esc_html_e('Review', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('Open', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('Ops', 'shanayn-labs'); ?></span>
                                </div>
                                <div class="si-crm-row">
                                    <span><?php esc_html_e('North Clinic', 'shanayn-labs'); ?></span>
                                    <span class="si-status-chip is-active"><?php esc_html_e('Sync', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('Live', 'shanayn-labs'); ?></span>
                                    <span><?php esc_html_e('AI', 'shanayn-labs'); ?></span>
                                </div>
                            </div>

                            <div class="si-panel si-ai-panel">
                                <div class="si-panel-heading">
                                    <span><?php esc_html_e('AI Assistant', 'shanayn-labs'); ?></span>
                                    <em><?php esc_html_e('Automate', 'shanayn-labs'); ?></em>
                                </div>
                                <div class="si-ai-bubble"><?php esc_html_e('Summarize weekly sales activity', 'shanayn-labs'); ?></div>
                                <div class="si-ai-bubble is-response"><?php esc_html_e('Summary ready with next actions.', 'shanayn-labs'); ?></div>
                            </div>

                            <div class="si-panel si-automation-flow">
                                <div class="si-panel-heading">
                                    <span><?php esc_html_e('Workflow', 'shanayn-labs'); ?></span>
                                    <em><?php esc_html_e('Report', 'shanayn-labs'); ?></em>
                                </div>
                                <div class="si-automation-nodes">
                                    <span class="si-automation-node"><?php esc_html_e('Trigger', 'shanayn-labs'); ?></span>
                                    <span class="si-automation-node"><?php esc_html_e('Review', 'shanayn-labs'); ?></span>
                                    <span class="si-automation-node"><?php esc_html_e('Sync', 'shanayn-labs'); ?></span>
                                    <span class="si-automation-node"><?php esc_html_e('Report', 'shanayn-labs'); ?></span>
                                </div>
                            </div>

                            <div class="si-panel si-task-board">
                                <div class="si-panel-heading">
                                    <span><?php esc_html_e('Task Board', 'shanayn-labs'); ?></span>
                                    <em><?php esc_html_e('Track', 'shanayn-labs'); ?></em>
                                </div>
                                <div class="si-task-columns">
                                    <span class="si-task-column"><?php esc_html_e('New', 'shanayn-labs'); ?></span>
                                    <span class="si-task-column"><?php esc_html_e('In Progress', 'shanayn-labs'); ?></span>
                                    <span class="si-task-column"><?php esc_html_e('Done', 'shanayn-labs'); ?></span>
                                </div>
                            </div>

                            <div class="si-panel si-integration-nodes">
                                <div class="si-panel-heading">
                                    <span><?php esc_html_e('API Nodes', 'shanayn-labs'); ?></span>
                                    <em><?php esc_html_e('Connect', 'shanayn-labs'); ?></em>
                                </div>
                                <div class="si-integration-map">
                                    <span class="si-integration-node"><?php esc_html_e('CRM', 'shanayn-labs'); ?></span>
                                    <span class="si-integration-node"><?php esc_html_e('POS', 'shanayn-labs'); ?></span>
                                    <span class="si-integration-node"><?php esc_html_e('Website', 'shanayn-labs'); ?></span>
                                    <span class="si-integration-node"><?php esc_html_e('Analytics', 'shanayn-labs'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    $service_fit_rows = array(
        array(
            'need' => __('I need a professional website', 'shanayn-labs'),
            'system' => __('Digital Presence', 'shanayn-labs'),
            'microcopy' => __('For credibility, service pages, landing pages, ecommerce, and stronger online presentation.', 'shanayn-labs'),
            'tag_class' => 'service-fit-tag-digital',
            'url' => home_url('/service-pillar/digital-presence/'),
        ),
        array(
            'need' => __('I need more traffic and leads', 'shanayn-labs'),
            'system' => __('Growth Engine', 'shanayn-labs'),
            'microcopy' => __('For SEO, social media, content, campaigns, analytics, and lead generation.', 'shanayn-labs'),
            'tag_class' => 'service-fit-tag-growth',
            'url' => home_url('/service-pillar/growth-engine/'),
        ),
        array(
            'need' => __('I need automation or dashboards', 'shanayn-labs'),
            'system' => __('Software Intelligence', 'shanayn-labs'),
            'microcopy' => __('For dashboards, CRM, POS, workflows, AI automation, internal tools, and integrations.', 'shanayn-labs'),
            'tag_class' => 'service-fit-tag-software',
            'url' => home_url('/service-pillar/software-intelligence/'),
        ),
        array(
            'need' => __('I need all of these connected', 'shanayn-labs'),
            'system' => __('Complete Digital System', 'shanayn-labs'),
            'microcopy' => __('For businesses that need website, marketing, software, and automation working together.', 'shanayn-labs'),
            'tag_class' => 'service-fit-tag-complete',
            'url' => home_url('/contact/'),
        ),
    );
    ?>
    <section class="service-fit-section" aria-labelledby="service-fit-heading" data-animate>
        <div class="container service-fit-inner">
            <header class="service-fit-header">
                <p class="service-fit-eyebrow"><?php esc_html_e('SERVICE FIT GUIDE', 'shanayn-labs'); ?></p>
                <h2 id="service-fit-heading" class="service-fit-title"><?php esc_html_e('Not sure which service system fits your business?', 'shanayn-labs'); ?></h2>
                <p class="service-fit-description"><?php esc_html_e('Use this quick guide to understand whether your next priority is digital presence, growth, software, or a complete connected system.', 'shanayn-labs'); ?></p>
            </header>

            <div class="service-fit-panel" role="list" aria-label="<?php echo esc_attr__('Service system recommendations', 'shanayn-labs'); ?>">
                <div class="service-fit-panel-head" aria-hidden="true">
                    <span><?php esc_html_e('Your need', 'shanayn-labs'); ?></span>
                    <span><?php esc_html_e('Recommended system', 'shanayn-labs'); ?></span>
                </div>

                <?php foreach ($service_fit_rows as $fit_row) : ?>
                    <a class="service-fit-row" href="<?php echo esc_url($fit_row['url']); ?>" role="listitem">
                        <span class="service-fit-need">
                            <span class="service-fit-dot" aria-hidden="true"></span>
                            <strong><?php echo esc_html($fit_row['need']); ?></strong>
                        </span>

                        <span class="service-fit-recommendation">
                            <span class="service-fit-tag <?php echo esc_attr($fit_row['tag_class']); ?>"><?php echo esc_html($fit_row['system']); ?></span>
                            <span class="service-fit-microcopy"><?php echo esc_html($fit_row['microcopy']); ?></span>
                        </span>
                    </a>
                <?php endforeach; ?>

                <div class="service-fit-footer">
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="service-fit-cta">
                        <?php esc_html_e('Not sure what you need? Book a call', 'shanayn-labs'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php
    shanaynlabs_render_project_inquiry_section(
        array(
            'heading' => __('Need help choosing the right service?', 'shanayn-labs'),
        )
    );
    ?>

</main>

<?php get_footer(); ?>
