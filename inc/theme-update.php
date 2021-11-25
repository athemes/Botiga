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
function botiga_migrate_woo_catalog_columns() {
    $flag = get_theme_mod( 'botiga_migrate_woo_catalog_columns_flag', false );

    if ( true === $flag ) {
        return;
    }

    $woocommerce_catalog_columns = get_option( 'woocommerce_catalog_columns', 4 );
    set_theme_mod( 'shop_woocommerce_catalog_columns_desktop', $woocommerce_catalog_columns );

    //Set flag
    set_theme_mod( 'botiga_migrate_woo_catalog_columns_flag', true );
}
add_action( 'init', 'botiga_migrate_woo_catalog_columns' );