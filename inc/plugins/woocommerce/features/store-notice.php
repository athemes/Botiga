<?php
/**
 * Store Notice
 *
 * @package Botiga
 */

/**
 * Shortcode suppport to store notice
 */
function botiga_store_notice_add_shortcode_support( $notice ) {
	if ( strpos( $notice, '[' ) !== false ) {
		$notice = str_replace(
			array( '<p class="woocommerce-store-notice demo_store"', '</p>' ),
			array( '<div class="woocommerce-store-notice demo_store"', '</div>' ),
			$notice
		);
		
		return do_shortcode( $notice );
	}
	return $notice;
}
add_filter( 'woocommerce_demo_store', 'botiga_store_notice_add_shortcode_support' );

/**
 * Custom CSS
 */
function botiga_store_notice_custom_css( $css ) {
    
    // Background Color
    $css .= Botiga_Custom_CSS::get_background_color_css( 
        'shop_store_notice_background_color', 
        '#3d9cd2', 
        '.woocommerce-store-notice' 
    );

    // Text Color
    $css .= Botiga_Custom_CSS::get_color_css( 
        'shop_store_notice_text_color', 
        '#212121', 
        '.woocommerce-store-notice' 
    );

    // Link Color
    $css .= Botiga_Custom_CSS::get_color_css( 
        'shop_store_notice_link_color', 
        '#212121', 
        '.woocommerce-store-notice a' 
    );
    $css .= Botiga_Custom_CSS::get_color_css( 
        'shop_store_notice_link_color_hover', 
        '#757575', 
        '.woocommerce-store-notice a:hover' 
    );

    // Wrapper Padding
    $css .= Botiga_Custom_CSS::get_responsive_dimensions_css( 
        'shop_store_notice_wrapper_padding',
        array(
            'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        ), 
        '.woocommerce-store-notice', 
        'padding'
    );

    return $css;
}
add_filter( 'botiga_custom_css_output', 'botiga_store_notice_custom_css' );