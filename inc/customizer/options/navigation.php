<?php
/**
 * Navigation
 */
$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_navigation',
	array(
		'title'    => esc_html__( 'Navigation', 'botiga' ),
		'priority' => 10,
	),
) );
//
// @priority 11 (Header)
//
// @priority 12 (Footer)
//
// @priority 13 (Sidebar)
//

/**
 * Site Styles
 */
$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_site_styles',
	array(
		'title'    => esc_html__( 'Site Styles', 'botiga' ),
		'priority' => 20,
		'divider'  => true,
	),
) );
//
// @priority 21 (Typography)
//
// @priority 22 (Colors)
//
$wp_customize->get_section( 'colors' )->priority = 22;
//
// @priority 23 (Layout)
//
// @priority 24 (Background)
//
$wp_customize->get_section( 'background_image' )->title    = esc_html__( 'Background', 'botiga');
$wp_customize->get_section( 'background_image' )->priority = 24;

/**
 * Elements
 */
$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_elements',
	array(
		'title'    => esc_html__( 'Elements', 'botiga' ),
		'priority' => 30,
		'divider'  => true,
	),
) );
//
// @priority 31 (Buttons)
//
// @priority 32 (Scroll to Top)
//
// @priority 33 (Breadcrumbs)
//
// @priority 34 (Quick Links)
//

/**
 * WooCommerce
 */
if ( class_exists( 'WooCommerce' ) ) {

	$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_woocommerce',
		array(
			'title'    => esc_html__( 'WooCommerce', 'botiga' ),
			'priority' => 40,
			'divider'  => true,
		),
	) );
	//
	// @priority 41 (General)
	//
	// @priority 42 (Store Notice)
	//
	if ( $wp_customize->get_section( 'woocommerce_store_notice' ) ) {
		$wp_customize->get_section( 'woocommerce_store_notice' )->panel    = null;
		$wp_customize->get_section( 'woocommerce_store_notice' )->priority = 42;
	}
	//
	// @priority 43 (Product Catalog)
	//
	if ( $wp_customize->get_section( 'woocommerce_product_catalog' ) ) {
		$wp_customize->get_section( 'woocommerce_product_catalog' )->panel    = null;
		$wp_customize->get_section( 'woocommerce_product_catalog' )->priority = 43;
	}
	//
	// @priority 44 (Single Products)
	//
	// @priority 45 (Checkout)
	//
	if ( $wp_customize->get_section( 'woocommerce_checkout' ) ) {
		$wp_customize->get_section( 'woocommerce_checkout' )->panel    = null;
		$wp_customize->get_section( 'woocommerce_checkout' )->priority = 45;
	}
	//
	// @priority 46 (Cart)
	//
	// @priority 47 (Search)
	//
	// @priority 48 (Wishlist)
	//
	// @priority 49 (Floating Mini Cart Icon)
	//
	// @priority 50 (Product Images)
	//
	if ( $wp_customize->get_section( 'woocommerce_product_images' ) ) {
		$wp_customize->get_section( 'woocommerce_product_images' )->panel    = null;
		$wp_customize->get_section( 'woocommerce_product_images' )->priority = 50;
	}
	//
	// @priority 51 (Product Swatches)
	//

}

/**
 * Blog
 */
$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_blog',
	array(
		'title'    => esc_html__( 'Blog', 'botiga' ),
		'priority' => 60,
		'divider'  => true,
	),
) );
//
// @priority 61 (Blog Archives)
//
// @priority 62 (Single Posts)
//

/**
 * Extension
 */
$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_extension',
	array(
		'title'    => esc_html__( 'Extension', 'botiga' ),
		'priority' => 70,
		'divider'  => true,
	),
) );
//
// @priority 71 (Performance)
//
// @priority 72 (Modal Popup)
//
// @priority 73 (Hooks)

/**
 * Core
 */
$wp_customize->add_section( new Botiga_Title_Section( $wp_customize, 'botiga_core',
	array(
		'title'    => esc_html__( 'Core', 'botiga' ),
		'priority' => 80,
		'divider'  => true,
	),
) );
//
// @priority 81 (Widgets)
//
if ( $wp_customize->get_panel( 'widgets' ) ) {
	$wp_customize->get_panel( 'widgets' )->priority = 81;
}
//
// @priority 82 (Menus)
//
if ( $wp_customize->get_panel( 'nav_menus' ) ) {
	$wp_customize->get_panel( 'nav_menus' )->priority = 82;
}
//
// @priority 83 (Homepage Settings)
//
if ( $wp_customize->get_section( 'static_front_page' ) ) {
	$wp_customize->get_section( 'static_front_page' )->priority = 83;
}
//
// @priority 84 (Additional CSS)
//
if ( $wp_customize->get_section( 'custom_css' ) ) {
	$wp_customize->get_section( 'custom_css' )->priority = 84;
}