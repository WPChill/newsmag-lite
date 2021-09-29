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
<?php do_action( 'wp_body_open' ); ?>
<?php
$preloader = get_theme_mod( 'newsmag_preloader_effect', false );
if ( $preloader ) :
	get_template_part( 'template-parts/preloader' );
endif;
?>

<div id="page" class="site">

	<?php get_template_part( 'template-parts/social' ); ?>

	<?php
	$center_class = false;
	if ( has_custom_logo() ) {
		$center_class = true;
	}
	?>
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding container <?php echo $center_class ? 'centered-branding' : ''; ?>">
			<div class="row">
				<div class="col-md-4 header-logo">
					<?php
					$header_textcolor = get_theme_mod( 'header_textcolor' );
					if ( function_exists( 'the_custom_logo' ) ) {
						if ( has_custom_logo() ) {
							the_custom_logo();
						} else {
						?>
							<?php
							if ( 'blank' !== $header_textcolor ) :
								?>
								<a class="site-title"
								href="<?php echo esc_url( get_home_url() ); ?>"> <?php echo get_option( 'blogname', 'newsmag' ); ?></a>
							<?php endif; ?>
							<?php
							$description = get_bloginfo( 'description', 'display' );
							if ( 'blank' !== $header_textcolor && ! empty( $description ) ) :
							?>
								<p class="site-description" <?php echo ( ! empty( $header_textcolor ) ) ? 'style="color:#' . esc_attr( $header_textcolor ) . '"' : ''; ?>><?php echo wp_kses_post( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
							endif;
						}
					}
					?>
				</div>

				<?php
				$newsmag_show_banner = get_theme_mod( 'newsmag_show_banner_on_homepage', true );
				?>
				<?php if ( $newsmag_show_banner ) : ?>
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
		<nav id="site-navigation" class="main-navigation <?php echo $enable_sticky ? 'stick-menu' : ''; ?>"
			role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php if ( $enable_sticky && ! empty( $image[0] ) ) : ?>
							<div class="stick-menu-logo hidden-xs hidden-sm">
								<a href="<?php echo esc_url( get_home_url() ); ?>"><img
											src="<?php echo esc_url( $image[0] ); ?>"/></a>
							</div>
						<?php endif; ?>
						<button class="menu-toggle" aria-controls="primary-menu"
								aria-expanded="false"><span class="nmicon-bars"></span></button>
						<?php
						if ( has_nav_menu( 'primary' ) ) {
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									'menu_id'        => 'primary-menu',
									'items_wrap'     => '<ul id="%1$s" class="menu nav-menu %2$s">%3$s</ul>',
								)
							);

						} else {
							?>
							<div class="menu-all-pages-container">
								<ul id="primary-menu" class="menu nav-menu menu" aria-expanded="false">
									<li id="menu-item-1636"
										class="menu-item menu-item-type-custom menu-item-object-custom menu-item-1636">
										<a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php echo __( 'Add a menu', 'newsmag' ); ?></a>
									</li>
								</ul>
							</div>
							<?php
						}
						?>
						<?php if ( $enable_search ) : ?>
							<button href="#" class="search-form-opener" type="button"><span class="nmicon-search"></span>
							</button>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</nav><!-- #site-navigation -->
		<?php if ( $enable_search ) : ?>
			<div class="header-search-form">
				<div class="container">
					<!-- Search Form -->
					<?php get_search_form(); ?>
				</div>
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
