<?php

if ( function_exists( 'register_sidebar' ) ) {
	if ( ! function_exists( 'newsmag_register_sidebars' ) ) {
		function newsmag_register_sidebars() {
			register_sidebar( array(
				                  'id'            => 'sidebar',
				                  'name'          => __( 'Blog Sidebar', 'newsmag' ),
				                  'description'   => __( 'This is the blog sidebar. If you\'ve set a posts page under Settings -> Reading, that\'s where your sidebar will be showing up', 'newsmag' ),
				                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</div>',
				                  'before_title'  => '<h3>',
				                  'after_title'   => '</h3>',
			                  ) );

			register_sidebar( array(
				                  'id'            => 'homepage-slider',
				                  'name'          => __( 'Homepage - Header area', 'newsmag' ),
				                  'description'   => __( 'This sidebar holds the header sidebar area on the homepage.', 'newsmag' ),
				                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</div>',
				                  'before_title'  => '<h3>',
				                  'after_title'   => '</h3>',
			                  ) );

			register_sidebar( array(
				                  'id'            => 'content-area',
				                  'name'          => __( 'Homepage - Content area', 'newsmag' ),
				                  'description'   => __( 'The sidebar holds the entire homepage content, place "Newsmag - Homepage builder" widgets here, please consider the column arrangement.', 'newsmag' ),
				                  'before_title'  => '<h3 class="widget-title"><span>',
				                  'after_title'   => '</span></h3>',
				                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</div>'
			                  )
			);

			register_sidebar( array(
				                  'id'            => 'footer-1',
				                  'name'          => __( 'Footer 1', 'newsmag' ),
				                  'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</div>',
				                  'before_title'  => '<h3 class="widget-title">',
				                  'after_title'   => '</h3>',
			                  ) );

			register_sidebar( array(
				                  'id'            => 'footer-2',
				                  'name'          => __( 'Footer 2', 'newsmag' ),
				                  'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</div>',
				                  'before_title'  => '<h3 class="widget-title">',
				                  'after_title'   => '</h3>',
			                  ) );

			register_sidebar( array(
				                  'id'            => 'footer-3',
				                  'name'          => __( 'Footer 3', 'newsmag' ),
				                  'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</div>',
				                  'before_title'  => '<h3 class="widget-title">',
				                  'after_title'   => '</h3>',
			                  ) );

			register_sidebar( array(
				                  'id'            => 'footer-4',
				                  'name'          => __( 'Footer 4', 'newsmag' ),
				                  'description'   => __( 'This is your footer sidebar. By default, we\'ve defined a maximum of 4 sidebars but if you want to use less make sure you change the settings in: Footer -> Footer columns.', 'newsmag' ),
				                  'before_widget' => '<div id="%1$s" class="widget %2$s">',
				                  'after_widget'  => '</div>',
				                  'before_title'  => '<h3 class="widget-title">',
				                  'after_title'   => '</h3>',
			                  ) );

		} // function newsmag_register_sidebars end

		add_action( 'widgets_init', 'newsmag_register_sidebars' );

	} // function exists (newsmag_register_sidebars) check
} // function exists (register_sidebar) check


function newsmag_remove_specific_widget( $sidebars_widgets ) {

	foreach ( $sidebars_widgets as $widget_area => $widget_list ) {

		if ( $widget_area === 'homepage-slider' && ! empty( $widget_list ) ) {
			foreach ( $widget_list as $pos => $widget_id ) {
				if ( strpos( $widget_id, 'newsmag_slider_widget' ) !== false ) {
					continue;
				}
				unset( $sidebars_widgets[ $widget_area ][ $pos ] );
			}

			if ( count( $sidebars_widgets[ $widget_area ] ) > 1 ) {
				$sidebars_widgets[ $widget_area ] = array_slice( $sidebars_widgets[ $widget_area ], 0, 1 );
			}
		}

	}

	return $sidebars_widgets;
}

add_filter( 'sidebars_widgets', 'newsmag_remove_specific_widget' );