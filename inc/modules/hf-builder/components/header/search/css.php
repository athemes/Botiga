<?php
/**
 * Header/Footer Builder
 * Search Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'bhfb_search_icon_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-search, .bhfb-mobile_offcanvas .bhfb-builder-item.bhfb-component-search', 
    'display',
    ''
);

// Icon Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_color', '#212121', '.bhfb-component-search .header-search svg' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_color', '#212121', '.bhfb-component-search .header-search .botiga-image.is-svg' );

// Icon Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_color_hover', '#757575', '.bhfb-component-search .header-search:hover svg' );
$css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_color_hover', '#757575', '.bhfb-component-search .header-search:hover .botiga-image.is-svg' );

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Icon Color
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_sticky_color', '#212121', '.sticky-header-active .bhfb-component-search .header-search svg' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_sticky_color', '#212121', '.sticky-header-active .bhfb-component-search .header-search .botiga-image.is-svg' );

    // Sticky Header - Icon Color Hover
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_search_icon_sticky_color_hover', '#757575', '.sticky-header-active .bhfb-component-search .header-search:hover svg' );
    $css .= Botiga_Custom_CSS::get_background_color_css( 'bhfb_search_icon_sticky_color_hover', '#757575', '.sticky-header-active .bhfb-component-search .header-search:hover .botiga-image.is-svg' );
}

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_search_icon_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-search', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'bhfb_search_icon_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-search', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound