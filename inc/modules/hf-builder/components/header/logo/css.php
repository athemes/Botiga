<?php
/**
 * Header/Footer Builder
 * Rows CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Site TItle Color
$css .= Botiga_Custom_CSS::get_color_css( 'site_title_color', '', '.bhfb .site-title a' );

// Site Description Color
$css .= Botiga_Custom_CSS::get_color_css( 'site_description_color', '', '.bhfb .site-description' );

// Site Logo Size
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'site_logo_size', 
    array( 'desktop' => 120, 'tablet' => 100, 'mobile' => 100 ), 
    '.custom-logo-link img',
    'width',
    'px' 
);

// Text Alignment
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_hb_component__logo_text_alignment', 
    array( 'desktop' => 'center', 'tablet' => 'center', 'mobile' => 'center' ), 
    '.bhfb.bhfb-header .bhfb-component-logo',
    'text-align',
    '' 
);

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Site TItle Color
    $css .= Botiga_Custom_CSS::get_color_css( 'site_title_sticky_color', '', '.sticky-header-active .bhfb .site-title a' );
    
    // Sticky Header - Site Description Color
    $css .= Botiga_Custom_CSS::get_color_css( 'site_description_sticky_color', '', '.sticky-header-active .bhfb .site-description' );
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound