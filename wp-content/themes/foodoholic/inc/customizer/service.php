<?php
/**
 * Services options
 *
 * @package Foodoholic
 */

/**
 * Add services content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_service_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options for Foodie World Theme, go %1$shere%2$s', 'foodoholic' ),
                '<a href="javascript:wp.customize.section( \'foodoholic_service\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'foodoholic_service', array(
			'title' => esc_html__( 'Services', 'foodoholic' ),
			'panel' => 'foodoholic_theme_options',
		)
	);

    $action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_service_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'active_callback'   => 'foodoholic_is_ect_services_inactive',
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Services Content Type Enabled', 'foodoholic' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'
            ),
            'section'           => 'foodoholic_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );


	// Add color scheme setting and control.
	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_service_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'active_callback'   => 'foodoholic_is_ect_services_active',
			'choices'           => foodoholic_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodoholic' ),
			'section'           => 'foodoholic_service',
			'type'              => 'select',
		)
	);

    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_service_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'active_callback'   => 'foodoholic_is_services_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'foodoholic' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'foodoholic_service',
            'type'              => 'description',
        )
    );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_service_number',
			'default'           => 3,
			'sanitize_callback' => 'foodoholic_sanitize_number_range',
			'active_callback'   => 'foodoholic_is_services_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Services is changed (Max no of Services is 20)', 'foodoholic' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of items', 'foodoholic' ),
			'section'           => 'foodoholic_service',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'foodoholic_service_number', 3 );

	//loop for services post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		foodoholic_register_option( $wp_customize, array(
				'name'              => 'foodoholic_service_cpt_' . $i,
				'sanitize_callback' => 'foodoholic_sanitize_post',
				'active_callback'   => 'foodoholic_is_services_active',
				'label'             => esc_html__( 'Services', 'foodoholic' ) . ' ' . $i ,
				'section'           => 'foodoholic_service',
				'type'              => 'select',
                'choices'           => foodoholic_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'foodoholic_service_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'foodoholic_is_services_active' ) ) :
	/**
	* Return true if services content is active
	*
	* @since Foodoholic 1.0
	*/
	function foodoholic_is_services_active( $control ) {
		$enable = $control->manager->get_setting( 'foodoholic_service_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( foodoholic_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'foodoholic_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'foodoholic_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
