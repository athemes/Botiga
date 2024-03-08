<?php
/**
 * Botiga WP-CLI commands.
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'WP_CLI' ) ) {
	return;
}

if ( ! WP_CLI ) {
	return;
}

class Botiga_WP_CLI {

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		add_action( 'cli_init', array( $this, 'regenerate_custom_css' ) );
	}

	/**
	 * Regenerate custom CSS.
	 * Regenerates the dynamic custom css file from the theme.
	 * 
	 * @return void
	 */
	public function regenerate_custom_css() {
		WP_CLI::add_command( 'bt-custom-css', function(){
			$custom_css = new Botiga_Custom_CSS();
			$custom_css->update_custom_css_file();

			WP_CLI::success( 'Custom CSS regenerated.' );
		} );
	}
}

new Botiga_WP_CLI();
