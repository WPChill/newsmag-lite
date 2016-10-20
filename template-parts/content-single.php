<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */
// Grab the current author
$curauth             = get_userdata( $post->post_author );
$breadcrumbs_enabled = get_theme_mod( 'newsmag_enable_post_breadcrumbs', true );
?>
<div class="row newsmag-article-post <?php echo $breadcrumbs_enabled ? '' : 'newsmag-margin-top' ?> ">
	<?php if ( get_theme_mod( 'newsmag_enable_author_box', true ) && ! empty( $curauth->description ) ): ?>
		<div class="col-md-3">
			<?php
			// Include author information
			get_template_part( 'template-parts/author-info' );
			?>
		</div>
	<?php endif; ?>
	<div
		class="<?php echo ( get_theme_mod( 'newsmag_enable_author_box', true ) && ! empty( $curauth->description ) ) ? 'col-md-9' : 'col-md-12'; ?>">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( ! is_single() ): ?>
				<header class="entry-header">

					<div class="newsmag-image">
						<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'newsmag-recent-post-big' );
						} else {
							echo '<img src=' . esc_url( get_template_directory_uri() . '/assets/images/picture_placeholder.jpg' ) . '" />';
						}
						?>
					</div>
					<?php
					if ( ! is_single() ) {
						echo '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . wp_trim_words( get_the_title(), 8 ) . '</a></h4>';
					}
					?>
				</header><!-- .entry-header -->
			<?php endif; ?>
			<div class="entry-content">
				<div class="newsmag-post-meta">
					<?php newsmag_posted_on( 'date' ); ?>
				</div><!-- .entry-meta -->
				<?php if ( is_single() ) {
					the_content();
				} else {
					$excerpt = get_the_excerpt();
					$length  = (int) get_theme_mod( 'newsmag_excerpt_length', 25 );
					?>
					<p>
						<?php echo wp_kses_post( wp_trim_words( $excerpt, $length ) ); ?>
					</p>
				<?php }

				wp_link_pages( array(
					               'before' => '<ul class="newsmag-pager">',
					               'after'  => '</ul>',
				               ) );

				$prev = get_previous_post_link();
				$prev = str_replace( '&laquo;', '<div class="wrapper"><span class="fa fa-angle-left"></span>', $prev );
				$prev = str_replace( '</a>', '</a></div>', $prev );
				$next = get_next_post_link();
				$next = str_replace( '&raquo;', '<span class="fa fa-angle-right"></span></div>', $next );
				$next = str_replace( '<a', '<div class="wrapper"><a', $next );
				?>
				<div class="newsmag-next-prev row">
					<div class="col-md-6 text-left">
						<?php echo wp_kses_post( $prev ) ?>
					</div>
					<div class="col-md-6 text-right">
						<?php echo wp_kses_post( $next ) ?>
					</div>
				</div>
				<?php
				?>
			</div>
		</article><!-- #post-## -->
	</div>
</div>
<div class="row newsmag-article-post-footer">
	<div class="col-md-12">
		<?php
		$tags_enabled = get_theme_mod( 'newsmag_show_single_post_tags', true );
		$has_tag      = has_tag();
		if ( $tags_enabled && $has_tag ): ?>
			<footer class="entry-footer">
				<?php
				if ( 'post' === get_post_type() ) : ?>
					<div class="newsmag-post-meta">
						<?php newsmag_posted_on( 'tags' ); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</footer><!-- .entry-footer -->

		<?php endif; ?>
		<?php do_action( 'newsmag_single_after_article' ); ?>

	</div>
</div>

