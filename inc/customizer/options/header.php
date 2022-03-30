<?php
/**
 * Header Customizer options
 *
 * @package Botiga
 */

/**
 * Header
 */
$wp_customize->add_panel(
	'botiga_panel_header',
	array(
		'title'         => esc_html__( 'Header', 'botiga'),
		'priority'      => 1,
	)
);

/**
 * Header image
 */
$wp_customize->add_setting(
	'show_header_image_only_home',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'show_header_image_only_home',
		array(
			'label'         	=> esc_html__( 'Show only in the homepage', 'botiga' ),
			'section'       	=> 'header_image',
		)
	)
);

/**
 * Site identity
 */
$wp_customize->add_setting( 'site_logo_size_desktop', array(
	'default'   		=> 180,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'site_logo_size_tablet', array(
	'default'   		=> 100,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'site_logo_size_mobile', array(
	'default'   		=> 100,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'site_logo_size',
	array(
		'label' 		=> esc_html__( 'Logo width', 'botiga' ),
		'section' 		=> 'title_tagline',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'site_logo_size_desktop',
			'size_tablet' 		=> 'site_logo_size_tablet',
			'size_mobile' 		=> 'site_logo_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 500
		)		
	)
) );


$wp_customize->add_setting(
	'site_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'site_title_color',
		array(
			'label'         	=> esc_html__( 'Site title color', 'botiga' ),
			'section'       	=> 'title_tagline',
		)
	)
);

$wp_customize->add_setting(
	'site_description_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'site_description_color',
		array(
			'label'         	=> esc_html__( 'Site description color', 'botiga' ),
			'section'       	=> 'title_tagline',
		)
	)
);

/**
 * Main header
 */
$wp_customize->add_section(
	'botiga_section_main_header',
	array(
		'title'      => esc_html__( 'Main header', 'botiga'),
		'panel'      => 'botiga_panel_header',
	)
);

$wp_customize->add_setting(
	'botiga_main_header_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_main_header_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_main_header',
			'controls_general'		=> json_encode( array( '#customize-control-header_layout_desktop','#customize-control-header_transparent','#customize-control-topbar_transparent','#customize-control-header_transparent_display_rules_title','#customize-control-header_transparent_display_on','#customize-control-header_divider_1','#customize-control-main_header_settings_title','#customize-control-main_header_menu_position','#customize-control-header_container','#customize-control-enable_sticky_header','#customize-control-sticky_header_type','#customize-control-sitcky_header_logo','#customize-control-header_divider_2','#customize-control-main_header_elements_title','#customize-control-header_components_l1','#customize-control-header_components_l3left','#customize-control-header_components_l3right','#customize-control-header_components_l4top','#customize-control-header_components_l4bottom','#customize-control-header_components_l5topleft','#customize-control-header_components_l5topright','#customize-control-header_components_l5bottom','#customize-control-header_divider_3','#customize-control-main_header_cart_account_title','#customize-control-enable_header_cart','#customize-control-enable_header_account','#customize-control-header_divider_4','#customize-control-main_header_button_title','#customize-control-header_button_text','#customize-control-header_button_link','#customize-control-header_button_class','#customize-control-header_button_newtab','#customize-control-header_divider_5','#customize-control-main_header_contact_info_title','#customize-control-header_contact_mail','#customize-control-header_contact_phone', ) ),
			'controls_design'		=> json_encode( array( '#customize-control-main_header_submenu_color','#customize-control-main_header_submenu_color_hover','#customize-control-main_header_divider_10','#customize-control-main_header_minicart_count_background_color','#customize-control-main_header_minicart_count_text_color','#customize-control-main_header_submenu_background','#customize-control-main_header_bottom_padding','#customize-control-main_header_bottom_background', '#customize-control-main_header_bottom_color','#customize-control-main_header_bottom_color_hover','#customize-control-main_header_divider_9','#customize-control-main_header_divider_7','#customize-control-main_header_background','#customize-control-main_header_color','#customize-control-main_header_color_hover','#customize-control-main_header_divider_11','#customize-control-main_header_divider_6','#customize-control-main_header_padding','#customize-control-main_header_divider_size','#customize-control-main_header_divider_color','#customize-control-main_header_divider_width','#customize-control-main_header_sticky_active_divider','#customize-control-main_header_sticky_active_title_1','#customize-control-main_header_sticky_active_background','#customize-control-main_header_sticky_active_color','#customize-control-main_header_sticky_active_color_hover','#customize-control-main_header_sticky_active_submenu_background_color','#customize-control-main_header_sticky_active_submenu_color','#customize-control-main_header_sticky_active_submenu_color_hover' ) ),
		)
	)
);

//Layout
$choices = botiga_header_layouts();

$wp_customize->add_setting(
	'header_layout_desktop',
	array(
		'default'           => 'header_layout_1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'header_layout_desktop',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'botiga_section_main_header',
			'cols'		=> 2,
			'choices'  	=> $choices,
			'priority'	=> 20
		)
	)
);

$wp_customize->add_setting(
	'header_transparent',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'header_transparent',
		array(
			'label'         	=> esc_html__( 'Enable transparent header', 'botiga' ),
			'description'       => esc_html__( 'The header stays over the content. You need manually change the background color from header to be transparent.', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'		    => 21
		)
	)
);

$wp_customize->add_setting(
	'topbar_transparent',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'topbar_transparent',
		array(
			'label'         	=> esc_html__( 'Enable transparent top bar', 'botiga' ),
			'description'       => esc_html__( 'The top bar stays over the content. You need manually change the background color from top bar to be transparent.', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_header_transparent_enabled',
			'priority'		    => 21
		)
	)
);

$wp_customize->add_setting( 'header_transparent_display_rules_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'header_transparent_display_rules_title',
		array(
			'label'			  => esc_html__( 'Header Transparent Display On', 'botiga' ),
			'section' 		  => 'botiga_section_main_header',
			'active_callback' => 'botiga_header_transparent_enabled',
			'priority'		  => 21
		)
	)
);

$wp_customize->add_setting(
	'header_transparent_display_on',
	array(
		'default'           => 'front-page',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control(
	new Botiga_Select2_Control(
		$wp_customize,
		'header_transparent_display_on',
		array(
			'label'           => '',
			'section'         => 'botiga_section_main_header',
			'select2_options' => '{ "selectionCssClass": "botiga-select2" }',
			'multiple'        => true,
			'choices'         => botiga_header_transparent_choices(),
			'active_callback' => 'botiga_header_transparent_enabled',
			'priority'		  => 21
		)
	)
);

$wp_customize->add_setting( 'header_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'header_divider_1',
		array(
			'section' 		=> 'botiga_section_main_header',
			'priority'		=> 30
		)
	)
);

//General
$wp_customize->add_setting( 'main_header_settings_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'main_header_settings_title',
		array(
			'label'			=> esc_html__( 'Settings', 'botiga' ),
			'section' 		=> 'botiga_section_main_header',
			'priority'		=> 40
		)
	)
);

$wp_customize->add_setting( 'main_header_menu_position',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'main_header_menu_position',
	array(
		'label' 		=> esc_html__( 'Menu position', 'botiga' ),
		'section' => 'botiga_section_main_header',
		'choices' => array(
			'left' 		=> esc_html__( 'Left', 'botiga' ),
			'center' 	=> esc_html__( 'Center', 'botiga' ),
			'right' 	=> esc_html__( 'Right', 'botiga' ),
		),
		'active_callback' => 'botiga_callback_header_layout_not_1',
		'priority'		  => 50
	)
) );

$wp_customize->add_setting( 'header_container',
	array(
		'default' 			=> 'container-fluid',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'header_container',
	array(
		'label' 		=> esc_html__( 'Container type', 'botiga' ),
		'section' => 'botiga_section_main_header',
		'choices' => array(
			'container' 		=> esc_html__( 'Contained', 'botiga' ),
			'container-fluid' 	=> esc_html__( 'Full-width', 'botiga' ),
		),
		'active_callback' => 'botiga_callback_header_layout_not_6',
		'priority'		  => 60
	)
) );

$wp_customize->add_setting(
	'enable_sticky_header',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_sticky_header',
		array(
			'label'         	=> esc_html__( 'Enable sticky header', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_header_layout_not_6',
			'priority'		    => 70
		)
	)
);

$wp_customize->add_setting( 'sticky_header_type',
	array(
		'default' 			=> 'always',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'sticky_header_type',
	array(
		'label' 		=> esc_html__( 'Sticky header type', 'botiga' ),
		'section' => 'botiga_section_main_header',
		'choices' => array(
			'always' 		=> esc_html__( 'Always sticky', 'botiga' ),
			'scrolltop' 	=> esc_html__( 'On scroll to top', 'botiga' ),
		),
		'active_callback' => 'botiga_callback_sticky_header',
		'priority'		  => 80
	)
) );

$wp_customize->add_setting( 
	'sitcky_header_logo',
	array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new WP_Customize_Media_Control( 
		$wp_customize, 
		'sitcky_header_logo',
		array(
			'label'           => __( 'Sticky Header Logo', 'botiga' ),
			'section'         => 'botiga_section_main_header',
			'mime_type'       => 'image',
			'active_callback' => 'botiga_callback_sticky_header_logo',
			'priority'	      => 81
		)
	)
);

$wp_customize->add_setting( 'header_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'header_divider_2',
		array(
			'section' 		=> 'botiga_section_main_header',
			'priority'		=> 90
		)
	)
);

$wp_customize->add_setting( 'main_header_elements_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'main_header_elements_title',
		array(
			'label'			=> esc_html__( 'Elements', 'botiga' ),
			'section' 		=> 'botiga_section_main_header',
			'priority'		=> 100
		)
	)
);

$header_components 	= botiga_header_elements();
$default_components = botiga_get_default_header_components();

//Layout 1&2 elements
$wp_customize->add_setting( 'header_components_l1', array(
	'default'  			=> $default_components['l1'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l1', array(
	'label'   			=> '',
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_1_2',
	'priority'			=> 110
) ) );

//Layout 3 elements
$wp_customize->add_setting( 'header_components_l3left', array(
	'default'  			=> $default_components['l3left'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l3left', array(
	'label'   			=> esc_html__( 'Left', 'botiga' ),
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_3',
	'priority'			=> 120
) ) );

$wp_customize->add_setting( 'header_components_l3right', array(
	'default'  			=> $default_components['l3right'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l3right', array(
	'label'   			=> esc_html__( 'Right', 'botiga' ),
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_3',
	'priority'			=> 130
) ) );

//Layout 4 elements
$wp_customize->add_setting( 'header_components_l4top', array(
	'default'  			=> $default_components['l4top'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l4top', array(
	'label'   			=> esc_html__( 'Top row', 'botiga' ),
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_4',
	'priority'			=> 140
) ) );

$wp_customize->add_setting( 'header_components_l4bottom', array(
	'default'  			=> $default_components['l4bottom'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l4bottom', array(
	'label'   			=> esc_html__( 'Bottom row', 'botiga' ),
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_4',
	'priority'			=> 150
) ) );

//Layout 5 elements
$wp_customize->add_setting( 'header_components_l5topleft', array(
	'default'  			=> $default_components['l5topleft'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l5topleft', array(
	'label'   			=> esc_html__( 'Top left', 'botiga' ),
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_5',
	'priority'			=> 160
) ) );

$wp_customize->add_setting( 'header_components_l5topright', array(
	'default'  			=> $default_components['l5topleft'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l5topright', array(
	'label'   			=> esc_html__( 'Top right', 'botiga' ),
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_5',
	'priority'			=> 170
) ) );

$wp_customize->add_setting( 'header_components_l5bottom', array(
	'default'  			=> $default_components['l5topleft'],
	'sanitize_callback'	=> 'botiga_sanitize_header_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l5bottom', array(
	'label'   			=> esc_html__( 'Bottom', 'botiga' ),
	'section' 			=> 'botiga_section_main_header',
	'choices' 			=> $header_components,
	'active_callback' 	=> 'botiga_callback_header_layout_5',
	'priority'			=> 180
) ) );

/**
 * Elements
 */
//Cart&account icons
$wp_customize->add_setting( 'header_divider_3',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'header_divider_3',
		array(
			'section' 		=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'woocommerce_icons' ); },
			'priority'			=> 190
		)
	)
);

$wp_customize->add_setting( 'main_header_cart_account_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'main_header_cart_account_title',
		array(
			'label'				=> esc_html__( 'Cart &amp; account icons', 'botiga' ),
			'section' 			=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'woocommerce_icons' ); },
			'priority'			=> 200
		)
	)
);

$wp_customize->add_setting(
	'enable_header_cart',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_header_cart',
		array(
			'label'         	=> esc_html__( 'Enable cart icon', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'woocommerce_icons' ); },
			'priority'			=> 210
		)
	)
);

$wp_customize->add_setting(
	'enable_header_account',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_header_account',
		array(
			'label'         	=> esc_html__( 'Enable account icon', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'woocommerce_icons' ); },
			'priority'			=> 220
		)
	)
);

//Button
$wp_customize->add_setting( 'header_divider_4',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'header_divider_4',
		array(
			'section' 			=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'button' ); },
			'priority'			=> 230
		)
	)
);

$wp_customize->add_setting( 'main_header_button_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'main_header_button_title',
		array(
			'label'				=> esc_html__( 'Button', 'botiga' ),
			'section' 			=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'button' ); },
			'priority'			=> 240
		)
	)
);

$wp_customize->add_setting(
	'header_button_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( 'Click me', 'botiga' ),
	)       
);
$wp_customize->add_control( 'header_button_text', array(
	'label'       => esc_html__( 'Button text', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_main_header',
	'active_callback' 	=> function() { return botiga_callback_header_elements( 'button' ); },
	'priority'			=> 250
) );

$wp_customize->add_setting(
	'header_button_link',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'header_button_link', array(
	'label'       => esc_html__( 'Button link', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_main_header',
	'active_callback' 	=> function() { return botiga_callback_header_elements( 'button' ); },
	'priority'			=> 260
) );

$wp_customize->add_setting(
	'header_button_class',
	array(
		'sanitize_callback' => 'esc_attr',
		'default'           => '',
	)       
);
$wp_customize->add_control( 'header_button_class', array(
	'label'       => esc_html__( 'Button Class', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_main_header',
	'active_callback' 	=> function() { return botiga_callback_header_elements( 'button' ); },
	'priority'			=> 260
) );

$wp_customize->add_setting(
	'header_button_newtab',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'header_button_newtab',
		array(
			'label'         	=> esc_html__( 'Open in a new tab?', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'button' ); },
			'priority'			=> 270
		)
	)
);

//Contact info
$wp_customize->add_setting( 'header_divider_5',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'header_divider_5',
		array(
			'section' 			=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'contact_info' ); },
			'priority'			=> 280
		)
	)
);

$wp_customize->add_setting( 'main_header_contact_info_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'main_header_contact_info_title',
		array(
			'label'				=> esc_html__( 'Contact info', 'botiga' ),
			'section' 			=> 'botiga_section_main_header',
			'active_callback' 	=> function() { return botiga_callback_header_elements( 'contact_info' ); },
			'priority'			=> 290
		)
	)
);

$wp_customize->add_setting(
	'header_contact_mail',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( 'office@example.org', 'botiga' ),
	)       
);
$wp_customize->add_control( 'header_contact_mail', array(
	'label'       => esc_html__( 'Email address', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_main_header',
	'active_callback' 	=> function() { return botiga_callback_header_elements( 'contact_info' ); },
	'priority'			=> 300
) );

$wp_customize->add_setting(
	'header_contact_phone',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( '111222333', 'botiga' ),
	)       
);
$wp_customize->add_control( 'header_contact_phone', array(
	'label'       => esc_html__( 'Phone number', 'botiga' ),
	'type'        => 'text',
	'section'     => 'botiga_section_main_header',
	'active_callback' 	=> function() { return botiga_callback_header_elements( 'contact_info' ); },
	'priority'			=> 310
) );

/**
 * Styling
 */
$wp_customize->add_setting(
	'main_header_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 320
		)
	)
);

$wp_customize->add_setting(
	'main_header_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 330
		)
	)
);

$wp_customize->add_setting(
	'main_header_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color hover', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 330
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_11',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'main_header_divider_11',
		array(
			'section' 			=> 'botiga_section_main_header',
			'priority'			=> 331
		)
	)
);

$wp_customize->add_setting(
	'main_header_bottom_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_bottom_background',
		array(
			'label'         	=> esc_html__( 'Bottom row background color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
            'active_callback'   => 'botiga_callback_header_bottom',
			'priority'			=> 340
		)
	)
);

$wp_customize->add_setting(
	'main_header_bottom_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_bottom_color',
		array(
			'label'         	=> esc_html__( 'Bottom row text color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
            'active_callback'   => 'botiga_callback_header_bottom',
			'priority'			=> 350
		)
	)
);

$wp_customize->add_setting(
	'main_header_bottom_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_bottom_color_hover',
		array(
			'label'         	=> esc_html__( 'Bottom row text color hover', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
            'active_callback'   => 'botiga_callback_header_bottom',
			'priority'			=> 350
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_9',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'main_header_divider_9',
		array(
			'section' 			=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_header_bottom',
			'priority'			=> 351
		)
	)
);

$wp_customize->add_setting(
	'main_header_submenu_background',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_submenu_background',
		array(
			'label'         	=> esc_html__( 'Submenu background', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 360
		)
	)
);

$wp_customize->add_setting(
	'main_header_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_submenu_color',
		array(
			'label'         	=> esc_html__( 'Submenu color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 370
		)
	)
);

$wp_customize->add_setting(
	'main_header_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_submenu_color_hover',
		array(
			'label'         	=> esc_html__( 'Submenu color hover', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 370
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_10',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'main_header_divider_10',
		array(
			'section' 			=> 'botiga_section_main_header',
			'priority'			=> 371
		)
	)
);

$wp_customize->add_setting(
	'main_header_minicart_count_background_color',
	array(
		'default'           => '#ff5858',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_minicart_count_background_color',
		array(
			'label'         	=> esc_html__( 'Mini Cart Background Color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 371
		)
	)
);

$wp_customize->add_setting(
	'main_header_minicart_count_text_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_minicart_count_text_color',
		array(
			'label'         	=> esc_html__( 'Mini Cart Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'priority'			=> 371
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_6',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'main_header_divider_6',
		array(
			'section' 			=> 'botiga_section_main_header',
			'priority'			=> 380
		)
	)
);

$wp_customize->add_setting( 'main_header_padding', array(
	'default'   		=> 15,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'main_header_padding',
	array(
		'label' 		  => esc_html__( 'Padding', 'botiga' ),
		'section' 		  => 'botiga_section_main_header',
		'is_responsive'	  => 0,
		'settings' 		  => array (
			'size_desktop' 		=> 'main_header_padding',
		),
		'input_attrs'     => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'		  => 390
	)
) );

$wp_customize->add_setting( 'main_header_bottom_padding', array(
	'default'   		=> 15,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'main_header_bottom_padding',
	array(
		'label' 		=> esc_html__( 'Bottom row padding', 'botiga' ),
		'section' 		=> 'botiga_section_main_header',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'main_header_bottom_padding',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'active_callback'   => 'botiga_callback_header_bottom',
		'priority'			=> 400
	)
) );


$wp_customize->add_setting( 'main_header_divider_7',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'main_header_divider_7',
		array(
			'section' 			=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_header_layout_not_6_7_8',
			'priority'			=> 410
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_size', array(
	'sanitize_callback' => 'absint',
	'default' 			=> 0,
) );

$wp_customize->add_control( 'main_header_divider_size', array(
	'type' 				=> 'number',
	'section' 			=> 'botiga_section_main_header',
	'label' 			=> esc_html__( 'Border size', 'botiga' ),
	'active_callback' => 'botiga_callback_header_layout_not_6',
	'priority'			=> 420
) );

$wp_customize->add_setting(
	'main_header_divider_color',
	array(
		'default'           => 'rgba(33,33,33,0.1)',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_divider_color',
		array(
			'label'         	=> esc_html__( 'Border color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback' => 'botiga_callback_header_layout_not_6',
			'priority'			=> 430
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_width',
	array(
		'default' 			=> 'fullwidth',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'main_header_divider_width',
	array(
		'label' 	=> esc_html__( 'Border width', 'botiga' ),
		'section' 	=> 'botiga_section_main_header',
		'choices' 	=> array(
			'contained' 	=> esc_html__( 'Contained', 'botiga' ),
			'fullwidth' 	=> esc_html__( 'Full-width', 'botiga' ),
		),
		'active_callback' => 'botiga_callback_header_layout_not_6',
		'priority'			=> 440
	)
) );

$wp_customize->add_setting( 'main_header_sticky_active_divider',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'main_header_sticky_active_divider',
		array(
			'section' 			=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_sticky_header',
			'priority'			=> 440
		)
	)
);

$wp_customize->add_setting( 
	'main_header_sticky_active_title_1',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( 
	new Botiga_Text_Control( 
		$wp_customize, 
		'main_header_sticky_active_title_1',
		array(
			'label'			  => esc_html__( 'Sticky Header Active State', 'botiga' ),
			'section' 		  => 'botiga_section_main_header',
			'active_callback' => 'botiga_callback_sticky_header',
			'priority'		  => 440
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_background',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_sticky_header',
			'priority'			=> 440
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_sticky_header',
			'priority'			=> 440
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_sticky_header',
			'priority'			=> 450
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_submenu_background_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_submenu_background_color',
		array(
			'label'         	=> esc_html__( 'Submenu Background', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_sticky_header',
			'priority'			=> 560
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_submenu_color',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_sticky_header',
			'priority'			=> 560
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_submenu_color_hover',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_main_header',
			'active_callback'   => 'botiga_callback_sticky_header',
			'priority'			=> 560
		)
	)
);