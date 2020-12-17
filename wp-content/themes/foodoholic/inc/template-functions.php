<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Foodoholic
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function foodoholic_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$classes[] = 'navigation-default';

	// Adds a class with respect to layout selected.
	$layout  = foodoholic_get_theme_layout();
	$sidebar = foodoholic_get_sidebar_id();

	if ( 'no-sidebar-full-width' === $layout ) {
		$classes[] = 'no-sidebar full-width-layout';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$classes[] = 'two-columns-layout content-left';
		}
	}

	$classes[] = 'fluid-layout';

	$header_media_title    = get_theme_mod( 'foodoholic_header_media_title' );
	$header_media_subtitle = get_theme_mod( 'foodoholic_header_media_subtitle' );
	$header_media_text     = get_theme_mod( 'foodoholic_header_media_text' );
	$header_media_url      = get_theme_mod( 'foodoholic_header_media_url', '' );
	$header_media_url_text = get_theme_mod( 'foodoholic_header_media_url_text' );

	$header_image = foodoholic_featured_overall_image();

	if ( '' == $header_image ) {
		$classes[] = 'no-header-media-image';
	}

	$header_text_enabled = foodoholic_has_header_media_text();

	if ( ! $header_text_enabled ) {
		$classes[] = 'no-header-media-text';
	}

	$enable_slider = foodoholic_check_section( get_theme_mod( 'foodoholic_slider_option', 'disabled' ) );

	if ( ! $enable_slider ) {
		$classes[] = 'no-featured-slider';
	}

	if ( '' == $header_image && ! $header_text_enabled && ! $enable_slider ) {
		$classes[] = 'content-has-padding-top';
	}

	if ( $enable_slider || $header_image ) {
		$classes[] = 'absolute-header';
	}

	$classes[] = 'social-header-disabled';

	// Add Color Scheme to Body Class.
	$classes[] = esc_attr( 'color-scheme-' . get_theme_mod( 'color_scheme', 'default' ) );

	return $classes;
}
add_filter( 'body_class', 'foodoholic_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function foodoholic_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'foodoholic_pingback_header' );

/**
 * Adds Slider BG CSS
 */
function foodoholic_slider_bg_css() {
	$enable_slider = get_theme_mod( 'foodoholic_slider_option', 'disabled' );
	$style         = 'style-with-bg';

	if ( ! foodoholic_check_section( $enable_slider ) || 'slider-without-bg' === $style ) {
		// Bail if featured content is disabled.
		return;
	}

	$css = '';

	$image = get_theme_mod( 'foodoholic_slider_bg_image', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/slider-bg-1920x1080.jpg' );

	if ( $image ) {
		$css = '
			.slider-content-wrapper {
				background: url(\'' . esc_url( $image ) . '\');
				background-attachment: scroll;
				background-repeat: no-repeat;
				background-size: cover;
				background-position: center center;
			}';
	}

	wp_add_inline_style( 'foodoholic-style', $css );
}
add_action( 'wp_enqueue_scripts', 'foodoholic_slider_bg_css', 11 );

/**
 * Adds food_menu background CSS
 */
function foodoholic_food_menu_bg_css() {
	$background = get_theme_mod( 'foodoholic_food_menu_bg_image' );

	$css = '';

	if ( $background ) {
		$image = ' background-image: url("' . esc_url( $background ) . '");';

		// Background Position.
		$position_x = get_theme_mod( 'foodoholic_food_menu_bg_position_x' );
		$position_y = get_theme_mod( 'foodoholic_food_menu_bg_position_y' );

		if ( ! in_array( $position_x, array( 'left', 'center', 'right' ), true ) ) {
			$position_x = 'left';
		}

		if ( ! in_array( $position_y, array( 'top', 'center', 'bottom' ), true ) ) {
			$position_y = 'top';
		}

		$position = ' background-position: ' . esc_attr( $position_x ) . ' ' . esc_attr( $position_y ) . ';';

		// Background Repeat.
		$repeat = get_theme_mod( 'foodoholic_food_menu_bg_repeat', 'repeat' );

		$repeat = ' background-repeat: ' . esc_attr( $repeat ) . ';';

		// Background Scroll.
		$attachment = get_theme_mod( 'foodoholic_food_menu_bg_attachment', 1 );

		if ( $attachment ) {
			$attachment = 'scroll';
		} else {
			$attachment = 'fixed';
		}

		$attachment = ' background-attachment: ' . esc_attr( $attachment ) . ';';

		// Background Size.
		$size = get_theme_mod( 'foodoholic_food_menu_bg_size', 'cover' );

		$size =  ' background-size: ' . esc_attr( $size ) . ';';

		$css = $image . $position . $repeat . $attachment . $size;
	}


	if ( '' !== $css ) {
		$css = '.menu-content-wrapper { ' . $css . '}';
	}

	wp_add_inline_style( 'foodoholic-style', $css );
}
add_action( 'wp_enqueue_scripts', 'foodoholic_food_menu_bg_css', 11 );

/**
 * Adds header image overlay for each section
 */
function foodoholic_header_image_overlay_css() {
	$css = '';

	$overlay = get_theme_mod( 'foodoholic_header_media_opacity', '20' );

	$overlay_bg = $overlay / 100;

	if ( '20' !== $overlay ) {
		$css = '.custom-header:after { background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . '); } '; // Dividing by 100 as the option is shown as % for user
	}

	wp_add_inline_style( 'foodoholic-style', $css );
}
add_action( 'wp_enqueue_scripts', 'foodoholic_header_image_overlay_css', 11 );

/**
 * Remove first post from blog as it is already show via recent post template
 */
function foodoholic_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = get_theme_mod( 'foodoholic_front_page_category' );

		if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] = $cats;
		}
	}
}
add_action( 'pre_get_posts', 'foodoholic_alter_home' );

/**
 * Function to add Scroll Up icon
 */
function foodoholic_scrollup() {
	$disable_scrollup = get_theme_mod( 'foodoholic_disable_scrollup' );

	if ( $disable_scrollup ) {
		return;
	}

	echo '
		<div class="scrollup">
			<a href="#masthead" id="scrollup" class="fa fa-sort-asc" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'foodoholic' ) . '</span></a>
		</div>' ;
}
add_action( 'wp_footer', 'foodoholic_scrollup', 1 );

if ( ! function_exists( 'foodoholic_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since Foodoholic 1.0
	 */
	function foodoholic_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'foodoholic_pagination_type', 'default' );

		/**
		 * Check if navigation type is Jetpack Infinite Scroll and if it is enabled, else goto default pagination
		 * if it's active then disable pagination
		 */
		if ( ( 'infinite-scroll' === $pagination_type ) && class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
			return false;
		}

		if ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous', 'foodoholic' ),
				'next_text'          => esc_html__( 'Next', 'foodoholic' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'foodoholic' ) . ' </span>',
			) );
		} else {
			the_posts_navigation();
		}
	}
endif; // foodoholic_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function foodoholic_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop
	$page_id = absint( $wp_query->get_queried_object_id() );

	// Front page displays in Reading Settings
	$page_for_posts = absint( get_option( 'page_for_posts' ) );

	return ( 'entire-site' == $value  || ( ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) && 'homepage' == $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Foodoholic 1.0
 */

function foodoholic_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field( 'post_content', $postID ) , $matches );

	if( isset( $matches[1][0] ) ) {
		//Get first image
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="pngfix wp-post-image" src="' . $first_img . '">';
	}

	return false;
}

function foodoholic_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'foodoholic_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() || is_search() ) {
			$layout = get_theme_mod( 'foodoholic_homepage_archive_layout', 'no-sidebar-full-width' );
		}
	}

	return $layout;
}

function foodoholic_get_sidebar_id() {
	$sidebar = '';

	$layout = foodoholic_get_theme_layout();

	$sidebaroptions = '';

	if ( 'no-sidebar-full-width' === $layout ) {
		return $sidebar;
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}

	return $sidebar;
}

/**
 * Featured content posts
 */
function foodoholic_get_featured_posts() {
	$type = 'featured-content';

	$number = get_theme_mod( 'foodoholic_featured_content_number', 3 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			$post_id = get_theme_mod( 'foodoholic_featured_content_cpt_' . $i );

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';

	$featured_posts = get_posts( $args );

	return $featured_posts;
}


/**
 * Services content posts
 */
function foodoholic_get_services_posts() {

	$number = get_theme_mod( 'foodoholic_service_number', 3 );

	$post_list    = array();

	$args = array(
		'posts_per_page'      => $number,
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

		$args['post_type'] = 'ect-service';

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			$post_id = get_theme_mod( 'foodoholic_service_cpt_' . $i );

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';

	$services_posts = get_posts( $args );

	return $services_posts;
}

if ( ! function_exists( 'foodoholic_sections' ) ) :
	/**
	 * Display Sections on header and footer with respect to the section option set in foodoholic_sections_sort
	 */
	function foodoholic_sections( $selector = 'header' ) {
		get_template_part( 'template-parts/slider/content', 'display' );

		get_template_part( 'template-parts/header/header', 'media' );

		get_template_part( 'template-parts/featured-content/display', 'featured' );

		get_template_part( 'template-parts/hero-content/content','hero' );

		get_template_part( 'template-parts/services/display', 'services' );

		get_template_part( 'template-parts/food-menu/display', 'menu' );

		get_template_part( 'template-parts/portfolio/display', 'portfolio' );

		get_template_part( 'template-parts/testimonials/display', 'testimonial' );
	}
endif;

/**
 * Enqueues front-end CSS for navigation color
 *
 * @since Foodoholic 1.0
 *
 * @see wp_add_inline_style()
 */
function foodoholic_absolute_header_color_css() {
	$default_color         = '#ffffff';
	$absolute_header_color = get_theme_mod( 'absolute_header_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $absolute_header_color === $default_color ) {
		return;
	}

	// Convert gradient text hex color to rgba.
	$absolute_header_color_rgb = foodoholic_hex2rgb( $absolute_header_color );

	// If the rgba values are empty return early.
	if ( empty( $absolute_header_color_rgb ) ) {
		return;
	}

	$absolute_twenty_header_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $absolute_header_color_rgb );

	$css = '
		/* Absolute Header Color */
		.absolute-header .header-top-bar .header-top-content li,
		.absolute-header .header-top-bar .header-top-content li a,
		.absolute-header .entry-breadcrumbs a,
		.absolute-header .entry-breadcrumbs a:after,
		.absolute-header .woocommerce .entry-breadcrumbs .woocommerce-breadcrumb a,
		.absolute-header .menu-toggle,
		.absolute-header .site-title a,
		.absolute-header .site-description {
			color: %1$s;
		}

		@media screen and (min-width: 50.75em) {
			.absolute-header .cart-contents,
			.absolute-header .site-header-main .social-navigation a {
				color: %1$s;
			}
		}

		@media screen and (min-width: 64em) {
		.navigation-classic.absolute-header .main-navigation a:hover,
		.navigation-classic.absolute-header .main-navigation a:focus,
		.navigation-classic.absolute-header .main-navigation .menu > .current-menu-item > a,
		.navigation-classic.absolute-header .main-navigation .menu > .current-menu-ancestor > a,
		.navigation-classic.absolute-header .main-navigation a {
				color: %1$s;
			}
		}

		@media screen and (min-width: 64em) {
			.navigation-classic .main-navigation ul ul {
				background-color: %1$s;
			}
		}

		/* 20% of Absolute Header Color */
		@media screen and (min-width: 64em) {
			.absolute-header .header-top-bar {
				border-color: %2$s;
			}
		}
	';

	wp_add_inline_style( 'foodoholic-block-style', sprintf( $css, $absolute_header_color, $absolute_twenty_header_color ) );
}
add_action( 'wp_enqueue_scripts', 'foodoholic_absolute_header_color_css', 11 );

/**
 * Converts a HEX value to RGB.
 *
 * @since Foodoholic 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function foodoholic_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}
