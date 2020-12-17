<?php
/**
 * Hero Content Options
 *
 * @package Foodoholic
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'foodoholic_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'foodoholic' ),
			'panel' => 'foodoholic_theme_options',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'choices'           => foodoholic_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'foodoholic' ),
			'section'           => 'foodoholic_hero_content_options',
			'type'              => 'select',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'foodoholic_sanitize_post',
			'active_callback'   => 'foodoholic_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'foodoholic' ),
			'section'           => 'foodoholic_hero_content_options',
			'type'              => 'dropdown-pages',
			'allow_addition'    => true,
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_hero_content_show',
			'default'           => 'full-content',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'active_callback'   => 'foodoholic_is_hero_content_active',
			'choices'           => foodoholic_content_show(),
			'label'             => esc_html__( 'Display Content', 'foodoholic' ),
			'section'           => 'foodoholic_hero_content_options',
			'type'              => 'select',
		)
	);
}
add_action( 'customize_register', 'foodoholic_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'foodoholic_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Foodoholic 1.0
	*/
	function foodoholic_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'foodoholic_hero_content_visibility' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( foodoholic_check_section( $enable ) );
	}
endif;
