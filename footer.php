<?php
/**
 * Footer template.
 *
 * @package Resta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$options = resta_get_options();
?>
<footer class="resta-footer">
	<div class="container">
		<div class="resta-footer__inner">
			<div class="resta-footer__col">
				<h4><?php echo esc_html__( 'About', 'resta' ); ?></h4>
				<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
			</div>

			<div class="resta-footer__col">
				<h4><?php echo esc_html__( 'Quick Links', 'resta' ); ?></h4>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'resta-footer-menu',
						'fallback_cb'    => false,
					)
				);
				?>
			</div>

			<div class="resta-footer__col">
				<h4><?php echo esc_html__( 'Contact', 'resta' ); ?></h4>
				<p><?php echo esc_html( $options['header_phone'] ?? '' ); ?></p>
				<p><?php echo esc_html( $options['header_email'] ?? '' ); ?></p>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
