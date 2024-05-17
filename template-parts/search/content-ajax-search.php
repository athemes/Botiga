<?php
/**
 * Template part for displaying ajax search content.
 * 
 * This template can be overridden by copying it to yourtheme/template-parts/search/content-ajax-search.php.
 *
 * HOWEVER, on occasion Botiga will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 *
 * @package Botiga\Templates
 * @version 2.2.4
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

		botiga_get_template_part( 'template-parts/search/content', 'ajax-search-item', array( 'post_id' => $_post->ID ) );
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