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
		<div class="row">
			<?php if ( is_active_sidebar( 'content-area' ) ) { ?>
				<?php dynamic_sidebar( 'content-area' ); ?>
			<?php } ?>
		</div>
	</div>

<?php get_footer(); ?>