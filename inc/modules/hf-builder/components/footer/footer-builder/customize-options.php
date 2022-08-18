<?php
/**
 * Footer Builder
 * General Footer Settings
 * 
 * @package Botiga_Pro
 */

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'footer_container'
    ),
    'style'   => array()
);

// Move existing options.
$priority = 25;
foreach( $opts_to_move as $tabs ) {
    foreach( $tabs as $option_name ) {
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_fb_wrapper';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}