<?php
/**
 * Template part for displaying single product sticky add to cart
 *
 * @package Botiga
 */

global $product;

//Options
$single_sticky_add_to_cart_position          = get_theme_mod( 'single_sticky_add_to_cart_position', 'bottom' );
$single_sticky_add_to_cart_elements          = get_theme_mod( 'single_sticky_add_to_cart_elements', array( 'botiga_sticky_add_to_cart_product_image', 'botiga_sticky_add_to_cart_product_title', 'botiga_single_product_price', 'botiga_sticky_add_to_cart_product_addtocart' ) ); 
$single_sticky_add_to_cart_scroll_hide       = get_theme_mod( 'single_sticky_add_to_cart_scroll_hide', 0 );
$single_sticky_add_to_cart_device_visibility = get_theme_mod( 'single_sticky_add_to_cart_device_visibility', 'desktop-only' );

//Wrapper class
$wrapper_class = 'botiga-single-sticky-add-to-cart-wrapper';

//Position
if( $single_sticky_add_to_cart_position === 'bottom' ) {
    $wrapper_class .= ' position-bottom';
} else {
    $wrapper_class .= ' position-top';
}

//Hide when scroll
if( $single_sticky_add_to_cart_scroll_hide ) {
    $wrapper_class .= ' hide-when-scroll';
} 

//Visibility
if( $single_sticky_add_to_cart_device_visibility === 'mobile-only' ) {
    $wrapper_class .= ' visible-mobile-only';
} elseif( $single_sticky_add_to_cart_device_visibility === 'desktop-only' ) {
    $wrapper_class .= ' visible-desktop-only';
} ?>

<div class="<?php echo esc_attr( $wrapper_class ); ?>">
    <div class="botiga-single-sticky-add-to-cart-wrapper-content-mobile">
        <a href="#" class="button botiga-mobile-sticky-addtocart-button" onclick="botiga.toggleClass.init(event, this, false);" data-botiga-toggle-class="botiga-sticky-addtocart-mobile-active" data-botiga-selector=".botiga-single-sticky-add-to-cart-wrapper">
            <?php echo esc_html__( 'Add to Cart', 'botiga' ); ?>
        </a>
        <a href="#" class="button botiga-mobile-sticky-close-button" onclick="botiga.toggleClass.init(event, this, false);" data-botiga-toggle-class="botiga-sticky-addtocart-mobile-active" data-botiga-selector=".botiga-single-sticky-add-to-cart-wrapper">
                <?php echo esc_html__( 'Close', 'botiga' ); ?>
        </a>
    </div>
    <div class="botiga-single-sticky-add-to-cart-wrapper-content">
        
        <?php foreach( $single_sticky_add_to_cart_elements as $element ) {
            $class = '';
            switch ( $element ) {
                case 'botiga_sticky_add_to_cart_product_image':
                    $class = 'product-image';
                    break;
                
                case 'botiga_sticky_add_to_cart_product_title':
                    $class = 'product-title';
                    break;

                case 'botiga_single_product_price':
                    $class = 'product-price';
                    break;

                case 'botiga_sticky_add_to_cart_product_addtocart':
                    $class = 'product-addtocart';
                    break;
            }

            echo '<div class="botiga-single-sticky-add-to-cart-item '. esc_attr( $class ) .'">';
                call_user_func( $element );
            echo '</div>';
        } ?>

    </div>
</div>