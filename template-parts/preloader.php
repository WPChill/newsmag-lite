<!-- Page Loader -->
<?php
$preloader_effect_type = get_theme_mod( 'newsmag_preloader_effect_type', 'fade' );
?>
<div class="page-loader" data-effect="<?php echo esc_attr( $preloader_effect_type ); ?>">
	<div class="loader"></div>
	<?php
	$preloader_text = get_theme_mod( 'newsmag_preloader_effect_text', esc_html__( 'Loading...', 'newsmag' ) );
	?>
	<span class="loader-text"><?php echo wp_kses_post( $preloader_text ); ?></span>
</div>
<!-- End Page Loader --> 
