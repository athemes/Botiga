<?php
/**
 * Cross Sell
 *
 * @package Botiga
 */

/**
 * Enqueue cross sell scripts
 */
function botiga_cross_sell_scripts() {
	$layout                      = get_theme_mod( 'shop_cart_layout', 'layout1' );
	$shop_cart_show_cross_sell   = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
	$enable_mini_cart_cross_sell = get_theme_mod( 'enable_mini_cart_cross_sell', 0 );

	if( 
		( is_cart() && $shop_cart_show_cross_sell && count( WC()->cart->get_cross_sells() ) > 2 ) ||
		( ! is_cart() && $enable_mini_cart_cross_sell ) 
	) {
		// We need register this script again because the order of 'wp_enqueue_scripts'
		wp_register_script( 'botiga-carousel', get_template_directory_uri() . '/assets/js/botiga-carousel.min.js', NULL, BOTIGA_VERSION );
		wp_enqueue_script( 'botiga-carousel' );
	}
}
add_action( 'wp_enqueue_scripts', 'botiga_cross_sell_scripts', 9 );

/**
 * Hooks 
 */
function botiga_cross_sell_hooks() {
    if ( is_cart() ) {
		add_filter( 'botiga_content_class', function( $class ) { 
			$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
			$layout                    = get_theme_mod( 'shop_cart_layout', 'layout1' ); 

			if( $shop_cart_show_cross_sell && count( WC()->cart->get_cross_sells() ) > 2 ) {
				$class .= ' has-cross-sells-carousel';
			}
			
			return $class; 
		} );

        //Cart cross sell
        $cart_layout               = get_theme_mod( 'shop_cart_layout', 'layout1' );
        $shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );

        if( !$shop_cart_show_cross_sell ) {
            remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
        }
        add_filter( 'woocommerce_cross_sells_columns', function() use ($cart_layout) {
            return 'layout1' === $cart_layout ? 2 : 4;
        } );
	}
	
	add_filter( 'woocommerce_cross_sells_total', function() {
		return -1;
	} );
}
add_action( 'wp', 'botiga_cross_sell_hooks' );

/**
 * Mini cart cross sell
 */
function botiga_mini_cart_cross_sell() {
	if( is_cart() ) {
		return;
	}

	$enable_mini_cart_cross_sell = get_theme_mod( 'enable_mini_cart_cross_sell', 0 );
	if( ! $enable_mini_cart_cross_sell || count( WC()->cart->get_cross_sells() ) === 0 ) {
		return;
	} ?>
	
	<div class="botiga-woocommerce-mini-cart__cross-sell">
		<?php woocommerce_cross_sell_display(); ?>
	</div>

	<?php
}
add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'botiga_mini_cart_cross_sell' );