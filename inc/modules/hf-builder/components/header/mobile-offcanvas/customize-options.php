<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Options
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_offcanvas_mode',
        'mobile_menu_elements_spacing',
        'mobile_menu_alignment'
    ),
    'style'   => array(
        'offcanvas_menu_background'
    )
);

// Mobile Offcanvas Wrapper/Row
$wp_customize->add_setting(
    'botiga_header_row__mobile_offcanvas',
    array(
        'default'           => $this->get_row_default_value( 'mobile_offcanvas' ),
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    'botiga_header_row__mobile_offcanvas',
    array(
        'type'     => 'text',
        'label'    => esc_html__( 'Mobile Offcanvas', 'botiga' ),
        'section'  => 'botiga_section_hb_mobile_offcanvas',
        'settings' => 'botiga_header_row__mobile_offcanvas',
        'priority' => 10
    )
);

// Selective Refresh
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial(
        'botiga_header_row__mobile_offcanvas',
        array(
            'selector'        => '.bhfb-mobile_offcanvas .bhfb-mobile-offcanvas-rows',
            'render_callback' => function() {
                $this->mobile_offcanvas_callback( 'mobile_offcanvas' ); // phpcs:ignore PHPCompatibility.FunctionDeclarations.NewClosure.ThisFoundOutsideClass
            },
        )
    );
}

// Tabs
$wp_customize->add_setting(
    'botiga_header_row__mobile_offcanvas_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_header_row__mobile_offcanvas_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_mobile_offcanvas',
            'controls_general'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-botiga_header_row__mobile_offcanvas',
                        '#customize-control-bhfb_mobile_offcanvas_padding',
                        '#customize-control-bhfb_mobile_offcanvas_close_offset'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_mobile_offcanvas_close_background_color',
                        '#customize-control-bhfb_mobile_offcanvas_close_text_color',
                        '#customize-control-bhfb_mobile_offcanvas_close_text_color_hover',
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Padding.
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_padding', 
    array(
        'default'   		=> 20,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint',
    ) 
);			
$wp_customize->add_control( 
    new Botiga_Responsive_Slider( 
        $wp_customize, 
        'bhfb_mobile_offcanvas_padding',
        array(
            'label' 		=> esc_html__( 'Padding', 'botiga' ),
            'section' 		=> 'botiga_section_hb_mobile_offcanvas',
            'is_responsive'	=> 0,
            'settings' 		=> array (
                'size_desktop' 		=> 'bhfb_mobile_offcanvas_padding',
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 200,
                'step'  => 1
            ),
            'priority'     => 25
        )
    ) 
);

// Close Button Offset.
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_close_offset', 
    array(
        'default'   		=> 20,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint',
    ) 
);			
$wp_customize->add_control( 
    new Botiga_Responsive_Slider( 
        $wp_customize, 
        'bhfb_mobile_offcanvas_close_offset',
        array(
            'label' 		=> esc_html__( 'Close Icon Offset', 'botiga' ),
            'section' 		=> 'botiga_section_hb_mobile_offcanvas',
            'is_responsive'	=> 0,
            'settings' 		=> array (
                'size_desktop' 		=> 'bhfb_mobile_offcanvas_close_offset',
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 100,
                'step'  => 1
            ),
            'priority'     => 25
        )
    ) 
);

// Close Icon Background.
$wp_customize->add_setting(
	'bhfb_mobile_offcanvas_close_background_color',
	array(
		'default'           => 'rgba(255,255,255,0)',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_mobile_offcanvas_close_background_color',
		array(
			'label'         	=> esc_html__( 'Close Icon Background', 'botiga' ),
			'section'       	=> 'botiga_section_hb_mobile_offcanvas',
			'priority'			=> 40
		)
	)
);

// Close Icon Text Color.
$wp_customize->add_setting(
	'bhfb_mobile_offcanvas_close_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_mobile_offcanvas_close_text_color',
		array(
			'label'         	=> esc_html__( 'Close Icon Text', 'botiga' ),
			'section'       	=> 'botiga_section_hb_mobile_offcanvas',
			'priority'			=> 40
		)
	)
);

// Close Icon Text Color Hover.
$wp_customize->add_setting(
	'bhfb_mobile_offcanvas_close_text_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_mobile_offcanvas_close_text_color_hover',
		array(
			'label'         	=> esc_html__( 'Close Icon Text Hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_mobile_offcanvas',
			'priority'			=> 40
		)
	)
);

// Move existing options.
$priority = 25;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {
        
        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
        
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_mobile_offcanvas';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound