<?php
global $wp_customize;

$wp_customize->add_section(
	'newsmag_general_banners_controls',
	array(
		'title' => esc_html__( 'Banner Settings', 'newsmag' )
	)
);
