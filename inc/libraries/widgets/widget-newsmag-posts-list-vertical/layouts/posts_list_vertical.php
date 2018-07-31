<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( $posts->have_posts() ) : ?>
	<div class="newsmag-post-list-vertical-row">
		<?php
		$id_obj = get_category_by_slug( $instance['newsmag_category'] );
		?>
		<h2>
			<?php
			if ( ! empty( $instance['title'] ) ) {
				?>
				<span><?php echo esc_html( $instance['title'] ); ?></span>
				<?php
			} else {
				?>
				<a href="<?php echo esc_url( get_category_link( $id_obj->term_id ) ); ?>">
					<?php echo ( empty( $instance['title'] ) && false !== $id_obj ) ? esc_html( $id_obj->name ) : esc_html( $instance['title'] ); ?>
				</a>
			<?php } ?>
		</h2>
		<?php
		while ( $posts->have_posts() ) :
			$posts->the_post();
			$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . esc_url( get_template_directory_uri() . '/assets/images/picture_placeholder.jpg' ) . ' " />';
			if ( has_post_thumbnail() ) {
				$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-vertical-post' );
			}

			$image_obj = array(
				'id'    => get_the_ID(),
				'image' => $image,
			);
			$image     = Newsmag_Helper::get_lazy_image( $image_obj );

			$cat = get_the_category();
			?>

			<div class="newsmag-blog-post-layout-b wide-layout">
				<div class="row">
					<div class="col-sm-5 col-xs-12">
						<div class="newsmag-image">
							<a href="<?php echo esc_url( get_the_permalink() ); ?>">
								<?php echo $image['image']; ?>
							</a>
							<span class="newsmag-post-box-category">
							<a href="<?php echo esc_url_raw( get_category_link( $cat[0] ) ); ?>">
								<?php echo esc_html( $cat[0]->name ); ?>
							</a>
						</span>
						</div>
					</div>
					<div class="col-sm-7 col-xs-12">
						<div class="newsmag-title">
							<h3>
								<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo wp_trim_words( get_the_title(), 15 ); ?></a>
							</h3>
							<div class="meta">
								<span class="nmicon-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
								<?php Newsmag_Helper::posted_on( 'comments' ); ?>
								<?php if ( current_user_can( 'manage_options' ) ) { ?>
									<a class="newsmag-comments-link " target="_blank" href="<?php echo get_admin_url() . 'post.php?post=' . get_the_ID() . '&action=edit'; ?>">
										<span class="nmicon-edit"></span> <?php echo __( 'Edit', 'newsmag' ); ?>
									</a>
								<?php } ?>
							</div>
							<?php
							$excerpt = get_the_excerpt();
							$length  = (int) get_theme_mod( 'newsmag_excerpt_length', 25 );
							?>
							<p>
								<?php echo wp_kses_post( wp_trim_words( strip_shortcodes( $excerpt ), $length ) ); ?>
							</p>
						</div>
					</div>
				</div>
			</div>

		<?php endwhile; ?>
	</div>
<?php
endif;
