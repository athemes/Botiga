<?php
/**
 * Dokan Compatibility File
 *
 * @package Botiga
 */

/**
 * Dequeue dokan scripts and styles on pages where it's not needed
 */
function botiga_dokan_dequeue_scripts() {
    if( dokan_is_store_page() || dokan_is_store_listing() || dokan_is_seller_dashboard() || is_account_page() ) {
        return false;
    }
    
    wp_dequeue_style( 'dokan-style' );
    wp_dequeue_style( 'dokan-fontawesome' );
    
    wp_dequeue_script( 'dokan-popup' );
    wp_dequeue_script( 'dokan-i18n-jed' );
    wp_dequeue_script( 'dokan-sweetalert2' );
    wp_dequeue_script( 'dokan-util-helper' );
    wp_dequeue_script( 'dokan-login-form-popup' );
}
add_action( 'wp_enqueue_scripts', 'botiga_dokan_dequeue_scripts', 12 );

/**
 * Enqueue scripts and styles.
 */
function botiga_dokan_enqueue_scripts() {
    if( ! dokan_is_store_page() && ! dokan_is_store_listing() && ! dokan_is_seller_dashboard() && ! is_account_page() ) {
        return false;
    }
    wp_enqueue_style( 'botiga-dokan', get_template_directory_uri() . '/assets/css/dokan.min.css', array(), BOTIGA_VERSION );
}
add_action( 'wp_enqueue_scripts', 'botiga_dokan_enqueue_scripts', 12 );

/**
 * Identify dokan store list page
 */
function botiga_dokan_body_class( $classes ) {
    if( dokan_is_store_listing() ) {
        $classes[] = 'is-dokan-store-listing';
    }

    return $classes;
}
add_filter( 'body_class', 'botiga_dokan_body_class' );