<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Due to the fact that we changed how this theme works,
 * we need to create a separate file to keep all the
 * deprecated functions
 */

function newsmag_the_posts_navigation( $args = array() ) {
	echo get_the_posts_navigation( $args );
}

function newsmag_posted_on( $element = 'default' ) {
	Newsmag_Helper::posted_on( $element );
}

function newsmag_breadcrumbs() {
	Newsmag_Helper::add_breadcrumbs();
}

function newsmag_get_attachment_id( $url ) {
	return Newsmag_Helper::get_attachment_id( $url );
}

function newsmag_format_icon( $format = 'standard' ) {
	echo Newsmag_Helper::format_icon( $format );
}

function newsmag_on_iis() {
	return Newsmag_Helper::on_iis();
}