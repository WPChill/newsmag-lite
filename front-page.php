<?php
/**
 * The template for displaying Front page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

get_header();
$show_on_front = get_option('show_on_front');
if ( $show_on_front == 'posts' ):

	$img = get_custom_header();
	$img = $img->url;

	if ( ! empty( $img ) ): ?>
		<div class="newsmag-custom-header" style="background-image:url(<?php echo esc_url_raw( $img ) ?>)">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="page-title"><?php echo esc_html( get_option( 'blogname' ) ) ?></h2>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
	<div class="container">
		<div class="row">
			<?php

			$layout = get_theme_mod( 'newsmag_blog_layout', 'right-sidebar' ); ?>
			<?php if ( $layout === 'left-sidebar' ): ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>

			<div id="primary"
			     class="newsmag-content newsmag-archive-page <?php echo ( $layout === 'fullwidth' ) ? '' : 'col-lg-8 col-md-8'; ?> col-sm-12 col-xs-12">
				<main id="main" class="site-main" role="main">
					<?php
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

					endif;
					?>
				</main><!-- #main -->
				<?php the_posts_pagination(array('prev_text' => 'prev', 'next_text' => 'next')); ?>
			</div><!-- #primary -->
			<?php if ( $layout === 'right-sidebar' ): ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>
		</div>
	</div>

	<?php
else:
	if ( is_active_sidebar( 'homepage-slider' ) ) { ?>
		<div id="newsmag-homepage-slider">
			<?php
			dynamic_sidebar( 'homepage-slider' );
			?>
		</div>
		<?php } ?>

	<div class="container newsmag-margin-top">
		<div class="row">
			<?php if ( is_active_sidebar( 'content-area' ) ) { ?>
				<?php dynamic_sidebar( 'content-area' ); ?>
			<?php } ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer();