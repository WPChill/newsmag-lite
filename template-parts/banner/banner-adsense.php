<?php

$code = get_theme_mod( 'newsmag_banner_adsense_code', '' );

/**
 * In case we don't have an image, we terminate here
 */
if ( empty( $code ) ) {
	return false;
}

echo htmlspecialchars_decode( $code );