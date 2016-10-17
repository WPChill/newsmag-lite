<?php
if ( $posts->have_posts() ):

	$i = 0; ?>
	<div class="col-md-4">
		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<?php $category = get_the_category();
			if ( $i == 0 ) {
				$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/picture_placeholder.jpg" />';
				if ( has_post_thumbnail() ) {
					$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
				}

				?>
				<div class="newsmag-post-box-a">
					<h2>
						<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ) ?>">
							<?php echo empty( $instance['title'] ) ? esc_html( $category[0]->name ) : esc_html( $instance['title'] ); ?>
						</a>
					</h2>
					<a class="newsmag-post-box-image" href="<?php echo esc_url( get_the_permalink() ); ?>">
						<?php echo wp_kses_post( $image ); ?>
						<span class="newsmag-post-box-a-category"><?php echo esc_html( $category[0]->name ) ?></span>
					</a>
					<h3>
						<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
					</h3>
					<?php if ( $instance['show_date'] === 'on' ): ?>
						<span class="colored fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
					<?php endif; ?>
					<p><?php echo wp_trim_words( get_the_content(), 20, ' <a href="' . esc_url( get_the_permalink() ) . '">…</a>' ) ?></p>
				</div>
				<?php
			} else {
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
									<span
										class="colored fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			$i ++; ?>
		<?php endwhile; ?>
	</div>
<?php endif; ?>