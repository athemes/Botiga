<?php
/**
 * Header/Footer Builder
 * WPML Components
 * 
 * @package Botiga_Pro
 */

/**
 * WPML Language Switcher
 * 
 */
$wp_customize->add_section(
    'botiga_section_hb_component__wpml_switcher',
    array(
        'title'      => esc_html__( 'Polylang Language Switcher', 'botiga-pro' ),
        'panel'      => 'botiga_panel_header'
    )
);

$wp_customize->add_setting( 'botiga_section_hb_component__wpml_switcher_configure',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'botiga_section_hb_component__wpml_switcher_configure',
		array(
			'description' 	=> '<a class="footer-widget-area-link footer-widget-area-link-1" target="_blank" href="/wp-admin/admin.php?page=sitepress-multilingual-cms%2Fmenu%2Flanguages.php#wpml-language-switcher-shortcode-action">' . esc_html__( 'Configure language switcher', 'botiga-pro' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section' 		=> 'botiga_section_hb_component__wpml_switcher'
		)
	)
);