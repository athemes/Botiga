<?php
/**
 * Header/Footer Builder
 * WooCommerce Icons Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Icon Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_color', '', '.bhfb-component-woo_icons .header-item svg:not(.stroke-based)' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_color', '', '.bhfb-component-woo_icons .header-item .botiga-image.is-svg' );

// Icon Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_color_hover', '', '.bhfb-component-woo_icons .header-item:hover svg:not(.stroke-based)' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_color_hover', '', '.bhfb-component-woo_icons .header-item:hover .botiga-image.is-svg' );

// Mini Cart Count Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'main_header_minicart_count_background_color', '', '.bhfb-component-woo_icons .site-header-cart .count-number, .bhfb-component-woo_icons .header-wishlist-icon .count-number' );
$css .= Botiga_Custom_CSS::get_border_color_css( 'main_header_minicart_count_background_color', '', '.bhfb-component-woo_icons .site-header-cart .count-number, .bhfb-component-woo_icons .header-wishlist-icon .count-number' );

// Mini Cart Count Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_minicart_count_text_color', '', '.bhfb-component-woo_icons .site-header-cart .count-number, .bhfb-component-woo_icons .header-wishlist-icon .count-number' );

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Icon Color
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_sticky_color', '', '.sticky-header-active .bhfb-component-woo_icons .header-item svg:not(.stroke-based)' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_sticky_color', '', '.sticky-header-active .bhfb-component-woo_icons .header-item .botiga-image.is-svg' );

    // Sticky Header - Icon Color Hover
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_woo_icons_sticky_color_hover', '', '.sticky-header-active .bhfb-component-woo_icons .header-item:hover svg:not(.stroke-based)' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_woo_icons_sticky_color_hover', '', '.sticky-header-active .bhfb-component-woo_icons .header-item:hover .botiga-image.is-svg' );
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound