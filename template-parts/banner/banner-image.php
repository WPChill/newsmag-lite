<?php
/**
 * In case we don't have an image, we terminate here
 */
$banner_image = get_theme_mod( 'newsmag_banner_image', esc_url( get_template_directory_uri() . '/assets/images/banner.jpg' ) );
if ( empty( $banner_image ) ) {
	return false;
}
$default = esc_url( get_template_directory_uri() . '/assets/images/banner.jpg' );
$link    = get_theme_mod( 'newsmag_banner_link', 'https://machothemes.com/' );

/**
 * In case the user did not select an image ( default ), we fallback to the placeholder banner
 */
if ( $banner_image !== $default ) {
	$attachment_id = newsmag_get_attachment_id( get_theme_mod( 'newsmag_banner_image' ) ); ?>
	<a href="<?php echo esc_url_raw( $link ) ?>">
		<?php echo wp_get_attachment_image( $attachment_id, 'newsmag-wide-banner' ); ?>
	</a>
<?php } else { ?>
	<a href="<?php echo esc_url_raw( $link ) ?>">
		<?php
		echo '<img src="' . $default . '" />';
		?>
	</a>
<?php }
