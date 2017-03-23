<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Epsilon_Framework {
	/**
	 * Epsilon_Framework constructor.
	 */
	public function __construct() {
		$controls = array( 'checkbox-multiple', 'slider', 'toggle', 'typography', 'upsell' );

		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_enqueue_scripts' ) );
		add_action( 'customize_preview_init', array( $this, 'customize_preview_styles' ) );

		wp_enqueue_style( 'epsilon-style', get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/css/style.css' );
		$path = get_template_directory() . '/inc/libraries/epsilon-framework';
		foreach ( $controls as $control ) {
			if ( file_exists( $path . '/controls/class-epsilon-control-' . $control . '.php' ) ) {
				require_once $path . '/controls/class-epsilon-control-' . $control . '.php';
			}
		}


	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 */
	public function customize_preview_styles() {
		wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/css/style.css' );
	}

	/*
	 * Our Customizer script
	 *
	 * Dependencies: Customizer Controls script (core)
	 */
	public function customizer_enqueue_scripts() {
		wp_enqueue_script( 'epsilon-object', get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/js/epsilon.js', array( 'jquery' ) );
		wp_localize_script( 'epsilon-object', 'WPUrls', array(
			'siteurl' => get_option( 'siteurl' ),
			'theme'   => get_template_directory_uri(),
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
		wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/libraries/epsilon-framework/assets/css/style.css' );
	}
}