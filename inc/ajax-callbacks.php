<?php
/**
 * Ajax Callbacks
 *
 * @package Botiga
 */

/**
 * Ajax Search Callback
 */
function botiga_ajax_search_callback() {
	check_ajax_referer( 'botiga-ajax-search-random-nonce', 'nonce' );

    $search_term    = isset( $_POST['search_term'] ) ? apply_filters( 'botiga_ajax_search_search_term', sanitize_text_field( wp_unslash( $_POST['search_term'] ) ) ) : '';
    $posts_per_page = isset( $_POST['posts_per_page'] ) ? absint( $_POST['posts_per_page'] ) : 15;
    $order          = isset( $_POST['order'] ) ? sanitize_text_field( wp_unslash( $_POST['order'] ) ) : 'asc';
    $orderby        = isset( $_POST['orderby'] ) ? sanitize_text_field( wp_unslash( $_POST['orderby'] ) ) : 'title'; 
    
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $posts_per_page,
        's'              => $search_term,
        'order'          => $order,
        'orderby'        => $orderby,
        'post_status'    => array( 'publish' )
    );
    
    if( $orderby === 'price' ) {
        $args['meta_key'] = '_price';
    }

    $output = '';
    $qry = new WP_Query( $args );

    if( $qry->have_posts() ) :
        $output .= '<h2 class="botiga-ajax-search__heading-title">'. esc_html__( 'Products', 'botiga' ) .'</h2>';
        $output .= '<hr class="botiga-ajax-search__divider">';
        $output .= '<div class="botiga-ajax-search-products">';

            while( $qry->have_posts() ) :
                $qry->the_post();

                $post = get_post();

                $args = array(
                    'post_id' => $post->ID,
                    'type'    => 'product'
                );

                ob_start();
                botiga_get_template_part( 'template-parts/content', 'ajax-search-item', $args );
                $output .= ob_get_clean();

            endwhile;     

        $output .= '</div>';
    endif;

    // Categories
    $show_categories = isset( $_POST['show_categories'] ) ? absint( $_POST['show_categories'] ) : 1;
    if( $show_categories ) {
        $args = array(
            'taxonomy' => 'product_cat',
            'name__like' => $search_term
        );
        $cats = get_terms( $args );
    
        if( count( $cats ) > 0 && $search_term ) {
            $output .= '<h2 class="botiga-ajax-search__heading-title">'. esc_html__( 'Categories', 'botiga' ) .'</h2>';
            $output .= '<hr class="botiga-ajax-search__divider">';
            $output .= '<div class="botiga-ajax-search-categories">';
    
                foreach( $cats as $category ) {
                    $args = array(
                        'term_id' => $category->term_id,
                        'type'    => 'category'
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
            'output'  => wp_kses_post( $output )
        ) );
    } else {
        $output = '<p class="botiga-ajax-search__no-results">'. esc_html__( 'No products found.', 'botiga' ) .'</p>';

        wp_send_json( array(
            'status'  => 'success',
            'type'    => 'no-results',
            'output'  => wp_kses_post( $output )
        ) );
    }
}
add_action('wp_ajax_botiga_ajax_search_callback', 'botiga_ajax_search_callback');
add_action('wp_ajax_nopriv_botiga_ajax_search_callback', 'botiga_ajax_search_callback');