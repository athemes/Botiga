<?php
/**
 * Header/Footer Builder
 * Header Builder CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

$header_transparent         = get_theme_mod( 'header_transparent', 0 );
$header_transparent_hb_rows = get_theme_mod( 'header_transparent_hb_rows', 'main-row' );

// Apply Header Transparent To
if( $header_transparent ) {

    if( $header_transparent_hb_rows ) {
        $rows = explode( ',', $header_transparent_hb_rows );

        if( in_array( 'top-row', $rows ) ) {
            $css .= 'body:not(.sticky-header-active) .header-transparent-wrapper .bhfb-header.bhfb-desktop .bhfb-above_header_row { background-color: transparent; }';
        }

        if( in_array( 'main-row', $rows ) ) {
            $css .= 'body:not(.sticky-header-active) .header-transparent-wrapper .bhfb-header.bhfb-desktop .bhfb-main_header_row { background-color: transparent; }';
        }

        if( in_array( 'bottom-row', $rows ) ) {
            $css .= 'body:not(.sticky-header-active) .header-transparent-wrapper .bhfb-header.bhfb-desktop .bhfb-below_header_row { background-color: transparent; }';
        }

    }

}

// Padding
$hb_padding = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_padding', '0px 0px 0px 0px' );
$css .= '.bhfb-header.bhfb-desktop { padding: '. esc_attr( $hb_padding ) .'; }';

// Background Image
$hb_background_image = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_image', '' );
if( $hb_background_image ) {
    $image_url           = wp_get_attachment_image_url( $hb_background_image, 'full' );
    $background_size     = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_size', 'cover' );
    $background_position = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_position', 'center center' );
    $background_repeat   = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_repeat', 'no-repeat' );

    $css .= '.bhfb-header.bhfb-desktop { background-image: url(' . esc_url( $image_url ) . '); background-size: '. esc_attr( $background_size ) .'; background-position: '. esc_attr( $background_position ) .'; background-repeat: '. esc_attr( $background_repeat ) .'; }';
}

// Background Color
$hb_background_color = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_color', '' );
if( $hb_background_color ) {
    $css .= '.bhfb-header.bhfb-desktop { background-color: '. esc_attr( $hb_background_color ) .'; }';
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound