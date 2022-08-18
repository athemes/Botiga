<?php
/**
 * Header/Footer Builder
 * Button Component 2 CSS Output
 * 
 * @package Botiga_Pro
 */

/**
 * Default State
 */

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button2_background_color', '', '.bhfb-component-button2 .button' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button2_color', '', '.bhfb-component-button2 .button' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button2_border_color', '', '.bhfb-component-button2 .button' );

/**
 * Hover State
 */

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button2_background_color_hover', '', '.bhfb-component-button2 .button:hover' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button2_color_hover', '', '.bhfb-component-button2 .button:hover' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button2_border_color_hover', '', '.bhfb-component-button2 .button:hover' );

/**
 * Sticky Header Active State
 */
if( botiga_sticky_header_enabled() ) {

    /**
     * Default State
     */

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button2_sticky_background_color', '', '.sticky-header-active .bhfb-component-button2 .button' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button2_sticky_color', '', '.sticky-header-active .bhfb-component-button2 .button' );

    // Border Color
    $css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button2_sticky_border_color', '', '.sticky-header-active .bhfb-component-button2 .button' );

    /**
     * Hover State
     */

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button2_sticky_background_color_hover', '', '.sticky-header-active .bhfb-component-button2 .button:hover' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button2_sticky_color_hover', '', '.sticky-header-active .bhfb-component-button2 .button:hover' );

    // Border Color
    $css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button2_sticky_border_color_hover', '', '.sticky-header-active .bhfb-component-button2 .button:hover' );

}