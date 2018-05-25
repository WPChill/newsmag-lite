<?php
/**
 * Template part for displaying author info.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

// Grab the current author
$curauth = get_userdata( $post->post_author );

if ( is_single() ) { ?>
	<!-- Author description -->
	<div class="author-description p-author h-card vcard" itemscope="" itemtype="http://schema.org/Person">

		<!-- Avatar -->
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
		<!-- .Avatar -->
		<!-- Short Description -->
		<h4 class="post-author p-name fn" rel="author"><?php echo get_the_author_posts_link(); ?></h4>
		<?php if ( ! empty( $curauth->description ) ) : ?>
			<p class="p-note"><?php esc_html( the_author_meta( 'description' ) ); ?></p>
		<?php endif; ?>
		<!-- .Short Description -->
	</div>
	<!-- .Author description -->
<?php } ?>
