<?php
if ( ! class_exists( 'Epsilon_Typography' ) ) {
	/**
	 * Class Epsilon_Typography
	 */
	class Epsilon_Typography {
		/**
		 * Prefix for our custom control
		 *
		 * @var string
		 */
		protected $prefix;
		/**
		 * If there isn't any inline style, we don't need to generate the CSS
		 *
		 * @var bool
		 */
		protected $terminate = false;
		/**
		 * Options with defaults
		 *
		 * @var array
		 */
		protected $options = array();
		/**
		 * Stores the import url
		 *
		 * @var array
		 */
		protected $font_imports = array();
		/**
		 * Array that defines the controls/settings to be added in the customizer
		 *
		 * @var array
		 */
		protected $customizer_controls = array();

		/**
		 * Epsilon_Typography constructor.
		 *
		 * @param array $args
		 *
		 * Description
		 *
		 * Normal usage: Epsilon_Typography::get_instance( array $options )
		 *
		 * During construct, $this->options is being populated with the options
		 * defined as typography. After this, the inline scripts are enqueued.
		 */
		public function __construct( $args = array() ) {
			$this->options = $this->get_option( $args );
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
		}

		/**
		 * @param $args
		 *
		 * @return array
		 */
		public function get_option( $args ) {
			$options = array();

			if ( ! empty( $args ) ) {
				foreach ( $args as $option ) {
					$typo = get_theme_mod( $option, '' );
					if ( $typo === '' ) {
						continue;
					}

					$typo         = str_replace( '&quot;', '"', $typo );
					$typo         = (array) json_decode( $typo );
					$typo['json'] = (array) $typo['json'];

					$this->set_font( $typo['json']['font-family'] );

					$options[ $option ] = array_filter( $typo );
				}
			}

			return array_filter( $options );
		}

		/**
		 * Grabs the instance of the epsilon typography class
		 *
		 * @param null $args
		 *
		 * @return Epsilon_Typography
		 */
		public static function get_instance( $args = NULL ) {
			static $inst;

			if ( ! $inst ) {
				$inst = new Epsilon_Typography( $args );
			}

			return $inst;
		}


		/**
		 * Access the GFonts Json and parse its content.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array|mixed|object
		 */
		public function google_fonts( $font = NULL ) {
			global $wp_filesystem;
			if ( empty( $wp_filesystem ) ) {
				require_once( ABSPATH . '/wp-admin/includes/file.php' );
				WP_Filesystem();
			}

			$path   = get_template_directory() . '/inc/customizer/epsilon-framework/assets/data/gfonts.json';
			$gfonts = $wp_filesystem->get_contents( $path );
			$gfonts = json_decode( $gfonts );

			if ( empty( $font ) ) {
				return json_decode( $gfonts );
			}

			return $gfonts->$font;

		}

		/**
		 * @param $args
		 *
		 * @return bool
		 */
		public function set_font( $args ) {

			if ( is_array( $args ) ) {
				$args = $args['font-family'];
			}

			$defaults = array( 'Select font', 'Theme default', 'default_font', 'Lato' );
			if ( in_array( $args, $defaults ) ) {
				return false;
			}

			$font = $this->google_fonts( $args );

			if ( in_array( $args, $defaults ) ) {
				$this->font_imports = false;
			}

			$this->font_imports[] = $font->import;

			return true;
		}

		/**
		 * Return the css string for the live website
		 *
		 * @return string
		 */
		public function generate_css( $options ) {
			$css      = '';
			$defaults = array( 'Select font', 'Theme default', 'initial', 'default_font' );

			$css .= $options['selectors'] . '{' . "\n";
			foreach ( $options['json'] as $property => $value ) {
				$extra = '';

				if ( in_array( $value, $defaults ) ) {
					continue;
				}

				if ( $property === 'font-size' || $property === 'line-height' ) {
					$extra = 'px';
				}

				$css .= $property . ':' . $value . $extra . ';' . "\n";
			}
			$css .= '}' . "\n";

			return $css;
		}

		/**
		 * Enqueue the inline style CSS string
		 */
		public function enqueue() {
			$css   = '';
			$fonts = '';

			foreach ( $this->options as $k => $v ) {
				$css .= $this->generate_css( $v );
			}

			if ( $css !== '' ) {
				$this->font_imports = array_unique( $this->font_imports );
				foreach ( $this->font_imports as $font ) {
					if ( $font !== NULL ) {
						$fonts .= '@import url("https://fonts.googleapis.com/css?family=' . $font . '");' . "\n";
					}
				}
			}

			$css = $fonts . "\n" . $css;

			wp_add_inline_style( 'newsmag-stylesheet', $css );
		}

	}

	/**
	 * Instantiate the object
	 */
	$options = array(
		'newsmag_headings_typography',
		'newsmag_paragraphs_typography'
	);

	Epsilon_Typography::get_instance( $options );
	/**
	 * Add the actions for the customizer previewer
	 */
	add_action( 'wp_ajax_epsilon_generate_typography_css', 'epsilon_generate_typography_css' );
	add_action( 'wp_ajax_nopriv_epsilon_generate_typography_css', 'epsilon_generate_typography_css' );
	function epsilon_generate_typography_css() {
		$args = array(
			'selectors',
			'json'
		);

		/**
		 * Sanitize the $_POST['args']
		 */
		foreach ( $_POST['args']['json'] as $k => $v ) {
			$args['json'][ $k ] = esc_attr( $v );
		}
		$args['selectors'] = esc_attr( $_POST['args']['selectors'] );

		$id = esc_attr( $_POST['id'] );

		/**
		 * Grab the instance of the Epsilon Color Scheme
		 */
		$typography = Epsilon_Typography::get_instance( $id );
		$typography->set_font( $args['json'] );
		/**
		 * Echo the css inline sheet
		 */
		echo $typography->generate_css( $args );
		wp_die();
	}

	add_action( 'wp_ajax_epsilon_retrieve_font_weights', 'epsilon_retrieve_font_weights' );
	add_action( 'wp_ajax_nopriv_epsilon_retrieve_font_weights', 'epsilon_retrieve_font_weights' );
	function epsilon_retrieve_font_weights() {
		if ( empty( $_POST ) || empty( $_POST['args'] ) || $_POST['action'] !== 'epsilon_retrieve_font_weights' ) {
			wp_die();
		}

		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		$path   = get_template_directory() . '/inc/customizer/epsilon-framework/assets/data/gfonts.json';
		$gfonts = $wp_filesystem->get_contents( $path );
		$gfonts = json_decode( $gfonts );
		$return = array();

		$family   = $gfonts->{$_POST['args']};
		$return[] = array( 'text' => __( 'Theme default', 'newsmag' ), 'value' => 'initial' );

		foreach ( $family->variants as $weight ) {
			$return[] = array( 'text' => $weight, 'value' => $weight );
		}

		echo json_encode( $return );
		wp_die();

	}
}
