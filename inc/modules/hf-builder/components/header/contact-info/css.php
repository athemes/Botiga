<?php
/**
 * Header/Footer Builder
 * Contact Info Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Icons Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_color', '', '.bhfb-component-contact_info .header-contact > a svg' );

// Icons Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_color_hover', '', '.bhfb-component-contact_info .header-contact > a:hover svg' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_color', '', '.bhfb-component-contact_info .header-contact > a' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_color_hover', '', '.bhfb-component-contact_info .header-contact > a:hover' );

// Sticky Header Active
if( botiga_sticky_header_enabled() ) {

    // Icons Color
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_sticky_color', '', '.sticky-header-active .bhfb-component-contact_info .header-contact > a svg' );

    // Icons Color Hover
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_contact_info_icon_sticky_color_hover', '', '.sticky-header-active .bhfb-component-contact_info .header-contact > a:hover svg' );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_sticky_color', '', '.sticky-header-active .bhfb-component-contact_info .header-contact > a' );

    // Text Color Hover
    $css .= Botiga_Custom_CSS::get_color_css( 'bhfb_contact_info_text_sticky_color_hover', '', '.sticky-header-active .bhfb-component-contact_info .header-contact > a:hover' );

}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound