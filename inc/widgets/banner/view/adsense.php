<?php
/**
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ensign
 * @subpackage Ensign/includes
 */

// If the image is not set, terminate here
if ( empty( $params['image'] ) ) {
	return false;
}
?>

<div class="col-md-4 newsmag-adsense-banner">
	<?php echo $params['adsense_code'] ?>
</div>
