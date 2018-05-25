<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'newsmag-single-page-layout' ); ?>>

	<div class="col-xs-12">
		<div class="newsmag-content entry-content">
			<?php the_content(); ?> 
		</div>
	</div>

</article><!-- #post-## -->
