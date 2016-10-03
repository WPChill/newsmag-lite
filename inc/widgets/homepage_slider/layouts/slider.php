<?php
wp_enqueue_script( 'owlCarousel-js' );
// owlCarousel Stylesheet
wp_enqueue_style( 'owlCarousel-main-css' );
wp_enqueue_style( 'owlCarousel-theme-css' );
?>
<section class="primary-slider" role="slider">
	<div class="owl-carousel owl-theme newsmag-slider">
		<?php
		if ( $posts->have_posts() ):
			while ( $posts->have_posts() ): $posts->the_post(); ?>
				<div class="item">
					<div class="item-image">
						<a href="<?php the_permalink(); ?>" class="u-photo">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'newsmag-slider-image' );
							} else {
								echo '<img src="' . get_stylesheet_directory_uri() . '/images/banner-placeholder.jpg"/>';
							}
							?>
						</a>
						<div class="slider-caption hidden-xs">
							<h3 class="entry-title">
								<a href="<?php the_permalink(); ?>"
								   class="u-url"><?php the_title(); ?></a>
							</h3>
							<?php the_category() ?>
						</div> <!-- end caption -->
					</div> <!-- end image -->
				</div> <!-- end h-entry -->
			<?php endwhile; ?>
		<?php endif; ?>
	</div> <!-- end slider swipe -->
</section>