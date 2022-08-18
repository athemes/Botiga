<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Options
 * 
 * @package Botiga_Pro
 */

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_transparent',
        'header_transparent_display_rules_title',
        'header_transparent_display_on',
        'header_container',
        'enable_sticky_header',
        'sticky_header_type'
    ),
    'style'   => array()
);

// Sticky Header Row
$wp_customize->add_setting( 
	'botiga_section_hb_wrapper__header_builder_sticky_row', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default' 			=> 'main-header-row'
	) 
);
$wp_customize->add_control( 
	'botiga_section_hb_wrapper__header_builder_sticky_row', 
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Header Row To Sticky', 'botiga-pro' ),
		'choices'         => array(
            'all' 	            => esc_html__( 'All', 'botiga-pro' ),
			'main-header-row' 	=> esc_html__( 'Main Header Row', 'botiga-pro' ),
            'below-header-row' 	=> esc_html__( 'Bottom Header Row', 'botiga-pro' )
		),
        'section' 	      => 'botiga_section_hb_wrapper',
        'active_callback' => 'botiga_sticky_header_enabled',
        'priority'        => 35
	) 
);

// Move existing options.
$priority = 25;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_hb_wrapper';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}