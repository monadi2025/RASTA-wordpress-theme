<?php
/**
 * Front page template (homepage).
 *
 * @package Resta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$options = resta_get_options();
$slider  = $options['home_slider'] ?? array();
?>

<main class="resta-main">
	<!-- Hero Slider Section -->
	<?php if ( ! empty( $slider ) && is_array( $slider ) ) : ?>
		<section class="resta-slider">
			<div class="resta-slider__wrapper">
				<?php foreach ( $slider as $slide ) : ?>
					<div class="resta-slider__item">
						<?php if ( ! empty( $slide['image'] ) ) : ?>
							<img src="<?php echo esc_url( $slide['image'] ); ?>" alt="<?php echo esc_attr( $slide['title'] ?? '' ); ?>" class="resta-slider__image">
						<?php else : ?>
							<div class="resta-slider__no-image"><?php echo esc_html__( 'No Image', 'resta' ); ?></div>
						<?php endif; ?>
						<div class="resta-slider__content">
							<?php if ( ! empty( $slide['title'] ) ) : ?>
								<h2 class="resta-slider__title"><?php echo esc_html( $slide['title'] ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $slide['link'] ) ) : ?>
								<a href="<?php echo esc_url( $slide['link'] ); ?>" class="resta-btn resta-btn--primary"><?php echo esc_html__( 'Shop Now', 'resta' ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<button class="resta-slider__nav resta-slider__nav--prev" aria-label="<?php echo esc_attr__( 'Previous slide', 'resta' ); ?>">❮</button>
			<button class="resta-slider__nav resta-slider__nav--next" aria-label="<?php echo esc_attr__( 'Next slide', 'resta' ); ?>">❯</button>
		</section>
	<?php endif; ?>

	<!-- Promo Banners Section -->
	<?php if ( function_exists( 'wc_get_products' ) ) : ?>
		<section class="resta-promo-banners">
			<div class="container">
				<div class="resta-promo-banners__grid">
					<div class="resta-promo-banner">
						<h3><?php echo esc_html__( 'Free Shipping', 'resta' ); ?></h3>
						<p><?php echo esc_html__( 'On orders over 500,000 Toman', 'resta' ); ?></p>
					</div>
					<div class="resta-promo-banner">
						<h3><?php echo esc_html__( 'Secure Payment', 'resta' ); ?></h3>
						<p><?php echo esc_html__( '100% safe and secure', 'resta' ); ?></p>
					</div>
					<div class="resta-promo-banner">
						<h3><?php echo esc_html__( '24/7 Support', 'resta' ); ?></h3>
						<p><?php echo esc_html__( 'Dedicated customer service', 'resta' ); ?></p>
					</div>
				</div>
			</div>
		</section>

		<!-- New Products Section -->
		<section class="resta-products-section">
			<div class="container">
				<div class="resta-section-header">
					<h2><?php echo esc_html__( 'New Arrivals', 'resta' ); ?></h2>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="resta-section-link"><?php echo esc_html__( 'View All', 'resta' ); ?></a>
				</div>
				<div class="resta-products-grid">
					<?php
					$new_products = wc_get_products(
						array(
							'limit'   => 8,
							'orderby' => 'date',
							'order'   => 'DESC',
						)
					);

					if ( ! empty( $new_products ) ) {
						foreach ( $new_products as $product ) {
							resta_product_card( $product );
						}
					}
					?>
				</div>
			</div>
		</section>

		<!-- Best Sellers Section -->
		<section class="resta-products-section resta-products-section--alt">
			<div class="container">
				<div class="resta-section-header">
					<h2><?php echo esc_html__( 'Best Sellers', 'resta' ); ?></h2>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="resta-section-link"><?php echo esc_html__( 'View All', 'resta' ); ?></a>
				</div>
				<div class="resta-products-grid">
					<?php
					$best_sellers = wc_get_products(
						array(
							'limit'   => 8,
							'orderby' => 'popularity',
							'order'   => 'DESC',
						)
					);

					if ( ! empty( $best_sellers ) ) {
						foreach ( $best_sellers as $product ) {
							resta_product_card( $product );
						}
					}
					?>
				</div>
			</div>
		</section>

		<!-- Newsletter Section -->
		<section class="resta-newsletter">
			<div class="container">
				<div class="resta-newsletter__content">
					<h2><?php echo esc_html( $options['newsletter_title'] ?? '' ); ?></h2>
					<p><?php echo esc_html( $options['newsletter_text'] ?? '' ); ?></p>
					<form class="resta-newsletter__form">
						<input type="email" placeholder="<?php echo esc_attr__( 'Enter your email', 'resta' ); ?>" required>
						<button type="submit" class="resta-btn resta-btn--primary"><?php echo esc_html__( 'Subscribe', 'resta' ); ?></button>
					</form>
				</div>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php
get_footer();
