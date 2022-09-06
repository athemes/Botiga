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

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

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

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound