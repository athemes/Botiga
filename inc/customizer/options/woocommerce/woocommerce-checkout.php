<?php
/**
 * Woocommerce Checkout Customizer options
 *
 * @package Botiga
 */

if ( botiga_is_checkout_block_layout() ) {
	$wp_customize->add_setting(
		'shop_checkout_layout_edit_block_settings',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Botiga_Text_Control(
			$wp_customize,
			'shop_checkout_layout_edit_block_settings',
			array(
				'label'     => esc_html__( 'Layout', 'botiga' ),
				'description' => '<a class="botiga-to-widget-area-link" href="' . esc_url( get_admin_url() . 'post.php?post=' . wc_get_page_id( 'checkout' ) . '&action=edit' ) . '" target="_blank">' . esc_html__( 'Edit checkout layout', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
				'section' => 'woocommerce_checkout',
				'priority' => 1,
			)
		)
	);

	$wp_customize->remove_control( 'woocommerce_checkout_company_field' );
	$wp_customize->remove_control( 'woocommerce_checkout_address_2_field' );
	$wp_customize->remove_control( 'woocommerce_checkout_phone_field' );
	$wp_customize->remove_control( 'woocommerce_checkout_highlight_required_fields' );
	$wp_customize->remove_control( 'wp_page_for_privacy_policy' );
	$wp_customize->remove_control( 'woocommerce_terms_page_id' );
	$wp_customize->remove_control( 'woocommerce_checkout_privacy_policy_text' );

	// Woo 8.3+ checkout/cart info
	$wp_customize->add_setting( 
		'woocommerce_checkout_incompat_info',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( 
		new Botiga_Text_Control( 
			$wp_customize, 
			'woocommerce_checkout_incompat_info',
			array(
				'label'           => '',
				'description'     => esc_html__( 'Your checkout page is being rendered through the new WooCommerce 8.3.0 checkout block. To have all Botiga checkout features working, you must edit the checkout page to use the classic checkout shortcode instead.', 'botiga' ),
				'link_title'        => esc_html__( 'Learn More', 'botiga' ),
				'link'              => 'https://docs.athemes.com/article/how-to-switch-cart-checkout-blocks-to-the-classic-shortcodes/',
				'check_white_label' => false,
				'section'         => 'woocommerce_checkout',
				'priority'        => 20,
			)
		)
	);
} else {
	// Checkout
	$wp_customize->add_setting(
		'shop_checkout_layout',
		array(
			'default'           => 'layout1',
			'sanitize_callback' => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new Botiga_Radio_Images(
			$wp_customize,
			'shop_checkout_layout',
			array(
				'label'     => esc_html__( 'Layout', 'botiga' ),
				'section'   => 'woocommerce_checkout',
				'cols'      => 2,
				'choices'  => array(
					'layout1' => array(
						'label' => esc_html__( 'Layout 1', 'botiga' ),
						'url'   => '%s/assets/img/checkout1.svg',
					),
					'layout2' => array(
						'label' => esc_html__( 'Layout 2', 'botiga' ),
						'url'   => '%s/assets/img/checkout2.svg',
					),
					'layout3' => array(
						'is_pro' => true,
						'label'  => esc_html__( 'Layout 3 (Multi Step)', 'botiga' ),
						'url'    => '%s/assets/img/checkout3.svg',
					),
					'layout4' => array(
						'is_pro' => true,
						'label'  => esc_html__( 'Layout 4 (Shopify Style)', 'botiga' ),
						'url'    => '%s/assets/img/checkout4.svg',
					),
					'layout5' => array(
						'is_pro' => true,
						'label'  => esc_html__( 'Layout 5 (One Step)', 'botiga' ),
						'url'    => '%s/assets/img/checkout5.svg',
					),
				),
				'priority'   => 1,
			)
		)
	); 
	$wp_customize->add_setting(
		'shop_checkout_show_coupon_form',
		array(
			'default'           => 1,
			'sanitize_callback' => 'botiga_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Botiga_Toggle_Control(
			$wp_customize,
			'shop_checkout_show_coupon_form',
			array(
				'label'             => esc_html__( 'Display Coupon Form', 'botiga' ),
				'section'           => 'woocommerce_checkout',
				'priority'          => 2,
			)
		)
	);
}
