<?php
/**
 * Class for backward compatibility.
 * This class is responsible handling dynamic theme stuff based on the first version
 * which the user started using the theme.
 * 
 * E.g Inject certain pieces of CSS only to specific versions from the theme.
 * 
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Botiga_Backward_Compatibility {

    /**
     * First theme version.
     * 
     * @var string
     */
    private $first_theme_version;

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        $this->first_theme_version = get_option( 'botiga-first-theme-version' );

        add_action( 'wp_enqueue_scripts', array( $this, 'set_single_blog_posts_container_full_width' ), 20 );
    }

    /**
     * Set single blog posts container to full width (with page builder mode enabled).
     * This should happen only for users who have started using the theme from version 2.2.15.
     * 
     * @param string $css
     * @since 2.2.15
     * 
     * @return void
     */
    public function set_single_blog_posts_container_full_width() {
        if ( 
            ! $this->first_theme_version || 
            ( $this->first_theme_version && version_compare( $this->first_theme_version, '2.2.15', '<' ) )
        ) {
            return;
        }

        if ( ! is_singular( 'post' ) ) {
            return;
        }

        $page_builder_mode = botiga_get_page_builder_mode();
        if ( ! $page_builder_mode ) {
            return;
        }

        $css = "
            .single-post .entry-content {
                --bt-single-post-entry-content-max-width: 100%;
            }
        ";
        
        wp_add_inline_style( 'botiga-style', $css );
    }
}

new Botiga_Backward_Compatibility();