<?php

if ( !class_exists( 'MT_Notify_System' ) ) {
	/**
	 * Class MT_Notify_System
	 */
	class MT_Notify_System {
		/**
		 * @param $ver
		 *
		 * @return mixed
		 */
		public static function newsmag_version_check( $ver ) {
			$newsmag = wp_get_theme();

			return version_compare( $newsmag['Version'], $ver, '>=' );
		}

		/**
		 * @return bool
		 */
		public static function newsmag_is_not_static_page() {
			return 'page' == get_option( 'show_on_front' ) ? true : false;
		}

		/**
		 * @return bool
		 */
		public static function newsmag_has_widgets() {
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
		public static function newsmag_has_content() {
			$check = array(
				'widgets' => self::newsmag_has_widgets(),
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
		public static function newsmag_check_wordpress_importer() {
			if ( file_exists( ABSPATH . 'wp-content/plugins/wordpress-importer/wordpress-importer.php' ) ) {
				include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

				return is_plugin_active( 'wordpress-importer/wordpress-importer.php' );
			}

			return false;
		}

		/**
		 * @return bool
		 */
		public static function newsmag_is_not_template_front_page() {
			$page_id = get_option( 'page_on_front' );

			return get_page_template_slug( $page_id ) == 'page-templates/frontpage-template.php' ? true : false;
		}
	}
}