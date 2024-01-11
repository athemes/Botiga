<?php
/**
 * Multi List Toggle Control
 * This is a copy from the sortable control but without the sotable functionality.
 * The purpose of this control is having a list of items that can be toggled on and off.
 *
 * @package Botiga
 */

class Botiga_Multi_List_Toggle_Control extends WP_Customize_Control {
    public $type = 'botiga-multi-list-toggle-control';

	public function enqueue() {
		parent::enqueue();

		// Enqueue the script.
		wp_enqueue_script( 'botiga-multi-list-toggle-control', get_template_directory_uri() . '/inc/customizer/controls/multi-list-toggle/js/control.js', array( 'jquery', 'customize-base' ), BOTIGA_VERSION, false );
	}

	public function to_json() {
		parent::to_json();

		// Default value.
		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		// Value.
		$this->json['value'] = $this->value();

		// Choices.
		$this->json['choices'] = $this->choices;

		// The link.
		$this->json['link'] = $this->get_link();

		// The ID.
		$this->json['id'] = $this->id;

		// The ajaxurl in case we need it.
		$this->json['ajaxurl'] = admin_url( 'admin-ajax.php' );

		// Input attributes.
		$this->json['inputAttrs'] = '';
		if ( is_array( $this->input_attrs ) ) {
			foreach ( $this->input_attrs as $attr => $value ) {
				$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
			}
		}
	}

	protected function render_content() {}

	protected function content_template() { ?>
		<label class='botiga-multi-list-toggle'>
			<span class="customize-control-title">
				{{{ data.label }}}
			</span>
			<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
			<# } #>

			<ul class="sortable">
				<# _.each( data.value, function( choiceID ) { #>
					<# if ( data.choices[ choiceID ] ) { #>
						<li {{{ data.inputAttrs }}} class='botiga-multi-list-toggle-item' data-value='{{ choiceID }}'>
							<i class="dashicons dashicons-visibility visibility"></i>
							{{{ data.choices[ choiceID ] }}}
						</li>
					<# } #>
				<# }); #>
				<# _.each( data.choices, function( choiceLabel, choiceID ) { #>
					<# if ( -1 === data.value.indexOf( choiceID ) ) { #>
						<li {{{ data.inputAttrs }}} class='botiga-multi-list-toggle-item invisible' data-value='{{ choiceID }}'>
							<i class="dashicons dashicons-visibility visibility"></i>
							{{{ data.choices[ choiceID ] }}}
						</li>
					<# } #>
				<# }); #>
			</ul>
		</label>

		<?php
	}
}