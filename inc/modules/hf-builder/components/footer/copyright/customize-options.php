<?php
/**
 * Footer Builder
 * Copyright/credits Component
 * 
 * @package Botiga_Pro
 */

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
        'title'      => esc_html__( 'Copyright', 'botiga-pro' ),
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
				array_merge(
					array(
						'#customize-control-botiga_section_fb_component__copyright_text_alignment'
					),
					array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
				)
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

// Text Alignment
$wp_customize->add_setting( 'botiga_section_fb_component__copyright_text_alignment',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'botiga_sanitize_text',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'botiga_section_fb_component__copyright_text_alignment',
	array(
		'label'   => esc_html__( 'Text Alignment', 'botiga-pro' ),
		'section' => 'botiga_section_fb_component__copyright',
		'choices' => array(
			'left'   => esc_html__( 'left', 'botiga-pro' ),
			'center' => esc_html__( 'Center', 'botiga-pro' ),
			'right'  => esc_html__( 'Right', 'botiga-pro' )
		),
		'priority'              => 35
	)
) );

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
			'label'         	=> esc_html__( 'Text Color', 'botiga-pro' ),
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
			'label'         	=> esc_html__( 'Links Color', 'botiga-pro' ),
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
			'label'         	=> esc_html__( 'Links Color Hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__copyright',
			'priority'			=> 25
		)
	)
);

// Move existing options.
$priority = 30;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_fb_component__copyright';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}