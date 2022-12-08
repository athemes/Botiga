<?php
/**
 *
 * Dashboard Settings
 * @package Dashboard
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
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

  //
  // Hero.
  //
  $settings['hero_title'] = esc_html__( 'Welcome to Botiga', 'botiga' );
  $settings['hero_desc']  = esc_html__( 'Botiga is now installed and ready to go. To help you with the next step, we’ve gathered together on this page all the resources you might need. We hope you enjoy using Botiga.', 'botiga' );
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
  $settings['promo_title']  = esc_html__( 'Upgrade to Pro', 'botiga' );
  $settings['promo_desc']   = esc_html__( 'Take Botiga to a whole other level by upgrading to the Pro version.', 'botiga' );
  $settings['promo_button'] = esc_html__( 'Discover Botiga Pro', 'botiga' );
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
    'home'           => esc_html__( 'Home', 'botiga' ),
    'starter-sites'  => esc_html__( 'Starter Sites', 'botiga' ),
    'theme-features' => esc_html__( 'Theme Features', 'botiga' ),
    'useful-plugins' => esc_html__( 'Useful Plugins', 'botiga' ),
    'free-vs-pro'    => esc_html__( 'Free vs Pro', 'botiga' ),
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
    'title'  => esc_html__( 'aThemes Block', 'botiga' ),
    'desc'   => esc_html__( 'Extend the Gutenberg Block Editor with additional functionality. You can extend the Gutenberg block editor with additional functionality.', 'botiga' ),
  );

  $settings['plugins'][] = array(
    'slug'   => 'wpforms-lite',
    'path'   => 'wpforms-lite/wpforms.php',
    'icon'   => 'https://plugins.svn.wordpress.org/wpforms-lite/assets/icon-256x256.png',
    'banner' => 'https://plugins.svn.wordpress.org/wpforms-lite/assets/banner-772x250.png',
    'title'  => esc_html__( 'WP Forms', 'botiga' ),
    'desc'   => esc_html__( 'The best WordPress contact form plugin. Drag & Drop online form builder that helps you create beautiful contact forms + custom forms in minutes.', 'botiga' ),
  );

  $settings['plugins'][] = array(
    'slug'   => 'leadin',
    'path'   => 'leadin/leadin.php',
    'icon'   => 'https://plugins.svn.wordpress.org/leadin/assets/icon-256x256.png',
    'banner' => 'https://plugins.svn.wordpress.org/leadin/assets/banner-772x250.png',
    'title'  => esc_html__( 'HubSpot', 'botiga' ),
    'desc'   => esc_html__( 'HubSpot is a platform with all the tools and integrations you need for marketing, sales, and customer service.', 'botiga' ),
  );

  $settings['plugins'][] = array(
    'slug'   => 'tutor',
    'path'   => 'tutor/tutor.php',
    'icon'   => 'https://plugins.svn.wordpress.org/tutor/assets/icon-256X256.gif',
    'banner' => 'https://plugins.svn.wordpress.org/tutor/assets/banner-772x250.jpg',
    'title'  => esc_html__( 'Tutor LMS', 'botiga' ),
    'desc'   => esc_html__( 'Tutor LMS is a complete, feature-packed, and robust WordPress LMS plugin to easily create & sell courses online.', 'botiga' ),
  );

  //
  // Features.
  //
  $settings['features'] = array();

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Change Site Title or Logo', 'botiga' ),
    'desc'          => esc_html__( 'Set the title and upload logo.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[control]', 'blogname', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Typography', 'botiga' ),
    'desc'          => esc_html__( 'Set the global font size, style and library.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[panel]', 'botiga_panel_typography', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Color Options', 'botiga' ),
    'desc'          => esc_html__( 'Create your own palette and set the global colors.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'colors', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'module'            => 'hf-builder',
    'type'              => 'free',
    'title'             => esc_html__( 'Header & Footer Builder', 'botiga' ),
    'desc'              => esc_html__( 'Drag and drop header/footer builder.', 'botiga' ),
    'customize_url'     => add_query_arg( 'autofocus[section]', 'botiga_section_hb_wrapper', admin_url( 'customize.php' ) ),
    'documentation_url' => 'https://docs.athemes.com/article/447-header-builder-pro',
  );

  if ( ! Botiga_Modules::is_module_active( 'hf-builder' ) ) {

    $settings['features'][] = array(
      'type'          => 'free',
      'title'         => esc_html__( 'Main Header', 'botiga' ),
      'desc'          => esc_html__( 'Set the main header layout, elements and styles.', 'botiga' ),
      'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_main_header', admin_url( 'customize.php' ) ),
    );

    $settings['features'][] = array(
      'type'          => 'free',
      'title'         => esc_html__( 'Mobile Header', 'botiga' ),
      'desc'          => esc_html__( 'Set the mobile header layout, elements and styles.', 'botiga' ),
      'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_mobile_header', admin_url( 'customize.php' ) ),
    );

    $settings['features'][] = array(
      'type'          => 'free',
      'title'         => esc_html__( 'Footer Copyright', 'botiga' ),
      'desc'          => esc_html__( 'Set the copyright text, layout and styles.', 'botiga' ),
      'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_footer_credits', admin_url( 'customize.php' ) ),
    );

  }

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Blog Archives', 'botiga' ),
    'desc'          => esc_html__( 'Set the blog layout, columns, pagination and styles.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_blog_archives', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Single Posts', 'botiga' ),
    'desc'          => esc_html__( 'Set the single post layout, meta elements and styles.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_blog_singles', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Button Options', 'botiga' ),
    'desc'          => esc_html__( 'Create your own button, set typography and styles.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_buttons', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Product Catalog', 'botiga' ),
    'desc'          => esc_html__( 'Set the shop layout, product cart and more.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'woocommerce_product_catalog', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Single Products', 'botiga' ),
    'desc'          => esc_html__( 'Set the product layout, tabs, size chart and more.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_single_product', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Cart Layout', 'botiga' ),
    'desc'          => esc_html__( 'Set the cart layout, mini cart and more.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_shop_cart', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Checkout Options', 'botiga' ),
    'desc'          => esc_html__( 'Set the checkout layout, coupon and more.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'woocommerce_checkout', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'free',
    'title'         => esc_html__( 'Scroll to Top', 'botiga' ),
    'desc'          => esc_html__( 'Set the scroll to top type, icon, position and styles.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_scrolltotop', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'Wishlist', 'botiga' ),
    'desc'          => esc_html__( 'Set the wishlist layout and styles.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_wishlist', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'Product Swatches', 'botiga' ),
    'desc'          => esc_html__( 'Set the global swatches and toolitp.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_product_swatches', admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'Shop Header Styles', 'botiga' ),
    'desc'          => esc_html__( 'Set the shop header colors, spacing and more.', 'botiga' ),
    'customize_url' => add_query_arg( array( 'autofocus[section]' => 'woocommerce_product_catalog', 'control' => 'customize-control-accordion_shop_layout' ), admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'More Single Product Gallery Styles', 'botiga' ),
    'desc'          => esc_html__( 'Set the gallery slideshow layout and more.', 'botiga' ),
    'customize_url' => add_query_arg( array( 'autofocus[section]' => 'botiga_section_single_product', 'control' => 'customize-control-accordion_single_product_layout' ), admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'Single Product Sticky Add to Cart', 'botiga' ),
    'desc'          => esc_html__( 'Set the sticky cart elements, position and more.', 'botiga' ),
    'customize_url' => add_query_arg( array( 'autofocus[section]' => 'botiga_section_single_product', 'control' => 'customize-control-accordion_single_product_sticky_add_to_cart' ), admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'Single Product Tab Styles', 'botiga' ),
    'desc'          => esc_html__( 'Set the tab layout, position, alignment and more.', 'botiga' ),
    'customize_url' => add_query_arg( array( 'autofocus[section]' => 'botiga_section_single_product', 'control' => 'customize-control-accordion_single_product_tabs' ), admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'Shop Sidebar Layouts', 'botiga' ),
    'desc'          => esc_html__( 'Set the shop sidebar layout, position and more.', 'botiga' ),
    'customize_url' => add_query_arg( array( 'autofocus[section]' => 'woocommerce_product_catalog', 'control' => 'customize-control-accordion_shop_layout' ), admin_url( 'customize.php' ) ),
  );

  $settings['features'][] = array(
    'type'          => 'pro',
    'title'         => esc_html__( 'Distraction Free Checkout', 'botiga' ),
    'desc'          => esc_html__( 'Set the distraction free checkout.', 'botiga' ),
    'customize_url' => add_query_arg( 'autofocus[section]', 'woocommerce_checkout', admin_url( 'customize.php' ) ),
  );

  if ( ! Botiga_Modules::is_module_active( 'hf-builder' ) ) {

    $settings['features'][] = array(
      'type'          => 'pro',
      'title'         => esc_html__( 'More Footer Copyright Elements', 'botiga' ),
      'desc'          => esc_html__( 'Set the copyright text, layout and styles.', 'botiga' ),
      'customize_url' => add_query_arg( 'autofocus[section]', 'botiga_section_footer_credits', admin_url( 'customize.php' ) ),
    );

  }

  $settings['features'][] = array(
    'module'            => 'mega-menu',
    'type'              => 'pro',
    'title'             => esc_html__( 'Mega Menu', 'botiga' ),
    'desc'              => esc_html__( 'Create mega menus.', 'botiga' ),
    'customize_url'     => admin_url( 'nav-menus.php' ),
    'documentation_url' => 'https://docs.athemes.com/article/448-pro-mega-menu',
  );

  $settings['features'][] = array(
    'module'            => 'breadcrumbs',
    'type'              => 'pro',
    'title'             => esc_html__( 'Breadcrumbs', 'botiga' ),
    'desc'              => esc_html__( 'Set the breadcrumb engine, spacing and styles.', 'botiga' ),
    'customize_url'     => add_query_arg( 'autofocus[section]', 'botiga_breadcrumbs', admin_url( 'customize.php' ) ),
    'documentation_url' => 'https://docs.athemes.com/article/450-pro-breadcrumbs',
  );

  $settings['features'][] = array(
    'module'            => 'quick-links',
    'type'              => 'pro',
    'title'             => esc_html__( 'Quick Links', 'botiga' ),
    'desc'              => esc_html__( 'Set the quick links, layout and styles.', 'botiga' ),
    'customize_url'     => add_query_arg( 'autofocus[section]', 'botiga_quicklinks', admin_url( 'customize.php' ) ),
    'documentation_url' => 'https://docs.athemes.com/article/botiga-pro-quick-links',
  );

  return $settings;

}

add_filter( 'botiga_dashboard_settings', 'botiga_dashboard_settings' );

function botiga_demos_settings( $settings ) {

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
  $settings['pro_label'] = esc_html__( 'Get Pro', 'botiga' );
  $settings['pro_link']  = 'https://athemes.com/theme/botiga?utm_source=theme_table&utm_medium=button&utm_campaign=Botiga';

  return $settings;
}
add_filter( 'atss_register_demos_settings', 'botiga_demos_settings' );
