<?php
/**
 * Theme functions for Resta - Complete Version
 *
 * @package Resta
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'RESTA_THEME_VERSION', '1.0.0' );
define( 'RESTA_DIR', get_template_directory() );
define( 'RESTA_URI', get_template_directory_uri() );

// Load Codestar Framework embedded
if ( ! class_exists( 'CSF' ) ) {
	require_once RESTA_DIR . '/vendor/codestar/framework.php';
}

// ===== Default Options =====
if ( ! function_exists( 'resta_get_default_options' ) ) {
	function resta_get_default_options() {
		return array(
			'logo_url'                  => '',
			'primary_color'             => '#111111',
			'secondary_color'           => '#d9b46a',
			'header_bg'                 => '#ffffff',
			'body_bg'                   => '#f5f5f5',
			'text_color'                => '#111111',
			'muted_color'               => '#6b7280',
			'font_family'               => 'Vazirmatn',
			'header_phone'              => '+989121234567',
			'header_email'              => 'info@example.com',
			'home_slider'               => array(),
			'newsletter_title'          => 'خبرنامه رستا',
			'newsletter_text'           => 'برای دریافت پیشنهادهای ویژه، ثبت‌نام کنید.',
			'woocommerce_columns'       => '4',
			'catalog_products_per_page' => '12',
			'debug_enabled'             => 1,
		);
	}
}

// ===== Get Theme Options =====
if ( ! function_exists( 'resta_get_options' ) ) {
	function resta_get_options() {
		$defaults = resta_get_default_options();
		$options  = get_option( 'resta_options', array() );

		if ( ! is_array( $options ) ) {
			$options = array();
		}

		return wp_parse_args( $options, $defaults );
	}
}

// ===== Theme Setup =====
if ( ! function_exists( 'resta_setup' ) ) {
	function resta_setup() {
		load_theme_textdomain( 'resta', RESTA_DIR . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'resta' ),
				'footer'  => esc_html__( 'Footer Menu', 'resta' ),
			)
		);

		add_image_size( 'resta-product-card', 500, 650, true );
		add_image_size( 'resta-hero', 1600, 700, true );
	}
}
add_action( 'after_setup_theme', 'resta_setup' );

// ===== Register Theme Options Panel =====
if ( ! function_exists( 'resta_register_options' ) ) {
	function resta_register_options() {
		if ( class_exists( 'CSF' ) ) {
			require_once RESTA_DIR . '/inc/theme-options.php';
		}
	}
}
add_action( 'after_setup_theme', 'resta_register_options', 20 );

// ===== Enqueue Main Assets =====
if ( ! function_exists( 'resta_enqueue_main' ) ) {
	function resta_enqueue_main() {
		$version = RESTA_THEME_VERSION;

		// Main CSS
		wp_enqueue_style(
			'resta-style',
			get_stylesheet_uri(),
			array(),
			$version
		);

		wp_enqueue_style(
			'resta-main',
			RESTa_URI . '/assets/css/main.css',
			array(),
			$version
		);

		// Main JS
		wp_enqueue_script(
			'resta-main',
			RESTa_URI . '/assets/js/main.js',
			array( 'jquery' ),
			$version,
			true
		);

		// WooCommerce support
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style(
				'resta-woocommerce',
				RESTa_URI . '/assets/css/woocommerce.css',
				array(),
				$version
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'resta_enqueue_main' );

// ===== Enqueue Homepage Assets =====
if ( ! function_exists( 'resta_enqueue_homepage' ) ) {
	function resta_enqueue_homepage() {
		if ( is_front_page() ) {
			$version = RESTA_THEME_VERSION;

			wp_enqueue_style(
				'resta-home',
				RESTa_URI . '/assets/css/home.css',
				array( 'resta-main' ),
				$version
			);

			wp_enqueue_script(
				'resta-home',
				RESTa_URI . '/assets/js/home.js',
				array( 'jquery' ),
				$version,
				true
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'resta_enqueue_homepage' );

// ===== Enqueue Product Page Assets =====
if ( ! function_exists( 'resta_enqueue_product' ) ) {
	function resta_enqueue_product() {
		if ( is_singular( 'product' ) ) {
			$version = RESTA_THEME_VERSION;

			wp_enqueue_style(
				'resta-product',
				RESTa_URI . '/assets/css/product.css',
				array( 'resta-main' ),
				$version
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'resta_enqueue_product' );

// ===== Include Product Card Component =====
if ( ! function_exists( 'resta_product_card' ) ) {
	require_once RESTA_DIR . '/inc/product-card.php';
}

// ===== Debug Functions =====
if ( ! function_exists( 'resta_debug_log' ) ) {
	function resta_debug_log( $message = '' ) {
		if ( empty( $message ) ) {
			return;
		}

		$upload_dir = wp_upload_dir();
		$log_dir    = trailingslashit( $upload_dir['basedir'] ) . 'resta-debug';

		if ( ! file_exists( $log_dir ) ) {
			wp_mkdir_p( $log_dir );
		}

		$log_path  = trailingslashit( $log_dir ) . 'debug.log';
		$timestamp = current_time( 'mysql' );
		$entry     = '[' . $timestamp . '] ' . wp_json_encode( $message ) . PHP_EOL;

		$file = fopen( $log_path, 'ab' );
		if ( $file ) {
			fwrite( $file, $entry );
			fclose( $file );
		}
	}
}

if ( ! function_exists( 'resta_get_debug_log' ) ) {
	function resta_get_debug_log() {
		$upload_dir = wp_upload_dir();
		$log_path   = trailingslashit( $upload_dir['basedir'] ) . 'resta-debug/debug.log';

		if ( ! file_exists( $log_path ) ) {
			return '';
		}

		return file_get_contents( $log_path );
	}
}

if ( ! function_exists( 'resta_clear_debug_log' ) ) {
	function resta_clear_debug_log() {
		if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ), 'resta_clear_debug_log' ) ) {
			wp_die( esc_html__( 'Security check failed.', 'resta' ) );
		}

		$upload_dir = wp_upload_dir();
		$log_path   = trailingslashit( $upload_dir['basedir'] ) . 'resta-debug/debug.log';

		if ( file_exists( $log_path ) ) {
			unlink( $log_path );
		}

		wp_safe_redirect(
			add_query_arg(
				array(
					'page'    => 'resta-debug',
					'cleared' => 1,
				),
				admin_url( 'admin.php' )
			)
		);
		exit;
	}
}
add_action( 'admin_post_resta_clear_debug_log', 'resta_clear_debug_log' );

if ( ! function_exists( 'resta_admin_debug_page' ) ) {
	function resta_admin_debug_page() {
		$log_contents = resta_get_debug_log();
		?>
		<div class="wrap">
			<h1><?php echo esc_html__( 'Resta Debug Panel', 'resta' ); ?></h1>

			<?php if ( isset( $_GET['cleared'] ) ) : ?>
				<div class="notice notice-success is-dismissible">
					<p><?php echo esc_html__( 'Debug log cleared successfully.', 'resta' ); ?></p>
				</div>
			<?php endif; ?>

			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="resta_clear_debug_log" />
				<?php wp_nonce_field( 'resta_clear_debug_log' ); ?>
				<?php submit_button( __( 'Clear Debug Log', 'resta' ), 'delete', 'submit', false ); ?>
			</form>

			<h2><?php echo esc_html__( 'Error Log', 'resta' ); ?></h2>
			<textarea rows="20" cols="160" style="width: 100%; font-family: monospace; background: #f5f5f5; padding: 10px;" readonly><?php echo esc_textarea( $log_contents ); ?></textarea>
		</div>
		<?php
	}
}

if ( ! function_exists( 'resta_register_debug_menu' ) ) {
	function resta_register_debug_menu() {
		add_menu_page(
			__( 'Resta Debug', 'resta' ),
			__( 'Resta Debug', 'resta' ),
			'manage_options',
			'resta-debug',
			'resta_admin_debug_page',
			'dashicons-admin-tools',
			30
		);
	}
}
add_action( 'admin_menu', 'resta_register_debug_menu' );
