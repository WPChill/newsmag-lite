<?php

if ( ! class_exists( 'MT_Notify_System' ) ) {
	/**
	 * Class MT_Notify_System
	 */
	class MT_Notify_System {
		/**
		 * @param $ver
		 *
		 * @return mixed
		 */
		public static function version_check( $ver ) {
			$newsmag = wp_get_theme();

			return version_compare( $newsmag['Version'], $ver, '>=' );
		}

		/**
		 * @return bool
		 */
		public static function is_not_static_page() {
			return 'page' == get_option( 'show_on_front' ) ? true : false;
		}

		/**
		 * @return bool
		 */
		public static function has_widgets() {
			if ( ! is_active_sidebar( 'homepage-slider' ) && ! is_active_sidebar( 'content-area' ) ) {
				return false;
			}

			return true;
		}

		/**
		 * @return bool
		 */
		public static function newmsag_has_posts() {
			$args  = array( "s" => 'Gary Johns: \'What is Aleppo\'' );
			$query = get_posts( $args );

			if ( ! empty( $query ) ) {
				return true;
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public static function has_content() {
			$check = array(
				'widgets' => self::has_widgets(),
				'posts'   => self::newmsag_has_posts(),
			);

			if ( $check['widgets'] && $check['posts'] ) {
				return true;
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public static function check_wordpress_importer() {
			if ( file_exists( ABSPATH . 'wp-content/plugins/wordpress-importer/wordpress-importer.php' ) ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				return is_plugin_active( 'wordpress-importer/wordpress-importer.php' );
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public static function check_plugin_is_installed( $slug ) {
			if ( file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $slug . '.php' ) ) {
				return true;
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public static function check_plugin_is_active( $slug ) {
			if ( file_exists( ABSPATH . 'wp-content/plugins/' . $slug . '/' . $slug . '.php' ) ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				return is_plugin_active( $slug . '/' . $slug . '.php' );
			}
		}

		/**
		 * @return string
		 */
		public static function wordpress_importer_description() {
			$installed = self::check_plugin_is_installed( 'wordpress-importer' );
			if ( ! $installed ) {
				return __( 'Please install the WordPress Importer to create the demo content.', 'newsmag' );
			}

			$active = self::check_plugin_is_active( 'wordpress-importer' );
			if ( $installed && ! $active ) {
				return __( 'Please activate the WordPress Importer to create the demo content.', 'newsmag' );
			}

			return __( 'Please install the WordPress Importer to create the demo content.', 'newsmag' );
		}

		public static function force_regenerate_thumbnails_description() {
			$installed = self::check_plugin_is_installed( 'force-regenerate-thumbnails' );
			if ( ! $installed ) {
				return __( 'Please install this plugin to regenerate your images using our custom image sizes.', 'newsmag' );
			}

			$active = self::check_plugin_is_active( 'force-regenerate-thumbnails' );
			if ( $installed && ! $active ) {
				return __( 'Please activate this plugin and regenerate your images using our custom image sizes.', 'newsmag' );
			}

			return __( 'Please install this plugin to regenerate your images using our custom image sizes.', 'newsmag' );

		}

		public static function widget_importer_exporter_description() {
			$installed = self::check_plugin_is_installed( 'widget-importer-exporter' );
			if ( ! $installed ) {
				return __( 'Please install the WordPress widget importer to create the demo content', 'newsmag' );
			}

			$active = self::check_plugin_is_active( 'widget-importer-exporter' );
			if ( $installed && ! $active ) {
				return __( 'Please activate the WordPress Widget Importer to create the demo content.', 'newsmag' );
			}

			return __( 'Please install the WordPress widget importer to create the demo content', 'newsmag' );

		}

		/**
		 * @return bool
		 */
		public static function is_not_template_front_page() {
			$page_id = get_option( 'page_on_front' );

			return get_page_template_slug( $page_id ) == 'page-templates/frontpage-template.php' ? true : false;
		}
	}
}