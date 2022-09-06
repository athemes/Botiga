<?php
/**
 * Footer Builder
 * Copyright/credits Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'footer_credits'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_fb_component__copyright',
    array(
        'title'      => esc_html__( 'Copyright', 'botiga' ),
        'panel'      => 'botiga_panel_footer'
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
            'controls_general'		=> json_encode(
				array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__copyright_text_color',
                    '#customize-control-botiga_section_fb_component__copyright_links_color',
                    '#customize-control-botiga_section_fb_component__copyright_links_color_hover'
                )
            ),
            'priority' 				=> 20
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
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__copyright_links_color',
		array(
			'label'         	=> esc_html__( 'Links Color', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__copyright',
			'priority'			=> 25
		)
	)
);

// Links Color Hover
$wp_customize->add_setting(
	'botiga_section_fb_component__copyright_links_color_hover',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__copyright_links_color_hover',
		array(
			'label'         	=> esc_html__( 'Links Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__copyright',
			'priority'			=> 25
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

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound