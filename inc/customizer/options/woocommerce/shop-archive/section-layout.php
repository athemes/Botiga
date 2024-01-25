<?php
/**
 * Shop Archive - Section Layout Customizer Settings
 *
 * @package Botiga
 */

// Products Per Row
$wp_customize->add_setting( 
	'shop_woocommerce_catalog_columns_desktop', 
	array(
		'default'           => 4,
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_setting( 
	'shop_woocommerce_catalog_columns_tablet', 
	array(
		'default'           => 3,
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_setting( 
	'shop_woocommerce_catalog_columns_mobile', 
	array(
		'default'           => 1,
		'sanitize_callback' => 'absint',
	) 
);          
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_woocommerce_catalog_columns_desktop',
		array(
			'label'         => esc_html__( 'Products Per Row', 'botiga' ),
			'section'       => 'woocommerce_product_catalog',
			'is_responsive' => 1,
			'settings'      => array(
				'size_desktop'      => 'shop_woocommerce_catalog_columns_desktop',
				'size_tablet'       => 'shop_woocommerce_catalog_columns_tablet',
				'size_mobile'       => 'shop_woocommerce_catalog_columns_mobile',
			),
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 6,
				'step'  => 1,
				'unit'  => '',
			),
			'priority'      => 1,
		)
	) 
);

// Rows Per Page
$wp_customize->add_setting( 
	'shop_woocommerce_catalog_rows', 
	array(
		'default'           => 4,
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_woocommerce_catalog_rows',
		array(
			'label'         => esc_html__( 'Rows Per Page', 'botiga' ),
			'section'       => 'woocommerce_product_catalog',
			'is_responsive' => 0,
			'settings'      => array(
				'size_desktop'      => 'shop_woocommerce_catalog_rows',
			),
			'input_attrs' => array(
				'min'   => 1,

				/**
				 * Hook 'botiga_shop_woocommerce_catalog_rows_max'
				 *
				 * @since 1.0.0
				 */
				'max'   => apply_filters( 'botiga_shop_woocommerce_catalog_rows_max', 20 ),
				'step'  => 1,
				'unit'  => '',
			),
			'priority'      => 1,
		)
	) 
);

// Layout Type
$wp_customize->add_setting( 'shop_archive_layout',
	array(
		'default'           => 'product-grid',
		'sanitize_callback' => 'botiga_sanitize_text',
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'shop_archive_layout',
	array(
		'label'     => esc_html__( 'Layout Type', 'botiga' ),
		'section'   => 'woocommerce_product_catalog',
		'choices'   => array(
			'product-grid'      => esc_html__( 'Grid', 'botiga' ),
			'product-list'      => esc_html__( 'List', 'botiga' ),
		),
		'priority'   => 20,
	)
) );

// Shop Header Style
$wp_customize->add_setting(
    'shop_archive_header_style',
    array(
        'default'           => 'style1',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control(
    new Botiga_Radio_Images(
        $wp_customize,
        'shop_archive_header_style',
        array(
            'label'     => esc_html__( 'Shop Header Style', 'botiga' ),
            'section'   => 'woocommerce_product_catalog',
            'cols'      => 2,
            'choices'  => array(
                'style1' => array(
                    'label' => esc_html__( 'Style 1', 'botiga' ),
                    'url'   => '%s/assets/img/shop-page-header-style-1.svg',
                ),
                'style2' => array(
					'is_pro' => true,
                    'label'  => esc_html__( 'Style 2', 'botiga' ),
                    'url'    => '%s/assets/img/shop-page-header-style-2.svg',
                ),
                'style3' => array(
					'is_pro' => true,
                    'label'  => esc_html__( 'Style 3', 'botiga' ),
                    'url'    => '%s/assets/img/shop-page-header-style-3.svg',
                ),       
            ),
            'priority'   => 21,
        )
    )
);

// Sidebar Layout
$wp_customize->add_setting(
	'shop_archive_sidebar',
	array(
		'default'           => 'no-sidebar',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_archive_sidebar',
		array(
			'label'    => esc_html__( 'Sidebar Layout', 'botiga' ),
			'section'  => 'woocommerce_product_catalog',
			'cols'      => 2,
			'choices'  => array(
				'no-sidebar'   => array(
					'label' => esc_html__( 'No Sidebar', 'botiga' ),
					'url'   => '%s/assets/img/sidebar-disabled.svg',
				),
				'sidebar-left' => array(
					'label' => esc_html__( 'Left', 'botiga' ),
					'url'   => '%s/assets/img/sidebar-left.svg',
				),
				'sidebar-right' => array(
					'label' => esc_html__( 'Right', 'botiga' ),
					'url'   => '%s/assets/img/sidebar-right.svg',
				),
				'sidebar-top' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Top', 'botiga' ),
					'url'    => '%s/assets/img/sidebar-top.svg',
				),
				'sidebar-slide' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Slide-out', 'botiga' ),
					'url'    => '%s/assets/img/sidebar-slide.svg',
				),
			),
			'priority'   => 30,
		)
	)
);

// Divider
$wp_customize->add_setting( 'shop_archive_divider_1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'shop_archive_divider_1',
		array(
			'section'           => 'woocommerce_product_catalog',
			'priority'          => 40,
		)
	)
);

// Page elements
$wp_customize->add_setting( 'shop_page_elements_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'shop_page_elements_title',
		array(
			'label'         => esc_html__( 'Page elements', 'botiga' ),
			'section'       => 'woocommerce_product_catalog',
			'priority'      => 50,
		)
	)
);

// Shop Page Title
$wp_customize->add_setting(
	'shop_page_title',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_page_title',
		array(
			'label'             => esc_html__( 'Page title', 'botiga' ),
			'section'           => 'woocommerce_product_catalog',
			'priority'          => 60,
		)
	)
);

// Shop Page Description
$wp_customize->add_setting(
	'shop_page_description',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_page_description',
		array(
			'label'             => esc_html__( 'Page Description', 'botiga' ),
			'section'           => 'woocommerce_product_catalog',
			'priority'          => 60,
		)
	)
);

// Product Sorting
$wp_customize->add_setting(
	'shop_product_sorting',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_product_sorting',
		array(
			'label'             => esc_html__( 'Product Sorting', 'botiga' ),
			'description'       => esc_html__( 'Show options for sorting products.', 'botiga' ),
			'section'           => 'woocommerce_product_catalog',
			'priority'          => 70,
		)
	)
);

// Shop Results Count
$wp_customize->add_setting(
	'shop_results_count',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_results_count',
		array(
			'label'             => esc_html__( 'Results count', 'botiga' ),
			'section'           => 'woocommerce_product_catalog',
			'priority'          => 80,
		)
	)
);

// Shop Breadcrumbs
$wp_customize->add_setting(
	'shop_breadcrumbs',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_breadcrumbs',
		array(
			'label'             => esc_html__( 'Display breadcrumbs', 'botiga' ),
			'section'           => 'woocommerce_product_catalog',
			'priority'          => 90,
		)
	)
);