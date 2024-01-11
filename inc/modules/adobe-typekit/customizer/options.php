<?php
/**
 * Adobe Typekit Customize Options
 *
 * @package Botiga
 */

if ( $wp_customize->get_control( 'fonts_library' ) !== NULL ) {
	$wp_customize->get_control( 'fonts_library' )->choices['adobe'] = esc_html__( 'Adobe Fonts', 'botiga' );
}

$wp_customize->add_setting( 
	'adobe_fonts_kits_generator',
	array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 
	new Botiga_Typography_Adobe_Kits_Control( 
		$wp_customize, 
		'adobe_fonts_kits_generator',
		array(
			'section'         => 'botiga_section_typography_general',
			'active_callback' => 'botiga_font_library_adobe',
		)
	) 
);
