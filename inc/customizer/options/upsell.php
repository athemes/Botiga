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
            'section'     => 'botiga_section_main_header',
            'description' => __( 'More header options available in PRO.', 'botiga' ),
            'priority'    => 999
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
            'section'     => 'botiga_section_blog_singles',
            'description' => __( 'More blog single posts options available in PRO.', 'botiga' ),
            'priority'    => 999
        )
    ) 
);

if( class_exists( 'Woocommerce' ) ) {

    /**
     * Woocommerce Single
     */
    $botiga_controls_general     = json_decode( $wp_customize->get_control( 'botiga_single_product_tabs' )->controls_general );
    $botiga_new_controls_general = array( '#customize-control-botiga_upsell_single_product' );
    $wp_customize->get_control( 'botiga_single_product_tabs' )->controls_general = json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

    $wp_customize->add_setting( 
        'botiga_upsell_single_product',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_single_product',
            array(
                'section'     => 'botiga_section_single_product',
                'description' => __( 'More single products options available in PRO.', 'botiga' ),
                'priority'    => 999
            )
        ) 
    );

    /**
     * Woocommerce Product Catalog
     */
    $botiga_controls_general     = json_decode( $wp_customize->get_control( 'botiga_product_catalog_tabs' )->controls_general );
    $botiga_new_controls_general = array( '#customize-control-botiga_upsell_product_catalog' );
    $wp_customize->get_control( 'botiga_product_catalog_tabs' )->controls_general = json_encode( array_merge( $botiga_controls_general, $botiga_new_controls_general ) );

    $wp_customize->add_setting( 
        'botiga_upsell_product_catalog',
        array(
            'default'           => '',
            'sanitize_callback' => 'botiga_sanitize_text'
        )
    );

    $wp_customize->add_control( 
        new Botiga_Upsell_Message( 
            $wp_customize, 
            'botiga_upsell_product_catalog',
            array(
                'section'     => 'woocommerce_product_catalog',
                'description' => __( 'More product catalog options available in PRO.', 'botiga' ),
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
                'section'     => 'botiga_section_shop_cart',
                'description' => __( 'More cart options available in PRO.', 'botiga' ),
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
                'section'     => 'woocommerce_checkout',
                'description' => __( 'More checkout options available in PRO.', 'botiga' ),
                'priority'    => 999
            )
        ) 
    );
    
}

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
            'section'     => 'botiga_section_footer_credits',
            'description' => __( 'More footer copyright options available in PRO version.', 'botiga' ),
            'priority'    => 999
        )
    ) 
);