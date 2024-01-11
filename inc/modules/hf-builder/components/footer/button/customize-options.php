<?php
/**
 * Footer Builder
 * Button 1 Component
 * 
 * @package Botiga_Pro
 */

$wp_customize->add_section(
    new Botiga_Section_Hidden(
        $wp_customize,
        'botiga_section_fb_component__button',
        array(
            'title'      => esc_html__( 'Button 1', 'botiga' ),
            'panel'      => 'botiga_panel_footer',
        )
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__button_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__button_tabs',
        array(
            'label'                 => '',
            'section'               => 'botiga_section_fb_component__button',
            'controls_general'      => wp_json_encode(
                array(
                    '#customize-control-bhfb_footer_button_text',
                    '#customize-control-bhfb_footer_button_link',
                    '#customize-control-bhfb_footer_button_class',
                    '#customize-control-bhfb_footer_button_newtab',
                    '#customize-control-bhfb_footer_button_visibility',
                )
            ),
            'controls_design'       => wp_json_encode(
                array(
                    '#customize-control-bhfb_footer_button_colors_title',
                    '#customize-control-bhfb_footer_button_background',
                    '#customize-control-bhfb_footer_button',
                    '#customize-control-bhfb_footer_button_border',
					'#customize-control-bhfb_footer_button_padding',
					'#customize-control-bhfb_footer_button_margin',
                )
            ),
            'priority'              => 20,
        )
    )
);

// Button Text
$wp_customize->add_setting(
	'bhfb_footer_button_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( 'Click me', 'botiga' ),
	)       
);
$wp_customize->add_control( 'bhfb_footer_button_text', array(
	'label'       => esc_html__( 'Button text', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_fb_component__button',
	'priority'          => 25,
) );

// Button Link
$wp_customize->add_setting(
	'bhfb_footer_button_link',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'bhfb_footer_button_link', array(
	'label'       => esc_html__( 'Button link', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_fb_component__button',
	'priority'          => 30,
) );

// Button Class
$wp_customize->add_setting(
	'bhfb_footer_button_class',
	array(
		'sanitize_callback' => 'esc_attr',
		'default'           => '',
	)       
);
$wp_customize->add_control( 'bhfb_footer_button_class', array(
	'label'       => esc_html__( 'Button Class', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_fb_component__button',
	'priority'          => 35,
) );

// Button Target
$wp_customize->add_setting(
	'bhfb_footer_button_newtab',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'bhfb_footer_button_newtab',
		array(
			'label'             => esc_html__( 'Open in a new tab?', 'botiga' ),
			'section'           => 'botiga_section_fb_component__button',
			'priority'          => 40,
		)
	)
);

// Visibility
$wp_customize->add_setting( 
    'bhfb_footer_button_visibility_desktop',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'bhfb_footer_button_visibility_tablet',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'bhfb_footer_button_visibility_mobile',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'bhfb_footer_button_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'botiga' ),
            'section'       => 'botiga_section_fb_component__button',
            'is_responsive' => true,
            'settings' => array(
                'desktop'       => 'bhfb_footer_button_visibility_desktop',
                'tablet'        => 'bhfb_footer_button_visibility_tablet',
                'mobile'        => 'bhfb_footer_button_visibility_mobile',
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'botiga' ),
                'hidden'  => esc_html__( 'Hidden', 'botiga' ),
            ),
            'priority'      => 42,
        )
    ) 
);

// Colors Title.
$wp_customize->add_setting( 'bhfb_footer_button_colors_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'bhfb_footer_button_colors_title',
		array(
			'label'         => esc_html__( 'Colors', 'botiga' ),
			'section'       => 'botiga_section_fb_component__button',
            'priority'      => 45,
		)
	)
);

// Background Color.
$wp_customize->add_setting(
	'bhfb_footer_button_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'bhfb_footer_button_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'bhfb_footer_button_background',
        array(
            'label'    => esc_html__( 'Background Color', 'botiga' ),
            'section'  => 'botiga_section_fb_component__button',
            'settings' => array(
                'normal' => 'bhfb_footer_button_background_color',
                'hover'  => 'bhfb_footer_button_background_color_hover',
            ),
            'priority' => 50,
        )
    )
);

// Text Color.
$wp_customize->add_setting(
	'bhfb_footer_button_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'bhfb_footer_button_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'bhfb_footer_button',
        array(
            'label'    => esc_html__( 'Text Color', 'botiga' ),
            'section'  => 'botiga_section_fb_component__button',
            'settings' => array(
                'normal' => 'bhfb_footer_button_color',
                'hover'  => 'bhfb_footer_button_color_hover',
            ),
            'priority' => 55,
        )
    )
);

// Border Color.
$wp_customize->add_setting(
	'bhfb_footer_button_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'bhfb_footer_button_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'bhfb_footer_button_border',
        array(
            'label'    => esc_html__( 'Border Color', 'botiga' ),
            'section'  => 'botiga_section_fb_component__button',
            'settings' => array(
                'normal' => 'bhfb_footer_button_border_color',
                'hover'  => 'bhfb_footer_button_border_color_hover',
            ),
            'priority' => 60,
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'bhfb_footer_button_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'bhfb_footer_button_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'bhfb_footer_button_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'bhfb_footer_button_padding',
        array(
            'label'             => __( 'Wrapper Padding', 'botiga' ),
            'section'           => 'botiga_section_fb_component__button',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true,
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'      => true,
            'settings'           => array(
                'desktop' => 'bhfb_footer_button_padding_desktop',
                'tablet'  => 'bhfb_footer_button_padding_tablet',
                'mobile'  => 'bhfb_footer_button_padding_mobile',
            ),
            'priority'           => 72,
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'bhfb_footer_button_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'bhfb_footer_button_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'bhfb_footer_button_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'bhfb_footer_button_margin',
        array(
            'label'             => __( 'Wrapper Margin', 'botiga' ),
            'section'           => 'botiga_section_fb_component__button',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true,
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'      => true,
            'settings'           => array(
                'desktop' => 'bhfb_footer_button_margin_desktop',
                'tablet'  => 'bhfb_footer_button_margin_tablet',
                'mobile'  => 'bhfb_footer_button_margin_mobile',
            ),
            'priority'           => 72,
        )
    )
);