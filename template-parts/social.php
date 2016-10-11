<?php
/**
 * Template part for displaying social / search part
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

if ( has_nav_menu( 'social' ) ) {
	?>
	<div class="top-header">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="top-header-icons pull-right">
						<?php
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
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
