<?php
/**
 * Class for dynamic CSS output
 *
 */


if ( !class_exists( 'Botiga_Custom_CSS' ) ) :

	/**
	 * Botiga_Custom_CSS 
	 */
	class Botiga_Custom_CSS {
		
		/**
		 * Instance
		 */     
		private static $instance;

		/**
		 * Properties
		 */
		public $customizer_js;
		public $customizer_js_css_vars;
		public $dynamic_css_uri;
		public $dynamic_css_path;
		public static $css_to_replace = array();

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

			$upload_dir = wp_upload_dir();

			$this->customizer_js = array();

			$this->dynamic_css_uri  = trailingslashit( set_url_scheme( $upload_dir['baseurl'] ) ) . 'botiga/';
			$this->dynamic_css_path = trailingslashit( set_url_scheme( $upload_dir['basedir'] ) ) . 'botiga/';

			if ( !is_customize_preview() && wp_is_writable( trailingslashit( $upload_dir['basedir'] ) ) && file_exists( $this->dynamic_css_path . 'custom-styles.css' ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 11 );
			} else {
				add_action( 'wp_enqueue_scripts', array( $this, 'print_styles' ), 12 );
			}

			if ( !is_customize_preview() ) {
				remove_action( 'wp_head', 'wp_custom_css_cb', 101 );
			}

			add_action( 'customize_save_after', array( $this, 'update_custom_css_file' ) );

			add_action( 'after_switch_theme', array( $this, 'update_custom_css_file' ) );

			add_action( 'switch_theme', array( $this, 'delete_custom_css_file' ) );

			add_action( 'init', array( $this, 'init' ) );
		}

		/**
		 * Receive a list with selectors and mount them in a unique css selector
		 */
		public static function get_mounted_selector( $selectors, $selector_wrapper ) {
			$selectors = array_map( function( $selector ) use ( $selector_wrapper ) {
				return $selector_wrapper ? $selector_wrapper . $selector : $selector;
			}, $selectors );

			return implode( ',', $selectors );
		}

		/**
		 * Gnerate and return theme typography CSS
		 * This is used in multiple places accross the theme code, so because of that is useful having a function for it
		 */
		public static function get_typography_css( $context = 'frontend' ) {

			$css = '';

			//Selectors
			$body_selector      = $context === 'frontend' ? 'body ' : 'div.editor-styles-wrapper ';
			$html_body_selector = $context === 'frontend' ? 'html, body ' : 'div.editor-styles-wrapper ';
			$empty_selector     = $context === 'frontend' ? '' : 'div.editor-styles-wrapper ';

			//Typography 
			$fonts_library = get_theme_mod( 'fonts_library', 'google' );

			//Google Fonts
			if( $fonts_library === 'google' ) {
				$typography_defaults = wp_json_encode(
					array(
						'font'          => 'System default',
						'regularweight' => '400',
						'category'      => 'sans-serif',
					)
				);  
	
				$body_font                       = get_theme_mod( 'botiga_body_font', $typography_defaults );
				$headings_font                   = get_theme_mod( 'botiga_headings_font', $typography_defaults );
				$header_menu_font                = get_theme_mod( 'botiga_header_menu_font', $body_font );
				$button_font                     = get_theme_mod( 'button_font', $typography_defaults );
				$button_font_style               = get_theme_mod( 'button_font_style', 'custom' );
				$loop_post_title_font            = get_theme_mod( 'loop_post_title_font', $typography_defaults );
				$loop_post_title_font_style      = get_theme_mod( 'loop_post_title_font_style', 'heading' );
				$single_post_title_font          = get_theme_mod( 'single_post_title_font', $typography_defaults );
				$single_post_title_font_style    = get_theme_mod( 'single_post_title_font_style', 'heading' );
				$single_product_title_font       = get_theme_mod( 'single_product_title_font', $typography_defaults );
				$single_product_title_font_style = get_theme_mod( 'single_product_title_font_style', 'heading' );
				$shop_product_title_font         = get_theme_mod( 'shop_product_title_font', $typography_defaults );
				$shop_product_title_font_style   = get_theme_mod( 'shop_product_title_font_style', 'heading' );

				$body_font        = json_decode( $body_font, true );
				$headings_font    = json_decode( $headings_font, true );
				$header_menu_font = json_decode( $header_menu_font, true );

				if ( $button_font_style === 'body' ) {
					$button_font = $body_font;
				} elseif ( $button_font_style === 'heading' ) {
					$button_font = $headings_font;
				} else {
					$button_font = json_decode( $button_font, true );
				}

				if ( $loop_post_title_font_style === 'body' ) {
					$loop_post_title_font = $body_font;
				} elseif ( $loop_post_title_font_style === 'heading' ) {
					$loop_post_title_font = $headings_font;
				} else {
					$loop_post_title_font = json_decode( $loop_post_title_font, true );
				}

				if ( $single_post_title_font_style === 'body' ) {
					$single_post_title_font = $body_font;
				} elseif ( $single_post_title_font_style === 'heading' ) {
					$single_post_title_font = $headings_font;
				} else {
					$single_post_title_font = json_decode( $single_post_title_font, true );
				}

				if ( $single_product_title_font_style === 'body' ) {
					$single_product_title_font = $body_font;
				} elseif ( $single_product_title_font_style === 'heading' ) {
					$single_product_title_font = $headings_font;
				} else {
					$single_product_title_font = json_decode( $single_product_title_font, true );
				}

				if ( $shop_product_title_font_style === 'body' ) {
					$shop_product_title_font = $body_font;
				} elseif ( $shop_product_title_font_style === 'heading' ) {
					$shop_product_title_font = $headings_font;
				} else {
					$shop_product_title_font = json_decode( $shop_product_title_font, true );
				}
				
				if ( 'System default' !== $body_font['font'] ) {
					$css .= $body_selector . '{ font-family:' . esc_attr( $body_font['font'] ) . ',' . esc_attr( $body_font['category'] ) . '; font-weight: '. esc_attr( $body_font['regularweight'] ) .';}' . "\n";    
				}
				
				if ( 'System default' !== $headings_font['font'] ) {
					$selectors = array( 
						'h1', 
						'h2', 
						'h3', 
						'h4', 
						'h5', 
						'h6', 
						'.site-title', 
						'.wc-block-grid__product-title',
						'.checkout .recurring-totals > th',
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );
					
					$css .= $selector . '{ font-family:' . esc_attr( $headings_font['font'] ) . ',' . esc_attr( $headings_font['category'] ) . '; font-weight: '. esc_attr( $headings_font['regularweight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $button_font['font'] ) {
					$selectors = array( 
						'button', 
						'a.button', 
						'.wp-block-button__link', 
						'input[type="button"]', 
						'input[type="reset"]', 
						'input[type="submit"]', 
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:' . esc_attr( $button_font['font'] ) . ',' . esc_attr( $button_font['category'] ) . '; font-weight: '. esc_attr( $button_font['regularweight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $loop_post_title_font['font'] ) {
					$css .= $empty_selector . '.posts-archive .entry-title { font-family:' . esc_attr( $loop_post_title_font['font'] ) . ',' . esc_attr( $loop_post_title_font['category'] ) . '; font-weight: '. esc_attr( $loop_post_title_font['regularweight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $single_post_title_font['font'] ) {
					$css .= $empty_selector . '.single .entry-header .entry-title { font-family:' . esc_attr( $single_post_title_font['font'] ) . ',' . esc_attr( $single_post_title_font['category'] ) . '; font-weight: '. esc_attr( $single_post_title_font['regularweight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $single_product_title_font['font'] ) {
					$css .= $empty_selector . '.product-gallery-summary .entry-title { font-family:' . esc_attr( $single_product_title_font['font'] ) . ',' . esc_attr( $single_product_title_font['category'] ) . '; font-weight: '. esc_attr( $single_product_title_font['regularweight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $shop_product_title_font['font'] ) {
					$selectors = array( 
						'ul.products li.product .botiga-wc-loop-product__title', 
						'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title', 
						'ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title', 
						'ul.wc-block-grid__products li.product .wc-block-grid__product-title', 
						'ul.wc-block-grid__products li.product .woocommerce-loop-product__title', 
						'ul.products li.wc-block-grid__product .wc-block-grid__product-title', 
						'ul.products li.wc-block-grid__product .woocommerce-loop-product__title', 
						'ul.products li.product .wc-block-grid__product-title', 
						'ul.products li.product .woocommerce-loop-product__title', 
						'ul.products li.product .woocommerce-loop-category__title', 
						'.woocommerce-loop-product__title .botiga-wc-loop-product__title', 
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:' . esc_attr( $shop_product_title_font['font'] ) . ',' . esc_attr( $shop_product_title_font['category'] ) . '; font-weight: '. esc_attr( $shop_product_title_font['regularweight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $button_font['font'] ) {
					$selectors = array( 
						'button', 
						'a.button', 
						'.wp-block-button__link', 
						'input[type="button"]', 
						'input[type="reset"]', 
						'input[type="submit"]', 
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:' . esc_attr( $button_font['font'] ) . ',' . esc_attr( $button_font['category'] ) . '; font-weight: '. esc_attr( $button_font['regularweight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $header_menu_font['font'] ) {

					if( class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'hf-builder' ) ) {
						$selectors = array( 
							'.bhfb-header .main-navigation', 
							'.bhfb-header .secondary-navigation', 
						);
						$selector = self::get_mounted_selector( $selectors, $empty_selector );

						$css .= $selector . '{ font-family:' . esc_attr( $header_menu_font['font'] ) . ',' . esc_attr( $header_menu_font['category'] ) . '; font-weight: '. esc_attr( $header_menu_font['regularweight'] ) .';}' . "\n";
					} else {
						$selectors = array( 
							'.top-bar .secondary-navigation', 
							'#masthead .main-navigation', 
							'.botiga-offcanvas-menu .main-navigation', 
							'.bottom-header-row .main-navigation', 
						);
						$selector = self::get_mounted_selector( $selectors, $empty_selector );

						$css .= $selector . '{ font-family:' . esc_attr( $header_menu_font['font'] ) . ',' . esc_attr( $header_menu_font['category'] ) . '; font-weight: '. esc_attr( $header_menu_font['regularweight'] ) .';}' . "\n";
					}

				}
			}

			if( $fonts_library === 'adobe' ) {
				$body_font                       = get_theme_mod( 'botiga_body_adobe_font', 'system-default|n4' );
				$headings_font                   = get_theme_mod( 'botiga_headings_adobe_font', 'system-default|n4' );
				$header_menu_font                = get_theme_mod( 'botiga_header_menu_adobe_font', $body_font );
				$button_font                     = get_theme_mod( 'button_adobe_font', 'system-default|n4' );
				$button_font_style               = get_theme_mod( 'button_font_style', 'custom' );
				$loop_post_title_font            = get_theme_mod( 'loop_post_title_adobe_font', 'system-default|n4' );
				$loop_post_title_font_style      = get_theme_mod( 'loop_post_title_font_style', 'heading' );
				$single_post_title_font          = get_theme_mod( 'single_post_title_adobe_font', 'system-default|n4' );
				$single_post_title_font_style    = get_theme_mod( 'single_post_title_font_style', 'heading' );
				$single_product_title_font       = get_theme_mod( 'single_product_title_adobe_font', 'system-default|n4' );
				$single_product_title_font_style = get_theme_mod( 'single_product_title_font_style', 'heading' );
				$shop_product_title_font         = get_theme_mod( 'shop_product_title_adobe_font', 'system-default|n4' );
				$shop_product_title_font_style   = get_theme_mod( 'shop_product_title_font_style', 'heading' );

				$body_font = explode( '|', $body_font );
				$body_font = array(
					'font'   => $body_font[0],
					'weight' => $body_font[1],
				);

				$headings_font = explode( '|', $headings_font );
				$headings_font = array(
					'font'   => $headings_font[0],
					'weight' => $headings_font[1],
				);

				$header_menu_font = explode( '|', $header_menu_font );
				$header_menu_font = array(
					'font'   => $header_menu_font[0],
					'weight' => $header_menu_font[1],
				);

				if ( $button_font_style === 'body' ) {
					$button_font = $body_font;
				} elseif ( $button_font_style === 'heading' ) {
					$button_font = $headings_font;
				} else {
					$button_font = explode( '|', $button_font );
					$button_font = array(
						'font'   => $button_font[0],
						'weight' => $button_font[1],
					);
				}

				if ( $loop_post_title_font_style === 'body' ) {
					$loop_post_title_font = $body_font;
				} elseif ( $loop_post_title_font_style === 'heading' ) {
					$loop_post_title_font = $headings_font;
				} else {
					$loop_post_title_font = explode( '|', $loop_post_title_font );
					$loop_post_title_font = array(
						'font'   => $loop_post_title_font[0],
						'weight' => $loop_post_title_font[1],
					);
				}

				if ( $single_post_title_font_style === 'body' ) {
					$single_post_title_font = $body_font;
				} elseif ( $single_post_title_font_style === 'heading' ) {
					$single_post_title_font = $headings_font;
				} else {
					$single_post_title_font = explode( '|', $single_post_title_font );
					$single_post_title_font = array(
						'font'   => $single_post_title_font[0],
						'weight' => $single_post_title_font[1],
					);
				}

				if ( $single_product_title_font_style === 'body' ) {
					$single_product_title_font = $body_font;
				} elseif ( $single_product_title_font_style === 'heading' ) {
					$single_product_title_font = $headings_font;
				} else {
					$single_product_title_font = explode( '|', $single_product_title_font );
					$single_product_title_font = array(
						'font'   => $single_product_title_font[0],
						'weight' => $single_product_title_font[1],
					);
				}

				if ( $shop_product_title_font_style === 'body' ) {
					$shop_product_title_font = $body_font;
				} elseif ( $shop_product_title_font_style === 'heading' ) {
					$shop_product_title_font = $headings_font;
				} else {
					$shop_product_title_font = explode( '|', $shop_product_title_font );
					$shop_product_title_font = array(
						'font'   => $shop_product_title_font[0],
						'weight' => $shop_product_title_font[1],
					);
				}
				
				if ( 'System default' !== $body_font['font'] ) {
					$css .= $body_selector . '{ font-family:' . esc_attr( $body_font['font'] ) . '; font-weight: '. esc_attr( $body_font['weight'] ) .';}' . "\n";  
				}
				
				if ( 'System default' !== $headings_font['font'] ) {
					$selectors = array(
						'h1',
						'h2',
						'h3',
						'h4',
						'h5',
						'h6',
						'.site-title',
						'.wc-block-grid__product-title',
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:' . esc_attr( $headings_font['font'] ) . '; font-weight: '. esc_attr( $headings_font['weight'] ) .';}' . "\n";
				}
				
				if ( 'System default' !== $button_font['font'] ) {
					$selectors = array(
						'button',
						'a.button',
						'.wp-block-button__link',
						'input[type="button"]',
						'input[type="reset"]',
						'input[type="submit"]',
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:' . esc_attr( $button_font['font'] ) . '; font-weight: '. esc_attr( $button_font['weight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $loop_post_title_font['font'] ) {
					$css .= $empty_selector . '.posts-archive .entry-title { font-family:' . esc_attr( $loop_post_title_font['font'] ) . '; font-weight: '. esc_attr( $loop_post_title_font['weight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $single_post_title_font['font'] ) {
					$css .= $empty_selector . '.single .entry-header .entry-title { font-family:' . esc_attr( $single_post_title_font['font'] ) . '; font-weight: '. esc_attr( $single_post_title_font['weight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $single_product_title_font['font'] ) {
					$css .= $empty_selector . '.product-gallery-summary .entry-title { font-family:' . esc_attr( $single_product_title_font['font'] ) . '; font-weight: '. esc_attr( $single_product_title_font['weight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $shop_product_title_font['font'] ) {
					$selectors = array(
						'ul.products li.product .botiga-wc-loop-product__title', 
						'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title', 
						'ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title', 
						'ul.wc-block-grid__products li.product .wc-block-grid__product-title', 
						'ul.wc-block-grid__products li.product .woocommerce-loop-product__title', 
						'ul.products li.wc-block-grid__product .wc-block-grid__product-title', 
						'ul.products li.wc-block-grid__product .woocommerce-loop-product__title', 
						'ul.products li.product .wc-block-grid__product-title', 
						'ul.products li.product .woocommerce-loop-product__title', 
						'ul.products li.product .woocommerce-loop-category__title', 
						'.woocommerce-loop-product__title .botiga-wc-loop-product__title', 
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:' . esc_attr( $shop_product_title_font['font'] ) . '; font-weight: '. esc_attr( $shop_product_title_font['weight'] ) .';}' . "\n";
				}

				if ( 'System default' !== $header_menu_font['font'] ) {
					if( class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'hf-builder' ) ) {
						$selectors = array(
							'.bhfb-header .main-navigation',
							'.bhfb-header .secondary-navigation',
						);
						$selector = self::get_mounted_selector( $selectors, $empty_selector );

						$css .= $selector . '{ font-family:' . esc_attr( $header_menu_font['font'] ) . '; font-weight: '. esc_attr( $header_menu_font['weight'] ) .';}' . "\n";
					} else {
						$selectors = array(
							'.top-bar .secondary-navigation',
							'#masthead .main-navigation',
							'.botiga-offcanvas-menu .main-navigation',
							'.bottom-header-row .main-navigation',
						);
						$selector = self::get_mounted_selector( $selectors, $empty_selector );

						$css .= $selector . '{ font-family:' . esc_attr( $header_menu_font['font'] ) . '; font-weight: '. esc_attr( $header_menu_font['weight'] ) .';}' . "\n";
					}   
				}
			}

			if( $fonts_library === 'custom' ) {

				// Embed custom fonts
				$css .= botiga_get_custom_fonts() . "\n";   

				$body_font                       = get_theme_mod( 'botiga_body_custom_font', 'System default' );
				$headings_font                   = get_theme_mod( 'botiga_headings_custom_font', '' );
				$header_menu_font                = get_theme_mod( 'botiga_header_menu_custom_font', $body_font );
				$button_font                     = get_theme_mod( 'button_custom_font', '' );
				$button_font_style               = get_theme_mod( 'button_font_style', 'custom' );
				$loop_post_title_font            = get_theme_mod( 'loop_post_title_custom_font', '' );
				$loop_post_title_font_style      = get_theme_mod( 'loop_post_title_font_style', 'heading' );
				$single_post_title_font          = get_theme_mod( 'single_post_title_custom_font', '' );
				$single_post_title_font_style    = get_theme_mod( 'single_post_title_font_style', 'heading' );
				$single_product_title_font       = get_theme_mod( 'single_product_title_custom_font', '' );
				$single_product_title_font_style = get_theme_mod( 'single_product_title_font_style', 'heading' );
				$shop_product_title_font         = get_theme_mod( 'shop_product_title_custom_font', '' );
				$shop_product_title_font_style   = get_theme_mod( 'shop_product_title_font_style', 'heading' );

				if ( $button_font_style === 'body' ) {
					$button_font = $body_font;
				} elseif ( $button_font_style === 'heading' ) {
					$button_font = $headings_font;
				}

				if ( $loop_post_title_font_style === 'body' ) {
					$loop_post_title_font = $body_font;
				} elseif ( $loop_post_title_font_style === 'heading' ) {
					$loop_post_title_font = $headings_font;
				}

				if ( $single_post_title_font_style === 'body' ) {
					$single_post_title_font = $body_font;
				} elseif ( $single_post_title_font_style === 'heading' ) {
					$single_post_title_font = $headings_font;
				}

				if ( $single_product_title_font_style === 'body' ) {
					$single_product_title_font = $body_font;
				} elseif ( $single_product_title_font_style === 'heading' ) {
					$single_product_title_font = $headings_font;
				}

				if ( $shop_product_title_font_style === 'body' ) {
					$shop_product_title_font = $body_font;
				} elseif ( $shop_product_title_font_style === 'heading' ) {
					$shop_product_title_font = $headings_font;
				}

				if ( 'System default' !== $body_font ) {
					$css .= $body_selector . '{ font-family:"' . esc_attr( $body_font ) . '";}' . "\n"; 
				}
				
				if ( ! empty( $headings_font ) && 'System default' !== $headings_font ) {
					$selectors = array(
						'h1',
						'h2',
						'h3',
						'h4',
						'h5',
						'h6',
						'.site-title',
						'.wc-block-grid__product-title',
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:"' . esc_attr( $headings_font ) . '";}' . "\n";
				}
				
				if ( ! empty( $button_font ) && 'System default' !== $button_font ) {
					$selectors = array(
						'button',
						'a.button',
						'.wp-block-button__link',
						'input[type="button"]',
						'input[type="reset"]',
						'input[type="submit"]',
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:"' . esc_attr( $button_font ) . '";}' . "\n";
				}

				if ( ! empty( $loop_post_title_font ) && 'System default' !== $loop_post_title_font ) {
					$css .= $empty_selector . '.posts-archive .entry-title { font-family:"' . esc_attr( $loop_post_title_font ) . '";}' . "\n";
				}

				if ( ! empty( $single_post_title_font ) && 'System default' !== $single_post_title_font ) {
					$css .= $empty_selector . '.single .entry-header .entry-title { font-family:"' . esc_attr( $single_post_title_font ) . '";}' . "\n";
				}

				if ( ! empty( $single_product_title_font ) && 'System default' !== $single_product_title_font ) {
					$css .= $empty_selector . '.product-gallery-summary .entry-title { font-family:"' . esc_attr( $single_product_title_font ) . '";}' . "\n";
				}

				if ( ! empty( $shop_product_title_font ) && 'System default' !== $shop_product_title_font ) {
					$selectors = array(
						'ul.products li.product .botiga-wc-loop-product__title', 
						'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title', 
						'ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title', 
						'ul.wc-block-grid__products li.product .wc-block-grid__product-title', 
						'ul.wc-block-grid__products li.product .woocommerce-loop-product__title', 
						'ul.products li.wc-block-grid__product .wc-block-grid__product-title', 
						'ul.products li.wc-block-grid__product .woocommerce-loop-product__title', 
						'ul.products li.product .wc-block-grid__product-title', 
						'ul.products li.product .woocommerce-loop-product__title', 
						'ul.products li.product .woocommerce-loop-category__title', 
						'.woocommerce-loop-product__title .botiga-wc-loop-product__title', 
					);
					$selector = self::get_mounted_selector( $selectors, $empty_selector );

					$css .= $selector . '{ font-family:"' . esc_attr( $shop_product_title_font ) . '";}' . "\n";
				}

				if ( 'System default' !== $header_menu_font ) {
					if( class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'hf-builder' ) ) {
						$selectors = array(
							'.bhfb-header .main-navigation', 
							'.bhfb-header .secondary-navigation',
						);
						$selector = self::get_mounted_selector( $selectors, $empty_selector );

						$css .= $selector . '{ font-family:"' . esc_attr( $header_menu_font ) . '";}' . "\n";
					} else {
						$selectors = array(
							'.top-bar .secondary-navigation', 
							'#masthead .main-navigation', 
							'.botiga-offcanvas-menu .main-navigation', 
							'.bottom-header-row .main-navigation',
						);
						$selector = self::get_mounted_selector( $selectors, $empty_selector );

						$css .= $selector . '{ font-family:"' . esc_attr( $header_menu_font ) . '";}' . "\n";
					}   
				}

			}

			// Headings typography
			$headings_font_style      = get_theme_mod( 'headings_font_style', 'normal' );
			$headings_line_height     = get_theme_mod( 'headings_line_height', 1.2 );
			$headings_letter_spacing  = get_theme_mod( 'headings_letter_spacing', 0 );
			$headings_text_transform  = get_theme_mod( 'headings_text_transform', 'none' );
			$headings_text_decoration = get_theme_mod( 'headings_text_decoration', 'none' );

			$selectors = array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'.site-title',
			);
			$selector = self::get_mounted_selector( $selectors, $empty_selector );

			$css .= $selector . "{ text-decoration:" . esc_attr( $headings_text_decoration ) . ";text-transform:" . esc_attr( $headings_text_transform ) . ";font-style:" . esc_attr( $headings_font_style ) . ";line-height:" . esc_attr( $headings_line_height ) . ";letter-spacing:" . esc_attr( $headings_letter_spacing ) . "px;}" . "\n"; 

			// Body typography
      		$body_font_style      = get_theme_mod( 'body_font_style', 'normal' );
			$body_line_height     = get_theme_mod( 'body_line_height', 1.68 );
			$body_letter_spacing  = get_theme_mod( 'body_letter_spacing', 0 );
			$body_text_transform  = get_theme_mod( 'body_text_transform', 'none' );
			$body_text_decoration = get_theme_mod( 'body_text_decoration', 'none' );

			$css .= $body_selector . "{ text-decoration:" . esc_attr( $body_text_decoration ) . ";text-transform:" . esc_attr( $body_text_transform ) . ";font-style:" . esc_attr( $body_font_style ) . ";line-height:" . esc_attr( $body_line_height ) . ";letter-spacing:" . esc_attr( $body_letter_spacing ) . "px;}" . "\n";
			$css .= $empty_selector . ".site-header-cart .widget_shopping_cart .woocommerce-mini-cart__empty-message { line-height: " . esc_attr( $body_line_height ) . "; }";

			// Header menu typography
			$header_menu_font_style      = get_theme_mod( 'header_menu_font_style', $body_font_style );
			$header_menu_line_height     = get_theme_mod( 'header_menu_line_height', $body_line_height );
			$header_menu_letter_spacing  = get_theme_mod( 'header_menu_letter_spacing', $body_letter_spacing );
			$header_menu_text_transform  = get_theme_mod( 'header_menu_text_transform', $body_text_transform );
			$header_menu_text_decoration = get_theme_mod( 'header_menu_text_decoration', $body_text_decoration );

			if( class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'hf-builder' ) ) {
				$selectors = array(
					'.bhfb-header .main-navigation',
					'.bhfb-header .secondary-navigation',
					'.bhfb-mobile_offcanvas .main-navigation',
					'.bhfb-mobile_offcanvas .secondary-navigation',
				);
				$selector = self::get_mounted_selector( $selectors, $empty_selector );

				$css .= $selector . "{ text-decoration:" . esc_attr( $header_menu_text_decoration ) . ";text-transform:" . esc_attr( $header_menu_text_transform ) . ";font-style:" . esc_attr( $header_menu_font_style ) . ";line-height:" . esc_attr( $header_menu_line_height ) . ";letter-spacing:" . esc_attr( $header_menu_letter_spacing ) . "px;}" . "\n";              
			} else {
				$selectors = array(
					'.top-bar .secondary-navigation',
					'#masthead .main-navigation',
					'.botiga-offcanvas-menu .main-navigation',
					'.bottom-header-row .main-navigation',
				);
				$selector = self::get_mounted_selector( $selectors, $empty_selector );

				$css .= $selector . "{ text-decoration:" . esc_attr( $header_menu_text_decoration ) . ";text-transform:" . esc_attr( $header_menu_text_transform ) . ";font-style:" . esc_attr( $header_menu_font_style ) . ";line-height:" . esc_attr( $header_menu_line_height ) . ";letter-spacing:" . esc_attr( $header_menu_letter_spacing ) . "px;}" . "\n";
			}

			return $css;
		}

		/**
		 * Output all custom CSS
		 */
		public function output_css( $custom_css = false ) {
			global $post;

			$css = '';

			//Typograhpy
			$css .= $this->get_typography_css( 'frontend' );

			// Body variables.
			$css .= self::get_variables_css(
				'body',
				array(

					// Font sizes.
					array(
						'setting'  => 'body_font_size',
						'defaults' => array( 'desktop' => 16, 'tablet'  => 16, 'mobile'  => 16 ),
						'name'     => '--bt-font-size-body',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'h1_font_size',
						'defaults' => array( 'desktop' => 64, 'tablet'  => 42, 'mobile'  => 32 ),
						'name'     => '--bt-font-size-h1',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'h2_font_size',
						'defaults' => array( 'desktop' => 48, 'tablet'  => 32, 'mobile'  => 24 ),
						'name'     => '--bt-font-size-h2',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'h3_font_size',
						'defaults' => array( 'desktop' => 32, 'tablet'  => 24, 'mobile'  => 20 ),
						'name'     => '--bt-font-size-h3',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'h4_font_size',
						'defaults' => array( 'desktop' => 24, 'tablet'  => 18, 'mobile'  => 16 ),
						'name'     => '--bt-font-size-h4',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'h5_font_size',
						'defaults' => array( 'desktop' => 18, 'tablet'  => 16, 'mobile'  => 16 ),
						'name'     => '--bt-font-size-h5',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'h6_font_size',
						'defaults' => array( 'desktop' => 16, 'tablet'  => 16, 'mobile'  => 16 ),
						'name'     => '--bt-font-size-h6',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'button_font_size',
						'defaults' => array( 'desktop' => 14, 'tablet'  => 14, 'mobile'  => 14 ),
						'name'     => '--bt-font-size-button',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'header_menu_font_size',
						'defaults' => array( 'desktop' => 16, 'tablet'  => 16, 'mobile'  => 16 ),
						'name'     => '--bt-font-size-header-menu',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'single_post_meta_size',
						'defaults' => array( 'desktop' => 14, 'tablet'  => 14, 'mobile'  => 14 ),
						'name'     => '--bt-font-size-post-meta',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'single_post_title_size',
						'defaults' => array( 'desktop' => 32, 'tablet'  => 32, 'mobile'  => 32 ),
						'name'     => '--bt-font-size-post-title',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'loop_post_text_size',
						'defaults' => array( 'desktop' => 16, 'tablet'  => 16, 'mobile'  => 16 ),
						'name'     => '--bt-font-size-loop-post-text',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'loop_post_meta_size',
						'defaults' => array( 'desktop' => 14, 'tablet'  => 14, 'mobile'  => 14 ),
						'name'     => '--bt-font-size-loop-post-meta',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'loop_post_title_size',
						'defaults' => array( 'desktop' => 18, 'tablet'  => 18, 'mobile'  => 18 ),
						'name'     => '--bt-font-size-loop-post-title',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'shop_product_title_size',
						'defaults' => array( 'desktop' => 16, 'tablet'  => 16, 'mobile'  => 16 ),
						'name'     => '--bt-font-size-prod-card-title',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'single_product_title_size',
						'defaults' => array( 'desktop' => 32, 'tablet'  => 32, 'mobile'  => 32 ),
						'name'     => '--bt-font-size-single-prod-title',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'single_product_price_size',
						'defaults' => array( 'desktop' => 24, 'tablet'  => 24, 'mobile'  => 24 ),
						'name'     => '--bt-font-size-single-prod-price',
						'unit'     => 'px',
					),
					array(
						'setting'  => 'footer_widgets_title_size',
						'defaults' => array( 'desktop' => 20, 'tablet'  => 20, 'mobile'  => 20 ),
						'name'     => '--bt-font-size-footer-widgets-title',
						'unit'     => 'px',
					),
				)
			);
			
			$css .= self::get_variables_css(
				'body',
				array(
					array(
						'setting'  => 'color_forms_text',
						'defaults' => '#212121',
						'name'     => '--bt-color-forms-text',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_forms_background',
						'defaults' => '#ffffff',
						'name'     => '--bt-color-forms-background',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_forms_borders',
						'defaults' => '#212121',
						'name'     => '--bt-color-forms-borders',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_forms_dividers',
						'defaults' => '#dddddd',
						'name'     => '--bt-color-forms-dividers',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_forms_placeholder',
						'defaults' => '#848484',
						'name'     => '--bt-color-forms-placeholder',
						'unit'     => '',
					),
					array(
						'setting'  => 'content_cards_background',
						'defaults' => '#f2f2f2',
						'name'     => '--bt-color-content-cards-bg',
						'unit'     => '',
					),
					array(
						'setting'  => 'background_color',
						'defaults' => '#FFF',
						'name'     => '--bt-color-bg',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_heading_1',
						'defaults' => '#212121',
						'name'     => '--bt-color-heading-1',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_heading_2',
						'defaults' => '#212121',
						'name'     => '--bt-color-heading-2',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_heading_3',
						'defaults' => '#212121',
						'name'     => '--bt-color-heading-3',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_heading_4',
						'defaults' => '#212121',
						'name'     => '--bt-color-heading-4',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_heading_5',
						'defaults' => '#212121',
						'name'     => '--bt-color-heading-5',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_heading_6',
						'defaults' => '#212121',
						'name'     => '--bt-color-heading-6',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_body_text',
						'defaults' => '#212121',
						'name'     => '--bt-color-body-text',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_link_default',
						'defaults' => '#212121',
						'name'     => '--bt-color-link-default',
						'unit'     => '',
					),
					array(
						'setting'  => 'color_link_hover',
						'defaults' => '#757575',
						'name'     => '--bt-color-link-hover',
						'unit'     => '',
					),
					array(
						'setting'  => 'button_color',
						'defaults' => '#FFF',
						'name'     => '--bt-color-button',
						'unit'     => '',
					),
					array(
						'setting'  => 'button_color_hover',
						'defaults' => '#FFF',
						'name'     => '--bt-color-button-hover',
						'unit'     => '',
					),
					array(
						'setting'  => 'button_background_color',
						'defaults' => '#212121',
						'name'     => '--bt-color-button-bg',
						'unit'     => '',
					),
					array(
						'setting'  => 'button_background_color_hover',
						'defaults' => '#757575',
						'name'     => '--bt-color-button-bg-hover',
						'unit'     => '',
					),
				)
			);

			//Global colors
			$css .= $this->get_color_css( 'site_title_color', '', '.site-header .site-title a' );
			$css .= $this->get_color_css( 'site_description_color', '', '.site-description' );
			$css .= $this->get_color_css( 'color_link_default', '', 'a' );
			$css .= $this->get_color_css( 'color_link_hover', '', 'a:hover, .wp-block-columns p a:hover,.widget a:hover' );

			//Header
			$header_layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );

			if ( class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'hf-builder' ) ) {
				
				/**
				 * Hook 'botiga_bhfb_custom_css'
				 *
				 * @since 1.0.0
				 */
				$css .= apply_filters( 'botiga_bhfb_custom_css', Botiga_Header_Footer_Builder::custom_css() );

			} else {
				$css .= $this->get_max_width_css( 'site_logo_size', $defaults = array( 'desktop' => 180, 'tablet' => 100, 'mobile' => 100 ), '.custom-logo-link img' );

				$css .= $this->get_background_color_css( 'topbar_background', '', '.top-bar' );
				$css .= $this->get_background_color_css( 'topbar_submenu_background_color', '', '.top-bar .top-bar-login-register nav, .top-bar .botiga-dropdown .sub-menu .botiga-dropdown-li' );
				$css .= $this->get_color_css( 'topbar_color', '#212121', '.top-bar, .top-bar a, .top-header-row, .top-header-row a, .top-bar .top-bar-login-register nav > a' );
				$css .= $this->get_color_css( 'topbar_color_hover', '#757575', '.top-bar a:hover, .top-header-row a:hover, .top-bar .top-bar-login-register nav > a:hover' );
				$css .= $this->get_fill_css( 'topbar_color', '', '.top-bar svg:not(.stroke-based), .top-bar .dropdown-symbol .ws-svg-icon svg' );
				$css .= $this->get_fill_css( 'topbar_color_hover', '', '.top-bar .botiga-dropdown .botiga-dropdown-li:hover > .dropdown-symbol .ws-svg-icon svg' );

				$css .= $this->get_border_color_rgba_css( 'topbar_color', '#212121', '.top-bar .top-bar-login-register nav>a+a', 0.08 );
				$css .= $this->get_border_color_css( 'topbar_color', '#212121', '.top-bar .top-bar-login-register >a:after' );
				$css .= $this->get_border_color_css( 'topbar_color_hover', '#212121', '.top-bar .top-bar-login-register >a:hover:after' );

				$topbar_padding     = get_theme_mod( 'topbar_padding', 15 );
				$css .= ".top-bar-inner { padding-top:" . esc_attr( $topbar_padding ) . 'px;padding-bottom:' . esc_attr( $topbar_padding ) . "px;}" . "\n";
				$topbar_divider_width   = get_theme_mod( 'topbar_divider_width', 'fullwidth' );
				$topbar_divider_size    = get_theme_mod( 'topbar_divider_size', 1 );
				$topbar_divider_color   = get_theme_mod( 'topbar_divider_color', 'rgba(33,33,33,0.1)' );

				
				if ( 'fullwidth' === $topbar_divider_width ) {
					$css .= ".top-bar { border-bottom:" . esc_attr( $topbar_divider_size ) . 'px solid ' . esc_attr( $topbar_divider_color ) . ";}" . "\n";
				} else {
					$css .= ".top-bar-inner { border-bottom:" . esc_attr( $topbar_divider_size ) . 'px solid ' . esc_attr( $topbar_divider_color ) . ";}.top-bar {border-bottom:0;}" . "\n";
				}

				$main_header_divider_width  = get_theme_mod( 'main_header_divider_width', 'fullwidth' );
				$main_header_divider_size   = get_theme_mod( 'main_header_divider_size', 0 );
				$main_header_divider_color  = get_theme_mod( 'main_header_divider_color', 'rgba(33,33,33,0.1)' );
				
				if ( 'fullwidth' === $main_header_divider_width ) {
					$css .= ".site-header, .bottom-header-row { border-bottom:" . esc_attr( $main_header_divider_size ) . 'px solid ' . esc_attr( $main_header_divider_color ) . ";}" . "\n";
					if ( 0 == $main_header_divider_size ) {
						$css .= ".header_layout_3,.header_layout_4,.header_layout_5 { border-bottom: 1px solid " . esc_attr( $main_header_divider_color ) . ";}" . "\n";
					}            
				} else {
					$css .= ".top-header-row,.site-header-inner, .bottom-header-inner { border-bottom:" . esc_attr( $main_header_divider_size ) . 'px solid ' . esc_attr( $main_header_divider_color ) . ";} .site-header,.bottom-header-row {border:0;}" . "\n";
					if ( 0 == $main_header_divider_size ) {
						$css .= ".top-header-row { border-bottom: 1px solid " . esc_attr( $main_header_divider_color ) . ";}" . "\n";
					}            
				}

				$center_top_bar_contents = get_theme_mod( 'center_top_bar_contents', 0 );
				if ( $center_top_bar_contents ) {
					$css .= ".top-bar-inner > .row { display:block;} .top-bar-inner .col,.top-bar-inner .col:last-of-type {-webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; text-align: center;}" . "\n";
				}

				$css .= $this->get_background_color_css( 'main_header_background', '', '.site-header,.header-search-form' );
				$css .= $this->get_color_css( 'main_header_color', '', '.site-header .site-title a,.site-header .site-description,.site-header .botiga-dropdown .menu > .botiga-dropdown-li > .botiga-dropdown-link, .site-header .header-contact a, .site-header .header-login-register>a, .site-header .header-login-register nav>a' );
				$css .= $this->get_color_css( 'main_header_color_hover', '', '.site-header .site-title a:hover,.site-header .botiga-dropdown .menu > .botiga-dropdown-li > .botiga-dropdown-link:hover, .site-header .header-contact a:hover, .site-header .header-login-register>a:hover, .site-header .header-login-register nav>a:hover, .site-header .botiga-dropdown .menu > .botiga-dropdown-li:hover > .botiga-dropdown-link, .site-header .header-contact a:hover' );
				$css .= $this->get_background_color_css( 'main_header_minicart_count_background_color', '', '.site-header-cart .count-number, .header-wishlist-icon .count-number' );
				$css .= $this->get_border_color_css( 'main_header_minicart_count_background_color', '', '.site-header-cart .count-number, .header-wishlist-icon .count-number' );
				$css .= $this->get_color_css( 'main_header_minicart_count_text_color', '', '.site-header-cart .count-number, .header-wishlist-icon .count-number' );
				$css .= $this->get_fill_css( 'main_header_color', '', '.site-header a svg:not(.stroke-based), .site-header a svg:not(.stroke-based), .site-header a .dropdown-symbol .ws-svg-icon svg, .site-header .dropdown-symbol .ws-svg-icon svg' );
				$css .= $this->get_background_color_css( 'main_header_color', '', '.site-header .botiga-image.is-svg' );
				$css .= $this->get_fill_css( 'main_header_color_hover', '', '.site-header .botiga-dropdown .menu > .botiga-dropdown-li:hover > .dropdown-symbol svg, .site-header a:hover svg:not(.stroke-based), .site-header a:hover svg:not(.stroke-based), .site-header a:hover .dropdown-symbol .ws-svg-icon svg' );
				$css .= $this->get_background_color_css( 'main_header_color_hover', '', '.site-header .botiga-image.is-svg:hover' );
				$css .= $this->get_stroke_css( 'main_header_color', '', '.site-header .header-item svg.stroke-based' );
				$css .= $this->get_stroke_css( 'main_header_color_hover', '', '.site-header .header-item a:hover svg.stroke-based' );
				
				// Bottom header row
				$css .= $this->get_background_color_css( 'main_header_bottom_background', '', '.bottom-header-row' );
				$css .= $this->get_color_css( 'main_header_bottom_color', '#212121', '.bottom-header-row, .bottom-header-row .header-contact a,.bottom-header-row .botiga-dropdown .menu > .botiga-dropdown-li > .botiga-dropdown-link' );
				$css .= $this->get_color_css( 'main_header_bottom_color_hover', '#757575', '.bottom-header-row .header-contact a:hover,.bottom-header-row .botiga-dropdown .menu > .botiga-dropdown-li:hover > .botiga-dropdown-link' );

				$css .= $this->get_color_css( 'main_header_bottom_color', '#212121', '.bottom-header-row .header-login-register>a' );
				$css .= $this->get_color_css( 'main_header_bottom_color_hover', '#212121', '.bottom-header-row .header-login-register>a:hover' );
				$css .= $this->get_border_color_rgba_css( 'main_header_bottom_color', '#212121', '.bottom-header-row .header-login-register nav>a+a', 0.08 );
				$css .= $this->get_border_color_css( 'main_header_bottom_color', '#212121', '.bottom-header-row .header-login-register >a:after', true );
				$css .= $this->get_border_color_css( 'main_header_bottom_color_hover', '#212121', '.bottom-header-row .header-login-register >a:hover:after', true );

				$css .= $this->get_fill_css( 'main_header_bottom_color_hover', '#757575', '.bottom-header-row .botiga-dropdown .menu > .botiga-dropdown-li:hover > .dropdown-symbol svg' );
				$css .= $this->get_fill_css( 'main_header_bottom_color', '#212121', '.bottom-header-row .header-item svg:not(.stroke-based),.bottom-header-row .dropdown-symbol .ws-svg-icon svg' );
				$css .= $this->get_fill_css( 'main_header_bottom_color_hover', '#757575', '.bottom-header-row a:hover svg:not(.stroke-based),.bottom-header-row .dropdown-symbol:hover .ws-svg-icon svg' );
				$css .= $this->get_stroke_css( 'main_header_bottom_color', '#212121', '.bottom-header-row .header-item svg.stroke-based' );
				$css .= $this->get_stroke_css( 'main_header_bottom_color_hover', '#212121', '.bottom-header-row a:hover svg.stroke-based' );
				
				$main_header_padding    = get_theme_mod( 'main_header_padding', 15 );
				$css .= ".site-header .site-header-inner, .site-header .top-header-row { padding-top:" . esc_attr( $main_header_padding ) . 'px;padding-bottom:' . esc_attr( $main_header_padding ) . "px;}" . "\n";

				$main_header_bottom_padding = get_theme_mod( 'main_header_bottom_padding', 15 );
				$css .= ".bottom-header-inner { padding-top:" . esc_attr( $main_header_bottom_padding ) . 'px;padding-bottom:' . esc_attr( $main_header_bottom_padding ) . "px;}" . "\n";

				$css .= $this->get_background_color_css( 'main_header_submenu_background', '', '.site-header .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li, .site-header .header-login-register nav, .bottom-header-row .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li, .botiga-desktop-offcanvas-menu .botiga-dropdown .botiga-mega-menu>.sub-menu>.botiga-dropdown-li>.sub-menu .menu-item-has-children:hover>.sub-menu' );
				$css .= $this->get_color_css( 'main_header_submenu_color', '#212121', '.site-header .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-link, .site-header .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul > .botiga-dropdown-li:hover > .dropdown-symbol svg, .site-header .header-login-register nav>a, .bottom-header-row .header-login-register nav>a' );
				$css .= $this->get_color_css( 'main_header_submenu_color_hover', '#757575', '.site-header .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li:hover > .botiga-dropdown-link, .site-header .header-login-register nav>a:hover, .bottom-header-row .header-login-register nav>a:hover' );
				$css .= $this->get_fill_css( 'main_header_submenu_color', '#212121', '.site-header .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li > .dropdown-symbol svg' );
				$css .= $this->get_fill_css( 'main_header_submenu_color_hover', '#757575', '.site-header .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li:hover > .dropdown-symbol svg' );

				$css .= $this->get_color_css( 'main_header_color', '#212121', '.site-header .header-login-register>a' );
				$css .= $this->get_border_color_rgba_css( 'main_header_color', '#212121', '.site-header .header-login-register nav>a+a', 0.08 );
				$css .= $this->get_border_color_css( 'main_header_color', '#212121', '.site-header .header-login-register >a:after', true );
				$css .= $this->get_border_color_css( 'main_header_color_hover', '#212121', '.site-header .header-login-register >a:hover:after', true );

				//Sticky header active state
				$sticky_header = get_theme_mod( 'enable_sticky_header', 0 );
				if( $sticky_header ) {

					$site_header_inner_selector = '.site-header-inner';
					if( in_array( $header_layout, array( 'header_layout_3', 'header_layout_4', 'header_layout_5' ) ) ) {
						$site_header_inner_selector = '.bottom-header-inner';
					}

					$css .= '.sticky-header, .sticky-header .ws-svg-icon svg { -webkit-transition: ease all 300ms; transition: ease all 300ms; }';
					$css .= '@media only screen and (min-width: 1025px) {';
						// background color
						$css .= $this->get_background_color_css( 'main_header_sticky_active_background', '', '.sticky-header-active .sticky-header, .header-search-form' );

						// text color
						$css .= $this->get_color_css( 'main_header_sticky_active_color', '', ".sticky-header-active .sticky-header $site_header_inner_selector .site-title a, .sticky-header-active .sticky-header $site_header_inner_selector .site-description, .sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .menu > .botiga-dropdown-li > .botiga-dropdown-link, .sticky-header-active .sticky-header $site_header_inner_selector .header-contact a, .sticky-header-active .sticky-header .header-login-register>a", true );
						$css .= $this->get_border_color_css( 'main_header_sticky_active_color', '', ".sticky-header-active .sticky-header $site_header_inner_selector .header-login-register>a:after", true );
						$css .= $this->get_fill_css( 'main_header_sticky_active_color', '', ".sticky-header-active .sticky-header $site_header_inner_selector .header-item svg:not(.stroke-based), .sticky-header-active .sticky-header $site_header_inner_selector .dropdown-symbol .ws-svg-icon svg" );
						$css .= $this->get_stroke_css( 'main_header_sticky_active_color', '', ".sticky-header-active .sticky-header $site_header_inner_selector .header-item svg.stroke-based" );
						$css .= $this->get_background_color_css( 'main_header_sticky_active_color', '', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-image.is-svg" );

						// text color hover
						$css .= $this->get_color_css( 'main_header_sticky_active_color_hover', '', ".sticky-header-active .sticky-header $site_header_inner_selector .site-title a:hover, .sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .menu > .botiga-dropdown-li:hover > .botiga-dropdown-link, .sticky-header-active .sticky-header $site_header_inner_selector .header-contact a:hover, .sticky-header-active .sticky-header .header-login-register>a:hover", true );
						$css .= $this->get_border_color_css( 'main_header_sticky_active_color_hover', '', ".sticky-header-active .sticky-header $site_header_inner_selector .header-login-register>a:hover:after", true );
						$css .= $this->get_fill_css( 'main_header_sticky_active_color_hover', '', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .menu > .botiga-dropdown-li:hover > .dropdown-symbol svg, .sticky-header-active .sticky-header $site_header_inner_selector .header-item:not(.header-contact):hover svg:not(.stroke-based)" );
						$css .= $this->get_stroke_css( 'main_header_sticky_active_color_hover', '', ".sticky-header-active .sticky-header $site_header_inner_selector .header-item:hover svg.stroke-based" );
						$css .= $this->get_background_color_css( 'main_header_sticky_active_color_hover', '', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-image.is-svg:hover" );

						// Submenu 
						$css .= $this->get_background_color_css( 'main_header_sticky_active_submenu_background_color', '#FFF', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li, .header-login-register nav" );
						$css .= $this->get_color_css( 'main_header_sticky_active_submenu_color', '#212121', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li > .botiga-dropdown-link, .header-login-register nav>a", true );
						$css .= $this->get_fill_css( 'main_header_sticky_active_submenu_color', '#212121', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li > .dropdown-symbol svg" );
						$css .= $this->get_fill_css( 'main_header_sticky_active_submenu_color_hover', '#757575', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li:hover > .dropdown-symbol svg" );
						$css .= $this->get_color_css( 'main_header_sticky_active_submenu_color_hover', '#757575', ".sticky-header-active .sticky-header $site_header_inner_selector .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-ul .botiga-dropdown-li:hover > .botiga-dropdown-link, .header-login-register nav>a:hover", true );
						
					$css .= '}';
				}

				//Header Layout 6
				if( 'header_layout_6' === $header_layout ) {
					$main_header_areas_spacing_l6    = get_theme_mod( 'main_header_areas_spacing_l6', 15 );
					$main_header_elements_spacing_l6 = get_theme_mod( 'main_header_elements_spacing_l6', 15 );
					$main_header_padding             = get_theme_mod( 'main_header_padding', 15 );

					$css .= '.header_layout_6 .botiga-desktop-offcanvas > .row > div { margin-top: '. esc_attr( $main_header_areas_spacing_l6 ) .'px; }';
					$css .= '.header_layout_6 .header-item { margin-bottom: '. esc_attr( $main_header_elements_spacing_l6 ) .'px; }';
					$css .= '.header_layout_6 .header-item.header-contact a + a { margin-top: '. esc_attr( $main_header_elements_spacing_l6 ) .'px; }';
					$css .= '.header_layout_6 .botiga-desktop-offcanvas { padding: '. esc_attr( $main_header_padding ) .'px; }';
				}

				// Header Layout 7
				if( 'header_layout_7' === $header_layout || 'header_layout_8' === $header_layout ) {
					$desktop_offcanvas_padding = get_theme_mod( 'desktop_offcanvas_padding', 30 );
					$desktop_offcanvas_menu_link_spacing = get_theme_mod( 'desktop_offcanvas_menu_link_spacing', 10 );
					$desktop_offcanvas_menu_link_separator = get_theme_mod( 'desktop_offcanvas_menu_link_separator', 0 );
					$desktop_offcanvas_content_areas_spacing = get_theme_mod( 'desktop_offcanvas_content_areas_spacing', 50 );
					$header_components_desktop_offcanvas_elements_spacing = get_theme_mod( 'header_components_desktop_offcanvas_elements_spacing', 15 );
					$desktop_offcanvas_menu_text_color = get_theme_mod( 'desktop_offcanvas_menu_text_color', '#212121' );

					$css .= $this->get_background_color_css( 'desktop_offcanvas_menu_background_color', '#FFF', '.botiga-desktop-offcanvas' );
					$css .= '.header_layout_7 .botiga-desktop-offcanvas, .header_layout_8 .botiga-desktop-offcanvas { padding: '. esc_attr( $desktop_offcanvas_padding ) .'px; }';
					$css .= '.header_layout_7 .botiga-desktop-offcanvas > .row > div, .header_layout_8 .botiga-desktop-offcanvas > .row > div { margin-top: '. esc_attr( $desktop_offcanvas_content_areas_spacing ) .'px; }';
					$css .= '.header_layout_7 .botiga-desktop-offcanvas .header-item, .header_layout_8 .botiga-desktop-offcanvas .header-item { margin-bottom: '. esc_attr( $header_components_desktop_offcanvas_elements_spacing ) .'px; }';
					$css .= '.header_layout_7 .botiga-desktop-offcanvas .header-item.header-contact a + a, .header_layout_8 .botiga-desktop-offcanvas .header-item.header-contact a + a { margin-top: '. esc_attr( $header_components_desktop_offcanvas_elements_spacing ) .'px; }';
					$css .= '.header_layout_7 .botiga-desktop-offcanvas .botiga-dropdown .menu > .botiga-dropdown-li > .botiga-dropdown-link, .header_layout_8 .botiga-desktop-offcanvas .botiga-dropdown .menu > .botiga-dropdown-li > .botiga-dropdown-link { padding-top: '. esc_attr( $desktop_offcanvas_menu_link_spacing ) .'px; padding-bottom: '. esc_attr( $desktop_offcanvas_menu_link_spacing ) .'px; }';

					if( $desktop_offcanvas_menu_link_separator ) {
						$desktop_offcanvas_link_separator_color = get_theme_mod( 'desktop_offcanvas_link_separator_color', '#212121' );

						$css .= '.header_layout_7 .botiga-desktop-offcanvas .botiga-dropdown .menu > .botiga-dropdown-li + .botiga-dropdown-li, .header_layout_8 .botiga-desktop-offcanvas .botiga-dropdown .menu > .botiga-dropdown-li + .botiga-dropdown-li { border-top: 1px solid '. esc_attr( self::get_instance()->to_rgba( $desktop_offcanvas_link_separator_color, '0.1' ) ) .'; }';
					}

					$css .= $this->get_color_css( 'desktop_offcanvas_menu_text_color', '#212121', '.botiga-desktop-offcanvas .botiga-dropdown .menu .botiga-dropdown-li .botiga-dropdown-link, .botiga-desktop-offcanvas .site-title a, .botiga-desktop-offcanvas .site-description .botiga-desktop-offcanvas .header-contact a' );
					$css .= '.botiga-desktop-offcanvas .botiga-dropdown .menu li a:hover, .botiga-desktop-offcanvas .header-contact a:hover { color: '. esc_attr( self::get_instance()->to_rgba( $desktop_offcanvas_menu_text_color, '0.7' ) ) .'; }';
					$css .= $this->get_fill_css( 'desktop_offcanvas_menu_text_color', '#212121', '.botiga-desktop-offcanvas .header-item svg:not(.stroke-based), .botiga-desktop-offcanvas .dropdown-symbol .ws-svg-icon svg, .desktop-menu-close svg' );
					$css .= $this->get_stroke_css( 'desktop_offcanvas_menu_text_color', '#212121', '.botiga-desktop-offcanvas .header-item svg.stroke-based' );             
				}
			}

			$css .= $this->get_background_color_rgba_css( 'color_body_text', '#212121', '.site-header-cart .widget_shopping_cart .widgettitle:after, .site-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons:before, .site-header-cart .widget_shopping_cart .botiga-woocommerce-mini-cart__cross-sell:before', '0.1' );

			//Mobile menu
			$mobile_menu_alignment = get_theme_mod( 'mobile_menu_alignment', 'left' );
			$css .= ".botiga-offcanvas-menu .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-li { text-align:" . esc_attr( $mobile_menu_alignment ) . ";}" . "\n";

			$mobile_menu_link_separator     = get_theme_mod( 'mobile_menu_link_separator', 0 );
			$link_separator_color           = get_theme_mod( 'link_separator_color', '#eeeeee' );
			$mobile_header_separator_width  = get_theme_mod( 'mobile_header_separator_width', 1 );

			if ( $mobile_menu_link_separator ) {
				$css .= ".botiga-offcanvas-menu .botiga-dropdown .botiga-dropdown-ul .botiga-dropdown-li { padding-top:5px;border-bottom: " . intval( $mobile_header_separator_width ) . "px solid " . esc_attr( $link_separator_color ) . ";}" . "\n";
			}

			$mobile_menu_link_spacing = get_theme_mod( 'mobile_menu_link_spacing', 20 );
			$css .= ".botiga-offcanvas-menu .botiga-dropdown .botiga-dropdown-link { padding:" . esc_attr( $mobile_menu_link_spacing )/2 . "px 0;}" . "\n";

			$mobile_menu_elements_spacing = get_theme_mod( 'mobile_menu_elements_spacing', 20 );
			$css .= ".botiga-offcanvas-menu .header-item + .header-item:not(.separator) { margin-top:" . esc_attr( $mobile_menu_elements_spacing ) . "px;}" . "\n";

			$css .= $this->get_background_color_css( 'mobile_header_background', '', '#masthead-mobile' );
			$css .= $this->get_color_css( 'mobile_header_color', '', '#masthead-mobile a:not(.button)' );
			$css .= $this->get_fill_css( 'mobile_header_color', '', '#masthead-mobile svg:not(.stroke-based)' );
			$css .= $this->get_stroke_css( 'mobile_header_color', '', '#masthead-mobile svg.stroke-based' );

			$mobile_header_padding = get_theme_mod( 'mobile_header_padding', 15 );
			$css .= ".mobile-header { padding-top:" . esc_attr( $mobile_header_padding ) . 'px;padding-bottom:' . esc_attr( $mobile_header_padding ) . "px;}" . "\n";

			$css .= self::get_variables_css(
				'.botiga-offcanvas-menu',
				array(
					array(
						'setting'  => 'offcanvas_menu_background',
						'defaults' => '',
						'name'     => '--bt-color-menu-bg',
						'unit'     => '',
					),
					array(
						'setting'  => 'offcanvas_menu_color',
						'defaults' => '',
						'name'     => '--bt-color-menu-text',
						'unit'     => '',
					),
				)
			);

			$offcanvas_mode = get_theme_mod( 'header_offcanvas_mode', 'layout1' );
			if ( 'layout2' === $offcanvas_mode ) {
				$css .= ".botiga-offcanvas-menu {max-width:100%;}" . "\n";
			}
			
			//Blog
			$list_image_size = get_theme_mod( 'archive_featured_image_size_desktop', 30 );
			$css .= ".posts-archive .list-image { width:" . esc_attr( $list_image_size ) . "%;}" . "\n";
			$css .= ".posts-archive .list-content { width:" . (100 - esc_attr( $list_image_size ) ) . "%;}" . "\n";

			$image_spacing = get_theme_mod( 'archive_featured_image_spacing_desktop', 16 );
			$css .= ".posts-archive:not(.layout4):not(.layout6) .post-thumbnail { margin:0 0 " . esc_attr( $image_spacing ) . "px 0;}" . "\n";
			$css .= ".posts-archive.layout4 .post-thumbnail, .posts-archive.layout6 .post-thumbnail { margin:0 " . esc_attr( $image_spacing ) . "px 0 0;}" . "\n";

			$archive_title_spacing = get_theme_mod( 'archive_title_spacing', 16 );
			$css .= ".posts-archive .entry-header { margin-bottom:" . esc_attr( $archive_title_spacing ) . "px;}" . "\n";

			$archive_meta_spacing = get_theme_mod( 'archive_meta_spacing', 8 );
			$css .= ".posts-archive .entry-meta { margin:" . esc_attr( $archive_meta_spacing ) . "px 0;}" . "\n";

			$css .= self::get_variables_css( 
				'.single',
				array(
					array(
						'setting'  => 'single_post_title_color',
						'defaults' => '#212121',
						'name'     => '--bt-color-post-title',
						'unit'     => '',
					),
					array(
						'setting'  => 'single_post_meta_color',
						'defaults' => '#666666',
						'name'     => '--bt-color-post-meta',
						'unit'     => '',
					),
				)
			);
			$css .= self::get_variables_css( 
				'.blog',
				array(
					array(
						'setting'  => 'loop_post_text_color',
						'defaults' => '#212121',
						'name'     => '--bt-color-loop-post-text',
						'unit'     => '',
					),
					array(
						'setting'  => 'loop_post_title_color',
						'defaults' => '#212121',
						'name'     => '--bt-color-loop-post-title',
						'unit'     => '',
					),
					array(
						'setting'  => 'loop_post_meta_color',
						'defaults' => '#212121',
						'name'     => '--bt-color-loop-post-meta',
						'unit'     => '',
					),
				)
			);

			$loop_post_title_text_transform  = get_theme_mod( 'loop_post_title_text_transform', 'none' );
			$loop_post_title_text_decoration = get_theme_mod( 'loop_post_title_text_decoration', 'none' );
			$css .= ".posts-archive .entry-title { text-transform:" . esc_attr( $loop_post_title_text_transform ) . "; text-decoration:" . esc_attr( $loop_post_title_text_decoration ) . ";}" . "\n";

			//Single 
			$single_post_header_alignment = get_theme_mod( 'single_post_header_alignment', 'middle' );
			if ( 'middle' !== $single_post_header_alignment ) {
				$css .= ".single .entry-header { text-align:left;}" . "\n";
			}

			$single_post_header_spacing = get_theme_mod( 'single_post_header_spacing', 40 );
			$css .= ".single .entry-header { margin-bottom:" . esc_attr( $single_post_header_spacing ) . "px;}" . "\n";

			$single_post_image_spacing = get_theme_mod( 'single_post_header_spacing', 38 );
			$css .= ".single .post-thumbnail { margin-bottom:" . esc_attr( $single_post_header_spacing ) . "px;}" . "\n";

			$single_post_meta_spacing = get_theme_mod( 'single_post_meta_spacing', 8 );
			$css .= ".single .entry-meta-above { margin-bottom:" . esc_attr( $single_post_meta_spacing ) . "px;}" . "\n";
			$css .= ".single .entry-meta-below { margin-top:" . esc_attr( $single_post_meta_spacing ) . "px;}" . "\n";
			
			$single_post_title_text_transform  = get_theme_mod( 'single_post_title_text_transform', 'none' );
			$single_post_title_text_decoration = get_theme_mod( 'single_post_title_text_decoration', 'none' );
			$css .= ".single .entry-header .entry-title { text-transform:" . esc_attr( $single_post_title_text_transform ) . "; text-decoration:" . esc_attr( $single_post_title_text_decoration ) . ";}" . "\n";

			// Single post reading progress
			$single_post_reading_progress = get_theme_mod( 'single_post_reading_progress', 0 );
			if( $single_post_reading_progress ) {
				$single_post_reading_progress_height = get_theme_mod( 'single_post_reading_progress_height', 6 );

				$css .= '.botiga-reading-progress__bar { height: '. absint( $single_post_reading_progress_height ) .'px; }';
				$css .= $this->get_background_color_css( 'single_post_reading_progress_background_color', 'transparent', '.botiga-reading-progress' );
				$css .= $this->get_background_color_css( 'single_post_reading_progress_foreground_color', '#212121', '.botiga-reading-progress__bar' );
			}

			// Single post elements divider color
			$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.botiga-share-box, .botiga-related-posts, .botiga-related-products, .botiga-upsell-products, .botiga-recently-viewed-products, .post-navigation, .single-post-author, .comments-area', 0.1 );
			
			//Back to top
			$scrolltop_radius           = get_theme_mod( 'scrolltop_radius', 30 );
			$scrolltop_icon_size        = get_theme_mod( 'scrolltop_icon_size', 18 );
			$scrolltop_padding          = get_theme_mod( 'scrolltop_padding', 15 );

			$css .= ".back-to-top.display { border-radius:" . esc_attr( $scrolltop_radius ) . "px;}" . "\n";
			$css .= $this->get_responsive_css( 'scrolltop_bottom_offset', array( 'desktop' => 30, 'tablet' => 30, 'mobile' => 30 ), '.back-to-top.display', 'bottom' );
			$css .= $this->get_responsive_css( 'scrolltop_side_offset', array( 'desktop' => 30, 'tablet' => 30, 'mobile' => 30 ), '.back-to-top.position-right', 'right' );
			$css .= $this->get_responsive_css( 'scrolltop_side_offset', array( 'desktop' => 30, 'tablet' => 30, 'mobile' => 30 ), '.back-to-top.position-left', 'left' );
			$css .= $this->get_background_color_css( 'scrolltop_bg_color', '', '.back-to-top' );
			$css .= $this->get_background_color_css( 'scrolltop_bg_color_hover', '', '.back-to-top:hover' );
			$css .= $this->get_color_css( 'scrolltop_color', '', '.back-to-top' );
			$css .= $this->get_stroke_css( 'scrolltop_color', '', '.back-to-top svg' );
			$css .= $this->get_color_css( 'scrolltop_color_hover', '', '.back-to-top:hover' );
			$css .= $this->get_stroke_css( 'scrolltop_color_hover', '', '.back-to-top:hover svg' );
			$css .= ".back-to-top .ws-svg-icon { width:" . esc_attr( $scrolltop_icon_size ) . "px;height:" . esc_attr( $scrolltop_icon_size ) . "px;}" . "\n";
			$css .= ".back-to-top { padding:" . esc_attr( $scrolltop_padding ) . "px;}" . "\n";

			//Footer
			$footer_widgets_divider         = get_theme_mod( 'footer_widgets_divider', 0 );
			$footer_widgets_divider_width   = get_theme_mod( 'footer_widgets_divider_width', 'contained' );
			$footer_widgets_divider_size    = get_theme_mod( 'footer_widgets_divider_size', 1 );
			$footer_widgets_divider_color   = get_theme_mod( 'footer_widgets_divider_color' );

			if ( $footer_widgets_divider ) {
				if ( 'contained' === $footer_widgets_divider_width ) {
					$css .= ".footer-widgets-grid { border-top:" . esc_attr( $footer_widgets_divider_size ) . 'px solid ' . esc_attr( $footer_widgets_divider_color ) . ";}" . "\n";
				} else {
					$css .= ".footer-widgets { border-top:" . esc_attr( $footer_widgets_divider_size ) . 'px solid ' . esc_attr( $footer_widgets_divider_color ) . ";}" . "\n";
				}
			}

			$footer_credits_divider         = get_theme_mod( 'footer_credits_divider', 1 );
			$footer_credits_divider_width   = get_theme_mod( 'footer_credits_divider_width', 'contained' );
			$footer_credits_divider_size    = get_theme_mod( 'footer_credits_divider_size', 1 );
			if ( $footer_credits_divider ) {
				if ( 'contained' === $footer_credits_divider_width ) {
					$css .= ".site-info { border-top-width:" . esc_attr( $footer_credits_divider_size ) . "px; border-top-style: solid;}" . "\n";
					$css .= $this->get_border_color_css( 'footer_credits_divider_color', 'rgba(33,33,33,0.1)', '.site-info' );
					$css .= ".site-footer { border-top: 0; }" . "\n";
				} else {
					$css .= ".site-footer { border-top-width:" . esc_attr( $footer_credits_divider_size ) . "px; border-top-style: solid;}" . "\n";
					$css .= $this->get_border_color_css( 'footer_credits_divider_color', 'rgba(33,33,33,0.1)', '.site-footer' );
					$css .= ".site-info { border-top: 0; }" . "\n";
				}
			} else {
				$css .= ".site-info { border-top:0;}" . "\n";
			}           

			$footer_widgets_column_spacing_desktop = get_theme_mod( 'footer_widgets_column_spacing_desktop', 30 );
			$css .= ".footer-widgets-grid { gap:" . esc_attr( $footer_widgets_column_spacing_desktop ) . "px;}" . "\n";
			$css .= $this->get_top_bottom_padding_css( 'footer_widgets_padding', $defaults = array( 'desktop' => 70, 'tablet' => 40, 'mobile' => 40 ), '.footer-widgets-grid' );

			$css .= $this->get_background_color_css( 'footer_widgets_background', '', '.footer-widgets' );
			$css .= $this->get_color_css( 'footer_widgets_title_color', '', '.widget-column .widget .widget-title' );
			$css .= $this->get_color_css( 'footer_widgets_text_color', '', '.widget-column .widget' );
			$css .= $this->get_color_css( 'footer_widgets_links_color', '', '.widget-column .widget a' );
			$css .= $this->get_color_css( 'footer_widgets_links_hover_color', '', '.widget-column .widget a:hover' );
			$css .= $this->get_background_color_css( 'footer_credits_background', '', '.site-footer' );
			$css .= $this->get_color_css( 'footer_credits_text_color', '', '.site-info' );
			$css .= $this->get_fill_css( 'footer_credits_text_color', '', '.site-info .ws-svg-icon svg' );
			$css .= $this->get_color_css( 'footer_credits_links_color', '', '.site-info a' );
			$css .= $this->get_color_css( 'footer_credits_links_color_hover', '', '.site-info a:hover' );

			$footer_credits_padding_desktop         = get_theme_mod( 'footer_credits_padding_desktop', 30 );
			$footer_credits_padding_bottom_desktop  = get_theme_mod( 'footer_credits_padding_bottom_desktop', 60 );
			$css .= ".site-info { padding-top:" . esc_attr( $footer_credits_padding_desktop ) . 'px;padding-bottom:' . esc_attr( $footer_credits_padding_bottom_desktop ) . "px;}" . "\n";

			$footer_copyright_elements_spacing_desktop = get_theme_mod( 'footer_copyright_elements_spacing_desktop', 15 );
			$css .= ".footer-copyright-elements>div+div { margin-top:" . esc_attr( $footer_copyright_elements_spacing_desktop ) . "px; }" . "\n";

			//Woocommerce
			$shop_archive_header_style = get_theme_mod( 'shop_archive_header_style', 'style1' );
			if( 'style1' === $shop_archive_header_style || 'style3' === $shop_archive_header_style ) {
				$shop_archive_header_style_alignment = get_theme_mod( 'shop_archive_header_style_alignment', 'center' );

				if( 'left' === $shop_archive_header_style_alignment ) {
					$css .= ".woocommerce-page-header .categories-wrapper { -webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;}" . "\n";
				} elseif( 'right' === $shop_archive_header_style_alignment ) {
					$css .= ".woocommerce-page-header .categories-wrapper { -webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;}" . "\n";
				}
			}

			if( 'style3' === $shop_archive_header_style ) {
				$css .= $this->get_border_color_css( 'shop_archive_header_button_border_color', '#212121', '.woocommerce-page-header .categories-wrapper' );
			}

			$shop_archive_header_padding_top    = get_theme_mod( 'shop_archive_header_padding_top', 80 );
			$shop_archive_header_padding_bottom = get_theme_mod( 'shop_archive_header_padding_bottom', 80 );
			$css .= '.woocommerce-page-header { padding-top: '. absint( $shop_archive_header_padding_top ) .'px; padding-bottom: '. absint( $shop_archive_header_padding_bottom ) .'px; }';

			$css .= $this->get_background_color_css( 'shop_archive_header_background_color', '#FFF', '.woocommerce-page-header' );
			$css .= $this->get_color_css( 'shop_archive_header_title_color', '#212121', '.woocommerce-page-header h1' );
			$css .= $this->get_color_css( 'shop_archive_header_description_color', '#212121', '.woocommerce-page-header .page-description, .woocommerce-page-header .term-description' );
			$css .= $this->get_color_css( 'shop_archive_header_button_color', '#212121', '.woocommerce-page-header .category-button' );
			$css .= $this->get_color_css( 'shop_archive_header_button_color_hover', '#FFF', '.woocommerce-page-header .category-button:hover', true );
			$css .= $this->get_background_color_css( 'shop_archive_header_button_background_color', '#FFF', '.woocommerce-page-header .category-button' );
			$css .= $this->get_background_color_css( 'shop_archive_header_button_background_color_hover', '#212121', '.woocommerce-page-header .category-button:hover', true );
			$css .= $this->get_border_color_css( 'shop_archive_header_button_border_color', '#212121', '.woocommerce-page-header .category-button' );
			$css .= $this->get_border_color_css( 'shop_archive_header_button_border_color_hover', '#212121', '.woocommerce-page-header .category-button:hover', true );
			$css .= ".woocommerce-page-header .category-button { border-radius: ". get_theme_mod( 'shop_archive_header_button_border_radius', 35 ) ."px; }" . "\n";

			$css .= $this->get_gap_css( 'shop_archive_columns_gap', $defaults = array( 'desktop' => 30, 'tablet' => 30, 'mobile' => 20 ), 'ul.wc-block-grid__products, ul.products' );

			$shop_product_alignment = get_theme_mod( 'shop_product_alignment', 'center' );
			$css .= "ul.wc-block-grid__products li.wc-block-grid__product, .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product, ul.products li.product .wp-block-button__link { text-align:" . esc_attr( $shop_product_alignment ) . "!important;}" . "\n";

			$shop_categories_alignment = get_theme_mod( 'shop_categories_alignment', 'center' );
			$css .= "ul.products li.product-category .woocommerce-loop-category__title { text-align:" . esc_attr( $shop_categories_alignment ) . ";}" . "\n";

			$shop_categories_layout = get_theme_mod( 'shop_categories_layout', 'layout1' );
			$shop_categories_radius = get_theme_mod( 'shop_categories_radius', 0 );
			$css .= "ul.products li.product-category > a, ul.products li.product-category > a > img { border-radius:" . esc_attr( $shop_categories_radius ) . "px;}" . "\n";
			if( 'layout4' === $shop_categories_layout ) {
				$css .= ".product-category-item-layout4 ul.products li.product-category > a h2 { border-radius: 0 0 " . esc_attr( $shop_categories_radius ) . "px " . esc_attr( $shop_categories_radius ) . "px;}" . "\n";
			}

			$shop_product_card_style        = get_theme_mod( 'shop_product_card_style', 'layout1' );
			$shop_product_card_border_color = get_theme_mod( 'shop_product_card_border_color', '#eee' );
			$shop_product_card_border_size  = get_theme_mod( 'shop_product_card_border_size', 1 );
			$shop_product_card_background   = get_theme_mod( 'shop_product_card_background' );
			$shop_product_card_radius       = get_theme_mod( 'shop_product_card_radius' );
			$shop_product_card_thumb_radius = get_theme_mod( 'shop_product_card_thumb_radius' );

			if ( 'layout2' === $shop_product_card_style || 'layout3' === $shop_product_card_style ) {
				$css .= "ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product { border-radius: " . intval( $shop_product_card_radius ) . "px; border-width: " . intval( $shop_product_card_border_size ) . "px; border-style: solid;padding:30px;}" . "\n";           
				$css .= "ul.wc-block-grid__products li.wc-block-grid__product .loop-image-wrap, ul.wc-block-grid__products li.product .loop-image-wrap, ul.products li.wc-block-grid__product .loop-image-wrap, ul.products li.product .loop-image-wrap { overflow:hidden;border-radius:" . esc_attr( $shop_product_card_thumb_radius ) . "px;}" . "\n";
				$css .= $this->get_background_color_css( 'shop_product_card_background', '', 'ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product' );
				$css .= $this->get_border_color_css( 'shop_product_card_border_color', '#eee', 'ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product' );
			}

			if ( 'layout3' === $shop_product_card_style ) {
				$css .= "ul.wc-block-grid__products li.wc-block-grid__product .loop-image-wrap, ul.wc-block-grid__products li.product .loop-image-wrap, ul.products li.wc-block-grid__product .loop-image-wrap, ul.products li.product .loop-image-wrap { margin:-30px -30px 20px;}" . "\n";
			}

			if ( 'left' === $shop_product_alignment ) {
				$css .= ".star-rating,ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link, ul.wc-block-grid__products li.wc-block-grid__product .button, ul.wc-block-grid__products li.product .wp-block-button__link, ul.wc-block-grid__products li.product .button, ul.products li.wc-block-grid__product .wp-block-button__link, ul.products li.wc-block-grid__product .button, ul.products li.product .wp-block-button__link, ul.products li.product .button { margin-left:0!important;}" . "\n";
			} elseif ( 'right' === $shop_product_alignment ) {
				$css .= ".star-rating,ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link, ul.wc-block-grid__products li.wc-block-grid__product .button, ul.wc-block-grid__products li.product .wp-block-button__link, ul.wc-block-grid__products li.product .button, ul.products li.wc-block-grid__product .wp-block-button__link, ul.products li.wc-block-grid__product .button, ul.products li.product .wp-block-button__link, ul.products li.product .button { margin-right:0!important;}" . "\n";      
			}

			$shop_product_add_to_cart_button_width = get_theme_mod( 'shop_product_add_to_cart_button_width', 'auto' );
			if( $shop_product_add_to_cart_button_width === 'full-width' ) {
				$css .= '.button-layout2.button-with-quantity .button, .button-layout2.button-with-quantity .wp-block-button .wp-block-button__link { width: calc( 100% - 100px ); }';
				$css .= '.button-layout2.button-with-quantity, .button-layout2.button-width-full:not(.button-with-quantity) .button, .button-layout2.button-width-full:not(.button-with-quantity) .wp-block-button, .button-layout2.button-width-full:not(.button-with-quantity) .wp-block-button .wp-block-button__link, .button-layout2.button-with-quantity .wp-block-button { width: 100%; }';
				$css .= '.product-equal-height ul.products li.product .button-layout2.button-with-quantity .quantity, .product-equal-height .wc-block-grid__products .wc-block-grid__product .button-layout2.button-with-quantity .quantity { height: 100%; }';
			} else {
				$alignval = 'center';
				if ( 'left' === $shop_product_alignment ) {
					$alignval = 'flex-start';
				} elseif ( 'right' === $shop_product_alignment ) {
					$alignval = 'flex-end';
				}
				$css .= '.product-equal-height ul.products li.product .button-layout2.button-with-quantity, .product-equal-height .wc-block-grid__products .wc-block-grid__product .button-layout2.button-with-quantity, .wc-block-grid__products .wc-block-grid__product .button-layout2.button-with-quantity { justify-content: '. esc_attr( $alignval ) .'; }';
				$css .= '.product-equal-height ul.products li.product .button-layout2.button-with-quantity .quantity, .product-equal-height .wc-block-grid__products .wc-block-grid__product .button-layout2.button-with-quantity .quantity { height: 100%; }';
			}

			$shop_product_element_spacing = get_theme_mod( 'shop_product_element_spacing', 12 );
			$css .= "ul.wc-block-grid__products li.wc-block-grid__product .col-md-7>*, ul.wc-block-grid__products li.wc-block-grid__product .col-md-8>*, ul.wc-block-grid__products li.wc-block-grid__product>*, ul.wc-block-grid__products li.product .col-md-7>*, ul.wc-block-grid__products li.product .col-md-8>*, ul.wc-block-grid__products li.product>*, ul.products li.wc-block-grid__product .col-md-7>*, ul.products li.wc-block-grid__product .col-md-8>*, ul.products li.wc-block-grid__product>*, ul.products li.product .col-md-7>*, ul.products li.product .col-md-8>*, ul.products li.product>* { margin-bottom:" . esc_attr( $shop_product_element_spacing ) . "px;}" . "\n";
			$css .= "ul.products li.product .product-description-column:not(:empty), ul.products li.wc-block-grid__product .product-description-column:not(:empty), ul.wc-block-grid__products li.wc-block-grid__product .product-description-column:not(:empty) { margin-top:" . esc_attr( $shop_product_element_spacing ) . "px;}" . "\n";

			$single_product_gallery_layout  = get_theme_mod( 'single_product_gallery', 'gallery-default' );
			$shop_product_sale_tag_layout   = get_theme_mod( 'shop_product_sale_tag_layout', 'layout1' );
			$shop_sale_tag_spacing          = get_theme_mod( 'shop_sale_tag_spacing', 20 );
			$shop_sale_tag_radius           = get_theme_mod( 'shop_sale_tag_radius', 0 );
			$rtl_left                       = is_rtl() ? 'right' : 'left';

			$css .= ".wc-block-grid__product-onsale, span.onsale {border-radius:" . esc_attr( $shop_sale_tag_radius ) . "px;top:" . esc_attr( $shop_sale_tag_spacing ) . "px!important;left:" . esc_attr( $shop_sale_tag_spacing ) . "px!important;}" . "\n";
			if ( 'layout2' === $shop_product_sale_tag_layout ) {
				$css .= ".wc-block-grid__product-onsale, .products span.onsale {left:auto!important;right:" . esc_attr( $shop_sale_tag_spacing ) . "px;}" . "\n";
			}
			if ( 'gallery-vertical' === $single_product_gallery_layout ) {
				$css .= ".single-product .has-gallery-images .product-gallery-summary span.onsale { $rtl_left: 107px !important; }";
			}
			if ( 'gallery-showcase' === $single_product_gallery_layout ) {
				$css .= ".single-product .has-gallery-images .product-gallery-summary span.onsale { top: 104px !important; $rtl_left: 110px !important; }";
			}
			if ( 'gallery-full-width' === $single_product_gallery_layout ) {
				$css .= ".single-product .has-gallery-images .product-gallery-summary span.onsale { top: 142px !important; }";
			}

			$css .= $this->get_color_css( 'single_product_sale_color', '', '.wc-block-grid__product-onsale, span.onsale' );
			$css .= $this->get_background_color_css( 'single_product_sale_background_color', '', '.wc-block-grid__product-onsale, span.onsale' );
			$css .= $this->get_color_css( 'shop_product_product_title', '', 'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title, ul.wc-block-grid__products li.product .wc-block-grid__product-title, ul.wc-block-grid__products li.product .woocommerce-loop-product__title, ul.products li.wc-block-grid__product .wc-block-grid__product-title, ul.products li.wc-block-grid__product .woocommerce-loop-product__title, ul.products li.product .wc-block-grid__product-title, ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-category__title, .woocommerce-loop-product__title .botiga-wc-loop-product__title' );
			$css .= $this->get_color_css( 'shop_product_product_title_hover', '', 'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title:hover, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title:hover, ul.wc-block-grid__products li.product .wc-block-grid__product-title:hover, ul.wc-block-grid__products li.product .woocommerce-loop-product__title:hover, ul.products li.wc-block-grid__product .wc-block-grid__product-title:hover, ul.products li.wc-block-grid__product .woocommerce-loop-product__title:hover, ul.products li.product .wc-block-grid__product-title:hover, ul.products li.product .woocommerce-loop-product__title:hover, ul.products li.product .woocommerce-loop-category__title:hover, .woocommerce-loop-product__title .botiga-wc-loop-product__title:hover' );

			//Shop product options
			$shop_product_title_text_transform  = get_theme_mod( 'shop_product_title_text_transform', 'none' );
			$shop_product_title_text_decoration = get_theme_mod( 'shop_product_title_text_decoration', 'none' );
			$css .= "ul.products li.product .botiga-wc-loop-product__title, ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title, ul.wc-block-grid__products li.product .wc-block-grid__product-title, ul.wc-block-grid__products li.product .woocommerce-loop-product__title, ul.products li.wc-block-grid__product .wc-block-grid__product-title, ul.products li.wc-block-grid__product .woocommerce-loop-product__title, ul.products li.product .wc-block-grid__product-title, ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-category__title, .woocommerce-loop-product__title .botiga-wc-loop-product__title { text-transform:" . esc_attr( $shop_product_title_text_transform ) . "; text-decoration:" . esc_attr( $shop_product_title_text_decoration ) . ";}" . "\n";
			$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.woocommerce-sorting-wrapper', '0.1' );

			// Default pagination
			$css .= $this->get_background_color_css( 'button_background_color', '#212121', '.pagination .page-numbers:hover, .pagination .page-numbers:focus, .pagination .page-numbers.current, .woocommerce-pagination li .page-numbers:hover, .woocommerce-pagination li .page-numbers:focus, .woocommerce-pagination li .page-numbers.current' );
			$css .= $this->get_color_css( 'button_color_hover', '#FFF', '.pagination .page-numbers:hover, .pagination .page-numbers:focus, .pagination .page-numbers.current, .woocommerce-pagination li .page-numbers:hover, .woocommerce-pagination li .page-numbers:focus, .woocommerce-pagination li .page-numbers.current' );

			// Pagination infinite scroll
			$blog_archive_pagination_type = get_theme_mod( 'blog_archive_pagination_type', 'default' ); 
			$shop_archive_pagination_type = get_theme_mod( 'shop_archive_pagination_type', 'default' );

			//Wishlist
			$wishlist_enable = Botiga_Modules::is_module_active( 'wishlist' );
			$wishlist_layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );
			if( $wishlist_enable && 'layout1' !== $wishlist_layout ) {
				// wishlist buttons/icons
				$css .= $this->get_fill_css( 'shop_product_wishlist_icon_active_color', '#fda5a5', '.botiga-wishlist-button:hover svg path, .botiga-wishlist-button.active svg path' );
				$css .= $this->get_stroke_css( 'shop_product_wishlist_icon_active_color', '#fda5a5', '.botiga-wishlist-button:hover svg path, .botiga-wishlist-button.active svg path' );
				$css .= $this->get_background_color_css( 'shop_product_wishlist_icon_background_color', 'rgba(255,255,255,0)', '.botiga-wishlist-button' );
			} 
			
			//Woocommerce single
			$single_sku         = get_theme_mod( 'single_product_sku', 1 );
			$single_categories  = get_theme_mod( 'single_product_categories', 1 );
			$single_tags        = get_theme_mod( 'single_product_tags', 1 );
			$single_sticky_add_to_cart_elements_spacing = get_theme_mod( 'single_sticky_add_to_cart_elements_spacing', 35 );

			if( !$single_sku ) {
				$css .= ".single-product .product_meta .sku_wrapper { display: none }";
			}
			if( !$single_categories ) {
				$css .= ".single-product .product_meta .posted_in { display: none }";
			}
			if( !$single_tags ) {
				$css .= ".single-product .product_meta .tagged_as { display: none }";
			}
			if( !$single_sku && !$single_categories && !$single_tags ) {
				$css .= ".single-product .product_meta { border-top: 0; }";
			}

			//Woocommerce single product gallery
			$single_product_gallery = get_theme_mod( 'single_product_gallery', 'gallery-default' );
			if( 'gallery-showcase' === $single_product_gallery || 'gallery-full-width' === $single_product_gallery ) {
				$css .= $this->get_background_color_css( 'single_product_gallery_styles_background_color', '', '.product-gallery-summary.gallery-showcase:before, .product-gallery-summary.gallery-full-width:before' );

				$single_product_gallery_styles_padding_top_bottom = get_theme_mod( 'single_product_gallery_styles_padding_top_bottom', 80 );
				$css .= ".product-gallery-summary.gallery-showcase, .product-gallery-summary.gallery-full-width { padding-top: ". esc_attr( $single_product_gallery_styles_padding_top_bottom ) ."px; padding-bottom: ". esc_attr( $single_product_gallery_styles_padding_top_bottom ) ."px; }";
			}

			//Woocommerce single tabs
			$single_product_tabs_layout    = get_theme_mod( 'single_product_tabs_layout', 'style1' );

			switch ( $single_product_tabs_layout ) {
				case 'style1':
					$css .= $this->get_border_color_css( 'single_product_tabs_border_color_active', '', '.botiga-tabs-style1 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style1 .woocommerce-tabs ul.tabs li:hover a' );
					$css .= $this->get_border_bottom_color_rgba_css( 'single_product_tabs_remaining_borders', '#212121', '.botiga-tabs-style1 .woocommerce-tabs ul.tabs', '0.3' );
					break;
				case 'style2':
					$css .= $this->get_border_top_color_css( 'single_product_tabs_border_color_active', '', '.botiga-tabs-style2 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style2 .woocommerce-tabs ul.tabs li:hover a' );
					$css .= $this->get_border_color_rgba_css( 'single_product_tabs_remaining_borders', '#212121', '.botiga-tabs-style2 .woocommerce-tabs ul.tabs li a, .botiga-tabs-style2 .woocommerce-tabs ul.tabs, .botiga-tabs-style2 .woocommerce-tabs ul.tabs li:not(.active):not(:hover) a', '0.3' );
					break;  
				case 'style3':
					$css .= $this->get_background_color_rgba_css( 'single_product_tabs_background_color', '#f5f5f5', '.botiga-tabs-style3 .woocommerce-tabs ul.tabs li:not(.active) a, .botiga-tabs-style3 .woocommerce-tabs ul.tabs li:not(.active):hover a', '0.5' );
					$css .= $this->get_background_color_css( 'single_product_tabs_background_color_active', '#f5f5f5', '.botiga-tabs-style3 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style3 .woocommerce-tabs ul.tabs li:hover a' );
					$css .= $this->get_border_bottom_color_rgba_css( 'single_product_tabs_remaining_borders', '#212121', '.botiga-tabs-style3 .woocommerce-tabs ul.tabs', '0.3' );
					break;
				case 'style4':
					$css .= $this->get_border_color_css( 'single_product_tabs_border_color_active', '', '.botiga-tabs-style4 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style4 .woocommerce-tabs ul.tabs li:hover a' );
					$css .= $this->get_background_color_css( 'single_product_tabs_background_color', '#f5f5f5', '.botiga-tabs-style4 .woocommerce-tabs ul.tabs li:not(.active) a' );
					$css .= $this->get_background_color_css( 'single_product_tabs_background_color_active', '#f5f5f5', '.botiga-tabs-style4 .woocommerce-tabs ul.tabs li.active a' );
					$css .= $this->get_border_color_rgba_css( 'single_product_tabs_remaining_borders', '#212121', '.botiga-tabs-style4 .woocommerce-tabs ul.tabs:before, .botiga-tabs-style4 .woocommerce-tabs ul.tabs li:not(.active) a', '0.3' );
					break;
				case 'style5':
					$color_rgba = self::get_instance()->to_rgba( get_theme_mod( 'single_product_tabs_remaining_borders', '#212121' ), '0.3' );

					$css .= $this->get_background_color_rgba_css( 'single_product_tabs_background_color', '#f5f5f5', '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li:not(.active) a', '0.4' );
					$css .= $this->get_background_color_rgba_css( 'single_product_tabs_background_color_active', '#f5f5f5', '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style5 .woocommerce-tabs .panel', '1' );
					$css .= $this->get_border_color_rgba_css( 'single_product_tabs_remaining_borders', '#212121', '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li a, .botiga-tabs-style5 .woocommerce-tabs .panel', '0.3' );
					$css .= '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li:not(.active) a { border-right: 1px solid '.  esc_attr( $color_rgba ) .' }';
					$css .= '.botiga-tabs-style5.botiga-tabs-align-center .woocommerce-tabs ul.tabs li+li a { border-top-color: '.  esc_attr( $color_rgba ) .'; border-right-color: '.  esc_attr( $color_rgba ) .' }';
					break;
					
				case 'style6':
					$css .= $this->get_color_css( 'single_product_tabs_text_color', '#212121', '.botiga-accordion__item>a' );
					$css .= $this->get_border_color_rgba_css( 'single_product_tabs_text_color', '#212121', '.botiga-accordion__item>a:after', 0.5 );
					$css .= $this->get_color_css( 'single_product_tabs_text_color_active', '#212121', '.botiga-accordion__item>a.active, .botiga-accordion__item>a:hover, .botiga-accordion__item>a:focus' );
					$css .= $this->get_border_color_css( 'single_product_tabs_text_color_active', '#212121', '.botiga-accordion__item>a.active:after, .botiga-accordion__item>a:hover:after, .botiga-accordion__item>a:focus:after' );
					$css .= $this->get_border_color_rgba_css( 'single_product_tabs_remaining_borders', '#212121', '.botiga-accordion__item', 0.5 );
					break;
					
			}

			$css .= $this->get_color_css( 'single_product_tabs_text_color', '', '.woocommerce-tabs ul.tabs li:not(.active) a ,.woocommerce-tabs ul.tabs li:not(.active) a:hover' );
			$css .= $this->get_color_css( 'single_product_tabs_text_color_active', '', '.woocommerce-tabs ul.tabs li.active a,.woocommerce-tabs ul.tabs li.active a:hover' );

			//Single Product - Reviews Advanced
			$single_product_reviews_advanced_enable = Botiga_Modules::is_module_active( 'advanced-reviews' );
			if( $single_product_reviews_advanced_enable ) {
				$css .= $this->get_background_color_css( 'single_product_reviews_advanced_section_bg_color', '#FFF', '.single-product .site-main>.product>section.products.botiga-adv-reviews:after, .botiga-reviews-orderby', true );
				$css .= $this->get_color_css( 'single_product_reviews_advanced_stars_bg_color', '#777', '.star-rating.botiga-star-rating-style2:before, .star-rating::before' );
				$css .= $this->get_color_css( 'single_product_reviews_advanced_stars_color', '#FFA441', '.star-rating.botiga-star-rating-style2 span:before, .star-rating span::before, .botiga-adv-reviews-modal .botiga-adv-reviews-modal-body .botiga-adv-reviews-modal-content .stars:hover a:before' );
				$css .= $this->get_background_color_css( 'color_link_default', '#212121', '.botiga-star-rating-bars .botiga-star-rating-bar-item .item-bar .item-bar-inner' );
				$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.botiga-reviews-list-wrapper .botiga-reviews-list-item+.botiga-reviews-list-item', 0.15 );
			}

			// Single Product - Product Navigation
			$single_product_navigation = get_theme_mod( 'single_product_navigation', 0 );
			if( $single_product_navigation ) {
				$css .= $this->get_border_bottom_color_rgba_css( 'color_heading_4', '#212121', '.botiga-product-navigation a span:after' );
			}

			//Woocommerce single upsell, related and recently viewed products section
			$single_upsell_products = get_theme_mod( 'single_upsell_products', 1 );
			if( $single_upsell_products ) {
				$css .= $this->get_background_color_css( 'single_product_upsell_section_background_color', '', '.single-product .upsells.products:after', true );
			}

			$single_related_products = get_theme_mod( 'single_related_products', 1 );
			if( $single_related_products ) {
				$css .= $this->get_background_color_css( 'single_product_related_section_background_color', '', '.single-product .related.products:after', true );
			}

			$single_recently_viewed_products = get_theme_mod( 'single_recently_viewed_products', 0 );
			if( $single_recently_viewed_products ) {
				$css .= $this->get_background_color_css( 'single_product_recently_section_background_color', '', '.single-product .recently-viewed-products.products:after', true );
			}

			//Woocommerce single sticky add to cart
			$single_sticky_add_to_cart = Botiga_Modules::is_module_active( 'sticky-add-to-cart' );

			if( $single_sticky_add_to_cart ) {
				$css .= $this->get_border_color_rgba_css( 'single_sticky_add_to_cart_style_color_border', '', '.botiga-single-sticky-add-to-cart-wrapper', 0.1 );
				$css .= $this->get_background_color_css( 'single_sticky_add_to_cart_style_color_background', '', '.botiga-single-sticky-add-to-cart-wrapper, .botiga-single-sticky-add-to-cart-wrapper input[type="number"], .botiga-single-sticky-add-to-cart-wrapper select' );
				$css .= $this->get_color_css( 'single_sticky_add_to_cart_style_color_title', '', '.botiga-single-sticky-add-to-cart-wrapper h5' );
				$css .= $this->get_color_css( 'single_sticky_add_to_cart_style_color_content', '', '.botiga-single-sticky-add-to-cart-wrapper .price, .botiga-single-sticky-add-to-cart-wrapper .botiga-single-sticky-add-to-cart-wrapper-content .variations_form table.variations .label, .botiga-single-sticky-add-to-cart-wrapper select, .botiga-single-sticky-add-to-cart-wrapper .botiga-variations-wrapper .botiga-variation-type-button>a, .botiga-single-sticky-add-to-cart-wrapper .quantity .botiga-quantity-plus, .botiga-single-sticky-add-to-cart-wrapper .quantity .botiga-quantity-minus, .botiga-single-sticky-add-to-cart-wrapper .qty, .botiga-single-sticky-add-to-cart-wrapper table.variations .reset_variations' );
				$css .= $this->get_border_color_css( 'single_sticky_add_to_cart_style_color_content', '', '.botiga-single-sticky-add-to-cart-wrapper select, .botiga-single-sticky-add-to-cart-wrapper .botiga-variations-wrapper .botiga-variation-type-button>a, .botiga-single-sticky-add-to-cart-wrapper .quantity' );
				$css .= '.botiga-single-sticky-add-to-cart-wrapper .price del { color: '. esc_attr( get_theme_mod( 'single_sticky_add_to_cart_style_color_content', '#212121' ) ) .'; opacity: 0.8; }';

				$margin_side = is_rtl() ? 'left' : 'right';
				$css .= '.botiga-single-sticky-add-to-cart-wrapper .botiga-single-sticky-add-to-cart-wrapper-content .botiga-single-sticky-add-to-cart-item { margin-'. esc_attr( $margin_side ) .': '. esc_attr( $single_sticky_add_to_cart_elements_spacing ) .'px; }';
			}

			//Side Mini Cart
			$mini_cart_style = get_theme_mod( 'mini_cart_style', 'default' );
			if( $mini_cart_style === 'side' ) {
				$css .= $this->get_background_color_rgba_css( 'color_body_text', '#212121', '.botiga-side-mini-cart .widget_shopping_cart .woocommerce-mini-cart__buttons:before, .botiga-side-mini-cart .widget_shopping_cart .botiga-woocommerce-mini-cart__cross-sell:before', '0.1' );
			}

			//Cart display coupon form
			$shop_cart_show_coupon_form = get_theme_mod( 'shop_cart_show_coupon_form', 1 );
			if( !$shop_cart_show_coupon_form ) {
				$css .= '.woocommerce-cart .coupon { display: none; }';
			}

			//Checkout display coupon form
			$shop_checkout_show_coupon_form = get_theme_mod( 'shop_checkout_show_coupon_form', 1 );
			if( !$shop_checkout_show_coupon_form ) {
				$css .= '.woocommerce-checkout .woocommerce-form-coupon-toggle { display: none !important; }';
			}

			// Checkout
			$checkout_sticky_totals_box = get_theme_mod( 'checkout_sticky_totals_box', 0 );
			$shop_checkout_layout = get_theme_mod( 'shop_checkout_layout', 'layout1' );
			if( $checkout_sticky_totals_box && $shop_checkout_layout === 'layout1' ) {
				$css .= '.woocommerce-checkout .woocommerce-checkout-review-order { position: sticky; top: 45px; } .admin-bar .woocommerce-checkout .woocommerce-checkout-review-order { top: 77px; }';
			}

			//Multi step checkout
			$shop_checkout_layout = get_theme_mod( 'shop_checkout_layout', 'layout1' );
			if( 'layout3' === $shop_checkout_layout ) {
				$css .= $this->get_background_color_rgba_css( 'color_body_text', '#212121', '.botiga-mstepc-wrapper .divider', '0.1', true );
				$css .= '.botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item:before { border-top-color: '. esc_attr( self::get_instance()->to_rgba( get_theme_mod( 'color_body_text', '#212121' ), '0.1' ) ) .' }';
			}

			//My account
			$css .= $this->get_color_css( 'color_link_default', '', '.woocommerce-account.logged-in .entry-content>.woocommerce .woocommerce-MyAccount-navigation ul .is-active a' );
			$css .= $this->get_color_css( 'color_link_default', '', '.woocommerce-orders-table__cell-order-number a,.woocommerce-MyAccount-content p a' );
			$css .= $this->get_color_css( 'color_link_hover', '', '.woocommerce-orders-table__cell-order-number a:hover,.woocommerce-MyAccount-content p a:hover' );

			//Single product options
			$css .= $this->get_border_color_css( 'color_link_default', '', '.single-product div.product .gallery-vertical .flex-control-thumbs li img:hover, .single-product div.product .gallery-vertical .flex-control-thumbs li img.flex-active' );
			$css .= $this->get_color_css( 'single_product_title_color', '', '.product-gallery-summary .product_title' );
      		$css .= $this->get_color_css( 'single_product_price_color', '', '.product-gallery-summary .price' );
			$css .= $this->get_background_color_rgba_css( 'content_cards_background', '#f5f5f5', '.single-product .site-main>.product>section.products:nth-child(even):after', 0.5 );

			$single_product_title_text_transform  = get_theme_mod( 'single_product_title_text_transform', 'none' );
			$single_product_title_text_decoration = get_theme_mod( 'single_product_title_text_decoration', 'none' );
			$css .= ".product-gallery-summary .product_title { text-transform:" . esc_attr( $single_product_title_text_transform ) . "; text-decoration:" . esc_attr( $single_product_title_text_decoration ) . ";}" . "\n";

			//Quantity input
			$shop_general_quantity_style = get_theme_mod( 'shop_general_quantity_style', 'style1' );

			switch ( $shop_general_quantity_style ) {
				case 'style2':
					// $css .= $this->get_background_color_css( 'content_cards_background', '', '.quantity-button-style2 .quantity' );
					$css .= $this->get_background_color_css( 'button_background_color', '', '.quantity-button-style2 .botiga-quantity-plus:hover, .quantity-button-style2 .botiga-quantity-minus:hover' );
					$css .= $this->get_color_css( 'button_color', '', '.quantity-button-style2 .botiga-quantity-plus:hover, .quantity-button-style2 .botiga-quantity-minus:hover' );
					$css .= $this->get_border_color_rgba_css( 'color_body_text', '', '.quantity-button-style2 .quantity, .quantity-button-style2 .botiga-quantity-plus, .quantity-button-style2 .botiga-quantity-minus', 0.3 );
					break;

				case 'style4':
					$css .= $this->get_border_color_rgba_css( 'color_body_text', '', '.quantity-button-style4 .quantity', 0.1 );
					$css .= $this->get_background_color_css( 'button_background_color', '', '.quantity-button-style4 .quantity .botiga-quantity-plus, .quantity-button-style4 .quantity .botiga-quantity-minus' );
					$css .= $this->get_background_color_css( 'button_background_color_hover', '', '.quantity-button-style4 .quantity .botiga-quantity-plus:hover, .quantity-button-style4 .quantity .botiga-quantity-minus:hover' );
					$css .= $this->get_color_css( 'button_color', '', '.quantity-button-style4 .quantity .botiga-quantity-plus, .quantity-button-style4 .quantity .botiga-quantity-minus' );
					break;

				case 'style5':
					$css .= $this->get_background_color_rgba_css( 'content_cards_background', '', '.quantity-button-style5 .quantity .botiga-quantity-plus:hover, .quantity-button-style5 .quantity .botiga-quantity-minus:hover', 0.3 );
					$css .= $this->get_color_css( 'color_body_text', '', '.quantity .botiga-quantity-plus, .quantity .botiga-quantity-minus' );
					break;

				case 'style6':
					$css .= $this->get_background_color_rgba_css( 'content_cards_background', '', '.quantity-button-style6 .quantity .botiga-quantity-plus:hover, .quantity-button-style6 .quantity .botiga-quantity-minus:hover', 0.3 );
					$css .= $this->get_color_css( 'color_body_text', '', '.quantity .botiga-quantity-plus, .quantity .botiga-quantity-minus' );
					$css .= $this->get_border_color_rgba_css( 'color_body_text', '', '.quantity-button-style6 .quantity .qty, .quantity-button-style6 .quantity .botiga-quantity-plus, .quantity-button-style6 .quantity .botiga-quantity-minus', 0.3 );
					break;

				case 'style7':
					$css .= $this->get_border_color_rgba_css( 'color_body_text', '', '.quantity-button-style7 .quantity', 0.3 );
					$css .= $this->get_border_color_css( 'button_color', '', '.quantity-button-style-arrows .botiga-quantity-plus:before, .quantity-button-style-arrows .botiga-quantity-minus:before' );
					$css .= $this->get_background_color_css( 'button_background_color', '', '.quantity-button-style7 .quantity .botiga-quantity-plus, .quantity-button-style7 .quantity .botiga-quantity-minus' );
					break;

				case 'style8':
					$css .= $this->get_border_color_rgba_css( 'color_body_text', '', '.quantity-button-style8 .quantity', 0.5 );
					$css .= $this->get_background_color_css( 'button_background_color', '', '.quantity-button-style8 .quantity .botiga-quantity-plus, .quantity-button-style8 .quantity .botiga-quantity-minus' );
					$css .= $this->get_background_color_css( 'button_background_color_hover', '', '.quantity-button-style8 .quantity .botiga-quantity-plus:hover, .quantity-button-style8 .quantity .botiga-quantity-minus:hover' );
					$css .= $this->get_color_css( 'button_color', '', '.quantity-button-style8 .quantity .botiga-quantity-plus, .quantity-button-style8 .quantity .botiga-quantity-minus' );
					break;
				
			}

			// Login/Register Popup
			$background_color = get_theme_mod( 'background_color', '#FFF' );
			$login_register_popup = Botiga_Modules::is_module_active( 'login-popup' );
			if( $login_register_popup ) {
				$css .= '.botiga-popup-wrapper { background-color: #'. esc_attr( $background_color ) .'; }';
			}

			// Modal Popup
			$modal_popup_enable = Botiga_Modules::is_module_active( 'modal-popup' );
			if( $modal_popup_enable ) {
				$css .= $this->get_max_width_css( 'modal_popup_max_width', $defaults = array( 'desktop' => 800, 'tablet' => 550, 'mobile' => 300 ), '#modalPopup .botiga-popup-wrapper' );
				$css .= '@media(min-width: 1025px) { #modalPopup .botiga-popup-wrapper__content-side-image { max-width: '. esc_attr( get_theme_mod( 'modal_popup_side_image_max_width_desktop', 40 ) ) .'%; } }';
				$css .= '.botiga-popup-wrapper { background-color: #'. esc_attr( $background_color ) .'; }';    
			}

			//Tables
			$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.shop_table th, .shop_table td, .shop_table tr', '0.1', true );
			$css .= $this->get_color_css( 'color_link_default', '', '.woocommerce-table__product-name.product-name a' );
			$css .= $this->get_border_color_css( 'color_link_default', '#212121', '.shop-table-layout2 .shop_table .botiga-qty-remove-wrapper .remove:after' );

			// Additional Information (Variations) Table
			$css .= $this->get_background_color_rgba_css( 'content_cards_background', '#f5f5f5', 'table.woocommerce-product-attributes tr:nth-child(even)', 0.3 );

			//Buttons
			$css .= $this->get_top_bottom_padding_css( 'button_top_bottom_padding', $defaults = array( 'desktop' => 13, 'tablet' => 13, 'mobile' => 13 ), 'button,a.button,.wp-block-button .wp-block-button__link,.wp-block-button__link,ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link,ul.wc-block-grid__products li.wc-block-grid__product .button,ul.products li.product .button,input[type="button"],input[type="reset"],input[type="submit"]' );
			$css .= $this->get_left_right_padding_css( 'button_left_right_padding', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), 'button,a.button,.wp-block-button__link,ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link,ul.wc-block-grid__products li.wc-block-grid__product .button,ul.products li.product .button,input[type="button"],input[type="reset"],input[type="submit"]' );
			$css .= $this->get_border_color_css( 'button_border_color', '#212121', "button,a.button,.wp-block-button .wp-block-button__link,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"]" );
			$css .= $this->get_border_color_css( 'button_border_color_hover', '#757575', "button:hover,a.button:hover,.wp-block-button .wp-block-button__link:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover" );

			$button_letter_spacing = get_theme_mod( 'button_letter_spacing' );
			$css .= "button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { letter-spacing:" . intval( $button_letter_spacing ) . "px;}" . "\n";

			$button_border_radius = get_theme_mod( 'button_border_radius' );
			$css .= "button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { border-radius:" . intval( $button_border_radius ) . "px;}" . "\n";

			$button_text_transform = get_theme_mod( 'button_text_transform', 'uppercase' );
			$button_text_decoration = get_theme_mod( 'button_text_decoration', 'none' );
			$css .= "button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { text-transform:" . esc_attr( $button_text_transform ) . "; text-decoration:" . esc_attr( $button_text_decoration ) . ";}" . "\n";

			$css .= $this->get_background_color_css( 'button_background_color', '#212121', 'button:not(.has-background),a.button:not(.has-background),.wp-block-button .wp-block-button__link:not(.has-background),.wp-block-button__link:not(.has-background),.wp-block-search .wp-block-search__button:not(.has-background),input[type="button"]:not(.has-background),input[type="reset"]:not(.has-background),input[type="submit"]:not(.has-background),.comments-area .comment-reply-link:not(.has-background),.botiga-sc-product-quantity' );          
			$css .= $this->get_background_color_css( 'button_background_color_hover', '#757575', '.is-style-outline .wp-block-button__link:not(.has-background):hover,button:not(.has-background):hover,a.button:not(.has-background):hover,.wp-block-button .wp-block-button__link:not(.has-background):hover,.wp-block-button__link:not(.has-background):hover,.wp-block-search .wp-block-search__button:not(.has-background):hover,input[type="button"]:not(.has-background):hover,input[type="reset"]:not(.has-background):hover,input[type="submit"]:not(.has-background):hover,.comments-area .comment-reply-link:not(.has-background):hover' );          

			$css .= $this->get_color_css( 'button_color', '#FFF', '.wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),button:not(.has-text-color),a.button:not(.wc-forward):not(.has-text-color),a.button.checkout:not(.has-text-color),.checkout-button.button:not(.has-text-color),.wp-block-button .wp-block-button__link:not(.has-text-color),.wp-block-button__link:not(.has-text-color),input[type="button"]:not(.has-text-color),input[type="reset"]:not(.has-text-color),input[type="submit"]:not(.has-text-color),.woocommerce-message .button.wc-forward:not(.has-text-color),.comments-area .comment-reply-link:not(.has-text-color), .wp-block-search .wp-block-search__button:not(.has-text-color),.botiga-sc-product-quantity' );          
			$css .= $this->get_color_css( 'button_color_hover', '#FFF', '.is-style-outline .wp-block-button__link:not(.has-text-color):hover,button:hover,a.button:not(.wc-forward):not(.has-text-color):hover,a.button.checkout:not(.has-text-color):hover,.checkout-button.button:not(.has-text-color):hover,.wp-block-button .wp-block-button__link:not(.has-text-color):hover,.wp-block-button__link:not(.has-text-color):hover,input[type="button"]:not(.has-text-color):hover,input[type="reset"]:not(.has-text-color):hover,input[type="submit"]:not(.has-text-color):hover,.woocommerce-message .button.wc-forward:not(.has-text-color):hover,.comments-area .comment-reply-link:not(.has-text-color):hover, .wp-block-search .wp-block-search__button:not(.has-text-color):hover' );
			
			$css .= $this->get_fill_css( 'button_color', '#FFF', '.woocommerce-product-search .search-submit svg, #masthead-mobile .search-submit svg:not(.stroke-based), ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link svg, ul.wc-block-grid__products li.product .wp-block-button__link svg, ul.products li.wc-block-grid__product .wp-block-button__link svg, ul.products li.product .button svg' );
			$css .= $this->get_fill_css( 'button_color_hover', '#FFF', '.woocommerce-product-search .search-submit:hover svg, #masthead-mobile .search-submit:hover svg:not(.stroke-based), ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link:hover svg, ul.wc-block-grid__products li.product .wp-block-button__link:hover svg, ul.products li.wc-block-grid__product .wp-block-button__link:hover svg, ul.products li.product .button:hover svg' );

			$button_border_color = get_theme_mod( 'button_border_color', '#212121' );
			$button_border_color_hover = get_theme_mod( 'button_border_color_hover', '#757575' );
			$css .= $this->get_border_color_css( 'button_border_color', '#212121', '.wp-block-button.is-style-outline .wp-block-button__link, .wp-block-button__link.is-style-outline,.wp-block-search .wp-block-search__button,button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"]' );
			$css .= $this->get_border_color_css( 'button_border_color_hover', '#757575', '.wp-block-button.is-style-outline .wp-block-button__link:hover,button:hover,a.button:hover,.wp-block-button__link:hover,.wp-block-search .wp-block-search__button:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover' );

			//Widgets
			$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.widget-area .widget', 0.1 );
			$css .= $this->get_color_css( 'button_color', '', '.widget_product_tag_cloud .tag-cloud-link' );
			$css .= $this->get_color_css( 'button_color_hover', '', '.widget_product_tag_cloud .tag-cloud-link:hover' );
			$css .= $this->get_background_color_css( 'button_background_color', '', '.widget_product_tag_cloud .tag-cloud-link' );
			$css .= $this->get_background_color_css( 'button_background_color_hover', '', '.widget_product_tag_cloud .tag-cloud-link:hover' );
			$css .= $this->get_background_color_css( 'button_background_color', '', '.widget_price_filter .ui-slider .ui-slider-handle' );
			$css .= $this->get_background_color_css( 'button_background_color_hover', '', '.widget_price_filter .ui-slider .ui-slider-handle:hover' );

			//WPForms
			$color_forms_borders = get_theme_mod( 'color_forms_borders' );
			$color_forms_placeholder = get_theme_mod( 'color_forms_placeholder' );
			if( defined( 'WPFORMS_VERSION' ) ) {
				$css .= $this->get_background_color_css( 'color_forms_text', '', 'div.wpforms-container-full .wpforms-form .wpforms-field-number-slider input[type=range]::-webkit-slider-thumb', true );
				$css .= ".wpforms-field ::placeholder { color:" . esc_attr( $color_forms_placeholder ) . " !important;opacity:1;}" . "\n";
				$css .= ".wpforms-field :-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . " !important;}" . "\n";
				$css .= ".wpforms-field ::-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . " !important;}" . "\n";

				// button
				$css .= $this->get_top_bottom_padding_css( 'button_top_bottom_padding', $defaults = array( 'desktop' => 13, 'tablet' => 13, 'mobile' => 13 ), '.wpforms-submit', true );
				$css .= $this->get_left_right_padding_css( 'button_left_right_padding', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), '.wpforms-submit', true );

				$css .= ".wpforms-submit { border-radius:" . intval( $button_border_radius ) . "px !important;}" . "\n";

				$css .= ".wpforms-submit { text-transform:" . esc_attr( $button_text_transform ) . " !important;}" . "\n";

				$css .= $this->get_background_color_css( 'button_background_color', '#212121', '.wpforms-submit:not(.has-background)', true );          
				$css .= $this->get_background_color_css( 'button_background_color_hover', '#757575', '.wpforms-submit:not(.has-background):hover', true );          

				$css .= $this->get_color_css( 'button_color', '#FFF', '.wpforms-submit:not(.has-text-color)', true );           
				$css .= $this->get_color_css( 'button_color_hover', '#FFF', '.wpforms-submit:not(.has-text-color):hover', true );
				
				$css .= ".wpforms-submit { border-color:" . esc_attr( $button_border_color ) . " !important;}" . "\n";
				$css .= ".wpforms-submit:hover { border-color:" . esc_attr( $button_border_color_hover ) . " !important;}" . "\n";
			}

			// Layouts
			$site_layout = get_theme_mod( 'site_layout', 'default' );

			// Default, Boxed, Padded
			if ( in_array( $site_layout, array( 'default', 'boxed', 'padded' ) ) ) {
				$css .= $this->get_variable_css( 'content_max_width', 1140, ':root', 'botiga_content_width', 'px' );
			}

			// Boxed
			if ( $site_layout === 'boxed' ) {
				$css .= $this->get_variable_css( 'boxed_max_width', 1000, ':root', 'botiga_boxed_width', 'px' );
			}

			// Padded
			if ( $site_layout === 'padded' ) {
				$css .= $this->get_variable_css( 'background_color', '#ffffff', ':root', 'botiga_background_color' );
				$css .= $this->get_responsive_variable_css( 'padded_layout_spacing', array( 'desktop' => 20, 'tablet' => 10, 'mobile' => 10 ), ':root', 'botiga_padded_spacing', 'px' );
			}

			// Fluid
			if ( $site_layout === 'fluid' ) {
				$css .= $this->get_responsive_variable_css( 'fluid_layout_spacing', array( 'desktop' => 15, 'tablet' => 15, 'mobile' => 15 ), ':root', 'botiga_fluid_spacing', 'px' );
			}

			// Boxed, Padded
			if ( in_array( $site_layout, array( 'boxed', 'padded' ) ) ) {
				$css .= $this->get_background_color_rgba_css( 'content_background_color', '#ffffff', '.site', 1 );          
			}

			//Gutenberg palettes
			$palettes = botiga_global_color_palettes();
		    $selected_palette = get_theme_mod( 'color_palettes', 'palette1' );
			$custom_palette_toggle = get_theme_mod( 'custom_palette_toggle', 0 );

			if ( $custom_palette_toggle ) {
				for ( $i = 0; $i < 8; $i++ ) {
					$color = get_theme_mod( 'custom_color' . ($i+1), '#212121' );
					$css .= ".has-color-" . $i . "-color, .has-color-" . $i . "-color:hover, .has-color-" . $i . "-color:active, .has-color-" . $i . "-color:visited { color:" . esc_attr( $color ) . ";}" . "\n";
					$css .= ".has-color-" . $i . "-background-color, .has-color-" . $i . "-background-color:hover { background-color:" . esc_attr( $color ) . ";}" . "\n";
				}
			} else {
				for ( $i = 0; $i < 8; $i++ ) {
					$css .= ".has-color-" . $i . "-color, .has-color-" . $i . "-color:hover, .has-color-" . $i . "-color:active, .has-color-" . $i . "-color:visited { color:" . esc_attr( $palettes[$selected_palette][$i] ) . ";}" . "\n";
					$css .= ".has-color-" . $i . "-background-color, .has-color-" . $i . "-background-color:hover { background-color:" . esc_attr( $palettes[$selected_palette][$i] ) . ";}" . "\n";
				}
			}

			// Gutenberg palettes backward compatibility
			foreach ( $palettes as $key => $palette ) {
				for ( $i = 0; $i < 8; $i++ ) { 
					$css .= ".has-" . str_replace( 'palette', 'palette-', $key ) . "-color-" . $i . "-color, .has-" . str_replace( 'palette', 'palette-', $key ) . "-color-" . $i . "-color:active, .has-" . str_replace( 'palette', 'palette-', $key ) . "-color-" . $i . "-color:visited { color:" . esc_attr( $palettes[$key][$i] ) . ";}" . "\n";
					$css .= ".has-" . str_replace( 'palette', 'palette-', $key ) . "-color-" . $i . "-background-color { background-color:" . esc_attr( $palettes[$key][$i] ) . ";}" . "\n";
				}
			}

			/**
			 * Hook 'botiga_custom_css_output'
			 * 
			 * @since 1.0.0
			 */
			$css = apply_filters( 'botiga_custom_css_output', $css );

			if ( $custom_css || !is_customize_preview() ) {
				$css .= wp_get_custom_css();
			}

			// Remove css with empty values.
			self::$css_to_replace[] = 'background-color';
			self::$css_to_replace[] = 'color';
			self::$css_to_replace[] = 'border-color';

			if( ! empty( self::$css_to_replace ) ) {
				foreach( self::$css_to_replace as $variable ) {
					$css = str_replace( $variable . ':;', '', $css );
				}
			}
			
			$css = $this->minify( $css );           
			
			return $css;
		}

		/**
		 * Print styles
		 */
		public function print_styles() {

			$css = $this->output_css();

			wp_add_inline_style( 'botiga-style-min', $css );
			wp_localize_script( 'botiga-customizer', 'botiga_theme_options', $this->customizer_js );
			wp_localize_script( 'botiga-customizer', 'botiga_theme_options_css_vars', $this->customizer_js_css_vars );
		}

		/**
		 * Enqueues styles file.
		 *
		 */
		public function enqueue_styles() {

			$exists = file_exists( $this->dynamic_css_path . 'custom-styles.css' );

			if ( ! $exists ) {
				$exists = $this->update_custom_css_file();
			}

			if ( $exists ) {

				/**
				 * Register the custom style here but enqueue is inside functions.php. 
				 * This is required to keep the stylesheets order correct.
				 * 
				 */

				wp_register_style(
					'botiga-custom-styles',
					$this->dynamic_css_uri . 'custom-styles.css',
					false,
					filemtime( $this->dynamic_css_path . 'custom-styles.css' ),
					'all'
				);
			}
		}   

		/**
		 * Init.
		 *
		 */
		public function init() {

			if ( false === get_transient( 'botiga_custom_css' ) ) {
				$this->update_custom_css_file();
			}
		}       
		
		/**
		 * Update custom css file 
		 */
		public function update_custom_css_file() {

			$css = $this->output_css( true );

			if ( empty( $css ) || '' === trim( $css ) ) {
				return;
			}

			// Load file.php file.
			require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php'; // phpcs:ignore

			global $wp_filesystem;

			// Check if the the global filesystem isn't setup yet.
			if ( is_null( $wp_filesystem ) ) {
				WP_Filesystem();
			}
			
			if ( ! file_exists( $this->dynamic_css_path ) ) {
				$wp_filesystem->mkdir( $this->dynamic_css_path );
			}

			if ( $wp_filesystem->put_contents( $this->dynamic_css_path . 'custom-styles.css', $css ) ) {
				$this->clean_cache();
				set_transient( 'botiga_custom_css', true, 0 );
				return true;
			}

			return false;
		}
		
		/**
		 * Delete dynamic css file.
		 *
		 * @return void
		 */
		public function delete_custom_css_file() {

			// Load file.php file.
			require_once ABSPATH . 'wp-admin' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'file.php'; // phpcs:ignore

			global $wp_filesystem;
			// Check if the the global filesystem isn't setup yet.
			if ( is_null( $wp_filesystem ) ) {
				WP_Filesystem();
			}

			$wp_filesystem->delete( $this->dynamic_css_path . 'dynamic-styles.css' );

			delete_transient( 'botiga_custom_css' );
		}

		/**
		 * CSS code minification.
		 */
		private function minify( $css ) {
			$css = preg_replace( '/\s+/', ' ', $css );
			$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
			$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
			$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
			$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
			$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

			return trim( $css );
		}

		/**
		 * Cleans caches
		 *
		 */
		private function clean_cache() {

			// If W3 Total Cache is being used, clear the cache.
			if ( function_exists( 'w3tc_pgcache_flush' ) ) {
				w3tc_pgcache_flush();
			}

			// if WP Super Cache is being used, clear the cache.
			if ( function_exists( 'wp_cache_clean_cache' ) ) {
				global $file_prefix;
				wp_cache_clean_cache( $file_prefix );
			}

			// If SG CachePress is installed, reset its caches.
			if ( class_exists( 'SG_CachePress_Supercacher' ) ) {
				if ( method_exists( 'SG_CachePress_Supercacher', 'purge_cache' ) ) {
					SG_CachePress_Supercacher::purge_cache();
				}
			}

			// Clear caches on WPEngine-hosted sites.
			if ( class_exists( 'WpeCommon' ) ) {

				if ( method_exists( 'WpeCommon', 'purge_memcached' ) ) {
					WpeCommon::purge_memcached();
				}

				if ( method_exists( 'WpeCommon', 'clear_maxcdn_cache' ) ) {
					WpeCommon::clear_maxcdn_cache();
				}

				if ( method_exists( 'WpeCommon', 'purge_varnish_cache' ) ) {
					WpeCommon::purge_varnish_cache();
				}
			}

			// Clean OpCache.
			if ( function_exists( 'opcache_reset' ) && ! ini_get( 'opcache.restrict_api' ) ) {
				opcache_reset(); // phpcs:ignore PHPCompatibility.FunctionUse.NewFunctions.opcache_resetFound
			}

			// Clean WordPress cache.
			if ( function_exists( 'wp_cache_flush' ) ) {
				wp_cache_flush();
			}
		}
		
		/**
		 * Get background color CSS
		 */
		public static function get_background_color_css( $setting = '', $default_value = '', $selector = '', $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			if( ! $mod ) {
				return '';
			}

			if( $setting === 'background_color' && substr( $mod, 0, 1 ) !== '#' ) {
				$mod = "#$mod";
			}

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'background-color', '', $important );

			return $selector . '{ background-color:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) . ';}' . "\n";
		}

		/**
		 * Get background color rgba CSS
		 */
		public static function get_background_color_rgba_css( $setting, $default_value, $selector, $opacity ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'background-color', $opacity );

			return $selector . '{ background-color:' . esc_attr( self::get_instance()->to_rgba( $mod, $opacity ) ) . ';}' . "\n";
		}

		/**
		 * Get color CSS
		 */
		public static function get_color_css( $setting = '', $default_value = '', $selector = '', $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			if( $setting === 'background_color' && substr( $mod, 0, 1 ) !== '#' ) {
				$mod = "#$mod";
			}
			
			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'color', '', $important );
			
			return $selector . '{ color:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}
		
		/**
		 * Get border color CSS
		 */
		public static function get_border_color_css( $setting = '', $default_value = '', $selector = '', $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-color', '', $important );

			return $selector . '{ border-color:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) . ';}' . "\n";
		}

		/**
		 * Get border top color CSS
		 */
		public static function get_border_top_color_css( $setting, $default_value, $selector ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-top-color' );

			return $selector . '{ border-top-color:' . esc_attr( $mod ) . ';}' . "\n";
		}

		/**
		 * Get border top color rgba CSS
		 */
		public static function get_border_top_color_rgba_css( $setting = '', $default_value = '', $selector = '', $opacity = 1, $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-top-color', $opacity, $important );

			return $selector . '{ border-top-color:' . esc_attr( self::get_instance()->to_rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}

		/**
		 * Get border color rgba CSS
		 */
		public static function get_border_color_rgba_css( $setting = '', $default_value = '', $selector = '', $opacity = 1, $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-color', $opacity, $important );

			return $selector . '{ border-color:' . esc_attr( self::get_instance()->to_rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}

		/**
		 * Get border bottom color rgba CSS
		 */
		public static function get_border_bottom_color_rgba_css( $setting = '', $default_value = '', $selector = '', $opacity = 1, $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'border-bottom-color', $opacity, $important );

			return $selector . '{ border-bottom-color:' . esc_attr( self::get_instance()->to_rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}
		
		/**
		 * Get fill CSS
		 */
		public static function get_fill_css( $setting, $default_value, $selector, $opacity = 1, $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'fill', $opacity, $important );

			return $selector . '{ fill:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}   
		
		/**
		 * Get stroke CSS
		 */
		public static function get_stroke_css( $setting, $default_value, $selector ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, 'stroke' );

			return $selector . '{ stroke:' . esc_attr( $mod ) . ';}' . "\n";
		}       

		//Font sizes
		public static function get_font_sizes_css( $setting = '', $defaults = array(), $selector = '', $important = false ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { font-size:' . intval( $mod ) . 'px' . ( ( $important ) ? ' !important' : '' ) .';} }' . "\n";  
			}

			return $css;
		}
		
		//Max width
		public static function get_max_width_css( $setting = '', $defaults = array(), $selector = '', $unit = 'px' ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { max-width:' . intval( $mod ) . $unit . ';} }' . "\n";  
			}

			return $css;
		}           

		//Top bottom padding
		public static function get_top_bottom_padding_css( $setting = '', $defaults = array(), $selector = '', $important = false ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$important = $important ? ' !important' : ''; 

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { padding-top:' . intval( $mod ) . 'px'. $important .'; padding-bottom:' . intval( $mod ) . 'px'. $important .';} }' . "\n"; 
			}

			return $css;
		}   

		//Left right padding
		public static function get_left_right_padding_css( $setting = '', $defaults = array(), $selector = '', $important = false ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$important = $important ? ' !important' : '';

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { padding-left:' . intval( $mod ) . 'px'. $important .';padding-right:' . intval( $mod ) . 'px'. $important .';} }' . "\n";  
			}

			return $css;
		}   

		//Gap
		public static function get_gap_css( $setting = '', $defaults = array(), $selector = '' ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { gap:' . intval( $mod ) . 'px; } }' . "\n"; 
			}

			return $css;
		}   

		//Right margin
		public static function get_right_margin_css( $setting = '', $defaults = array(), $selector = '', $important = false ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { margin-right:' . intval( $mod ) . 'px'. ( ( $important ) ? ' !important' : '' ) .'; } }' . "\n";   
			}

			return $css;
		}

		//Dimensions
		public static function get_dimensions_css( $setting = '', $default_value = '', $selector = '', $css_prop = '', $important = false ) {
			$mod_val = json_decode( get_theme_mod( $setting, $default_value ) );
			$mod_val = is_object( $mod_val ) ? $mod_val : json_decode( $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, $css_prop, '', $important, false, 'dimensions' );

			if( $mod_val->top === '' && $mod_val->right === '' && $mod_val->bottom === '' && $mod_val->left === '' ) {
				return '';
			}

			$mod_val->top    = $mod_val->top === '' ? 0 : $mod_val->top;
			$mod_val->right  = $mod_val->right === '' ? 0 : $mod_val->right;
			$mod_val->bottom = $mod_val->bottom === '' ? 0 : $mod_val->bottom;
			$mod_val->left   = $mod_val->left === '' ? 0 : $mod_val->left;

			$css_prop_value = "{$mod_val->top}{$mod_val->unit} {$mod_val->right}{$mod_val->unit} {$mod_val->bottom}{$mod_val->unit} {$mod_val->left}{$mod_val->unit}";

			if( is_array( $css_prop ) ) {
				$css_output = '';

				foreach( $css_prop as $css ) {
					$css_output .= $selector . '{ '. $css['prop'] .':' . esc_attr( $css_prop_value ) . ( $important ? '!important' : '' ) . ';}' . "\n";
				}

				return $css_output;
			} else {
				return $selector . '{ '. $css_prop .':' . esc_attr( $css_prop_value ) . ( $important ? '!important' : '' ) . ';}' . "\n";
			}
		}

		//Responsive dimensions
		public static function get_responsive_dimensions_css( $setting = '', $defaults = array(), $selector = '', $css_prop = '', $important = false ) {
			$devices = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod_val = json_decode( get_theme_mod( $setting . '_' . $device, $defaults[$device] ) );
				$mod_val = is_object( $mod_val ) ? $mod_val : json_decode( $defaults[$device] );

				self::get_instance()->mount_customizer_js_options( $selector, $setting . '_' . $device, $css_prop, '', $important, true, 'dimensions', $device );

				if( $mod_val->top === '' && $mod_val->right === '' && $mod_val->bottom === '' && $mod_val->left === '' ) {
					continue;
				}

				$mod_val->top    = $mod_val->top === '' ? 0 : $mod_val->top;
				$mod_val->right  = $mod_val->right === '' ? 0 : $mod_val->right;
				$mod_val->bottom = $mod_val->bottom === '' ? 0 : $mod_val->bottom;
				$mod_val->left   = $mod_val->left === '' ? 0 : $mod_val->left;

				$css_prop_value = "{$mod_val->top}{$mod_val->unit} {$mod_val->right}{$mod_val->unit} {$mod_val->bottom}{$mod_val->unit} {$mod_val->left}{$mod_val->unit}";
				$css .= $media . ' { ' . $selector . ' { ' . $css_prop . ':' . esc_attr( $css_prop_value ) . ( $important ? '!important' : '' ) . '; } }' . "\n";   
			}

			return $css;
		}

		//CSS (can pass css prop and unit)
		public static function get_css( $setting = '', $default_value = '', $selector = '', $css_prop = '', $unit = 'px', $important = false ) {
			$mod = get_theme_mod( $setting, $default_value );

			self::get_instance()->mount_customizer_js_options( $selector, $setting, $css_prop, '', $important, false, '', '', $unit );

			if( is_array( $css_prop ) ) {
				$css_output = '';

				foreach( $css_prop as $css ) {
					$css_output .= $selector . '{ '. $css['prop'] .':' . esc_attr( $mod ) . ( isset( $css['unit'] ) ? $css['unit'] : '' ) . ( $important ? '!important' : '' ) . ';}' . "\n";
				}

				return $css_output;
			} else {
				return $selector . '{ '. $css_prop .':' . esc_attr( $mod ) . ( $unit ? $unit : '' ) . ( $important ? '!important' : '' ) . ';}' . "\n";
			}
		}
		
		//Responsive CSS (can pass css prop and unit)
		public static function get_responsive_css( $setting = '', $defaults = array(), $selector = '', $css_prop = '', $unit = 'px', $important = false ) {
			$devices    = array( 
				'desktop'   => '@media (min-width: 992px)',
				'tablet'    => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'    => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {

				$default = ( isset( $defaults[ $device ] ) ) ? $defaults[ $device ] : $defaults;

				$mod = get_theme_mod( $setting . '_' . $device, $default );

				// Some properties need to be converted to be compatible with the respective css property
				$type = '';
				if( strpos( $setting, '_visibility' ) !== FALSE && $css_prop === 'display' ) {
					$type = 'display';
				}

				self::get_instance()->mount_customizer_js_options( $selector, $setting . '_' . $device, $css_prop, '', $important, true, $type, $device, $unit );

				// Check and convert value to be compatible with 'display' css property
				if( $css_prop === 'display' ) {
					if( $mod === 'hidden' ) {
						$mod = 'none';
					} else {
						continue;
					}
				}

				$css .= $media . ' { ' . $selector . ' { ' . $css_prop . ':' . esc_attr( $mod ) . ( $unit ? $unit : '' ) . ( $important ? '!important' : '' ) . '; } }' . "\n"; 
			}

			return $css;
		}

		// Get css variables
		public static function get_variables_css( $selector = '', $variables = array() ) {

			$devices    = array(
				'mobile'  => '',
				'tablet'  => '@media (min-width: 576px) and (max-width:  991px)',
				'desktop' => '@media (min-width: 992px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {

				// Mobile first concept.
				if( 'mobile' === $device ) {
					$css .= $selector . ' {' . self::get_variables_css_content( $variables, $device ) . '}' . "\n";
				} else {
					$css .= $media . ' { ' . $selector . ' {'. self::get_variables_css_content( $variables, $device ) .'} }' . "\n";    
				}
			}

			self::get_instance()->mount_customizer_js_css_vars_options( $selector, $variables );

			return $css;
		}

		public static function get_variables_css_content( $variables, $device ) {
			$css = '';

			foreach( $variables as $variable ) {
				$is_responsive = is_array($variable[ 'defaults' ]);

				if( $is_responsive ) {
					$mod = get_theme_mod( $variable[ 'setting' ] . '_' . $device, $variable[ 'defaults' ][ $device ] );
				} else {
					$mod = get_theme_mod( $variable[ 'setting' ], $variable[ 'defaults' ] );
				}

				if( '--bt-color-bg' === $variable[ 'name' ] && substr( $mod, 0, 1 ) !== '#' ) {
					$mod = "#$mod";
				}
				
				$css .= $variable[ 'name' ] .':' . $mod . $variable[ 'unit' ] .';' . "\n";

				if( ! $is_responsive && $device !== 'mobile' ) {
					$css = '';
				}

				// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
				if ( ! in_array( $variable[ 'name' ], self::$css_to_replace ) ) {
					self::$css_to_replace[] = $variable[ 'name' ];
				}
			}

			return $css;
		}

		// CSS Variable val()
		public static function get_variable_css( $setting = '', $default_value = '', $selector = '', $prop = '', $unit = '' ) {

			$mod = get_theme_mod( $setting, $default_value );

			if ( $mod !== '' ) {

				if( $setting === 'background_color' && substr( $mod, 0, 1 ) !== '#' ) {
					$mod = '#'.$mod;
				}

				return $selector . ' { --'. $prop .':' . esc_attr( $mod ) . $unit .';}' . "\n"; 
			
			}
		}   

		// Responsive CSS Variable val()
		public static function get_responsive_variable_css( $setting = '', $defaults = array(), $selector = '', $variable_name = '', $unit = '' ) {

			$devices    = array( 
				'desktop' => '@media (min-width: 992px)',
				'tablet'  => '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'  => '@media (max-width: 575px)',
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[ $device ] );
				if ( $mod !== '' ) {
					$css .= $media . ' { ' . $selector . ' { --'. $variable_name .':' . intval( $mod ) . $unit .';} }' . "\n";  
				}
			}

			return $css;
		}

		//Convert hex to rgba
		public static function to_rgba( $color = '', $opacity = false ) {

			$default = 'rgb(0,0,0)';

			if( strpos( $color, 'rgba' ) !== FALSE ) {
				return $color;
			}
		 
			if ( $color ) {
				if ( $color[0] == '#' ) {
					$color = substr( $color, 1 );
				}   
			}

			if (strlen($color) == 6) {
				$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
				$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
				return $default;
			}
		
			$rgb =  array_map('hexdec', $hex);
		
			if ( $opacity ){
				if( abs($opacity) > 1 )
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			} else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
		
			return $output;
		}

		public static function mount_customizer_js_options( $selector = '', $setting = '', $prop = '', $opacity = '', $important = false, $is_responsive = false, $type = '', $device = '', $unit = '' ) {
			$options = array(
				'option'        => $setting,
				'selector'      => $selector,
				'prop'          => $prop,
				'important'     => $important,
				'is_responsive' => $is_responsive,
				'type'          => $type,
				'device'        => $device,
				'unit'          => $unit,
			);

			if( $opacity ) {
				$options[ 'rgba' ] = $opacity;
			}

			$options[ 'pseudo' ] = true;
			
			self::get_instance()->customizer_js[] = $options;
		}

		public static function mount_customizer_js_css_vars_options( $selector = '', $variables = array() ) {
			$options = array(
				'selector'      => $selector,
				'variables'     => $variables,
			);

			self::get_instance()->customizer_js_css_vars[] = $options;
		}
	}

	/**
	 * Initialize class
	 */
	Botiga_Custom_CSS::get_instance();

endif;
