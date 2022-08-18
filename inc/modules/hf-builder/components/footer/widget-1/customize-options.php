<?php
/**
 * Footer Builder
 * Widget 1 Component
 * 
 * @package Botiga_Pro
 */

$wp_customize->add_section(
    'botiga_section_fb_component__widget1',
    array(
        'title'      => esc_html__( 'Widget 1', 'botiga-pro' ),
        'panel'      => 'botiga_panel_footer'
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__widget1_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__widget1_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_fb_component__widget1',
            'controls_general'		=> json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__widget1_goto_edit'
                )
            ),
            'controls_design'		=> json_encode(
                array(
                    '#customize-control-botiga_section_fb_component__widget1_title_color',
                    '#customize-control-botiga_section_fb_component__widget1_text_color',
                    '#customize-control-botiga_section_fb_component__widget1_links_color',
                    '#customize-control-botiga_section_fb_component__widget1_links_color_hover'
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Go to button (edit widget)
$wp_customize->add_setting( 'botiga_section_fb_component__widget1_goto_edit',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_fb_component__widget1_goto_edit',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;"></span><a class="to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-1\' ).focus();">' . esc_html__( 'Footer Widget Area 1', 'botiga-pro' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section' 		=> 'botiga_section_fb_component__widget1',
            'priority' 		=> 30
		)
	)
);

// Widget Title Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget1_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget1_title_color',
		array(
			'label'         	=> esc_html__( 'Widget Title Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__widget1',
			'priority'			=> 29
		)
	)
);

// Text Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget1_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget1_text_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__widget1',
			'priority'			=> 29
		)
	)
);

// Links Color
$wp_customize->add_setting(
	'botiga_section_fb_component__widget1_links_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget1_links_color',
		array(
			'label'         	=> esc_html__( 'Links Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__widget1',
			'priority'			=> 29
		)
	)
);

// Links Color Hover
$wp_customize->add_setting(
	'botiga_section_fb_component__widget1_links_color_hover',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'botiga_section_fb_component__widget1_links_color_hover',
		array(
			'label'         	=> esc_html__( 'Links Color Hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__widget1',
			'priority'			=> 29
		)
	)
);