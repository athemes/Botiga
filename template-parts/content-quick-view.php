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
                <h2 class="product_title entry-title">
                    <?php echo esc_html( get_the_title( $product_id ) ); ?>
                </h2>
                <?php if ( wc_review_ratings_enabled() ) :
                    $rating_count = $product->get_rating_count();
                    $review_count = $product->get_review_count();
                    $average      = $product->get_average_rating();

                    if ( $rating_count > 0 ) : ?>

                        <div class="woocommerce-product-rating">
                            <?php echo wc_get_rating_html( $average, $rating_count ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            <?php if ( comments_open( $product_id ) ) : ?>
                                <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>#reviews" class="woocommerce-review-link" rel="nofollow">(<?php /* translators: %s: customer review text */ printf( _n( '%s customer review', '%s customer reviews', $review_count, 'botiga' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>)</a>
                            <?php endif ?>
                        </div>

                    <?php endif; ?>
                <?php endif; ?>
                
                <p class="<?php echo esc_attr( apply_filters( 'botiga_quick_view_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

                <?php
                $short_description = apply_filters( 'botiga_quick_view_short_description', $product->get_short_description() );
                if ( $short_description ) : ?>
                    <div class="woocommerce-product-details__short-description">
                        <p><?php echo wp_kses_post( $short_description ); ?></p>
                    </div>
                <?php endif; ?>
                
                <?php 
                switch ( $product->get_type() ) {
                    case 'grouped':
                        botiga_grouped_add_to_cart( $product, 'quick_view' );
                        break;
                    
                    case 'variable':
                        botiga_variable_add_to_cart( $product, 'quick_view' );
                        break;

                    case 'external':
                        botiga_external_add_to_cart( $product, 'quick_view' );
                        break;
                    
                    default:
                        botiga_simple_add_to_cart( $product, 'quick_view' );
                        break;
                } ?>

                <div class="product_meta">
                    <?php do_action( 'botiga_quick_view_product_meta_start' ); ?>

                    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

                        <span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'botiga' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? esc_html( $sku ) : esc_html__( 'N/A', 'botiga' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>

                    <?php endif; ?>

                    <?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'botiga' ) . ' ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                    <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'botiga' ) . ' ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                    <?php do_action( 'botiga_quick_view_product_meta_end' ); ?>
                </div>

                <?php do_action( 'botiga_quick_view_share' ); ?>
            </div>
        </div>
    </div>

</div>