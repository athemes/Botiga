<?php
/**
 * No products found popular products
 *
 * @package Botiga
 */

/**
 * Add popular products if no products found.
 */
function botiga_woocommerce_no_products_found_popular_products() {

	$enable = get_theme_mod( 'shop_search_enable_popular_products', 0 );

	if ( ! $enable || ! is_search() ) {
		return;
	}

?>
	<section class="products botiga-no-products-found-popular-products">
		<?php

			/**
			 * Hook 'botiga_woocommerce_no_products_found_popular_products_heading'
			 *
			 * @since 1.0.0
			 */
			$heading_text = apply_filters( 'botiga_woocommerce_no_products_found_popular_products_heading', esc_html__( 'Popular Products', 'botiga' ) );

			/**
			 * Hook 'botiga_woocommerce_no_products_found_popular_products_heading_tag'
			 *
			 * @since 1.0.0
			 */
			$heading_tag  = apply_filters( 'botiga_woocommerce_no_products_found_popular_products_heading_tag', 'h2' );

			if ( $heading_text ) {
				printf( '<%1$s>%2$s</%1$s>', tag_escape( $heading_tag ), esc_html( $heading_text ) );
			}

			/**
			 * Hook 'botiga_woocommerce_no_products_found_popular_products_grid_columns'
			 *
			 * @since 1.0.0
			 */
			$columns = apply_filters( 'botiga_woocommerce_no_products_found_popular_products_grid_columns', 5 );

			/**
			 * Hook 'botiga_woocommerce_no_products_found_popular_products_grid_rows'
			 *
			 * @since 1.0.0
			 */
			$rows    = apply_filters( 'botiga_woocommerce_no_products_found_popular_products_grid_rows', 1 );

			/**
			 * Hook 'botiga_woocommerce_no_products_found_popular_products_grid_orderby'
			 *
			 * @since 1.0.0
			 */
			$orderby = apply_filters( 'botiga_woocommerce_no_products_found_popular_products_grid_orderby', 'popularity' );
			$limit   = $columns * $rows;

			echo do_shortcode( '[products limit="'. $limit .'" columns="'. $columns .'" orderby="'. $orderby .'"]' );

		?>
	</section>
	<?php
}

add_action( 'woocommerce_no_products_found', 'botiga_woocommerce_no_products_found_popular_products' );
