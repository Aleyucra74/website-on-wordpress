<?php
/**
 * Theme Options
 *
 * @package Foodoholic
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'foodoholic_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'foodoholic' ),
		'priority' => 130,
	) );

	// Layout Options
	$wp_customize->add_section( 'foodoholic_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'foodoholic' ),
		'panel' => 'foodoholic_theme_options',
		)
	);

	/* Default Layout */
	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'foodoholic' ),
			'section'           => 'foodoholic_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'foodoholic' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'foodoholic' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'foodoholic' ),
			'section'           => 'foodoholic_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'foodoholic' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'foodoholic' ),
			),
		)
	);

	// Single Page/Post Image
	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'foodoholic' ),
			'section'           => 'foodoholic_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'              => esc_html__( 'Disabled', 'foodoholic' ),
				'post-thumbnail'        => esc_html__( 'Post Thumbnail (1060x596)', 'foodoholic' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'foodoholic_excerpt_options', array(
		'panel' => 'foodoholic_theme_options',
		'title' => esc_html__( 'Excerpt Options', 'foodoholic' ),
	) );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_excerpt_length',
			'default'           => '10',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 55 words', 'foodoholic' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'foodoholic' ),
			'section'  => 'foodoholic_excerpt_options',
			'type'     => 'number',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading', 'foodoholic' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'foodoholic' ),
			'section'           => 'foodoholic_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'foodoholic_search_options', array(
		'panel'     => 'foodoholic_theme_options',
		'title'     => esc_html__( 'Search Options', 'foodoholic' ),
	) );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_search_text',
			'default'           => esc_html__( 'Search ...', 'foodoholic' ),
			'sanitize_callback' => 'wp_kses_data',
			'label'             => esc_html__( 'Search Text', 'foodoholic' ),
			'section'           => 'foodoholic_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'foodoholic_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'foodoholic' ),
		'panel'       => 'foodoholic_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'foodoholic' ),
	) );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_front_page_category',
			'sanitize_callback' => 'foodoholic_sanitize_category_list',
			'custom_control'    => 'Foodoholic_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'foodoholic' ),
			'section'           => 'foodoholic_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$wp_customize->add_section( 'foodoholic_pagination_options', array(
		'panel'       => 'foodoholic_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'foodoholic' ),
	) );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'choices'           => foodoholic_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'foodoholic' ),
			'section'           => 'foodoholic_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'foodoholic_scrollup', array(
		'panel'    => 'foodoholic_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'foodoholic' ),
	) );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_disable_scrollup',
			'sanitize_callback' => 'foodoholic_sanitize_checkbox',
			'label'             => esc_html__( 'Disable Scroll Up', 'foodoholic' ),
			'section'           => 'foodoholic_scrollup',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'foodoholic_theme_options' );
