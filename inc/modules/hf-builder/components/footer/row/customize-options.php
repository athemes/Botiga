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
                    'botiga_footer_row__' . $row['id']
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
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_columns_layout',
                    '#customize-control-botiga_footer_row__' . $row['id'] . '_elements_spacing'
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

    // Columns Layout.
    $wp_customize->add_setting(
        'botiga_footer_row__' . $row['id'] . '_columns_layout',
        array(
            'default'           => 'equal',
            'sanitize_callback' => 'sanitize_key',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Radio_Images(
            $wp_customize,
            'botiga_footer_row__' . $row['id'] . '_columns_layout',
            array(
                'label'    => esc_html__( 'Columns Layout', 'botiga' ),
                'section'  => $row['section'],
                'cols' 		=> 4,
                'choices'  => array(			
                    '1col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'botiga' ),
                        'url'   => '%s/assets/img/fl1.svg'
                    ),
                    '2col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'botiga' ),
                        'url'   => '%s/assets/img/fl2.svg'
                    ),		
                    '2col-bigleft' => array(
                        'label' => esc_html__( 'Big Left', 'botiga' ),
                        'url'   => '%s/assets/img/fl3.svg'
                    ),				
                    '2col-bigright' => array(
                        'label' => esc_html__( 'Big Right', 'botiga' ),
                        'url'   => '%s/assets/img/fl4.svg'
                    ),
                    '3col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'botiga' ),
                        'url'   => '%s/assets/img/fl5.svg'
                    ),	
                    '3col-bigleft' => array(
                        'label' => esc_html__( 'Big Left', 'botiga' ),
                        'url'   => '%s/assets/img/fl6.svg'
                    ),
                    '3col-bigright' => array(
                        'label' => esc_html__( 'Big Right', 'botiga' ),
                        'url'   => '%s/assets/img/fl7.svg'
                    ),	
                    '4col-equal' => array(
                        'label' => esc_html__( 'Equal', 'botiga' ),
                        'url'   => '%s/assets/img/fl8.svg'
                    ),	
                    '4col-bigleft' => array(
                        'label' => esc_html__( 'Big Left', 'botiga' ),
                        'url'   => '%s/assets/img/fl9.svg'
                    ),
                    '4col-bigright' => array(
                        'label' => esc_html__( 'Big Right', 'botiga' ),
                        'url'   => '%s/assets/img/fl10.svg'
                    ),
                    '5col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'botiga' ),
                        'url'   => '%s/assets/img/fl11.svg'
                    ),
                    '6col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'botiga' ),
                        'url'   => '%s/assets/img/fl12.svg'
                    ),
                ),
                'priority' => 35
            )
        )
    );

    // Elements Spacing.
    $wp_customize->add_setting( 'botiga_footer_row__' . $row['id'] . '_elements_spacing', array(
        'default'   		=> 25,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint',
    ) );			
    
    $wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'botiga_footer_row__' . $row['id'] . '_elements_spacing',
        array(
            'label' 		=> esc_html__( 'Elements Spacing', 'botiga' ),
            'section' 		=> $row['section'],
            'is_responsive'	=> 0,
            'settings' 		=> array (
                'size_desktop' 		=> 'botiga_footer_row__' . $row['id'] . '_elements_spacing',
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 150,
                'step'  => 1
            ),
            'priority'     => 36
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