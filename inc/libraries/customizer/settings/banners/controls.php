<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

global $wp_customize;
/**
 * Display banner on homepage
 */
$wp_customize->add_control( new Epsilon_Control_Toggle(
	                            $wp_customize,
	                            'newsmag_show_banner_on_homepage',
	                            array(
		                            'type'    => 'epsilon-toggle',
		                            'label'   => esc_html__( 'Enable banner', 'newsmag' ),
		                            'section' => 'newsmag_general_banners_controls',
	                            )
                            )
);

/**
 * Type of banners
 */
$wp_customize->add_control(
	'newsmag_banner_type',
	array(
		'type'        => 'radio',
		'choices'     => array(
			'image'   => esc_html__( 'Image', 'newsmag' ),
			'adsense' => esc_html__( 'AdSense', 'newsmag' )
		),
		'label'       => esc_html__( 'The type of the banner', 'newsmag' ),
		'description' => esc_html__( 'Select what type of banner you want to use: normal image or adsense script',
		                             'newsmag' ),
		'section'     => 'newsmag_general_banners_controls',
	)
);

/**
 * Image upload field for the top-right banner
 */
$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'newsmag_banner_image',
		array(
			'label'           => esc_html__( 'Banner Image:', 'newsmag' ),
			'description'     => esc_html__( 'Recommended size: 728 x 90', 'newsmag' ),
			'section'         => 'newsmag_general_banners_controls',
			'active_callback' => 'banners_type_callback',
		)
	)
);

/**
 * Banner url
 */
$wp_customize->add_control(
	'newsmag_banner_link',
	array(
		'label'           => esc_html__( 'Banner Link:', 'newsmag' ),
		'description'     => esc_html__( 'Add the link for banner image.', 'newsmag' ),
		'section'         => 'newsmag_general_banners_controls',
		'settings'        => 'newsmag_banner_link',
		'active_callback' => 'banners_type_callback',
	)
);

/**
 * AdSense code
 */
$wp_customize->add_control(
	'newsmag_banner_adsense_code',
	array(
		'label'           => esc_html__( 'AdSense Code:', 'newsmag' ),
		'description'     => esc_html__( 'Add the code you retrieved from your AdSense account. You only need to insert the <ins> tag.', 'newsmag' ),
		'section'         => 'newsmag_general_banners_controls',
		'settings'        => 'newsmag_banner_adsense_code',
		'type'            => 'textarea',
		'active_callback' => 'banners_type_false_callback',
	)
);

function banners_type_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_banner_type' )->value() == 'image' ) {
		return true;
	}

	return false;
}

function banners_type_false_callback( $control ) {
	if ( $control->manager->get_setting( 'newsmag_banner_type' )->value() == 'image' ) {
		return false;
	}

	return true;
}