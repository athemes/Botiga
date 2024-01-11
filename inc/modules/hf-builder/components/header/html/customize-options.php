<?php
/**
 * Header/Footer Builder
 * HTML Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_html_content'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    new Botiga_Section_Hidden(
        $wp_customize,
        'botiga_section_hb_component__html',
        array(
            'title'      => esc_html__( 'HTML', 'botiga' ),
            'panel'      => 'botiga_panel_header'
        )
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__html_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__html_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__html',
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-botiga_section_hb_component__html_text_align',
                        '#customize-control-botiga_section_hb_component__html_visibility'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-botiga_section_hb_component__html_text_color',
                        '#customize-control-botiga_section_hb_component__html_link',

						// Sticky State
                        '#customize-control-botiga_section_hb_component__html_sticky_title',
                        '#customize-control-botiga_section_hb_component__html_sticky_text_color',
                        '#customize-control-botiga_section_hb_component__html_sticky_link',
                        '#customize-control-botiga_section_hb_component__html_padding',
                        '#customize-control-botiga_section_hb_component__html_margin'

                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Text Alignment.
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_text_align_desktop',
    array(
        'default' 			=> 'left',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_text_align_tablet',
    array(
        'default' 			=> 'left',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_text_align_mobile',
    array(
        'default' 			=> 'left',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'botiga_section_hb_component__html_text_align',
        array(
            'label'         => esc_html__( 'Text Alignment', 'botiga' ),
            'section'       => 'botiga_section_hb_component__html',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'botiga_section_hb_component__html_text_align_desktop',
                'tablet' 		=> 'botiga_section_hb_component__html_text_align_tablet',
                'mobile' 		=> 'botiga_section_hb_component__html_text_align_mobile'
            ),
            'choices'       => array(
                'left' 		=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
                'center' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
                'right' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>'
            ),
            'priority'      => 30
        )
    ) 
);

// Visibility
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'botiga_section_hb_component__html_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'botiga' ),
            'section'       => 'botiga_section_hb_component__html',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'botiga_section_hb_component__html_visibility_desktop',
                'tablet' 		=> 'botiga_section_hb_component__html_visibility_tablet',
                'mobile' 		=> 'botiga_section_hb_component__html_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'botiga' ),
                'hidden'  => esc_html__( 'Hidden', 'botiga' )
            ),
            'priority'      => 30
        )
    ) 
);

// Text Color.
$wp_customize->add_setting(
	'botiga_section_hb_component__html_text_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_hb_component__html_text_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__html',
            'priority'          => 40
		)
	)
);

// Link Color.
$wp_customize->add_setting(
	'botiga_section_hb_component__html_link_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'botiga_section_hb_component__html_link_color_hover',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'botiga_section_hb_component__html_link',
        array(
            'label'    => esc_html__( 'Link Color', 'botiga' ),
            'section'  => 'botiga_section_hb_component__html',
            'settings' => array(
                'normal' => 'botiga_section_hb_component__html_link_color',
                'hover'  => 'botiga_section_hb_component__html_link_color_hover',
            ),
            'priority' => 41
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'botiga_section_hb_component__html_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga' ),
            'section' 		  => 'botiga_section_hb_component__html',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 44
        )
    )
);

// Sticky - Text Color.
$wp_customize->add_setting(
	'botiga_section_hb_component__html_sticky_text_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_hb_component__html_sticky_text_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__html',
            'active_callback'   => 'botiga_sticky_header_enabled',
            'priority'          => 45
		)
	)
);

// Sticky - Link Color.
$wp_customize->add_setting(
	'botiga_section_hb_component__html_sticky_link_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'botiga_section_hb_component__html_sticky_link_color_hover',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'botiga_section_hb_component__html_sticky_link',
        array(
            'label'    => esc_html__( 'Link Color', 'botiga' ),
            'section'  => 'botiga_section_hb_component__html',
            'settings' => array(
                'normal' => 'botiga_section_hb_component__html_sticky_link_color',
                'hover'  => 'botiga_section_hb_component__html_sticky_link_color_hover',
            ),
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority' => 46
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_hb_component__html_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__html',
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
                'desktop' => 'botiga_section_hb_component__html_padding_desktop',
                'tablet'  => 'botiga_section_hb_component__html_padding_tablet',
                'mobile'  => 'botiga_section_hb_component__html_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__html_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_hb_component__html_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__html',
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
                'desktop' => 'botiga_section_hb_component__html_margin_desktop',
                'tablet'  => 'botiga_section_hb_component__html_margin_tablet',
                'mobile'  => 'botiga_section_hb_component__html_margin_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Move existing options.
$priority = 30;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }

        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__html';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound