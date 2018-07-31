<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( $posts->have_posts() ) :

	$i = 0; ?>
	<div class="newsmag-blog-post-layout-row">
		<?php
		while ( $posts->have_posts() ) :
			$posts->the_post();
?>
			<?php $category = get_the_category(); ?>

			<?php if ( 0 == $i ) { ?>
				<h2>
					<?php
					if ( ! empty( $instance['title'] ) ) {
						?>
						<span><?php echo esc_html( $instance['title'] ); ?></span>
						<?php
					} else {
						?>
						<a href="<?php echo esc_url( get_category_link( $category[0]->term_id ) ); ?>">
							<?php echo empty( $instance['title'] ) ? esc_html( $category[0]->name ) : esc_html( $instance['title'] ); ?>
						</a>
					<?php } ?>
				</h2>
			<?php
}

			$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/picture_placeholder_list.jpg" />';
if ( has_post_thumbnail() ) {
	$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-list-image' );
}
			$image_obj = array(
				'id'    => get_the_ID(),
				'image' => $image,
			);
			$image     = Newsmag_Helper::get_lazy_image( $image_obj );

			?>
			<div class="newsmag-blog-post-layout-b">
				<div class="row">
					<div class="col-sm-3 col-xs-4">
						<div class="newsmag-image">
							<a href=" <?php echo esc_url( get_the_permalink() ); ?>">
								<?php echo wp_kses( $image['image'], $image['tags'] ); ?>
							</a>
						</div>
					</div>
					<div class="col-sm-9 col-xs-8">
						<div class="newsmag-title">
							<h3>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a>
							</h3>
							<div class="meta">
								<?php if ( 'on' === $instance['show_date'] ) : ?>
									<span class="nmicon-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
									<?php Newsmag_Helper::posted_on( 'comments' ); ?>
								<?php endif; ?>
								<?php if ( current_user_can( 'manage_options' ) ) { ?>
									<a class="newsmag-comments-link " target="_blank" href="<?php echo get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit'; ?>">
										<span class="nmicon-edit"></span> <?php echo __( 'Edit', 'newsmag' ); ?>
									</a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$i ++;
		endwhile;
		?>
	</div>
<?php endif; ?>
