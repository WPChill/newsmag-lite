<?php
/**
 * Template part for displaying the news ticker
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

$cats = get_theme_mod( 'newsmag_recent_posts_category', array( '1' ) );
$args = array(
	'numberposts' => 10,
	'orderby'     => 'date',
	'order'       => 'DESC',
	'post_type'   => 'post',
	'post_status' => 'publish',
);

$recent_posts = wp_get_recent_posts( $args, OBJECT );
wp_reset_postdata();
if ( ! $recent_posts ) {
	return false;
}
?>
<div class="top-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- News Ticker Module -->
				<div class="newsmag-news-ticker">
					<span class="newsmag-module-title"><icon
							class="fa fa-clock-o"></icon> <?php echo __( 'Latest News', 'newsmag' ) ?></span>
					<ul class="newsmag-news-carousel owl-carousel owl-theme">
						<?php foreach ( $recent_posts as $post ) { ?>
							<li class="item">
								<a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo wp_trim_words( $post->post_title, 12 ); ?></a>
							</li>
						<?php } ?>
					</ul>
				</div>

			</div>
		</div>
	</div>
</div>

