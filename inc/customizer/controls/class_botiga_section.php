<?php
/**
 * Botiga Customizer Section
 *
 * @package Botiga
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Section_Hidden extends WP_Customize_Section {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'botiga-section-hidden';
}
