<?php
/**
 * Typography custom control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Typography_Custom_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-typography-custom-control';

	public $title = '';

	public $custom_fonts = array();

	public $google_fonts = array();

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );

		$this->custom_fonts = json_decode( get_theme_mod( 'custom_fonts', '[]' ), true );

		$this->google_fonts = botiga_get_google_fonts();
	}

	/**
	 * Export our List of Google Fonts to JavaScript
	 */
	public function to_json() {
		parent::to_json();
		$this->json['google_fonts'] = $this->google_fonts;
	}

	/**
	 * Customize print styles
	 */
	public function enqueue() {
		add_action( 'customize_controls_print_styles', array( $this, 'print_styles' ) );
	}

	/**
	 * Embed the custom fonts
	 */
	public function print_styles() {
		echo '<style type="text/css">'. wp_strip_all_tags( botiga_get_custom_fonts() ) .'</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

		$google_font_weights = array();

		?>
		<div class="botiga-typography-custom-control">

			<?php if( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			<?php } ?>

			<?php if( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php } ?>

			<select class="botiga-typography-custom-select" data-control-name="<?php echo esc_attr( $this->id ); ?>" <?php $this->link( 'font-family' ); ?>>
				<option value="System default"><?php esc_html_e( 'System default', 'botiga' ); ?></option>
				<optgroup label="<?php esc_attr_e( 'Custom Fonts', 'botiga' ); ?>" data-type="custom-fonts">
					<?php if ( ! empty( $this->custom_fonts ) ) : ?>
						<?php foreach ( $this->custom_fonts as $font ) : ?>
							<?php $selected = $this->value( 'font-family' ) === $font['name'] ? true : false; ?>
							<option value="<?php echo esc_attr( $font['name'] ); ?>" <?php selected( $selected ); ?>><?php echo esc_html( $font['name'] ); ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</optgroup>
				<optgroup label="<?php esc_attr_e( 'Google Fonts', 'botiga' ); ?>" data-type="google-fonts">
					<?php if ( ! empty( $this->google_fonts ) ) : ?>
						<?php foreach ( $this->google_fonts as $key => $font ) : ?>
							<?php $selected = $this->value() === $font->family ? true : false; ?>
							<?php
								if ( $this->value( 'font-family' ) === $font->family ) {
									$google_font_weights = $font->variants;
								}
							?>
							<option value="<?php echo esc_attr( $font->family ); ?>" <?php selected( $selected ); ?>><?php echo esc_html( $font->family ); ?></option>
						<?php endforeach; ?>
					<?php endif; ?>
				</optgroup>
			</select>

			<?php $is_weight_hidden = empty( $google_font_weights ) ? ' hidden' : ''; ?>
			<div class="botiga-typography-custom-weight-select-wrapper<?php echo esc_attr( $is_weight_hidden ); ?>">
				<div class="customize-control-title"><?php esc_html_e( 'Font weight', 'botiga' ) ?></div>
				<select class="botiga-typography-custom-weight-select" <?php $this->link( 'font-weight' ); ?>>
					<?php
						if ( ! empty( $google_font_weights ) ) {
							foreach( $google_font_weights as $key => $weight ) {
								echo '<option value="'. esc_attr( $weight ) .'" '. selected( $weight, $this->value( 'font-weight' ), false ) .'>'. esc_html( $weight ) .'</option>';
							}
						}
					?>
				</select>
			</div>

		</div>
		<?php
	}
}
