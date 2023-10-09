<?php
/**
 * Header/Footer Builder
 * Header Builder CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_fb_wrapper__footer_builder_padding', 
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-footer', 
    'padding'
);

// Background Image
$fb_background_image = get_theme_mod( 'botiga_section_fb_wrapper__footer_builder_background_image', '' );
if( $fb_background_image ) {
    $image_url           = wp_get_attachment_image_url( $fb_background_image, 'full' );
    $background_size     = get_theme_mod( 'botiga_section_fb_wrapper__footer_builder_background_size', 'cover' );
    $background_position = get_theme_mod( 'botiga_section_fb_wrapper__footer_builder_background_position', 'center' );
    $background_repeat   = get_theme_mod( 'botiga_section_fb_wrapper__footer_builder_background_repeat', 'no-repeat' );

    $css .= '.bhfb-footer { background-image: url(' . esc_url( $image_url ) . '); }';
    $css .= Botiga_Custom_CSS::get_css( 
        'botiga_section_fb_wrapper__footer_builder_background_size', 
        'cover', 
        '.bhfb-footer', 
        'background-size', 
        '' 
    );
    $css .= Botiga_Custom_CSS::get_css( 
        'botiga_section_fb_wrapper__footer_builder_background_position', 
        'center', 
        '.bhfb-footer', 
        'background-position', 
        '' 
    );
    $css .= Botiga_Custom_CSS::get_css( 
        'botiga_section_fb_wrapper__footer_builder_background_repeat', 
        'no-repeat', 
        '.bhfb-footer', 
        'background-repeat', 
        '' 
    );
}

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'botiga_section_fb_wrapper__footer_builder_background_color', '', '.bhfb-footer' );

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound