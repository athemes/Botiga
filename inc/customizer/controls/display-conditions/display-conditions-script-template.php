<?php
/**
 * Display conditions script template
 *
 * @package Botiga
 */

function botiga_customizer_display_conditions_script_template() {
	botiga_display_conditions_script_template();
}
add_action( 'customize_controls_print_footer_scripts', 'botiga_customizer_display_conditions_script_template' );
