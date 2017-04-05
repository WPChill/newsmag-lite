<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Widget_Newsmag_homepage_slider extends WP_Widget {

	function __construct() {

		parent::__construct( 'newsmag_slider_widget', __( 'Newsmag - Homepage Slider', 'newsmag' ), array(
			'classname'                   => 'newsmag_slider',
			'description'                 => __( 'You can add a fullwidth slider with this widget.', 'newsmag' ),
			'customize_selective_refresh' => true
		) );
	}

	public function form( $instance ) {
		$defaults = array(
			'title'            => __( 'Recent posts', 'newsmag' ),
			'newsmag_category' => 'uncategorized'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		?>
        <p>
            <label><?php _e( 'Headline', 'newsmag' ); ?> </label>
            <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>">
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
		$instance['newsmag_category'] = ( ! empty( $new_instance['newsmag_category'] ) ) ? strip_tags( $new_instance['newsmag_category'] ) : '';

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

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$defaults = array(
			'title'            => __( 'Recent posts', 'newsmag' ),
			'newsmag_category' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		echo $args['before_widget'];
		$filepath = get_template_directory() . '/inc/libraries/widgets/widget-newsmag-homepage-slider/layouts/slider.php';

		$posts = $this->get_posts( $instance );

		if ( file_exists( $filepath ) ) {
			include $filepath;
		} else {
			esc_html_e( 'Please configure your widget', 'newsmag' );
		}

		echo $args['after_widget'];

	}

}