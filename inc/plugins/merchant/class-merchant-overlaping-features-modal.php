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

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_css' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_js' ) );

		add_action( 'admin_footer', array( $this, 'modal_content' ) );
	}

	/**
	 * Enqueue admin CSS.
	 * 
	 */
	public function enqueue_admin_css() {
		wp_enqueue_style( 'botiga-admin-modal' );

		$css = "
			.btm-modules-modal h2 {
				font-size: 20px;
				line-height: 1;
				margin: 0;
			}

			.btm-modules-modal h3 {
				font-size: 16px;
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
				gap: 12px;
				margin-bottom: 15px !important;
			}

			.btm-modules-modal-title-desc {
				margin-bottom: 30px !important;
			}

			@media (min-width: 768px) {
				.btm-modules-modal-actions {
					display: flex;
				}

				.btm-modules-modal-actions > div {
					display: flex;
					flex-direction: column;
					flex: 1;
				}

				.btm-modules-modal-link {
					margin-top: auto !important;
				}
			}

			.btm-modules-modal-actions p {
				margin-bottom: 28px !important;
			}

			.btm-modules-modal-link {
				display: inline-flex;
				align-items: center;
				gap: 7px;
				text-decoration: underline;
			}

			.btm-modules-modal-link-botiga {
				color: #212121;
			}

			.btm-modules-modal-link-merchant {
				color: #3858E9;
			}
		";
		wp_add_inline_style( 'botiga-admin-modal', $css );
	}

	/**
	 * Enqueue admin JS.
	 * 
	 */
	public function enqueue_admin_js() {
		wp_enqueue_script( 'botiga-admin-modal' );

		$customizer_url = admin_url( 'customize.php' );
		$js = "
			(function($) {
				$( document ).ready( function() {
					const customizerSectionsMap = {
						'size-chart': 'botiga_section_single_product_size_chart',
						'scroll-to-top-button': 'botiga_section_scrolltotop',
						'product-swatches' : 'botiga_section_product_swatches'
					}

					$( '.botiga-admin-modal' ).on( 'botiga-admin-modal-opened', function(e, modalPopup, modalTrigger) {
						const merchantModuleId  = modalTrigger.data( 'module-id' );
						const modalPopupLink    = modalPopup.find( '.btm-modules-modal-link' );
						const customizerSection = customizerSectionsMap[merchantModuleId];
						const customizerSectionLink = customizerSection ? '" . esc_js( $customizer_url ) . "?autofocus[section]=' + customizerSection : '" . esc_js( $customizer_url ) . "';
						
						modalPopupLink.eq(0).attr( 'href', customizerSectionLink );
					} );
				});
			})(jQuery);
		";
		wp_add_inline_script( 'botiga-admin-modal', $js );
	}

	/**
	 * Modal content.
	 * 
	 */
	public function modal_content() {
		?>

		<div class="botiga-admin-modal">
			<div class="botiga-admin-modal-content">
				<div class="botiga-admin-modal-body btm-modules-modal">
					<h2 class="btm-modules-modal-title">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.29 3.86002L1.81999 18C1.64536 18.3024 1.55296 18.6453 1.55198 18.9945C1.551 19.3438 1.64148 19.6872 1.81442 19.9905C1.98735 20.2939 2.23672 20.5468 2.5377 20.7239C2.83868 20.901 3.18079 20.9962 3.52999 21H20.47C20.8192 20.9962 21.1613 20.901 21.4623 20.7239C21.7633 20.5468 22.0126 20.2939 22.1856 19.9905C22.3585 19.6872 22.449 19.3438 22.448 18.9945C22.447 18.6453 22.3546 18.3024 22.18 18L13.71 3.86002C13.5317 3.56613 13.2807 3.32314 12.9812 3.15451C12.6817 2.98587 12.3437 2.89728 12 2.89728C11.6563 2.89728 11.3183 2.98587 11.0188 3.15451C10.7193 3.32314 10.4683 3.56613 10.29 3.86002Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M12 9V13" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M12 17H12.01" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
						<?php echo esc_html__( 'This module conflicts with Botiga!', 'botiga' ); ?>
					</h2>
					<p class="btm-modules-modal-title-desc"><?php echo esc_html__( 'This Merchant module is also present on Botiga and we intentionally deactivate it by default. But you still can switch to the Merchant module at any time through the options below.', 'botiga' ); ?></p>
					<div class="btm-modules-modal-actions">
						<div>
							<h3><?php echo esc_html__( 'Continue with Botiga', 'botiga' ); ?></h3>
							<p><?php echo esc_html__( 'If you want that the Botiga module continue having precedence over the Merchant module, click in the below button to go to the Botiga module settings.', 'botiga' ); ?></p>
							<a href="#" class="btm-modules-modal-link btm-modules-modal-link-botiga" title="<?php echo esc_attr__( 'Go to Botiga settings', 'botiga' ); ?>" target="_blank">
								<?php echo esc_html__( 'Go to Botiga settings', 'botiga' ); ?>
								<svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M11.4375 0.5C11.7422 0.5 12 0.757812 12 1.0625V4.25C12 4.55469 11.8125 4.83594 11.5078 4.95312C11.4141 5 11.3203 5 11.2266 5C11.0156 5 10.8281 4.92969 10.6875 4.78906L9.72656 3.82812L5.20312 8.35156C5.0625 8.49219 4.875 8.5625 4.6875 8.5625C4.47656 8.5625 4.28906 8.49219 4.14844 8.35156C3.84375 8.07031 3.84375 7.57812 4.14844 7.29688L8.67188 2.77344L7.71094 1.8125C7.5 1.60156 7.42969 1.27344 7.54688 0.992188C7.66406 0.6875 7.94531 0.5 8.25 0.5H11.4375ZM9.1875 8C9.49219 8 9.75 8.25781 9.75 8.5625V11.1875C9.75 11.9141 9.14062 12.5 8.4375 12.5H1.3125C0.585938 12.5 0 11.9141 0 11.1875V4.0625C0 3.35938 0.585938 2.75 1.3125 2.75H3.9375C4.24219 2.75 4.5 3.00781 4.5 3.3125C4.5 3.64062 4.24219 3.875 3.9375 3.875H1.3125C1.19531 3.875 1.125 3.96875 1.125 4.0625V11.1875C1.125 11.3047 1.19531 11.375 1.3125 11.375H8.4375C8.53125 11.375 8.625 11.3047 8.625 11.1875V8.5625C8.625 8.25781 8.85938 8 9.1875 8Z" fill="#212121"/>
								</svg>
							</a>
						</div>
						<div>
							<h3><?php echo esc_html__( 'Continue with Merchant', 'botiga' ); ?></h3>
							<p><?php echo esc_html__( 'If you want to disable the Botiga module and enable the respective Merchant module, click in the below button', 'botiga' ); ?></p>
							<a href="#" class="btm-modules-modal-link btm-modules-modal-link-merchant" title="<?php echo esc_attr__( 'Enable Merchant module', 'botiga' ); ?>">
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