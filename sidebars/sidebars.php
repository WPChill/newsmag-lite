<?php

if ( function_exists( 'register_sidebar' ) ) {
	if ( ! function_exists( 'newsmag_register_sidebars' ) ) {
		function newsmag_register_sidebars() {

			#
			#    Register sidebars
			#
			register_sidebar( array(
				'id'            => 'homepage-slider',
				'name'          => __( 'Homepage Slider', 'newsmag' ),
				'description'   => __( 'But first, create a homepage template. Dashboard > Pages > Add New > Template > Front Page Template', 'newsmag' ),
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'id'            => 'sidebar',
				'name'          => __( 'Right Sidebar', 'newsmag' ),
				'description'   => __( 'This widget is located right side as sidebar. Only seen on the normal post query', 'newsmag' ),
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
					'id'            => 'content-area',
					'name'          => __( 'Content Area', 'newsmag' ),
					'before_title'  => '<h3 class="widget-title"><span>',
					'after_title'   => '</span></h3>',
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget'  => '</div>'
				)
			);

//			register_sidebar( array(
//					'id'            => 'top-area-a',
//					'name'          => __( 'Top Area #1', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);
//			register_sidebar( array(
//					'id'            => 'top-area-b',
//					'name'          => __( 'Top Area #2', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);
//			register_sidebar( array(
//					'id'            => 'top-area-c',
//					'name'          => __( 'Top Area #3', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);
//
//			register_sidebar( array(
//					'id'            => 'content-area-a',
//					'name'          => __( 'Content Area #1', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);
//			register_sidebar( array(
//					'id'            => 'content-area-b',
//					'name'          => __( 'Content Area #2', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);
//
//			register_sidebar( array(
//					'id'            => 'content-area-main',
//					'name'          => __( 'Content Area Main', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget newsmag-margin-top %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);
//
//			register_sidebar( array(
//					'id'            => 'content-area-banner',
//					'name'          => __( 'Content Area Banner', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);
//
//			register_sidebar( array(
//					'id'            => 'before-footer-area',
//					'name'          => __( 'Before Footer Content Area', 'newsmag' ),
//					'before_title'  => '<h3 class="widget-title"><span>',
//					'after_title'   => '</span></h3>',
//					'before_widget' => '<div id="%1$s" class="widget newsmag-margin-top %2$s">',
//					'after_widget'  => '</div>'
//				)
//			);

			register_sidebar( array(
				'id'            => 'footer-1',
				'name'          => __( 'Footer 1', 'newsmag' ),
				'description'   => __( 'This widget is located footer.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'id'            => 'footer-2',
				'name'          => __( 'Footer 2', 'newsmag' ),
				'description'   => __( 'This widget is located footer.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'id'            => 'footer-3',
				'name'          => __( 'Footer 3', 'newsmag' ),
				'description'   => __( 'This widget is located footer.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

			register_sidebar( array(
				'id'            => 'footer-4',
				'name'          => __( 'Footer 4', 'newsmag' ),
				'description'   => __( 'This widget is located footer.', 'newsmag' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );

		} // function newsmag_register_sidebars end

		add_action( 'widgets_init', 'newsmag_register_sidebars' );

	} // function exists (newsmag_register_sidebars) check
} // function exists (register_sidebar) check
