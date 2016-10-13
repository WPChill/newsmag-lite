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
	<?php $go_top_enabled = get_theme_mod( 'newsmag_enable_go_top', true ); ?>

	<?php if ( $go_top_enabled ): ?>
		<a href="#0" id="back-to-top" class="back-to-top">
			<span class="fa fa-angle-up"></span>
		</a>
	<?php endif; ?>

	<?php
	$copyright_area = get_theme_mod( 'newsmag_enable_copyright', true );
	?>
	<div class="site-info">
		<div class="container">
			<div class="row">
				<?php if ( $copyright_area ): ?>
					<div class="col-lg-9 col-sm-8">
						<?php
						echo wp_kses_post( get_theme_mod( 'newsmag_copyright_contents', '&copy; ' . date( "Y" ) . ' <a href="https://machothemes.com/newsmag-lite/">Newsmag</a>. All rights reserved.' ) );
						?>
					</div>
				<?php endif; ?>
				<div class="<?php echo $copyright_area ? 'col-lg-3 col-sm-4' : 'col-md-12' ?> text-right">
					<?php echo __( 'Created by <a href="https://machothemes.com">Macho Themes</a>', 'newsmag' ) ?>
				</div>
			</div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
