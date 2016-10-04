<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newsmag
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container">
			<div class="row">
				<div class="col-md-4 header-logo">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
						$custom_logo = get_theme_mod( 'custom_logo' );
						if ( ! $custom_logo ) {
							$header_textcolor = get_theme_mod( 'header_textcolor' );
							?>
							<a class="custom-logo-link site-title" <?php echo ( ! empty( $header_textcolor ) ) ? 'style="color:#' . esc_attr( $header_textcolor ) . '"' : ''; ?>
							   href="<?php echo get_home_url() ?>"> <?php echo get_option( 'blogname' ) ?></a>
							<?php
						}
					}
					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="site-description" <?php echo ( ! empty( $header_textcolor ) ) ? 'style="color:#' . esc_attr( $header_textcolor ) . '"' : ''; ?>><?php echo wp_kses_post( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
					endif; ?>
				</div>

				<?php
				$newsmag_show_banner = get_theme_mod( 'newsmag_show_banner_on_homepage', true );
				?>
				<?php if ( $newsmag_show_banner ): ?>
					<div class="col-md-8 header-banner">
						<?php
						$banner = get_theme_mod( 'newsmag_banner_type', 'image' );
						get_template_part( 'template-parts/banner/banner', $banner );
						?>
					</div>
				<?php endif; ?>
			</div>
		</div><!-- .site-branding -->
		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<button class="menu-toggle" aria-controls="primary-menu"
						        aria-expanded="false"><span class="fa fa-bars"></span></button>
						<?php wp_nav_menu( array(
							                   'theme_location' => 'primary',
							                   'menu_id'        => 'primary-menu',
							                   'items_wrap'     => '<ul id="%1$s" class="menu %2$s">%3$s</ul>'
						                   ) ); ?>
					</div>

					<?php
					get_template_part( 'template-parts/social' );
					?>
				</div>
			</div>

		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
