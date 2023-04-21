<?php

/**
 * Enable programmatically all features from Botiga/Botiga Pro
 * This fil will be evaluated thourgh wp-cli for testings purposes
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
	$front_page = get_page_by_title( 'Home' );
	if ( ! empty( $front_page ) ) {
		update_option( 'page_on_front', $front_page->ID );
	}

	// Asign the blog page.
	$blog_page  = get_page_by_title( 'Blog' );
	if ( ! empty( $blog_page ) ) {
		update_option( 'page_for_posts', $blog_page->ID );
	}

	// My wishlist page
	$wishlist_page = get_page_by_title( 'My Wishlist' );
	if ( ! empty( $wishlist_page ) ) {
		update_option( 'botiga_wishlist_page_id', $wishlist_page->ID );
	}

	// Asign the shop page.
	$shop_page = ( 'single-product' === $demo_id ) ? get_page_by_title( 'Listing' ) : get_page_by_title( 'Shop' );
	if ( ! empty( $shop_page ) ) {
		update_option( 'woocommerce_shop_page_id', $shop_page->ID );
	}

	// Asign the cart page.
	$cart_page = get_page_by_title( 'Cart' );
	if ( ! empty( $cart_page ) ) {
		update_option( 'woocommerce_cart_page_id', $cart_page->ID );
	}

	// Asign the checkout page.
	$checkout_page  = get_page_by_title( 'Checkout' );
	if ( ! empty( $checkout_page ) ) {
		update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
	}

	// Asign the myaccount page.
	$myaccount_page = get_page_by_title( 'My Account' );
	if ( ! empty( $myaccount_page ) ) {
		update_option( 'woocommerce_myaccount_page_id', $myaccount_page->ID );
	}

	// Update custom CSS
	$custom_css = Botiga_Custom_CSS::get_instance();
	$custom_css->update_custom_css_file();

}

// Create random menu for tests
$menuname = 'Menu For Tests';

// Does the menu exist already?
$menu_exists = wp_get_nav_menu_object( $menuname );

// If it doesn't exist, let's create it.
if( ! $menu_exists){
    $menu_id = wp_create_nav_menu( $menuname );

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Home'),
        'menu-item-classes' => 'home',
        'menu-item-url' => home_url( '/' ), 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Activity'),
        'menu-item-classes' => 'activity',
        'menu-item-url' => home_url( '/activity/' ), 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Members'),
        'menu-item-classes' => 'members',
        'menu-item-url' => home_url( '/members/' ), 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Groups'),
        'menu-item-classes' => 'groups',
        'menu-item-url' => home_url( '/groups/' ), 
        'menu-item-status' => 'publish'));

    $dropdown_parent_id = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Forums'),
        'menu-item-classes' => 'forums',
        'menu-item-url' => home_url( '/forums/' ), 
        'menu-item-status' => 'publish'));
    
    for( $i=1; $i<=5; $i++ ) {
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' =>  __('Sub Menu Item ' . $i),
            'menu-item-classes' => 'sub-menu-item-' . $i,
            'menu-item-url' => home_url( '/sub-item-' . $i . '/' ), 
            'menu-item-parent-id' => $dropdown_parent_id,
            'menu-item-status' => 'publish') );
    }

    // Assign menu to the primary location
    set_theme_mod( 'nav_menu_locations', array( 
        'primary' => $menu_id, 
        'secondary' => $menu_id,
        'footer-copyright-menu' => $menu_id 
    ) );
}

// Header
// Set header builder components
set_theme_mod( 'botiga_header_row__mobile_offcanvas', '{"desktop":[],"mobile":[],"mobile_offcanvas":[["mobile_offcanvas_menu","social","contact_info","button","html","button2","html2","shortcode"]]}' );
set_theme_mod( 'botiga_header_row__above_header_row', '{"desktop":[["secondary_menu","social"],["contact_info","html"],["button2","html2"]],"mobile":[[],[],[]],"mobile_offcanvas":[["secondary_menu","social"],["contact_info","html"],["button2","html2"]]}' );
set_theme_mod( 'botiga_header_row__main_header_row', '{"desktop":[["menu"],["logo","button"],["search","woo_icons"]],"mobile":[["search"],["logo"],["mobile_hamburger"]]}' );
set_theme_mod( 'botiga_header_row__below_header_row', '{"desktop":[["shortcode"],[],[]],"mobile":[[],[],[]],"mobile_offcanvas":[[]]}' );

// Set header builder components contnet
set_theme_mod( 'social_profiles_topbar', 'https://facebook,https://twitter' );
set_theme_mod( 'header_html_content', 'HTML Content Example One' );
set_theme_mod( 'botiga_section_hb_component__html2_content', 'HTML Content Example Two' );
set_theme_mod( 'header_shortcode_content', 'shortcode content goes here' );

// Footer
// Set footer builder components
set_theme_mod( 'botiga_footer_row__main_footer_row', '{ "desktop": [["social", "copyright", "footer_menu", "button", "button2", "html", "html2", "widget1", "widget2", "widget3", "widget4", "shortcode"], [], []], "mobile": [[], [], []] }' );

// Set footer builder componenets content
set_theme_mod( 'social_profiles_footer', 'https://facebook,https://twitter' );
set_theme_mod( 'footer_html_content', 'HTML Content One For Tests' );
set_theme_mod( 'botiga_section_fb_component__html2_content', 'HTML Content Two For Tests' );
set_theme_mod( 'footer_shortcode_content', 'Shortcode content goes here' );

// Enable all modules
$all_modules = get_option( 'botiga-modules' );
$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

update_option( 'botiga-modules', array_merge( 
    $all_modules, 
    array( 
        'hf-builder' => true,
        'adobe-typekit' => true,
        'custom-fonts' => true,
        'google-autocomplete' => true,
        'quantity-step-control' => true,
        'mega-menu' => true,
        'wishlist' => true,
        'modal-popup' => true,
        'table-of-contents' => true,
        'login-popup' => true,
        'custom-sidebars' => true,
        'breadcrumbs' => true,
        'quick-links' => true,
        'product-swatches' => true,
        'sticky-add-to-cart' => true,
        'advanced-reviews' => true,
        'size-chart' => true,
        'linked-variations' => true,
        'video-gallery' => true,
        'variations-gallery' => true,
        'templates' => true,
		'schema-markup' => true,
		'buy-now' => true,
		'free-shipping-progress-bar' => true,
		'add-to-cart-notifications' => true
    ) 
) );

// Enable popular products grid on the search results page
set_theme_mod( 'shop_search_enable_popular_products', 1 );

// Enable single product ajax add to cart
set_theme_mod( 'single_ajax_add_to_cart', 1 );

// Enable ajax search
set_theme_mod( 'shop_search_enable_ajax', 1 );

set_theme_mod( 'shop_general_quantity_min', '1' );
set_theme_mod( 'shop_general_quantity_max', '10' );
set_theme_mod( 'shop_general_quantity_step', '1' );
set_theme_mod( 'shop_general_quantity_default', '1' );

// Enable mini cart quantity
set_theme_mod( 'enable_mini_cart_quantity', 1 );

// Enable shop catalog quantity input
set_theme_mod( 'shop_product_quantity', 1 );

// Enable image swap
set_theme_mod( 'shop_product_image_swap', 1 );

// Increase modal popup delay time (to avoid issues with tests)
set_theme_mod( 'modal_popup_open_delay_desktop', 20 );

botiga_setup_after_import( 'beauty' );