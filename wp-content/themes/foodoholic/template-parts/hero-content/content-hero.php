<?php
/**
 * The template used for displaying hero content
 *
 * @package Foodoholic
 */
?>

<?php
$enable_section = get_theme_mod( 'foodoholic_hero_content_visibility', 'disabled' );

if ( ! foodoholic_check_section( $enable_section ) ) {
	// Bail if hero content is not enabled
	return;
}

get_template_part( 'template-parts/hero-content/post-type', 'hero' );
