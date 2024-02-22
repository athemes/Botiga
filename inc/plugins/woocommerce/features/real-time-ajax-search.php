<?php
/**
 * Real Time Ajax Search
 *
 * @package Botiga
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue scripts and styles.
 * 
 */
function botiga_enqueue_ajax_search_css_and_js() {
	$ajax_search = get_theme_mod( 'shop_search_enable_ajax', 0 );

	if( $ajax_search ) {
		$posts_per_page       = get_theme_mod( 'shop_search_ajax_posts_per_page', 15 );
		$order                = get_theme_mod( 'shop_search_ajax_order', 'asc' );
		$orderby              = get_theme_mod( 'shop_search_ajax_orderby', 'none' );
		$show_categories      = get_theme_mod( 'shop_search_ajax_show_categories', 1 );
		$enable_search_by_sku = get_theme_mod( 'shop_search_ajax_enable_search_by_sku', 0 );

		wp_register_script( 'botiga-ajax-search', get_template_directory_uri() . '/assets/js/botiga-ajax-search.min.js', array( 'jquery' ), BOTIGA_VERSION, true );
		wp_enqueue_script( 'botiga-ajax-search' );
		wp_localize_script( 'botiga-ajax-search', 'botiga_ajax_search', array(
			'nonce' => wp_create_nonce( 'botiga-ajax-search-random-nonce' ),
			'query_args' => array(

                /**
                 * Hook 'botiga_shop_ajax_search_posts_per_page'
                 *
                 * @since 1.0.0
                 */
				'posts_per_page'       => apply_filters( 'botiga_shop_ajax_search_posts_per_page', $posts_per_page ),

                /**
                 * Hook 'botiga_shop_ajax_search_order'
                 *
                 * @since 1.0.0
                 */
				'order'                => apply_filters( 'botiga_shop_ajax_search_order', $order ),

                /**
                 * Hook 'botiga_shop_ajax_search_orderby'
                 *
                 * @since 1.0.0
                 */
				'orderby'              => apply_filters( 'botiga_shop_ajax_search_orderby', $orderby ),

                /**
                 * Hook 'botiga_shop_ajax_search_show_categories'
                 *
                 * @since 1.0.0
                 */
				'show_categories'      => apply_filters( 'botiga_shop_ajax_search_show_categories', $show_categories ),

                /**
                 * Hook 'botiga_shop_ajax_search_enable_search_by_sku'
                 *
                 * @since 1.0.0
                 */
				'enable_search_by_sku' => apply_filters( 'botiga_shop_ajax_search_enable_search_by_sku', $enable_search_by_sku ),
			),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'botiga_enqueue_ajax_search_css_and_js', 11 );

/**
 * Ajax Search Callback
 * 
 */
function botiga_ajax_search_callback() {
	check_ajax_referer( 'botiga-ajax-search-random-nonce', 'nonce' );

    /**
     * Hook 'botiga_ajax_search_search_term'
     *
     * @since 1.0.0
     */
    $search_term          = isset( $_POST['search_term'] ) ? apply_filters( 'botiga_ajax_search_search_term', sanitize_text_field( wp_unslash( $_POST['search_term'] ) ) ) : '';
    $posts_per_page       = isset( $_POST['posts_per_page'] ) ? absint( $_POST['posts_per_page'] ) : 15;
    $order                = isset( $_POST['order'] ) ? sanitize_text_field( wp_unslash( $_POST['order'] ) ) : 'asc';
    $orderby              = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : 'title'; 
    $enable_search_by_sku = isset( $_POST['enable_search_by_sku'] ) && sanitize_text_field( wp_unslash( $_POST['enable_search_by_sku'] ) ) ? true : false;
    $see_all_button       = get_theme_mod( 'shop_search_ajax_display_see_all', 0 );
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $posts_per_page,
        's'              => $search_term,
        'order'          => $order,
        'orderby'        => $orderby,
        'post_status'    => array( 'publish' ),
    );
    
    if( $orderby === 'price' ) {
        $args[ 'meta_key' ] = '_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        $args[ 'orderby' ]  = 'meta_value_num';
    }

    $output = '';
    $qry = new WP_Query( $args );

    // Enable search by SKU
    if( $enable_search_by_sku ) {
        $qry->posts = array_unique( array_merge( $qry->posts, botiga_ajax_search_get_products_by_sku( $posts_per_page, $order, $orderby, $search_term ) ), SORT_REGULAR );
        $qry->post_count = count( $qry->posts );
    }

    if( $qry->have_posts() ) :
        $output .= '<h2 class="botiga-ajax-search__heading-title">'. esc_html__( 'Products', 'botiga' ) .'</h2>';
        $output .= '<hr class="botiga-ajax-search__divider">';
        $output .= '<div class="botiga-ajax-search-products">';

            while( $qry->have_posts() ) :
                $qry->the_post();

                $post = get_post();

                $args = array(
                    'post_id' => $post->ID,
                    'type'    => 'product',
                );

                ob_start();
                botiga_get_template_part( 'template-parts/content', 'ajax-search-item', $args );
                $output .= ob_get_clean();

            endwhile;     

        $output .= '</div>';
        
        if( $see_all_button ) {
            $search_link_mounted = add_query_arg( 'post_type', 'product', get_search_link( $search_term ) );

            $output .= '<div class="botiga-ajax-search__see-all">';
                $output .= '<a href="'. esc_url( $search_link_mounted ) .'" class="botiga-ajax-search__see-all-link">' . esc_html( 
                    /* Translators: 1. Search results quantity */
                    sprintf( __( 'See all products (%s)', 'botiga' ), $qry->post_count ) 
                ) . '<span class="bas-arrow">→</span></a>';
            $output .= '</div>';
        }
    endif;

    // Categories
    $show_categories = isset( $_POST['show_categories'] ) ? absint( $_POST['show_categories'] ) : 1;
    if( $show_categories ) {
        $args = array(
            'taxonomy' => 'product_cat',
            'name__like' => $search_term,
        );
        $cats = get_terms( $args );
    
        if( count( $cats ) > 0 && $search_term ) {
            $output .= '<h2 class="botiga-ajax-search__heading-title">'. esc_html__( 'Categories', 'botiga' ) .'</h2>';
            $output .= '<hr class="botiga-ajax-search__divider">';
            $output .= '<div class="botiga-ajax-search-categories">';
    
                foreach( $cats as $category ) {
                    $args = array(
                        'term_id' => $category->term_id,
                        'type'    => 'category',
                    );
    
                    ob_start();
                    botiga_get_template_part( 'template-parts/content', 'ajax-search-item', $args );
                    $output .= ob_get_clean();
                }
                
            $output .= '</div>';
        }
    }

    if( $output ) {
        wp_send_json( array(
            'status'  => 'success',
            'output'  => wp_kses_post( $output ),
        ) );
    } else {
        $output = '<p class="botiga-ajax-search__no-results">'. esc_html__( 'No products found.', 'botiga' ) .'</p>';

        wp_send_json( array(
            'status'  => 'success',
            'type'    => 'no-results',
            'output'  => wp_kses_post( $output ),
        ) );
    }
}
add_action('wp_ajax_botiga_ajax_search_callback', 'botiga_ajax_search_callback');
add_action('wp_ajax_nopriv_botiga_ajax_search_callback', 'botiga_ajax_search_callback');

/**
 * Get products by SKU.
 * 
 */
function botiga_ajax_search_get_products_by_sku( $posts_per_page, $order, $orderby, $search_term ) {
    $args = array(
        'post_type'      => array( 'product', 'product_variation' ),
        'posts_per_page' => $posts_per_page,
        'order'          => $order,
        'orderby'        => $orderby,
        'post_status'    => array( 'publish' ),
        'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
            'relation' => 'OR',
            array(
                'key' => '_sku',
                'value' => $search_term,
                'compare' => 'LIKE',
            ),
        ),
    );
    
    if( $orderby === 'price' ) {
        $args[ 'meta_key' ] = '_price'; // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        $args[ 'orderby' ]  = 'meta_value_num';
    }

    $qry_sku = new WP_Query( $args );

    return $qry_sku->posts;
}

/**
 * Include the search by SKU in the default search.
 * 
 */
function botiga_merge_sku_search_with_default_search( $clauses, $query ) {
	global $wpdb;
	
    $enable_search_by_sku = get_theme_mod( 'shop_search_ajax_enable_search_by_sku', 0 );

    if( ! $enable_search_by_sku ) {
        return $clauses;
    }

	// Do not implement the search by sku whether the search is being made by extra plugins.
	// Otherwise it might break the extra plugin functionality.
	if( isset( $_GET[ 'yith_wcan' ] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return $clauses;
	}

    if ( ! is_admin() && $query->is_main_query() && $query->is_search() && $query->get( 'post_type' ) === 'product' && $query->get( 's' ) !== '' ) {
		$search_term = $wpdb->esc_like( $query->get('s') );
		
		$clauses['join'] = " LEFT JOIN {$wpdb->prefix}postmeta ON ( {$wpdb->prefix}posts.ID = {$wpdb->prefix}postmeta.post_id )";
		$clauses['where'] .= $wpdb->prepare( " OR ( {$wpdb->prefix}postmeta.meta_key = '_sku' AND {$wpdb->prefix}postmeta.meta_value LIKE %s )", "%{$search_term}%" );
	}
		
	return $clauses;
}
add_filter( 'posts_clauses', 'botiga_merge_sku_search_with_default_search', 10, 2 );

/**
 * Custom CSS
 * 
 */
function botiga_ajax_search_custom_css( $css ) {
    $shop_ajax_search = get_theme_mod( 'shop_search_enable_ajax', 0 );

    if( ! $shop_ajax_search ) {
        return $css;
    }

    $css .= Botiga_Custom_CSS::get_border_color_rgba_css( 'color_body_text', '#212121', '.botiga-ajax-search__wrapper ,.botiga-ajax-search__item+.botiga-ajax-search__item:before', '0.1', true );
    $css .= Botiga_Custom_CSS::get_background_color_rgba_css( 'color_body_text', '#212121', '.botiga-ajax-search__divider', '0.1', true );

    return $css;
}
add_filter( 'botiga_custom_css_output', 'botiga_ajax_search_custom_css' );
