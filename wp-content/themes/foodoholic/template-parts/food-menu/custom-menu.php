<?php
/**
 * The template for displaying food_menu items
 *
 * @package Foodoholic
 */
?>

<?php
$number = get_theme_mod( 'foodoholic_food_menu_number', 5 );

if ( ! $number ) {
	// If number is 0, then this section is disabled
	return;
}

for ( $i = 1; $i <= $number; $i++ ) {
	$title   = get_theme_mod( 'foodoholic_food_menu_title_' . $i );
	$content = get_theme_mod( 'foodoholic_food_menu_content_' . $i );
	$target  = get_theme_mod( 'foodoholic_food_menu_target_' . $i ) ? '_blank': '_self';
	$link    = get_theme_mod( 'foodoholic_food_menu_link_' . $i, '#' );
	$price   = get_theme_mod( 'foodoholic_food_menu_price_' . $i );

	if ( function_exists( 'qtrans_convertURL' ) ) {
		$link = qtrans_convertURL( $link );
	}

	?>
	<article id="post-<?php echo esc_attr( $i ) ?>" class="post hentry post-image">
		<div class="hentry-inner">
			<div class="entry-container">
				<?php if ( $content || $title ) : ?>
				<div class="entry-description">
					<header class="entry-header">
						<h2 class="entry-title"><a href="<?php echo esc_url( $link ); ?>" target="<?php echo $target; ?>"><?php echo esc_html( $title ); ?></a></h2>
					</header>
					<div class="entry-content">
						<?php echo wp_kses_post( apply_filters( 'the_content', $content ) ); ?>
					</div>
				</div>
				<?php endif; ?>

				<?php if ( $price ) : ?>
				<div class="entry-price">
					<p class="item-price"><?php echo esc_html( $price ); ?></p>
				</div>
				<?php endif; ?>
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php
} // end foreach().
