<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Epsilon_Section_Pro extends WP_Customize_Section {
	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'epsilon-section-pro';
	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $button_url = '';

	/**
	 * Epsilon_Section_Pro constructor.
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string               $id
	 * @param array                $args
	 */
	public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
		$manager->register_control_type( 'Epsilon_Section_Pro' );
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function json() {
		$json = parent::json();
		$json['button_url']  = esc_url( $this->button_url );

		return $json;
	}
	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

			<h3 class="accordion-section-title epsilon-pro-section-title" >
				{{ data.title }}

				<# if ( data.button_url ) { #>
					<a href="{{ data.button_url }}" class="epsilon-full-section-button" target="_blank"> </a>
				<# } #>
			</h3>
		</li>
	<?php }
}