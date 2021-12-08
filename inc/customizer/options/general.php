<?php
/**
 * General Customizer options
 *
 * @package Botiga
 */

/**
 * General
 */
$wp_customize->add_panel(
	'botiga_panel_general',
	array(
		'title'         => esc_html__( 'General', 'botiga'),
		'priority'      => 0,
	)
);

/**
 * Scroll to top
 */
$wp_customize->add_section(
	'botiga_section_scrolltotop',
	array(
		'title'      => esc_html__( 'Scroll to top', 'botiga'),
		'panel'      => 'botiga_panel_general',
	)
);

$wp_customize->add_setting(
	'botiga_scrolltop_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_scrolltop_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_scrolltotop',
			'controls_general'		=> json_encode( array( '#customize-control-scrolltop_text','#customize-control-enable_scrolltop','#customize-control-scrolltop_type','#customize-control-scrolltop_icon','#customize-control-scrolltop_radius','#customize-control-scrolltop_divider_1','#customize-control-scrolltop_position','#customize-control-scrolltop_side_offset','#customize-control-scrolltop_bottom_offset','#customize-control-scrolltop_divider_2','#customize-control-scrolltop_visibility',	) ),
			'controls_design'		=> json_encode( array( '#customize-control-scrolltop_color','#customize-control-scrolltop_bg_color','#customize-control-scrolltop_divider_3','#customize-control-scrolltop_color_hover','#customize-control-scrolltop_bg_color_hover','#customize-control-scrolltop_divider_4','#customize-control-scrolltop_icon_size','#customize-control-scrolltop_padding', ) ),
		)
	)
);

$wp_customize->add_setting(
	'enable_scrolltop',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_scrolltop',
		array(
			'label'         	=> esc_html__( 'Enable scroll to top', 'botiga' ),
			'section'       	=> 'botiga_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_type',
	array(
		'default' 			=> 'icon',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'scrolltop_type',
	array(
		'label' 	=> esc_html__( 'Type', 'botiga' ),
		'section' 	=> 'botiga_section_scrolltotop',
		'choices' 	=> array(
			'icon' 		=> esc_html__( 'Icon', 'botiga' ),
			'text' 		=> esc_html__( 'Text + Icon', 'botiga' ),
		),
		'active_callback' => 'botiga_callback_scrolltop',
	)
) );

$wp_customize->add_setting(
	'scrolltop_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( 'Back to top', 'botiga' ),
	)       
);
$wp_customize->add_control( 'scrolltop_text', array(
	'label'       		=> esc_html__( 'Text', 'botiga' ),
	'type'        		=> 'text',
	'section'     		=> 'botiga_section_scrolltotop',
	'active_callback' 	=> 'botiga_callback_scrolltop_text'
) );

$wp_customize->add_setting(
	'scrolltop_icon',
	array(
		'default'           => 'icon1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'scrolltop_icon',
		array(
			'label'    	=> esc_html__( 'Icon', 'botiga' ),
			'section'  	=> 'botiga_section_scrolltotop',
			'cols'		=> 4,
			'choices'  	=> array(			
				'icon1' 	=> array(
					'label' => esc_html__( 'Icon 1', 'botiga' ),
					'url'   => '%s/assets/img/st1.svg'
				),
				'icon2' => array(
					'label' => esc_html__( 'Icon 2', 'botiga' ),
					'url'   => '%s/assets/img/st2.svg'
				),		
				'icon3' => array(
					'label' => esc_html__( 'Icon 3', 'botiga' ),
					'url'   => '%s/assets/img/st3.svg'
				),				
				'icon4' => array(
					'label' => esc_html__( 'Icon 4', 'botiga' ),
					'url'   => '%s/assets/img/st4.svg'
				),
			),
			'active_callback' => 'botiga_callback_scrolltop',
		)
	)
); 

$wp_customize->add_setting( 'scrolltop_radius', array(
	'default'   		=> 30,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'scrolltop_radius',
	array(
		'label' 		=> esc_html__( 'Button radius', 'botiga' ),
		'section' 		=> 'botiga_section_scrolltotop',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'scrolltop_radius',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'active_callback' => 'botiga_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'scrolltop_divider_1',
		array(
			'section' 		=> 'botiga_section_scrolltotop',
			'active_callback' => 'botiga_callback_scrolltop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_position',
	array(
		'default' 			=> 'right',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'scrolltop_position',
	array(
		'label' 	=> esc_html__( 'Position', 'botiga' ),
		'section' 	=> 'botiga_section_scrolltotop',
		'choices' 	=> array(
			'left' 		=> esc_html__( 'Left', 'botiga' ),
			'right' 	=> esc_html__( 'Right', 'botiga' ),
		),
		'active_callback' => 'botiga_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_side_offset', array(
	'default'   		=> 30,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'scrolltop_side_offset',
	array(
		'label' 		=> esc_html__( 'Side offset', 'botiga' ),
		'section' 		=> 'botiga_section_scrolltotop',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'scrolltop_side_offset',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'active_callback' => 'botiga_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_bottom_offset', array(
	'default'   		=> 30,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'scrolltop_bottom_offset',
	array(
		'label' 		=> esc_html__( 'Bottom offset', 'botiga' ),
		'section' 		=> 'botiga_section_scrolltotop',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'scrolltop_bottom_offset',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'active_callback' => 'botiga_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'scrolltop_divider_2',
		array(
			'section' 		=> 'botiga_section_scrolltotop',
			'active_callback' => 'botiga_callback_scrolltop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_visibility', array(
	'sanitize_callback' => 'botiga_sanitize_select',
	'default' 			=> 'all',
) );

$wp_customize->add_control( 'scrolltop_visibility', array(
	'type' 		=> 'select',
	'section' 	=> 'botiga_section_scrolltotop',
	'label' 	=> esc_html__( 'Visibility', 'botiga' ),
	'choices' => array(
		'all' 			=> esc_html__( 'Show on all devices', 'botiga' ),
		'desktop-only' 	=> esc_html__( 'Desktop only', 'botiga' ),
		'mobile-only' 	=> esc_html__( 'Mobile/tablet only', 'botiga' ),
	),
	'active_callback' => 'botiga_callback_scrolltop',
) );

/**
 * Style
 */
$wp_customize->add_setting(
	'scrolltop_color',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'scrolltop_color',
		array(
			'label'         	=> esc_html__( 'Icon color', 'botiga' ),
			'section'       	=> 'botiga_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting(
	'scrolltop_bg_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'scrolltop_bg_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_divider_3',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'scrolltop_divider_3',
		array(
			'section' 		=> 'botiga_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting(
	'scrolltop_color_hover',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'scrolltop_color_hover',
		array(
			'label'         	=> esc_html__( 'Icon hover color', 'botiga' ),
			'section'       	=> 'botiga_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting(
	'scrolltop_bg_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'scrolltop_bg_color_hover',
		array(
			'label'         	=> esc_html__( 'Background hover color', 'botiga' ),
			'section'       	=> 'botiga_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_divider_4',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'scrolltop_divider_4',
		array(
			'section' 		=> 'botiga_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_icon_size', array(
	'default'   		=> 18,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'scrolltop_icon_size',
	array(
		'label' 		=> esc_html__( 'Icon size', 'botiga' ),
		'section' 		=> 'botiga_section_scrolltotop',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'scrolltop_icon_size',
		),
		'input_attrs' => array (
			'min'	=> 10,
			'max'	=> 100
		),
	)
) );

$wp_customize->add_setting( 'scrolltop_padding', array(
	'default'   		=> 15,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'scrolltop_padding',
	array(
		'label' 		=> esc_html__( 'Padding', 'botiga' ),
		'section' 		=> 'botiga_section_scrolltotop',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'scrolltop_padding',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
	)
) );

/**
 * Buttons
 */
$wp_customize->add_section(
	'botiga_section_buttons',
	array(
		'title'      => esc_html__( 'Buttons', 'botiga'),
		'panel'      => 'botiga_panel_general',
	)
);

$wp_customize->add_setting( 'button_top_bottom_padding_desktop', array(
	'default'   		=> 13,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'button_top_bottom_padding_tablet', array(
	'default'   		=> 13,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'button_top_bottom_padding_mobile', array(
	'default'   		=> 13,
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_top_bottom_padding',
	array(
		'label' 		=> esc_html__( 'Top/Bottom padding', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_top_bottom_padding_desktop',
			'size_tablet' 		=> 'button_top_bottom_padding_tablet',
			'size_mobile' 		=> 'button_top_bottom_padding_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50
		)		
	)
) );

$wp_customize->add_setting( 'button_left_right_padding_desktop', array(
	'default'   		=> 24,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'button_left_right_padding_tablet', array(
	'default'   		=> 24,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'button_left_right_padding_mobile', array(
	'default'   		=> 24,
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_left_right_padding',
	array(
		'label' 		=> esc_html__( 'Left/Right padding', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_left_right_padding_desktop',
			'size_tablet' 		=> 'button_left_right_padding_tablet',
			'size_mobile' 		=> 'button_left_right_padding_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50
		)		
	)
) );


$wp_customize->add_setting( 'button_border_radius', array(
	'default'   		=> 0,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_border_radius',
	array(
		'label' 		=> esc_html__( 'Button radius', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_border_radius',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
	)
) );

$wp_customize->add_setting( 'buttons_divider_0',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'buttons_divider_0',
		array(
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'button_font_size_desktop', array(
	'default'   		=> 14,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'button_font_size_tablet', array(
	'default'   		=> 14,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'button_font_size_mobile', array(
	'default'   		=> 14,
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'button_font_size',
	array(
		'label' 		=> esc_html__( 'Font size', 'botiga' ),
		'section' 		=> 'botiga_section_buttons',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'button_font_size_desktop',
			'size_tablet' 		=> 'button_font_size_tablet',
			'size_mobile' 		=> 'button_font_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 50
		)		
	)
) );

$wp_customize->add_setting( 'button_text_transform',
	array(
		'default' 			=> 'uppercase',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'button_text_transform',
	array(
		'label'   => esc_html__( 'Text transform', 'botiga' ),
		'section' => 'botiga_section_buttons',
		'choices' => array(
			'none' 			=> '-',
			'capitalize' 	=> 'Aa',
			'lowercase' 	=> 'aa',
			'uppercase' 	=> 'AA',
		)
	)
) );

$wp_customize->add_setting( 'buttons_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'buttons_divider_1',
		array(
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'buttons_default_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'buttons_default_state_title',
		array(
			'label'			=> esc_html__( 'Default state', 'botiga' ),
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_border_color',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'buttons_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'buttons_divider_2',
		array(
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting( 'buttons_hover_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'buttons_hover_state_title',
		array(
			'label'			=> esc_html__( 'Hover state', 'botiga' ),
			'section' 		=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_background_color_hover',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_color_hover',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);

$wp_customize->add_setting(
	'button_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'button_border_color_hover',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga' ),
			'section'       	=> 'botiga_section_buttons',
		)
	)
);