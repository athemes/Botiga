<?php
/**
 * Real Time Ajax Search
 *
 * @package Botiga
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

class Botiga_Real_Time_Ajax_Search_Helper {

	/**
	 * Get products.
	 * 
	 * @param int    $posts_per_page Number of products to display.
	 * @param string $search_term    Search term.
	 * @param string $order          Order of products.
	 * @param string $orderby        Order by.
	 * @param bool   $enable_search_by_sku Enable search by SKU.
	 * 
	 * @return WP_Query
	 */
	public static function get_products( $data = array() ) {
		if ( empty( $data ) ) {
			return array();
		}

		$query_args = array(
			'post_type'      => 'product',
			'posts_per_page' => $data['posts-per-page'],
			's'              => $data['search-term'],
			'order'          => $data['order'],
			'orderby'        => $data['orderby'],
			'post_status'    => array( 'publish' ),
			'tax_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => array( 'exclude-from-search' ),
					'operator' => 'NOT IN',
				),
			),
		);

		if ( get_option( 'woocommerce_hide_out_of_stock_items' ) === 'yes' ) {
			$query_args['meta_query'] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'     => '_stock_status',
					'value'   => 'outofstock',
					'compare' => 'NOT LIKE',
				),
			);
		}
		
		if( $data['orderby'] === 'price' ) {
			$query_args[ 'meta_key' ] = '_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			$query_args[ 'orderby' ]  = 'meta_value_num';
		}

		$qry = new WP_Query( $query_args );

		// Enable search by SKU
		if( $data['enable-search-by-sku'] ) {
			$qry->posts = array_unique( array_merge( Botiga_Real_Time_Ajax_Search_Helper::get_products_by_sku( $data ), $qry->posts ), SORT_REGULAR );
			$qry->post_count = count( $qry->posts );
		}

		return $qry;
	}

	/**
	 * Get products by SKU.
	 * 
	 * @param int    $posts_per_page Number of products to display.
	 * @param string $order          Order of products.
	 * @param string $orderby        Order by.
	 * @param string $search_term    Search term.
	 * 
	 * @return array
	 */
	public static function get_products_by_sku( $data = array() ) {
		if ( empty( $data ) ) {
			return array();
		}

		$args = array(
			'post_type'      => array( 'product', 'product_variation' ),
			'posts_per_page' => $data['posts-per-page'],
			'order'          => $data['order'],
			'orderby'        => $data['orderby'],
			'post_status'    => array( 'publish' ),
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'relation' => 'AND',
				array(
					'key' => '_sku',
					'value' => $data['search-term'],
					'compare' => 'LIKE',
				),
			),
			'tax_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => array( 'exclude-from-search' ),
					'operator' => 'NOT IN',
				),
			),
		);

		if ( get_option( 'woocommerce_hide_out_of_stock_items' ) === 'yes' ) {
			$args['meta_query'][] = array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'key'     => '_stock_status',
				'value'   => 'outofstock',
				'compare' => 'NOT LIKE',
			);
		}
		
		if( $data['orderby'] === 'price' ) {
			$args[ 'meta_key' ] = '_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			$args[ 'orderby' ]  = 'meta_value_num';
		}

		$qry_sku = new WP_Query( $args );

		return $qry_sku->posts;
	}

	/**
	 * Handle query post clauses
	 * 
	 * @param array $clauses Query clauses.
	 * @param object $query Query object.
	 * 
	 * @return array
	 */
	public static function set_query_post_clauses( $clauses, $query ) {
		global $wpdb;

		// Do not implement the search by sku whether the search is being made by extra plugins.
		// Otherwise it might break the extra plugin functionality.
		if( isset( $_GET[ 'yith_wcan' ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return $clauses;
		}

		if ( ! is_admin() && $query->is_main_query() && $query->is_search() && $query->get( 'post_type' ) === 'product' && $query->get( 's' ) !== '' ) {
			$search_term = $wpdb->esc_like( $query->get('s') );

			$clauses['join'] = " LEFT JOIN {$wpdb->prefix}postmeta ON ( {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id )";
			$clauses['where'] .= $wpdb->prepare( " OR ( {$wpdb->prefix}postmeta.meta_key = '_sku' AND {$wpdb->prefix}postmeta.meta_value LIKE %s )", "%{$search_term}%" );

			if ( get_option( 'woocommerce_hide_out_of_stock_items' ) === 'yes' ) {
				$clauses['where'] .= $wpdb->prepare( " AND ( {$wpdb->prefix}postmeta.meta_key = '_stock_status' AND {$wpdb->prefix}postmeta.meta_value NOT LIKE %s )", "outofstock" );
			}
		}
		
		return $clauses;
	}
}