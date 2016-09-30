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

get_header(); ?>

<?php if ( is_active_sidebar( 'homepage-slider' ) ) {
	dynamic_sidebar( 'homepage-slider' );
} elseif ( current_user_can( 'edit_theme_options' ) ) {
	get_template_part( 'inc/demo-content/slider' );
} ?>

	<div class="container newsmag-margin-top">
		<?php if ( is_active_sidebar( 'top-area-a' ) || is_active_sidebar( 'top-area-b' ) || is_active_sidebar( 'top-area-c' ) ) { ?>
			<!-- Top Section -->
			<div class="row">
				<?php if ( is_active_sidebar( 'top-area-a' ) ) { ?>
					<div class="col-md-4">
						<?php
						dynamic_sidebar( 'top-area-a' );
						?>
					</div>
				<?php } ?>
				<?php if ( is_active_sidebar( 'top-area-b' ) ) { ?>
					<div class="col-md-4">
						<?php
						dynamic_sidebar( 'top-area-b' );
						?>
					</div>
				<?php } ?>
				<?php if ( is_active_sidebar( 'top-area-c' ) ) { ?>
					<div class="col-md-4">
						<?php
						dynamic_sidebar( 'top-area-c' );
						?>
					</div>
				<?php } ?>
			</div>
			<!-- / Top Section -->
		<?php } elseif ( current_user_can( 'edit_theme_options' ) ) {
			get_template_part( 'inc/demo-content/top-area' );
		} ?>

		<?php if ( is_active_sidebar( 'content-area-a' ) || is_active_sidebar( 'content-area-b' ) ) { ?>
			<!-- Top Content Area -->
			<div class="row">
				<?php if ( is_active_sidebar( 'content-area-a' ) ) { ?>
					<div class="col-md-8">
						<?php
						dynamic_sidebar( 'content-area-a' );
						?>
					</div>
				<?php } ?>

				<?php if ( is_active_sidebar( 'content-area-b' ) ) { ?>
					<div class="col-md-4">
						<?php
						dynamic_sidebar( 'content-area-b' );
						?>
					</div>
				<?php } ?>
			</div>
			<!-- / Top Content Area -->
		<?php } elseif ( current_user_can( 'edit_theme_options' ) ) {
			get_template_part( 'inc/demo-content/content-area' );
		} ?>


		<?php if ( is_active_sidebar( 'content-area-main' ) ) { ?>
			<!-- Content area -->
			<?php dynamic_sidebar( 'content-area-main' ); ?>
			<!-- / Content area -->
		<?php } ?>

		<?php if ( is_active_sidebar( 'content-area-banner' ) ) { ?>
			<!-- Content area banner -->
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3">
					<?php dynamic_sidebar( 'content-area-banner' ); ?>
				</div>
			</div>
			<!-- / Content area banner -->
		<?php } ?>

		<?php if ( is_active_sidebar( 'before-footer-area' ) ) { ?>
			<!-- Before footer area -->
			<div class="row">
				<div class="col-md-12">
					<?php dynamic_sidebar( 'before-footer-area' ); ?>
				</div>
			</div>
			<!-- / Before footer area -->
		<?php } ?>

	</div>

<?php get_footer(); ?>