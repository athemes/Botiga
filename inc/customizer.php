<?php
/**
 * Botiga Theme Customizer
 *
 * @package Botiga
 */

if ( !class_exists( 'Botiga_Customizer' ) ) {
	class Botiga_Customizer {

		/**
		 * Instance
		 */     
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {     
			add_action( 'init', array( $this, 'customize_wp_init' ) );
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ), 99 );
			add_action( 'customize_controls_print_scripts', array( $this, 'styles' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'scripts' ) );
		}

		/**
		 * Ajax callbacks
		 */
		function customize_wp_init() {
			require get_template_directory() . '/inc/customizer/ajax-callbacks.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/inc/customizer/controls/display-conditions/display-conditions-script-template.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}

		/**
		 * Options
		 */     
		function customize_register( $wp_customize ) {

			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/inc/customizer/controls/typography/class_botiga_typography.php';
			require get_template_directory() . '/inc/customizer/controls/typography-adobe/class_botiga_typography_adobe.php';
			require get_template_directory() . '/inc/customizer/controls/typography-adobe/class_botiga_typography_adobe_kits.php';
			require get_template_directory() . '/inc/customizer/controls/repeater/class_botiga_repeater.php';
			require get_template_directory() . '/inc/customizer/controls/alpha-color/class_botiga_alpha_color.php';
			require get_template_directory() . '/inc/customizer/controls/radio-images/class_botiga_radio_images.php';
			require get_template_directory() . '/inc/customizer/controls/radio-buttons/class_botiga_radio_buttons.php';
			require get_template_directory() . '/inc/customizer/controls/responsive-slider/class_botiga_responsive_slider.php';
			require get_template_directory() . '/inc/customizer/controls/select2/class_botiga_select2.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_tab_control.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_text_control.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_tinymce_control.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_create_page_control.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_divider_control.php';
			require get_template_directory() . '/inc/customizer/controls/toggle/class_botiga_toggle_control.php';
			require get_template_directory() . '/inc/customizer/controls/color-palettes/class_botiga_color_palettes_control.php';
			require get_template_directory() . '/inc/customizer/controls/color-palettes/class_botiga_custom_palettes_control.php';
			require get_template_directory() . '/inc/customizer/controls/accordion/class_botiga_accordion_control.php';
			require get_template_directory() . '/inc/customizer/controls/display-conditions/class_botiga_display_conditions_control.php';
			require get_template_directory() . '/inc/customizer/controls/custom-sidebars/class_botiga_custom_sidebars_control.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_section.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_title_section.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_panel_upsell.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_section_upsell.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_section_upsell_message.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_typography_preview_control.php';
			require get_template_directory() . '/inc/customizer/controls/class_botiga_text_style_control.php';
			require get_template_directory() . '/inc/customizer/controls/color-group/class_botiga_color_group.php';
			require get_template_directory() . '/inc/customizer/controls/custom-fonts/class_botiga_custom_fonts_control.php';
			require get_template_directory() . '/inc/customizer/controls/custom-fonts/class_botiga_typography_custom_control.php';
			require get_template_directory() . '/inc/customizer/controls/dimensions/class_botiga_dimensions_control.php';
			require get_template_directory() . '/inc/customizer/controls/multi-list-toggle/class_botiga_multi_list_toggle_control.php';
			if( ! defined( 'BOTIGA_PRO_VERSION' ) ) {
				require get_template_directory() . '/inc/customizer/controls/class_botiga_upsell_message.php';
			}
			// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			$wp_customize->register_panel_type( 'Botiga_Panel_Upsell' );
			$wp_customize->register_section_type( 'Botiga_Section_Upsell' );
			$wp_customize->register_section_type( 'Botiga_Section_Upsell_Message' );

			$wp_customize->register_control_type( '\Kirki\Control\sortable' );
			$wp_customize->register_control_type( 'Botiga_Multi_List_Toggle_Control' );

			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_section( 'title_tagline' )->priority     = 1;
			$wp_customize->get_section( 'title_tagline' )->panel        = 'botiga_panel_header';
			$wp_customize->get_section( 'header_image' )->panel         = 'botiga_panel_header';

			$wp_customize->remove_control( 'header_textcolor' );

			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/inc/customizer/sanitize.php';
			require_once get_template_directory() . '/inc/customizer/callbacks.php';
			require get_template_directory() . '/inc/customizer/options/navigation.php';
			require get_template_directory() . '/inc/customizer/options/layout.php';
			require get_template_directory() . '/inc/customizer/options/buttons.php';
			require get_template_directory() . '/inc/customizer/options/scrolltotop.php';
			require get_template_directory() . '/inc/customizer/options/blog.php';
			require get_template_directory() . '/inc/customizer/options/blog-single.php';
			require get_template_directory() . '/inc/customizer/options/topbar.php';
			require get_template_directory() . '/inc/customizer/options/header.php';
			require get_template_directory() . '/inc/customizer/options/header-mobile.php';
			require get_template_directory() . '/inc/customizer/options/footer.php';
			require get_template_directory() . '/inc/customizer/options/colors.php';
			require get_template_directory() . '/inc/customizer/options/performance.php';
			if ( class_exists( 'WooCommerce' ) ) {
				require get_template_directory() . '/inc/customizer/options/woocommerce/woocommerce-general.php';
				require get_template_directory() . '/inc/customizer/options/woocommerce/woocommerce-shop-archive.php';
				require get_template_directory() . '/inc/customizer/options/woocommerce/woocommerce-single.php';
				require get_template_directory() . '/inc/customizer/options/woocommerce/woocommerce-cart.php';
				require get_template_directory() . '/inc/customizer/options/woocommerce/woocommerce-checkout.php';
				require get_template_directory() . '/inc/customizer/options/woocommerce/woocommerce-search.php';
				require get_template_directory() . '/inc/customizer/options/woocommerce/woocommerce-store-notice.php';
			}
			require get_template_directory() . '/inc/customizer/options/typography.php';
			if( ! defined( 'BOTIGA_PRO_VERSION' ) ) {
				require get_template_directory() . '/inc/customizer/options/upsell.php';
			}
			// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound	


			if ( isset( $wp_customize->selective_refresh ) ) {
				$wp_customize->selective_refresh->add_partial(
					'blogname',
					array(
						'selector'        => '.site-title a',
						'render_callback' => 'botiga_customize_partial_blogname',
						'container_inclusive' => false,
					)
				);
				$wp_customize->selective_refresh->add_partial(
					'blogdescription',
					array(
						'selector'        => '.site-description',
						'render_callback' => 'botiga_customize_partial_blogdescription',
						'container_inclusive' => false,
					)
				);
				$wp_customize->selective_refresh->add_partial( 
					'social_profiles_footer', 
					array(
						'selector'          => '.site-info .social-profile',
						'render_callback'   => function() { botiga_social_profile( 'social_profiles_footer' ); },
						'container_inclusive' => false,
					) 
				); 
				$wp_customize->selective_refresh->add_partial( 
					'footer_credits', 
					array(
						'selector'          => '.site-info .botiga-credits',
						'render_callback'   => 'botiga_customize_partial_footer_credits',
						'container_inclusive' => false,
					) 
				); 
			}
		}

		public function customize_preview_js() {
			wp_enqueue_script( 'botiga-customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'jquery', 'customize-preview' ), BOTIGA_VERSION, true );
		}       

		public function styles() {

			$fonts_library = get_theme_mod( 'fonts_library', 'google' );
			
			if( $fonts_library === 'google' ) {
				wp_enqueue_style( 'botiga-google-fonts', botiga_google_fonts_url(), array(), botiga_google_fonts_version() );
			} elseif ( $fonts_library === 'custom' ) {
				wp_enqueue_style( 'botiga-custom-google-fonts', botiga_custom_google_fonts_url(), array(), botiga_google_fonts_version() );
			} else {
				$kits = get_option( 'botiga_adobe_fonts_kits', array() );
				foreach ( $kits as $kit_id => $kit_data ) {
					// phpcs:ignore Universal.Operators.StrictComparisons.LooseEqual
					if ( $kit_data['enable'] == false ) {
						continue;
					}
					wp_enqueue_style( 'botiga-typekit-' . $kit_id, 'https://use.typekit.net/' . $kit_id . '.css', array(), BOTIGA_VERSION );
				}
			}

			wp_enqueue_style( 'botiga-customizer-styles', get_template_directory_uri() . '/assets/css/customizer.min.css', array(), BOTIGA_VERSION );

			// Add RTL support.
			if ( is_rtl() ) {
				wp_enqueue_style( 'botiga-customizer-styles-rtl', get_template_directory_uri() . '/assets/css/customizer-rtl.min.css', array(), BOTIGA_VERSION );
			}
		}

		public function scripts() {

			wp_enqueue_script( 'botiga-customizer-scripts', get_template_directory_uri() . '/assets/js/customizer-scripts.min.js', array( 'jquery', 'jquery-ui-core' ), BOTIGA_VERSION, true );

			wp_localize_script( 'botiga-customizer-scripts', 'ajax_object', array(
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'botiga_ajax_nonce' ),
			) );
		}
	}
}

//Initiate
Botiga_Customizer::get_instance();

require get_template_directory() . '/inc/customizer-helpers.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
