<?php
/**
 * Footer Builder
 * Rows CSS Output
 * 
 * @package Botiga_Pro
 */

$rows = array( 'above_footer_row', 'main_footer_row', 'below_footer_row' );
foreach( $rows as $row ) {

    // Height
    $css .= Botiga_Custom_CSS::get_responsive_css( 
        "botiga_footer_row__${row}_height", 
        array( 'desktop' => 100, 'tablet' => 100, 'mobile' => 100 ), 
        ".bhfb-$row",
        'min-height',
        'px' 
    );

    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( "botiga_footer_row__${row}_background_color", '#FFF', ".bhfb-$row" ); 

    // Border Top
    $css .= Botiga_Custom_CSS::get_css( 
        "botiga_footer_row__${row}_border_top_desktop",
        1, 
        ".bhfb-$row",
        array(
            array(
                'prop' => 'border-top-width',
                'unit' => 'px'
            )
        )
    );
    $css .= ".bhfb-$row { border-top-style: solid; }";
    $css .= Botiga_Custom_CSS::get_border_top_color_css( "botiga_footer_row__${row}_border_top_color", '#EAEAEA', ".bhfb-$row" );

}