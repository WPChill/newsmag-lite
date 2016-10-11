<?php if ( $posts->have_posts() ): $i = 0; ?>

	<div class="newsmag-margin-top">
		<div class="col-md-12">
			<?php if ( ! empty( $instance['title'] ) ) { ?>
				<h2 class="colored"><?php echo esc_html( $instance['title'] ); ?></h2>
			<?php } else { ?>
				<h2 class="colored"><?php echo esc_html( get_category_by_slug( $instance['newsmag_category'] )->name ) ?></h2>
			<?php } ?>
		</div>
		<?php while ( $posts->have_posts() ) : $posts->the_post();
			$i ++;

			$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . esc_url( get_template_directory_uri() . '/assets/images/picture_placeholder.jpg' ) . '" />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
			}
			?>

			<div class="col-md-3 col-sm-6">
				<div class="newsmag-post-box-a thumbnail-layout">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>">
						<?php echo wp_kses_post( $image ) ?>
					</a>
					<h3>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
					</h3>
					<div class="date"><span
							class="colored fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?></div>
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

