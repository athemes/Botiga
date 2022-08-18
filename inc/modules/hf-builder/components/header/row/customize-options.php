<?php
/**
 * Header/Footer Builder
 * Rows
 * 
 * @package Botiga_Pro
 */

/**
 * All Controls 
 */

foreach( $this->header_rows as $row ) {
    $wp_customize->add_setting(
        'botiga_header_row__' . $row['id'],
        array(
            'default'           => $row['default'],
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'botiga_header_row__' . $row['id'],
        array(
            'type'     => 'text',
            'label'    => esc_html( $row['label'] ),
            'section'  => $row['section'],
            'settings' => 'botiga_header_row__' . $row['id'],
            'priority' => 10
        )
    );

    // Selective Refresh
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'botiga_header_row__' . $row['id'],
            array(
                'selector'        => '.bhfb-desktop .bhfb-rows .bhfb-' . $row['id'],
                'render_callback' => function() use( $row ) {
                    $this->rows_callback( 'header', $row['id'], 'desktop' );
                },
            )
        );
    }

    $wp_customize->add_setting(
        'botiga_header_row__' . $row['id'] . '_tabs',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control(
        new Botiga_Tab_Control (
            $wp_customize,
            'botiga_header_row__' . $row['id'] . '_tabs',
            array(
                'label' 				=> '',
                'section'       		=> $row['section'],
                'controls_general'		=> json_encode( array( 
                    '#customize-control-botiga_header_row__mobile_above_header_row',
                    '#customize-control-botiga_header_row__mobile_main_header_row',
                    '#customize-control-botiga_header_row__mobile_below_header_row',
                    '#customize-control-botiga_header_row__' . $row['id'] ,
                    '#customize-control-botiga_header_row__' . $row['id'] . '_height' ) 
                ),
                'controls_design'		=> json_encode( array( 
                    '#customize-control-botiga_header_row__' . $row['id'] . '_background_color',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_border_bottom',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_border_bottom_color',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_padding',

                    // Stiky Active State
                    '#customize-control-botiga_header_row__' . $row['id'] . '_sticky_divider1',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_sticky_title',
                    
                    '#customize-control-botiga_header_row__' . $row['id'] . '_sticky_background_color',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_sticky_border_bottom_color'
                ) ),
                'priority' 				=> 20
            )
        )
    );

    /**
     * General
     */

    // Height.
    $wp_customize->add_setting( 'botiga_header_row__' . $row['id'] . '_height_desktop', array(
        'default'   		=> 100,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );			
    $wp_customize->add_setting( 'botiga_header_row__' . $row['id'] . '_height_tablet', array(
        'default'   		=> 100,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_setting( 'botiga_header_row__' . $row['id'] . '_height_mobile', array(
        'default'   		=> 100,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );			
    
    $wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'botiga_header_row__' . $row['id'] . '_height',
        array(
            'label' 		=> esc_html__( 'Height', 'botiga-pro' ),
            'section' 		=> $row['section'],
            'is_responsive'	=> 1,
            'settings' 		=> array (
                'size_desktop' 		=> 'botiga_header_row__' . $row['id'] . '_height_desktop',
                'size_tablet' 		=> 'botiga_header_row__' . $row['id'] . '_height_tablet',
                'size_mobile' 		=> 'botiga_header_row__' . $row['id'] . '_height_mobile',
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 500
            ),
            'priority'              => 30
        )
    ) );

    /**
     * Styling
     */

    // Background.
    $wp_customize->add_setting(
        'botiga_header_row__' . $row['id'] . '_background_color',
        array(
            'default'           => '#FFF',
            'sanitize_callback' => 'botiga_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Alpha_Color(
            $wp_customize,
            'botiga_header_row__' . $row['id'] . '_background_color',
            array(
                'label'         	=> esc_html__( 'Background Color', 'botiga-pro' ),
                'section'       	=> $row['section'],
                'priority'			=> 32
            )
        )
    );

    // Border Bottom.
    $wp_customize->add_setting( 'botiga_header_row__' . $row['id'] . '_border_bottom_desktop', array(
        'default'   		=> 1,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );						
    $wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'botiga_header_row__' . $row['id'] . '_border_bottom',
        array(
            'label' 		=> esc_html__( 'Border Bottom Size', 'botiga-pro' ),
            'section' 		=> $row['section'],
            'is_responsive'	=> 0,
            'settings' 		=> array (
                'size_desktop' 		=> 'botiga_header_row__' . $row['id'] . '_border_bottom_desktop'
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
        'botiga_header_row__' . $row['id'] . '_border_bottom_color',
        array(
            'default'           => '#EAEAEA',
            'sanitize_callback' => 'botiga_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Alpha_Color(
            $wp_customize,
            'botiga_header_row__' . $row['id'] . '_border_bottom_color',
            array(
                'label'         	=> esc_html__( 'Border Bottom Color', 'botiga-pro' ),
                'section'       	=> $row['section'],
                'priority'			=> 36
            )
        )
    );

    // Sticky Header - Divider
    $wp_customize->add_setting( 'botiga_header_row__' . $row['id'] . '_sticky_divider1',
        array(
            'sanitize_callback' => 'esc_attr'
        )
        );
        $wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'botiga_header_row__' . $row['id'] . '_sticky_divider1',
            array(
                'section' 		  => $row['section'],
                'active_callback' => 'botiga_sticky_header_enabled',
                'priority'        => 37
            )
        )
    );

    // Sticky Header - Title
    $wp_customize->add_setting( 
        'botiga_header_row__' . $row['id'] . '_sticky_title',
        array(
            'default' 			=> '',
            'sanitize_callback' => 'esc_attr'
        )
        );
        $wp_customize->add_control( 
        new Botiga_Text_Control( 
            $wp_customize, 
            'botiga_header_row__' . $row['id'] . '_sticky_title',
            array(
                'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga-pro' ),
                'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga-pro' ),
                'section' 		  => $row['section'],
                'active_callback' => 'botiga_sticky_header_enabled',
                'priority'	 	  => 38
            )
        )
    );

    // Sticky Header - Background.
    $wp_customize->add_setting(
        'botiga_header_row__' . $row['id'] . '_sticky_background_color',
        array(
            'default'           => '#FFF',
            'sanitize_callback' => 'botiga_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Alpha_Color(
            $wp_customize,
            'botiga_header_row__' . $row['id'] . '_sticky_background_color',
            array(
                'label'         	=> esc_html__( 'Background Color', 'botiga-pro' ),
                'section'       	=> $row['section'],
                'priority'			=> 39
            )
        )
    );

    // Sticky Header - Border Bottom Color.
    $wp_customize->add_setting(
        'botiga_header_row__' . $row['id'] . '_sticky_border_bottom_color',
        array(
            'default'           => '#EAEAEA',
            'sanitize_callback' => 'botiga_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Alpha_Color(
            $wp_customize,
            'botiga_header_row__' . $row['id'] . '_sticky_border_bottom_color',
            array(
                'label'         	=> esc_html__( 'Border Bottom Color', 'botiga-pro' ),
                'section'       	=> $row['section'],
                'priority'			=> 40
            )
        )
    );
}

/**
 * Mobile Controls
 * Currently we only add mobile partials here to trigger the 'change'
 * javascript event and consequently do the selective refresh in the desired area.
 * 
 * For now no more controls than that are needed to be added here.
 */
foreach( $this->header_rows as $row ) {
    $wp_customize->add_setting(
        'botiga_header_row__mobile_' . $row['id'],
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'botiga_header_row__mobile_' . $row['id'],
        array(
            'type'     => 'text',
            'label'    => sprintf( esc_html__( 'Mobile - %s', 'botiga-pro' ), $row['label'] ),
            'section'  => $row['section'],
            'settings' => 'botiga_header_row__mobile_' . $row['id'],
            'priority' => 10
        )
    );

    // Selective Refresh
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'botiga_header_row__mobile_' . $row['id'],
            array(
                'selector'        => '.bhfb-mobile .bhfb-' . $row['id'],
                'render_callback' => function() use( $row ) {
                    $this->rows_callback( 'header', $row['id'], 'mobile' );
                },
            )
        );
    }
}