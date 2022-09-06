<?php
/**
 * Header/Footer Builder
 * Mobile Hamburger Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
 
// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'mobile_menu_icon',
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_hb_component__mobile_hamburger',
    array(
        'title'      => esc_html__( 'Menu Toggle', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__mobile_hamburger_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__mobile_hamburger_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__mobile_hamburger',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_mobile_hamburger_icon_color'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Icon Color
$wp_customize->add_setting(
	'bhfb_mobile_hamburger_icon_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_mobile_hamburger_icon_color',
		array(
			'label'         	=> esc_html__( 'Icon color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__mobile_hamburger',
			'priority'			=> 25
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
        
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__mobile_hamburger';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// Selective Refresh
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->get_setting( 'mobile_menu_icon' )->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial(
        'mobile_menu_icon',
        array(
            'selector'            => '.bhfb-component-mobile_hamburger',
            'container_inclusive' => true,
            'render_callback'     => function() {
                require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-hamburger/mobile-hamburger.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
            }
        )
    );
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound