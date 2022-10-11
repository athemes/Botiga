<?php
/**
 * Footer Builder
 * HTML Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'footer_html_content'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_fb_component__html',
    array(
        'title'      => esc_html__( 'HTML', 'botiga' ),
        'panel'      => 'botiga_panel_footer'
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__html_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__html_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_fb_component__html',
            'controls_general'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-botiga_section_fb_component__html_title',
                        '#customize-control-botiga_section_fb_component__html_text_align'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-botiga_section_fb_component__html_text_color',
                        '#customize-control-botiga_section_fb_component__html_link_color',
                        '#customize-control-botiga_section_fb_component__html_link_color_hover'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

$wp_customize->add_setting( 
    'botiga_section_fb_component__html_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'botiga_section_fb_component__html_title',
        array(
            'label'			  => esc_html__( 'HTML Content', 'botiga' ),
            'section' 		  => 'botiga_section_fb_component__html',
            'priority'	 	  => 29
        )
    )
);

// Text Alignment.
$wp_customize->add_setting( 
    'botiga_section_fb_component__html_text_align_desktop',
    array(
        'default' 			=> 'left',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__html_text_align_tablet',
    array(
        'default' 			=> 'left',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__html_text_align_mobile',
    array(
        'default' 			=> 'left',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'botiga_section_fb_component__html_text_align',
        array(
            'label'         => esc_html__( 'Text Alignment', 'botiga' ),
            'section'       => 'botiga_section_fb_component__html',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'botiga_section_fb_component__html_text_align_desktop',
                'tablet' 		=> 'botiga_section_fb_component__html_text_align_tablet',
                'mobile' 		=> 'botiga_section_fb_component__html_text_align_mobile'
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

// Text Color.
$wp_customize->add_setting(
	'botiga_section_fb_component__html_text_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__html_text_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__html',
            'priority'          => 40
		)
	)
);

// Link Color.
$wp_customize->add_setting(
	'botiga_section_fb_component__html_link_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__html_link_color',
		array(
			'label'         	=> esc_html__( 'Link Color', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__html',
            'priority'          => 41
		)
	)
);

// Link Color Hover.
$wp_customize->add_setting(
	'botiga_section_fb_component__html_link_color_hover',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__html_link_color_hover',
		array(
			'label'         	=> esc_html__( 'Link Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__html',
            'priority'          => 42
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
        
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_fb_component__html';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound