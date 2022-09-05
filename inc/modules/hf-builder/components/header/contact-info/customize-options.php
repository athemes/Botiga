<?php
/**
 * Header/Footer Builder
 * Contact Info Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_contact_mail',
        'header_contact_phone'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_hb_component__contact_info',
    array(
        'title'      => esc_html__( 'Contact Info', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__contact_info_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__contact_info_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__contact_info',
            'controls_general'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_contact_info_display_inline'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_contact_info_icon_color',
                        '#customize-control-bhfb_contact_info_icon_color_hover',
                        '#customize-control-bhfb_contact_info_text_color',
                        '#customize-control-bhfb_contact_info_text_color_hover',

                        // Sticky Active State
                        '#customize-control-bhfb_contact_info_sticky_divider1',
                        '#customize-control-bhfb_contact_info_sticky_title',

                        '#customize-control-bhfb_contact_info_icon_sticky_color',
                        '#customize-control-bhfb_contact_info_icon_sticky_color_hover',
                        '#customize-control-bhfb_contact_info_text_sticky_color',
                        '#customize-control-bhfb_contact_info_text_sticky_color_hover',
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

$wp_customize->add_setting(
    'bhfb_contact_info_display_inline',
    array(
        'default'           => 0,
        'sanitize_callback' => 'botiga_sanitize_checkbox',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    new Botiga_Toggle_Control(
        $wp_customize,
        'bhfb_contact_info_display_inline',
        array(
            'label'         	=> esc_html__( 'Display Inline', 'botiga' ),
            'section'       	=> 'botiga_section_hb_component__contact_info',
            'priority' 			=> 21
        )
    )
);

// Icons Color
$wp_customize->add_setting(
	'bhfb_contact_info_icon_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_icon_color',
		array(
			'label'         	=> esc_html__( 'Icons color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'priority'			=> 25
		)
	)
);

// Icons Color Hover
$wp_customize->add_setting(
	'bhfb_contact_info_icon_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_icon_color_hover',
		array(
			'label'         	=> esc_html__( 'Icons color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'priority'			=> 30
		)
	)
);

// Text Color
$wp_customize->add_setting(
	'bhfb_contact_info_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_text_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'priority'			=> 35
		)
	)
);

// Text Color Hover
$wp_customize->add_setting(
	'bhfb_contact_info_text_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_text_color_hover',
		array(
			'label'         	=> esc_html__( 'Text Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'priority'			=> 40
		)
	)
);

// Sticky Header - Divider
$wp_customize->add_setting( 'bhfb_contact_info_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'bhfb_contact_info_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__contact_info',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 41
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'bhfb_contact_info_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'bhfb_contact_info_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga' ),
            'section' 		  => 'botiga_section_hb_component__contact_info',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 42
        )
    )
);

// Sticky Header - Icons Color
$wp_customize->add_setting(
	'bhfb_contact_info_icon_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_icon_sticky_color',
		array(
			'label'         	=> esc_html__( 'Icons color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 43
		)
	)
);

// Sticky Header - Icons Color Hover
$wp_customize->add_setting(
	'bhfb_contact_info_icon_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_icon_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Icons color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 44
		)
	)
);

// Sticky Header - Text Color
$wp_customize->add_setting(
	'bhfb_contact_info_text_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_text_sticky_color',
		array(
			'label'         	=> esc_html__( 'Text Color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 45
		)
	)
);

// Sticky Header - Text Color Hover
$wp_customize->add_setting(
	'bhfb_contact_info_text_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_contact_info_text_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Text Color Hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__contact_info',
			'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 46
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
		
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__contact_info';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound