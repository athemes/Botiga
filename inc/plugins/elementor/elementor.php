<?php
/**
 * Elementor Compatibility File
 *
 * @package Botiga
 */

class Botiga_Elementor_Compatibility {
    public function __construct() {

        // Init
        add_action( 'wp', array( $this, 'init' ) );
        
    }

    /**
     * Initialize through 'wp' action
     * 
     */
    public function init() {

        // Register elementor locations (Theme Builder)
        add_action( 'elementor/theme/register_locations', array( $this, 'register_elementor_locations' ) );

    }

    /**
     * Register elementor locations
     * 
     */
    public function register_elementor_locations( $elementor_theme_manager ) {
        $elementor_theme_manager->register_location( 'header' );
        $elementor_theme_manager->register_location( 'footer' );
    }
}

new Botiga_Elementor_Compatibility();