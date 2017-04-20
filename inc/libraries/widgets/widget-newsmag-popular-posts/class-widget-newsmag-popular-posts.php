<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Widget_Newsmag_Popular_Posts extends WP_Widget {
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
		$defaults = array(
			'title'  => __( 'Popular posts', 'newsmag' ),
			'number' => 5,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$instance['title'] = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		$r = new WP_Query( array(
			                   'posts_per_page' => $instance['number'],
			                   'offset'         => 0,
			                   'orderby'        => 'comment_count'
		                   ) );

		wp_reset_postdata();
		if ( $r->have_posts() ) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php echo $args['before_title'] . $instance['title'] . $args['after_title']; ?>

            <ul class="posts-list">
				<?php while ( $r->have_posts() ) : $r->the_post();
					$image = '<img class="attachment-newsmag-recent-post-big size-newsmag-recent-post-big wp-post-image" alt="" src="' . get_template_directory_uri() . '/assets/images/picture_placeholder_list.jpg" />';
					if ( has_post_thumbnail() ) {
						$image = get_the_post_thumbnail( get_the_ID(), 'newsmag-recent-post-list-image' );
					}
					$image_obj = array( 'id' => get_the_ID(), 'image' => $image );
					$image     = Newsmag_Helper::get_lazy_image( $image_obj );
					?>
                    <li>
                        <a class="newsmag-image" href="<?php the_permalink() ?>">
							<?php echo wp_kses( $image['image'], $image['tags'] ); ?>
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
                                <span class="nmicon-clock-o"></span> <?php echo esc_html( get_the_date() ); ?>
                            </div>
                        </div>

                    </li>
				<?php endwhile; ?>
            </ul>

			<?php echo $args['after_widget']; ?>

			<?php
		endif;
	}

	public function update( $new, $old ) {
		$instance = array(
			'title'  => ! empty( $new['title'] ) ? strip_tags( $new['title'] ) : '',
			'number' => ! empty( $new['show_post'] ) ? absint( $new['number'] ) : '',
		);

		return $instance;
	}

	public function form( $instance ) {
		$defaults = array(
			'title'  => __( 'Popular posts', 'newsmag' ),
			'number' => 5,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
        <p><label
                    for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'newsmag' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['title'] ); ?>"/>
        </p>

        <p>
            <label
                    for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php _e( 'Number of posts to show:', 'newsmag' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['number'] ); ?>"
                   size="3"/>
        </p>
		<?php
	}

}