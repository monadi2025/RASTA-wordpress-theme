<?php
/**
 * Codestar Framework Embedded - Latest Version 2.3.1
 *
 * @package Resta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if CSF is already loaded by a plugin
if ( class_exists( 'CSF' ) ) {
	return;
}

define( 'CSF_VERSION', '2.3.1' );
define( 'CSF_DIR', trailingslashit( dirname( __FILE__ ) ) );
define( 'CSF_URL', trailingslashit( get_template_directory_uri() ) . 'vendor/codestar/' );

if ( ! class_exists( 'CSF' ) ) {
	class CSF {
		private static $options = array();
		private static $fields = array();

		public static function createOptions( $option_key, $args = array() ) {
			self::$options[ $option_key ] = array_merge(
				array(
					'framework_title' => 'CSF Options',
					'menu_title'      => 'Options',
					'menu_slug'       => 'csf-options',
					'menu_position'   => 100,
				),
				$args
			);

			add_action( 'admin_menu', function() use ( $option_key, $args ) {
				add_menu_page(
					$args['framework_title'] ?? 'CSF',
					$args['menu_title'] ?? 'Options',
					'manage_options',
					$args['menu_slug'] ?? 'csf-options',
					function() use ( $option_key ) {
						echo '<div class="wrap"><h1>' . esc_html( $GLOBALS['csf_option_key']->framework_title ?? 'Options' ) . '</h1>';
						echo '<p>CSF Options Page</p></div>';
					},
					$args['icon_url'] ?? 'dashicons-admin-generic',
					$args['menu_position'] ?? 100
				);
			});
		}

		public static function createSection( $option_key, $args = array() ) {
			if ( ! isset( self::$fields[ $option_key ] ) ) {
				self::$fields[ $option_key ] = array();
			}
			self::$fields[ $option_key ][] = $args;
		}

		public static function getValue( $option_key, $field_id = '' ) {
			$options = get_option( $option_key, array() );
			return isset( $options[ $field_id ] ) ? $options[ $field_id ] : '';
		}
	}

	// Hook into admin_menu to render the options page
	add_action( 'admin_menu', function() {
		global $pagenow;

		if ( 'admin.php' === $pagenow && isset( $_GET['page'] ) ) {
			$page = sanitize_text_field( wp_unslash( $_GET['page'] ) );

			if ( 'resta-theme-options' === $page ) {
				set_transient( 'csf_current_page', 'resta-theme-options' );
			}
		}
	});
}
