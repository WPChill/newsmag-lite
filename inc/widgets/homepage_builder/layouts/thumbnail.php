<?php if ( $posts->have_posts() ): $i = 0; ?>

	<div class="row newsmag-margin-top">
		<div class="col-md-12">
			<?php if ( ! empty( $instance['title'] ) ) { ?>
				<h2 class="colored"><?php echo $instance['title']; ?></h2>
			<?php } else { ?>
				<h2 class="colored"><?php echo get_category_by_slug($instance['newsmag_category'])->name ?></h2>
			<?php } ?>
		</div>
		<?php while ( $posts->have_posts() ) : $posts->the_post();
			$i ++;

			$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/images/picture_placeholder.jpg" />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
			}
			$new_image = apply_filters( 'newsmag_widget_image', $image ); ?>

			<div class="col-md-3 col-sm-6">
				<div class="newsmag-post-box-a">
					<a href="<?php echo get_the_permalink(); ?>">
						<?php echo $new_image ?>
					</a>
					<h3>
						<a href="<?php echo get_the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
					</h3>
					<span class="colored fa fa-clock-o"></span> <?php echo get_the_date(); ?>
				</div>
			</div>
			<?php

			if ( fmod( $i, 4 ) == 0 && $i != (int) $posts->post_count ) {
				echo '</div><div class="row">';
			} elseif ( $i == (int) $posts->post_count ) {
				continue;
			}

		endwhile; ?>
	</div>
<?php endif; ?>

