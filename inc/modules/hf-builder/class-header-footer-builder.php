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
                'label' => esc_html__( 'Primary Menu', 'botiga' )
            ),
            array(
                'id'    => 'secondary_menu',
                'label' => esc_html__( 'Secondary Menu', 'botiga' )
            ),
            array(
                'id'    => 'social',
                'label' => esc_html__( 'Social', 'botiga' )
            ),
            array(
                'id'    => 'search',
                'label' => esc_html__( 'Search', 'botiga' )
            ),
            array(
                'id'    => 'logo',
                'label' => esc_html__( 'Site Identity', 'botiga' )
            ),
            array(
                'id'    => 'button',
                'label' => esc_html__( 'Button', 'botiga' )
            ),
            array(
                'id'    => 'contact_info',
                'label' => esc_html__( 'Contact Info', 'botiga' )
            ),
            array(
                'id'    => 'html',
                'label' => esc_html__( 'HTML', 'botiga' )
            )
        );

        // Mobile components.
        $this->mobile_components = array(
            array(
                'id'    => 'mobile_offcanvas_menu',
                'label' => esc_html__( 'Off-Canvas Menu', 'botiga' )
            ),
            array(
                'id'    => 'secondary_menu',
                'label' => esc_html__( 'Secondary Menu', 'botiga' )
            ),
            array(
                'id'    => 'mobile_hamburger',
                'label' => esc_html__( 'Menu Toggle', 'botiga' )
            ),
            array(
                'id'    => 'social',
                'label' => esc_html__( 'Social', 'botiga' )
            ),
            array(
                'id'    => 'search',
                'label' => esc_html__( 'Search', 'botiga' )
            ),
            array(
                'id'    => 'logo',
                'label' => esc_html__( 'Site Identity', 'botiga' )
            ),
            array(
                'id'    => 'button',
                'label' => esc_html__( 'Button', 'botiga' )
            ),
            array(
                'id'    => 'contact_info',
                'label' => esc_html__( 'Contact Info', 'botiga' )
            ),
            array(
                'id'    => 'html',
                'label' => esc_html__( 'HTML', 'botiga' )
            )
        );

        // WooCommerce components.
        if( class_exists( 'Woocommerce' ) ) {
            $this->desktop_components[] = array(
                'id'    => 'woo_icons',
                'label' => esc_html__( 'WooCommerce Icons', 'botiga' )
            );

            $this->mobile_components[] = array(
                'id'    => 'woo_icons',
                'label' => esc_html__( 'WooCommerce Icons', 'botiga' )
            );
        }

        // Footer Components.
        $this->footer_components = array(
            array(
                'id'    => 'copyright',
                'label' => esc_html__( 'Copyright', 'botiga' )
            ),
            array(
                'id'    => 'social',
                'label' => esc_html__( 'Social', 'botiga' )
            ),
            array(
                'id'    => 'button',
                'label' => esc_html__( 'Button 1', 'botiga' )
            ),
            array(
                'id'    => 'html',
                'label' => esc_html__( 'HTML', 'botiga' )
            ),
            array(
                'id'    => 'widget1',
                'label' => esc_html__( 'Widget Area 1', 'botiga' )
            ),
            array(
                'id'    => 'widget2',
                'label' => esc_html__( 'Widget Area 2', 'botiga' )
            ),
            array(
                'id'    => 'widget3',
                'label' => esc_html__( 'Widget Area 3', 'botiga' )
            ),
            array(
                'id'    => 'widget4',
                'label' => esc_html__( 'Widget Area 4', 'botiga' )
            ),
        );

        // Upsell Header Components
        $this->header_upsell_components = array(
            array(
                'id'    => 'button2',
                'label' => esc_html__( 'Button 2', 'botiga' )
            ),
            array(
                'id'    => 'html2',
                'label' => esc_html__( 'HTML 2', 'botiga' )
            ),
            array(
                'id'    => 'social',
                'label' => esc_html__( 'Login/Register', 'botiga' )
            )
        );

        // Upsell Footer Components
        $this->footer_upsell_components = array(
            array(
                'id'    => 'footer_menu',
                'label' => esc_html__( 'Footer Menu', 'botiga' )
            ),
            array(
                'id'    => 'html2',
                'label' => esc_html__( 'HTML 2', 'botiga' )
            ),
            array(
                'id'    => 'button2',
                'label' => esc_html__( 'Button 2', 'botiga' )
            )
        );

        // Header Rows Options
        $this->header_rows = array(
            array(
                'id' => 'above_header_row',
                'label' => esc_html__( 'Above Header Row', 'botiga' ),
                'section' => 'botiga_section_hb_above_header_row',
                'default' => $this->get_row_default_value( 'above_header_row' )
            ),
            array(
                'id' => 'main_header_row',
                'label' => esc_html__( 'Main Header Row', 'botiga' ),
                'section' => 'botiga_section_hb_main_header_row',
                'default' => $this->get_row_default_value( 'main_header_row' )
            ),
            array(
                'id' => 'below_header_row',
                'label' => esc_html__( 'Below Header Row', 'botiga' ),
                'section' => 'botiga_section_hb_below_header_row',
                'default' => $this->get_row_default_value( 'below_header_row' )
            )
        );

        // Footer Rows Options
        $this->footer_rows = array(
            array(
                'id' => 'above_footer_row',
                'label' => esc_html__( 'Above Footer Row', 'botiga' ),
                'section' => 'botiga_section_fb_above_footer_row',
                'default' => $this->get_row_default_value( 'above_footer_row' )
            ),
            array(
                'id' => 'main_footer_row',
                'label' => esc_html__( 'Main Footer Row', 'botiga' ),
                'section' => 'botiga_section_fb_main_footer_row',
                'default' => $this->get_row_default_value( 'main_footer_row' )
            ),
            array(
                'id' => 'below_footer_row',
                'label' => esc_html__( 'Below Footer Row', 'botiga' ),
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

        add_action( 'customize_controls_print_footer_scripts', function() {
            echo '<aside class="widget-area"></aside>';
        });
        
        
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_filter( 'body_class', array( $this, 'body_class' ) );

        remove_all_actions( 'botiga_header' );
        add_action( 'botiga_header', array( $this, 'header_front_output' ) );

        remove_all_actions( 'botiga_footer' );
        add_action( 'botiga_footer', array( $this, 'footer_front_output' ) );

        // Header Image (customize > header > header image)
        add_action( 'botiga_header', array( $this, 'header_image' ), 30 );
    }

    /**
     * Enqueue Admin Scripts
     */
    public function admin_enqueue_scripts() {
        wp_enqueue_script( 'jquery-ui-sortable' );

        wp_enqueue_style( 'botiga-bhfb', get_template_directory_uri() . '/assets/css/admin/botiga-bhfb.min.css', array(), BOTIGA_VERSION );
        wp_enqueue_script( 'botiga-bhfb', get_template_directory_uri() . '/assets/js/admin/botiga-bhfb.min.js', array(), BOTIGA_VERSION, true );
        wp_localize_script( 'botiga-bhfb', 'botiga_hfb', array(
            'rows' => array(
                'defaults' => array(
                    'above_header_row' => $this::get_row_default_value( 'above_header_row' ),
                    'main_header_row'  => $this::get_row_default_value( 'main_header_row' ),
                    'below_header_row' => $this::get_row_default_value( 'below_header_row' ),
                    'mobile_offcanvas' => $this::get_row_default_value( 'mobile_offcanvas' ),
                    'above_footer_row' => $this::get_row_default_value( 'above_footer_row' ),
                    'main_footer_row'  => $this::get_row_default_value( 'main_footer_row' ),
                    'below_footer_row' => $this::get_row_default_value( 'below_footer_row' )
                )
            ),
            'components' => array(
                'desktop' => apply_filters( 'botiga_header_builder_desktop_components', $this->desktop_components ),
                'mobile'  => apply_filters( 'botiga_header_builder_mobile_components', $this->mobile_components ),
                'footer'  => apply_filters( 'botiga_header_builder_footer_components', $this->footer_components )
            ),
            'upsell_components' => array(
                'enable' => ! defined( 'BOTIGA_AWL_ACTIVE' ) && ! defined( 'BOTIGA_PRO_VERSION' ) ? true : false,
                'header' => apply_filters( 'botiga_header_builder_upsell_components', $this->header_upsell_components ),
                'footer' => apply_filters( 'botiga_header_builder_footer_upsell_components', $this->footer_upsell_components ),
                'title'  => esc_html__( 'PRO Components', 'botiga' ),
                'total'  => esc_html__( '13+ Components Available', 'botiga' ),
                'button' => esc_html__( 'Get Botiga Pro Now!', 'botiga' ),
                'link'   => 'https://athemes.com/botiga-upgrade?utm_source=theme_customizer_deep&utm_medium=button&utm_campaign=Botiga'
            ),
            'header_presets' => $this->header_presets_values(),
            'i18n' => array(
                'elementsMessage' => esc_html__( 'It looks like you already is using all available components.', 'botiga' )
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
                'title'      => esc_html__( 'Header Builder', 'botiga' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Above Header Row Section
        $wp_customize->add_section(
            'botiga_section_hb_above_header_row',
            array(
                'title'      => esc_html__( 'Above Header Row', 'botiga' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Main Header Row Section
        $wp_customize->add_section(
            'botiga_section_hb_main_header_row',
            array(
                'title'      => esc_html__( 'Main Header Row', 'botiga' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Below Header Row Section
        $wp_customize->add_section(
            'botiga_section_hb_below_header_row',
            array(
                'title'      => esc_html__( 'Below Header Row', 'botiga' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Header Builder Mobile Offcanvas Header Section
        $wp_customize->add_section(
            'botiga_section_hb_mobile_offcanvas',
            array(
                'title'      => esc_html__( 'Mobile Offcanvas', 'botiga' ),
                'panel'      => 'botiga_panel_header'
            )
        );

        // Components
        // @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        require get_template_directory() . '/inc/modules/hf-builder/components/header/button/customize-options.php'; 
        require get_template_directory() . '/inc/modules/hf-builder/components/header/contact-info/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/menu/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/secondary-menu/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/social/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/search/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/logo/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/wc-icons/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/html/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-hamburger/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-offcanvas-menu/customize-options.php';

        // Structure Components.
        require get_template_directory() . '/inc/modules/hf-builder/components/header/header-builder/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/row/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/columns/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-offcanvas/customize-options.php';
        // @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    public function footer_customizer_options( $wp_customize ) {

        // Remove sections
        $wp_customize->remove_section('botiga_section_footer_widgets');
        $wp_customize->remove_section('botiga_section_footer_credits');

        // Footer Builder Wrapper
        $wp_customize->add_section(
            'botiga_section_fb_wrapper',
            array(
                'title'      => esc_html__( 'Footer Builder', 'botiga' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Footer Builder Above Footer Row Section
        $wp_customize->add_section(
            'botiga_section_fb_above_footer_row',
            array(
                'title'      => esc_html__( 'Above Footer Row', 'botiga' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Footer Builder Main Footer Row Section
        $wp_customize->add_section(
            'botiga_section_fb_main_footer_row',
            array(
                'title'      => esc_html__( 'Main Footer Row', 'botiga' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Footer Builder Below Footer Row Section
        $wp_customize->add_section(
            'botiga_section_fb_below_footer_row',
            array(
                'title'      => esc_html__( 'Below Footer Row', 'botiga' ),
                'panel'      => 'botiga_panel_footer'
            )
        );

        // Components.
        // @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/social/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/copyright/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/button/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/html/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-1/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-2/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-3/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-4/customize-options.php';

        // Structure Components.
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/footer-builder/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/row/customize-options.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/columns/customize-options.php';
        // @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

    }

    /**
     * Header Presets Values
     */
    public function header_presets_values() {
        return array(
            'header_layout_1' => array(
                'above_row' => '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
                'main_row'  => '{ "desktop": [["menu"], ["logo"], ["search","woo_icons"]], "mobile": [["mobile_hamburger"], ["logo"], ["search", "woo_icons"]], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }',
                'below_row' => '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
            ),
            'header_layout_2' => array(
                'above_row' => '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
                'main_row'  => '{ "desktop": [["logo"], ["menu","search","woo_icons"]], "mobile": [["mobile_hamburger"], ["logo"], ["search", "woo_icons"]], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }',
                'below_row' => '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
            ),
            'header_layout_3' => array(
                'above_row' => '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
                'main_row'  => '{ "desktop": [["search"], ["logo"], ["woo_icons"]], "mobile": [["mobile_hamburger"], ["logo"], ["search", "woo_icons"]], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }',
                'below_row' => '{ "desktop": [["menu"]], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
            ),
            'header_layout_4' => array(
                'above_row' => '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
                'main_row'  => '{ "desktop": [["logo"], ["search"]], "mobile": [["mobile_hamburger"], ["logo"], ["search", "woo_icons"]], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }',
                'below_row' => '{ "desktop": [["menu"],["woo_icons"]], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
            ),
            'header_layout_5' => array(
                'above_row' => '{ "desktop": [[], [], []], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
                'main_row'  => '{ "desktop": [["search"], ["logo"], ["woo_icons"]], "mobile": [["mobile_hamburger"], ["logo"], ["search", "woo_icons"]], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }',
                'below_row' => '{ "desktop": [["menu"],["button"]], "mobile": [[], [], []], "mobile_offcanvas": [[]] }',
            )
        );
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
                    $default = '{ "desktop": [["menu"], ["logo"], ["search", "woo_icons"]], "mobile": [["search"], ["logo"], ["woo_icons", "mobile_hamburger"]] }';
                } else {
                    $default = '{ "desktop": [["menu"], ["logo"], ["search"]], "mobile": [["search"], ["logo"], ["mobile_hamburger"]] }';
                }
                break;

            case 'mobile_offcanvas':
                $default = '{ "desktop": [], "mobile": [], "mobile_offcanvas": [["mobile_offcanvas_menu"]] }';
                break;

            case 'main_footer_row':
                $default = '{ "desktop": [[], [], []], "mobile": [[], [], []] }';
                break;

            case 'below_footer_row':
                $default = '{ "desktop": [["copyright"]], "mobile": [[], [], []] }';
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
            <button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'botiga' ); ?>"
                    title="<?php esc_attr_e( 'Click to edit this element.', 'botiga' ); ?>"
                    class="customize-partial-edit-shortcut-button bhfb-item-customizer-focus">
                <?php echo botiga_get_svg_icon( 'icon-edit' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </button>
        </div>
        <?php
    }

    /**
     * Edit column icon inside customizer.
     */
    public static function customizer_edit_column_button( $builderType, $row, $column_id ) {
        if( !is_customize_preview() ) {
            return;
        } 
        
        // Mount customize column setting id.
        $columnOptionID = 'botiga_'. $builderType .'_row__'. $row .'_column' . $column_id; ?>

        <div class="customize-partial-edit-shortcut bhfb-customize-partial-edit-column-shortcut" data-section-id="<?php echo esc_attr( $columnOptionID ); ?>">
            <button aria-label="<?php esc_attr_e( 'Click to edit this element.', 'botiga' ); ?>"
                    title="<?php esc_attr_e( 'Click to edit this element.', 'botiga' ); ?>"
                    class="customize-partial-edit-shortcut-button bhfb-item-customizer-focus">
            <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="15" fill="#FFF"/><rect x="7" width="2" height="15" fill="#FFF"/><rect y="3" width="3" height="16" transform="rotate(-90 0 3)" fill="#FFF"/><rect y="15" width="2" height="16" transform="rotate(-90 0 15)" fill="#FFF"/><rect x="14" width="2" height="15" fill="#FFF"/></svg>
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
                        <?php echo esc_html__( 'Desktop', 'botiga' ); ?>
                    </a>
                </div>
                <div class="botiga-bhfb-device">
                    <a href="#" class="botiga-bhfb-device-link" data-device="tablet">
                        <span class="dashicons dashicons-smartphone"></span>
                        <?php echo esc_html__( 'Tablet/Mobile', 'botiga' ); ?>
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
                                <span class="title"><?php echo esc_html__( 'TOP ROW', 'botiga' ); ?></span>
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
                                <span class="title"><?php echo esc_html__( 'MAIN ROW', 'botiga' ); ?></span>
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
                                <span class="title"><?php echo esc_html__( 'BOTTOM ROW', 'botiga' ); ?></span>
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
                            <span class="title"><?php echo esc_html__( 'OFFCANVAS', 'botiga' ); ?></span>
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
                                <span class="title"><?php echo esc_html__( 'TOP ROW', 'botiga' ); ?></span>
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
                                <span class="title"><?php echo esc_html__( 'MAIN ROW', 'botiga' ); ?></span>
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
                                <span class="title"><?php echo esc_html__( 'BOTTOM ROW', 'botiga' ); ?></span>
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
                        <?php echo esc_html__( 'Show', 'botiga' ); ?>
                    </div>
                    <div class="botiga-bhfb-bottom-display-hide">
                        <span class="dashicons dashicons-arrow-down-alt2"></span>
                        <?php echo esc_html__( 'Hide', 'botiga' ); ?>
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

            <?php do_action( 'botiga_before_header' ); ?>

            <header class="bhfb bhfb-header bhfb-<?php echo esc_attr( $device ); ?><?php echo ( $device === 'desktop' && $sticky_header ? ' has-sticky-header sticky-' . esc_attr( $sticky_header_type ) . ' sticky-row-' . esc_attr( $sticky_row ) : '' ); ?>"<?php echo $device === 'desktop' && ! empty($sticky_header_styles) ? 'style="' . esc_attr( implode( ' ', $sticky_header_styles ) ) . '"' : ''; ?>> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

                <?php do_action( 'botiga_bhfb_header_inner_before' ); ?>

                <div class="bhfb-rows">
                    <?php
                    foreach( $this->header_rows as $row ) { 
                        if( $this->get_row_data( $row['id'], 'header' ) === NULL ) {
                            continue;
                        }

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
                        $attributes[] = 'class="'. esc_attr( implode( ' ', $classes ) ) .'"';

                        // Mount 'style' attribute outut
                        $attributes[] = 'style="'. esc_attr( implode( ' ', $styles ) ) .'"'; ?>

                        <div <?php echo implode( ' ', $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

                            <?php do_action( "botiga_bhfb_header_{$row['id']}_before" ); ?>

                            <?php $this->rows_callback( 'header', $row['id'], $device ); ?>

                            <?php do_action( "botiga_bhfb_header_{$row['id']}_after" ); ?>
                        </div>

                    <?php
                    } ?>
                </div>

                <?php $this->search_form( 'header' ); ?>

                <?php do_action( 'botiga_bhfb_header_inner_after' ); ?>

                <?php do_action( "botiga_before_bhfb_header_output_close_$device" ); ?>
            </header>

            <?php do_action( 'botiga_after_header' ); ?>

            <?php 
        } ?>

        <div class="bhfb bhfb-mobile_offcanvas botiga-offcanvas-menu">
            <a class="mobile-menu-close" href="#" title="<?php echo esc_attr( 'Close mobile menu', 'botiga' ); ?>"><i class="ws-svg-icon icon-cancel"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i></a>
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

                <?php do_action( 'botiga_bhfb_footer_inner_before' ); ?>

                <div class="bhfb-rows">
                    <?php
                    foreach( $this->footer_rows as $row ) { 
                        if( $this->get_row_data( $row['id'], 'footer' ) === NULL ) {
                            continue;
                        }
                        
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
                        $attributes[] = 'class="'. esc_attr( implode( ' ', $classes ) ) .'"';

                        // Mount 'style' attribute outut
                        $attributes[] = 'style="'. esc_attr( implode( ' ', $styles ) ) .'"'; ?>

                        <div <?php echo implode( ' ', $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>

                            <?php do_action( "botiga_bhfb_footer_{$row['id']}_before" ); ?>

                            <?php $this->rows_callback( 'footer', $row['id'], $device ); ?>

                            <?php do_action( "botiga_bhfb_footer_{$row['id']}_after" ); ?>
                        </div>

                    <?php
                    } ?>
                </div>
                
                <?php do_action( 'botiga_bhfb_footer_inner_after' ); ?>

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
            $cols++;
        }
    
        return $cols; 
    }

    /**
     * Check if row is empty (without any component)
     */
    public static function is_row_empty( $columns ) {
        $empty = true;

        foreach( $columns as $columnComponents ) {
            if( is_array( $columnComponents ) && count( $columnComponents ) > 0 ) {
                $empty = false;
            }
        }
    
        return $empty; 
    }

    /**
     * Get columns layout class
     */
    public static function get_columns_layout_class( $val ) {
        $classes = array();

        if( strpos( $val, 'equal' ) !== FALSE ) {
            $classes[] = 'bhfb-cols-layout-equal';
        }

        if( strpos( $val, 'fluid' ) !== FALSE ) {
            $classes[] = 'bhfb-cols-layout-fluid';
        }

        if( strpos( $val, 'bigleft' ) !== FALSE ) {
            $classes[] = 'bhfb-cols-layout-bigleft';
        }

        if( strpos( $val, 'bigright' ) !== FALSE ) {
            $classes[] = 'bhfb-cols-layout-bigright';
        }

        return implode( ' ', $classes );
    }

    /**
     * Get columns layout class (responsive)
     */
    public static function get_columns_layout_class_responsive( $mod, $default ) {
        $classes = array();

        $devices = array( 'desktop', 'tablet' );

        foreach( $devices as $device ) {
            $val = get_theme_mod( $mod . '_' . $device, $default );

            if( strpos( $val, 'equal' ) !== FALSE ) {
                $classes[] = 'bhfb-cols-layout-equal-' . $device;
            }

            if( strpos( $val, 'fluid' ) !== FALSE ) {
                $classes[] = 'bhfb-cols-layout-fluid-' . $device;
            }
    
            if( strpos( $val, 'bigleft' ) !== FALSE ) {
                $classes[] = 'bhfb-cols-layout-bigleft-' . $device;
            }
    
            if( strpos( $val, 'bigright' ) !== FALSE ) {
                $classes[] = 'bhfb-cols-layout-bigright-' . $device;
            }
        }

        return implode( ' ', $classes );
    }

    /**
     * Get rows columns layout default customizer value
     */
    public static function get_row_columns_layout_default_customizer_value( $row ) {
        $default = '3col-equal';

        if( $row === 'main_footer_row' ) {
            $default = '3col-bigleft';
        }

        return $default;
    }

    /**
     * Get rows height default customizer value
     */
    public static function get_row_height_default_customizer_value( $row ) {
        $default = 100;

        if( $row === 'main_footer_row' ) {
            $default = 280;
        }

        return $default;
    }

    /**
     * Get rows border default customizer value
     */
    public static function get_row_border_default_customizer_value( $row ) {
        $default = 0;

        if( $row === 'below_footer_row' ) {
            $default = 1;
        }

        return $default;
    }

    /**
     * Get rows column default customizer value
     */
    public static function get_row_column_default_customizer_value( $row, $column_id, $setting_id ) {
        $default = '';

        // Vertical Alignment.
        if( $setting_id === 'vertical_alignment' ) {
            $default = 'middle';

            if( strpos( $row, 'footer' ) !== FALSE ) {
                $default = 'top';
            }
        }

        // Inner Layout.
        if( $setting_id === 'inner_layout' ) {
            $default = 'inline';

            if( strpos( $row, 'footer' ) !== FALSE ) {
                $default = 'stack';
            }
        }

        // Horizontal Alignment.
        if( $setting_id === 'horizontal_alignment' ) {
            $default = 'start';
            
            if( $row === 'main_header_row' ) {
                if( $column_id === 2 ) {
                    $default = 'center';
                }

                if( $column_id === 3 ) {
                    $default = 'end';
                }
            }

            if( $row === 'below_footer_row' && $column_id === 1 ) {
                $default = 'start';
            }
        }

        return $default;
    }

    /**
     * Convert CSS value
     */
    public static function convert_column_css_value( $value ) {
        switch ( $value ) {
            case 'top':
            case 'start':
                $value = 'flex-start';
                break;

            case 'middle':
                $value = 'center';
                break;

            case 'bottom':
            case 'end':
                $value = 'flex-end';
                break;

            case 'stack':
                $value = 'column';
                break;

            case 'inline':
                $value = 'row';
                break;
            
        }

        return $value;
    }

    /**
     * Convert css alignment props.
     */
    public static function convert_column_css_alignment_prop( $prop, $row, $column ) {

        // Get 'Inner Layout' to check and convert according to.
        $default = self::get_row_column_default_customizer_value( $row, $column, 'inner_layout' );
        $inner_layout = get_theme_mod( $column . 'inner_layout', $default );

        if( $inner_layout === 'stack' ) {
            if( $prop === 'align-items' ) {
                $prop = 'justify-content';
            }
        }

        return $prop;
    }

    /**
     * Generate responsive css output (specific to header/footer builder).
     */
    public static function get_responsive_css( $setting = '', $defaults = array(), $selector = '', $css_prop = '', $unit = 'px', $row = '', $column = '' ) {
        $devices 	= array( 
            'desktop' 	=> '@media (min-width: 992px)',
            'tablet'	=> '@media (min-width: 576px) and (max-width:  991px)',
            'mobile'	=> '@media (max-width: 575px)'
        );

        $css = '';
        $new_css_prop = '';

        // Get 'Inner Layout' default values.
        $default = self::get_row_column_default_customizer_value( $row, $column, 'inner_layout' );

        foreach ( $devices as $device => $media ) {
            $mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
            $mod = self::convert_column_css_value( $mod );

            if( $row && $column ) {
                
                // Get 'Inner Layout' to check and convert according to its value.
                $inner_layout = get_theme_mod( $column . '_inner_layout' . '_' . $device, $default );

                // Stack.
                if( $inner_layout === 'stack' ) {

                    // Vertical and Horizontal alignment.
                    if( $css_prop === 'align-items' ) {
                        $new_css_prop = 'justify-content';
                    } else if( $css_prop === 'justify-content' ) {
                        $new_css_prop = 'align-items';
                    }

                    // Elements Spacing.
                    if( $css_prop === 'margin-left' ) {
                        $new_css_prop = 'margin-top';
                    } else if( $css_prop === 'margin-top' ) {
                        $new_css_prop = 'margin-left';
                    }

                // Inline.
                } else {

                    // Elements Spacing.
                    if( $css_prop === 'margin-top' ) {
                        $new_css_prop = 'margin-left';
                    }

                }
                
            }

            if( ! $unit ) {
                $mod  = esc_attr( $mod );
                $unit = '';
            } else {
                $mod = intval( $mod );
            }

            // If new css prop is empty, then it should reveive the default css prop value.
            if( ! $new_css_prop ) {
                $new_css_prop = $css_prop;
            }

            $css .= $media . ' { ' . $selector . ' { ' . $new_css_prop . ':' . $mod . $unit . '; } }' . "\n";	
        }

        return $css;
    }

    /**
     * Core header image
     */
    public function header_image() {
        $show_header_image_only_home = get_theme_mod( 'show_header_image_only_home', 0 );

        // output
        $output = '<div class="header-image">';
            $output .= get_header_image_tag();
        $output .= '</div>';

        if ( ! botiga_get_display_conditions( 'header_image_display_conditions', false, '[{"type":"include","condition":"all","id":null}]' ) ) {
            return;
        }

        echo wp_kses_post( $output );
    }

    /**
     * Primary Menu
     */
    public function menu( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/header/menu/menu.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Secondary Menu
     */
    public function secondary_menu( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/header/secondary-menu/secondary-menu.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Social
     */
    public function social( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/'. $params[0] .'/social/social.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Search icon
     */
    public function search( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/header/search/search.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Search form
     */
    public function search_form( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/header/search/search-form.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Site branding
     */		
    public function logo( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/'. $params[0] .'/logo/logo.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Copyright
     */		
    public function copyright( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/copyright/copyright.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Button
     */		
    public function button( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/'. $params[0] .'/button/button.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Contact Info
     */		
    public function contact_info( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/header/contact-info/contact-info.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * WooCommerce Icons
    */		
    public function woo_icons( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/header/wc-icons/wc-icons.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * HTML
     */		
    public function html( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/'. $params[0] .'/html/html.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Widget(s)
     */		
    public function widget1( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-1/widget.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }
    public function widget2( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-2/widget.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }
    public function widget3( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-3/widget.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }
    public function widget4( $params ) {
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-4/widget.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Mobile menu trigger
     */
    public function mobile_hamburger( $params ) { 
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-hamburger/mobile-hamburger.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * Mobile Offcanvas Menu
     */
    public function mobile_offcanvas_menu( $params ) { 
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-offcanvas-menu/menu.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
    }

    /**
     * CSS Output
     */
    public static function custom_css() {

        // We need to require these callbacks here because
        // this function runs on hooks like "after_switch_theme" (out from customizer)
        // @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        require_once get_template_directory() . '/inc/customizer/callbacks.php';

        $css = '';

        // Header.
        // Structure Components.
        require get_template_directory() . '/inc/modules/hf-builder/components/header/header-builder/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/row/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/columns/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-offcanvas/css.php';

        // General Components.
        require get_template_directory() . '/inc/modules/hf-builder/components/header/logo/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/menu/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/secondary-menu/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/search/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/wc-icons/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/social/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/button/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/contact-info/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-hamburger/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-offcanvas-menu/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/header/html/css.php';

        // Footer.
        // Structure Components.
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/row/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/columns/css.php';

        // General Components.
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/copyright/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/social/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/button/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-1/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-2/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-3/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/widget-4/css.php';
        require get_template_directory() . '/inc/modules/hf-builder/components/footer/html/css.php';
        // @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

        return apply_filters( 'botiga_hf_builder_custom_css', $css );
    }
}

/**
 * Initialize class
 */
Botiga_Header_Footer_Builder::get_instance();