<?php
/**
 * Woocommerce Single Product Customizer options
 *
 * @package Botiga
 */

/**
 * Panel
 */
$wp_customize->add_panel(
    'botiga_panel_single_product',
    array(
        'title' => esc_html__('Single Product', 'botiga'),
        'priority' => 110,
        'description' => esc_html__('Manage the overall design and functionality from the shop single product pages.', 'botiga'),
    )
);

/**
 * Layout Section
 */

// Section
$wp_customize->add_section(
    'botiga_section_single_product_layout',
    array(
        'panel'       => 'botiga_panel_single_product',
        'title'       => esc_html__('Layout', 'botiga'),
        'description' => esc_html__( 'Manage the overall design and functionality from the shop single product pages.', 'botiga' ),
    )
);

// Tabs (Control)
$wp_customize->add_setting(
    'botiga_single_product_layout_tabs',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new Botiga_Tab_Control(
        $wp_customize,
        'botiga_single_product_layout_tabs',
        array(
            'label' => '',
            'section' => 'botiga_section_single_product_layout',
            'controls_general' => wp_json_encode(array(
                '#customize-control-single_gallery_slider',
                '#customize-control-single_product_gallery',
                '#customize-control-single_zoom_effects',
                '#customize-control-single_gallery_divider_1',
                '#customize-control-single_breadcrumbs',
                '#customize-control-single_breadcrumbs_hide_title',
                '#customize-control-single_ajax_add_to_cart',
                '#customize-control-single_product_sidebar',
                '#customize-control-single_product_elements_order',
                '#customize-control-single_upsell_products_top_divider',
                '#customize-control-single_upsell_products',
                '#customize-control-single_recently_viewed_top_divider',
                '#customize-control-single_recently_viewed_products',
                '#customize-control-single_recently_viewed_bottom_divider',
                '#customize-control-single_related_products',
                '#customize-control-single_product_sku',
                '#customize-control-single_product_categories',
                '#customize-control-single_product_tags',
            )),
            'controls_design' => wp_json_encode(array(
                '#customize-control-single_product_title_title',
                '#customize-control-single_product_title_font_style',
                '#customize-control-single_product_title_adobe_font',
                '#customize-control-single_product_title_font',
                '#customize-control-single_product_title_size',
                '#customize-control-single_product_title_text_style',
                '#customize-control-single_product_title_color',
                '#customize-control-single_product_styling_divider_1',
				'#customize-control-single_product_title_and_price_divider',
                '#customize-control-single_product_price_title',
                '#customize-control-single_product_price_size',
                '#customize-control-single_product_price_color',
            )),
        )
    )
);

// Layout Settings
require 'single-product/section-layout.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Tabs Section
 */

// Section
$wp_customize->add_section(
    'botiga_section_single_product_tabs',
    array(
        'panel'       => 'botiga_panel_single_product',
        'title'       => esc_html__('Product Tab', 'botiga'),
        'description' => esc_html__( 'Manage the overall design and functionality from the shop single product tabs.', 'botiga' ),
    )
);

// Tabs (Control)
if( defined( 'BOTIGA_PRO_VERSION' ) ) {
    $wp_customize->add_setting(
        'botiga_single_product_tabs_tabs',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control(
        new Botiga_Tab_Control(
            $wp_customize,
            'botiga_single_product_tabs_tabs',
            array(
                'label' => '',
                'section' => 'botiga_section_single_product_tabs',
                'controls_general' => wp_json_encode(array(
                    '#customize-control-single_product_tabs',
                )),
                'controls_design' => wp_json_encode(array()),
            )
        )
    );
}

// Product Tabs Settings
require 'single-product/section-tabs.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
