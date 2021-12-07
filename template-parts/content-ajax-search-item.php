<?php
/**
 * Template part for ajax search item content
 *
 * @package Botiga
 */

if( $args['type'] === 'product' ) {
    $post_id = $args['post_id'];
    $product = wc_get_product( $post_id );
    $permalink = get_the_permalink( $post_id );
    $image = wp_get_attachment_image( $product->get_image_id() );
    $title = get_the_title( $post_id );
    $description  = wp_trim_words( $product->get_description(), 10 );
    $price = $product->get_price_html();
} else {
    $term_id = $args['term_id'];
    $term    = get_term( $term_id );
    $permalink = get_term_link( $term_id );
    $image = false;
    $title = $term->name;
    $description  = false;
    $price = false;
} ?>

<a class="botiga-ajax-search__item botiga-ajax-search__item-<?php echo esc_attr( $args['type'] ); ?>" href="<?php echo esc_url( $permalink ); ?>">
    <?php if( $image ) : ?>
        <div class="botiga-ajax-search__item-image">
            <?php echo wp_kses_post( $image ); ?>
        </div>
    <?php endif; ?>
    <div class="botiga-ajax-search__item-info">
        <h3><?php echo $title; ?></h3>
        <?php if( $description ) : ?>
            <p><?php echo $description; ?></p>
        <?php endif; ?>
    </div>
    <div class="botiga-ajax-search__item-price">
        <?php echo $price; ?>
    </div>
</a>