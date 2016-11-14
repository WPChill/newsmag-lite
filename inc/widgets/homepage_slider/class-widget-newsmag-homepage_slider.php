<?php

class Widget_Newsmag_homepage_slider extends WP_Widget {

	function __construct() {

		parent::__construct( 'newsmag_slider_widget', __( 'Newsmag - Homepage Slider', 'newsmag' ), array(
			'classname'   => 'newsmag_slider',
			'description' => __( 'You can add a fullwidth slider with this widget.', 'newsmag' ),
			'customize_selective_refresh' => true
		) );
	}

	public function form( $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = 'Today’s hot topics';
		}

		if ( ! empty( $instance['newsmag_category'] ) ) {
			$newsmag_category = $instance['newsmag_category'];
		} else {
			$instance['newsmag_category'] = '';
		}

		?>
		<p>
			<label><?php _e( 'Headline', 'newsmag' ); ?> </label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label><?php _e( 'Category', 'newsmag' ); ?> </label>
			<select name="<?php echo $this->get_field_name( 'newsmag_category' ); ?>"
			        id="<?php echo $this->get_field_id( 'newsmag_category' ); ?>">
				<option value="" <?php if ( empty( $instance['newsmag_category'] ) ) {
					echo 'selected="selected"';
				} ?>><?php _e( '&ndash; Select a category &ndash;', 'newsmag' ) ?></option>
				<?php
				$categories = get_categories( 'hide_empty=0' );
				foreach ( $categories as $category ) { ?>
					<option
						value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( esc_attr( $category->slug ), $instance['newsmag_category'] ); ?>><?php echo esc_html( $category->cat_name ); ?></option>
				<?php } ?>
			</select>
		</p>

	<?php }

	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['newsmag_category'] = ( ! empty( $new_instance['newsmag_category'] ) ) ? $new_instance['newsmag_category'] : '';

		return $instance;

	}

	/**
	 * Proxy function to return posts
	 *
	 * @param $args
	 *
	 * @return WP_Query
	 */
	public function get_posts( $args ) {
		$idObj = get_category_by_slug( $args['newsmag_category'] );
		$atts  = array(
			'posts_per_page' => 2,
		);

		if ( $idObj ) {
			$id          = $idObj->term_id;
			$atts['cat'] = $id;
		}

		$posts = new WP_Query( $atts );

		wp_reset_postdata();

		return $posts;
	}

	public function widget( $args, $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = 'Today’s hot topics';
		}

		if ( ! empty( $instance['newsmag_category'] ) ) {
			$newsmag_category = $instance['newsmag_category'];
		} else {
			$instance['newsmag_category'] = 'uncategorized';
		}

		extract( $args, EXTR_SKIP );

		echo $before_widget;
		$filepath = get_template_directory() . '/inc/widgets/homepage_slider/layouts/slider.php';

		$posts = $this->get_posts( $instance );

		if ( file_exists( $filepath ) ) {
			include $filepath;
		} else {
			echo _e( 'Please configure your widget', 'newsmag' );
		}

		wp_reset_query();
		echo $after_widget;

	}

}