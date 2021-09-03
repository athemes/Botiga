<?php
/**
 * Botiga Accordion Control
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Accordion_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 */
	public $type  = 'botiga-accordion';
    public $until = '';
    public $start_after = '';

    /**
     * Displays the control content.
     *
     */
    public function render_content() {
    ?>
        <a href="#" class="botiga-accordion-title" data-until="<?php echo esc_attr( $this->until ); ?>" data-start-after="<?php echo esc_attr( $this->start_after ); ?>"><?php echo esc_html( $this->label ); ?></a>  
    <?php 
    }
}
