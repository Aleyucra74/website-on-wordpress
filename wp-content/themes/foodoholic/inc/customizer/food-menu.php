<?php
/**
 * Add Food Menu Settings in Customizer
 *
 * @package Foodoholic
*/

/**
 * Add food_menu options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_food_menu_options( $wp_customize ) {
	// Add note to ECT Featured Content Section
	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Foodoholic_Note_Control',
			'active_callback'   => 'foodoholic_is_ect_food_menu_inactive',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
				'label'             => sprintf( esc_html__( 'For Food Menu, install %1$sEssential Content Types Pro%2$s Plugin with Food Menu Enabled', 'foodoholic' ),
				'<a target="_blank" href="https://catchplugins.com/plugins/essential-content-types-pro/">',
				'</a>'
			),
			'section'           => 'foodoholic_food_menu',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'foodoholic_food_menu', array(
			'panel'    => 'foodoholic_theme_options',
			'title'    => esc_html__( 'Food Menus', 'foodoholic' ),
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'active_callback'   => 'foodoholic_is_ect_food_menu_active',
			'choices'           => foodoholic_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodoholic' ),
			'section'           => 'foodoholic_food_menu',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	/* Testimonial Background */
	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_bg_image',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'custom_control'    => 'WP_Customize_Image_Control',
			'label'             => esc_html__( 'Background Image', 'foodoholic' ),
			'section'           => 'foodoholic_food_menu',
		)
	);

	$wp_customize->add_setting( 'foodoholic_food_menu_bg_position_x', array(
		'sanitize_callback' => 'foodoholic_sanitize_food_menu_bg_position',
	) );

	$wp_customize->add_setting( 'foodoholic_food_menu_bg_position_y', array(
		'sanitize_callback' => 'foodoholic_sanitize_food_menu_bg_position',
	) );

	$wp_customize->add_control( new WP_Customize_Background_Position_Control( $wp_customize, 'foodoholic_food_menu_bg_position', array(
		'label'           => esc_html__( 'Background Image Position', 'foodoholic' ),
		'active_callback' => 'foodoholic_is_food_menu_bg_active',
		'section'         => 'foodoholic_food_menu',
		'settings'        => array(
			'x' => 'foodoholic_food_menu_bg_position_x',
			'y' => 'foodoholic_food_menu_bg_position_y',
		),
	) ) );

	foodoholic_register_option( $wp_customize, array(
		'name'              => 'foodoholic_food_menu_bg_size',
		'default'           => 'cover',
		'description'       => esc_html__( 'In mobiles, Background Size is always cover', 'foodoholic' ),
		'sanitize_callback' => 'foodoholic_sanitize_select',
		'active_callback'   => 'foodoholic_is_food_menu_bg_active',
		'label'             => esc_html__( 'Desktop Background Image Size', 'foodoholic' ),
		'section'           => 'foodoholic_food_menu',
		'type'              => 'select',
		'choices' => array(
			'auto'    => esc_html__( 'Original', 'foodoholic' ),
			'contain' => esc_html__( 'Fit to Screen', 'foodoholic' ),
			'cover'   => esc_html__( 'Fill Screen', 'foodoholic' ),
		),
	) );

	foodoholic_register_option( $wp_customize, array(
		'name'              => 'foodoholic_food_menu_bg_repeat',
		'default'           => 'repeat',
		'sanitize_callback' => 'foodoholic_sanitize_select',
		'active_callback'   => 'foodoholic_is_food_menu_bg_active',
		'label'             => esc_html__( 'Repeat Background Image', 'foodoholic' ),
		'type'              => 'select',
		'section'           => 'foodoholic_food_menu',
		'choices'           => array(
			'no-repeat' =>  esc_html__( 'No Repeat', 'foodoholic' ),
			'repeat'    =>  esc_html__( 'Repeat both vertically and horizontally (The last image will be clipped if it does not fit)', 'foodoholic' ),
			'repeat-x'  =>  esc_html__( 'Repeat only horizontally', 'foodoholic' ),
			'repeat-y'  =>  esc_html__( 'Repeat only vertically', 'foodoholic' ),
		),
	) );

	foodoholic_register_option( $wp_customize, array(
		'name'              => 'foodoholic_food_menu_bg_attachment',
		'default'           => 1,
		'sanitize_callback' => 'foodoholic_sanitize_checkbox',
		'active_callback'   => 'foodoholic_is_food_menu_bg_active',
		'label'             => esc_html__( 'Scroll with Page', 'foodoholic' ),
		'section'           => 'foodoholic_food_menu',
		'type'              => 'checkbox',
	) );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_headline',
			'default'           => esc_html__( 'Our Menu', 'foodoholic' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Headline', 'foodoholic' ),
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'section'           => 'foodoholic_food_menu',
			'type'              => 'text',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_subheadline',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Sub headline', 'foodoholic' ),
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'section'           => 'foodoholic_food_menu',
			'type'              => 'text',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_number',
			'default'           => 5,
			'sanitize_callback' => 'foodoholic_sanitize_number_range',
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'label'             => esc_html__( 'No of items', 'foodoholic' ),
			'section'           => 'foodoholic_food_menu',
			'type'              => 'number',
			'input_attrs'       => array(
				'style'             => 'width: 100px;',
				'min'               => 0,
			),
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_show',
			'default'           => 'excerpt',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'choices'           => foodoholic_content_show(),
			'label'             => esc_html__( 'Display Content', 'foodoholic' ),
			'section'           => 'foodoholic_food_menu',
			'type'              => 'select',
		)
	);

	$number = get_theme_mod( 'foodoholic_food_menu_number', 5 );

	for ( $i = 1; $i <= $number ; $i++ ) {
		// For CPT - sections
		foodoholic_register_option( $wp_customize, array(
				'name'              => 'foodoholic_food_menu_cpt_' . $i,
				'sanitize_callback' => 'foodoholic_sanitize_select',
				'active_callback'   => 'foodoholic_is_food_menu_active',
				'label'             => esc_html__( 'Menu', 'foodoholic' ) . ' ' . $i ,
				'section'           => 'foodoholic_food_menu',
				'type'              => 'select',
				'choices'           => foodoholic_generate_taxonomy_array( 'ect_food_menu' ),
			)
		);
	} // End for().

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_more_text',
			'default'           => esc_html__( 'View Full Menu', 'foodoholic' ),
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'label'             => esc_html__( 'Button Text', 'foodoholic' ),
			'section'           => 'foodoholic_food_menu',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_more_link',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'label'             => esc_html__( 'Button Link', 'foodoholic' ),
			'section'           => 'foodoholic_food_menu',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_food_menu_more_target',
			'sanitize_callback' => 'foodoholic_sanitize_checkbox',
			'active_callback'   => 'foodoholic_is_food_menu_active',
			'label'             => esc_html__( 'Check to Open Button Link in New Window/Tab', 'foodoholic' ),
			'section'           => 'foodoholic_food_menu',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'foodoholic_food_menu_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'foodoholic_is_food_menu_active' ) ) :
	/**
	* Return true if food_menu is active
	*
	* @since Foodoholic 1.0
	*/
	function foodoholic_is_food_menu_active( $control ) {
		$enable = $control->manager->get_setting( 'foodoholic_food_menu_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( foodoholic_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'foodoholic_is_ect_food_menu_inactive' ) ) :
    /**
    * Return true if food_menu is active
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_food_menu_inactive( $control ) {
        return ! class_exists( 'Essential_Content_Pro_Featured_Content' );
    }
endif;

if ( ! function_exists( 'foodoholic_is_ect_food_menu_active' ) ) :
    /**
    * Return true if food_menu is active
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_food_menu_active( $control ) {
        return class_exists( 'Essential_Content_Pro_Featured_Content' );
    }
endif;

if ( ! function_exists( 'foodoholic_is_food_menu_bg_active' ) ) :
	/**
	* Return true if background is set
	*
	* @since Foodoholic 1.0
	*/
	function foodoholic_is_food_menu_bg_active( $control ) {
		$bg_image = $control->manager->get_setting( 'foodoholic_food_menu_bg_image' )->value();

		return ( foodoholic_is_food_menu_active( $control ) && '' !== $bg_image );
	}
endif;
