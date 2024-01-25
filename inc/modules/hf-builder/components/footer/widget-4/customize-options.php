<?php
/**
 * Footer Builder
 * Widget 4 Component
 * 
 * @package Botiga_Pro
 */

$wp_customize->add_section(
    new Botiga_Section_Hidden(
        $wp_customize,
        'botiga_section_fb_component__widget4',
        array(
            'title'      => esc_html__( 'Widget Area 4', 'botiga' ),
            'panel'      => 'botiga_panel_footer',
        )
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__widget4_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__widget4_tabs',
        array(
            'section'               => 'botiga_section_fb_component__widget4',
            'controls_general'      => wp_json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__widget4_goto_edit',
                    '#customize-control-botiga_section_fb_component__widget4_visibility',
                )
            ),
            'controls_design'       => wp_json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__widget4_title_color',
                    '#customize-control-botiga_section_fb_component__widget4_text_color',
                    '#customize-control-botiga_section_fb_component__widget4_links',
					'#customize-control-botiga_section_fb_component__widget4_padding',
					'#customize-control-botiga_section_fb_component__widget4_margin',
                )
            ),
            'priority'              => 20,
        )
    )
);

// Go to button (edit widget)
$wp_customize->add_setting( 'botiga_section_fb_component__widget4_goto_edit',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_fb_component__widget4_goto_edit',
		array(
			'description'   => '<a class="botiga-to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-4\' ).active(true); wp.customize.section( \'sidebar-widgets-footer-4\' ).focus();">' . esc_html__( 'Footer Widget Area 4', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section'       => 'botiga_section_fb_component__widget4',
            'priority'      => 30,
		)
	)
);

// Visibility
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_visibility_desktop',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_visibility_tablet',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_visibility_mobile',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'botiga_section_fb_component__widget4_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'botiga' ),
            'section'       => 'botiga_section_fb_component__widget4',
            'is_responsive' => true,
            'settings' => array(
                'desktop'       => 'botiga_section_fb_component__widget4_visibility_desktop',
                'tablet'        => 'botiga_section_fb_component__widget4_visibility_tablet',
                'mobile'        => 'botiga_section_fb_component__widget4_visibility_mobile',
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'botiga' ),
                'hidden'  => esc_html__( 'Hidden', 'botiga' ),
            ),
            'priority'      => 42,
        )
    ) 
);

// Widget Title Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget4_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget4_title_color',
		array(
			'label'             => esc_html__( 'Widget Title Color', 'botiga' ),
			'section'           => 'botiga_section_fb_component__widget4',
			'priority'          => 50,
		)
	)
);

// Text Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget4_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget4_text_color',
		array(
			'label'             => esc_html__( 'Text Color', 'botiga' ),
			'section'           => 'botiga_section_fb_component__widget4',
			'priority'          => 50,
		)
	)
);

// Links Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget4_links_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'botiga_section_fb_component__widget4_links_color_hover',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'botiga_section_fb_component__widget4_links',
        array(
            'label'    => esc_html__( 'Links Color', 'botiga' ),
            'section'  => 'botiga_section_fb_component__widget4',
            'settings' => array(
                'normal' => 'botiga_section_fb_component__widget4_links_color',
                'hover'  => 'botiga_section_fb_component__widget4_links_color_hover',
            ),
            'priority' => 50,
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_fb_component__widget4_padding',
        array(
            'label'             => __( 'Wrapper Padding', 'botiga' ),
            'section'           => 'botiga_section_fb_component__widget4',
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
                'desktop' => 'botiga_section_fb_component__widget4_padding_desktop',
                'tablet'  => 'botiga_section_fb_component__widget4_padding_tablet',
                'mobile'  => 'botiga_section_fb_component__widget4_padding_mobile',
            ),
            'priority'           => 72,
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_fb_component__widget4_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_fb_component__widget4_margin',
        array(
            'label'             => __( 'Wrapper Margin', 'botiga' ),
            'section'           => 'botiga_section_fb_component__widget4',
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
                'desktop' => 'botiga_section_fb_component__widget4_margin_desktop',
                'tablet'  => 'botiga_section_fb_component__widget4_margin_tablet',
                'mobile'  => 'botiga_section_fb_component__widget4_margin_mobile',
            ),
            'priority'           => 72,
        )
    )
);