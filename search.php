<?php
/**
 * The template for displaying search results pages.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Newsmag
 */

get_header(); ?>
<?php
$img = get_custom_header();
$img = $img->url;

if ( ! empty( $img ) ): ?>
	<div class="newsmag-custom-header" style="background-image:url(<?php echo esc_url_raw( $img ) ?>)">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'newsmag' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
	<div class="container">
		<?php
		$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', true );
		if ( $breadcrumbs_enabled ) { ?>
			<div class="row">
				<div class="col-xs-12">
					<?php newsmag_breadcrumbs(); ?>
				</div>
			</div>
		<?php } ?>
		<div class="row">
			<?php
			$layout = get_theme_mod( 'newsmag_blog_layout', 'right-sidebar' ); ?>

			<?php if ( $layout === 'left-sidebar' ): ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>

			<div id="primary"
			     class="newsmag-content newsmag-search-page <?php echo ( $layout === 'fullwidth' ) ? '' : 'col-lg-8 col-md-8'; ?> col-sm-12 col-xs-12">
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

						the_posts_pagination();
					else:
						echo '<div class="row">';
						get_template_part( 'template-parts/content', 'none' );
						echo '</div>';
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
get_footer();
