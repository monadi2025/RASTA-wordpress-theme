<?php
/**
 * Main template file.
 *
 * @package Resta
 */

get_header();
?>
<main class="resta-main">
	<div class="container">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<article <?php post_class(); ?>>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<div><?php the_excerpt(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php echo esc_html__( 'No posts found.', 'resta' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php
get_footer();
