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

botiga_setup_after_import( 'beauty' );

// Enable popular products grid on the search results page
set_theme_mod( 'shop_search_enable_popular_products', 1 );