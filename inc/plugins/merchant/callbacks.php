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

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'payment-logos' );

	echo do_shortcode( '[merchant_module_payment_logos]' );
}

/**
 * Render trust badges.
 * 
 * @return void
 */
function botiga_merchant_trust_badges() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode' );

	echo do_shortcode( '[merchant_module_trust_badges]', 'trust-badges' );
}

/**
 * Render product bundles.
 * 
 * @return void
 */
function botiga_merchant_product_bundles() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode' );

	echo do_shortcode( '[merchant_module_product_bundles]', 'product-bundles' );
}

/**
 * Render buy x get y.
 * 
 * @return void
 */
function botiga_merchant_buy_x_get_y() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'buy-x-get-y' );

	echo do_shortcode( '[merchant_module_buy_x_get_y]' );
}

/**
 * Render volume discounts.
 * 
 * @return void
 */
function botiga_merchant_volume_discounts() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'volume-discounts' );

	echo do_shortcode( '[merchant_module_volume_discounts]' );
}

/**
 * Render wait list.
 * 
 * @return void
 */
function botiga_merchant_wait_list() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'wait-list' );

	echo do_shortcode( '[merchant_module_wait_list]' );
}

/**
 * Render stock scarcity.
 * 
 * @return void
 */
function botiga_merchant_stock_scarcity() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'stock-scarcity' );

	echo do_shortcode( '[merchant_module_stock_scarcity]' );
}

/**
 * Render reasons to buy.
 * 
 * @return void
 */
function botiga_merchant_reasons_to_buy() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'reasons-to-buy' );

	echo do_shortcode( '[merchant_module_reasons_to_buy]' );
}

/**
 * Render product brand image.
 * 
 * @return void
 */
function botiga_merchant_product_brand_image() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'product-brand-image' );

	echo do_shortcode( '[merchant_module_product_brand_image]' );
}

/**
 * Render size chart.
 * 
 * @return void
 */
function botiga_merchant_size_chart() {

	/**
	 * Hook 'botiga_merchant_before_render_shortcode'
	 * Fires before rendering merchant shortcodes.
	 * 
	 * @since 2.2.1
	 */
	do_action( 'botiga_merchant_before_render_shortcode', 'size-chart' );

	echo do_shortcode( '[merchant_module_size_chart]' );
}