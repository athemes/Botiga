<?php
/**
 * Template part for displaying ajax search content.
 *
 * @package Botiga
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$query = $args['query'];
$data  = $args['data'];

/**
 * Hook 'botiga_shop_ajax_search_before_products_loop'
 * 
 * @param WP_Query $query WP_Query object.
 * @param string $search_term Search term.
 * 
 * @since 2.2.4
 */
do_action( 'botiga_shop_ajax_search_before_products_loop', $query, $data );

if ( $query->have_posts() ) :

	/**
	 * Hook 'botiga_shop_ajax_search_products_loop_start'
	 * 
	 * @param WP_Query $query WP_Query object.
	 * @param string $search_term Search term.
	 * 
	 * @since 2.2.4
	 */
	do_action( 'botiga_shop_ajax_search_products_loop_start', $query, $data );

	while( $query->have_posts() ) :
		$query->the_post();

		$_post = get_post();

		$args = array(
			'post_id' => $_post->ID,
			'type'    => 'product',
		);

		botiga_get_template_part( 'template-parts/search/content', 'ajax-search-item', $args );
	endwhile;

	/**
	 * Hook 'botiga_shop_ajax_search_products_loop_end'
	 * 
	 * @param WP_Query $query WP_Query object.
	 * @param string $search_term Search term.
	 * 
	 * @since 2.2.4
	 */
	do_action( 'botiga_shop_ajax_search_products_loop_end', $query, $data );
		
endif;

/**
 * Hook 'botiga_shop_ajax_search_after_products_loop'
 * 
 * @param WP_Query $query WP_Query object.
 * @param string $search_term Search term.
 * 
 * @since 2.2.4
 */
do_action( 'botiga_shop_ajax_search_after_products_loop', $query, $data );