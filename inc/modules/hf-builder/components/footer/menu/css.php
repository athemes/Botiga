<?php
/**
 * Header/Footer Builder
 * Secondary Menu CSS Output
 * 
 * @package Botiga_Pro
 */

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'footer_menu_color', '', '.bhfb .botiga-footer-copyright-navigation a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'footer_menu_color', '', '.bhfb .botiga-footer-copyright-navigation a + .dropdown-symbol svg' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'footer_menu_color_hover', '', '.bhfb .botiga-footer-copyright-navigation a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'footer_menu_color_hover', '', '.bhfb .botiga-footer-copyright-navigation a:hover + .dropdown-symbol svg' );