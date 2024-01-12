<?php
/**
 * Typography preview control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Typography_Preview_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-typography-preview-control';
		
	/**
	 * The control options
	 */
	public $options = array();

	/**
	 * Customizer manager.
	 */
	public $manager;

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		$this->manager = $manager;
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

		$props = array();

		// font family and font weight
		$library = get_theme_mod( 'fonts_library', 'google' );

		if ( $library === 'google' && isset( $this->options['google_font'] )  ) {

			$value = $this->manager->get_setting( $this->options['google_font'] )->value();

			if ( ! empty( $value ) ) {
				$values = json_decode( $value, true );
				if ( ! empty( $values['font'] ) ) {
					$props['font-family'] = '"'. $values['font'] .'"';
				}
				if ( ! empty( $values['regularweight'] ) ) {
					$props['font-weight'] = $values['regularweight'];
				}
			}

		} elseif ( $library == 'adobe' && isset( $this->options['adobe_font'] ) ) {

			$value = $this->manager->get_setting( $this->options['adobe_font'] )->value();

			if ( ! empty( $value ) ) {
				$values = explode( '|', $value );
				if ( ! empty( $values[0] ) ) {
					$props['font-family'] = '"'. $values[0] .'"';
				}
				if ( ! empty( $values[1] ) ) {
					$props['font-weight'] = str_replace( 'n4', '400', $values[1] );
				}
			}

		} elseif ( $library == 'custom' && isset( $this->options['custom_font'] ) ) {

			$value = $this->manager->get_setting( $this->options['custom_font'] )->value();

			if ( ! empty( $value ) ) {
				$props['font-family'] = '"'. $value .'"';
			}

			$weight_setting = $this->manager->get_setting( $this->options['custom_font'] .'_weight' );

			if ( ! empty( $weight_setting ) ) {

				$value = $weight_setting->value();

				if ( ! empty( $value ) ) {
					$props['font-weight'] = $value;
				}

			}

		}

		// font style, line-height, letter-spacing, text-transform, text-decoration
		$common_props = $this->options;

		if ( ! empty( $common_props ) ) {

			foreach ( $common_props as $common_prop => $setting_id ) {

				if ( in_array( $common_prop, array( 'google_font', 'adobe_font', 'custom_font' ) ) ) {
					continue;
				}

				$value = $this->manager->get_setting( $setting_id )->value();

				if ( $value !== '' ) {
					$unit = ( in_array( $common_prop, array( 'font-size', 'letter-spacing' ) ) ) ? 'px' : '';
					$props[ $common_prop ] = $value . $unit;
				}

			}

		}

		// styles
		$styles = '';

		if ( ! empty( $props ) ) {
			foreach ( $props as $prop => $value ) {
				$styles .= $prop .':'. $value .';';
			}
		}

	?>
		<div class="botiga-typography-preview" data-options="<?php echo esc_attr( wp_json_encode( $this->options ) ); ?>" style="<?php echo esc_attr( $styles ); ?>">Aa</div>
	<?php
	}
}
