<?php
/**
 * The template used for displaying menu single content
 *
 * @package Foodoholic
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="food-menu-thumbnail post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'foodoholic-testimonial-thumb' ); ?>
			</a>
		</div>
		<?php endif; ?>
		<div class="entry-container">
			<div class="entry-description">
				<header class="entry-header">
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h2>' ); ?>
				</header>

				<?php
				$show_content = get_theme_mod( 'foodoholic_food_menu_show', 'excerpt' );

				if ( 'excerpt' === $show_content ) {
					echo '<div class="entry-summary">' . wp_strip_all_tags( get_the_excerpt(), true ) . '</div>';
				} elseif ( 'full-content' === $show_content ) {
					$content = apply_filters( 'the_content', get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', $content );
					echo '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
				} ?>
			</div>
			<div class="entry-price">
				<p class="item-price"><?php echo esc_html( get_post_meta( get_the_ID(), 'ect_food_price', true ) ); ?></p>
			</div>
		</div>
	</div><!-- .hentry-inner -->
</article><!-- .hentry -->
