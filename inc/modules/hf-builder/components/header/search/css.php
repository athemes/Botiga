<?php
/**
 * Header/Footer Builder
 * Search Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Icon Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_color', '', '.bhfb-component-search .header-search svg' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_color', '', '.bhfb-component-search .header-search .botiga-image.is-svg' );

// Icon Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_color_hover', '', '.bhfb-component-search .header-search:hover svg' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_color_hover', '', '.bhfb-component-search .header-search:hover .botiga-image.is-svg' );

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Icon Color
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_sticky_color', '', '.sticky-header-active .bhfb-component-search .header-search svg' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_sticky_color', '', '.sticky-header-active .bhfb-component-search .header-search .botiga-image.is-svg' );

    // Sticky Header - Icon Color Hover
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_sticky_color_hover', '', '.sticky-header-active .bhfb-component-search .header-search:hover svg' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_sticky_color_hover', '', '.sticky-header-active .bhfb-component-search .header-search:hover .botiga-image.is-svg' );
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound