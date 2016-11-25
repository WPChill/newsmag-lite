<?php
/**
* Template part for displaying the after footer.
*
* @link    https://codex.wordpress.org/Template_Hierarchy
*
* @package Newsmag
*/
?>

<div class="after-footer-area text-center">
	<div class="after-footer-custom-logo">
		<?php
			$header_textcolor = get_theme_mod( 'header_textcolor' );
			if ( function_exists( 'the_custom_logo' ) ) {
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else { ?>
					<?php
					if ( $header_textcolor !== 'blank' ):
						?>
						<a class="site-title"
						   href="<?php echo esc_url_raw( get_home_url() ) ?>"> <?php echo get_option( 'blogname', 'newsmag' ) ?></a>
					<?php endif;

				}
			}
		?>
	</div>
	<div class="after-footer-social-menu">
		<?php
		wp_nav_menu(
			array(
				'theme_location'  => 'social',
				'container'       => 'div',
				'container_id'    => 'menu-social-footer',
				'container_class' => '',
				'menu_id'         => 'menu-social-items-footer',
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
