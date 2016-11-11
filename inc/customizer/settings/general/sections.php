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
$wp_customize->add_section( 'newsmag_typography',
                            array(
	                            'title'    => esc_html__( 'Typography', 'newsmag' ),
	                            'priority' => 51,
                            )
);


$wp_customize->add_section(
	'newsmag_general_pro_version_section',
	array(
		'title'    => esc_html__( 'Newsmag PRO features', 'newsmag' ),
		'priority' => 0
	)
);
