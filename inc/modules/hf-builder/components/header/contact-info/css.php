<?php
/**
 * Header/Footer Builder
 * Contact Info Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'bhfb_contact_info_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-contact_info, .bhfb-mobile_offcanvas .bhfb-builder-item.bhfb-component-contact_info', 
    'display',
    ''
);

// Icons Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_color', '#212121', '.bhfb-component-contact_info .header-contact > a svg' );

// Icons Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_color_hover', '#757575', '.bhfb-component-contact_info .header-contact > a:hover svg' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_color', '#212121', '.bhfb-component-contact_info .header-contact > a' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_color_hover', '#757575', '.bhfb-component-contact_info .header-contact > a:hover' );

// Sticky Header Active
if( botiga_sticky_header_enabled() ) {

    // Icons Color
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_sticky_color', '#212121', '.sticky-header-active .bhfb-component-contact_info .header-contact > a svg' );

    // Icons Color Hover
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_sticky_color_hover', '#757575', '.sticky-header-active .bhfb-component-contact_info .header-contact > a:hover svg' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_sticky_color', '#212121', '.sticky-header-active .bhfb-component-contact_info .header-contact > a' );

    // Text Color Hover
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_sticky_color_hover', '#757575', '.sticky-header-active .bhfb-component-contact_info .header-contact > a:hover' );

}

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_contact_info_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-contact_info', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_contact_info_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-contact_info', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound