<?php
/**
 * Single Product - Section Tabs Customizer Settings
 *
 * @package Botiga
 */

// Enable Product Tabs
$wp_customize->add_setting(
    'single_product_tabs',
    array(
        'default' => 1,
        'sanitize_callback' => 'botiga_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Botiga_Toggle_Control(
        $wp_customize,
        'single_product_tabs',
        array(
            'label' => esc_html__('Product tabs', 'botiga'),
            'section' => 'botiga_section_single_product_tabs',
            'priority' => 90,
        )
    )
);

// Tabs Position
$wp_customize->add_setting(
    'single_product_tabs_position',
    array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control(
    new Botiga_Radio_Images(
        $wp_customize,
        'single_product_tabs_position',
        array(
            'label'     => esc_html__( 'Position', 'botiga' ),
            'section'   => 'botiga_section_single_product_tabs',
            'cols'      => 2,
            'choices'  => array(
                'default' => array(
                    'label' => esc_html__( 'Default', 'botiga' ),
                    'url'   => '%s/assets/img/tabs-pos1.svg',
                ),
                'product-summary' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Product Summary', 'botiga' ),
                    'url'    => '%s/assets/img/tabs-pos2.svg',
                ),
            ),
            'priority'   => 112,
        )
    )
);

// Tabs Layout Style
$wp_customize->add_setting(
    'single_product_tabs_layout',
    array(
        'default'           => 'style1',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control(
    new Botiga_Radio_Images(
        $wp_customize,
        'single_product_tabs_layout',
        array(
            'label'     => esc_html__( 'Layout Style', 'botiga' ),
            'section'   => 'botiga_section_single_product_tabs',
            'cols'      => 2,
            'choices'  => array(
                'style1' => array(
                    'label' => esc_html__( 'Style 1', 'botiga' ),
                    'url'   => '%s/assets/img/tabs1.svg',
                ),
                'style2' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Style 2', 'botiga' ),
                    'url'    => '%s/assets/img/tabs2.svg',
                ),
                'style3' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Style 3', 'botiga' ),
                    'url'    => '%s/assets/img/tabs3.svg',
                ),
                'style4' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Style 4', 'botiga' ),
                    'url'    => '%s/assets/img/tabs4.svg',
                ),
                'style5' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Style 5', 'botiga' ),
                    'url'    => '%s/assets/img/tabs5.svg',
                ),
                'style6' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Style 6', 'botiga' ),
                    'url'    => '%s/assets/img/tabs6.svg',
                ),
            ),
            'priority'   => 112,
        )
    )
);