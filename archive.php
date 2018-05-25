<?php
/**
 * The template for displaying archive pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

get_header(); ?>

<?php

$img        = get_custom_header();
$img        = $img->url;
$additional = '';
if ( ! empty( $img ) ) :
?>
	<?php $additional = 'style="background-image:url(' . esc_url( $img ) . '"'; ?>
<?php endif; ?>

	<div class="newsmag-custom-header" <?php echo $additional; ?>>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h1 class="page-title">
						<?php
						if ( is_day() ) :
							printf( __( 'Day: %s', 'newsmag' ), get_the_date() );
						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'newsmag' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'newsmag' ) ) );
						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'newsmag' ), get_the_date( _x( 'Y', 'yearly archives date format', 'newsmag' ) ) );
						elseif ( is_category() ) :
							the_archive_title();
						else :
							single_tag_title( __( 'Tags archive: ', 'newsmag' ) );
						endif;
						?>
					</h1>
				</div>
			</div>
		</div>
	</div>

<?php
$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', true );
if ( $breadcrumbs_enabled ) {
	?>
	<div class="container newsmag-breadcrumbs-container">
		<div class="row newsmag-breadcrumbs-row">
			<div class="col-xs-12">
				<?php Newsmag_Helper::add_breadcrumbs(); ?>
			</div>
		</div>
	</div>
<?php } ?>
	<div class="container">
		<div class="row">
			<?php
			$layout = get_theme_mod( 'newsmag_blog_layout', 'right-sidebar' );
			?>

			<?php if ( 'left-sidebar' === $layout ) : ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>

			<div id="primary"
				class="newsmag-content newsmag-archive-page <?php echo ( 'fullwidth' === $layout ) ? '' : 'col-lg-8 col-md-8'; ?> col-sm-12 col-xs-12">
				<main id="main" class="site-main" role="main">
					<?php

					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */

							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

					else :
						echo '<div class="row">';
						get_template_part( 'template-parts/content', 'none' );
						echo '</div>';
					endif;
					?>
				</main><!-- #main -->
				<?php
				the_posts_pagination(
					array(
						'prev_text' => 'prev',
						'next_text' => 'next',
					)
				);
?>
			</div><!-- #primary -->
			<?php if ( 'right-sidebar' === $layout ) : ?>
				<?php get_sidebar( 'sidebar' ); ?>
			<?php endif; ?>
		</div>
	</div>
<?php
get_footer();
