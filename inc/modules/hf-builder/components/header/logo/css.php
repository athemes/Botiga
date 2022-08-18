<?php
/**
 * Header/Footer Builder
 * Rows CSS Output
 * 
 * @package Botiga_Pro
 */

// Site TItle Color
$css .= Botiga_Custom_CSS::get_color_css( 'site_title_color', '', '.bhfb .site-title a' );

// Site Description Color
$css .= Botiga_Custom_CSS::get_color_css( 'site_description_color', '', '.bhfb .site-description' );

// Site Logo Size
$css .= Botiga_Custom_CSS::get_responsive_css( 
    'site_logo_size', 
    array( 'desktop' => 180, 'tablet' => 100, 'mobile' => 100 ), 
    '.custom-logo-link img',
    'width',
    'px' 
);

if( botiga_sticky_header_enabled() ) {
    // Sticky Header - Site TItle Color
    $css .= Botiga_Custom_CSS::get_color_css( 'site_title_sticky_color', '', '.sticky-header-active .bhfb .site-title a' );
    
    // Sticky Header - Site Description Color
    $css .= Botiga_Custom_CSS::get_color_css( 'site_description_sticky_color', '', '.sticky-header-active .bhfb .site-description' );
}