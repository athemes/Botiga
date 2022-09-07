<?php
/**
 * Footer Builder
 * General Footer Settings
 * 
 * @package Botiga_Pro
 */

// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'footer_container'
    ),
    'style'   => array()
);

// Available Footer Components Area
$wp_customize->add_setting( 'botiga_section_fb_wrapper__footer_builder_available_footer_components',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_fb_wrapper__footer_builder_available_footer_components',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Available Components', 'botiga' ) .'</span><div class="bhfb-available-components botiga-footer-builder-available-footer-components botiga-bhfb-area"></div>',
			'section' 		=> 'botiga_section_fb_wrapper',
            'priority' 		=> 40
		)
	)
);

// Upsell
if( ! defined( 'BOTIGA_AWL_ACTIVE' ) && ! defined( 'BOTIGA_PRO_VERSION' ) ) {
	$wp_customize->add_setting( 'botiga_section_fb_wrapper__footer_builder_upsell',
		array(
			'default' 			=> '',
			'sanitize_callback' => 'esc_attr'
		)
	);
	$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_fb_wrapper__footer_builder_upsell',
			array(
				'description' 	=> '<div class="bhfb-customizer-sidebar-upsell"><p>'. esc_html__( 'Extend your footer with more components.', 'botiga' ) .'</p><a class="bhfb-upsell-button" target="_blank" href="https://athemes.com/botiga-upgrade?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga">'. esc_html__( 'Get Botiga Pro!', 'botiga' ) .'</a></div>',
				'section' 		=> 'botiga_section_fb_wrapper',
				'priority' 		=> 40
			)
		)
	);
}

// Move existing options.
$priority = 25;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
        
        $wp_customize->get_control( $option_name )->section  = 'botiga_section_fb_wrapper';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound