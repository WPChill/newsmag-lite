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

	<div class="col-xs-12">
		<div class="newsmag-title">
			<h3>
				<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
			</h3>
			<span class="colored fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>

		</div>
		<div class="newsmag-content entry-content">
			<?php the_content() ?>
			<span class="newsmag-categories"><?php the_category( ', ' ) ?></span>

		</div>
	</div>

</article><!-- #post-## -->
