<?php
/**
 * Header/Footer Builder
 * Search Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = apply_filters( 'botiga_hfb_header_component_search_opts_to_move', array(
    'general' => array(),
    'style'   => array()
) );

$wp_customize->add_section(
    'botiga_section_hb_component__search',
    array(
        'title'      => esc_html__( 'Search', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

if( defined( 'BOTIGA_PRO_VERSION' ) ) {
    $wp_customize->add_setting(
        'botiga_section_hb_component__search_tabs',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control(
        new Botiga_Tab_Control (
            $wp_customize,
            'botiga_section_hb_component__search_tabs',
            array(
                'label' 				=> '',
                'section'       		=> 'botiga_section_hb_component__search',
                'controls_general'		=> json_encode(
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                ),
                'controls_design'		=> json_encode(
                    array_merge(
                        array(
                            '#customize-control-bhfb_search_icon_color',
                            '#customize-control-bhfb_search_icon_color_hover',
                            '#customize-control-bhfb_search_icon_sticky_divider1',
                            '#customize-control-bhfb_search_icon_sticky_title',
                            '#customize-control-bhfb_search_icon_sticky_color',
                            '#customize-control-bhfb_search_icon_sticky_color_hover'
                        ),
                        array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                    )
                ),
                'priority' 				=> 20
            )
        )
    );
}

// Icon Color
$wp_customize->add_setting(
	'bhfb_search_icon_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_search_icon_color',
		array(
			'label'         	=> esc_html__( 'Icon color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__search',
			'priority'			=> 25
		)
	)
);

// Icon Color Hover
$wp_customize->add_setting(
	'bhfb_search_icon_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_search_icon_color_hover',
		array(
			'label'         	=> esc_html__( 'Icon color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__search',
			'priority'			=> 30
		)
	)
);

// Sticky Header - Divider
$wp_customize->add_setting( 'bhfb_search_icon_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'bhfb_search_icon_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__search',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 31
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'bhfb_search_icon_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'bhfb_search_icon_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga' ),
            'section' 		  => 'botiga_section_hb_component__search',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 32
        )
    )
);

// Sticky Header - Icon Color
$wp_customize->add_setting(
	'bhfb_search_icon_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_search_icon_sticky_color',
		array(
			'label'         	=> esc_html__( 'Icon color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__search',
            'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 33
		)
	)
);

// Sticky Header - Icon Color Hover
$wp_customize->add_setting(
	'bhfb_search_icon_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_search_icon_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Icon color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__search',
            'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 34
		)
	)
);

// Move existing options.
$priority = 40;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {
        
        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }

        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__search';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound