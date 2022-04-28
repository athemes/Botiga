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

	wp_enqueue_style( 'botiga-google-fonts', botiga_google_fonts_url(), array(), BOTIGA_VERSION );

	
	/**
	 * Make Customizer dynamic styles available in the editor
	 */
	$css = '';

	//Buttons
	$css .= Botiga_Custom_CSS::get_top_bottom_padding_css( 'button_top_bottom_padding', $defaults = array( 'desktop' => 13, 'tablet' => 13, 'mobile' => 13 ), 'button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );
	$css .= Botiga_Custom_CSS::get_left_right_padding_css( 'button_left_right_padding', $defaults = array( 'desktop' => 24, 'tablet' => 24, 'mobile' => 24 ), 'button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );

	$button_border_radius = get_theme_mod( 'button_border_radius' );
	$css .= "div.editor-styles-wrapper .wp-block-button__link { border-radius:" . intval( $button_border_radius ) . "px;}" . "\n";

	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'button_font_size', $defaults = array( 'desktop' => 14, 'tablet' => 14, 'mobile' => 14 ), 'button,a.button,.wp-block-button__link,input[type="button"],input[type="reset"],input[type="submit"]' );
	$button_text_transform = get_theme_mod( 'button_text_transform', 'none' );
	$css .= "div.editor-styles-wrapper .wp-block-button__link { text-transform:" . esc_attr( $button_text_transform ) . ";}" . "\n";

	$css .= Botiga_Custom_CSS::get_background_color_css( 'button_background_color', '#212121', 'div.editor-styles-wrapper .wp-block-button__link' );			
	$css .= Botiga_Custom_CSS::get_background_color_css( 'button_background_color_hover', '#757575', 'div.editor-styles-wrapper .wp-block-button__link:hover' );			

	$css .= Botiga_Custom_CSS::get_color_css( 'button_color', '#ffffff', 'div.editor-styles-wrapper .wp-block-button__link' );			
	$css .= Botiga_Custom_CSS::get_color_css( 'button_color_hover', '#ffffff', 'div.editor-styles-wrapper .wp-block-button__link:hover' );			

	$button_border_color = get_theme_mod( 'button_border_color', '#212121' );
	$button_border_color_hover = get_theme_mod( 'button_border_color_hover', '#757575' );
	$css .= "div.editor-styles-wrapper .is-style-outline .wp-block-button__link,div.editor-styles-wrapper .wp-block-button__link.is-style-outline,div.editor-styles-wrapper .wp-block-button__link { border-color:" . esc_attr( $button_border_color ) . ";}" . "\n";
	$css .= "div.editor-styles-wrapper .wp-block-button__link:hover { border-color:" . esc_attr( $button_border_color_hover ) . ";}" . "\n";

	//Fonts
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'single_post_title_size', $defaults = array( 'desktop' => 32, 'tablet' => 32, 'mobile' => 32 ), 'div.editor-styles-wrapper .editor-post-title .editor-post-title__input' );

	$typography_defaults = json_encode(
		array(
			'font' 			=> 'System default',
			'regularweight' => '400',
			'category' 		=> 'sans-serif'
		)
	);	

	$body_font		= get_theme_mod( 'botiga_body_font', $typography_defaults );
	$headings_font 	= get_theme_mod( 'botiga_headings_font', $typography_defaults );

	$body_font 		= json_decode( $body_font, true );
	$headings_font 	= json_decode( $headings_font, true );
	
	if ( 'System default' !== $body_font['font'] ) {
		$css .= 'div.editor-styles-wrapper body { font-family:' . esc_attr( $body_font['font'] ) . ',' . esc_attr( $body_font['category'] ) . '; font-weight: '. esc_attr( $headings_font['regularweight'] ) .'}' . "\n";	
	}
	
	if ( 'System default' !== $headings_font['font'] ) {
		$css .= 'div.editor-styles-wrapper .editor-post-title .editor-post-title__input, div.editor-styles-wrapper h1,div.editor-styles-wrapper h2,div.editor-styles-wrapper h3,div.editor-styles-wrapper h4,div.editor-styles-wrapper h5,div.editor-styles-wrapper h6 { font-family:' . esc_attr( $headings_font['font'] ) . ',' . esc_attr( $headings_font['category'] ) . ';}' . "\n";
	}

	$headings_font_style 		= get_theme_mod( 'headings_font_style', 'normal' );
	$headings_line_height 		= get_theme_mod( 'headings_line_height', 1.2 );
	$headings_letter_spacing 	= get_theme_mod( 'headings_letter_spacing', 0 );
	$headings_text_transform 	= get_theme_mod( 'headings_text_transform', 'none' );
	$headings_text_decoration 	= get_theme_mod( 'headings_text_decoration', 'none' );

	$css .= "div.editor-styles-wrapper h1,div.editor-styles-wrapper h2,div.editor-styles-wrapper h3,div.editor-styles-wrapper h4,div.editor-styles-wrapper h5,div.editor-styles-wrapper h6 { text-decoration:" . esc_attr( $headings_text_decoration ) . ";text-transform:" . esc_attr( $headings_text_transform ) . ";font-style:" . esc_attr( $headings_font_style ) . ";line-height:" . esc_attr( $headings_line_height ) . ";letter-spacing:" . esc_attr( $headings_letter_spacing ) . "px;}" . "\n";	

	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'h1_font_size', $defaults = array( 'desktop' => 64, 'tablet' => 42, 'mobile' => 32 ), 'div.editor-styles-wrapper h1' );
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'h2_font_size', $defaults = array( 'desktop' => 48, 'tablet' => 32, 'mobile' => 24 ), 'div.editor-styles-wrapper h2' );
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'h3_font_size', $defaults = array( 'desktop' => 32, 'tablet' => 24, 'mobile' => 20 ), 'div.editor-styles-wrapper h3' );
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'h4_font_size', $defaults = array( 'desktop' => 24, 'tablet' => 18, 'mobile' => 16 ), 'div.editor-styles-wrapper h4' );
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'h5_font_size', $defaults = array( 'desktop' => 18, 'tablet' => 16, 'mobile' => 16 ), 'div.editor-styles-wrapper h5' );
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'h6_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'div.editor-styles-wrapper h6' );

	$body_font_style 		= get_theme_mod( 'body_font_style', 'normal' );
	$body_line_height 		= get_theme_mod( 'body_line_height', 1.68 );
	$body_letter_spacing 	= get_theme_mod( 'body_letter_spacing', 0 );
	$body_text_transform 	= get_theme_mod( 'body_text_transform', 'none' );
	$body_text_decoration 	= get_theme_mod( 'body_text_decoration', 'none' );

	$css .= "div.editor-styles-wrapper { text-decoration:" . esc_attr( $body_text_decoration ) . ";text-transform:" . esc_attr( $body_text_transform ) . ";font-style:" . esc_attr( $body_font_style ) . ";line-height:" . esc_attr( $body_line_height ) . ";letter-spacing:" . esc_attr( $body_letter_spacing ) . "px;}" . "\n";	
	$css .= Botiga_Custom_CSS::get_font_sizes_css( 'body_font_size', $defaults = array( 'desktop' => 16, 'tablet' => 16, 'mobile' => 16 ), 'div.editor-styles-wrapper' );	

	//Colors
	$background_color 	= get_theme_mod( 'background_color' );
	$css .= "div.editor-styles-wrapper { background-color:#" . esc_attr( $background_color ) . ";}" . "\n";

	$css .= Botiga_Custom_CSS::get_color_css( 'single_post_title_color', '', 'div.editor-styles-wrapper .editor-post-title .editor-post-title__input' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_body_text', '', 'div.editor-styles-wrapper' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_link_default', '', 'div.editor-styles-wrapper a' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_link_hover', '', 'div.editor-styles-wrapper a:hover' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_1', '', 'div.editor-styles-wrapper h1' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_2', '', 'div.editor-styles-wrapper h2' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_3', '', 'div.editor-styles-wrapper h3' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_4', '', 'div.editor-styles-wrapper h4' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_5', '', 'div.editor-styles-wrapper h5' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_heading_6', '', 'div.editor-styles-wrapper h6' );
	$css .= Botiga_Custom_CSS::get_color_css( 'color_forms_text', '', 'div.editor-styles-wrapper input[type="text"],div.editor-styles-wrapper input[type="email"],div.editor-styles-wrapper input[type="url"],div.editor-styles-wrapper input[type="password"],div.editor-styles-wrapper input[type="search"],div.editor-styles-wrapper input[type="number"],div.editor-styles-wrapper input[type="tel"],div.editor-styles-wrapper input[type="range"],div.editor-styles-wrapper input[type="date"],div.editor-styles-wrapper input[type="month"],div.editor-styles-wrapper input[type="week"],div.editor-styles-wrapper input[type="time"],div.editor-styles-wrapper input[type="datetime"],div.editor-styles-wrapper input[type="datetime-local"],div.editor-styles-wrapper input[type="color"],div.editor-styles-wrapper textarea,div.editor-styles-wrapper select,' );
	$css .= Botiga_Custom_CSS::get_background_color_css( 'color_forms_background', '', 'div.editor-styles-wrapper input[type="text"],div.editor-styles-wrapper input[type="email"],div.editor-styles-wrapper input[type="url"],div.editor-styles-wrapper input[type="password"],div.editor-styles-wrapper input[type="search"],div.editor-styles-wrapper input[type="number"],div.editor-styles-wrapper input[type="tel"],div.editor-styles-wrapper input[type="range"],div.editor-styles-wrapper input[type="date"],div.editor-styles-wrapper input[type="month"],div.editor-styles-wrapper input[type="week"],div.editor-styles-wrapper input[type="time"],div.editor-styles-wrapper input[type="datetime"],div.editor-styles-wrapper input[type="datetime-local"],div.editor-styles-wrapper input[type="color"],div.editor-styles-wrapper textarea,div.editor-styles-wrapper select,' );
	$color_forms_borders 	= get_theme_mod( 'color_forms_borders' );
	$css .= "div.editor-styles-wrapper input[type=\"text\"],div.editor-styles-wrapper input[type=\"email\"],div.editor-styles-wrapper input[type=\"url\"],div.editor-styles-wrapper input[type=\"password\"],div.editor-styles-wrapper input[type=\"search\"],div.editor-styles-wrapper input[type=\"number\"],div.editor-styles-wrapper input[type=\"tel\"],div.editor-styles-wrapper input[type=\"range\"],div.editor-styles-wrapper input[type=\"date\"],div.editor-styles-wrapper input[type=\"month\"],div.editor-styles-wrapper input[type=\"week\"],div.editor-styles-wrapper input[type=\"time\"],div.editor-styles-wrapper input[type=\"datetime\"],div.editor-styles-wrapper input[type=\"datetime-local\"],div.editor-styles-wrapper input[type=\"color\"],div.editor-styles-wrapper textarea,div.editor-styles-wrapper select { border-color:" . esc_attr( $color_forms_borders ) . ";}" . "\n";
	$color_forms_placeholder 	= get_theme_mod( 'color_forms_placeholder', '#848484' );
	$css .= "div.editor-styles-wrapper ::placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";opacity:1;}" . "\n";
	$css .= "div.editor-styles-wrapper :-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";
	$css .= "div.editor-styles-wrapper ::-ms-input-placeholder { color:" . esc_attr( $color_forms_placeholder ) . ";}" . "\n";

	// Additional CSS (from customizer)
	$css .= wp_get_custom_css();

	wp_add_inline_style( 'botiga-block-editor-styles', $css );	
}
add_action( 'enqueue_block_editor_assets', 'botiga_enqueue_gutenberg_assets' );