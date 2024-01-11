<?php
/**
 * Header/Footer Builder
 * Social Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'social_profiles_topbar'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    new Botiga_Section_Hidden(
        $wp_customize,
        'botiga_section_hb_component__social',
        array(
            'title'      => esc_html__( 'Social Icons', 'botiga' ),
            'panel'      => 'botiga_panel_header'
        )
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
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_social_visibility'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                ),
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_social',
                        '#customize-control-bhfb_social_sticky_title',
                        '#customize-control-bhfb_social_sticky',
                        '#customize-control-bhfb_social_padding',
                        '#customize-control-bhfb_social_margin'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Visibility
$wp_customize->add_setting( 
    'bhfb_social_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'bhfb_social_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'bhfb_social_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'bhfb_social_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'botiga' ),
            'section'       => 'botiga_section_hb_component__social',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'bhfb_social_visibility_desktop',
                'tablet' 		=> 'bhfb_social_visibility_tablet',
                'mobile' 		=> 'bhfb_social_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'botiga' ),
                'hidden'  => esc_html__( 'Hidden', 'botiga' )
            ),
            'priority'      => 55
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
$wp_customize->add_setting(
	'bhfb_social_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'bhfb_social',
        array(
            'label'    => esc_html__( 'Icons Color', 'botiga' ),
            'section'  => 'botiga_section_hb_component__social',
            'settings' => array(
                'normal' => 'bhfb_social_color',
                'hover'  => 'bhfb_social_color_hover',
            ),
            'priority' => 25
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
$wp_customize->add_setting(
	'bhfb_social_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'bhfb_social_sticky',
        array(
            'label'    => esc_html__( 'Icons Color', 'botiga' ),
            'section'  => 'botiga_section_hb_component__social',
            'settings' => array(
                'normal' => 'bhfb_social_sticky_color',
                'hover'  => 'bhfb_social_sticky_color_hover',
            ),
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority' => 33
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

// Padding
$wp_customize->add_setting( 
    'bhfb_social_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_social_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_social_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'bhfb_social_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__social',
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
                'desktop' => 'bhfb_social_padding_desktop',
                'tablet'  => 'bhfb_social_padding_tablet',
                'mobile'  => 'bhfb_social_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'bhfb_social_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_social_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'bhfb_social_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'bhfb_social_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__social',
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
                'desktop' => 'bhfb_social_margin_desktop',
                'tablet'  => 'bhfb_social_margin_tablet',
                'mobile'  => 'bhfb_social_margin_mobile'
            ),
            'priority'	      	 => 72
        )
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

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound