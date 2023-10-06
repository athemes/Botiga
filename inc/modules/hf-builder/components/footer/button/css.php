<?php
/**
 * Footer Builder
 * Button 1 Component CSS Output
 * 
 * @package Botiga_Pro
 */

/**
 * Default State
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'bhfb_footer_button_visibility', 
    'visible', 
    '.bhfb.bhfb-footer .bhfb-builder-item.bhfb-component-button', 
    'display',
    ''
);

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_footer_button_background_color', '', '.bhfb-footer .bhfb-component-button .button' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_footer_button_color', '', '.bhfb-footer .bhfb-component-button .button' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_footer_button_border_color', '', '.bhfb-footer .bhfb-component-button .button' );

/**
 * Hover State
 */

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_footer_button_background_color_hover', '', '.bhfb-footer .bhfb-component-button .button:hover' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_footer_button_color_hover', '', '.bhfb-footer .bhfb-component-button .button:hover' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_footer_button_border_color_hover', '', '.bhfb-footer .bhfb-component-button .button:hover' );

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_footer_button_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-footer .bhfb-component-button', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_footer_button_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-footer .bhfb-component-button', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound