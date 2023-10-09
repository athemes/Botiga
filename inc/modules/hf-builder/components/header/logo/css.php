<?php
/**
 * Header/Footer Builder
 * Rows CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

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

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_hb_component__logo_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-logo, .bhfb-mobile_offcanvas .bhfb-builder-item.bhfb-component-logo', 
    'display',
    ''
);

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Site TItle Color
    $css .= Botiga_Custom_CSS::get_color_css( 'site_title_sticky_color', '', '.sticky-header-active .bhfb .site-title a' );
    
    // Sticky Header - Site Description Color
    $css .= Botiga_Custom_CSS::get_color_css( 'site_description_sticky_color', '', '.sticky-header-active .bhfb .site-description' );
}

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_hb_component__logo_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-header .bhfb-component-logo', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_hb_component__logo_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-header .bhfb-component-logo', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound