<?php
/**
 * Header/Footer Builder
 * HTML Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Text Alignment
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_hb_component__html_text_align', 
    array( 'desktop' => 'left', 'tablet' => 'left', 'mobile' => 'left' ), 
    '.bhfb.bhfb-header .bhfb-component-html',
    'text-align',
    '' 
);

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_hb_component__html_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-html, .bhfb-mobile_offcanvas .bhfb-builder-item.bhfb-component-html', 
    'display',
    ''
);

/**
 * Colors Default State
 */

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_hb_component__html_text_color', '', '.bhfb.bhfb-header .bhfb-component-html' );

// Links Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_hb_component__html_link_color', '', '.bhfb.bhfb-header .bhfb-component-html a' );

// Links Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_hb_component__html_link_color_hover', '', '.bhfb.bhfb-header .bhfb-component-html a:hover' );

/** 
 * Colors Sticky Header State
 */

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_hb_component__html_sticky_text_color', '', '.sticky-header-active .bhfb.bhfb-header .bhfb-component-html' );

// Links Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_hb_component__html_sticky_link_color', '', '.sticky-header-active .bhfb.bhfb-header .bhfb-component-html a' );

// Links Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_hb_component__html_sticky_link_color_hover', '', '.sticky-header-active .bhfb.bhfb-header .bhfb-component-html a:hover' );

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_hb_component__html_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb.bhfb-header .bhfb-component-html', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_hb_component__html_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb.bhfb-header .bhfb-component-html', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound