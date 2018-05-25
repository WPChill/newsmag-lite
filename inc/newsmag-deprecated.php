<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Due to the fact that we changed how this theme works,
 * we need to create a separate file to keep all the
 * deprecated functions
 */

/**
 * @todo - change newsmag posts navigation to default WordPress
 * @param array $args
 */
function newsmag_the_posts_navigation( $args = array() ) {
	echo get_the_posts_navigation( $args );
}

/**
 * @deprecated, please use Newsmag_Helper::posted_on(); instead
 */
function newsmag_posted_on( $element = 'default' ) {
	Newsmag_Helper::posted_on( $element );
}

/**
 * @deprecated, please use Newsmag_Helper::add_breadcrumbs(); instead
 */
function newsmag_breadcrumbs() {
	Newsmag_Helper::add_breadcrumbs();
}

/**
 * @param $url
 *
 * @return int
 * @deprecated, please use Newsmag_Helper::get_attachment_id(); instead;
 */
function newsmag_get_attachment_id( $url ) {
	return Newsmag_Helper::get_attachment_id( $url );
}

/**
 * @param string $format
 *
 * @deprecated, please use Newsmag_Helper::format_icon(); instead
 */
function newsmag_format_icon( $format = 'standard' ) {
	echo Newsmag_Helper::format_icon( $format );
}

/**
 * @return bool
 *
 * @deprecated, please use Newsmag_Helpper::on_iis(); instead
 */
function newsmag_on_iis() {
	return Newsmag_Helper::on_iis();
}
