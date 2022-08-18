<?php
/**
 * Footer Builder
 * Footer Menu Component
 * 
 * @package Botiga_Pro
 */

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
		'footer_navigation_menu_link'
	),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_fb_component__footer_menu',
    array(
        'title'      => esc_html__( 'Footer Menu', 'botiga-pro' ),
        'panel'      => 'botiga_panel_footer'
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__footer_menu_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_fb_component__footer_menu_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_fb_component__footer_menu',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
				array(
					'#customize-control-footer_menu_color',
					'#customize-control-footer_menu_color_hover'
				)
            ),
            'priority' 				=> 20
        )
    )
);

// Text Color
$wp_customize->add_setting(
	'footer_menu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_menu_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__footer_menu',
			'priority'			=> 25
		)
	)
);

// Text Color Hover
$wp_customize->add_setting(
	'footer_menu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'footer_menu_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_fb_component__footer_menu',
			'priority'			=> 30
		)
	)
);

// Move existing options.
$priority = 50;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_fb_component__footer_menu';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}