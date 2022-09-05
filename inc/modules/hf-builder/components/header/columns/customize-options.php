<?php
/**
 * Header Builder
 * Columns
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

/**
 * Columns
 */

foreach( $this->header_rows as $row ) {

    // Up to 6 columns.
    for( $i=1; $i<=6; $i++ ) {
        $section_id = 'botiga_header_row__' . $row['id'] . '_column' . $i;

        // Section.
        $wp_customize->add_section(
            $section_id,
            array(
                /* translators: 1: column number. */
                'title'      => sprintf( esc_html__( 'Column %s', 'botiga' ), $i ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Vertical Alignment.
        $default = Botiga_Header_Footer_Builder::get_row_column_default_customizer_value( $row[ 'id' ], $i, 'vertical_alignment' );

        $wp_customize->add_setting( 
            $section_id . '_vertical_alignment_desktop',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_vertical_alignment_tablet',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_vertical_alignment_mobile',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_control( 
            new Botiga_Radio_Buttons( 
                $wp_customize, 
                $section_id . '_vertical_alignment',
                array(
                    'label'         => esc_html__( 'Vertical Alignment', 'botiga' ),
                    'section'       => $section_id,
                    'is_responsive' => true,
                    'settings' 		=> array (
                        'desktop' 		=> $section_id . '_vertical_alignment_desktop',
                        'tablet' 		=> $section_id . '_vertical_alignment_tablet',
                        'mobile' 		=> $section_id . '_vertical_alignment_mobile'
                    ),
                    'choices'       => array(
                        'top'    => esc_html__( 'Top', 'botiga' ),
                        'middle' => esc_html__( 'Middle', 'botiga' ),
                        'bottom' => esc_html__( 'Bottom', 'botiga' )
                    ),
                    'priority'      => 20
                )
            ) 
        );

        // Inner Elements Layout.
        $default = Botiga_Header_Footer_Builder::get_row_column_default_customizer_value( $row[ 'id' ], $i, 'inner_layout' );

        $wp_customize->add_setting( 
            $section_id . '_inner_layout_desktop',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_inner_layout_tablet',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_inner_layout_mobile',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_control( 
            new Botiga_Radio_Buttons( 
                $wp_customize, 
                $section_id . '_inner_layout',
                array(
                    'label'   => esc_html__( 'Inner Elements Layout', 'botiga' ),
                    'section' => $section_id,
                    'is_responsive' => true,
                    'settings' => array(
                        'desktop' 		=> $section_id . '_inner_layout_desktop',
                        'tablet' 		=> $section_id . '_inner_layout_tablet',
                        'mobile' 		=> $section_id . '_inner_layout_mobile'
                    ),
                    'choices' => array(
                        'stack'  => esc_html__( 'Stack', 'botiga' ),
                        'inline' => esc_html__( 'Inline', 'botiga' )
                    ),
                    'priority'              => 25
                )
            ) 
        );
    
        // Horizontal Alignment.
        $default = Botiga_Header_Footer_Builder::get_row_column_default_customizer_value( $row[ 'id' ], $i, 'horizontal_alignment' );

        $wp_customize->add_setting( 
            $section_id . '_horizontal_alignment_desktop',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_horizontal_alignment_tablet',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_horizontal_alignment_mobile',
            array(
                'default' 			=> $default,
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_control( 
            new Botiga_Radio_Buttons( 
                $wp_customize, 
                $section_id . '_horizontal_alignment',
                array(
                    'label'         => esc_html__( 'Horizontal Alignment', 'botiga' ),
                    'section'       => $section_id,
                    'is_responsive' => true,
                    'settings' => array(
                        'desktop' 		=> $section_id . '_horizontal_alignment_desktop',
                        'tablet' 		=> $section_id . '_horizontal_alignment_tablet',
                        'mobile' 		=> $section_id . '_horizontal_alignment_mobile'
                    ),
                    'choices'       => array(
                        'start'  => esc_html__( 'Start', 'botiga' ),
                        'center' => esc_html__( 'Center', 'botiga' ),
                        'end'    => esc_html__( 'End', 'botiga' )
                    ),
                    'priority'      => 30
                )
            ) 
        );

        // Elements Spacing.
        $wp_customize->add_setting( 
            $section_id . '_elements_spacing_desktop',
            array(
                'default'   		=> 25,
                'transport'			=> 'postMessage',
                'sanitize_callback' => 'absint'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_elements_spacing_tablet',
            array(
                'default'   		=> 25,
                'transport'			=> 'postMessage',
                'sanitize_callback' => 'absint'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_elements_spacing_mobile',
            array(
                'default'   		=> 25,
                'transport'			=> 'postMessage',
                'sanitize_callback' => 'absint'
            ) 
        );			
        
        $wp_customize->add_control( 
            new Botiga_Responsive_Slider( 
                $wp_customize, 
                $section_id . '_elements_spacing',
                array(
                    'label' 		=> esc_html__( 'Elements Spacing', 'botiga' ),
                    'section' 		=> $section_id,
                    'is_responsive'	=> true,
                    'settings' 		=> array (
                        'size_desktop' 		=> $section_id . '_elements_spacing_desktop',
                        'size_tablet' 		=> $section_id . '_elements_spacing_tablet',
                        'size_mobile' 		=> $section_id . '_elements_spacing_mobile'
                    ),
                    'input_attrs' => array (
                        'min'	=> 0,
                        'max'	=> 150,
                        'step'  => 1
                    ),
                    'priority'     => 30
                )
            ) 
        );

    }
    
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound