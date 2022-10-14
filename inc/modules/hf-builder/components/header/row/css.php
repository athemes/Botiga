<?php
/**
 * Header/Footer Builder
 * Rows CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

$sticky_header_type = get_theme_mod( 'sticky_header_type', 'always' );
$sticky_row         = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_sticky_row', 'main-header-row' );

$rows = array( 'above_header_row', 'main_header_row', 'below_header_row' );
foreach( $rows as $row ) {

    // Height
    $css .= Botiga_Custom_CSS::get_responsive_css( 
        "botiga_header_row__${row}_height", 
        array( 'desktop' => 100, 'tablet' => 100, 'mobile' => 100 ), 
        ".bhfb-$row",
        'min-height',
        'px' 
    );

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( "botiga_header_row__${row}_background_color", '#FFF', ".bhfb-$row" ); 

    // Border Bottom
    $css .= Botiga_Custom_CSS::get_css( 
        "botiga_header_row__${row}_border_bottom_desktop",
        1, 
        ".bhfb-$row",
        array(
            array(
                'prop' => 'border-bottom-width',
                'unit' => 'px'
            )
        )
    );
    $css .= ".bhfb-$row { border-bottom-style: solid; }";
    $css .= Botiga_Custom_CSS::get_border_bottom_color_rgba_css( "botiga_header_row__${row}_border_bottom_color", '#EAEAEA', ".bhfb-$row", 0.1 );

    if( botiga_sticky_header_enabled() ) {
        
        // Sticky Header - Background Color
        $css .= Botiga_Custom_CSS::get_background_color_css( "botiga_header_row__${row}_sticky_background_color", '#FFF', ".sticky-header-active .has-sticky-header .bhfb-$row" ); 

        // Sticky Header - Border Bottom Color
        $css .= Botiga_Custom_CSS::get_border_bottom_color_rgba_css( "botiga_header_row__${row}_sticky_border_bottom_color", '#EAEAEA', ".sticky-header-active .has-sticky-header .bhfb-$row" );

    }

}

// Sticky Header
// Generate the gap on top of page for when sticky is active
if( botiga_sticky_header_enabled() ) {
    $sticky_gap = 0;

    foreach( $rows as $row ) {
        if( Botiga_Header_Footer_Builder::get_row_data( $row, 'header' ) !== NULL ) {
            if( ! (int) Botiga_Header_Footer_Builder::is_row_empty( Botiga_Header_Footer_Builder::get_row_data( $row, 'header' )->desktop ) ) {
                $sticky_gap = $sticky_gap + get_theme_mod( "botiga_header_row__${row}_height_desktop", 100 ) + get_theme_mod( "botiga_header_row__${row}_border_bottom", 1 );
            }
        }
    }
    
    if( get_theme_mod( 'site_layout', 'default' ) === 'padded' ) {
        $sticky_gap = $sticky_gap + get_theme_mod( 'padded_layout_spacing_desktop', 20 );
    }

    if( $sticky_row === 'all' ) {
        $css .= '@media(min-width: 1025px) { body.has-bhfb-builder:not(.header-transparent) { padding-top: '. esc_attr( $sticky_gap ) .'px; } }';
    }

    if( $sticky_row === 'main-header-row' || $sticky_row === 'below-header-row' ) {
        $sticky_gap = is_admin_bar_showing() ? $sticky_gap + 42 : $sticky_gap;
        $css .= '@media(min-width: 1025px) { body.has-bhfb-builder.sticky-header-active:not(.header-transparent) { padding-top: '. esc_attr( $sticky_gap ) .'px; } }';
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound