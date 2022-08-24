<?php
/**
 * Header/Footer Builder
 * Columns
 * 
 * @package Botiga_Pro
 */

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
                'title'      => sprintf( esc_html__( 'Column %s', 'botiga' ), $i ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Vertical Alignment.
        $wp_customize->add_setting( 
            $section_id . '_vertical_alignment',
            array(
                'default' 			=> 'middle',
                'sanitize_callback' => 'botiga_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_control( 
            new Botiga_Radio_Buttons( 
                $wp_customize, 
                $section_id . '_vertical_alignment',
                array(
                    'label'   => esc_html__( 'Vertical Alignment', 'botiga' ),
                    'section' => $section_id,
                    'choices' => array(
                        'top'    => esc_html__( 'Top', 'botiga' ),
                        'middle' => esc_html__( 'Middle', 'botiga' ),
                        'bottom' => esc_html__( 'Bottom', 'botiga' )
                    ),
                    'priority'              => 20
                )
            ) 
        );

        // Inner Elements Layout.
        $wp_customize->add_setting( 
            $section_id . '_inner_layout',
            array(
                'default' 			=> 'stack',
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
                    'choices' => array(
                        'stack'  => esc_html__( 'Stack', 'botiga' ),
                        'inline' => esc_html__( 'Inline', 'botiga' )
                    ),
                    'priority'              => 25
                )
            ) 
        );
    
        // Horizontal Alignment.
        $wp_customize->add_setting( 
            $section_id . '_horizontal_alignment',
            array(
                'default' 			=> 'start',
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
                    'choices'       => array(
                        'start'  => esc_html__( 'Start', 'botiga' ),
                        'center' => esc_html__( 'Center', 'botiga' ),
                        'end'    => esc_html__( 'End', 'botiga' )
                    ),
                    'priority'      => 30
                )
            ) 
        );

    }
    
}