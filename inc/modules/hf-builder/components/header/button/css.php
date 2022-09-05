<?php
/**
 * Header/Footer Builder
 * Button Component CSS Output
 * 
 * @package Botiga_Pro
 */

/**
 * Default State
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_background_color', '', '.bhfb-component-button .button' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_color', '', '.bhfb-component-button .button' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_border_color', '', '.bhfb-component-button .button' );

/**
 * Hover State
 */

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_background_color_hover', '', '.bhfb-component-button .button:hover' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_color_hover', '', '.bhfb-component-button .button:hover' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_border_color_hover', '', '.bhfb-component-button .button:hover' );

/**
 * Sticky Header Active State
 */
if( botiga_sticky_header_enabled() ) {

    /**
     * Default State
     */

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_sticky_background_color', '', '.sticky-header-active .bhfb-component-button .button' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_sticky_color', '', '.sticky-header-active .bhfb-component-button .button' );

    // Border Color
    $css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_sticky_border_color', '', '.sticky-header-active .bhfb-component-button .button' );

    /**
     * Hover State
     */

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_sticky_background_color_hover', '', '.sticky-header-active .bhfb-component-button .button:hover' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_sticky_color_hover', '', '.sticky-header-active .bhfb-component-button .button:hover' );

    // Border Color
    $css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_sticky_border_color_hover', '', '.sticky-header-active .bhfb-component-button .button:hover' );

}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound