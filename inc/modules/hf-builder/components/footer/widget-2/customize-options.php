<?php
/**
 * Footer Builder
 * Widget 2 Component
 * 
 * @package Botiga_Pro
 */

$wp_customize->add_section(
    'botiga_section_fb_component__widget2',
    array(
        'title'      => esc_html__( 'Widget Area 2', 'botiga' ),
        'panel'      => 'botiga_panel_footer'
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__widget2_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__widget2_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_fb_component__widget2',
            'controls_general'		=> json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__widget2_goto_edit'
                )
            ),
            'controls_design'		=> json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__widget2_title_color',
                    '#customize-control-botiga_section_fb_component__widget2_text_color',
                    '#customize-control-botiga_section_fb_component__widget2_links_color',
                    '#customize-control-botiga_section_fb_component__widget2_links_color_hover'
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Go to button (edit widget)
$wp_customize->add_setting( 'botiga_section_fb_component__widget2_goto_edit',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_fb_component__widget2_goto_edit',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;"></span><a class="to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-2\' ).active(true); wp.customize.section( \'sidebar-widgets-footer-2\' ).focus();">' . esc_html__( 'Footer Widget Area 2', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section' 		=> 'botiga_section_fb_component__widget2',
            'priority' 		=> 30
		)
	)
);

// Widget Title Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget2_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget2_title_color',
		array(
			'label'         	=> esc_html__( 'Widget Title Color', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__widget2',
			'priority'			=> 29
		)
	)
);

// Text Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget2_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget2_text_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__widget2',
			'priority'			=> 29
		)
	)
);

// Links Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget2_links_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget2_links_color',
		array(
			'label'         	=> esc_html__( 'Links Color', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__widget2',
			'priority'			=> 29
		)
	)
);

// Links Color Hover
$wp_customize->add_setting(
	'botiga_section_fb_component__widget2_links_color_hover',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget2_links_color_hover',
		array(
			'label'         	=> esc_html__( 'Links Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_fb_component__widget2',
			'priority'			=> 29
		)
	)
);