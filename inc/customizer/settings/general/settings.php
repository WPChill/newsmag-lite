<?php
global $wp_customize;

/**
 * Show / Hide the search icon from the top bar
 */
$wp_customize->add_setting( 'newsmag_enable_menu_search',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_radio_buttons'
		),
		'default'           => 'enabled'
	)
);

/**
 * Breadcrumbs on single blog posts
 */
$wp_customize->add_setting( 'newsmag_enable_post_breadcrumbs',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_radio_buttons'
		),
		'default'           => 'breadcrumbs_enabled'
	)
);

/**
 * Breadcrumbs separator
 */
$wp_customize->add_setting( 'newsmag_blog_breadcrumb_menu_separator',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_radio_buttons'
		),
		'default'           => 'rarr'
	)
);

/**
 * Breadcrumb post category
 */
$wp_customize->add_setting( 'newsmag_blog_breadcrumb_menu_post_category',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_checkbox'
		),
		'default'           => 1
	)
);

/**
 * Footer Options
 */
$wp_customize->add_setting( 'newsmag_footer_columns',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_radio_buttons'
		),
		'default'           => 3
	)
);

/**
 * Copyright Options
 * enable the copyright text
 */
$wp_customize->add_setting( 'newsmag_enable_copyright',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_radio_buttons'
		),
		'default'           => 'enabled'
	)
);
/**
 * Copyright text
 */
$wp_customize->add_setting( 'newsmag_copyright_contents',
	array(
		'sanitize_callback' => 'esc_html',
		'default'           => date( "Y" ) . ' Newsmag. All rights reserved.',
	)
);
/**
 * Enable the go top button
 */
$wp_customize->add_setting( 'newsmag_enable_go_top',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_radio_buttons'
		),
		'default'           => 'enabled'
	)
);
/**
 * Author box
 */

$wp_customize->add_setting( 'newsmag_enable_author_box',
	array(
		'sanitize_callback' => array(
			'Newsmag_Customizer_Helper',
			'newsmag_sanitize_radio_buttons'
		),
		'default'           => 'enabled'
	)
);

/**
 * Upsell
 */
$wp_customize->add_setting( 'newsmag_upsell_macho_general',
	array(
		'sanitize_callback' => 'esc_html',
		'default'           => ''
	) );
$wp_customize->add_setting( 'newsmag_upsell_macho_blog',
	array(
		'sanitize_callback' => 'esc_html',
		'default'           => ''
	) );