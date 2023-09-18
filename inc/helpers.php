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
		'product_page'
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
