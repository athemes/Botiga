<?php
/**
 * Wishlist
 *
 * @package Botiga
 */

/**
 * Wishlist post class callback
 */
function botiga_wishlist_post_class( $classes ) {
	$wishlist_icon_show_on_hover = get_theme_mod( 'shop_product_wishlist_show_on_hover', 0 );
	if( $wishlist_icon_show_on_hover ) {
		$classes[] = 'botiga-wishlist-show-on-hover';
	}

	return $classes;
}
add_filter( 'woocommerce_post_class', 'botiga_wishlist_post_class' );

/**
 * Wishlist button
 */
function botiga_wishlist_button( $product = false, $echo = true  ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id        = $product->get_id(); 
	$wishlist_layout   = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 
	if( 'layout1' == $wishlist_layout ) {
		return '';
	}
	$shop_product_wishlist_tooltip = get_theme_mod( 'shop_product_wishlist_tooltip', 0 );
	$tooltip_text 				   = $shop_product_wishlist_tooltip ? get_theme_mod( 'shop_product_wishlist_tooltip_text' ) : '';
	$wishlist_page_link            = get_the_permalink( get_option( 'botiga_wishlist_page_id' ) );

	if( $echo == false ) {
		ob_start();
	} ?>

	<a href="#" class="botiga-wishlist-button<?php echo ( $shop_product_wishlist_tooltip ) ? ' botiga-wishlist-button-tooltip' : ''; ?><?php echo ( botiga_product_is_inthe_wishlist( $product_id ) ) ? ' active' : ''; ?>" data-type="add" data-wishlist-link="<?php echo esc_url( $wishlist_page_link ); ?>" aria-label="<?php /* translators: %s: add to wishlist product title */ echo esc_attr( sprintf( __( 'Add to wishlist the %s product', 'botiga' ), get_the_title( $product_id ) ) ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-wishlist-nonce' ) ); ?>" data-botiga-wishlist-tooltip="<?php echo esc_attr( $tooltip_text ); ?>">
		<svg width="17" height="17" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M13.8213 2.50804L13.8216 2.5078C16.1161 0.140222 19.7976 -0.212946 22.2492 1.87607C25.093 4.30325 25.2444 8.66651 22.6933 11.2992L22.6932 11.2993L13.245 21.055C13.245 21.0551 13.245 21.0551 13.2449 21.0551C12.8311 21.4822 12.1652 21.4822 11.7514 21.0551C11.7513 21.0551 11.7513 21.0551 11.7513 21.055L2.30334 11.2995C-0.243225 8.66684 -0.0918835 4.30344 2.75181 1.8762C5.20368 -0.213127 8.88985 0.140465 11.1793 2.50744L11.1799 2.50804L12.1418 3.49925L12.5006 3.86899L12.8594 3.49925L13.8213 2.50804Z" stroke-width="1" stroke="#212121" fill="transparent"/>
		</svg>
	</a>

	<?php
	if( $echo == false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Wishlist button for single product and quick view
 */
function botiga_single_wishlist_button( $product = false, $echo = true  ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id        = $product->get_id(); 
	$wishlist_layout   = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 
	if( 'layout1' == $wishlist_layout ) {
		return '';
	}

	$wishlist_page_link        = get_the_permalink( get_option( 'botiga_wishlist_page_id' ) );
	$product_is_inthe_wishlist = botiga_product_is_inthe_wishlist( $product_id );
	
	if( $echo == false ) {
		ob_start();
	} ?>

	<div class="botiga-wishlist-wrapper">
		<a href="#" class="botiga-wishlist-button<?php echo ( $product_is_inthe_wishlist ) ? ' active' : ''; ?>" data-type="add" data-wishlist-link="<?php echo esc_url( $wishlist_page_link ); ?>" aria-label="<?php /* translators: %s: add to wishlist product title */ echo esc_attr( sprintf( __( 'Add to wishlist the %s product', 'botiga' ), get_the_title( $product_id ) ) ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-wishlist-nonce' ) ); ?>">
			<svg width="17" height="17" viewBox="-2 -2 30 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.8213 2.50804L13.8216 2.5078C16.1161 0.140222 19.7976 -0.212946 22.2492 1.87607C25.093 4.30325 25.2444 8.66651 22.6933 11.2992L22.6932 11.2993L13.245 21.055C13.245 21.0551 13.245 21.0551 13.2449 21.0551C12.8311 21.4822 12.1652 21.4822 11.7514 21.0551C11.7513 21.0551 11.7513 21.0551 11.7513 21.055L2.30334 11.2995C-0.243225 8.66684 -0.0918835 4.30344 2.75181 1.8762C5.20368 -0.213127 8.88985 0.140465 11.1793 2.50744L11.1799 2.50804L12.1418 3.49925L12.5006 3.86899L12.8594 3.49925L13.8213 2.50804Z" stroke-width="3" stroke="#212121" fill="transparent"/>
			</svg>
			<span class="botiga-wishlist-text" data-wishlist-view-text="<?php echo esc_attr__( 'View Wishlist', 'botiga' ); ?>">
				<?php 
				if( $product_is_inthe_wishlist ) {
					esc_html_e( 'View Wishlist', 'botiga' );
				} else {
					esc_html_e( 'Add to Wishlist', 'botiga' );
				} ?>
			</span>
		</a>
	</div>	

	<?php
	if( $echo == false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Wishlist set no cache headers
 * The purpose is avoid caching issues with plugins and servers
 */
function botiga_set_nocache_headers() {
	if( ! headers_sent() ) { 
		if( isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) {
			if( class_exists( 'WC_Cache_Helper' ) ) {
				WC_Cache_Helper::set_nocache_constants(true);
			}
			nocache_headers();
		}
	}
}
add_action( 'woocommerce_init', 'botiga_set_nocache_headers' );

/**
 * Wishlist button ajax callback
 * The cookie name needs to contain "woocommerce_items_in_cart" to avoid caching issues in some servers like kinsta. 
 * Reference: https://kinsta.com/blog/wordpress-cookies-php-sessions/#3-exclude-pages-from-cache-when-the-cookie-is-present
 */
function botiga_button_wishlist_callback_function(){
	check_ajax_referer( 'botiga-wishlist-nonce', 'nonce' );

	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	$qty = 1;

	if( isset( $_POST['type'] ) && 'add' === $_POST['type'] ) {
		if( isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) {
			$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) );
			$arr               = explode( ',', $wishlist_products );
			$newvalue          = $wishlist_products . ',' . absint( $_POST['product_id'] );
			$qty               = count( $arr ) + 1;
	
			if( !in_array( $_POST['product_id'], $arr ) ) {
				setcookie( 'woocommerce_items_in_cart_botiga_wishlist', $newvalue, apply_filters( 'botiga_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
			}
		} else {
			setcookie( 'woocommerce_items_in_cart_botiga_wishlist', absint( $_POST['product_id'] ), apply_filters( 'botiga_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
		}
	} else {
		$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) );
		$arr               = explode( ',', $wishlist_products );
		$key               = array_search( $_POST['product_id'], $arr );

		unset( $arr[ $key ] );

		$newvalue = implode( ',', $arr );

		$qty = count( $arr );

		setcookie( 'woocommerce_items_in_cart_botiga_wishlist', $newvalue, apply_filters( 'botiga_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
	}

	wp_send_json( array(
		'status' => 'success',
		'qty'    => absint( $qty )
	) );
}
add_action('wp_ajax_botiga_button_wishlist', 'botiga_button_wishlist_callback_function');
add_action( 'wp_ajax_nopriv_botiga_button_wishlist', 'botiga_button_wishlist_callback_function' );

/**
 * Wishlist - Check if the product is in the list
 */
function botiga_product_is_inthe_wishlist( $product_id ) {
	if( ! isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) {
		return false;
	} 

	$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) );
	$products          = explode( ',', $wishlist_products );
	if( in_array( $product_id, $products ) ) {
		return true;
	}

	return false;
}