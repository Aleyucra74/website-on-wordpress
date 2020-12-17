<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Foodoholic
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Foodie World Theme, go %1$shere%2$s', 'foodoholic' ),
                '<a href="javascript:wp.customize.section( \'foodoholic_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'foodoholic_testimonials', array(
            'panel'    => 'foodoholic_theme_options',
            'title'    => esc_html__( 'Testimonials', 'foodoholic' ),
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
            'name'              => 'foodoholic_testimonial_note_1',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'active_callback'   => 'foodoholic_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with Testimonial Content Type Enabled', 'foodoholic' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'foodoholic_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_testimonial_option',
            'default'           => 'disabled',
            'sanitize_callback' => 'foodoholic_sanitize_select',
            'active_callback'   => 'foodoholic_is_ect_testimonial_active',
            'choices'           => foodoholic_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'foodoholic' ),
            'section'           => 'foodoholic_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Foodoholic_Note_Control',
            'active_callback'   => 'foodoholic_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'foodoholic' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'foodoholic_testimonials',
            'type'              => 'description',
        )
    );

    foodoholic_register_option( $wp_customize, array(
            'name'              => 'foodoholic_testimonial_number',
            'default'           => 4,
            'sanitize_callback' => 'foodoholic_sanitize_number_range',
            'active_callback'   => 'foodoholic_is_testimonial_active',
            'label'             => esc_html__( 'No of items', 'foodoholic' ),
            'section'           => 'foodoholic_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 1,
                'max'               => 7,
            ),
        )
    );

    $number = get_theme_mod( 'foodoholic_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {
        //for CPT
        foodoholic_register_option( $wp_customize, array(
                'name'              => 'foodoholic_testimonial_cpt_' . $i,
                'sanitize_callback' => 'foodoholic_sanitize_post',
                'active_callback'   => 'foodoholic_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'foodoholic' ) . ' ' . $i ,
                'section'           => 'foodoholic_testimonials',
                'type'              => 'select',
                'choices'           => foodoholic_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'foodoholic_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'foodoholic_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'foodoholic_testimonial_option' )->value();

        //return true only if previewed page on customizer matches the type of content option selected
        return ( foodoholic_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'foodoholic_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_Testimonial' ) );
    }
endif;

if ( ! function_exists( 'foodoholic_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Foodoholic 1.0
    */
    function foodoholic_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_Testimonial' ) );
    }
endif;
