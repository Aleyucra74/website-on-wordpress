<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Foodoholic
 */

get_header(); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
			
			<?php do_action('slideshow_deploy', '110'); ?>
			
            <section>
            <article class="txtsobrenos">
                <h1 class="txth1">SOBRE NÓS</h1>
                <p class="txtparagrafo">Padaria Pão de Leite, localizada na zona norte, oferece produtos de alta qualidade e uma diversidade em panificação e confeitaria, e também servimos pizzas e esfihas com excelente padrão de qualidade para atender os clientes com satisfação e requinte.</p>
                <p class="txtparagrafo"> Temos um atendimento personalizado porém descontraído, servimos produtos de qualidade para sua festa, seu churrasco, e para seu evento em família, buscamos como objetivo servir sempre os melhores produtos.</p>
                <p class="txtparagrafo">Iniciando com grandes méritos e enfrentando grandes dificuldades no início, encontramos agora o caminho de uma prosperidade e uma parceria com todos os nossos clientes, assim é um trabalho multo de confiança e fidelidade, onde tudo isso é prezado pra que continue sempre essa parceria crescente e com muita confiança.</p>
            </article>
        </section>
			
			
			
			
				<div class="archive-content-wrap">
					<?php
					$post_title = esc_html__( 'Blog', 'foodoholic' );
					
					if ( '' !== $post_title ) :
					?>
						<div class="section-heading-wrapper">
							<?php if ( '' !== $post_title ) : ?>
								<div class="section-title-wrapper">
									<h2 class="section-title"><?php echo esc_html( $post_title ); ?></h2>
								</div>
							<?php endif; ?>
						</div><!-- .section-heading-wrap -->
					<?php
					endif;
					?>

					<?php
					if ( have_posts() ) :

						if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>

						<?php
						endif;
						?>
						<div class="section-content-wrapper">
							<?php
							/* Start the Loop */
							while ( have_posts() ) : the_post();
								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content/content', get_post_format() );

							endwhile;
							?>
						</div> <!-- .section-content-wrapper -->

						<?php
						foodoholic_content_nav();

					else :

						get_template_part( 'template-parts/content/content', 'none' );

					endif; ?>
				</div> <!-- .archive-content-wrap -->
			</main><!-- #main -->
		</div><!-- #primary -->
	<?php get_sidebar(); ?>
<?php
get_footer();
