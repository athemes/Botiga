<?php
/**
 * Buttons Customizer options
 *
 * @package Botiga
 */

/**
 * Buttons
 */
$wp_customize->add_section(
	'botiga_section_buttons',
	array(
		'title'    => esc_html__( 'Buttons', 'botiga'),
		'priority' => 31,
	)
);

$wp_customize->add_setting( 'button_top_bottom_padding_desktop', array(
	'default'   		=> 13,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'button_top_bottom_padding_tablet', array(
	'default'   		=> 13,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'button_top_bottom_padding_mobile', array(
	'default'   		=> 13,
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_top_bottom_padding',
	array(
		'label' 		=> esc_html__( 'Top/Bottom padding', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_top_bottom_padding_desktop',
			'size_tablet' 		=> 'button_top_bottom_padding_tablet',
			'size_mobile' 		=> 'button_top_bottom_padding_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50
		)		
	)
) );

$wp_customize->add_setting( 'button_left_right_padding_desktop', array(
	'default'   		=> 24,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'button_left_right_padding_tablet', array(
	'default'   		=> 24,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'button_left_right_padding_mobile', array(
	'default'   		=> 24,
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_left_right_padding',
	array(
		'label' 		=> esc_html__( 'Left/Right padding', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_left_right_padding_desktop',
			'size_tablet' 		=> 'button_left_right_padding_tablet',
			'size_mobile' 		=> 'button_left_right_padding_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50
		)		
	)
) );


$wp_customize->add_setting( 'button_border_radius', array(
	'default'   		=> 0,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_border_radius',
	array(
		'label' 		=> esc_html__( 'Button radius', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_border_radius',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
	)
) );

$wp_customize->add_setting( 'buttons_divider_0',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'buttons_divider_0',
		array(
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'button_font_size_desktop', array(
	'default'   		=> 14,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'button_font_size_tablet', array(
	'default'   		=> 14,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'button_font_size_mobile', array(
	'default'   		=> 14,
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_font_size',
	array(
		'label' 		=> esc_html__( 'Font size', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_font_size_desktop',
			'size_tablet' 		=> 'button_font_size_tablet',
			'size_mobile' 		=> 'button_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50
		)		
	)
) );

$wp_customize->add_setting( 'button_text_transform',
	array(
		'default' 			=> 'uppercase',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'button_text_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'botiga' ),
		'section' => 'botiga_section_buttons',
		'choices' => array(
			'none' 			=> '-',
			'capitalize' 	=> 'Aa',
			'lowercase' 	=> 'aa',
			'uppercase' 	=> 'AA',
		)
	)
) );

$wp_customize->add_setting( 'buttons_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'buttons_divider_1',
		array(
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'buttons_default_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'buttons_default_state_title',
		array(
			'label'			=> esc_html__( 'Default state', 'botiga' ),
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_border_color',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'buttons_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'buttons_divider_2',
		array(
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'buttons_hover_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'buttons_hover_state_title',
		array(
			'label'			=> esc_html__( 'Hover state', 'botiga' ),
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_background_color_hover',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_color_hover',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_border_color_hover',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);
