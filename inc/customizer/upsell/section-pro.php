<?php
/**
 * Pro customizer section.
 *
 * @since  1.0.0
 */
class Botiga_Customize_Upsell_Section_Pro extends WP_Customize_Section {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @var    string
	 */
	public $type = 'botiga-upsell';

	/**
	 * Custom button text to output.
	 *
	 * @since  1.0.0
	 * @var    string
	 */
	public $pro_text = '';

	/**
	 * Custom pro button URL.
	 *
	 * @since  1.0.0
	 * @var    string
	 */
	public $pro_url = '';

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = $this->pro_url;

		return $json;
	}

	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	protected function render_template() { ?>

		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<div class="botiga-upsell-button-wrapper">
				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="botiga-upsell-button" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</div>
		</li>
	<?php }
}
