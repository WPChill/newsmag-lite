<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newsmag
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area col-lg-4 col-md-4 col-sm-4 newsmag-sidebar hidden-xs" role="complementary">
	<div class="newsmag-blog-sidebar">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</div>
</aside><!-- #secondary -->
