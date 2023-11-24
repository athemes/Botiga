<?php
/**
 * WC Germanized Compatibility File
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Botiga_Woocommerce_Germanized_Compatibility {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        $this->single_product();
    }

    /**
     * Single Product.
     * 
     */
    public function single_product() {
        add_action( 'wp', function() {
            if ( ! is_singular( 'product' ) ) {
                return;
            }

            Botiga_Woocommerce_Germanized_Single_Product::remove_plugin_actions();
        } );
        
        add_filter( 'botiga_default_single_product_components', array( 'Botiga_Woocommerce_Germanized_Single_Product', 'customizer_components' ) );
        add_filter( 'botiga_single_product_elements', array( 'Botiga_Woocommerce_Germanized_Single_Product', 'customizer_elements' ) );
    }
}

require get_template_directory() . '/inc/plugins/wc-germanized/class-wc-germanized-single-product.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
new Botiga_Woocommerce_Germanized_Compatibility();
