<?php
/**
 * Woocommerce Store Notice Customizer options
 *
 * @package Botiga
 */

// Store notice tabs
$wp_customize->add_setting(
	'shop_store_notice_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'shop_store_notice_tabs',
		array(
			'label'            => '',
			'section'          => 'woocommerce_store_notice',
			'controls_general' => wp_json_encode( array( 
				'#customize-control-woocommerce_demo_store_notice',
				'#customize-control-woocommerce_demo_store',
			) ),
			'controls_design'  => wp_json_encode( array( 
				'#customize-control-shop_store_notice_background_color',
				'#customize-control-shop_store_notice_text_color',
				'#customize-control-shop_store_notice_link_color',
				'#customize-control-shop_store_notice_wrapper_padding',
			) ),
			'priority'         =>   -10,
		)
	)
);

// Move 'Enable store notice' checkbox to before the store notice
$wp_customize->get_control( 'woocommerce_demo_store' )->priority = 9;

// Store notice background color
$wp_customize->add_setting(
	'shop_store_notice_background_color',
	array(
		'default'           => '#3d9cd2',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'shop_store_notice_background_color',
		array(
			'label'             => esc_html__( 'Background color', 'botiga' ),
			'section'           => 'woocommerce_store_notice',
			'priority'          => 50,
		)
	)
);

// Store notice text color
$wp_customize->add_setting(
	'shop_store_notice_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'shop_store_notice_text_color',
		array(
			'label'             => esc_html__( 'Text color', 'botiga' ),
			'section'           => 'woocommerce_store_notice',
			'priority'          => 52,
		)
	)
);

// Store notice link color
$wp_customize->add_setting(
	'shop_store_notice_link_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'shop_store_notice_link_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'shop_store_notice_link_color',
        array(
            'label'    => esc_html__( 'Link Color', 'botiga' ),
            'section'  => 'woocommerce_store_notice',
            'settings' => array(
                'normal' => 'shop_store_notice_link_color',
                'hover'  => 'shop_store_notice_link_color_hover',
            ),
            'priority' => 54,
        )
    )
);

// Store notice padding
$wp_customize->add_setting( 
    'shop_store_notice_wrapper_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'shop_store_notice_wrapper_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'shop_store_notice_wrapper_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'shop_store_notice_wrapper_padding',
        array(
            'label'             => __( 'Wrapper Padding', 'botiga' ),
            'section'           => 'woocommerce_store_notice',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true,
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'      => true,
            'settings'           => array(
                'desktop' => 'shop_store_notice_wrapper_padding_desktop',
                'tablet'  => 'shop_store_notice_wrapper_padding_tablet',
                'mobile'  => 'shop_store_notice_wrapper_padding_mobile',
            ),
            'priority'           => 56,
        )
    )
);