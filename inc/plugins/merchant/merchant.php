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

/**
 * Disable Merchant modules if Botiga customizer options are active.
 * 
 */
$customize_options = array(
	'single_recently_viewed_products' => 'recently-viewed-products'
);
	
$overlaping_features = array_map( function( $theme_mod, $mmodule_id ) {
	return get_theme_mod( $theme_mod ) ? $mmodule_id : false;
}, array_keys( $customize_options ), $customize_options );

foreach( $overlaping_features as $mmodule_id ) {
	if ( $mmodule_id ) {
		add_filter( "merchant_module_{$mmodule_id}_deactivate", function() {
			return true;
		} );
	}
}
