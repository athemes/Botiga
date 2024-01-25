<?php

/**
 * Helper functions.
 * 
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if the current page has a WooCommerce shortcode.
 *
 * @param object $post
 * @return bool
 */
function botiga_post_content_has_woo_shortcode() {
	global $post;

	if ( empty( $post ) || ! is_page() && ! is_singular( 'post' ) ) {
		return false;
	}

	$shortcodes = array(
		'products',
		'product_page',
	);

	if ( isset( $post->post_content ) ) {
		foreach ( $shortcodes as $shortcode ) {
			if ( has_shortcode( $post->post_content, $shortcode ) ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Check if the current page has a WooCommerce block.
 *
 * @param object $post
 * @return bool
 */
function botiga_post_content_has_woo_blocks() {
	global $post;

	if ( empty( $post ) || ! is_page() && ! is_singular( 'post' ) ) {
		return false;
	}

	if ( isset( $post->post_content ) && strpos( $post->post_content, 'woocommerce/' ) ) {
		return true;
	}

	return false;
}

/**
 * Check if WooCommerce checkout page is being rendered by block.
 * Since WooCommerce 8.3.0 the checkout page is rendered by block.
 * 
 * @return bool
 */
function botiga_is_checkout_block_layout() {
	$checkout_page = wc_get_page_id( 'checkout' );

	if ( empty( $checkout_page ) ) {
		return false;
	}

	if ( function_exists( 'has_blocks' ) && has_blocks( $checkout_page ) ) {
		$post   = get_post( $checkout_page );
		$blocks = parse_blocks( $post->post_content );

		foreach ( $blocks as $block ) {
			if ( 'woocommerce/checkout' === $block['blockName'] ) {
				return true;
			}
		}
	}

	return false;
}

/**
 * Check if WooCommerce cart page is being rendered by block.
 * Since WooCommerce 8.3.0 the cart page is rendered by block.
 * 
 * @return bool
 */
function botiga_is_cart_block_layout() {
	$cart_page = wc_get_page_id( 'cart' );

	if ( empty( $cart_page ) ) {
		return false;
	}

	if ( function_exists( 'has_blocks' ) && has_blocks( $cart_page ) ) {
		$post   = get_post( $cart_page );
		$blocks = parse_blocks( $post->post_content );

		foreach ( $blocks as $block ) {
			if ( 'woocommerce/cart' === $block['blockName'] ) {
				return true;
			}
		}
	}

	return false;
}
