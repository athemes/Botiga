<?php
/**
 * Header/Footer Builder
 * Menu Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(),
    'style'   => array(
        'main_header_color',
        'main_header_color_hover',
        'main_header_submenu_background',
        'main_header_submenu_color',
        'main_header_submenu_color_hover',
        'main_header_sticky_active_divider',
        'main_header_sticky_active_title_1',
        'main_header_sticky_active_color',
        'main_header_sticky_active_color_hover',
        'main_header_sticky_active_submenu_background_color',
        'main_header_sticky_active_submenu_color',
        'main_header_sticky_active_submenu_color_hover'
    )
);

$wp_customize->add_section(
    'botiga_section_hb_component__menu',
    array(
        'title'      => esc_html__( 'Primary Menu', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__menu_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__menu_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__menu',
            'controls_general'		=> json_encode(
                array_merge(
                    array( '#customize-control-botiga_section_hb_component__menu_config' ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
            ),
            'priority' 				=> 20
        )
    )
);

$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_config',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'botiga_section_hb_component__menu_config',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">' . esc_html__( 'Configure Menu', 'botiga' ) . '</span><a class="to-widget-area-link" href="javascript:wp.customize.section( \'menu_locations\' ).focus();">' . esc_html__( 'Configure Menu', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section' 		=> 'botiga_section_hb_component__menu',
            'priority'      => 20
		)
	)
);

// Move existing options.
$priority = 30;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
        
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__menu';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound