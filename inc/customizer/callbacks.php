<?php
/**
 * Active callback functions
 *
 * @package Botiga
 */


/**
 * Footer widgets divider
 */
function botiga_callback_footer_widgets_divider() {
    
    $divider = get_theme_mod( 'footer_widgets_divider' );

	if ( $divider ) {
		return true;
	} else {
		return false;
	}   
}

function botiga_callback_sidebar_archives() {
    $sidebar = get_theme_mod( 'sidebar_archives' );

	if ( $sidebar ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * Single post layout
 */
function botiga_callback_single_post_layout() {
    $blog_single_layout = get_theme_mod( 'blog_single_layout', 'layout1' );

	if ( $blog_single_layout !== 'layout3' ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * Single post sidebar
 */
function botiga_callback_sidebar_single_post() {
    $sidebar            = get_theme_mod( 'sidebar_single_post', 1 );
	$blog_single_layout = get_theme_mod( 'blog_single_layout', 'layout1' );

	if ( $sidebar && $blog_single_layout !== 'layout3' ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * Single post author bio align
 */
function botiga_callback_single_post_show_author_box() {
    $enable = get_theme_mod( 'single_post_show_author_box', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * Single post show related posts
 */
function botiga_callback_single_post_show_related_posts() {
    $enable = get_theme_mod( 'single_post_show_related_posts', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * Single post related posts slider show
 */
function botiga_callback_single_post_related_posts_slider_navigation() {
    $related_posts = get_theme_mod( 'single_post_show_related_posts', 0 );
	$slider        = get_theme_mod( 'single_post_related_posts_slider', 0 );

	if ( $related_posts && $slider ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * Sale percentage
 */
function botiga_callback_sale_percentage() {
    $enable = get_theme_mod( 'sale_badge_percent', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}  
}

/**
 * Footer credits divider
 */
function botiga_callback_footer_credits_divider() {
    $divider = get_theme_mod( 'footer_credits_divider', 1 );

	if ( $divider ) {
		return true;
	} else {
		return false;
	}      
}

/**
 * Footer copyright alignment
 */
function botiga_callback_footer_copyright_alignment() {
    $layout = get_theme_mod( 'footer_copyright_layout', 'col2' );

	if ( $layout !== 'col2' ) {
		return true;
	} else {
		return false;
	}      
}

/**
 * Footer copyright elements
 */
function botiga_callback_footer_copyright_elements( $element, $check_columns_number = false ) {
	$elements = get_theme_mod( 'footer_copyright_elements', array( 'footer_credits', 'footer_social_profiles' ) );

	if ( in_array( $element, $elements ) ) {
		if( $check_columns_number ) {
			$cols = get_theme_mod( 'footer_copyright_layout', 'col2' );

			if( $cols === 'col2' ) {
				return true; 
			} else {
				return false;
			}
		}

		return true;
	} else {
		return false;
	}

}

/**
 * Enable custom palette
 */
function botiga_callback_custom_palette() {
    $enable = get_theme_mod( 'custom_palette_toggle', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}      
}

/**
 * Excerpt
 */
function botiga_callback_excerpt() {
    $enable = get_theme_mod( 'show_excerpt', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	} 	
}

/**
 * Scroll to top
 */
function botiga_callback_scrolltop() {
    $enable = get_theme_mod( 'enable_scrolltop', 1 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}	
}

function botiga_callback_scrolltop_text() {
    $enable = get_theme_mod( 'enable_scrolltop', 1 );
	$type 	= get_theme_mod( 'scrolltop_type', 'icon' );

	if ( $enable && 'text' === $type ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Read more
 */
function botiga_callback_read_more() {
    $enable = get_theme_mod( 'read_more_link', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	} 	
}

/**
 * Grid archives
 */
function botiga_callback_grid_archives() {
	$layout = get_theme_mod( 'blog_layout', 'layout3' );

	if ( 'layout3' === $layout || 'layout5' === $layout ) {
		return true;
	} else {
		return false;
	}
}

/**
 * List archives
 */
function botiga_callback_list_archives() {
	$layout = get_theme_mod( 'blog_layout', 'layout3' );

	if ( 'layout4' === $layout ) {
		return true;
	} else {
		return false;
	}
}

/**
 * List archives
 */
function botiga_callback_list_general_archives() {
	$layout = get_theme_mod( 'blog_layout', 'layout3' );

	if ( 'layout4' === $layout || 'layout6' === $layout ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Author avatar
 */
function botiga_callback_author_avatar() {
	$meta = get_theme_mod( 'archive_meta_elements', array( 'post_date' ) );

	if ( in_array( 'post_author', $meta ) ) {
		return true;
	} else {
		return false;
	}

}

/**
 * Header layouts
 */
function botiga_callback_header_layout_1_2() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_1' === $layout || 'header_layout_2' === $layout || 'header_layout_6' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_3() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_3' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_4() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_4' === $layout ) {
		return true;
	} else { 
		return false;
	}
}


function botiga_callback_header_layout_5() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_5' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_not_1() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_1' !== $layout && 'header_layout_6' !== $layout && 'header_layout_7' !== $layout && 'header_layout_8' !== $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_not_6() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_6' !== $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_not_6_7_8() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( ! in_array( $layout, array( 'header_layout_6', 'header_layout_7', 'header_layout_8' ) ) ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_not_7_8() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( ! in_array( $layout, array( 'header_layout_7', 'header_layout_8' ) ) ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_is_6() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_6' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_is_7() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_7' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_layout_is_7_8() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	
	if ( 'header_layout_7' === $layout || 'header_layout_8' === $layout ) {
		return true;
	} else { 
		return false;
	}
}

function botiga_callback_header_bottom() {
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );

	if ( 'header_layout_3' === $layout || 'header_layout_4' === $layout || 'header_layout_5' === $layout ) {
		return true;
	} else { 
		return false;
	}
}


/**
 * Sticky header
 */
function botiga_callback_sticky_header() {
	$header_layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	$enable        = get_theme_mod( 'enable_sticky_header', 0 );

	if ( $enable && $header_layout !== 'header_layout_6' ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Header elements
 */
function botiga_callback_header_elements( $element ) {
	
	$layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );

	switch ( $layout ) {
		case 'header_layout_1':
		case 'header_layout_2':
		case 'header_layout_6':
			$elements = get_theme_mod( 'header_components_l1', array( 'search' ) );

			if ( in_array( $element, $elements ) ) {
				return true;
			} else {
				return false;
			}

			break;

		case 'header_layout_3':
			$elements 		= get_theme_mod( 'header_components_l3left' );
			$elements_right = get_theme_mod( 'header_components_l3right' );

			if ( in_array( $element, $elements ) || in_array( $element, $elements_right ) ) {
				return true;
			} else {
				return false;
			}

			break;	
			
		case 'header_layout_4':
			$elements 			= get_theme_mod( 'header_components_l4top' );
			$elements_bottom 	= get_theme_mod( 'header_components_l4bottom' );

			if ( in_array( $element, $elements ) || in_array( $element, $elements_bottom ) ) {
				return true;
			} else {
				return false;
			}

			break;	
			
		case 'header_layout_5':
			$elements 			= get_theme_mod( 'header_components_l5topleft' );
			$elements_right 	= get_theme_mod( 'header_components_l5topright' );
			$elements_bottom 	= get_theme_mod( 'header_components_l5bottom' );

			if ( in_array( $element, $elements ) || in_array( $element, $elements_bottom ) || in_array( $element, $elements_right ) ) {
				return true;
			} else {
				return false;
			}

			break;

		default:
			return false;

			break;			
	}
}

/**
 * Top bar elements
 */
function botiga_callback_topbar_elements( $element ) {
	
	$elements_left 	= get_theme_mod( 'topbar_components_left' );
	$elements_right = get_theme_mod( 'topbar_components_right' );

	if ( in_array( $element, $elements_left ) || in_array( $element, $elements_right ) ) {
		return true;
	} else {
		return false;
	}
}

function botiga_callback_topbar_center_contents() {
	$elements_left 	= get_theme_mod( 'topbar_components_left' );
	$elements_right = get_theme_mod( 'topbar_components_right' );	

	if ( empty( $elements_left ) || empty( $elements_right ) ) {
		return true;
	} else {
		return false;
	}	
}

/**
 * WooCommerce cart sticky totals box
 */
function botiga_callback_shop_cart_layout() {
	$layout = get_theme_mod( 'shop_cart_layout', 'layout1' );

	if ( $layout !== 'layout1' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * WooCommerce checkout sticky totals box
 */
function botiga_callback_shop_checkout_layout() {
	$layout = get_theme_mod( 'shop_checkout_layout', 'layout1' );

	if ( $layout === 'layout1' ) {
		return true;
	} else {
		return false;
	}
}

/**
 * WooCommerce single sticky add to cart
 */
function botiga_callback_single_sticky_add_to_cart() {
	$enable = get_theme_mod( 'single_sticky_add_to_cart', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}	
}

/**
 * WooCommerce single product image layout
 */
function botiga_callback_single_product_gallery_image_layout() {
	$layout = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	if ( 'gallery-showcase' === $layout || 'gallery-full-width' === $layout ) {
		return true;
	} else {
		return false;
	}	
}

/**
 * WooCommerce single tabs
 */
function botiga_callback_single_tabs_border_color_active() {
	$layout = get_theme_mod( 'single_product_tabs_layout', 'style1' );

	if( ! in_array( $layout, array( 'style3', 'style5' ) ) ) {
		return true;
	} else {
		return false;
	}
}

function botiga_callback_single_tabs_background_color() {
	$layout = get_theme_mod( 'single_product_tabs_layout', 'style1' );

	if( ! in_array( $layout, array( 'style1', 'style2' ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * WooCommerce single image gallery
 */
function botiga_callback_single_product_gallery_layout() {
	$layout = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	if( ! in_array( $layout, array( 'gallery-grid', 'gallery-scrolling', 'gallery-showcase', 'gallery-full-width' ) ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * WooCommerce product catalog sidebar
 */
function botiga_callback_shop_archive_sidebar_slide() {
	$sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if ( 'sidebar-slide' === $sidebar ) {
		return true;
	} else {
		return false;
	}	
}

function botiga_callback_shop_archive_sidebar_top() {
	$sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if ( 'sidebar-top' === $sidebar ) {
		return true;
	} else {
		return false;
	}	
}

/**
 * Woocommerce single show related products
 */
function botiga_callback_shop_single_show_related_products() {
    $enable = get_theme_mod( 'single_related_products', 0 );

	if ( $enable ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * Woocommerce single related products slider show
 */
function botiga_callback_shop_single_related_products_slider_navigation() {
    $related_products = get_theme_mod( 'single_related_products', 0 );
	$slider           = get_theme_mod( 'shop_single_related_products_slider', 0 );

	if ( $related_products && $slider ) {
		return true;
	} else {
		return false;
	}   	
}

/**
 * WooCommerce product catalog page header style
 */
function botiga_callback_shop_archive_header_style_alignment() {
	$style = get_theme_mod( 'shop_archive_header_style', 'style1' );

	if ( 'style2' !== $style ) {
		return true;
	} else {
		return false;
	}	
}

/**
 * WooCommerce product catalog wishlist
 */
function botiga_callback_shop_product_wishlist_layout() {
	$layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );

	if( 'layout1' !== $layout ) {
		return true;
	} else {
		return false;
	}
}

function botiga_callback_shop_product_wishlist_tooltip() {
	$layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );
	$enable = get_theme_mod( 'shop_product_wishlist_tooltip', 0 );

	if( $enable && 'layout1' !== $layout ) {
		return true;
	} else {
		return false;
	}
}