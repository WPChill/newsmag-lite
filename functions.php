<?php
/**
 * Newsmag functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsmag
 */

/**
 * Start Newsmag theme framework
 */
require_once dirname( __FILE__ ) . '/inc/class-newsmag-autoloader.php';

$newsmag = new Newsmag_Lite();

require_once dirname( __FILE__ ) . '/inc/newsmag-deprecated.php';
