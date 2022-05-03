<?php
/**
 * Header Icons Template File
 * 
 */

$show_cart 		             = get_theme_mod( 'enable_mobile_header_cart', 1 );
$show_account                = get_theme_mod( 'enable_mobile_header_account', 1 );
$show_wishlist               = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ) !== 'layout1' ? true : false;
$enable_header_wishlist_icon = get_theme_mod( 'enable_mobile_header_wishlist_icon', 1 );

if ( is_cart() ) {
    $class = 'current-menu-item';
} else {
    $class = '';
}
?>

<?php if ( $show_account ) : ?>
<?php echo '<a class="header-item wc-account-link" href="' . esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) . '" title="' . esc_html__( 'Your account', 'botiga' ) . '"><i class="ws-svg-icon">' . botiga_get_header_icon( 'account' ) . '</i></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<?php endif; ?>	

<?php if ( $show_cart ) : ?>
<div id="site-header-cart" class="site-header-cart header-item mini-cart-<?php echo ( count( WC()->cart->get_cart() ) > 2 ? 'has-scroll' : 'has-no-scroll' ); ?>">
    <div class="<?php echo esc_attr( $class ); ?>">
        <?php echo botiga_woocommerce_cart_link();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
    <?php
    
    // Side Mini Cart
    $mini_cart_style = get_theme_mod( 'mini_cart_style', 'default' );
    if( $mini_cart_style === 'default' ) {
        $instance = array(
            'title' => esc_html__( 'Your Cart', 'botiga' ),
        );

        the_widget( 'WC_Widget_Cart', $instance );
    }
    
    ?>
</div>
<?php endif; ?>
<?php if( $show_wishlist && $enable_header_wishlist_icon ) : 
    $wishlist_count = isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ? count( explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) ) ) : 0; ?>
    <a class="header-item header-wishlist-icon" href="<?php echo esc_url( get_permalink( get_option('botiga_wishlist_page_id') ) ); ?>" title="<?php echo esc_attr__( 'Your wishlist', 'botiga' ); ?>">
        <span class="count-number"><?php echo esc_html( $wishlist_count ); ?></span>
        <i class="ws-svg-icon"><?php botiga_get_header_icon( 'wishlist', true ); ?></i>
    </a>
<?php endif; ?>