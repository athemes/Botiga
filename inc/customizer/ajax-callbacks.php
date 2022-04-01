<?php
/**
 * Customizer
 * Ajax callback functions
 *
 * @package Botiga
 */

/**
 * Adobe fonts control kits ajax callback
 */
function botiga_typography_adobe_kits_control() {
	check_ajax_referer( 'customize-typography-adobe-kits-control-nonce', 'nonce' );
    
    $url       = 'https://typekit.com/api/v1/json/kits/';
    $response  = wp_remote_request( $url . '?token=' . esc_attr( $_POST[ 'token' ] ), array() );

    if ( wp_remote_retrieve_response_code( $response ) != '200' ) {
        update_option( 'botiga_adobe_fonts_kits', array() );

        wp_send_json( array(
            'status' => 'error',
            'output' => '<p>' . esc_html__( 'Invalid API token.', 'botiga' ) . '</p>'
        ) );
    }

    $fonts = array();
    $response_body = json_decode( wp_remote_retrieve_body( $response ) );
    foreach( $response_body->kits as $kit ) {
        $url       = 'https://typekit.com/api/v1/json/kits/' . esc_attr( $kit->id ) . '?token=' . esc_attr( $_POST[ 'token' ] );
		$response  = wp_remote_request( $url, array() );

		if ( wp_remote_retrieve_response_code( $response ) === 200 ) {
			$response_body = json_decode( wp_remote_retrieve_body( $response ) );

            $fonts[ $response_body->kit->id ] = array(
                'enable'       => true,
                'project_name' => $response_body->kit->name
            );

            foreach( $response_body->kit->families as $family ) {
                $fonts[ $response_body->kit->id ][ 'families' ][] = array(
                    'name'       => $family->name,
                    'css_name'   => $family->css_names,
                    'css_stack'  => $family->css_stack,
                    'subset'     => $family->subset,
                    'variations' => $family->variations
                );
            }

            update_option( 'botiga_adobe_fonts_kits', $fonts );
		}
    }

    // print_r( get_option( 'botiga_adobe_fonts_kits' ) );
    wp_send_json( array(
        'status'  => 'success',
        'output'  => botiga_customize_control_adobe_font_kits_output( get_option( 'botiga_adobe_fonts_kits' ), false )
    ) );
}
add_action('wp_ajax_botiga_typography_adobe_kits_control', 'botiga_typography_adobe_kits_control');

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

    if( ! is_wp_error( $page_id ) ) {
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