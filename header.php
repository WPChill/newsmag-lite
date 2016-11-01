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

	<?php get_template_part( 'template-parts/social' ); ?>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container">
			<div class="row">
				<div class="col-md-4 header-logo">
					<?php
					if ( function_exists( 'the_custom_logo' ) ) {
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else { ?>
							<a class="site-title"
							   href="<?php echo esc_url_raw( get_home_url() ) ?>"> <?php echo get_option( 'blogname', 'newsmag' ) ?></a>
						<?php }
					}
					$header_textcolor = get_theme_mod( 'header_textcolor' );
					$description      = get_bloginfo( 'description', 'display' );
					if ( $header_textcolor !== 'blank' && ! empty( $description ) ) : ?>
						<p class="site-description" <?php echo ( ! empty( $header_textcolor ) ) ? 'style="color:#' . esc_attr( $header_textcolor ) . '"' : ''; ?>><?php echo wp_kses_post( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
					endif;
					?>
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
		<?php
		$enable_search  = get_theme_mod( 'newsmag_enable_menu_search', true );
		$enable_sticky  = get_theme_mod( 'newsmag_enable_sticky_menu', false );
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
		?>
		<nav id="site-navigation" class="main-navigation <?php echo $enable_sticky ? 'stick-menu' : '' ?>"
		     role="navigation">
			<div class="container">
				<div class="row">
					<div class="<?php echo $enable_search ? 'col-md-9' : 'col-md-12' ?>">
						<?php if ( $enable_sticky && ! empty( $image[0] ) ): ?>
							<div class="stick-menu-logo">
								<img src="<?php echo esc_url( $image[0] ); ?>"/>
							</div>
						<?php endif; ?>
						<button class="menu-toggle" aria-controls="primary-menu"
						        aria-expanded="false"><span class="fa fa-bars"></span></button>
						<?php wp_nav_menu( array(
							                   'theme_location' => 'primary',
							                   'menu_id'        => 'primary-menu',
							                   'items_wrap'     => '<ul id="%1$s" class="menu %2$s">%3$s</ul>'
						                   ) ); ?>
					</div>

					<?php if ( $enable_search ): ?>
						<div class="col-md-3">
							<div class="top-header-icons pull-right">
								<!-- Search Form -->
								<form role="search" method="get" id="searchform_topbar"
								      action="<?php echo esc_url_raw( home_url( '/' ) ); ?>">
									<label>
										<span
											class="screen-reader-text"><?php echo __( 'Search for:', 'newsmag' ) ?></span>
										<input class="search-field-top-bar" id="search-field-top-bar"
										       placeholder="<?php echo __( 'Search ...', 'newsmag' ) ?>"
										       value="" name="s"
										       type="search">
									</label>
									<button id="search-top-bar-submit" type="button" class="search-top-bar-submit"><span
											class="fa fa-search"></span></button>
								</form>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
