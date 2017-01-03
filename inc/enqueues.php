<?php

/**
 * Enqueue scripts and styles in the frontend.
 */
function newsmag_scripts() {
	$newsmag = wp_get_theme();

	/**
	 * Load Google Fonts
	 */
	wp_enqueue_style( 'newsmag-fonts', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Poppins:400,500,600,700', array(), $newsmag['Version'], 'all' );
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/assets/vendors/fontawesome//font-awesome.min.css' );

	/**
	 * Load the bootstrap framework
	 */
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap-theme.min.css' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.js', array( 'jquery' ), $newsmag['Version'], true );

	/**
	 * Load offscreen helper
	 */
	wp_enqueue_script( 'newsmag-offscreen', get_template_directory_uri() . '/assets/vendors/offscreen/offscreen.min.js', array( 'jquery' ), $newsmag['Version'], true );

	/**
	 * Load the Sticky library
	 */
	wp_enqueue_script( 'newsmag-sticky', get_template_directory_uri() . '/assets/vendors/sticky/jquery.sticky.js', array( 'jquery' ), $newsmag['Version'], true );

	/**
	 * Theme styling
	 */
	wp_enqueue_style( 'newsmag-style', get_stylesheet_uri() );
	wp_enqueue_style( 'newsmag-stylesheet', get_template_directory_uri() . '/assets/css/style.css', array(), $newsmag['Version'] );

	/**
	 * Load menu script & skip-link-focus-fix
	 */
	wp_enqueue_script( 'newsmag-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), $newsmag['Version'], true );
	wp_enqueue_script( 'newsmag-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), $newsmag['Version'], true );

	/**
	 * Adsense loader
	 */
	wp_enqueue_script( 'adsense-loader', get_template_directory_uri() . '/assets/vendors/adsenseloader/jquery.adsenseloader.js', array( 'jquery' ), $newsmag['Version'], true );

	/**
	 *Load the theme's core Javascript
	 */
	wp_enqueue_script( 'machothemes-object', get_template_directory_uri() . '/assets/vendors/machothemes/machothemes.min.js', array(), $newsmag['Version'], true );
	wp_enqueue_script( 'newsmag-functions', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), $newsmag['Version'], true );
	wp_localize_script( 'newsmag-functions', 'WPUrls', array(
		'siteurl' => get_option( 'siteurl' ),
		'theme'   => get_template_directory_uri(),
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * OwlCarousel Library
	 */
	wp_enqueue_script( 'owlCarousel-js', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.carousel.min.js', array( 'jquery' ), $newsmag['Version'], true );
	wp_enqueue_style( 'owlCarousel-main-css', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.carousel.min.css' );
	wp_enqueue_style( 'owlCarousel-theme-css', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.theme.default.css' );
}

add_action( 'wp_enqueue_scripts', 'newsmag_scripts' );

/**
 * Load admin fonts
 */
function newsmag_admin_scripts() {
	$newsmag = wp_get_theme();
	wp_enqueue_style( 'newsmag-fonts', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Poppins:400,500,600,700', array(), $newsmag['Version'], 'all' );
}

add_action( 'admin_enqueue_scripts', 'newsmag_admin_scripts' );

/**
 * Load editor styles
 */
function newsmag_add_editor_styles() {
	add_editor_style( 'inc/assets/css/custom-editor-style.css' );
}

add_action( 'admin_init', 'newsmag_add_editor_styles' );