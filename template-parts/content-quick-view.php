<?php
/**
 * Template part for displaying quick view content
 *
 * @package Botiga
 * @var array $args Contains product id
 */

$product    = wc_get_product( $args['product_id'] ); 
$product_id = $product->get_id(); ?>

<div id="product-<?php echo absint( $product_id ); ?>" <?php wc_product_class( '', $product ); ?>>
    <div class="row">
        <div class="col-lg-6">
            
            <?php
            //Gallery
            if ( function_exists( 'wc_get_gallery_image_html' ) ) :
                $columns           = apply_filters( 'botiga_quick_view_product_thumbnails_columns', 4 );
                $post_thumbnail_id = $product->get_image_id();
                $wrapper_classes   = apply_filters(
                    'botiga_quick_view_image_gallery_classes',
                    array(
                        'woocommerce-product-gallery',
                        'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
                        'woocommerce-product-gallery--columns-' . absint( $columns ),
                        'images'
                    )
                ); ?>

                <div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
                    <?php 
                    //On sale tag
                    if ( $product->is_on_sale() ) :
                        echo apply_filters( 'botiga_quick_view_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'botiga' ) . '</span>', get_post( $product_id ), $product ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    endif; ?>
                    
                    <figure class="woocommerce-product-gallery__wrapper">
                        <?php
                        if ( $post_thumbnail_id ) {
                            $html = wc_get_gallery_image_html( $post_thumbnail_id, true );
                        } else {
                            $html  = '<div class="woocommerce-product-gallery__image--placeholder">';
                            $html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'botiga' ) );
                            $html .= '</div>';
                        }

                        echo apply_filters( 'botiga_quick_view_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

                        //Thumbnails
                        $attachment_ids = $product->get_gallery_image_ids();

                        if ( $attachment_ids && $product->get_image_id() ) {
                            foreach ( $attachment_ids as $attachment_id ) {
                                echo apply_filters( 'botiga_quick_view_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            }
                        }
                        ?>
                    </figure>
                </div>

            <?php endif; ?>

        </div>
        <div class="col-lg-6">
            <div class="botiga-quick-view-summary product-gallery-summary">

                <?php
                $defaults 	= botiga_get_default_single_product_components();
                $components = botiga_get_quick_view_summary_components( get_theme_mod( 'single_product_elements_order', $defaults ) );

                foreach( $components as $component ) {
                    call_user_func( $component, $product );
                } ?>

                <?php do_action( 'botiga_quick_view_share' ); ?>
            </div>
        </div>
    </div>

</div>