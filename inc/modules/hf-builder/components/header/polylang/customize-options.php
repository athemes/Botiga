<?php
/**
 * Header/Footer Builder
 * Polylang Components
 * 
 * @package Botiga_Pro
 */

/**
 * Polylang Language Switcher
 * 
 */
$wp_customize->add_section(
    'botiga_section_hb_component__pll_switcher',
    array(
        'title'      => esc_html__( 'Polylang Language Switcher', 'botiga-pro' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
	'botiga_section_hb_component__pll_switcher_show_flags',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'botiga_section_hb_component__pll_switcher_show_flags',
		array(
			'label'         	=> esc_html__( 'Show flags', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__pll_switcher',
            'priority' 			=> 30
		)
	)
);

$wp_customize->add_setting(
	'botiga_section_hb_component__pll_switcher_show_names',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'botiga_section_hb_component__pll_switcher_show_names',
		array(
			'label'         	=> esc_html__( 'Show names', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__pll_switcher',
            'priority' 			=> 35
		)
	)
);

$wp_customize->add_setting(
	'botiga_section_hb_component__pll_switcher_dropdown',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'botiga_section_hb_component__pll_switcher_dropdown',
		array(
			'label'         	=> esc_html__( 'Show as dropdown', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__pll_switcher',
            'priority' 			=> 40
		)
	)
);

$wp_customize->add_setting(
	'botiga_section_hb_component__pll_switcher_hide_current',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'botiga_section_hb_component__pll_switcher_hide_current',
		array(
			'label'         	=> esc_html__( 'Hide current language', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__pll_switcher',
            'priority' 			=> 45
		)
	)
);