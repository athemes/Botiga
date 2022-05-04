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
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {		
			add_action( 'init', array( $this, 'customize_wp_init' ) );
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );
			add_action( 'customize_register', array( $this, 'customize_register' ) );
			add_action( 'customize_controls_print_footer_scripts', array( $this, 'scripts' ) );
		}

		/**
		 * Ajax callbacks
		 */
		function customize_wp_init() {
			require get_template_directory() . '/inc/customizer/ajax-callbacks.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
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
			if( ! defined( 'BOTIGA_PRO_VERSION' ) ) {
				require get_template_directory() . '/inc/customizer/controls/class_botiga_upsell_message.php';
			}
			// @codingStandardsIgnoreEnd WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			$wp_customize->register_control_type( '\Kirki\Control\sortable' );

			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_section( 'title_tagline' )->priority 	= 1;
			$wp_customize->get_section( 'colors' )->priority 			= 10;
			$wp_customize->get_section( 'title_tagline' )->panel 		= 'botiga_panel_header';
			$wp_customize->get_section( 'header_image' )->panel 		= 'botiga_panel_header';
			$wp_customize->get_section( 'background_image' )->panel 	= 'botiga_panel_general';

			$wp_customize->remove_control( 'header_textcolor' );
			if ( class_exists( 'WooCommerce') ) {
				$wp_customize->get_panel( 'woocommerce' )->priority 	= 31;
			}

			// @codingStandardsIgnoreStart WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			require get_template_directory() . '/inc/customizer/sanitize.php';
			require get_template_directory() . '/inc/customizer/callbacks.php';
			require get_template_directory() . '/inc/customizer/options/blog.php';
			require get_template_directory() . '/inc/customizer/options/blog-single.php';
			require get_template_directory() . '/inc/customizer/options/topbar.php';
			require get_template_directory() . '/inc/customizer/options/header.php';
			require get_template_directory() . '/inc/customizer/options/header-mobile.php';
			require get_template_directory() . '/inc/customizer/options/general.php';
			require get_template_directory() . '/inc/customizer/options/footer.php';
			require get_template_directory() . '/inc/customizer/options/colors.php';
			require get_template_directory() . '/inc/customizer/options/performance.php';
			if ( class_exists( 'WooCommerce' ) ) {
				require get_template_directory() . '/inc/customizer/options/woocommerce.php';
				require get_template_directory() . '/inc/customizer/options/woocommerce-single.php';
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
						'container_inclusive' => false
					)
				);
				$wp_customize->selective_refresh->add_partial(
					'blogdescription',
					array(
						'selector'        => '.site-description',
						'render_callback' => 'botiga_customize_partial_blogdescription',
						'container_inclusive' => false
					)
				);
				$wp_customize->selective_refresh->add_partial( 
					'social_profiles_footer', 
					array(
						'selector'          => '.site-info .social-profile',
						'render_callback'   => function() { botiga_social_profile( 'social_profiles_footer' ); },
						'container_inclusive' => false
					) 
				); 
				$wp_customize->selective_refresh->add_partial( 
					'footer_credits', 
					array(
						'selector'          => '.site-info .botiga-credits',
						'render_callback'   => 'botiga_customize_partial_footer_credits',
						'container_inclusive' => false
					) 
				);  
			}

		}

		public function customize_preview_js() {
			wp_enqueue_script( 'botiga-customizer', get_template_directory_uri() . '/assets/js/customizer.min.js', array( 'jquery', 'customize-preview' ), BOTIGA_VERSION, true );

		}		

		function scripts() {
			wp_enqueue_script( 'botiga-customizer-scripts', get_template_directory_uri() . '/assets/js/customizer-scripts.min.js', array( 'jquery', 'jquery-ui-core' ), BOTIGA_VERSION, true );
			wp_localize_script( 'botiga-customizer-scripts', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

			wp_enqueue_style( 'botiga-customizer-styles', get_template_directory_uri() . '/assets/css/customizer.css' );
		}
		
	}
}

//Initiate
Botiga_Customizer::get_instance();

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function botiga_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function botiga_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the footer credits for the selective refresh partial.
 *
 * @return void
 */
function botiga_customize_partial_footer_credits() {
	$footer = new Botiga_Footer();
	echo wp_kses_post( $footer->footer_credits() );
}

/**
 * Render adobe fonts control kits
 *
 */
function botiga_customize_control_adobe_font_kits_output( $kits = false, $echo = true ) {
	if( $kits ) {

		if( ! $echo ) {
			ob_start();
		} ?>
		
		<div class="botiga-adobe_fonts_kits_wrapper" style="margin-bottom: 25px;">

			<p><?php echo esc_html__( 'You have the following data in your Adobe Fonts account.', 'botiga' ); ?></p>

			<?php foreach( $kits as $kit_id => $project ) : ?>

				<div class="botiga-adobe_fonts_kits_wrapper-item<?php echo ( $project[ 'enable' ] ? '' : ' disabled' ); ?>">
					<ul>
						<li>
							<strong>
								<?php 
								echo sprintf( 
									/* translators: 1: Adobe fonts kit id */
									esc_html__( 'Kit ID: %s', 'botiga' ), 
									esc_html( $kit_id ) 
								); ?>
							</strong>
						</li>
						<li>
							<?php echo sprintf( 
								/* translators: 1: Adobe fonts project name */
								esc_html__( 'Project Name: %s', 'botiga' ), 
								esc_html( $project[ 'project_name' ] ) 
							); ?>
						</li>
						<li>
							<?php 
							$fonts_name = array();
							foreach( $project[ 'families' ] as $family ) {
								$fonts_name[] = $family[ 'name' ];
							}

							echo esc_html( implode( ', ', $fonts_name ) ); ?>
						</li>
					</ul>
					<div>
						<?php 
						if( $project[ 'enable' ] ) : ?>
							<a href="#" class="botiga-adobe_fonts_kit_onoff" data-kit="<?php echo esc_attr( $kit_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'customize-typography-adobe-kits-control-onoff-nonce' ) ); ?>" data-loading-text="<?php echo esc_attr__( 'Loading...', 'botiga' ); ?>" data-enable-text="<?php echo esc_attr__( 'Enable', 'botiga' ); ?>" data-disable-text="<?php echo esc_attr__( 'Disable', 'botiga' ); ?>"><?php echo esc_html__( 'Disable', 'botiga' ); ?></a>
						<?php else : ?>
							<a href="#" class="botiga-adobe_fonts_kit_onoff" data-kit="<?php echo esc_attr( $kit_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'customize-typography-adobe-kits-control-onoff-nonce' ) ); ?>" data-loading-text="<?php echo esc_attr__( 'Loading...', 'botiga' ); ?>" data-enable-text="<?php echo esc_attr__( 'Enable', 'botiga' ); ?>" data-disable-text="<?php echo esc_attr__( 'Disable', 'botiga' ); ?>"><?php echo esc_html__( 'Enable', 'botiga' ); ?></a>
						<?php endif; ?>
					</div>
					<div class="reload-message">
						<em>
							<?php echo wp_kses_post(
								/* Translators:  */
								sprintf( __( 'Reload the page is required to get it working across all typography options. <a href="%s">Click here</a> to reload the page.', 'botiga' ), admin_url( '/customize.php?autofocus[section]=botiga_section_typography_general' ) )
							); ?>
						</em>
					</div>
				</div>

			<?php endforeach; ?>

		</div>

	<?php 
		if( ! $echo ) {
			return ob_get_clean();
		}
	}
}