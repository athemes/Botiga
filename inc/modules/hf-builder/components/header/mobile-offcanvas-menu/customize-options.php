<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Options
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'mobile_menu_link_separator',
        'mobile_menu_link_spacing',
        'mobile_header_separator_width'
    ),
    'style'   => array(
        'link_separator_color'
    )
);

$wp_customize->add_section(
    'botiga_section_hb_component__mobile_offcanvas_menu',
    array(
        'title'      => esc_html__( 'Mobile Offcanvas Menu', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

// Tabs
$wp_customize->add_setting(
    'botiga_section_hb_component__mobile_offcanvas_menu_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__mobile_offcanvas_menu_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__mobile_offcanvas_menu',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-mobile_offcanvas_menu_color',
                        '#customize-control-mobile_offcanvas_menu_color_hover',
                        '#customize-control-mobile_offcanvas_menu_submenu_color',
                        '#customize-control-mobile_offcanvas_menu_submenu_color_hover'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Text Color
$wp_customize->add_setting(
	'mobile_offcanvas_menu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'mobile_offcanvas_menu_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__mobile_offcanvas_menu',
			'priority'			=> 25
		)
	)
);

// Text Color Hover
$wp_customize->add_setting(
	'mobile_offcanvas_menu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'mobile_offcanvas_menu_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__mobile_offcanvas_menu',
			'priority'			=> 30
		)
	)
);

// Submenu Text Color
$wp_customize->add_setting(
	'mobile_offcanvas_menu_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'mobile_offcanvas_menu_submenu_color',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__mobile_offcanvas_menu',
			'priority'			=> 40
		)
	)
);

// Submenu Text Color Hover
$wp_customize->add_setting(
	'mobile_offcanvas_menu_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'mobile_offcanvas_menu_submenu_color_hover',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__mobile_offcanvas_menu',
			'priority'			=> 45
		)
	)
);

// Move existing options.
$priority = 50;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

		if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
		
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__mobile_offcanvas_menu';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound