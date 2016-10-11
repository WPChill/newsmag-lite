<?php

class Widget_Newsmag_Posts_Column extends WP_Widget {

	function __construct() {

		parent::__construct( 'newsmag_widget_posts_column', __( 'Newsmag - Posts Column', 'newsmag' ), array(
			'classname'   => 'newsmag_builder',
			'description' => __( 'You can customize your homepage by this widget. Don\'t use others.', 'newsmag' )
		) );
	}

	public function form( $instance ) {

		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		} else {
			$title = '';
		}

		if ( isset( $instance['newsmag_category'] ) ) {
			$newsmag_category = $instance['newsmag_category'];
		} else {
			$instance['newsmag_category'] = 'uncategorized';
		}

		if ( isset( $instance['show_post'] ) ) {
			$show_post = $instance['show_post'];
		} else {
			$instance['show_post'] = '';
		}

		?>
		<p>
		<label><?php _e( 'Title', 'newsmag' ); ?> :</label>
		<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
		       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
		<label><?php _e( 'Category', 'newsmag' ); ?> :</label>
		<select name="<?php echo esc_attr( $this->get_field_name( 'newsmag_category' ) ); ?>"
		        id="<?php echo esc_attr( $this->get_field_id( 'newsmag_category' ) ); ?>">
			<option value="" <?php if ( empty( $instance['newsmag_category'] ) ) {
				echo 'selected="selected"';
			} ?>><?php _e( '&ndash; Select a category &ndash;', 'newsmag' ) ?></option>
			<?php
			$categories = get_categories( 'hide_empty=0' );
			foreach ( $categories as $category ) { ?>
				<option
					value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( esc_attr( $category->slug ), $instance['newsmag_category'] ); ?>><?php echo esc_attr( $category->cat_name ); ?></option>
			<?php } ?>
		</select>
		</p>

		<p>
		<label><?php _e( 'Posts to Show', 'newsmag' ); ?> :</label>
		<select name="<?php echo esc_attr( $this->get_field_name( 'show_post' ) ); ?>"
		        id="<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>">
			<option value="2" <?php selected( 2, $instance['show_post'] ); ?>>2</option>
			<option value="3" <?php selected( 3, $instance['show_post'] ); ?>>3</option>
			<option value="4" <?php selected( 4, $instance['show_post'] ); ?>>4</option>
			<option value="5" <?php selected( 5, $instance['show_post'] ); ?>>5</option>
			<option value="6" <?php selected( 6, $instance['show_post'] ); ?>>6</option>
			<option value="7" <?php selected( 7, $instance['show_post'] ); ?>>7</option>
			<option value="8" <?php selected( 8, $instance['show_post'] ); ?>>8</option>
			<option value="9" <?php selected( 9, $instance['show_post'] ); ?>>9</option>
			<option value="10" <?php selected( 10, $instance['show_post'] ); ?>>10</option>
		</select>
		</p>
	<?php }

	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['newsmag_category'] = ( ! empty( $new_instance['newsmag_category'] ) ) ? $new_instance['newsmag_category'] : '';
		$instance['show_post']        = ( ! empty( $new_instance['show_post'] ) ) ? $new_instance['show_post'] : '';

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
		$atts = array(
			'posts_per_page' => $args['show_post'],
		);

		if ( $idObj ) {
			$id = $idObj->term_id;
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
			$title = '';
		}

		if ( isset( $instance['newsmag_category'] ) ) {
			$newsmag_category = $instance['newsmag_category'];
		} else {
			$instance['newsmag_category'] = 'uncategorized';
		}
		if ( isset( $instance['show_post'] ) ) {
			$show_post = $instance['show_post'];
		} else {
			$instance['show_post'] = '';
		}

		extract( $args, EXTR_SKIP );

		echo $before_widget;
		$filepath = get_template_directory() . '/inc/widgets/posts_column/layouts/posts_column.php';

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