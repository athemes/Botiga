<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Menu Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Link Separator Color and Size.
$mobile_menu_link_separator 	= get_theme_mod( 'mobile_menu_link_separator', 0 );
if ( $mobile_menu_link_separator ) {
    $link_separator_color 			= get_theme_mod( 'link_separator_color', '#eeeeee' );
    $mobile_header_separator_width	= get_theme_mod( 'mobile_header_separator_width', 1 );

    $css .= ".botiga-offcanvas-menu .botiga-dropdown ul li { padding-top: 5px; border-bottom: " . intval( $mobile_header_separator_width ) . "px solid " . esc_attr( $link_separator_color ) . ";}";
}

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a + .dropdown-symbol svg' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a:hover + .dropdown-symbol svg' );

// Submenu Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_submenu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_submenu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu a + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_submenu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_submenu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu a:hover + .dropdown-symbol svg' );

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound