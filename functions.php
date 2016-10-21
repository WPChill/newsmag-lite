<?php
/**
 * Newsmag functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Newsmag
 */

if ( ! function_exists( 'newsmag_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function newsmag_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Newsmag, use a find and replace
		 * to change 'newsmag' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'newsmag', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'custom-header', array(
			'width'         => 1920,
			'height'        => 200,
			'default-image' => get_template_directory_uri() . '/assets/images/header.jpg',
			'uploads'       => true,
		) );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );


		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */

		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'quote',
			'link',
			'gallery',
			'video',
			'status',
			'audio',
			'chat'
		) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			                    'primary' => esc_html__( 'Primary', 'newsmag' ),
			                    'social'  => esc_html__( 'Social', 'newsmag' ),
		                    ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Post Thumbs
		 */
		add_image_size( 'newsmag-single-post', 730, 330, true );
		add_image_size( 'newsmag-recent-post-big', 560, 416, true );
		add_image_size( 'newsmag-post-horizontal', 350, 260, true );
		add_image_size( 'newsmag-vertical-post', 255, 195, true );
		add_image_size( 'newsmag-post-grid', 360, 270, true );
		add_image_size( 'newsmag-post-grid-small', 275, 210, true );
		add_image_size( 'newsmag-recent-post-list-image', 65, 65, true );
		add_image_size( 'newsmag-slider-image', 1920, 600, true );

		/**
		 * Add support for the custom logo functionality
		 */
		add_theme_support( 'custom-logo', array(
			'height'     => 45,
			'width'      => 150,
			'flex-width' => true,
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'newsmag_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Welcome screen
		if ( is_admin() ) {
			global $newsmag_required_actions;
			/*
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 *
			 */
			$imported = get_option( 'mt_imported_demo' );

			if ( empty( $imported ) ) {
				$imported = false;
			} else {
				$imported = true;
			}

			$newsmag_required_actions = array(
				array(
					"id"          => 'newsmag-req-ac-static-latest-news',
					"title"       => esc_html__( 'Set front page to static', 'newsmag' ),
					"description" => esc_html__( 'If you just installed Newsmag, and are not able to see the front-page demo, you need to go to Settings -> Reading , Front page displays and select "Static Page".', 'newsmag' ),
					"help"        => wp_kses( 'If you need more help understanding how this works, check out the following <a target="_blank"  href="https://codex.wordpress.org/Creating_a_Static_Front_Page#WordPress_Static_Front_Page_Process">link</a>,', 'newsmag' ),
					"check"       => newsmag_is_not_static_page()
				),
				array(
					'id'          => 'newsmag-req-ac-add-widgets',
					'title'       => esc_html__( 'Build your homepage!', 'newsmag' ),
					'description' => esc_html__( 'Get started with Newsmag by adding a Slider Widget to the Header Area or by adding a Content widget. To achieve any of these actions, please head on to Customize -> Widgets -> Homepage : Header Area or Content Area and select any of the widgets presented there.', 'newsmag' ),
					'check'       => newsmag_has_widgets()
				),
				array(
					"id"          => 'newsmag-req-ac-install-wp-import-plugin',
					"title"       => esc_html__( 'Install WordPress Importer', 'newsmag' ),
					"description" => esc_html__( 'Please install the WordPress Importer to create the demo content.', 'newsmag' ),
					"check"       => newsmag_check_wordpress_importer(),
					"plugin_slug" => 'wordpress-importer'
				),
				array(
					"id"          => 'newsmag-req-ac-install-wp-import-widget-plugin',
					"title"       => esc_html__( 'Install Widget Importer Exporter', 'newsmag' ),
					"description" => esc_html__( 'Please install the WordPress widget importer to create the demo content', 'newsmag' ),
					"check"       => defined( "WIE_VERSION" ),
					"plugin_slug" => 'widget-importer-exporter'
				),
				array(
					"id"          => 'newsmag-req-ac-install-data',
					"title"       => esc_html__( 'Run the import!', 'newsmag' ),
					"description" => esc_html__( 'Head over to our website and download the sample content data.', 'newsmag' ),
					"help"        => '<a target="_blank"  href="https://www.machothemes.com/sample-data/newsmag-lite-posts.xml">' . __( 'Posts', 'newsmag' ) . '</a>, 
									   <a target="_blank"  href="https://www.machothemes.com/sample-data/newsmag-lite-widgets.wie">' . __( 'Widgets', 'newsmag' ) . '</a>',
					"check"       => newsmag_has_content(),
				),
			);
			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}
	}
endif;
add_action( 'after_setup_theme', 'newsmag_setup' );

/**
 * @param string $format
 *
 * @return bool|mixed
 */
function newsmag_format_icon( $format = 'standard' ) {
	if ( $format === 'standard' ) {
		return false;
	}

	$icons = array(
		'aside'   => 'fa fa-hashtag',
		'image'   => 'fa fa-picture-o',
		'quote'   => 'fa fa-quote-left',
		'link'    => 'fa fa-link',
		'gallery' => 'fa fa-th-large',
		'video'   => 'fa fa-video-camera',
		'status'  => 'fa fa-heartbeat',
		'audio'   => 'fa fa-headphones',
		'chat'    => 'fa fa-comment-o'
	);

	return $icons[ $format ];
}

/**
 * @return bool
 */
function newsmag_is_not_static_page() {
	return 'page' == get_option( 'show_on_front' ) ? true : false;
}

/**
 * @return bool
 */
function newsmag_has_widgets() {
	if ( ! is_active_sidebar( 'homepage-slider' ) && ! is_active_sidebar( 'content-area' ) ) {
		return false;
	}

	return true;
}

/**
 * @return bool
 */
function newmsag_has_posts() {
	$args  = array( "s" => 'Gary Johns: \'What is Aleppo\'' );
	$query = get_posts( $args );

	if ( ! empty( $query ) ) {
		return true;
	}

	return false;
}

function newsmag_has_content() {
	$check = array(
		'widgets' => newsmag_has_widgets(),
		'posts'   => newmsag_has_posts(),
	);

	if ( $check['widgets'] && $check['posts'] ) {
		return true;
	}

	return false;
}

function newsmag_check_wordpress_importer() {
	if ( file_exists( ABSPATH . 'wp-content/plugins/wordpress-importer/wordpress-importer.php' ) ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		return is_plugin_active( 'wordpress-importer/wordpress-importer.php' );
	}

	return false;
}

/**
 * @return bool
 */
function newsmag_is_not_template_front_page() {
	$page_id = get_option( 'page_on_front' );

	return get_page_template_slug( $page_id ) == 'page-templates/frontpage-template.php' ? true : false;
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function newsmag_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'newsmag_content_width', 1110 );
}

add_action( 'after_setup_theme', 'newsmag_content_width', 0 );

/**
 * Filter the categories widget to add a <span> element before the count
 *
 * @param $links
 *
 * @return mixed
 */
function newsmag_add_span_cat_count( $links ) {
	$links = str_replace( '</a> (', '</a> <span class="newsmag-cat-count">', $links );
	$links = str_replace( ')', '</span>', $links );

	return $links;
}

add_filter( 'wp_list_categories', 'newsmag_add_span_cat_count' );

function newsmag_add_span_archive_count( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a> <span class="newsmag-cat-count">', $links );
	$links = str_replace( ')', '</span>', $links );

	return $links;
}

add_filter( 'get_archives_link', 'newsmag_add_span_archive_count' );

function newsmag_remove_from_archive_title( $title ) {
	if ( is_category() ) {

		$title = single_cat_title( '', false );

	} elseif ( is_tag() ) {

		$title = single_tag_title( '', false );

	} elseif ( is_author() ) {

		$title = '<span class="vcard">' . get_the_author() . '</span>';

	}

	return $title;
}

add_filter( 'get_the_archive_title', 'newsmag_remove_from_archive_title' );

/**
 * Enqueue scripts and styles.
 */
function newsmag_scripts() {
	/**
	 * Load the fonts
	 */
	$query_args = array(
		'family' => 'Lato:400,600,700|Poppins:400,500,600,700'
	);
	$newsmag    = wp_get_theme();

	wp_enqueue_style( 'newsmag-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), 1, 'all' );
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/assets/vendors/fontawesome//font-awesome.min.css' );

	/**
	 * Load the bootstrap framework
	 */
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-theme-style', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap-theme.min.css' );
	wp_enqueue_script( 'newsmag-bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.js', array( 'jquery' ), '20151215', true );

	/**
	 * Theme styling
	 */
	wp_enqueue_style( 'newsmag-style', get_stylesheet_uri() );
	wp_enqueue_style( 'newsmag-stylesheet', get_template_directory_uri() . '/assets/css/style.css', array(), $newsmag['Version'] );
	/**
	 * Load menu script & skip-link-focus-fix
	 */
	wp_enqueue_script( 'newsmag-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'newsmag-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	/**
	 *Load the theme's core Javascript
	 */
	wp_enqueue_script( 'newsmag-functions', get_template_directory_uri() . '/assets/js/functions.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'owlCarousel-js', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.carousel.min
				.js', array( 'jquery' ), '1.3.3', true );
	// owlCarousel Stylesheet
	wp_enqueue_style( 'owlCarousel-main-css', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.carousel.min.css' );
	wp_enqueue_style( 'owlCarousel-theme-css', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.theme.default.css' );
}

add_action( 'wp_enqueue_scripts', 'newsmag_scripts' );

function newsmag_admin_scripts() {
	/**
	 * Load the fonts
	 */
	$query_args = array(
		'family' => 'Lato:400,600,700|Poppins:400,500,600,700'
	);

	wp_enqueue_style( 'newsmag-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), 1, 'all' );
}

add_action( 'admin_enqueue_scripts', 'newsmag_admin_scripts' );

function newsmag_add_editor_styles() {
	add_editor_style( 'inc/assets/css/custom-editor-style.css' );
}

add_action( 'admin_init', 'newsmag_add_editor_styles' );

function newsmag_the_posts_navigation( $args = array() ) {
	echo get_the_posts_navigation( $args );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/components/breadcrumbs/class-newsmag-breadcrumbs.php';

function newsmag_widget_init() {

	$widget_path = get_template_directory() . '/inc/widgets';
	$dirs        = glob( $widget_path . '/*', GLOB_ONLYDIR );

	foreach ( $dirs as $dir ) {
		$dirname = basename( $dir );

		include_once( $dir . '/class-widget-newsmag-' . $dirname . '.php' );

		$widget_class = 'Widget_Newsmag_' . newsmag_dirname_to_classname( $dirname );
		if ( class_exists( $widget_class ) ) {
			register_widget( $widget_class );
		}

	}
}

add_action( 'widgets_init', 'newsmag_widget_init' );

function newsmag_dirname_to_classname( $dirname ) {
	$class_name = explode( '-', $dirname );
	$class_name = array_map( 'ucfirst', $class_name );
	$class_name = implode( '_', $class_name );

	return $class_name;
}

add_action( 'wp_ajax_newsmag_get_attachment_image', 'newsmag_get_attachment_image' );
add_action( 'wp_ajax_nopriv_newsmag_get_attachment_image', 'newsmag_get_attachment_image' );

function newsmag_get_attachment_image() {
	$id   = intval( $_POST['attachment_id'] );
	$size = esc_html( $_POST['attachment_size'] );

	$src = wp_get_attachment_image( $id, false );

	echo $src;
	die();
}

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
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load lazyload
 */
require get_template_directory() . '/inc/components/lazyload/class-newsmag-lazyload.php';

/**
 * Sidebars
 */
require get_template_directory() . '/inc/sidebars.php';