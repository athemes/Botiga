<?php
/**
 * Header/Footer Builder
 * Login/Register Component
 * 
 * @package Botiga_Pro
 */

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_login_register_title',
        'login_register_link_text',
        'login_register_popup',
        'login_register_show_welcome_message',
        'login_register_welcome_message_text'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_hb_component__login_register',
    array(
        'title'      => esc_html__( 'Login/Register', 'botiga-pro' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__login_register_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__login_register_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__login_register',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-login_register_color',
                        '#customize-control-login_register_color_hover',
                        '#customize-control-login_register_submenu_background',
                        '#customize-control-login_register_submenu_color',
                        '#customize-control-login_register_submenu_color_hover',
						'#customize-control-login_register_sticky_divider1',
                        '#customize-control-login_register_sticky_title',
						'#customize-control-login_register_sticky_color',
                        '#customize-control-login_register_sticky_color_hover',
                        '#customize-control-login_register_sticky_submenu_background',
                        '#customize-control-login_register_sticky_submenu_color',
                        '#customize-control-login_register_sticky_submenu_color_hover'
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
	'login_register_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'priority'			=> 25
		)
	)
);

// Text Color Hover
$wp_customize->add_setting(
	'login_register_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'priority'			=> 30
		)
	)
);

// Submenu Background
$wp_customize->add_setting(
	'login_register_submenu_background',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_submenu_background',
		array(
			'label'         	=> esc_html__( 'Submenu Background', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'priority'			=> 35
		)
	)
);

// Submenu Text Color
$wp_customize->add_setting(
	'login_register_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_submenu_color',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'priority'			=> 40
		)
	)
);

// Submenu Text Color Hover
$wp_customize->add_setting(
	'login_register_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_submenu_color_hover',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color Hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'priority'			=> 45
		)
	)
);

// Sticky Header - Divider
$wp_customize->add_setting( 'login_register_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'login_register_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__login_register',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 46
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'login_register_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'login_register_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga-pro' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga-pro' ),
            'section' 		  => 'botiga_section_hb_component__login_register',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 47
        )
    )
);

// Sticky Header - Text Color
$wp_customize->add_setting(
	'login_register_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_sticky_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 48
		)
	)
);

// Sticky Header - Text Color Hover
$wp_customize->add_setting(
	'login_register_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'active_callback' 	=> 'botiga_sticky_header_enabled',
			'priority'			=> 49
		)
	)
);

// Sticky Header - Submenu Background
$wp_customize->add_setting(
	'login_register_sticky_submenu_background',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_sticky_submenu_background',
		array(
			'label'         	=> esc_html__( 'Submenu Background', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'active_callback'	=> 'botiga_sticky_header_enabled',
			'priority'			=> 50
		)
	)
);

// Sticky Header - Submenu Text Color
$wp_customize->add_setting(
	'login_register_sticky_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_sticky_submenu_color',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'active_callback' 	=> 'botiga_sticky_header_enabled',
			'priority'			=> 51
		)
	)
);

// Sticky Header - Submenu Text Color Hover
$wp_customize->add_setting(
	'login_register_sticky_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'login_register_sticky_submenu_color_hover',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color Hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__login_register',
			'active_callback' 	=> 'botiga_sticky_header_enabled',
			'priority'			=> 52
		)
	)
);

// Move existing options.
$priority = 50;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__login_register';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}