<?php
if ( $posts->have_posts() ): ?>
	<?php echo ( $posts->post_count > 4 ) ? '<div class="col-md-12">' : '<div class="col-md-8">' ?>
	<div class="row newsmag-margin-bottom newsmag-post-banner-row">
		<?php
		$idObj = get_category_by_slug( $instance['newsmag_category'] );
		?>
		<h2>
			<?php
			if ( ! empty( $instance['title'] ) ) {
				?>
				<span><?php echo esc_html( $instance['title'] ); ?></span>
				<?php
			} else {
				?>
				<a href="<?php echo esc_url( get_category_link( $idObj->term_id ) ) ?>">
					<?php echo ( empty( $instance['title'] ) && $idObj !== false ) ? esc_html( $idObj->name ) : esc_html( $instance['title'] ); ?>
				</a>
			<?php } ?>
		</h2>
		<?php while ( $posts->have_posts() ): $posts->the_post(); ?>
			<?php
			$image = '<img class="newsmag-post-grid-size" src="' . get_template_directory_uri() . '/assets/images/picture_placeholder.jpg" />';
			if ( has_post_thumbnail() ) {
				$size  = $posts->post_count > 4 ? 'newsmag-post-grid-small' : 'newsmag-post-grid';
				$image = get_the_post_thumbnail( get_the_ID(), $size );
			}
			$image_obj    = array( 'id' => get_the_ID(), 'image' => $image );
			$new_image    = apply_filters( 'newsmag_widget_image', $image_obj );
			$allowed_tags = array(
				'img'      => array(
					'data-src'    => true,
					'data-srcset' => true,
					'srcset'      => true,
					'sizes'       => true,
					'src'         => true,
					'class'       => true,
					'alt'         => true,
					'width'       => true,
					'height'      => true
				),
				'noscript' => array()
			);
			$category     = get_the_category();
			?>

			<div
				class="newsmag-blog-post-layout-banner <?php echo ( $posts->post_count > 4 ) ? 'col-md-3' : 'col-md-6' ?>">
				<a href="<?php echo esc_url_raw( get_the_permalink() ); ?>">
					<?php echo wp_kses( $new_image, $allowed_tags ); ?>
				</a>
				<div class="banner-content">
					<span class="newsmag-post-layout-category">
						<a href="<?php echo esc_url_raw( get_category_link( $category[0] ) ) ?>">
							<?php echo esc_html( $category[0]->name ) ?>
						</a>
					</span>
					<h3>
						<a href="<?php echo esc_url_raw( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 9 ); ?></a>
					</h3>
					<span class="meta">
						<span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
						<?php newsmag_posted_on( 'comments' ); ?>
						<?php if ( current_user_can( 'manage_options' ) ) { ?>
							<a class="newsmag-comments-link " target="_blank"
							   href="<?php echo get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit' ?>">
									<span class="fa fa-edit"></span> <?php echo __( 'Edit', 'newsmag' ) ?>
								</a>
						<?php } ?>
					</span>
				</div>
			</div>
		<?php endwhile; ?>
	</div>
	</div>
<?php endif;