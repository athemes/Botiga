<?php
/**
 * Sanitize functions
 *
 * @package Botiga
 */


/**
 * Selects
 */
function botiga_sanitize_select( $input, $setting ){
          
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
}

/**
 * Select2
 */
function botiga_sanitize_select2( $input, $setting ){        
    if( empty( $input ) ) {
        return '';
    }

    $input   = strpos( $input, ',' ) !== FALSE ? explode( ',', $input ) : array( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;

    foreach( $input as $key => $value ) {
        $input[ $key ] = sanitize_key( $value );

        if( ! array_key_exists( $input[ $key ], $choices ) ) {
            return $setting->default;
        }
    }

    return implode( ',', $input );
}

/**
 * Sanitize blog elements
 */
function botiga_sanitize_blog_meta_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'post_date', 'post_categories', 'post_author', 'post_comments' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

function botiga_sanitize_single_meta_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'botiga_posted_on', 'botiga_posted_by', 'botiga_post_categories', 'botiga_entry_comments', 'botiga_post_reading_time' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize header components
 */
function botiga_sanitize_header_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( botiga_header_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

function botiga_sanitize_header_components_layout_7_8( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( botiga_header_elements_layout_7_8() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize mobile header components
 */
function botiga_sanitize_mobile_header_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( botiga_mobile_header_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize mobile off-canvas header components
 */
function botiga_sanitize_mobile_offcanvas_header_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( botiga_mobile_offcanvas_header_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize loop product components
 */
function botiga_sanitize_product_loop_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();

    /**
     * Hook 'botiga_sanitize_product_loop_components'
     *
     * @since 1.0.0
     */
    $elements   = apply_filters( 'botiga_sanitize_product_loop_components', array( 'botiga_shop_loop_product_title', 'woocommerce_template_loop_rating', 'woocommerce_template_loop_price', 'botiga_loop_product_category', 'botiga_loop_product_description' ) );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize single product components
 */
function botiga_sanitize_single_product_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = botiga_get_default_single_product_components();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize single product sitcky add to cart elements
 */
function botiga_sanitize_single_add_to_cart_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'botiga_sticky_add_to_cart_product_image', 'botiga_sticky_add_to_cart_product_title', 'botiga_single_product_price', 'botiga_sticky_add_to_cart_product_addtocart' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize footer copyright elements
 */
function botiga_sanitize_footer_copyright_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'footer_credits', 'footer_social_profiles', 'footer_payment_icons', 'footer_navigation_menu', 'footer_html', 'footer_shortcode' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize top bar components
 */
function botiga_sanitize_topbar_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( botiga_topbar_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize text
 */
function botiga_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


/**
 * Sanitize URLs
 */
function botiga_sanitize_urls( $input ) {
    if ( strpos( $input, ',' ) !== false) {
        $input = explode( ',', $input );
    }
    if ( is_array( $input ) ) {
        foreach ($input as $key => $value) {
            $input[$key] = esc_url_raw( $value );
        }
        $input = implode( ',', $input );
    }
    else {
        $input = esc_url_raw( $input );
    }
    return $input;
}

/**
 * Sanitize hex and rgba
 */
function botiga_sanitize_hex_rgba( $input, $setting ) {
    if ( empty( $input ) || is_array( $input ) ) {
        return $setting->default;
    }

    if ( false === strpos( $input, 'rgb' ) ) {
        $input = sanitize_hex_color( $input );
    } elseif ( false == strpos( $input, 'rgba' ) ) {
            // Sanitize as RGB color
            $input = str_replace( ' ', '', $input );
            sscanf( $input, 'rgb(%d,%d,%d)', $red, $green, $blue );
            $input = 'rgb(' . botiga_in_range( $red, 0, 255 ) . ',' . botiga_in_range( $green, 0, 255 ) . ',' . botiga_in_range( $blue, 0, 255 ) . ')';
        }
        else {
            // Sanitize as RGBa color
            $input = str_replace( ' ', '', $input );
            sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
            $input = 'rgba(' . botiga_in_range( $red, 0, 255 ) . ',' . botiga_in_range( $green, 0, 255 ) . ',' . botiga_in_range( $blue, 0, 255 ) . ',' . botiga_in_range( $alpha, 0, 1 ) . ')';
    }
    return $input;
}

/**
 * Helper function to check if value is in range
 */
function botiga_in_range( $input, $min, $max ){
    if ( $input < $min ) {
        $input = $min;
    }
    if ( $input > $max ) {
        $input = $max;
    }
    return $input;
}

/**
 * Sanitize checkboxes
 */
function botiga_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize fonts
 */
function botiga_google_fonts_sanitize( $input ) {
    $val =  json_decode( $input, true );
    if( is_array( $val ) ) {
        foreach ( $val as $key => $value ) {
            $val[$key] = sanitize_text_field( $value );
        }
        $input = wp_json_encode( $val );
    }
    else {
        $input = wp_json_encode( sanitize_text_field( $val ) );
    }
    return $input;
}