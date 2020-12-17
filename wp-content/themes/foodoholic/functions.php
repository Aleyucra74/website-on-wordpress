<?php
/**
 * Foodoholic Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Foodoholic
 */

if ( ! function_exists( 'foodoholic_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function foodoholic_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Foodoholic Pro, use a find and replace
		 * to change 'foodoholic' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'foodoholic', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 606, 606, true ); // Ratio 4:3

		// Used in Slider and Promotion
		add_image_size( 'foodoholic-slider', 1920, 1080, true ); // Ratio 16:9

		// Used in Slider option with background image
		add_image_size( 'foodoholic-slider-bg', 850, 850, true ); // Ratio 1:1

		// Used in Custom Header for single and archive pages
		add_image_size( 'foodoholic-header-inner', 1920, 540, true );

		// Used in Featured Content
		add_image_size( 'foodoholic-featured-content', 606, 455, true ); // Ratio 3:2

		// Used in Testimonial size 2 and Food Menu
		add_image_size( 'foodoholic-testimonial-thumb', 75, 75, true ); // Ratio 1:1

		//Used in Hero Content
		add_image_size( 'foodoholic-hero-content', 700, 700, true ); // 1:1 Image Ratio

		// Used in Team Section.
		add_image_size( 'foodoholic-team', 606, 808, true ); //  3:4 Image Ratio

		// Used in Portfolio and Service Section.
		add_image_size( 'foodoholic-portfolio', 666, 500, true ); //  4:3 Image Ratio

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'        => esc_html__( 'Primary', 'foodoholic' ),
			'social-footer' => esc_html__( 'Social On Footer', 'foodoholic' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

	    // Add support for Block Styles.
	    add_theme_support( 'wp-block-styles' );

	    // Add support for full and wide align images.
	    add_theme_support( 'align-wide' );

	    // Add support for editor styles.
	    add_theme_support( 'editor-styles' );

	    // Add support for responsive embeds.
	    add_theme_support( 'responsive-embeds' );

	    // Add custom editor font sizes.
	    add_theme_support(
	    	'editor-font-sizes',
	    	array(
	    		array(
	    			'name'      => esc_html__( 'Small', 'foodoholic' ),
	    			'shortName' => esc_html__( 'S', 'foodoholic' ),
	    			'size'      => 14,
	    			'slug'      => 'small',
	    		),
	    		array(
	    			'name'      => esc_html__( 'Normal', 'foodoholic' ),
	    			'shortName' => esc_html__( 'M', 'foodoholic' ),
	    			'size'      => 18,
	    			'slug'      => 'normal',
	    		),
	    		array(
	    			'name'      => esc_html__( 'Large', 'foodoholic' ),
	    			'shortName' => esc_html__( 'L', 'foodoholic' ),
	    			'size'      => 35,
	    			'slug'      => 'large',
	    		),
	    		array(
	    			'name'      => esc_html__( 'Huge', 'foodoholic' ),
	    			'shortName' => esc_html__( 'XL', 'foodoholic' ),
	    			'size'      => 42,
	    			'slug'      => 'huge',
	    		),
	    	)
	    );

	    // Add support for custom color scheme.
	    add_theme_support( 'editor-color-palette', array(
	    	array(
	    		'name'  => esc_html__( 'White', 'foodoholic' ),
	    		'slug'  => 'white',
	    		'color' => '#ffffff',
	    	),
	    	array(
	    		'name'  => esc_html__( 'Black', 'foodoholic' ),
	    		'slug'  => 'black',
	    		'color' => '#000000',
	    	),
	    	array(
	    		'name'  => esc_html__( 'Medium Black', 'foodoholic' ),
	    		'slug'  => 'medium-black',
	    		'color' => '#333333',
	    	),
	    	array(
	    		'name'  => esc_html__( 'Gray', 'foodoholic' ),
	    		'slug'  => 'gray',
	    		'color' => '#999999',
	    	),
	    	array(
	    		'name'  => esc_html__( 'Light Gray', 'foodoholic' ),
	    		'slug'  => 'light-gray',
	    		'color' => '#fafafa',
	    	),
	    	array(
	    		'name'  => esc_html__( 'Yellow', 'foodoholic' ),
	    		'slug'  => 'yellow',
	    		'color' => '#ffa415',
	    	),
	    ) );

		add_editor_style( array( 'assets/css/editor-style.css', foodoholic_fonts_url() ) );

		// Support Alternate image for services, testimonials when using Essential Content Types Pro.
		if ( class_exists( 'Essential_Content_Types_Pro' ) ) {
			add_theme_support( 'ect-alt-featured-image-jetpack-testimonial' );
		}

		/**
		 * Add Support for Sticky Menu.
		 */
		add_theme_support( 'catch-sticky-menu', apply_filters( 'catch_wedding_sticky_menu_args', array(
			'sticky_desktop_menu_selector' => '#masthead',
			'sticky_mobile_menu_selector'  => '#masthead',
			'sticky_background_color'      => '#ffffff',
			'sticky_text_color'            => '#000000',
		) ) );
	}
endif;
add_action( 'after_setup_theme', 'foodoholic_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function foodoholic_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'foodoholic_content_width', 1040 );
}
add_action( 'after_setup_theme', 'foodoholic_content_width', 0 );

if ( ! function_exists( 'foodoholic_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function foodoholic_template_redirect() {
		$layout = foodoholic_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1520;
		}
	}
endif;
add_action( 'template_redirect', 'foodoholic_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function foodoholic_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'foodoholic' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'foodoholic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'foodoholic' ),
		'id'            => 'sidebar-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'foodoholic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'foodoholic' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'foodoholic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'foodoholic' ),
		'id'            => 'sidebar-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'foodoholic' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	//Optional Sidebar Five Footer Instagram
	if ( class_exists( 'Catch_Instagram_Feed_Gallery_Widget' ) ||  class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Instagram', 'foodoholic' ),
			'id'            => 'sidebar-instagram',
			'description'   => esc_html__( 'Appears above footer. This sidebar is only for Widget from plugin Catch Instagram Feed Gallery Widget and Catch Instagram Feed Gallery Widget Pro', 'foodoholic' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'foodoholic_widgets_init' );

if ( ! function_exists( 'foodoholic_fonts_url' ) ) :
	/**
	 * Register Google fonts for Verity Pro.
	 *
	 * Create your own foodoholic_fonts_url() function to override in a child theme.
	 *
	 * @since Foodoholic 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function foodoholic_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Montserrat, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$lato = _x( 'on', 'lato: on or off', 'foodoholic' );

		/* Translators: If there are characters in your language that are not
		* supported by Pt Serif, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$pt_serif = _x( 'on', 'PT Serif font: on or off', 'foodoholic' );

		if ( 'off' !== $lato || 'off' !== $pt_serif ) {
			$font_families = array();

			if ( 'off' !== $lato ) {
				$font_families[] = 'Lato:400,400i,700,700i,900';
			}

			if ( 'off' !== $pt_serif ) {
				$font_families[] = 'PT Serif:400,400i,700,700i,900';
			}

			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Add preconnect for Google Fonts.
 */
function foodoholic_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'foodoholic-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'foodoholic_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function foodoholic_scripts() {
	wp_enqueue_style( 'foodoholic-fonts', foodoholic_fonts_url(), array(), null );

	wp_enqueue_style( 'font-awesome', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/font-awesome/css/font-awesome.css', array(), '4.7.0', 'all' );

	// Theme stylesheet.
	wp_enqueue_style( 'foodoholic-style', get_stylesheet_uri() );

	// Theme block stylesheet.
	wp_enqueue_style( 'foodoholic-block-style', get_theme_file_uri( '/assets/css/blocks.css' ), array( 'foodoholic-style' ), '1.0' );

	wp_register_script( 'jquery-match-height', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.matchHeight.min.js', array( 'jquery' ), '20171226', true );

	wp_enqueue_script( 'foodoholic-custom-script', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/custom-scripts.min.js', array( 'jquery', 'jquery-match-height' ), '20171226', true );

	wp_localize_script( 'foodoholic-custom-script', 'catchFoodmaniaScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'foodoholic' ),
		'collapse' => esc_html__( 'collapse child menu', 'foodoholic' ),
	) );

	wp_enqueue_script( 'foodoholic-navigation', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/navigation.min.js', array(), '20171226', true );

	wp_enqueue_script( 'foodoholic-skip-link-focus-fix', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/skip-link-focus-fix.min.js', array(), '20171226', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//Slider Scripts
	$enable_slider       = foodoholic_check_section( get_theme_mod( 'foodoholic_slider_option', 'disabled' ) );
	$enable_testimonial  = foodoholic_check_section( get_theme_mod( 'foodoholic_testimonial_option', 'disabled' ) );

	if ( $enable_slider || $enable_testimonial ) {
		wp_enqueue_script( 'jquery-cycle2', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/jquery.cycle/jquery.cycle2.min.js', array( 'jquery' ), '2.1.5', true );
	}

	// Enqueue fitvid if JetPack is not installed.
	if ( ! class_exists( 'Jetpack' ) ) {
		wp_enqueue_script( 'jquery-fitvids', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/js/fitvids.min.js', array( 'jquery' ), '1.1', true );
	}
}
add_action( 'wp_enqueue_scripts', 'foodoholic_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function foodoholic_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'foodoholic-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/css/editor-blocks.css' );
	// Add custom fonts.
	wp_enqueue_style( 'foodoholic-fonts', foodoholic_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'foodoholic_block_editor_styles' );

if ( ! function_exists( 'foodoholic_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since Foodoholic 1.0
	 */
	function foodoholic_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'foodoholic_excerpt_length', 10 );
		return absint( $length );
	}
endif; //foodoholic_excerpt_length
add_filter( 'excerpt_length', 'foodoholic_excerpt_length', 999 );

if ( ! function_exists( 'foodoholic_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer.
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function foodoholic_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text	= get_theme_mod( 'foodoholic_excerpt_more_text',  esc_html__( 'Continue reading', 'foodoholic' ) );

		$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link">%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'foodoholic_excerpt_more' );


if ( ! function_exists( 'foodoholic_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since Foodoholic 1.0
	 */
	function foodoholic_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'foodoholic_excerpt_more_text', esc_html__( 'Continue reading', 'foodoholic' ) );

			$link = sprintf( '<span class="more-button"><a href="%1$s" class="more-link">%2$s</a></span>',
			esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$link = ' &hellip; ' . $link;

			$output .= $link;
		}

		return $output;
	}
endif; //foodoholic_custom_excerpt
add_filter( 'get_the_excerpt', 'foodoholic_custom_excerpt' );


if ( ! function_exists( 'foodoholic_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since Foodoholic 1.0
	 */
	function foodoholic_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'foodoholic_excerpt_more_text', esc_html__( 'Continue reading', 'foodoholic' ) );

		return ' &hellip; ' . str_replace( $more_link_text, $more_tag_text, $more_link );
	}
endif; //foodoholic_more_link
add_filter( 'the_content_more_link', 'foodoholic_more_link', 10, 2 );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since Foodoholic 1.0
 */
function foodoholic_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // WPCS: XSS OK.
	}
}

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Include Header Background Color Options
 */
require get_parent_theme_file_path( 'inc/header-background-color.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Featured Slider
 */
require get_parent_theme_file_path( '/inc/featured-slider.php' );

/**
 * Metabox Options
 */
require get_parent_theme_file_path( '/inc/metabox/metabox.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Social Widget
 */
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function foodoholic_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// Catch Web Tools.
		array(
			'name' => 'Catch Web Tools', // Plugin Name, translation not required.
			'slug' => 'catch-web-tools',
		),
		// Catch IDs
		array(
			'name' => 'Catch IDs', // Plugin Name, translation not required.
			'slug' => 'catch-ids',
		),
		// To Top.
		array(
			'name' => 'To top', // Plugin Name, translation not required.
			'slug' => 'to-top',
		),
		// Catch Gallery.
		array(
			'name' => 'Catch Gallery', // Plugin Name, translation not required.
			'slug' => 'catch-gallery',
		),
	);

	if ( ! class_exists( 'Catch_Infinite_Scroll_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Infinite Scroll', // Plugin Name, translation not required.
			'slug' => 'catch-infinite-scroll',
		);
	}

	if ( ! class_exists( 'Essential_Content_Types_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Content Types', // Plugin Name, translation not required.
			'slug' => 'essential-content-types',
		);
	}

	if ( ! class_exists( 'Essential_Widgets_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Essential Widgets', // Plugin Name, translation not required.
			'slug' => 'essential-widgets',
		);
	}

	if ( ! class_exists( 'Catch_Instagram_Feed_Gallery_Widget_Pro' ) ) {
		$plugins[] = array(
			'name' => 'Catch Instagram Feed Gallery & Widget', // Plugin Name, translation not required.
			'slug' => 'catch-instagram-feed-gallery-widget',
		);
	}

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'foodoholic',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'foodoholic_register_required_plugins' );
