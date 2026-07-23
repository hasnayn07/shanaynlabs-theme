<?php
if (!defined('ABSPATH')) {
    exit;
}

$shanaynlabs_footer_link_groups = array(
    'services' => array(
        'heading' => __('Services', 'shanayn-labs'),
        'label'   => __('Footer services links', 'shanayn-labs'),
        'links'   => array(
            array('label' => __('Website Design', 'shanayn-labs'), 'url' => home_url('/services/website-design/')),
            array('label' => __('WordPress Development', 'shanayn-labs'), 'url' => home_url('/services/wordpress-development/')),
            array('label' => __('Ecommerce Development', 'shanayn-labs'), 'url' => home_url('/services/ecommerce-development/')),
            array('label' => __('Shopify Stores', 'shanayn-labs'), 'url' => home_url('/services/shopify-stores/')),
            array('label' => __('SEO', 'shanayn-labs'), 'url' => home_url('/services/seo/')),
            array('label' => __('Social Media Management', 'shanayn-labs'), 'url' => home_url('/services/social-media-management/')),
            array('label' => __('Performance Marketing', 'shanayn-labs'), 'url' => home_url('/services/performance-marketing/')),
        ),
    ),
    'software' => array(
        'heading' => __('Software & AI', 'shanayn-labs'),
        'label'   => __('Footer software and AI links', 'shanayn-labs'),
        'links'   => array(
            array('label' => __('Custom Software', 'shanayn-labs'), 'url' => home_url('/services/custom-software/')),
            array('label' => __('Web Applications', 'shanayn-labs'), 'url' => home_url('/services/web-applications/')),
            array('label' => __('Business Dashboards', 'shanayn-labs'), 'url' => home_url('/services/business-dashboards/')),
            array('label' => __('CRM Systems', 'shanayn-labs'), 'url' => home_url('/services/crm-systems/')),
            array('label' => __('POS Systems', 'shanayn-labs'), 'url' => home_url('/services/pos-systems/')),
            array('label' => __('AI Automation', 'shanayn-labs'), 'url' => home_url('/services/ai-automation/')),
            array('label' => __('AI Workflow Kits', 'shanayn-labs'), 'url' => home_url('/services/ai-workflow-kits/')),
        ),
    ),
    'company' => array(
        'heading' => __('Company', 'shanayn-labs'),
        'label'   => __('Footer company links', 'shanayn-labs'),
        'links'   => array(
            array('label' => __('About', 'shanayn-labs'), 'url' => home_url('/about/')),
            array('label' => __('Careers', 'shanayn-labs'), 'url' => home_url('/careers/')),
            array('label' => __('Contact', 'shanayn-labs'), 'url' => home_url('/contact/')),
            array('label' => __('Blogs', 'shanayn-labs'), 'url' => home_url('/blog/')),
            array('label' => __('Book a Call', 'shanayn-labs'), 'url' => home_url('/contact/')),
        ),
    ),
    'work' => array(
        'heading' => __('Work', 'shanayn-labs'),
        'label'   => __('Footer work and product links', 'shanayn-labs'),
        'links'   => array(
            array('label' => __('Case Studies', 'shanayn-labs'), 'url' => home_url('/work/')),
            array('label' => __('Featured Projects', 'shanayn-labs'), 'url' => home_url('/work/')),
            array('label' => __('Products', 'shanayn-labs'), 'url' => home_url('/products/')),
            array('label' => __('Product Systems', 'shanayn-labs'), 'url' => home_url('/products/')),
            array('label' => __('Business Dashboards', 'shanayn-labs'), 'url' => home_url('/products/business-dashboards/')),
        ),
    ),
    'industries' => array(
        'heading' => __('Industries', 'shanayn-labs'),
        'label'   => __('Footer industry links', 'shanayn-labs'),
        'links'   => array(
            array('label' => __('Healthcare & Clinics', 'shanayn-labs'), 'url' => home_url('/industries/healthcare-clinics/')),
            array('label' => __('Ecommerce & Retail', 'shanayn-labs'), 'url' => home_url('/industries/ecommerce-retail/')),
            array('label' => __('Local Businesses', 'shanayn-labs'), 'url' => home_url('/industries/local-businesses/')),
            array('label' => __('Service Businesses', 'shanayn-labs'), 'url' => home_url('/industries/service-businesses/')),
            array('label' => __('Startups', 'shanayn-labs'), 'url' => home_url('/industries/startups/')),
        ),
    ),
);

$shanaynlabs_legal_links = array(
    array('label' => __('Privacy Policy', 'shanayn-labs'), 'url' => home_url('/privacy-policy/')),
    array('label' => __('Terms & Conditions', 'shanayn-labs'), 'url' => home_url('/terms-conditions/')),
);

$shanaynlabs_footer_logo_url = content_url('/uploads/2026/07/shanaynsecondaryblack.png');
$shanaynlabs_social_links = function_exists('shanaynlabs_get_social_links') ? shanaynlabs_get_social_links() : array();
$shanaynlabs_contact_phones = function_exists('shanaynlabs_get_contact_phones') ? shanaynlabs_get_contact_phones() : array();
$shanaynlabs_footer_phone = !empty($shanaynlabs_contact_phones[0]) ? $shanaynlabs_contact_phones[0] : '';
$shanaynlabs_footer_phone_href = $shanaynlabs_footer_phone ? preg_replace('/[^0-9+]/', '', $shanaynlabs_footer_phone) : '';
$shanaynlabs_footer_address = '';
$shanaynlabs_footer_locations = function_exists('shanaynlabs_get_office_locations') ? shanaynlabs_get_office_locations(1) : null;

if ($shanaynlabs_footer_locations && $shanaynlabs_footer_locations->have_posts()) {
    $shanaynlabs_footer_locations->the_post();
    $shanaynlabs_footer_address = get_post_meta(get_the_ID(), '_shanaynlabs_location_address', true);
    wp_reset_postdata();
}

$shanaynlabs_newsletter_status = isset($_GET['newsletter']) ? sanitize_key(wp_unslash($_GET['newsletter'])) : '';
$shanaynlabs_newsletter_messages = array(
    'success' => __('Thanks for subscribing.', 'shanayn-labs'),
    'exists' => __('You are already subscribed.', 'shanayn-labs'),
    'invalid' => __('Please enter a valid email address.', 'shanayn-labs'),
);
$shanaynlabs_newsletter_redirect = home_url('/');

if (isset($_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI'])) {
    $shanaynlabs_http_host = sanitize_text_field(wp_unslash($_SERVER['HTTP_HOST']));
    $shanaynlabs_request_uri = sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI']));
    $shanaynlabs_newsletter_redirect = remove_query_arg('newsletter', set_url_scheme('http://' . $shanaynlabs_http_host . $shanaynlabs_request_uri));
}

$shanaynlabs_footer_social_icon = static function ($social_key) {
    if ('linkedin' === $social_key) {
        return '<svg viewBox="0 0 24 24" focusable="false"><path fill="currentColor" d="M6.7 19H3.4V8.8h3.3V19ZM5.1 7.4c-1 0-1.8-.8-1.8-1.8s.8-1.7 1.8-1.7 1.8.8 1.8 1.7-.8 1.8-1.8 1.8ZM20.7 19h-3.3v-5.4c0-1.3-.5-2.2-1.7-2.2-.9 0-1.4.6-1.7 1.2-.1.2-.1.5-.1.8V19h-3.3V8.8h3.2v1.4c.5-.7 1.4-1.7 3.3-1.7 2.4 0 3.6 1.6 3.6 4.8V19Z"></path></svg>';
    }

    if ('instagram' === $social_key) {
        return '<svg viewBox="0 0 24 24" focusable="false"><rect x="4.2" y="4.2" width="15.6" height="15.6" rx="4.4"></rect><circle cx="12" cy="12" r="3.6"></circle><circle cx="16.8" cy="7.2" r="0.8" fill="currentColor" stroke="none"></circle></svg>';
    }

    if ('twitter' === $social_key) {
        return '<svg viewBox="0 0 24 24" focusable="false"><path d="M5 5l14 14"></path><path d="M19 5 5 19"></path></svg>';
    }

    if ('facebook' === $social_key) {
        return '<svg viewBox="0 0 24 24" focusable="false"><path fill="currentColor" d="M14.2 8.2V6.9c0-.7.5-.9 1-.9h2V3h-2.8c-3 0-3.8 1.9-3.8 3.8v1.4H8.2v3.2h2.4V21h3.6v-9.6h2.8l.5-3.2h-3.3Z"></path></svg>';
    }

    if ('youtube' === $social_key) {
        return '<svg viewBox="0 0 24 24" focusable="false"><rect x="3.8" y="6.4" width="16.4" height="11.2" rx="3.1"></rect><path fill="currentColor" stroke="none" d="m10.6 9.3 4.5 2.7-4.5 2.7V9.3Z"></path></svg>';
    }

    return '<svg viewBox="0 0 24 24" focusable="false"><path d="M7 17L17 7"></path><path d="M9 7h8v8"></path></svg>';
};
?>
<footer class="site-footer" data-animate>
    <div class="container footer-shell">
        <div class="footer-main">
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-logo">
                    <img class="footer-logo-img" src="<?php echo esc_url($shanaynlabs_footer_logo_url); ?>" alt="<?php echo esc_attr__('ShanaynLabs', 'shanayn-labs'); ?>" loading="lazy">
                </a>

                <?php if (!empty($shanaynlabs_social_links)) : ?>
                <div class="footer-socials" aria-label="<?php echo esc_attr__('ShanaynLabs social links', 'shanayn-labs'); ?>">
                    <?php foreach ($shanaynlabs_social_links as $social_link) : ?>
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
                        <a href="<?php echo esc_url($social_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr(sprintf(__('Follow ShanaynLabs on %s', 'shanayn-labs'), $social_label)); ?>">
                            <span class="footer-social-icon" aria-hidden="true"><?php echo $shanaynlabs_footer_social_icon($social_key); ?></span>
                            <span class="screen-reader-text"><?php echo esc_html($social_label); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if ($shanaynlabs_footer_phone || $shanaynlabs_footer_address) : ?>
                    <div class="footer-contact-lines">
                        <?php if ($shanaynlabs_footer_phone) : ?>
                            <p class="footer-contact-line">
                                <?php if ($shanaynlabs_footer_phone_href) : ?>
                                    <a href="<?php echo esc_url('tel:' . $shanaynlabs_footer_phone_href); ?>"><?php echo esc_html($shanaynlabs_footer_phone); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html($shanaynlabs_footer_phone); ?>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($shanaynlabs_footer_address) : ?>
                            <p class="footer-contact-line"><?php echo esc_html($shanaynlabs_footer_address); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php foreach (array('services', 'software') as $group_key) : ?>
                <?php $footer_group = $shanaynlabs_footer_link_groups[$group_key]; ?>
                <nav class="footer-nav footer-nav-<?php echo esc_attr($group_key); ?>" aria-label="<?php echo esc_attr($footer_group['label']); ?>">
                    <h2><?php echo esc_html($footer_group['heading']); ?></h2>
                    <ul>
                        <?php foreach ($footer_group['links'] as $footer_link) : ?>
                            <li>
                                <a href="<?php echo esc_url($footer_link['url']); ?>">
                                    <?php echo esc_html($footer_link['label']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endforeach; ?>

            <div class="footer-newsletter">
                <h2><?php esc_html_e('Subscribe to our newsletter', 'shanayn-labs'); ?></h2>
                <p><?php esc_html_e('Get practical insights on websites, software, automation, AI, and digital growth.', 'shanayn-labs'); ?></p>

                <?php if ($shanaynlabs_newsletter_status && isset($shanaynlabs_newsletter_messages[$shanaynlabs_newsletter_status])) : ?>
                    <div class="footer-newsletter-notice footer-newsletter-notice-<?php echo esc_attr($shanaynlabs_newsletter_status); ?>" role="<?php echo esc_attr('success' === $shanaynlabs_newsletter_status ? 'status' : 'alert'); ?>">
                        <?php echo esc_html($shanaynlabs_newsletter_messages[$shanaynlabs_newsletter_status]); ?>
                    </div>
                <?php endif; ?>

                <form class="footer-newsletter-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <input type="hidden" name="action" value="shanaynlabs_newsletter_subscribe">
                    <input type="hidden" name="redirect_to" value="<?php echo esc_url($shanaynlabs_newsletter_redirect); ?>">
                    <?php wp_nonce_field('shanaynlabs_newsletter_subscribe', 'shanaynlabs_newsletter_nonce'); ?>

                    <label class="screen-reader-text" for="footer-newsletter-email"><?php esc_html_e('Email address', 'shanayn-labs'); ?></label>
                    <input id="footer-newsletter-email" type="email" name="newsletter_email" placeholder="<?php echo esc_attr__('Email address', 'shanayn-labs'); ?>" autocomplete="email" required>
                    <button type="submit"><?php esc_html_e('Subscribe', 'shanayn-labs'); ?></button>
                </form>
            </div>

            <?php foreach (array('work', 'company') as $group_key) : ?>
                <?php $footer_group = $shanaynlabs_footer_link_groups[$group_key]; ?>
                <nav class="footer-nav footer-nav-<?php echo esc_attr($group_key); ?>" aria-label="<?php echo esc_attr($footer_group['label']); ?>">
                    <h2><?php echo esc_html($footer_group['heading']); ?></h2>
                    <ul>
                        <?php foreach ($footer_group['links'] as $footer_link) : ?>
                            <li>
                                <a href="<?php echo esc_url($footer_link['url']); ?>">
                                    <?php echo esc_html($footer_link['label']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endforeach; ?>
        </div>

        <div class="footer-bottom">
            <p>
                &copy; <?php echo esc_html(date_i18n('Y')); ?>
                <?php esc_html_e('ShanaynLabs. All rights reserved.', 'shanayn-labs'); ?>
            </p>
            <nav class="footer-legal" aria-label="<?php echo esc_attr__('Footer legal links', 'shanayn-labs'); ?>">
                <?php foreach ($shanaynlabs_legal_links as $legal_link) : ?>
                    <a href="<?php echo esc_url($legal_link['url']); ?>">
                        <?php echo esc_html($legal_link['label']); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
