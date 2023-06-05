<?php
/**
 * Woocommerce Cart Customizer options
 *
 * @package Botiga
 */

// Section
$wp_customize->add_section(
	'botiga_section_shop_cart',
	array(
		'title'       => esc_html__( 'Cart', 'botiga'),
		'description' => esc_html__( 'Manage the overall design and functionality from the shop cart page.', 'botiga' ),
		'priority'    => 120
	)
);

// Cart Layout
$wp_customize->add_setting(
	'shop_cart_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_cart_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'botiga_section_shop_cart',
			'cols'		=> 2,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/cart1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/cart2.svg'
				),		
			),
			'priority'	 => 20
		)
	)
);

// Cross Sell
$wp_customize->add_setting(
	'shop_cart_show_cross_sell',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_cart_show_cross_sell',
		array(
			'label'         	=> esc_html__( 'Cross Sell', 'botiga' ),
			'section'       	=> 'botiga_section_shop_cart',
			'priority'	 		=> 40
		)
	)
);

// Display Coupon Form
$wp_customize->add_setting(
	'shop_cart_show_coupon_form',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_cart_show_coupon_form',
		array(
			'label'         	=> esc_html__( 'Display Coupon Form', 'botiga' ),
			'section'       	=> 'botiga_section_shop_cart',
			'priority'	 		=> 41
		)
	)
);

// Divider
$wp_customize->add_setting( 'shop_cart_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'shop_cart_divider_1',
		array(
			'section' 			=> 'botiga_section_shop_cart',
			'priority'	 		=> 50
		)
	)
);

// Mini Cart Title
$wp_customize->add_setting( 'mini_cart_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'mini_cart_title',
		array(
			'label'			=> esc_html__( 'Mini Cart', 'botiga' ),
			'section' 		=> 'botiga_section_shop_cart',
			'priority'	 	=> 60
		)
	)
);

// Mini Cart Style
$wp_customize->add_setting(
	'mini_cart_style',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'mini_cart_style',
		array(
			'label'     => esc_html__( 'Mini Cart Style', 'botiga' ),
			'section'   => 'botiga_section_shop_cart',
			'cols'      => 2,
			'choices'  => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'botiga' ),
					'url'   => '%s/assets/img/mini-cart-style1.svg'
				),
				'side' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Side', 'botiga' ),
					'url'    => '%s/assets/img/mini-cart-style2.svg'
				),      
			),
			'priority'   => 61
		)
	)
);

// Mini Car Cross Sell
$wp_customize->add_setting(
	'enable_mini_cart_cross_sell',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_mini_cart_cross_sell',
		array(
			'label'         	=> esc_html__( 'Mini Cart Cross Sell', 'botiga' ),
			'section'       	=> 'botiga_section_shop_cart',
			'active_callback' 	=> 'botiga_callback_header_show_minicart',
			'priority'			=> 70
		)
	)
);