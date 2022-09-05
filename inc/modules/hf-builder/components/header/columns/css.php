<?php
/**
 * Header Builder
 * Columns CSS Output
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

$rows = array( 'above_header_row', 'main_header_row', 'below_header_row' );
foreach( $rows as $row ) {

    // Up to 6 columns.
    for( $i=1; $i<=6; $i++ ) {
        $section_id      = "botiga_header_row__${row}_column$i";
        $column_selector = ".bhfb-header .bhfb-$row .bhfb-column-$i"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        // Vertical Alignment.
        $default = Botiga_Header_Footer_Builder::get_row_column_default_customizer_value( $row, $i, 'vertical_alignment' );
        $css .= Botiga_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_vertical_alignment', 
            array( 'desktop' => $default, 'tablet' => $default, 'mobile' => $default ), 
            $column_selector,
            'align-items',
            '',
            $row,
            $section_id
        );

        // Inner Layout.
        $default = Botiga_Header_Footer_Builder::get_row_column_default_customizer_value( $row, $i, 'inner_layout' );
        $css .= Botiga_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_inner_layout', 
            array( 'desktop' => $default, 'tablet' => $default, 'mobile' => $default ), 
            $column_selector,
            'flex-direction',
            '',
            $row,
            $section_id
        );

        // Horizontal Alignment.
        $default = Botiga_Header_Footer_Builder::get_row_column_default_customizer_value( $row, $i, 'horizontal_alignment' );
        $css .= Botiga_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_horizontal_alignment', 
            array( 'desktop' => $default, 'tablet' => $default, 'mobile' => $default ), 
            $column_selector,
            'justify-content',
            '',
            $row,
            $section_id
        );

        // Elements Spacing.
        $css .= Botiga_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_elements_spacing', 
            array( 'desktop' => '25', 'tablet' => '25', 'mobile' => '25' ), 
            "$column_selector .bhfb-builder-item + .bhfb-builder-item",
            'margin-left',
            'px',
            $row,
            $section_id
        );
    }

}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound