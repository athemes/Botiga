<?php
/**
 * Pro upsell options
 *
 * @package Botiga
 */

/**
 * Main Header
 */
$botiga_controls_general     = json_decode( $wp_customize->get_control( 'botiga_main_header_tabs' )->controls_general );
$botiga_new_controls_general = array( '#customize-control-botiga_upsell_main_header' );
$wp_customize->get_control( 'botiga_main_header_tabs' )->controls_general = wp_json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

$wp_customize->add_setting( 
    'botiga_upsell_main_header',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_main_header',
        array(
            'title'         => esc_html__( 'More header options available with Botiga Pro.', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Render HTML content', 'botiga' ),
                esc_html__( 'Render shortcode content', 'botiga' ),
                esc_html__( 'Polylang/WPML language switcher', 'botiga' ),
            ),
            'section'     => 'botiga_section_main_header',
            'priority'    => 999,
        )
    ) 
);

/**
 * Header Image
 */
$wp_customize->add_setting( 
    'botiga_upsell_header_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_header_image',
        array(
            'title'         => esc_html__( 'More header image options available with Botiga Pro.', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Display shop category image', 'botiga' ),
                esc_html__( 'Page level options to control the image', 'botiga' ),
            ),
            'section'       => 'header_image',
            'priority'      => 999,
        )
    ) 
);

/**
 * Typography General Section
 */
$wp_customize->add_setting( 
    'botiga_upsell_typography_general',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_typography_general',
        array(
            'title'         => esc_html__( 'Create your own custom Fonts Library with Botiga Pro!', 'botiga' ),
            'sub_title'     => esc_html__( 'You can upload your favorite fonts in the following formats:', 'botiga' ),
            'features_list' => array(
                '.woff2',
                '.woff',
                '.ttf',
                '.eot',
                '.otf',
                '.svg',
            ),
            'features_list_last_item_text' => array(
                'text_before_link' => esc_html__( 'Plus, you\'ll unlock', 'botiga' ),
                'link_text'        => esc_html__( 'many other premium features!', 'botiga' ),
            ),
            'section'       => 'botiga_section_typography_general',
            'priority'      => 999,
        )
    ) 
);

/**
 * Site Layout
 */
$wp_customize->add_setting( 
    'botiga_upsell_site_layout',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_site_layout',
        array(
            'title'         => esc_html__( 'Switch to a different site layout with Botiga Pro!', 'botiga' ),
            'sub_title'     => esc_html__( 'You\'ll unlock the following layouts:', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Boxed', 'botiga' ),
                esc_html__( 'Padded', 'botiga' ),
                esc_html__( 'Fluid', 'botiga' ),
            ),
            'features_list_last_item_text' => array(
                'text_before_link' => esc_html__( 'Plus, you\'ll get access to', 'botiga' ),
                'link_text'        => esc_html__( 'many other premium features!', 'botiga' ),
            ),
            'section'       => 'botiga_section_layout',
            'priority'      => 999,
        )
    ) 
);

/**
 * Blog Single
 */
$botiga_controls_general     = json_decode( $wp_customize->get_control( 'botiga_blog_single_tabs' )->controls_general );
$botiga_new_controls_general = array( '#customize-control-botiga_upsell_blog_single' );
$wp_customize->get_control( 'botiga_blog_single_tabs' )->controls_general = wp_json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

$wp_customize->add_setting( 
    'botiga_upsell_blog_single',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_blog_single',
        array(
            'title'         => esc_html__( 'Improve the user experience of your blog posts with Botiga Pro!', 'botiga' ),
            'features_list' => array(
                esc_html__( 'A reading time estimator', 'botiga' ),
                esc_html__( 'A reading progress bar', 'botiga' ),
                esc_html__( 'Table of contents', 'botiga' ),
                esc_html__( 'Social share buttons', 'botiga' ),
            ),
            'section'       => 'botiga_section_blog_singles',
            'priority'      => 999,
        )
    ) 
);

if( class_exists( 'Woocommerce' ) ) {

    /**
     * Woocommerce Single Tabs Section
     */
    $wp_customize->add_setting( 
        'botiga_upsell_single_product_tabs',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_single_product_tabs',
            array(
                'title'         => esc_html__( 'Single product tabs options available with Botiga Pro.', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'More positions to display the tabs', 'botiga' ),
                    esc_html__( '5+ layout variations', 'botiga' ),
                ),
                'section'     => 'botiga_section_single_product_tabs',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Shop Archive Layout Section
     */
    $wp_customize->add_setting( 
        'botiga_upsell_shop_archive_layout',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_shop_archive_layout',
            array(
                'title'         => esc_html__( 'Increase the conversion rate of your product catalog with Botiga Pro!', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'Wishlist buttons', 'botiga' ),
                    esc_html__( 'Off-canvas sidebar filters', 'botiga' ),
                    esc_html__( 'Extra shop header styles', 'botiga' ),
                    esc_html__( '\'Load more\' pagination', 'botiga' ),
                    esc_html__( 'Product spacing control', 'botiga' ),
                ),
                'section'     => 'woocommerce_product_catalog',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Shop Archive Product Card Section
     */
    $wp_customize->add_setting( 
        'botiga_upsell_shop_archive_product_card',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_shop_archive_product_card',
            array(
                'title'         => esc_html__( 'Make your product cards more engaging with Botiga Pro!', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'A quantity picker', 'botiga' ),
                    esc_html__( 'An in-cart quantity counter', 'botiga' ),
                    esc_html__( 'A product stock status label', 'botiga' ),
                    esc_html__( 'Custom fields added with the ACF plugin', 'botiga' ),
                    esc_html__( 'A cool product image swap effect', 'botiga' ),
                ),
                'section'     => 'botiga_section_shop_archive_product_card',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Cart
     */
    $wp_customize->add_setting( 
        'botiga_upsell_cart',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_cart',
            array(
                'title'         => esc_html__( 'Deliver a better cart experience with Botiga Pro!', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'Additional cart table styles', 'botiga' ),
                    esc_html__( 'A stylish \'Continue shopping\' button', 'botiga' ),
                    esc_html__( 'Off-canvas side mini cart functionality', 'botiga' ),
                    esc_html__( 'A floating mini cart icon', 'botiga' ),
                    esc_html__( 'An option to show a quantity picker inside the mini cart', 'botiga' ),
                ),
                'section'     => 'botiga_section_shop_cart',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Checkout
     */
    $wp_customize->add_setting( 
        'botiga_upsell_checkout',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_checkout',
            array(
                'title'         => esc_html__( 'Make the checkout process easier than ever with Botiga Pro!', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'A one-step checkout layout', 'botiga' ),
                    esc_html__( 'A Shopify-like checkout layout', 'botiga' ),
                    esc_html__( 'A multi-step checkout layout', 'botiga' ),
                    esc_html__( 'An option to show a quantity picker on the checkout page', 'botiga' ),
                    esc_html__( 'A distraction-free checkout page', 'botiga' ),
                ),
                'section'     => 'woocommerce_checkout',
                'priority'    => 999,
            )
        ) 
    );
    
}

/**
 * Menus
 */
$wp_customize->add_section( 
    new Botiga_Section_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_menus',
        array(
            'title'         => esc_html__( 'Create more complex menus with Botiga Pro!', 'botiga' ),
            'features_list' => array(
                esc_html__( 'A mega menu module', 'botiga' ),
                esc_html__( 'A \'Primary Mobile Menu\' location', 'botiga' ),
                esc_html__( 'A \'Secondary Mobile Menu\' location', 'botiga' ),
                esc_html__( 'A \'Footer Copyright Menu\' location', 'botiga' ),
            ),
            'panel'         => 'nav_menus',
            'priority'      => 999,
        )
    ) 
);

/**
 * Footer Copyright
 */
$botiga_controls_general     = json_decode( $wp_customize->get_control( 'botiga_footer_credits_tabs' )->controls_general );
$botiga_new_controls_general = array( '#customize-control-botiga_upsell_footer_copyright' );
$wp_customize->get_control( 'botiga_footer_credits_tabs' )->controls_general = wp_json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

$wp_customize->add_setting( 
    'botiga_upsell_footer_copyright',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_footer_copyright',
        array(
            'title'   => __( 'More footer copyright options available in PRO version.', 'botiga' ),
            'display_thumb' => false, 
            'section'       => 'botiga_section_footer_credits',
            'priority'      => 999,
        )
    ) 
);

/**
 * Upsell Sections
 * Sections that are not clickable
 */

// Main Panel

// Custom Sidebar
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_sidebar',
        array(
            'title'         => esc_html__( 'Custom Sidebar', 'botiga' ),
            'priority'      => 30,
        )
    ) 
);

// Product Swatches
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_product_swatches',
        array(
            'title'         => esc_html__( 'Variation Swatch', 'botiga' ),
            'priority'      => 150,
        )
    ) 
);

// Add To Cart Notifications
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_adtcnotif',
        array(
            'title'         => esc_html__( 'Add To Cart Notifications', 'botiga' ),
            'priority'      => 152,
        )
    ) 
);

// Free Shipping Progress Bar
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_free_shipping_progress_bar',
        array(
            'title'         => esc_html__( 'Free Shipping Progress Bar', 'botiga' ),
            'priority'      => 152,
        )
    ) 
);

// Breadcrumbs Module
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_breadcrumbs',
        array(
            'title'         => esc_html__( 'Advanced Breadcrumbs', 'botiga' ),
            'priority'      => 80,
        )
    ) 
);

// Buy Now
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_buy_now',
        array(
            'title'         => esc_html__( 'Buy Now', 'botiga' ),
            'priority'      => 151,
        )
    ) 
);

// Modal Popup
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_modal_popup',
        array(
            'title'         => esc_html__( 'Modal Popup', 'botiga' ),
            'priority'      => 185,
        )
    ) 
);

// Quick Links
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_quicklinks',
        array(
            'title'         => esc_html__( 'Quick Links', 'botiga' ),
            'priority'      => 85,
        )
    ) 
);

// Wishlist
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_wishlist',
        array(
            'title'         => esc_html__( 'Wishlist', 'botiga' ),
            'priority'      => 149,
        )
    ) 
);

// Single Product Panel

// Size Chart
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_single_product_size_chart',
        array(
            'title'         => esc_html__( 'Size Chart', 'botiga' ),
            'panel'         => 'botiga_panel_single_product',
        )
    ) 
);

// Advanced Reviews
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_single_product_advanced_reviews',
        array(
            'title'         => esc_html__( 'Advanced Reviews', 'botiga' ),
            'panel'         => 'botiga_panel_single_product',
        )
    ) 
);

// Sticky Add To Cart
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_single_product_sticky_add_to_cart',
        array(
            'title'         => esc_html__( 'Sticky Add To Cart', 'botiga' ),
            'panel'         => 'botiga_panel_single_product',
        )
    ) 
);

// Linked Variations
$wp_customize->add_section( 
    new Botiga_Section_Upsell( 
        $wp_customize, 
        'botiga_section_single_product_linked_variations',
        array(
            'title'         => esc_html__( 'Linked Variations', 'botiga' ),
            'panel'         => 'botiga_panel_single_product',
        )
    ) 
);

// Extensions

// Hooks
$wp_customize->add_panel(
	new Botiga_Panel_Upsell(
		$wp_customize,
		'botiga_panel_hooks',
		array(
			'title'       => esc_html__( 'Hooks', 'botiga' ),
			'description' => esc_html__( 'Render custom content in multiples areas across the website.', 'botiga' ),
			'priority'    => 190,
		)
	)
);