<?php
/**
 * WooCommerce Ajax Callbacks
 *
 * @package Botiga
 */

/**
 * Botiga custom add to cart ajax callback
 */
function botiga_custom_addtocart_callback_function(){
	check_ajax_referer( 'botiga-custom-addtocart-nonce', 'nonce' );

	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	WC()->cart->add_to_cart( absint( $_POST['product_id'] ) );

	wp_die();
}
add_action('wp_ajax_botiga_custom_addtocart', 'botiga_custom_addtocart_callback_function');
add_action( 'wp_ajax_nopriv_botiga_custom_addtocart', 'botiga_custom_addtocart_callback_function' );