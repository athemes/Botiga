<?php
/**
 * Merchant Compatibility Assets File
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Merchant' ) ) {
	return;
}

class Botiga_Merchant_Compatibility_Assets {

    /**
     * Constructor
     * 
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_css' ) );
    }

    /**
     * Enqueue CSS
     * 
     * @return void
     */
    public function enqueue_css() {
        wp_enqueue_style( 'botiga-merchant-compatibility', get_template_directory_uri() . '/assets/css/merchant.min.css', array(), BOTIGA_VERSION );
    }
}

new Botiga_Merchant_Compatibility_Assets();