<?php

class Widget_Newsmag_Banner extends WP_Widget {
	/**
	 * @internal
	 */
	public function __construct() {
		parent::__construct(
			'Newsmag_Banner', // Base ID
			__( 'Newsmag Banner', 'newsmag' ), // Name
			array( 'description' => __( 'Newsmag Banners', 'newsmag' ), ) // Args
		);
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$params = array();

		if ( empty( $instance ) ) {
			$instance = array(
				'title'        => esc_html__( 'Newsmag Banners', 'newsmag' ),
				'show_title'   => 'no',
				'image'        => '',
				'image_url'    => '',
				'banner_type'  => 'image',
				'adsense_code' => '',
			);

		}

		foreach ( $instance as $key => $value ) {
			$params[ $key ] = $value;
		}

		$title = $before_title . $params['title'] . $after_title;

		$filepath = get_template_directory() . '/inc/widgets/banner/view/' . $params['banner_type'] . '.php';

		$instance = $params;

		$before_widget = str_replace( 'class="', 'class="newsmag-type-' . $params['banner_type'] . ' ', $before_widget );
		echo $before_widget;

		if ( $params['show_title'] == 'yes' ) {
			echo $title;
		}

		if ( file_exists( $filepath ) ) {
			include $filepath;
		}

		echo $after_widget;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return string;
	 */
	public function form( $instance ) {
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_style( 'newsmag_media_upload_css', esc_url( get_stylesheet_directory_uri() . '/css/upload-media.css' ) );
		wp_enqueue_script( 'newsmag_media_upload_js', esc_url( get_stylesheet_directory_uri() . '/js/upload-media.js' ), array( 'jquery' ) );

		$defaults = array(
			'title'        => esc_attr__( 'Newsmag Banners', 'newsmag' ),
			'show_title'   => 'no',
			'image'        => get_stylesheet_directory_uri() . '/images/banner-square.jpg',
			'image_url'    => '',
			'banner_type'  => 'image',
			'adsense_code' => '',
		);

		// Merge the user-selected arguments with the defaults.
		$instance = wp_parse_args( (array) $instance, $defaults );
		// Extract the array to allow easy use of variables.
		extract( $instance );
		// Loads the widget form.
		?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'newsmag' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>"><?php _e( 'Show Title', 'newsmag' );
				?>:</label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'show_title' ) ); ?>"
			        id="<?php echo esc_attr( $this->get_field_id( 'show_title' ) ); ?>" class="widefat"
			        style="height: auto;">
				<option value="yes" <?php echo ( $show_title == 'yes' ) ? 'selected' : '' ?>>
					<?php echo __( 'Yes', 'newsmag' ) ?>
				</option>
				<option value="no" <?php echo ( $show_title == 'no' ) ? 'selected' : '' ?>>
					<?php echo __( 'No', 'newsmag' ) ?>
				</option>
			</select>
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'banner_type' ) ); ?>"><?php _e( 'Banner Type', 'newsmag' );
				?>:</label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'banner_type' ) ); ?>"
			        id="<?php echo esc_attr( $this->get_field_id( 'banner_type' ) ); ?>" class="widefat"
			        style="height: auto;">
				<option value="image" <?php echo ( $banner_type == 'image' ) ? 'selected' : '' ?>>
					<?php echo __( 'Image', 'newsmag' ) ?>
				</option>
				<option value="adsense" <?php echo ( $banner_type == 'adsense' ) ? 'selected' : '' ?>>
					<?php echo __( 'Adsense', 'newsmag' ) ?>
				</option>
			</select>
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"><?php _e( 'Image:', 'newsmag' ); ?></label>
			<input name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" class="widefat" type="text" size="36"
			       value="<?php echo esc_url( $image ); ?>"/>
			<input class="upload_image_button button button-primary" type="button" value="Upload Image"/>
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'adsense_code' ) ); ?>"><?php _e( 'Adsense Code:', 'newsmag' ); ?></label>
			<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'adsense_code' ) ); ?>"
			          name="<?php echo esc_attr( $this->get_field_name( 'adsense_code' ) ); ?>"
			          type="text"><?php echo esc_js( $adsense_code ); ?>
			</textarea>
		</p>

		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"><?php _e( 'Image URL:', 'newsmag' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'image_url' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'image_url' ) ); ?>" type="text"
			       value="<?php echo esc_url_raw( $image_url ); ?>">
		</p>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['show_title']   = esc_attr( $new_instance['show_title'] );
		$instance['image']        = esc_url( $new_instance['image'] );
		$instance['image_url']    = esc_url( $new_instance['image_url'] );
		$instance['banner_type']  = esc_attr( $new_instance['banner_type'] );
		$instance['adsense_code'] = esc_js( $new_instance['adsense_code'] );

		return $instance;
	}
}