<?php
/**
 * Footer Builder
 * Button 2 Component
 * 
 * @package Botiga_Pro
 */

$wp_customize->add_section(
    'botiga_section_fb_component__button2',
    array(
        'title'      => esc_html__( 'Button 2', 'botiga-pro' ),
        'panel'      => 'botiga_panel_footer'
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__button2_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__button2_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_fb_component__button2',
            'controls_general'		=> json_encode(
                array(
                    '#customize-control-bhfb_footer_button2_text',
                    '#customize-control-bhfb_footer_button2_link',
                    '#customize-control-bhfb_footer_button2_class',
                    '#customize-control-bhfb_footer_button2_newtab'
                )
            ),
            'controls_design'		=> json_encode(
                array(
                    '#customize-control-bhfb_footer_button2_default_state_title',
                    '#customize-control-bhfb_footer_button2_background_color',
                    '#customize-control-bhfb_footer_button2_color',
                    '#customize-control-bhfb_footer_button2_border_color',
                    '#customize-control-bhfb_footer_button2_buttons_divider_2',
                    '#customize-control-bhfb_footer_button2_buttons_hover_state_title',
                    '#customize-control-bhfb_footer_button2_background_color_hover',
                    '#customize-control-bhfb_footer_button2_color_hover',
                    '#customize-control-bhfb_footer_button2_border_color_hover'
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Button Text
$wp_customize->add_setting(
	'bhfb_footer_button2_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( 'Click me', 'botiga-pro' ),
	)       
);
$wp_customize->add_control( 'bhfb_footer_button2_text', array(
	'label'       => esc_html__( 'Button text', 'botiga-pro' ),
	'type'        => 'text',
	'section'     => 'botiga_section_fb_component__button2',
	'priority'			=> 25
) );

// Button Link
$wp_customize->add_setting(
	'bhfb_footer_button2_link',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'bhfb_footer_button2_link', array(
	'label'       => esc_html__( 'Button link', 'botiga-pro' ),
	'type'        => 'text',
	'section'     => 'botiga_section_fb_component__button2',
	'priority'			=> 30
) );

// Button Class
$wp_customize->add_setting(
	'bhfb_footer_button2_class',
	array(
		'sanitize_callback' => 'esc_attr',
		'default'           => '',
	)       
);
$wp_customize->add_control( 'bhfb_footer_button2_class', array(
	'label'       => esc_html__( 'Button Class', 'botiga-pro' ),
	'type'        => 'text',
	'section'     => 'botiga_section_fb_component__button2',
	'priority'			=> 35
) );

// Button Target
$wp_customize->add_setting(
	'bhfb_footer_button2_newtab',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'bhfb_footer_button2_newtab',
		array(
			'label'         	=> esc_html__( 'Open in a new tab?', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__button2',
			'priority'			=> 40
		)
	)
);

// Default State Title.
$wp_customize->add_setting( 'bhfb_footer_button2_default_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'bhfb_footer_button2_default_state_title',
		array(
			'label'			=> esc_html__( 'Default state', 'botiga-pro' ),
			'section' 		=> 'botiga_section_fb_component__button2',
            'priority'      => 45
		)
	)
);

// Background Color.
$wp_customize->add_setting(
	'bhfb_footer_button2_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_footer_button2_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__button2',
            'priority'          => 50
		)
	)
);

// Text Color.
$wp_customize->add_setting(
	'bhfb_footer_button2_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_footer_button2_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__button2',
            'priority'          => 55
		)
	)
);

// Border Color.
$wp_customize->add_setting(
	'bhfb_footer_button2_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_footer_button2_border_color',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__button2',
            'priority'          => 60
		)
	)
);

// Divider.
$wp_customize->add_setting( 'bhfb_footer_button2_buttons_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'bhfb_footer_button2_buttons_divider_2',
		array(
			'section' 		=> 'botiga_section_fb_component__button2',
            'priority'      => 65
		)
	)
);

// Hover State Title.
$wp_customize->add_setting( 'bhfb_footer_button2_buttons_hover_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'bhfb_footer_button2_buttons_hover_state_title',
		array(
			'label'			=> esc_html__( 'Hover state', 'botiga-pro' ),
			'section' 		=> 'botiga_section_fb_component__button2',
            'priority'      => 70
		)
	)
);

// Background Color Hover.
$wp_customize->add_setting(
	'bhfb_footer_button2_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_footer_button2_background_color_hover',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__button2',
            'priority'          => 75
		)
	)
);

// Text Color Hover.
$wp_customize->add_setting(
	'bhfb_footer_button2_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_footer_button2_color_hover',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__button2',
            'priority'          => 80
		)
	)
);

// Border Color Hover.
$wp_customize->add_setting(
	'bhfb_footer_button2_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_footer_button2_border_color_hover',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__button2',
            'priority'          => 85
		)
	)
);