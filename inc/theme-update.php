<?php
/**
 * Theme update functions
 * 
 * to do: use version compare
 *
 */

/**
 * Migrate woocommerce options
*/
function botiga_migrate_woo_catalog_columns_and_rows() {
    $flag = get_theme_mod( 'botiga_migrate_woo_catalog_columns_and_rows_flag', false );

    if ( true === $flag ) {
        return;
    }

    $woocommerce_catalog_columns = get_option( 'woocommerce_catalog_columns', 4 );
    set_theme_mod( 'shop_woocommerce_catalog_columns_desktop', $woocommerce_catalog_columns );

    $woocommerce_catalog_rows = get_option( 'woocommerce_catalog_rows', 4 );
    set_theme_mod( 'shop_woocommerce_catalog_rows', $woocommerce_catalog_rows );

    //Set flag
    set_theme_mod( 'botiga_migrate_woo_catalog_columns_and_rows_flag', true );
}
add_action( 'init', 'botiga_migrate_woo_catalog_columns_and_rows' );

/**
 * Migrate header options
*/
function botiga_migrate_header_mobile_icons() {
    $flag = get_theme_mod( 'botiga_migrate_header_mobile_icons_flag', false );

    if ( true === $flag ) {
        return;
    }
    
    $default_components = botiga_get_default_header_components();

    $header_components = get_theme_mod( 'header_components', $default_components['l1'] );

    $header_components_mobile = array_map(function ( $value ) {
        return $value === 'woocommerce_icons' ? 'mobile_woocommerce_icons' : $value;
    }, $header_components );
    set_theme_mod( 'header_components_mobile', $header_components_mobile );

    $header_components_offcanvas = array_map(function ( $value ) {
        return $value === 'woocommerce_icons' ? 'mobile_offcanvas_woocommerce_icons' : $value;
    }, $header_components );
    set_theme_mod( 'header_components_offcanvas', $header_components_offcanvas );

    //Set flag
    set_theme_mod( 'botiga_migrate_header_mobile_icons_flag', true );
}
add_action( 'init', 'botiga_migrate_header_mobile_icons' );