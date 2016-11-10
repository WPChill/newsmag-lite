<?php
/**
 * Newsmag functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsmag
 */

/**
 * Setup theme
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Enqueue styles and scripts
 */
require get_template_directory() . '/inc/enqueues.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load the system checks ( used for notifications )
 */
require get_template_directory() . '/inc/notify-system-checks.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load breadcrumbs
 */
require get_template_directory() . '/inc/components/breadcrumbs/class-newsmag-breadcrumbs.php';

/**
 * Load lazyload
 */
require get_template_directory() . '/inc/components/lazyload/class-newsmag-lazyload.php';

/**
 * Typography
 */
require get_template_directory() . '/inc/class-epsilon-typography.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Sidebars
 */
require get_template_directory() . '/inc/sidebars.php';