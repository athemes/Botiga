<?php
/**
 * Header/Footer Builder
 * Menu Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(),
    'style'   => array(
        'main_header',
        'main_header_submenu_background',
        'main_header_submenu',
        'main_header_sticky_active_title_1',
        'main_header_sticky_active',
        'main_header_sticky_active_submenu_background_color',
        'main_header_sticky_active_submenu',
    )
);

$wp_customize->add_section(
    new Botiga_Section_Hidden(
        $wp_customize,
        'botiga_section_hb_component__menu',
        array(
            'title'      => esc_html__( 'Primary Menu', 'botiga' ),
            'panel'      => 'botiga_panel_header'
        )
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
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array( 
                        '#customize-control-botiga_section_hb_component__menu_config',
                        '#customize-control-botiga_section_hb_component__menu_visibility'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] ),
                    array(
                        '#customize-control-botiga_section_hb_component__menu_padding',
                        '#customize-control-botiga_section_hb_component__menu_margin'
                    ),
                )
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
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">' . esc_html__( 'Configure Menu', 'botiga' ) . '</span><a class="botiga-to-widget-area-link" href="javascript:wp.customize.section( \'menu_locations\' ).focus();">' . esc_html__( 'Configure Menu', 'botiga' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section' 		=> 'botiga_section_hb_component__menu',
            'priority'      => 20
		)
	)
);

// Visibility
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'botiga_section_hb_component__menu_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'botiga' ),
            'section'       => 'botiga_section_hb_component__menu',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'botiga_section_hb_component__menu_visibility_desktop',
                'tablet' 		=> 'botiga_section_hb_component__menu_visibility_tablet',
                'mobile' 		=> 'botiga_section_hb_component__menu_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'botiga' ),
                'hidden'  => esc_html__( 'Hidden', 'botiga' )
            ),
            'priority'      => 22
        )
    ) 
);

// Padding
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_hb_component__menu_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__menu',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'botiga_section_hb_component__menu_padding_desktop',
                'tablet'  => 'botiga_section_hb_component__menu_padding_tablet',
                'mobile'  => 'botiga_section_hb_component__menu_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'botiga_section_hb_component__menu_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'botiga_section_hb_component__menu_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__menu',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'botiga_section_hb_component__menu_margin_desktop',
                'tablet'  => 'botiga_section_hb_component__menu_margin_tablet',
                'mobile'  => 'botiga_section_hb_component__menu_margin_mobile'
            ),
            'priority'	      	 => 72
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

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound