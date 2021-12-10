<?php
/**
 * Upsell Products
 *
 * @package Botiga
 */

/**
 * Hooks 
 */
function botiga_upsell_products_hooks() {
    $single_upsell = get_theme_mod( 'single_upsell_products', 1 );

    //Upsell products
    if ( !$single_upsell ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
    }	
    add_filter( 'woocommerce_upsells_columns', function() { return 3; } );
    add_filter( 'woocommerce_upsells_total', function() { return -1; } );
}
add_action( 'wp', 'botiga_upsell_products_hooks' );