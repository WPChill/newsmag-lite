<?php
wp_enqueue_script( 'owlCarousel-js' );
// owlCarousel Stylesheet
wp_enqueue_style( 'owlCarousel-main-css' );
wp_enqueue_style( 'owlCarousel-theme-css' );
?>
<div class="widget newsmag_builder">
	<section class="primary-slider" role="slider">
		<div class="owl-carousel owl-theme newsmag-slider">
			<div class="item">
				<div class="item-image">
					<a href="#" class="u-photo">
						<?php echo '<img src="' . get_stylesheet_directory_uri() . '/images/banner-placeholder.jpg"/>'; ?>
					</a>
					<div class="slider-caption hidden-xs">
						<h3 class="entry-title">
							<a href="#"
							   class="u-url">Lorem Ipsum Dolor Sit Amet</a>
						</h3>
						<ul class="post-categories">
							<li><a href="#" rel="category tag">Featured</a></li>
						</ul>
					</div> <!-- end caption -->
				</div> <!-- end image -->
			</div> <!-- end h-entry -->
			<div class="item">
				<div class="item-image">
					<a href="#" class="u-photo">
						<?php echo '<img src="' . get_stylesheet_directory_uri() . '/images/banner-placeholder.jpg"/>'; ?>
					</a>
					<div class="slider-caption hidden-xs">
						<h3 class="entry-title">
							<a href="#"
							   class="u-url">Lorem Ipsum Dolor Sit Amet</a>
						</h3>
						<ul class="post-categories">
							<li><a href="#" rel="category tag">Hot</a></li>
						</ul>
					</div> <!-- end caption -->
				</div> <!-- end image -->
			</div> <!-- end h-entry -->
		</div> <!-- end slider swipe -->
	</section>
</div>