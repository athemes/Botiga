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

class Botiga_Merchant_Overlaping_Features_Modal {

	private $disable_settings_map = array(
		'recently-viewed-products' => array(
			'customizer_section' => 'shop_single_recently_viewed_products_section',
			'theme_mod_id'    => 'single_recently_viewed_products',
			'theme_mod_value' => '',
		),
		'quick-view' => array(
			'customizer_section' => 'botiga_section_shop_archive_product_card',
			'theme_mod_id'    => 'shop_product_quickview_layout',
			'theme_mod_value' => 'layout1',
		),
		'checkout' => array(
			'customizer_section' => 'woocommerce_checkout',
			'theme_mod_id'    => 'shop_checkout_layout',
			'theme_mod_value' => 'layout1',
		),
		'floating-mini-cart' => array(
			'customizer_section' => 'side_mini_cart_floating_icon_section',
			'theme_mod_id'    => 'side_mini_cart_floating_icon',
			'theme_mod_value' => '',
		),
		'side-cart' => array(
			'customizer_section' => 'botiga_section_shop_cart',
			'theme_mod_id'    => 'mini_cart_style',
			'theme_mod_value' => 'default',
		),
		'reasons-to-buy' => array(
			'customizer_section' => 'botiga_section_single_product_layout',
			'theme_mod_id'    => 'single_product_elements_order',
			'theme_mod_value' => array( 'botiga_single_product_reasons_to_buy' ),
		),
		'product-brand-image' => array( 
			'customizer_section' => 'botiga_section_single_product_layout',
			'theme_mod_id'    => 'single_product_elements_order',
			'theme_mod_value' => array( 'botiga_single_product_brand_image' ),
		),
		'trust-badges' => array( 
			'customizer_section' => 'botiga_section_single_product_layout',
			'theme_mod_id'    => 'single_product_elements_order',
			'theme_mod_value' => array( 'botiga_single_product_trust_badge_image' ),
		),
		'real-time-search' => array( 
			'customizer_section' => 'botiga_section_shop_search',
			'theme_mod_id'    => 'shop_search_enable_ajax',
			'theme_mod_value' => '',
		),
		'scroll-to-top-button' => array( 
			'customizer_section' => 'botiga_section_scrolltotop',
			'theme_mod_id'    => 'enable_scrolltop',
			'theme_mod_value' => '',
		),
		'size-chart' => array(
			'has_module' => true,
			'customizer_section' => 'botiga_section_single_product_size_chart',
		),
		'sticky-add-to-cart' => array(
			'has_module' => true,
			'customizer_section' => 'botiga_section_single_product_sticky_add_to_cart',
		),
		'advanced-reviews' => array(
			'has_module' => true,
			'customizer_section' => 'botiga_section_single_product_advanced_reviews',
		),
		'buy-now' => array(
			'has_module' => true,
			'customizer_section' => 'botiga_section_buy_now',
		),
		'product-video' => array(
			'has_module' => true,
			'module_id'  => 'video-gallery',
			'customizer_section' => '',
		),
		'product-audio' => array(
			'has_module' => true,
			'module_id'  => 'video-gallery',
			'customizer_section' => '',
		),
		'wishlist' => array(
			'has_module' => true,
			'customizer_section' => 'botiga_section_wishlist',
		),
		'product-swatches' => array(
			'has_module' => true,
			'customizer_section' => 'botiga_section_product_swatches',
		),
		'quick-social-links' => array(
			'has_module' => true,
			'module_id'  => 'quick-links',
			'customizer_section' => 'botiga_quicklinks',
		),
		'address-autocomplete' => array(
			'has_module' => true,
			'module_id'  => 'google-autocomplete',
			'customizer_section' => 'botiga_google_autocomplete_section',
		),
	);

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		if ( ! is_admin() ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_css' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_js' ), 9999 );
		add_action( 'wp_ajax_enable_mechant_module', array( $this, 'ajax_enable_merchant_module' ) );
		add_action( 'admin_footer', array( $this, 'modal_content' ) );
	}

	/**
	 * Is merchant dashboard page.
	 * 
	 */
	public function is_merchant_dashboard_page() {
		global $pagenow;
		return $pagenow === 'admin.php' && ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === 'merchant' ); // phpcs:ignore WordPress.Security.NonceVerification
	}

	/**
	 * Enqueue admin CSS.
	 * 
	 */
	public function enqueue_admin_css() {
		if ( ! $this->is_merchant_dashboard_page() ) {
			return;
		}

		wp_enqueue_style( 'botiga-admin-modal' );

		$css = "
			.merchant-modules-list-item.merchant-module-deactivated-by-bp .merchant-modules-list-item-icon, .merchant-modules-list-item.merchant-module-deactivated-by-bp .merchant-modules-list-item-content {
				opacity: 1 !important;
			}

			.botiga-admin-modal-content {
				border-radius: 8px;
			}

			.botiga-admin-modal-body {
				position: relative;
				padding: 40px 30px 30px 40px;
			}

			.botiga-admin-close-modal {
				position: absolute;
				top: 18px;
				right: 16px;
				transition: ease opacity 300ms;
			}
			.botiga-admin-close-modal:hover {
				opacity: 0.7;
			}

			.btm-modules-modal h2 {
				font-size: 18px;
				font-weight: 700;
				line-height: 1;
				margin: 0;
			}

			.btm-modules-modal h3 {
				font-size: 18px;
				line-height: 1;
				margin: 0 0 12px 0;
			}

			.btm-modules-modal p,
			.btm-modules-modal a {
				font-size: 13px;
				line-height: 1.5;
				margin: 0;
			}

			.btm-modules-modal h2,
			.btm-modules-modal h3 {
				color: #212121;
			}

			.btm-modules-modal p {
				color: #757575;
			}

			.btm-modules-modal-title {
				display: flex;
				align-items: center;
				justify-content: center;
				gap: 7px;
				display: block;
				max-width: 321px;
				text-align: center;
				background-color: #FFFCF6;
				border: 1px solid #EFBF56;
				border-radius: 35px;
				margin: 0px auto 35px !important;
				padding: 13px 30px 15px;
			}

			.btm-modules-modal-title svg {
				position: relative;
				top: 3px;
			}

			.btm-modules-modal-title-desc {
				margin-bottom: 30px !important;
			}

			.btm-divider {
				display: none;
			}

			@media (min-width: 768px) {
				.btm-modules-modal-actions {
					display: flex;
					gap: 30px;
				}

				.btm-modules-modal-actions > div {
					display: flex;
					flex-direction: column;
					flex: 1;
				}

				.btm-modules-modal-link {
					margin-top: auto !important;
				}

				.btm-divider {
					display: block;
					max-width: 1px;
					border-right: 1px solid #D9D9D9;
				}
			}

			.btm-modules-modal-actions p {
				margin-bottom: 22px !important;
			}

			.btm-modules-modal-link {
				display: inline-flex;
				align-items: center;
				gap: 7px;
				font-weight: 500;
				text-decoration: underline;
				transition: ease color 300ms;
			}

			.btm-modules-modal-link-botiga {
				color: #212121;
			}
			.btm-modules-modal-link-botiga svn path {
				fill: #212121;
				transition: ease fill 300ms;
			}
			.btm-modules-modal-link-botiga:hover {
				color: #757575;
			}
			.btm-modules-modal-link-botiga:hover svg path {
				fill: #757575;
			}

			.btm-modules-modal-link-merchant {
				color: #3858E9;
			}
			.btm-modules-modal-link-merchant:hover {
				color: #1A3D9A;
			}

			.btm-modules-modal-link-disabled {
				pointer-events: none;
				text-decoration: none;
				color: #757575;
				box-shadow: none !important;
			}
		";
		wp_add_inline_style( 'botiga-admin-modal', $css );
	}

	/**
	 * Enqueue admin JS.
	 * 
	 */
	public function enqueue_admin_js() {
		if ( ! $this->is_merchant_dashboard_page() ) {
			return;
		}

		wp_enqueue_script( 'botiga-admin-modal' );
		wp_localize_script( 'botiga-admin-modal', 'botiga_admin_modal', array( 
			'loading'     => esc_html__( 'Loading...', 'botiga' ),
			'redirecting' => esc_html__( 'Redirecting...', 'botiga' ),
		) );

		$botiga_dashboard_url = add_query_arg( array( 'page' => 'botiga-dashboard' ), admin_url( 'admin.php' ) );
		$customize_url        = admin_url( 'customize.php' );
		$js = "
			(function($) {
				
				adminBotiga.modal.triggerSelector = '.merchant-module-activate.merchant-module-deactivated-by-bp';

				$( document ).ready( function() {
					const customizerSectionsMap = " . wp_json_encode( $this->disable_settings_map ) . ";

					$( '.botiga-admin-modal' ).on( 'botiga-admin-modal-opened', function(e, modalPopup, modalTrigger) {
						const merchantModuleId  = modalTrigger.data( 'module' );
						const modalPopupLink    = modalPopup.find( '.btm-modules-modal-link' );
						const customizerSection = typeof customizerSectionsMap[merchantModuleId]['customizer_section'] !== 'undefined' ? customizerSectionsMap[merchantModuleId]['customizer_section'] : false;
						const customizerSectionLink = customizerSection ? '" . esc_js( $customize_url ) . "?autofocus[section]=' + customizerSection : '" . esc_js( $botiga_dashboard_url ) . "';
						const enableMerchantLink = modalPopup.find( '.btm-modules-modal-link-merchant' );
						
						modalPopupLink.eq(0).attr( 'href', customizerSectionLink );
						enableMerchantLink.data( 'module-id', merchantModuleId );

						$( '.btm-modules-modal-link-merchant' ).off( 'click' ).on( 'click', function(e){
							e.preventDefault();

							const _this = $(this);

							_this
								.addClass( 'btm-modules-modal-link-disabled' )
								.text( botiga_admin_modal.loading );

							$.ajax({
								url: ajaxurl,
								type: 'POST',
								data: {
									action: 'enable_mechant_module',
									module_id: $(this).data( 'module-id' ),
									nonce: $(this).data( 'nonce' )
								},
								success: function( response ) {
									if ( response.success ) {
										_this.text( botiga_admin_modal.redirecting );

										location.href = response.data.redirect;
									}
								}
							});
						} );
					} );

				});
			})(jQuery);
		";
		wp_add_inline_script( 'botiga-admin-modal', $js );
	}

	/**
	 * Enable merchant module ajax callback.
	 * 
	 * @return void
	 */
	public function ajax_enable_merchant_module() {
		check_ajax_referer( 'btm-enable-merchant-module', 'nonce' );

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'You do not have permission to perform this action', 'botiga' ) ) );
		}

		$module_id = isset( $_POST['module_id'] ) ? sanitize_text_field( $_POST['module_id'] ) : false;
		if ( ! $module_id ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Invalid module ID', 'botiga' ) ) );
		}

		$disable_settings_map = $this->disable_settings_map;
		$module_settings      = $disable_settings_map[ $module_id ];

		if ( isset( $module_settings['has_module'] ) && $module_settings['has_module'] ) {
			$botiga_modules    = get_option( 'botiga-modules' );
			$botiga_modules    = ( is_array( $botiga_modules ) ) ? $botiga_modules : (array) $botiga_modules;
			$mutable_module_id = $module_settings['module_id'] ?? $module_id;

			if ( in_array( $mutable_module_id, $botiga_modules ) ) {
				$botiga_modules[ $mutable_module_id ] = false;
				update_option( 'botiga-modules', $botiga_modules );
			}
		} elseif ( ! is_array( $module_settings['theme_mod_value'] ) ) {
			set_theme_mod( $module_settings['theme_mod_id'], $module_settings['theme_mod_value'] );
		} else {
			$current_value = get_theme_mod( $module_settings['theme_mod_id'], array() );
			
			if ( is_array( $current_value ) ) {
				set_theme_mod( $module_settings['theme_mod_id'], array_merge( array_diff( $current_value, $module_settings['theme_mod_value'] ) ) );
			}
		}

		// Activate merchant module.
		$mmodules = get_option( Merchant_Modules::$option, array() );
		$mmodules[ $module_id ] = true;

		update_option( Merchant_Modules::$option, $mmodules );

		wp_send_json_success( array( 
			'message'  => esc_html__( 'Merchant module enabled', 'botiga' ),
			'redirect' => add_query_arg( array( 'page' => 'merchant', 'module' => $module_id ), admin_url( 'admin.php' ) ), 
		) );
	}
	

	/**
	 * Modal content.
	 * 
	 */
	public function modal_content() {
		if ( ! $this->is_merchant_dashboard_page() ) {
			return;
		}
		
		?>

		<div class="botiga-admin-modal">
			<div class="botiga-admin-modal-content">
				<div class="botiga-admin-modal-body btm-modules-modal">
					<a href="#" class="botiga-admin-close-modal" title="<?php echo esc_attr__( 'Close', 'botiga' ); ?>">
						<svg width="17" height="17" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M5.6875 5.6875L20.3125 20.3125" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M5.6875 20.3125L20.3125 5.6875" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
					</a>

					<h2 class="btm-modules-modal-title">
						<svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M19.7142 14.768L11.9066 1.09985C11.7115 0.764984 11.433 0.487331 11.0986 0.294411C10.7643 0.10149 10.3857 0 10.0004 0C9.6152 0 9.23663 0.10149 8.90228 0.294411C8.56793 0.487331 8.2894 0.764984 8.09429 1.09985L0.286657 14.768C0.0989313 15.0919 0 15.4603 0 15.8354C0 16.2105 0.0989313 16.5789 0.286657 16.9028C0.479264 17.2397 0.757321 17.5188 1.0923 17.7116C1.42727 17.9044 1.8071 18.0039 2.19281 17.9999H17.8081C18.1935 18.0036 18.5729 17.904 18.9076 17.7112C19.2422 17.5184 19.52 17.2394 19.7124 16.9028C19.9004 16.5791 19.9997 16.2108 20 15.8356C20.0003 15.4605 19.9017 15.0921 19.7142 14.768ZM9.2862 7.19999C9.2862 7.00903 9.36145 6.8259 9.4954 6.69088C9.62934 6.55585 9.81102 6.47999 10.0004 6.47999C10.1899 6.47999 10.3715 6.55585 10.5055 6.69088C10.6394 6.8259 10.7147 7.00903 10.7147 7.19999V10.8C10.7147 10.9909 10.6394 11.174 10.5055 11.3091C10.3715 11.4441 10.1899 11.5199 10.0004 11.5199C9.81102 11.5199 9.62934 11.4441 9.4954 11.3091C9.36145 11.174 9.2862 10.9909 9.2862 10.8V7.19999ZM10.0004 15.1199C9.78855 15.1199 9.58141 15.0566 9.40522 14.9379C9.22904 14.8192 9.09172 14.6506 9.01063 14.4532C8.92954 14.2559 8.90832 14.0387 8.94966 13.8292C8.991 13.6197 9.09304 13.4273 9.24287 13.2763C9.3927 13.1252 9.5836 13.0224 9.79143 12.9807C9.99926 12.939 10.2147 12.9604 10.4104 13.0421C10.6062 13.1239 10.7735 13.2623 10.8913 13.4399C11.009 13.6175 11.0718 13.8263 11.0718 14.0399C11.0718 14.3264 10.9589 14.6011 10.758 14.8036C10.5571 15.0061 10.2846 15.1199 10.0004 15.1199Z" fill="#F9BF14"/>
						</svg>
						<?php echo esc_html__( 'This module conflicts with Botiga!', 'botiga' ); ?>
					</h2>
					<div class="btm-modules-modal-actions">
						<div>
							<h3><?php echo esc_html__( 'Continue with Botiga', 'botiga' ); ?></h3>
							<p><?php echo esc_html__( 'To maintain the Botiga module as your primary option over the Merchant module, please click the button below to access the Botiga module settings.', 'botiga' ); ?></p>
							<a href="#" class="btm-modules-modal-link btm-modules-modal-link-botiga" title="<?php echo esc_attr__( 'Go to Botiga settings', 'botiga' ); ?>" target="_blank">
								<?php echo esc_html__( 'Go to Botiga settings', 'botiga' ); ?>
								<svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.4375 0.5C11.7422 0.5 12 0.757812 12 1.0625V4.25C12 4.55469 11.8125 4.83594 11.5078 4.95312C11.4141 5 11.3203 5 11.2266 5C11.0156 5 10.8281 4.92969 10.6875 4.78906L9.72656 3.82812L5.20312 8.35156C5.0625 8.49219 4.875 8.5625 4.6875 8.5625C4.47656 8.5625 4.28906 8.49219 4.14844 8.35156C3.84375 8.07031 3.84375 7.57812 4.14844 7.29688L8.67188 2.77344L7.71094 1.8125C7.5 1.60156 7.42969 1.27344 7.54688 0.992188C7.66406 0.6875 7.94531 0.5 8.25 0.5H11.4375ZM9.1875 8C9.49219 8 9.75 8.25781 9.75 8.5625V11.1875C9.75 11.9141 9.14062 12.5 8.4375 12.5H1.3125C0.585938 12.5 0 11.9141 0 11.1875V4.0625C0 3.35938 0.585938 2.75 1.3125 2.75H3.9375C4.24219 2.75 4.5 3.00781 4.5 3.3125C4.5 3.64062 4.24219 3.875 3.9375 3.875H1.3125C1.19531 3.875 1.125 3.96875 1.125 4.0625V11.1875C1.125 11.3047 1.19531 11.375 1.3125 11.375H8.4375C8.53125 11.375 8.625 11.3047 8.625 11.1875V8.5625C8.625 8.25781 8.85938 8 9.1875 8Z" fill="#212121"/>
								</svg>
							</a>
						</div>
						<div class="btm-divider"></div>
						<div>
							<h3><?php echo esc_html__( 'Switch to Merchant', 'botiga' ); ?></h3>
							<p><?php echo esc_html__( 'To disable the Botiga module and activate the corresponding Merchant module, please click the button below. This action will disable the Botiga module.', 'botiga' ); ?></p>
							<a href="#" class="btm-modules-modal-link btm-modules-modal-link-merchant" title="<?php echo esc_attr__( 'Enable Merchant module', 'botiga' ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'btm-enable-merchant-module' ) ); ?>">
								<?php echo esc_html__( 'Enable Merchant module', 'botiga' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
	}
}

new Botiga_Merchant_Overlaping_Features_Modal();