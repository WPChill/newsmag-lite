<?php
/**
 * The template for displaying all pages.
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

get_header(); ?>
	<div class="container">
		<?php
		$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', 'breadcrumbs_enabled' );
		if ( $breadcrumbs_enabled == 'breadcrumbs_enabled' ) { ?>
			<div class="row">
				<div class="col-xs-12">
					<?php newsmag_breadcrumbs(); ?>
				</div>
			</div>
		<?php } ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
<?php
get_footer();
