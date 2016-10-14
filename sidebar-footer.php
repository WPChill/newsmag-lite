<?php
/**
 * The footer widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Newsmag
 */

/**
 * The defined sidebars
 */
$mysidebars = array(
	'footer-1',
	'footer-2',
	'footer-3',
	'footer-4'
);

/**
 * We create an empty array that will keep which one of them has any active sidebars
 */
$sidebars = array();
foreach ( $mysidebars as $column ) {
	if ( is_active_sidebar( $column ) ) {
		$sidebars[] = $column;
	}
};

/**
 * If the array is empty, terminate here
 */
if ( empty( $sidebars ) ) {
	$args = array(
		'before_title' => '<h3 class="widget-title">',
		'after_title'  => '</h3>'
	); ?>
	<div class="footer-widgets-area">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<?php the_widget( 'WP_Widget_Meta', array(), $args ); ?>
				</div>
				<div class="col-md-3">
					<?php the_widget( 'WP_Widget_Recent_Posts', array(), $args ); ?>
				</div>
				<div class="col-md-3">
					<?php the_widget( 'WP_Widget_Tag_Cloud', array(), $args ); ?>
				</div>
				<div class="col-md-3">
					<?php the_widget( 'WP_Widget_Categories', array(), $args ); ?>
				</div>
			</div>
		</div>
	</div>

	<?php return false;
}

/**
 * Handle the sizing of the footer columns based on the user selection
 */
$count = get_theme_mod( 'newsmag_footer_columns', 4 );
/**
 * Size can be set dynamically as well by counting the array elements
 * $size = 12 / count($sidebars);
 */
$size = 12 / (int) $count;
/**
 * In case all the sidebars have widgets attached, we slice the array it.
 */
$sidebars = array_slice( $sidebars, 0, $count );
?>
<div class="footer-widgets-area">
	<div class="container">
		<div class="row">
			<?php foreach ( $sidebars as $sidebar ): ?>
				<div class="col-md-<?php echo esc_attr( $size ) ?> col-sm-6">
					<?php dynamic_sidebar( $sidebar ); ?>
				</div>
			<?php endforeach; ?>
		</div><!--.row-->
	</div>
</div>