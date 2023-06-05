<?php
/**
 * Botiga Customizer Section Upsell Message
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Section_Upsell_Message extends WP_Customize_Section {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-section-upsell-message';
	public $display_thumb = false;
	public $features_list = array();
	public $button_text   = '';
	public $button_link   = 'https://athemes.com/botiga-upgrade?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga';

    public function __construct( $wp_customize, $id, $args = array(), $options = array() ) {
		parent::__construct( $wp_customize, $id, $args );

        $this->button_text = esc_html__( 'Upgrade Now', 'botiga' );
	}

    /**
	 * Gather the parameters passed to client JavaScript via JSON.
	 *
	 */
	public function json() {
		$array                   = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden' ) );
		$array['title']          = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
		$array['content']        = $this->get_content();
		$array['active']         = $this->active();
		$array['instanceNumber'] = $this->instance_number;

        $array['display_thumb'] = $this->display_thumb;
        $array['features_list'] = $this->features_list;
        $array['button_text']   = $this->button_text;
        $array['button_link']   = $this->button_link;

		if ( $this->panel ) {
			/* translators: &#9656; is the unicode right-pointing triangle. %s: Section title in the Customizer. */
			$array['customizeAction'] = sprintf( __( 'Customizing &#9656; %s', 'botiga' ), esc_html( $this->manager->get_panel( $this->panel )->title ) );
		} else {
			$array['customizeAction'] = __( 'Customizing', 'botiga' );
		}

		return $array;
	}

    /**
	 * An Underscore (JS) template for rendering this section.
	 *
	 * Class variables for this section class are available in the `data` JS object;
	 * export custom variables by overriding WP_Customize_Section::json().
	 *
	 */
	protected function render_template() {
		?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }}">
            <div class="botiga-upsell-feature-wrapper">
                <# if ( data.display_thumb ) { #>
                    <div class="botiga-upsell-feature-thumb">
                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/admin/customizer-upsell-thumbnail.png' ); ?>" alt="<?php esc_attr_e( 'Botiga Pro', 'botiga' ); ?>" />
                    </div>
                <# } #>
                <# if ( data.title ) { #>
                    <strong>{{ data.title }}</strong>
                <# } #>
                <# if ( data.features_list ) { #>
                    <ul class="botiga-upsell-features-list">
                        <# _.each( data.features_list, function( feature ) { #>
                            <li>
                                <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.5 13.5C10.0899 13.5 13 10.5899 13 7C13 3.41015 10.0899 0.5 6.5 0.5C2.91015 0.5 0 3.41015 0 7C0 10.5899 2.91015 13.5 6.5 13.5ZM9.04966 4.45032C9.2612 4.66185 9.2612 5.00482 9.04966 5.21635L7.26606 7L9.04966 8.78367C9.2612 8.99521 9.2612 9.33812 9.04966 9.54966C8.83812 9.7612 8.49521 9.7612 8.28367 9.54966L6.5 7.76606L4.71635 9.54966C4.50482 9.7612 4.16185 9.7612 3.95032 9.54966C3.73879 9.33812 3.73879 8.99521 3.95032 8.78367L5.73394 7L3.95032 5.21635C3.73879 5.00482 3.73879 4.66185 3.95032 4.45032C4.16185 4.23879 4.50482 4.23879 4.71635 4.45032L6.5 6.23394L8.28367 4.45032C8.49521 4.23879 8.83812 4.23879 9.04966 4.45032Z" fill="#3858E9"/>
                                    <rect x="2.16602" y="2.66602" width="7.22222" height="7.94444" fill="#3858E9"/>
                                    <path d="M8.95783 4.71165L8.84116 4.62887L8.75294 4.74148L6.11936 8.10318L4.81026 7.1649L4.6941 7.08165L4.60533 7.19363L4.21644 7.6842L4.11851 7.80773L4.24676 7.89941L6.1912 9.28935L6.3079 9.37277L6.39644 9.25991L9.50755 5.2945L9.60471 5.17066L9.47634 5.07958L8.95783 4.71165Z" fill="white" stroke="white" stroke-width="0.3"/>
                                </svg>
                                {{{ feature }}}
                            </li>
                        <# } ); #>
                    </ul>
                <# } #>
                <a href="{{ data.button_link }}" role="button" class="botiga-upsell-button" target="_blank">
                    {{ data.button_text }}
                </a>
            </div>
		</li>
		<?php
	}
}
