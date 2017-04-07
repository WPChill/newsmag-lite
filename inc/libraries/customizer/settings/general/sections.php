<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
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
	                            'priority' => 50,
                            )
);

$wp_customize->add_section( 'newsmag_blog_section',
                            array(
	                            'title'    => esc_html__( 'Single Post', 'newsmag' ),
	                            'panel'    => 'newsmag_panel_blog',
	                            'priority' => 1,
                            )
);

$wp_customize->add_section( 'newsmag_preloader_section',
                            array(
	                            'title'    => esc_html__( 'Preloader', 'newsmag' ),
	                            'panel'    => 'newsmag_panel_general',
	                            'priority' => 1,
                            )
);


$wp_customize->add_section( 'newsmag_typography',
                            array(
	                            'title'    => esc_html__( 'Typography', 'newsmag' ),
	                            'priority' => 51,
                            )
);

$wp_customize->add_section( 'newsmag_typography_headings',
                            array(
	                            'title'    => esc_html__( 'Headings', 'newsmag' ),
	                            'panel'    => 'newsmag_panel_typography',
	                            'priority' => 51,
                            )
);
$wp_customize->add_section( 'newsmag_typography_paragraph',
                            array(
	                            'title'    => esc_html__( 'Paragraphs', 'newsmag' ),
	                            'panel'    => 'newsmag_panel_typography',
	                            'priority' => 52,
                            )
);

$wp_customize->add_section(
	new Epsilon_Section_Pro(
		$wp_customize,
		'epsilon-section-pro',
		array(
			'title'       => esc_html__( 'LITE vs PRO comparison', 'newsmag' ),
			'button_text' => esc_html__( 'Learn more', 'newsmag' ),
			'button_url'  => esc_url_raw( admin_url() . 'themes.php?page=newsmag-welcome&tab=features' ),
			'priority'    => 0
		)
	)
);

global $newsmag_required_actions, $newsmag_recommended_plugins;

$wp_customize->add_section(
	new Epsilon_Section_Recommended_Actions(
		$wp_customize,
		'epsilon_recommended_section',
		array(
			'title'                        => esc_html__( 'Recomended Actions', 'newsmag' ),
			'social_text'                  => esc_html__( 'We are social :', 'newsmag' ),
			'plugin_text'                  => esc_html__( 'Recomended Plugins :', 'newsmag' ),
			'actions'                      => $newsmag_required_actions,
			'plugins'                      => $newsmag_recommended_plugins,
			'theme_specific_option'        => 'newsmag_show_required_actions',
			'theme_specific_plugin_option' => 'newsmag_show_required_plugins',
			'facebook'                     => 'https://www.facebook.com/machothemes',
			'twitter'                      => 'https://twitter.com/MachoThemez',
			'wp_review'                    => true,
			'theme_slug'                   => 'newsmag',
			'priority'                     => 0
		)
	)
);