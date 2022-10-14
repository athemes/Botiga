<?php
/**
 * Product Card
 *
 * @package Botiga
 */

/**
 * Hooks 
 */
function botiga_product_card_hooks() {
    $layout			   			 = get_theme_mod( 'shop_archive_layout', 'product-grid' );	
	$button_layout     			 = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$quick_view_layout 			 = get_theme_mod( 'shop_product_quickview_layout', 'layout1' );
	$wishlist_layout 			 = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );
    
    //Loop image wrapper extra class
	$loop_image_wrap_extra_class = 'botiga-add-to-cart-button-'. $button_layout;
	if( 'layout1' !== $quick_view_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-quick-view-button-'. $quick_view_layout;
	}

	if( 'layout1' !== $wishlist_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-wishlist-button-'. $wishlist_layout;
	}

	//Archive layout
	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		if ( 'product-list' === $layout ) {

			// Products
			add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-big'; } );
			add_action( 'woocommerce_before_shop_loop_item', function() use ($loop_image_wrap_extra_class) { echo '<div class="row valign"><div class="col-md-4"><div class="loop-image-wrap '. esc_attr( apply_filters( 'botiga_wc_loop_image_wrap_extra_class', $loop_image_wrap_extra_class ) ) .'">'; }, 1 );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { echo '</div></div><div class="col-md-8">'; }, 11 );
			add_action( 'woocommerce_after_shop_loop_item', function() { echo '</div>'; }, PHP_INT_MAX );

			// Categories
			add_filter( 'subcategory_archive_thumbnail_size', function(){ return 'botiga-big'; } );
			add_action( 'woocommerce_before_subcategory', function() use ($loop_image_wrap_extra_class) { echo '<div class="row valign"><div class="col-md-4"><div class="loop-image-wrap '. esc_attr( apply_filters( 'botiga_wc_loop_image_wrap_extra_class', $loop_image_wrap_extra_class ) ) .'">'; }, 1 );
			add_action( 'woocommerce_before_subcategory_title', function() { echo '</div></div><div class="col-md-8">'; }, 11 );
			add_action( 'woocommerce_after_subcategory', function() { echo '</div>'; }, PHP_INT_MAX );
		}

		if ( in_array( $layout, array( 'product-grid', 'product-masonry' ) ) ) {
			$shop_woocommerce_catalog_columns_desktop = get_theme_mod( 'shop_woocommerce_catalog_columns_desktop', 4 );
		
			if( $shop_woocommerce_catalog_columns_desktop === 2 ) {
				add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-large'; } );
				add_filter( 'subcategory_archive_thumbnail_size', function(){ return 'botiga-large'; } );
				add_filter( 'woocommerce_get_image_size_botiga-large', function( $size ){ $size[ 'width' ] = 920; return $size; } );
			}
		
			if( $shop_woocommerce_catalog_columns_desktop === 1 ) {
				add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-extra-large'; } );
				add_filter( 'subcategory_archive_thumbnail_size', function(){ return 'botiga-extra-large'; } );
				add_filter( 'woocommerce_get_image_size_botiga-extra-large', function( $size ){ $size[ 'width' ] = 1140; return $size; } );
			}
		}
	}

	/**
	 * Loop product structure
	 */

	//Move link close tag
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 12 );

	//Wrap loop image
	if ( in_array( $layout, array( 'product-grid', 'product-masonry' ) ) || is_product() ) {
		//Wrap loop image
		add_action( 'woocommerce_before_shop_loop_item_title', function() use ($loop_image_wrap_extra_class) { echo '<div class="loop-image-wrap '. esc_attr( apply_filters( 'botiga_wc_loop_image_wrap_extra_class', $loop_image_wrap_extra_class ) ) .'">'; }, 9 );
		add_action( 'woocommerce_before_shop_loop_item_title', function() { echo '</div>'; }, 11 );
	}

	if ( in_array( $layout, array( 'product-grid', 'product-masonry' ) ) ) {
		//Move button inside image wrap
		if ( 'layout4' === $button_layout && 'layout3' !== $quick_view_layout || 'layout3' === $button_layout && 'layout2' !== $quick_view_layout ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { botiga_wrap_loop_button_start(); woocommerce_template_loop_add_to_cart(); echo '</div>'; } );
		}
	} else {
		//Move button inside image wrap
		if ( 'layout4' === $button_layout && 'layout3' !== $quick_view_layout || 'layout3' === $button_layout && 'layout2' !== $quick_view_layout ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { botiga_wrap_loop_button_start(); woocommerce_template_loop_add_to_cart(); echo '</div>'; } );
		}
	}

	//Remove product title, rating, price
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

	//Add elements from sortable option
	add_action( 'woocommerce_after_shop_loop_item', 'botiga_loop_product_structure', 9 );

	//Wrap loop button
	if ( 'layout4' !== $button_layout ) {
		add_action( 'woocommerce_after_shop_loop_item', 'botiga_wrap_loop_button_start', 9 );
		add_action( 'woocommerce_after_shop_loop_item', function() { echo '</div>'; }, 11 );
	}

	//Remove button
	if( 'layout1' === $button_layout ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
	}

	//Quick view button & add to cart button
	if ( 
		( 'layout4' === $button_layout && 'layout3' === $quick_view_layout ) || 
		( 'layout3' === $button_layout && 'layout2' === $quick_view_layout ) 
	) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
	}

	//Quick view and wishlist buttons
	if ( is_shop() || is_product_category() || is_product_tag() || is_product() || botiga_page_has_woo_blocks() || is_cart() || is_404() || is_product_taxonomy() ) {
		if( 'layout1' !== $quick_view_layout || 'layout1' !== $wishlist_layout ) {
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );
		}

		if( 'layout1' !== $quick_view_layout ) {
			add_action( 'woocommerce_before_shop_loop_item_title', 'botiga_quick_view_button', 10 );
			
			//Quick view popup
			add_action( 'wp_body_open', 'botiga_quick_view_popup' );
			
			// Do not include on single product pages
			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) && false === is_product() ) {
				add_action( 'botiga_footer_after', function(){
					wc_get_template( 'single-product/photoswipe.php' );
				} );
			}
		}

		if( 'layout1' !== $wishlist_layout ) {
			add_action( 'woocommerce_before_shop_loop_item_title', 'botiga_wishlist_button', 10 );
		}
	}

	$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
	if( $shop_cart_show_cross_sell ) {
		//Quick view popup
		add_action( 'wp_body_open', 'botiga_quick_view_popup' );
	}

	// Add to cart button text
	add_filter( 'woocommerce_product_add_to_cart_text', 'botiga_add_to_cart_text', 10, 2);
}
add_action( 'wp', 'botiga_product_card_hooks' );

/**
 * Loop add to cart
 */
function botiga_filter_loop_add_to_cart( $button, $product, $args ) {
	global $product;

	//Return if not button layout 4
	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$layout 		= get_theme_mod( 'shop_archive_layout', 'product-grid' );	

	if ( 'layout4' !== $button_layout ) {
		return $button;
	}

	if ( $product->is_type( 'simple' ) ) {
		$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i>';
	} else {
		$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-eye', false ) . '</i>';
	}

	$button = sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		$text
	);

	return $button;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'botiga_filter_loop_add_to_cart', 10, 3 );

/**
 * Check if page has woocommece GB blocks
 */
function botiga_page_has_woo_blocks() {
	global $post;
	
	if( $post ) {
		if( isset( $post->post_content ) && strpos( $post->post_content, 'woocommerce/' ) ) {
            return true;
        }
	}

	return false;
}

/**
 * Wrap loop button
 */
function botiga_wrap_loop_button_start() {

	$button_layout         = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$shop_product_quantity = get_theme_mod( 'shop_product_quantity', 0 );
	$button_with_quantity  = '';

	if ( $shop_product_quantity && in_array( $button_layout, array( 'layout2', 'layout3', 'layout4' ) ) ) {
		global $product;
		if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
			$button_with_quantity = ' button-with-quantity';
		}
	}

	echo '<div class="loop-button-wrap button-' . esc_attr( $button_layout ) . esc_attr( $button_with_quantity ) . '">';
}

/**
 * Loop product structure
 */
function botiga_loop_product_structure() {
	$elements 	= get_theme_mod( 'shop_card_elements', array( 'botiga_shop_loop_product_title', 'woocommerce_template_loop_price' ) );
	$layout		= get_theme_mod( 'shop_product_card_layout', 'layout1' );

	if ( 'layout1' === $layout ) {
		foreach ( $elements as $element ) {
			call_user_func( $element );
		}
	} else {
		$left_elements = array_diff( $elements, array( 'woocommerce_template_loop_price', 'botiga_loop_product_description' ) );

		echo '<div class="row">';
			echo '<div class="col-md-7">';
			foreach ( $left_elements as $element ) {
				call_user_func( $element );
			}		
			echo '</div>';
			echo '<div class="col-md-5 loop-price-inline text-sm-left">';
				if( in_array( 'woocommerce_template_loop_price', $elements ) ) {
					woocommerce_template_loop_price();
				}
			echo '</div>';
			echo '<div class="col-12 product-description-column">';
				if( in_array( 'botiga_loop_product_description', $elements ) ) {
					botiga_loop_product_description();
				}
			echo '</div>';
		echo '</div>';
	}
}

/**
 * Add to cart button text
 */
function botiga_add_to_cart_text( $text, $product ) {
	$out_of_stock_text = get_theme_mod( 'out_of_stock_text', '' );

	if( $out_of_stock_text && 'outofstock' === $product->get_stock_status() ) {
		$text = $out_of_stock_text;
	}

	return $text;
}