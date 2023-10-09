<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Menu Component CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'mobile_offcanvas_menu_visibility', 
    'visible', 
    '.bhfb.bhfb-header .bhfb-builder-item.bhfb-component-mobile_offcanvas_menu, .bhfb-mobile_offcanvas .bhfb-builder-item.bhfb-component-mobile_offcanvas_menu', 
    'display',
    ''
);

// Link Separator Color and Size.
$mobile_menu_link_separator 	= get_theme_mod( 'mobile_menu_link_separator', 0 );
if ( $mobile_menu_link_separator ) {
    $link_separator_color 			= get_theme_mod( 'link_separator_color', '#eeeeee' );
    $mobile_header_separator_width	= get_theme_mod( 'mobile_header_separator_width', 1 );

    $css .= ".botiga-offcanvas-menu .botiga-dropdown ul li { padding-top: 5px; border-bottom: " . intval( $mobile_header_separator_width ) . "px solid " . esc_attr( $link_separator_color ) . ";}";
}

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a.botiga-dropdown-link' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a.botiga-dropdown-link + .dropdown-symbol svg' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a.botiga-dropdown-link:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation a.botiga-dropdown-link:hover + .dropdown-symbol svg' );

// Submenu Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_submenu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_submenu_color', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_submenu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_submenu_color_hover', '', '.bhfb.bhfb-mobile_offcanvas .main-navigation .sub-menu.botiga-dropdown-ul a.botiga-dropdown-link:hover + .dropdown-symbol svg' );

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'mobile_offcanvas_menu_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-mobile_offcanvas_menu', 
    'padding'
);

// Margin
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'mobile_offcanvas_menu_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-component-mobile_offcanvas_menu', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound