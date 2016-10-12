<?php

class Widget_Newsmag_Posts_Column extends WP_Widget {

	function __construct() {

		add_action( 'admin_init', array( $this, 'enqueue' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue' ) );

		parent::__construct( 'newsmag_widget_posts_column', __( 'Newsmag - Posts Column', 'newsmag' ), array(
			'classname'   => 'newsmag_builder',
			'description' => __( 'Layout consists of a featured post thumbnail, followed by a handful of posts that are smaller in size. Perfect for emphasising important news.', 'newsmag' )
		) );

	}

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_enqueue_style( 'epsilon-styles', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/css/style.css' );
		wp_enqueue_script( 'epsilon-object', get_template_directory_uri() . '/inc/customizer/epsilon-framework/assets/js/epsilon.js', array( 'jquery' ) );
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

		if ( isset( $instance['featured_article'] ) ) {
			$featured_article = $instance['featured_article'];
		} else {
			$instance['featured_article'] = 'on';
		}

		if ( isset( $instance['show_post'] ) ) {
			$show_post = $instance['show_post'];
		} else {
			$instance['show_post'] = 4;
		}

		if ( isset( $instance['show_date'] ) ) {
			$show_date = $instance['show_date'];
		} else {
			$instance['show_date'] = 'on';
		}

		?>
		<p>
			<label><?php _e( 'Title', 'newsmag' ); ?> :</label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $title ); ?>">
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


		<label class="block" for="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>">
            <span class="customize-control-title">
               <?php _e( 'Posts to Show', 'newsmag' ); ?> :
            </span>
		</label>

		<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'show_post' ) ); ?>" class="rl-slider"
		       id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"
		       value="<?php echo esc_attr( $instance['show_post'] ); ?>"/>

		<div id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>" class="ss-slider"></div>
		<script>
			jQuery(document).ready(function ($) {
				$('[id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"]').slider({
					value: <?php echo esc_attr( $instance['show_post'] ); ?>,
					range: 'min',
					min  : 2,
					max  : 10,
					step : 2,
					slide: function (event, ui) {
						$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"]').val(ui.value).keyup();
					}
				});
				$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').val($('[id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').slider("value"));
				$('[id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').change(function () {
					$('[id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ) ?>"]').slider({
						value: $(this).val()
					});
				});
			});
		</script>

		<div class="checkbox_switch">
				<span class="customize-control-title onoffswitch_label">
                    <?php _e( 'Featured article', 'newsmag' ); ?>
				</span>
			<div class="onoffswitch">
				<input type="checkbox" id="<?php echo esc_attr( $this->get_field_name( 'featured_article' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'featured_article' ) ); ?>"
				       class="onoffswitch-checkbox"
				       value="on"
					<?php checked( $instance['featured_article'], 'on' ); ?>>
				<label class="onoffswitch-label"
				       for="<?php echo esc_attr( $this->get_field_name( 'featured_article' ) ); ?>"></label>
			</div>
		</div>

		<div class="checkbox_switch">
				<span class="customize-control-title onoffswitch_label">
                    <?php _e( 'Show Date', 'newsmag' ); ?>
				</span>
			<div class="onoffswitch">
				<input type="checkbox" id="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>"
				       class="onoffswitch-checkbox"
				       value="on"
					<?php checked( $instance['show_date'], 'on' ); ?>>
				<label class="onoffswitch-label"
				       for="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>"></label>
			</div>
		</div>

	<?php }

	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['newsmag_category'] = ( ! empty( $new_instance['newsmag_category'] ) ) ? $new_instance['newsmag_category'] : '';
		$instance['show_post']        = ( ! empty( $new_instance['show_post'] ) ) ? strip_tags( $new_instance['show_post'] ) : '';
		$instance['featured_article'] = ( ! empty( $new_instance['featured_article'] ) ) ? $new_instance['featured_article'] : '';
		$instance['show_date']        = ( ! empty( $new_instance['show_date'] ) ) ? $new_instance['show_date'] : '';

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
			'posts_per_page' => $args['show_post'],
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
			$instance['show_post'] = 4;
		}

		if ( isset( $instance['featured_article'] ) ) {
			$featured_article = $instance['featured_article'];
		} else {
			$instance['featured_article'] = 'on';
		}

		if ( isset( $instance['show_date'] ) ) {
			$show_date = $instance['show_date'];
		} else {
			$instance['show_date'] = 'on';
		}

		extract( $args, EXTR_SKIP );

		echo $before_widget;

		$filepath = get_template_directory() . '/inc/widgets/posts_column/layouts/posts_column.php';

		if ( $instance['featured_article'] ) {
			$filepath = get_template_directory() . '/inc/widgets/posts_column/layouts/posts_column_featured.php';
		}

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