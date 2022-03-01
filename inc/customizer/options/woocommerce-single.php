<?php
/**
 * Woocommerce Customizer options
 *
 * @package Botiga
 */

/**
 * General
 */
$wp_customize->add_section(
	'botiga_section_single_product',
	array(
		'title'      => esc_html__( 'Single products', 'botiga'),
		'panel'      => 'woocommerce',
		'priority'	 => 8
	)
); 

$wp_customize->add_setting(
	'botiga_single_product_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Botiga_Tab_Control (
		$wp_customize,
		'botiga_single_product_tabs',
		array(
			'label' 				=> '',
			'section'       		=> 'botiga_section_single_product',
			'controls_general'		=> json_encode( array( '#customize-control-single_gallery_slider','#customize-control-single_product_gallery','#customize-control-single_zoom_effects','#customize-control-single_breadcrumbs','#customize-control-single_product_elements_order','#customize-control-single_product_tabs','#customize-control-single_upsell_products_top_divider','#customize-control-single_upsell_products','#customize-control-single_recently_viewed_top_divider','#customize-control-single_recently_viewed_products','#customize-control-single_recently_viewed_bottom_divider','#customize-control-single_related_products','#customize-control-single_product_sku','#customize-control-single_product_categories','#customize-control-single_product_tags' ) ),
			'controls_design'		=> json_encode( array( '#customize-control-single_product_title_color','#customize-control-single_product_title_size','#customize-control-single_product_styling_divider_1','#customize-control-single_product_price_color','#customize-control-single_product_price_size', ) ),
		)
	)
);

$wp_customize->add_setting(
	'single_product_gallery',
	array(
		'default'           => 'gallery-default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Botiga_Radio_Images(
		$wp_customize,
		'single_product_gallery',
		array(
			'label'    	=> esc_html__( 'Product Image', 'botiga' ),
			'section'  	=> 'botiga_section_single_product',
			'cols'		=> 3,
			'choices'  => array(
				'gallery-default' => array(
					'label' => esc_html__( 'Layout 1', 'botiga' ),
					'url'   => '%s/assets/img/sg1.svg'
				),
				'gallery-single' => array(
					'label' => esc_html__( 'Layout 2', 'botiga' ),
					'url'   => '%s/assets/img/sg2.svg'
				),	
				'gallery-vertical' => array(
					'label' => esc_html__( 'Layout 3', 'botiga' ),
					'url'   => '%s/assets/img/sg3.svg'
				),															
			),
			'priority'	 => 20
		)
	)
);

$wp_customize->add_setting(
	'single_gallery_slider',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_gallery_slider',
		array(
			'label'         	=> esc_html__( 'Gallery thumbnail slider', 'botiga' ),
			'description'       => esc_html__( 'Requires page refresh after saving', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 30
		)
	)
);

$wp_customize->add_setting(
	'single_zoom_effects',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_zoom_effects',
		array(
			'label'         	=> esc_html__( 'Image zoom effects', 'botiga' ),
			'description'       => esc_html__( 'Requires page refresh after saving', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 40
		)
	)
);

$wp_customize->add_setting(
	'single_breadcrumbs',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_breadcrumbs',
		array(
			'label'         	=> esc_html__( 'Breadcrumbs', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 50
		)
	)
);

$botiga_defaults = botiga_get_default_single_product_components();
$botiga_choices  = botiga_single_product_elements();

$wp_customize->add_setting( 
	'single_product_elements_order', 
	array(
		'default'  			=> $botiga_defaults,
		'sanitize_callback'	=> 'botiga_sanitize_single_product_components'
	) 
);

$wp_customize->add_control( new \Kirki\Control\Sortable( 
	$wp_customize, 
	'single_product_elements_order', 
	array(
		'label'   		=> esc_html__( 'Elements', 'botiga' ),
		'section' => 'botiga_section_single_product',
		'choices' => $botiga_choices,
		'active_callback' => 'botiga_single_product_elements_show',
		'priority'     => 51
	) ) 
);

$wp_customize->add_setting(
	'single_product_sku',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_product_sku',
		array(
			'label'         	=> esc_html__( 'SKU', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'active_callback'    => function() { return botiga_callback_single_product_elements( 'woocommerce_template_single_meta' ); },
			'priority'	 		=> 60
		)
	)
);

$wp_customize->add_setting(
	'single_product_categories',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_product_categories',
		array(
			'label'         	=> esc_html__( 'Categories', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'active_callback'   => function() { return botiga_callback_single_product_elements( 'woocommerce_template_single_meta' ); },
			'priority'	 		=> 70
		)
	)
);

$wp_customize->add_setting(
	'single_product_tags',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_product_tags',
		array(
			'label'         	=> esc_html__( 'Tags', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'active_callback'   => function() { return botiga_callback_single_product_elements( 'woocommerce_template_single_meta' ); },
			'priority'	 		=> 80
		)
	)
);

$wp_customize->add_setting(
	'single_product_tabs',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_product_tabs',
		array(
			'label'         	=> esc_html__( 'Product tabs', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 90
		)
	)
);

$wp_customize->add_setting( 
	'single_upsell_products_top_divider',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( 
	$wp_customize, 
	'single_upsell_products_top_divider',
		array(
			'section' 		=> 'botiga_section_single_product',
			'priority'	 	=> 100
		)
	)
);

$wp_customize->add_setting(
	'single_upsell_products',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_upsell_products',
		array(
			'label'         	=> esc_html__( 'Upsell products', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 101
		)
	)
);

$wp_customize->add_setting( 
	'single_recently_viewed_top_divider',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( 
	$wp_customize, 
	'single_recently_viewed_top_divider',
		array(
			'section' 		=> 'botiga_section_single_product',
			'priority'	 	=> 103
		)
	)
);

$wp_customize->add_setting(
	'single_recently_viewed_products',
	array(
		'default'           => 0,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_recently_viewed_products',
		array(
			'label'         	=> esc_html__( 'Recently Viewed Products', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 104
		)
	)
);

$wp_customize->add_setting( 
	'single_recently_viewed_bottom_divider',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( 
	$wp_customize, 
	'single_recently_viewed_bottom_divider',
		array(
			'section' 		=> 'botiga_section_single_product',
			'priority'	 	=> 105
		)
	)
);

$wp_customize->add_setting(
	'single_related_products',
	array(
		'default'           => 1,
		'sanitize_callback' => 'botiga_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Botiga_Toggle_Control(
		$wp_customize,
		'single_related_products',
		array(
			'label'         	=> esc_html__( 'Related products', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 110
		)
	)
);

/**
 * Styling
 */

$wp_customize->add_setting( 'single_product_title_size_desktop', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'single_product_title_size_tablet', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'single_product_title_size_mobile', array(
	'default'   		=> 32,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			


$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'single_product_title_size',
	array(
		'label' 		=> esc_html__( 'Product title size', 'botiga' ),
		'section' 		=> 'botiga_section_single_product',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'single_product_title_size_desktop',
			'size_tablet' 		=> 'single_product_title_size_tablet',
			'size_mobile' 		=> 'single_product_title_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority'	 => 120
	)
) );

$wp_customize->add_setting(
	'single_product_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'botiga_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Botiga_Alpha_Color(
		$wp_customize,
		'single_product_title_color',
		array(
			'label'         	=> esc_html__( 'Product title color', 'botiga' ),
			'section'       	=> 'botiga_section_single_product',
			'priority'	 		=> 130
		)
	)
);

$wp_customize->add_setting( 'single_product_styling_divider_1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);

$wp_customize->add_control( new Botiga_Divider_Control( $wp_customize, 'single_product_styling_divider_1',
		array(
			'section' 		=> 'botiga_section_single_product',
			'priority'	 	=> 140
		)
	)
);

$wp_customize->add_setting( 'single_product_price_size_desktop', array(
	'default'   		=> 24,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );			

$wp_customize->add_setting( 'single_product_price_size_tablet', array(
	'default'   		=> 24,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'single_product_price_size_mobile', array(
	'default'   		=> 24,
	'transport'			=> 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Botiga_Responsive_Slider( $wp_customize, 'single_product_price_size',
	array(
		'label' 		=> esc_html__( 'Product price size', 'botiga' ),
		'section' 		=> 'botiga_section_single_product',
		'is_responsive'	=> 1,
		'settings' 		=> array (
			'size_desktop' 		=> 'single_product_price_size_desktop',
			'size_tablet' 		=> 'single_product_price_size_tablet',
			'size_mobile' 		=> 'single_product_price_size_mobile',
		),
		'input_attrs' => array (
			'min'	=> 0,
			'max'	=> 200
		),
		'priority'	 => 150
	)
) );