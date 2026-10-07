<?php
/**
 * Theme options for Resta using embedded Codestar Framework
 *
 * @package Resta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CSF' ) ) {
	return;
}

$prefix = 'resta_options';

// Create main options panel
CSF::createOptions(
	$prefix,
	array(
		'framework_title' => __( 'Resta Theme Options', 'resta' ),
		'menu_title'      => __( 'Resta Settings', 'resta' ),
		'menu_slug'       => 'resta-theme-options',
		'menu_position'   => 59,
		'icon_url'        => 'dashicons-admin-generic',
	)
);

// General Settings Section
CSF::createSection(
	$prefix,
	array(
		'id'     => 'general',
		'title'  => __( 'General Settings', 'resta' ),
		'icon'   => 'fas fa-cog',
		'fields' => array(
			array(
				'id'    => 'logo_url',
				'type'  => 'upload',
				'title' => __( 'Logo', 'resta' ),
			),
			array(
				'id'      => 'primary_color',
				'type'    => 'color',
				'title'   => __( 'Primary Color', 'resta' ),
				'default' => '#111111',
			),
			array(
				'id'      => 'secondary_color',
				'type'    => 'color',
				'title'   => __( 'Secondary Color (Accent)', 'resta' ),
				'default' => '#d9b46a',
			),
			array(
				'id'      => 'font_family',
				'type'    => 'text',
				'title'   => __( 'Font Family', 'resta' ),
				'default' => 'Vazirmatn, sans-serif',
				'help'    => __( 'Set the main font for the theme', 'resta' ),
			),
			array(
				'id'      => 'header_phone',
				'type'    => 'text',
				'title'   => __( 'Phone Number', 'resta' ),
				'default' => '+989121234567',
			),
			array(
				'id'      => 'header_email',
				'type'    => 'text',
				'title'   => __( 'Email Address', 'resta' ),
				'default' => 'info@example.com',
			),
		),
	)
);

// Homepage Settings Section
CSF::createSection(
	$prefix,
	array(
		'id'     => 'homepage',
		'title'  => __( 'Homepage', 'resta' ),
		'icon'   => 'fas fa-home',
		'fields' => array(
			array(
				'id'     => 'home_slider',
				'type'   => 'repeater',
				'title'  => __( 'Slider Items', 'resta' ),
				'fields' => array(
					array(
						'id'    => 'title',
						'type'  => 'text',
						'title' => __( 'Slide Title', 'resta' ),
					),
					array(
						'id'    => 'image',
						'type'  => 'upload',
						'title' => __( 'Slide Image (1600x700px)', 'resta' ),
					),
					array(
						'id'    => 'link',
						'type'  => 'text',
						'title' => __( 'Slide Button Link', 'resta' ),
						'help'  => __( 'Full URL to the page or product', 'resta' ),
					),
				),
				'button_title' => __( 'Add Slide', 'resta' ),
			),
			array(
				'id'      => 'newsletter_title',
				'type'    => 'text',
				'title'   => __( 'Newsletter Section Title', 'resta' ),
				'default' => 'خبرنامه رستا',
			),
			array(
				'id'      => 'newsletter_text',
				'type'    => 'textarea',
				'title'   => __( 'Newsletter Section Description', 'resta' ),
				'default' => 'برای دریافت پیشنهادهای ویژه، ثبت‌نام کنید.',
			),
		),
	)
);

// Shop Settings Section
CSF::createSection(
	$prefix,
	array(
		'id'     => 'shop',
		'title'  => __( 'Shop Settings', 'resta' ),
		'icon'   => 'fas fa-shopping-cart',
		'fields' => array(
			array(
				'id'      => 'woocommerce_columns',
				'type'    => 'select',
				'title'   => __( 'Products Per Row', 'resta' ),
				'options' => array(
					'2' => '2 Columns',
					'3' => '3 Columns',
					'4' => '4 Columns',
					'5' => '5 Columns',
				),
				'default' => '4',
			),
			array(
				'id'      => 'catalog_products_per_page',
				'type'    => 'number',
				'title'   => __( 'Products Per Page', 'resta' ),
				'default' => '12',
			),
		),
	)
);
