<?php

if ( ! class_exists( 'Epsilon_Control_Upsell' ) ):
	class Epsilon_Control_Upsell extends WP_Customize_Control {

		public $type = 'mte_upsell';
		public $button_text = 'Hello';
		public $button_url = '#';
		public $options = array();
		public $requirements = array();

		public $pro_label = 'Pro';//__( 'Pro Option', 'macho' );

		public function to_json() {
			parent::to_json();
			$this->json['button_text'] = $this->button_text;
			$this->json['button_url'] = $this->button_url;
			$this->json['options'] = $this->options;
			$this->json['requirements'] = $this->requirements;

			$this->json['pro_label'] = $this->pro_label;
		}

		public function content_template() { ?>
			<div class="macho-upsell">
				<# if ( data.options ) { #>
					<ul class="macho-upsell-options">
						<# for (option in data.options) { #>
							<li><span class="wp-ui-notification">{{ data.pro_label }}</span>{{ data.options[option] }}
							</li>
							<# } #>
					</ul>
					<# } #>

						<# if ( data.button_text && data.button_url ) { #>
							<a href="{{ data.button_url }}" class="button button-primary aligncenter" target="_blank">{{
								data.button_text }}</a>
							<# } #>
								<hr>

								<# if ( data.requirements ) { #>
									<ul class="macho-upsell-requirements">
										<# for (requirement in data.requirements) { #>
											<li>*{{ data.requirements[requirement] }}</li>
											<# } #>
									</ul>
									<# } #>
			</div>
		<?php }
	}
endif;