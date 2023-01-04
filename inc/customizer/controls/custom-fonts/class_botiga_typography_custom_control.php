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

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
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

		?>
		<div class="botiga-typography-custom-control">

			<?php if( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			<?php } ?>

			<?php if( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php } ?>

			<?php $custom_fonts = json_decode( get_theme_mod( 'custom_fonts', '[]' ), true ); ?>

			<select class="botiga-typography-custom-select" <?php $this->link(); ?>>
				<option value=""><?php esc_html_e( 'System default', 'botiga' ); ?></option>
				<?php if ( ! empty( $custom_fonts ) ) : ?>
					<?php foreach ( $custom_fonts as $font ) : ?>
						<?php $selected = $this->value() === $font['name'] ? true : false; ?>
						<option value="<?php echo esc_attr( $font['name'] ); ?>" <?php selected( $selected ); ?>><?php echo esc_html( $font['name'] ); ?></option>
					<?php endforeach; ?>
				<?php endif; ?>
			</select>

		</div>
		<?php
	}

}
