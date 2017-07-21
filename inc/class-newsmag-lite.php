<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Newsmag_Lite
 */
class Newsmag_Lite {
	/**
	 * Newsmag_Lite constructor.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueues' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueues' ) );
		add_action( 'admin_init', array( $this, 'editor_enqueues' ) );
		/**
		 * Customizer enqueues & controls
		 */
		add_action( 'customize_register', array( $this, 'customize_register_init' ) );

		add_action( 'after_setup_theme', array( $this, 'content_width' ), 10 );
		/**
		 * Grab all class methods and initiate automatically
		 */
		$methods = get_class_methods( 'Newsmag_Lite' );

		foreach ( $methods as $method ) {
			if ( strpos( $method, 'init_' ) !== false ) {
				$this->$method();
			}
		}
	}

	/**
	 * Loads sidebars and widgets
	 */
	public function init_sidebars() {
		new Newsmag_Sidebars();
	}

	/**
	 * Load Hooks
	 */
	public function init_hooks() {
		new Newsmag_Hooks();
	}

	/**
	 * Load Lazyload
	 */
	public function init_lazyload() {
		new Newsmag_LazyLoad();
	}

	/**
	 * Load Breadcrumbs
	 */
	public function init_breadcrumbs() {
		new Newsmag_Breadcrumbs();
	}

	/**
	 * Initiate the setting helper
	 */
	public function customize_register_init() {
		new Newsmag_Customizer_Helper();
	}

	/**
	 * Initiate epsilon framework
	 */
	public function init_epsilon() {
		$args = array(
			'controls' => array( 'slider', 'toggle', 'typography', 'upsell', 'color-scheme' ),
			'sections' => array( 'pro', 'recommended-actions' ),
			'path'     => '/inc/libraries'
		);

		new Epsilon_Framework( $args );

		/**
		 * Instantiate the object
		 */
		$options = array(
			'newsmag_headings_typography',
			'newsmag_paragraphs_typography'
		);

		$handler = 'newsmag-stylesheet';
		Epsilon_Typography::get_instance( $options, $handler );

	}

	/**
	 * Initiate the welcome screen
	 */
	public function init_welcome_screen() {
		// Welcome screen
		if ( is_admin() ) {
			global $newsmag_required_actions, $newsmag_recommended_plugins;

			$newsmag_recommended_plugins = array(
				'kiwi-social-share'        => array( 'recommended' => false ),
				'modula-best-grid-gallery' => array( 'recommended' => true ),
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
					"title"       => Newsmag_Notify_System::wordpress_importer_title(),
					"description" => Newsmag_Notify_System::wordpress_importer_description(),
					"check"       => Newsmag_Notify_System::has_import_plugin( 'wordpress-importer' ),
					"plugin_slug" => 'wordpress-importer'
				),
				array(
					"id"          => 'newsmag-req-ac-install-wp-import-widget-plugin',
					"title"       => Newsmag_Notify_System::widget_importer_exporter_title(),
					'description' => Newsmag_Notify_System::widget_importer_exporter_description(),
					"check"       => Newsmag_Notify_System::has_import_plugin( 'widget-importer-exporter' ),
					"plugin_slug" => 'widget-importer-exporter'
				),
				array(
					"id"          => 'newsmag-req-ac-download-data',
					"title"       => esc_html__( 'Download theme sample data', 'newsmag' ),
					"description" => esc_html__( 'Head over to our website and download the sample content data.', 'newsmag' ),
					"help"        => '<a target="_blank"  href="https://www.machothemes.com/sample-data/newsmag-lite-posts.xml">' . __( 'Posts', 'newsmag' ) . '</a>, 
									   <a target="_blank"  href="https://www.machothemes.com/sample-data/newsmag-lite-widgets.wie">' . __( 'Widgets', 'newsmag' ) . '</a>',
					"check"       => Newsmag_Notify_System::has_content(),
				),
				array(
					"id"    => 'newsmag-req-ac-install-data',
					"title" => esc_html__( 'Import Sample Data', 'newsmag' ),
					"help"  => '<a class="button button-primary" target="_blank"  href="' . self_admin_url( 'admin.php?import=wordpress' ) . '">' . __( 'Import Posts', 'newsmag' ) . '</a> 
									   <a class="button button-primary" target="_blank"  href="' . self_admin_url( 'tools.php?page=widget-importer-exporter' ) . '">' . __( 'Import Widgets', 'newsmag' ) . '</a>',
					"check" => Newsmag_Notify_System::has_import_plugins(),
				),
				array(
					"id"          => 'newsmag-req-ac-static-latest-news',
					"title"       => esc_html__( 'Set front page to static', 'newsmag' ),
					"description" => esc_html__( 'If you just installed Newsmag, and are not able to see the front-page demo, you need to go to Settings -> Reading , Front page displays and select "Static Page".', 'newsmag' ),
					"help"        => 'If you need more help understanding how this works, check out the following <a target="_blank"  href="https://codex.wordpress.org/Creating_a_Static_Front_Page#WordPress_Static_Front_Page_Process">link</a>. <br/><br/> <a class="button button-secondary" target="_blank"  href="' . self_admin_url( 'options-reading.php' ) . '">' . __( 'Set manually', 'newsmag' ) . '</a> <a class="button button-primary"  href="' . wp_nonce_url( self_admin_url( 'themes.php?page=newsmag-welcome&tab=recommended_actions&action=set_page_automatic' ), 'set_page_automatic' ) . '">' . __( 'Set automatically', 'newsmag' ) . '</a>',
					"check"       => Newsmag_Notify_System::is_not_static_page()
				)
			);

			new Newsmag_Welcome_Screen();
		}
	}

	/**
	 * Register Scripts and Styles for the theme
	 */
	public function enqueues() {
		$newsmag = wp_get_theme();

		/**
		 * Load Google Fonts
		 */
		wp_enqueue_style( 'newsmag-fonts', '//fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Poppins:400,500,600,700', array(), $newsmag['Version'], 'all' );
		wp_enqueue_style( 'newsmag-icon', get_template_directory_uri() . '/assets/vendors/newsmag-icon/style.min.css' );

		/**
		 * Load the bootstrap framework
		 */
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.css' );
		wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap-theme.min.css' );
		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/vendors/bootstrap/bootstrap.min.js', array( 'jquery' ), $newsmag['Version'], true );

		/**
		 * Load offscreen helper
		 */
		wp_enqueue_script( 'newsmag-offscreen', get_template_directory_uri() . '/assets/vendors/offscreen/offscreen.min.js', array( 'jquery' ), $newsmag['Version'], true );

		/**
		 * Load the Sticky library
		 */
		wp_enqueue_script( 'newsmag-sticky', get_template_directory_uri() . '/assets/vendors/sticky/jquery.sticky.js', array( 'jquery' ), $newsmag['Version'], true );

		/**
		 * Theme styling
		 */
		wp_enqueue_style( 'newsmag-style', get_stylesheet_uri() );
		wp_enqueue_style( 'newsmag-stylesheet', get_template_directory_uri() . '/assets/css/style.css', array(), $newsmag['Version'] );

		/**
		 * Load menu script & skip-link-focus-fix
		 */
		wp_enqueue_script( 'newsmag-navigation', get_template_directory_uri() . '/assets/vendors/navigation/navigation.min.js', array(), $newsmag['Version'], true );
		wp_enqueue_script( 'newsmag-skip-link-focus-fix', get_template_directory_uri() . '/assets/vendors/skip-link-focus/skip-link-focus-fix.js', array(), $newsmag['Version'], true );

		/**
		 * Adsense loader
		 */
		wp_enqueue_script( 'adsense-loader', get_template_directory_uri() . '/assets/vendors/adsenseloader/jquery.adsenseloader.min.js', array( 'jquery' ), $newsmag['Version'], true );

		/**
		 * OwlCarousel Library
		 */
		wp_enqueue_script( 'owlCarousel', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.carousel.min.js', array( 'jquery' ), $newsmag['Version'], true );
		wp_enqueue_style( 'owlCarousel', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.carousel.min.css' );
		wp_enqueue_style( 'owlCarousel-themes', get_template_directory_uri() . '/assets/vendors/owl-carousel/owl.theme.default.css' );

		/**
		 * Load preloader
		 */
		wp_enqueue_style( 'newsmag-preloader', get_template_directory_uri() . '/assets/vendors/preloader/preloader.css' );

		/**
		 * Load Plyr
		 */
		wp_enqueue_script( 'plyr', get_template_directory_uri() . '/assets/vendors/plyr/plyr.js', array(), $newsmag['Version'], true );
		wp_enqueue_style( 'plyr', get_template_directory_uri() . '/assets/vendors/plyr/plyr.css' );

		/**
		 * Load the theme's core Javascript
		 */
		wp_enqueue_script( 'machothemes-object', get_template_directory_uri() . '/assets/vendors/machothemes/machothemes.min.js', array(), $newsmag['Version'], true );

		wp_enqueue_script( 'newsmag-functions', get_template_directory_uri() . '/assets/js/functions.js', array( 'jquery' ), $newsmag['Version'], true );

		$preloader        = get_theme_mod( 'newsmag_preloader_effect', false );
		$preloader_accent = get_theme_mod( 'newsmag_preloader_color', '#ff3d2e' );

		if ( $preloader && strtolower( $preloader_accent ) !== '#ff3d2e' ) {

			$css = '.loader {
				border-top:1px solid ' . Newsmag_Helper::adjust_brightness( $preloader_accent, 100 ) . ';
				border-right:1px solid ' . Newsmag_Helper::adjust_brightness( $preloader_accent, 100 ) . ';
				border-bottom:1px solid ' . Newsmag_Helper::adjust_brightness( $preloader_accent, 100 ) . ';
				border-left:1px solid ' . $preloader_accent . ';
			}';

			wp_add_inline_style( 'newsmag-preloader', $css );
		}

		wp_localize_script( 'newsmag-functions', 'WPUrls', array(
			'siteurl' => get_option( 'siteurl' ),
			'theme'   => get_template_directory_uri(),
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Admin enqueues
	 */
	public function admin_enqueues() {
		$newsmag = wp_get_theme();
		wp_enqueue_style( 'newsmag-fonts', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900|Poppins:400,500,600,700', array(), $newsmag['Version'], 'all' );
		wp_enqueue_style( 'newsmag-lite-welcome-screen', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/css/welcome.css', array(), '123123' );
		wp_enqueue_script( 'newsmag-lite-welcome-screen', get_template_directory_uri() . '/inc/libraries/welcome-screen/assets/js/welcome.js', array( 'jquery', 'jquery-ui-slider' ), '112323123' );
	}

	/**
	 * Editor styles
	 */
	public function editor_enqueues() {
		add_editor_style( 'assets/css/custom-editor-style.css' );
	}

	/**
	 * Newsmag Theme Setup
	 */
	public function theme_setup() {

		load_theme_textdomain( 'newsmag', get_template_directory() . '/languages' );
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add theme support for custom header
		 */
		add_theme_support( 'custom-header', array(
			'width'   => 1920,
			'height'  => 200,
			'uploads' => true,
		) );

		add_theme_support( 'title-tag' );

		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'quote',
			'link',
			'gallery',
			'video',
			'status',
			'audio',
			'chat',
		) );

		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary', 'newsmag' ),
			'social'    => esc_html__( 'Social', 'newsmag' ),
			'copyright' => esc_html__( 'Copyright', 'newsmag' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-thumbnails' );

		add_image_size( 'newsmag-single-post', 730, 330, true );
		add_image_size( 'newsmag-recent-post-big', 560, 416, true );
		add_image_size( 'newsmag-post-horizontal', 350, 260, true );
		add_image_size( 'newsmag-vertical-post', 255, 195, true );
		add_image_size( 'newsmag-post-grid', 360, 270, true );
		add_image_size( 'newsmag-post-grid-small', 275, 210, true );
		add_image_size( 'newsmag-recent-post-list-image', 65, 65, true );
		add_image_size( 'newsmag-slider-image', 1920, 600, true );

		add_theme_support( 'custom-logo', array(
			'height'     => 90,
			'width'      => 300,
			'flex-width' => true,
		) );

		add_theme_support( 'custom-background', apply_filters( 'newsmag_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for Infinite Scroll.
		add_theme_support( 'infinite-scroll', array(
			'container' => 'main',
			'footer'    => 'page',
		) );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

	}

	/**
	 * Content width
	 */
	public function content_width() {
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 600;
		}
	}
}
