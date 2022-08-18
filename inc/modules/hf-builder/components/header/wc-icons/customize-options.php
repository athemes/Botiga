<?php
/**
 * Header/Footer Builder
 * WooCommerce Icons Component
 * 
 * @package Botiga_Pro
 */

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'cart_icon',
        'cart_icon_custom_image',
        'account_icon',
        'account_icon_custom_image',
        'wishlist_icon',
        'wishlist_icon_custom_image',
        'header_divider_3',
        'main_header_cart_account_title',
        'enable_header_cart',
        'enable_header_account',
        'enable_header_wishlist_icon'
    ),
    'style'   => array(
        'main_header_minicart_count_background_color',
        'main_header_minicart_count_text_color'
    )
);

$wp_customize->add_section(
    'botiga_section_hb_component__woo_icons',
    array(
        'title'      => esc_html__( 'WooCommerce Icons', 'botiga-pro' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting(
    'botiga_section_hb_component__woo_icons_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control (
        $wp_customize,
        'botiga_section_hb_component__woo_icons_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'botiga_section_hb_component__woo_icons',
            'controls_general'		=> json_encode(
                array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
            ),
            'controls_design'		=> json_encode(
                array_merge(
                    array(
                        '#customize-control-bhfb_woo_icons_color',
                        '#customize-control-bhfb_woo_icons_color_hover',
                        '#customize-control-bhfb_woo_icons_sticky_divider1',
                        '#customize-control-bhfb_woo_icons_sticky_title',
                        '#customize-control-bhfb_woo_icons_sticky_color',
                        '#customize-control-bhfb_woo_icons_sticky_color_hover'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Icon Color
$wp_customize->add_setting(
	'bhfb_woo_icons_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_woo_icons_color',
		array(
			'label'         	=> esc_html__( 'Icons color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__woo_icons',
			'priority'			=> 25
		)
	)
);

// Icon Color Hover
$wp_customize->add_setting(
	'bhfb_woo_icons_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_woo_icons_color_hover',
		array(
			'label'         	=> esc_html__( 'Icons color hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__woo_icons',
			'priority'			=> 30
		)
	)
);

// Sticky Header - Divider
$wp_customize->add_setting( 'bhfb_woo_icons_sticky_divider1',
    array(
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'bhfb_woo_icons_sticky_divider1',
        array(
            'section' 		  => 'botiga_section_hb_component__woo_icons',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'        => 50
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'bhfb_woo_icons_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'bhfb_woo_icons_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'botiga-pro' ),
            'description'     => esc_html__( 'Control the colors when the sticky header state is active.', 'botiga-pro' ),
            'section' 		  => 'botiga_section_hb_component__woo_icons',
            'active_callback' => 'botiga_sticky_header_enabled',
            'priority'	 	  => 51
        )
    )
);

// Sticky Header - Icon Color
$wp_customize->add_setting(
	'bhfb_woo_icons_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_woo_icons_sticky_color',
		array(
			'label'         	=> esc_html__( 'Icons color', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__woo_icons',
			'priority'			=> 52
		)
	)
);

// Sticky Header - Icon Color Hover
$wp_customize->add_setting(
	'bhfb_woo_icons_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'bhfb_woo_icons_sticky_color_hover',
		array(
			'label'         	=> esc_html__( 'Icons color hover', 'botiga-pro' ),
			'section'       	=> 'botiga_section_hb_component__woo_icons',
			'priority'			=> 53
		)
	)
);

// Move existing options.
$priority = 35;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_component__woo_icons';
        $wp_customize->get_control( $option_name )->priority = $priority;

        if( in_array( $option_name, array( 'enable_header_cart', 'enable_header_account' ) ) ) {
            $wp_customize->get_control( $option_name )->active_callback  = function(){};
        }
        
        $priority++;
    }
}