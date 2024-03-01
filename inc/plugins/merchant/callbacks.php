<?php
/**
 * Botiga Merchant Callbacks
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Render payment logos.
 * 
 * @return void
 */
function botiga_merchant_payment_logos() {
	echo do_shortcode( '[merchant_module_payment_logos]' );
}

/**
 * Render trust badges.
 * 
 * @return void
 */
function botiga_merchant_trust_badges() {
	echo do_shortcode( '[merchant_module_trust_badges]', 'trust-badges' );
}

/**
 * Render product bundles.
 * 
 * @return void
 */
function botiga_merchant_product_bundles() {
	echo do_shortcode( '[merchant_module_product_bundles]', 'product-bundles' );
}

/**
 * Render buy x get y.
 * 
 * @return void
 */
function botiga_merchant_buy_x_get_y() {
	echo do_shortcode( '[merchant_module_buy_x_get_y]' );
}

/**
 * Render volume discounts.
 * 
 * @return void
 */
function botiga_merchant_volume_discounts() {
	echo do_shortcode( '[merchant_module_volume_discounts]' );
}

/**
 * Render wait list.
 * 
 * @return void
 */
function botiga_merchant_wait_list() {
	echo do_shortcode( '[merchant_module_wait_list]' );
}

/**
 * Render stock scarcity.
 * 
 * @return void
 */
function botiga_merchant_stock_scarcity() {
	echo do_shortcode( '[merchant_module_stock_scarcity]' );
}

/**
 * Render reasons to buy.
 * 
 * @return void
 */
function botiga_merchant_reasons_to_buy() {
	echo do_shortcode( '[merchant_module_reasons_to_buy]' );
}

/**
 * Render product brand image.
 * 
 * @return void
 */
function botiga_merchant_product_brand_image() {
	echo do_shortcode( '[merchant_module_product_brand_image]' );
}

/**
 * Render size chart.
 * 
 * @return void
 */
function botiga_merchant_size_chart() {
	echo do_shortcode( '[merchant_module_size_chart]' );
}