<?php
/**
 * Merchant Compatibility File
 *
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Merchant' ) ) {
	return;
}

if ( defined( 'MERCHANT_VERSION' ) && version_compare( MERCHANT_VERSION, '1.9.2', '<=' ) ) {
	return;
}

class Botiga_Merchant_Single_Product_Elements {

	/**
	 * Modules data.
	 * 
	 */
	public static $modules_data = array(
		'payment-logos' => array(
			'class'            => 'Merchant_Payment_Logos',
			'callback'         => 'botiga_merchant_payment_logos',
		),
		'trust-badges' => array(
			'class'            => 'Merchant_Trust_Badges',
			'callback'         => 'botiga_merchant_trust_badges',
		),
		'product-bundles' => array(
			'class'             => 'Merchant_Product_Bundles',
			'callback'          => 'botiga_merchant_product_bundles',
		),
		'buy-x-get-y' => array(
			'class'             => 'Merchant_Buy_X_Get_Y',
			'callback'          => 'botiga_merchant_buy_x_get_y',
		),
		'volume-discounts' => array(
			'class'             => 'Merchant_Volume_Discounts',
			'callback'          => 'botiga_merchant_volume_discounts',
		),
		'wait-list' => array(
			'class'             => 'Merchant_Wait_List',
			'callback'          => 'botiga_merchant_wait_list',
		),
		'stock-scarcity' => array(
			'class'             => 'Merchant_Stock_Scarcity',
			'callback'          => 'botiga_merchant_stock_scarcity',
		),
		'reasons-to-buy' => array(
			'class'             => 'Merchant_Reasons_To_Buy',
			'callback'          => 'botiga_merchant_reasons_to_buy',
		),
		'product-brand-image' => array(
			'class'             => 'Merchant_Product_Brand_Image',
			'callback'          => 'botiga_merchant_product_brand_image',
		),
		'size-chart' => array(
			'class'             => 'Merchant_Size_Chart',
			'callback'          => 'botiga_merchant_size_chart',
		),
	);

	/**
	 * Get module title.
	 * 
	 * @param string $module_id Module ID.
	 * 
	 * @return string
	 */
	public static function get_module_title( $module_id ) {
		$titles = array(
			'payment-logos'       => esc_html__( 'Merchant: Payment Logos', 'botiga' ),
			'trust-badges'        => esc_html__( 'Merchant: Trust Badges', 'botiga' ),
			'product-bundles'     => esc_html__( 'Merchant: Product Bundles', 'botiga' ),
			'buy-x-get-y'         => esc_html__( 'Merchant: Buy X Get Y', 'botiga' ),
			'volume-discounts'    => esc_html__( 'Merchant: Bulk Discounts', 'botiga' ),
			'wait-list'           => esc_html__( 'Merchant: Waitlist', 'botiga' ),
			'stock-scarcity'      => esc_html__( 'Merchant: Stock Scarcity', 'botiga' ),
			'reasons-to-buy'      => esc_html__( 'Merchant: Reasons To Buy', 'botiga' ),
			'product-brand-image' => esc_html__( 'Merchant: Product Brand Image', 'botiga' ),
			'size-chart'          => esc_html__( 'Merchant: Size Chart', 'botiga' ),
		);
		
		return $titles[ $module_id ];
	}

	/**
	 * Get module admin field description.
	 * 
	 * @param string $module_id Module ID.
	 * @param string $setting_id Setting ID.
	 * 
	 * @return string
	 */
	public static function get_module_admin_field_descriptions() {
		$customizer_section_url = admin_url( 'customize.php?autofocus[section]=botiga_section_single_product_layout' );
		$default_desc           = sprintf(
			/* Translators: 1. Customizer link. 2. Link text. */
			__( 'The display is being controlled by Botiga under <a href="%1$s" target="_blank">%2$s</a>', 'botiga' ),
			$customizer_section_url,
			__( 'Customizer > WooCommerce > Single Product (Elements)', 'botiga' )
		);

		return array(
			'buy-x-get-y'   => array(
				'single_product_placement' => $default_desc,
			),
			'volume-discounts'   => array(
				'single_product_placement' => $default_desc,
			),
			'product-bundles' => array(
				'placement' => $default_desc,
			),
			'stock-scarcity' => array(
				'single_product_placement' => $default_desc,
			),
			'reasons-to-buy' => array(
				'placement' => $default_desc,
			),
		);
	}

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {

		/**
		 * Hook 'botiga_merchant_modules_single_product_integration'
		 * Filters whether to integrate Merchant modules with Botiga single product elements.
		 * 
		 * @since 2.2.1
		 */
		if ( ! apply_filters( 'botiga_merchant_modules_single_product_integration', true ) ) {
			return;
		}

		if ( ! get_option( 'botiga_merchant_modules_single_product_integration', true ) ) {
			return;
		}

		add_action( 'merchant_admin_module_activated', array( $this, 'add_module_to_customizer_single_product_elements' ) );
		add_action( 'merchant_admin_module_deactivated', array( $this, 'remove_module_from_customizer_single_product_elements' ) );

		add_filter( 'merchant_admin_module_field_wrapper_classes', array( $this, 'admin_field_wrapper_class' ), 10, 4 );
		add_filter( 'merchant_admin_module_field_description', array( $this, 'replace_module_field_description' ), 10, 4 );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_internal_style' ) );

		add_filter( 'botiga_default_single_product_components', array( $this, 'customizer_components_value' ) );
		add_filter( 'botiga_single_product_elements', array( $this, 'customizer_elements' ) );

		// Merchant won't render the modules output if the shortcode option is off. So, we need to force it to be on.
		// This needs to be done via 'botiga_merchant_before_render_shortcode' because we don't want to force the shortcode functionality enable to the modules
		// when some page builder such as botiga templates builder, elementor, wpbakery, beaver, etc, are in use. 
		add_action( 'botiga_before_render_single_product_elements', array( $this, 'turn_on_merchant_modules_shortcode_functionality' ) );
	}

	/**
	 * Turn on merchant modules shortcode functionality.
	 * 
	 * @return void
	 */
	public function turn_on_merchant_modules_shortcode_functionality() {
		foreach ( self::$modules_data as $module_id => $module ) {
			add_filter( "merchant_{$module_id}_is_shortcode_enabled", '__return_true' );
		}
	}

	/**
	 * Add internal style.
	 * 
	 */
	public function add_internal_style() {
		$page = ( ! empty( $_GET['page'] ) ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		if ( ! empty( $page ) && 'merchant' === $page && isset( $_GET['module'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$css = "
				.botiga-merchant-module-field-disabled .merchant-module-page-setting-field-inner {
					pointer-events: none;
					opacity: 0.5;
				}
			";

			wp_add_inline_style( 'merchant-admin', $css );
		}
	}
	

	/**
	 * Module activation.
	 * 
	 * @param string $module_id Module ID.
	 * 
	 * @return void
	 */
	public function add_module_to_customizer_single_product_elements( $module_id ) {
		if ( ! array_key_exists( $module_id, self::$modules_data ) ) {
			return;
		}

		$module = self::$modules_data[ $module_id ];
		$current_mod_value = get_theme_mod( 'single_product_elements_order', botiga_get_default_single_product_components() );
		$new_mod_value     = array_merge( $current_mod_value, array( $module[ 'callback' ] ) );

		if ( ! in_array( $module[ 'callback' ], $current_mod_value, true ) ) {
			set_theme_mod( 'single_product_elements_order', $new_mod_value );
		}
	}

	/**
	 * Module deactivation.
	 * 
	 * @param string $module_id Module ID.
	 * 
	 * @return void
	 */
	public function remove_module_from_customizer_single_product_elements( $module_id ) {
		if ( ! array_key_exists( $module_id, self::$modules_data ) ) {
			return;
		}

		$module = self::$modules_data[ $module_id ];
		$current_mod_value = get_theme_mod( 'single_product_elements_order', botiga_get_default_single_product_components() );
		$new_mod_value     = array_diff( $current_mod_value, array( $module[ 'callback' ] ) );

		set_theme_mod( 'single_product_elements_order', $new_mod_value );
	}

	/**
	 * Admin field wrapper class.
	 * 
	 * @param array  $classes    Classes.
	 * @param array  $settings   Settings.
	 * @param string $value      Value.
	 * @param string $module_id  Module ID.
	 * 
	 * @return array
	 */
	public function admin_field_wrapper_class( $classes, $settings, $value, $module_id ) {
		if ( ! array_key_exists( $module_id, self::$modules_data ) ) {
			return $classes;
		}

		$descriptions_map = self::get_module_admin_field_descriptions();
		if ( ! array_key_exists( $module_id, $descriptions_map ) || ! array_key_exists( $settings['id'], $descriptions_map[ $module_id ] ) ) {
			return $classes;
		}

		$classes[] = 'botiga-merchant-module-field-disabled';
		return $classes;
	}

	/**
	 * Replace module field description.
	 * 
	 * @param string $desc       Description.
	 * @param array  $settings   Settings.
	 * @param string $value      Value.
	 * @param string $module_id  Module ID.
	 * 
	 * @return string
	 */
	public function replace_module_field_description( $desc, $settings, $value, $module_id ) {
		if ( ! array_key_exists( $module_id, self::$modules_data ) ) {
			return $desc;
		}

		$descriptions_map = self::get_module_admin_field_descriptions();
		if ( ! array_key_exists( $module_id, $descriptions_map ) || ! array_key_exists( $settings['id'], $descriptions_map[ $module_id ] ) ) {
			return $desc;
		}

		$new_desc = $descriptions_map[ $module_id ][ $settings['id'] ];
		if ( empty( $new_desc ) ) {
			return $desc;
		}

		return $new_desc;
	}

	/**
	 * Customizer Components value.
	 * 
	 * @param array $components Components.
	 * 
	 * @return array
	 */
	public function customizer_components_value( $components ) {
		foreach( self::$modules_data as $module_id => $module_data ) {
			if ( ! Merchant_Modules::is_module_active( $module_data[ 'class' ]::MODULE_ID ) ) {
				continue;
			}

			if ( in_array( $module_id, array( 'buy-x-get-y', 'volume-discounts', 'product-bundles', 'stock-scarcity' ), true ) ) {
				$add_to_cart_callback_index = array_search( 'woocommerce_template_single_add_to_cart', $components, true );

				if ( $add_to_cart_callback_index ) {
					array_splice( $components, $add_to_cart_callback_index, 0, $module_data[ 'callback' ] );
					return array_unique( $components );
				}
			}

			$components[] = $module_data[ 'callback' ];
		}

		return $components;
	}

	/**
	 * Customizer Elements.
	 * 
	 * @param array $elements Elements.
	 * 
	 * @return array
	 */
	public function customizer_elements( $elements ) {
		foreach( self::$modules_data as $module_id => $module ) {
			if ( ! Merchant_Modules::is_module_active( $module[ 'class' ]::MODULE_ID ) ) {
				continue;
			}

			$elements[ $module[ 'callback' ] ] = self::get_module_title( $module_id );
		}
		
		return $elements;
	}
}

new Botiga_Merchant_Single_Product_Elements();
