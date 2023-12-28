<?php
/**
 * Header/Footer Builder
 * WooCommerce Icons Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'bhfb_woo_icons_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-woo_icons, .bhfb-mobile_offcanvas .bhfb-builder-item.bhfb-component-woo_icons', 
    'display',
    ''
);

// Icon Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_color', '#212121', '.bhfb-component-woo_icons .header-item svg:not(.stroke-based)' );
$css .= Botiga_Custom_CSS::get_stroke_css( 'bhfb_woo_icons_color', '#212121', '.bhfb-component-woo_icons .header-item svg.stroke-based' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_color', '#212121', '.bhfb-component-woo_icons .header-item .botiga-image.is-svg' );

// Icon Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_color_hover', '#757575', '.bhfb-component-woo_icons .header-item:hover svg:not(.stroke-based)' );
$css .= Botiga_Custom_CSS::get_stroke_css( 'bhfb_woo_icons_color_hover', '#757575', '.bhfb-component-woo_icons .header-item:hover svg.stroke-based' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_color_hover', '#757575', '.bhfb-component-woo_icons .header-item:hover .botiga-image.is-svg' );

// Mini Cart Count Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'main_header_minicart_count_background_color', '#ff5858', '.bhfb-component-woo_icons .site-header-cart .count-number, .bhfb-component-woo_icons .header-wishlist-icon .count-number' );
$css .= Botiga_Custom_CSS::get_border_color_css( 'main_header_minicart_count_background_color', '#ff5858', '.bhfb-component-woo_icons .site-header-cart .count-number, .bhfb-component-woo_icons .header-wishlist-icon .count-number' );

// Mini Cart Count Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_minicart_count_text_color', '#FFF', '.bhfb-component-woo_icons .site-header-cart .count-number, .bhfb-component-woo_icons .header-wishlist-icon .count-number' );

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Icon Color
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_sticky_color', '#212121', '.sticky-header-active .bhfb-component-woo_icons .header-item svg:not(.stroke-based)' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_sticky_color', '#212121', '.sticky-header-active .bhfb-component-woo_icons .header-item .botiga-image.is-svg' );

    // Sticky Header - Icon Color Hover
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_sticky_color_hover', '#757575', '.sticky-header-active .bhfb-component-woo_icons .header-item:hover svg:not(.stroke-based)' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_sticky_color_hover', '#757575', '.sticky-header-active .bhfb-component-woo_icons .header-item:hover .botiga-image.is-svg' );
}

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_woo_icons_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-woo_icons', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_woo_icons_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-woo_icons', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound