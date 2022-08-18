<?php
/**
 * Footer Builder
 * Button 2 Component CSS Output
 * 
 * @package Botiga_Pro
 */

/**
 * Default State
 */

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_footer_button2_background_color', '', '.bhfb-footer .bhfb-component-button2 .button' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_footer_button2_color', '', '.bhfb-footer .bhfb-component-button2 .button' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_footer_button2_border_color', '', '.bhfb-footer .bhfb-component-button2 .button' );

/**
 * Hover State
 */

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_footer_button2_background_color_hover', '', '.bhfb-footer .bhfb-component-button2 .button:hover' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_footer_button2_color_hover', '', '.bhfb-footer .bhfb-component-button2 .button:hover' );

// Border Color
$css .= Botiga_Custom_CSS::get_border_color_css( 'bhfb_footer_button2_border_color_hover', '', '.bhfb-footer .bhfb-component-button2 .button:hover' );