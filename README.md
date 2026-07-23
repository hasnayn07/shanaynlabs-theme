# ShanaynLabs Custom WordPress Theme

A custom WordPress theme for ShanaynLabs, built as a responsive business website for services, work, products, insights, contact inquiries, and backend-managed company content.

## Overview

ShanaynLabs is a bespoke WordPress theme designed for a digital systems company. It combines custom frontend templates with backend-managed content systems so the site can be updated from the WordPress dashboard without relying on page-builder plugins.

The theme includes a custom homepage, responsive header and dropdown navigation, mobile menu, custom footer, service pillar pages, Work category subpages, product pages, blog templates, secure inquiry forms, newsletter signup, and dynamic contact/social settings.

## Main Features

- Custom homepage with dynamic service, work, product, industry, testimonial, and inquiry sections.
- Responsive header with desktop dropdowns and a clean mobile menu.
- Custom footer with logo, dynamic social icons, contact details, newsletter signup, and structured link columns.
- Services archive, service pillar templates, and single service templates.
- Work archive, single work pages, and Work category subpages for Digital Presence, Growth Engine, and Software Intelligence.
- Products archive and single product templates.
- Blog archive and single blog post templates for standard WordPress posts.
- About and Contact pages with backend-managed team, social, contact, and location data.
- Responsive layouts for desktop, laptop, tablet, and mobile screens.

## Dynamic Systems

The theme uses custom post types and settings to manage site content from WordPress admin:

- Services CPT
- Work CPT
- Products CPT
- Industries
- Testimonials
- Team Members
- Pricing Packages
- Office Locations
- Project Inquiries
- Newsletter Subscribers
- Dynamic contact and company social settings
- Backend-editable Project Inquiry form options

Backend-only content such as Industries, Team Members, Office Locations, Project Inquiries, Newsletter Subscribers, and other admin-managed data is registered without public archive or single pages where appropriate.

## Forms

The Project Inquiry form is used across key conversion sections and stores submissions in WordPress admin under Project Inquiries. It also sends email notifications with `wp_mail()`.

The Newsletter form stores subscribers in WordPress admin under Newsletter Subscribers and prevents duplicate email entries.

For production, SMTP is recommended through a plugin such as WP Mail SMTP or FluentSMTP so inquiry and newsletter-related emails are delivered reliably.

## Security Features

The theme includes form and data-handling safeguards:

- Nonce verification for form submissions.
- Honeypot field protection.
- Timing check to reject submissions sent too quickly.
- IP-based transient rate limiting.
- Sanitization for text, email, URL, textarea, and array input.
- Escaping for frontend and admin output.
- JSON payload storage for sanitized inquiry data.
- Backend-only CPTs for private/admin-managed records.
- Safe redirects after form submissions.

## Recommended Plugins

These plugins are recommended for production use:

- Yoast SEO
- WP Mail SMTP or FluentSMTP
- UpdraftPlus
- Wordfence
- Site Kit by Google
- Redirection
- LiteSpeed Cache or Autoptimize
- Converter for Media

## Local Development

1. Install WordPress locally.
2. Copy this theme folder into `wp-content/themes/`.
3. Activate **ShanaynLabs** from WordPress admin.
4. Save permalinks from **Settings -> Permalinks** after activating the theme, especially for Work category subpage routes.
5. Add or seed dashboard content for services, work, products, industries, testimonials, pricing packages, team members, office locations, blog posts, and contact settings.

This repository should contain only the custom theme. WordPress core files, uploads, plugins, database exports, `wp-config.php`, local backups, and environment secrets should remain outside this repo.

## Deployment Notes

- Upload only the theme folder to the production WordPress installation.
- Configure contact details, social links, office locations, inquiry options, and footer content from WordPress admin.
- Add real Work, Services, Products, Team, Industries, Testimonials, and Pricing content before launch.
- Configure an SMTP plugin before relying on form email notifications.
- Re-save permalinks after deployment if custom routes do not resolve.
- Replace local/test media with production media through the WordPress Media Library.

## Important Notes

- Do not commit database files, uploads, `wp-config.php`, `.env` files, API keys, backups, or XAMPP-specific files.
- This theme does not require ACF, page builders, React, Composer, npm, GSAP, Lottie, or external frontend libraries.
- Some visual elements are built with HTML/CSS only and are intentionally asset-light.
- Work category subpages depend on the `service-pillar` taxonomy terms matching the expected slugs.
- Email delivery depends on server mail configuration; SMTP is strongly recommended for live hosting.
