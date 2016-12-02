<?php
/**
 * Newsmag Theme Customizer.
 *
 * @package Newsmag
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newsmag_customize_register( $wp_customize ) {
	/**
	 * Customizer settings
	 */
	require_once get_template_directory() . '/inc/customizer/register_settings.php';
	$controls = array( 'checkbox-multiple', 'slider-control', 'toggle', 'typography', 'upsell' );
	/**
	 * Initiate the setting helper
	 */
	$newsmag_customizer = new Newsmag_Customizer_Helper($controls);
	$newsmag_customizer->add_theme_options();
}

add_action( 'customize_register', 'newsmag_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newsmag_customize_preview_js() {
	wp_enqueue_script( 'newsmag_customizer', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/js/previewer.js', array( 'customize-preview' ), '21151215', true );

	wp_localize_script( 'newsmag_customizer', 'WPUrls', array(
		'siteurl' => get_option( 'siteurl' ),
		'theme'   => get_template_directory_uri(),
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );

	wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/css/style.css' );

}

function newsmag_customizer_enqueue_scripts() {
	/*
	 * Our Customizer script
	 *
	 * Dependencies: Customizer Controls script (core)
	 */
	wp_enqueue_script( 'epsilon-object', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/js/epsilon.js', array( 'jquery' ) );
	wp_localize_script( 'epsilon-object', 'WPUrls', array(
		'siteurl' => get_option( 'siteurl' ),
		'theme'   => get_template_directory_uri(),
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	) );
	wp_enqueue_script( 'customizer-scripts', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/js/customizer.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/css/style.css' );
}

add_action( 'customize_controls_enqueue_scripts', 'newsmag_customizer_enqueue_scripts' );
add_action( 'customize_preview_init', 'newsmag_customize_preview_js' );
