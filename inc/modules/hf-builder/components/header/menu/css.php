<?php
/**
 * Header/Footer Builder
 * Primary Menu CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_hb_component__menu_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-menu', 
    'display',
    ''
);

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_color', '', '.bhfb .main-navigation a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_color', '', '.bhfb .main-navigation a + .dropdown-symbol svg' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_color_hover', '', '.bhfb .main-navigation a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_color_hover', '', '.bhfb .main-navigation a:hover + .dropdown-symbol svg' );

// Submenu Background
$css .= Botiga_Custom_CSS::get_background_color_css( 'main_header_submenu_background', '', '.bhfb .sub-menu, .bhfb .sub-menu li' );

// Submenu Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_submenu_color', '', '.bhfb .main-navigation .sub-menu a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_submenu_color', '', '.bhfb .main-navigation .sub-menu a + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_submenu_color_hover', '', '.bhfb .main-navigation .sub-menu a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_submenu_color_hover', '', '.bhfb .main-navigation .sub-menu a:hover + .dropdown-symbol svg' );

// Sticky Header - Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_color', '', '.sticky-header-active .bhfb .main-navigation a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_color', '', '.sticky-header-active .bhfb .main-navigation a + .dropdown-symbol svg' );

// Sticky Header - Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_color_hover', '', '.sticky-header-active .bhfb .main-navigation a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_color_hover', '', '.sticky-header-active .bhfb .main-navigation a:hover + .dropdown-symbol svg' );

// Sticky Header - Submenu Background
$css .= Botiga_Custom_CSS::get_background_color_css( 'main_header_sticky_active_submenu_background_color', '', '.sticky-header-active .bhfb .sub-menu, .sticky-header-active .bhfb .sub-menu li' );

// Sticky Header - Submenu Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_submenu_color', '', '.sticky-header-active .bhfb .main-navigation .sub-menu a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_submenu_color', '', '.sticky-header-active .bhfb .main-navigation .sub-menu a + .dropdown-symbol svg' );

// Sticky Header - Submenu Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_submenu_color_hover', '', '.sticky-header-active .bhfb .main-navigation .sub-menu a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_submenu_color_hover', '', '.sticky-header-active .bhfb .main-navigation .sub-menu a:hover + .dropdown-symbol svg' );

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_hb_component__menu_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-header .bhfb-component-menu', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_hb_component__menu_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-header .bhfb-component-menu', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound