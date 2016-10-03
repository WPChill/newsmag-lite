<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newsmag
 */

?>
</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">

	<?php get_sidebar( 'footer' ) ?>

	<?php if ( get_theme_mod( 'newsmag_enable_go_top', true ) ): ?>
		<a href="#0" id="back-to-top" class="back-to-top">
			<span class="fa fa-angle-up"></span>
		</a>
	<?php endif; ?>

	<?php if ( get_theme_mod( 'newsmag_enable_copyright', true ) ): ?>
		<div class="site-info">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php
						echo get_theme_mod( 'newsmag_copyright_contents', '&copy; ' . date( "Y" ) . ' <a href="https://machothemes.com/">Newsmag. All rights reserved.</a>' );
						?>
					</div>
					<div class="col-md-6 text-right">
						<?php echo __('Created by Macho Themes', 'newsmag') ?>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
