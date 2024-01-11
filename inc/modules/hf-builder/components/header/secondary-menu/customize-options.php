<?php
/**
 * Header/Footer Builder
 * Secondary Menu Component
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'topbar_nav_link'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    new Botiga_Section_Hidden(
        $wp_customize,
        'botiga_section_hb_component__secondary_menu',
        array(
            'title'      => esc_html__( 'Secondary Menu', 'botiga' ),
            'panel'      => 'botiga_panel_header'
        )
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
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] ),
                    array(
                        '#customize-control-secondary_menu_visibility'
                    )
                ),
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-secondary_menu',
                        '#customize-control-secondary_menu_submenu_background',
                        '#customize-control-secondary_menu_submenu',
                        '#customize-control-secondary_menu_sticky_title',
						'#customize-control-secondary_menu_sticky',
                        '#customize-control-secondary_menu_sticky_submenu_background',
                        '#customize-control-secondary_menu_sticky_submenu',
						'#customize-control-secondary_menu_padding',
						'#customize-control-secondary_menu_margin'
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
    'secondary_menu_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'secondary_menu_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'secondary_menu_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Botiga_Radio_Buttons( 
        $wp_customize, 
        'secondary_menu_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'botiga' ),
            'section'       => 'botiga_section_hb_component__secondary_menu',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'secondary_menu_visibility_desktop',
                'tablet' 		=> 'secondary_menu_visibility_tablet',
                'mobile' 		=> 'secondary_menu_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'botiga' ),
                'hidden'  => esc_html__( 'Hidden', 'botiga' )
            ),
            'priority'      => 25
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
$wp_customize->add_setting(
	'secondary_menu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Color_Group(
		$wp_customize,
		'secondary_menu',
		array(
			'label'    => esc_html__( 'Text Color', 'botiga' ),
			'section'  => 'botiga_section_hb_component__secondary_menu',
			'settings' => array(
				'normal' => 'secondary_menu_color',
				'hover'  => 'secondary_menu_color_hover',
			),
			'priority' => 35
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
$wp_customize->add_setting(
	'secondary_menu_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Color_Group(
		$wp_customize,
		'secondary_menu_submenu',
		array(
			'label'    => esc_html__( 'Submenu Text Color', 'botiga' ),
			'section'  => 'botiga_section_hb_component__secondary_menu',
			'settings' => array(
				'normal' => 'secondary_menu_submenu_color',
				'hover'  => 'secondary_menu_submenu_color_hover',
			),
			'priority' => 40
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
$wp_customize->add_setting(
	'secondary_menu_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Color_Group(
		$wp_customize,
		'secondary_menu_sticky',
		array(
			'label'    => esc_html__( 'Text Color', 'botiga' ),
			'section'  => 'botiga_section_hb_component__secondary_menu',
			'settings' => array(
				'normal' => 'secondary_menu_sticky_color',
				'hover'  => 'secondary_menu_sticky_color_hover',
			),
			'active_callback' => 'botiga_sticky_header_enabled',
			'priority' => 48
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
$wp_customize->add_setting(
	'secondary_menu_sticky_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Color_Group(
		$wp_customize,
		'secondary_menu_sticky_submenu',
		array(
			'label'    => esc_html__( 'Submenu Text Color', 'botiga' ),
			'section'  => 'botiga_section_hb_component__secondary_menu',
			'settings' => array(
				'normal' => 'secondary_menu_sticky_submenu_color',
				'hover'  => 'secondary_menu_sticky_submenu_color_hover',
			),
			'active_callback' => 'botiga_sticky_header_enabled',
			'priority' => 51
		)
	)
);

// Padding
$wp_customize->add_setting( 
    'secondary_menu_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'secondary_menu_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'secondary_menu_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'secondary_menu_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__secondary_menu',
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
                'desktop' => 'secondary_menu_padding_desktop',
                'tablet'  => 'secondary_menu_padding_tablet',
                'mobile'  => 'secondary_menu_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'secondary_menu_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'secondary_menu_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'secondary_menu_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'secondary_menu_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'botiga' ),
            'section'         	=> 'botiga_section_hb_component__secondary_menu',
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
                'desktop' => 'secondary_menu_margin_desktop',
                'tablet'  => 'secondary_menu_margin_tablet',
                'mobile'  => 'secondary_menu_margin_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Move existing options.
$priority = 21;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

		if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }

        if( 'topbar_nav_link' === $option_name ) {
            $wp_customize->get_control( $option_name )->label = esc_html__( 'Secondary Menu', 'botiga' );   
            $wp_customize->get_control( $option_name )->rm_desc_mt = true;    
        }
		
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__secondary_menu';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound