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
