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
	<?php $go_top_enabled = get_theme_mod('newsmag_enable_go_top', true); ?>

	<?php if ( $go_top_enabled ): ?>
		<a href="#0" id="back-to-top" class="back-to-top">
			<span class="fa fa-angle-up"></span>
		</a>
	<?php endif; ?>

	<?php
	$copyright_area        = get_theme_mod( 'newsmag_enable_copyright', true );
	$copyright_attribution = get_theme_mod( 'newsmag_enable_attribution', true );
	?>
	<?php if ( $copyright_area || $copyright_attribution ): ?>
		<div class="site-info">
			<div class="container">
				<div class="row">
					<?php if ( $copyright_area ): ?>
						<div class="col-md-6">
							<?php
							echo wp_kses_post( get_theme_mod( 'newsmag_copyright_contents', '&copy; ' . date( "Y" ) . ' <a href="https://machothemes.com/newsmag-lite/">Newsmag</a>. All rights reserved.' ) );
							?>
						</div>
					<?php endif; ?>
					<?php if ( $copyright_attribution ): ?>
						<div class="col-md-6 text-right">
							<?php echo __( 'Created by <a href="https://machothemes.com">Macho Themes</a>', 'newsmag' ) ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
