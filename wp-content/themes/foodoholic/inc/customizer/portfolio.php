<?php
/**
 * Add Portfolio Settings in Customizer
 *
 * @package Foodoholic
 */

/**
 * Add portfolio options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_portfolio_options( $wp_customize ) {
    // Add note to Jetpack Portfolio Section
    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_jetpack_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'label'             => sprintf( esc_html__( 'For Portfolio Options for Foodoholic Theme, go %1$shere%2$s', 'foodoholic' ),
                 '<a href="javascript:wp.customize.section( \'foodoholic_portfolio\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'jetpack_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	$wp_customize->add_section( 'foodoholic_portfolio', array(
            'panel'    => 'foodoholic_theme_options',
            'title'    => esc_html__( 'Portfolio', 'foodoholic' ),
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

    // Add note to ECT Featured Content Section
    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_portfolio_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'active_callback'   => 'foodoholic_is_ect_portfolio_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'foodoholic' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'foodoholic_portfolio',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_portfolio_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodoholic_sanitize_select',
            'active_callback'   => 'foodoholic_is_ect_portfolio_active',
			'choices'           => foodoholic_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodoholic' ),
			'section'           => 'foodoholic_portfolio',
			'type'              => 'select',
		)
	);

    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_portfolio_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'active_callback'   => 'foodoholic_is_portfolio_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'foodoholic' ),
                 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'foodoholic_portfolio',
            'type'              => 'description',
        )
    );

    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_portfolio_number',
            'default'           => '3',
            'sanitize_callback' => 'foodoholic_sanitize_number_range',
            'active_callback'   => 'foodoholic_is_portfolio_active',
            'label'             => esc_html__( 'Number of items to show', 'foodoholic' ),
            'section'           => 'foodoholic_portfolio',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'foodoholic_portfolio_number', 3 );

    for ( $i = 1; $i <= $number ; $i++ ) {
        //for CPT
        foodoholic_register_option( $wp_customize, array(
                'name'              => 'foodoholic_portfolio_cpt_' . $i,
                'sanitize_callback' => 'foodoholic_sanitize_post',
                'active_callback'   => 'foodoholic_is_portfolio_active',
                'label'             => esc_html__( 'Portfolio', 'foodoholic' ) . ' ' . $i ,
                'section'           => 'foodoholic_portfolio',
                'type'              => 'select',
                'choices'           => foodoholic_generate_post_array( 'jetpack-portfolio' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'foodoholic_portfolio_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'foodoholic_is_portfolio_active' ) ) :
    /**
    * Return true if portfolio is active
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_portfolio_active( $control ) {
        $enable = $control->manager->get_setting( 'foodoholic_portfolio_option' )->value();

        //return true only if previwed page on customizer matches the type of content option selected
        return ( foodoholic_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'foodoholic_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'foodoholic_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;
