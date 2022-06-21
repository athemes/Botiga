<?php
/**
 * Performance Customizer Options
 *
 * @package Botiga
 */

$wp_customize->add_section(
    'botiga_section_performance',
    array(
        'title'      => esc_html__( 'Performance', 'botiga' ),
        'panel'      => '',
        'priority'   => 41
    )
);

$wp_customize->add_setting(
	'perf_google_fonts_local',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox'
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'perf_google_fonts_local',
		array(
			'label'         	=> esc_html__( 'Load Google Fonts Locally?', 'botiga' ),
			'section'       	=> 'botiga_section_performance',
			'priority' 			=> 10
		)
	)
);