<?php
/**
 * Shop Archive - Section Categories Customizer Settings
 *
 * @package Botiga
 */

// Layout
$wp_customize->add_setting(
	'shop_categories_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_categories_layout',
		array(
			'label'     => esc_html__( 'Layout', 'botiga' ),
			'section'   => 'botiga_section_shop_archive_categories',
			'cols'      => 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/pcat1.svg',
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/pcat2.svg',
				),      
				'layout3' => array(
					'label' => esc_html__( 'Layout 3', 'botiga' ),
					'url'   => '%s/assets/img/pcat3.svg',
				),          
				'layout4' => array(
					'label' => esc_html__( 'Layout 4', 'botiga' ),
					'url'   => '%s/assets/img/pcat4.svg',
				),                  
				'layout5' => array(
					'label' => esc_html__( 'Layout 5', 'botiga' ),
					'url'   => '%s/assets/img/pcat5.svg',
				),                  
			),
			'priority'   => 250,
		)
	)
);

// Aligment
$wp_customize->add_setting( 'shop_categories_alignment',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'shop_categories_alignment',
	array(
		'label'   => esc_html__( 'Text alignment', 'botiga' ),
		'section' => 'botiga_section_shop_archive_categories',
		'choices' => array(
			'left'      => '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
			'center'    => '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
			'right'     => '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>',
		),
		'priority'   => 260,
	)
) );

// Radius
$wp_customize->add_setting( 'shop_categories_radius', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_categories_radius',
	array(
		'label'         => esc_html__( 'Border radius', 'botiga' ),
		'section'       => 'botiga_section_shop_archive_categories',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'shop_categories_radius',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'priority'   => 270,
	)
) );