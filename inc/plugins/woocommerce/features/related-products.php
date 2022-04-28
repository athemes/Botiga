<?php
/**
 * Related Products
 *
 * @package Botiga
 */

/**
 * Hooks 
 */
function botiga_related_products_hooks() {
    $single_related = get_theme_mod( 'single_related_products', 1 );
	$hook_order     = apply_filters( 'botiga_woocommerce_after_single_product_summary_related_products_order', 20 );

    if ( !$single_related ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', $hook_order );
    } else {
        $shop_single_related_products_columns_number = get_theme_mod( 'shop_single_related_products_columns_number', 3 );
        $single_related_products_slider 			 = get_theme_mod( 'shop_single_related_products_slider', 0 );
        
        if( $shop_single_related_products_columns_number == 2 ) {
            add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-large'; } );
        }

        if( $shop_single_related_products_columns_number == 1 ) {
            add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-extra-large'; } );
        }
        
        if( $single_related_products_slider ) {
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', $hook_order );
            add_action( 'woocommerce_after_single_product_summary', 'botiga_woocommerce_output_related_products_slider', $hook_order );
        }
    }
}
add_action( 'wp', 'botiga_related_products_hooks' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function botiga_woocommerce_related_products_args( $args ) {
	$posts_per_page = get_theme_mod( 'shop_single_related_products_number', 3 );
	$columns        = get_theme_mod( 'shop_single_related_products_columns_number', 3 );

	$defaults = array(
		'posts_per_page' => $posts_per_page,
		'columns'        => $columns,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'botiga_woocommerce_related_products_args' );

/**
 * Related products as slider
 */
function botiga_woocommerce_output_related_products_slider( $args = array() ) { 
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

	// Get visible related products then sort them at random.
	$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

	// Handle orderby.
	$related_products = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] ); 
	
	if( count( $related_products ) === 0 ) {
		return;
	} ?>
	
	<section class="related products">

		<?php
		$heading = apply_filters( 'botiga_woocommerce_product_related_products_heading', __( 'Related products', 'botiga' ) );

		if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php

		$wrapper_atts = array();
		$wrapper_classes = array( 'botiga-related-products' );

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
	
	<?php
}