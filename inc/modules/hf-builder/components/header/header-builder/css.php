<?php
/**
 * Header/Footer Builder
 * Header Builder CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

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

// Mobile breakpoint.
$mobile_breakpoint = absint( get_theme_mod( 'mobile_breakpoint', 1024 ) );
$min_width         = $mobile_breakpoint + 1;

$css .= "
    @media (max-width: {$mobile_breakpoint}px) {
        .bhfb-header.bhfb-mobile,
        .botiga-offcanvas-menu {
            display: block;
        }
        .bhfb-header.bhfb-desktop {
            display: none;
        }
        .botiga-offcanvas-menu .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul {
            -webkit-transform: none;
            transform: none;
            opacity: 1;
        }

        .botiga-mega-menu-column {
            margin-left: -10px;
        }
        .botiga-mega-menu-column > .botiga-dropdown-link,
        .botiga-mega-menu-column > span {
            display: none !important;
        }
        .botiga-mega-menu-column > .sub-menu.botiga-dropdown-ul{
            display: block !important;
        }
        .botiga-mega-menu-column .is-mega-menu-heading {
            display: none !important;
        }
    }

    @media (min-width: {$min_width}px) {
        .bhfb-header.bhfb-mobile {
            display: none;
        }
        .bhfb-header.bhfb-desktop {
            display: block;
        }
        .bhfb-header .botiga-dropdown > .botiga-dropdown-ul,
        .bhfb-header .botiga-dropdown > div > .botiga-dropdown-ul {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
    }
";

// Padding
$css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
    'botiga_section_hb_wrapper__header_builder_padding', 
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.bhfb-header.bhfb-desktop, .bhfb-header.bhfb-mobile', 
    'padding'
);

// Background Image
$hb_background_image = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_background_image', '' );
if( $hb_background_image ) {
    $image_url           = wp_get_attachment_image_url( $hb_background_image, 'full' );

    $css .= '.bhfb-header.bhfb-desktop, .bhfb-header.bhfb-mobile { background-image: url(' . esc_url( $image_url ) . '); }';
    $css .= Botiga_Custom_CSS::get_css( 
        'botiga_section_hb_wrapper__header_builder_background_size', 
        'cover', 
        '.bhfb-header.bhfb-desktop, .bhfb-header.bhfb-mobile', 
        'background-size', 
        '' 
    );
    $css .= Botiga_Custom_CSS::get_css( 
        'botiga_section_hb_wrapper__header_builder_background_position', 
        'center', 
        '.bhfb-header.bhfb-desktop, .bhfb-header.bhfb-mobile', 
        'background-position', 
        '' 
    );
    $css .= Botiga_Custom_CSS::get_css( 
        'botiga_section_hb_wrapper__header_builder_background_repeat', 
        'no-repeat', 
        '.bhfb-header.bhfb-desktop, .bhfb-header.bhfb-mobile', 
        'background-repeat', 
        '' 
    );
}

// Background Color
$css .= Botiga_Custom_CSS::get_background_color_css( 'botiga_section_hb_wrapper__header_builder_background_color', '', '.bhfb-header.bhfb-desktop, .bhfb-header.bhfb-mobile' );

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound