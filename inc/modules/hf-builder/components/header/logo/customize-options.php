<?php
/**
 * Header/Footer Builder
 * Logo Component
 * 
 * @package Botiga_Pro
 */

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'custom_logo',
        'blogname',
        'blogdescription',
        'site_logo_size',
        'display_header_text',
        'site_icon',
        'sitcky_header_logo'
    ),
    'style'   => array(
        'site_title_color',
        'site_description_color'
    )
);

// Register New Options.
$wp_customize->add_section(
    'botiga_section_hb_component__logo',
    array(
        'title'      => esc_html__( 'Logo', 'botiga-pro' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__logo_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__logo_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__logo',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] ) 
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-logo_sticky_divider1',
                        '#customize-control-logo_sticky_title',
                        '#customize-control-site_title_sticky_color',
                        '#customize-control-site_description_sticky_color'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Sticky Header - Divider
$wp_customize->add_setting( 'logo_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'logo_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__logo',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 50
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'logo_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'logo_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga-pro' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga-pro' ),
            'section' 		  => 'botiga_section_hb_component__logo',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 51
        )
    )
);

// Sticky Header - Site TItle Color
$wp_customize->add_setting(
	'site_title_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'site_title_sticky_color',
		array(
			'label'         	=> esc_html__( 'Site Title Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__logo',
            'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 52
		)
	)
);

// Sticky Header - Site Description Color
$wp_customize->add_setting(
	'site_description_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'site_description_sticky_color',
		array(
			'label'         	=> esc_html__( 'Site Description Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__logo',
            'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 53
		)
	)
);

// Move existing options.
$priority = 40;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__logo';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}