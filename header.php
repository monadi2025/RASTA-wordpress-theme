<?php
/**
 * Header template.
 *
 * @package Resta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = resta_get_options();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="resta-header">
	<div class="container">
		<div class="resta-header__inner">
			<div class="resta-logo">
				<?php if ( ! empty( $options['logo_url'] ) ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo esc_url( $options['logo_url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php echo esc_html( get_bloginfo( 'name' ) ); ?>
					</a>
				<?php endif; ?>
			</div>

			<nav class="resta-main-menu" aria-label="<?php echo esc_attr__( 'Primary navigation', 'resta' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'resta-menu',
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<div class="resta-header__tools">
				<form class="resta-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr__( 'Search products', 'resta' ); ?>">
					<button type="submit"><?php echo esc_html__( 'Search', 'resta' ); ?></button>
				</form>

				<?php if ( class_exists( 'WooCommerce' ) ) : ?>
					<a class="resta-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
						<?php echo esc_html__( 'Cart', 'resta' ); ?>
						<?php
						$count = WC()->cart->get_cart_contents_count();
						if ( $count ) {
							echo '<span class="resta-cart-count">' . esc_html( $count ) . '</span>';
						}
						?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>
