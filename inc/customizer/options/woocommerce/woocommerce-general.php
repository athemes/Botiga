<?php
/**
 * Woocommerce General Customizer options
 *
 * @package Botiga
 */

// Section
$wp_customize->add_section(
	'botiga_section_catalog_general',
	array(
		'title'    => esc_html__( 'General', 'botiga'),
		'priority' => 95,
	)
); 
$wp_customize->get_control( 'woocommerce_shop_page_display' )->section  = 'botiga_section_catalog_general';
$wp_customize->get_control( 'woocommerce_category_archive_display' )->section  = 'botiga_section_catalog_general';
$wp_customize->get_control( 'woocommerce_default_catalog_orderby' )->section  = 'botiga_section_catalog_general';