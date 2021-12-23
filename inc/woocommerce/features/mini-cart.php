<?php
/**
 * Mini Cart
 *
 * @package Botiga
 */

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'botiga_woocommerce_header_cart' ) ) {
			botiga_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'botiga_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function botiga_woocommerce_cart_link_fragment( $fragments ) {
		$cart_icon = get_theme_mod( 'cart_icon', 'icon-cart' );

		ob_start();
		?>

		<span class="cart-count"><i class="ws-svg-icon"><?php botiga_get_svg_icon( $cart_icon, true ); ?></i><span class="count-number"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span></span>

		<?php
		$fragments['.cart-count'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'botiga_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'botiga_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function botiga_woocommerce_cart_link() {
		$cart_icon = get_theme_mod( 'cart_icon', 'icon-cart' );

		$link = '<a class="cart-contents" href="' . esc_url( wc_get_cart_url() ) . '" title="' . esc_attr__( 'View your shopping cart', 'botiga' ) . '">';
		$link .= '<span class="cart-count"><i class="ws-svg-icon">' . botiga_get_svg_icon( $cart_icon, false ) . '</i><span class="count-number">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span></span>';
		$link .= '</a>';

		return $link;
	}
}

if ( ! function_exists( 'botiga_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function botiga_woocommerce_header_cart() {
		$show_cart 		   = get_theme_mod( 'enable_header_cart', 1 );
		$show_account      = get_theme_mod( 'enable_header_account', 1 );
		$show_wishlist     = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ) !== 'layout1' ? true : false;
		$enable_header_wishlist_icon = get_theme_mod( 'enable_header_wishlist_icon', 1 );

		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>

		<?php if ( $show_account ) : ?>
		<?php echo '<a class="header-item wc-account-link" href="' . esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) . '" title="' . esc_html__( 'Your account', 'botiga' ) . '"><i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-user', false ) . '</i></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>	

		<?php if ( $show_cart ) : ?>
		<div id="site-header-cart" class="site-header-cart header-item mini-cart-<?php echo ( count( WC()->cart->get_cart() ) > 2 ? 'has-scroll' : 'has-no-scroll' ); ?>">
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php echo botiga_woocommerce_cart_link();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php
			$instance = array(
				'title' => esc_html__( 'Your Cart', 'botiga' ),
			);

			the_widget( 'WC_Widget_Cart', $instance );
			?>
		</div>
		<?php endif; ?>
		<?php if( $show_wishlist && $enable_header_wishlist_icon ) : 
			$wishlist_count = isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ? count( explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) ) ) : 0; ?>
			<a class="header-item header-wishlist-icon" href="<?php echo esc_url( get_permalink( get_option('botiga_wishlist_page_id') ) ); ?>" title="<?php echo esc_attr__( 'Your wishlist', 'botiga' ); ?>">
				<span class="count-number"><?php echo esc_html( $wishlist_count ); ?></span>
				<i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-wishlist', true ); ?></i>
			</a>
		<?php endif; ?>
		<?php
	}
}