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
		'title'       => esc_html__('Buttons', 'botiga'),
		'description' => esc_html__( 'Vary your button styles to highlight different calls-to-action.', 'botiga' ),
		'priority'    => 70,
	)
);

// Tabs
$wp_customize->add_setting(
	'button_archive_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control(
		$wp_customize,
		'button_archive_tabs',
		array(
			'label'   => '',
			'section' => 'botiga_section_buttons',
			'controls_general' => wp_json_encode(array(
				'#customize-control-button_font_style',
				'#customize-control-button_adobe_font',
				'#customize-control-button_font',
				'#customize-control-button_font_size',
				'#customize-control-button_letter_spacing',
				'#customize-control-button_text',
				'#customize-control-buttons_divider_0',
				'#customize-control-button_top_bottom_padding',
				'#customize-control-button_left_right_padding',
				'#customize-control-button_border_radius',
			)),
			'controls_design'  => wp_json_encode(array(
				'#customize-control-button_background',
				'#customize-control-button',
				'#customize-control-button_border',
			)),
		)
	)
);

$wp_customize->add_setting(
	'button_font_style',
	array(
		'default'           => 'body',
		'sanitize_callback' => 'botiga_sanitize_select',
	)
);
$wp_customize->add_control(
	'button_font_style',
	array(
		'type'      => 'select',
		'section'   => 'botiga_section_buttons',
		'label'     => esc_html__('Style', 'botiga'),
		'choices'   => array(
			'body'    => esc_html__('Body', 'botiga'),
			'heading' => esc_html__('Heading', 'botiga'),
			'custom'  => esc_html__('Custom', 'botiga'),
		),
	)
);

// Custom Typography
$wp_customize->add_setting(
	'button_custom_font',
	array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_setting( 'button_custom_font_weight',
	array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(new Botiga_Typography_Custom_Control(
	$wp_customize,
	'button_custom_font_typography',
	array(
		'section'         => 'botiga_section_buttons',
		'settings'        => array(
			'font-family'   => 'button_custom_font',
			'font-weight'   => 'button_custom_font_weight',
		),
		'active_callback' => 'botiga_button_font_library_custom_and_custom_style',
	)
));

// Adobe Typography
$wp_customize->add_setting(
	'button_adobe_font',
	array(
		'default'           => 'system-default|n4',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control(new Botiga_Typography_Adobe_Control(
	$wp_customize,
	'button_adobe_font',
	array(
		'section'         => 'botiga_section_buttons',
		'active_callback' => 'botiga_button_font_library_adobe_and_custom_style',
	)
));

// Google Typography
$wp_customize->add_setting(
	'button_font',
	array(
		'default'           => '{"font":"System default","regularweight":"400","category":"sans-serif"}',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'botiga_google_fonts_sanitize',
	)
);
$wp_customize->add_control(new Botiga_Typography_Control(
	$wp_customize,
	'button_font',
	array(
		'section'  => 'botiga_section_buttons',
		'settings' => array(
			'family' => 'button_font',
		),
		'input_attrs' => array(
			'font_count'     => 'all',
			'orderby'        => 'alpha',
			'disableRegular' => false,
		),
		'active_callback' => 'botiga_button_font_library_google_and_custom_style',
	)
));

// Button Font Size
$wp_customize->add_setting('button_font_size_desktop', array(
	'default'           => 14,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('button_font_size_tablet', array(
	'default'           => 14,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('button_font_size_mobile', array(
	'default'           => 14,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Botiga_Responsive_Slider(
	$wp_customize,
	'button_font_size',
	array(
		'label'         => esc_html__('Size', 'botiga'),
		'section'       => 'botiga_section_buttons',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop' => 'button_font_size_desktop',
			'size_tablet'  => 'button_font_size_tablet',
			'size_mobile'  => 'button_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 50,
		),
	)
));

// Button Letter Spacing
$wp_customize->add_setting('button_letter_spacing', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
));
$wp_customize->add_control(new Botiga_Responsive_Slider(
	$wp_customize,
	'button_letter_spacing',
	array(
		'label'         => esc_html__('Letter spacing', 'botiga'),
		'section'       => 'botiga_section_buttons',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop' => 'button_letter_spacing',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.5,
		),
	)
));

// Button Transform and Decoration
$wp_customize->add_setting('button_text_transform', array(
	'default'           => 'uppercase',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
));

$wp_customize->add_setting('button_text_decoration', array(
	'default'           => 'none',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
));

$wp_customize->add_control(new Botiga_Text_Style_Control(
	$wp_customize,
	'button_text',
	array(
		'section'  => 'botiga_section_buttons',
		'settings' => array(
			'transform'  => 'button_text_transform',
			'decoration' => 'button_text_decoration',
		),
	)
));

// Divider
$wp_customize->add_setting( 
	'buttons_divider_0',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Botiga_Divider_Control(
		$wp_customize,
		'buttons_divider_0',
		array(
			'section' => 'botiga_section_buttons',
		)
	)
);

// Button Top and Bottom Padding
$wp_customize->add_setting('button_top_bottom_padding_desktop', array(
	'default'           => 13,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('button_top_bottom_padding_tablet', array(
	'default'           => 13,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('button_top_bottom_padding_mobile', array(
	'default'           => 13,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Botiga_Responsive_Slider(
	$wp_customize,
	'button_top_bottom_padding',
	array(
		'label'         => esc_html__('Top/Bottom padding', 'botiga'),
		'section'       => 'botiga_section_buttons',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'button_top_bottom_padding_desktop',
			'size_tablet'       => 'button_top_bottom_padding_tablet',
			'size_mobile'       => 'button_top_bottom_padding_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 50,
		),
	)
));

// Button Left and Right Padding
$wp_customize->add_setting('button_left_right_padding_desktop', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));
$wp_customize->add_setting('button_left_right_padding_tablet', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));
$wp_customize->add_setting('button_left_right_padding_mobile', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Botiga_Responsive_Slider(
	$wp_customize,
	'button_left_right_padding',
	array(
		'label'         => esc_html__('Left/Right padding', 'botiga'),
		'section'       => 'botiga_section_buttons',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'button_left_right_padding_desktop',
			'size_tablet'       => 'button_left_right_padding_tablet',
			'size_mobile'       => 'button_left_right_padding_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 50,
		),
	)
));

// Button Border Radius
$wp_customize->add_setting('button_border_radius', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Botiga_Responsive_Slider(
	$wp_customize,
	'button_border_radius',
	array(
		'label'         => esc_html__('Button radius', 'botiga'),
		'section'       => 'botiga_section_buttons',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'button_border_radius',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
	)
));

// Button Background Color
$wp_customize->add_setting(
	'button_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'button_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Color_Group(
		$wp_customize,
		'button_background',
		array(
			'label'    => esc_html__('Background Color', 'botiga'),
			'section'  => 'botiga_section_buttons',
			'settings' => array(
				'normal' => 'button_background_color',
				'hover'  => 'button_background_color_hover',
			),
		)
	)
);

// Button Text Color
$wp_customize->add_setting(
	'button_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'button_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Color_Group(
		$wp_customize,
		'button',
		array(
			'label'    => esc_html__('Text Color', 'botiga'),
			'section'  => 'botiga_section_buttons',
			'settings' => array(
				'normal' => 'button_color',
				'hover'  => 'button_color_hover',
			),
		)
	)
);

// Button Border Color
$wp_customize->add_setting(
	'button_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'button_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Color_Group(
		$wp_customize,
		'button_border',
		array(
			'label'    => esc_html__('Border Color', 'botiga'),
			'section'  => 'botiga_section_buttons',
			'settings' => array(
				'normal' => 'button_border_color',
				'hover'  => 'button_border_color_hover',
			),
		)
	)
);
