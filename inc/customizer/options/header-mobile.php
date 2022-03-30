<?php
/**
 * Header Customizer options
 *
 * @package Botiga
 */

/**
 * Mobile Header
 */
$wp_customize->add_section(
	'botiga_section_mobile_header',
	array(
		'title'      => esc_html__( 'Mobile header', 'botiga'),
		'panel'      => 'botiga_panel_header',
	)
);

$wp_customize->add_setting(
	'botiga_mobile_header_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_mobile_header_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_mobile_header',
			'controls_general'		=> json_encode( array( '#customize-control-header_layout_mobile','#customize-control-header_components_mobile','#customize-control-mobile_header_cart_account_title','#customize-control-enable_mobile_header_cart','#customize-control-enable_mobile_header_account','#customize-control-mobile_header_divider_1','#customize-control-header_offcanvas_mode','#customize-control-header_components_offcanvas','#customize-control-mobile_header_offcanvas_cart_account_title','#customize-control-enable_mobile_header_offcanvas_cart','#customize-control-enable_mobile_header_offcanvas_account','#customize-control-mobile_header_divider_2','#customize-control-mobile_menu_alignment','#customize-control-mobile_menu_link_separator','#customize-control-mobile_menu_link_spacing','#customize-control-mobile_menu_elements_spacing','#customize-control-mobile_menu_icon', ) ),
			'controls_design'		=> json_encode( array( '#customize-control-mobile_header_bar_title','#customize-control-mobile_header_offcanvas_title','#customize-control-mobile_header_separator_title','#customize-control-mobile_header_background','#customize-control-mobile_header_color','#customize-control-mobile_header_padding','#customize-control-mobile_header_divider_3','#customize-control-offcanvas_menu_background','#customize-control-offcanvas_menu_color','#customize-control-mobile_header_divider_4','#customize-control-mobile_header_separator_width','#customize-control-link_separator_color', ) ),
		)
	)
);

//Layout
$botiga_choices = botiga_mobile_header_layouts();

$wp_customize->add_setting(
	'header_layout_mobile',
	array(
		'default'           => 'header_mobile_layout_1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'header_layout_mobile',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'botiga_section_mobile_header',
			'cols'		=> 2,
			'choices'  	=> $botiga_choices,
			'priority'  => 20
		)
	)
);

$botiga_header_components  = botiga_mobile_header_elements();
$botiga_default_components = botiga_get_default_header_components();

$wp_customize->add_setting( 'header_components_mobile', array(
	'default'  			=> $botiga_default_components['mobile'],
	'sanitize_callback'	=> 'botiga_sanitize_mobile_header_components'
) );
$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_mobile', array(
	'label'   			=> esc_html__( 'Additional elements', 'botiga' ),
	'section' 			=> 'botiga_section_mobile_header',
	'choices' 			=> $botiga_header_components,
	'priority'  		=> 30
) ) );

// Mobile Header Cart & Account Icons
$wp_customize->add_setting( 'mobile_header_cart_account_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'mobile_header_cart_account_title',
		array(
			'label'				=> esc_html__( 'Cart &amp; account icons', 'botiga' ),
			'section' 			=> 'botiga_section_mobile_header',
			'active_callback' 	=> function() { return botiga_callback_mobile_header_elements( 'mobile_woocommerce_icons' ); },
			'priority'  => 40
		)
	)
);

$wp_customize->add_setting(
	'enable_mobile_header_cart',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_mobile_header_cart',
		array(
			'label'         	=> esc_html__( 'Enable cart icon', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'active_callback' 	=> function() { return botiga_callback_mobile_header_elements( 'mobile_woocommerce_icons' ); },
			'priority'  		=> 50
		)
	)
);

$wp_customize->add_setting(
	'enable_mobile_header_account',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_mobile_header_account',
		array(
			'label'         	=> esc_html__( 'Enable account icon', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'active_callback' 	=> function() { return botiga_callback_mobile_header_elements( 'mobile_woocommerce_icons' ); },
			'priority'  		=> 60
		)
	)
);

$wp_customize->add_setting( 'mobile_header_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'mobile_header_divider_1',
		array(
			'section' 		=> 'botiga_section_mobile_header',
			'priority'  	=> 70
		)
	)
);

$wp_customize->add_setting(
	'header_offcanvas_mode',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'header_offcanvas_mode',
		array(
			'label'    	=> esc_html__( 'Offcanvas mode', 'botiga' ),
			'section'  	=> 'botiga_section_mobile_header',
			'cols'		=> 2,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/oc1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/oc2.svg'
				),	
			),
			'priority'  => 80
		)
	)
);

$botiga_header_components  = botiga_mobile_offcanvas_header_elements();

$wp_customize->add_setting( 'header_components_offcanvas', array(
	'default'  			=> $botiga_default_components['offcanvas'],
	'sanitize_callback'	=> 'botiga_sanitize_mobile_offcanvas_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_offcanvas', array(
	'label'   			=> esc_html__( 'Additional offcanvas elements', 'botiga' ),
	'section' 			=> 'botiga_section_mobile_header',
	'choices' 			=> $botiga_header_components,
	'priority'  		=> 90
) ) );

// Mobile Header Offcanvas Cart & Account Icons
$wp_customize->add_setting( 'mobile_header_offcanvas_cart_account_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'mobile_header_offcanvas_cart_account_title',
		array(
			'label'				=> esc_html__( 'Offcanvas Cart &amp; account icons', 'botiga' ),
			'section' 			=> 'botiga_section_mobile_header',
			'active_callback' 	=> function() { return botiga_callback_mobile_header_offcanvas_elements( 'mobile_offcanvas_woocommerce_icons' ); },
			'priority'  		=> 100
		)
	)
);

$wp_customize->add_setting(
	'enable_mobile_header_offcanvas_cart',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_mobile_header_offcanvas_cart',
		array(
			'label'         	=> esc_html__( 'Enable cart icon', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'active_callback' 	=> function() { return botiga_callback_mobile_header_offcanvas_elements( 'mobile_offcanvas_woocommerce_icons' ); },
			'priority'  		=> 110
		)
	)
);

$wp_customize->add_setting(
	'enable_mobile_header_offcanvas_account',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_mobile_header_offcanvas_account',
		array(
			'label'         	=> esc_html__( 'Enable account icon', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'active_callback' 	=> function() { return botiga_callback_mobile_header_offcanvas_elements( 'mobile_offcanvas_woocommerce_icons' ); },
			'priority'  		=> 120
		)
	)
);


$wp_customize->add_setting( 'mobile_header_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'mobile_header_divider_2',
		array(
			'section' 		=> 'botiga_section_mobile_header',
			'priority'  	=> 130
		)
	)
);

$wp_customize->add_setting( 'mobile_menu_alignment',
	array(
		'default' 			=> 'left',
		'sanitize_callback' => 'botiga_sanitize_text',
		'transport'			=> 'postMessage'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'mobile_menu_alignment',
	array(
		'label'   => esc_html__( 'Link alignment', 'botiga' ),
		'section' => 'botiga_section_mobile_header',
		'choices' => array(
			'left' 		=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
			'center' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
			'right' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>',
		),
		'priority'  => 140
	)
) );

$wp_customize->add_setting(
	'mobile_menu_link_separator',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'mobile_menu_link_separator',
		array(
			'label'         	=> esc_html__( 'Link separator', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'priority'  		=> 150
		)
	)
);

$wp_customize->add_setting( 'mobile_menu_link_spacing', array(
	'default'   		=> 20,
	'sanitize_callback' => 'absint',
	'transport'			=> 'postMessage'
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'mobile_menu_link_spacing',
	array(
		'label' 		=> esc_html__( 'Link spacing', 'botiga' ),
		'section' 		=> 'botiga_section_mobile_header',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'mobile_menu_link_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50,
			'step'  => 1
		),
		'priority'  => 160
	)
) );

$wp_customize->add_setting( 'mobile_menu_elements_spacing', array(
	'default'   		=> 20,
	'sanitize_callback' => 'absint',
	'transport'			=> 'postMessage'
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'mobile_menu_elements_spacing',
	array(
		'label' 		=> esc_html__( 'Elements spacing', 'botiga' ),
		'section' 		=> 'botiga_section_mobile_header',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'mobile_menu_elements_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200,
			'step'  => 1
		),
		'priority'  => 161
	)
) );

$wp_customize->add_setting( 'mobile_menu_icon',
	array(
		'default' 			=> 'mobile-icon2',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'mobile_menu_icon',
	array(
		'label'   => esc_html__( 'Menu icon', 'botiga' ),
		'section' => 'botiga_section_mobile_header',
		'choices' => array(
			'mobile-icon1' 	=> '<svg width="16" height="7" viewBox="0 0 16 7" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="16" height="1"/><rect y="6" width="16" height="1"/></svg>',
			'mobile-icon2' 	=> '<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="16" height="1"/><rect y="5" width="16" height="1"/><rect y="10" width="16" height="1"/></svg>',
			'mobile-icon3' 	=> '<svg width="16" height="11" viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="16" height="1"/><rect y="5" width="10" height="1"/><rect y="10" width="16" height="1"/></svg>',
			'mobile-icon4' 	=> '<svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg"><rect y="7" width="14" height="1"/><rect x="7.5" y="0.5" width="14" height="1" transform="rotate(90 7.5 0.5)"/></svg>',
		),
		'priority'  => 170
	)
) );

/**
 * Styling
 */
$wp_customize->add_setting( 'mobile_header_bar_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'mobile_header_bar_title',
		array(
			'label'			=> esc_html__( 'Menu bar', 'botiga' ),
			'section' 		=> 'botiga_section_mobile_header',
			'priority'  	=> 180
		)
	)
);
$wp_customize->add_setting(
	'mobile_header_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'mobile_header_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'priority'  		=> 190
		)
	)
);

$wp_customize->add_setting(
	'mobile_header_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'mobile_header_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'priority'  		=> 200
		)
	)
);

$wp_customize->add_setting( 'mobile_header_padding', array(
	'default'   		=> 15,
	'sanitize_callback' => 'absint',
	'transport'			=> 'postMessage'
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'mobile_header_padding',
	array(
		'label' 		=> esc_html__( 'Top&amp;bottom padding', 'botiga' ),
		'section' 		=> 'botiga_section_mobile_header',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'mobile_header_padding',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50,
			'step'  => 1
		),
		'priority'  => 210
	)
) );


$wp_customize->add_setting( 'mobile_header_divider_3',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'mobile_header_divider_3',
		array(
			'section' 		=> 'botiga_section_mobile_header',
			'priority'  	=> 220
		)
	)
);

$wp_customize->add_setting( 'mobile_header_offcanvas_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'mobile_header_offcanvas_title',
		array(
			'label'			=> esc_html__( 'Offcanvas menu', 'botiga' ),
			'section' 		=> 'botiga_section_mobile_header',
			'priority'  	=> 230
		)
	)
);

$wp_customize->add_setting(
	'offcanvas_menu_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'offcanvas_menu_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'priority'  		=> 240
		)
	)
);

$wp_customize->add_setting(
	'offcanvas_menu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'offcanvas_menu_color',
		array(
			'label'         	=> esc_html__( 'Color', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'priority'  		=> 250
		)
	)
);

$wp_customize->add_setting( 'mobile_header_divider_4',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'mobile_header_divider_4',
		array(
			'section' 		=> 'botiga_section_mobile_header',
			'priority'  	=> 260
		)
	)
);

$wp_customize->add_setting( 'mobile_header_separator_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'mobile_header_separator_title',
		array(
			'label'			=> esc_html__( 'Link separator', 'botiga' ),
			'section' 		=> 'botiga_section_mobile_header',
			'priority'  	=> 270
		)
	)
);

$wp_customize->add_setting( 'mobile_header_separator_width', array(
	'default'   		=> 1,
	'sanitize_callback' => 'absint',
	'transport'			=> 'postMessage'
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'mobile_header_separator_width',
	array(
		'label' 		=> esc_html__( 'Separator size', 'botiga' ),
		'section' 		=> 'botiga_section_mobile_header',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'mobile_header_separator_width',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50,
			'step'  => 1
		),
		'priority'  => 280
	)
) );

$wp_customize->add_setting(
	'link_separator_color',
	array(
		'default'           => '#eee',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'link_separator_color',
		array(
			'label'         	=> esc_html__( 'Separator color', 'botiga' ),
			'section'       	=> 'botiga_section_mobile_header',
			'priority'  		=> 290
		)
	)
);