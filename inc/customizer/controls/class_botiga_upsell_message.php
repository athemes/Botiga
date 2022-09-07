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
	public $type 		 	  = 'botiga-upsell-features';
	public $button_title 	  = '';
	public $button_link  	  = 'https://athemes.com/botiga-upgrade?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga';

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

		$this->button_title = __( 'Learn More', 'botiga' ); ?>

		<div class="botiga-upsell-feature-wrapper">
			<p><?php echo esc_html( $this->description ); ?></p>
			<a href="<?php echo esc_url( $this->button_link ) ?>" role="button" class="button button-secondary alignright upsell-button" target="_blank">
				<?php echo esc_html( $this->button_title ); ?>
			</a>
		</div>

	<?php
	}
}
