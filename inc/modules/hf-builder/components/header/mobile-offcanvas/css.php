<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Padding.
$padding = get_theme_mod( 'bhfb_mobile_offcanvas_padding', 30 );
$css .= '.bhfb-mobile_offcanvas { padding: '. esc_attr( $padding ) .'px; }';

// Elements Spacing.
$el_spacing = get_theme_mod( 'mobile_menu_elements_spacing', 20 );
$css .= '.bhfb-mobile_offcanvas .bhfb-builder-item + .bhfb-builder-item { margin-top: '. esc_attr( $el_spacing ) .'px; }';

// Close Icon Offset
$offset = get_theme_mod( 'bhfb_mobile_offcanvas_close_offset', 25 );
$css .= '.bhfb-mobile_offcanvas .mobile-menu-close { top: '. esc_attr( $offset ) .'px; right: '. esc_attr( $offset ) .'px; }';

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'offcanvas_menu_background', '#FFF', '.bhfb-mobile_offcanvas' );

// Close Icon Background
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_mobile_offcanvas_close_background_color', 'rgba(255,255,255,0)', '.bhfb-mobile_offcanvas .mobile-menu-close' );

// Close Icon Text Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_mobile_offcanvas_close_text_color', '#212121', '.bhfb-mobile_offcanvas .mobile-menu-close svg' );

// Close Icon Text Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_mobile_offcanvas_close_text_color_hover', '#757575', '.bhfb-mobile_offcanvas .mobile-menu-close:hover svg' );

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound