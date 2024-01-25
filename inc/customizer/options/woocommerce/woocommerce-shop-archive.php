<?php
/**
 * Woocommerce Shop Archive Customizer options
 *
 * @package Botiga
 */

/**
 * Panel
 */
$wp_customize->add_panel(
    'botiga_panel_shop_archive',
    array(
        'title' => esc_html__( 'Product Catalog', 'botiga' ),
        'priority' => 111,
        'description' => esc_html__('Manage the overall design and functionality from the shop archive pages.', 'botiga'),
    )
);

/**
 * Layout Section
 * 
 */

// Section
$wp_customize->get_section( 'woocommerce_product_catalog' )->panel = 'botiga_panel_shop_archive';
$wp_customize->get_section( 'woocommerce_product_catalog' )->title = esc_html__( 'Layout', 'botiga' );

// Layout Tabs (control)
if( defined( 'BOTIGA_PRO_VERSION' ) ) {
	$wp_customize->add_setting(
		'botiga_product_catalog_tabs',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Botiga_Tab_Control (
			$wp_customize,
			'botiga_product_catalog_tabs',
			array(
				'label'            => '',
				'section'          => 'woocommerce_product_catalog',
				'controls_general' => wp_json_encode( array( 
					'#customize-control-woocommerce_catalog_rows',
					'#customize-control-woocommerce_catalog_columns',
					'#customize-control-shop_woocommerce_catalog_columns_desktop',
					'#customize-control-shop_woocommerce_catalog_rows',
					'#customize-control-shop_archive_layout',
					'#customize-control-shop_archive_sidebar',
					'#customize-control-shop_archive_divider_1',
					'#customize-control-shop_page_elements_title',
					'#customize-control-shop_page_title',
					'#customize-control-shop_page_description',
					'#customize-control-shop_product_sorting',
					'#customize-control-shop_results_count',
					'#customize-control-shop_breadcrumbs',
				) ),
				'controls_design'  => wp_json_encode( array() ),
				'priority'         =>   -10,
			)
		)
	);
}

// Layout Settings
require 'shop-archive/section-layout.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Product Card Section
 * 
 */

// Section
$wp_customize->add_section(
    'botiga_section_shop_archive_product_card',
    array(
        'panel'       => 'botiga_panel_shop_archive',
        'title'       => esc_html__( 'Product Card', 'botiga' ),
		'description' => esc_html__( 'Manage the overall design and functionality from the shop archive products card.', 'botiga' ),
    )
);

// Product Card Tabs (control)
$wp_customize->add_setting(
	'botiga_shop_archive_product_card_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_shop_archive_product_card_tabs',
		array(
			'label'            => '',
			'section'          => 'botiga_section_shop_archive_product_card',
			'controls_general' => wp_json_encode( array( 
				'#customize-control-shop_product_card_layout',
				'#customize-control-shop_product_add_to_cart_layout',
				'#customize-control-out_of_stock_text',
				'#customize-control-shop_product_equal_height',
				'#customize-control-shop_product_quickview_layout',
				'#customize-control-shop_card_elements',
				'#customize-control-shop_product_alignment',
				'#customize-control-shop_product_element_spacing',
			) ),
			'controls_design'  => wp_json_encode( array( 
				'#customize-control-shop_product_card_style',
				'#customize-control-shop_product_card_radius',
				'#customize-control-shop_product_card_thumb_radius',
				'#customize-control-shop_product_card_background',
				'#customize-control-shop_product_card_border_size',
				'#customize-control-shop_product_card_border_color',
				'#customize-control-shop_product_title_title',
				'#customize-control-shop_product_title_font_style',
				'#customize-control-shop_product_title_adobe_font',
				'#customize-control-shop_product_title_font',
				'#customize-control-shop_product_title_size',
		        '#customize-control-shop_product_title_text_style',
				'#customize-control-shop_product_product',
				'#customize-control-shop_product_add_to_cart_button_title',
				'#customize-control-shop_product_add_to_cart_button_width',
			) ),
			'priority'         =>   -10,
		)
	)
);

// Product Card Settings
require 'shop-archive/section-product-card.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Sale Tag Section
 * 
 */

// Section
$wp_customize->add_section(
    'botiga_section_shop_archive_sale_tag',
    array(
        'panel'       => 'botiga_panel_shop_archive',
        'title'       => esc_html__( 'Sale Tag', 'botiga' ),
		'description' => esc_html__( 'Manage the overall design and functionality from the shop archive products sale tag.', 'botiga' ),
    )
);

// Sale Tag Tabs (control)
$wp_customize->add_setting(
	'botiga_shop_archive_sale_tag_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_shop_archive_sale_tag_tabs',
		array(
			'label'            => '',
			'section'          => 'botiga_section_shop_archive_sale_tag',
			'controls_general' => wp_json_encode( array( 
				'#customize-control-accordion_shop_sale_tag',
				'#customize-control-shop_product_sale_tag_layout',
				'#customize-control-shop_sale_tag_spacing',
				'#customize-control-shop_sale_tag_radius',
				'#customize-control-sale_badge_text',
				'#customize-control-sale_badge_percent',
				'#customize-control-sale_percentage_text',
			) ),
			'controls_design'  => wp_json_encode( array( 
				'#customize-control-single_product_sale_background_color',
				'#customize-control-single_product_sale_color',
			) ),
			'priority'         =>   -10,
		)
	)
);

// Sale Tag Settings
require 'shop-archive/section-sale-tag.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Categories Section
 * 
 */

// Section
$wp_customize->add_section(
    'botiga_section_shop_archive_categories',
    array(
        'panel'       => 'botiga_panel_shop_archive',
        'title'       => esc_html__( 'Categories', 'botiga' ),
		'description' => esc_html__( 'Manage the overall design and functionality from the shop archive products categories.', 'botiga' ),
    )
);

// Categories Tabs (control)
$wp_customize->add_setting(
	'botiga_shop_archive_categories_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_shop_archive_categories_tabs',
		array(
			'label'            => '',
			'section'          => 'botiga_section_shop_archive_categories',
			'controls_general' => wp_json_encode( array( 
				'#customize-control-shop_categories_layout',
				'#customize-control-shop_categories_alignment',
			) ),
			'controls_design'  => wp_json_encode( array( 
				'#customize-control-shop_categories_radius',
			) ),
			'priority'         =>   -10,
		)
	)
);

// Categories Settings
require 'shop-archive/section-categories.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound