<?php
/**
 * Sticky add to cart
 *
 * @package Botiga
 */

/**
 * Hooks 
 */
function botiga_sticky_add_to_cart_hooks() {
    if ( ! is_product() ) {
        return;
    }

    $single_sticky_add_to_cart		= get_theme_mod( 'single_sticky_add_to_cart', 0 );

    if( $single_sticky_add_to_cart ) {
        $single_sticky_add_to_cart_position = get_theme_mod( 'single_sticky_add_to_cart_position', 'bottom' );

        if( $single_sticky_add_to_cart_position === 'bottom' ) {
            add_action( 'botiga_footer_before', 'botiga_single_sticky_add_to_cart' );
        } else {
            add_action( 'botiga_page_header', 'botiga_single_sticky_add_to_cart' );
        }
    }

    
}
add_action( 'wp', 'botiga_sticky_add_to_cart_hooks' );

function botiga_single_sticky_add_to_cart() { 	
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/content', 'sticky-add-to-cart' );
	endwhile;
}

function botiga_sticky_add_to_cart_product_image() {
	the_post_thumbnail( 'thumbnail' );
}

function botiga_sticky_add_to_cart_product_title() {
	the_title( '<h5 class="sticky-addtocart-title">', '</h5>' );
}

function botiga_sticky_add_to_cart_product_addtocart() {
	global $product;

	switch ( $product->get_type() ) {
		case 'grouped':
			botiga_grouped_add_to_cart( $product, 'single_sticky_addtocart' );
			break;
		
		case 'variable':
			botiga_variable_add_to_cart( $product, 'single_sticky_addtocart' );
			break;

		case 'external':
			botiga_external_add_to_cart( $product, 'single_sticky_addtocart' );
			break;
		
		default:
			botiga_simple_add_to_cart( $product, 'single_sticky_addtocart' );
			break;
	}
}