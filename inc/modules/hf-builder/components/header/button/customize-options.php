<?php
/**
 * Header/Footer Builder
 * Button Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_button_text',
        'header_button_link',
        'header_button_class',
        'header_button_newtab'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_hb_component__button',
    array(
        'title'      => esc_html__( 'Button', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__button_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__button_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__button',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_button_default_state_title',
                        '#customize-control-bhfb_button_background_color',
                        '#customize-control-bhfb_button_color',
                        '#customize-control-bhfb_button_border_color',
                        '#customize-control-buttons_divider_2',
                        '#customize-control-buttons_hover_state_title',
                        '#customize-control-bhfb_button_background_color_hover',
                        '#customize-control-bhfb_button_color_hover',
                        '#customize-control-bhfb_button_border_color_hover',

						// Sticky State
						'#customize-control-bhfb_button_sticky_divider1',
						'#customize-control-bhfb_button_sticky_title',

                        '#customize-control-bhfb_button_sticky_background_color',
                        '#customize-control-bhfb_button_sticky_color',
                        '#customize-control-bhfb_button_sticky_border_color',
                        '#customize-control-bhfb_button_sticky_background_color_hover',
                        '#customize-control-bhfb_button_sticky_color_hover',
                        '#customize-control-bhfb_button_sticky_border_color_hover',
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Default State Title.
$wp_customize->add_setting( 'bhfb_button_default_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'bhfb_button_default_state_title',
		array(
			'label'			=> esc_html__( 'Default state', 'botiga' ),
			'section' 		=> 'botiga_section_hb_component__button',
            'priority'      => 25
		)
	)
);

// Background Color.
$wp_customize->add_setting(
	'bhfb_button_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
            'priority'          => 30
		)
	)
);

// Text Color.
$wp_customize->add_setting(
	'bhfb_button_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
            'priority'          => 35
		)
	)
);

// Border Color.
$wp_customize->add_setting(
	'bhfb_button_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_border_color',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
            'priority'          => 40
		)
	)
);

// Divider.
$wp_customize->add_setting( 'buttons_divider_2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'buttons_divider_2',
		array(
			'section' 		=> 'botiga_section_hb_component__button',
            'priority'      => 45
		)
	)
);

// Hover State Title.
$wp_customize->add_setting( 'buttons_hover_state_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'buttons_hover_state_title',
		array(
			'label'			=> esc_html__( 'Hover state', 'botiga' ),
			'section' 		=> 'botiga_section_hb_component__button',
            'priority'      => 50
		)
	)
);

// Background Color Hover.
$wp_customize->add_setting(
	'bhfb_button_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_background_color_hover',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
            'priority'          => 55
		)
	)
);

// Text Color Hover.
$wp_customize->add_setting(
	'bhfb_button_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_color_hover',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
            'priority'          => 60
		)
	)
);

// Border Color Hover.
$wp_customize->add_setting(
	'bhfb_button_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_border_color_hover',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
            'priority'          => 65
		)
	)
);

// Sticky Header - Divider
$wp_customize->add_setting( 'bhfb_button_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'bhfb_button_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__button',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 66
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'bhfb_button_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'bhfb_button_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga' ),
            'section' 		  => 'botiga_section_hb_component__button',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 67
        )
    )
);

// Sticky Header - Background Color.
$wp_customize->add_setting(
	'bhfb_button_sticky_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_sticky_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
			'active_callback'   => 'botiga_sticky_header_enabled',
            'priority'          => 68
		)
	)
);

// Sticky Header - Text Color.
$wp_customize->add_setting(
	'bhfb_button_sticky_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_sticky_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
			'active_callback'   => 'botiga_sticky_header_enabled',
            'priority'          => 69
		)
	)
);

// Sticky Header - Border Color.
$wp_customize->add_setting(
	'bhfb_button_sticky_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_sticky_border_color',
		array(
			'label'         	=> esc_html__( 'Border Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
			'active_callback'   => 'botiga_sticky_header_enabled',
            'priority'          => 70
		)
	)
);

// Sticky Header - Background Color Hover.
$wp_customize->add_setting(
	'bhfb_button_sticky_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_sticky_background_color_hover',
		array(
			'label'         	=> esc_html__( 'Background color (Hover)', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
			'active_callback'   => 'botiga_sticky_header_enabled',
            'priority'          => 71
		)
	)
);

// Sticky Header - Text Color Hover.
$wp_customize->add_setting(
	'bhfb_button_sticky_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Text Color (Hover)', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
			'active_callback'   => 'botiga_sticky_header_enabled',
            'priority'          => 72
		)
	)
);

// Sticky Header - Border Color Hover.
$wp_customize->add_setting(
	'bhfb_button_sticky_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_button_sticky_border_color_hover',
		array(
			'label'         	=> esc_html__( 'Border Color (Hover)', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__button',
			'active_callback'   => 'botiga_sticky_header_enabled',
            'priority'          => 73
		)
	)
);

// Move existing options.
$priority = 80;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

		if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
		
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__button';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound