<?php
/**
 * Elementor Pro Widgets Compatibility Class
 *
 * @package Botiga
 */

class Botiga_Elementor_Pro_Widgets_Compatibility {

	/**
	 * Widgets to check.
	 * 
	 */
	public $widgets_styles = array(
		'woocommerce-product-images' => '.elementor-widget-woocommerce-product-images .flex-viewport + .flex-control-nav { margin-top: 25px !important; } .elementor-widget-woocommerce-product-images .woocommerce-product-gallery > .woocommerce-product-gallery__wrapper { display: flex; flex-wrap: wrap; gap: 25px; }',
		'woocommerce-product-add-to-cart' => '.elementor-widget-woocommerce-product-add-to-cart:not(.elementor-add-to-cart--layout-stacked):not(.elementor-add-to-cart--layout-auto) .botiga-single-addtocart-wrapper { display: flex; flex-wrap: wrap; width: 100%; gap: var( --button-spacing, 20px ); } .elementor-widget-woocommerce-product-add-to-cart:not(.elementor-add-to-cart--layout-stacked):not(.elementor-add-to-cart--layout-auto) .button { margin-left: 0 !important; } .elementor-widget-woocommerce-product-add-to-cart:not(.elementor-add-to-cart--layout-stacked):not(.elementor-add-to-cart--layout-auto) .single_add_to_cart_button { flex: 1; min-width: fit-content; }',
		'woocommerce-product-price' => '.elementor-widget-woocommerce-product-price .price { margin-bottom: 0; }',
		'woocommerce-product-rating' => '.elementor-widget-woocommerce-product-rating .woocommerce-product-rating { margin: 0; }',
		'woocommerce-product-short-description' => '.elementor-widget-woocommerce-product-short-description .woocommerce-product-details__short-description p:last-of-type { margin-bottom: 0; }',
		'woocommerce-product-data-tabs' => '.elementor-widget-woocommerce-product-data-tabs .woocommerce-tabs { margin-top: 0; margin-bottom: 0; }',
		'woocommerce-product-related' => '.elementor-widget-woocommerce-product-related .related.products { padding-top: 0; padding-bottom: 0; } .elementor-widget-woocommerce-product-related .related.products>.products { border-top: none; padding-top: 0; } .elementor-widget-woocommerce-product-related .woocommerce-loop-product__title .botiga-wc-loop-product__title { color: inherit; }',
		'woocommerce-product-additional-information' => '.elementor-widget-woocommerce-product-additional-information table { margin: 0; }',
	);

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		add_filter( 'elementor/widget/render_content', array( $this, 'prepend_custom_style_to_widget' ), 10, 2 );
	}

	/**
	 * Prepend custom style to specific widgets.
	 * 
	 * @param object $widget
	 * @param string $content
	 */
	public function prepend_custom_style_to_widget( $content, $widget ) {
		foreach( $this->widgets_styles as $widget_name => $style ) {
			if ( $widget->get_name() === $widget_name ) {
				$content = '<style>' . $style . '</style>' . $content;
			}
		}

		return $content;
	}
}

new Botiga_Elementor_Pro_Widgets_Compatibility();