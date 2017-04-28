<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Sigma_Shop_Sidebars
 */
class Newsmag_Sidebars {
	/**
	 * @var array
	 */
	public $sidebars = array();

	/**
	 * Sigma_Shop_Sidebars constructor.
	 */
	public function __construct() {
		$this->collect_sidebars();
		add_action( 'widgets_init', array( $this, 'set_sidebars' ) );
		add_action( 'widgets_init', array( $this, 'initiate_widgets' ) );

		add_filter( 'sidebars_widgets', array( $this, 'remove_specific_widget' ) );
	}

	/**
	 * Filter widgets, we don`t allow normal widgets in the homepage builder
	 *
	 * @param $sidebars_widgets
	 *
	 * @return mixed
	 */
	public function remove_specific_widget( $sidebars_widgets ) {
		$filtering = apply_filters( 'newsmag_widget_filtering', true );

		if ( ! $filtering ) {
			return $sidebars_widgets;
		}

		/**
		 * Start filtering the widgets
		 */
		foreach ( $sidebars_widgets as $widget_area => $widget_list ) {
			/**
			 * On the homepage-slider sidebar, we don't allow more any other sidebar, except the newsmag_slider_widget
			 */
			if ( $widget_area === 'homepage-slider' && ! empty( $widget_list ) ) {
				foreach ( $widget_list as $pos => $widget_id ) {
					if ( strpos( $widget_id, 'newsmag_slider_widget' ) === false ) {
						unset( $sidebars_widgets[ $widget_area ][ $pos ] );;
					}
				}

				/**
				 * And there can be only one #highlander
				 */
				if ( count( $sidebars_widgets[ $widget_area ] ) > 1 ) {
					$sidebars_widgets[ $widget_area ] = array_slice( $sidebars_widgets[ $widget_area ], 0, 1 );
				}
			}

			/**
			 * In the content area of the frontend page, we can only use builder widgets
			 */
			if ( $widget_area === 'content-area' && ! empty( $widget_list ) ) {
				foreach ( $widget_list as $pos => $widget_id ) {
					if ( strpos( $widget_id, 'newsmag_widget_posts_' ) === false ) {
						/**
						 * Special case, banner widget
						 */
						if ( strpos( $widget_id, 'newsmag_banner' ) !== false ) {
							continue;
						}
						unset( $sidebars_widgets[ $widget_area ][ $pos ] );
					}
				}
			}

			/**
			 * Footer sidebars
			 */
			if ( in_array( $widget_area, array(
					'footer-1',
					'footer-2',
					'footer-3',
					'footer-4',
					'sidebar'
				) ) && ! empty( $widget_list )
			) {
				foreach ( $widget_list as $pos => $widget_id ) {
					if ( strpos( $widget_id, 'newsmag_' ) !== false ) {
						unset( $sidebars_widgets[ $widget_area ][ $pos ] );;
					}
				}
			}
		}

		return $sidebars_widgets;
	}

	/**
	 * registers sidebars
	 */
	public function set_sidebars() {
		foreach ( $this->sidebars as $sidebar ) {
			register_sidebar( $sidebar );
		}
	}

	/**
	 * Add sidebars here
	 */
	private function collect_sidebars() {
		$this->sidebars = array(
			array(
				'id'            => 'sidebar',
				'name'          => __( 'Blog Sidebar', 'newsmag' ),
				'description'   => __( 'This is the blog sidebar. If you\'ve set a posts page under Settings -> Reading, that\'s where your sidebar will be showing up', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			),
			array(
				'id'            => 'homepage-slider',
				'name'          => __( 'Homepage - Header area', 'newsmag' ),
				'description'   => __( 'This sidebar holds the header sidebar area on the homepage.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			),
			array(
				'id'            => 'content-area',
				'name'          => __( 'Homepage - Content area', 'newsmag' ),
				'description'   => __( 'The sidebar holds the entire homepage content, place "Newsmag - Homepage builder" widgets here, please consider the column arrangement.', 'newsmag' ),
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>'
			),
			array(
				'id'            => 'footer-1',
				'name'          => __( 'Footer 1', 'newsmag' ),
				'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			),
			array(
				'id'            => 'footer-2',
				'name'          => __( 'Footer 2', 'newsmag' ),
				'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			),
			array(
				'id'            => 'footer-3',
				'name'          => __( 'Footer 3', 'newsmag' ),
				'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			),
			array(
				'id'            => 'footer-4',
				'name'          => __( 'Footer 4', 'newsmag' ),
				'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			),
		);
	}

	/**
	 * Initiate widgets
	 */
	public function initiate_widgets() {
		$widgets = array(
			'Widget_Newsmag_Homepage_Slider',
			'Widget_Newsmag_Popular_Posts',
			'Widget_Newsmag_Posts_Column',
			'Widget_Newsmag_Posts_Grid',
			'Widget_Newsmag_Posts_List_Horizontal',
			'Widget_Newsmag_Posts_List_Vertical'
		);

		foreach ( $widgets as $widget ) {
			new $widget();
			register_widget( $widget );
		}
	}
}