<?php
if ( $posts->have_posts() ): ?>
	<div class="col-md-4">
		<?php if ( ! empty( $instance['title'] ) ) { ?>
			<h2 class="colored"><?php echo esc_html( $instance['title'] ); ?></h2>
		<?php } else { ?>
			<h2 class="colored"><?php echo esc_html( get_category_by_slug( $instance['newsmag_category'] )->name ) ?></h2>
		<?php } ?>

		<?php
		while ( $posts->have_posts() ) : $posts->the_post();
			$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . esc_url( get_template_directory_uri() . '/assets/images/picture_placeholder.jpg' ) . ' " />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-big' );
			}
			?>

			<div class="newsmag-blog-post-layout-b">
				<div class="row">
					<div class="col-sm-5 col-xs-12">
						<div class="newsmag-image">
							<a href="<?php echo get_the_permalink(); ?>">
								<?php echo wp_kses_post( $image ) ?>
							</a>
						</div>
					</div>
					<div class="col-sm-7 col-xs-12">
						<div class="newsmag-title">
							<h4>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a>
							</h4>
						</div>
					</div>
				</div>
			</div>

		<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php wp_reset_query();