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

<div class="col-md-4 newsmag-image-banner newsmag-margin-top">
	<?php echo ( ! empty( $params['image_url'] ) ) ? '<a href="' . $params['image_url'] . '">' : '' ?>
		<img src="<?php echo $params['image'] ?>"/>
	<?php echo ( ! empty( $params['image_url'] ) ) ? '</a>' : '' ?>
</div>

