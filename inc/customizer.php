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
	wp_enqueue_style( 'epsilon-style', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/css/style.css' );
	/**
	 * Custom controls
	 */
	require_once get_template_directory() . '/inc/customizer/epsilon-framework/control-epsilon-checkbox-multiple.php';
	require_once get_template_directory() . '/inc/customizer/epsilon-framework/control-epsilon-slider-control.php';
	require_once get_template_directory() . '/inc/customizer/epsilon-framework/control-epsilon-upsell.php';
	require_once get_template_directory() . '/inc/customizer/epsilon-framework/control-epsilon-toggle.php';

	$wp_customize->register_control_type( 'Epsilon_Control_Upsell' );

	/**
	 * Customizer settings
	 */
	require_once get_template_directory() . '/inc/customizer/register_settings.php';

	/**
	 * Initiate the setting helper
	 */
	$newsmag_customizer = new Newsmag_Customizer_Helper();
	$newsmag_customizer->add_theme_options();
}

add_action( 'customize_register', 'newsmag_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newsmag_customize_preview_js() {
	wp_enqueue_script( 'newsmag_customizer', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/js/previewer.js', array( 'customize-preview' ), '20151215', true );
	wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/css/style.css' );
}
function newsmag_customizer_enqueue_scripts() {
	/*
	 * Our Customizer script
	 *
	 * Dependencies: Customizer Controls script (core)
	 */
	wp_enqueue_script( 'customizer-scripts', get_stylesheet_directory_uri() . '/inc/customizer/epsilon-framework/assets/js/customizer.js', array( 'customize-controls' ) );
	wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/css/style.css' );
}

add_action( 'customize_controls_enqueue_scripts', 'newsmag_customizer_enqueue_scripts' );
add_action( 'customize_preview_init', 'newsmag_customize_preview_js' );
