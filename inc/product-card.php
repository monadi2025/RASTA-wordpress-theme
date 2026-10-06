<?php
/**
 * Product card component.
 *
 * @package Resta
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'resta_product_card' ) ) {
	function resta_product_card( $product ) {
		if ( ! $product ) {
			return;
		}

		$product_id  = $product->get_id();
		$title       = $product->get_name();
		$permalink   = $product->get_permalink();
		$image_id    = $product->get_image_id();
		$image_url   = wp_get_attachment_image_url( $image_id, 'resta-product-card' );
		$price       = $product->get_price();
		$regular_price = $product->get_regular_price();
		$sale_price  = $product->get_sale_price();
		$rating      = $product->get_average_rating();
		$review_count = $product->get_review_count();
		$stock       = $product->get_stock_status();

		// Calculate discount percentage
		$discount = 0;
		if ( $regular_price && $sale_price ) {
			$discount = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
		}
		?>
		<div class="resta-product-card">
			<div class="resta-product-card__image">
				<?php if ( $image_url ) : ?>
					<a href="<?php echo esc_url( $permalink ); ?>">
						<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
					</a>
				<?php else : ?>
					<a href="<?php echo esc_url( $permalink ); ?>" class="resta-product-card__no-image">
						<?php echo esc_html__( 'No Image', 'resta' ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $discount > 0 ) : ?>
					<span class="resta-product-card__badge resta-product-card__badge--discount">-<?php echo esc_html( $discount ); ?>%</span>
				<?php endif; ?>

				<?php if ( 'outofstock' === $stock ) : ?>
					<span class="resta-product-card__badge resta-product-card__badge--outofstock"><?php echo esc_html__( 'Sold Out', 'resta' ); ?></span>
				<?php endif; ?>
			</div>

			<div class="resta-product-card__content">
				<h3 class="resta-product-card__title">
					<a href="<?php echo esc_url( $permalink ); ?>"><?php echo esc_html( $title ); ?></a>
				</h3>

				<?php if ( $rating > 0 ) : ?>
					<div class="resta-product-card__rating">
						<div class="resta-rating">
							<?php
							for ( $i = 1; $i <= 5; $i++ ) {
								$class = $i <= round( $rating ) ? 'filled' : '';
								?>
								<span class="resta-star <?php echo esc_attr( $class ); ?>">★</span>
								<?php
							}
							?>
						</div>
						<span class="resta-product-card__review-count">(<?php echo esc_html( $review_count ); ?>)</span>
					</div>
				<?php endif; ?>

				<div class="resta-product-card__price">
					<?php if ( $sale_price ) : ?>
						<span class="resta-price--sale"><?php echo wc_price( $sale_price ); ?></span>
						<span class="resta-price--regular"><?php echo wc_price( $regular_price ); ?></span>
					<?php else : ?>
						<span class="resta-price"><?php echo wc_price( $price ); ?></span>
					<?php endif; ?>
				</div>

				<div class="resta-product-card__actions">
					<?php if ( 'instock' === $stock ) : ?>
						<form class="resta-add-to-cart" method="post" action="<?php echo esc_url( wc_get_cart_url() ); ?>">
							<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product_id ); ?>">
							<button type="submit" class="resta-btn resta-btn--add-to-cart"><?php echo esc_html__( 'Add to Cart', 'resta' ); ?></button>
						</form>
					<?php else : ?>
						<button class="resta-btn resta-btn--disabled" disabled><?php echo esc_html__( 'Unavailable', 'resta' ); ?></button>
					<?php endif; ?>

					<a href="<?php echo esc_url( $permalink ); ?>" class="resta-product-card__view" title="<?php echo esc_attr__( 'View Details', 'resta' ); ?>">🔍</a>
				</div>
			</div>
		</div>
		<?php
	}
}
