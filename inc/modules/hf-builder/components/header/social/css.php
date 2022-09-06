<?php
/**
 * Header/Footer Builder
 * Social Icons Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Icon Color
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_social_color', '', '.bhfb-component-social .social-profile > a svg' );

// Icon Color Hover
$css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_social_color_hover', '', '.bhfb-component-social .social-profile > a:hover svg' );

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Icon Color
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_social_sticky_color', '', '.sticky-header-active .bhfb-component-social .social-profile > a svg' );
    
    // Sticky Header - Icon Color Hover
    $css .= Botiga_Custom_CSS::get_fill_css( 'bhfb_social_sticky_color_hover', '', '.sticky-header-active .bhfb-component-social .social-profile > a:hover svg' );
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound