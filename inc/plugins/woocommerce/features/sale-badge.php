<?php
/**
 * Sale Badge
 *
 * @package Botiga
 */

/**
 * Sale badge text
 * 
 * @param string $html    The badge html.
 * @param object $post    The post object.
 * @param object $product The product object.
 * 
 * @return string
 */
function botiga_sale_badge( $html, $post, $product ) {
	if ( !$product->is_on_sale() ) {
		return;
	}   

	$text           = get_theme_mod( 'sale_badge_text', esc_html__( 'Sale!', 'botiga' ) );
	$enable_perc    = get_theme_mod( 'sale_badge_percent', 0 );
	$perc_text      = get_theme_mod( 'sale_percentage_text', '-{value}%' );

	if ( !$enable_perc ) {
		$badge = '<span class="onsale">' . esc_html( $text ) . '</span>';
	} else {
		$sale_data = botiga_get_product_sale_data( $product );

		$sale_percentage = ! empty( $sale_data['percentage'] ) ? $sale_data['percentage'] : '';

		$perc_text = str_replace( '{value}', $sale_percentage, $perc_text );

		$badge = '<span class="onsale">' . esc_html( $perc_text ) . '</span>';
	}
	
	return $badge;
}
add_filter( 'woocommerce_sale_flash', 'botiga_sale_badge', 10, 3 );

/**
 * Get the sale data.
 * 
 * @param WC_Product $product The product object.
 * @param array      $label   The label data.
 * 
 * @return array
 */
function botiga_get_product_sale_data( $product ) {
	$sale_data = array();

	if ( $product->is_type( 'variable' ) ) {
		$regular_price = (float) $product->get_variation_regular_price( 'min' );
		$sale_price    = (float) $product->get_variation_sale_price( 'min' );

		if ( 0 !== $sale_price || ! empty( $sale_price ) ) {
			$sale_data['amount']     = $regular_price - $sale_price;
			$sale_data['percentage'] = $regular_price ? round( 100 - ( $sale_price / $regular_price * 100 ) ) : 0;
		}
	} elseif ( $product->is_type( 'grouped' ) ) {
		$children_ids = $product->get_children();

		$total_regular_price = 0;
		$total_sale_price    = 0;

		foreach ( $children_ids as $child_id ) {
			$child_product = wc_get_product( $child_id );

			$regular_price = (float) $child_product->get_regular_price();
			$sale_price    = (float) $child_product->get_sale_price();

			if ( $child_product->is_type( 'variable' ) ) {
				$regular_price = (float) $child_product->get_variation_regular_price( 'min' );
				$sale_price    = (float) $child_product->get_variation_sale_price( 'min' );
			}

			$total_regular_price += $regular_price;
			$total_sale_price    += ! empty( $sale_price ) ? $sale_price : $regular_price;
		}

		if ( 0 !== $total_sale_price || ! empty( $total_sale_price ) ) {
			$sale_data['amount']     = $total_regular_price - $total_sale_price;
			$sale_data['percentage'] = $total_regular_price ? round( 100 - ( ( $total_sale_price / $total_regular_price ) * 100 ) ) : 0;
		}
	} else {
		$regular_price = (float) $product->get_regular_price();
		$sale_price    = (float) $product->get_sale_price();

		if ( 0 !== $sale_price || ! empty( $sale_price ) ) {
			$sale_data['amount']     = $regular_price - $sale_price;
			$sale_data['percentage'] = $regular_price ? round( 100 - ( ( $sale_price / $regular_price ) * 100 ) ) : 0;
		}
	}

	/**
	 * Filter the product sale data.
	 *
	 * @param array      $sale_data  The sale data.
	 * @param WC_Product $product    The product object.
	 *
	 * @since 2.2.15
	 */
	return apply_filters( 'botiga_product_sale_data', $sale_data, $product );
}
