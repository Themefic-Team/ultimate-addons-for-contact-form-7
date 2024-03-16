<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

if ( file_exists( UACF7_PATH . 'admin/tf-options/options/tf-menu-icon.php' ) ) {

	$menu_icon = UACF7_URL . 'assets/admin/images/icon.png'; 
} else {
	$menu_icon = 'dashicons-palmtree';
}

UACF7_Settings::option( 'uacf7_settings', array(
	'title' => __( 'Ultimate Addons', 'ultimate-addons-cf7' ),
	'icon' => $menu_icon,
	'position' => 30.01,
	'sections' =>
		apply_filters( 'uacf7_settings_options', array(
			'addons_settings' => array(
				'title' => __( 'Addons Settings', 'ultimate-addons-cf7' ),
				'icon' => 'fa fa-cog',
				'fields' => array(
				),
			),
			'general_addons' => array(
				'title' => __( 'General Addons', 'ultimate-addons-cf7' ),
				'parent' => 'addons_settings',
				'icon' => 'fa fa-cog',
				'fields' => array(
					'uacf7_enable_redirection' => array(
						'id' => 'uacf7_enable_redirection',
						'child_field' => 'uacf7_enable_redirection_pro',
						'type' => 'switch',
						'label' => __( 'Redirection ', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Redirection@2x.png',
						'subtitle' => __( 'Redirect users to a Thank You or External page upon form submission.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/redirection-for-contact-form-7/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/redirection-for-contact-form-7/',
						'default' => false,


					),
					'uacf7_enable_redirection_pro' => array(
						'id' => 'uacf7_enable_redirection_pro',
						'child_field' => 'uacf7_enable_redirection',
						'type' => 'switch',
						'label' => __( 'Redirection Pro (Conditional Redirect + Whatsapp Integration)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Conditional-Redirect@2x.png',
						'subtitle' => __( 'Redirect users to different webpages based on specific conditions. Supports CF7 fields tag and Whatsapp data transfer.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/conditional-redirect-for-contact-form-7/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/conditional-redirect-for-contact-form-7/',
						'default' => false,
						'is_pro' => true,

					),
					'uacf7_enable_conditional_field' => array(
						'id' => 'uacf7_enable_conditional_field',
						'child_field' => 'uacf7_enable_conditional_field_pro',
						'type' => 'switch',
						'label' => __( 'Conditional Field', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Conditional-Field@2x.png',
						'subtitle' => __( 'Show or hide Contact Form 7 fields based on Conditional Logic.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-conditional-fields/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-conditional-fields/',
						'default' => false,

					),
					'uacf7_enable_conditional_field_pro' => array(
						'id' => 'uacf7_enable_conditional_field_pro',
						'child_field' => 'uacf7_enable_conditional_field',
						'type' => 'switch',
						'label' => __( 'Conditional Field (Pro)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Conditional-Field@2x.png',
						'subtitle' => __( 'Advanced Conditional Logic for elements like Range Slider, Star Rating, Country Dropdown, and IP Geolocation.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/conditional-field-pro/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-conditional-fields-pro//',
						'default' => false,
						'is_pro' => true,

					),
					'uacf7_enable_field_column' => array(
						'id' => 'uacf7_enable_field_column',
						'child_field' => 'uacf7_enable_field_column_pro',
						'type' => 'switch',
						'label' => __( 'Column or Grid', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Column-or-Grid-Layout@2x.png',
						'subtitle' => __( 'Easily create two columns, three Columns; even Four columns form.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-columns-or-grid/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-columns/',
						'label_on' => __( 'Yes', 'ultimate-addons-cf7' ),
						'label_off' => __( 'No', 'ultimate-addons-cf7' ),
						'default' => false,

					),
					'uacf7_enable_field_column_pro' => array(
						'id' => 'uacf7_enable_field_column_pro',
						'child_field' => 'uacf7_enable_field_column',
						'type' => 'switch',
						'label' => __( 'Column - Custom Width', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Custom-Column-Width@2x.png',
						'subtitle' => __( 'Set form columns at custom / desired widths, like creating a form with columns of 12%, 27%, and 61% widths.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/custom-columns-grid-layout/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/custom-columns-for-contact-form-7/',
						'default' => false,
						'is_pro' => true,

					),
					'uacf7_enable_placeholder' => array(
						'id' => 'uacf7_enable_placeholder',
						'type' => 'switch',
						'label' => __( 'Placeholder Styling', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Placeholder-Styling@2x.png',
						'default' => false,
						'subtitle' => __( 'Style form placeholders, like text color and background color, without writing any CSS. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-placeholder-styling/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-placeholder-styling/',
					),
					'uacf7_enable_uacf7style' => array(
						'id' => 'uacf7_enable_uacf7style',
						'type' => 'switch',
						'label' => __( 'Form Styler (Single)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Form-Styler@2x.png',
						'default' => false,
						'subtitle' => __( 'Style your entire form without any CSS coding, including colors, margins, button styles, and font sizes.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-style-addon/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-style/',
					),
					'uacf7_enable_uacf7style_global' => array(
						'id' => 'uacf7_enable_uacf7style_global',
						'type' => 'switch',
						'label' => __( 'Form Styler (Global)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Global-Form-Styler@2x.png',
						'default' => false,
						'is_pro' => true,
						'subtitle' => __( 'Style all your forms from one place without any CSS code.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/global-form-styler/',
						'documentation_link' => 'https://themefic.com/docs/pro-addons/global-form-styler-for-contact-form-7/',
					),
					'uacf7_enable_multistep' => array(
						'id' => 'uacf7_enable_multistep',
						'child_field' => 'uacf7_enable_multistep_pro',
						'type' => 'switch',
						'label' => __( 'Multi-step Form', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Multi-Step-Form@2x.png',
						'default' => false,
						'subtitle' => __( 'Create stunning multi-step forms with Contact Form 7. Ideal for long forms and surveys.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-multi-step-forms/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-multi-step-forms/',
					),
					'uacf7_enable_multistep_pro' => array(
						'id' => 'uacf7_enable_multistep_pro',
						'child_field' => 'uacf7_enable_multistep',
						'type' => 'switch',
						'label' => __( 'Multi-step Form (Pro)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Multi-Step-Form-Pro-Skins@2x.png',
						'default' => false,
						'subtitle' => __( 'Choose from premium templates for multi-step forms, automatically generating pre-designed forms. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-multi-step-forms/pro/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-multi-step-form-pro/',
						'is_pro' => true,
					),
					'uacf7_enable_booking_form' => array(
						'id' => 'uacf7_enable_booking_form',
						'type' => 'switch',
						'label' => __( 'Booking/Appointment Form', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Booking-or-Appointment-Form@2x.png',
						'default' => false,
						'subtitle' => __( 'Create a booking or appointment form using Contact Form 7, including calendar and time options, with payment support.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-booking-form/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-booking-form/',
						'is_pro' => true,
					),
					'uacf7_enable_post_submission' => array(
						'id' => 'uacf7_enable_post_submission',
						'type' => 'switch',
						'label' => __( 'Frontend Post Submission', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Frontend-Post-Submission@2x.png',
						'default' => false,
						'subtitle' => __( 'Automatically publish submitted forms as new posts and display them on the front end, with custom field support.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-to-post-type/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-to-post-type/',
						'is_pro' => true,
					),
					'uacf7_enable_mailchimp' => array(
						'id' => 'uacf7_enable_mailchimp',
						'type' => 'switch',
						'label' => __( 'Mailchimp Integration', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Connect-with-Mailchimp@2x.png',
						'default' => false,
						'subtitle' => __( 'Integrate Contact Form 7 with Mailchimp. Add submissions to Mailchimp lists automatically.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/mailchimp-for-contact-form-7/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-mailchimp/',

					),
					'uacf7_enable_database_field' => array(
						'id' => 'uacf7_enable_database_field',
						'type' => 'switch',
						'label' => __( 'Database ', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Save-to-Database.png',
						'default' => false,
						'subtitle' => __( 'Store form data, view data in the admin backend, and export data in CSV format. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-database/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-database/',

					),
					'uacf7_enable_pdf_generator_field' => array(
						'id' => 'uacf7_enable_pdf_generator_field',
						'type' => 'switch',
						'label' => __( 'PDF Generate', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Send-PDF-Using-Contact-form-8.png',
						'default' => false,
						'subtitle' => __( "Generate PDFs upon form submission; PDFs are sent to the admin and submitter email. ", 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-pdf-generator/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-pdf-generator/',

					),
					'uacf7_enable_form_generator_ai_field' => array(
						'id' => 'uacf7_enable_form_generator_ai_field',
						'type' => 'switch',
						'label' => __( 'AI Form Generator', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Generate-Al-Forms.png',
						'default' => false,
						'subtitle' => __( 'The Form Generator Addon helps generating categorized contact forms with the power of AI.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/ai-form-generator/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/ai-form-generator/',

					),
					'uacf7_enable_conversational_form' => array(
						'id' => 'uacf7_enable_conversational_form',
						'type' => 'switch',
						'label' => __( 'Conversational Form', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Conversational-Form.png',
						'default' => false,
						'subtitle' => __( 'Create interactive, engaging forms that mimic a conversational experience. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/conversational-form-for-contact-form-7/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/conversational-form-for-contact-form-7/',
						'is_pro' => true,
					),
					'uacf7_enable_submission_id_field' => array(
						'id' => 'uacf7_enable_submission_id_field',
						'type' => 'switch',
						'label' => __( 'Submission ID', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Unique-Submission-ID.png',
						'default' => false,
						'subtitle' => __( 'Add an unique id to every form submission. The ID can be added on the "Subject Line" of your form.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/unique-id-for-contact-form-7/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/unique-id-for-contact-form-7/',

					),
					'uacf7_enable_telegram_field' => array(
						'id' => 'uacf7_enable_telegram_field',
						'type' => 'switch',
						'label' => __( 'Telegram Integration', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Telegram-Integration-1.png',
						'default' => false,
						'subtitle' => __( 'Forward form submission data to Telegram.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-telegram/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-telegram/',

					),
					'uacf7_enable_signature_field' => array(
						'id' => 'uacf7_enable_signature_field',
						'type' => 'switch',
						'label' => __( 'Digital Signature', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/digital-signature.png',
						'default' => false,
						'subtitle' => __( 'Add a digital signature feature to your forms.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-signature-addon/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-signature-addon/',

					),
					'uacf7_enable_opt_web_hook' => array(
						'id' => 'uacf7_enable_opt_web_hook',
						'type' => 'switch',
						'label' => __( 'Pabbly/Zapier (Webhook)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Zapier(Webhook).png',
						'default' => false,
						'subtitle' => __( 'Transfer form data to third-party services like Pabbly or Zapier via webhooks. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/pabbly-zapier-webhook/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-webhook/',
					),
				),
			),
			'extra_fields_addons' => array(
				'title' => __( 'Extra Fields Addons', 'ultimate-addons-cf7' ),
				'parent' => 'addons_settings',
				'icon' => 'fa fa-cog',
				'fields' => array(
					'uacf7_enable_dynamic_text' => array(
						'id' => 'uacf7_enable_dynamic_text',
						'type' => 'switch',
						'label' => __( 'Dynamic Text ', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Dynamic-Text-Editor@1x-1.png',
						'default' => false,
						'subtitle' => __( 'Retrieve dynamic data from a website to be used in hidden fields, including URL, blog, post, user info, and custom fields. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-dynamic-text-extension/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-dynamic-text-extension/',

					),
					'uacf7_enable_pre_populate_field' => array(
						'id' => 'uacf7_enable_pre_populate_field',
						'type' => 'switch',
						'label' => __( 'Pre-populate Field', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Woocomerce-Product-Dropdown@2x.png',
						'default' => false,
						'subtitle' => __( 'Send data from one form to another, after the first form submission.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-pre-populate-fields/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-pre-populate-fields/',

					),
					'uacf7_enable_star_rating' => array(
						'id' => 'uacf7_enable_star_rating',
						'child_field' => 'uacf7_enable_star_rating_pro',
						'type' => 'switch',
						'label' => __( 'Star Rating', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Star-Rating-Field@2x.png',
						'default' => false,
						'subtitle' => __( 'Get customer feedback by adding a star rating field to your Contact Form 7. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-star-rating/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-star-rating-field/',

					),
					'uacf7_enable_star_rating_pro' => array(
						'id' => 'uacf7_enable_star_rating_pro',
						'child_field' => 'uacf7_enable_star_rating',
						'type' => 'switch',
						'label' => __( 'Star Rating Field (Pro)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Star-Rating-Field-Pro@2x.png',
						'default' => false,
						'subtitle' => __( "Choose from 5 built-in Star Rating styles, or use any Font Awesome icon for custom styles. ", 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/star-rating-pro/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-star-rating-field-pro/',
						'is_pro' => true,

					),
					'uacf7_enable_range_slider' => array(
						'id' => 'uacf7_enable_range_slider',
						'child_field' => 'uacf7_enable_range_slider_pro',
						'type' => 'switch',
						'label' => __( 'Range Slider', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Range-Slider@2x.png',
						'default' => false,
						'subtitle' => __( 'Add beautiful Range slider fields to Contact Form 7.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-range-slider/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-range-slider/',

					),
					'uacf7_enable_range_slider_pro' => array(
						'id' => 'uacf7_enable_range_slider_pro', 
						'child_field' => 'uacf7_enable_range_slider',
						'type' => 'switch',
						'label' => __( 'Range Slider (Pro)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Range-Slider-Pro@2x.png',
						'default' => false,
						'subtitle' => __( 'Choose from 3 premium pre-built Range Slider layouts for Contact Form 7. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/range-slider-pro',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-range-slider-pro/',
						'is_pro' => true,

					),
					'uacf7_enable_repeater_field' => array(
						'id' => 'uacf7_enable_repeater_field',
						'type' => 'switch',
						'label' => __( 'Repeater Field', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Repeater-Field@2x.png',
						'default' => false,
						'subtitle' => __( 'Add a repeater field to Contact Form 7 to repeat various fields, like text, files, checkboxes, text-areas, etc., with mail tag support.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/repeater-field-for-contact-form-7/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-repeatable-fields/',
						'is_pro' => true,
					),
					'uacf7_enable_country_dropdown_field' => array(
						'id' => 'uacf7_enable_country_dropdown_field',
						'child_field' => 'uacf7_enable_ip_geo_fields',
						'type' => 'switch',
						'label' => __( 'Country Dropdown Field', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/All-Country-List-with-Flag@2x.png',
						'default' => false,
						'subtitle' => __( 'Add a country dropdown list with flags to your form, automatically populating with country names. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-country-dropdown/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-country-dropdown-with-flag/',

					),
					'uacf7_enable_ip_geo_fields' => array(
						'id' => 'uacf7_enable_ip_geo_fields',
						'child_field' => 'uacf7_enable_country_dropdown_field',
						'type' => 'switch',
						'label' => __( 'IP Geo Fields (Autocomplete Country, City, State, Zip Fields)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/IP-Geolocation@2x.png',
						'default' => false,
						'subtitle' => __( 'Set up IP Geolocation-based Auto Completion for Country, City, State, Zip Fields. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-autocomplete/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-autocomplete/',
						'is_pro' => true,
					),
				),
			),
			'wooCommerce_integration' => array(
				'title' => __( 'WooCommerce Integration', 'ultimate-addons-cf7' ),
				'parent' => 'addons_settings',
				'icon' => 'fa fa-cog',
				'fields' => array(
					'uacf7_enable_product_dropdown' => array(
						'id' => 'uacf7_enable_product_dropdown',
						'child_field' => 'uacf7_enable_product_dropdown_pro',
						'type' => 'switch',
						'label' => __( 'WooCommerce Product Dropdown', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Woocomerce-Product-Dropdown@2x.png',
						'default' => false,
						'subtitle' => __( 'Easily show WooCommerce products on forms with a dropdown, allowing customers to select and inquire about products. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-woocommerce/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/free-addons/contact-form-7-woocommerce/',


					),
					'uacf7_enable_product_dropdown_pro' => array(
						'id' => 'uacf7_enable_product_dropdown_pro',
						'child_field' => 'uacf7_enable_product_dropdown',
						'type' => 'switch',
						'label' => __( 'WooCommerce Product Dropdown (Pro)', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/Woo-Categorized-Product@2x.png',
						'default' => false,
						'is_pro' => true,
						'subtitle' => __( 'Add specific WooCommerce products as dropdowns based on Product ID, with options to connect to Cart/Checkout and show products based on categories or IDs. ', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/pricing/duct-grid-view-with-thumbnails/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-woocommerce-pro/',
					),
					'uacf7_enable_product_auto_cart' => array(
						'id' => 'uacf7_enable_product_auto_cart',
						'type' => 'switch',
						'label' => __( 'WooCommerce Checkout', 'ultimate-addons-cf7' ),
						'image_url' => UACF7_URL . 'assets/admin/images/addons/WooCommerce-Checkout@2x.png',
						'default' => false,
						'subtitle' => __( 'Connect your form with WooCommerce. The process: The user selects a product from the dropdown field, submits the form, and is then automatically redirected to the WooCommerce Cart page with the product added to their cart.', 'ultimate-addons-cf7' ),
						'demo_link' => 'https://cf7addons.com/preview/contact-form-7-woocommerce-checkout/',
						'documentation_link' => 'https://themefic.com/docs/uacf7/pro-addons/contact-form-7-woocommerce-checkout/',
						'is_pro' => true,
					),
				),
			),



			'api_integration' => array(
				'title' => __( 'API Integration', 'ultimate-addons-cf7' ),
				'icon' => 'fa fa-circle-nodes',
				'fields' => array(
				),
			),
			'mailchimp' => array(
				'title' => __( 'Mailchimp API', 'ultimate-addons-cf7' ),
				'icon' => 'fa fa-mailchimp',
				'parent' => 'api_integration',
				'fields' => array(
					'uacf7_mailchimp_api_key' => array(
						'id' => 'uacf7_mailchimp_api_key',
						'type' => 'text',
						'label' => __( 'Mailchimp API', 'ultimate-addons-cf7' ),
						'subtitle' => sprintf(
							// Translators: %1$s is a Documentation link.
							esc_html__( 'Please enter your Mailchimp API key. If you are not sure how to get the API Key, follow this %1s.', 'ultimate-addons-cf7' ),
							 '<a href="https://mailchimp.com/help/about-api-keys/" target="_blank" rel="noopener">article</a>'
						)
					),
					'uacf7_mailchimp_api_status' => array(
						'id' => 'uacf7_mailchimp_api_status',
						'type' => 'notice',
						'notice' => 'info',
						'title' => __( 'To begin, you must enable the Mailchimp add-on.', 'ultimate-addons-cf7' ),
					),
				),
			),

			/**
			 * Import/Export
			 *
			 * Main menu
			 */
			'uacf7_import_export_data' => array(
				'title' => __( 'Miscellaneous', 'ultimate-addons-cf7' ),
				'icon' => 'fa-solid fa-shuffle',
				'fields' => array(
				),
			),
			'uacf7_import_export' => array(
				'title' => __( 'Import/Export', 'ultimate-addons-cf7' ),
				'parent' => 'uacf7_import_export_data',
				'icon' => 'fa fa-download',
				'fields' => array(
					'uacf7_import_export_backup' => array(
						'id' => 'uacf7_import_export_backup',
						'type' => 'backup',
						'label' => __( 'Import/Export', 'ultimate-addons-cf7' ),
						'subtitle' => sprintf(
							__( 'Import and export all options associated with this settings panel. Please save it first in order to generate the export file. ', 'ultimate-addons-cf7' )
						)
					),
				),
			),
			'uacf7_load_cdn' => array(
				'title' => __( 'Optimize Assets', 'ultimate-addons-cf7' ),
				'parent' => 'uacf7_import_export_data',
				'icon' => 'fa fa-arrow-trend-up',
				'fields' => array(
					'uacf7_enable_cdn_load_css' => array(
						'id' => 'uacf7_enable_cdn_load_css',
						'type' => 'switch',
						'save_empty' => true,
						'label' => __( 'Enable CSS Libraries Loading from CDN', 'ultimate-addons-cf7' ),
						'subtitle' => __( 'To optimize CSS performance, consider loading all assets from the CDN to reduce latency and enhance user experience.', 'ultimate-addons-cf7' )
						
					),
					'uacf7_enable_cdn_load_js' => array(
						'id' => 'uacf7_enable_cdn_load_js',
						'type' => 'switch',
						'save_empty' => true,
						'label' => __( 'Enable JavaScript Libraries Loading from CDN', 'ultimate-addons-cf7' ),
						'subtitle' => __( 'To maximize JavaScript performance, consider loading all assets from the CDN to reduce quiescence and faster user experience.', 'ultimate-addons-cf7' )
						
					),
				),
			),
		),
		)
) );
