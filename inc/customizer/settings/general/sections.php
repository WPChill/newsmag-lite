<?php
global $wp_customize;

$wp_customize->add_section( 'newsmag_general_section',
	array(
		'title'    => esc_html__( 'General', 'newsmag' ),
		'panel'    => 'newsmag_panel_general',
		'priority' => 1,
	)
);

$wp_customize->add_section( 'newsmag_footer_section',
	array(
		'title'    => esc_html__( 'Footer', 'newsmag' ),
		'panel'    => 'newsmag_panel_general',
		'priority' => 2,
	)
);

$wp_customize->add_section( 'newsmag_blog_section',
	array(
		'title'    => esc_html__( 'Blog Settings', 'newsmag' ),
		'panel'    => 'newsmag_panel_general',
		'priority' => 3,
	)
);