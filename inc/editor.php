<?php
/**
 * Gutenberg related functionality
 *
 * @package Botiga
 */

/**
 * Enqueue assets
 */
function botiga_enqueue_gutenberg_assets() {
	wp_enqueue_style( 'botiga-block-editor-styles', get_template_directory_uri() . '/assets/css/editor.min.css', array(), BOTIGA_VERSION );

	$fonts_library = get_theme_mod( 'fonts_library', 'google' );
	if( $fonts_library === 'google' ) {
		wp_enqueue_style( 'botiga-google-fonts', botiga_google_fonts_url(), array(), botiga_google_fonts_version() );
	} elseif( $fonts_library === 'custom' ) {
		wp_enqueue_style( 'botiga-custom-google-fonts', botiga_custom_google_fonts_url(), array(), botiga_google_fonts_version() );
	} else {
		$kits = get_option( 'botiga_adobe_fonts_kits', array() );

		foreach ( $kits as $kit_id => $kit_data ) {

			if ( $kit_data['enable'] == false ) {
				continue;
			}

			wp_enqueue_style( 'botiga-typekit-' . $kit_id, 'https://use.typekit.net/' . $kit_id . '.css', array(), BOTIGA_VERSION );
		}
	}
	
	/**
	 * Make Customizer dynamic styles available in the editor
	 */
	$css = '';

	// Block editor color palettes.
	$css .= Botiga_Custom_CSS::get_block_editor_color_palettes_css( 'block-editor' );

	//Buttons
	$css .= Botiga_Custom_CSS::get_top_bottom_padding_css( 'button_top_bottom_padding', $defaults = array( 'desktop' => 13, 'tablet' => 13, 'mobile' => 13 ), 'div.editor-styles-wrapper button,a.button,div.editor-styles-wrapper .wp-block-button__link, div.editor-styles-wrapper input[type="button"], div.editor-styles-wrapper input[type="reset"], div.editor-styles-wrapper input[type="submit"], div.editor-styles-wrapper .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link' );
	$css .= Botiga_Custom_CSS::get_left_right_padding_css( 'button_left_right_padding', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), 'div.editor-styles-wrapper button,a.button, div.editor-styles-wrapper .wp-block-button__link, div.editor-styles-wrapper input[type="button"], div.editor-styles-wrapper input[type="reset"], div.editor-styles-wrapper input[type="submit"], div.editor-styles-wrapper .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link' );

	$button_border_radius = get_theme_mod( 'button_border_radius' );
	$css .= "div.editor-styles-wrapper .wp-block-button__link { border-radius:" . intval( $button_border_radius ) . "px;}" . "\n";

	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'button_font_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), 'div.editor-styles-wrapper button, div.editor-styles-wrapper a.button, div.editor-styles-wrapper .wp-block-button__link, div.editor-styles-wrapper input[type="button"], div.editor-styles-wrapper input[type="reset"], div.editor-styles-wrapper input[type="submit"]' );
	$button_text_transform = get_theme_mod( 'button_text_transform', 'uppercase' );
	$css .= "div.editor-styles-wrapper .wp-block-button__link { text-transform:" . esc_attr( $button_text_transform ) . ";}" . "\n";

	$css .= Botiga_Custom_CSS::get_background_color_css( 'button_background_color', '#212121', 'div.editor-styles-wrapper .wp-block-button__link' );            
	$css .= Botiga_Custom_CSS::get_background_color_css( 'button_background_color_hover', '#757575', 'div.editor-styles-wrapper .wp-block-button__link:hover, div.editor-styles-wrapper .is-style-outline .wp-block-button__link:not(.has-background):hover' );         

	$css .= Botiga_Custom_CSS::get_color_css( 'button_color', '#ffffff', 'div.editor-styles-wrapper .wp-block-button__link, div.editor-styles-wrapper .wp-block-button__link:visited, div.editor-styles-wrapper .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color)' );           
	$css .= Botiga_Custom_CSS::get_color_css( 'button_color_hover', '#ffffff', 'div.editor-styles-wrapper .wp-block-button__link:hover, div.editor-styles-wrapper .is-style-outline .wp-block-button__link:not(.has-text-color):hover' );           

	$button_border_color = get_theme_mod( 'button_border_color', '#212121' );
	$button_border_color_hover = get_theme_mod( 'button_border_color_hover', '#757575' );
	$css .= "div.editor-styles-wrapper .wp-block-button.is-style-outline .wp-block-button__link, div.editor-styles-wrapper .is-style-outline .wp-block-button__link, div.editor-styles-wrapper .wp-block-button__link.is-style-outline, div.editor-styles-wrapper .wp-block-button__link { border-color:" . esc_attr( $button_border_color ) . ";}" . "\n";
	$css .= "div.editor-styles-wrapper .wp-block-button.is-style-outline .wp-block-button__link:hover, div.editor-styles-wrapper .wp-block-button__link:hover { border-color:" . esc_attr( $button_border_color_hover ) . ";}" . "\n";

	//Fonts
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'single_post_title_size', $defaults = array( 'desktop' => 32, 'tablet' => 32, 'mobile' => 32 ), 'div.editor-styles-wrapper .editor-post-title .editor-post-title__input' );

	//Typography
	$css .= Botiga_Custom_CSS::get_typography_css( 'block-editor' );

	//Colors
	$background_color         = get_theme_mod( 'background_color' );
	$content_background_color = get_theme_mod( 'content_background_color', '#fff' );
	$site_layout              = get_theme_mod( 'site_layout', 'default' );
	
	if ( in_array( $site_layout, array( 'boxed', 'padded' ) ) ) {
		$css .= "div.editor-styles-wrapper { background-color:#" . ltrim( esc_attr( $content_background_color ), '#' ) . ";}" . "\n";
	} else {
		$css .= "div.editor-styles-wrapper { background-color:#" . ltrim( esc_attr( $background_color ), '#' ) . ";}" . "\n";
	}

	$css .= Botiga_Custom_CSS::get_color_css( 'single_post_title_color', '', 'div.editor-styles-wrapper .editor-post-title .editor-post-title__input' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_body_text', '', 'div.editor-styles-wrapper, div.editor-styles-wrapper .wp-block-columns p a' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_link_default', '', 'div.editor-styles-wrapper a' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_link_hover', '', 'div.editor-styles-wrapper a:hover, div.editor-styles-wrapper .wp-block-columns p a:hover' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_1', '', 'div.editor-styles-wrapper h1' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_2', '', 'div.editor-styles-wrapper h2' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_3', '', 'div.editor-styles-wrapper h3' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_4', '', 'div.editor-styles-wrapper h4' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_5', '', 'div.editor-styles-wrapper h5' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_6', '', 'div.editor-styles-wrapper h6' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_forms_text', '', 'div.editor-styles-wrapper input[type="text"],div.editor-styles-wrapper input[type="email"],div.editor-styles-wrapper input[type="url"],div.editor-styles-wrapper input[type="password"],div.editor-styles-wrapper input[type="search"],div.editor-styles-wrapper input[type="number"],div.editor-styles-wrapper input[type="tel"],div.editor-styles-wrapper input[type="range"],div.editor-styles-wrapper input[type="date"],div.editor-styles-wrapper input[type="month"],div.editor-styles-wrapper input[type="week"],div.editor-styles-wrapper input[type="time"],div.editor-styles-wrapper input[type="datetime"],div.editor-styles-wrapper input[type="datetime-local"],div.editor-styles-wrapper input[type="color"],div.editor-styles-wrapper textarea,div.editor-styles-wrapper select,' );
	$css .= Botiga_Custom_CSS::get_background_color_css( 'color_forms_background', '#ffffff', 'div.editor-styles-wrapper input[type="text"],div.editor-styles-wrapper input[type="email"],div.editor-styles-wrapper input[type="url"],div.editor-styles-wrapper input[type="password"],div.editor-styles-wrapper input[type="search"],div.editor-styles-wrapper input[type="number"],div.editor-styles-wrapper input[type="tel"],div.editor-styles-wrapper input[type="range"],div.editor-styles-wrapper input[type="date"],div.editor-styles-wrapper input[type="month"],div.editor-styles-wrapper input[type="week"],div.editor-styles-wrapper input[type="time"],div.editor-styles-wrapper input[type="datetime"],div.editor-styles-wrapper input[type="datetime-local"],div.editor-styles-wrapper input[type="color"],div.editor-styles-wrapper textarea,div.editor-styles-wrapper select,' );
	$color_forms_borders    = get_theme_mod( 'color_forms_borders' );
	$css .= "div.editor-styles-wrapper input[type=\"text\"],div.editor-styles-wrapper input[type=\"email\"],div.editor-styles-wrapper input[type=\"url\"],div.editor-styles-wrapper input[type=\"password\"],div.editor-styles-wrapper input[type=\"search\"],div.editor-styles-wrapper input[type=\"number\"],div.editor-styles-wrapper input[type=\"tel\"],div.editor-styles-wrapper input[type=\"range\"],div.editor-styles-wrapper input[type=\"date\"],div.editor-styles-wrapper input[type=\"month\"],div.editor-styles-wrapper input[type=\"week\"],div.editor-styles-wrapper input[type=\"time\"],div.editor-styles-wrapper input[type=\"datetime\"],div.editor-styles-wrapper input[type=\"datetime-local\"],div.editor-styles-wrapper input[type=\"color\"],div.editor-styles-wrapper textarea,div.editor-styles-wrapper select { border-color:" . esc_attr( $color_forms_borders ) . ";}" . "\n";
	$color_forms_placeholder    = get_theme_mod( 'color_forms_placeholder', '#848484' );
	$css .= "div.editor-styles-wrapper ::placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";opacity:1;}" . "\n";
	$css .= "div.editor-styles-wrapper :-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";
	$css .= "div.editor-styles-wrapper ::-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";

	//Shop product options
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'shop_product_title_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'div.editor-styles-wrapper ul.products li.product .botiga-wc-loop-product__title, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title, div.editor-styles-wrapper ul.wc-block-grid__products li.product .wc-block-grid__product-title, div.editor-styles-wrapper ul.wc-block-grid__products li.product .woocommerce-loop-product__title, div.editor-styles-wrapper ul.products li.wc-block-grid__product .wc-block-grid__product-title, div.editor-styles-wrapper ul.products li.wc-block-grid__product .woocommerce-loop-product__title, div.editor-styles-wrapper ul.products li.product .wc-block-grid__product-title, div.editor-styles-wrapper ul.products li.product .woocommerce-loop-product__title, div.editor-styles-wrapper ul.products li.product .woocommerce-loop-category__title, div.editor-styles-wrapper .woocommerce-loop-product__title .botiga-wc-loop-product__title' );

	$shop_product_element_spacing = get_theme_mod( 'shop_product_element_spacing', 12 );
	$css .= "div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .col-md-7>*, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .col-md-8>*, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product>*, div.editor-styles-wrapper ul.wc-block-grid__products li.product .col-md-7>*, div.editor-styles-wrapper ul.wc-block-grid__products li.product .col-md-8>*, div.editor-styles-wrapper ul.wc-block-grid__products li.product>*, div.editor-styles-wrapper ul.products li.wc-block-grid__product .col-md-7>*, div.editor-styles-wrapper ul.products li.wc-block-grid__product .col-md-8>*, div.editor-styles-wrapper ul.products li.wc-block-grid__product>*, div.editor-styles-wrapper ul.products li.product .col-md-7>*, div.editor-styles-wrapper ul.products li.product .col-md-8>*, div.editor-styles-wrapper ul.products li.product>* { margin-bottom:" . esc_attr( $shop_product_element_spacing ) . "px;}" . "\n";
	$css .= "div.editor-styles-wrapper ul.products li.product .product-description-column:not(:empty), div.editor-styles-wrapper ul.products li.wc-block-grid__product .product-description-column:not(:empty), div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .product-description-column:not(:empty) { margin-top:" . esc_attr( $shop_product_element_spacing ) . "px;}" . "\n";

	$shop_product_alignment = get_theme_mod( 'shop_product_alignment', 'center' );
	$css .= "div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product, div.editor-styles-wrapper ul.wc-block-grid__products li.product, div.editor-styles-wrapper ul.products li.wc-block-grid__product, div.editor-styles-wrapper ul.products li.product { text-align:" . esc_attr( $shop_product_alignment ) . "!important;}" . "\n";
	if ( 'left' === $shop_product_alignment ) {
		$css .= "div.editor-styles-wrapper .star-rating, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .button, div.editor-styles-wrapper ul.wc-block-grid__products li.product .wp-block-button__link, div.editor-styles-wrapper ul.wc-block-grid__products li.product .button, div.editor-styles-wrapper ul.products li.wc-block-grid__product .wp-block-button__link, div.editor-styles-wrapper ul.products li.wc-block-grid__product .button, div.editor-styles-wrapper ul.products li.product .wp-block-button__link, div.editor-styles-wrapper ul.products li.product .button { margin-left:0!important;}" . "\n";
	} elseif ( 'right' === $shop_product_alignment ) {
		$css .= "div.editor-styles-wrapper .star-rating, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link, div.editor-styles-wrapper ul.wc-block-grid__products li.wc-block-grid__product .button, div.editor-styles-wrapper ul.wc-block-grid__products li.product .wp-block-button__link, div.editor-styles-wrapper ul.wc-block-grid__products li.product .button, div.editor-styles-wrapper ul.products li.wc-block-grid__product .wp-block-button__link, div.editor-styles-wrapper ul.products li.wc-block-grid__product .button, div.editor-styles-wrapper ul.products li.product .wp-block-button__link, div.editor-styles-wrapper ul.products li.product .button { margin-right:0!important;}" . "\n";       
	}
	
	$alignval = 'center';
	$textalign = 'center';
	if ( 'left' === $shop_product_alignment ) {
		$alignval = 'flex-start';
		$textalign = 'left';
	} elseif ( 'right' === $shop_product_alignment ) {
		$alignval = 'flex-end';
		$textalign = 'right';
	}

	$css .= 'div.editor-styles-wrapper .wc-block-grid__product-add-to-cart.wp-block-button .wp-block-button__link { text-align: '. esc_attr( $textalign ) .' !important; }';

	$shop_product_add_to_cart_button_width = get_theme_mod( 'shop_product_add_to_cart_button_width', 'auto' );
	if( $shop_product_add_to_cart_button_width === 'full-width' ) {
		$css .= 'div.editor-styles-wrapper .button-layout2.button-with-quantity .button, div.editor-styles-wrapper .button-layout2.button-with-quantity .wp-block-button .wp-block-button__link { width: calc( 100% - 100px ); }';
		$css .= 'div.editor-styles-wrapper .button-layout2.button-with-quantity, div.editor-styles-wrapper .button-layout2.button-width-full:not(.button-with-quantity) .button, div.editor-styles-wrapper .button-layout2.button-width-full:not(.button-with-quantity) .wp-block-button, div.editor-styles-wrapper .button-layout2.button-width-full:not(.button-with-quantity) .wp-block-button .wp-block-button__link, div.editor-styles-wrapper .button-layout2.button-with-quantity .wp-block-button { width: 100%; }';
		$css .= 'div.editor-styles-wrapper .button-width-full.button-layout2 .add_to_cart_button { width: 100%; margin-left: 0 !important; margin-right: 0 !important; }';
	} else {
		$css .= 'div.editor-styles-wrapper .wc-block-grid__products .wc-block-grid__product .button-layout2.button-with-quantity { justify-content: '. esc_attr( $alignval ) .'; }';
	}

	//Forms
	$css .= Botiga_Custom_CSS::get_color_css( 'color_forms_text', '', 'div.editor-styles-wrapper input[type="text"], div.editor-styles-wrapper input[type="email"], div.editor-styles-wrapper input[type="url"], div.editor-styles-wrapper input[type="password"], div.editor-styles-wrapper input[type="search"], div.editor-styles-wrapper input[type="number"], div.editor-styles-wrapper input[type="tel"], div.editor-styles-wrapper input[type="range"], div.editor-styles-wrapper input[type="date"], div.editor-styles-wrapper input[type="month"], div.editor-styles-wrapper input[type="week"], div.editor-styles-wrapper input[type="time"], div.editor-styles-wrapper input[type="datetime"], div.editor-styles-wrapper input[type="datetime-local"], div.editor-styles-wrapper input[type="color"], div.editor-styles-wrapper textarea, div.editor-styles-wrapper select, div.editor-styles-wrapper .woocommerce .select2-container .select2-selection--single, div.editor-styles-wrapper .woocommerce-page .select2-container .select2-selection--single, div.editor-styles-wrapper input[type="text"]:focus, div.editor-styles-wrapper input[type="email"]:focus, div.editor-styles-wrapper input[type="url"]:focus, div.editor-styles-wrapper input[type="password"]:focus, div.editor-styles-wrapper input[type="search"]:focus, div.editor-styles-wrapper input[type="number"]:focus, div.editor-styles-wrapper input[type="tel"]:focus, div.editor-styles-wrapper input[type="range"]:focus, div.editor-styles-wrapper input[type="date"]:focus, div.editor-styles-wrapper input[type="month"]:focus, div.editor-styles-wrapper input[type="week"]:focus, div.editor-styles-wrapper input[type="time"]:focus, div.editor-styles-wrapper input[type="datetime"]:focus, div.editor-styles-wrapper input[type="datetime-local"]:focus, div.editor-styles-wrapper input[type="color"]:focus, div.editor-styles-wrapper textarea:focus, div.editor-styles-wrapper select:focus, .woocommerce .select2-container .select2-selection--single:focus, div.editor-styles-wrapper .woocommerce-page .select2-container .select2-selection--single:focus, div.editor-styles-wrapper .select2-container--default .select2-selection--single .select2-selection__rendered, div.editor-styles-wrapper .wp-block-search .wp-block-search__input, div.editor-styles-wrapper .wp-block-search .wp-block-search__input:focus' );
	$css .= Botiga_Custom_CSS::get_background_color_css( 'color_forms_background', '#ffffff', 'div.editor-styles-wrapper input[type="text"], div.editor-styles-wrapper input[type="email"], div.editor-styles-wrapper input[type="url"], div.editor-styles-wrapper input[type="password"], div.editor-styles-wrapper input[type="search"], div.editor-styles-wrapper input[type="number"], div.editor-styles-wrapper input[type="tel"], div.editor-styles-wrapper input[type="range"], div.editor-styles-wrapper input[type="date"], div.editor-styles-wrapper input[type="month"], div.editor-styles-wrapper input[type="week"], div.editor-styles-wrapper input[type="time"], div.editor-styles-wrapper input[type="datetime"], div.editor-styles-wrapper input[type="datetime-local"], div.editor-styles-wrapper input[type="color"], div.editor-styles-wrapper textarea, div.editor-styles-wrapper select, div.editor-styles-wrapper .woocommerce .select2-container .select2-selection--single, div.editor-styles-wrapper .woocommerce-page .select2-container .select2-selection--single, div.editor-styles-wrapper .woocommerce-cart .woocommerce-cart-form .actions .coupon input[type="text"]' );
	$css .= Botiga_Custom_CSS::get_border_color_css( 'color_forms_borders', '', 'div.editor-styles-wrapper input[type="text"], div.editor-styles-wrapper input[type="email"], div.editor-styles-wrapper input[type="url"], div.editor-styles-wrapper input[type="password"], div.editor-styles-wrapper input[type="search"], div.editor-styles-wrapper input[type="number"], div.editor-styles-wrapper input[type="tel"], div.editor-styles-wrapper input[type="range"], div.editor-styles-wrapper input[type="date"], div.editor-styles-wrapper input[type="month"], div.editor-styles-wrapper input[type="week"], div.editor-styles-wrapper input[type="time"], div.editor-styles-wrapper input[type="datetime"], div.editor-styles-wrapper input[type="datetime-local"], div.editor-styles-wrapper input[type="color"], div.editor-styles-wrapper textarea, div.editor-styles-wrapper select, div.editor-styles-wrapper .woocommerce .select2-container .select2-selection--single, div.editor-styles-wrapper .woocommerce-page .select2-container .select2-selection--single, div.editor-styles-wrapper .woocommerce-account fieldset, div.editor-styles-wrapper .woocommerce-account .woocommerce-form-login, div.editor-styles-wrapper .woocommerce-account .woocommerce-form-register, div.editor-styles-wrapper .woocommerce-cart .woocommerce-cart-form .actions .coupon input[type="text"], div.editor-styles-wrapper .wp-block-search .wp-block-search__input, div.editor-styles-wrapper .woocommerce-form__label-for-checkbox span:not(.required):after, div.editor-styles-wrapper .select2-dropdown, div.editor-styles-wrapper .botiga-sc-cart-total tfoot tr' );

	//WPForms
	if( defined( 'WPFORMS_VERSION' ) ) {
		$css .= Botiga_Custom_CSS::get_wpforms_css( 'block-editor' );
	}

	// Additional Information (Variations) Table
	$css .= Botiga_Custom_CSS::get_background_color_rgba_css( 'content_cards_background', '#f5f5f5', 'div.editor-styles-wrapper table.woocommerce-product-attributes tr:nth-child(even)', 0.3 );

	// Additional CSS (from customizer)
	$css .= wp_get_custom_css();

	/**
	 * Hook 'botiga_block_editor_custom_css'.
	 * Filters the custom CSS for the block editor.
	 * 
	 * @since 2.2.6
	 */
	$css = apply_filters( 'botiga_block_editor_custom_css', $css );

	wp_add_inline_style( 'botiga-block-editor-styles', $css );

	wp_enqueue_style( 'botiga-quick-view', get_template_directory_uri() . '/assets/css/quick-view.min.css', array(), BOTIGA_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'botiga_enqueue_gutenberg_assets' );

function botiga_block_editor_custom_js() {
	$inner_js = '';

	// Product equal height.
	if ( get_theme_mod( 'shop_product_equal_height', 0 ) ) {
		$inner_js = "$( '.editor-styles-wrapper' ).addClass('product-equal-height');";
	}
	
	$js = "
		( function( $ ) {
			wp.domReady(function(){
				const unsubscribe = wp.data.subscribe(() => {
					const isEditorReady = wp.data.select('core/editor').getBlocks().length > 0;

					if (isEditorReady) {
						{$inner_js}

						unsubscribe();
					}
				});
			});
		})( jQuery );
	";

	wp_add_inline_script( 'wp-dom-ready', $js );
}
add_action( 'enqueue_block_editor_assets', 'botiga_block_editor_custom_js', 999 );