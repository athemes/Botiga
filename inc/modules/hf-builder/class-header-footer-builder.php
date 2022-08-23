<?php
/**
 * Header/Footer Builder
 * 
 * @package Botiga_Pro
 */

if ( ! Botiga_Modules::is_module_active( 'hf-builder' ) ) {
	return;
}

class Botiga_Header_Footer_Builder {
    /**
     * Instance
     */		
    private static $instance;

    /**
     * Initiator
     */
    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * Constructor
     */
    public function __construct() {

        // Desktop Components.
        $this->desktop_components = array(
            array(
                'id'    => 'menu',
                'label' => esc_html__( 'Primary Menu', 'botiga-pro' )
            ),
            array(
                'id'    => 'secondary_menu',
                'label' => esc_html__( 'Secondary Menu', 'botiga-pro' )
            ),
            array(
                'id'    => 'social',
                'label' => esc_html__( 'Social', 'botiga-pro' )
            ),
            array(
                'id'    => 'search',
                'label' => esc_html__( 'Search', 'botiga-pro' )
            ),
            array(
                'id'    => 'logo',
                'label' => esc_html__( 'Site Title & Logo', 'botiga-pro' )
            ),
            array(
                'id'    => 'button',
                'label' => esc_html__( 'Button', 'botiga-pro' )
            ),
            array(
                'id'    => 'button2',
                'label' => esc_html__( 'Button 2', 'botiga-pro' )
            ),
            array(
                'id'    => 'contact_info',
                'label' => esc_html__( 'Contact Info', 'botiga-pro' )
            ),
            array(
                'id'    => 'html',
                'label' => esc_html__( 'HTML', 'botiga-pro' )
            ),
            array(
                'id'    => 'html2',
                'label' => esc_html__( 'HTML 2', 'botiga-pro' )
            )
        );

        // Mobile components.
        $this->mobile_components = array(
            array(
                'id'    => 'mobile_offcanvas_menu',
                'label' => esc_html__( 'Off-Canvas Menu', 'botiga-pro' )
            ),
            array(
                'id'    => 'secondary_menu',
                'label' => esc_html__( 'Secondary Menu', 'botiga-pro' )
            ),
            array(
                'id'    => 'mobile_hamburger',
                'label' => esc_html__( 'Mobile Hamburger', 'botiga-pro' )
            ),
            array(
                'id'    => 'social',
                'label' => esc_html__( 'Social', 'botiga-pro' )
            ),
            array(
                'id'    => 'search',
                'label' => esc_html__( 'Search', 'botiga-pro' )
            ),
            array(
                'id'    => 'logo',
                'label' => esc_html__( 'Site Title & Logo', 'botiga-pro' )
            ),
            array(
                'id'    => 'button',
                'label' => esc_html__( 'Button', 'botiga-pro' )
            ),
            array(
                'id'    => 'button2',
                'label' => esc_html__( 'Button 2', 'botiga-pro' )
            ),
            array(
                'id'    => 'contact_info',
                'label' => esc_html__( 'Contact Info', 'botiga-pro' )
            ),
            array(
                'id'    => 'html',
                'label' => esc_html__( 'HTML', 'botiga-pro' )
            ),
            array(
                'id'    => 'html2',
                'label' => esc_html__( 'HTML 2', 'botiga-pro' )
            )
        );

        // WooCommerce components.
        if( class_exists( 'Woocommerce' ) ) {
            $this->desktop_components[] = array(
                'id'    => 'woo_icons',
                'label' => esc_html__( 'WooCommerce Icons', 'botiga-pro' )
            );

            $this->mobile_components[] = array(
                'id'    => 'woo_icons',
                'label' => esc_html__( 'WooCommerce Icons', 'botiga-pro' )
            );
        }

        // WPML component.
        if ( class_exists( 'SitePress' ) ) {
            $this->desktop_components[] = array(
                'id'    => 'wpml_switcher',
                'label' => esc_html__( 'WPML Language Switcher', 'botiga-pro' )
            );

            $this->mobile_components[] = array(
                'id'    => 'wpml_switcher',
                'label' => esc_html__( 'WPML Language Switcher', 'botiga-pro' )
            );
		}
        
        // Polylang component.
		if ( function_exists( 'pll_the_languages' ) ) {
            $this->desktop_components[] = array(
                'id'    => 'pll_switcher',
                'label' => esc_html__( 'Polylang Language Switcher', 'botiga-pro' )
            );

            $this->mobile_components[] = array(
                'id'    => 'pll_switcher',
                'label' => esc_html__( 'Polylang Language Switcher', 'botiga-pro' )
            );
		}

        // Footer Components.
        $this->footer_components = array(
            array(
                'id'    => 'footer_menu',
                'label' => esc_html__( 'Footer Menu', 'botiga-pro' )
            ),
            array(
                'id'    => 'copyright',
                'label' => esc_html__( 'Copyright', 'botiga-pro' )
            ),
            array(
                'id'    => 'social',
                'label' => esc_html__( 'Social', 'botiga-pro' )
            ),
            array(
                'id'    => 'button',
                'label' => esc_html__( 'Button 1', 'botiga-pro' )
            ),
            array(
                'id'    => 'button2',
                'label' => esc_html__( 'Button 2', 'botiga-pro' )
            ),
            array(
                'id'    => 'html',
                'label' => esc_html__( 'HTML', 'botiga-pro' )
            ),
            array(
                'id'    => 'html2',
                'label' => esc_html__( 'HTML 2', 'botiga-pro' )
            ),
            array(
                'id'    => 'widget1',
                'label' => esc_html__( 'Widget 1', 'botiga-pro' )
            ),
            array(
                'id'    => 'widget2',
                'label' => esc_html__( 'Widget 2', 'botiga-pro' )
            ),
            array(
                'id'    => 'widget3',
                'label' => esc_html__( 'Widget 3', 'botiga-pro' )
            ),
            array(
                'id'    => 'widget4',
                'label' => esc_html__( 'Widget 4', 'botiga-pro' )
            ),
        );

        // Header Rows Options
        $this->header_rows = array(
            array(
                'id' => 'above_header_row',
                'label' => esc_html__( 'Above Header Row', 'botiga-pro' ),
                'section' => 'botiga_section_hb_above_header_row',
                'default' => $this->get_row_default_value( 'above_header_row' )
            ),
            array(
                'id' => 'main_header_row',
                'label' => esc_html__( 'Main Header Row', 'botiga-pro' ),
                'section' => 'botiga_section_hb_main_header_row',
                'default' => $this->get_row_default_value( 'main_header_row' )
            ),
            array(
                'id' => 'below_header_row',
                'label' => esc_html__( 'Below Header Row', 'botiga-pro' ),
                'section' => 'botiga_section_hb_below_header_row',
                'default' => $this->get_row_default_value( 'below_header_row' )
            )
        );

        // Footer Rows Options
        $this->footer_rows = array(
            array(
                'id' => 'above_footer_row',
                'label' => esc_html__( 'Above Footer Row', 'botiga-pro' ),
                'section' => 'botiga_section_fb_above_footer_row',
                'default' => $this->get_row_default_value( 'above_footer_row' )
            ),
            array(
                'id' => 'main_footer_row',
                'label' => esc_html__( 'Main Footer Row', 'botiga-pro' ),
                'section' => 'botiga_section_fb_main_footer_row',
                'default' => $this->get_row_default_value( 'main_footer_row' )
            ),
            array(
                'id' => 'below_footer_row',
                'label' => esc_html__( 'Below Footer Row', 'botiga-pro' ),
                'section' => 'botiga_section_fb_below_footer_row',
                'default' => $this->get_row_default_value( 'below_footer_row' )
            )
        );

        if( is_customize_preview() ) {
            add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
        }
        
        add_action( 'customize_preview_init', array( $this, 'customize_preview_scripts' ) );

        // The order '1000' is required here to make sure BP features will be registered as well.
        add_action( 'customize_register', array( $this, 'customizer_options' ), 1000 );

        add_action( 'customize_controls_print_footer_scripts', function(){ $this->header_builder_admin_grid( 'header' ); } );
        add_action( 'customize_controls_print_footer_scripts', function(){ $this->header_builder_admin_grid( 'footer' ); } );
        
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_filter( 'body_class', array( $this, 'body_class' ) );

        remove_all_actions( 'botiga_header' );
        add_action( 'botiga_header', array( $this, 'header_front_output' ) );

        remove_all_actions( 'botiga_footer' );
        add_action( 'botiga_footer', array( $this, 'footer_front_output' ) );
    }

    /**
     * Enqueue Admin Scripts
     */
    public function admin_enqueue_scripts() {
        wp_enqueue_script( 'jquery-ui-sortable' );

        wp_enqueue_style( 'botiga-bhfb', get_template_directory_uri() . '/assets/css/admin/botiga-bhfb.min.css', array(), BOTIGA_VERSION );
        wp_enqueue_script( 'botiga-bhfb', get_template_directory_uri() . '/assets/js/admin/botiga-bhfb.min.js', array(), BOTIGA_VERSION, true );
        wp_localize_script( 'botiga-bhfb', 'botiga_hfb', array(
            'components' => array(
                'desktop' => apply_filters( 'botiga_header_builder_desktop_components', $this->desktop_components ),
                'mobile'  => apply_filters( 'botiga_header_builder_mobile_components', $this->mobile_components ),
                'footer'  => apply_filters( 'botiga_header_builder_footer_components', $this->footer_components )
            ),
            'i18n' => array(
                'elementsMessage' => esc_html__( 'It looks like you already is using all available components.', 'botiga-pro' )
            )
        ) );
    }

    /**
     * Enqueue Customize Preview Scripts.
     */
    public function customize_preview_scripts() {
        wp_enqueue_style( 'botiga-bhfb-customize-preview', get_template_directory_uri() . '/assets/css/admin/botiga-bhfb-customize-preview.min.css', array(), BOTIGA_VERSION );
        wp_enqueue_script( 'botiga-bhfb-customize-preview', get_template_directory_uri() . '/assets/js/admin/botiga-bhfb-customize-preview.min.js', array(), BOTIGA_VERSION, true );
    }

    /**
     * Enqueue Front Scripts.
     */
    public function enqueue_scripts() {
        wp_enqueue_style( 'botiga-bhfb', get_template_directory_uri() . '/assets/css/botiga-bhfb.min.css', array(), BOTIGA_VERSION );
    }

    /**
     * Body Class Callback
     */
    public function body_class( $classes ) {
        $classes[] = 'has-bhfb-builder';

        return $classes;
    }

    /**
     * Register Customizer Header/Footer Builder Options
     */
    public function customizer_options( $wp_customize ) {
        $this->header_customizer_options( $wp_customize );
        $this->footer_customizer_options( $wp_customize );
    }

    /**
     * Header Customizer Options
     */
    public function header_customizer_options( $wp_customize ) {
        
        // Remove sections
        $wp_customize->remove_section('botiga_section_top_bar');
        $wp_customize->remove_section('botiga_section_main_header');
        $wp_customize->remove_section('botiga_section_mobile_header');
        $wp_customize->remove_section('botiga_section_header_icons');

        // Header Builder Wrapper
        $wp_customize->add_section(
            'botiga_section_hb_wrapper',
            array(
                'title'      => esc_html__( 'Header Builder', 'botiga-pro' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Above Header Row Section
        $wp_customize->add_section(
            'botiga_section_hb_above_header_row',
            array(
                'title'      => esc_html__( 'Above Header', 'botiga-pro' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Main Header Row Section
        $wp_customize->add_section(
            'botiga_section_hb_main_header_row',
            array(
                'title'      => esc_html__( 'Main Header', 'botiga-pro' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Below Header Row Section
        $wp_customize->add_section(
            'botiga_section_hb_below_header_row',
            array(
                'title'      => esc_html__( 'Below Header', 'botiga-pro' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Mobile Offcanvas Header Section
        $wp_customize->add_section(
            'botiga_section_hb_mobile_offcanvas',
            array(
                'title'      => esc_html__( 'Mobile Offcanvas', 'botiga-pro' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Components
        require 'components/header/button/customize-options.php';
        require 'components/header/button-2/customize-options.php';
        require 'components/header/contact-info/customize-options.php';
        require 'components/header/menu/customize-options.php';
        require 'components/header/secondary-menu/customize-options.php';
        require 'components/header/social/customize-options.php';
        require 'components/header/search/customize-options.php';
        require 'components/header/logo/customize-options.php';
        require 'components/header/wc-icons/customize-options.php';
        require 'components/header/html/customize-options.php';
        require 'components/header/html-2/customize-options.php';
        require 'components/header/mobile-hamburger/customize-options.php';
        require 'components/header/mobile-offcanvas-menu/customize-options.php';

        if ( function_exists( 'SitePress' ) ) {
            require 'components/header/wpml/customize-options.php';
        }

		if ( function_exists( 'pll_the_languages' ) ) {
            require 'components/header/polylang/customize-options.php';
        }

        // Structure Components.
        require 'components/header/header-builder/customize-options.php';
        require 'components/header/row/customize-options.php';
        require 'components/header/mobile-offcanvas/customize-options.php';
    }

    public function footer_customizer_options( $wp_customize ) {

        // Remove sections
        $wp_customize->remove_section('botiga_section_footer_widgets');
        $wp_customize->remove_section('botiga_section_footer_credits');

        // Footer Builder Wrapper
        $wp_customize->add_section(
            'botiga_section_fb_wrapper',
            array(
                'title'      => esc_html__( 'Footer Builder', 'botiga-pro' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Footer Builder Above Footer Row Section
        $wp_customize->add_section(
            'botiga_section_fb_above_footer_row',
            array(
                'title'      => esc_html__( 'Above Footer', 'botiga-pro' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Footer Builder Main Footer Row Section
        $wp_customize->add_section(
            'botiga_section_fb_main_footer_row',
            array(
                'title'      => esc_html__( 'Main Footer', 'botiga-pro' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Footer Builder Below Footer Row Section
        $wp_customize->add_section(
            'botiga_section_fb_below_footer_row',
            array(
                'title'      => esc_html__( 'Below Footer', 'botiga-pro' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Components.
        require 'components/footer/menu/customize-options.php';
        require 'components/footer/social/customize-options.php';
        require 'components/footer/copyright/customize-options.php';
        require 'components/footer/button/customize-options.php';
        require 'components/footer/button-2/customize-options.php';
        require 'components/footer/html/customize-options.php';
        require 'components/footer/html-2/customize-options.php';
        require 'components/footer/widget-1/customize-options.php';
        require 'components/footer/widget-2/customize-options.php';
        require 'components/footer/widget-3/customize-options.php';
        require 'components/footer/widget-4/customize-options.php';

        // Structure Components.
        require 'components/footer/footer-builder/customize-options.php';
        require 'components/footer/row/customize-options.php';

    }

    /**
     * Get Row Data
     */
    public static function get_row_data( $row, $area ) {
        if( $area === 'footer' ) {
            return json_decode( get_theme_mod( 'botiga_footer_row__' . $row, Botiga_Header_Footer_Builder::get_row_default_value( $row ) ) );
        }

        return json_decode( get_theme_mod( 'botiga_header_row__' . $row, Botiga_Header_Footer_Builder::get_row_default_value( $row ) ) );
    }

    /**
     * Get Row Default Value
     */
    public static function get_row_default_value( $row ) {
        switch ( $row ) {
            case 'main_header_row':
                if( class_exists( 'Woocommerce' ) ) {
                    $default = '{ "desktop": [["menu"], ["logo"], ["search", "woo_icons"]], "mobile": [["mobile_hamburger"], ["logo"], ["search", "woo_icons"]] }';
                } else {
                    $default = '{ "desktop": [["menu"], ["logo"], ["search"]], "mobile": [["mobile_hamburger"], ["logo"], ["search"]] }';
                }
                break;

            case 'mobile_offcanvas':
                $default = '{ "desktop": [], "mobile": [], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }';
                break;
            
            default:
                $default = '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }';
                break;
        }

        return $default;
    }

    /**
     * Row Output
     */
    public function rows_callback( $area, $row, $device ) {

        $args = array(
            'area'     => $area,
            'row'      => $row,
            'device'   => $device,
            'row_data' => $this->get_row_data( $row, $area )
        );

        if( 'header' === $area ) {
            botiga_get_template_part( 'template-parts/header-builder/content', 'header-row', $args );
        }

        if( 'footer' === $area ) {
            botiga_get_template_part( 'template-parts/footer-builder/content', 'footer-row', $args );
        }
    }

    /**
     * Mobile Offcanvas Output
     */
    public function mobile_offcanvas_callback() { 
        $args = array(
            'row_data' => json_decode( get_theme_mod( 'botiga_header_row__mobile_offcanvas', $this->get_row_default_value( 'mobile_offcanvas' ) ) )
        );

        botiga_get_template_part( 'template-parts/header-builder/content', 'header-mobile-offcanvas', $args );
    }

    /**
     * Edit icon inside customizer.
     */
    public static function customizer_edit_button() {
        if( !is_customize_preview() ) {
            return;
        } ?>

        <div class="customize-partial-edit-shortcut" data-id="bhfb">
            <button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'botiga-pro' ); ?>"
                    title="<?php esc_attr_e( 'Click to edit this element.', 'botiga-pro' ); ?>"
                    class="customize-partial-edit-shortcut-button bhfb-item-customizer-focus">
                <?php echo botiga_get_svg_icon( 'icon-edit' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </button>
        </div>
        <?php
    }

    /**
     * Customizer Header/Footer Builder Grid System Output
     */
    public function header_builder_admin_grid( $area ) { 
        $area_prefix = $area === 'header' ? 'hb' : 'fb';
        ?>
        <div class="botiga-bhfb botiga-bhfb-<?php echo esc_attr( $area ); ?>">
            <div class="botiga-bhfb-devices">
                <div class="botiga-bhfb-device">
                    <a href="#" class="botiga-bhfb-device-link active" data-device="desktop">
                        <span class="dashicons dashicons-desktop"></span>
                        <?php echo esc_html__( 'Desktop', 'botiga-pro' ); ?>
                    </a>
                </div>
                <div class="botiga-bhfb-device">
                    <a href="#" class="botiga-bhfb-device-link" data-device="tablet">
                        <span class="dashicons dashicons-smartphone"></span>
                        <?php echo esc_html__( 'Tablet/Mobile', 'botiga-pro' ); ?>
                    </a>
                </div>
            </div>
            <div class="botiga-bhfb-top">
                <div id="botiga-bhfb-elements" class="botiga-bhfb-elements">
                    <div class="botiga-bhfb-elements-wrapper">
                        <div class="botiga-bhfb-elements-desktop"></div>
                        <div class="botiga-bhfb-elements-mobile"></div>
                    </div>
                </div>
                <div class="botiga-bhfb-desktop">
                    <div class="botiga-bhfb-rows-wrapper">
                        <div class="botiga-bhfb-row botiga-bhfb-row-top botiga-bhfb-above-row">
                            <div class="botiga-bhfb-row-controls">
                                <a href="#" class="settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_above_<?php echo esc_attr( $area ); ?>_row').focus();">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.7604 7.62398C11.7844 7.42398 11.8004 7.21598 11.8004 6.99998C11.8004 6.78398 11.7844 6.57598 11.7524 6.37598L13.1044 5.31998C13.2244 5.22398 13.2564 5.04798 13.1844 4.91198L11.9044 2.69598C11.8244 2.55198 11.6564 2.50398 11.5124 2.55198L9.9204 3.19198C9.5844 2.93598 9.2324 2.72798 8.8404 2.56798L8.6004 0.871976C8.5764 0.711976 8.4404 0.599976 8.2804 0.599976H5.7204C5.5604 0.599976 5.4324 0.711976 5.4084 0.871976L5.1684 2.56798C4.7764 2.72798 4.4164 2.94398 4.0884 3.19198L2.4964 2.55198C2.3524 2.49598 2.1844 2.55198 2.1044 2.69598L0.824397 4.91198C0.744397 5.05598 0.776397 5.22398 0.904397 5.31998L2.2564 6.37598C2.2244 6.57598 2.2004 6.79198 2.2004 6.99998C2.2004 7.20798 2.2164 7.42398 2.2484 7.62398L0.896397 8.67998C0.776397 8.77598 0.744397 8.95198 0.816397 9.08798L2.0964 11.304C2.1764 11.448 2.3444 11.496 2.4884 11.448L4.0804 10.808C4.4164 11.064 4.7684 11.272 5.1604 11.432L5.4004 13.128C5.4324 13.288 5.5604 13.4 5.7204 13.4H8.2804C8.4404 13.4 8.5764 13.288 8.5924 13.128L8.8324 11.432C9.2244 11.272 9.5844 11.056 9.9124 10.808L11.5044 11.448C11.6484 11.504 11.8164 11.448 11.8964 11.304L13.1764 9.08798C13.2564 8.94398 13.2244 8.77598 13.0964 8.67998L11.7604 7.62398ZM7.0004 9.39998C5.6804 9.39998 4.6004 8.31998 4.6004 6.99998C4.6004 5.67998 5.6804 4.59998 7.0004 4.59998C8.3204 4.59998 9.4004 5.67998 9.4004 6.99998C9.4004 8.31998 8.3204 9.39998 7.0004 9.39998Z" fill="white"/>
                                    </svg>
                                </a>
                                <span class="title"><?php echo esc_html__( 'TOP ROW', 'botiga-pro' ); ?></span>
                            </div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-left" data-bhfb-row="above_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="left"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-center" data-bhfb-row="above_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="center"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-right" data-bhfb-row="above_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="right"></div>
                        </div>
                        <div class="botiga-bhfb-row botiga-bhfb-row-main botiga-bhfb-main-row">
                            <div class="botiga-bhfb-row-controls">
                                <a href="#" class="settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_main_<?php echo esc_attr( $area ); ?>_row').focus();">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.7604 7.62398C11.7844 7.42398 11.8004 7.21598 11.8004 6.99998C11.8004 6.78398 11.7844 6.57598 11.7524 6.37598L13.1044 5.31998C13.2244 5.22398 13.2564 5.04798 13.1844 4.91198L11.9044 2.69598C11.8244 2.55198 11.6564 2.50398 11.5124 2.55198L9.9204 3.19198C9.5844 2.93598 9.2324 2.72798 8.8404 2.56798L8.6004 0.871976C8.5764 0.711976 8.4404 0.599976 8.2804 0.599976H5.7204C5.5604 0.599976 5.4324 0.711976 5.4084 0.871976L5.1684 2.56798C4.7764 2.72798 4.4164 2.94398 4.0884 3.19198L2.4964 2.55198C2.3524 2.49598 2.1844 2.55198 2.1044 2.69598L0.824397 4.91198C0.744397 5.05598 0.776397 5.22398 0.904397 5.31998L2.2564 6.37598C2.2244 6.57598 2.2004 6.79198 2.2004 6.99998C2.2004 7.20798 2.2164 7.42398 2.2484 7.62398L0.896397 8.67998C0.776397 8.77598 0.744397 8.95198 0.816397 9.08798L2.0964 11.304C2.1764 11.448 2.3444 11.496 2.4884 11.448L4.0804 10.808C4.4164 11.064 4.7684 11.272 5.1604 11.432L5.4004 13.128C5.4324 13.288 5.5604 13.4 5.7204 13.4H8.2804C8.4404 13.4 8.5764 13.288 8.5924 13.128L8.8324 11.432C9.2244 11.272 9.5844 11.056 9.9124 10.808L11.5044 11.448C11.6484 11.504 11.8164 11.448 11.8964 11.304L13.1764 9.08798C13.2564 8.94398 13.2244 8.77598 13.0964 8.67998L11.7604 7.62398ZM7.0004 9.39998C5.6804 9.39998 4.6004 8.31998 4.6004 6.99998C4.6004 5.67998 5.6804 4.59998 7.0004 4.59998C8.3204 4.59998 9.4004 5.67998 9.4004 6.99998C9.4004 8.31998 8.3204 9.39998 7.0004 9.39998Z" fill="white"/>
                                    </svg>
                                </a>
                                <span class="title"><?php echo esc_html__( 'MAIN ROW', 'botiga-pro' ); ?></span>
                            </div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-left" data-bhfb-row="main_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="left"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-center" data-bhfb-row="main_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="center"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-right" data-bhfb-row="main_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="right"></div>
                        </div>
                        <div class="botiga-bhfb-row botiga-bhfb-row-bottom botiga-bhfb-below-row">
                            <div class="botiga-bhfb-row-controls">
                                <a href="#" class="settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_below_<?php echo esc_attr( $area ); ?>_row').focus();">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.7604 7.62398C11.7844 7.42398 11.8004 7.21598 11.8004 6.99998C11.8004 6.78398 11.7844 6.57598 11.7524 6.37598L13.1044 5.31998C13.2244 5.22398 13.2564 5.04798 13.1844 4.91198L11.9044 2.69598C11.8244 2.55198 11.6564 2.50398 11.5124 2.55198L9.9204 3.19198C9.5844 2.93598 9.2324 2.72798 8.8404 2.56798L8.6004 0.871976C8.5764 0.711976 8.4404 0.599976 8.2804 0.599976H5.7204C5.5604 0.599976 5.4324 0.711976 5.4084 0.871976L5.1684 2.56798C4.7764 2.72798 4.4164 2.94398 4.0884 3.19198L2.4964 2.55198C2.3524 2.49598 2.1844 2.55198 2.1044 2.69598L0.824397 4.91198C0.744397 5.05598 0.776397 5.22398 0.904397 5.31998L2.2564 6.37598C2.2244 6.57598 2.2004 6.79198 2.2004 6.99998C2.2004 7.20798 2.2164 7.42398 2.2484 7.62398L0.896397 8.67998C0.776397 8.77598 0.744397 8.95198 0.816397 9.08798L2.0964 11.304C2.1764 11.448 2.3444 11.496 2.4884 11.448L4.0804 10.808C4.4164 11.064 4.7684 11.272 5.1604 11.432L5.4004 13.128C5.4324 13.288 5.5604 13.4 5.7204 13.4H8.2804C8.4404 13.4 8.5764 13.288 8.5924 13.128L8.8324 11.432C9.2244 11.272 9.5844 11.056 9.9124 10.808L11.5044 11.448C11.6484 11.504 11.8164 11.448 11.8964 11.304L13.1764 9.08798C13.2564 8.94398 13.2244 8.77598 13.0964 8.67998L11.7604 7.62398ZM7.0004 9.39998C5.6804 9.39998 4.6004 8.31998 4.6004 6.99998C4.6004 5.67998 5.6804 4.59998 7.0004 4.59998C8.3204 4.59998 9.4004 5.67998 9.4004 6.99998C9.4004 8.31998 8.3204 9.39998 7.0004 9.39998Z" fill="white"/>
                                    </svg>
                                </a>
                                <span class="title"><?php echo esc_html__( 'BOTTOM ROW', 'botiga-pro' ); ?></span>
                            </div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-left" data-bhfb-row="below_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="left"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-center" data-bhfb-row="below_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="center"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-right" data-bhfb-row="below_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="right"></div>
                        </div>
                    </div>
                </div>
                <div class="botiga-bhfb-mobile">
                    <div class="bhfb-offcanvas">
                        <div class="bhfb-offcanvas-settings">
                            <a href="#" class="settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_mobile_offcanvas').focus();">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.7604 7.62398C11.7844 7.42398 11.8004 7.21598 11.8004 6.99998C11.8004 6.78398 11.7844 6.57598 11.7524 6.37598L13.1044 5.31998C13.2244 5.22398 13.2564 5.04798 13.1844 4.91198L11.9044 2.69598C11.8244 2.55198 11.6564 2.50398 11.5124 2.55198L9.9204 3.19198C9.5844 2.93598 9.2324 2.72798 8.8404 2.56798L8.6004 0.871976C8.5764 0.711976 8.4404 0.599976 8.2804 0.599976H5.7204C5.5604 0.599976 5.4324 0.711976 5.4084 0.871976L5.1684 2.56798C4.7764 2.72798 4.4164 2.94398 4.0884 3.19198L2.4964 2.55198C2.3524 2.49598 2.1844 2.55198 2.1044 2.69598L0.824397 4.91198C0.744397 5.05598 0.776397 5.22398 0.904397 5.31998L2.2564 6.37598C2.2244 6.57598 2.2004 6.79198 2.2004 6.99998C2.2004 7.20798 2.2164 7.42398 2.2484 7.62398L0.896397 8.67998C0.776397 8.77598 0.744397 8.95198 0.816397 9.08798L2.0964 11.304C2.1764 11.448 2.3444 11.496 2.4884 11.448L4.0804 10.808C4.4164 11.064 4.7684 11.272 5.1604 11.432L5.4004 13.128C5.4324 13.288 5.5604 13.4 5.7204 13.4H8.2804C8.4404 13.4 8.5764 13.288 8.5924 13.128L8.8324 11.432C9.2244 11.272 9.5844 11.056 9.9124 10.808L11.5044 11.448C11.6484 11.504 11.8164 11.448 11.8964 11.304L13.1764 9.08798C13.2564 8.94398 13.2244 8.77598 13.0964 8.67998L11.7604 7.62398ZM7.0004 9.39998C5.6804 9.39998 4.6004 8.31998 4.6004 6.99998C4.6004 5.67998 5.6804 4.59998 7.0004 4.59998C8.3204 4.59998 9.4004 5.67998 9.4004 6.99998C9.4004 8.31998 8.3204 9.39998 7.0004 9.39998Z" fill="white"/>
                                </svg>
                            </a>
                            <span class="title"><?php echo esc_html__( 'OFFCANVAS', 'botiga-pro' ); ?></span>
                        </div>
                        <div class="bhfb-offcanvas-components-wrapper">
                            <div class="botiga-bhfb-area botiga-bhfb-area-offcanvas" data-bhfb-row="mobile_offcanvas" data-bhfb-column="left"></div>
                        </div>
                    </div>
                    <div class="botiga-bhfb-rows-wrapper">
                        <div class="botiga-bhfb-row botiga-bhfb-row-top botiga-bhfb-above-row">
                            <div class="botiga-bhfb-row-controls">
                                <a href="#" class="settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_above_<?php echo esc_attr( $area ); ?>_row').focus();">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.7604 7.62398C11.7844 7.42398 11.8004 7.21598 11.8004 6.99998C11.8004 6.78398 11.7844 6.57598 11.7524 6.37598L13.1044 5.31998C13.2244 5.22398 13.2564 5.04798 13.1844 4.91198L11.9044 2.69598C11.8244 2.55198 11.6564 2.50398 11.5124 2.55198L9.9204 3.19198C9.5844 2.93598 9.2324 2.72798 8.8404 2.56798L8.6004 0.871976C8.5764 0.711976 8.4404 0.599976 8.2804 0.599976H5.7204C5.5604 0.599976 5.4324 0.711976 5.4084 0.871976L5.1684 2.56798C4.7764 2.72798 4.4164 2.94398 4.0884 3.19198L2.4964 2.55198C2.3524 2.49598 2.1844 2.55198 2.1044 2.69598L0.824397 4.91198C0.744397 5.05598 0.776397 5.22398 0.904397 5.31998L2.2564 6.37598C2.2244 6.57598 2.2004 6.79198 2.2004 6.99998C2.2004 7.20798 2.2164 7.42398 2.2484 7.62398L0.896397 8.67998C0.776397 8.77598 0.744397 8.95198 0.816397 9.08798L2.0964 11.304C2.1764 11.448 2.3444 11.496 2.4884 11.448L4.0804 10.808C4.4164 11.064 4.7684 11.272 5.1604 11.432L5.4004 13.128C5.4324 13.288 5.5604 13.4 5.7204 13.4H8.2804C8.4404 13.4 8.5764 13.288 8.5924 13.128L8.8324 11.432C9.2244 11.272 9.5844 11.056 9.9124 10.808L11.5044 11.448C11.6484 11.504 11.8164 11.448 11.8964 11.304L13.1764 9.08798C13.2564 8.94398 13.2244 8.77598 13.0964 8.67998L11.7604 7.62398ZM7.0004 9.39998C5.6804 9.39998 4.6004 8.31998 4.6004 6.99998C4.6004 5.67998 5.6804 4.59998 7.0004 4.59998C8.3204 4.59998 9.4004 5.67998 9.4004 6.99998C9.4004 8.31998 8.3204 9.39998 7.0004 9.39998Z" fill="white"/>
                                    </svg>
                                </a>
                                <span class="title"><?php echo esc_html__( 'TOP ROW', 'botiga-pro' ); ?></span>
                            </div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-left" data-bhfb-row="above_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="left"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-center" data-bhfb-row="above_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="center"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-right" data-bhfb-row="above_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="right"></div>
                        </div>
                        <div class="botiga-bhfb-row botiga-bhfb-row-main botiga-bhfb-main-row">
                            <div class="botiga-bhfb-row-controls">
                                <a href="#" class="settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_main_<?php echo esc_attr( $area ); ?>_row').focus();">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.7604 7.62398C11.7844 7.42398 11.8004 7.21598 11.8004 6.99998C11.8004 6.78398 11.7844 6.57598 11.7524 6.37598L13.1044 5.31998C13.2244 5.22398 13.2564 5.04798 13.1844 4.91198L11.9044 2.69598C11.8244 2.55198 11.6564 2.50398 11.5124 2.55198L9.9204 3.19198C9.5844 2.93598 9.2324 2.72798 8.8404 2.56798L8.6004 0.871976C8.5764 0.711976 8.4404 0.599976 8.2804 0.599976H5.7204C5.5604 0.599976 5.4324 0.711976 5.4084 0.871976L5.1684 2.56798C4.7764 2.72798 4.4164 2.94398 4.0884 3.19198L2.4964 2.55198C2.3524 2.49598 2.1844 2.55198 2.1044 2.69598L0.824397 4.91198C0.744397 5.05598 0.776397 5.22398 0.904397 5.31998L2.2564 6.37598C2.2244 6.57598 2.2004 6.79198 2.2004 6.99998C2.2004 7.20798 2.2164 7.42398 2.2484 7.62398L0.896397 8.67998C0.776397 8.77598 0.744397 8.95198 0.816397 9.08798L2.0964 11.304C2.1764 11.448 2.3444 11.496 2.4884 11.448L4.0804 10.808C4.4164 11.064 4.7684 11.272 5.1604 11.432L5.4004 13.128C5.4324 13.288 5.5604 13.4 5.7204 13.4H8.2804C8.4404 13.4 8.5764 13.288 8.5924 13.128L8.8324 11.432C9.2244 11.272 9.5844 11.056 9.9124 10.808L11.5044 11.448C11.6484 11.504 11.8164 11.448 11.8964 11.304L13.1764 9.08798C13.2564 8.94398 13.2244 8.77598 13.0964 8.67998L11.7604 7.62398ZM7.0004 9.39998C5.6804 9.39998 4.6004 8.31998 4.6004 6.99998C4.6004 5.67998 5.6804 4.59998 7.0004 4.59998C8.3204 4.59998 9.4004 5.67998 9.4004 6.99998C9.4004 8.31998 8.3204 9.39998 7.0004 9.39998Z" fill="white"/>
                                    </svg>
                                </a>
                                <span class="title"><?php echo esc_html__( 'MAIN ROW', 'botiga-pro' ); ?></span>
                            </div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-left" data-bhfb-row="main_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="left"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-center" data-bhfb-row="main_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="center"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-right" data-bhfb-row="main_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="right"></div>
                        </div>
                        <div class="botiga-bhfb-row botiga-bhfb-row-bottom botiga-bhfb-below-row">
                            <div class="botiga-bhfb-row-controls">
                                <a href="#" class="settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_below_<?php echo esc_attr( $area ); ?>_row').focus();">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11.7604 7.62398C11.7844 7.42398 11.8004 7.21598 11.8004 6.99998C11.8004 6.78398 11.7844 6.57598 11.7524 6.37598L13.1044 5.31998C13.2244 5.22398 13.2564 5.04798 13.1844 4.91198L11.9044 2.69598C11.8244 2.55198 11.6564 2.50398 11.5124 2.55198L9.9204 3.19198C9.5844 2.93598 9.2324 2.72798 8.8404 2.56798L8.6004 0.871976C8.5764 0.711976 8.4404 0.599976 8.2804 0.599976H5.7204C5.5604 0.599976 5.4324 0.711976 5.4084 0.871976L5.1684 2.56798C4.7764 2.72798 4.4164 2.94398 4.0884 3.19198L2.4964 2.55198C2.3524 2.49598 2.1844 2.55198 2.1044 2.69598L0.824397 4.91198C0.744397 5.05598 0.776397 5.22398 0.904397 5.31998L2.2564 6.37598C2.2244 6.57598 2.2004 6.79198 2.2004 6.99998C2.2004 7.20798 2.2164 7.42398 2.2484 7.62398L0.896397 8.67998C0.776397 8.77598 0.744397 8.95198 0.816397 9.08798L2.0964 11.304C2.1764 11.448 2.3444 11.496 2.4884 11.448L4.0804 10.808C4.4164 11.064 4.7684 11.272 5.1604 11.432L5.4004 13.128C5.4324 13.288 5.5604 13.4 5.7204 13.4H8.2804C8.4404 13.4 8.5764 13.288 8.5924 13.128L8.8324 11.432C9.2244 11.272 9.5844 11.056 9.9124 10.808L11.5044 11.448C11.6484 11.504 11.8164 11.448 11.8964 11.304L13.1764 9.08798C13.2564 8.94398 13.2244 8.77598 13.0964 8.67998L11.7604 7.62398ZM7.0004 9.39998C5.6804 9.39998 4.6004 8.31998 4.6004 6.99998C4.6004 5.67998 5.6804 4.59998 7.0004 4.59998C8.3204 4.59998 9.4004 5.67998 9.4004 6.99998C9.4004 8.31998 8.3204 9.39998 7.0004 9.39998Z" fill="white"/>
                                    </svg>
                                </a>
                                <span class="title"><?php echo esc_html__( 'BOTTOM ROW', 'botiga-pro' ); ?></span>
                            </div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-left" data-bhfb-row="below_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="left"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-center" data-bhfb-row="below_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="center"></div>
                            <div class="botiga-bhfb-area botiga-bhfb-area-right" data-bhfb-row="below_<?php echo esc_attr( $area ); ?>_row" data-bhfb-column="right"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botiga-bhfb-bottom">
                <div class="botiga-bhfb-bottom-upsell"></div>
                <a href="#" class="botiga-bhfb-bottom-settings" onClick="wp.customize.section('botiga_section_<?php echo esc_js( $area_prefix ); ?>_wrapper').focus();">
                    <span class="dashicons dashicons-admin-generic"></span>
                </a>
                <a href="#" class="botiga-bhfb-bottom-display">
                    <div class="botiga-bhfb-bottom-display-show">
                        <span class="dashicons dashicons-arrow-up-alt2"></span>
                        <?php echo esc_html__( 'Show', 'botiga-pro' ); ?>
                    </div>
                    <div class="botiga-bhfb-bottom-display-hide">
                        <span class="dashicons dashicons-arrow-down-alt2"></span>
                        <?php echo esc_html__( 'Hide', 'botiga-pro' ); ?>
                    </div>
                </a>
            </div>
        </div>


    <?php
    }

    /**
     * Header Builder Front Output
     */
    public function header_front_output() {
        $sticky_header_styles = array();
        $sticky_header        = get_theme_mod( 'enable_sticky_header', 0 );
        $sticky_header_type   = get_theme_mod( 'sticky_header_type', 'always' );
        $sticky_row           = get_theme_mod( 'botiga_section_hb_wrapper__header_builder_sticky_row', 'main-header-row' );

        $devices = array( 'desktop', 'mobile' );
        foreach( $devices as $device ) { ?>

            <header class="bhfb bhfb-header bhfb-<?php echo esc_attr( $device ); ?><?php echo ( $device === 'desktop' && $sticky_header ? ' has-sticky-header sticky-' . esc_attr( $sticky_header_type ) . ' sticky-row-' . esc_attr( $sticky_row ) : '' ); ?>"<?php echo $device === 'desktop' && ! empty($sticky_header_styles) ? 'style="' . esc_attr( implode( ' ', $sticky_header_styles ) ) . '"' : ''; ?>>
                <div class="bhfb-rows">
                    <?php
                    foreach( $this->header_rows as $row ) { 
                        $attributes = $classes  = $styles = array();

                        // Main row class
                        $classes[] = 'bhfb-row-wrapper';
                        $classes[] = 'bhfb-' . esc_attr( $row['id'] );

                        // Hide row if there's no component inside
                        $hide_row = (int) $this->is_row_empty( $this->get_row_data( $row['id'], 'header' )->$device );
                        if( $hide_row ) {
                            $classes[] = 'bt-d-none';
                        }

                        // Sticky Row
                        if( $sticky_header && $device === 'desktop' ) {
                            if( $row[ 'id' ] === 'main_header_row' && $sticky_row !== 'below-header-row' ) {
                                $classes[] = ' bhfb-sticky-header';
                            }

                            if( $row[ 'id' ] === 'below_header_row' ) {
                                $classes[] = ' bhfb-sticky-header';
                            }
                        }
                        
                        // Mount 'class' attribute output
                        $attributes[] = 'class="'. implode( ' ', $classes ) .'"';

                        // Mount 'style' attribute outut
                        $attributes[] = 'style="'. implode( ' ', $styles ) .'"'; ?>

                        <div <?php echo implode( ' ', $attributes ); ?>>
                            <?php $this->rows_callback( 'header', $row['id'], $device ); ?>
                        </div>

                    <?php
                    } ?>
                </div>

                <?php $this->search_form( 'header' ); ?>

                <?php do_action( "botiga_before_bhfb_header_output_close_$device" ); ?>
            </header>

            <?php 
        } ?>

        <div class="bhfb bhfb-mobile_offcanvas botiga-offcanvas-menu">
            <a class="mobile-menu-close" href="#" title="<?php echo esc_attr( 'Close mobile menu', 'botiga-pro' ); ?>"><i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i></a>
            <div class="bhfb-mobile-offcanvas-rows">
                <?php $this->mobile_offcanvas_callback( 'mobile_offcanvas' ); ?>
            </div>

            <?php $this->search_form( 'header' ); ?>
        </div>
        
        <div class="search-overlay"></div>

        <?php
    }

    /**
     * Footer Builder Front Output
     */
    public function footer_front_output() {

        $devices = array( 'desktop' );
        foreach( $devices as $device ) { ?>

            <footer class="bhfb bhfb-footer bhfb-<?php echo esc_attr( $device ); ?>">
                <div class="bhfb-rows">
                    <?php
                    foreach( $this->footer_rows as $row ) { 
                        $attributes = $classes  = $styles = array();

                        // Main row class
                        $classes[] = 'bhfb-row-wrapper';
                        $classes[] = 'bhfb-' . esc_attr( $row['id'] );

                        // Hide row if there's no component inside
                        $hide_row = (int) $this->is_row_empty( $this->get_row_data( $row['id'], 'footer' )->$device );
                        if( $hide_row ) {
                            $classes[] = 'bt-d-none';
                        }
                        
                        // Mount 'class' attribute output
                        $attributes[] = 'class="'. implode( ' ', $classes ) .'"';

                        // Mount 'style' attribute outut
                        $attributes[] = 'style="'. implode( ' ', $styles ) .'"'; ?>

                        <div <?php echo implode( ' ', $attributes ); ?>>
                            <?php $this->rows_callback( 'footer', $row['id'], $device ); ?>
                        </div>

                    <?php
                    } ?>
                </div>

                <?php do_action( "botiga_before_bhfb_footer_output_close_$device" ); ?>
            </footer>

            <?php 
        }
    }

    /**
     * Header/Footer Builder get number of columns
     */
    public static function get_row_number_of_columns( $columns ) {
        $cols = 0;

        foreach( $columns as $columnComponents ) {
            // if( count( $columnComponents ) > 0 ) {
                $cols++;
            // }
        }
    
        return $cols; 
    }

    /**
     * Check if row is empty (without any component)
     */
    public static function is_row_empty( $columns ) {
        $empty = true;

        foreach( $columns as $columnComponents ) {
            if( count( $columnComponents ) > 0 ) {
                $empty = false;
            }
        }
    
        return $empty; 
    }

    /**
     * Get columns layout class
     */
    public static function get_columns_layout_class( $val ) {
        if( strpos( $val, 'equal' ) !== FALSE ) {
            return 'equal';
        }

        if( strpos( $val, 'bigleft' ) !== FALSE ) {
            return 'bigleft';
        }

        if( strpos( $val, 'bigright' ) !== FALSE ) {
            return 'bigright';
        }
    }

    /**
     * Primary Menu
     */
    public function menu( $params ) {
        require 'components/header/menu/menu.php';
    }

    /**
     * Secondary Menu
     */
    public function secondary_menu( $params ) {
        require 'components/header/secondary-menu/secondary-menu.php';
    }

    /**
     * Footer Menu
     */
    public function footer_menu( $params ) {
        require 'components/footer/menu/menu.php';
    }

    /**
     * Social
     */
    public function social( $params ) {
        require 'components/'. $params[0] .'/social/social.php';
    }

    /**
     * Search icon
     */
    public function search( $params ) {
        require 'components/header/search/search.php';
    }

    /**
     * Search form
     */
    public function search_form( $params ) {
        require 'components/header/search/search-form.php';
    }

    /**
     * Site branding
     */		
    public function logo( $params ) {
        require 'components/'. $params[0] .'/logo/logo.php';
    }

    /**
     * Copyright
     */		
    public function copyright( $params ) {
        require 'components/footer/copyright/copyright.php';
    }

    /**
     * Button
     */		
    public function button( $params ) {
        require 'components/'. $params[0] .'/button/button.php';
    }

    /**
     * Button 2
     */		
    public function button2( $params ) {
        require 'components/'. $params[0] .'/button-2/button.php';
    }

    /**
     * Contact Info
     */		
    public function contact_info( $params ) {
        require 'components/header/contact-info/contact-info.php';
    }

    /**
     * WooCommerce Icons
    */		
    public function woo_icons( $params ) {
        require 'components/header/wc-icons/wc-icons.php';
    }

    /**
     * HTML
    */		
    public function html( $params ) {
        require 'components/'. $params[0] .'/html/html.php';
    }

    /**
     * HTML 2
    */		
    public function html2( $params ) {
        require 'components/'. $params[0] .'/html-2/html.php';
    }

    /**
     * Widget(s)
     */		
    public function widget1( $params ) {
        require 'components/footer/widget-1/widget.php';
    }
    public function widget2( $params ) {
        require 'components/footer/widget-2/widget.php';
    }
    public function widget3( $params ) {
        require 'components/footer/widget-3/widget.php';
    }
    public function widget4( $params ) {
        require 'components/footer/widget-4/widget.php';
    }

    /**
     * Mobile menu trigger
     */
    public function mobile_hamburger( $params ) { 
        require 'components/header/mobile-hamburger/mobile-hamburger.php';
    }

    /**
     * Mobile Offcanvas Menu
     */
    public function mobile_offcanvas_menu( $params ) { 
        require 'components/header/mobile-offcanvas-menu/menu.php';
    }

    /**
     * Polylang Language Switcher
     */
    public function pll_switcher( $params ) { 
        require 'components/header/polylang/polylang-switcher.php';
    }

    /**
     * WPML Language Switcher
     */
    public function wpml_switcher( $params ) { 
        require 'components/header/wpml/wpml-switcher.php';
    }

    /**
     * CSS Output
     */
    public static function custom_css() {

        // We need to require these callbacks here because
        // this function runs on hooks like "after_switch_theme" (out from customizer)
        require_once( get_template_directory() . '/inc/customizer/callbacks.php' );

        $css = '';

        // Header.
        // Structure Components.
        require 'components/header/header-builder/css.php';
        require 'components/header/row/css.php';
        require 'components/header/mobile-offcanvas/css.php';

        // General Components.
        require 'components/header/logo/css.php';
        require 'components/header/menu/css.php';
        require 'components/header/secondary-menu/css.php';
        require 'components/header/search/css.php';
        require 'components/header/wc-icons/css.php';
        require 'components/header/social/css.php';
        require 'components/header/button/css.php';
        require 'components/header/button-2/css.php';
        require 'components/header/contact-info/css.php';
        require 'components/header/mobile-hamburger/css.php';
        require 'components/header/mobile-offcanvas-menu/css.php';

        // Footer.
        // Structure Components.
        require 'components/footer/row/css.php';

        // General Components.
        require 'components/footer/menu/css.php';
        require 'components/footer/copyright/css.php';
        require 'components/footer/social/css.php';
        require 'components/footer/button/css.php';
        require 'components/footer/button-2/css.php';
        require 'components/footer/widget-1/css.php';
        require 'components/footer/widget-2/css.php';
        require 'components/footer/widget-3/css.php';
        require 'components/footer/widget-4/css.php';

        return apply_filters( 'botiga_hf_builder_custom_css', $css );
    }
}

/**
 * Initialize class
 */
Botiga_Header_Footer_Builder::get_instance();