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

	$button_layout            = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$layout                   = get_theme_mod( 'shop_product_card_layout', 'layout1' );
	$quick_view_layout        = get_theme_mod( 'shop_product_quickview_layout', 'layout1' );
	$wishlist_layout          = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );
	$wishlist_enable          = Botiga_Modules::is_module_active( 'wishlist' );
	$shop_product_quantity    = get_theme_mod( 'shop_product_quantity', 0 );
	$button_width             = get_theme_mod( 'shop_product_add_to_cart_button_width', 'auto' ) === 'auto' ? 'button-width-auto' : 'button-width-full';
	$button_with_quantity     = '';
	$wc_block_grid_item_class = array();

	if ( $shop_product_quantity && in_array( $button_layout, array( 'layout2', 'layout3', 'layout4' ) ) ) {
		if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
			$button_with_quantity = ' button-with-quantity';
		}
	}

	//Check for gb option to hide or show add to cart button
	if( strpos( $html, 'wp-block-button' ) === FALSE ) {
		$button_layout = 'layout1';
	}
	
	//Loop image wrapper extra class
	$loop_image_wrap_extra_class = 'botiga-add-to-cart-button-'. $button_layout;
	if( 'layout1' !== $quick_view_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-quick-view-button-'. $quick_view_layout;
	}

	if( $wishlist_enable && 'layout1' !== $wishlist_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-wishlist-button-'. $wishlist_layout;

		$wishlist_icon_show_on_hover = get_theme_mod( 'shop_product_wishlist_show_on_hover', 0 );
		if( $wishlist_icon_show_on_hover ) {
			$wc_block_grid_item_class[] = 'botiga-wishlist-show-on-hover';
		}
	}

	$wc_block_grid_item_class = implode( ' ', apply_filters( 'botiga_wc_block_grid_item_class', $wc_block_grid_item_class, $product ) );

	$markup = "<li class=\"wc-block-grid__product product-grid $wc_block_grid_item_class\">
				<div class=\"loop-image-wrap ". apply_filters( 'botiga_wc_block_product_loop_image_wrap_extra_class', $loop_image_wrap_extra_class ) ."\">
					<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
						". apply_filters( 'botiga_wc_block_product_loop_image_wrap_image_output', $data->image, $product ) ."
					</a>";

	// Sale badge
	if( function_exists( 'botiga_sale_badge' ) ) {
		$markup .= botiga_sale_badge( $html = '', $post, $product );
	}

	//Add button inside image wrapper for layout4 and layout3
	if ( 'layout4' === $button_layout || 'layout3' === $button_layout ) {
		$loop_button_wrapper_classes = apply_filters( 'botiga_loop_button_wrap_classes', array( 'loop-button-wrap', $button_width, 'button-' . $button_layout, $button_with_quantity ) );
		$button_wrapper_open = $button_layout !== 'layout3' ? '<div class="wp-block-button wc-block-grid__product-add-to-cart"><div class="'. esc_attr( implode( ' ', $loop_button_wrapper_classes ) ) .'">' : '<div class="'. esc_attr( implode( ' ', $loop_button_wrapper_classes ) ) .'">';
		$button_wrapper_close = $button_layout !== 'layout3' ? '</div></div>' : '</div>';

		$markup .= $button_wrapper_open . botiga_gb_add_to_cart_button( $product ) . $button_wrapper_close;
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
		$loop_button_wrapper_classes = apply_filters( 'botiga_loop_button_wrap_classes', array( 'loop-button-wrap', $button_width, 'button-' . $button_layout, $button_with_quantity ) );

		$markup .= '<div class="wp-block-button wc-block-grid__product-add-to-cart">';
			$markup .= '<div class="'. esc_attr( implode( ' ', $loop_button_wrapper_classes ) ) .'">';
				$markup .= botiga_gb_add_to_cart_button( $product );
			$markup .= '</div>';
		$markup .= '</div>';
	}

	$enable_product_swatch = Botiga_Modules::is_module_active( 'product-swatches' );
	$enable_product_swatch_on_shop_catalog = get_theme_mod( 'product_swatch_on_shop_catalog', 0 );

	if (
		( $button_layout === 'layout3' || $button_layout === 'layout4' ) &&
		( $enable_product_swatch && $enable_product_swatch_on_shop_catalog && class_exists( 'Botiga_Product_Swatch' ) )
	) {

		ob_start();
			Botiga_Product_Swatch::product_swatch_on_shop_catalog();
		$markup .= ob_get_clean();

	}

	$markup .= apply_filters( 'botiga_after_shop_loop_item_inside_wc_block', '', $product );

	$markup .= "</li>";

	return $markup;
}
add_filter( 'woocommerce_blocks_product_grid_item_html', 'botiga_filter_woocommerce_blocks', 10, 3 );

/**
 * Gutenberg blocks add to cart
 * replaces default add to cart block function to allow theme options
 */
function botiga_gb_add_to_cart_button( $_product ) {

	global $product;

	$product = $_product; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );

	//Button text
	if ( 'layout4' !== $button_layout ) {
		$text = esc_html( $_product->add_to_cart_text() );
	} else {
		if ( $_product->is_type( 'simple' ) ) {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i>';
		} else {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-eye', false ) . '</i>';
		}
	}

	//Start markup
	$markup = '';

	$enable_product_swatch = Botiga_Modules::is_module_active( 'product-swatches' );
	$enable_product_swatch_on_shop_catalog = get_theme_mod( 'product_swatch_on_shop_catalog', 0 );

	if (
		( $button_layout === 'layout1' || $button_layout === 'layout2' ) &&
		( $enable_product_swatch && $enable_product_swatch_on_shop_catalog && class_exists( 'Botiga_Product_Swatch' ) )
	) {

		ob_start();
			Botiga_Product_Swatch::product_swatch_on_shop_catalog();
		$markup .= ob_get_clean();

	} else {

		$attributes = array(
			'aria-label'       => $_product->add_to_cart_description(),
			'data-quantity'    => '1',
			'data-product_id'  => $_product->get_id(),
			'data-product_sku' => $product->get_sku(),
			'rel'              => 'nofollow',
			'class'            => 'button wp-block-button__link add_to_cart_button',
		);

		if (
			$_product->supports( 'ajax_add_to_cart' ) &&
			$_product->is_purchasable() &&
			( $_product->is_in_stock() || $_product->backorders_allowed() )
		) {
			$attributes['class'] .= ' ajax_add_to_cart';
		}

		$markup .= apply_filters( 
			'botiga_loop_add_to_cart_link_inside_wc_block', 
			sprintf(
				'<a href="%s" %s>%s</a>',
				esc_url( $_product->add_to_cart_url() ),
				wc_implode_html_attributes( $attributes ),
				$text
			),
			$_product,
			$attributes
		);

	}

	return $markup;
}
