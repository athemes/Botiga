<?php
/**
 * Sale Badge
 *
 * @package Botiga
 */

/**
 * Sale badge text
 */
function botiga_sale_badge( $html, $post, $product ) {

	if ( !$product->is_on_sale() ) {
		return;
	}	

	$text 			= get_theme_mod( 'sale_badge_text', esc_html__( 'Sale!', 'botiga' ) );
	$enable_perc 	= get_theme_mod( 'sale_badge_percent', 0 );
	$perc_text 		= get_theme_mod( 'sale_percentage_text', '-{value}%' );

	if ( !$enable_perc ) {
		$badge = '<span class="onsale">' . esc_html( $text ) . '</span>';
	} else {
		if ( $product->is_type('variable' ) ) {
			$percentages = array();
			$prices = $product->get_variation_prices();
	  
			foreach( $prices['price'] as $key => $price ){
				if( $prices['regular_price'][$key] !== $price ){
					$percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
				}
			}
			$percentage = max( $percentages );
	  
		} elseif ( $product->is_type('grouped') ) {
			$percentages 	= array();
			$children_ids 	= $product->get_children();
	  
			foreach ( $children_ids as $child_id ) {
				$child_product = wc_get_product($child_id);
	  
				$regular_price = (float) $child_product->get_regular_price();
				$sale_price    = (float) $child_product->get_sale_price();
	  
				if ( $sale_price != 0 || ! empty($sale_price) ) {
					$percentages[] = round(100 - ($sale_price / $regular_price * 100));
				}
			}
			$percentage = max($percentages) ;
		} else {
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();
	  
			if ( $sale_price != 0 || ! empty($sale_price) ) {
				$percentage = round(100 - ($sale_price / $regular_price * 100) );
			} else {
				return $html;
			}
		}

		$perc_text = str_replace( '{value}', $percentage, $perc_text );

		$badge = '<span class="onsale">' . esc_html( $perc_text ) . '</span>';

	}
	
	return $badge;
}
add_filter( 'woocommerce_sale_flash', 'botiga_sale_badge', 10, 3 );