<?php

class Widget_Newsmag_PopularPosts extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'newsmag-popular-posts-widget',
			__( 'Newsmag - Popular Posts', 'newsmag' ),
			array(
				'description'                 => __( 'Displays posts with most comments.', 'newsmag' ),
				'classname'                   => 'popular-posts',
				'customize_selective_refresh' => true
			)
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$number            = empty( $number ) ? 5 : $number;
		$instance['title'] = empty( $instance['title'] ) ? __( 'Popular posts', 'newsmag' ) : $instance['title'];

		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$r = new WP_Query( array( 'posts_per_page' => $number, 'offset' => 0, 'orderby' => 'comment_count' ) );

		if ( $r->have_posts() ) :
			?>
			<?php echo $before_widget; ?>
			<?php echo $before_title . $title . $after_title; ?>

			<ul class="posts-list">
				<?php while ( $r->have_posts() ) : $r->the_post();
					$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/picture_placeholder_list.jpg" />';
					if ( has_post_thumbnail() ) {
						$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-list-image' );
					}
					$image_obj    = array( 'id' => get_the_ID(), 'image' => $image );
					$new_image    = apply_filters( 'newsmag_widget_image', $image_obj );
					$allowed_tags = array(
						'img'      => array(
							'data-srcset' => true,
							'data-src'    => true,
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
					?>
					<li>
						<a class="newsmag-image" href="<?php the_permalink() ?>">
							<?php echo wp_kses( $new_image, $allowed_tags ); ?>
						</a>
						<div class="content">

							<a href="<?php the_permalink(); ?>"
							   title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>">
								<?php if ( get_the_title() ) {
									the_title();
								} else {
									the_ID();
								} ?></a>
							<div class="meta">
								<span class="fa fa-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
							</div>
						</div>

					</li>
				<?php endwhile; ?>
			</ul>

			<?php echo $after_widget; ?>

			<?php
			// reset global data
			wp_reset_postdata();

		endif;
	}

	public function update( $new, $old ) {
		$new['title']  = strip_tags( $new['title'] );
		$new['number'] = intval( $new['number'] );

		return $new;
	}

	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<p><label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'newsmag' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'newsmag' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $number ); ?>"
			       size="3"/>
		</p>
		<?php
	}

}