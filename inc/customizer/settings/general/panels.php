<?php
global $wp_customize;
$wp_customize->add_panel( 'newsmag_panel_general',
                          array(
	                          'priority'       => 24,
	                          'capability'     => 'edit_theme_options',
	                          'theme_supports' => '',
	                          'title'          => esc_html__( 'Theme options', 'newsmag' )
                          )
);

$wp_customize->add_panel( 'newsmag_panel_blog',
                          array(
	                          'priority'       => 25,
	                          'capability'     => 'edit_theme_options',
	                          'theme_supports' => '',
	                          'title'          => esc_html__( 'Blog Settings', 'newsmag' )
                          )
);
