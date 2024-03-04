<?php
/**
 * Merchant Compatibility File
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Merchant' ) ) {
	return;
}

class Botiga_Merchant_Overlaping_Features {

	/**
	 * Overlaping modules.
	 * 
	 */
	public $overlaping_modules = array(
		'size-chart',
		'sticky-add-to-cart',
		'advanced-reviews',
		'buy-now',
		'video-gallery',
		'wishlist',
		'product-swatches',
		'quick-links',
		'google-autocomplete',
	);

	/**
	 * Modules map.
	 * Some modules have different id's, so we need to map them.
	 * 
	 */
	public $modules_map = array(
		'size-chart' => 'size-chart',
		'sticky-add-to-cart' => 'sticky-add-to-cart',
		'advanced-reviews' => 'advanced-reviews',
		'buy-now' => 'buy-now',
		'video-gallery' => array( 'product-video', 'product-audio' ),
		'wishlist' => 'wishlist',
		'product-swatches' => 'product-swatches',
		'quick-links' => 'quick-social-links',
		'google-autocomplete' => 'address-autocomplete',
	);

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		$this->disable_modules_by_customizer_settings();
		$this->disable_modules_by_botiga_modules();
	}

	/**
	 * Get customizer overlaping features.
	 * 
	 * @param array $required_opts_to_disable_merchant_modules Required options to disable merchant modules.
	 * @return array $overlaping_features Overlaping features.
	 */
	public function get_customizer_overlaping_features( $required_opts_to_disable_merchant_modules ) {
		return array_map( function( $mmodule_id, $theme_mod ) {
			if ( ! is_array( $theme_mod[ 'mod_value' ] ) ) {
				return get_theme_mod( $theme_mod[ 'mod_name' ], $theme_mod[ 'mod_default' ] ) !== $theme_mod[ 'mod_value' ] ? $mmodule_id : false;
			} elseif( ! is_array( get_theme_mod( $theme_mod[ 'mod_name' ], $theme_mod[ 'mod_default' ] ) ) ) {
				return ! in_array( get_theme_mod( $theme_mod[ 'mod_name' ], $theme_mod[ 'mod_default' ] ), $theme_mod[ 'mod_value' ] ) ? $mmodule_id : false;
			} else {
				return array_intersect( get_theme_mod( $theme_mod[ 'mod_name' ], $theme_mod[ 'mod_default' ] ), $theme_mod[ 'mod_value' ] ) ? $mmodule_id : false;
			}
		}, array_keys( $required_opts_to_disable_merchant_modules ), $required_opts_to_disable_merchant_modules );
	}

	/**
	 * Disable modules by customizer settings.
	 * 
	 * @return void
	 */
	public function disable_modules_by_customizer_settings() {
		$default_single_product_components = function_exists( 'botiga_get_default_single_product_components' ) ? botiga_get_default_single_product_components() : array();

		$required_opts_to_disable_merchant_modules = array(
			'recently-viewed-products' => array(
				'mod_name'    => 'single_recently_viewed_products',
				'mod_value'   => 0,
				'mod_default' => 0,
			),
			'quick-view' => array(
				'mod_name'    => 'shop_product_quickview_layout',
				'mod_value'   => 'layout1',
				'mod_default' => 'layout1',
			),
			'checkout' => array(
				'mod_name'    => 'shop_checkout_layout',
				'mod_value'   => array( 'layout1', 'layout2' ),
				'mod_default' => 'layout1',
			),
			'floating-mini-cart' => array(
				'mod_name'    => 'side_mini_cart_floating_icon',
				'mod_value'   => 0,
				'mod_default' => 0,
			),
			'side-cart' => array(
				'mod_name'    => 'mini_cart_style',
				'mod_value'   => 'default',
				'mod_default' => 'default',
			),
			'reasons-to-buy' => array(
				'mod_name'    => 'single_product_elements_order',
				'mod_value'   => array( 'botiga_single_product_reasons_to_buy' ),
				'mod_default' => $default_single_product_components,
			),
			'product-brand-image' => array(
				'mod_name'    => 'single_product_elements_order',
				'mod_value'   => array( 'botiga_single_product_brand_image' ),
				'mod_default' => $default_single_product_components,
			),
			'trust-badges' => array(
				'mod_name'    => 'single_product_elements_order',
				'mod_value'   => array( 'botiga_single_product_trust_badge_image' ),
				'mod_default' => $default_single_product_components,
			),
			'real-time-search' => array(
				'mod_name'    => 'shop_search_enable_ajax',
				'mod_value'   => 0,
				'mod_default' => 0,
			),
			'scroll-to-top-button' => array(
				'mod_name'    => 'enable_scrolltop',
				'mod_value'   => '',
				'mod_default' => 1,
			),
		);

		$overlaping_features = self::get_customizer_overlaping_features( $required_opts_to_disable_merchant_modules );
		foreach( $overlaping_features as $mmodule_id ) {
			if ( $mmodule_id ) {
				add_filter( "merchant_module_{$mmodule_id}_deactivate", function() {
					return true;
				} );
			}
		}
	}

	/**
	 * Disable merchant modules by checking for Botiga modules.
	 * 
	 * @return void
	 */
	public function disable_modules_by_botiga_modules() {
		$botiga_modules = get_option( 'botiga-modules' );
		$botiga_modules = ( is_array( $botiga_modules ) ) ? $botiga_modules : (array) $botiga_modules;

		foreach( $this->overlaping_modules as $module ) {
			if ( in_array( $module, $botiga_modules ) && isset( $botiga_modules[ $module ] ) && $botiga_modules[ $module ] ) {
				if ( is_array( $this->modules_map[$module] ) ) {
					foreach( $this->modules_map[$module] as $mmodule_id ) {
						add_filter( "merchant_module_{$mmodule_id}_deactivate", function() {
							return true;
						} );
					}
				} else {
					add_filter( "merchant_module_{$this->modules_map[$module]}_deactivate", function() {
						return true;
					} );
				}
			}
		}
	}
}

new Botiga_Merchant_Overlaping_Features();
