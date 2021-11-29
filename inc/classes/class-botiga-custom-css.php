<?php
/**
 * Class for dynamic CSS output
 *
 */


if ( !class_exists( 'Botiga_Custom_CSS' ) ) :

	/**
	 * Botiga_Custom_CSS 
	 */
	Class Botiga_Custom_CSS {

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

			$upload_dir = wp_upload_dir();

			$this->dynamic_css_uri  = trailingslashit( set_url_scheme( $upload_dir['baseurl'] ) ) . 'botiga/';
			$this->dynamic_css_path = trailingslashit( set_url_scheme( $upload_dir['basedir'] ) ) . 'botiga/';

			if ( !is_customize_preview() && wp_is_writable( trailingslashit( $upload_dir['basedir'] ) ) ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 12 );
			} else {
				add_action( 'wp_enqueue_scripts', array( $this, 'print_styles' ), 11 );
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
		 * Output all custom CSS
		 */
		public function output_css( $custom_css = false ) {
			global $post;

			$css = '';

			//Typography 
			$typography_defaults = json_encode(
				array(
					'font' 			=> 'System default',
					'regularweight' => 'regular',
					'category' 		=> 'sans-serif'
				)
			);	

			$body_font		= get_theme_mod( 'botiga_body_font', $typography_defaults );
			$headings_font 	= get_theme_mod( 'botiga_headings_font', $typography_defaults );
		
			$body_font 		= json_decode( $body_font, true );
			$headings_font 	= json_decode( $headings_font, true );
			
			if ( 'System default' !== $body_font['font'] ) {
				$css .= 'body { font-family:' . esc_attr( $body_font['font'] ) . ',' . esc_attr( $body_font['category'] ) . ';}' . "\n";	
			}
			
			if ( 'System default' !== $headings_font['font'] ) {
				$css .= 'h1,h2,h3,h4,h5,h6,.site-title,.wc-block-grid__product-title { font-family:' . esc_attr( $headings_font['font'] ) . ',' . esc_attr( $headings_font['category'] ) . ';}' . "\n";
			}

			$headings_font_style 		= get_theme_mod( 'headings_font_style' );
			$headings_line_height 		= get_theme_mod( 'headings_line_height', 1.2 );
			$headings_letter_spacing 	= get_theme_mod( 'headings_letter_spacing' );
			$headings_text_transform 	= get_theme_mod( 'headings_text_transform' );
			$headings_text_decoration 	= get_theme_mod( 'headings_text_decoration' );

			$css .= "h1,h2,h3,h4,h5,h6,.site-title { text-decoration:" . esc_attr( $headings_text_decoration ) . ";text-transform:" . esc_attr( $headings_text_transform ) . ";font-style:" . esc_attr( $headings_font_style ) . ";line-height:" . esc_attr( $headings_line_height ) . ";letter-spacing:" . esc_attr( $headings_letter_spacing ) . "px;}" . "\n";	

			$css .= $this->get_font_sizes_css( 'h1_font_size', $defaults = array( 'desktop' => 64, 'tablet' => 42, 'mobile' => 32 ), 'h1:not(.site-title)' );
			$css .= $this->get_font_sizes_css( 'h2_font_size', $defaults = array( 'desktop' => 48, 'tablet' => 32, 'mobile' => 24 ), 'h2' );
			$css .= $this->get_font_sizes_css( 'h3_font_size', $defaults = array( 'desktop' => 32, 'tablet' => 24, 'mobile' => 20 ), 'h3' );
			$css .= $this->get_font_sizes_css( 'h4_font_size', $defaults = array( 'desktop' => 24, 'tablet' => 18, 'mobile' => 16 ), 'h4' );
			$css .= $this->get_font_sizes_css( 'h5_font_size', $defaults = array( 'desktop' => 18, 'tablet' => 16, 'mobile' => 16 ), 'h5' );
			$css .= $this->get_font_sizes_css( 'h6_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'h6' );

            $body_font_style 		= get_theme_mod( 'body_font_style' );
			$body_line_height 		= get_theme_mod( 'body_line_height', 1.68 );
			$body_letter_spacing 	= get_theme_mod( 'body_letter_spacing' );
			$body_text_transform 	= get_theme_mod( 'body_text_transform' );
			$body_text_decoration 	= get_theme_mod( 'body_text_decoration' );

			$css .= "body { text-decoration:" . esc_attr( $body_text_decoration ) . ";text-transform:" . esc_attr( $body_text_transform ) . ";font-style:" . esc_attr( $body_font_style ) . ";line-height:" . esc_attr( $body_line_height ) . ";letter-spacing:" . esc_attr( $body_letter_spacing ) . "px;}" . "\n";	
			$css .= $this->get_font_sizes_css( 'body_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'body' );

			//Global colors
			$css .= $this->get_color_css( 'site_title_color', '', '.site-header .site-title a' );
			$css .= $this->get_color_css( 'site_description_color', '', '.site-description' );
			$css .= $this->get_color_css( 'color_body_text', '', 'body,.wp-block-columns p a,.woocommerce-account.logged-in .entry-content>.woocommerce .woocommerce-MyAccount-navigation ul a,.widget a' );
			$css .= $this->get_fill_css( 'color_body_text', '', '.sidebar-slide .sidebar-open-wrapper .sidebar-open svg, .sidebar-slide+.widget-area .sidebar-wrapper .close-sidebar svg' );
			$css .= $this->get_color_css( 'color_link_default', '', 'a:not(.button):not(.wc-forward):not(.wp-block-button__link):not(.botiga-quantity-plus):not(.botiga-quantity-minus):not(.remove_from_cart_button):not(.category-button):not(.page-numbers):hover,ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title:hover' );
			$css .= $this->get_color_css( 'color_link_hover', '', 'a:hover,.site-header .main-navigation .menu > li > a:hover, .site-header .header-contact a:hover,.wp-block-columns p a:hover,.widget a:hover' );
			$css .= $this->get_color_css( 'color_heading_1', '', 'h1' );
			$css .= $this->get_color_css( 'color_heading_2', '', 'h2,.wp-block-search .wp-block-search__label' );
			$css .= $this->get_color_css( 'color_heading_3', '', 'h3' );
			$css .= $this->get_color_css( 'color_heading_4', '', 'h4,.product-gallery-summary .product_meta,.product-gallery-summary .product_meta a,.woocommerce-breadcrumb,.woocommerce-breadcrumb a,.botiga-tabs-style1 .woocommerce-tabs ul.tabs li a,.botiga-tabs-style1 .woocommerce-tabs ul.tabs li a:hover,.product-gallery-summary .woocommerce-Price-amount,.order-total .woocommerce-Price-amount, .woocommerce-mini-cart-item .quantity,.woocommerce-mini-cart__total .woocommerce-Price-amount' );
			$css .= $this->get_background_color_css( 'color_heading_4', '', '.site-header-cart .product_list_widget li a.remove' );
			$css .= $this->get_border_color_css( 'color_heading_4', '', '.botiga-tabs-style1 .woocommerce-tabs ul.tabs li.active a' );
			$css .= $this->get_color_css( 'color_heading_5', '', 'h5' );
			$css .= $this->get_color_css( 'color_heading_6', '', 'h6' );
			$css .= $this->get_color_css( 'color_forms_text', '', 'input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="range"],input[type="date"],input[type="month"],input[type="week"],input[type="time"],input[type="datetime"],input[type="datetime-local"],input[type="color"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus, select:focus, .woocommerce .select2-container .select2-selection--single:focus, .woocommerce-page .select2-container .select2-selection--single:focus,.select2-container--default .select2-selection--single .select2-selection__rendered,.wp-block-search .wp-block-search__input,.wp-block-search .wp-block-search__input:focus' );
			$css .= $this->get_border_color_css( 'color_forms_text', '', '.woocommerce-form__label-for-checkbox span:not(.required):before' );
			$css .= $this->get_background_color_css( 'color_forms_background', '', 'input[type="text"],input[type="email"],input[type="url"],input[type="password"],input[type="search"],input[type="number"],input[type="tel"],input[type="range"],input[type="date"],input[type="month"],input[type="week"],input[type="time"],input[type="datetime"],input[type="datetime-local"],input[type="color"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,.woocommerce-cart .woocommerce-cart-form .actions .coupon input[type="text"]' );
			$color_forms_borders 	= get_theme_mod( 'color_forms_borders' );
			$css .= "input[type=\"text\"],input[type=\"email\"],input[type=\"url\"],input[type=\"password\"],input[type=\"search\"],input[type=\"number\"],input[type=\"tel\"],input[type=\"range\"],input[type=\"date\"],input[type=\"month\"],input[type=\"week\"],input[type=\"time\"],input[type=\"datetime\"],input[type=\"datetime-local\"],input[type=\"color\"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,.woocommerce-account fieldset,.woocommerce-account .woocommerce-form-login, .woocommerce-account .woocommerce-form-register,.woocommerce-cart .woocommerce-cart-form .actions .coupon input[type=\"text\"],.wp-block-search .wp-block-search__input, .woocommerce-form__label-for-checkbox span:not(.required):after { border-color:" . esc_attr( $color_forms_borders ) . ";}" . "\n";
			$color_forms_placeholder 	= get_theme_mod( 'color_forms_placeholder' );
			$css .= "::placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";opacity:1;}" . "\n";
			$css .= ":-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";
			$css .= "::-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";

			$css .= $this->get_background_color_css( 'content_cards_background', '#f5f5f5', '.comments-area,.woocommerce-cart .cart_totals,.checkout-wrapper .woocommerce-checkout-review-order,.woocommerce-info, .woocommerce-noreviews, p.no-comments,.site-header-cart .widget_shopping_cart .woocommerce-mini-cart__total, .site-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons,.woocommerce-account.logged-in .entry-content>.woocommerce .woocommerce-MyAccount-navigation ul .is-active a,.checkout_coupon,.woocommerce-checkout .woocommerce-form-login,.sidebar-slide+.widget-area' );

			$background_color 	= get_theme_mod( 'background_color' );
			$css .= ".checkout-wrapper .wc_payment_methods,.site-header-cart .widget_shopping_cart { background-color:#" . esc_attr( $background_color ) . ";}" . "\n";
			$css .= ".site-header-cart .product_list_widget li a.remove { color:#" . esc_attr( $background_color ) . ";}" . "\n";

			//Header
			$css .= $this->get_max_width_css( 'site_logo_size', $defaults = array( 'desktop' => 180, 'tablet' => 100, 'mobile' => 100 ), '.custom-logo-link img' );
			$css .= $this->get_background_color_css( 'topbar_background', '', '.top-bar' );
			$css .= $this->get_color_css( 'topbar_color', '', '.top-bar, .top-bar a' );
			$css .= $this->get_fill_css( 'topbar_color', '', '.top-bar svg:not(.stroke-based)' );
			$topbar_padding 	= get_theme_mod( 'topbar_padding', 15 );
			$css .= ".top-bar-inner { padding-top:" . esc_attr( $topbar_padding ) . 'px;padding-bottom:' . esc_attr( $topbar_padding ) . "px;}" . "\n";
			$topbar_divider_width 	= get_theme_mod( 'topbar_divider_width', 'fullwidth' );
			$topbar_divider_size 	= get_theme_mod( 'topbar_divider_size', 1 );
			$topbar_divider_color 	= get_theme_mod( 'topbar_divider_color', 'rgba(33,33,33,0.1)' );

			
            if ( 'fullwidth' === $topbar_divider_width ) {
                $css .= ".top-bar { border-bottom:" . esc_attr( $topbar_divider_size ) . 'px solid ' . esc_attr( $topbar_divider_color ) . ";}" . "\n";
            } else {
                $css .= ".top-bar-inner { border-bottom:" . esc_attr( $topbar_divider_size ) . 'px solid ' . esc_attr( $topbar_divider_color ) . ";}.top-bar {border-bottom:0;}" . "\n";
            }

			$main_header_divider_width 	= get_theme_mod( 'main_header_divider_width', 'fullwidth' );
			$main_header_divider_size 	= get_theme_mod( 'main_header_divider_size', 0 );
			$main_header_divider_color 	= get_theme_mod( 'main_header_divider_color', 'rgba(33,33,33,0.1)' );
            
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
			$css .= $this->get_color_css( 'main_header_color', '', '.site-header .site-title a,.site-header .site-description,.site-header .main-navigation .menu > li > a, .site-header .header-contact a' );
			$css .= $this->get_border_color_css( 'main_header_color', '', '.site-header-cart .count-number, .header-wishlist-icon .count-number' );
			$css .= $this->get_fill_css( 'main_header_color', '', '.site-header .header-item svg:not(.stroke-based), .site-header .dropdown-symbol .ws-svg-icon svg' );
			$css .= $this->get_stroke_css( 'main_header_color', '', '.site-header .header-item svg.stroke-based' );

			$css .= $this->get_background_color_css( 'main_header_bottom_background', '', '.bottom-header-row' );
			$css .= $this->get_color_css( 'main_header_bottom_color', '', '.bottom-header-row, .bottom-header-row .header-contact a,.bottom-header-row .main-navigation .menu > li > a' );
			$css .= $this->get_color_css( 'color_link_hover', '', '.bottom-header-row .main-navigation .menu > li > a:hover' );
			$css .= $this->get_fill_css( 'main_header_bottom_color', '', '.bottom-header-row .header-item svg:not(.stroke-based),.dropdown-symbol .ws-svg-icon svg' );
			$css .= $this->get_stroke_css( 'main_header_bottom_color', '', '.bottom-header-row .header-item svg.stroke-based' );
			
			$main_header_padding 	= get_theme_mod( 'main_header_padding', 15 );
			$css .= ".site-header .site-header-inner, .site-header .top-header-row { padding-top:" . esc_attr( $main_header_padding ) . 'px;padding-bottom:' . esc_attr( $main_header_padding ) . "px;}" . "\n";

			$main_header_bottom_padding = get_theme_mod( 'main_header_bottom_padding', 15 );
			$css .= ".bottom-header-inner { padding-top:" . esc_attr( $main_header_bottom_padding ) . 'px;padding-bottom:' . esc_attr( $main_header_bottom_padding ) . "px;}" . "\n";

			$css .= $this->get_background_color_css( 'main_header_submenu_background', '', '.main-navigation ul ul li' );
			$css .= $this->get_color_css( 'main_header_submenu_color', '', '.main-navigation ul ul a' );

			//Sticky header active state
			$sticky_header = get_theme_mod( 'enable_sticky_header', 0 );
			if( $sticky_header ) {
				$css .= '.site-header { -webkit-transition: ease all 300ms; transition: ease all 300ms; }';
				$css .= '@media only screen and (min-width: 1025px) {';
					$css .= $this->get_background_color_css( 'main_header_sticky_active_background', '', '.sticky-header-active .site-header, .sticky-header-active .header-search-form, .sticky-header-active .site-header-cart .count-number, .sticky-header-active .header-wishlist-icon .count-number' );
					$css .= $this->get_color_css( 'main_header_sticky_active_color', '', '.sticky-header-active .site-header .site-header-inner .site-title a, .sticky-header-active .site-header .site-header-inner .site-description, .sticky-header-active .site-header .site-header-inner .main-navigation .menu > li > a, .sticky-header-active .site-header .site-header-inner .header-contact a, .sticky-header-active .site-header .site-header-inner .site-header-cart .count-number, .sticky-header-active .site-header .site-header-inner .header-wishlist-icon .count-number' );
					$css .= $this->get_border_color_css( 'main_header_sticky_active_color', '', '.sticky-header-active .site-header .site-header-inner .site-header-cart .count-number, .sticky-header-active .site-header .site-header-inner .header-wishlist-icon .count-number' );
					$css .= $this->get_fill_css( 'main_header_sticky_active_color', '', '.sticky-header-active .site-header .site-header-inner .header-item svg:not(.stroke-based), .sticky-header-active .site-header .site-header-inner .dropdown-symbol .ws-svg-icon svg' );
					$css .= $this->get_stroke_css( 'main_header_sticky_active_color', '', '.sticky-header-active .site-header .site-header-inner .header-item svg.stroke-based' );
				$css .= '}';
			}

			//Header Layout 6
			$header_layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );

			if( 'header_layout_6' === $header_layout ) {
				$main_header_areas_spacing_l6    = get_theme_mod( 'main_header_areas_spacing_l6', 15 );
				$main_header_elements_spacing_l6 = get_theme_mod( 'main_header_elements_spacing_l6', 15 );
				$main_header_padding             = get_theme_mod( 'main_header_padding', 15 );

				$css .= '.header_layout_6 .botiga-desktop-offcanvas > .row > div { margin-top: '. esc_attr( $main_header_areas_spacing_l6 ) .'px; }';
				$css .= '.header_layout_6 .header-item { margin-bottom: '. esc_attr( $main_header_elements_spacing_l6 ) .'px; }';
				$css .= '.header_layout_6 .header-item.header-contact a + a { margin-top: '. esc_attr( $main_header_elements_spacing_l6 ) .'px; }';
				$css .= '.header_layout_6 .botiga-desktop-offcanvas { padding: '. esc_attr( $main_header_elements_spacing_l6 ) .'px; }';
			}

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
				$css .= '.header_layout_7 .botiga-desktop-offcanvas .main-navigation .menu > li > a, .header_layout_8 .botiga-desktop-offcanvas .main-navigation .menu > li > a { padding-top: '. esc_attr( $desktop_offcanvas_menu_link_spacing ) .'px; padding-bottom: '. esc_attr( $desktop_offcanvas_menu_link_spacing ) .'px; }';

				if( $desktop_offcanvas_menu_link_separator ) {
					$desktop_offcanvas_link_separator_color = get_theme_mod( 'desktop_offcanvas_link_separator_color', '#212121' );

					$css .= '.header_layout_7 .botiga-desktop-offcanvas .main-navigation .menu > li + li, .header_layout_8 .botiga-desktop-offcanvas .main-navigation .menu > li + li { border-top: 1px solid '. esc_attr( Botiga_Custom_CSS::get_instance()->to_rgba( $desktop_offcanvas_link_separator_color, '0.1' ) ) .'; }';
				}

				$css .= $this->get_color_css( 'desktop_offcanvas_menu_text_color', '#212121', '.botiga-desktop-offcanvas .main-navigation .menu li a, .botiga-desktop-offcanvas .site-title a, .botiga-desktop-offcanvas .site-description, .botiga-desktop-offcanvas .site-header-cart .count-number, .botiga-desktop-offcanvas .header-wishlist-icon .count-number, .botiga-desktop-offcanvas .header-contact a' );
				$css .= '.botiga-desktop-offcanvas .main-navigation .menu li a:hover, .botiga-desktop-offcanvas .header-contact a:hover { color: '. esc_attr( Botiga_Custom_CSS::get_instance()->to_rgba( $desktop_offcanvas_menu_text_color, '0.7' ) ) .'; }';
				$css .= $this->get_fill_css( 'desktop_offcanvas_menu_text_color', '#212121', '.botiga-desktop-offcanvas .header-item svg:not(.stroke-based), .botiga-desktop-offcanvas .dropdown-symbol .ws-svg-icon svg, .desktop-menu-close svg' );
				$css .= $this->get_stroke_css( 'desktop_offcanvas_menu_text_color', '#212121', '.botiga-desktop-offcanvas .header-item svg.stroke-based' );
				$css .= $this->get_border_color_css( 'desktop_offcanvas_menu_text_color', '#212121', '.botiga-desktop-offcanvas .site-header-cart .count-number, .botiga-desktop-offcanvas .header-wishlist-icon .count-number' );
				$css .= $this->get_background_color_css( 'desktop_offcanvas_menu_background_color', '#FFF', '.botiga-desktop-offcanvas .site-header-cart .count-number, .botiga-desktop-offcanvas .header-wishlist-icon .count-number' );
				
			}

			//Header mini cart
			// $css .= $this->get_color_css( 'color_body_text', '', '.site-header-cart .count-number' );
			$css .= $this->get_background_color_rgba_css( 'color_body_text', '#212121', '.site-header-cart .widget_shopping_cart .widgettitle:after, .site-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons:before', '0.1' );

			//Mobile menu
			$mobile_menu_alignment = get_theme_mod( 'mobile_menu_alignment', 'left' );
			$css .= ".botiga-offcanvas-menu .main-navigation ul li { text-align:" . esc_attr( $mobile_menu_alignment ) . ";}" . "\n";

			$mobile_menu_link_separator 	= get_theme_mod( 'mobile_menu_link_separator', 0 );
			$link_separator_color 			= get_theme_mod( 'link_separator_color', '#eeeeee' );
			$mobile_header_separator_width	= get_theme_mod( 'mobile_header_separator_width', 1 );

			if ( $mobile_menu_link_separator ) {
				$css .= ".botiga-offcanvas-menu .main-navigation ul li { padding-top:5px;border-bottom: " . intval( $mobile_header_separator_width ) . "px solid " . esc_attr( $link_separator_color ) . ";}" . "\n";
			}

			$mobile_menu_link_spacing = get_theme_mod( 'mobile_menu_link_spacing', 20 );
			$css .= ".botiga-offcanvas-menu .main-navigation a { padding:" . esc_attr( $mobile_menu_link_spacing )/2 . "px 0;}" . "\n";

			$css .= $this->get_background_color_css( 'mobile_header_background', '', '#masthead-mobile' );
			$css .= $this->get_color_css( 'mobile_header_color', '', '#masthead-mobile a:not(.button)' );
			$css .= $this->get_fill_css( 'mobile_header_color', '', '#masthead-mobile svg:not(.stroke-based)' );
			$css .= $this->get_stroke_css( 'mobile_header_color', '', '#masthead-mobile svg.stroke-based' );

			$mobile_header_padding = get_theme_mod( 'mobile_header_padding', 15 );
			$css .= ".mobile-header { padding-top:" . esc_attr( $mobile_header_padding ) . 'px;padding-bottom:' . esc_attr( $mobile_header_padding ) . "px;}" . "\n";

			$css .= $this->get_background_color_css( 'offcanvas_menu_background', '', '.botiga-offcanvas-menu' );
			$css .= $this->get_color_css( 'offcanvas_menu_color', '', '.botiga-offcanvas-menu,.botiga-offcanvas-menu a:not(.button)' );
			$css .= $this->get_fill_css( 'offcanvas_menu_color', '', '.botiga-offcanvas-menu svg:not(.stroke-based), .botiga-offcanvas-menu .dropdown-symbol .ws-svg-icon svg' );
			$css .= $this->get_stroke_css( 'offcanvas_menu_color', '', '.botiga-offcanvas-menu svg.stroke-based' );

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

			$css .= $this->get_color_css( 'single_post_title_color', '', '.single .entry-header .entry-title' );
			$css .= $this->get_color_css( 'single_post_meta_color', '', '.single .entry-meta a' );
			$css .= $this->get_font_sizes_css( 'single_post_meta_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), '.single .entry-meta' );
			$css .= $this->get_font_sizes_css( 'single_post_title_size', $defaults = array( 'desktop' => 32, 'tablet' => 32, 'mobile' => 32 ), '.single .entry-header .entry-title' );
			$css .= $this->get_color_css( 'loop_post_text_color', '', '.posts-archive .entry-content' );
			$css .= $this->get_color_css( 'loop_post_title_color', '', '.posts-archive .entry-title a' );
			$css .= $this->get_color_css( 'loop_post_meta_color', '', '.posts-archive .entry-meta a' );
			$css .= $this->get_font_sizes_css( 'loop_post_text_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), '.posts-archive .entry-content' );
			$css .= $this->get_font_sizes_css( 'loop_post_meta_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), '.posts-archive .entry-meta' );
			$css .= $this->get_font_sizes_css( 'loop_post_title_size', $defaults = array( 'desktop' => 18, 'tablet' => 18, 'mobile' => 18 ), '.posts-archive .entry-title' );

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
			
			$css .= $this->get_color_css( 'color_link_default', '', '.botiga-related-posts .related-post .posted-on a' );
			$css .= $this->get_color_css( 'color_link_hover', '', '.botiga-related-posts .related-post .posted-on a:hover' );
			$css .= $this->get_color_css( 'color_body_text', '', '.botiga-related-posts .related-post h3 a' );
			$css .= $this->get_color_css( 'color_link_hover', '', '.botiga-related-posts .related-post h3 a:hover' );
			$css .= $this->get_color_css( 'button_color', '', '.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev' );
			$css .= $this->get_color_css( 'button_color_hover', '', '.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next:hover, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev:hover' );
			$css .= $this->get_background_color_css( 'button_background_color', '', '.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev' );
			$css .= $this->get_background_color_css( 'button_background_color_hover', '', '.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next:hover, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev:hover' );

			$css .= $this->get_fill_css( 'color_link_hover', '', '.botiga-share-box-item svg' );
			$css .= $this->get_fill_css( 'color_link_default', '', '.botiga-share-box-item:hover svg' );
			
			//Back to top
			$scrolltop_radius 			= get_theme_mod( 'scrolltop_radius', 30 );
			$scrolltop_side_offset 		= get_theme_mod( 'scrolltop_side_offset', 30 );
			$scrolltop_bottom_offset 	= get_theme_mod( 'scrolltop_bottom_offset', 30 );
			$scrolltop_icon_size 		= get_theme_mod( 'scrolltop_icon_size', 18 );
			$scrolltop_padding 			= get_theme_mod( 'scrolltop_padding', 15 );

			$css .= ".back-to-top.display { border-radius:" . esc_attr( $scrolltop_radius ) . "px;bottom:" . esc_attr( $scrolltop_bottom_offset ) . "px;}" . "\n";
			$css .= ".back-to-top.position-right { right:" . esc_attr( $scrolltop_side_offset ) . "px;}" . "\n";
			$css .= ".back-to-top.position-left { left:" . esc_attr( $scrolltop_side_offset ) . "px;}" . "\n";
			$css .= $this->get_background_color_css( 'scrolltop_bg_color', '', '.back-to-top' );
			$css .= $this->get_background_color_css( 'scrolltop_bg_color_hover', '', '.back-to-top:hover' );
			$css .= $this->get_color_css( 'scrolltop_color', '', '.back-to-top' );
			$css .= $this->get_stroke_css( 'scrolltop_color', '', '.back-to-top svg' );
			$css .= $this->get_color_css( 'scrolltop_color_hover', '', '.back-to-top:hover' );
			$css .= $this->get_stroke_css( 'scrolltop_color_hover', '', '.back-to-top:hover svg' );
			$css .= ".back-to-top .ws-svg-icon { width:" . esc_attr( $scrolltop_icon_size ) . "px;height:" . esc_attr( $scrolltop_icon_size ) . "px;}" . "\n";
			$css .= ".back-to-top { padding:" . esc_attr( $scrolltop_padding ) . "px;}" . "\n";

			//Footer
			$footer_widgets_divider 		= get_theme_mod( 'footer_widgets_divider', 0 );
			$footer_widgets_divider_width 	= get_theme_mod( 'footer_widgets_divider_width', 'contained' );
			$footer_widgets_divider_size 	= get_theme_mod( 'footer_widgets_divider_size', 1 );
			$footer_widgets_divider_color 	= get_theme_mod( 'footer_widgets_divider_color' );

			if ( $footer_widgets_divider ) {
				if ( 'contained' === $footer_widgets_divider_width ) {
					$css .= ".footer-widgets-grid { border-top:" . esc_attr( $footer_widgets_divider_size ) . 'px solid ' . esc_attr( $footer_widgets_divider_color ) . ";}" . "\n";
				} else {
					$css .= ".footer-widgets { border-top:" . esc_attr( $footer_widgets_divider_size ) . 'px solid ' . esc_attr( $footer_widgets_divider_color ) . ";}" . "\n";
				}
			}

			$footer_credits_divider 		= get_theme_mod( 'footer_credits_divider', 1 );
			$footer_credits_divider_width 	= get_theme_mod( 'footer_credits_divider_width', 'contained' );
			$footer_credits_divider_size 	= get_theme_mod( 'footer_credits_divider_size', 1 );
			$footer_credits_divider_color 	= get_theme_mod( 'footer_credits_divider_color', 'rgba(33,33,33,0.1)' );			
			if ( $footer_credits_divider ) {
				if ( 'contained' === $footer_credits_divider_width ) {
					$css .= ".site-info { border-top:" . esc_attr( $footer_credits_divider_size ) . 'px solid ' . esc_attr( $footer_credits_divider_color ) . ";}" . "\n";
				} else {
					$css .= ".site-footer { border-top:" . esc_attr( $footer_credits_divider_size ) . 'px solid ' . esc_attr( $footer_credits_divider_color ) . ";}" . "\n";
				}
			} else {
				$css .= ".site-info { border-top:0;}" . "\n";
			}			

			$footer_widgets_column_spacing_desktop = get_theme_mod( 'footer_widgets_column_spacing_desktop', 30 );
			$css .= ".footer-widgets-grid { gap:" . esc_attr( $footer_widgets_column_spacing_desktop ) . "px;}" . "\n";
			$css .= $this->get_top_bottom_padding_css( 'footer_widgets_padding', $defaults = array( 'desktop' => 70, 'tablet' => 40, 'mobile' => 40 ), '.footer-widgets-grid' );
			$css .= $this->get_font_sizes_css( 'footer_widgets_title_size', $defaults = array( 'desktop' => 20, 'tablet' => 20, 'mobile' => 20 ), '.widget-column .widget .widget-title' );

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

			$footer_credits_padding_desktop 		= get_theme_mod( 'footer_credits_padding_desktop', 30 );
			$footer_credits_padding_bottom_desktop 	= get_theme_mod( 'footer_credits_padding_bottom_desktop', 60 );
			$css .= ".site-info { padding-top:" . esc_attr( $footer_credits_padding_desktop ) . 'px;padding-bottom:' . esc_attr( $footer_credits_padding_bottom_desktop ) . "px;}" . "\n";

			$footer_copyright_elements_spacing_desktop = get_theme_mod( 'footer_copyright_elements_spacing_desktop', 15 );
			$css .= ".footer-copyright-elements>div+div { margin-top:" . esc_attr( $footer_copyright_elements_spacing_desktop ) . "px; }" . "\n";

			//Woocommerce
			$shop_archive_header_style = get_theme_mod( 'shop_archive_header_style', 'style1' );
			if( 'style1' === $shop_archive_header_style ) {
				$shop_archive_header_style_alignment = get_theme_mod( 'shop_archive_header_style_alignment', 'center' );

				if( 'left' === $shop_archive_header_style_alignment ) {
					$css .= ".woocommerce-page-header .categories-wrapper { -webkit-box-pack: start; -ms-flex-pack: start; justify-content: flex-start;}" . "\n";
				} elseif( 'right' === $shop_archive_header_style_alignment ) {
					$css .= ".woocommerce-page-header .categories-wrapper { -webkit-box-pack: end; -ms-flex-pack: end; justify-content: flex-end;}" . "\n";
				}
			}

			$css .= $this->get_background_color_css( 'shop_archive_header_background_color', '#FFF', '.woocommerce-page-header' );
			$css .= $this->get_color_css( 'shop_archive_header_title_color', '#212121', '.woocommerce-page-header h1' );
			$css .= $this->get_color_css( 'shop_archive_header_description_color', '#212121', '.woocommerce-page-header .page-description, .woocommerce-page-header .term-description' );
			$css .= $this->get_color_css( 'shop_archive_header_button_color', '#212121', '.woocommerce-page-header .category-button' );
			$css .= $this->get_color_css( 'shop_archive_header_button_color_hover', '#FFF', '.woocommerce-page-header .category-button:hover', true );
			$css .= $this->get_background_color_css( 'shop_archive_header_button_background_color', '#FFF', '.woocommerce-page-header .category-button' );
			$css .= $this->get_background_color_css( 'shop_archive_header_button_background_color_hover', '#FFF', '.woocommerce-page-header .category-button:hover', true );
			$css .= $this->get_border_color_css( 'shop_archive_header_button_border_color', '#212121', '.woocommerce-page-header .category-button' );
			$css .= $this->get_border_color_css( 'shop_archive_header_button_border_color_hover', '#212121', '.woocommerce-page-header .category-button:hover', true );
			$css .= ".woocommerce-page-header .category-button { border-radius: ". get_theme_mod( 'shop_archive_header_button_border_radius', 35 ) ."px; }" . "\n";

			$css .= $this->get_gap_css( 'shop_archive_columns_gap', $defaults = array( 'desktop' => 30, 'tablet' => 30, 'mobile' => 20 ), 'ul.wc-block-grid__products, ul.products' );

			$shop_product_alignment = get_theme_mod( 'shop_product_alignment', 'center' );
			$css .= "ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product { text-align:" . esc_attr( $shop_product_alignment ) . "!important;}" . "\n";

			$shop_categories_alignment = get_theme_mod( 'shop_categories_alignment', 'center' );
			$css .= "ul.products li.product-category .woocommerce-loop-category__title { text-align:" . esc_attr( $shop_categories_alignment ) . ";}" . "\n";

			$shop_categories_layout = get_theme_mod( 'shop_categories_layout', 'layout1' );
			$shop_categories_radius = get_theme_mod( 'shop_categories_radius', 0 );
			$css .= "ul.products li.product-category > a, ul.products li.product-category > a > img { border-radius:" . esc_attr( $shop_categories_radius ) . "px;}" . "\n";
			if( 'layout4' === $shop_categories_layout ) {
				$css .= ".product-category-item-layout4 ul.products li.product-category > a h2 { border-radius: 0 0 " . esc_attr( $shop_categories_radius ) . "px " . esc_attr( $shop_categories_radius ) . "px;}" . "\n";
			}

			$shop_product_card_style 		= get_theme_mod( 'shop_product_card_style', 'layout1' );
			$shop_product_card_border_color = get_theme_mod( 'shop_product_card_border_color', '#eee' );
			$shop_product_card_border_size 	= get_theme_mod( 'shop_product_card_border_size', 1 );
			$shop_product_card_background 	= get_theme_mod( 'shop_product_card_background' );
			$shop_product_card_radius 		= get_theme_mod( 'shop_product_card_radius' );
			$shop_product_card_thumb_radius = get_theme_mod( 'shop_product_card_thumb_radius' );

			if ( 'layout2' === $shop_product_card_style || 'layout3' === $shop_product_card_style ) {
				$css .= "ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product { background-color: " . esc_attr( $shop_product_card_background ) . ";border-radius: " . intval( $shop_product_card_radius ) . "px; border: " . intval( $shop_product_card_border_size ) . "px solid " . esc_attr( $shop_product_card_border_color ) . ";padding:30px;}" . "\n";			
				$css .= "ul.wc-block-grid__products li.wc-block-grid__product .loop-image-wrap, ul.wc-block-grid__products li.product .loop-image-wrap, ul.products li.wc-block-grid__product .loop-image-wrap, ul.products li.product .loop-image-wrap { overflow:hidden;border-radius:" . esc_attr( $shop_product_card_thumb_radius ) . "px;}" . "\n";
				$css .= $this->get_border_color_rgba_css( 'color_body_text', '#eee', 'ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product', '0.1' );
			}

			if ( 'layout3' === $shop_product_card_style ) {
				$css .= "ul.wc-block-grid__products li.wc-block-grid__product .loop-image-wrap, ul.wc-block-grid__products li.product .loop-image-wrap, ul.products li.wc-block-grid__product .loop-image-wrap, ul.products li.product .loop-image-wrap { margin:-30px -30px 12px;}" . "\n";
			}

			if ( 'left' === $shop_product_alignment ) {
				$css .= ".star-rating,ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link, ul.wc-block-grid__products li.wc-block-grid__product .button, ul.wc-block-grid__products li.product .wp-block-button__link, ul.wc-block-grid__products li.product .button, ul.products li.wc-block-grid__product .wp-block-button__link, ul.products li.wc-block-grid__product .button, ul.products li.product .wp-block-button__link, ul.products li.product .button { margin-left:0!important;}" . "\n";
			} elseif ( 'right' === $shop_product_alignment ) {
				$css .= ".star-rating,ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link, ul.wc-block-grid__products li.wc-block-grid__product .button, ul.wc-block-grid__products li.product .wp-block-button__link, ul.wc-block-grid__products li.product .button, ul.products li.wc-block-grid__product .wp-block-button__link, ul.products li.wc-block-grid__product .button, ul.products li.product .wp-block-button__link, ul.products li.product .button { margin-right:0!important;}" . "\n";		
			}

			$shop_product_element_spacing = get_theme_mod( 'shop_product_element_spacing', 12 );
			$css .= "ul.wc-block-grid__products li.wc-block-grid__product .col-md-7>*, ul.wc-block-grid__products li.wc-block-grid__product .col-md-8>*, ul.wc-block-grid__products li.wc-block-grid__product>*, ul.wc-block-grid__products li.product .col-md-7>*, ul.wc-block-grid__products li.product .col-md-8>*, ul.wc-block-grid__products li.product>*, ul.products li.wc-block-grid__product .col-md-7>*, ul.products li.wc-block-grid__product .col-md-8>*, ul.products li.wc-block-grid__product>*, ul.products li.product .col-md-7>*, ul.products li.product .col-md-8>*, ul.products li.product>* { margin-bottom:" . esc_attr( $shop_product_element_spacing ) . "px;}" . "\n";

			$shop_product_sale_tag_layout 	= get_theme_mod( 'shop_product_sale_tag_layout', 'layout1' );
			$shop_sale_tag_spacing			= get_theme_mod( 'shop_sale_tag_spacing', 20 );
			$shop_sale_tag_radius			= get_theme_mod( 'shop_sale_tag_radius', 0 );

			$css .= ".wc-block-grid__product-onsale, span.onsale {border-radius:" . esc_attr( $shop_sale_tag_radius ) . "px;top:" . esc_attr( $shop_sale_tag_spacing ) . "px!important;left:" . esc_attr( $shop_sale_tag_spacing ) . "px!important;}" . "\n";
			if ( 'layout2' === $shop_product_sale_tag_layout ) {
				$css .= ".wc-block-grid__product-onsale, .products span.onsale {left:auto!important;right:" . esc_attr( $shop_sale_tag_spacing ) . "px;}" . "\n";
			}

			$css .= $this->get_color_css( 'single_product_sale_color', '', '.wc-block-grid__product-onsale, span.onsale' );
			$css .= $this->get_background_color_css( 'single_product_sale_background_color', '', '.wc-block-grid__product-onsale, span.onsale' );
			$css .= $this->get_color_css( 'shop_product_product_title', '', 'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title, ul.wc-block-grid__products li.product .wc-block-grid__product-title, ul.wc-block-grid__products li.product .woocommerce-loop-product__title, ul.products li.wc-block-grid__product .wc-block-grid__product-title, ul.products li.wc-block-grid__product .woocommerce-loop-product__title, ul.products li.product .wc-block-grid__product-title, ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-category__title, .woocommerce-loop-product__title .botiga-wc-loop-product__title' );
			$css .= $this->get_color_css( 'shop_product_product_title_hover', '', 'ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title:hover, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title:hover, ul.wc-block-grid__products li.product .wc-block-grid__product-title:hover, ul.wc-block-grid__products li.product .woocommerce-loop-product__title:hover, ul.products li.wc-block-grid__product .wc-block-grid__product-title:hover, ul.products li.wc-block-grid__product .woocommerce-loop-product__title:hover, ul.products li.product .wc-block-grid__product-title:hover, ul.products li.product .woocommerce-loop-product__title:hover, ul.products li.product .woocommerce-loop-category__title:hover, .woocommerce-loop-product__title .botiga-wc-loop-product__title:hover', true );

			$css .= $this->get_color_css( 'color_body_text', '', 'a.wc-forward:not(.checkout-button)' );
			$css .= $this->get_color_css( 'color_link_hover', '', 'a.wc-forward:not(.checkout-button):hover' );
			$css .= $this->get_color_css( 'button_color_hover', '', '.woocommerce-pagination li .page-numbers:hover' );
			$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.woocommerce-sorting-wrapper', '0.1' );

			//Wishlist
			$wishlist_layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );
			if( 'layout1' !== $wishlist_layout ) {
				// wishlist buttons/icons
				$css .= $this->get_color_css( 'color_body_text', '', '.single-product .botiga-wishlist-wrapper .botiga-wishlist-button' );
				$css .= $this->get_stroke_css( 'color_link_default', '#212121', '.botiga-wishlist-button svg path, .botiga-wishlist-button:hover svg path' );
				$css .= $this->get_fill_css( 'shop_product_wishlist_icon_active_color', '#fda5a5', '.botiga-wishlist-button:hover svg path, .botiga-wishlist-button.active svg path' );
				$css .= $this->get_stroke_css( 'shop_product_wishlist_icon_active_color', '#fda5a5', '.botiga-wishlist-button:hover svg path, .botiga-wishlist-button.active svg path' );
				$css .= '.botiga-wishlist-button.botiga-wishlist-button-tooltip:not(.active):after { border-left-color: '. get_theme_mod( 'color_link_default', '#212121' ) .'; }';
				$css .= $this->get_background_color_css( 'color_link_default', '', '.botiga-wishlist-button.botiga-wishlist-button-tooltip:not(.active):before' );
				$css .= $this->get_background_color_css( 'shop_product_wishlist_icon_background_color', 'rgba(255,255,255,0)', '.botiga-wishlist-button' );
				

				// wishlist page
				$css .= $this->get_color_css( 'color_link_default', '', 'a.botiga-custom-addtocart, .botiga_wishlist_table .product-addtocart strong a' );
				$css .= $this->get_color_css( 'color_link_hover', '', 'a.botiga-custom-addtocart:hover, .botiga_wishlist_table .product-addtocart strong a:hover' );
			} 

			//Sidebar
			$shop_archive_sidebar = get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

			if( 'sidebar-top' === $shop_archive_sidebar ) {
				$css .= $this->get_background_color_css( 'content_cards_background', '#f5f5f5', '.sidebar-top+.widget-area .sidebar-wrapper' );
			}
			
			//Woocommerce single
			$single_sku 	 	= get_theme_mod( 'single_product_sku', 1 );
			$single_categories  = get_theme_mod( 'single_product_categories', 1 );
			$single_tags 	 	= get_theme_mod( 'single_product_tags', 1 );
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
					$color_rgba = Botiga_Custom_CSS::get_instance()->to_rgba( get_theme_mod( 'single_product_tabs_remaining_borders', '#212121' ), '0.3' );

					$css .= $this->get_background_color_rgba_css( 'single_product_tabs_background_color', '#f5f5f5', '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li:not(.active) a', '0.4' );
					$css .= $this->get_background_color_rgba_css( 'single_product_tabs_background_color_active', '#f5f5f5', '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style5 .woocommerce-tabs .panel', '1' );
					$css .= $this->get_border_color_rgba_css( 'single_product_tabs_remaining_borders', '#212121', '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li a, .botiga-tabs-style5 .woocommerce-tabs .panel', '0.3' );
					$css .= '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li:not(.active) a { border-right: 1px solid '.  esc_attr( $color_rgba ) .' }';
					$css .= '.botiga-tabs-style5.botiga-tabs-align-center .woocommerce-tabs ul.tabs li+li a { border-top-color: '.  esc_attr( $color_rgba ) .'; border-right-color: '.  esc_attr( $color_rgba ) .' }';
					break;		
			}

			$css .= $this->get_color_css( 'single_product_tabs_text_color', '', '.woocommerce-tabs ul.tabs li:not(.active) a ,.woocommerce-tabs ul.tabs li:not(.active) a:hover' );
			$css .= $this->get_color_css( 'single_product_tabs_text_color_active', '', '.woocommerce-tabs ul.tabs li.active a,.woocommerce-tabs ul.tabs li.active a:hover' );

			//Woocommerce single sticky add to cart
			$single_sticky_add_to_cart = get_theme_mod( 'single_sticky_add_to_cart', 0 );

			if( $single_sticky_add_to_cart ) {
				$css .= $this->get_border_color_css( 'single_sticky_add_to_cart_style_color_border', '', '.botiga-single-sticky-add-to-cart-wrapper' );
				$css .= $this->get_background_color_css( 'single_sticky_add_to_cart_style_color_background', '', '.botiga-single-sticky-add-to-cart-wrapper, .botiga-single-sticky-add-to-cart-wrapper input[type="number"], .botiga-single-sticky-add-to-cart-wrapper select' );
				$css .= $this->get_color_css( 'single_sticky_add_to_cart_style_color_content', '', '.botiga-single-sticky-add-to-cart-wrapper h5, .botiga-single-sticky-add-to-cart-wrapper .price, .botiga-single-sticky-add-to-cart-wrapper form.cart .quantity .botiga-quantity-minus, .botiga-single-sticky-add-to-cart-wrapper form.cart .quantity .botiga-quantity-plus, .botiga-single-sticky-add-to-cart-wrapper .quantity .qty, .botiga-single-sticky-add-to-cart-wrapper .botiga-single-sticky-add-to-cart-wrapper-content .variations_form table.variations .label, .botiga-single-sticky-add-to-cart-wrapper select' );
				$css .= $this->get_border_color_css( 'single_sticky_add_to_cart_style_color_content', '', '.botiga-single-sticky-add-to-cart-wrapper form.cart .quantity, .botiga-single-sticky-add-to-cart-wrapper select' );
				$css .= '.botiga-single-sticky-add-to-cart-wrapper .price del { color: '. esc_attr( get_theme_mod( 'single_sticky_add_to_cart_style_color_content', '#212121' ) ) .'; opacity: 0.8; }';
				$css .= '.botiga-single-sticky-add-to-cart-wrapper .botiga-single-sticky-add-to-cart-wrapper-content .botiga-single-sticky-add-to-cart-item { margin-right: '. esc_attr( $single_sticky_add_to_cart_elements_spacing ) .'px; }';
			}

			//Quick view
			$css .= $this->get_background_color_css( 'content_cards_background', '', '.botiga-quick-view-popup .botiga-quick-view-popup-content' );

			//Mini cart
			$css .= $this->get_color_css( 'color_body_text', '', '.mini_cart_item a:nth-child(2)' );
			$css .= $this->get_color_css( 'color_link_default', '', '.site-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons .button:not(.checkout)' );

			//Cart
			$css .= $this->get_stroke_css( 'color_link_hover', '', '.has-cross-sells-carousel .cross-sells .botiga-carousel-wrapper .botiga-carousel-nav svg path' );
			$css .= $this->get_stroke_css( 'color_link_default', '', '.has-cross-sells-carousel .cross-sells .botiga-carousel-wrapper .botiga-carousel-nav:hover svg path' );
			$css .= $this->get_color_css( 'color_body_text', '', '.woocommerce-cart .product-name a,.woocommerce-cart .product-remove a' );
			$css .= $this->get_color_css( 'color_link_hover', '', '.woocommerce-cart .product-name a:hover,.woocommerce-cart .product-remove a:hover' );
			
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
			if( $checkout_sticky_totals_box ) {
				$css .= '.woocommerce-checkout .woocommerce-checkout-review-order { position: sticky; top: 45px; } .admin-bar .woocommerce-checkout .woocommerce-checkout-review-order { top: 77px; }';
			}

			//Order Received
			$css .= $this->get_background_color_css( 'content_cards_background', '#f5f5f5', '.shop_table.order_details, .shop_table.woocommerce-MyAccount-orders, .woocommerce-thankyou-order-received, .woocommerce-thankyou-order-details' );
			$css .= $this->get_color_css( 'color_body_text', '', '.shop_table.order_details, .shop_table.woocommerce-MyAccount-orders' );

			//Multi step checkout
			$shop_checkout_layout = get_theme_mod( 'shop_checkout_layout', 'layout1' );
			if( 'layout3' === $shop_checkout_layout ) {
				$css .= $this->get_background_color_css( 'content_cards_background', '#f5f5f5', '.botiga-mstepc-wrapper .woocommerce-billing-fields__field-wrapper, .botiga-mstepc-wrapper .woocommerce-shipping-fields__field-wrapper, .botiga-mstepc-wrapper .woocommerce-account-fields, .botiga-mstepc-wrapper .woocommerce-additional-fields__field-wrapper, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item .step, .botiga-mstepc-wrapper .botiga-mstep-order-review' );
				$css .= $this->get_color_css( 'color_body_text', '', '.botiga-mstepc-wrapper a' );
				$css .= $this->get_color_css( 'color_heading_1', '', '.botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item:not(.current-step):not(.completed):hover .step .step-number' );
				$css .= $this->get_background_color_css( 'color_link_default', '', '.botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.current-step .step, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.completed .step' );
				$css .= $this->get_border_color_css( 'color_link_default', '', '.botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item:hover .step, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.completed .step, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.current-step .step' );
				$css .= $this->get_background_color_rgba_css( 'color_body_text', '#212121', '.botiga-mstepc-wrapper .divider', '0.1', true );
				
				$css .= '.botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.current-step:before, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.completed:before { border-top-color: '. esc_attr( get_theme_mod( 'color_link_default', '#212121' ) ) .' }';
				$css .= '.botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item:before { border-top-color: '. esc_attr( Botiga_Custom_CSS::get_instance()->to_rgba( get_theme_mod( 'color_body_text', '#212121' ), '0.1' ) ) .' }';
				$css .= '.botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item .step svg { fill: #'. esc_attr( $background_color ) .'; }';
			}

			

			//My account
			$css .= $this->get_color_css( 'color_link_default', '', '.woocommerce-account.logged-in .entry-content>.woocommerce .woocommerce-MyAccount-navigation ul .is-active a' );
			$css .= $this->get_color_css( 'color_link_default', '', '.woocommerce-orders-table__cell-order-number a,.woocommerce-MyAccount-content p a' );
			$css .= $this->get_color_css( 'color_link_hover', '', '.woocommerce-orders-table__cell-order-number a:hover,.woocommerce-MyAccount-content p a:hover' );

			//View order
			$css .= $this->get_background_color_css( 'content_cards_background', '', '.woocommerce-account .botiga-wc-account-view-order+.woocommerce-notices-wrapper+p' );

			//Single product options
			$css .= $this->get_border_color_css( 'color_link_default', '', '.single-product div.product .gallery-vertical .flex-control-thumbs li img:hover, .single-product div.product .gallery-vertical .flex-control-thumbs li img.flex-active' );
			$css .= $this->get_background_color_css( 'content_cards_background', '#f5f5f5', '.woocommerce-message, .woocommerce-info, .woocommerce-error, .woocommerce-noreviews, p.no-comments, .botiga-quick-view-popup form.cart .qty, .woocommerce-Reviews #comments .review .comment_container .comment-text .description, .woocommerce-Reviews #review_form_wrapper' );
			$css .= $this->get_color_css( 'single_product_title_color', '', '.product-gallery-summary .product_title' );
			$css .= $this->get_color_css( 'single_product_price_color', '', '.product-gallery-summary .price' );
			$css .= $this->get_font_sizes_css( 'single_product_title_size', $defaults = array( 'desktop' => 32, 'tablet' => 32, 'mobile' => 32 ), '.product-gallery-summary .entry-title' );
			$css .= $this->get_font_sizes_css( 'single_product_price_size', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), '.product-gallery-summary .price' );
			$css .= $this->get_border_color_css( 'color_body_text', '', '.woocommerce-cart-form .quantity, form.cart .quantity' );
			$css .= $this->get_color_css( 'color_body_text', '', '.woocommerce-cart-form .quantity .botiga-quantity-plus, form.cart .quantity .botiga-quantity-plus, .woocommerce-cart-form .quantity .botiga-quantity-minus, form.cart .quantity .botiga-quantity-minus' );

			//Tables
			$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.shop_table th, .shop_table td, .shop_table tr', '0.1', true );
			$css .= $this->get_color_css( 'color_link_default', '', '.woocommerce-table__product-name.product-name a' );

			//Buttons
			$css .= $this->get_top_bottom_padding_css( 'button_top_bottom_padding', $defaults = array( 'desktop' => 13, 'tablet' => 13, 'mobile' => 13 ), 'button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );
			$css .= $this->get_left_right_padding_css( 'button_left_right_padding', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), 'button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );

			$button_border_radius = get_theme_mod( 'button_border_radius' );
			$css .= "button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { border-radius:" . intval( $button_border_radius ) . "px;}" . "\n";

			$css .= $this->get_font_sizes_css( 'button_font_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), 'button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );
			$css .= $this->get_font_sizes_css( 'button_font_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), '.wp-block-button__link', true );
			$button_text_transform = get_theme_mod( 'button_text_transform', 'uppercase' );
			$css .= "button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { text-transform:" . esc_attr( $button_text_transform ) . ";}" . "\n";

			$css .= $this->get_background_color_css( 'button_background_color', '#212121', 'button,a.button,.wp-block-button__link,.wp-block-search .wp-block-search__button,input[type="button"],input[type="reset"],input[type="submit"]' );			
			$css .= $this->get_background_color_css( 'button_background_color_hover', '#757575', 'button:hover,a.button:hover,.wp-block-button__link:hover,.wp-block-search .wp-block-search__button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover' );			

			$css .= $this->get_color_css( 'button_color', '#FFF', 'button,a.button:not(.wc-forward),.checkout-button.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"],.woocommerce-message .button.wc-forward' );			
			$css .= $this->get_color_css( 'button_color_hover', '#FFF', 'button:hover,a.button:not(.wc-forward):hover,a.button.checkout,.wp-block-button__link:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,.woocommerce-message .button.wc-forward:hover' );			

			$button_border_color = get_theme_mod( 'button_border_color', '#212121' );
			$button_border_color_hover = get_theme_mod( 'button_border_color_hover', '#757575' );
			$css .= ".is-style-outline .wp-block-button__link, .wp-block-button__link.is-style-outline,.wp-block-search .wp-block-search__button,button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { border-color:" . esc_attr( $button_border_color ) . ";}" . "\n";
			$css .= "button:hover,a.button:hover,.wp-block-button__link:hover,.wp-block-search .wp-block-search__button:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover { border-color:" . esc_attr( $button_border_color_hover ) . ";}" . "\n";

			//Widgets
			$css .= $this->get_background_color_css( 'color_body_text', '', '.widget_price_filter .ui-slider .ui-slider-range' );
			$css .= $this->get_border_color_rgba_css( 'color_body_text', '#212121', '.widget-area .widget', 0.1 );
			$css .= $this->get_color_css( 'button_color', '', '.widget_product_tag_cloud .tag-cloud-link' );
			$css .= $this->get_color_css( 'button_color_hover', '', '.widget_product_tag_cloud .tag-cloud-link:hover' );
			$css .= $this->get_background_color_css( 'button_background_color', '', '.widget_product_tag_cloud .tag-cloud-link' );
			$css .= $this->get_background_color_css( 'button_background_color_hover', '', '.widget_product_tag_cloud .tag-cloud-link:hover' );
			$css .= $this->get_background_color_css( 'button_background_color', '', '.widget_price_filter .ui-slider .ui-slider-handle' );
			$css .= $this->get_background_color_css( 'button_background_color_hover', '', '.widget_price_filter .ui-slider .ui-slider-handle:hover' );
			
			//Gutenberg palettes
			$palettes = botiga_global_color_palettes();

			foreach ( $palettes as $key => $palette ) {
				for ( $i = 0; $i < 8; $i++ ) { 
					$css .= ".has-" . str_replace( 'palette', 'palette-', $key ) . "-color-" . $i . "-color { color:" . esc_attr( $palettes[$key][$i] ) . ";}" . "\n";
					$css .= ".has-" . str_replace( 'palette', 'palette-', $key ) . "-color-" . $i . "-background-color { background-color:" . esc_attr( $palettes[$key][$i] ) . ";}" . "\n";
				}
			}

			//Filter the value
			$css = apply_filters( 'botiga_custom_css_output', $css );

			if ( $custom_css || !is_customize_preview() ) {
				$css .= wp_get_custom_css();
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
		}

		/**
		 * Enqueues styles file.
		 *
		 */
		public function enqueue_styles() {

			$exists = file_exists( $this->dynamic_css_path . 'custom-styles.css' );

			if ( !$exists ) {
				$exists = $this->update_custom_css_file();
			}

			if ( $exists ) {
				wp_enqueue_style(
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
		public static function get_background_color_css( $setting, $default, $selector, $important = false ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ background-color:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) . ';}' . "\n";
		}

		/**
		 * Get background color rgba CSS
		 */
		public static function get_background_color_rgba_css( $setting, $default, $selector, $opacity ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ background-color:' . esc_attr( Botiga_Custom_CSS::get_instance()->to_rgba( $mod, $opacity ) ) . ';}' . "\n";
		}

		/**
		 * Get color CSS
		 */
		public static function get_color_css( $setting, $default, $selector, $important = false ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ color:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}
		
		/**
		 * Get border color CSS
		 */
		public static function get_border_color_css( $setting, $default, $selector, $important = false ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ border-color:' . esc_attr( $mod ) . ( $important ? '!important' : '' ) . ';}' . "\n";
		}

		/**
		 * Get border top color CSS
		 */
		public static function get_border_top_color_css( $setting, $default, $selector ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ border-top-color:' . esc_attr( $mod ) . ';}' . "\n";
		}

		/**
		 * Get border color rgba CSS
		 */
		public static function get_border_color_rgba_css( $setting, $default, $selector, $opacity, $important = false ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ border-color:' . esc_attr( Botiga_Custom_CSS::get_instance()->to_rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}

		/**
		 * Get border bottom color rgba CSS
		 */
		public static function get_border_bottom_color_rgba_css( $setting, $default, $selector, $opacity, $important = false ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ border-bottom-color:' . esc_attr( Botiga_Custom_CSS::get_instance()->to_rgba( $mod, $opacity ) ) . ( $important ? '!important' : '' ) .';}' . "\n";
		}
		
		/**
		 * Get fill CSS
		 */
		public static function get_fill_css( $setting, $default, $selector ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ fill:' . esc_attr( $mod ) . ';}' . "\n";
		}	
		
		/**
		 * Get stroke CSS
		 */
		public static function get_stroke_css( $setting, $default, $selector ) {
			$mod = get_theme_mod( $setting, $default );

			return $selector . '{ stroke:' . esc_attr( $mod ) . ';}' . "\n";
		}		

		//Font sizes
		public static function get_font_sizes_css( $setting, $defaults = array(), $selector, $important = false ) {
			$devices 	= array( 
				'desktop' 	=> '@media (min-width: 992px)',
				'tablet'	=> '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'	=> '@media (max-width: 575px)'
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { font-size:' . intval( $mod ) . 'px' . ( ( $important ) ? ' !important' : '' ) .';} }' . "\n";	
			}

			return $css;
		}
		
		//Max width
		public static function get_max_width_css( $setting, $defaults = array(), $selector ) {
			$devices 	= array( 
				'desktop' 	=> '@media (min-width: 992px)',
				'tablet'	=> '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'	=> '@media (max-width: 575px)'
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { max-width:' . intval( $mod ) . 'px;} }' . "\n";	
			}

			return $css;
		}			

		//Top bottom padding
		public static function get_top_bottom_padding_css( $setting, $defaults = array(), $selector ) {
			$devices 	= array( 
				'desktop' 	=> '@media (min-width: 992px)',
				'tablet'	=> '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'	=> '@media (max-width: 575px)'
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { padding-top:' . intval( $mod ) . 'px;padding-bottom:' . intval( $mod ) . 'px;} }' . "\n";	
			}

			return $css;
		}	

		//Left right padding
		public static function get_left_right_padding_css( $setting, $defaults = array(), $selector ) {
			$devices 	= array( 
				'desktop' 	=> '@media (min-width: 992px)',
				'tablet'	=> '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'	=> '@media (max-width: 575px)'
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { padding-left:' . intval( $mod ) . 'px;padding-right:' . intval( $mod ) . 'px;} }' . "\n";	
			}

			return $css;
		}	

		//Gap
		public static function get_gap_css( $setting, $defaults = array(), $selector ) {
			$devices 	= array( 
				'desktop' 	=> '@media (min-width: 992px)',
				'tablet'	=> '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'	=> '@media (max-width: 575px)'
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { gap:' . intval( $mod ) . 'px; } }' . "\n";	
			}

			return $css;
		}	

		//Right margin
		public static function get_right_margin_css( $setting, $defaults = array(), $selector, $important = false ) {
			$devices 	= array( 
				'desktop' 	=> '@media (min-width: 992px)',
				'tablet'	=> '@media (min-width: 576px) and (max-width:  991px)',
				'mobile'	=> '@media (max-width: 575px)'
			);

			$css = '';

			foreach ( $devices as $device => $media ) {
				$mod = get_theme_mod( $setting . '_' . $device, $defaults[$device] );
				$css .= $media . ' { ' . $selector . ' { margin-right:' . intval( $mod ) . 'px'. ( ( $important ) ? ' !important' : '' ) .'; } }' . "\n";	
			}

			return $css;
		}	
		
		//Convert hex to rgba
		public static function to_rgba( $color, $opacity = false ) {

			$default = 'rgb(0,0,0)';
		 
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
	}

	/**
	 * Initialize class
	 */
	Botiga_Custom_CSS::get_instance();

endif;