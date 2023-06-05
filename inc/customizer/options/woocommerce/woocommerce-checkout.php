<?php
/**
 * Woocommerce Checkout Customizer options
 *
 * @package Botiga
 */

//Checkout
$wp_customize->add_setting(
	'shop_checkout_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key'
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_checkout_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'woocommerce_checkout',
			'cols'		=> 2,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/checkout1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/checkout2.svg'
				),
				'layout3' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Layout 3 (Multi Step)', 'botiga' ),
					'url'    => '%s/assets/img/checkout3.svg'
				),
				'layout4' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Layout 4 (Shopify Style)', 'botiga' ),
					'url'    => '%s/assets/img/checkout4.svg'
				),
				'layout5' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Layout 5 (One Step)', 'botiga' ),
					'url'    => '%s/assets/img/checkout5.svg'
				)
			),
			'priority'	 => 1
		)
	)
); 
$wp_customize->add_setting(
	'shop_checkout_show_coupon_form',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox'
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_checkout_show_coupon_form',
		array(
			'label'         	=> esc_html__( 'Display Coupon Form', 'botiga' ),
			'section'       	=> 'woocommerce_checkout',
			'priority'	 		=> 2
		)
	)
);