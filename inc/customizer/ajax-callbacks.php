<?php
/**
 * Customizer
 * Ajax callback functions
 *
 * @package Botiga
 */

/**
 * Create page control ajax callback
 */
function botiga_create_page_control() {
	check_ajax_referer( 'customize-create-page-control-nonce', 'nonce' );
    
    $page_title      = isset( $_POST['page_title'] ) ? wp_strip_all_tags( wp_unslash( $_POST['page_title'] ) ) : '';
    $page_meta_key   = isset( $_POST['page_meta_key'] ) ? sanitize_text_field( wp_unslash( $_POST['page_meta_key'] ) ) : '';
    $page_meta_value = isset( $_POST['page_meta_value'] ) ? sanitize_text_field( wp_unslash( $_POST['page_meta_value'] ) ) : '';
    $option_name     = isset( $_POST['option_name'] ) ? sanitize_text_field( wp_unslash( $_POST['option_name'] ) ) : '';

    $meta_input = array();
    if( $page_meta_key && $page_meta_value ) { 
        $meta_input = array(
            $page_meta_key => $page_meta_value
        );
    }

    $postarr = array(
        'post_type'    => 'page',
        'post_status'  => 'publish',
        'post_title'    => $page_title,
        'post_content' => '',
        'meta_input'   => $meta_input
    );

	$page_id = wp_insert_post( $postarr );

    if( !is_wp_error( $page_id ) ) {
        if( $option_name ) {
            update_option( wp_unslash( $option_name ), $page_id );
        }

        wp_send_json( array(
            'status'  => 'success',
            'page_id' => $page_id
        ) );
    } else {
        wp_send_json( array(
            'status'  => 'error'
        ) );
    }
}
add_action('wp_ajax_botiga_create_page_control', 'botiga_create_page_control');