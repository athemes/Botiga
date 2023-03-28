<?php
/**
 * Woocommerce Customizer options
 *
 * @package Botiga
 */

 //General
$wp_customize->add_section(
	'botiga_section_catalog_general',
	array(
		'title'    => esc_html__( 'General', 'botiga'),
		'priority' => 95,
	)
); 
$wp_customize->get_control( 'woocommerce_shop_page_display' )->section  = 'botiga_section_catalog_general';
$wp_customize->get_control( 'woocommerce_category_archive_display' )->section  = 'botiga_section_catalog_general';
$wp_customize->get_control( 'woocommerce_default_catalog_orderby' )->section  = 'botiga_section_catalog_general';

$wp_customize->add_setting(
	'botiga_product_catalog_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_product_catalog_tabs',
		array(
			'label'            => '',
			'section'          => 'woocommerce_product_catalog',
			'controls_general' => json_encode( array( 
				'#customize-control-shop_breadcrumbs',
				'#customize-control-woocommerce_catalog_rows',
				'#customize-control-woocommerce_catalog_columns',
				'#customize-control-shop_woocommerce_catalog_columns_desktop',
				'#customize-control-shop_woocommerce_catalog_rows',
				'#customize-control-accordion_shop_layout',
				'#customize-control-shop_archive_layout',
				'#customize-control-shop_archive_sidebar',
				'#customize-control-shop_archive_divider_1',
				'#customize-control-shop_page_elements_title',
				'#customize-control-shop_page_title',
				'#customize-control-shop_page_description',
				'#customize-control-shop_product_sorting',
				'#customize-control-shop_results_count',
				'#customize-control-accordion_shop_product_card',
				'#customize-control-shop_product_card_layout',
				'#customize-control-shop_product_add_to_cart_layout',
				'#customize-control-out_of_stock_text',
				'#customize-control-shop_product_equal_height',
				'#customize-control-shop_product_quickview_layout',
				'#customize-control-shop_card_elements',
				'#customize-control-shop_product_alignment',
				'#customize-control-shop_product_element_spacing',
				'#customize-control-accordion_shop_sale_tag',
				'#customize-control-shop_product_sale_tag_layout',
				'#customize-control-shop_sale_tag_spacing',
				'#customize-control-shop_sale_tag_radius',
				'#customize-control-sale_badge_text',
				'#customize-control-sale_badge_percent',
				'#customize-control-sale_percentage_text',
				'#customize-control-accordion_shop_categories',
				'#customize-control-shop_categories_layout',
				'#customize-control-shop_categories_alignment',
				'#customize-control-shop_categories_radius',
				'#customize-control-shop_cart_layout',
				'#customize-control-shop_checkout_layout',
			) ),
			'controls_design'  => json_encode( array( 
				'#customize-control-accordion_shop_styling_card',
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
				'#customize-control-accordion_shop_styling_sale',
				'#customize-control-single_product_sale_background_color',
				'#customize-control-single_product_sale_color',
			) ),
			'priority'         =>	-10
		)
	)
);

//Layout
$wp_customize->add_setting( 'accordion_shop_layout', 
	array(
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
    new Botiga_Accordion_Control(
        $wp_customize,
        'accordion_shop_layout',
        array(
            'label'         => esc_html__( 'Layout', 'botiga' ),
            'section'       => 'woocommerce_product_catalog',
            'until'         => 'shop_breadcrumbs',
			'priority' =>	-1

        )
    )
);

$wp_customize->add_setting( 
	'shop_woocommerce_catalog_columns_desktop', 
	array(
		'default'   		=> 4,
		'sanitize_callback' => 'absint'
	) 
);
$wp_customize->add_setting( 
	'shop_woocommerce_catalog_columns_tablet', 
	array(
		'default'   		=> 3,
		'sanitize_callback' => 'absint'
	) 
);
$wp_customize->add_setting( 
	'shop_woocommerce_catalog_columns_mobile', 
	array(
		'default'   		=> 1,
		'sanitize_callback' => 'absint'
	) 
);			
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_woocommerce_catalog_columns_desktop',
		array(
			'label' 		=> esc_html__( 'Products Per Row', 'botiga' ),
			'section' 		=> 'woocommerce_product_catalog',
			'is_responsive'	=> 1,
			'settings' 		=> array (
				'size_desktop' 		=> 'shop_woocommerce_catalog_columns_desktop',
				'size_tablet' 		=> 'shop_woocommerce_catalog_columns_tablet',
				'size_mobile' 		=> 'shop_woocommerce_catalog_columns_mobile'
			),
			'input_attrs' => array (
				'min'	=> 1,
				'max'	=> 6,
				'step'  => 1,
				'unit'  => '',
			),
			'priority'      => 1
		)
	) 
);

$wp_customize->add_setting( 
	'shop_woocommerce_catalog_rows', 
	array(
		'default'   		=> 4,
		'sanitize_callback' => 'absint'
	) 
);
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_woocommerce_catalog_rows',
		array(
			'label' 		=> esc_html__( 'Rows Per Page', 'botiga' ),
			'section' 		=> 'woocommerce_product_catalog',
			'is_responsive'	=> 0,
			'settings' 		=> array (
				'size_desktop' 		=> 'shop_woocommerce_catalog_rows'
			),
			'input_attrs' => array (
				'min'	=> 1,
				'max'	=> apply_filters( 'botiga_shop_woocommerce_catalog_rows_max', 20 ),
				'step'  => 1,
				'unit'  => '',
			),
			'priority'      => 1
		)
	) 
);

$wp_customize->add_setting( 'shop_archive_layout',
	array(
		'default' 			=> 'product-grid',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'shop_archive_layout',
	array(
		'label' 	=> esc_html__( 'Layout type', 'botiga' ),
		'section' 	=> 'woocommerce_product_catalog',
		'choices' 	=> array(
			'product-grid' 		=> esc_html__( 'Grid', 'botiga' ),
			'product-list' 		=> esc_html__( 'List', 'botiga' ),
		),
		'priority'	 => 20
	)
) );

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
			'cols' 		=> 2,
			'choices'  => array(
				'no-sidebar'   => array(
					'label' => esc_html__( 'No Sidebar', 'botiga' ),
					'url'   => '%s/assets/img/sidebar-disabled.svg'
				),
				'sidebar-left' => array(
					'label' => esc_html__( 'Left', 'botiga' ),
					'url'   => '%s/assets/img/sidebar-left.svg'
				),
				'sidebar-right' => array(
					'label' => esc_html__( 'Right', 'botiga' ),
					'url'   => '%s/assets/img/sidebar-right.svg'
				),	
			),
			'priority'	 => 30
		)
	)
);

$wp_customize->add_setting( 'shop_archive_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'shop_archive_divider_1',
		array(
			'section' 			=> 'woocommerce_product_catalog',
			'priority'	 		=> 40
		)
	)
);

//Page elements
$wp_customize->add_setting( 'shop_page_elements_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'shop_page_elements_title',
		array(
			'label'			=> esc_html__( 'Page elements', 'botiga' ),
			'section' 		=> 'woocommerce_product_catalog',
			'priority'	 	=> 50
		)
	)
);

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
			'label'         	=> esc_html__( 'Page title', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 60
		)
	)
);

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
			'label'         	=> esc_html__( 'Page Description', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 60
		)
	)
);

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
			'label'         	=> esc_html__( 'Product sorting', 'botiga' ),
			'description'       => esc_html__( 'Show options for sorting products.', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 70
		)
	)
);

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
			'label'         	=> esc_html__( 'Results count', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 80
		)
	)
);

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
			'label'         	=> esc_html__( 'Display breadcrumbs', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 90
		)
	)
);

//Product card
$wp_customize->add_setting( 'accordion_shop_product_card', 
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
    new Botiga_Accordion_Control(
        $wp_customize,
        'accordion_shop_product_card',
        array(
            'label'         => esc_html__( 'Product card', 'botiga' ),
            'section'       => 'woocommerce_product_catalog',
            'until'         => 'shop_product_element_spacing',
			'priority'	 	=> 100
        )
    )
);
$wp_customize->add_setting(
	'shop_product_card_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_product_card_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'woocommerce_product_catalog',
			'cols'		=> 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/pc1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/pc2.svg'
				),		
			),
			'priority'	 => 110
		)
	)
); 

$wp_customize->add_setting(
	'shop_product_add_to_cart_layout',
	array(
		'default'           => 'layout3',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_product_add_to_cart_layout',
		array(
			'label'    	=> esc_html__( 'Add to cart button', 'botiga' ),
			'section'  	=> 'woocommerce_product_catalog',
			'cols'		=> 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/ac1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/ac2.svg'
				),	
				'layout3' => array(
					'label' => esc_html__( 'Layout 3', 'botiga' ),
					'url'   => '%s/assets/img/ac3.svg'
				),	
				'layout4' => array(
					'label' => esc_html__( 'Layout 4', 'botiga' ),
					'url'   => '%s/assets/img/ac4.svg'
				),										
			),
			'priority'	 => 120
		)
	)
);

$wp_customize->add_setting(
	'out_of_stock_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => '',
	)       
);
$wp_customize->add_control( 'out_of_stock_text', array(
	'label'       => esc_html__( 'Out of Stock Text', 'botiga' ),
	'description' => esc_html__( 'Controls the add to cart button text when product is out of stock. Default: "Read More"', 'botiga' ),
	'type'        => 'text',
	'section'     => 'woocommerce_product_catalog',
	'priority'	  => 120
) );

// Product Equal Height
$wp_customize->add_setting(
    'shop_product_equal_height',
    array(
        'default'           => 0,
        'sanitize_callback' => 'botiga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Botiga_Toggle_Control(
        $wp_customize,
        'shop_product_equal_height',
        array(
            'label'    => esc_html__( 'Product Equal Height', 'botiga' ),
            'section'  => 'woocommerce_product_catalog',
            'priority' => 120
        )
    )
);

$wp_customize->add_setting(
	'shop_product_quickview_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_product_quickview_layout',
		array(
			'label'    	=> esc_html__( 'Quick view', 'botiga' ),
			'section'  	=> 'woocommerce_product_catalog',
			'cols'		=> 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/qw1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/qw2.svg'
				),	
				'layout3' => array(
					'label' => esc_html__( 'Layout 3', 'botiga' ),
					'url'   => '%s/assets/img/qw3.svg'
				),										
			),
			'priority'	 => 130
		)
	)
);

$wp_customize->add_setting( 'shop_card_elements', array(
	'default'  	=> array( 'botiga_shop_loop_product_title', 'woocommerce_template_loop_price' ),
	'sanitize_callback'	=> 'botiga_sanitize_product_loop_components'
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'shop_card_elements', array(
	'label'   			=> esc_html__( 'Card elements', 'botiga' ),
	'section' 			=> 'woocommerce_product_catalog',
	'choices' 			=> apply_filters( 'botiga_shop_archive_product_card_elements', array(
		'botiga_shop_loop_product_title'         	=> esc_html__( 'Title', 'botiga' ),
		'woocommerce_template_loop_rating' 			=> esc_html__( 'Reviews', 'botiga' ),
		'woocommerce_template_loop_price' 			=> esc_html__( 'Price', 'botiga' ),
		'botiga_loop_product_category' 				=> esc_html__( 'Category', 'botiga' ),
		'botiga_loop_product_description' 			=> esc_html__( 'Short description', 'botiga' ),
	) ),
	'priority'	 => 140
) ) );

$wp_customize->add_setting( 'shop_product_alignment',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'shop_product_alignment',
	array(
		'label'   => esc_html__( 'Text alignment', 'botiga' ),
		'section' => 'woocommerce_product_catalog',
		'choices' => array(
			'left' 		=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
			'center' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
			'right' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>',
		),
		'priority'	 => 150
	)
) );

$wp_customize->add_setting( 'shop_product_element_spacing', array(
	'default'   		=> 12,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_product_element_spacing',
	array(
		'label' 		=> esc_html__( 'Elements spacing', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_product_element_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'	 => 160
	)
) );

//Sale tag
$wp_customize->add_setting( 'accordion_shop_sale_tag', 
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
    new Botiga_Accordion_Control(
        $wp_customize,
        'accordion_shop_sale_tag',
        array(
            'label'         => esc_html__( 'Sale tag', 'botiga' ),
            'section'       => 'woocommerce_product_catalog',
            'until'         => 'sale_percentage_text',
			'priority'	 	=> 170
        )
    )
);
$wp_customize->add_setting(
	'shop_product_sale_tag_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_product_sale_tag_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'woocommerce_product_catalog',
			'cols'		=> 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/sale1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/sale2.svg'
				),											
			),
			'priority'	 => 180
		)
	)
);

$wp_customize->add_setting( 'shop_sale_tag_spacing', array(
	'default'   		=> 20,
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_sale_tag_spacing',
	array(
		'label' 		=> esc_html__( 'Spacing', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_sale_tag_spacing',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'	 => 190
	)
) );

$wp_customize->add_setting( 'shop_sale_tag_radius', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_sale_tag_radius',
	array(
		'label' 		=> esc_html__( 'Border radius', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_sale_tag_radius',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'	 => 200
	)
) );

$wp_customize->add_setting(
	'sale_badge_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => esc_html__( 'Sale!', 'botiga' ),
	)       
);
$wp_customize->add_control( 'sale_badge_text', array(
	'label'       => esc_html__( 'Badge text', 'botiga' ),
	'type'        => 'text',
	'section'     => 'woocommerce_product_catalog',
	'priority'	  => 210
) );

$wp_customize->add_setting(
	'sale_badge_percent',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'sale_badge_percent',
		array(
			'label'         	=> esc_html__( 'Display sale percentage', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 220
		)
	)
);

$wp_customize->add_setting(
	'sale_percentage_text',
	array(
		'sanitize_callback' => 'botiga_sanitize_text',
		'default'           => '-{value}%',
	)       
);
$wp_customize->add_control( 'sale_percentage_text', array(
	'label'       		=> esc_html__( 'Sale percentage text', 'botiga' ),
	'description' 		=> wp_kses_post( __( 'You may use the {value} tag. E.g. <strong>{value}% OFF!</strong>', 'botiga' ) ),
	'type'        		=> 'text',
	'section'     		=> 'woocommerce_product_catalog',
	'active_callback'	=> 'botiga_callback_sale_percentage',
	'priority'	 		=> 230
) );

//Categories
$wp_customize->add_setting( 'accordion_shop_categories', 
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
    new Botiga_Accordion_Control(
        $wp_customize,
        'accordion_shop_categories',
        array(
            'label'         => esc_html__( 'Categories', 'botiga' ),
            'section'       => 'woocommerce_product_catalog',
            'until'         => 'shop_categories_radius',
			'priority'	 	=> 240
        )
    )
);
$wp_customize->add_setting(
	'shop_categories_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_categories_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'woocommerce_product_catalog',
			'cols'		=> 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/pcat1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/pcat2.svg'
				),		
				'layout3' => array(
					'label' => esc_html__( 'Layout 3', 'botiga' ),
					'url'   => '%s/assets/img/pcat3.svg'
				),			
				'layout4' => array(
					'label' => esc_html__( 'Layout 4', 'botiga' ),
					'url'   => '%s/assets/img/pcat4.svg'
				),					
				'layout5' => array(
					'label' => esc_html__( 'Layout 5', 'botiga' ),
					'url'   => '%s/assets/img/pcat5.svg'
				),					
			),
			'priority'	 => 250
		)
	)
);

$wp_customize->add_setting( 'shop_categories_alignment',
	array(
		'default' 			=> 'center',
		'sanitize_callback' => 'botiga_sanitize_text'
	)
);
$wp_customize->add_control( new Botiga_Radio_Buttons( $wp_customize, 'shop_categories_alignment',
	array(
		'label'   => esc_html__( 'Text alignment', 'botiga' ),
		'section' => 'woocommerce_product_catalog',
		'choices' => array(
			'left' 		=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
			'center' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
			'right' 	=> '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>',
		),
		'priority'	 => 260
	)
) );

$wp_customize->add_setting( 'shop_categories_radius', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_categories_radius',
	array(
		'label' 		=> esc_html__( 'Border radius', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_categories_radius',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'	 => 270
	)
) );

//Cart 
$wp_customize->add_section(
	'botiga_section_shop_cart',
	array(
		'title'    => esc_html__( 'Cart', 'botiga'),
		'priority' => 120
	)
);

$wp_customize->add_setting(
	'shop_cart_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_cart_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'botiga_section_shop_cart',
			'cols'		=> 2,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/cart1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/cart2.svg'
				),		
			),
			'priority'	 => 20
		)
	)
);

$wp_customize->add_setting(
	'shop_cart_show_cross_sell',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_cart_show_cross_sell',
		array(
			'label'         	=> esc_html__( 'Cross Sell', 'botiga' ),
			'section'       	=> 'botiga_section_shop_cart',
			'priority'	 		=> 40
		)
	)
);

$wp_customize->add_setting(
	'shop_cart_show_coupon_form',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_cart_show_coupon_form',
		array(
			'label'         	=> esc_html__( 'Display Coupon Form', 'botiga' ),
			'section'       	=> 'botiga_section_shop_cart',
			'priority'	 		=> 41
		)
	)
);

$wp_customize->add_setting( 'shop_cart_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'shop_cart_divider_1',
		array(
			'section' 			=> 'botiga_section_shop_cart',
			'priority'	 		=> 50
		)
	)
);

$wp_customize->add_setting( 'mini_cart_title',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'mini_cart_title',
		array(
			'label'			=> esc_html__( 'Mini Cart', 'botiga' ),
			'section' 		=> 'botiga_section_shop_cart',
			'priority'	 	=> 60
		)
	)
);

$wp_customize->add_setting(
	'enable_mini_cart_cross_sell',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'enable_mini_cart_cross_sell',
		array(
			'label'         	=> esc_html__( 'Mini Cart Cross Sell', 'botiga' ),
			'section'       	=> 'botiga_section_shop_cart',
			'active_callback' 	=> 'botiga_callback_header_show_minicart',
			'priority'			=> 70
		)
	)
);

//Checkout
$wp_customize->add_setting(
	'shop_checkout_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key'
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_checkout_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'botiga' ),
			'section'  	=> 'woocommerce_checkout',
			'cols'		=> 2,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/checkout1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/checkout2.svg'
				),		
			),
			'priority'	 => 20
		)
	)
); 
$wp_customize->add_setting(
	'shop_checkout_show_coupon_form',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox'
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'shop_checkout_show_coupon_form',
		array(
			'label'         	=> esc_html__( 'Display Coupon Form', 'botiga' ),
			'section'       	=> 'woocommerce_checkout',
			'priority'	 		=> 30
		)
	)
);

/**
 * Styling
 */
//Product card 
$wp_customize->add_setting( 'accordion_shop_styling_card', 
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
    new Botiga_Accordion_Control(
        $wp_customize,
        'accordion_shop_styling_card',
        array(
            'label'         => esc_html__( 'Product card', 'botiga' ),
            'section'       => 'woocommerce_product_catalog',
            'until'         => 'shop_product_product',
			'priority'	 	=> 280
        )
    )
);
$wp_customize->add_setting(
	'shop_product_card_style',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'shop_product_card_style',
		array(
			'label'    	=> esc_html__( 'Card Style', 'botiga' ),
			'section'  	=> 'woocommerce_product_catalog',
			'cols'		=> 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/card1.svg'
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/card2.svg'
				),
				'layout3' => array(
					'label' => esc_html__( 'Layout 3', 'botiga' ),
					'url'   => '%s/assets/img/card3.svg'
				),						
			),
			'priority'	 => 290
		)
	)
); 

$wp_customize->add_setting( 'shop_product_card_radius', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_product_card_radius',
	array(
		'label' 		=> esc_html__( 'Card radius', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_product_card_radius',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'	 => 300
	)
) );

$wp_customize->add_setting( 'shop_product_card_thumb_radius', array(
	'default'   		=> 0,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_product_card_thumb_radius',
	array(
		'label' 		=> esc_html__( 'Image radius', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_product_card_thumb_radius',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'	 => 310
	)
) );

$wp_customize->add_setting(
	'shop_product_card_background',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'shop_product_card_background',
		array(
			'label'         	=> esc_html__( 'Card background', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 320
		)
	)
);

$wp_customize->add_setting( 'shop_product_card_border_size', array(
	'default'   		=> 1,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_product_card_border_size',
	array(
		'label' 		=> esc_html__( 'Border size', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 0,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_product_card_border_size',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 100
		),
		'priority'	 => 350
	)
) );

$wp_customize->add_setting(
	'shop_product_card_border_color',
	array(
		'default'           => '#eee',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'shop_product_card_border_color',
		array(
			'label'         	=> esc_html__( 'Border color', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 360
		)
	)
);

$wp_customize->add_setting( 'shop_product_title_title',
  array(
    'default'           => '',
    'sanitize_callback' => 'esc_attr'
  )
);
$wp_customize->add_control( new Botiga_Text_Control( $wp_customize, 'shop_product_title_title',
    array(
      'label'    => esc_html__( 'Product Title', 'botiga' ),
      'section'  => 'woocommerce_product_catalog',
      'priority' => 365
    )
  )
);

// Typography
$wp_customize->add_setting( 
  'shop_product_title_font_style', 
  array(
    'default'           => 'heading',
    'sanitize_callback' => 'botiga_sanitize_select',
  ) 
);
$wp_customize->add_control( 
  'shop_product_title_font_style', 
  array(
    'type'      => 'select',
    'section'   => 'woocommerce_product_catalog',
    'label'     => esc_html__( 'Font Style', 'botiga' ),
    'choices'   => array(
      'heading' => esc_html__( 'Heading', 'botiga' ),
      'body'    => esc_html__( 'Body', 'botiga' ),
      'custom'  => esc_html__( 'Custom', 'botiga' ),
    ),
    'priority'  => 365,
  )
);

$wp_customize->add_setting( 'shop_product_title_adobe_font',
  array(
    'default'           => 'system-default|n4',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  )
);
$wp_customize->add_control( new Botiga_Typography_Adobe_Control( $wp_customize, 'shop_product_title_adobe_font',
  array(
    'section'         => 'woocommerce_product_catalog',
    'active_callback' => 'botiga_shop_product_title_font_library_adobe_and_custom_style',
    'priority'        => 365,
  )
) );

$wp_customize->add_setting( 'shop_product_title_custom_font',
  array(
    'default'           => '',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  )
);
$wp_customize->add_setting( 'shop_product_title_custom_font_weight',
  array(
    'default'           => '',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'sanitize_text_field',
  )
);
$wp_customize->add_control( new Botiga_Typography_Custom_Control( $wp_customize, 'shop_product_title_custom_font_typography',
  array(
    'section'         => 'woocommerce_product_catalog',
	'settings'        => array(
		'font-family' => 'shop_product_title_custom_font',
		'font-weight' => 'shop_product_title_custom_font_weight',
	),
    'active_callback' => 'botiga_shop_product_title_font_library_custom_and_custom_style',
    'priority'        => 365,
  )
) );

$wp_customize->add_setting( 'shop_product_title_font',
  array(
    'default'           => '{"font":"System default","regularweight":"400","category":"sans-serif"}',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'botiga_google_fonts_sanitize',
    'priority'          => 365,
  )
);
$wp_customize->add_control( new Botiga_Typography_Control( $wp_customize, 'shop_product_title_font',
  array(
    'section'  => 'woocommerce_product_catalog',
    'settings' => array (
      'family' => 'shop_product_title_font',
    ),
    'input_attrs' => array(
      'font_count'     => 'all',
      'orderby'        => 'alpha',
      'disableRegular' => false,
    ),
    'active_callback' => 'botiga_shop_product_title_font_library_google_and_custom_style',
    'priority'  => 365,
  )
) );

// Font Size
$wp_customize->add_setting( 'shop_product_title_size_desktop', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			
$wp_customize->add_setting( 'shop_product_title_size_tablet', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'shop_product_title_size_mobile', array(
	'default'   		=> 16,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			
$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'shop_product_title_size',
	array(
		'label' 		=> esc_html__( 'Font Size', 'botiga' ),
		'section' 		=> 'woocommerce_product_catalog',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'shop_product_title_size_desktop',
			'size_tablet' 		=> 'shop_product_title_size_tablet',
			'size_mobile' 		=> 'shop_product_title_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority'	 => 365
	)
) );

// Text Style
$wp_customize->add_setting( 'shop_product_title_text_decoration', array(
  'default'           => 'none',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'botiga_sanitize_text',
) );
$wp_customize->add_setting( 'shop_product_title_text_transform', array(
  'default'           => 'none',
  'transport'         => 'postMessage',
  'sanitize_callback' => 'botiga_sanitize_text',
) );
$wp_customize->add_control( new Botiga_Text_Style_Control( $wp_customize, 'shop_product_title_text_style',
  array(
    'section'  => 'woocommerce_product_catalog',
    'settings' => array(
      'decoration' => 'shop_product_title_text_decoration',
      'transform'  => 'shop_product_title_text_transform',
    ),
    'priority' => 365,
  )
) );

$wp_customize->add_setting(
	'shop_product_product_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'shop_product_product_title_hover',
	array(
		'default'           => '',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'shop_product_product',
        array(
            'label'    => esc_html__( 'Product Title Color', 'botiga' ),
            'section'  => 'woocommerce_product_catalog',
            'settings' => array(
                'normal' => 'shop_product_product_title',
                'hover'  => 'shop_product_product_title_hover',
            ),
            'priority' => 365
        )
    )
);

//Sale tag
$wp_customize->add_setting( 'accordion_shop_styling_sale', 
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
    new Botiga_Accordion_Control(
        $wp_customize,
        'accordion_shop_styling_sale',
        array(
            'label'         => esc_html__( 'Sale tag', 'botiga' ),
            'section'       => 'woocommerce_product_catalog',
            'until'         => 'single_product_sale_color',
			'priority'	 	=> 370
        )
    )
);
$wp_customize->add_setting(
	'single_product_sale_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'single_product_sale_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 380
		)
	)
);

$wp_customize->add_setting(
	'single_product_sale_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'single_product_sale_color',
		array(
			'label'         	=> esc_html__( 'Color', 'botiga' ),
			'section'       	=> 'woocommerce_product_catalog',
			'priority'	 		=> 390
		)
	)
);

/**
 * Search
 */
$wp_customize->add_section(
	'botiga_section_shop_search',
	array(
		'title'    => esc_html__( 'Search', 'botiga'),
		'priority' => 125
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
			'label'         	=> esc_html__( 'Enable AJAX On Search Fields', 'botiga' ),
			'description'       => esc_html__( 'Allow your customers to search and get results in real time without loading other pages.', 'botiga' ),
			'section'       	=> 'botiga_section_shop_search',
			'priority'	 		=> 10
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
			'label'         	=> esc_html__( 'Enable search by SKU', 'botiga' ),
			'description'       => esc_html__( 'Return search results based on either product name or SKU.', 'botiga' ),
			'section'       	=> 'botiga_section_shop_search',
			'priority'	 		=> 11
		)
	)
);

$wp_customize->add_setting( 
	'shop_search_ajax_posts_per_page', 
	array(
		'default'   		=> 15,
		'sanitize_callback' => 'absint',
	) 
);			
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_search_ajax_posts_per_page',
		array(
			'label' 		=> esc_html__( 'Results Amount per Search', 'botiga' ),
			'description'	=> esc_html__( 'Control the maximum amount of products to show in the search results.', 'botiga' ),
			'section' 		=> 'botiga_section_shop_search',
			'active_callback' => 'botiga_shop_search_ajax_is_enabled',
			'is_responsive'	=> 0,
			'settings' 		=> array (
				'size_desktop' 		=> 'shop_search_ajax_posts_per_page',
			),
			'input_attrs' => array (
				'min'	=> 1,
				'max'	=> 100,
				'unit'  => '',
			),
			'priority'	 => 20
		)
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_desc_content', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default' 			=> 'product-post-content'
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_desc_content', 
	array(
		'type' 		  => 'select',
		'section' 	  => 'botiga_section_shop_search',
		'label' 	  => esc_html__( 'Results Description', 'botiga' ),
		'description' => esc_html__( 'Save/publish the changes is required to see this option working in the customizer preview.', 'botiga' ),
		'choices' 	  => array(
			'product-post-content' 		=> esc_html__( 'Product Description', 'botiga' ),
			'product-short-description' => esc_html__( 'Product Short Description', 'botiga' )
		),
		'active_callback' => 'botiga_shop_search_ajax_is_enabled',
		'priority'	 => 30
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_desc_excerpt_length', 
	array(
		'default'   		=> 10,
		'sanitize_callback' => 'absint',
	) 
);			
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_search_ajax_desc_excerpt_length',
		array(
			'label' 		=> esc_html__( 'Results Description Length', 'botiga' ),
			'description'	=> esc_html__( 'The number of words to show in the results description. Save/publish the changes is required to see this option working in the customizer preview.', 'botiga' ),
			'section' 		=> 'botiga_section_shop_search',
			'active_callback' => 'botiga_shop_search_ajax_is_enabled',
			'is_responsive'	=> 0,
			'settings' 		=> array (
				'size_desktop' 		=> 'shop_search_ajax_desc_excerpt_length',
			),
			'input_attrs' => array (
				'min'	=> 1,
				'max'	=> 100,
				'unit'  => '',
			),
			'priority'	 => 30
		)
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_orderby', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default' 			=> 'title'
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_orderby', 
	array(
		'type' 		=> 'select',
		'section' 	=> 'botiga_section_shop_search',
		'label' 	=> esc_html__( 'Results Order By', 'botiga' ),
		'choices' => array(
			'none' 		=> esc_html__( 'None', 'botiga' ),
			'title'		=> esc_html__( 'Product Name', 'botiga' ),
			'date'		=> esc_html__( 'Published Date', 'botiga' ),
			'modified'  => esc_html__( 'Modified Date', 'botiga' ),
			'rand'		=> esc_html__( 'Random', 'botiga' ),
			'price'		=> esc_html__( 'Product Price', 'botiga' )
		),
		'active_callback' => 'botiga_shop_search_ajax_is_enabled',
		'priority'	 => 30
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_order', 
	array(
		'sanitize_callback' => 'botiga_sanitize_select',
		'default' 			=> 'asc'
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_order', 
	array(
		'type' 		=> 'select',
		'section' 	=> 'botiga_section_shop_search',
		'label' 	=> esc_html__( 'Results Order', 'botiga' ),
		'choices' => array(
			'asc' 	=> esc_html__( 'Ascendant', 'botiga' ),
			'desc' 	=> esc_html__( 'Descendant', 'botiga' )
		),
		'active_callback' => 'botiga_shop_search_ajax_is_enabled',
		'priority'	 => 40
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
			'label'         	=> esc_html__( 'Display Categories', 'botiga' ),
			'description'       => esc_html__( 'Display product categories in the results if the searched term matches with category name.', 'botiga' ),
			'section'       	=> 'botiga_section_shop_search',
			'active_callback'   => 'botiga_shop_search_ajax_is_enabled',
			'priority'	 		=> 50
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
			'priority'    => 55
		)
	)
);

/**
 * Store Notice
 */

// Store notice tabs
$wp_customize->add_setting(
	'shop_store_notice_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'shop_store_notice_tabs',
		array(
			'label'            => '',
			'section'          => 'woocommerce_store_notice',
			'controls_general' => json_encode( array( 
				'#customize-control-woocommerce_demo_store_notice',
				'#customize-control-woocommerce_demo_store'
			) ),
			'controls_design'  => json_encode( array( 
				'#customize-control-shop_store_notice_background_color',
				'#customize-control-shop_store_notice_text_color',
				'#customize-control-shop_store_notice_link_color',
				'#customize-control-shop_store_notice_wrapper_padding'
			) ),
			'priority'         =>	-10
		)
	)
);

// Store notice background color
$wp_customize->add_setting(
	'shop_store_notice_background_color',
	array(
		'default'           => '#3d9cd2',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'shop_store_notice_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'botiga' ),
			'section'       	=> 'woocommerce_store_notice',
			'priority'	 		=> 50
		)
	)
);

// Store notice text color
$wp_customize->add_setting(
	'shop_store_notice_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'shop_store_notice_text_color',
		array(
			'label'         	=> esc_html__( 'Text color', 'botiga' ),
			'section'       	=> 'woocommerce_store_notice',
			'priority'	 		=> 52
		)
	)
);

// Store notice link color
$wp_customize->add_setting(
	'shop_store_notice_link_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'shop_store_notice_link_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Botiga_Color_Group(
        $wp_customize,
        'shop_store_notice_link_color',
        array(
            'label'    => esc_html__( 'Link Color', 'botiga' ),
            'section'  => 'woocommerce_store_notice',
            'settings' => array(
                'normal' => 'shop_store_notice_link_color',
                'hover'  => 'shop_store_notice_link_color_hover',
            ),
            'priority' => 54
        )
    )
);

// Store notice padding
$wp_customize->add_setting( 
    'shop_store_notice_wrapper_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'shop_store_notice_wrapper_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'shop_store_notice_wrapper_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'botiga_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Botiga_Dimensions_Control( 
        $wp_customize, 
        'shop_store_notice_wrapper_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'botiga' ),
            'section'         	=> 'woocommerce_store_notice',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'shop_store_notice_wrapper_padding_desktop',
                'tablet'  => 'shop_store_notice_wrapper_padding_tablet',
                'mobile'  => 'shop_store_notice_wrapper_padding_mobile'
            ),
            'priority'	      	 => 56
        )
    )
);