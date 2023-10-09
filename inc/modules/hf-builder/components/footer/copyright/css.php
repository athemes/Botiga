<?php
/**
 * Footer Builder
 * Copyright/credits Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_fb_component__copyright_visibility', 
    'visible', 
    '.bhfb.bhfb-footer .bhfb-builder-item.bhfb-component-copyright',
    'display',
    ''
);

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__copyright_text_color', '', '.bhfb .botiga-credits' );

// Links Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__copyright_links_color', '', '.bhfb .botiga-credits a' );

// Links Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__copyright_links_color_hover', '', '.bhfb .botiga-credits a:hover' );

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_fb_component__copyright_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-copyright', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_fb_component__copyright_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-copyright', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound