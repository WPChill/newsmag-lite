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

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->get_section( 'header_image' )->panel    = 'newsmag_panel_general';
	$wp_customize->get_section( 'header_image' )->priority = 4;
	$wp_customize->get_section( 'header_image' )->title    = __( 'Blog Archive Header Image', 'newsmag' );

	/**
	 * Custom controls
	 */
	require_once get_template_directory() . '/inc/customizer/custom-fields/control-checkbox-multiple.php';
	require_once get_template_directory() . '/inc/customizer/custom-fields/control-slider-control.php';
	require_once get_template_directory() . '/inc/customizer/custom-fields/control-macho-pro.php';
	require_once get_template_directory() . '/inc/customizer/custom-fields/control-mte-toggle.php';

	$wp_customize->register_control_type( 'WP_Macho_Pro_Control' );

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
	wp_enqueue_script( 'newsmag_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '201512151', true );
	wp_enqueue_style( 'newsmag_media_upload_css', get_stylesheet_directory_uri() . '/css/upload-media.css' );
}

add_action( 'customize_preview_init', 'newsmag_customize_preview_js' );
