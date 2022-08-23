<?php
/**
 * Footer Builder
 * Rows
 * 
 * @package Botiga_Pro
 */

/**
 * All Controls 
 */
foreach( $this->footer_rows as $row ) {
    $wp_customize->add_setting(
        'botiga_footer_row__' . $row['id'],
        array(
            'default'           => $row['default'],
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'botiga_footer_row__' . $row['id'],
        array(
            'type'     => 'text',
            'label'    => esc_html( $row['label'] ),
            'section'  => $row['section'],
            'settings' => 'botiga_footer_row__' . $row['id'],
            'priority' => 10
        )
    );

    // Selective Refresh
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'botiga_footer_row__' . $row['id'],
            array(
                'selector'        => '.bhfb-desktop .bhfb-rows .bhfb-' . $row['id'],
                'settings'        => array( 
                    'botiga_footer_row__' . $row['id'], 
                    'botiga_footer_row__' . $row['id'] . '_vertical_alignment',
                    'botiga_footer_row__' . $row['id'] . '_inner_layout' 
                ),
                'render_callback' => function() use( $row ) {
                    $this->rows_callback( 'footer', $row['id'], 'desktop' );
                },
            )
        );
    }

    $wp_customize->add_setting(
        'botiga_footer_row__' . $row['id'] . '_tabs',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control(
        new Botiga_Tab_Control (
            $wp_customize,
            'botiga_footer_row__' . $row['id'] . '_tabs',
            array(
                'label' 				=> '',
                'section'       		=> $row['section'],
                'controls_general'		=> json_encode( array( 
                    '#customize-control-botiga_footer_row__' . $row['id'] ,
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_height',
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_columns',
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_vertical_alignment',
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_inner_layout'
                ) ),
                'controls_design'		=> json_encode( array( 
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_background_color',
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_border_top',
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_border_top_color',
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_padding'
                ) ),
                'priority' 				=> 20
            )
        )
    );

    /**
     * General
     */

    // Height.
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_height_desktop', array(
        'default'   		=> 100,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );			
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_height_tablet', array(
        'default'   		=> 100,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_height_mobile', array(
        'default'   		=> 100,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );			
    
    $wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'botiga_footer_row__' . $row['id'] . '_height',
        array(
            'label' 		=> esc_html__( 'Height', 'botiga-pro' ),
            'section' 		=> $row['section'],
            'is_responsive'	=> 1,
            'settings' 		=> array (
                'size_desktop' 		=> 'botiga_footer_row__' . $row['id'] . '_height_desktop',
                'size_tablet' 		=> 'botiga_footer_row__' . $row['id'] . '_height_tablet',
                'size_mobile' 		=> 'botiga_footer_row__' . $row['id'] . '_height_mobile',
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 500
            ),
            'priority'              => 30
        )
    ) );

    // Columns.
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_columns',
        array(
            'default' 			=> '3',
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'botiga_footer_row__' . $row['id'] . '_columns',
        array(
            'label'   => esc_html__( 'Columns', 'botiga-pro' ),
            'section' => $row['section'],
            'choices' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'priority'              => 35
        )
    ) );

    // Vertical Alignment.
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_vertical_alignment',
        array(
            'default' 			=> 'top',
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'botiga_footer_row__' . $row['id'] . '_vertical_alignment',
        array(
            'label'   => esc_html__( 'Vertical Alignment', 'botiga-pro' ),
            'section' => $row['section'],
            'choices' => array(
                'top'    => esc_html__( 'Top', 'botiga-pro' ),
                'middle' => esc_html__( 'Middle', 'botiga-pro' ),
                'bottom' => esc_html__( 'Bottom', 'botiga-pro' )
            ),
            'priority'              => 35
        )
    ) );

    // Inner Elements Layout.
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_inner_layout',
        array(
            'default' 			=> 'stack',
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'botiga_footer_row__' . $row['id'] . '_inner_layout',
        array(
            'label'   => esc_html__( 'Inner Elements Layout', 'botiga-pro' ),
            'section' => $row['section'],
            'choices' => array(
                'stack'  => esc_html__( 'Stack', 'botiga-pro' ),
                'inline' => esc_html__( 'Inline', 'botiga-pro' )
            ),
            'priority'              => 35
        )
    ) );

    /**
     * Styling
     */

    // Background.
    $wp_customize->add_setting(
        'botiga_footer_row__' . $row['id'] . '_background_color',
        array(
            'default'           => '#FFF',
            'sanitize_callback' => 'botiga_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Alpha_Color(
            $wp_customize,
            'botiga_footer_row__' . $row['id'] . '_background_color',
            array(
                'label'         	=> esc_html__( 'Background Color', 'botiga-pro' ),
                'section'       	=> $row['section'],
                'priority'			=> 32
            )
        )
    );

    // Border Top.
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_border_top_desktop', array(
        'default'   		=> 1,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );						
    $wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'botiga_footer_row__' . $row['id'] . '_border_top',
        array(
            'label' 		=> esc_html__( 'Border Top Size', 'botiga-pro' ),
            'section' 		=> $row['section'],
            'is_responsive'	=> 0,
            'settings' 		=> array (
                'size_desktop' 		=> 'botiga_footer_row__' . $row['id'] . '_border_top_desktop'
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 10
            ),
            'priority'              => 34
        )
    ) );

    // Border Bottom Color.
    $wp_customize->add_setting(
        'botiga_footer_row__' . $row['id'] . '_border_top_color',
        array(
            'default'           => '#EAEAEA',
            'sanitize_callback' => 'botiga_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Alpha_Color(
            $wp_customize,
            'botiga_footer_row__' . $row['id'] . '_border_top_color',
            array(
                'label'         	=> esc_html__( 'Border Top Color', 'botiga-pro' ),
                'section'       	=> $row['section'],
                'priority'			=> 36
            )
        )
    );
}