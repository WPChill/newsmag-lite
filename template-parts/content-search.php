<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php newsmag_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php
		$excerpt = get_the_excerpt();
		$length  = (int) get_theme_mod( 'newsmag_excerpt_length', 25 );
		?>
		<p>
			<?php echo wp_kses_post( wp_trim_words( $excerpt, $length ) ); ?>
		</p>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
