<?php
global $wp_customize;

$wp_customize->add_setting( 'newsmag_enable_news_ticker',
                            array(
	                            'sanitize_callback' => array(
		                            'Newsmag_Customizer_Helper',
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
                            )
);

/**
 * Show / Hide the search icon from the top bar
 */
$wp_customize->add_setting( 'newsmag_enable_menu_search',
                            array(
	                            'sanitize_callback' => array(
		                            'Newsmag_Customizer_Helper',
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
                            )
);

/**
 * Breadcrumbs on single blog posts
 */
$wp_customize->add_setting( 'newsmag_enable_post_breadcrumbs',
                            array(
	                            'sanitize_callback' => array(
		                            'Newsmag_Customizer_Helper',
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
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
	                            'default'           => '/'
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
	                            'default'           => true
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
	                            'default'           => 4
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
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
                            )
);
$wp_customize->add_setting( 'newsmag_enable_attribution',
                            array(
	                            'sanitize_callback' => array(
		                            'Newsmag_Customizer_Helper',
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
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
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
                            )
);
/**
 * Blog posts
 */

/**
 * Author box
 */
$wp_customize->add_setting( 'newsmag_enable_author_box',
                            array(
	                            'sanitize_callback' => array(
		                            'Newsmag_Customizer_Helper',
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
                            )
);

$wp_customize->add_setting( 'newsmag_show_single_post_tags',
                            array(
	                            'sanitize_callback' => array(
		                            'Newsmag_Customizer_Helper',
		                            'newsmag_sanitize_checkbox'
	                            ),
	                            'default'           => true
                            )
);

$wp_customize->add_setting( 'newsmag_excerpt_length',
                            array(
	                            'sanitize_callback' => 'absint',
	                            'default'           => 25
                            )
);

/**
 * Upsell
 */
$wp_customize->add_setting( 'newsmag_upsell_macho_blog',
                            array(
	                            'sanitize_callback' => 'esc_html',
	                            'default'           => ''
                            ) );
$wp_customize->add_setting( 'newsmag_upsell_pro_banners',
                            array(
	                            'sanitize_callback' => 'esc_html',
	                            'default'           => ''
                            ) );

$wp_customize->add_setting( 'newsmag_upsell_color_version',
                            array(
	                            'sanitize_callback' => 'esc_html',
	                            'default'           => ''
                            ) );