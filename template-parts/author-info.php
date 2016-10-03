<?php
/**
 * Template part for displaying author info.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */
$social_media = array(
	'twitter_profile',
	'facebook_profile',
	'google-plus_profile',
	'linkedin_profile',
	'dribbble_profile',
	'github_profile',
	'pinterest_profile',
	'tumblr_profile',
	'youtube_profile',
	'flickr_profile',
	'vimeo_profile',
	'instagram_profile',
	'codepen_profile',
);

$filtered = array();
foreach ( $social_media as $social_link ) {
	if ( ! empty( get_the_author_meta( $social_link ) ) ) {
		$filtered[ $social_link ] = get_the_author_meta( $social_link );
	}
}

// Grab the current author
$curauth = get_userdata( $post->post_author );

if ( is_single() && ! empty( $curauth->description ) ) { ?>
	<!-- Author description -->
	<div class="author-description" itemscope="" itemtype="http://schema.org/Person">

		<!-- Avatar -->
		<?php echo get_avatar( get_the_author_meta( 'ID' ), 70 ); ?>
		<!-- .Avatar -->

		<!-- Short Description -->
		<h4 class="post-author"><?php echo get_the_author_posts_link(); ?></h4>
		<p><?php the_author_meta( 'description' ); ?></p>
		<ul class="social-links">
			<?php foreach ( $filtered as $key => $val ): ?>
				<li><a href="<?php echo esc_url( $val ) ?>"><span class="fa fa-<?php echo str_replace('_profile', '', $key) ?>"></span></a></li>
			<?php endforeach; ?>
		</ul>
		<!-- .Short Description -->
	</div>
	<!-- .Author description -->
<?php } ?>