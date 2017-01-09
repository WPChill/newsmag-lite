<?php

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

		/**
		 * Add theme support for custom header
		 */
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
			                    'primary'   => esc_html__( 'Primary', 'newsmag' ),
			                    'social'    => esc_html__( 'Social', 'newsmag' ),
			                    'copyright' => esc_html__( 'Copyright', 'newsmag' )
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
		 * Image Sizes
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
			'height'     => 90,
			'width'      => 300,
			'flex-width' => true,
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'newsmag_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		// Welcome screen
		if ( is_admin() ) {
			global $newsmag_required_actions, $newsmag_recommended_plugins;

			$newsmag_recommended_plugins = array(
				'kiwi-social-share'           => array( 'recommended' => false ),
				'force-regenerate-thumbnails' => array( 'recommended' => true ),
				'wp-product-review'           => array( 'recommended' => false, 'tracking_url' => 'http://bit.ly/2iuuqs8' ),
				'pirate-forms'                => array( 'recommended' => false, 'tracking_url' => 'http://bit.ly/2iTSm9n' ),
				'visualizer'                  => array( 'recommended' => false, 'tracking_url' => 'bit.ly/2iupxzf' )
			);
			/*
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 *
			 */

			$newsmag_required_actions = array(
				array(
					"id"          => 'newsmag-req-ac-install-wp-import-plugin',
					"title"       => MT_Notify_System::wordpress_importer_title(),
					"description" => MT_Notify_System::wordpress_importer_description(),
					"check"       => MT_Notify_System::has_import_plugin( 'wordpress-importer' ),
					"plugin_slug" => 'wordpress-importer'
				),
				array(
					"id"          => 'newsmag-req-ac-install-wp-import-widget-plugin',
					"title"       => MT_Notify_System::widget_importer_exporter_title(),
					'description' => MT_Notify_System::widget_importer_exporter_description(),
					"check"       => MT_Notify_System::has_import_plugin( 'widget-importer-exporter' ),
					"plugin_slug" => 'widget-importer-exporter'
				),
				array(
					"id"          => 'newsmag-req-ac-download-data',
					"title"       => esc_html__( 'Download theme sample data', 'newsmag' ),
					"description" => esc_html__( 'Head over to our website and download the sample content data.', 'newsmag' ),
					"help"        => '<a target="_blank"  href="https://www.machothemes.com/sample-data/newsmag-lite-posts.xml">' . __( 'Posts', 'newsmag' ) . '</a>, 
									   <a target="_blank"  href="https://www.machothemes.com/sample-data/newsmag-lite-widgets.wie">' . __( 'Widgets', 'newsmag' ) . '</a>',
					"check"       => MT_Notify_System::has_content(),
				),
				array(
					"id"    => 'newsmag-req-ac-install-data',
					"title" => esc_html__( 'Import Sample Data', 'newsmag' ),
					"help"  => '<a class="button button-primary" target="_blank"  href="' . self_admin_url( 'admin.php?import=wordpress' ) . '">' . __( 'Import Posts', 'newsmag' ) . '</a> 
									   <a class="button button-primary" target="_blank"  href="' . self_admin_url( 'tools.php?page=widget-importer-exporter' ) . '">' . __( 'Import Widgets', 'newsmag' ) . '</a>',
					"check" => MT_Notify_System::has_import_plugins(),
				),
				array(
					"id"          => 'newsmag-req-ac-static-latest-news',
					"title"       => esc_html__( 'Set front page to static', 'newsmag' ),
					"description" => esc_html__( 'If you just installed Newsmag, and are not able to see the front-page demo, you need to go to Settings -> Reading , Front page displays and select "Static Page".', 'newsmag' ),
					"help"        => 'If you need more help understanding how this works, check out the following <a target="_blank"  href="https://codex.wordpress.org/Creating_a_Static_Front_Page#WordPress_Static_Front_Page_Process">link</a>. <br/><br/> <a class="button button-secondary" target="_blank"  href="' . self_admin_url( 'options-reading.php' ) . '">' . __( 'Set manually', 'newsmag' ) . '</a> <a class="button button-primary"  href="' . wp_nonce_url( self_admin_url( 'themes.php?page=newsmag-welcome&tab=recommended_actions&action=set_page_automatic' ), 'set_page_automatic' ) . '">' . __( 'Set automatically', 'newsmag' ) . '</a>',
					"check"       => MT_Notify_System::is_not_static_page()
				)
			);

			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}
	}
endif;
add_action( 'after_setup_theme', 'newsmag_setup' );

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