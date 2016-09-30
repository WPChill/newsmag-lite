<?php
global $wp_customize;

/**
 * Enable search
 */
$wp_customize->add_control(
	'newsmag_enable_menu_search',
	array(
		'type'    => 'radio',
		'choices' => array(
			'enabled'  => esc_html__( 'Enabled', 'newsmag' ),
			'disabled' => esc_html__( 'Disabled', 'newsmag' )
		),
		'label'   => esc_html__( 'Enable or disable the search from menu bar', 'newsmag' ),
		'section' => 'newsmag_general_section',
	)
);

/**
 * Enable the news ticker
 */
$wp_customize->add_control(
	'newsmag_enable_news_ticker',
	array(
		'type'    => 'radio',
		'choices' => array(
			'enabled'  => esc_html__( 'Enabled', 'newsmag' ),
			'disabled' => esc_html__( 'Disabled', 'newsmag' )
		),
		'label'   => esc_html__( 'Enable or disable the news ticker', 'newsmag' ),
		'section' => 'newsmag_general_section',
	)
);


/**
 * Footer Column Count
 */
$wp_customize->add_control(
	'newsmag_footer_columns',
	array(
		'type'        => 'radio',
		'choices'     => array(
			1 => esc_html__( 'One Column', 'newsmag' ),
			2 => esc_html__( 'Two Columns', 'newsmag' ),
			3 => esc_html__( 'Three Columns', 'newsmag' ),
			4 => esc_html__( 'Four Columns', 'newsmag' )
		),
		'label'       => esc_html__( 'Footer Columns', 'newsmag' ),
		'description' => esc_html__( 'Select how many columns should the footer display.', 'newsmag' ),
		'section'     => 'newsmag_footer_section',
	)
);
/**
 * Copyright enable/disable
 */
$wp_customize->add_control(
	'newsmag_enable_copyright',
	array(
		'type'    => 'radio',
		'choices' => array(
			'enabled'  => esc_html__( 'Enabled', 'newsmag' ),
			'disabled' => esc_html__( 'Disabled', 'newsmag' ),
		),
		'label'   => esc_html__( 'Enable copyright footer bar?', 'newsmag' ),
		'section' => 'newsmag_footer_section',
	)
);
/**
 * Copyright content
 */
$wp_customize->add_control(
	'newsmag_copyright_contents',
	array(
		'label'           => esc_html__( 'Copyright Text', 'newsmag' ),
		'section'         => 'newsmag_footer_section',
		'active_callback' => 'copyright_enabled_callback',
	)
);
/**
 * Enable / Disable Go top
 */
$wp_customize->add_control(
	'newsmag_enable_go_top',
	array(
		'type'    => 'radio',
		'choices' => array(
			'enabled'  => esc_html__( 'Enabled', 'newsmag' ),
			'disabled' => esc_html__( 'Disabled', 'newsmag' ),
		),
		'label'   => esc_html__( 'Go Top Button', 'newsmag' ),
		'section' => 'newsmag_footer_section',
	)
);

/**
 * Blog Settings
 *
 * Author box
 */
$wp_customize->add_control(
	'newsmag_blog_layout',
	array(
		'type'    => 'radio',
		'choices' => array(
			'fullwidth'     => esc_html__( 'Fullwidth', 'newsmag' ),
			'left-sidebar'  => esc_html__( 'Sidebar Left', 'newsmag' ),
			'right-sidebar' => esc_html__( 'Sidebar Right', 'newsmag' ),
		),
		'label'   => esc_html__( 'Blog layout', 'newsmag' ),
		'section' => 'newsmag_blog_section',
	)
);

$wp_customize->add_control(
	'newsmag_enable_author_box',
	array(
		'type'    => 'radio',
		'choices' => array(
			'enabled'  => esc_html__( 'Enabled', 'newsmag' ),
			'disabled' => esc_html__( 'Disabled', 'newsmag' ),
		),
		'label'   => esc_html__( 'Show author box in posts?', 'newsmag' ),
		'section' => 'newsmag_blog_section',
	)
);
/**
 * Enable breadcrumbs on single posts
 */
$wp_customize->add_control(
	'newsmag_enable_post_breadcrumbs',
	array(
		'type'        => 'radio',
		'choices'     => array(
			'breadcrumbs_enabled'  => esc_html__( 'Enabled', 'newsmag' ),
			'breadcrumbs_disabled' => esc_html__( 'Disabled', 'newsmag' )
		),
		'label'       => esc_html__( 'Breadcrumbs on single blog posts', 'newsmag' ),
		'description' => esc_html__( 'This will disable the breadcrumbs', 'newsmag' ),
		'section'     => 'newsmag_blog_section',
	)
);

/**
 *  Breadcrumbs separator
 */
$wp_customize->add_control(
	'newsmag_blog_breadcrumb_menu_separator',
	array(
		'type'            => 'select',
		'choices'         => array(
			'/'         => esc_html( '/' ),
			'rarr'      => esc_html( '&rarr;' ),
			'middot'    => esc_html( '&middot;' ),
			'diez'      => esc_html( '&#35;' ),
			'ampersand' => esc_html( '&#38;' ),
		),
		'label'           => esc_html__( 'Separator to be used between breadcrumb items', 'newsmag' ),
		'section'         => 'newsmag_blog_section',
		'active_callback' => 'breadcrumbs_enabled_callback',
	)
);

/**
 *  Breadcrumbs post category
 */

$wp_customize->add_control(
	'newsmag_blog_breadcrumb_menu_post_category',
	array(
		'type'            => 'checkbox',
		'label'           => esc_html__( 'Show post category ?', 'newsmag' ),
		'description'     => esc_html__( 'Show the post category in the breadcrumb ?', 'newsmag' ),
		'section'         => 'newsmag_blog_section',
		'active_callback' => 'breadcrumbs_enabled_callback',
	)
);
/*
 * Related Post Section
 */
$wp_customize->add_control(
	'newsmag_related_posts_enabled',
	array(
		'type'    => 'radio',
		'choices' => array(
			'enabled'  => esc_html__( 'Enabled', 'newsmag' ),
			'disabled' => esc_html__( 'Disabled', 'newsmag' ),
		),
		'label'   => esc_html__( 'Enable Related Posts Section', 'newsmag' ),
		'section' => 'newsmag_blog_section',
	)
);

/**
 * Autoplay carousel
 */
$wp_customize->add_control(
	'newsmag_autoplay_blog_posts',
	array(
		'type'            => 'checkbox',
		'label'           => esc_html__( 'Autoplay related carousel?', 'newsmag' ),
		'section'         => 'newsmag_blog_section',
		'active_callback' => 'related_posts_enabled_callback',
	)
);

/**
 * Blog Post number
 */
$wp_customize->add_control( new Newsmag_Controls_Slider_Control(
		$wp_customize,
		'newsmag_howmany_blog_posts',
		array(
			'label'           => esc_html__( 'How many blog posts to display in the carousel at once?', 'newsmag' ),
			'description'     => esc_html__( 'No more than 4 posts at once;', 'newsmag' ),
			'choices'         => array(
				'min'  => 1,
				'max'  => 4,
				'step' => 1,
			),
			'section'         => 'newsmag_blog_section',
			'default'         => 4,
			'active_callback' => 'related_posts_enabled_callback',
		)
	)
);

/**
 * Show title
 */

$wp_customize->add_control(
	'newsmag_enable_related_title_blog_posts',
	array(
		'type'            => 'checkbox',
		'label'           => esc_html__( 'Posts title in the carousel ?', 'newsmag' ),
		'section'         => 'newsmag_blog_section',
		'active_callback' => 'related_posts_enabled_callback',
	)
);

/**
 * Show date
 */
$wp_customize->add_control(
	'newsmag_enable_related_date_blog_posts',
	array(
		'type'            => 'checkbox',
		'label'           => esc_html__( 'Carousel related posts date?', 'newsmag' ),
		'section'         => 'newsmag_blog_section',
		'active_callback' => 'related_posts_enabled_callback',
	)
);

/**
 * General Settings Upsell
 */
$wp_customize->add_control( new WP_Macho_Pro_Control(
		$wp_customize,
		'newsmag_upsell_macho_general',
		array(
			'section'     => 'newsmag_general_section',
			'options'     => array( 'News Ticker' ),
			'priority'    => 0,
			'button_link' => 'https://machothemes.com',
			'button_text' => 'Upgrade to pro!',
		)
	)
);
$wp_customize->add_control( new WP_Macho_Pro_Control(
		$wp_customize,
		'newsmag_upsell_macho_blog',
		array(
			'section'     => 'newsmag_blog_section',
			'options'     => array( 'Related Posts Carousel', 'Blog Layout' ),
			'priority'    => 0,
			'button_link' => 'https://machothemes.com',
			'button_text' => 'Upgrade to pro!',
		)
	)
);
/**
 * Active Callback for breadcrumb
 */
function breadcrumbs_enabled_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_enable_post_breadcrumbs' )->value() == 'breadcrumbs_enabled' ) {
		return true;
	}

	return false;
}

/**
 * Active Callback for copyright
 */
function copyright_enabled_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_enable_copyright' )->value() == 'enabled' ) {
		return true;
	}

	return false;
}

/**
 * Active Callback for copyright
 */
function related_posts_enabled_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_related_posts_enabled' )->value() == 'enabled' ) {
		return true;
	}

	return false;
}