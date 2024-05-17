<?php
/**
 * Template part for displaying ajax search item content.
 * 
 * This template can be overridden by copying it to yourtheme/template-parts/search/content-ajax-search-item.php.
 *
 * HOWEVER, on occasion Botiga will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 *
 * @package Botiga\Templates
 * @version 2.2.4
 */

/**
 * Hook 'botiga_before_ajax_search_item'
 *
 * @since 1.0.0
 */
do_action( 'botiga_before_ajax_search_item' );

$product_id     = $args['post_id'];
$product        = wc_get_product( $product_id );
$item_permalink = get_the_permalink( $product_id );
$item_image     = wp_get_attachment_image( $product->get_image_id() );
$item_title     = get_the_title( $product_id );
$desc_length    = get_theme_mod( 'shop_search_ajax_desc_excerpt_length', 10 ); 
$description    = wp_trim_words( get_theme_mod( 'shop_search_ajax_desc_content', 'product-post-content' ) === 'product-post-content' ? $product->get_description() : $product->get_short_description(), $desc_length );
$price          = $product->get_price_html();

?>

<a class="botiga-ajax-search__item botiga-ajax-search__item-product" href="<?php echo esc_url( $item_permalink ); ?>">
    <?php if( $item_image ) : ?>
        <div class="botiga-ajax-search__item-image">
            <?php echo wp_kses_post( $item_image ); ?>
        </div>
    <?php endif; ?>
    <div class="botiga-ajax-search__item-info">
        <h3><?php echo esc_html( $item_title ); ?></h3>
        <?php if( $description ) : ?>
            <p><?php echo esc_html( $description ); ?></p>
        <?php endif; ?>
    </div>
    <div class="botiga-ajax-search__item-price">
        <?php echo wp_kses_post( $price ); ?>
    </div>
</a>

<?php 
/**
 * Hook 'botiga_after_ajax_search_item'
 *
 * @since 1.0.0
 */
do_action( 'botiga_after_ajax_search_item' ); ?>