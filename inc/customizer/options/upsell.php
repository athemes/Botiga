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
$wp_customize->get_control( 'botiga_main_header_tabs' )->controls_general = json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

$wp_customize->add_setting( 
    'botiga_upsell_main_header',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text'
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
                esc_html__( 'Polylang/WPML language switcher', 'botiga' )
            ),
            'section'     => 'botiga_section_main_header',
            'priority'    => 999
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
		'sanitize_callback' => 'botiga_sanitize_text'
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
                esc_html__( 'Page level options to control the image', 'botiga' )
            ),
            'section'       => 'header_image',
            'priority'      => 999
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
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_typography_general',
        array(
            'title'         => esc_html__( 'More typography options available with Botiga Pro.', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Upload and use custom fonts', 'botiga' )
            ),
            'section'       => 'botiga_section_typography_general',
            'priority'      => 999
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
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_site_layout',
        array(
            'title'         => esc_html__( 'More site layout options available with Botiga Pro.', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Boxed layout', 'botiga' ),
                esc_html__( 'Padded layout', 'botiga' ),
                esc_html__( 'Fluid layout', 'botiga' )
            ),
            'section'       => 'botiga_section_layout',
            'priority'      => 999
        )
    ) 
);

/**
 * General options
 */
$wp_customize->add_setting( 
    'botiga_upsell_general',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_general',
        array(
            'title'         => esc_html__( 'More options available with Botiga Pro.', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Free shipping progress bar module', 'botiga' ),
                esc_html__( 'Display buy now button', 'botiga' ),
                esc_html__( 'Add to cart notifications popup', 'botiga' ),
                esc_html__( 'Quantity picker step control', 'botiga' ),
                esc_html__( 'Modal popup module', 'botiga' ),
                esc_html__( 'Custom sidebars module', 'botiga' ),
                esc_html__( 'Quick links module', 'botiga' ),
                esc_html__( 'Templates builder', 'botiga' ),
                esc_html__( '9+ quantity picker styles', 'botiga' ),
                esc_html__( 'Schema markup module', 'botiga' ),
            ),
            'section'       => 'botiga_section_catalog_general',
            'priority'      => 999
        )
    ) 
);

/**
 * Blog Single
 */
$botiga_controls_general     = json_decode( $wp_customize->get_control( 'botiga_blog_single_tabs' )->controls_general );
$botiga_new_controls_general = array( '#customize-control-botiga_upsell_blog_single' );
$wp_customize->get_control( 'botiga_blog_single_tabs' )->controls_general = json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

$wp_customize->add_setting( 
    'botiga_upsell_blog_single',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);

$wp_customize->add_control( 
    new Botiga_Upsell_Message( 
        $wp_customize, 
        'botiga_upsell_blog_single',
        array(
            'title'         => esc_html__( 'More blog single posts options available with Botiga Pro.', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Reading post time', 'botiga' ),
                esc_html__( 'Reading progress bar', 'botiga' ),
                esc_html__( 'Table of contents', 'botiga' ),
                esc_html__( 'Share box buttons', 'botiga' )
            ),
            'section'       => 'botiga_section_blog_singles',
            'priority'      => 999
        )
    ) 
);

if( class_exists( 'Woocommerce' ) ) {

    /**
     * Woocommerce Single Layout Section
     */
    $wp_customize->add_setting( 
        'botiga_upsell_single_product_layout',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_single_product_layout',
            array(
                'title'         => esc_html__( 'More single product options available with Botiga Pro.', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'Product swatches', 'botiga' ),
                    esc_html__( 'Advanced reviews system', 'botiga' ),
                    esc_html__( 'Product trust badge', 'botiga' ),
                    esc_html__( 'Next/prev product buttons', 'botiga' ),
                    esc_html__( 'Gallery support to video/audio', 'botiga' ),
                    esc_html__( 'Upsell and related products slider', 'botiga' )
                ),
                'section'     => 'botiga_section_single_product_layout',
                'priority'    => 999
            )
        ) 
    );

    /**
     * Woocommerce Single Tabs Section
     */
    $wp_customize->add_setting( 
        'botiga_upsell_single_product_tabs',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_single_product_tabs',
            array(
                'title'         => esc_html__( 'More single product tabs options available with Botiga Pro.', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'More positions to display the tabs', 'botiga' ),
                    esc_html__( '5+ layout variations', 'botiga' )
                ),
                'section'     => 'botiga_section_single_product_tabs',
                'priority'    => 999
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
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_shop_archive_layout',
            array(
                'title'         => esc_html__( 'More product catalog options available with Botiga Pro.', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'Wishlist', 'botiga' ),
                    esc_html__( 'Off-Canvas sidebar filter', 'botiga' ),
                    esc_html__( 'More shop header styles', 'botiga' ),
                    esc_html__( 'Load more button pagination', 'botiga' ),
                    esc_html__( 'Products spacing control', 'botiga' )
                ),
                'section'     => 'woocommerce_product_catalog',
                'priority'    => 999
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
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_shop_archive_product_card',
            array(
                'title'         => esc_html__( 'More product card options available with Botiga Pro.', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'Display quantity picker', 'botiga' ),
                    esc_html__( 'Render ACF field', 'botiga' ),
                    esc_html__( 'Display product stock', 'botiga' ),
                    esc_html__( 'Product image swap', 'botiga' ),
                    esc_html__( 'Display \'in cart\' quantity', 'botiga' )
                ),
                'section'     => 'botiga_section_shop_archive_product_card',
                'priority'    => 999
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
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_cart',
            array(
                'title'         => esc_html__( 'More cart options available with Botiga Pro.', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'More cart table styles', 'botiga' ),
                    esc_html__( 'Display \'continue shopping\' button', 'botiga' ),
                    esc_html__( 'Off-Canvas side mini cart style', 'botiga' ),
                    esc_html__( 'Floating mini cart icon', 'botiga' ),
                    esc_html__( 'Display quantity picker in the mini cart', 'botiga' )
                ),
                'section'     => 'botiga_section_shop_cart',
                'priority'    => 999
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
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_checkout',
            array(
                'title'         => esc_html__( 'More checkout options available with Botiga Pro.', 'botiga' ),
                'features_list' => array(
                    esc_html__( 'Multi step checkout', 'botiga' ),
                    esc_html__( 'Shopify checkout style', 'botiga' ),
                    esc_html__( 'One step checkout', 'botiga' ),
                    esc_html__( 'Distraction free checkout', 'botiga' ),
                    esc_html__( 'Display quantity picker in the checkout', 'botiga' )
                ),
                'section'     => 'woocommerce_checkout',
                'priority'    => 999
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
            'title'         => esc_html__( 'More menu options available with Botiga Pro.', 'botiga' ),
            'features_list' => array(
                esc_html__( 'Mega menu module', 'botiga' ),
                esc_html__( 'Extra primary mobile menu location', 'botiga' ),
                esc_html__( 'Extra secondary mobile menu location', 'botiga' ),
                esc_html__( 'Extra footer copyright menu location', 'botiga' )
            ),
            'panel'         => 'nav_menus',
            'priority'      => 999
        )
    ) 
);

/**
 * Footer Copyright
 */
$botiga_controls_general     = json_decode( $wp_customize->get_control( 'botiga_footer_credits_tabs' )->controls_general );
$botiga_new_controls_general = array( '#customize-control-botiga_upsell_footer_copyright' );
$wp_customize->get_control( 'botiga_footer_credits_tabs' )->controls_general = json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

$wp_customize->add_setting( 
    'botiga_upsell_footer_copyright',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_text'
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
            'priority'      => 999
        )
    ) 
);