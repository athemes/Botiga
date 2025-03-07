<?php
/**
 * Merchant Compatibility File for the Side Cart module.
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Merchant_Side_Cart_Compatibility {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        add_action( 'merchant_before_mini_cart', array( $this, 'remove_mini_cart_quantity' ) );
    }

    /**
     * Remove the mini cart quantity.
     * 
     * @return void
     */
    public function remove_mini_cart_quantity() {
        remove_filter( 'woocommerce_widget_cart_item_quantity', 'botiga_mini_cart_quantity', 10 );
    }
}

new Botiga_Merchant_Side_Cart_Compatibility();