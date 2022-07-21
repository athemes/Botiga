<?php
/**
 * WooCommerce Brands Compatibility File
 *
 * @link https://woocommerce.com/document/woocommerce-brands/
 *
 * @package Botiga
 */

class Botiga_WC_Brands {
    public function __construct() {
        add_filter( 'botiga_shop_page_header_cats_query_args', array( $this, 'shop_page_header_cats_query_args' ) );
        add_filter( 'botiga_shop_page_header_sub_cats_query_args', array( $this, '_shop_page_header_sub_cats_query_args' ) );
        add_filter( 'botiga_default_single_product_components', array( $this, 'customizer_single_product_components_defaults' ) );
        add_filter( 'botiga_single_product_elements', array( $this, 'customizer_single_product_components' ) );
        add_action( 'customize_register', array( $this, 'customizer_options' ) );
    }

    /**
     * Extend shop archive 'Show Categories In The Header' query with brands.
     * 
     */
    public function shop_page_header_cats_query_args( $args ) {
        $cats_includes_brands = get_theme_mod( 'shop_archive_header_cats_includes_brands', 0 );
        
        if( $cats_includes_brands ) {
            $args[ 'taxonomy' ] = array( 'product_cat', 'product_brand' );
        }

        return $args;
    }

    /**
     * Extend shop archive 'Show Sub Categories In The Header' query with brands.
     * 
     */
    public function _shop_page_header_sub_cats_query_args( $args ) {
        $cats_includes_brands = get_theme_mod( 'shop_archive_header_cats_includes_brands', 0 );
        
        if( $cats_includes_brands ) {
            $args[ 'taxonomy' ] = array( 'product_cat', 'product_brand' );
        }

        return $args;
    }

    /**
     * Extend Single Product 'Elements' customizer default values.
     * 
     */
    public function customizer_single_product_components_defaults( $components ) {
        $components[] = 'botiga_wc_brands_brand';
        return $components;
    }

    /**
     * Extend Single Product 'Elements' customizer with 'Brand' option.
     * 
     */
    public function customizer_single_product_components( $elements ) {
        $elements[ 'botiga_wc_brands_brand' ] = esc_html__( 'Brand', 'botiga' );
        return $elements;
    }

    /**
     * Customizer callbacks.
     * 
     */
    public function is_brand_element_active() {
        $element  = 'botiga_wc_brands_brand';
        $elements = get_theme_mod( 'single_product_elements_order' );

        if ( in_array( $element, $elements ) ) {
            return true;
        } else {
            return false;
        }
    }

    public function is_bp() {
        if( ! defined( 'BOTIGA_PRO_VERSION' ) ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Add WooCommerce Brands customizer options.
     * 
     */
    public function customizer_options( $wp_customize ) {

        /**
         * Shop Archive
         */
        // Tabs control
        $controls_general     = json_decode( $wp_customize->get_control( 'botiga_product_catalog_tabs' )->controls_general );
        $new_controls_general = array( '#customize-control-shop_archive_header_cats_includes_brands' );
        $wp_customize->get_control( 'botiga_product_catalog_tabs' )->controls_general = json_encode( array_merge( $controls_general, $new_controls_general ) );

        // Display brands with categories
        $wp_customize->add_setting(
            'shop_archive_header_cats_includes_brands',
            array(
                'default'           => 0,
                'sanitize_callback' => 'botiga_sanitize_checkbox',
            )
        );
        $wp_customize->add_control(
            new Botiga_Toggle_Control(
                $wp_customize,
                'shop_archive_header_cats_includes_brands',
                array(
                    'label'         	=> esc_html__( 'Include Brands On Categories', 'botiga' ),
                    'description'       => esc_html__( 'Check to filter and display product brands along with product categories', 'botiga' ),
                    'section'       	=> 'woocommerce_product_catalog',
                    'active_callback'   => array( $this, 'is_bp' ),
                    'priority' 			=> 22
                )
            )
        );

        /**
         * Single Product
         */
        // Tabs control
        $controls_general     = json_decode( $wp_customize->get_control( 'botiga_single_product_tabs' )->controls_general );
        $new_controls_general = array( '#customize-control-botiga_wc_brands_brand_image_width', '#customize-control-botiga_wc_brands_brand_image_height' );
        $wp_customize->get_control( 'botiga_single_product_tabs' )->controls_general = json_encode( array_merge( $controls_general, $new_controls_general ) );

        // Brand image width
        $wp_customize->add_setting( 
            'botiga_wc_brands_brand_image_width', 
            array(
                'default'   		=> 65,
                'sanitize_callback' => 'botiga_sanitize_text',
            ) 
        );			
        $wp_customize->add_control( 
            new Botiga_Responsive_Slider( 
                $wp_customize, 
                'botiga_wc_brands_brand_image_width',
                array(
                    'label' 		=> esc_html__( 'Brand Image Width', 'botiga' ),
                    'section' 		=> 'botiga_section_single_product',
                    'active_callback' => array( $this, 'is_brand_element_active' ),
                    'is_responsive'	=> 0,
                    'settings' 		=> array (
                        'size_desktop' 		=> 'botiga_wc_brands_brand_image_width',
                    ),
                    'input_attrs' => array (
                        'min'	=> 0,
                        'max'	=> 300,
                        'step'  => 1
                    ),
                    'priority'      => 91
                )
            ) 
        );

        // Brand image height
        $wp_customize->add_setting( 
            'botiga_wc_brands_brand_image_height', 
            array(
                'default'   		=> 65,
                'sanitize_callback' => 'botiga_sanitize_text',
            ) 
        );			
        $wp_customize->add_control( 
            new Botiga_Responsive_Slider( 
                $wp_customize, 
                'botiga_wc_brands_brand_image_height',
                array(
                    'label' 		=> esc_html__( 'Brand Image Height', 'botiga' ),
                    'section' 		=> 'botiga_section_single_product',
                    'active_callback' => array( $this, 'is_brand_element_active' ),
                    'is_responsive'	=> 0,
                    'settings' 		=> array (
                        'size_desktop' 		=> 'botiga_wc_brands_brand_image_height',
                    ),
                    'input_attrs' => array (
                        'min'	=> 0,
                        'max'	=> 300,
                        'step'  => 1
                    ),
                    'priority'      => 91
                )
            ) 
        );
    }
}

// Initialize the class
new Botiga_WC_Brands();

/**
 * Single product elements 'Brand' output
 * 
 */
function botiga_wc_brands_brand() {
    $width  = get_theme_mod( 'botiga_wc_brands_brand_image_width', 65 );
    $height = get_theme_mod( 'botiga_wc_brands_brand_image_height', 65 );

    echo '<div class="botiga-wc-brands-brand-wrapper">';
        echo do_shortcode( "[product_brand width=\"${width}px\" height=\"${height}px\" class=\"botiga-wc-brands-brand-image\"]" );
    echo '</div>';
}