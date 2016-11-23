<?php

$code = get_theme_mod( 'newsmag_banner_adsense_code', '' );

/**
 * In case we don't have an image, we terminate here
 */
if ( empty( $code ) ) {
	return false;
}
?>
<div class="newsmag-adsense">
	<?php
	echo htmlspecialchars_decode( $code );
	?>
	<p class="adsense__loading"><span><?php echo __( 'Loading', 'newsmag' ); ?></span></p>
</div>
