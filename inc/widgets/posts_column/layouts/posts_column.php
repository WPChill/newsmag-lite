<?php
if ( $posts->have_posts() ):

	$i = 0; ?>
	<div class="col-md-4 newsmag-blog-post-layout-row">
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php $category = get_the_category(); ?>

			<?php if ( $i == 0 ) {
				if ( ! empty( $instance['title'] ) ) { ?>
					<h2><span><?php echo esc_html( $instance['title'] ); ?></span></h2>
				<?php } else { ?>
					<h2>
						<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ) ?>"><?php echo esc_html( $category[0]->name ) ?></a>
					</h2>
				<?php }
			}

			$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . esc_url_raw( get_template_directory_uri() . '/assets/images/picture_placeholder_list.jpg' ) . '" />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-list-image' );
			}
			?>
			<div class="newsmag-blog-post-layout-b">
				<div class="row">
					<div class="col-sm-3 col-xs-4">
						<div class="newsmag-image">
							<a href=" <?php echo esc_url( get_the_permalink() ); ?>">
								<?php echo wp_kses_post( $image ) ?>
							</a>
						</div>
					</div>
					<div class="col-sm-9 col-xs-8">
						<div class="newsmag-title">
							<h3>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a>
							</h3>
							<?php if ( $instance['show_date'] === 'on' ): ?>
								<span class="colored fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php $i ++;
		endwhile; ?>
	</div>
<?php endif; ?>