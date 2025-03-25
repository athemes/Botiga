<?php

/**
 * WP Rocket compatibility file.
 * 
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'WP_ROCKET_VERSION' ) ) {
    return;
}

class Botiga_WP_Rocket {

    /**
     * Used CSS parameters.
     * 
     * @var array
     */
    protected static $used_css_params = array(
        'rocket_rucss_external_exclusions' => array(
            // '/wp-content/plugins/plugin-name/css/file.css',
        ),
        'rocket_rucss_inline_content_exclusions' => array(
            // '.targetSelector',
        ),
        'rocket_rucss_inline_atts_exclusions' => array(
            // 'data-example-1',
            // 'data-example-2="the-value"',
            // "data-example-3='the-value'",
        ),
        'rocket_rucss_skip_styles_with_attr' => array(
            // 'data-example-1',
            // 'data-example-2="the-value"',
            // "data-example-3='the-value'",
        ),
        'prepend_css' => array(
            // '.new_css{background:red;}',
        ),
        'append_css' => array(
            // '.new_css{background:red;}',
        ),
        'filter_css' => array(
            // '.to-be-removed{padding:10px};'
            // =>
            // '.to-be-inserted{padding:20px};',
        ),
    );

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        
        // Exclude external stylesheets from being removed by WP Rocket's Remove Unused CSS optimization.
        add_filter( 'rocket_rucss_external_exclusions', array( $this, 'exclusions' ) );

        // Exclude inline styles from being removed by WP Rocket's Remove Unused CSS optimization.
        add_filter( 'rocket_rucss_inline_content_exclusions', array( $this, 'exclusions' ) );

        // Exclude inline styles from being removed by WP Rocket's Remove Unused CSS optimization.
        add_filter( 'rocket_rucss_inline_atts_exclusions', array( $this, 'exclusions' ) );

        // Completely remove styles with target attributes from page.
        add_filter( 'rocket_rucss_skip_styles_with_attr', array( $this, 'exclusions' ) );

        // Filter the CSS for prepend, append and filter.
        add_filter( 'rocket_usedcss_content', array( $this, 'filter_css' ) );
    }

    /**
     * Exclusions.
     * 
     * @param array $exclusions
     * @return array
     */
    public static function exclusions( $exclusions = array() ) {
        $current_filter = current_filter();

        if ( empty( self::$used_css_params[$current_filter] ) ) {
            return $exclusions;
        }

        foreach ( self::$used_css_params[$current_filter] as $exclusion ) {
            $exclusions[] = $exclusion;
        }

        

        return $exclusions;
    }

    /**
     * Filter CSS.
     * 
     * @param string $css
     * @return string
     */
    public static function filter_css( $css ) {
        if ( ! empty( self::$used_css_params['prepend_css'] ) ) {
            foreach ( self::$used_css_params['prepend_css'] as $prepend_css ) {
                $css = $prepend_css . $css;
            }
        }
      
        if ( ! empty( self::$used_css_params['append_css'] ) ) {
            foreach ( self::$used_css_params['append_css'] as $append_css ) {
                $css = $css . $append_css;
            }
        }
      
        if ( ! empty( self::$used_css_params['filter_css'] ) ) {
            foreach ( self::$used_css_params['filter_css'] as $to_be_removed => $to_be_inserted ) {
                $css = str_replace( $to_be_removed, $to_be_inserted, $css );
            }
        }
      
        return $css;
    }
}

new Botiga_WP_Rocket();