<?php
/**
 * Create page control
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Upsell_Message extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type        = 'botiga-upsell-features';
	public $button_link = 'https://athemes.com/botiga-upgrade?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga';

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
		if( defined( 'BOTIGA_AWL_ACTIVE' ) ) {
			return '';
		}
		?>
		<div class="botiga-upsell-feature-wrapper">
			<a href="<?php echo esc_url( $this->button_link ) ?>" role="button" class="botiga-upsell-button" target="_blank">
				<?php echo esc_html( $this->description ); ?>
			</a>
		</div>
	<?php
	}
}
