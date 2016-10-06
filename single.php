<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Newsmag
 */

get_header();
$image = get_custom_header();
$title = '';

while ( have_posts() ) : the_post();
	$img   = get_the_post_thumbnail_url();
	$title = get_the_title();
endwhile;

if ( empty( $img ) ) {
	$img = get_custom_header();
	$img = $img->url;
}
?>
<?php if ( ! empty( $img ) ): ?>
	<div class="newsmag-custom-header <?php echo is_single() ? 'newsmag-custom-header-single-post': '' ?>" style="background-image:url(<?php echo esc_url_raw($img) ?>)">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h2><?php echo esc_html($title) ?></h2>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
<?php
	$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', true );
	if ( $breadcrumbs_enabled ) { ?>
		<div class="container <?php echo is_single() ? 'newsmag-breadcrumbs-container' : ''; ?>">
			<div class="row <?php echo is_single() ? 'newsmag-breadcrumbs-row' : ''; ?>">
				<div class="col-xs-12">
					<?php newsmag_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	<?php } ?>
	<div class="container">
		<div class="row">
			<?php
			$layout = get_theme_mod( 'newsmag_blog_layout', 'right-sidebar' ); ?>

			<?php if ( $layout === 'left-sidebar' ): ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>

			<div id="primary" class="content-area <?php echo ( $layout === 'fullwidth' ) ? '' : 'col-lg-8 col-md-8'; ?> col-xs-12 newsmag-sidebar">
				<main id="main" class="site-main" role="main">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'single' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</main><!-- #main -->
			</div><!-- #primary -->
			<?php if ( $layout === 'right-sidebar' ): ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php
get_footer();
