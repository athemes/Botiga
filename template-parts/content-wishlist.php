<?php
/**
 * Template part for displaying wishlist content
 *
 * @package Botiga
 */

$products = isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) : false;

if( $products ) : 
    $products = explode( ',', $products ); ?>
    
    <div class="botiga-wishlist-wrapper woocommerce-cart-form">
        <table class="shop_table shop_table_responsive botiga_wishlist_table" cellspacing="0">
            <thead>
                <tr>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name"><?php esc_html_e( 'Product Name', 'botiga' ); ?></th>
                    <th class="product-price"><?php esc_html_e( 'Unit Price', 'botiga' ); ?></th>
                    <th class="product-quantity"><?php esc_html_e( 'Stock Status', 'botiga' ); ?></th>
                    <th class="product-subtotal">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ( $products as $product_id ) {
                    $_product = wc_get_product( $product_id );

                    if ( $_product && $_product->exists() ) {
                        $product_permalink = $_product->is_visible() ? $_product->get_permalink() : '';
                        ?>
                        <tr class="botiga-wishlist-row-item woocommerce-cart-form__cart-item">

                            <td class="product-remove">
                                <?php
                                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    echo apply_filters(
                                        'botiga_wishlist_remove_item_button',
                                        sprintf(
                                            '<a href="#" class="botiga-wishlist-remove-item remove" data-type="remove" aria-label="%s" data-product-id="%s" data-product_sku="%s" data-nonce="%s">&times;</a>',
                                            esc_html__( 'Remove this item', 'botiga' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $_product->get_sku() ),
                                            esc_attr( wp_create_nonce( 'botiga-wishlist-nonce' ) )
                                        )
                                    );
                                ?>
                            </td>

                            <td class="product-thumbnail">
                                <?php
                                $thumbnail = $_product->get_image();

                                if ( ! $product_permalink ) {
                                    echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } else {
                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } ?>
                            </td>

                            <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'botiga' ); ?>">
                                <?php
                                if ( ! $product_permalink ) {
                                    echo wp_kses_post( $_product->get_name() . '&nbsp;' );
                                } else {
                                    echo wp_kses_post( sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ) );
                                } 
                                
                                do_action( 'botiga_wishlist_after_item_name', $_product, $product_id ); ?>
                            </td>

                            <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'botiga' ); ?>">
                                <?php
                                    echo wp_kses_post( wc_price( $_product->get_price() ) );
                                ?>
                            </td>

                            <td class="product-stock" data-title="<?php esc_attr_e( 'Stock', 'botiga' ); ?>">
                                <?php
                                if ( ! $_product->is_in_stock() ) {
                                    echo apply_filters( 'botiga_wishlist_out_of_stock', esc_html__( 'Out of Stock', 'botiga' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } else {
                                    echo apply_filters( 'botiga_wishlist_in_stock', esc_html__( 'In Stock', 'botiga' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } 
                                ?>
                            </td>

                            <td class="product-addtocart" data-title="<?php esc_attr_e( 'Add to Cart', 'botiga' ); ?>">
                                <?php
                                    switch ( $_product->get_type() ) {
                                        case 'grouped':
                                            $button_class = '';
                                            $button_text  = __( 'View Products', 'botiga' );
                                            $button_url   = $_product->add_to_cart_url();
                                            break;
                                        
                                        case 'variable':
                                            $button_class = '';
                                            $button_text  = __( 'Select Options', 'botiga' );
                                            $button_url   = $_product->add_to_cart_url();
                                            break;
                                
                                        case 'external':
                                            $button_class = '';
                                            $button_text  = $_product->single_add_to_cart_text();
                                            $button_url   = $_product->add_to_cart_url();
                                            break;
                                        
                                        default:
                                            $button_class = 'botiga-custom-addtocart';
                                            $button_text  = __( 'Add to Cart', 'botiga' );
                                            $button_url   = $_product->add_to_cart_url();
                                            break;
                                    }
                                    echo '<strong><a href="'. esc_url( $button_url ) .'" class="'. esc_attr( $button_class ) .'" data-product-id="'. absint( $product_id ) .'" data-loading-text="'. esc_attr__( 'Loading...', 'botiga' ) .'" data-added-text="'. esc_attr__( 'Added!', 'botiga' ) .'" data-nonce="'. esc_attr( wp_create_nonce( 'botiga-custom-addtocart-nonce' ) ) .'">'. esc_html( $button_text ) .'</a></strong>';
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="footer-buttons">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button"><?php echo esc_html__( 'View Cart', 'botiga' ); ?></a>
        </div>
    </div>

<?php else : ?>
   
    <div class="botiga-wishlist-wrapper woocommerce-cart-form">
        <table class="shop_table shop_table_responsive botiga_wishlist_table empty" cellspacing="0">
            <thead>
                <tr>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name"><?php esc_html_e( 'Product Name', 'botiga' ); ?></th>
                    <th class="product-price"><?php esc_html_e( 'Unit Price', 'botiga' ); ?></th>
                    <th class="product-quantity"><?php esc_html_e( 'Stock Status', 'botiga' ); ?></th>
                    <th class="product-subtotal">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr class="botiga-wishlist-row-item woocommerce-cart-form__cart-item">
                    <td colspan="6"><?php echo esc_html__( 'No products added to the wishlist', 'botiga' ); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

<?php endif; ?>