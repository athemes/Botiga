<?php
/**
 * Footer Builder
 * Copyright/credits Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'footer_credits'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    new Botiga_Section_Hidden(
        $wp_customize,
        'botiga_section_fb_component__copyright',
        array(
            'title'      => esc_html__( 'Copyright', 'botiga' ),
            'panel'      => 'botiga_panel_footer'
        )
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__copyright_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__copyright_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_fb_component__copyright',
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-botiga_section_fb_component__copyright_visibility'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                ),
            ),
            'controls_design'		=> wp_json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__copyright_text_color',
                    '#customize-control-botiga_section_fb_component__copyright_links',
                    '#customize-control-botiga_section_fb_component__copyright_padding',
                    '#customize-control-botiga_section_fb_component__copyright_margin'
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Visibility
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'botiga_section_fb_component__copyright_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'botiga' ),
            'section'       => 'botiga_section_fb_component__copyright',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'botiga_section_fb_component__copyright_visibility_desktop',
                'tablet' 		=> 'botiga_section_fb_component__copyright_visibility_tablet',
                'mobile' 		=> 'botiga_section_fb_component__copyright_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'botiga' ),
                'hidden'  => esc_html__( 'Hidden', 'botiga' )
            ),
            'priority'      => 42
        )
    ) 
);

// Text Color
$wp_customize->add_setting(
	'botiga_section_fb_component__copyright_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__copyright_text_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__copyright',
			'priority'			=> 25
		)
	)
);

// Links Color
$wp_customize->add_setting(
	'botiga_section_fb_component__copyright_links_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
    'botiga_section_fb_component__copyright_links_color_hover',
    array(
        'default'           => '#212121',
        'sanitize_callback' => 'botiga_sanitize_hex_rgba',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'botiga_section_fb_component__copyright_links',
        array(
            'label'    => esc_html__( 'Links Color', 'botiga' ),
            'section'  => 'botiga_section_fb_component__copyright',
            'settings' => array(
                'normal' => 'botiga_section_fb_component__copyright_links_color',
                'hover'  => 'botiga_section_fb_component__copyright_links_color_hover',
            ),
            'priority' => 25
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_fb_component__copyright_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'botiga' ),
            'section'         	=> 'botiga_section_fb_component__copyright',
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
                'desktop' => 'botiga_section_fb_component__copyright_padding_desktop',
                'tablet'  => 'botiga_section_fb_component__copyright_padding_tablet',
                'mobile'  => 'botiga_section_fb_component__copyright_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__copyright_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_fb_component__copyright_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'botiga' ),
            'section'         	=> 'botiga_section_fb_component__copyright',
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
                'desktop' => 'botiga_section_fb_component__copyright_margin_desktop',
                'tablet'  => 'botiga_section_fb_component__copyright_margin_tablet',
                'mobile'  => 'botiga_section_fb_component__copyright_margin_mobile'
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
		
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_fb_component__copyright';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound