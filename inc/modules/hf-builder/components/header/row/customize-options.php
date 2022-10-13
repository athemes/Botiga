<?php
/**
 * Header/Footer Builder
 * Rows
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

/**
 * Rows
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
                    $this->rows_callback( 'header', $row['id'], 'desktop' ); // phpcs:ignore PHPCompatibility.FunctionDeclarations.NewClosure.ThisFoundOutsideClass
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
                    '#customize-control-botiga_header_row__' . $row['id'] . '_height',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_columns',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_columns_layout',
                    '#customize-control-botiga_header_row__' . $row['id'] . '_available_columns'
                ) ),
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
            'label' 		=> esc_html__( 'Height', 'botiga' ),
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

    // Columns.
    $wp_customize->add_setting( 'botiga_header_row__' . $row['id'] . '_columns_desktop',
        array(
            'default' 			=> '3',
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_setting( 'botiga_header_row__' . $row['id'] . '_columns_tablet',
        array(
            'default' 			=> '3',
            'sanitize_callback' => 'botiga_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'botiga_header_row__' . $row['id'] . '_columns',
        array(
            'label'         => esc_html__( 'Columns', 'botiga' ),
            'section'       => $row['section'],
            'is_responsive' => true,
            'settings' 		=> array (
                'desktop' 		=> 'botiga_header_row__' . $row['id'] . '_columns_desktop',
                'tablet' 		=> 'botiga_header_row__' . $row['id'] . '_columns_tablet'
            ),
            'choices'       => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'priority'      => 35
        )
    ) );

    // Columns Layout.
    $wp_customize->add_setting(
        'botiga_header_row__' . $row['id'] . '_columns_layout_desktop',
        array(
            'default'           => 'equal',
            'sanitize_callback' => 'sanitize_key',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_setting(
        'botiga_header_row__' . $row['id'] . '_columns_layout_tablet',
        array(
            'default'           => 'equal',
            'sanitize_callback' => 'sanitize_key',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Botiga_Radio_Images(
            $wp_customize,
            'botiga_header_row__' . $row['id'] . '_columns_layout',
            array(
                'label'    => esc_html__( 'Columns Layout', 'botiga' ),
                'section'  => $row['section'],
                'cols' 		=> 4,
                'is_responsive' => true,
                'settings' 		=> array (
                    'desktop' 		=> 'botiga_header_row__' . $row['id'] . '_columns_layout_desktop',
                    'tablet' 		=> 'botiga_header_row__' . $row['id'] . '_columns_layout_tablet'
                ),
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
                    '3col-fluid' => array(
                        'label' => esc_html__( 'Fluid Width', 'botiga' ),
                        'url'   => '%s/assets/img/fl13.svg'
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

    // Available Columns.
    $devices = array( 'desktop', 'tablet' );
    $desc    = '';
    foreach( $devices as $device ) {
        $desc .= '<div class="bhfb-available-columns bhfb-available-columns-'. esc_attr( $device ) .'">';
            $desc .= '<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Available Columns', 'botiga' ) .'</span>';
            $desc .= '<div class="bhfb-available-columns-items-wrapper">';
            for( $i=1;$i<=6;$i++ ) {
                $col_section_id = 'botiga_header_row__' . $row['id'] . '_column' . $i;

                $desc .= '<a class="bhfb-available-columns-item to-widget-area-link" href="#" data-column="'. absint( $i ) .'" onClick="wp.customize.section(\''. esc_js( $col_section_id ) .'\').focus()">'. /* translators: 1: column number. */ sprintf( esc_html__( 'Column %s', 'botiga' ), absint( $i ) ) .'<span class="dashicons dashicons-arrow-right-alt2"></span></a>';
            }
            $desc .= '</div>';
        $desc .= '</div>';
    }

    $wp_customize->add_setting( 
        'botiga_header_row__' . $row['id'] . '_available_columns',
        array(
            'default' 			=> '',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( 
        new Botiga_Text_Control( 
            $wp_customize, 
            'botiga_header_row__' . $row['id'] . '_available_columns',
            array(
                'description' 	=> $desc,
                'section' 		=> $row['section'],
                'priority' 		=> 37
            )
        )
    );

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
                'label'         	=> esc_html__( 'Background Color', 'botiga' ),
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
            'label' 		=> esc_html__( 'Border Bottom Size', 'botiga' ),
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
                'label'         	=> esc_html__( 'Border Bottom Color', 'botiga' ),
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
                'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga' ),
                'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga' ),
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
                'label'         	=> esc_html__( 'Background Color', 'botiga' ),
                'section'       	=> $row['section'],
                'active_callback'   => 'botiga_sticky_header_enabled',
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
                'label'         	=> esc_html__( 'Border Bottom Color', 'botiga' ),
                'section'       	=> $row['section'],
                'active_callback'   => 'botiga_sticky_header_enabled',
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
            /* translators: 1: Mobile row identifier. */
            'label'    => sprintf( esc_html__( 'Mobile - %s', 'botiga' ), $row['label'] ),
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
                    $this->rows_callback( 'header', $row['id'], 'mobile' ); // phpcs:ignore PHPCompatibility.FunctionDeclarations.NewClosure.ThisFoundOutsideClass
                },
            )
        );
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound