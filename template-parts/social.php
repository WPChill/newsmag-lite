<?php
/**
 * Template part for displaying social / search part
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

?>
<div class="col-md-6 col-xs-12">
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

		<?php if ( get_theme_mod( 'newsmag_enable_menu_search', 'enabled' ) === 'enabled'): ?>

			<span class="separator pull-right"></span>
			<!-- Search Form -->
			<form role="search" method="get" class="pull-right" id="searchform_topbar" action="<?php echo home_url( '/' ); ?>">
				<label>
					<span class="screen-reader-text"><?php __( 'Search for:', 'newsmag' ) ?></span>
					<input class="search-field-top-bar" id="search-field-top-bar" placeholder="Search ..."
					       value="" name="s"
					       type="search">
				</label>
				<button id="search-top-bar-submit" type="button" class="search-top-bar-submit"><span
						class="fa fa-search"></span></button>
			</form>
		<?php endif; ?>

	</div>
</div>
