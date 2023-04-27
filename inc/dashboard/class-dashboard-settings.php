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

function botiga_dashboard_settings()
{

	$settings = array();

	//
	// General.
	//
	$settings['menu_slug']           = 'botiga-dashboard';
	$settings['starter_plugin_slug'] = 'athemes-starter-sites';
	$settings['starter_plugin_path'] = 'athemes-starter-sites/athemes-starter-sites.php';
	$settings['has_pro']             = false;

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
		'theme-features' => esc_html__('Theme Features', 'botiga'),
		'settings'       => esc_html__('Settings', 'botiga'),
		'useful-plugins' => esc_html__('Useful Plugins', 'botiga'),
		'free-vs-pro'    => esc_html__('Free vs Pro', 'botiga'),
	);

	//
	// Settings.
	//
	$settings['settings']  = array(
		'general'     => esc_html__('General', 'botiga'),
		'performance' => esc_html__('Performance', 'botiga'),
	);

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
		'title'      => esc_html__('Change Site Title or Logo', 'botiga'),
		'desc'       => esc_html__('Set the title and upload logo.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[control]', 'blogname', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Typography', 'botiga'),
		'desc'       => esc_html__('Set the global font size, style and library.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[panel]', 'botiga_panel_typography', admin_url('customize.php'))
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Color Options', 'botiga'),
		'desc'       => esc_html__('Create your own palette and set the global colors.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'colors', admin_url('customize.php'))
	);

	$settings['features'][] = array(
		'module'     => 'hf-builder',
		'type'       => 'free',
		'title'      => esc_html__('Header & Footer Builder', 'botiga'),
		'desc'       => esc_html__('Drag and drop header/footer builder.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_hb_wrapper', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/header-footer-builder/'
	);

	if (!Botiga_Modules::is_module_active('hf-builder')) {

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
		'title'      => esc_html__('Blog Archives', 'botiga'),
		'desc'       => esc_html__('Set the blog layout, columns, pagination and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_blog_archives', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Single Posts', 'botiga'),
		'desc'       => esc_html__('Set the single post layout, meta elements and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_blog_singles', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Button Options', 'botiga'),
		'desc'       => esc_html__('Create your own button, set typography and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_buttons', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Product Catalog', 'botiga'),
		'desc'       => esc_html__('Set the shop layout, product cart and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'woocommerce_product_catalog', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Single Products', 'botiga'),
		'desc'       => esc_html__('Set the product layout, tabs, size chart and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_single_product', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Cart Layout', 'botiga'),
		'desc'       => esc_html__('Set the cart layout, mini cart and more. Side off-canvas mini cart available on Botiga Pro.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_shop_cart', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Checkout Options', 'botiga'),
		'desc'       => esc_html__('Set the checkout layout, coupon and more. Multi-step, one-step and shopify checkout are avilable on Botiga Pro.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'woocommerce_checkout', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'free',
		'title'      => esc_html__('Scroll to Top', 'botiga'),
		'desc'       => esc_html__('Set the scroll to top type, icon, position and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_scrolltotop', admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'module' 	=> 'schema-markup',
		'type'   	=> 'free',
		'title'  	=> esc_html__('Schema Markup', 'botiga'),
		'desc'      => esc_html__('Add the schema structured data to your website.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/schema-markup/'
	);

	$settings['features'][] = array(
		'module'     => 'adobe-typekit',
		'type'       => 'free',
		'title'      => esc_html__('Adobe Fonts', 'botiga'),
		'desc'       => esc_html__('Set and use Adobe Fonts.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_typography_general', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/how-to-use-adobe-fonts/'
	);

	$settings['features'][] = array(
		'module'     => 'custom-fonts',
		'type'       => 'pro',
		'title'      => esc_html__('Custom Fonts', 'botiga'),
		'desc'       => esc_html__('Upload your own custom fonts.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_typography_general', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-custom-fonts/'
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Shop Header Styles', 'botiga'),
		'desc'       => esc_html__('Set the shop header colors, spacing and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array('autofocus[section]' => 'woocommerce_product_catalog', 'control' => 'customize-control-accordion_shop_layout'), admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('More Single Product Gallery Styles', 'botiga'),
		'desc'       => esc_html__('Set the gallery slideshow layout and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array('autofocus[section]' => 'botiga_section_single_product', 'control' => 'customize-control-accordion_single_product_layout'), admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Single Product Tab Styles', 'botiga'),
		'desc'       => esc_html__('Set the tab layout, position, alignment and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array('autofocus[section]' => 'botiga_section_single_product', 'control' => 'customize-control-accordion_single_product_tabs'), admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Shop Sidebar Layouts', 'botiga'),
		'desc'       => esc_html__('Set the shop sidebar layout, position and more.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array('autofocus[section]' => 'woocommerce_product_catalog', 'control' => 'customize-control-accordion_shop_layout'), admin_url('customize.php')),
	);

	$settings['features'][] = array(
		'type'       => 'pro',
		'title'      => esc_html__('Distraction Free Checkout', 'botiga'),
		'desc'       => esc_html__('Increase your store conversion rate with the distraction free checkout.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'woocommerce_checkout', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-checkout-distraction-free-and-sticky-totals-box/'
	);

	$settings['features'][] = array(
		'module'     => 'google-autocomplete',
		'type'       => 'pro',
		'title'      => esc_html__('Google Autocomplete', 'botiga'),
		'desc'       => esc_html__('Help customers autocomplete their addresses on checkout with Google Maps API.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_google_autocomplete_section', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-how-to-enable-google-autocomplete-on-checkout-address-fields/'
	);

	$settings['features'][] = array(
		'module'     => 'buy-now',
		'type'       => 'pro',
		'title'      => esc_html__('Buy Now', 'botiga'),
		'desc'       => esc_html__('Allows to redirect customers directly to the checkout for quick buy.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_buy_now', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-buy-now-feature/'
	);

	$settings['features'][] = array(
		'module'     => 'add-to-cart-notifications',
		'type'       => 'pro',
		'title'      => esc_html__('Add To Cart Notifications', 'botiga'),
		'desc'       => esc_html__('Display a notification when a product is added to cart.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_adtcnotif', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-add-to-cart-notifications/'
	);

	$settings['features'][] = array(
		'module'     => 'free-shipping-progress-bar',
		'type'       => 'pro',
		'title'      => esc_html__('Free Shipping Progress Bar', 'botiga'),
		'desc'       => esc_html__('Display a progress bar to show how close you are to getting free delivery.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_free_shipping_progress_bar', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-free-shipping-progress-bar/'
	);

	if ( !Botiga_Modules::is_module_active('hf-builder') ) {

		$settings['features'][] = array(
			'type'       => 'pro',
			'title'      => esc_html__('More Footer Copyright Elements', 'botiga'),
			'desc'       => esc_html__('Set the copyright text, layout and styles.', 'botiga'),
			'link_label' => esc_html__('Customize', 'botiga'),
			'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_footer_credits', admin_url('customize.php')),
		);
	}

	$settings['features'][] = array(
		'module'     => 'quantity-step-control',
		'type'       => 'pro',
		'title'      => esc_html__('Quantity Step Control', 'botiga'),
		'desc'       => esc_html__('Set the min, max, step and default preset from all quantity inputs.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_catalog_general', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-quantity-step-control/'
	);

	$settings['features'][] = array(
		'module'     => 'mega-menu',
		'type'       => 'pro',
		'title'      => esc_html__('Mega Menu', 'botiga'),
		'desc'       => esc_html__('Create beautiful and unique mega menus.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => admin_url('nav-menus.php'),
		'docs_link'  => 'https://docs.athemes.com/article/pro-mega-menu/'
	);

	$settings['features'][] = array(
		'module'     => 'wishlist',
		'type'       => 'pro',
		'title'      => esc_html__('Wishlist', 'botiga'),
		'desc'       => esc_html__('Your customers can save their favorite products to find them easily when they\'re ready to buy.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_wishlist', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-wishlist/'
	);

	$settings['features'][] = array(
		'module'     => 'modal-popup',
		'type'       => 'pro',
		'title'      => esc_html__('Modal Popup', 'botiga'),
		'desc'       => esc_html__('Displays a modal popup to highlight any content. Display conditions are available.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_modal_popup', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-modal-popup/'
	);

	$settings['features'][] = array(
		'module' 	=> 'table-of-contents',
		'type'   	=> 'pro',
		'title'  	=> esc_html__('Single Post Table of Contents', 'botiga'),
		'desc'   	=> esc_html__('Display a table of contents inside your blog posts.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/pro-single-blog-post-table-of-contents/'
	);

	$settings['features'][] = array(
		'module' 	=> 'login-popup',
		'type'   	=> 'pro',
		'title'  	=> esc_html__('Login Popup', 'botiga'),
		'desc'   	=> esc_html__('Display the login/register form inside a popup.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/pro-header-top-bar-login-register-link-with-popup/'
	);

	$settings['features'][] = array(
		'module'     => 'custom-sidebars',
		'type'       => 'pro',
		'title'      => esc_html__('Custom Sidebars', 'botiga'),
		'desc'       => esc_html__('Create any number of custom sidebars.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_sidebar', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-custom-sidebars/'
	);

	$settings['features'][] = array(
		'module'     => 'breadcrumbs',
		'type'       => 'pro',
		'title'      => esc_html__('Breadcrumbs', 'botiga'),
		'desc'       => esc_html__('Set the breadcrumb engine, spacing and styles.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_breadcrumbs', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-breadcrumbs-2/'
	);

	$settings['features'][] = array(
		'module'     => 'quick-links',
		'type'       => 'pro',
		'title'      => esc_html__('Quick Links', 'botiga'),
		'desc'       => esc_html__('Floating quick links bar (contact, social, etc).', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_quicklinks', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/botiga-pro-quick-links/'
	);

	$settings['features'][] = array(
		'module'     => 'product-swatches',
		'type'       => 'pro',
		'title'      => esc_html__('Product Swatches', 'botiga'),
		'desc'       => esc_html__('Enable your customers to see all the available color, size, and other options as beautiful product swatches.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg('autofocus[section]', 'botiga_section_product_swatches', admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-product-swatch/'
	);

	$settings['features'][] = array(
		'module'     => 'sticky-add-to-cart',
		'type'       => 'pro',
		'title'      => esc_html__('Single Product Sticky Add to Cart', 'botiga'),
		'desc'       => esc_html__('Display a sticky add-to-cart button on your product single page. It will stay visible as the user explores the product.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array('autofocus[section]' => 'botiga_section_single_product', 'control' => 'customize-control-accordion_single_product_sticky_add_to_cart'), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-sticky-add-to-cart/'
	);

	$settings['features'][] = array(
		'module'     => 'advanced-reviews',
		'type'       => 'pro',
		'title'      => esc_html__('Single Product Advanced Reviews', 'botiga'),
		'desc'       => esc_html__('Replace the default WooCommerce reviews workflow and style with a modern and intuitive star rating reviews.', 'botiga'),
		'link_label' => esc_html__('Customize', 'botiga'),
		'link_url'   => add_query_arg(array('autofocus[section]' => 'botiga_section_single_product', 'control' => 'customize-control-accordion_single_product_reviews_advanced'), admin_url('customize.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-single-product-advanced-reviews/'
	);

	$settings['features'][] = array(
		'module'     => 'size-chart',
		'type'       => 'pro',
		'title'      => esc_html__('Single Product Size Chart', 'botiga'),
		'desc'       => esc_html__('Add custom size charts to your products, e.g. size charts for clothes, shoes, bags, or jewelry.', 'botiga'),
		'link_label' => esc_html__('Size Charts', 'botiga'),
		'link_url'   => add_query_arg('post_type', 'size_chart', admin_url('edit.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-size-chart/'
	);

	$settings['features'][] = array(
		'module'     => 'linked-variations',
		'type'       => 'pro',
		'title'      => esc_html__('Product Linked Variations', 'botiga'),
		'desc'       => esc_html__('Allows users to connect a group of any product types together by attribute(s) while they can still be managed as separate products.', 'botiga'),
		'link_label' => esc_html__('Linked Variations', 'botiga'),
		'link_url'   => add_query_arg('post_type', 'linked_variation', admin_url('edit.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-single-product-linked-variations/'
	);

	$settings['features'][] = array(
		'module' 	=> 'video-gallery',
		'type'   	=> 'pro',
		'title'  	=> esc_html__('Product Video Gallery', 'botiga'),
		'desc'   	=> esc_html__('Add videos to your products along with the image gallery. Featured videos to display in the shop catalog page are available as well.', 'botiga'),
		'docs_link' => 'https://docs.athemes.com/article/pro-product-featured-and-gallery-video-audio/'
	);

	$settings['features'][] = array(
		'module' => 'variations-gallery',
		'type'   => 'pro',
		'title'  => esc_html__('Product Variations Gallery', 'botiga'),
		'desc'   => esc_html__('Set different galleries for product each product variation.', 'botiga'),
	);

	$settings['features'][] = array(
		'module'     => 'templates',
		'type'       => 'pro',
		'title'      => esc_html__('Templates Builder', 'botiga'),
		'desc'       => esc_html__('Create custom templates for shop catalog, single products, 404 page, mega menu, modal popup and hooks.', 'botiga'),
		'link_label' => esc_html__('Build Templates', 'botiga'),
		'link_url'   => add_query_arg('post_type', 'athemes_hf', admin_url('edit.php')),
		'docs_link'  => 'https://docs.athemes.com/article/pro-templates-builder-overview/'
	);

	return $settings;
}

add_filter('botiga_dashboard_settings', 'botiga_dashboard_settings');

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
	$settings['pro_link']  = 'https://athemes.com/theme/botiga?utm_source=theme_table&utm_medium=button&utm_campaign=Botiga';

	return $settings;
}
add_filter( 'atss_register_demos_settings', 'botiga_demos_settings' );
