<?php
/**
 * Header/Footer Builder
 * Social Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'social_profiles_topbar'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_hb_component__social',
    array(
        'title'      => esc_html__( 'Social Icons', 'botiga' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__social_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__social_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__social',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_social_color',
                        '#customize-control-bhfb_social_color_hover',
                        '#customize-control-bhfb_social_sticky_divider1',
                        '#customize-control-bhfb_social_sticky_title',
                        '#customize-control-bhfb_social_sticky_color',
                        '#customize-control-bhfb_social_sticky_color_hover'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Icons Color.
$wp_customize->add_setting(
	'bhfb_social_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_social_color',
		array(
			'label'         	=> esc_html__( 'Icons color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__social',
			'priority'			=> 25
		)
	)
);

// Icons Color Hover.
$wp_customize->add_setting(
	'bhfb_social_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_social_color_hover',
		array(
			'label'         	=> esc_html__( 'Icons color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__social',
			'priority'			=> 30
		)
	)
);

// Sticky Header - Divider
$wp_customize->add_setting( 'bhfb_social_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'bhfb_social_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__social',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 31
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'bhfb_social_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'bhfb_social_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga' ),
            'section' 		  => 'botiga_section_hb_component__social',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 32
        )
    )
);

// Sticky Header - Icons Color.
$wp_customize->add_setting(
	'bhfb_social_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_social_sticky_color',
		array(
			'label'         	=> esc_html__( 'Icons color', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__social',
            'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 33
		)
	)
);

// Sticky Header - Icons Color Hover.
$wp_customize->add_setting(
	'bhfb_social_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_social_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Icons color hover', 'botiga' ),
			'section'       	=> 'botiga_section_hb_component__social',
            'active_callback'   => 'botiga_sticky_header_enabled',
			'priority'			=> 34
		)
	)
);

// Add selective refresh to existing options.
$wp_customize->selective_refresh->add_partial(
    'social_profiles_topbar',
    array(
        'selector'        => '.bhfb.bhfb-header .social-profile',
        'render_callback' => function() {
            botiga_social_profile( 'social_profiles_topbar' );
        }
    )
);

// Move existing options.
$priority = 35;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {
        
        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }

        if( $option_name === 'social_profiles_topbar' ) {
            $wp_customize->get_setting( $option_name )->transport = 'postMessage';
        }

        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__social';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound