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
			'default-image' => get_template_directory_uri() . '/images/header.jpg',
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
		add_theme_support( 'post-formats', array() );

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
		add_image_size( 'newsmag-single-post', 760, 490, true );
		add_image_size( 'newsmag-recent-post-big', 560, 416, true );
		add_image_size( 'newsmag-recent-post-list-image', 65, 65, true );
		add_image_size( 'newsmag-slider-image', 1920, 600, true );

		/**
		 * Banners
		 */
		add_image_size( 'newsmag-wide-banner', 728, 90, true );
		add_image_size( 'newsmag-square-banner', 300, 250, true );
		add_image_size( 'newsmag-skyscraper-banner', 300, 600, true );

		add_filter( 'image_size_names_choose', 'newsmag_image_sizes' );
		function newsmag_image_sizes( $sizes ) {
			$addsizes = array(
				'newsmag-single-post'       => __( 'Single Post Size', 'newsmag' ),
				'newsmag-wide-banner'       => __( 'Wide Banner', 'newsmag' ),
				'newsmag-square-banner'     => __( 'Square Banner', 'newsmag' ),
				'newsmag-skyscraper-banner' => __( 'Sky scraper Banner', 'newsmag' )
			);
			$newsizes = array_merge( $sizes, $addsizes );

			return $newsizes;
		}

		/**
		 * Add support for the custom logo functionality
		 */
		add_theme_support( 'custom-logo', array(
			'height'     => 45,
			'width'      => 285,
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
					"check"       => newsmag_is_not_static_page()
				),

			);
			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}
	}
endif;
add_action( 'after_setup_theme', 'newsmag_setup' );

/**
 * @param $sidebars_widgets
 *
 * @return mixed
 */
function newsmag_disable_default_widgets( $sidebars_widgets ) {

	if ( is_array( $sidebars_widgets['before-content-area'] ) ) {
		foreach ( $sidebars_widgets['before-content-area'] as $i => $widget ) {
			unset( $sidebars_widgets['before-content-area'][ $i ] );
		}

	}

	return $sidebars_widgets;
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

function newsmag_check_widget_text( $content ) {

	$content = preg_replace( "/<object/Si", '<div class="newsmag-video-containe"><object', $content );
	$content = preg_replace( "/<\/object>/Si", '</object></div>', $content );

	/**
	 * Added iframe filtering, iframes are bad.
	 */
	$content = preg_replace( "/<iframe.+?src=\"(.+?)\"/Si", '<div class="newsmag-video-containe"><iframe src="\1" frameborder="0" allowfullscreen>', $content );
	$content = preg_replace( "/<\/iframe>/Si", '</iframe></div>', $content );

	return $content;
}

add_filter( 'widget_text', 'newsmag_check_widget_text' );

/**
 * Enqueue scripts and styles.
 */
function newsmag_scripts() {
	/**
	 * Load the fonts
	 */
	$ssl = is_ssl() ? 'https:' : 'http:';

	wp_enqueue_style( 'poppins-style', $ssl . '//fonts.googleapis.com/css?family=Poppins:400,600,500,700,300' );
	wp_enqueue_style( 'lato-style', $ssl . '//fonts.googleapis.com/css?family=Lato:400,300,400italic,700,700italic,900' );
	wp_enqueue_style( 'hind-style', $ssl . '//fonts.googleapis.com/css?family=Hind:400,300,500,600,700' );
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/css/font-awesome.min.css' );

	/**
	 * Load the bootstrap framework
	 */
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
	wp_enqueue_script( 'newsmag-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20151215', true );

	/**
	 * Theme styling
	 */
	wp_enqueue_style( 'newsmag-style', get_stylesheet_uri() );
	wp_enqueue_style( 'newsmag-stylesheet', get_template_directory_uri() . '/css/style.css' );
	/**
	 * Load menu script & skip-link-focus-fix
	 */
	wp_enqueue_script( 'newsmag-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'newsmag-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	/**
	 *Load the theme's core Javascript
	 */
	wp_enqueue_script( 'newsmag-functions', get_template_directory_uri() . '/js/functions.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'owlCarousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min
				.js', array( 'jquery' ), '1.3.3', true );
	// owlCarousel Stylesheet
	wp_register_style( 'owlCarousel-main-css', get_template_directory_uri() . '/css/owl-carousel/owl.carousel.min.css' );
	wp_register_style( 'owlCarousel-theme-css', get_template_directory_uri() . '/css/owl-carousel/owl.theme.default.css' );
}

add_action( 'wp_enqueue_scripts', 'newsmag_scripts' );

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

function newsmag_register_new_user_profile_fields( $profile_fields ) {
	// Add new fields
	$profile_fields['twitter']     = 'Twitter URL';
	$profile_fields['facebook']    = 'Facebook URL';
	$profile_fields['google-plus'] = 'Google+ URL';
	$profile_fields['linkedin']    = 'LinkedIn URL';
	$profile_fields['dribbble']    = 'Dribbble URL';
	$profile_fields['github']      = 'GitHub URL';
	$profile_fields['pinterest']   = 'Pinterest URL';
	$profile_fields['tumblr']      = 'Tumblr URL';
	$profile_fields['youtube']     = 'YouTube URL';
	$profile_fields['flickr']      = 'FlickR URL';
	$profile_fields['vimeo']       = 'Vimeo URL';
	$profile_fields['instagram']   = 'Instagram URL';
	$profile_fields['codepen']     = 'Codepen URL';

	return $profile_fields;
}

add_filter( 'user_contactmethods', 'newsmag_register_new_user_profile_fields' );

function newsmag_dirname_to_classname( $dirname ) {
	$class_name = explode( '-', $dirname );
	$class_name = array_map( 'ucfirst', $class_name );
	$class_name = implode( '_', $class_name );

	return $class_name;
}

add_action( 'widgets_init', 'newsmag_widget_init' );
/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Sidebars
 */
require get_template_directory() . '/sidebars/sidebars.php';