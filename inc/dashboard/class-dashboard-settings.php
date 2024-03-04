<?php

/**
 *
 * Dashboard Settings
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if( ! is_admin() ) {
	return;
}

function botiga_dashboard_settings() {

	$settings = array();

	//
	// General.
	//
	$settings['menu_slug']           = 'botiga-dashboard';
	$settings['starter_plugin_slug'] = 'athemes-starter-sites';
	$settings['starter_plugin_path'] = 'athemes-starter-sites/athemes-starter-sites.php';
	$settings['has_pro']             = false;
	$settings['website_link']        = 'https://athemes.com/';

	//
	// Hero.
	//
	$settings['hero_title'] = esc_html__('Welcome to Botiga', 'botiga');
	$settings['hero_desc']  = esc_html__('Botiga is now installed and ready to go. To help you with the next step, we’ve gathered together on this page all the resources you might need. We hope you enjoy using Botiga.', 'botiga');
	$settings['hero_image'] = get_template_directory_uri() . '/assets/img/dashboard/welcome-banner@2x.png';

	//
	// Documentation.
	//
	$settings['documentation_link'] = 'https://docs.athemes.com/collection/318-botiga';

	//
	// Upgrade to Pro.
	//
	$settings['upgrade_pro'] = 'https://athemes.com/botiga-upgrade?utm_source=theme_info&utm_medium=link&utm_campaign=Botiga';

	//
	// Promo.
	//
	$settings['promo_title']  = esc_html__('Upgrade to Pro', 'botiga');
	$settings['promo_desc']   = esc_html__('Take Botiga to a whole other level by upgrading to the Pro version.', 'botiga');
	$settings['promo_button'] = esc_html__('Discover Botiga Pro', 'botiga');
	$settings['promo_link']   = 'https://athemes.com/botiga-upgrade?utm_source=theme_info&utm_medium=link&utm_campaign=Botiga';

	//
	// Review.
	//
	$settings['review_link']       = 'https://wordpress.org/support/theme/botiga/reviews/';
	$settings['suggest_idea_link'] = 'https://athemes.com/feature-request/';

	//
	// Knowledge Base.
	//
	$settings['knowledge_base_link'] = 'https://docs.athemes.com/collection/318-botiga';

	//
	// Support.
	//
	$settings['support_link']     = 'https://wordpress.org/support/theme/botiga/';
	$settings['support_pro_link'] = 'https://athemes.com/botiga-upgrade?utm_source=theme_support&utm_medium=button&utm_campaign=Botiga';

	//
	// Community.
	//
	$settings['community_link'] = 'https://www.facebook.com/groups/athemes/';

	//
	// Tutorial.
	//
	$settings['tutorial_link'] = 'https://athemes.com/video-tutorials/botiga/';

	//
	// Changelog.
	//
	$theme = wp_get_theme();
	$settings['changelog_version'] = $theme->version;
	$settings['changelog_link']    = 'https://athemes.com/changelog/botiga/';

	//
	// Social Links.
	//
	$settings['facebook_link'] = 'https://www.facebook.com/groups/athemes/';
	$settings['twitter_link']  = 'https://twitter.com/athemesdotcom';
	$settings['youtube_link']  = 'https://www.youtube.com/@Athemes';

	//
	// Tabs.
	//
	$settings['tabs']  = array(
		'home'           => esc_html__('Home', 'botiga'),
		'starter-sites'  => esc_html__('Starter Sites', 'botiga'),
		'settings'       => esc_html__('Settings', 'botiga'),
		'free-vs-pro'    => esc_html__('Free vs Pro', 'botiga'),
	);

	$is_legacy_tb = get_option( 'botiga-legacy-templates-builder', false ) == true;
	if ( ! $is_legacy_tb && ( isset( $settings['has_pro'] ) && $settings['has_pro'] && Botiga_Modules::is_module_active( 'templates' ) ) || !$is_legacy_tb && ! $settings['has_pro'] ) {
		$settings['tabs'] = array_merge(
			array_slice( $settings['tabs'], 0, 2 ),
			array( 'builder' => esc_html__( 'Templates Builder', 'botiga' ) ),
			array_slice( $settings['tabs'], 2 )
		);
	}

	//
	// Settings.
	//
	$settings['settings'] = array(
		'general'      => esc_html__('General', 'botiga'),
		'performance'  => esc_html__('Performance', 'botiga'),
	);

	if ( class_exists( 'Merchant' ) && defined( 'MERCHANT_VERSION' ) && version_compare( MERCHANT_VERSION, '1.9.2', '>' ) ) {
		$settings['settings']['merchant'] = esc_html__('Merchant', 'botiga');
	}

	//
	// Notifications.
	//
	$notifications_response    = wp_remote_get( 'https://athemes.com/wp-json/wp/v2/notifications?theme=7085&per_page=3' );
	$settings['notifications'] = ! is_wp_error( $notifications_response ) || wp_remote_retrieve_response_code( $notifications_response ) === 200 ? json_decode( wp_remote_retrieve_body( $notifications_response ) ) : false;
	$settings['notifications_tabs'] = false;


	//
	// Demos.
	//
	$ettings['demos'] = array();

	$settings['demos'][] = array(
		'name'      => 'Beauty',
		'type'      => 'free',
		'thumbnail' => 'https://athemes.com/themes-demo-content/botiga/beauty/thumb.png',
	);

	$settings['demos'][] = array(
		'name'      => 'Apparel',
		'type'      => 'pro',
		'thumbnail' => 'https://athemes.com/themes-demo-content/botiga/apparel/thumb.png',
	);

	$settings['demos'][] = array(
		'name'      => 'Furniture',
		'type'      => 'pro',
		'thumbnail' => 'https://athemes.com/themes-demo-content/botiga/beauty/thumb.png',
	);

	$settings['demos'][] = array(
		'name'      => 'Jewelry',
		'type'      => 'pro',
		'thumbnail' => 'https://athemes.com/themes-demo-content/botiga/jewelry/thumb.png',
	);

	$settings['demos'][] = array(
		'name'      => 'Single Product',
		'type'      => 'pro',
		'thumbnail' => 'https://athemes.com/themes-demo-content/botiga/single-product/thumb.png',
	);

	//
	// Plugins.
	//
	$settings['plugins'] = array();

	$settings['plugins'][] = array(
		'slug'   => 'athemes-blocks',
		'path'   => 'athemes-blocks/athemes-blocks.php',
		'icon'   => 'https://plugins.svn.wordpress.org/athemes-blocks/assets/icon-256x256.png',
		'banner' => 'https://plugins.svn.wordpress.org/athemes-blocks/assets/banner-772x250.png',
		'title'  => esc_html__('aThemes Blocks', 'botiga'),
		'desc'   => esc_html__('Extend the Gutenberg Block Editor with additional functionality.', 'botiga'),
	);

	$settings['plugins'][] = array(
		'slug'   => 'wpforms-lite',
		'path'   => 'wpforms-lite/wpforms.php',
		'icon'   => 'https://plugins.svn.wordpress.org/wpforms-lite/assets/icon-256x256.png',
		'banner' => 'https://plugins.svn.wordpress.org/wpforms-lite/assets/banner-772x250.png',
		'title'  => esc_html__('WPForms', 'botiga'),
		'desc'   => esc_html__('The best WordPress contact form plugin. Drag & Drop online form builder that helps you create beautiful contact forms + custom forms in minutes.', 'botiga'),
	);

	$settings['plugins'][] = array(
		'slug'   => 'leadin',
		'path'   => 'leadin/leadin.php',
		'icon'   => 'https://plugins.svn.wordpress.org/leadin/assets/icon-256x256.png',
		'banner' => 'https://plugins.svn.wordpress.org/leadin/assets/banner-772x250.png',
		'title'  => esc_html__('HubSpot', 'botiga'),
		'desc'   => esc_html__('HubSpot is a platform with all the tools and integrations you need for marketing, sales, and customer service.', 'botiga'),
	);

	//
	// Features.
	//
	$settings['features'] = array();

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Site Identity', 'botiga'),
		'desc'       => esc_html__('Set the title and upload logo.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[control]', 'blogname', admin_url('customize.php')),
	);

	if ( Botiga_Modules::is_module_active( 'hf-builder' ) ) {

		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Header Builder', 'botiga'),
			'desc'       => esc_html__('Drag and drop header builder.', 'botiga'),
			'link_label' => esc_html__('Customize', 'botiga'),
			'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_hb_wrapper', admin_url('customize.php')),
		);
	
		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Footer Builder', 'botiga'),
			'desc'       => esc_html__('Drag and drop footer builder.', 'botiga'),
			'link_label' => esc_html__('Customize', 'botiga'),
			'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_fb_wrapper', admin_url('customize.php')),
		);

	} else {

		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Main Header', 'botiga'),
			'desc'       => esc_html__('Set the main header layout, elements and styles.', 'botiga'),
			'link_label' => esc_html__('Customize', 'botiga'),
			'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_main_header', admin_url('customize.php')),
		);

		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Mobile Header', 'botiga'),
			'desc'       => esc_html__('Set the mobile header layout, elements and styles.', 'botiga'),
			'link_label' => esc_html__('Customize', 'botiga'),
			'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_mobile_header', admin_url('customize.php')),
		);

		$settings['features'][] = array(
			'type'       => 'free',
			'title'      => esc_html__('Footer Copyright', 'botiga'),
			'desc'       => esc_html__('Set the copyright text, layout and styles.', 'botiga'),
			'link_label' => esc_html__('Customize', 'botiga'),
			'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_footer_credits', admin_url('customize.php')),
		);

	}

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Global Colors', 'botiga'),
		'desc'       => esc_html__('Create your own palette and set the global colors.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'colors', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Typography', 'botiga'),
		'desc'       => esc_html__('Set the global font size, style and library.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[panel]', 'botiga_panel_typography', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Page Layout', 'botiga'),
		'desc'       => esc_html__('Set the page layout.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_layout', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Blog Archives', 'botiga'),
		'desc'       => esc_html__('Set the blog layout, columns, pagination and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_blog_archives', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Single Post', 'botiga'),
		'desc'       => esc_html__('Set the single post layout, meta elements and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_blog_singles', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Buttons', 'botiga'),
		'desc'       => esc_html__('Create your own button, set typography and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_buttons', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Scroll to Top', 'botiga'),
		'desc'       => esc_html__('Set the scroll to top type, icon, position and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_scrolltotop', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Ajax Real-Time Search', 'botiga'),
		'desc'       => esc_html__('Built-in ajax functionalit to search without reloading the page.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[control]', 'shop_search_enable_ajax', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Product Catalog', 'botiga'),
		'desc'       => esc_html__('Set the shop layout, product cart and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[panel]', 'botiga_panel_shop_archive', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Single Product', 'botiga'),
		'desc'       => esc_html__('Set the product layout, tabs, size chart and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[panel]', 'botiga_panel_single_product', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Cart', 'botiga'),
		'desc'       => esc_html__('Set the cart layout, mini cart and more. Side off-canvas mini cart available on Botiga Pro.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_shop_cart', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Checkout', 'botiga'),
		'desc'       => esc_html__('Set the checkout layout, coupon and more. Multi-step, one-step and shopify checkout are avilable on Botiga Pro.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'woocommerce_checkout', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'module'    => 'schema-markup',
		'type'      => 'free',
		'title'     => esc_html__('Schema Markup', 'botiga'),
		'desc'      => esc_html__('Add the schema structured data to your website.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/schema-markup/',
	);

	$settings['features'][] = array(
		'module'     => 'adobe-typekit',
		'type'       => 'free',
		'title'      => esc_html__('Adobe Fonts', 'botiga'),
		'desc'       => esc_html__('Set and use Adobe Fonts.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_typography_general', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/how-to-use-adobe-fonts/',
	);

	// Pro features.
	$settings['features'][] = array(
		'module'     => 'custom-fonts',
		'type'       => 'pro',
		'title'      => esc_html__('Custom Fonts', 'botiga'),
		'desc'       => esc_html__('Upload your own custom fonts.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_typography_general', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-custom-fonts/',
	);

	$settings['features'][] = array(
		'module'     => 'wishlist',
		'type'       => 'pro',
		'title'      => esc_html__('Wishlist', 'botiga'),
		'desc'       => esc_html__('Your customers can save their favorite products to find them easily when they\'re ready to buy.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_wishlist', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-wishlist/',
	);

	$settings['features'][] = array(
		'module'     => 'product-swatches',
		'type'       => 'pro',
		'title'      => esc_html__('Variation Swatches', 'botiga'),
		'desc'       => esc_html__('Enable your customers to see all the available color, size, and other options as beautiful variation swatches.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_product_swatches', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-product-swatch/',
	);

	$settings['features'][] = array(
		'module'    => 'video-gallery',
		'type'      => 'pro',
		'title'     => esc_html__('Product Video & Audio', 'botiga'),
		'desc'      => esc_html__('Add videos to your products along with the image gallery. Featured videos to display in the shop catalog page are available as well.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/pro-product-featured-and-gallery-video-audio/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Image Hover Swap', 'botiga'),
		'desc'       => esc_html__('Swap the product image on mouse over.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'shop_product_image_swap' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-product-image-hover-swap/',
	);

	$settings['features'][] = array(
		'module' => 'variations-gallery',
		'type'   => 'pro',
		'title'  => esc_html__('Variations Gallery', 'botiga'),
		'desc'   => esc_html__('Set different galleries for product each product variation.', 'botiga'),
		'docs_link'  => 'https://docs.athemes.com/article/pro-product-variations-gallery/',
	);

	$settings['features'][] = array(
		'module'     => 'size-chart',
		'type'       => 'pro',
		'title'      => esc_html__('Size Chart', 'botiga'),
		'desc'       => esc_html__('Add custom size charts to your products, e.g. size charts for clothes, shoes, bags, or jewelry.', 'botiga'),
		'link_label' => esc_html__('Size Charts', 'botiga'),
		'link_url'   => add_query_arg('post_type', 'size_chart', admin_url('edit.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-size-chart/',
	);

	$settings['features'][] = array(
		'module'     => 'advanced-reviews',
		'type'       => 'pro',
		'title'      => esc_html__('Advanced Reviews', 'botiga'),
		'desc'       => esc_html__('Replace the default WooCommerce reviews workflow and style with a modern and intuitive star rating reviews.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[section]' => 'botiga_section_single_product_advanced_reviews' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-single-product-advanced-reviews/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Product Gallery Layouts', 'botiga'),
		'desc'       => esc_html__('Set the gallery slideshow layout and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[section]' => 'botiga_section_single_product_layout' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-product-gallery-layouts/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Product Tab Styles', 'botiga'),
		'desc'       => esc_html__('Set the tab layout, position, alignment and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[section]' => 'botiga_section_single_product_tabs' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-single-product-tabs-styles/',
	);

	$settings['features'][] = array(
		'module'     => 'buy-now',
		'type'       => 'pro',
		'title'      => esc_html__('Buy Now', 'botiga'),
		'desc'       => esc_html__('Allows to redirect customers directly to the checkout for quick buy.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_buy_now', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-buy-now-feature/',
	);

	$settings['features'][] = array(
		'module'     => 'free-shipping-progress-bar',
		'type'       => 'pro',
		'title'      => esc_html__('Free Shipping Progress Bar', 'botiga'),
		'desc'       => esc_html__('Display a progress bar to show how close you are to getting free delivery.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_free_shipping_progress_bar', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-free-shipping-progress-bar/',
	);

	$settings['features'][] = array(
		'module'     => 'quantity-step-control',
		'type'       => 'pro',
		'title'      => esc_html__('Quantity Step Control', 'botiga'),
		'desc'       => esc_html__('Set the min, max, step and default preset from all quantity inputs.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_catalog_general', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-quantity-step-control/',
	);

	$settings['features'][] = array(
		'module'     => 'sticky-add-to-cart',
		'type'       => 'pro',
		'title'      => esc_html__('Sticky Add to Cart', 'botiga'),
		'desc'       => esc_html__('Display a sticky add-to-cart button on your product single page. It will stay visible as the user explores the product.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[section]' => 'botiga_section_single_product_sticky_add_to_cart' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-sticky-add-to-cart/',
	);

	$settings['features'][] = array(
		'module'     => 'linked-variations',
		'type'       => 'pro',
		'title'      => esc_html__('Linked Variations', 'botiga'),
		'desc'       => esc_html__('Allows users to connect a group of any product types together by attribute(s) while they can still be managed as separate products.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('post_type', 'linked_variation', admin_url('edit.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-single-product-linked-variations/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Trust Badge', 'botiga'),
		'desc'       => esc_html__('Display a trust badge on single product pages.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'single_product_elements_order' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-product-trust-badge/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Reasons to Buy List', 'botiga'),
		'desc'       => esc_html__('Display a list with reasons to buy on single product pages.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'single_product_elements_order' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-reasons-to-buy-list/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Brand Image Upload', 'botiga'),
		'desc'       => esc_html__('Display a brand image on single product pages.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'single_product_elements_order' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-single-product-brand-image/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Next/Prev Buttons', 'botiga'),
		'desc'       => esc_html__('Display next/prev buttons on single product pages.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'single_product_navigation' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-next-prev-product-navigation/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Shop Header Styles', 'botiga'),
		'desc'       => esc_html__('Set the shop header colors, spacing and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'shop_archive_header_style' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-shop-header-styles/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Upsell Products Slider', 'botiga'),
		'desc'       => esc_html__('Display the upsell products as a slider.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'single_upsell_products' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-related-upsell-and-recently-viewed-products/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Related Products Slider', 'botiga'),
		'desc'       => esc_html__('Display the related products as a slider.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'single_related_products' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-advanced-related-products-options/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Shop Sidebar Layouts', 'botiga'),
		'desc'       => esc_html__('Set the shop sidebar layout, position and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[control]' => 'shop_archive_sidebar' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-shop-sidebar-positions/',
	);

	$settings['features'][] = array(
		'module'     => 'custom-sidebars',
		'type'       => 'pro',
		'title'      => esc_html__('Custom Sidebars', 'botiga'),
		'desc'       => esc_html__('Create any number of custom sidebars.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_sidebar', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-custom-sidebars/',
	);

	$settings['features'][] = array(
		'module'     => 'mega-menu',
		'type'       => 'pro',
		'title'      => esc_html__('Mega Menu', 'botiga'),
		'desc'       => esc_html__('Create beautiful and unique mega menus.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => admin_url('nav-menus.php'),
		'docs_link'  => 'https://docs.athemes.com/article/pro-mega-menu/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Multi-Step Checkout', 'botiga'),
		'desc'       => esc_html__('Multi-step style for the checkout.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[section]' => 'woocommerce_checkout' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-layouts/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Shopify Style Checkout', 'botiga'),
		'desc'       => esc_html__('Shopify style for the checkout.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[section]' => 'woocommerce_checkout' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-layouts/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('One-Step Checkout', 'botiga'),
		'desc'       => esc_html__('One-step style for the checkout.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array( 'autofocus[section]' => 'woocommerce_checkout' ), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-layouts/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Distraction-Free Checkout', 'botiga'),
		'desc'       => esc_html__('Increase your store conversion rate with the distraction free checkout.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'woocommerce_checkout', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-distraction-free-and-sticky-totals-box/',
	);

	$settings['features'][] = array(
		'module'     => 'add-to-cart-notifications',
		'type'       => 'pro',
		'title'      => esc_html__('Add To Cart Notifications', 'botiga'),
		'desc'       => esc_html__('Display a notification when a product is added to cart.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_adtcnotif', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-add-to-cart-notifications/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Side Mini Cart', 'botiga'),
		'desc'       => esc_html__('Display the mini cart inside of a offcanvas sidebar.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[control]', 'mini_cart_style', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-distraction-free-and-sticky-totals-box/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Floating Mini Cart', 'botiga'),
		'desc'       => esc_html__('Display the mini cart icon floating on the screen.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[control]', 'mini_cart_style', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-distraction-free-and-sticky-totals-box/',
	);

	$settings['features'][] = array(
		'module'     => 'modal-popup',
		'type'       => 'pro',
		'title'      => esc_html__('Modal Popup', 'botiga'),
		'desc'       => esc_html__('Displays a modal popup to highlight any content. Display conditions are available.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_modal_popup', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-modal-popup/',
	);

	$settings['features'][] = array(
		'module'    => 'login-popup',
		'type'      => 'pro',
		'title'     => esc_html__('Login Popup', 'botiga'),
		'desc'      => esc_html__('Display the login/register form inside a popup.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/pro-header-top-bar-login-register-link-with-popup/',
	);

	$settings['features'][] = array(
		'module'     => 'breadcrumbs',
		'type'       => 'pro',
		'title'      => esc_html__('Breadcrumbs', 'botiga'),
		'desc'       => esc_html__('Set the breadcrumb engine, spacing and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_breadcrumbs', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-breadcrumbs-2/',
	);

	$settings['features'][] = array(
		'module'     => 'quick-links',
		'type'       => 'pro',
		'title'      => esc_html__('Quick Links', 'botiga'),
		'desc'       => esc_html__('Floating quick links bar (contact, social, etc).', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_quicklinks', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/botiga-pro-quick-links/',
	);

	$settings['features'][] = array(
		'module'     => 'google-autocomplete',
		'type'       => 'pro',
		'title'      => esc_html__('Google Autocomplete', 'botiga'),
		'desc'       => esc_html__('Help customers autocomplete their addresses on checkout with Google Maps API.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_google_autocomplete_section', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-how-to-enable-google-autocomplete-on-checkout-address-fields/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Reading Post Time', 'botiga'),
		'desc'       => esc_html__('Display reading post time as a meta on single posts.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[control]', 'single_post_meta_elements', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-distraction-free-and-sticky-totals-box/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Reading Progress Bar', 'botiga'),
		'desc'       => esc_html__('Display a reading progress bar on single posts.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[control]', 'single_post_reading_progress', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-distraction-free-and-sticky-totals-box/',
	);

	$settings['features'][] = array(
		'module'    => 'table-of-contents',
		'type'      => 'pro',
		'title'     => esc_html__('Table of Contents', 'botiga'),
		'desc'      => esc_html__('Display a table of contents inside your blog posts.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/pro-single-blog-post-table-of-contents/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Hooked Elements', 'botiga'),
		'desc'       => esc_html__('Inject custom code across multiple available areas.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[panel]', 'botiga_panel_hooks', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-distraction-free-and-sticky-totals-box/',
	);

	$settings['features'][] = array(
		'module'     => 'templates',
		'type'       => 'pro',
		'title'      => esc_html__('Templates Builder', 'botiga'),
		'desc'       => esc_html__('Create custom templates for shop catalog, single products, 404 page, mega menu, modal popup and hooks.', 'botiga'),
		'link_label' => esc_html__('Build Templates', 'botiga'),
		'link_url'   => get_option( 'botiga-legacy-templates-builder' ) ? add_query_arg('post_type', 'athemes_hf', admin_url('edit.php')) : add_query_arg(array( 'page' => 'botiga-dashboard', 'tab' => 'builder' ), admin_url('admin.php')),
		'link_target'=> '_self',
		'docs_link'  => 'https://docs.athemes.com/article/pro-templates-builder-overview/',
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('White Label (Agency)', 'botiga'),
		'desc'       => esc_html__('Rename and present Botiga as your own.', 'botiga'),
		'docs_link'  => 'https://docs.athemes.com/article/pro-white-label-botiga/',
		'link_label' => esc_html__('Learn More', 'botiga'),
		'pro_use_docs_link' => true,
	);

	return $settings;
}
add_filter('botiga_dashboard_settings', 'botiga_dashboard_settings');

/**
 * Get all modules ids
 * 
 */
function botiga_get_modules_ids() {
	$settings = botiga_dashboard_settings();

	$modules = array();

	foreach ( $settings[ 'features' ] as $feature ) {
		if( ! isset( $feature[ 'module' ] ) ) {
			continue;
		}

		$modules[] = $feature[ 'module' ];
	}
	
	return $modules;
}

/**
 * Demos Settings
 * 
 */
function botiga_demos_settings($settings) {

	// Categories.
	$settings['categories'] = array(
		'business'  => 'Business',
		'portfolio' => 'Portfolio',
		'ecommerce' => 'eCommerce',
		'event'     => 'Events',
	);

	// Builders.
	$settings['builders'] = array(
		'gutenberg' => 'Gutenberg',
		'elementor' => 'Elementor',
	);

	// Pro.
	$settings['has_pro']   = false;
	$settings['pro_label'] = esc_html__('Get Pro', 'botiga');
	$settings['pro_link']  = 'https://athemes.com/botiga-upgrade/?utm_source=theme_table&utm_medium=button&utm_campaign=Botiga';

	return $settings;
}
add_filter( 'atss_register_demos_settings', 'botiga_demos_settings' );

/**
 * Get setting icon
 * 
 */
function botiga_dashboard_get_setting_icon( $slug ) {
	$icon = '';

	switch ( $slug ) {
		case 'general':
			$icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M11.9287 18C15.2424 18 17.9287 15.3137 17.9287 12C17.9287 8.68629 15.2424 6 11.9287 6C8.615 6 5.92871 8.68629 5.92871 12C5.92871 15.3137 8.615 18 11.9287 18ZM11.9287 15C13.5856 15 14.9287 13.6569 14.9287 12C14.9287 10.3431 13.5856 9 11.9287 9C10.2719 9 8.92871 10.3431 8.92871 12C8.92871 13.6569 10.2719 15 11.9287 15Z" fill="#1E1E1E"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M11.2758 4C10.787 4 10.3698 4.35341 10.2894 4.8356L9.92871 7H13.9287L13.568 4.8356C13.4876 4.35341 13.0704 4 12.5816 4H11.2758ZM12.5816 20C13.0704 20 13.4876 19.6466 13.568 19.1644L13.9287 17H9.92871L10.2894 19.1644C10.3698 19.6466 10.787 20 11.2758 20H12.5816Z" fill="#1E1E1E"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M18.53 7.43471C18.2856 7.01137 17.7709 6.82677 17.3132 6.99827L15.2584 7.76807L17.2584 11.2322L18.9524 9.83756C19.3298 9.52687 19.4273 8.98887 19.1829 8.56552L18.53 7.43471ZM5.32647 16.5655C5.57089 16.9889 6.08555 17.1735 6.54332 17.002L8.59811 16.2322L6.59811 12.7681L4.90406 14.1627C4.52665 14.4734 4.42918 15.0114 4.6736 15.4347L5.32647 16.5655Z" fill="#1E1E1E"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M4.67454 8.56553C4.43012 8.98888 4.52759 9.52688 4.90499 9.83757L6.59905 11.2322L8.59905 7.76808L6.54426 6.99828C6.08649 6.82678 5.57183 7.01138 5.32741 7.43472L4.67454 8.56553ZM19.1838 15.4347C19.4282 15.0114 19.3308 14.4734 18.9534 14.1627L17.2593 12.7681L15.2593 16.2322L17.3141 17.002C17.7719 17.1735 18.2865 16.9889 18.5309 16.5655L19.1838 15.4347Z" fill="#1E1E1E"/>
			</svg>';
			break;

		case 'performance':
			$icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M14.1109 6.79335L15.5547 7.62693L12.9157 13.0315L10.75 11.7811L14.1109 6.79335Z" fill="#1E1E1E"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M16.9497 16.9497C18.2165 15.683 19 13.933 19 12C19 8.13401 15.866 5 12 5C8.13401 5 5 8.13401 5 12C5 13.933 5.7835 15.683 7.05025 16.9497L5.98959 18.0104C4.45139 16.4722 3.5 14.3472 3.5 12C3.5 7.30558 7.30558 3.5 12 3.5C16.6944 3.5 20.5 7.30558 20.5 12C20.5 14.3472 19.5486 16.4722 18.0104 18.0104L16.9497 16.9497Z" fill="#1E1E1E"/>
			</svg>';
			break;

		case 'merchant':
			$icon = '<svg viewBox="0 0 256 256" width="24" height="24" xmlns="http://www.w3.org/2000/svg" class="stroke-based"><rect fill="none" height="256" width="256"/><path d="M212,132l-57.4,57.4a31.9,31.9,0,0,1-45.2,0L66.6,146.6a31.9,31.9,0,0,1,0-45.2L124,44" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="18"/><line fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="18" x1="88" x2="32" y1="168" y2="224"/><line fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="18" x1="144" x2="184" y1="64" y2="24"/><line fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="18" x1="232" x2="192" y1="72" y2="112"/><line fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="18" x1="224" x2="112" y1="144" y2="32"/></svg>';
			break;

		case 'info':
			$icon = '<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M9 1.6875C7.55373 1.6875 6.13993 2.11637 4.9374 2.91988C3.73486 3.72339 2.7976 4.86544 2.24413 6.20163C1.69067 7.53781 1.54586 9.00811 1.82801 10.4266C2.11017 11.8451 2.80661 13.148 3.82928 14.1707C4.85196 15.1934 6.15492 15.8898 7.57341 16.172C8.99189 16.4541 10.4622 16.3093 11.7984 15.7559C13.1346 15.2024 14.2766 14.2651 15.0801 13.0626C15.8836 11.8601 16.3125 10.4463 16.3125 9C16.3105 7.06123 15.5394 5.20246 14.1685 3.83154C12.7975 2.46063 10.9388 1.68955 9 1.6875ZM8.71875 5.0625C8.88563 5.0625 9.04876 5.11198 9.18752 5.2047C9.32627 5.29741 9.43441 5.42919 9.49828 5.58336C9.56214 5.73754 9.57885 5.90719 9.54629 6.07086C9.51373 6.23453 9.43337 6.38487 9.31537 6.50287C9.19737 6.62087 9.04703 6.70123 8.88336 6.73379C8.71969 6.76634 8.55004 6.74963 8.39586 6.68577C8.24169 6.62191 8.10991 6.51377 8.0172 6.37501C7.92449 6.23626 7.875 6.07313 7.875 5.90625C7.875 5.68247 7.9639 5.46786 8.12213 5.30963C8.28037 5.15139 8.49498 5.0625 8.71875 5.0625ZM9.5625 12.9375C9.26413 12.9375 8.97799 12.819 8.76701 12.608C8.55603 12.397 8.4375 12.1109 8.4375 11.8125V9C8.28832 9 8.14525 8.94074 8.03976 8.83525C7.93427 8.72976 7.875 8.58668 7.875 8.4375C7.875 8.28832 7.93427 8.14524 8.03976 8.03975C8.14525 7.93426 8.28832 7.875 8.4375 7.875C8.73587 7.875 9.02202 7.99353 9.233 8.2045C9.44398 8.41548 9.5625 8.70163 9.5625 9V11.8125C9.71169 11.8125 9.85476 11.8718 9.96025 11.9773C10.0657 12.0827 10.125 12.2258 10.125 12.375C10.125 12.5242 10.0657 12.6673 9.96025 12.7727C9.85476 12.8782 9.71169 12.9375 9.5625 12.9375Z" fill="#3858E9"/>
			</svg>';
			break;

		case 'arrow':
			$icon = '<svg width="8" height="8" viewBox="0 0 8 8" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M5.0301 6.45275C4.95061 6.37327 4.91246 6.27722 4.91564 6.16462C4.91882 6.05201 4.96028 5.95597 5.04003 5.87648L6.16278 4.75374H1.73142C1.61881 4.75374 1.52436 4.71558 1.44805 4.63928C1.37174 4.56297 1.33372 4.46864 1.33399 4.3563C1.33399 4.2437 1.37214 4.14924 1.44845 4.07294C1.52475 3.99663 1.61908 3.95861 1.73142 3.95887H6.16278L5.0301 2.82619C4.95061 2.74671 4.91087 2.65225 4.91087 2.54283C4.91087 2.4334 4.95061 2.33908 5.0301 2.25985C5.10958 2.18037 5.20404 2.14062 5.31347 2.14062C5.42289 2.14062 5.51722 2.18037 5.59644 2.25985L7.41468 4.0781C7.45443 4.11785 7.48265 4.1609 7.49934 4.20727C7.51603 4.25363 7.52424 4.30331 7.52398 4.3563C7.52398 4.4093 7.51563 4.45897 7.49894 4.50534C7.48225 4.55171 7.45416 4.59476 7.41468 4.63451L5.5865 6.46269C5.51364 6.53555 5.42263 6.57198 5.31347 6.57198C5.2043 6.57198 5.10985 6.53224 5.0301 6.45275Z" fill="#6D7175"/>
			</svg>';
			break;
		
	}

	if( empty( $icon ) ) {
		return '';
	}
	
	return wp_kses(
		$icon,
		array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
				'fill'      => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
				'stroke'    => true,
				'stroke-width' => true,
				'stroke-linejoin' => true,
				'stroke-linecap' => true,
			),
			'line'    => array(
				'x1'      => true,
				'y1'      => true,
				'x2'      => true,
				'y2'      => true,
				'stroke'  => true,
				'stroke-width' => true,
				'stroke-linecap' => true,
				'stroke-linejoin' => true,
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
			'rect'    => array(
				'x'      => true,
				'y'      => true,
				'width'  => true,
				'height' => true,
				'transform' => true,
				'fill'   => true,
			),
		)
	);
}
