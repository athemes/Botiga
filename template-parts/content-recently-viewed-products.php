<?php
/**
 * Template part for displaying recently viewed products in single product page
 *
 * @package Botiga
 */

global $product;

if ( ! $product ) {
    return;
}

$posts_per_page = get_theme_mod( 'shop_single_related_products_number', 3 );
$columns        = get_theme_mod( 'shop_single_related_products_columns_number', 3 );
$shop_single_related_products_slider_nav = get_theme_mod( 'shop_single_related_products_slider_nav', 'always-show' );

$defaults = array(
    'posts_per_page' => $posts_per_page,
    'orderby'        => 'rand',
    'order'          => 'desc'
);

$args = wp_parse_args( $args, $defaults );

$args['related_products'] = array_filter( array_map( 'wc_get_product', explode( '|', $_COOKIE['woocommerce_recently_viewed'] ) ), 'wc_products_array_filter_visible' );

// Handle orderby.
$related_products = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] ); 

if( count( $related_products ) === 0 ) {
    return;
} ?>

<section class="recently-viewed-products products">

    <?php
    $heading = apply_filters( 'botiga_woocommerce_product_recently_viewed_products_heading', __( 'Recently viewed products', 'botiga' ) );

    if ( $heading ) : ?>
        <h2><?php echo esc_html( $heading ); ?></h2>
    <?php endif; ?>
    
    <?php

    $wrapper_atts = array();
    $wrapper_classes = array( 'botiga-related-posts' );

    wp_enqueue_script( 'botiga-carousel' );
    wp_localize_script( 'botiga-carousel', 'botiga_carousel', botiga_localize_carousel_options() );	

    $wrapper_classes[] = 'botiga-carousel botiga-carousel-nav2';

    if( $shop_single_related_products_slider_nav === 'always-show' ) {
        $wrapper_classes[] = 'botiga-carousel-nav2-always-show';
    }

    $wrapper_atts[] = 'data-per-page="'. absint( $columns ) .'"';

    // Mount related posts wrapper class
    $wrapper_atts[] = 'class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

    echo '<div '. implode( ' ', $wrapper_atts ) .'>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
        echo '<ul class="products columns-'. esc_attr( $columns ) .' row botiga-carousel-stage">';
            foreach ( $related_products as $related_product ) :

                $post_object = get_post( $related_product->get_id() );

                setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                wc_get_template_part( 'content', 'product' );

            endforeach;
        echo '</ul>';
    echo '</div>';
    ?>

</section>