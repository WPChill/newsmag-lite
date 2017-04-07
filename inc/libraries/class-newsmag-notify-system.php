<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Class Epsilon_Notify_System
 */
class Newsmag_Notify_System extends Epsilon_Notify_System {
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

	public static function has_import_plugin( $slug = NULL ) {
		$return = self::has_content();

		if ( $return ) {
			return true;
		}
		$check = array(
			'installed' => self::check_plugin_is_installed( $slug ),
			'active'    => self::check_plugin_is_active( $slug )
		);

		if ( ! $check['installed'] || ! $check['active'] ) {
			return false;
		}

		return true;
	}

	public static function has_import_plugins() {
		$check = array(
			'wordpress-importer'       => array( 'installed' => false, 'active' => false ),
			'widget-importer-exporter' => array( 'installed' => false, 'active' => false )
		);

		$content = self::has_content();
		$return  = false;
		if ( $content ) {
			return true;
		}

		$stop = false;
		foreach ( $check as $plugin => $val ) {
			if ( $stop ) {
				continue;
			}

			$check[ $plugin ]['installed'] = self::check_plugin_is_installed( $plugin );
			$check[ $plugin ]['active']    = self::check_plugin_is_active( $plugin );

			if ( ! $check[ $plugin ]['installed'] || ! $check[ $plugin ]['active'] ) {
				$return = true;
				$stop   = true;
			}

		}

		return $return;
	}

	public static function widget_importer_exporter_title() {
		$installed = self::check_plugin_is_installed( 'widget-importer-exporter' );
		if ( ! $installed ) {
			return __( 'Install: Widget Importer Exporter Plugin', 'newsmag' );
		}

		$active = self::check_plugin_is_active( 'widget-importer-exporter' );
		if ( $installed && ! $active ) {
			return __( 'Activate: Widget Importer Exporter Plugin', 'newsmag' );
		}

		return __( 'Install: Widget Importer Exporter Plugin', 'newsmag' );
	}

	public static function wordpress_importer_title() {
		$installed = self::check_plugin_is_installed( 'wordpress-importer' );
		if ( ! $installed ) {
			return __( 'Install: WordPress Importer', 'newsmag' );
		}

		$active = self::check_plugin_is_active( 'wordpress-importer' );
		if ( $installed && ! $active ) {
			return __( 'Activate: WordPress Importer', 'newsmag' );
		}

		return __( 'Install: WordPress Importer', 'newsmag' );
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
