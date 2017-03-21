<?php

/**
 * Class Widget_Newsmag_Posts_Video
 */
class Widget_Newsmag_Posts_Video extends WP_Widget {
	/*
	 * Constructor
	 */
	function __construct() {
		add_action( 'admin_init', array( $this, 'enqueue' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue' ) );

		parent::__construct( 'newsmag_widget_posts_video', __( 'Newmsag - Video posts', 'newsmag' ), array(
			'classname'                   => 'newsmag_builder newsmag_widget_posts_video',
			'description'                 => __( 'Add a video posts widget.', 'newsmag' ),
			'customize_selective_refresh' => true
		) );
	}

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/css/style.css' );
		wp_enqueue_script( 'epsilon-object', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/js/epsilon.js', array( 'jquery' ) );
	}

	/*
	 * @param array $instance
	 */
	public function form( $instance ) {
		$defaults = array(
			'title'     => __( 'Recent posts', 'newsmag' ),
			'show_post' => 4,
			'category'  => 'uncategorized'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
		?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'sigma-labs' ); ?> </label>
            <input class="widefat" type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label><?php _e( 'Category', 'newsmag' ); ?> :</label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>"
                    id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
                <option value="" <?php if ( empty( $instance['category'] ) ) {
					echo 'selected="selected"';
				} ?>><?php _e( '&ndash; Select a category &ndash;', 'newsmag' ) ?></option>
				<?php
				$categories = get_categories( 'hide_empty=0' );
				foreach ( $categories as $category ) { ?>
                    <option
                            value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( esc_attr( $category->slug ), $instance['category'] ); ?>><?php echo esc_attr( $category->cat_name ); ?></option>
				<?php } ?>
            </select>
        </p>

        <label class="block" for="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>">
            <span class="customize-control-title">
               <?php _e( 'Posts to Show', 'newsmag' ); ?> :
            </span>
        </label>

        <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'show_post' ) ); ?>" class="rl-slider"
               id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"
               value="<?php echo esc_attr( $instance['show_post'] ); ?>"/>

        <div id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>" data-attr-min="1"
             data-attr-max="10" data-attr-step="1" class="ss-slider"></div>
        <script>
					jQuery(document).ready(function ($) {
						$('[id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"]').slider({
							value: <?php echo esc_attr( $instance['show_post'] ); ?>,
							range: 'min',
							min  : 1,
							max  : 10,
							step : 1,
							slide: function (event, ui) {
								$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"]').val(ui.value).keyup();
							}
						});
						$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').on('focus', function () {
							$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').trigger('blur');
						});
						$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').val($('[id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').slider("value"));
						$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').change(function () {
							$('[id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').slider({
								value: $(this).val()
							});
						});
					});
        </script>

		<?php
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'title'     => ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '',
			'show_post' => ! empty( $new_instance['show_post'] ) ? absint( $new_instance['show_post'] ) : '',
			'category'  => ! empty( $new_instance['category'] ) ? strip_tags( $new_instance['category'] ) : '',
		);

		return $instance;
	}


	public function widget( $args, $instance ) {
		$defaults = array(
			'title'     => __( 'Recent posts', 'newsmag' ),
			'show_post' => __( 4, 'newsmag' ),
			'category'  => 'uncategorized'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		echo $args['before_widget'];

		$query = array(
			'post_type'      => 'post',
			'posts_per_page' => $instance['show_post'],
			'tax_query'      => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => 'post-format-video',
				)
			)
		);

		$idObj = get_category_by_slug( $instance['category'] );
		if ( $idObj ) {
			$query['cat'] = $idObj->term_id;
		}

		$new_query = new WP_Query( $query );
		wp_reset_postdata();

		if ( $new_query->have_posts() ):
			include get_template_directory() . '/inc/widgets/posts_video/layouts/default.php';
		endif;

		echo $args['after_widget'];
	}
}