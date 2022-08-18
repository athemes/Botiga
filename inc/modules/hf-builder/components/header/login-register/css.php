<?php
/**
 * Header/Footer Builder
 * Login/Register Component CSS Output
 * 
 * @package Botiga_Pro
 */

if( ! class_exists( 'Woocommerce' ) ) {
    return;
}

// Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'login_register_color', '', '.bhfb .header-login-register a' );
$css .= Botiga_Custom_CSS::get_border_color_css( 'login_register_color', '', '.bhfb .header-login-register>a:not(.botiga-login-register-link):after' );

// Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'login_register_color_hover', '', '.bhfb .header-login-register a:hover' );
$css .= Botiga_Custom_CSS::get_border_color_css( 'login_register_color_hover', '', '.bhfb .header-login-register>a:not(.botiga-login-register-link):hover:after' );

// Submenu Background
$css .= Botiga_Custom_CSS::get_background_color_css( 'login_register_submenu_background', '', '.bhfb .header-login-register nav' );

// Submenu Text Color
$css .= Botiga_Custom_CSS::get_color_css( 'login_register_submenu_color', '', '.bhfb .header-login-register nav a' );
$css .= Botiga_Custom_CSS::get_fill_css( 'login_register_submenu_color', '', '.bhfb .header-login-register nav a + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Botiga_Custom_CSS::get_color_css( 'login_register_submenu_color_hover', '', '.bhfb .header-login-register nav a:hover' );
$css .= Botiga_Custom_CSS::get_fill_css( 'login_register_submenu_color_hover', '', '.bhfb .header-login-register nav a:hover + .dropdown-symbol svg' );

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'login_register_sticky_color', '', '.sticky-header-active .bhfb .header-login-register a' );
    $css .= Botiga_Custom_CSS::get_border_color_css( 'login_register_sticky_color', '', '.sticky-header-active .bhfb .header-login-register>a:not(.botiga-login-register-link):after' );
    
    // Sticky Header - Text Color Hover
    $css .= Botiga_Custom_CSS::get_color_css( 'login_register_sticky_color_hover', '', '.sticky-header-active .bhfb .header-login-register a:hover' );
    $css .= Botiga_Custom_CSS::get_border_color_css( 'login_register_sticky_color_hover', '', '.sticky-header-active .bhfb .header-login-register>a:not(.botiga-login-register-link):hover:after' );
    
    // Sticky Header - Submenu Background
    $css .= Botiga_Custom_CSS::get_background_color_css( 'login_register_sticky_submenu_background', '', '.sticky-header-active .bhfb .header-login-register nav' );
    
    // Sticky Header - Submenu Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 'login_register_sticky_submenu_color', '', '.sticky-header-active .bhfb .header-login-register nav a' );
    $css .= Botiga_Custom_CSS::get_fill_css( 'login_register_sticky_submenu_color', '', '.sticky-header-active .bhfb .header-login-register nav a + .dropdown-symbol svg' );
    
    // Sticky Header - Submenu Text Color Hover
    $css .= Botiga_Custom_CSS::get_color_css( 'login_register_sticky_submenu_color_hover', '', '.sticky-header-active .bhfb .header-login-register nav a:hover' );
    $css .= Botiga_Custom_CSS::get_fill_css( 'login_register_sticky_submenu_color_hover', '', '.sticky-header-active .bhfb .header-login-register nav a:hover + .dropdown-symbol svg' );
}