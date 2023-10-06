<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

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

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_mobile_offcanvas_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-mobile_offcanvas', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_mobile_offcanvas_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-mobile_offcanvas', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound