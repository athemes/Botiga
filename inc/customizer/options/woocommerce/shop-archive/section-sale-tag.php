<?php
/**
 * Shop Archive - Section Sale Tag Customizer Settings
 *
 * @package Botiga
 */

// Layout
$wp_customize->add_setting(
	'shop_product_sale_tag_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_product_sale_tag_layout',
		array(
			'label'     => esc_html__( 'Layout', 'botiga' ),
			'section'   => 'botiga_section_shop_archive_sale_tag',
			'cols'      => 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/sale1.svg',
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/sale2.svg',
				),                                          
			),
			'priority'   => 180,
		)
	)
);

// Spacing
$wp_customize->add_setting( 'shop_sale_tag_spacing', array(
	'default'           => 20,
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_sale_tag_spacing',
	array(
		'label'         => esc_html__( 'Spacing', 'botiga' ),
		'section'       => 'botiga_section_shop_archive_sale_tag',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'shop_sale_tag_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'priority'   => 190,
	)
) );

// Border Radius
$wp_customize->add_setting( 'shop_sale_tag_radius', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_sale_tag_radius',
	array(
		'label'         => esc_html__( 'Border radius', 'botiga' ),
		'section'       => 'botiga_section_shop_archive_sale_tag',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'shop_sale_tag_radius',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'priority'   => 200,
	)
) );

// Badge Text
$wp_customize->add_setting(
	'sale_badge_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( 'Sale!', 'botiga' ),
	)       
);
$wp_customize->add_control( 'sale_badge_text', array(
	'label'       => esc_html__( 'Badge text', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_shop_archive_sale_tag',
	'priority'    => 210,
) );

// Display Sale Percentage
$wp_customize->add_setting(
	'sale_badge_percent',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'sale_badge_percent',
		array(
			'label'             => esc_html__( 'Display sale percentage', 'botiga' ),
			'section'           => 'botiga_section_shop_archive_sale_tag',
			'priority'          => 220,
		)
	)
);

// Sale Percentage Text
$wp_customize->add_setting(
	'sale_percentage_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => '-{value}%',
	)       
);
$wp_customize->add_control( 'sale_percentage_text', array(
	'label'             => esc_html__( 'Sale percentage text', 'botiga' ),
	'description'       => wp_kses_post( __( 'You may use the {value} tag. E.g. <strong>{value}% OFF!</strong>', 'botiga' ) ),
	'type'              => 'text',
	'section'           => 'botiga_section_shop_archive_sale_tag',
	'active_callback'   => 'botiga_callback_sale_percentage',
	'priority'          => 230,
) );

/**
 * Styling
 * 
 */

// Background Color
$wp_customize->add_setting(
	'single_product_sale_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'single_product_sale_background_color',
		array(
			'label'             => esc_html__( 'Background color', 'botiga' ),
			'section'           => 'botiga_section_shop_archive_sale_tag',
			'priority'          => 380,
		)
	)
);

// Color
$wp_customize->add_setting(
	'single_product_sale_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'single_product_sale_color',
		array(
			'label'             => esc_html__( 'Color', 'botiga' ),
			'section'           => 'botiga_section_shop_archive_sale_tag',
			'priority'          => 390,
		)
	)
);