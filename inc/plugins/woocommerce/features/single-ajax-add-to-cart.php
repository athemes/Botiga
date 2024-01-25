<?php
/**
 * Single Ajax Add to Cart
 *
 * @package Botiga
 */

/**
 * Enqueue script.
 */
function botiga_single_ajax_add_to_cart_script() {

    if ( ! is_product() ) {
        return;
    }

    $enable = get_theme_mod( 'single_ajax_add_to_cart', 0 );

    if ( empty( $enable ) ) {
        return;
    }

    if ( get_option( 'woocommerce_enable_ajax_add_to_cart' ) !== 'yes' ) {
        return;
    }

    wp_enqueue_script( 'botiga-single-ajax-add-to-cart', get_template_directory_uri() . '/assets/js/botiga-ajax-add-to-cart.min.js', array( 'jquery' ), BOTIGA_VERSION, true );
}
add_action('wp_enqueue_scripts', 'botiga_single_ajax_add_to_cart_script' );

/**
 * Single ajax add to cart handler.
 */
function botiga_single_ajax_add_to_cart() {
    WC_AJAX::get_refreshed_fragments();
}
add_action( 'wc_ajax_botiga_single_ajax_add_to_cart', 'botiga_single_ajax_add_to_cart' );
add_action( 'wc_ajax_nopriv_botiga_single_ajax_add_to_cart', 'botiga_single_ajax_add_to_cart' );

/**
 * Single ajax add to cart to add fragments for notices.
 */
function botiga_single_ajax_add_to_cart_add_fragments( $fragments ) {
    $wc_ajax = ( isset( $_GET['wc-ajax'] ) ) ? sanitize_text_field( wp_unslash( $_GET['wc-ajax'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

    if ( $wc_ajax === 'botiga_single_ajax_add_to_cart' ) {
        $notices = wc_get_notices();
        if ( ! empty( $notices ) ) {
            ob_start();
            foreach ( $notices as $notice_type => $notice_data ) {
                wc_get_template( 'notices/'. $notice_type .'.php', array( 'notices' => array_filter( $notices[ $notice_type ] ) ) );
            }
            $fragments['notices'] = ob_get_clean();
            wc_clear_notices();
        }
    }

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'botiga_single_ajax_add_to_cart_add_fragments' );
