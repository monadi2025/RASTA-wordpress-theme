<?php
/**
 * Theme options for Resta using Codestar Framework.
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

CSF::createOptions(
	$prefix,
	array(
		'framework_title' => __( 'Resta Theme Options', 'resta' ),
		'menu_title'      => __( 'Resta', 'resta' ),
		'menu_slug'       => 'resta-theme-options',
		'menu_position'   => 59,
		'icon_url'        => 'dashicons-admin-generic',
	)
);

CSF::createSection(
	$prefix,
	array(
		'id'     => 'general',
		'title'  => __( 'General', 'resta' ),
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
				'title'   => __( 'Secondary Color', 'resta' ),
				'default' => '#d9b46a',
			),
			array(
				'id'      => 'font_family',
				'type'    => 'text',
				'title'   => __( 'Font Family', 'resta' ),
				'default' => 'Vazirmatn',
			),
			array(
				'id'      => 'header_phone',
				'type'    => 'text',
				'title'   => __( 'Header Phone', 'resta' ),
				'default' => '+989121234567',
			),
			array(
				'id'      => 'header_email',
				'type'    => 'text',
				'title'   => __( 'Header Email', 'resta' ),
				'default' => 'info@example.com',
			),
		),
	)
);

CSF::createSection(
	$prefix,
	array(
		'id'     => 'home',
		'title'  => __( 'Home', 'resta' ),
		'fields' => array(
			array(
				'id'     => 'home_slider',
				'type'   => 'repeater',
				'title'  => __( 'Slider Items', 'resta' ),
				'fields' => array(
					array(
						'id'    => 'title',
						'type'  => 'text',
						'title' => __( 'Title', 'resta' ),
					),
					array(
						'id'    => 'image',
						'type'  => 'upload',
						'title' => __( 'Image', 'resta' ),
					),
					array(
						'id'    => 'link',
						'type'  => 'text',
						'title' => __( 'Link', 'resta' ),
					),
				),
			),
			array(
				'id'    => 'newsletter_title',
				'type'  => 'text',
				'title' => __( 'Newsletter Title', 'resta' ),
			),
			array(
				'id'    => 'newsletter_text',
				'type'  => 'textarea',
				'title' => __( 'Newsletter Text', 'resta' ),
			),
		),
	)
);

CSF::createSection(
	$prefix,
	array(
		'id'     => 'shop',
		'title'  => __( 'Shop', 'resta' ),
		'fields' => array(
			array(
				'id'      => 'woocommerce_columns',
				'type'    => 'select',
				'title'   => __( 'Products Per Row', 'resta' ),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'default' => '4',
			),
			array(
				'id'      => 'catalog_products_per_page',
				'type'    => 'number',
				'title'   => __( 'Products Per Page', 'resta' ),
				'default' => 12,
			),
		),
	)
);
