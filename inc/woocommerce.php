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

	//Enqueue gallery scripts for quick view
	$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
	
	if ( is_shop() || is_product_category() || is_product_tag() || botiga_wc_has_blocks() || is_cart() && $shop_cart_show_cross_sell ) {
		$quick_view_layout = get_theme_mod( 'shop_product_quickview_layout', 'layout1' );
		
		if( 'layout1' !== $quick_view_layout ) {
			$register_scripts = array();
			
			if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
				$register_scripts['flexslider'] = array(
					'src'     => plugins_url( 'assets/js/flexslider/jquery.flexslider.min.js', WC_PLUGIN_FILE ),
					'deps'    => array( 'jquery' )
				);
			}
			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
				$register_styles = array(
					'photoswipe' => array(
						'src'     => plugins_url( 'assets/css/photoswipe/photoswipe.min.css', WC_PLUGIN_FILE ),
						'deps'    => array()
					),
					'photoswipe-default-skin' => array(
						'src'     => plugins_url( 'assets/css/photoswipe/default-skin/default-skin.min.css', WC_PLUGIN_FILE ),
						'deps'    => array( 'photoswipe' )
					)
				);
				foreach ( $register_styles as $name => $props ) {
					wp_enqueue_style( $name, $props['src'], $props['deps'], BOTIGA_VERSION );
				}

				$register_scripts['photoswipe'] = array(
					'src'     => plugins_url( 'assets/js/photoswipe/photoswipe.min.js', WC_PLUGIN_FILE ),
					'deps'    => array()
				);
				$register_scripts['photoswipe-ui-default'] = array(
					'src'     => plugins_url( 'assets/js/photoswipe/photoswipe-ui-default.min.js', WC_PLUGIN_FILE ),
					'deps'    => array( 'photoswipe' )
				);
			}

			$register_scripts['wc-single-product'] = array(
				'src'     => plugins_url( 'assets/js/frontend/single-product.min.js', WC_PLUGIN_FILE ),
				'deps'    => array( 'jquery' )
			);

			if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
				$register_scripts['zoom'] = array(
					'src'     => plugins_url( 'assets/js/zoom/jquery.zoom.min.js', WC_PLUGIN_FILE ),
					'deps'    => array( 'jquery' )
				);
			}

			// Enqueue variation scripts.
			$register_scripts['wc-add-to-cart-variation'] = array(
				'src'     => plugins_url( 'assets/js/frontend/add-to-cart-variation.min.js', WC_PLUGIN_FILE ),
				'deps'    => array( 'jquery', 'wp-util', 'jquery-blockui' )
			);

			foreach ( $register_scripts as $name => $props ) {
				wp_enqueue_script( $name, $props['src'], $props['deps'], BOTIGA_VERSION );
			}

		}
	}

	//Cross sell
	$layout                    = get_theme_mod( 'shop_cart_layout', 'layout1' );
	$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );

	if( is_cart() && $layout === 'layout1' && $shop_cart_show_cross_sell && count( WC()->cart->get_cross_sells() ) > 2 ) {

		// We need register this script again because the order of 'wp_enqueue_scripts'
		wp_register_script( 'botiga-carousel', get_template_directory_uri() . '/assets/js/botiga-carousel.min.js', NULL, BOTIGA_VERSION );
		wp_enqueue_script( 'botiga-carousel' );
	}

	// Sidebar
	$shop_archive_sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if( 'sidebar-slide' === $shop_archive_sidebar && ( is_shop() || is_product_category() || is_product_tag() ) ) {
		wp_register_script( 'botiga-sidebar', get_template_directory_uri() . '/assets/js/botiga-sidebar.min.js', array( 'botiga-custom' ), BOTIGA_VERSION, true );
		wp_enqueue_script( 'botiga-sidebar' );
	}
}
add_action( 'wp_enqueue_scripts', 'botiga_woocommerce_scripts', 9 );

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
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function botiga_woocommerce_related_products_args( $args ) {
	$posts_per_page = get_theme_mod( 'shop_single_related_products_number', 3 );
	$columns        = get_theme_mod( 'shop_single_related_products_columns_number', 3 );

	$defaults = array(
		'posts_per_page' => $posts_per_page,
		'columns'        => $columns,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'botiga_woocommerce_related_products_args' );

/**
 * Check if page has woocommece GB blocks
 */
function botiga_wc_has_blocks() {
	global $post;
	
	if( $post ) {
		if( has_blocks( $post ) ) {
			$post_blocks = parse_blocks( $post->post_content );

			foreach( $post_blocks as $block ) {
				if( strpos( $block['blockName'], 'woocommerce/' ) !== FALSE ) {
					return true;
				}
			}
		}
	}

	return false;
}

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

	if ( 'no-sidebar' === $archive_sidebar ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}

	if ( 'sidebar-top' === $archive_sidebar ) {
		$shop_archive_sidebar_top_columns = get_theme_mod( 'shop_archive_sidebar_top_columns', '4' );

		$archive_sidebar .= ' sidebar-top-columns-' . $shop_archive_sidebar_top_columns;
	}

	$archive_sidebar .= ' product-category-item-' . $shop_categories_layout;
	
	$layout = get_theme_mod( 'shop_archive_layout', 'product-grid' );	

	return $archive_sidebar . ' ' . $layout;
}

/**
 * Layout single product
 */
function botiga_wc_single_layout() {
	$single_product_tabs_layout    = get_theme_mod( 'single_product_tabs_layout', 'style1' );
	$single_product_tabs_alignment = get_theme_mod( 'single_product_tabs_alignment', 'left' );

	return 'no-sidebar' . ' botiga-tabs-' . $single_product_tabs_layout . ' botiga-tabs-align-' . $single_product_tabs_alignment;
}

/**
 * Loop product structure
 */
function botiga_loop_product_structure() {
	$elements 	= get_theme_mod( 'shop_card_elements', array( 'botiga_shop_loop_product_title', 'woocommerce_template_loop_price' ) );
	$layout		= get_theme_mod( 'shop_product_card_layout', 'layout1' );

	if ( 'layout1' === $layout ) {
		foreach ( $elements as $element ) {
			call_user_func( $element );
		}
	} else {
		$elements = array_diff( $elements, array( 'woocommerce_template_loop_price' ) );

		echo '<div class="row">';
		echo '<div class="col-md-7">';
		foreach ( $elements as $element ) {
			call_user_func( $element );
		}		
		echo '</div>';
		echo '<div class="col-md-5 loop-price-inline">';
			woocommerce_template_loop_price();
		echo '</div>';
		echo '</div>';
	}

}

/**
 * Hook into Woocommerce
 */
function botiga_wc_hooks() {
	$layout			   		= get_theme_mod( 'shop_archive_layout', 'product-grid' );	
	$button_layout     		= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$quick_view_layout 		= get_theme_mod( 'shop_product_quickview_layout', 'layout1' );
	$wishlist_layout 		= get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );

	//Loop image wrapper extra class
	$loop_image_wrap_extra_class = 'botiga-add-to-cart-button-'. $button_layout;
	if( 'layout1' !== $quick_view_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-quick-view-button-'. $quick_view_layout;
	}

	if( 'layout1' !== $wishlist_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-wishlist-button-'. $wishlist_layout;
	}

	//No sidebar for checkout, cart, account
	if ( is_cart() ) {
		add_filter( 'botiga_content_class', function() { 
			$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
			$layout                    = get_theme_mod( 'shop_cart_layout', 'layout1' ); 

			if( $layout === 'layout1' && $shop_cart_show_cross_sell && count( WC()->cart->get_cross_sells() ) > 2 ) {
				$layout .= ' has-cross-sells-carousel';
			}
			
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
	if ( is_shop() || is_product_category() || is_product_tag()	) {
		add_filter( 'botiga_content_class', 'botiga_wc_archive_layout' );

		if ( 'product-list' === $layout ) {
			add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-big'; } );
			add_action( 'woocommerce_before_shop_loop_item', function() use ($loop_image_wrap_extra_class) { echo '<div class="row valign"><div class="col-md-4"><div class="loop-image-wrap '. esc_attr( $loop_image_wrap_extra_class ) .'">'; }, 1 );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { echo '</div></div><div class="col-md-8">'; }, 11 );
			add_action( 'woocommerce_after_shop_loop_item', function() { echo '</div>'; }, PHP_INT_MAX );
		}

		if ( 'product-grid' === $layout ) {
			$shop_woocommerce_catalog_columns_desktop = get_theme_mod( 'shop_woocommerce_catalog_columns_desktop', 4 );

			if( $shop_woocommerce_catalog_columns_desktop == 2 ) {
				add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-large'; } );
			}

			if( $shop_woocommerce_catalog_columns_desktop == 1 ) {
				add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-extra-large'; } );
			}
		}
	}

	//Single product settings
	if ( is_product() ) {
		$single_breadcrumbs 			= get_theme_mod( 'single_breadcrumbs', 1 );
		$single_tabs					= get_theme_mod( 'single_product_tabs', 1 );
		$single_related					= get_theme_mod( 'single_related_products', 1 );
		$single_upsell					= get_theme_mod( 'single_upsell_products', 1 );
		$single_sticky_add_to_cart		= get_theme_mod( 'single_sticky_add_to_cart', 0 );
		$single_product_gallery         = get_theme_mod( 'single_product_gallery', 'gallery-default' );

		//Content class
		add_filter( 'botiga_content_class', 'botiga_wc_single_layout' );

		//Remove sidebar
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		add_filter( 'botiga_sidebar', '__return_false' );

		add_action( 'woocommerce_before_add_to_cart_button', 'botiga_single_addtocart_wrapper_open' );
		add_action( 'woocommerce_after_add_to_cart_button', 'botiga_single_addtocart_wrapper_close' );

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

		//Breadcrumbs
		if ( !$single_breadcrumbs ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		}

		//Product tabs
		if ( !$single_tabs ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
		}

		//Related products
		if ( !$single_related ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		} else {
			$shop_single_related_products_columns_number = get_theme_mod( 'shop_single_related_products_columns_number', 3 );
			$single_related_products_slider 			 = get_theme_mod( 'shop_single_related_products_slider', 0 );
			
			if( $shop_single_related_products_columns_number == 2 ) {
				add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-large'; } );
			}

			if( $shop_single_related_products_columns_number == 1 ) {
				add_filter( 'single_product_archive_thumbnail_size', function(){ return 'botiga-extra-large'; } );
			}
			
			if( $single_related_products_slider ) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
				add_action( 'woocommerce_after_single_product_summary', 'botiga_woocommerce_output_related_products_slider', 20 );
			}
		}
		
		//Upsell products
		if ( !$single_upsell ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}	
		add_filter( 'woocommerce_upsells_columns', function() { return 3; } );
		add_filter( 'woocommerce_upsells_total', function() { return -1; } );
		
		//Move sale tag
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );
		add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 99 );

		// Sticky add to cart
		if( $single_sticky_add_to_cart ) {
			$single_sticky_add_to_cart_position = get_theme_mod( 'single_sticky_add_to_cart_position', 'bottom' );

			if( $single_sticky_add_to_cart_position === 'bottom' ) {
				add_action( 'botiga_footer_before', 'botiga_single_sticky_add_to_cart' );
			} else {
				add_action( 'botiga_page_header', 'botiga_single_sticky_add_to_cart' );
			}
		}

		//Wishlist
		add_action( 'woocommerce_single_product_summary', 'botiga_single_wishlist_button', 31 );
	}

	//Move cart collaterals
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );
	add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cart_totals' );

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
			$shop_archive_sidebar_open_icon        = get_theme_mod( 'shop_archive_sidebar_open_icon', 0 );

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

	//Cart cross sell
	$cart_layout               = get_theme_mod( 'shop_cart_layout', 'layout1' );
	$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );

	if( !$shop_cart_show_cross_sell ) {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	}
	add_filter( 'woocommerce_cross_sells_columns', function() use ($cart_layout) {
		return 'layout1' === $cart_layout ? 2 : 3;
	} );
	add_filter( 'woocommerce_cross_sells_total', function() use ($cart_layout) {
		return -1;
	} );

	//Cart total sticky
	$shop_cart_sticky_totals_box = get_theme_mod( 'shop_cart_sticky_totals_box', 0 );

	if( $shop_cart_sticky_totals_box && $cart_layout === 'layout2' ) {
		add_action( 'woocommerce_before_cart', function(){ echo '<div class="cart-totals-sticky"></div>'; }, 999 );
	}

	/**
	 * Loop product structure
	 */

	//Move link close tag
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 12 );

	//Wrap loop image
	if ( 'product-grid' === $layout || is_product() ) {
		//Wrap loop image
		add_action( 'woocommerce_before_shop_loop_item_title', function() use ($loop_image_wrap_extra_class) { echo '<div class="loop-image-wrap '. esc_attr( $loop_image_wrap_extra_class ) .'">'; }, 9 );
		add_action( 'woocommerce_before_shop_loop_item_title', function() { echo '</div>'; }, 11 );
	}

	if ( 'product-grid' === $layout ) {
		//Move button inside image wrap
		if ( 'layout4' === $button_layout && 'layout3' !== $quick_view_layout || 'layout3' === $button_layout && 'layout2' !== $quick_view_layout ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { botiga_wrap_loop_button_start(); woocommerce_template_loop_add_to_cart(); echo '</div>'; } );
		}
	} else {
		//Move button inside image wrap
		if ( 'layout4' === $button_layout && 'layout3' !== $quick_view_layout || 'layout3' === $button_layout && 'layout2' !== $quick_view_layout ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { botiga_wrap_loop_button_start(); woocommerce_template_loop_add_to_cart(); echo '</div>'; } );
		}
	}

	//Remove product title, rating, price
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

	//Add elements from sortable option
	add_action( 'woocommerce_after_shop_loop_item', 'botiga_loop_product_structure', 9 );

	//Wrap loop button
	if ( 'layout4' !== $button_layout ) {
		add_action( 'woocommerce_after_shop_loop_item', 'botiga_wrap_loop_button_start', 9 );
		add_action( 'woocommerce_after_shop_loop_item', function() { echo '</div>'; }, 11 );
	}

	//Remove button
	if( 'layout1' === $button_layout ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
	}

	//Quick view button & add to cart button
	if ( 
		( 'layout4' === $button_layout && 'layout3' === $quick_view_layout ) || 
		( 'layout3' === $button_layout && 'layout2' === $quick_view_layout ) 
	) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
	}

	//Quick view and wishlist buttons
	if ( is_shop() || is_product_category() || is_product_tag() || is_product() || botiga_wc_has_blocks() || is_cart() && $shop_cart_show_cross_sell ) {
		if( 'layout1' !== $quick_view_layout || 'layout1' !== $wishlist_layout ) {
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open' );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close' );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );
		}

		if( 'layout1' !== $quick_view_layout ) {
			add_action( 'woocommerce_before_shop_loop_item_title', 'botiga_quick_view_button', 10 );
			
			//Quick view popup
			add_action( 'wp_body_open', 'botiga_quick_view_popup' );
			
			// Do not include on single product pages
			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) && false === is_product() ) {
				add_action( 'botiga_footer_after', function(){
					wc_get_template( 'single-product/photoswipe.php' );
				} );
			}
		}

		if( 'layout1' !== $wishlist_layout ) {
			add_action( 'woocommerce_before_shop_loop_item_title', 'botiga_wishlist_button', 10 );
		}
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
 * Woocommerce post class callback
 */
function botiga_woocommerce_post_class( $classes ) {
	$wishlist_icon_show_on_hover = get_theme_mod( 'shop_product_wishlist_show_on_hover', 0 );
	if( $wishlist_icon_show_on_hover ) {
		$classes[] = 'botiga-wishlist-show-on-hover';
	}

	return $classes;
}
add_filter( 'woocommerce_post_class', 'botiga_woocommerce_post_class' );

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
 * Wrap loop button
 */
function botiga_wrap_loop_button_start() {
	$button_layout = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	echo '<div class="loop-button-wrap button-' . esc_attr( $button_layout ) . '">';
}

/**
 * Quantity buttons
 */
function botiga_woocommerce_before_quantity_input_field() {
	echo '<a href="#" class="botiga-quantity-minus" role="button">'. esc_html( '-', 'botiga' ) .'</a>';
}
add_action( 'woocommerce_before_quantity_input_field', 'botiga_woocommerce_before_quantity_input_field' );

function botiga_woocommerce_after_quantity_input_field() {
	echo '<a href="#" class="botiga-quantity-plus" role="button">'. esc_html( '+', 'botiga' ) .'</a>';
}
add_action( 'woocommerce_after_quantity_input_field', 'botiga_woocommerce_after_quantity_input_field' );

/**
 * Page header
 */
function botiga_woocommerce_page_header() {
	if ( !is_shop() && !is_product_category() && !is_product_tag() ) {
		return;
	}

	$shop_archive_header_style 					   = get_theme_mod( 'shop_archive_header_style', 'style1' );
	$shop_archive_header_style_alignment 		   = $shop_archive_header_style !== 'style2' ? get_theme_mod( 'shop_archive_header_style_alignment', 'center' ) : 'left';
	$shop_archive_header_style_show_categories 	   = get_theme_mod( 'shop_archive_header_style_show_categories', 0 );
	$shop_archive_header_style_show_sub_categories = get_theme_mod( 'shop_archive_header_style_show_sub_categories', 0 );
	$shop_page_title           					   = get_theme_mod( 'shop_page_title', 1 );
	$shop_page_description           			   = get_theme_mod( 'shop_page_description', 1 );
	$shop_breadcrumbs 							   = get_theme_mod( 'shop_breadcrumbs', 1 );

	//Remove elements
	add_filter( 'woocommerce_show_page_title', '__return_false' );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );

	if( ! $shop_page_title && ! $shop_page_description && ! $shop_breadcrumbs && ! $shop_archive_header_style_show_categories && ! $shop_archive_header_style_show_sub_categories ) {
		return;
	}
	?>
		<header class="woocommerce-page-header woocommerce-page-header-<?php echo esc_attr( $shop_archive_header_style ); ?> woocommerce-page-header-alignment-<?php echo esc_attr( $shop_archive_header_style_alignment ); ?>">
			<div class="container">
				<?php 
				if ( $shop_breadcrumbs ) { ?>
					<?php woocommerce_breadcrumb(); ?>
					</div>
					<div class="container">
				<?php
				}
				if ( ( $shop_page_title && ( is_shop() || is_product_category() || is_product_tag() ) ) || !is_shop() && !is_product_category() && !is_product_tag() ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif;

				if( ( $shop_page_description && ( is_shop() || is_product_category() || is_product_tag() ) ) || !is_shop() && !is_product_category() && !is_product_tag() ) {
					woocommerce_taxonomy_archive_description();
					woocommerce_product_archive_description();
				}
				if( is_shop() && $shop_archive_header_style_show_categories ) : ?>
					</div>
					<div class="container">
						<div class="categories-wrapper">
							<?php  
							$args = array(
								'taxonomy' => 'product_cat',
								'fields'   => 'id=>name',
								'parent'   => 0
							);
							$categories = get_terms( $args );
							
							foreach( $categories as $cat_id => $cat_name ) {
								$cat_link = get_term_link( $cat_id );
								echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) .'</a>';
							} ?>
						</div>
					<!-- </div> -->
				<?php endif; ?>
				<?php if( $shop_archive_header_style_show_sub_categories && ( is_product_category() || is_product_tag() ) ) : ?>
					</div>
					<div class="container">
						<div class="categories-wrapper">
							<?php 
							$category = get_category( $GLOBALS['wp_query']->get_queried_object() );
							$args = array(
								'taxonomy' => 'product_cat',
								'parent'   => $category->term_id,
								'fields'   => 'id=>name'
							);
							$categories = get_terms( $args );

							foreach( $categories as $cat_id => $cat_name ) {
								$cat_link = get_term_link( $cat_id );
								echo '<a href="'. esc_url( $cat_link ) .'" class="category-button" role="button">'. esc_html( $cat_name ) .'</a>';
							} ?>
						</div>
					<!-- </div> -->
				<?php endif; ?>
			</div>
		</header>
	<?php
}
add_action( 'botiga_page_header', 'botiga_woocommerce_page_header' );

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

	echo wp_kses_post( wp_trim_words( $content, 12, '&hellip;' ) );
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
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'botiga_woocommerce_header_cart' ) ) {
			botiga_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'botiga_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function botiga_woocommerce_cart_link_fragment( $fragments ) {
		$cart_icon = get_theme_mod( 'cart_icon', 'icon-cart' );

		ob_start();
		?>

		<span class="cart-count"><i class="ws-svg-icon"><?php botiga_get_svg_icon( $cart_icon, true ); ?></i><span class="count-number"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span></span>

		<?php
		$fragments['.cart-count'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'botiga_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'botiga_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function botiga_woocommerce_cart_link() {
		$cart_icon = get_theme_mod( 'cart_icon', 'icon-cart' );

		$link = '<a class="cart-contents" href="' . esc_url( wc_get_cart_url() ) . '" title="' . esc_attr__( 'View your shopping cart', 'botiga' ) . '">';
		$link .= '<span class="cart-count"><i class="ws-svg-icon">' . botiga_get_svg_icon( $cart_icon, false ) . '</i><span class="count-number">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span></span>';
		$link .= '</a>';

		return $link;
	}
}

if ( ! function_exists( 'botiga_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function botiga_woocommerce_header_cart() {
		$show_cart 		   = get_theme_mod( 'enable_header_cart', 1 );
		$show_account      = get_theme_mod( 'enable_header_account', 1 );
		$show_wishlist     = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ) !== 'layout1' ? true : false;
		$enable_header_wishlist_icon = get_theme_mod( 'enable_header_wishlist_icon', 1 );

		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>

		<?php if ( $show_account ) : ?>
		<?php echo '<a class="header-item wc-account-link" href="' . esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) . '" title="' . esc_html__( 'Your account', 'botiga' ) . '"><i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-user', false ) . '</i></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>	

		<?php if ( $show_cart ) : ?>
		<div id="site-header-cart" class="site-header-cart header-item">
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php echo botiga_woocommerce_cart_link();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php
			$instance = array(
				'title' => esc_html__( 'Your Cart', 'botiga' ),
			);

			the_widget( 'WC_Widget_Cart', $instance );
			?>
		</div>
		<?php endif; ?>
		<?php if( $show_wishlist && $enable_header_wishlist_icon ) : 
			$wishlist_count = isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ? count( explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) ) ) : 0; ?>
			<a class="header-item header-wishlist-icon" href="<?php echo esc_url( get_permalink( get_option('botiga_wishlist_page_id') ) ); ?>" title="<?php echo esc_attr__( 'Your wishlist', 'botiga' ); ?>">
				<span class="count-number"><?php echo esc_html( $wishlist_count ); ?></span>
				<i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-wishlist', true ); ?></i>
			</a>
		<?php endif; ?>
		<?php
	}
}

/**
 * Wrap products results and ordering before
 */
function botiga_wrap_products_results_ordering_before() {
	echo '<div class="woocommerce-sorting-wrapper">';
	echo '<div class="row">';
	echo '<div class="col-md-6 col-6">';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_wrap_products_results_ordering_before', 19 );

/**
 * Add a button to toggle filters on shop archives
 */
function botiga_add_filters_button() {
	echo '</div>';
	echo '<div class="col-md-6 col-6 text-align-right">';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_add_filters_button', 22 );

/**
 * Wrap products results and ordering after
 */
function botiga_wrap_products_results_ordering_after() {
	echo '</div>';
	echo '</div>';
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_wrap_products_results_ordering_after', 31 );

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
 * Woocommerce tabs titles
 */
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_false' );

/**
 * Loop add to cart
 */
function botiga_filter_loop_add_to_cart( $button, $product, $args ) {
	global $product;

	//Return if not button layout 4
	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$layout 		= get_theme_mod( 'shop_archive_layout', 'product-grid' );	

	if ( 'layout4' !== $button_layout ) {
		return $button;
	}

	if ( $product->is_type( 'simple' ) ) {
		$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i>';
	} else {
		$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-eye', false ) . '</i>';
	}

	$button = sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		$text
	);

	return $button;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'botiga_filter_loop_add_to_cart', 10, 3 );

/**
 * Sales badge text
 */
function botiga_sale_badge( $html, $post, $product ) {

	if ( !$product->is_on_sale() ) {
		return;
	}	

	$text 			= get_theme_mod( 'sale_badge_text', esc_html__( 'Sale!', 'botiga' ) );
	$enable_perc 	= get_theme_mod( 'sale_badge_percent', 0 );
	$perc_text 		= get_theme_mod( 'sale_percentage_text', '-{value}%' );

	if ( !$enable_perc ) {
		$badge = '<span class="onsale">' . esc_html( $text ) . '</span>';
	} else {
		if ( $product->is_type('variable' ) ) {
			$percentages = array();
			$prices = $product->get_variation_prices();
	  
			foreach( $prices['price'] as $key => $price ){
				if( $prices['regular_price'][$key] !== $price ){
					$percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
				}
			}
			$percentage = max( $percentages );
	  
		} elseif ( $product->is_type('grouped') ) {
			$percentages 	= array();
			$children_ids 	= $product->get_children();
	  
			foreach ( $children_ids as $child_id ) {
				$child_product = wc_get_product($child_id);
	  
				$regular_price = (float) $child_product->get_regular_price();
				$sale_price    = (float) $child_product->get_sale_price();
	  
				if ( $sale_price != 0 || ! empty($sale_price) ) {
					$percentages[] = round(100 - ($sale_price / $regular_price * 100));
				}
			}
			$percentage = max($percentages) ;
		} else {
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();
	  
			if ( $sale_price != 0 || ! empty($sale_price) ) {
				$percentage = round(100 - ($sale_price / $regular_price * 100) );
			} else {
				return $html;
			}
		}

		$perc_text = str_replace( '{value}', $percentage, $perc_text );

		$badge = '<span class="onsale">' . esc_html( $perc_text ) . '</span>';

	}
	
	return $badge;
}
add_filter( 'woocommerce_sale_flash', 'botiga_sale_badge', 10, 3 );

/**
 * Filter Woocommerce blocks
 * replaces default block product structure to allow theme options
 */
function botiga_filter_woocommerce_blocks( $html, $data, $product ){

	global $post;

	$button_layout 	   = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$layout			   = get_theme_mod( 'shop_product_card_layout', 'layout1' );
	$quick_view_layout = get_theme_mod( 'shop_product_quickview_layout', 'layout1' );
	$wishlist_layout   = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 

	$wc_block_grid_item_class = '';

	//Check for gb option to hide or show add to cart button
	if( strpos( $html, 'wp-block-button' ) === FALSE ) {
		$button_layout = 'layout1';
	}
	
	//Loop image wrapper extra class
	$loop_image_wrap_extra_class = 'botiga-add-to-cart-button-'. $button_layout;
	if( 'layout1' !== $quick_view_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-quick-view-button-'. $quick_view_layout;
	}

	if( 'layout1' !== $wishlist_layout ) {
		$loop_image_wrap_extra_class .= ' botiga-wishlist-button-'. $wishlist_layout;

		$wishlist_icon_show_on_hover = get_theme_mod( 'shop_product_wishlist_show_on_hover', 0 );
		if( $wishlist_icon_show_on_hover ) {
			$wc_block_grid_item_class .= 'botiga-wishlist-show-on-hover';
		}
	}

	$markup = "<li class=\"wc-block-grid__product product-grid $wc_block_grid_item_class\">
				<div class=\"loop-image-wrap $loop_image_wrap_extra_class\">
					<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
						{$data->image}
					</a>"
				. botiga_sale_badge( $html = '', $post, $product );

	//Add button inside image wrapper for layout4 and layout3
	if ( 'layout4' === $button_layout || 'layout3' === $button_layout ) {
		$markup .= "<div class=\"loop-button-wrap button-" . esc_attr( $button_layout ) . "\">"
				. botiga_gb_add_to_cart_button( $product ) .
				"</div>";
	}

	//Quick view
	$markup .= botiga_quick_view_button( $product, false );

	//Wishlist
	$markup .= botiga_wishlist_button( $product, false );

	$markup .= "</div>";
	
	if ( 'layout2' === $layout ) {
		$markup .= "<div class=\"row\">
					<div class=\"col-md-7\">";
	}

	$markup .= "<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
					{$data->title}
				</a>";
	
	$markup .= "{$data->rating}";

	if ( 'layout1' === $layout ) {
		$markup .= "{$data->price}";
	} else {
		$markup .= "</div><div class=\"col-md-5 loop-price-inline\">
		{$data->price}
		</div>
		</div>";
	}
		
	//Add button outside image wrapper		
	if ( 'layout1' !== $button_layout && 'layout4' !== $button_layout && 'layout3' !== $button_layout ) {
		$markup .= "<div class=\"loop-button-wrap button-" . esc_attr( $button_layout ) . "\">"
		. botiga_gb_add_to_cart_button( $product ) .
		"</div>";
	}

	$markup .= "</li>";

	return $markup;
}
add_filter( 'woocommerce_blocks_product_grid_item_html', 'botiga_filter_woocommerce_blocks', 10, 3 );

/**
 * Gutenberg blocks add to cart
 * replaces default add to cart block function to allow theme options
 */
function botiga_gb_add_to_cart_button( $product ) { 

	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );

	//Button text
	if ( 'layout4' !== $button_layout ) {
		$text = esc_html( $product->add_to_cart_text() );
	} else {
		if ( $product->is_type( 'simple' ) ) {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i>';
		} else {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-eye', false ) . '</i>';
		}
	}

	//Start markup
	$markup = '<div class="wp-block-button wc-block-grid__product-add-to-cart">';
	
	$attributes = array(
		'aria-label'       => $product->add_to_cart_description(),
		'data-quantity'    => '1',
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'rel'              => 'nofollow',
		'class'            => 'wp-block-button__link add_to_cart_button',
	);

	if (
		$product->supports( 'ajax_add_to_cart' ) &&
		$product->is_purchasable() &&
		( $product->is_in_stock() || $product->backorders_allowed() )
	) {
		$attributes['class'] .= ' ajax_add_to_cart';
	}

	$markup .= sprintf(
		'<a href="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		wc_implode_html_attributes( $attributes ),
		$text
	);	
	
	$markup .= '</div>';

	return $markup;
}

/**
 * Wishlist button
 */
function botiga_wishlist_button( $product = false, $echo = true  ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id        = $product->get_id(); 
	$wishlist_layout   = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 
	if( 'layout1' == $wishlist_layout ) {
		return '';
	}
	$shop_product_wishlist_tooltip = get_theme_mod( 'shop_product_wishlist_tooltip', 0 );
	$tooltip_text 				   = $shop_product_wishlist_tooltip ? get_theme_mod( 'shop_product_wishlist_tooltip_text' ) : '';
	$wishlist_page_link            = get_the_permalink( get_option( 'botiga_wishlist_page_id' ) );

	if( $echo == false ) {
		ob_start();
	} ?>

	<a href="#" class="botiga-wishlist-button<?php echo ( $shop_product_wishlist_tooltip ) ? ' botiga-wishlist-button-tooltip' : ''; ?><?php echo ( botiga_product_is_inthe_wishlist( $product_id ) ) ? ' active' : ''; ?>" data-type="add" data-wishlist-link="<?php echo esc_url( $wishlist_page_link ); ?>" aria-label="<?php /* translators: %s: add to wishlist product title */ echo esc_attr( sprintf( __( 'Add to wishlist the %s product', 'botiga' ), get_the_title( $product_id ) ) ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-wishlist-nonce' ) ); ?>" data-botiga-wishlist-tooltip="<?php echo esc_attr( $tooltip_text ); ?>">
		<svg width="17" height="17" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M13.8213 2.50804L13.8216 2.5078C16.1161 0.140222 19.7976 -0.212946 22.2492 1.87607C25.093 4.30325 25.2444 8.66651 22.6933 11.2992L22.6932 11.2993L13.245 21.055C13.245 21.0551 13.245 21.0551 13.2449 21.0551C12.8311 21.4822 12.1652 21.4822 11.7514 21.0551C11.7513 21.0551 11.7513 21.0551 11.7513 21.055L2.30334 11.2995C-0.243225 8.66684 -0.0918835 4.30344 2.75181 1.8762C5.20368 -0.213127 8.88985 0.140465 11.1793 2.50744L11.1799 2.50804L12.1418 3.49925L12.5006 3.86899L12.8594 3.49925L13.8213 2.50804Z" stroke-width="1" stroke="#212121" fill="transparent"/>
		</svg>
	</a>

	<?php
	if( $echo == false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Wishlist button for single product and quick view
 */
function botiga_single_wishlist_button( $product = false, $echo = true  ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id        = $product->get_id(); 
	$wishlist_layout   = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 
	if( 'layout1' == $wishlist_layout ) {
		return '';
	}

	$wishlist_page_link        = get_the_permalink( get_option( 'botiga_wishlist_page_id' ) );
	$product_is_inthe_wishlist = botiga_product_is_inthe_wishlist( $product_id );
	
	if( $echo == false ) {
		ob_start();
	} ?>

	<div class="botiga-wishlist-wrapper">
		<a href="#" class="botiga-wishlist-button<?php echo ( $product_is_inthe_wishlist ) ? ' active' : ''; ?>" data-type="add" data-wishlist-link="<?php echo esc_url( $wishlist_page_link ); ?>" aria-label="<?php /* translators: %s: add to wishlist product title */ echo esc_attr( sprintf( __( 'Add to wishlist the %s product', 'botiga' ), get_the_title( $product_id ) ) ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-wishlist-nonce' ) ); ?>">
			<svg width="17" height="17" viewBox="-2 -2 30 27" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.8213 2.50804L13.8216 2.5078C16.1161 0.140222 19.7976 -0.212946 22.2492 1.87607C25.093 4.30325 25.2444 8.66651 22.6933 11.2992L22.6932 11.2993L13.245 21.055C13.245 21.0551 13.245 21.0551 13.2449 21.0551C12.8311 21.4822 12.1652 21.4822 11.7514 21.0551C11.7513 21.0551 11.7513 21.0551 11.7513 21.055L2.30334 11.2995C-0.243225 8.66684 -0.0918835 4.30344 2.75181 1.8762C5.20368 -0.213127 8.88985 0.140465 11.1793 2.50744L11.1799 2.50804L12.1418 3.49925L12.5006 3.86899L12.8594 3.49925L13.8213 2.50804Z" stroke-width="3" stroke="#212121" fill="transparent"/>
			</svg>
			<span class="botiga-wishlist-text" data-wishlist-view-text="<?php echo esc_attr__( 'View Wishlist', 'botiga' ); ?>">
				<?php 
				if( $product_is_inthe_wishlist ) {
					esc_html_e( 'View Wishlist', 'botiga' );
				} else {
					esc_html_e( 'Add to Wishlist', 'botiga' );
				} ?>
			</span>
		</a>
	</div>	

	<?php
	if( $echo == false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Wishlist set no cache headers
 * The purpose is avoid caching issues with plugins and servers
 */
function botiga_set_nocache_headers() {
	if( ! headers_sent() ) { 
		if( isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) {
			if( class_exists( 'WC_Cache_Helper' ) ) {
				WC_Cache_Helper::set_nocache_constants(true);
			}
			nocache_headers();
		}
	}
}
add_action( 'woocommerce_init', 'botiga_set_nocache_headers' );

/**
 * Wishlist button ajax callback
 * The cookie name needs to contain "woocommerce_items_in_cart" to avoid caching issues in some servers like kinsta. 
 * Reference: https://kinsta.com/blog/wordpress-cookies-php-sessions/#3-exclude-pages-from-cache-when-the-cookie-is-present
 */
function botiga_button_wishlist_callback_function(){
	check_ajax_referer( 'botiga-wishlist-nonce', 'nonce' );

	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	$qty = 1;

	if( isset( $_POST['type'] ) && 'add' === $_POST['type'] ) {
		if( isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) {
			$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) );
			$arr               = explode( ',', $wishlist_products );
			$newvalue          = $wishlist_products . ',' . absint( $_POST['product_id'] );
			$qty               = count( $arr ) + 1;
	
			if( !in_array( $_POST['product_id'], $arr ) ) {
				setcookie( 'woocommerce_items_in_cart_botiga_wishlist', $newvalue, apply_filters( 'botiga_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
			}
		} else {
			setcookie( 'woocommerce_items_in_cart_botiga_wishlist', absint( $_POST['product_id'] ), apply_filters( 'botiga_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
		}
	} else {
		$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) );
		$arr               = explode( ',', $wishlist_products );
		$key               = array_search( $_POST['product_id'], $arr );

		unset( $arr[ $key ] );

		$newvalue = implode( ',', $arr );

		$qty = count( $arr );

		setcookie( 'woocommerce_items_in_cart_botiga_wishlist', $newvalue, apply_filters( 'botiga_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
	}

	wp_send_json( array(
		'status' => 'success',
		'qty'    => absint( $qty )
	) );
}
add_action('wp_ajax_botiga_button_wishlist', 'botiga_button_wishlist_callback_function');
add_action( 'wp_ajax_nopriv_botiga_button_wishlist', 'botiga_button_wishlist_callback_function' );

/**
 * Wishlist - Check if the product is in the list
 */
function botiga_product_is_inthe_wishlist( $product_id ) {
	if( ! isset( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) ) {
		return false;
	} 

	$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_botiga_wishlist'] ) );
	$products          = explode( ',', $wishlist_products );
	if( in_array( $product_id, $products ) ) {
		return true;
	}

	return false;
}

/**
 * Botiga custom add to cart ajax callback
 */
function botiga_custom_addtocart_callback_function(){
	check_ajax_referer( 'botiga-custom-addtocart-nonce', 'nonce' );

	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	WC()->cart->add_to_cart( absint( $_POST['product_id'] ) );

	wp_die();
}
add_action('wp_ajax_botiga_custom_addtocart', 'botiga_custom_addtocart_callback_function');
add_action( 'wp_ajax_nopriv_botiga_custom_addtocart', 'botiga_custom_addtocart_callback_function' );

/**
 * Quick view button
 */
function botiga_quick_view_button( $product = false, $echo = true ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id        = $product->get_id(); 
	$quick_view_layout = get_theme_mod( 'shop_product_quickview_layout', 'layout1' ); 
	if( 'layout1' == $quick_view_layout ) {
		return '';
	} 
	
	if( $echo == false ) {
		ob_start();
	} ?>

	<a href="#" class="button botiga-quick-view-show-on-hover botiga-quick-view botiga-quick-view-<?php echo esc_attr( $quick_view_layout ); ?>" aria-label="<?php /* translators: %s: quick view product title */ echo esc_attr( sprintf( __( 'Quick view the %s product', 'botiga' ), get_the_title( $product_id ) ) ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-qview-nonce' ) ); ?>">
		<?php esc_html_e( 'Quick View', 'botiga' ); ?>
	</a>
	<?php
	if( $echo == false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Quick view popup
 */
function botiga_quick_view_popup() { ?>
	<div class="single-product botiga-quick-view-popup">
		<div class="botiga-quick-view-loader">
			<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512" aria-hidden="true" focusable="false">
				<path fill="#FFF" d="M288 39.056v16.659c0 10.804 7.281 20.159 17.686 23.066C383.204 100.434 440 171.518 440 256c0 101.689-82.295 184-184 184-101.689 0-184-82.295-184-184 0-84.47 56.786-155.564 134.312-177.219C216.719 75.874 224 66.517 224 55.712V39.064c0-15.709-14.834-27.153-30.046-23.234C86.603 43.482 7.394 141.206 8.003 257.332c.72 137.052 111.477 246.956 248.531 246.667C393.255 503.711 504 392.788 504 256c0-115.633-79.14-212.779-186.211-240.236C302.678 11.889 288 23.456 288 39.056z" />
			</svg>
		</div>
		<div class="botiga-quick-view-popup-content">
			<a href="#" class="botiga-quick-view-popup-close-button">
				<i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i>
			</a>
			<div class="botiga-quick-view-popup-content-ajax"></div>
		</div>
	</div>
	
	<?php
}

/**
 * Quick view add to cart wrapper
 */
add_action( 'botiga_quick_view_before_add_to_cart_button', 'botiga_single_addtocart_wrapper_open' );
add_action( 'botiga_quick_view_after_add_to_cart_button', 'botiga_single_addtocart_wrapper_close' );

/**
 * Quick view ajax callback
 */
function botiga_quick_view_content_callback_function() {
	check_ajax_referer( 'botiga-qview-nonce', 'nonce' );
	
	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	$args = array(
		'product_id' => absint( $_POST['product_id'] )
	);
	
	botiga_get_template_part( 'template-parts/content', 'quick-view', $args );
	
	wp_die();
}
add_action('wp_ajax_botiga_quick_view_content', 'botiga_quick_view_content_callback_function');
add_action( 'wp_ajax_nopriv_botiga_quick_view_content', 'botiga_quick_view_content_callback_function' );

/**
 * Botiga output for simple product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_simple_add_to_cart( $product, $hook_prefix = '' ) {
	if ( ! $product->is_purchasable() ) {
		return;
	}
	
	echo wc_get_stock_html( $product ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	
	if ( $product->is_in_stock() ) : ?>
	
		<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>
	
		<form class="cart" action="<?php echo esc_url( apply_filters( "botiga_{$hook_prefix}_add_to_cart_form_action", $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
			<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); ?>
	
			<?php
			do_action( "botiga_{$hook_prefix}_before_add_to_cart_quantity" );

			woocommerce_quantity_input(
				array(
					'min_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_min", $product->get_min_purchase_quantity(), $product ),
					'max_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_max", $product->get_max_purchase_quantity(), $product ),
					'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( absint( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity()
				)
			);
	
			do_action( "botiga_{$hook_prefix}_after_add_to_cart_quantity" );
			?>
	
			<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
	
			<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>
		</form>
	
		<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_form" ); ?>
	
	<?php endif;
}

/**
 * Botiga output for grouped product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_grouped_add_to_cart( $product, $hook_prefix = '' ) {
	$products = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );

	if ( $products ) :
		$post               = get_post( $product->get_id() );
		$grouped_product    = $product;
		$grouped_products   = $products;
		$quantites_required = false;

		do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>

		<form class="cart grouped_form" action="<?php echo esc_url( apply_filters( "botiga_{$hook_prefix}_add_to_cart_form_action", $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
			<table cellspacing="0" class="woocommerce-grouped-product-list group_table">
				<tbody>
					<?php
					$quantites_required      = false;
					$previous_post           = $post;
					$grouped_product_columns = apply_filters(
						"botiga_{$hook_prefix}_grouped_product_columns",
						array(
							'quantity',
							'label',
							'price',
						),
						$product
					);
					$show_add_to_cart_button = false;

					do_action( "botiga_{$hook_prefix}_grouped_product_list_before", $grouped_product_columns, $quantites_required, $product );

					foreach ( $grouped_products as $grouped_product_child ) {
						$post_object        = get_post( $grouped_product_child->get_id() );
						$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
						$post               = $post_object;
						setup_postdata( $post );

						if ( $grouped_product_child->is_in_stock() ) {
							$show_add_to_cart_button = true;
						}

						echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';

						// Output columns for each product.
						foreach ( $grouped_product_columns as $column_id ) {
							do_action( "botiga_{$hook_prefix}_grouped_product_list_before_" . $column_id, $grouped_product_child );

							switch ( $column_id ) {
								case 'quantity':
									ob_start();

									if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
										woocommerce_template_loop_add_to_cart();
									} elseif ( $grouped_product_child->is_sold_individually() ) {
										echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
									} else {
										do_action( "botiga_{$hook_prefix}_before_add_to_cart_quantity" );

										woocommerce_quantity_input(
											array(
												'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
												'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : '', // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
												'min_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_min", 0, $grouped_product_child ),
												'max_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_max", $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
												'placeholder' => '0',
											)
										);

										do_action( "botiga_{$hook_prefix}_after_add_to_cart_quantity" );
									}

									$value = ob_get_clean();
									break;
								case 'label':
									$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
									$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( "botiga_{$hook_prefix}_grouped_product_list_link", $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
									$value .= '</label>';
									break;
								case 'price':
									$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
									break;
								default:
									$value = '';
									break;
							}

							echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( "botiga_{$hook_prefix}_grouped_product_list_column_" . $column_id, $value, $grouped_product_child ) . '</td>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

							do_action( "botiga_{$hook_prefix}_grouped_product_list_after_" . $column_id, $grouped_product_child );
						}

						echo '</tr>';
					}
					$post = $previous_post;
					setup_postdata( $post );

					do_action( "botiga_{$hook_prefix}_grouped_product_list_after", $grouped_product_columns, $quantites_required, $product );
					?>
				</tbody>
			</table>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

			<?php if ( $quantites_required && $show_add_to_cart_button ) : ?>

				<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); ?>

				<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

				<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>

			<?php endif; ?>
		</form>

		<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_form" ); ?>
	
	<?php endif;
}

/**
 * Botiga output for variable product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_variable_add_to_cart( $product, $hook_prefix = '' ) {
	// Get Available variations?
	$get_variations = count( $product->get_children() ) <= apply_filters( "botiga_{$hook_prefix}_ajax_variation_threshold", 30, $product );

	$available_variations = $get_variations ? $product->get_available_variations() : false;
	$attributes           = $product->get_variation_attributes();
	$selected_attributes  = $product->get_default_attributes();

	$attribute_keys  = array_keys( $attributes );
	$variations_json = wp_json_encode( $available_variations );
	$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

	do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>

	<form class="variations_form cart" action="<?php echo esc_url( apply_filters( "botiga_{$hook_prefix}_add_to_cart_form_action", $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>">
		<?php do_action( "botiga_{$hook_prefix}_before_variations_form" ); ?>

		<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php echo esc_html( apply_filters( "botiga_{$hook_prefix}_out_of_stock_message", __( 'This product is currently out of stock and unavailable.', 'botiga' ) ) ); ?></p>
		<?php else : ?>
			<table class="variations" cellspacing="0">
				<tbody>
					<?php foreach ( $attributes as $attribute_name => $options ) : ?>
						<tr>
							<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></label></td>
							<td class="value">
								<?php
									wc_dropdown_variation_attribute_options(
										array(
											'options'   => $options,
											'attribute' => $attribute_name,
											'product'   => $product,
										)
									);
									echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( "botiga_{$hook_prefix}_reset_variations_link", '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'botiga' ) . '</a>' ) ) : '';
								?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<div class="single_variation_wrap">
				<?php
					/**
					 * Hook: woocommerce_before_single_variation.
					 */
					do_action( "botiga_{$hook_prefix}_before_single_variation" ); ?>

					<div class="woocommerce-variation single_variation"></div>
					<div class="woocommerce-variation-add-to-cart variations_button">
						<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedHooknameFound ?> 

						<?php
						do_action( "botiga_{$hook_prefix}_before_add_to_cart_quantity" );

						woocommerce_quantity_input(
							array(
								'min_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_min", $product->get_min_purchase_quantity(), $product ),
								'max_value'   => apply_filters( "botiga_{$hook_prefix}_quantity_input_max", $product->get_max_purchase_quantity(), $product ),
								'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
							)
						);

						do_action( "botiga_{$hook_prefix}_after_add_to_cart_quantity" );
						?>

						<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

						<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>

						<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
						<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
						<input type="hidden" name="variation_id" class="variation_id" value="0" />
					</div>


					<?php
					/**
					 * Hook: woocommerce_after_single_variation.
					 */
					do_action( 'botiga_quick_view_after_single_variation' );
				?>
			</div>
		<?php endif; ?>

		<?php do_action( 'botiga_quick_view_after_variations_form' ); ?>
	</form>

	<?php
	do_action( 'botiga_quick_view_after_add_to_cart_form' );
}


/**
 * Botiga output for external product add to cart area.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_external_add_to_cart( $product, $hook_prefix = '' ) {
	if ( ! $product->add_to_cart_url() ) {
		return;
	}

	$product_url = $product->add_to_cart_url();
	$button_text = $product->single_add_to_cart_text();

	do_action( "botiga_{$hook_prefix}_before_add_to_cart_form" ); ?>

	<form class="cart" action="<?php echo esc_url( $product_url ); ?>" method="get">
		<?php do_action( "botiga_{$hook_prefix}_before_add_to_cart_button" ); ?>

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $button_text ); ?></button>

		<?php wc_query_string_form_fields( $product_url ); ?>

		<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_button" ); ?>
	</form>

	<?php do_action( "botiga_{$hook_prefix}_after_add_to_cart_form" );
}

/**
 * Botiga output for product price.
 * The purpose is avoid third party plugins hooking here
 */
function botiga_single_product_price( $hook_prefix = '' ) {
	global $product; ?>

	<p class="<?php echo esc_attr( apply_filters( "botiga_{$hook_prefix}_product_price_class", 'price' ) ); ?>"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>

<?php
}

/**
 * My account page 
 * Identify the page and insert html so we can style some elements
 */
function botiga_myaccount_html_insert() {
    if( !isset( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$request_url = wc_clean( wp_unslash( $_SERVER['REQUEST_URI'] ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
    
	// view-order
    if( strpos( $request_url, '/my-account/view-order' ) !== FALSE || strpos( $request_url, '&view-order=' ) !== FALSE ) {
        echo '<div class="botiga-wc-account-view-order"></div>';
    }
}
add_action( 'woocommerce_account_content', 'botiga_myaccount_html_insert', 0 );

/**
 * Single sticky add to cart
 */
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

/**
 * Botiga related products as slider
 */
function botiga_woocommerce_output_related_products_slider( $args = array() ) { 
	global $product;

	if ( ! $product ) {
		return;
	}

	$posts_per_page = get_theme_mod( 'shop_single_related_products_number', 3 );
	$columns        = get_theme_mod( 'shop_single_related_products_columns_number', 3 );
	$shop_single_related_products_slider_nav = get_theme_mod( 'shop_single_related_products_slider_nav', 'always-show' );

	$defaults = array(
		'posts_per_page' => $posts_per_page,
		'orderby'        => 'rand',
		'order'          => 'desc'
	);

	$args = wp_parse_args( $args, $defaults );

	// Get visible related products then sort them at random.
	$args['related_products'] = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );

	// Handle orderby.
	$related_products = wc_products_array_orderby( $args['related_products'], $args['orderby'], $args['order'] ); ?>
	
	<section class="related products">

		<?php
		$heading = apply_filters( 'botiga_woocommerce_product_related_products_heading', __( 'Related products', 'botiga' ) );

		if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php

		$wrapper_atts = array();
		$wrapper_classes = array( 'botiga-related-posts' );

		wp_enqueue_script( 'botiga-carousel' );
		wp_localize_script( 'botiga-carousel', 'botiga_carousel', botiga_localize_carousel_options() );	

		$wrapper_classes[] = 'botiga-carousel botiga-carousel-nav2';

		if( $shop_single_related_products_slider_nav === 'always-show' ) {
			$wrapper_classes[] = 'botiga-carousel-nav2-always-show';
		}

		$wrapper_atts[] = 'data-per-page="'. absint( $columns ) .'"';

		// Mount related posts wrapper class
		$wrapper_atts[] = 'class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

		echo '<div '. implode( ' ', $wrapper_atts ) .'>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
			echo '<ul class="products columns-'. esc_attr( $columns ) .' row botiga-carousel-stage">';
				foreach ( $related_products as $related_product ) :
	
					$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );

				endforeach;
			echo '</ul>';
		echo '</div>';
		?>

	</section>
	
	<?php
}