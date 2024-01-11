<?php
/**
 * WC Germanized Compatibility File
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Botiga_Woocommerce_Germanized_Single_Product {

    public static $shopmarks = array(
        'unit_price'             => array(
            'default_filter'   => 'woocommerce_single_product_summary',
            'default_priority' => 11,
            'callback'         => 'woocommerce_gzd_template_single_price_unit',
        ),
        'legal'                  => array(
            'default_filter'   => 'woocommerce_single_product_summary',
            'default_priority' => 12,
            'callback'         => 'woocommerce_gzd_template_single_legal_info',
        ),
        'delivery_time'          => array(
            'default_filter'   => 'woocommerce_single_product_summary',
            'default_priority' => 27,
            'callback'         => 'woocommerce_gzd_template_single_delivery_time_info',
        ),
        'units'                  => array(
            'default_filter'   => 'woocommerce_product_meta_start',
            'default_priority' => 5,
            'callback'         => 'woocommerce_gzd_template_single_product_units',
        ),
        'defect_description'     => array(
            'default_filter'   => 'woocommerce_single_product_summary',
            'default_priority' => 21,
            'callback'         => 'woocommerce_gzd_template_single_defect_description',
        ),
        'deposit'                => array(
            'default_filter'   => 'woocommerce_single_product_summary',
            'default_priority' => 13,
            'callback'         => 'woocommerce_gzd_template_single_deposit',
        ),
        'deposit_packaging_type' => array(
            'default_filter'   => 'woocommerce_single_product_summary',
            'default_priority' => 10,
            'callback'         => 'woocommerce_gzd_template_single_deposit_packaging_type',
        ),
        'nutri_score'            => array(
            'default_filter'   => 'woocommerce_single_product_summary',
            'default_priority' => 15,
            'callback'         => 'woocommerce_gzd_template_single_nutri_score',
        ),
    );

    public static function remove_plugin_actions() {
        foreach( self::$shopmarks as $shopmark ) {
            remove_action( $shopmark[ 'default_filter' ], $shopmark[ 'callback' ], $shopmark[ 'default_priority' ] );
        }
    }

    public static function customizer_components( $components ) {
        foreach( self::$shopmarks as $shopmark ) {
            $components[] = $shopmark[ 'callback' ];
        }

        return $components;
    }

    public static function customizer_elements( $elements ) {
        foreach( self::$shopmarks as $shopmark_slug => $shopmark ) {
            $elements[ $shopmark[ 'callback' ] ] = self::get_shopmark_title( $shopmark_slug );
        }

        return $elements;
    }

    public static function get_shopmark_title( $slug ) {
        $titles = array(
            'unit_price'             => esc_html__( 'WCGZ: Unit Price', 'botiga' ),
            'legal'                  => esc_html__( 'WCGZ: Legal Info', 'botiga' ),
            'delivery_time'          => esc_html__( 'WCGZ: Delivery Time', 'botiga' ),
            'units'                  => esc_html__( 'WCGZ: Units', 'botiga' ),
            'defect_description'     => esc_html__( 'WCGZ: Defect Description', 'botiga' ),
            'deposit'                => esc_html__( 'WCGZ: Deposit', 'botiga' ),
            'deposit_packaging_type' => esc_html__( 'WCGZ: Deposit Packaging Type', 'botiga' ),
            'nutri_score'            => esc_html__( 'WCGZ: Nutri Score', 'botiga' ),
        );

        return $titles[ $slug ];
    }
}
