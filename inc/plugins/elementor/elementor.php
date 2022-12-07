<?php
/**
 * Elementor Compatibility File
 *
 * @package Botiga
 */

class Botiga_Elementor_Compatibility {
    public function __construct() {

        // Extend Motion Effects with custom animations
        add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'extend_motion_effects' ) );

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

    /**
     * Extend Motion Effects with custom animations filter callback
     * 
     */
    public function extend_motion_effects( $additional_animations ) {
        $additional_animations[ 'Botiga' ] = array(
            'fadeInUpShorter' => esc_html__( 'Fade In Up Shorter', 'botiga' ),
            'fadeInDownShorter' => esc_html__( 'Fade In Down Shorter', 'botiga' ),
            'fadeInLeftShorter' => esc_html__( 'Fade In Left Shorter', 'botiga' ),
            'fadeInRightShorter' => esc_html__( 'Fade In Right Shorter', 'botiga' )
        );

        return $additional_animations;
    }
}

new Botiga_Elementor_Compatibility();