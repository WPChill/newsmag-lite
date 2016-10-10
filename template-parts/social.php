<?php
/**
 * Template part for displaying social / search part
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

?>

<div class="top-header-icons pull-right">
	<?php
	if ( has_nav_menu( 'social' ) ) {

		wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'container'       => 'div',
				'container_id'    => 'menu-social',
				'container_class' => 'pull-right',
				'menu_id'         => 'menu-social-items',
				'menu_class'      => 'menu-items',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => '',
			)
		);
	}
	?>


</div>
