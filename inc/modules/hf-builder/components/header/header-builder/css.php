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

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound