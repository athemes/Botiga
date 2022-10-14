<?php
/**
 * Footer Builder
 * Rows CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

$rows = array( 'above_footer_row', 'main_footer_row', 'below_footer_row' );
foreach( $rows as $row ) {

    // Height
    $default = Botiga_Header_Footer_Builder::get_row_height_default_customizer_value( $row );

    $css .= Botiga_Custom_CSS::get_responsive_css( 
        "botiga_footer_row__${row}_height", 
        array( 'desktop' => $default, 'tablet' => $default, 'mobile' => $default ), 
        ".bhfb-$row",
        'min-height',
        'px' 
    );

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( "botiga_footer_row__${row}_background_color", '#f5f5f5', ".bhfb-$row" ); 

    // Border Top
    $css .= Botiga_Custom_CSS::get_css( 
        "botiga_footer_row__${row}_border_top_desktop",
        Botiga_Header_Footer_Builder::get_row_border_default_customizer_value( $row ), 
        ".bhfb-$row",
        array(
            array(
                'prop' => 'border-top-width',
                'unit' => 'px'
            )
        )
    );
    $css .= ".bhfb-$row { border-top-style: solid; }";
    $css .= Botiga_Custom_CSS::get_border_top_color_rgba_css( "botiga_footer_row__${row}_border_top_color", '#EAEAEA', ".bhfb-$row", 0.1 );

    // Elements Spacing.
    $elements_spacing = get_theme_mod( "botiga_footer_row__${row}_elements_spacing", '25' );
    $css .= ":root { --botiga_footer_row__${row}_elements_spacing: ${elements_spacing}px; }";

}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound