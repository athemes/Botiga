<?php
/**
 * Script to run after WP-CLI import. That's the same code from athemes starter sites plugin.
 * 
 */
function botiga_setup_after_import( $demo_id ) {

	// Assign the menu.
	$main_menu = get_term_by( 'name', 'Main', 'nav_menu' );
	if ( ! empty( $main_menu ) ) {
		$locations = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $main_menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// Beauty, Furniture and Single Product Demo Extras
	if ( in_array( $demo_id, array( 'beauty', 'furniture', 'single-product', 'multi-vendor' ) ) ) {

		// Set modules.
	  $modules = get_option( 'botiga-modules', array() );
		update_option( 'botiga-modules', array_merge( $modules, array( 'hf-builder' => true ) ) );

	}

	// Multi Vendor Demo Extras
	if ( $demo_id === 'multi-vendor' ) {

		// Set modules.
	  $modules = get_option( 'botiga-modules', array() );
		update_option( 'botiga-modules', array_merge( $modules, array( 'hf-builder' => true, 'mega-menu' => true, 'size-chart' => true, 'product-swatches' => true ) ) );

		// Assign secondary menu
		$secondary_menu = get_term_by( 'name', 'Trending Categories', 'nav_menu' );
		if ( ! empty( $secondary_menu ) ) {
			$locations = get_theme_mod( 'nav_menu_locations', array() );
			$locations['secondary'] = $secondary_menu->term_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}

	}

	// Apparel Demo Extras
	if ( $demo_id === 'apparel' ) {

		// Set modules.
		// The demo apparel uses the old header system, so we need to disable the HF Builder
	  $modules = get_option( 'botiga-modules', array() );
		update_option( 'botiga-modules', array_merge( $modules, array( 'hf-builder' => false ) ) );

		// Assign footer copyright menu
		$copyright_menu = get_term_by( 'name', 'Footer Copyright', 'nav_menu' );
		if ( ! empty( $copyright_menu ) ) {
			$locations = get_theme_mod( 'nav_menu_locations', array() );
			$locations['footer-copyright-menu'] = $copyright_menu->term_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}

	}

	// Jewelry Demo Extras
	if ( $demo_id === 'jewelry' ) {

		// Set modules.
	  $modules = get_option( 'botiga-modules', array() );
		update_option( 'botiga-modules', array_merge( $modules, array( 'hf-builder' => true, 'mega-menu' => true ) ) );

		// Update custom CSS file with mega menu css
		if ( class_exists( 'Botiga_Mega_menu' ) ) {
			$mega_menu = Botiga_Mega_Menu::get_instance();
			$mega_menu->save_mega_menu_css_as_option();
			$mega_menu->update_custom_css_file();
		}

	}

	// "Footer" menu (menu name from import)
	$footer_menu_one = get_term_by( 'name', 'Footer', 'nav_menu' );
	if ( ! empty( $footer_menu_one ) ) {
		$nav_menu_widget = get_option( 'widget_nav_menu' );
		foreach ( $nav_menu_widget as $key => $widget ) {
			if ( $key !== '_multiwidget' ) {
				if ( ( ! empty( $nav_menu_widget[ $key ]['title'] ) && in_array( $nav_menu_widget[ $key ]['title'], array( 'Quick links', 'Quick Links' ) ) ) || ( empty( $nav_menu_widget[ $key ]['title'] ) && $demo_id === 'jewelry' ) ) {
					$nav_menu_widget[ $key ]['nav_menu'] = $footer_menu_one->term_id;
					update_option( 'widget_nav_menu', $nav_menu_widget );
				}
			}
		}
	}

	// "Footer 2" menu (menu name from import)
	$footer_menu_two = get_term_by( 'name', 'Footer 2', 'nav_menu' );
	if ( ! empty( $footer_menu_two ) ) {
		$nav_menu_widget = get_option( 'widget_nav_menu' );
		foreach ( $nav_menu_widget as $key => $widget ) {
			if ( $key !== '_multiwidget' ) {
				if ( ! empty( $nav_menu_widget[ $key ]['title'] ) && in_array( $nav_menu_widget[ $key ]['title'], array( 'About' ) ) ) {
					$nav_menu_widget[ $key ]['nav_menu'] = $footer_menu_two->term_id;
					update_option( 'widget_nav_menu', $nav_menu_widget );
				}
			}
		}
	}

	// Asign the front as page.
	update_option( 'show_on_front', 'page' );

	// Asign the front page.
	$front_page = tests_custom_get_page_by_title2( 'Home' );
	if ( ! empty( $front_page ) ) {
		update_option( 'page_on_front', $front_page->ID );
	}

	// Asign the blog page.
	$blog_page  = tests_custom_get_page_by_title2( 'Blog' );
	if ( ! empty( $blog_page ) ) {
		update_option( 'page_for_posts', $blog_page->ID );
	}

	// My wishlist page
	$wishlist_page = tests_custom_get_page_by_title2( 'My Wishlist' );
	if ( ! empty( $wishlist_page ) ) {
		update_option( 'botiga_wishlist_page_id', $wishlist_page->ID );
	}

	// Asign the shop page.
	$shop_page = ( 'single-product' === $demo_id ) ? tests_custom_get_page_by_title2( 'Listing' ) : tests_custom_get_page_by_title2( 'Shop' );
	if ( ! empty( $shop_page ) ) {
		update_option( 'woocommerce_shop_page_id', $shop_page->ID );
	}

	// Asign the cart page.
	$cart_page = tests_custom_get_page_by_title2( 'Cart' );
	if ( ! empty( $cart_page ) ) {
		update_option( 'woocommerce_cart_page_id', $cart_page->ID );
	}

	// Asign the checkout page.
	$checkout_page  = tests_custom_get_page_by_title2( 'Checkout' );
	if ( ! empty( $checkout_page ) ) {
		update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
	}

	// Asign the myaccount page.
	$myaccount_page = tests_custom_get_page_by_title2( 'My Account' );
	if ( ! empty( $myaccount_page ) ) {
		update_option( 'woocommerce_myaccount_page_id', $myaccount_page->ID );
	}

	// Update custom CSS
	$custom_css = Botiga_Custom_CSS::get_instance();
	$custom_css->update_custom_css_file();

}

botiga_setup_after_import( 'jewelry' );

// Attributes from products are imported as 'select' type and the correct is 'color', so we have to change it
// We are going to test product swatches with this demo, so we need to change the type of the attribute
add_filter( 'product_attributes_type_selector', function(){
	return array(
		'select' => 'Select',
		'color'  => 'Color',
		'text'   => 'Text'
	);
} );

$attribute_data = wc_get_attribute( 1 );
$test = wc_update_attribute( $attribute_data->id, array(
	'name'         => $attribute_data->name,
	'slug'         => $attribute_data->slug,
	'type'         => 'color',
	'order_by'     => $attribute_data->order_by,
	'has_archives' => false
) );

// Enable sticky add to cart module
$all_modules = get_option( 'botiga-modules' );
$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

update_option( 'botiga-modules', array_merge( $all_modules, array( 'sticky-add-to-cart' => true ) ) );

// Enable wishlist module
$all_modules = get_option( 'botiga-modules' );
$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;
update_option( 'botiga-modules', array_merge( $all_modules, array( 'wishlist' => true ) ) );

// Enable popular products grid on the search results page
set_theme_mod( 'shop_search_enable_popular_products', 1 );

// Enable single product ajax add to cart
set_theme_mod( 'single_ajax_add_to_cart', 1 );

// Enable product swatche on shop catalog
set_theme_mod( 'product_swatch_on_shop_catalog', 1 );

// Enable product swatches tooltip
set_theme_mod( 'product_swatch_tooltip', 1 );

// Enable shop catalog left sidebar
set_theme_mod( 'shop_archive_sidebar', 'left' );
set_theme_mod( 'shop_sidebar', 'shop-sidebar-1' );

// Set products cards layout
set_theme_mod( 'shop_product_add_to_cart_layout', 'layout2' );

// Enable quick view
set_theme_mod( 'shop_product_quickview_layout', 'layout2' );

// Insert widgets on sidebars
function insert_widget_in_sidebar( $widget_id, $widget_data, $sidebar ) {
	// Retrieve sidebars, widgets and their instances
	$sidebars_widgets = get_option( 'sidebars_widgets', array() );
	$widget_instances = get_option( 'widget_' . $widget_id, array() );

	// Retrieve the key of the next widget instance
	$numeric_keys = array_filter( array_keys( $widget_instances ), 'is_int' );
	$next_key = $numeric_keys ? max( $numeric_keys ) + 1 : 2;

	// Add this widget to the sidebar
	if ( ! isset( $sidebars_widgets[ $sidebar ] ) ) {
		$sidebars_widgets[ $sidebar ] = array();
	}
	$sidebars_widgets[ $sidebar ][] = $widget_id . '-' . $next_key;

	// Add the new widget instance
	$widget_instances[ $next_key ] = $widget_data;

	// Store updated sidebars, widgets and their instances
	update_option( 'sidebars_widgets', $sidebars_widgets );
	update_option( 'widget_' . $widget_id, $widget_instances );
}

// insert product swatch active filter widget in the shop sidebar
insert_widget_in_sidebar( 'botiga_widget_product_swatch_active_filter', array(
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title">',
	'after_title' => '</div>'
), 'shop-sidebar-1' );

// insert product swatch filter widget in the shop sidebar
insert_widget_in_sidebar( 'botiga_widget_product_swatch_filter', array(
	'title' => 'Filter BY Color',
	'attribute' => 'color',
	'allow_selecting' => 'single',
	'display_available_variations' => false,
	'before_widget' => '<div id="%1$s" class="widget %2$s">', 
	'after_widget' => '</div>',
	'before_title' => '<div class="widget-title">',
	'after_title' => '</div>'
), 'shop-sidebar-1' );

/**
 * Get page by title
 * The core WordPress function 'get_page_by_title' were deprecated since 6.2.0
 * More info: https://make.wordpress.org/core/2023/03/06/get_page_by_title-deprecated/
 *
 * @param string $page_title The title of the page.
 */
function tests_custom_get_page_by_title2( $page_title ) {
	$query = new WP_Query(
		array(
			'post_type'              => 'page',
			'title'                  => $page_title,
			'post_status'            => 'all',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'orderby'                => 'post_date ID',
			'order'                  => 'ASC',
		)
	);
	
	if ( ! empty( $query->post ) ) {
		$page_got_by_title = $query->post;
	} else {
		$page_got_by_title = null;
	}
	
	return $page_got_by_title;
}