<?php
/**
 * The template for displaying services posts on the front page
 *
 * @package Foodoholic
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="hentry-inner">
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php

				// Default value if there is no first image
				$image = '<img class="wp-post-image" src="' . trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-666x500.jpg" >';

				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'foodoholic-portfolio' );
				} else {
					// Get the first image in page, returns false if there is no image.
					$first_image = foodoholic_get_first_image( get_the_ID(), 'foodoholic-portfolio', '' );

					// Set value of image as first image if there is an image present in the page.
					if ( $first_image ) {
						$image = $first_image;
					}

					echo $image;
				}
				?>
			</a>
		</div>

		<div class="entry-container">
			<header class="entry-header">
				<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
			</header>

			<?php
				$excerpt = get_the_excerpt();

				echo '<div class="entry-summary"><p>' . $excerpt . '</p></div><!-- .entry-summary -->';
			 ?>
		</div><!-- .entry-container -->
	</div> <!-- .hentry-inner -->
</article> <!-- .article -->
