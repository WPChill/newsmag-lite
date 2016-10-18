<?php
if ( $posts->have_posts() ): ?>
	<?php echo ( $posts->post_count > 4 ) ? '<div class="col-md-12">' : '<div class="col-md-8">' ?>
	<div class="row newsmag-margin-bottom newsmag-post-banner-row">
		<?php
		$idObj = get_category_by_slug( $instance['newsmag_category'] );
		?>
		<h2>
			<a href="<?php echo esc_url( get_category_link( $idObj->term_id ) ) ?>">
				<?php echo empty( $instance['title'] ) ? esc_html( $idObj->name ) : esc_html( $instance['title'] ); ?>
			</a>
		</h2>
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
					<span class="meta"><span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?> <?php newsmag_posted_on('comments'); ?></span>

				</div>
			</div>
		<?php endwhile; ?>
	</div>
	</div>
<?php endif;