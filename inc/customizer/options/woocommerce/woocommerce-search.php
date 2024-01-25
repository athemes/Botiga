<?php
/**
 * Woocommerce Search Customizer options
 *
 * @package Botiga
 */

/**
 * Search
 */
$wp_customize->add_section(
	'botiga_section_shop_search',
	array(
		'title'       => esc_html__( 'Search', 'botiga'),
		'description' => esc_html__( 'Manage the overall design and functionality from the shop search page.', 'botiga' ),
		'priority'    => 125,
	)
);

$wp_customize->add_setting(
	'shop_search_enable_ajax',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_search_enable_ajax',
		array(
			'label'             => esc_html__( 'Enable AJAX On Search Fields', 'botiga' ),
			'description'       => esc_html__( 'Allow your customers to search and get results in real time without loading other pages.', 'botiga' ),
			'section'           => 'botiga_section_shop_search',
			'priority'          => 10,
		)
	)
);

$wp_customize->add_setting(
	'shop_search_ajax_enable_search_by_sku',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_search_ajax_enable_search_by_sku',
		array(
			'label'             => esc_html__( 'Enable search by SKU', 'botiga' ),
			'description'       => esc_html__( 'Return search results based on either product name or SKU.', 'botiga' ),
			'section'           => 'botiga_section_shop_search',
			'priority'          => 11,
		)
	)
);

$wp_customize->add_setting( 
	'shop_search_ajax_posts_per_page', 
	array(
		'default'           => 15,
		'sanitize_callback' => 'absint',
	) 
);          
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_search_ajax_posts_per_page',
		array(
			'label'         => esc_html__( 'Results Amount per Search', 'botiga' ),
			'description'   => esc_html__( 'Control the maximum amount of products to show in the search results.', 'botiga' ),
			'section'       => 'botiga_section_shop_search',
			'active_callback' => 'botiga_shop_search_ajax_is_enabled',
			'is_responsive' => 0,
			'settings'      => array(
				'size_desktop'      => 'shop_search_ajax_posts_per_page',
			),
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 100,
				'unit'  => '',
			),
			'priority'   => 20,
		)
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_desc_content', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default'           => 'product-post-content',
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_desc_content', 
	array(
		'type'        => 'select',
		'section'     => 'botiga_section_shop_search',
		'label'       => esc_html__( 'Results Description', 'botiga' ),
		'description' => esc_html__( 'Save/publish the changes is required to see this option working in the customizer preview.', 'botiga' ),
		'choices'     => array(
			'product-post-content'      => esc_html__( 'Product Description', 'botiga' ),
			'product-short-description' => esc_html__( 'Product Short Description', 'botiga' ),
		),
		'active_callback' => 'botiga_shop_search_ajax_is_enabled',
		'priority'   => 30,
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_desc_excerpt_length', 
	array(
		'default'           => 10,
		'sanitize_callback' => 'absint',
	) 
);          
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_search_ajax_desc_excerpt_length',
		array(
			'label'         => esc_html__( 'Results Description Length', 'botiga' ),
			'description'   => esc_html__( 'The number of words to show in the results description. Save/publish the changes is required to see this option working in the customizer preview.', 'botiga' ),
			'section'       => 'botiga_section_shop_search',
			'active_callback' => 'botiga_shop_search_ajax_is_enabled',
			'is_responsive' => 0,
			'settings'      => array(
				'size_desktop'      => 'shop_search_ajax_desc_excerpt_length',
			),
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 100,
				'unit'  => '',
			),
			'priority'   => 30,
		)
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_orderby', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default'           => 'title',
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_orderby', 
	array(
		'type'      => 'select',
		'section'   => 'botiga_section_shop_search',
		'label'     => esc_html__( 'Results Order By', 'botiga' ),
		'choices' => array(
			'none'      => esc_html__( 'None', 'botiga' ),
			'title'     => esc_html__( 'Product Name', 'botiga' ),
			'date'      => esc_html__( 'Published Date', 'botiga' ),
			'modified'  => esc_html__( 'Modified Date', 'botiga' ),
			'rand'      => esc_html__( 'Random', 'botiga' ),
			'price'     => esc_html__( 'Product Price', 'botiga' ),
		),
		'active_callback' => 'botiga_shop_search_ajax_is_enabled',
		'priority'   => 30,
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_order', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default'           => 'asc',
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_order', 
	array(
		'type'      => 'select',
		'section'   => 'botiga_section_shop_search',
		'label'     => esc_html__( 'Results Order', 'botiga' ),
		'choices' => array(
			'asc'   => esc_html__( 'Ascendant', 'botiga' ),
			'desc'  => esc_html__( 'Descendant', 'botiga' ),
		),
		'active_callback' => 'botiga_shop_search_ajax_is_enabled',
		'priority'   => 40,
	) 
);

$wp_customize->add_setting(
	'shop_search_ajax_show_categories',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_search_ajax_show_categories',
		array(
			'label'             => esc_html__( 'Display Categories', 'botiga' ),
			'description'       => esc_html__( 'Display product categories in the results if the searched term matches with category name.', 'botiga' ),
			'section'           => 'botiga_section_shop_search',
			'active_callback'   => 'botiga_shop_search_ajax_is_enabled',
			'priority'          => 50,
		)
	)
);

$wp_customize->add_setting(
	'shop_search_ajax_display_see_all',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_search_ajax_display_see_all',
		array(
			'label'             => esc_html__( 'Display See All Products Link', 'botiga' ),
			'section'           => 'botiga_section_shop_search',
			'active_callback'   => 'botiga_shop_search_ajax_is_enabled',
			'priority'          => 51,
		)
	)
);

$wp_customize->add_setting(
	'shop_search_enable_popular_products',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_search_enable_popular_products',
		array(
			'label'       => esc_html__( 'Enable Popular Products', 'botiga' ),
			'description' => esc_html__( 'Show popular products if no products found in search results page.', 'botiga' ),
			'section'     => 'botiga_section_shop_search',
			'priority'    => 55,
		)
	)
);