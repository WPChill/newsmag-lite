<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
?>
<section class="primary-slider" role="slider">
	<div class="owl-carousel owl-theme newsmag-slider">
		<?php

		$owl_nav_list = array();

		if ( $posts->have_posts() ) :
			while ( $posts->have_posts() ) :
				$posts->the_post();

				?>
				<div class="item">
				<div class="item-image">
					<a href="<?php the_permalink(); ?>" tabindex="-1">
						<?php

						if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'newsmag-slider-image' );
						} else {
							echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/banner-placeholder.jpg' ) . '"/>';
						}

							?>
						</a>
						<div class="slider-caption">

							<?php

							$category = get_the_category();

							$name     = $category[0]->cat_name;
							$cat_id   = get_cat_ID( $name );
							$link     = get_category_link( $cat_id );
							$link_src = '<a href="' . esc_url( $link ) . '">' . $name . '</a>';
							$date     = get_the_date();

							?>

							<div class="slide-meta">
							<span class="category"><?php echo $link_src; ?></span>
							<span
								class="ticker"><strong><?php echo esc_html( $date ); ?></strong>&nbsp; - &nbsp;<strong>by</strong> <?php the_author(); ?></span>
						</div>

						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<?php $owl_nav_list[] = get_the_title(); ?>

						</div> <!-- end caption -->
					</div> <!-- end image -->
				</div> <!-- end h-entry -->
			<?php endwhile; ?>
	</div> <!-- end slider swipe -->

	<!-- article navigation list -->
	<div class="owl-nav-list hidden-xs hidden-sm">
		<?php if ( empty( $instance['title'] ) ) { ?>
			<h4><?php esc_html_e( 'Today’s  hot  topics', 'newsmag' ); ?></h4>
		<?php } else { ?>
			<h4><?php echo esc_html( $instance['title'] ); ?></h4>
		<?php } ?>
		<ul>
			<?php

			foreach ( $owl_nav_list as $title_index => $title_value ) {
				$title_str = $title_index;

				if ( $title_index < 10 ) {
					$title_str = '0' . ( $title_index + 1 );
				}

				if ( 0 == $title_index ) {
					echo '<li class="active"><span>' . $title_str . '</span><a href="#">' . $title_value . '</a></li>';
				} else {
					echo '<li><span>' . $title_str . '</span><a href="#">' . $title_value . '</a></li>';
				}
			}

			?>
		</ul>
	</div>
	<!-- end article navigation list -->
	<?php endif; ?>
</section>
