<?php
global $wp_customize;

/**
 * Enable search
 */
$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_enable_menu_search',
	                            array(
		                            'type'        => 'mte-toggle',
		                            'label'       => esc_html__( 'Search icon in the menu', 'newsmag' ),
		                            'description' => esc_html__( 'Toggle the display of the search icon and functionality in the main navigation menu.', 'newsmag' ),
		                            'section'     => 'newsmag_general_section',
	                            )
                            )
);
/**
 * Enable / Disable Go top
 */
$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_enable_go_top',
	                            array(
		                            'type'    => 'mte-toggle',
		                            'label'   => esc_html__( 'Go to top button', 'newsmag' ),
		                            'description' => esc_html__( 'Toggle the display of the go to top button.', 'newsmag' ),
		                            'section' => 'newsmag_general_section',
	                            )
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
		'description' => esc_html__( 'Select the number of sidebars you would like to use in the footer. The higher the number, the more widgets you will be able to place here.', 'newsmag' ),
		'section'     => 'newsmag_footer_section',
	)
);
/**
 * Copyright enable/disable
 */

$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_enable_attribution',
	                            array(
		                            'type'    => 'mte-toggle',
		                            'label'   => esc_html__( 'Link attribution', 'newsmag' ),
		                            'description' => esc_html__( 'Toggling this to off will remove the link attribution. This basically means that we, the theme authors, will not be receiving a backlink to our website.', 'newsmag' ),
		                            'section' => 'newsmag_footer_section',
	                            )
                            )
);


$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_enable_copyright',
	                            array(
		                            'type'    => 'mte-toggle',
		                            'label'   => esc_html__( 'Copyright Area', 'newsmag' ),
		                            'description' => esc_html__( 'Toggle the copyright area on or off. By setting it on the off position, you will not be able to display a copyright message in the footer', 'newsmag' ),
		                            'section' => 'newsmag_footer_section',
	                            )
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


$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_enable_author_box',
	                            array(
		                            'type'    => 'mte-toggle',
		                            'label'   => esc_html__( 'Posta meta: Author', 'newsmag' ),
		                            'description' => esc_html__('Toggle the display of the author box, at the left side of the post. Will only display if the author has a description defined.', 'newsmag'),
		                            'section' => 'newsmag_blog_section',
	                            )
                            )
);


$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_show_single_post_tags',
	                            array(
		                            'type'        => 'mte-toggle',
		                            'label'       => esc_html__( 'Post Meta: Tags', 'newsmag' ),
		                            'description' => esc_html__( 'This will disable the tags zone at the end of the post.', 'newsmag' ),
		                            'section'     => 'newsmag_blog_section',
	                            )
                            )
);
/**
 * Enable breadcrumbs on single posts
 */
$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_enable_post_breadcrumbs',
	                            array(
		                            'type'    => 'mte-toggle',
		                            'label'   => esc_html__( 'Breadcrumbs', 'newsmag' ),
		                            'description' => esc_html__( 'Toggle the display of the breadcrumbs. Affects the whole blog - single posts as well as the blog archive.', 'newsmag' ),
		                            'section' => 'newsmag_blog_section',
	                            )
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
		'label'           => esc_html__( 'Breadcrumbs: Separator', 'newsmag' ),
		'section'         => 'newsmag_blog_section',
		'active_callback' => 'breadcrumbs_enabled_callback',
	)
);

/**
 *  Breadcrumbs post category
 */
$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_blog_breadcrumb_menu_post_category',
	                            array(
		                            'type'            => 'mte-toggle',
		                            'label'           => esc_html__( 'Breacrumbs: Category', 'newsmag' ),
		                            'description'     => esc_html__( 'Show the post category in the breadcrumb ?', 'newsmag' ),
		                            'section'         => 'newsmag_blog_section',
		                            'active_callback' => 'breadcrumbs_enabled_callback',
	                            )
                            )
);
/**
 * General Settings Upsell
 */
$wp_customize->add_control( new Epsilon_Control_Upsell(
	                            $wp_customize,
	                            'newsmag_upsell_macho_blog',
	                            array(
		                            'section'     => 'newsmag_blog_section',
		                            'options'     => array( 
						                            	esc_html__('Related Posts Carousel', 'newsmag'), 
						                            	esc_html__('Extra Blog Layouts', 'newsmag') 
					                            	),
		                              'requirements' => array(
		                            				esc_html__('Control the number of posts, speed, display of title and date on your related posts carousel.', 'newsmag'),
		                            				esc_html__('Multiple blog layouts are available in the PRO version of Newsmag. That includes: full-width posts and sidebars on the left.', 'newsmag'),
		                            				),
		                            'priority'    => 0,
		                            'button_link' => esc_url('https://www.machothemes.com/themes/newsmag-pro/'), // xss ok
		                            'button_text' => esc_html__('Get the PRO version!', 'newsmag'),
	                            )
                            )
);
$wp_customize->add_control( new Epsilon_Control_Upsell(
	                            $wp_customize,
	                            'newsmag_upsell_pro_version',
	                            array(
		                            'section'     => 'newsmag_general_pro_version_section',
		                            'priority'    => 0,
		                            'options'     => array( 
				                            		esc_html__('News Ticker', 'newsmag'), 
				                            		esc_html__('Related Posts Carousel', 'newsmag'), 
				                            		esc_html__('Extra Blog Layouts', 'newsmag'),
				                            		esc_html__('More Slider Widget Controls', 'newsmag'),
				                            		esc_html__('More Banner Ad areas', 'newsmag') ,
				                            		esc_html__('Dedicated Support', 'newsmag'),
				                            		esc_html__('Theme Updates for 1 year', 'newsmag') ,
		                            		),
		                            'requirements' => array(
		                            				esc_html__('Get news ticker functionality with the PRO version of Newsmag. Showcase your most important news in style!', 'newsmag'),
		                            				esc_html__('Control the number of posts, speed, display of title and date on your related posts carousel.', 'newsmag'),
		                            				esc_html__('Multiple blog layouts are available in the PRO version of Newsmag. That includes: full-width posts and sidebars on the left.', 'newsmag'),
		                            				esc_html__('Control the number of posts displayed in the slider widget. ', 'newsmag'),
		                            				esc_html__('Get in-content banner areas - blend your ads with the posts for a better click-through rate.', 'newsmag'),
		                            				esc_html__('Theme updates and support for 1 year - included with purchase', 'newsmag') ,
		                            				),
		                            'button_link' => esc_url('https://www.machothemes.com/themes/newsmag-pro/'), // xss ok
		                            'button_text' => esc_html__('Get the PRO version!', 'newsmag'),
	                            )
                            )
);


$wp_customize->add_control( new Epsilon_Control_Upsell(
	                            $wp_customize,
	                            'newsmag_upsell_color_version',
	                            array(
		                            'section'     => 'colors',
		                            'priority'    => 0,
		                            'options'     => array( 
				                            		esc_html__('More Color Options', 'newsmag'), 
		                            		),
		                            'requirements' => array(
		                            				esc_html__('The PRO version of Newsmag allows for a greater degree of customisability. Get multiple professionally designed color schemes with the purchase of the PRO version. ', 'newsmag'),
		                            				),
		                            'button_link' => esc_url('https://www.machothemes.com/themes/newsmag-pro/'), // xss ok
		                            'button_text' => esc_html__('Get the PRO version!', 'newsmag'),
	                            )
                            )
);

/**
 * Active Callback for breadcrumb
 */
function breadcrumbs_enabled_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_enable_post_breadcrumbs' )->value() == true ) {
		return true;
	}

	return false;
}

/**
 * Active Callback for copyright
 */
function copyright_enabled_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_enable_copyright' )->value() == true ) {
		return true;
	}

	return false;
}

/**
 * Active Callback for copyright
 */
function related_posts_enabled_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_related_posts_enabled' )->value() == true ) {
		return true;
	}

	return false;
}