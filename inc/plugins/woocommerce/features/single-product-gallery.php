<?php
/**
 * Single Product Gallery
 *
 * @package Botiga
 */

/**
 * WC Hooks 
 */
function botiga_single_product_gallery_hooks() {
    if( ! is_product() ) {
        return;
    }

    $single_product_gallery = get_theme_mod( 'single_product_gallery', 'gallery-default' );

    //Gallery
    if( 'gallery-grid' === $single_product_gallery || 'gallery-scrolling' === $single_product_gallery ) {
        remove_theme_support( 'wc-product-gallery-slider' );
        remove_theme_support( 'wc-product-gallery-zoom' );
        add_action( 'woocommerce_single_product_summary', function(){ echo '<div class="sticky-entry-summary">'; }, -99 );
        add_action( 'woocommerce_single_product_summary', function(){ echo '</div>'; }, 99 );
        add_filter( 'woocommerce_gallery_image_size', function(){ return 'woocommerce_single'; } );
    }

    if( 'gallery-showcase' === $single_product_gallery ) {
        remove_theme_support( 'wc-product-gallery-zoom' );
        add_action( 'woocommerce_single_product_summary', function(){ echo '<div class="sticky-entry-summary">'; }, -99 );
        add_action( 'woocommerce_single_product_summary', function(){ echo '</div>'; }, 99 );
    }

    if( 'gallery-full-width' === $single_product_gallery ) {
        remove_theme_support( 'wc-product-gallery-zoom' );
        add_action( 'woocommerce_single_product_summary', function(){ echo '<div class="gallery-full-width-title-wrapper">'; }, 0 );
        add_action( 'woocommerce_single_product_summary', function(){ echo '</div><div class="gallery-full-width-addtocart-wrapper">'; }, 20 );
        add_action( 'woocommerce_single_product_summary', function(){ echo '</div>'; }, 99 );
    }
}
add_action( 'wp', 'botiga_single_product_gallery_hooks' );

/**
 * Single product top area wrapper
 */
function botiga_single_product_wrap_before() {
	$single_product_gallery = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	echo '<div class="product-gallery-summary ' . esc_attr( $single_product_gallery ) . '">';
}
add_action( 'woocommerce_before_single_product_summary', 'botiga_single_product_wrap_before', -99 );

/**
 * Single product top area wrapper
 */
function botiga_single_product_wrap_after() {
	echo '</div>';
}
add_action( 'woocommerce_after_single_product_summary', 'botiga_single_product_wrap_after', 9 );

/**
 * Filter single product Flexslider options
 */
function botiga_product_carousel_options( $options ) {

	$layout = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	if ( 'gallery-single' === $layout ) {
		$options['controlNav'] = false;
		$options['directionNav'] = true;
	}

	if ( 'gallery-showcase' === $layout || 'gallery-full-width' === $layout ) {
		$options['controlNav'] = 'thumbnails';
		$options['directionNav'] = true;
	}

	return $options;
}
add_filter( 'woocommerce_single_product_carousel_options', 'botiga_product_carousel_options' );
