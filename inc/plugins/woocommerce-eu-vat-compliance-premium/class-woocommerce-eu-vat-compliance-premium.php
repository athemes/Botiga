<?php
/**
 * WC EU VAT Compilance (Premium)
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Woocommerce_Eu_Vat_Compilance_Compatibility {
	
	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		add_action( 'botiga_checkout_after_billing_fields', array( $this, 'get_vat_number_field' ) );
	}

	/**
	 * Get VAT Number Field.
	 * 
	 */
	public function get_vat_number_field() {
		$shortcode_checkout = new WC_VAT_Compliance_Shortcode_Checkout( new WC_EU_VAT_Compliance_VAT_Number() );
		$shortcode_checkout->vat_number_field();
	}
}

new Botiga_Woocommerce_Eu_Vat_Compilance_Compatibility();
