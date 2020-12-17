<?php
/**
 * Primary Menu Template
 *
 * @package Foodoholic
 */

?>
<div id="site-header-menu" class="site-header-menu">
	<div id="primary-menu-wrapper" class="menu-wrapper">
		<div class="menu-toggle-wrapper">
			<button id="menu-toggle" class="menu-toggle" aria-controls="top-menu" aria-expanded="false">
				<span class="menu-label"><?php echo esc_html_e( 'Menu', 'foodoholic' ); ?></span>
			</button>
		</div><!-- .menu-toggle-wrapper -->

		<div class="menu-inside-wrapper">
			<?php
				if( function_exists( 'foodoholic_header_cart' ) ) {
					foodoholic_header_cart();
				}
				?>

				<?php get_template_part( 'template-parts/header/header', 'navigation' ); ?>

				<div class="mobile-header-top">
					<?php get_template_part( 'template-parts/header/header', 'top' ); ?>
				</div>

			<div class="mobile-social-search">
				<div class="search-container">
					<?php get_search_form(); ?>
				</div>
			</div><!-- .mobile-social-search -->
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #primary-menu-wrapper.menu-wrapper -->
	<div id="primary-search-wrapper" class="menu-wrapper">
		<div class="menu-toggle-wrapper">
			<button id="social-search-toggle" class="menu-toggle">
				<span class="menu-label screen-reader-text"><?php echo esc_html_e( 'Search', 'foodoholic' ); ?>
			</button>
		</div><!-- .menu-toggle-wrapper -->

		<div class="menu-inside-wrapper">
			<div class="search-container">
				<?php get_Search_form(); ?>
			</div>
		</div><!-- .menu-inside-wrapper -->
	</div><!-- #social-search-wrapper.menu-wrapper -->
	<?php
		if( function_exists( 'foodoholic_header_cart' ) ) {
			foodoholic_header_cart();
		}
	?>
</div><!-- .site-header-menu -->
