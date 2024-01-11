<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Options
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

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
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-botiga_header_row__mobile_offcanvas',
                        '#customize-control-bhfb_mobile_offcanvas_close_offset',
                        '#customize-control-bhfb_mobile_offcanvas_hide_close_button'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] ),
                    array(
                        '#customize-control-bhfb_mobile_offcanvas_close_background_color',
                        '#customize-control-bhfb_mobile_offcanvas_close_text',
                        '#customize-control-bhfb_mobile_offcanvas_padding',
                        '#customize-control-bhfb_mobile_offcanvas_margin'
                    )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Hide Close Button.
$wp_customize->add_setting(
    'bhfb_mobile_offcanvas_hide_close_button',
    array(
        'default'           => 0,
        'sanitize_callback' => 'botiga_sanitize_checkbox'
    )
);
$wp_customize->add_control(
    new Botiga_Toggle_Control(
        $wp_customize,
        'bhfb_mobile_offcanvas_hide_close_button',
        array(
            'label'         	=> esc_html__( 'Hide Close Icon', 'botiga' ),
            'section'       	=> 'botiga_section_hb_mobile_offcanvas',
            'priority' 			=> 25
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
            'active_callback' => function(){ return ! get_theme_mod( 'bhfb_mobile_offcanvas_hide_close_button', 0 ); },
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
$wp_customize->add_setting(
	'bhfb_mobile_offcanvas_close_text_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'bhfb_mobile_offcanvas_close_text',
        array(
            'label'    => esc_html__( 'Close Icon Text', 'botiga' ),
            'section'  => 'botiga_section_hb_mobile_offcanvas',
            'settings' => array(
                'normal' => 'bhfb_mobile_offcanvas_close_text_color',
                'hover'  => 'bhfb_mobile_offcanvas_close_text_color_hover',
            ),
            'priority' => 40
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "20", "right": "20", "bottom": "20", "left": "20" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "20", "right": "20", "bottom": "20", "left": "20" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "20", "right": "20", "bottom": "20", "left": "20" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'bhfb_mobile_offcanvas_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'botiga' ),
            'section'         	=> 'botiga_section_hb_mobile_offcanvas',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'bhfb_mobile_offcanvas_padding_desktop',
                'tablet'  => 'bhfb_mobile_offcanvas_padding_tablet',
                'mobile'  => 'bhfb_mobile_offcanvas_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_mobile_offcanvas_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'bhfb_mobile_offcanvas_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'botiga' ),
            'section'         	=> 'botiga_section_hb_mobile_offcanvas',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'bhfb_mobile_offcanvas_margin_desktop',
                'tablet'  => 'bhfb_mobile_offcanvas_margin_tablet',
                'mobile'  => 'bhfb_mobile_offcanvas_margin_mobile'
            ),
            'priority'	      	 => 72
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

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound