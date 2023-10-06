<?php
/**
 * Footer Builder
 * Widget 1 CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_fb_component__widget1_visibility', 
    'visible', 
    '.bhfb.bhfb-footer .bhfb-builder-item.bhfb-component-widget1', 
    'display',
    ''
);

// Widget Title Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__widget1_title_color', '', '.bhfb-footer .bhfb-component-widget1 .widget-column .widget .widget-title' );

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__widget1_text_color', '', '.bhfb-footer .bhfb-component-widget1 .widget-column .widget' );

// Links Color
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__widget1_links_color', '', '.bhfb-footer .bhfb-component-widget1 .widget-column .widget a' );

// Links Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'botiga_section_fb_component__widget1_links_color_hover', '', '.bhfb-footer .bhfb-component-widget1 .widget-column .widget a:hover' );

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_fb_component__widget1_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-footer .bhfb-component-widget1', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_fb_component__widget1_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-footer .bhfb-component-widget1', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound