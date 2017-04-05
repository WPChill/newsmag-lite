<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
global $wp_customize;
$wp_customize->add_panel( 'newsmag_panel_general',
                          array(
	                          'priority'       => 24,
	                          'capability'     => 'edit_theme_options',
	                          'theme_supports' => '',
	                          'title'          => esc_html__( 'Theme options', 'newsmag' )
                          )
);

$wp_customize->add_panel( 'newsmag_panel_typography',
                          array(
	                          'priority'       => 26,
	                          'capability'     => 'edit_theme_options',
	                          'theme_supports' => '',
	                          'title'          => esc_html__( 'Typography', 'newsmag' )
                          )
);

$wp_customize->add_panel( 'newsmag_panel_blog',
                          array(
	                          'priority'       => 25,
	                          'capability'     => 'edit_theme_options',
	                          'theme_supports' => '',
	                          'title'          => esc_html__( 'Blog', 'newsmag' )
                          )
);

$wp_customize->add_panel( 'newsmag_panel_typography',
                          array(
	                          'priority'       => 26,
	                          'capability'     => 'edit_theme_options',
	                          'theme_supports' => '',
	                          'title'          => esc_html__( 'Typography', 'newsmag' )
                          )
);