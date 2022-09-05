<?php
/**
 * Header/Footer Builder
 * Secondary Menu Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'topbar_nav_title',
        'topbar_nav_link'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_hb_component__secondary_menu',
    array(
        'title'      => esc_html__( 'Secondary Menu', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__secondary_menu_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__secondary_menu_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__secondary_menu',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-secondary_menu_color',
                        '#customize-control-secondary_menu_color_hover',
                        '#customize-control-secondary_menu_submenu_background',
                        '#customize-control-secondary_menu_submenu_color',
                        '#customize-control-secondary_menu_submenu_color_hover',
						'#customize-control-secondary_menu_sticky_divider1',
                        '#customize-control-secondary_menu_sticky_title',
						'#customize-control-secondary_menu_sticky_color',
                        '#customize-control-secondary_menu_sticky_color_hover',
                        '#customize-control-secondary_menu_sticky_submenu_background',
                        '#customize-control-secondary_menu_sticky_submenu_color',
                        '#customize-control-secondary_menu_sticky_submenu_color_hover'
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
	'secondary_menu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'priority'			=> 25
		)
	)
);

// Text Color Hover
$wp_customize->add_setting(
	'secondary_menu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'priority'			=> 30
		)
	)
);

// Submenu Background
$wp_customize->add_setting(
	'secondary_menu_submenu_background',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_submenu_background',
		array(
			'label'         	=> esc_html__( 'Submenu Background', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'priority'			=> 35
		)
	)
);

// Submenu Text Color
$wp_customize->add_setting(
	'secondary_menu_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_submenu_color',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'priority'			=> 40
		)
	)
);

// Submenu Text Color Hover
$wp_customize->add_setting(
	'secondary_menu_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_submenu_color_hover',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'priority'			=> 45
		)
	)
);

// Sticky Header - Divider
$wp_customize->add_setting( 'secondary_menu_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'secondary_menu_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__secondary_menu',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 46
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'secondary_menu_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'secondary_menu_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga' ),
            'section' 		  => 'botiga_section_hb_component__secondary_menu',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 47
        )
    )
);

// Sticky Header - Text Color
$wp_customize->add_setting(
	'secondary_menu_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_sticky_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 48
		)
	)
);

// Sticky Header - Text Color Hover
$wp_customize->add_setting(
	'secondary_menu_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Text color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'active_callback' 	=> 'botiga_sticky_header_enabled',
			'priority'			=> 49
		)
	)
);

// Sticky Header - Submenu Background
$wp_customize->add_setting(
	'secondary_menu_sticky_submenu_background',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_sticky_submenu_background',
		array(
			'label'         	=> esc_html__( 'Submenu Background', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'active_callback'	=> 'botiga_sticky_header_enabled',
			'priority'			=> 50
		)
	)
);

// Sticky Header - Submenu Text Color
$wp_customize->add_setting(
	'secondary_menu_sticky_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_sticky_submenu_color',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'active_callback' 	=> 'botiga_sticky_header_enabled',
			'priority'			=> 51
		)
	)
);

// Sticky Header - Submenu Text Color Hover
$wp_customize->add_setting(
	'secondary_menu_sticky_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'secondary_menu_sticky_submenu_color_hover',
		array(
			'label'         	=> esc_html__( 'Submenu Text Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__secondary_menu',
			'active_callback' 	=> 'botiga_sticky_header_enabled',
			'priority'			=> 52
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
		
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__secondary_menu';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound