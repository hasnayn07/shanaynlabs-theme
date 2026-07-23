<?php
/**
 * Template Name: Contact / Book a Call
 *
 * @package Shanayn_Labs
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$contact_hero_eyebrow = trim((string) get_option('shanaynlabs_contact_hero_eyebrow', ''));
$contact_hero_heading = trim((string) get_option('shanaynlabs_contact_hero_heading', ''));
$contact_hero_description = trim((string) get_option('shanaynlabs_contact_hero_description', ''));

if ('' === $contact_hero_eyebrow) {
    $contact_hero_eyebrow = __('CONTACT SHANAYN LABS', 'shanayn-labs');
}

if ('' === $contact_hero_heading) {
    $contact_hero_heading = __("Let's talk about what your business needs next.", 'shanayn-labs');
}

if ('' === $contact_hero_description) {
    $contact_hero_description = __('Share your project details, ask a question, or book a conversation about your website, marketing, software, automation, or AI workflow.', 'shanayn-labs');
}

$contact_details_heading = trim((string) get_option('shanaynlabs_contact_details_heading', ''));
$contact_details_description = trim((string) get_option('shanaynlabs_contact_details_description', ''));

if ('' === $contact_details_heading) {
    $contact_details_heading = __('Contact details', 'shanayn-labs');
}

if ('' === $contact_details_description) {
    $contact_details_description = __('Reach out directly or send a project inquiry and we will help you find the right next step.', 'shanayn-labs');
}

$contact_status = isset($_GET['contact_status']) ? sanitize_key(wp_unslash($_GET['contact_status'])) : '';
$redirect_to = get_permalink();
$redirect_to = $redirect_to ? $redirect_to : home_url('/contact/');

$service_interest_options = array(
    '' => __('Select a service interest', 'shanayn-labs'),
    'Website / Digital Presence' => __('Website / Digital Presence', 'shanayn-labs'),
    'Marketing / Growth' => __('Marketing / Growth', 'shanayn-labs'),
    'Software / Dashboard' => __('Software / Dashboard', 'shanayn-labs'),
    'AI / Automation' => __('AI / Automation', 'shanayn-labs'),
    'Not sure yet' => __('Not sure yet', 'shanayn-labs'),
);

$project_type_options = array(
    'Website' => __('Website', 'shanayn-labs'),
    'Marketing' => __('Marketing', 'shanayn-labs'),
    'Software' => __('Software', 'shanayn-labs'),
    'AI' => __('AI', 'shanayn-labs'),
    'Automation' => __('Automation', 'shanayn-labs'),
);

$budget_options = array(
    '' => __('Select a budget range', 'shanayn-labs'),
    'Not sure yet' => __('Not sure yet', 'shanayn-labs'),
    'Under $1,000' => __('Under $1,000', 'shanayn-labs'),
    '$1,000 - $3,000' => __('$1,000 - $3,000', 'shanayn-labs'),
    '$3,000 - $7,500' => __('$3,000 - $7,500', 'shanayn-labs'),
    '$7,500+' => __('$7,500+', 'shanayn-labs'),
);

$timeline_options = array(
    '' => __('Select a timeline', 'shanayn-labs'),
    'Not sure yet' => __('Not sure yet', 'shanayn-labs'),
    'As soon as possible' => __('As soon as possible', 'shanayn-labs'),
    'Within 1 month' => __('Within 1 month', 'shanayn-labs'),
    '1-3 months' => __('1-3 months', 'shanayn-labs'),
    '3+ months' => __('3+ months', 'shanayn-labs'),
);

$contact_emails = shanaynlabs_get_contact_emails();
$contact_phones = shanaynlabs_get_contact_phones();
$contact_whatsapp = shanaynlabs_get_contact_whatsapp();
$business_hours = array_map('sanitize_text_field', shanaynlabs_split_lines(get_option('shanaynlabs_business_hours', '')));
$response_time = sanitize_text_field(get_option('shanaynlabs_response_time', ''));
$social_links = shanaynlabs_get_social_links();
$contact_social_links = array();

if (!empty($social_links)) {
    foreach ($social_links as $platform => $social_link) {
        if (is_array($social_link)) {
            $social_label = isset($social_link['label']) ? sanitize_text_field($social_link['label']) : '';
            $social_url = isset($social_link['url']) ? esc_url_raw($social_link['url']) : '';
            $social_key = isset($social_link['key']) ? sanitize_html_class($social_link['key']) : sanitize_html_class($social_label);
        } else {
            $social_label = sanitize_text_field((string) $platform);
            $social_url = esc_url_raw($social_link);
            $social_key = sanitize_html_class((string) $platform);
        }

        if ($social_label && $social_url) {
            $contact_social_links[] = array(
                'label' => $social_label,
                'url' => $social_url,
                'key' => $social_key ? $social_key : 'social',
            );
        }
    }
}

$primary_location = array();
$office_locations = shanaynlabs_get_office_locations(1);
$contact_icon = static function ($icon, $modifier = '') {
    $paths = array(
        'email' => '<path d="M4 6.5h16v11H4z"></path><path d="m4 7 8 6 8-6"></path>',
        'phone' => '<path d="M8.5 5.5 10.8 8l-1.4 2c.8 1.7 2.1 3 3.8 3.8l2-1.4 2.4 2.3-.7 3.1c-.1.5-.6.8-1.1.8A11.7 11.7 0 0 1 5.4 8.2c0-.5.3-1 .8-1.1z"></path>',
        'whatsapp' => '<path d="M6.5 18.2 7.3 15A7.1 7.1 0 1 1 10 17.4z"></path><path d="M9.7 8.6c.2 2.3 1.6 4 4 4.8"></path><path d="m14 13.4 1.2-1.1"></path>',
        'address' => '<path d="M12 20s6-5.2 6-10a6 6 0 0 0-12 0c0 4.8 6 10 6 10z"></path><circle cx="12" cy="10" r="2"></circle>',
        'hours' => '<circle cx="12" cy="12" r="7.5"></circle><path d="M12 7.8V12l3 1.8"></path>',
        'response' => '<path d="M5 7.5h14v8.5H9l-4 3z"></path><path d="M8.5 10.5h7"></path><path d="M8.5 13h4.5"></path>',
        'social' => '<circle cx="8" cy="12" r="2.5"></circle><circle cx="16" cy="7" r="2.5"></circle><circle cx="16" cy="17" r="2.5"></circle><path d="m10.2 10.8 3.6-2.5"></path><path d="m10.2 13.2 3.6 2.5"></path>',
        'map' => '<path d="m4.5 7 5-2 5 2 5-2v12l-5 2-5-2-5 2z"></path><path d="M9.5 5v12"></path><path d="M14.5 7v12"></path>',
        'arrow' => '<path d="M5 12h13"></path><path d="m13 7 5 5-5 5"></path>',
    );

    if (empty($paths[$icon])) {
        return '';
    }

    $classes = trim('contact-detail-icon contact-detail-icon--' . $icon . ' ' . $modifier);

    return '<span class="' . esc_attr($classes) . '" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false">' . $paths[$icon] . '</svg></span>';
};

if ($office_locations->have_posts()) {
    $office_locations->the_post();

    $location_id = get_the_ID();
    $primary_location = array(
        'title' => get_the_title(),
        'address' => get_post_meta($location_id, '_shanaynlabs_location_address', true),
        'city' => get_post_meta($location_id, '_shanaynlabs_location_city', true),
        'email' => get_post_meta($location_id, '_shanaynlabs_location_email', true),
        'phone' => get_post_meta($location_id, '_shanaynlabs_location_phone', true),
        'whatsapp' => get_post_meta($location_id, '_shanaynlabs_location_whatsapp', true),
        'map_link' => get_post_meta($location_id, '_shanaynlabs_location_map_link', true),
        'hours' => shanaynlabs_split_lines(get_post_meta($location_id, '_shanaynlabs_location_hours', true)),
    );

    wp_reset_postdata();
}

$all_office_locations = shanaynlabs_get_office_locations();
?>

<main id="main-content" class="site-main contact-page">
    <section class="contact-hero" aria-labelledby="contact-hero-heading">
        <div class="container contact-hero-inner">
            <div class="contact-hero-content">
                <p class="eyebrow"><?php echo esc_html($contact_hero_eyebrow); ?></p>
                <h1 id="contact-hero-heading"><?php echo esc_html($contact_hero_heading); ?></h1>
                <p><?php echo esc_html($contact_hero_description); ?></p>
            </div>

            <div class="contact-hero-visual" aria-hidden="true">
                <div class="contact-system-visual contact-conversation-visual">
                    <div class="contact-visual-card contact-visual-card-main">
                        <span class="contact-visual-kicker"><?php esc_html_e('Project Brief', 'shanayn-labs'); ?></span>
                        <span class="contact-visual-title"><?php esc_html_e('New business system', 'shanayn-labs'); ?></span>
                        <span class="contact-visual-line contact-visual-line-long"></span>
                        <span class="contact-visual-line"></span>
                        <div class="contact-visual-pills">
                            <span><?php esc_html_e('Website', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Growth', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('Software', 'shanayn-labs'); ?></span>
                            <span><?php esc_html_e('AI', 'shanayn-labs'); ?></span>
                        </div>
                    </div>

                    <div class="contact-visual-card contact-visual-card-message">
                        <span class="contact-visual-dot"></span>
                        <span><?php esc_html_e('Discovery call', 'shanayn-labs'); ?></span>
                    </div>

                    <div class="contact-visual-card contact-visual-card-plan">
                        <span><?php esc_html_e('Next step', 'shanayn-labs'); ?></span>
                        <strong><?php esc_html_e('Clear project direction', 'shanayn-labs'); ?></strong>
                    </div>

                    <div class="contact-visual-nodes">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-main" aria-labelledby="contact-main-heading">
        <div class="container contact-main-inner">
            <div class="contact-form-column">
                <div class="contact-form-card">
                    <p class="eyebrow"><?php esc_html_e('Project Inquiry', 'shanayn-labs'); ?></p>
                    <h2 id="contact-main-heading"><?php esc_html_e('Tell us about your project.', 'shanayn-labs'); ?></h2>

                    <?php if ('success' === $contact_status) : ?>
                        <div class="form-notice form-notice-success" role="status">
                            <?php esc_html_e('Thanks. Your inquiry has been sent successfully.', 'shanayn-labs'); ?>
                        </div>
                    <?php elseif ('error' === $contact_status) : ?>
                        <div class="form-notice form-notice-error" role="alert">
                            <?php esc_html_e('Something went wrong. Please check the required fields and try again.', 'shanayn-labs'); ?>
                        </div>
                    <?php endif; ?>

                    <form class="contact-main-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                        <input type="hidden" name="action" value="shanaynlabs_contact_form">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_to); ?>">
                        <input type="hidden" name="shanaynlabs_form_started_at" value="<?php echo esc_attr(time()); ?>">
                        <?php wp_nonce_field('shanaynlabs_contact_form', 'shanaynlabs_contact_nonce'); ?>
                        <div class="contact-hp-field" aria-hidden="true">
                            <label for="contact_website"><?php esc_html_e('Website', 'shanayn-labs'); ?></label>
                            <input id="contact_website" type="text" name="contact_website" tabindex="-1" autocomplete="off">
                        </div>

                        <fieldset class="contact-form-group">
                            <legend><?php esc_html_e('Basic Details', 'shanayn-labs'); ?></legend>
                            <div class="contact-form-grid">
                                <div class="contact-form-field">
                                    <label for="full_name"><?php esc_html_e('Full Name', 'shanayn-labs'); ?></label>
                                    <input id="full_name" type="text" name="full_name" autocomplete="name" required>
                                </div>

                                <div class="contact-form-field">
                                    <label for="business_name"><?php esc_html_e('Business Name', 'shanayn-labs'); ?></label>
                                    <input id="business_name" type="text" name="business_name" autocomplete="organization">
                                </div>

                                <div class="contact-form-field">
                                    <label for="email_address"><?php esc_html_e('Email Address', 'shanayn-labs'); ?></label>
                                    <input id="email_address" type="email" name="email_address" autocomplete="email" required>
                                </div>

                                <div class="contact-form-field">
                                    <label for="phone_whatsapp"><?php esc_html_e('Phone / WhatsApp', 'shanayn-labs'); ?></label>
                                    <input id="phone_whatsapp" type="text" name="phone_whatsapp" autocomplete="tel">
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="contact-form-group">
                            <legend><?php esc_html_e('Project Direction', 'shanayn-labs'); ?></legend>
                            <div class="contact-form-grid">
                                <div class="contact-form-field">
                                    <label for="service_interest"><?php esc_html_e('Service Interest', 'shanayn-labs'); ?></label>
                                    <select id="service_interest" name="service_interest">
                                        <?php foreach ($service_interest_options as $value => $label) : ?>
                                            <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="contact-form-field">
                                    <label for="budget_range"><?php esc_html_e('Budget Range', 'shanayn-labs'); ?></label>
                                    <select id="budget_range" name="budget_range">
                                        <?php foreach ($budget_options as $value => $label) : ?>
                                            <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="contact-form-field">
                                    <label for="project_timeline"><?php esc_html_e('Timeline', 'shanayn-labs'); ?></label>
                                    <select id="project_timeline" name="project_timeline">
                                        <?php foreach ($timeline_options as $value => $label) : ?>
                                            <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($label); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="contact-form-field">
                                    <label for="website_social_link"><?php esc_html_e('Website / Social Link', 'shanayn-labs'); ?></label>
                                    <input id="website_social_link" type="url" name="website_social_link" autocomplete="url" placeholder="<?php echo esc_attr__('https://', 'shanayn-labs'); ?>">
                                </div>
                            </div>

                            <div class="contact-form-field contact-form-field-wide">
                                <span class="contact-checkbox-label"><?php esc_html_e('Project Type', 'shanayn-labs'); ?></span>
                                <div class="contact-checkbox-grid">
                                    <?php foreach ($project_type_options as $value => $label) : ?>
                                        <label>
                                            <input type="checkbox" name="project_type[]" value="<?php echo esc_attr($value); ?>">
                                            <span><?php echo esc_html($label); ?></span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="contact-form-group">
                            <legend><?php esc_html_e('Message', 'shanayn-labs'); ?></legend>
                            <div class="contact-form-field contact-form-field-wide">
                                <label for="message"><?php esc_html_e('Project Details', 'shanayn-labs'); ?></label>
                                <textarea id="message" name="message" rows="6" required></textarea>
                            </div>
                        </fieldset>

                        <button class="contact-main-submit" type="submit">
                            <?php esc_html_e('Send Project Inquiry', 'shanayn-labs'); ?>
                            <span aria-hidden="true">-&gt;</span>
                        </button>
                    </form>
                </div>
            </div>

            <aside class="contact-details-column" aria-labelledby="contact-details-heading">
                <div class="contact-details-panel">
                    <p class="eyebrow"><?php esc_html_e('Contact Details', 'shanayn-labs'); ?></p>
                    <h2 id="contact-details-heading"><?php echo esc_html($contact_details_heading); ?></h2>
                    <p class="contact-details-intro"><?php echo esc_html($contact_details_description); ?></p>

                    <?php if (!empty($contact_emails)) : ?>
                        <div class="contact-detail-block">
                            <?php echo $contact_icon('email'); ?>
                            <div class="contact-detail-content">
                                <h3 class="contact-detail-label"><?php esc_html_e('Email', 'shanayn-labs'); ?></h3>
                                <div class="contact-detail-value">
                                    <?php foreach ($contact_emails as $email) : ?>
                                        <a href="<?php echo esc_url('mailto:' . $email); ?>"><?php echo esc_html($email); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($contact_phones)) : ?>
                        <div class="contact-detail-block">
                            <?php echo $contact_icon('phone'); ?>
                            <div class="contact-detail-content">
                                <h3 class="contact-detail-label"><?php esc_html_e('Phone', 'shanayn-labs'); ?></h3>
                                <div class="contact-detail-value">
                                    <?php foreach ($contact_phones as $phone) : ?>
                                        <?php $phone_href = preg_replace('/[^0-9+]/', '', $phone); ?>
                                        <a href="<?php echo esc_url('tel:' . $phone_href); ?>"><?php echo esc_html($phone); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($contact_whatsapp)) : ?>
                        <div class="contact-detail-block">
                            <?php echo $contact_icon('whatsapp'); ?>
                            <div class="contact-detail-content">
                                <h3 class="contact-detail-label"><?php esc_html_e('WhatsApp', 'shanayn-labs'); ?></h3>
                                <div class="contact-detail-value">
                                    <?php foreach ($contact_whatsapp as $whatsapp) : ?>
                                        <?php $whatsapp_href = preg_replace('/\D+/', '', $whatsapp); ?>
                                        <?php if ($whatsapp_href) : ?>
                                            <a href="<?php echo esc_url('https://wa.me/' . $whatsapp_href); ?>"><?php echo esc_html($whatsapp); ?></a>
                                        <?php else : ?>
                                            <span><?php echo esc_html($whatsapp); ?></span>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($business_hours)) : ?>
                        <div class="contact-detail-block">
                            <?php echo $contact_icon('hours'); ?>
                            <div class="contact-detail-content">
                                <h3 class="contact-detail-label"><?php esc_html_e('Business Hours', 'shanayn-labs'); ?></h3>
                                <div class="contact-detail-value">
                                    <?php foreach ($business_hours as $hours_line) : ?>
                                        <span><?php echo esc_html($hours_line); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($response_time) : ?>
                        <div class="contact-detail-block">
                            <?php echo $contact_icon('response'); ?>
                            <div class="contact-detail-content">
                                <h3 class="contact-detail-label"><?php esc_html_e('Response Time', 'shanayn-labs'); ?></h3>
                                <div class="contact-detail-value">
                                    <span><?php echo esc_html($response_time); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($primary_location)) : ?>
                        <div class="contact-detail-block">
                            <?php echo $contact_icon('address'); ?>
                            <div class="contact-detail-content">
                                <h3 class="contact-detail-label"><?php esc_html_e('Primary Location', 'shanayn-labs'); ?></h3>
                                <div class="contact-detail-value">
                                    <?php if (!empty($primary_location['title'])) : ?>
                                        <strong><?php echo esc_html($primary_location['title']); ?></strong>
                                    <?php endif; ?>
                                    <?php if (!empty($primary_location['city'])) : ?>
                                        <span><?php echo esc_html($primary_location['city']); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($primary_location['address'])) : ?>
                                        <span><?php echo esc_html($primary_location['address']); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($primary_location['hours'])) : ?>
                                        <?php foreach ($primary_location['hours'] as $location_hours_line) : ?>
                                            <span><?php echo esc_html($location_hours_line); ?></span>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($primary_location['map_link'])) : ?>
                                        <a href="<?php echo esc_url($primary_location['map_link']); ?>" target="_blank" rel="noopener noreferrer">
                                            <?php echo $contact_icon('map', 'contact-detail-icon--inline'); ?>
                                            <?php esc_html_e('Open map', 'shanayn-labs'); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </aside>
        </div>
    </section>

    <?php if ($all_office_locations->have_posts()) : ?>
        <section class="contact-locations" aria-labelledby="contact-locations-heading">
            <div class="container">
                <div class="section-header">
                    <p class="eyebrow"><?php esc_html_e('Office Locations', 'shanayn-labs'); ?></p>
                    <h2 id="contact-locations-heading"><?php esc_html_e('Where to find ShanaynLabs', 'shanayn-labs'); ?></h2>
                </div>

                <div class="contact-location-grid">
                    <?php
                    while ($all_office_locations->have_posts()) :
                        $all_office_locations->the_post();

                        $location_id = get_the_ID();
                        $location_address = get_post_meta($location_id, '_shanaynlabs_location_address', true);
                        $location_city = get_post_meta($location_id, '_shanaynlabs_location_city', true);
                        $location_email = get_post_meta($location_id, '_shanaynlabs_location_email', true);
                        $location_phone = get_post_meta($location_id, '_shanaynlabs_location_phone', true);
                        $location_whatsapp = get_post_meta($location_id, '_shanaynlabs_location_whatsapp', true);
                        $location_map_link = get_post_meta($location_id, '_shanaynlabs_location_map_link', true);
                        $location_map_embed = get_post_meta($location_id, '_shanaynlabs_location_map_embed', true);
                        $location_hours = shanaynlabs_split_lines(get_post_meta($location_id, '_shanaynlabs_location_hours', true));
                        $location_phone_href = preg_replace('/[^0-9+]/', '', $location_phone);
                        $location_whatsapp_href = preg_replace('/\D+/', '', $location_whatsapp);
                        ?>
                        <article class="contact-location-card">
                            <div class="contact-location-content">
                                <h3><?php the_title(); ?></h3>

                                <?php if ($location_city) : ?>
                                    <p class="contact-location-city">
                                        <?php echo esc_html($location_city); ?>
                                    </p>
                                <?php endif; ?>

                                <?php if ($location_address) : ?>
                                    <p class="contact-location-line">
                                        <?php echo $contact_icon('address', 'contact-detail-icon--inline'); ?>
                                        <span><?php echo esc_html($location_address); ?></span>
                                    </p>
                                <?php endif; ?>

                                <div class="contact-location-details">
                                    <?php if ($location_email) : ?>
                                        <a href="<?php echo esc_url('mailto:' . sanitize_email($location_email)); ?>">
                                            <?php echo $contact_icon('email', 'contact-detail-icon--inline'); ?>
                                            <?php echo esc_html($location_email); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($location_phone) : ?>
                                        <a href="<?php echo esc_url('tel:' . $location_phone_href); ?>">
                                            <?php echo $contact_icon('phone', 'contact-detail-icon--inline'); ?>
                                            <?php echo esc_html($location_phone); ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($location_whatsapp) : ?>
                                        <?php if ($location_whatsapp_href) : ?>
                                            <a href="<?php echo esc_url('https://wa.me/' . $location_whatsapp_href); ?>">
                                                <?php echo $contact_icon('whatsapp', 'contact-detail-icon--inline'); ?>
                                                <?php echo esc_html($location_whatsapp); ?>
                                            </a>
                                        <?php else : ?>
                                            <span>
                                                <?php echo $contact_icon('whatsapp', 'contact-detail-icon--inline'); ?>
                                                <?php echo esc_html($location_whatsapp); ?>
                                            </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>

                                <?php if (!empty($location_hours)) : ?>
                                    <div class="contact-location-hours">
                                        <span>
                                            <?php echo $contact_icon('hours', 'contact-detail-icon--inline'); ?>
                                            <?php esc_html_e('Hours', 'shanayn-labs'); ?>
                                        </span>
                                        <?php foreach ($location_hours as $location_hours_line) : ?>
                                            <p><?php echo esc_html($location_hours_line); ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!$location_map_embed && $location_map_link) : ?>
                                    <a class="contact-location-map-link" href="<?php echo esc_url($location_map_link); ?>" target="_blank" rel="noopener noreferrer">
                                        <?php echo $contact_icon('map', 'contact-detail-icon--inline'); ?>
                                        <?php esc_html_e('View on Map', 'shanayn-labs'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <?php if ($location_map_embed) : ?>
                                <div class="contact-map-frame">
                                    <?php
                                    echo wp_kses(
                                        $location_map_embed,
                                        array(
                                            'iframe' => array(
                                                'src' => true,
                                                'width' => true,
                                                'height' => true,
                                                'style' => true,
                                                'allowfullscreen' => true,
                                                'loading' => true,
                                                'referrerpolicy' => true,
                                                'title' => true,
                                            ),
                                        )
                                    );
                                    ?>
                                </div>
                            <?php endif; ?>
                        </article>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>

    <?php if (!empty($contact_social_links)) : ?>
        <section class="section about-socials contact-socials" aria-labelledby="contact-social-heading">
            <div class="container">
                <div class="about-socials-inner">
                    <div class="about-socials-content">
                        <p class="eyebrow"><?php esc_html_e('Connect With Us', 'shanayn-labs'); ?></p>
                        <h2 id="contact-social-heading"><?php esc_html_e('Follow ShanaynLabs across the web', 'shanayn-labs'); ?></h2>
                        <p><?php esc_html_e('Stay connected with our latest work, insights, updates, and digital product ideas.', 'shanayn-labs'); ?></p>
                    </div>

                    <div class="about-socials-links" aria-label="<?php echo esc_attr__('ShanaynLabs social links', 'shanayn-labs'); ?>">
                    <?php foreach ($contact_social_links as $social_link) : ?>
                        <?php
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
</main>

<?php get_footer(); ?>
