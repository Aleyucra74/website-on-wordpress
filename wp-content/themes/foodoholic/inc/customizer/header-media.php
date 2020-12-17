<?php
/**
 * Header Media Options
 *
 * @package Foodoholic
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function foodoholic_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'foodoholic' );

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_option',
			'default'           => 'homepage',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'foodoholic' ),
				'exclude-home'           => esc_html__( 'Excluding Homepage', 'foodoholic' ),
				'exclude-home-page-post' => esc_html__( 'Excluding Homepage, Page/Post Featured Image', 'foodoholic' ),
				'entire-site'            => esc_html__( 'Entire Site', 'foodoholic' ),
				'entire-site-page-post'  => esc_html__( 'Entire Site, Page/Post Featured Image', 'foodoholic' ),
				'pages-posts'            => esc_html__( 'Pages and Posts', 'foodoholic' ),
				'disable'                => esc_html__( 'Disabled', 'foodoholic' ),
			),
			'label'             => esc_html__( 'Enable on', 'foodoholic' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_content_align',
			'default'           => 'content-aligned-left',
			'sanitize_callback' => 'foodoholic_sanitize_select',
			'choices'           => array(
				'content-aligned-center' => esc_html__( 'Center', 'foodoholic' ),
				'content-aligned-right'  => esc_html__( 'Right', 'foodoholic' ),
				'content-aligned-left'   => esc_html__( 'Left', 'foodoholic' ),
			),
			'label'             => esc_html__( 'Content Alignment', 'foodoholic' ),
			'section'           => 'header_image',
			'type'              => 'select',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_opacity',
			'default'           => 20,
			'sanitize_callback' => 'foodoholic_sanitize_number_range',
			'label'             => esc_html__( 'Header Media Overlay', 'foodoholic' ),
			'section'           => 'header_image',
			'type'              => 'number',
			'input_attrs'       => array(
				'style' => 'width: 60px;',
				'min'   => 0,
				'max'   => 100,
			),
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Sub Title', 'foodoholic' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'foodoholic' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'foodoholic' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_url',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'foodoholic' ),
			'section'           => 'header_image',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'foodoholic' ),
			'section'           => 'header_image',
		)
	);

	foodoholic_register_option( $wp_customize, array(
			'name'              => 'foodoholic_header_url_target',
			'sanitize_callback' => 'foodoholic_sanitize_checkbox',
			'label'             => esc_html__( 'Check to Open Link in New Window/Tab', 'foodoholic' ),
			'section'           => 'header_image',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'foodoholic_header_media_options' );
