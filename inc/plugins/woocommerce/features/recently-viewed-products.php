<?php
/**
 * Recently viewed products
 *
 * @package Botiga
 */

/**
 * Always track product views
 */
function botiga_wc_track_product_view() {
	$single_recently_viewed_products = get_theme_mod( 'single_recently_viewed_products', 0 );

	if ( ! is_singular( 'product' ) || ! $single_recently_viewed_products ) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) { // @codingStandardsIgnoreLine.
		$viewed_products = array();
	} else {
		$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ); // @codingStandardsIgnoreLine.
	}

	// Unset if already in viewed products list.
	$keys = array_flip( $viewed_products );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 15 ) {
		array_shift( $viewed_products );
	}

	// Store for session only.
	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}
remove_action( 'template_redirect', 'wc_track_product_view', 20 );
add_action( 'template_redirect', 'botiga_wc_track_product_view', 20 );

/**
 * Recently viewed products output
 */
function botiga_woocommerce_output_recently_viewed_products( $args = array() ) { 
	global $product;

	if ( ! $product || ! isset( $_COOKIE['woocommerce_recently_viewed'] ) ) {
		return;
	}

	$enable = get_theme_mod( 'single_recently_viewed_products', 0 );

	if( ! $enable ) {
		return;
	}

	$posts_per_page = get_theme_mod( 'shop_single_recently_viewed_products_number', 3 );
	$columns        = get_theme_mod( 'shop_single_recently_viewed_products_columns_number', 3 );
	$slider		    = get_theme_mod( 'shop_single_recently_viewed_products_slider', 0 );
	$slider_nav     = get_theme_mod( 'shop_single_recently_viewed_products_slider_nav', 'always-show' );

	$defaults = array(
		'posts_per_page' => $posts_per_page,
		'orderby'        => 'rand',
		'order'          => 'desc'
	);

	$args = wp_parse_args( $args, $defaults );

	// Get visible recently viewed products then sort them at random.
	$args['products'] = array_filter( array_map( 'wc_get_product', explode( '|', sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) ) ), 'wc_products_array_filter_visible' );

	// Handle orderby.
	$products = array_slice( wc_products_array_orderby( $args['products'], $args['orderby'], $args['order'] ), 0, $posts_per_page ); 
	
	if( count( $products ) === 0 ) {
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
		$wrapper_classes = array( 'botiga-recently-viewed-products' );
		
		if( $slider ) {
			wp_enqueue_script( 'botiga-carousel' );
			wp_localize_script( 'botiga-carousel', 'botiga_carousel', botiga_localize_carousel_options() );	
		

			$wrapper_classes[] = 'botiga-carousel botiga-carousel-nav2';

			if( $slider_nav === 'always-show' ) {
				$wrapper_classes[] = 'botiga-carousel-nav2-always-show';
			}

			$wrapper_atts[] = 'data-per-page="'. absint( $columns ) .'"';
		}

		// Mount recently viewed products wrapper class
		$wrapper_atts[] = 'class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

		echo '<div '. implode( ' ', $wrapper_atts ) .'>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
			echo '<ul class="products columns-'. esc_attr( $columns ) .' row botiga-carousel-stage">';
				foreach ( $products as $p ) :
	
					$post_object = get_post( $p->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );

				endforeach;
			echo '</ul>';
		echo '</div>';
		?>

	</section>
	
	<?php
}
add_action( 'woocommerce_after_single_product_summary', 'botiga_woocommerce_output_recently_viewed_products', apply_filters( 'botiga_woocommerce_after_single_product_summary_recently_viewed_products_order', 21 ) );