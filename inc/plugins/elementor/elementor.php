<?php
/**
 * Elementor Compatibility File
 *
 * @package Botiga
 */

class Botiga_Elementor_Compatibility {
    public function __construct() {

        // Enqueue global elementor compatibility file.
        add_action( 'wp_enqueue_scripts', array( $this, 'add_compatibility_css' ) );

        // Extend Motion Effects with custom animations.
        add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'extend_motion_effects' ) );

        // Init.
        add_action( 'wp', array( $this, 'init' ) );

        // Add inline style.
        add_action( 'wp_enqueue_scripts', array( $this, 'add_global_inline_style' ), 20 );

        // Automatically set the page builder mode to posts that have been built with Elementor.
        add_filter( 'botiga_page_builder_mode', array( $this, 'set_page_builder' ), 10, 2 );
    }

    /**
     * Compatibility CSS.
     * 
     * @return void
     */
    public function add_compatibility_css() {
        wp_enqueue_style( 'botiga-elementor', get_template_directory_uri() . '/assets/css/elementor.min.css', array(), BOTIGA_VERSION );
    }

    /**
     * Initialize through 'wp' action
     * 
     * @return void
     */
    public function init() {

        // Register elementor locations (Theme Builder)
        add_action( 'elementor/theme/register_locations', array( $this, 'register_elementor_locations' ) );
    }

    /**
     * Set page builder mode
     * 
     * @param string|bool $mode
     * @param object $post
     * @return bool
     */
    public function set_page_builder( $mode, $post ) {
        if ( $mode ) {
            return $mode;
        }

        if ( ! $post ) {
            return false;
        }

        // Pages shouldn't be automatically enable the page builder mode.
        if ( $post->post_type === 'page' ) {
            return $mode;
        }

        if ( Botiga_Elementor_Helpers::is_built_with_elementor( $post->ID ) ) {
            return true;
        }

        return false;
    }

    /**
     * Add global inline style
     * 
     */
    public function add_global_inline_style() {
        if ( ! Botiga_Elementor_Helpers::is_built_with_elementor() ) {
            return;
        }

        $inline_style = "
            @media(min-width: 1140px) {
                .e-con.e-parent>.e-con-inner {
                    max-width: calc( var(--content-width) - 15px );
                }

                div[data-elementor-type=\"loop-item\"] .e-con.e-parent>.e-con-inner {
                    max-width: var(--content-width);
                }
            }

            body[class*=\"elementor-page\"] .content-wrapper {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            div[data-elementor-type] {
                width: 100% !important;
                max-width: 100% !important;
            }

            div[data-elementor-type].post {
                margin: 0;
            }
        ";

        // Add inline style
        if ( ! empty( $inline_style ) ) {
            wp_add_inline_style( 'botiga-style', $inline_style );
        }
    }

    /**
     * Register elementor locations
     * 
     */
    public function register_elementor_locations( $elementor_theme_manager ) {
        $elementor_theme_manager->register_location( 'header' );
        $elementor_theme_manager->register_location( 'footer' );
        $elementor_theme_manager->register_location( 'single' );
    }

    /**
     * Extend Motion Effects with custom animations filter callback
     * 
     */
    public function extend_motion_effects( $additional_animations ) {
        $additional_animations[ 'Botiga' ] = array(
            'fadeInUpShorter' => esc_html__( 'Fade In Up Shorter', 'botiga' ),
            'fadeInDownShorter' => esc_html__( 'Fade In Down Shorter', 'botiga' ),
            'fadeInLeftShorter' => esc_html__( 'Fade In Left Shorter', 'botiga' ),
            'fadeInRightShorter' => esc_html__( 'Fade In Right Shorter', 'botiga' ),
        );

        return $additional_animations;
    }
}

new Botiga_Elementor_Compatibility();

/**
 * Elementor Helper Class
 * 
 */
class Botiga_Elementor_Helpers {

    /**
     * Get location type.
     * 
     * @return string
     */
    public static function get_location_type() {
        if ( is_singular() || is_404() ) {
            return 'single';
        }

        if ( is_home() ||  is_archive() || is_search() ) {
            return 'archive';
        }

        return '';
    }

    /**
     * Get custom template by location type.
     * 
     * @param string $location_type
     * @return array
     */
    public static function get_custom_template_by_location_type( $location_type ) {
        $conditions_manager = \ElementorPro\Plugin::instance()->modules_manager->get_modules( 'theme-builder' )->get_conditions_manager();
        $documents          = $conditions_manager->get_theme_templates_ids( $location_type );
        
        $documents = reset( $documents );

        return $documents;
    }

    /**
     * Check if a theme builder location is active.
     * 
     * @param string $location
     * @return bool
     */
    public static function elementor_has_location( $location ) {
        if ( ! did_action( 'elementor_pro/init' ) ) {
            return false;
        }

        if( ! class_exists( 'ElementorPro\\Plugin' ) ) {
            return false;
        }

        $custom_template = self::get_custom_template_by_location_type( $location );

        return ! empty( $custom_template );
    }

    /**
     * Check if a post is built with Elementor.
     * 
     * @param int $post_id
     * @return bool
     */
    public static function is_built_with_elementor( $post_id = 0 ) {
        global $post;

        if ( ! $post_id && $post ) {
            $post_id = $post->ID;
        }

        if ( ! did_action( 'elementor/init' ) ) {
            return false;
        }
        
        if ( ! class_exists( 'Elementor\Plugin' ) ) {
            return false;
        }

        if (
            ! empty( $post_id ) &&  
            \Elementor\Plugin::$instance->documents->get( $post_id ) && 
            \Elementor\Plugin::$instance->documents->get( $post_id )->is_built_with_elementor() 
        ) {
            return true;
        } else {
            $location_type = self::get_location_type();

            if ( self::elementor_has_location( $location_type ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check whether a pace is loaded via Elementor Pro Theme Builder.
     * 
     * @return bool
     */
    public static function is_page_loaded_by_elementor_theme_builder() {
        $location_type = Botiga_Elementor_Helpers::get_location_type();
        $template = Botiga_Elementor_Helpers::get_custom_template_by_location_type( $location_type );

        if ( Botiga_Elementor_Helpers::is_built_with_elementor( $template ) ) {
            return true;
        }

        return false;
    }
}
