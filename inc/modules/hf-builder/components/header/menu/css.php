<?php
/**
 * Header/Footer Builder
 * Primary Menu CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'botiga_section_hb_component__menu_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-menu', 
    'display',
    ''
);

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_color', '', '.bhfb .main-navigation a.botiga-dropdown-link' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_color', '', '.bhfb .main-navigation a.botiga-dropdown-link + .dropdown-symbol svg' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_color_hover', '', '.bhfb .main-navigation a.botiga-dropdown-link:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_color_hover', '', '.bhfb .main-navigation a.botiga-dropdown-link:hover + .dropdown-symbol svg' );

// Submenu Background
$css .= Botiga_Custom_CSS::get_background_color_css( 'main_header_submenu_background', '', '.bhfb .sub-menu.botiga-dropdown-ul, .bhfb .sub-menu.botiga-dropdown-ul li.botiga-dropdown-li' );

// Submenu Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_submenu_color', '', '.bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_submenu_color', '', '.bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_submenu_color_hover', '', '.bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_submenu_color_hover', '', '.bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link:hover + .dropdown-symbol svg' );

// Sticky Header - Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_color', '', '.sticky-header-active .bhfb .main-navigation a.botiga-dropdown-link' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_color', '', '.sticky-header-active .bhfb .main-navigation a.botiga-dropdown-link + .dropdown-symbol svg' );

// Sticky Header - Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_color_hover', '', '.sticky-header-active .bhfb .main-navigation a.botiga-dropdown-link:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_color_hover', '', '.sticky-header-active .bhfb .main-navigation a.botiga-dropdown-link:hover + .dropdown-symbol svg' );

// Sticky Header - Submenu Background
$css .= Botiga_Custom_CSS::get_background_color_css( 'main_header_sticky_active_submenu_background_color', '', '.sticky-header-active .bhfb .sub-menu.botiga-dropdown-ul, .sticky-header-active .bhfb .sub-menu.botiga-dropdown-ul li.botiga-dropdown-li' );

// Sticky Header - Submenu Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_submenu_color', '', '.sticky-header-active .bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_submenu_color', '', '.sticky-header-active .bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link + .dropdown-symbol svg' );

// Sticky Header - Submenu Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'main_header_sticky_active_submenu_color_hover', '', '.sticky-header-active .bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'main_header_sticky_active_submenu_color_hover', '', '.sticky-header-active .bhfb .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link:hover + .dropdown-symbol svg' );

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

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound