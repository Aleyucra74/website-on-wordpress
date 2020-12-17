<?php
/**
 * Featured Slider Options
 *
 * @package Foodoholic
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'foodoholic_featured_slider', array(
			'panel' => 'foodoholic_theme_options',
			'title' => esc_html__( 'Featured Slider', 'foodoholic' ),
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'choices'           => foodoholic_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodoholic' ),
			'section'           => 'foodoholic_featured_slider',
			'type'              => 'select',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              =>'foodoholic_slider_bg_image',
			'sanitize_callback' => 'foodoholic_sanitize_image',
			'default'           => trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'assets/images/slider-bg-1920x1080.jpg',
			'custom_control'    => 'WP_Customize_Image_Control',
			'active_callback'   => 'foodoholic_is_slider_active',
			'label'             => esc_html__( 'BG Image', 'foodoholic' ),
			'section'           => 'foodoholic_featured_slider',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_slider_number',
			'default'           => '4',
			'sanitize_callback' => 'foodoholic_sanitize_number_range',

			'active_callback'   => 'foodoholic_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'foodoholic' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of items', 'foodoholic' ),
			'section'           => 'foodoholic_featured_slider',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_slider_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'active_callback'   => 'foodoholic_is_slider_active',
			'choices'           => foodoholic_content_show(),
			'label'             => esc_html__( 'Display Content', 'foodoholic' ),
			'section'           => 'foodoholic_featured_slider',
			'type'              => 'select',
		)
	);

	$slider_number = get_theme_mod( 'foodoholic_slider_number', 4 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {
		// Page Sliders
		foodoholic_register_option( $wp_customize, array(
				'name'              =>'foodoholic_slider_page_' . $i,
				'sanitize_callback' => 'foodoholic_sanitize_post',
				'active_callback'   => 'foodoholic_is_slider_active',
				'label'             => esc_html__( 'Page', 'foodoholic' ) . ' # ' . $i,
				'section'           => 'foodoholic_featured_slider',
				'type'              => 'dropdown-pages',
				'allow_addition'    => true,
			)
		);	
	} // End for().
}
add_action( 'customize_register', 'foodoholic_slider_options' );

/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Foodoholic 1.0
 */
function foodoholic_content_show() {
	$options = array(
		'excerpt'      => esc_html__( 'Show Excerpt', 'foodoholic' ),
		'full-content' => esc_html__( 'Full Content', 'foodoholic' ),
		'hide-content' => esc_html__( 'Hide Content', 'foodoholic' ),
	);
	return apply_filters( 'foodoholic_content_show', $options );
}

/**
 * Returns an array of featured content show registered for Lucida.
 *
 * @since Foodoholic 1.0
 */
function foodoholic_meta_show() {
	$options = array(
		'show-meta' => esc_html__( 'Show Meta', 'foodoholic' ),
		'hide-meta' => esc_html__( 'Hide Meta', 'foodoholic' ),
	);
	return apply_filters( 'foodoholic_content_show', $options );
}

/** Active Callback Functions */

if( ! function_exists( 'foodoholic_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Foodoholic 1.0
	*/
	function foodoholic_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'foodoholic_slider_option' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected
		return ( foodoholic_check_section( $enable ) );
	}
endif;
