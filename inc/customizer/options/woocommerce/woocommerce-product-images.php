<?php
/**
 * Woocommerce Product Images Customizer options
 *
 * @package Botiga
 */

// Thumbnail Image Width.
$wp_customize->add_setting( 
	'shop_woocommerce_thumbnail_image_width', 
	array(
		'default'           => 420,
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_woocommerce_thumbnail_image_width',
		array(
			'label'         => esc_html__( 'Thumbnail Image Width', 'botiga' ),
            'description'   => esc_html__( 'Controls the size of the images in the product grid. Note that this will apply to all product grids throughout the entire website and not only to the shop archive grids.', 'botiga' ),
			'section'       => 'woocommerce_product_images',
			'is_responsive' => 0,
			'settings'      => array(
				'size_desktop'      => 'shop_woocommerce_thumbnail_image_width',
			),
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 2000,
				'step'  => 1,
				'unit'  => 'px',
			),
			'priority' => 30,
		)
	) 
);

// Single Product Image Width.
$wp_customize->add_setting( 
	'shop_woocommerce_single_image_width', 
	array(
		'default'           => 800,
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new Botiga_Responsive_Slider( 
		$wp_customize, 
		'shop_woocommerce_single_image_width',
		array(
			'label'         => esc_html__( 'Single Product Image Width', 'botiga' ),
            'description'   => esc_html__( 'Controls the size of the main product image on single product pages.', 'botiga' ),
			'section'       => 'woocommerce_product_images',
			'is_responsive' => 0,
			'settings'      => array(
				'size_desktop'      => 'shop_woocommerce_single_image_width',
			),
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 2000,
				'step'  => 1,
				'unit'  => 'px',
			),
			'priority' => 31,
		)
	) 
);
