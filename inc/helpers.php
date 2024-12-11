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
 * Get the page builder mode.
 * 
 * @return string
 */
function botiga_get_page_builder_mode() {
	global $post;

	if ( empty( $post ) ) {
		return;
	}

	$page_builder_mode = get_post_meta( $post->ID, '_botiga_page_builder_mode', true );

	/**
	 * Hook 'botiga_page_builder_mode'
	 * Filters the page builder mode.
	 * 
	 * @since 2.2.10
	 */
	return apply_filters( 'botiga_page_builder_mode', $page_builder_mode, $post );
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

/**
 * Check whether a page is loaded via any builder. 
 * e.g. Elementor Pro Theme Builder, Botiga Pro Templates Builder, etc.
 * 
 * @return bool
 */
function botiga_is_page_loaded_by_builders() {
	if ( 
		class_exists( 'Botiga_Elementor_Helpers' ) && 
		Botiga_Elementor_Helpers::is_page_loaded_by_elementor_theme_builder() 
	) {
		return true;
	}
	
	if ( 
		class_exists( 'BotigaPro\Modules\TemplatesBuilder\Frontend\Utils' ) && 
		BotigaPro\Modules\TemplatesBuilder\Frontend\Utils::is_page_loaded_by_templates_builder() 
	) {
		return true;
	}

	return false;
}

/**
 * Get Botiga first theme version.
 * Returns from the database a string if the first theme version is set, otherwise returns false.
 * 
 * @return string|bool
 */
function botiga_get_first_theme_version() {
	return get_option( 'botiga-first-theme-version' ) ? get_option( 'botiga-first-theme-version' ) : false;
}