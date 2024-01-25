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

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'bhfb_button_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-button, .bhfb-mobile_offcanvas .bhfb-builder-item.bhfb-component-button', 
    'display',
    ''
);

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_background_color', '#212121', '.bhfb-component-button .button' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_color', '#FFF', '.bhfb-component-button .button' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_border_color', '#212121', '.bhfb-component-button .button' );

/**
 * Hover State
 */

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_background_color_hover', '#757575', '.bhfb-component-button .button:hover' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_color_hover', '#FFF', '.bhfb-component-button .button:hover' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_border_color_hover', '#757575', '.bhfb-component-button .button:hover' );

/**
 * Sticky Header Active State
 */
if( botiga_sticky_header_enabled() ) {

    /**
     * Default State
     */

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_sticky_background_color', '#212121', '.sticky-header-active .bhfb-component-button .button' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_sticky_color', '#FFF', '.sticky-header-active .bhfb-component-button .button' );

    // Border Color
    $css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_sticky_border_color', '#212121', '.sticky-header-active .bhfb-component-button .button' );

    /**
     * Hover State
     */

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_button_sticky_background_color_hover', '#757575', '.sticky-header-active .bhfb-component-button .button:hover' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_button_sticky_color_hover', '#757575', '.sticky-header-active .bhfb-component-button .button:hover' );

    // Border Color
    $css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_button_sticky_border_color_hover', '#757575', '.sticky-header-active .bhfb-component-button .button:hover' );

}

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_button_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-header .bhfb-component-button', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_button_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-header .bhfb-component-button', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound