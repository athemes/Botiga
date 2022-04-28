<?php
/**
 * WooCommerce GB Blocks
 *
 * @package Botiga
 */

/**
 * Filter Woocommerce blocks
 * replaces default block product structure to allow theme options
 */
function botiga_filter_woocommerce_blocks( $html, $data, $product ){

	global $post;

	$button_layout 	   = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$layout			   = get_theme_mod( 'shop_product_card_layout', 'layout1' );
	$quick_view_layout = get_theme_mod( 'shop_product_quickview_layout', 'layout1' );
	$wishlist_layout   = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 

	$wc_block_grid_item_class = '';

	//Check for gb option to hide or show add to cart button
	if( strpos( $html, 'wp-block-button' ) === FALSE ) {
		$button_layout = 'layout1';
	}
	
	//Loop image wrapper extra class
	$loop_image_wrap_extra_class = 'botiga-add-to-cart-button-'. $button_layout;
	if( 'layout1' !== $quick_view_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-quick-view-button-'. $quick_view_layout;
	}

	if( 'layout1' !== $wishlist_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-wishlist-button-'. $wishlist_layout;

		$wishlist_icon_show_on_hover = get_theme_mod( 'shop_product_wishlist_show_on_hover', 0 );
		if( $wishlist_icon_show_on_hover ) {
			$wc_block_grid_item_class .= 'botiga-wishlist-show-on-hover';
		}
	}

	$markup = "<li class=\"wc-block-grid__product product-grid $wc_block_grid_item_class\">
				<div class=\"loop-image-wrap $loop_image_wrap_extra_class\">
					<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
						{$data->image}
					</a>";

	// Sale badge
	if( function_exists( 'botiga_sale_badge' ) ) {
		$markup .= botiga_sale_badge( $html = '', $post, $product );
	}

	//Add button inside image wrapper for layout4 and layout3
	if ( 'layout4' === $button_layout || 'layout3' === $button_layout ) {
		$markup .= "<div class=\"loop-button-wrap button-" . esc_attr( $button_layout ) . "\">"
				. botiga_gb_add_to_cart_button( $product ) .
				"</div>";
	}

	//Quick view
	if( function_exists( 'botiga_quick_view_button' ) ) {
		$markup .= botiga_quick_view_button( $product, false );
	}

	//Wishlist
	if( function_exists( 'botiga_wishlist_button' ) ) {
		$markup .= botiga_wishlist_button( $product, false );
	}

	$markup .= "</div>";
	
	if ( 'layout2' === $layout ) {
		$markup .= "<div class=\"row\">
					<div class=\"col-md-7\">";
	}

	$markup .= "<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
					{$data->title}
				</a>";
	
	$markup .= "{$data->rating}";

	if ( 'layout1' === $layout ) {
		$markup .= "{$data->price}";
	} else {
		$markup .= "</div><div class=\"col-md-5 loop-price-inline\">
		{$data->price}
		</div>
		</div>";
	}
		
	//Add button outside image wrapper		
	if ( 'layout1' !== $button_layout && 'layout4' !== $button_layout && 'layout3' !== $button_layout ) {
		$markup .= "<div class=\"loop-button-wrap button-" . esc_attr( $button_layout ) . "\">"
		. botiga_gb_add_to_cart_button( $product ) .
		"</div>";
	}

	$markup .= "</li>";

	return $markup;
}
add_filter( 'woocommerce_blocks_product_grid_item_html', 'botiga_filter_woocommerce_blocks', 10, 3 );

/**
 * Gutenberg blocks add to cart
 * replaces default add to cart block function to allow theme options
 */
function botiga_gb_add_to_cart_button( $product ) { 

	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );

	//Button text
	if ( 'layout4' !== $button_layout ) {
		$text = esc_html( $product->add_to_cart_text() );
	} else {
		if ( $product->is_type( 'simple' ) ) {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i>';
		} else {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-eye', false ) . '</i>';
		}
	}

	//Start markup
	$markup = '<div class="wp-block-button wc-block-grid__product-add-to-cart">';
	
	$attributes = array(
		'aria-label'       => $product->add_to_cart_description(),
		'data-quantity'    => '1',
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'rel'              => 'nofollow',
		'class'            => 'wp-block-button__link add_to_cart_button',
	);

	if (
		$product->supports( 'ajax_add_to_cart' ) &&
		$product->is_purchasable() &&
		( $product->is_in_stock() || $product->backorders_allowed() )
	) {
		$attributes['class'] .= ' ajax_add_to_cart';
	}

	$markup .= sprintf(
		'<a href="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		wc_implode_html_attributes( $attributes ),
		$text
	);	
	
	$markup .= '</div>';

	return $markup;
}