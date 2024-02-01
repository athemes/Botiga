<?php
/**
 * Elementor Pro Widgets Compatibility Class
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Elementor_Pro_Widgets_Compatibility {

	/**
	 * Elementor Pro widgets styles to append.
	 * 
	 */
	public $widgets_styles = array(
		// Shop Archive.
		'wc-archive-products' => '
			.elementor-widget-wc-archive-products .woocommerce-loop-product__title .botiga-wc-loop-product__title { 
				color: inherit; 
			}
		',

		// Single Product.
		'woocommerce-product-images' => '
			.elementor-widget-woocommerce-product-images .gallery-vertical, 
			.elementor-widget-woocommerce-product-images .gallery-showcase { 
				gap: 20px; 
			} 
			.elementor-widget-woocommerce-product-images .product-gallery-summary.gallery-showcase, 
			.elementor-widget-woocommerce-product-images .product-gallery-summary.gallery-full-width { 
				margin-top: 0; 
			} 
			.elementor-widget-woocommerce-product-images .product-gallery-summary.gallery-showcase:before, 
			.elementor-widget-woocommerce-product-images .product-gallery-summary.gallery-full-width:before { 
				background-color: transparent; 
			}
		',
		'woocommerce-product-add-to-cart' => '
			.elementor-widget-woocommerce-product-add-to-cart:not(.elementor-add-to-cart--layout-stacked):not(.elementor-add-to-cart--layout-auto) .botiga-single-addtocart-wrapper {
				display: flex; flex-wrap: wrap; width: 100%; gap: var( --button-spacing, 20px ); 
			} 
			.elementor-widget-woocommerce-product-add-to-cart:not(.elementor-add-to-cart--layout-stacked):not(.elementor-add-to-cart--layout-auto) .button { 
				margin-left: 0 !important; 
			} 
			.elementor-widget-woocommerce-product-add-to-cart:not(.elementor-add-to-cart--layout-stacked):not(.elementor-add-to-cart--layout-auto) .single_add_to_cart_button { 
				flex: 1; min-width: fit-content; 
			}
		',
		'woocommerce-product-price' => '
			.elementor-widget-woocommerce-product-price .price { 
				margin-bottom: 0; 
			}
		',
		'woocommerce-product-rating' => '
			.elementor-widget-woocommerce-product-rating .woocommerce-product-rating { 
				margin: 0; 
			}
		',
		'woocommerce-product-short-description' => '
			.elementor-widget-woocommerce-product-short-description .woocommerce-product-details__short-description p:last-of-type { 
				margin-bottom: 0; 
			}
		',
		'woocommerce-product-data-tabs' => '
			.elementor-widget-woocommerce-product-data-tabs .woocommerce-tabs { 
				margin-top: 0; margin-bottom: 0; 
			}
		',
		'woocommerce-product-related' => '
			.elementor-widget-woocommerce-product-related .related.products { 
				padding-top: 0; padding-bottom: 0; 
			} 
			.elementor-widget-woocommerce-product-related .related.products>.products { 
				border-top: none; padding-top: 0; 
			} 
			.elementor-widget-woocommerce-product-related .woocommerce-loop-product__title .botiga-wc-loop-product__title { 
				color: inherit; 
			}
		',
		'woocommerce-product-additional-information' => '
			.elementor-widget-woocommerce-product-additional-information table { 
				margin: 0; 
			}
		',
		'woocommerce-breadcrumb' => '
			.elementor-widget-woocommerce-breadcrumb .woocommerce-breadcrumb { 
				margin-bottom: 0; 
			}
		',
	);

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		add_filter( 'elementor/widget/render_content', array( $this, 'prepend_custom_style_to_widget' ), 10, 2 );
		add_filter( 'elementor/widget/render_content', array( $this, 'replace_product_gallery_wrapper_class' ), 10, 2 );
	}

	/**
	 * Prepend custom style to specific widgets.
	 * 
	 * @param object $widget
	 * @param string $content
	 * 
	 * @return string
	 */
	public function prepend_custom_style_to_widget( $content, $widget ) {
		/**
		 * Hook 'botiga_elementor_pro_widgets_styles'
		 * 
		 * @since 2.2.0
		 */
		$widgets_styles = apply_filters( 'botiga_elementor_pro_widgets_styles', $this->widgets_styles );

		foreach( $widgets_styles as $widget_name => $style ) {
			if ( $widget->get_name() === $widget_name ) {
				$style = preg_replace( '/\s+/', ' ', $style );
				$content = '<style>' . $style . '</style>' . $content;
			}
		}

		return $content;
	}

	/**
	 * Replace product gallery wrapper class.
	 * 
	 * @param string $content
	 * @param object $widget
	 * 
	 * @return string
	 */
	public function replace_product_gallery_wrapper_class( $content, $widget ) {
		if ( 'woocommerce-product-images' === $widget->get_name() ) {
			$gallery_layout       = get_theme_mod( 'single_product_gallery', 'gallery-default' );
			$gallery_slider_class = get_theme_mod( 'single_gallery_slider', 1 ) ? 'has-thumbs-slider' : 'has-thumbs-grid';

			$content = preg_replace( '/class="woocommerce-product-gallery/', "class=\"woocommerce-product-gallery product-gallery-summary $gallery_layout $gallery_slider_class", $content, 1 );
		}

		return $content;
	}
}

new Botiga_Elementor_Pro_Widgets_Compatibility();