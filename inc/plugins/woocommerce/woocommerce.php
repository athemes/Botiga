<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Botiga
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function botiga_woocommerce_setup() {

	$enable_zoom 	= get_theme_mod( 'single_zoom_effects', 1 );
	$enable_gallery = get_theme_mod( 'single_gallery_slider', 1 );

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 420,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			)
		)
	);
	
	if ( $enable_zoom ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	}

	if ( $enable_gallery ) {
		add_theme_support( 'wc-product-gallery-slider' );
	}

	add_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'botiga_woocommerce_setup' );

/**
 * WooCommerce admin specific scripts & stylesheets.
 *
 * @return void
 */
function botiga_admin_woocommerce_scripts() {
	$current_screen = get_current_screen();

    if( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
		wp_enqueue_style( 'botiga-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.min.css', array(), BOTIGA_VERSION );
	}
}
add_action( 'admin_enqueue_scripts', 'botiga_admin_woocommerce_scripts' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function botiga_woocommerce_scripts() {
	$single_product_gallery = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	if ( current_theme_supports( 'wc-product-gallery-slider' ) && in_array( $single_product_gallery, array( 'gallery-vertical' ) ) ) {
		wp_enqueue_script( 'botiga-swiper', get_template_directory_uri() . '/assets/js/botiga-swiper.min.js', array(), BOTIGA_VERSION, true );
	}

	if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
		wp_enqueue_script( 'botiga-gallery', get_template_directory_uri() . '/assets/js/botiga-gallery.min.js', array( 'botiga-custom' ), BOTIGA_VERSION, true );
	}

	wp_enqueue_style( 'botiga-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.min.css', array(), BOTIGA_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}
		@font-face {
			font-family: "WooCommerce";
			src: url("' . $font_path . 'WooCommerce.eot");
			src: url("' . $font_path . 'WooCommerce.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'WooCommerce.woff") format("woff"),
				url("' . $font_path . 'WooCommerce.ttf") format("truetype"),
				url("' . $font_path . 'WooCommerce.svg#WooCommerce") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'botiga-woocommerce-style', $inline_font );

	// Sidebar
	$shop_archive_sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if( 'sidebar-slide' === $shop_archive_sidebar && ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) ) {
		wp_register_script( 'botiga-sidebar', get_template_directory_uri() . '/assets/js/botiga-sidebar.min.js', array( 'botiga-custom' ), BOTIGA_VERSION, true );
		wp_enqueue_script( 'botiga-sidebar' );
	}
}
add_action( 'wp_enqueue_scripts', 'botiga_woocommerce_scripts', 9 );

/**
 * Enqueue WooCommerce specific scripts & stylesheets after custom.min.js.
 * Useful when we need handle with custom.min.js functions
 *
 * @return void
 */
function botiga_woocommerce_scripts_after_custom_js() {
	// Ajax Search
	$ajax_search = get_theme_mod( 'shop_search_enable_ajax', 0 );
	if( $ajax_search ) {
		$posts_per_page  = get_theme_mod( 'shop_search_ajax_posts_per_page', 15 );
		$order 			 = get_theme_mod( 'shop_search_ajax_order', 'asc' );
		$orderby 		 = get_theme_mod( 'shop_search_ajax_orderby', 'none' );
		$show_categories = get_theme_mod( 'shop_search_ajax_show_categories', 1 );

		wp_register_script( 'botiga-ajax-search', get_template_directory_uri() . '/assets/js/botiga-ajax-search.min.js', NULL, BOTIGA_VERSION, true );
		wp_enqueue_script( 'botiga-ajax-search' );
		wp_localize_script( 'botiga-ajax-search', 'botiga_ajax_search', array(
			'nonce' => wp_create_nonce( 'botiga-ajax-search-random-nonce' ),
			'query_args' => array(
				'posts_per_page'  => apply_filters( 'botiga_shop_ajax_search_posts_per_page', $posts_per_page ),
				'order' 		  => apply_filters( 'botiga_shop_ajax_search_order', $order ),
				'orderby' 		  => apply_filters( 'botiga_shop_ajax_search_orderby', $orderby ),
				'show_categories' => apply_filters( 'botiga_shop_ajax_search_show_categories', $show_categories )
			)
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'botiga_woocommerce_scripts_after_custom_js', 11 );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function botiga_woocommerce_active_body_class( $classes ) {
	global $template;
	$template_name = basename($template);
	
	$single_breadcrumbs = get_theme_mod( 'single_breadcrumbs', 1 );
	if( ! $single_breadcrumbs && is_single() ) {
		$classes[] = 'no-single-breadcrumbs';
	}

	$classes[] = 'woocommerce-active';

	if( 'template-wishlist.php' === $template_name ) {
		$classes[] = 'woocommerce-cart';
	}

	// Shop catalog responsive columns
	$shop_columns_tablet  = get_theme_mod( 'shop_woocommerce_catalog_columns_tablet', 3 );
	$shop_columns_mobile  = get_theme_mod( 'shop_woocommerce_catalog_columns_mobile', 1 );

	$classes[] = 'shop-columns-tablet-' . absint( $shop_columns_tablet );
	$classes[] = 'shop-columns-mobile-' . absint( $shop_columns_mobile ); 

	return $classes;
}
add_filter( 'body_class', 'botiga_woocommerce_active_body_class' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Layout shop archive
 */
function botiga_wc_archive_layout() {

	$archive_sidebar 	    = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );
	$shop_categories_layout = get_theme_mod( 'shop_categories_layout', 'layout1' );
	$shop_archive_sidebar_filter_in_desktop = get_theme_mod( 'shop_archive_sidebar_filter_in_desktop', 1 );

	if ( $archive_sidebar === 'sidebar-slide' && $shop_archive_sidebar_filter_in_desktop ) {
		$archive_sidebar .= ' sidebar-desktop';
	}

	if ( 'no-sidebar' === $archive_sidebar ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}

	if ( 'sidebar-top' === $archive_sidebar ) {
		$shop_archive_sidebar_top_columns = get_theme_mod( 'shop_archive_sidebar_top_columns', '4' );

		$archive_sidebar .= ' sidebar-top-columns-' . $shop_archive_sidebar_top_columns;
	}

	$archive_sidebar .= ' product-category-item-' . $shop_categories_layout;
	
	$layout = get_theme_mod( 'shop_archive_layout', 'product-grid' );	

	$button_layout      = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$equal_height       = get_theme_mod( 'shop_product_equal_height', 0 );
	$equal_height_class = ( ! empty( $equal_height ) && $button_layout === 'layout2' && $layout === 'product-grid' ) ? ' product-equal-height' : '';

	return $archive_sidebar . ' ' . $layout . $equal_height_class;
}

/**
 * Layout single product
 */
function botiga_wc_single_layout() {

  // Sidebar layout
	$sidebar_layout = get_theme_mod( 'single_product_sidebar', 'no-sidebar' );
  
  $meta_sidebar_layout = get_post_meta( get_the_ID(), '_botiga_sidebar_layout', true );

  if ( ! empty( $meta_sidebar_layout ) && $meta_sidebar_layout !== 'customizer' ) {
  	$sidebar_layout = $meta_sidebar_layout;
  }

  // Remove sidebar
  if ( $sidebar_layout === 'no-sidebar' ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		add_filter( 'botiga_sidebar', '__return_false' );
  }

	return $sidebar_layout;

}

/**
 * Hook into Woocommerce
 */
function botiga_wc_hooks() {

	//No sidebar for checkout, cart, account
	if ( is_cart() ) {
		add_filter( 'botiga_content_class', function() { 
			$layout = get_theme_mod( 'shop_cart_layout', 'layout1' ); 

			return 'no-sidebar cart-' . esc_attr( $layout ); 
		} );
		add_filter( 'botiga_sidebar', '__return_false' );
	} elseif ( is_checkout() ) {
		add_filter( 'botiga_content_class', function() { $layout = get_theme_mod( 'shop_checkout_layout', 'layout1' ); return 'no-sidebar checkout-' . esc_attr( $layout ); } );
		add_filter( 'botiga_sidebar', '__return_false' );
	} elseif( is_account_page() ) {
		add_filter( 'botiga_content_class', function() { return 'no-sidebar'; } );
		add_filter( 'botiga_sidebar', '__return_false' );
	}

	//Archive layout
	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		add_filter( 'botiga_content_class', 'botiga_wc_archive_layout' );
	}

	//Single product settings
	if ( is_product() ) {
		$single_breadcrumbs = get_theme_mod( 'single_breadcrumbs', 1 );

		//Content class
		add_filter( 'botiga_content_class', 'botiga_wc_single_layout' );

		add_action( 'woocommerce_before_add_to_cart_button', 'botiga_single_addtocart_wrapper_open' );
		add_action( 'woocommerce_after_add_to_cart_button', 'botiga_single_addtocart_wrapper_close' );

		//Breadcrumbs
		if ( !$single_breadcrumbs ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		}

		//Elements Order
		$single_product_gallery = get_theme_mod( 'single_product_gallery', 'gallery-default' );
		if( 'gallery-full-width' !== $single_product_gallery ) {
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
	
			$defaults 	= botiga_get_default_single_product_components();
			$components = get_theme_mod( 'single_product_elements_order', $defaults );

			foreach ( $components as $component ) {
				if( ! function_exists( $component ) ) {
					continue;
				}

				add_action( 'woocommerce_single_product_summary', $component, 5 );
			}
			
			add_action( 'woocommerce_single_product_summary', function(){ echo '<div class="elements-order-end"></div>'; }, 50 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		}

		//Move sale tag
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );
		add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 99 );
	}

	//Move cart collaterals
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );
	add_action( 'woocommerce_before_cart_collaterals', function() {
		echo woocommerce_cart_totals(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '</div>';
	} );

	//Results and sorting
	$shop_results_count 	= get_theme_mod( 'shop_results_count', 1 );
	$shop_product_sorting 	= get_theme_mod( 'shop_product_sorting', 1 );

	if ( !$shop_product_sorting ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	}

	if ( !$shop_results_count ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}
	
	//Shop sidebar
	$shop_archive_sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if( 'sidebar-slide' === $shop_archive_sidebar ) {
		add_action( 'woocommerce_before_shop_loop', function() {
			$shop_archive_sidebar_open_button_text = get_theme_mod( 'shop_archive_sidebar_open_button_text', '' );
			$shop_archive_sidebar_open_icon        = get_theme_mod( 'shop_archive_sidebar_open_icon', 1 );

			$icon = '';
			if( $shop_archive_sidebar_open_icon ) {
				$icon = botiga_get_svg_icon( 'icon-filters' );
			}

			$text = '';
			if( $shop_archive_sidebar_open_button_text ) {
				$text = $shop_archive_sidebar_open_button_text;
			}

			echo '<div class="sidebar-open-wrapper'. ( $text ? ' has-text' : '' ) .'">';
			echo '    <a href="#" role="button" class="sidebar-open" onclick="botiga.toggleClass.init(event, this, \'sidebar-slide-open\');" data-botiga-selector=".sidebar-slide+.widget-area" data-botiga-toggle-class="show">'. $icon . esc_html( $text ) .'</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
			
		}, 19 );
	}

	//Cart total sticky
	$shop_cart_sticky_totals_box = get_theme_mod( 'shop_cart_sticky_totals_box', 0 );
	$cart_layout                 = get_theme_mod( 'shop_cart_layout', 'layout1' ); 

	if( $shop_cart_sticky_totals_box && $cart_layout === 'layout2' ) {
		add_action( 'woocommerce_before_cart', function(){ echo '<div class="cart-totals-sticky"></div>'; }, 999 );
	}

}
add_action( 'wp', 'botiga_wc_hooks' );

/**
 * Loop shop columns callback
 */
function botiga_loop_shop_columns() {
	$columns_desktop = get_theme_mod( 'shop_woocommerce_catalog_columns_desktop', 4 );
	return $columns_desktop;
}
add_filter( 'loop_shop_columns', 'botiga_loop_shop_columns' );

/**
 * Loop shop rows callback
 */
function botiga_loop_shop_per_page() {
	$columns = get_theme_mod( 'shop_woocommerce_catalog_columns_desktop', 4 );
	$rows    = get_theme_mod( 'shop_woocommerce_catalog_rows', 4 );
	return $columns * $rows;
}
add_filter( 'loop_shop_per_page', 'botiga_loop_shop_per_page' );

/**
 * Loop shop product title
 */
function botiga_shop_loop_product_title() {
	global $post;
	
	echo wp_kses_post( the_title( '<h2 class="woocommerce-loop-product__title"><a class="botiga-wc-loop-product__title" href="'. esc_url( get_the_permalink( $post->ID ) ) .'">', '</a></h2>' ) );
}

/**
 * Single add to cart wrapper
 */
function botiga_single_addtocart_wrapper_open() {
	echo '<div class="botiga-single-addtocart-wrapper">';
}

function botiga_single_addtocart_wrapper_close() {
	echo '</div>';
}

/**
 * Quantity buttons
 */
function botiga_woocommerce_before_quantity_input_field() {
	echo '<a href="#" class="botiga-quantity-minus" role="button">'. esc_html( botiga_get_quantity_symbols_output( 'minus' ) ) .'</a>';
}
add_action( 'woocommerce_before_quantity_input_field', 'botiga_woocommerce_before_quantity_input_field' );

function botiga_woocommerce_after_quantity_input_field() {
	echo '<a href="#" class="botiga-quantity-plus" role="button">'. esc_html( botiga_get_quantity_symbols_output( 'plus' ) ) .'</a>';
}
add_action( 'woocommerce_after_quantity_input_field', 'botiga_woocommerce_after_quantity_input_field' );

function botiga_get_quantity_symbols_output( $type = 'plus' ) {
	$qty_style = get_theme_mod( 'shop_general_quantity_style', 'style1' );

	if( in_array( $qty_style, array( 'style1', 'style2', 'style4', 'style5', 'style6', 'style8' ) ) ) {
		if( $type === 'plus' ) {
			return '+';
		} else {
			return '-';
		}
	}

	return '';
}

/**
 * Loop product category
 */
function botiga_loop_product_category() {
	echo '<div class="product-category">' . wc_get_product_category_list( get_the_id() ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Loop product description
 */
function botiga_loop_product_description() {
	$content = get_the_excerpt();

	echo '<div class="product-description">' . wp_kses_post( wp_trim_words( $content, 12, '&hellip;' ) ) . '</div>';
}

if ( ! function_exists( 'botiga_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function botiga_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'botiga_woocommerce_wrapper_before' );

if ( ! function_exists( 'botiga_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function botiga_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'botiga_woocommerce_wrapper_after' );

/**
 * Wrap products results and ordering before
 */
function botiga_wrap_products_results_ordering_before() {
	if( ! botiga_has_woocommerce_sorting_wrapper() ) {
		return;
	}

	echo '<div class="woocommerce-sorting-wrapper">';
	echo '<div class="row">';
	echo '<div class="col-md-6 col-6 botiga-sorting-left">';
	echo '<div class="botiga-sorting-left-inner">';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_wrap_products_results_ordering_before', 19 );

/**
 * Add a button to toggle filters on shop archives
 */
function botiga_add_filters_button() {
	if( ! botiga_has_woocommerce_sorting_wrapper() ) {
		return;
	}

	echo '</div>';
	echo '</div>';
	echo '<div class="col-md-6 col-6 botiga-sorting-right">';
	echo '<div class="botiga-sorting-right-inner">';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_add_filters_button', 22 );

/**
 * Wrap products results and ordering after
 */
function botiga_wrap_products_results_ordering_after() {
	if( ! botiga_has_woocommerce_sorting_wrapper() ) {
		return;
	}
	
	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_wrap_products_results_ordering_after', 31 );

/**
 * Check if has "woocommerce-sorting-wrapper"
 */
function botiga_has_woocommerce_sorting_wrapper() {
	$shop_grid_list_view  = get_theme_mod( 'shop_grid_list_view', 1 );
	$shop_product_sorting = get_theme_mod( 'shop_product_sorting', 1 );
	$shop_results_count   = get_theme_mod( 'shop_results_count', 1 );
	$shop_archive_sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if( ! $shop_grid_list_view && ! $shop_product_sorting && ! $shop_results_count && $shop_archive_sidebar !== 'sidebar-slide' ) {
		return false;
	}

	return true;
}

/**
 * Checkout wrapper
 */
function botiga_wrap_order_review_before() {
	echo '<div class="checkout-wrapper">';
}
add_action( 'woocommerce_checkout_before_order_review_heading', 'botiga_wrap_order_review_before', 5 );

/**
 * Checkout wrapper end
 */
function botiga_wrap_order_review_after() {
	echo '</div>';
}
add_action( 'woocommerce_checkout_after_order_review', 'botiga_wrap_order_review_after', 15 );

/**
 * My account page 
 * Identify the page and insert html so we can style some elements
 */
function botiga_myaccount_html_insert() {
    if( !isset( $_SERVER['REQUEST_URI'] ) && is_account_page() ) {
		return;
	}

	$request_url = wc_clean( wp_unslash( $_SERVER['REQUEST_URI'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
    
	// view-order
    if( strpos( $request_url, '/view-order' ) !== FALSE || strpos( $request_url, '&view-order=' ) !== FALSE ) {
        echo '<div class="botiga-wc-account-view-order"></div>';
    }
}
add_action( 'woocommerce_account_content', 'botiga_myaccount_html_insert', 0 );

/**
 * Header Mini Cart
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/mini-cart.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Shop Page Header
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/wc-page-header.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Sale Badge
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/sale-badge.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Quick View
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/quick-view.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Quick View
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/wishlist.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Cross Sell
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/cross-sell.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Sticky Add To Cart
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/sticky-add-to-cart.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Product Card
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/product-card.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Single Product Gallery
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/single-product-gallery.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Single Product Tabs
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/single-product-tabs.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Upsell Products
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/upsell-products.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Related Products
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/related-products.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Recently viewed products
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/recently-viewed-products.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * WooCommerce GB Blocks
 */
require get_template_directory() . '/inc/plugins/woocommerce/features/wc-editor-blocks.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * WooCommerce Template Functions
 */
require get_template_directory() . '/inc/plugins/woocommerce/woocommerce-template-functions.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * WooCommerce Ajax Callbacks
 */
require get_template_directory() . '/inc/plugins/woocommerce/woocommerce-ajax-callbacks.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
