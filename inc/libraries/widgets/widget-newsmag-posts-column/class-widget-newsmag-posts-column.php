<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Widget_Newsmag_Posts_Column extends WP_Widget {

	function __construct() {

		add_action( 'admin_init', array( $this, 'enqueue' ) );
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'customize_preview_init', array( $this, 'enqueue' ) );

		parent::__construct(
			'newsmag_widget_posts_column', __( 'Newsmag - Posts Column', 'newsmag' ), array(
				'classname'                   => 'newsmag_builder col-md-4',
				'description'                 => __( 'Layout consists of a featured post thumbnail, followed by a handful of posts that are smaller in size. Perfect for emphasising important news.', 'newsmag' ),
				'customize_selective_refresh' => true,
			)
		);

	}

	public function enqueue() {
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-slider' );
	}

	public function form( $instance ) {
		$defaults = array(
			'title'            => __( 'Recent posts', 'newsmag' ),
			'show_post'        => 4,
			'newsmag_category' => 'uncategorized',
			'featured_article' => 'on',
			'show_date'        => 'on',
			'order'            => 'desc',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		<p>
			<label><?php _e( 'Title', 'newsmag' ); ?> :</label>
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				value="<?php echo esc_attr( $instance['title'] ); ?>">
		</p>

		<p>
			<label><?php _e( 'Category', 'newsmag' ); ?> :</label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'newsmag_category' ) ); ?>"
					id="<?php echo esc_attr( $this->get_field_id( 'newsmag_category' ) ); ?>">
				<option value=""
				<?php
				if ( empty( $instance['newsmag_category'] ) ) {
					echo 'selected="selected"';
				}
				?>
				><?php _e( '&ndash; Select a category &ndash;', 'newsmag' ); ?></option>
				<?php
				$categories = get_categories( 'hide_empty=0' );
				foreach ( $categories as $category ) {
				?>
					<option
							value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( esc_attr( $category->slug ), $instance['newsmag_category'] ); ?>><?php echo esc_html( $category->cat_name ); ?></option>
				<?php } ?>
			</select>
		</p>
		<p>
			<label><?php _e( 'Order', 'newsmag' ); ?> :</label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>"
					id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" class="pull-right">
				<option value ="desc" <?php echo ( 'desc' === $instance['order'] ) ? 'selected' : ''; ?> ><?php echo esc_html__( 'Descending', 'newsmag' ); ?></option>
				<option value ="asc" <?php echo ( 'asc' === $instance['order'] ) ? 'selected' : ''; ?> ><?php echo esc_html__( 'Ascending', 'newsmag' ); ?></option>
				<option value ="rand" <?php echo ( 'rand' === $instance['order'] ) ? 'selected' : ''; ?> ><?php echo esc_html__( 'Random', 'newsmag' ); ?></option>
			</select>
		</p>

		<label class="block" for="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>">
			<span class="customize-control-title">
				<?php _e( 'Posts to Show', 'newsmag' ); ?> :
			</span>
		</label>

		<div class="slider-container">
			<input type="text" name="<?php echo esc_attr( $this->get_field_name( 'show_post' ) ); ?>" class="rl-slider"
				id="input_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>"
				value="<?php echo esc_attr( $instance['show_post'] ); ?>"/>

			<div id="slider_<?php echo esc_attr( $this->get_field_id( 'show_post' ) ); ?>" data-attr-min="1"
				data-attr-max="10" data-attr-step="1" class="ss-slider"></div>
		</div>
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
					<?php _e( 'Show Date and Comments', 'newsmag' ); ?>
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

	<?php
	}

	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['newsmag_category'] = ( ! empty( $new_instance['newsmag_category'] ) ) ? strip_tags( $new_instance['newsmag_category'] ) : '';
		$instance['show_post']        = ( ! empty( $new_instance['show_post'] ) ) ? absint( $new_instance['show_post'] ) : '';
		$instance['featured_article'] = ( ! empty( $new_instance['featured_article'] ) ) ? strip_tags( $new_instance['featured_article'] ) : '';
		$instance['show_date']        = ( ! empty( $new_instance['show_date'] ) ) ? strip_tags( $new_instance['show_date'] ) : '';
		$instance['order']            = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';

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

		/**
		 * Arguments for the normal query
		 */
		$atts = array(
			'posts_per_page' => $args['show_post'],
		);

		/**
		 * Grab the sticky posts
		 */
		$sticky_atts = array(
			'posts_per_page' => $args['show_post'],
			'post__in'       => get_option( 'sticky_posts' ),
		);

		$atts['order']          = $args['order'];
		$sticky_atts['order']   = $args['order'];
		$atts['orderby']        = 'date';
		$sticky_atts['orderby'] = 'date';

		if ( 'rand' == $atts['order'] ) {
			$atts['order']          = '';
			$sticky_atts['order']   = '';
			$atts['orderby']        = 'rand';
			$sticky_atts['orderby'] = 'rand';
		}
		/**
		 * Grab category and add the new argument
		 */
		$id_obj = get_category_by_slug( $args['newsmag_category'] );
		if ( $id_obj ) {
			$id                 = $id_obj->term_id;
			$atts['cat']        = $id;
			$sticky_atts['cat'] = $id;
		}

		/**
		 * Initiate WP Query for the sticky posts
		 */
		$sticky = new WP_Query( $sticky_atts );
		wp_reset_postdata();
		$sticky_post_ids = array();

		/**
		 * Start adding the IDS of the sticky posts in a new array
		 */
		if ( ! empty( $sticky->posts ) ) {
			foreach ( $sticky->posts as $post ) {
				$sticky_post_ids[] = $post->ID;
			}
		}

		/**
		 * Run the normal query
		 */
		$normal_posts = new WP_Query( $atts );
		wp_reset_postdata();
		/**
		 * In case we do not have sticky posts, we terminate here and return this result
		 */
		if ( empty( $sticky->posts ) ) {
			return $normal_posts;
		}

		/**
		 * We check if the post id is in the sticky post id array, and if not - we add it to the sticky posts result
		 */
		foreach ( $normal_posts->posts as $post ) {
			if ( in_array( $post->ID, $sticky_post_ids ) ) {
				continue;
			}

			$sticky->posts[] = $post;
		}

		$sticky->posts      = array_slice( $sticky->posts, 0, (int) $args['show_post'] );
		$sticky->post_count = count( $sticky->posts );

		return $sticky;
	}

	public function widget( $args, $instance ) {
		$defaults = array(
			'title'            => __( 'Recent posts', 'newsmag' ),
			'show_post'        => 4,
			'newsmag_category' => '',
			'featured_article' => 'on',
			'show_date'        => 'on',
			'order'            => 'desc',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		echo $args['before_widget'];

		$filepath = get_template_directory() . '/inc/libraries/widgets/widget-newsmag-posts-column/layouts/posts_column.php';

		if ( $instance['featured_article'] ) {
			$filepath = get_template_directory() . '/inc/libraries/widgets/widget-newsmag-posts-column/layouts/posts_column_featured.php';
		}

		$posts = $this->get_posts( $instance );

		if ( file_exists( $filepath ) ) {
			include $filepath;
		} else {
			esc_html_e( 'Please configure your widget', 'newsmag' );
		}

		echo $args['after_widget'];

	}

}
