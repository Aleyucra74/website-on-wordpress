<?php
/**
 * The template for displaying the Slider
 *
 * @package Foodoholic
 */

if ( ! function_exists( 'foodoholic_featured_slider' ) ) :
	/**
	 * Add slider.
	 *
	 * @uses action hook foodoholic_before_content.
	 *
	 * @since Foodoholic 1.0
	 */
	function foodoholic_featured_slider() {
		if ( foodoholic_is_slider_displayed() ) {
			$output = '
				<div class="slider-content-wrapper section style-with-bg">
					<div class="wrapper">
						<div class="section-content-wrap">
							<div class="cycle-slideshow"
							    data-cycle-log="false"
							    data-cycle-pause-on-hover="true"
							    data-cycle-swipe="true"
							    data-cycle-auto-height=container
							    data-cycle-fx="fade"
								data-cycle-speed="1000"
								data-cycle-timeout="4000"
								data-cycle-loader="true"
								data-cycle-loader=false
								data-cycle-pager="#featured-slider-pager"
								data-cycle-prev="#featured-slider-prev"
        						data-cycle-next="#featured-slider-next"
								data-cycle-slides="> .post-slide"
								>';

				$output .= '
								<div class="controllers">
									<!-- prev/next links -->
									<div id="featured-slider-prev" class="cycle-prev fa fa-angle-left" aria-label="Previous" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Previous Slide', 'foodoholic' ) . '</span></div>

									<!-- empty element for pager links -->
									<div id="featured-slider-pager" class="cycle-pager"></div>

									<div id="featured-slider-next" class="cycle-next fa fa-angle-right" aria-label="Next" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Next Slide', 'foodoholic' ) . '</span></div>

								</div><!-- .controllers -->';
				$output .= foodoholic_post_page_category_slider();
				$output .= '
							</div><!-- .cycle-slideshow -->
						</div><!-- .section-content-wrap -->
					</div><!-- .wrapper -->';

					$output .= '<div class="scroll-down">
						<span>' . esc_html__( 'Scroll', 'foodoholic' ) . '</span>
						<span class="fa fa-angle-down" aria-hidden="true"></span>
					</div><!-- .scroll-down -->';

			$output .= '
				</div><!-- .slider-content-wrapper -->';

			echo $output;
		} // End if().
	}
	endif;
add_action( 'foodoholic_slider', 'foodoholic_featured_slider', 10 );

if ( ! function_exists( 'foodoholic_post_page_category_slider' ) ) :
	/**
	 * This function to display featured posts/page/category slider
	 *
	 * @param $options: foodoholic_theme_options from customizer
	 *
	 * @since Foodoholic 1.0
	 */
	function foodoholic_post_page_category_slider() {
		$quantity     = get_theme_mod( 'foodoholic_slider_number', 4 );
		$no_of_post   = 0; // for number of posts
		$post_list    = array();// list of valid post/page ids
		$show_content = get_theme_mod( 'foodoholic_slider_content_show', 'show-content' );
		$output       = '';

		$args = array(
			'post_type'           => 'any',
			'orderby'             => 'post__in',
			'ignore_sticky_posts' => 1, // ignore sticky posts
		);

		//Get valid number of posts
			for ( $i = 1; $i <= $quantity; $i++ ) {
				$post_id = '';

					$post_id = get_theme_mod( 'foodoholic_slider_page_' . $i );

				if ( $post_id && '' !== $post_id ) {
					$post_list = array_merge( $post_list, array( $post_id ) );

					$no_of_post++;
				}
			}

			$args['post__in'] = $post_list;

		if ( ! $no_of_post ) {
			return;
		}

		$args['posts_per_page'] = $no_of_post;

		$loop = new WP_Query( $args );

		while ( $loop->have_posts() ) :
			$loop->the_post();

			$title_attribute = the_title_attribute( 'echo=0' );


			if ( 0 === $loop->current_post ) {
				$classes = 'post post-' . get_the_ID() . ' hentry slides displayblock content-aligned-right';

			} else {
				$classes = 'post post-' . get_the_ID() . ' hentry slides displaynone content-aligned-right';
			}

			// Default value if there is no featurd image or first image.
			$image_url = trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/no-thumb-850x850.jpg';

			$thumbnail = 'foodoholic-slider-bg';
			
			if ( has_post_thumbnail() ) {
				$image_url = get_the_post_thumbnail_url( get_the_ID(), $thumbnail );
			} else {
				// Get the first image in page, returns false if there is no image.
				$first_image_url = foodoholic_get_first_image( get_the_ID(), $thumbnail, '', true );

				// Set value of image as first image if there is an image present in the page.
				if ( $first_image_url ) {
					$image_url = $first_image_url;
				} 
			}
			$more_tag_text = get_theme_mod( 'foodoholic_excerpt_more_text',  esc_html__( 'Continue reading', 'foodoholic' ) );

			$output .= '
			<div class="post-slide">
				<article class="' . esc_attr( $classes ) . '">';

					$output .= '
					<div class="slider-image">
						<a href="' . esc_url( get_permalink() ) . '" title="' . $title_attribute . '">
								<img src="' . esc_url( $image_url ) . '" class="wp-post-image" alt="' . $title_attribute . '">
							</a>
					</div><!-- .slider-image -->
					<div class="entry-container"><div class="entry-container-wrap">';

				$output .= the_title( '<header class="entry-header"><h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2></header>', false );

				$show_content = get_theme_mod( 'foodoholic_slider_show', 'excerpt' );

				if ( 'excerpt' === $show_content ) {
					$output .= '<div class="entry-summary"><p>' . get_the_excerpt() . '</p></div><!-- .entry-summary -->';
				} elseif ( 'full-content' === $show_content ) {
					$content = apply_filters( 'the_content', get_the_content() );
					$content = str_replace( ']]>', ']]&gt;', $content );
					$output .= '<div class="entry-content">' . wp_kses_post( $content ) . '</div><!-- .entry-content -->';
				}

						$output .= '
					</div></div><!-- .entry-container -->
				</article><!-- .slides -->
			</div><!-- .post-slide -->';
		endwhile;

		wp_reset_postdata();

		return $output;
	}
endif; // foodoholic_post_page_category_slider.

if ( ! function_exists( 'foodoholic_is_slider_displayed' ) ) :
	/**
	 * Return true if slider image is displayed
	 *
	 */
	function foodoholic_is_slider_displayed() {
		$enable_slider = get_theme_mod( 'foodoholic_slider_option', 'disabled' );

		return foodoholic_check_section( $enable_slider );
	}
endif; // foodoholic_is_slider_displayed.
