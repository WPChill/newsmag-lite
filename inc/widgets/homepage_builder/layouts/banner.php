<?php
if ( $posts->have_posts() ):?>
	<?php echo ( $posts->post_count > 4 ) ? '<div class="col-md-12">' : '<div class="col-md-8">' ?>
	<div class="row newsmag-margin-bottom post-banner-row">
		<?php if ( ! empty( $instance['title'] ) ) { ?>
			<h2 class="colored"><?php echo esc_html($instance['title']); ?></h2>
		<?php } else { ?>
			<h2 class="colored"><?php the_category() ?></h2>
		<?php } ?>
		<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
			<?php
			$image = get_template_directory_uri() . '/assets/images/picture_placeholder.jpg';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail_url( get_the_ID(), 'newsmag-recent-post-big' );
			}
			?>

			<div class="newsmag-blog-post-layout-banner <?php echo ( $posts->post_count > 4 ) ? 'col-md-3' : 'col-md-6' ?>"
				style="background-image:url('<?php echo esc_url( $image ) ?>')">
				<div class="banner-content">
					<h3>
						<a href="<?php echo esc_url_raw( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
					</h3>
					<span class="date"><?php echo esc_html( get_the_date() ); ?></span>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	</div>
<?php endif;