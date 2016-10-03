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

/**
 * Enqueue scripts and styles.
 */
function newsmag_scripts() {
	/**
	 * Load the fonts
	 */
	$query_args = array(
		'family' => 'Hind:400,700|Lato:400,600,700|Poppins:400,500,600,700'
	);

	wp_enqueue_style( 'newsmag-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), 1, 'all' );
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

	wp_enqueue_script( 'owlCarousel-js', get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min
				.js', array( 'jquery' ), '1.3.3', true );
	// owlCarousel Stylesheet
	wp_enqueue_style( 'owlCarousel-main-css', get_template_directory_uri() . '/css/owl-carousel/owl.carousel.min.css' );
	wp_enqueue_style( 'owlCarousel-theme-css', get_template_directory_uri() . '/css/owl-carousel/owl.theme.default.css' );
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

if ( ! function_exists( 'newsmag_author_extra_social_links' ) ) {

	/**
	 * Function used to register more social profiles on the w.org admin back-end -> user profile.
	 *
	 * @param $user
	 */
	function newsmag_author_extra_social_links( $user ) {

		echo '<div class="shapely-extra-profile-links">';
		echo '<h2>' . __( 'Shapely Profile Links', 'shapely' ) . '</h2>';
		echo '<small>' . __( 'These user profile fields are being registered through the current active theme - Newsmag. If you disable the theme, this information will be lost.', 'shapely' ) . '</small>';

		echo '<table class="form-table">';
		echo '<tr>';
		echo '<th><label for="facebook_profile">' . __( 'Facebook Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="facebook_profile" value="' . esc_attr( get_the_author_meta( 'facebook_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="twitter_profile">' . __( 'Twitter Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="twitter_profile" value="' . esc_attr( get_the_author_meta( 'twitter_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="github_profile">' . __( 'Github Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="github_profile" value="' . esc_attr( get_the_author_meta( 'github_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="dribble_profile">' . __( 'Dribbble Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="dribble_profile" value="' . esc_attr( get_the_author_meta( 'dribble_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="vimeo_profile">' . __( 'Vimeo Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="vimeo_profile" value="' . esc_attr( get_the_author_meta( 'vimeo_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="google-plus_profile">' . __( 'Google Plus Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="google-plus_profile" value="' . esc_attr( get_the_author_meta( 'google-plus_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="linkedin_profile">' . __( 'Linkedin Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="linkedin_profile" value="' . esc_attr( get_the_author_meta( 'linkedin_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="pinterest_profile">' . __( 'Pinterest Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="pinterest_profile" value="' . esc_attr( get_the_author_meta( 'pinterest_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="tumblr_profile">' . __( 'TumblrR Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="tumblr_profile" value="' . esc_attr( get_the_author_meta( 'tumblr_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="youtube_profile">' . __( 'YouTube Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="youtube_profile" value="' . esc_attr( get_the_author_meta( 'youtube_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="flickr_profile">' . __( 'FlickR Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="flickr_profile" value="' . esc_attr( get_the_author_meta( 'flickr_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="instagram_profile">' . __( 'Instagram Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="instagram_profile" value="' . esc_attr( get_the_author_meta( 'instagram_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '<tr>';
		echo '<th><label for="codepen_profile">' . __( 'Codepen Profile', 'newsmag' ) . '</label></th>';
		echo '<td><input type="text" name="codepen_profile" value="' . esc_attr( get_the_author_meta( 'codepen_profile', $user->ID ) ) . '" class="regular-text" /></td>';
		echo '</tr>';

		echo '</table>';
		echo '</div><!--/.shapely-extra-profile-links-->';
	}

	// hook our functions
	add_action( 'show_user_profile', 'newsmag_author_extra_social_links' );
	add_action( 'edit_user_profile', 'newsmag_author_extra_social_links' );

}

if ( ! function_exists( 'newsmag_save_extra_social_links' ) ) {

	/**
	 * @param $user_id
	 */
	function newsmag_save_extra_social_links( $user_id ) {
		update_user_meta( $user_id, 'facebook_profile', sanitize_text_field( $_POST['facebook_profile'] ) );
		update_user_meta( $user_id, 'twitter_profile', sanitize_text_field( $_POST['twitter_profile'] ) );
		update_user_meta( $user_id, 'github_profile', sanitize_text_field( $_POST['github_profile'] ) );
		update_user_meta( $user_id, 'dribble_profile', sanitize_text_field( $_POST['dribble_profile'] ) );
		update_user_meta( $user_id, 'vimeo_profile', sanitize_text_field( $_POST['vimeo_profile'] ) );
		update_user_meta( $user_id, 'google_plus_profile', sanitize_text_field( $_POST['google_plus_profile'] ) );
		update_user_meta( $user_id, 'linkedin_profile', sanitize_text_field( $_POST['linkedin_profile'] ) );
		update_user_meta( $user_id, 'pinterest_profile', sanitize_text_field( $_POST['pinterest_profile'] ) );
		update_user_meta( $user_id, 'tumblr_profile', sanitize_text_field( $_POST['tumblr_profile'] ) );
		update_user_meta( $user_id, 'youtube_profile', sanitize_text_field( $_POST['youtube_profile'] ) );
		update_user_meta( $user_id, 'flickr_profile', sanitize_text_field( $_POST['flickr_profile'] ) );
		update_user_meta( $user_id, 'instagram_profile', sanitize_text_field( $_POST['instagram_profile'] ) );
		update_user_meta( $user_id, 'codepen_profile', sanitize_text_field( $_POST['codepen_profile'] ) );
	}

	//hook our functions
	add_action( 'personal_options_update', 'newsmag_save_extra_social_links' );
	add_action( 'edit_user_profile_update', 'newsmag_save_extra_social_links' );
}


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