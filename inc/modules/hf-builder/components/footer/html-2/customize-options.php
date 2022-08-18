<?php
/**
 * Footer Builder
 * HTML Component 2
 * 
 * @package Botiga_Pro
 */

$wp_customize->add_section(
    'botiga_section_fb_component__html2',
    array(
        'title'      => esc_html__( 'HTML 2', 'botiga-pro' ),
        'panel'      => 'botiga_panel_footer'
    )
);

$wp_customize->add_setting( 
    'botiga_section_fb_component__html2_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Botiga_Text_Control( 
        $wp_customize, 
        'botiga_section_fb_component__html2_title',
        array(
            'label'			  => esc_html__( 'HTML Content', 'botiga-pro' ),
            'section' 		  => 'botiga_section_fb_component__html2',
            'priority'	 	  => 30
        )
    )
);

$wp_customize->add_setting(
    'botiga_section_fb_component__html2_content',
    array(
        'sanitize_callback' => 'botiga_sanitize_text',
        'default'           => '',
    )       
);
$wp_customize->add_control( 
    'botiga_section_fb_component__html2_content', 
    array(
        'label'           => '',
        'type'            => 'textarea',
        'section'         => 'botiga_section_fb_component__html2',
        'priority'        => 35
    ) 
);