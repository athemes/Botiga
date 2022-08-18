<?php
/**
 * Footer Builder
 * HTML Component
 * 
 * @package Botiga_Pro
 */

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'footer_html_content'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    'botiga_section_fb_component__html',
    array(
        'title'      => esc_html__( 'HTML', 'botiga-pro' ),
        'panel'      => 'botiga_panel_footer'
    )
);

$wp_customize->add_setting( 
    'botiga_section_fb_component__html_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'botiga_section_fb_component__html_title',
        array(
            'label'			  => esc_html__( 'HTML Content', 'botiga-pro' ),
            'section' 		  => 'botiga_section_fb_component__html',
            'priority'	 	  => 29
        )
    )
);

// Move existing options.
$priority = 30;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_fb_component__html';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}