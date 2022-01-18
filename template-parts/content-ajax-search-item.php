<?php
/**
 * Template part for displaying ajax search item content
 *
 * @package Botiga
 */

if( $args['type'] === 'product' ) {
    $item_post_id   = $args['post_id'];
    $product        = wc_get_product( $item_post_id );
    $item_permalink = get_the_permalink( $item_post_id );
    $item_image     = wp_get_attachment_image( $product->get_image_id() );
    $item_title     = get_the_title( $item_post_id );
    $desc_length    = get_theme_mod( 'shop_search_ajax_desc_excerpt_length', 10 ); 
    $description    = wp_trim_words( get_theme_mod( 'shop_search_ajax_desc_content', 'product-post-content' ) === 'product-post-content' ? $product->get_description() : $product->get_short_description(), $desc_length );
    $price          = $product->get_price_html();
} else {
    $item_term_id   = $args['term_id'];
    $item_term      = get_term( $item_term_id );
    $item_permalink = get_term_link( $item_term_id );
    $item_image     = false;
    $item_title     = $item_term->name;
    $description    = false;
    $price          = false;
} ?>

<a class="botiga-ajax-search__item botiga-ajax-search__item-<?php echo esc_attr( $args['type'] ); ?>" href="<?php echo esc_url( $item_permalink ); ?>">
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