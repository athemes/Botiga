<?php
/**
 * Botiga Woocommerce Block Product Categories
 * Class to handle with default WooCommerce product categories block.
 * 
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Botiga_Woocommerce_Block_Product_Categories {
	
	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		add_filter( 'render_block_woocommerce/product-categories', array( $this, 'render' ), 10, 3 );
		add_filter( 'botiga_wc_block_product_categories_render', array( $this, 'add_active_class' ), 10, 2 );
		add_filter( 'botiga_wc_block_product_categories_render', array( $this, 'filter_items_links' ), 10, 3 );
	}

	/**
	 * Render product categories block.
	 * 
	 * @param string $block_content
	 * @param array $block
	 * @param array $attributes
	 * @return string
	 */
	public function render( $block_content, $block, $attributes ): string {
		if ( is_admin() || wp_is_json_request() ) {
			return $block_content;
		}
	
		global $wp;
		$current_url = trim( $wp->request, '/' );

		/**
		 * Hook 'botiga_wc_block_product_categories_render'
		 * 
		 * @param string $block_content
		 * @param string $current_url
		 * @since 2.2.0
		 */
		return apply_filters( 'botiga_wc_block_product_categories_render', $block_content, $current_url );
	}

	/**
	 * Add active class to the current category.
	 * 
	 * @param string $block_content
	 * @param string $current_url
	 */
	public function add_active_class( $block_content, $current_url ): string {
		$block_content = htmlspecialchars($block_content, ENT_QUOTES, 'UTF-8');

		$dom = new DOMDocument();
		$dom->loadHTML( $block_content );
		$elements = $dom->getElementsByTagName( 'a' );

		if ( $elements->length ) {
			foreach ( $elements as $element ) {
				$href = wp_parse_url( $element->getAttribute( 'href' ) );
				$path = trim( $href['path'], '/' );
	
				if ( $current_url === $path ) {
					$li_class = $element->parentNode->getAttribute( 'class' );
					$li_class .= ' active';
	
					$element->parentNode->setAttribute( 'class', $li_class );
					break;
				}
			}
	
			$block_content = $dom->saveHTML();
		}

		return html_entity_decode( $block_content );
	}

	/**
	 * Filter items links.
	 * 
	 * @param string $block_content
	 * @param string $current_url
	 * @return string
	 */
	public function filter_items_links( $block_content, $current_url ): string {
		global $wp;

		$has_bp_active_filter = strpos( $wp->query_string, 'filter_' ) !== FALSE;

		$block_content = htmlspecialchars($block_content, ENT_QUOTES, 'UTF-8');
		$dom = new DOMDocument();
		$dom->loadHTML( $block_content );
		$elements = $dom->getElementsByTagName( 'a' );

		if ( $elements->length ) {
			foreach ( $elements as $element ) {
				$href = $element->getAttribute( 'href' ) . ( $has_bp_active_filter ? '?' . $wp->query_string : '' );
				$href = remove_query_arg( 'product_cat', $href );

				$element->setAttribute( 'href', $href );
			}
	
			$block_content = $dom->saveHTML();
		}

		return html_entity_decode( $block_content );
	}
}

new Botiga_Woocommerce_Block_Product_Categories();