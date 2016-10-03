<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'newsmag-blog-post-layout' ); ?>>
	<?php
	$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . esc_url( get_template_directory_uri() . '/images/picture_placeholder.jpg' ) . '" />';
	if ( has_post_thumbnail() ) {
		$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
	}
	$new_image = $image; ?>
	<div class="row">
		<div class="col-sm-4 col-xs-12">
			<div class="newsmag-image">
				<a href=" <?php echo esc_url( get_the_permalink() ); ?>">
					<?php echo $new_image ?>
				</a>
			</div>
		</div>
		<div class="col-sm-8 col-xs-12">
			<div class="newsmag-title">
				<h3>
					<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
				</h3>
				<span class="colored fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
			</div>
			<div class="newsmag-content">
				<?php is_single() ? the_content() : the_excerpt(); ?>
				<span class="newsmag-categories"><?php esc_html(the_category( ', ' )) ?></span>
			</div>
		</div>
	</div>

</article><!-- #post-## -->
