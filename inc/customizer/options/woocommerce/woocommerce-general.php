<?php
/**
 * Woocommerce General Customizer options
 *
 * @package Botiga
 */

// Section
$wp_customize->add_section(
	'botiga_section_catalog_general',
	array(
		'title'       => esc_html__( 'General', 'botiga'),
		'description' => esc_html__( 'General WooCommerce and theme settings.', 'botiga' ),
		'priority'    => 95,
	)
); 
$wp_customize->get_control( 'woocommerce_shop_page_display' )->section  = 'botiga_section_catalog_general';
$wp_customize->get_control( 'woocommerce_category_archive_display' )->section  = 'botiga_section_catalog_general';
$wp_customize->get_control( 'woocommerce_default_catalog_orderby' )->section  = 'botiga_section_catalog_general';

// Divider
$wp_customize->add_setting( 
	'shop_general_pro_divider1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( 
	new Botiga_Divider_Control( 
		$wp_customize, 
		'shop_general_pro_divider1',
		array(
			'section'         => 'botiga_section_catalog_general',
			'priority'        => 21,
		)
	)
);

// Quantity Input Styles
$wp_customize->add_setting(
	'shop_general_quantity_style',
	array(
		'default'           => 'style1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_general_quantity_style',
		array(
			'label'     => esc_html__( 'Quantity Input Style', 'botiga' ),
			'section'   => 'botiga_section_catalog_general',
			'cols'      => 3,
			'class'     => 'botiga-radio-images-medium',
			'choices'  => array(
				'style1' => array(
					'label' => esc_html__( 'Style 1', 'botiga' ),
					'url'   => '%s/assets/img/qty1.svg',
				),
				'style2' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 2', 'botiga' ),
					'url'    => '%s/assets/img/qty2.svg',
				),
				'style3' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 3', 'botiga' ),
					'url'    => '%s/assets/img/qty3.svg',
				),
				'style4' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 4', 'botiga' ),
					'url'    => '%s/assets/img/qty4.svg',
				),
				'style5' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 5', 'botiga' ),
					'url'    => '%s/assets/img/qty5.svg',
				),
				'style6' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 6', 'botiga' ),
					'url'    => '%s/assets/img/qty6.svg',
				),
				'style7' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 7', 'botiga' ),
					'url'    => '%s/assets/img/qty7.svg',
				),
				'style8' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 8', 'botiga' ),
					'url'    => '%s/assets/img/qty8.svg',
				),
				'style9' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Style 9', 'botiga' ),
					'url'    => '%s/assets/img/qty9.svg',
				),
			),
			'priority'   => 22,
		)
	)
);