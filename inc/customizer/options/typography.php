<?php
/**
 * Typography Customizer options
 *
 * @package Botiga
 */
/**
 * Typography
 */
$wp_customize->add_panel(
	'botiga_panel_typography',
	array(
		'title'    => esc_html__( 'Typography', 'botiga' ),
		'priority' => 40,
		'description' => esc_html__( 'Manage the typography settings for different elements.', 'botiga' ),
	)
);

$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_global_text_styles',
	array(
		'title'    => esc_html__( 'Global Text Styles', 'botiga' ),
		'panel'    => 'botiga_panel_typography',
		'priority' => 21,
	)
) );

/**
 * General
 */
$wp_customize->add_section(
	'botiga_section_typography_general',
	array(
		'panel'      => 'botiga_panel_typography',
		'title'      => esc_html__( 'Fonts Library', 'botiga'),
	)
);

$wp_customize->add_setting( 
	'fonts_library', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default'           => 'google',
	) 
);
$wp_customize->add_control( 
	'fonts_library', 
	array(
		'type'     => 'select',
		'section'  => 'botiga_section_typography_general',
		'label'    => esc_html__( 'Fonts Library', 'botiga' ),
		'choices'  => array(
			'google' => esc_html__( 'Google Fonts', 'botiga' ),
		),
	) 
);

/**
 * Header Menu
 */
$wp_customize->add_section(
	'botiga_section_typography_header_menu',
	array(
		'title'      => esc_html__( 'Header Menu', 'botiga'),
		'panel'      => 'botiga_panel_typography',
	)
);

// Header Menu Typography Preview
$wp_customize->add_setting( 
	'botiga_header_menu_typography_preview',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( new Botiga_Typography_Preview_Control( $wp_customize, 'botiga_header_menu_typography_preview',
	array(
		'section' => 'botiga_section_typography_header_menu',
		'options' => array(
			'google_font'     => 'botiga_header_menu_font',
			'adobe_font'      => 'botiga_header_menu_adobe_font',
			'custom_font'     => 'botiga_header_menu_custom_font',
			'font-style'      => 'header_menu_font_style',
			'line-height'     => 'header_menu_line_height',
			'letter-spacing'  => 'header_menu_letter_spacing',
			'text-transform'  => 'header_menu_text_transform',
			'text-decoration' => 'header_menu_text_decoration',
		),
	)
) );

$wp_customize->add_setting( 'botiga_header_menu_font',
	array(
		'default'           => get_theme_mod( 'botiga_body_font', '{"font":"System default","regularweight":"400","category":"sans-serif"}' ),
		'sanitize_callback' => 'botiga_google_fonts_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Control( $wp_customize, 'botiga_header_menu_font',
	array(
		'section' => 'botiga_section_typography_header_menu',
		'settings' => array(
			'family' => 'botiga_header_menu_font',
		),
		'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
		'active_callback' => 'botiga_font_library_google',
	)
) );

// Adobe Fonts
$wp_customize->add_setting( 'botiga_header_menu_adobe_font',
	array(
		'default'           => get_theme_mod( 'botiga_body_adobe_font', 'system-default|n4' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Adobe_Control( $wp_customize, 'botiga_header_menu_adobe_font',
	array(
		'section' => 'botiga_section_typography_header_menu',
		'active_callback' => 'botiga_font_library_adobe',
	)
) );

// Custom Fonts
$wp_customize->add_setting( 'botiga_header_menu_custom_font',
	array(
		'default'           => get_theme_mod( 'botiga_body_custom_font', '' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting( 'botiga_header_menu_custom_font_weight',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Custom_Control( $wp_customize, 'botiga_header_menu_custom_font_typography',
	array(
		'section' => 'botiga_section_typography_header_menu',
		'settings' => array(
			'font-family' => 'botiga_header_menu_custom_font',
			'font-weight' => 'botiga_header_menu_custom_font_weight',
		),
		'active_callback' => 'botiga_font_library_custom',
	)
) );

$wp_customize->add_setting( 'header_menu_font_style', array(
	'sanitize_callback' => 'botiga_sanitize_select',
	'default'           => get_theme_mod( 'body_font_style', 'normal' ),
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'header_menu_font_style', array(
	'type'      => 'select',
	'section'   => 'botiga_section_typography_header_menu',
	'label'     => esc_html__( 'Font style', 'botiga' ),
	'choices' => array(
		'normal'    => esc_html__( 'Normal', 'botiga' ),
		'italic'    => esc_html__( 'Italic', 'botiga' ),
		'oblique'   => esc_html__( 'Oblique', 'botiga' ),
	),
) );

$wp_customize->add_setting( 'header_menu_font_size_desktop', array(
	'default'           => get_theme_mod( 'body_font_size_desktop', 16 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'header_menu_font_size_tablet', array(
	'default'           => get_theme_mod( 'body_font_size_tablet', 16 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'header_menu_font_size_mobile', array(
	'default'           => get_theme_mod( 'body_font_size_mobile', 16 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'header_menu_font_size',
	array(
		'label'         => esc_html__( 'Font size', 'botiga' ),
		'section'       => 'botiga_section_typography_header_menu',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'header_menu_font_size_desktop',
			'size_tablet'       => 'header_menu_font_size_tablet',
			'size_mobile'       => 'header_menu_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 40,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'header_menu_line_height', array(
	'default'           => get_theme_mod( 'body_line_height', 1.68 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );            
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'header_menu_line_height',
	array(
		'label'         => esc_html__( 'Line height', 'botiga' ),
		'section'       => 'botiga_section_typography_header_menu',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'header_menu_line_height',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.01,
			'unit' => 'em',
		),
	)
) );

$wp_customize->add_setting( 'header_menu_letter_spacing', array(
	'default'           => get_theme_mod( 'body_letter_spacing', 0 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );            
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'header_menu_letter_spacing',
	array(
		'label'         => esc_html__( 'Letter spacing', 'botiga' ),
		'section'       => 'botiga_section_typography_header_menu',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'header_menu_letter_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 5,
			'step'  => 0.5,
		),
	)
) );

$wp_customize->add_setting( 'header_menu_text_transform', array(
	'default'           => get_theme_mod( 'body_text_transform', 'none' ),
  	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );

$wp_customize->add_setting( 'header_menu_text_decoration', array(
	'default'           => get_theme_mod( 'body_text_decoration', 'none' ),
  	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );

$wp_customize->add_control( new Botiga_Text_Style_Control( $wp_customize, 'header_menu_text',
    array(
    'section'  => 'botiga_section_typography_header_menu',
    'settings' => array(
        'transform'  => 'header_menu_text_transform',
        'decoration' => 'header_menu_text_decoration',
    ),
    )
) );

/**
 * Headings
 */
$wp_customize->add_section(
	'botiga_section_typography_headings',
	array(
		'title'      => esc_html__( 'Headings', 'botiga'),
		'panel'      => 'botiga_panel_typography',
	)
);

// Heading Typography Preview
$wp_customize->add_setting( 
	'botiga_headings_typography_preview',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( new Botiga_Typography_Preview_Control( $wp_customize, 'botiga_headings_typography_preview',
	array(
		'section' => 'botiga_section_typography_headings',
		'options' => array(
			'google_font'     => 'botiga_headings_font',
			'adobe_font'      => 'botiga_headings_adobe_font',
			'custom_font'     => 'botiga_headings_custom_font',
			'font-style'      => 'headings_font_style',
			'line-height'     => 'headings_line_height',
			'letter-spacing'  => 'headings_letter_spacing',
			'text-transform'  => 'headings_text_transform',
			'text-decoration' => 'headings_text_decoration',
		),
	)
) );

// Custom Fonts
$wp_customize->add_setting( 'botiga_headings_custom_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting( 'botiga_headings_custom_font_weight',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Custom_Control( $wp_customize, 'botiga_headings_custom_font_typography',
	array(
		'section' => 'botiga_section_typography_headings',
		'settings' => array(
			'font-family' => 'botiga_headings_custom_font',
			'font-weight' => 'botiga_headings_custom_font_weight',
		),
		'active_callback' => 'botiga_font_library_custom',
	)
) );

// Adobe Fonts
$wp_customize->add_setting( 'botiga_headings_adobe_font',
	array(
		'default'           => 'system-default|n4',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Adobe_Control( $wp_customize, 'botiga_headings_adobe_font',
	array(
		'section' => 'botiga_section_typography_headings',
		'active_callback' => 'botiga_font_library_adobe',
	)
) );

// Google Fonts
$wp_customize->add_setting( 'botiga_headings_font',
	array(
		'default'           => '{"font":"System default","regularweight":"700","category":"sans-serif"}',
		'sanitize_callback' => 'botiga_google_fonts_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Control( $wp_customize, 'botiga_headings_font',
	array(
		'section' => 'botiga_section_typography_headings',
		'settings' => array(
			'family' => 'botiga_headings_font',
		),
		'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
		'active_callback' => 'botiga_font_library_google',
	)
) );

$wp_customize->add_setting( 'headings_font_style', array(
	'sanitize_callback' => 'botiga_sanitize_select',
	'default'           => 'normal',
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'headings_font_style', array(
	'type'      => 'select',
	'section'   => 'botiga_section_typography_headings',
	'label'     => esc_html__( 'Font style', 'botiga' ),
	'choices' => array(
		'normal'    => esc_html__( 'Normal', 'botiga' ),
		'italic'    => esc_html__( 'Italic', 'botiga' ),
		'oblique'   => esc_html__( 'Oblique', 'botiga' ),
	),
) );

$wp_customize->add_setting( 'headings_line_height', array(
	'default'           => 1.2,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );            
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'headings_line_height',
	array(
		'label'         => esc_html__( 'Line height', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'headings_line_height',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.01,
			'unit' => 'em',
		),
	)
) );

$wp_customize->add_setting( 'headings_letter_spacing', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );            
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'headings_letter_spacing',
	array(
		'label'         => esc_html__( 'Letter spacing', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'headings_letter_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 5,
			'step'  => 0.5,
		),
	)
) );

$wp_customize->add_setting( 'headings_text_transform', array(
	'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );

$wp_customize->add_setting( 'headings_text_decoration', array(
	'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );

$wp_customize->add_control( new Botiga_Text_Style_Control( $wp_customize, 'headings_text',
    array(
    'section'  => 'botiga_section_typography_headings',
    'settings' => array(
        'transform'  => 'headings_text_transform',
        'decoration' => 'headings_text_decoration',
    ),
    )
) );

$wp_customize->add_setting( 'typography_divider_1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'typography_divider_1',
		array(
			'section'       => 'botiga_section_typography_headings',
		)
	)
);

$wp_customize->add_setting( 'h1_font_size_desktop', array(
	'default'           => 64,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h1_font_size_tablet', array(
	'default'           => 42,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h1_font_size_mobile', array(
	'default'           => 32,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'h1_font_size',
	array(
		'label'         => esc_html__( 'Heading 1', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h1_font_size_desktop',
			'size_tablet'       => 'h1_font_size_tablet',
			'size_mobile'       => 'h1_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h2_font_size_desktop', array(
	'default'           => 48,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h2_font_size_tablet', array(
	'default'           => 32,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h2_font_size_mobile', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'h2_font_size',
	array(
		'label'         => esc_html__( 'Heading 2', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h2_font_size_desktop',
			'size_tablet'       => 'h2_font_size_tablet',
			'size_mobile'       => 'h2_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h3_font_size_desktop', array(
	'default'           => 32,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h3_font_size_tablet', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h3_font_size_mobile', array(
	'default'           => 20,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'h3_font_size',
	array(
		'label'         => esc_html__( 'Heading 3', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h3_font_size_desktop',
			'size_tablet'       => 'h3_font_size_tablet',
			'size_mobile'       => 'h3_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h4_font_size_desktop', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h4_font_size_tablet', array(
	'default'           => 18,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h4_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'h4_font_size',
	array(
		'label'         => esc_html__( 'Heading 4', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h4_font_size_desktop',
			'size_tablet'       => 'h4_font_size_tablet',
			'size_mobile'       => 'h4_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h5_font_size_desktop', array(
	'default'           => 18,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h5_font_size_tablet', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h5_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'h5_font_size',
	array(
		'label'         => esc_html__( 'Heading 5', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h5_font_size_desktop',
			'size_tablet'       => 'h5_font_size_tablet',
			'size_mobile'       => 'h5_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h6_font_size_desktop', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h6_font_size_tablet', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h6_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'h6_font_size',
	array(
		'label'         => esc_html__( 'Heading 6', 'botiga' ),
		'section'       => 'botiga_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h6_font_size_desktop',
			'size_tablet'       => 'h6_font_size_tablet',
			'size_mobile'       => 'h6_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

/**
 * Body
 */
$wp_customize->add_section(
	'botiga_section_typography_body',
	array(
		'title'      => esc_html__( 'Paragraphs', 'botiga'),
		'panel'      => 'botiga_panel_typography',
	)
);

// Body Typography Preview
$wp_customize->add_setting( 
	'botiga_body_typography_preview',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( new Botiga_Typography_Preview_Control( $wp_customize, 'botiga_body_typography_preview',
	array(
		'section' => 'botiga_section_typography_body',
		'options' => array(
			'google_font'     => 'botiga_body_font',
			'adobe_font'      => 'botiga_body_adobe_font',
			'custom_font'     => 'botiga_body_custom_font',
			'font-style'      => 'body_font_style',
			'line-height'     => 'body_line_height',
			'letter-spacing'  => 'body_letter_spacing',
			'text-transform'  => 'body_text_transform',
			'text-decoration' => 'body_text_decoration',
		),
	)
) );

$wp_customize->add_setting( 'botiga_body_font',
	array(
		'default'           => '{"font":"System default","regularweight":"400","category":"sans-serif"}',
		'sanitize_callback' => 'botiga_google_fonts_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Control( $wp_customize, 'botiga_body_font',
	array(
		'section' => 'botiga_section_typography_body',
		'settings' => array(
			'family' => 'botiga_body_font',
		),
		'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
		'active_callback' => 'botiga_font_library_google',
	)
) );

// Custom Fonts
$wp_customize->add_setting( 'botiga_body_custom_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting( 'botiga_body_custom_font_weight',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Custom_Control( $wp_customize, 'botiga_body_custom_font_typography',
	array(
		'section' => 'botiga_section_typography_body',
		'settings' => array(
			'font-family' => 'botiga_body_custom_font',
			'font-weight' => 'botiga_body_custom_font_weight',
		),
		'active_callback' => 'botiga_font_library_custom',
	)
) );

// Adobe Fonts
$wp_customize->add_setting( 'botiga_body_adobe_font',
	array(
		'default'           => 'system-default|n4',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Botiga_Typography_Adobe_Control( $wp_customize, 'botiga_body_adobe_font',
	array(
		'section' => 'botiga_section_typography_body',
		'active_callback' => 'botiga_font_library_adobe',
	)
) );

$wp_customize->add_setting( 'body_font_style', array(
	'sanitize_callback' => 'botiga_sanitize_select',
	'default'           => 'normal',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'body_font_style', array(
	'type'      => 'select',
	'section'   => 'botiga_section_typography_body',
	'label'     => esc_html__( 'Font style', 'botiga' ),
	'choices' => array(
		'normal'    => esc_html__( 'Normal', 'botiga' ),
		'italic'    => esc_html__( 'Italic', 'botiga' ),
		'oblique'   => esc_html__( 'Oblique', 'botiga' ),
	),
) );

$wp_customize->add_setting( 'body_font_size_desktop', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'body_font_size_tablet', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'body_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'body_font_size',
	array(
		'label'         => esc_html__( 'Font Size', 'botiga' ),
		'section'       => 'botiga_section_typography_body',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'body_font_size_desktop',
			'size_tablet'       => 'body_font_size_tablet',
			'size_mobile'       => 'body_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 40,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'body_line_height', array(
	'default'           => 1.68,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );            

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'body_line_height',
	array(
		'label'         => esc_html__( 'Line height', 'botiga' ),
		'section'       => 'botiga_section_typography_body',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'body_line_height',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.01,
			'unit' => 'em',
		),
	)
) );

$wp_customize->add_setting( 'body_letter_spacing', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );            

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'body_letter_spacing',
	array(
		'label'         => esc_html__( 'Letter spacing', 'botiga' ),
		'section'       => 'botiga_section_typography_body',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'body_letter_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 5,
			'step'  => 0.5,
		),
	)
) );

$wp_customize->add_setting( 'body_text_transform', array(
    'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );

$wp_customize->add_setting( 'body_text_decoration', array(
    'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'botiga_sanitize_text',
) );

$wp_customize->add_control( new Botiga_Text_Style_Control( $wp_customize, 'body_text',
    array(
    'section'  => 'botiga_section_typography_body',
    'settings' => array(
        'transform'  => 'body_text_transform',
        'decoration' => 'body_text_decoration',
    ),
    )
) );