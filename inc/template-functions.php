<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Botiga
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function botiga_body_classes( $classes ) {

	// Add a class for header layout
	$header_layout = get_theme_mod( 'header_layout_desktop', 'header_layout_1' );
	$classes[] = 'header-' . $header_layout;

	if( in_array( $header_layout, array( 'header_layout_7', 'header_layout_8' ) ) ) {
		$main_header_desktop_offcanvas = get_theme_mod( 'main_header_desktop_offcanvas', 'layout1' );

		$classes[] = 'header-desktop-offcanvas-' . $main_header_desktop_offcanvas;
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for blog single post layout.
	if( is_singular( 'post' ) ) {
		$classes[] = 'blog-single-' . get_theme_mod( 'blog_single_layout', 'layout1' );
	}
	
	// Add a class for site layout.
	$classes[] = 'botiga-site-layout-' . get_theme_mod( 'site_layout', 'default' );

	return $classes;
}
add_filter( 'body_class', 'botiga_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function botiga_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'botiga_pingback_header' );

/**
 * Sidebar
 */
function botiga_sidebar() {

	if ( !apply_filters( 'botiga_sidebar', true ) ) {
		return;
	}

	if( is_singular( 'post' ) && get_theme_mod( 'blog_single_layout' ) === 'layout3' ) {
		return;
	}
	
	get_sidebar();	
}
add_action( 'botiga_do_sidebar', 'botiga_sidebar' );

function botiga_page_post_sidebar() {

	global $post;

	if ( !isset( $post ) ) {
		return;
	}

	$enable_post 	= get_theme_mod( 'sidebar_single_post', 0 );
	$enable_page 	= get_theme_mod( 'sidebar_single_page', 0 );

	$sidebar_layout	= get_post_meta( $post->ID, '_botiga_sidebar_layout', true );

	if ( 'no-sidebar' === $sidebar_layout ) {
		add_filter( 'botiga_sidebar', '__return_false' );
		add_filter( 'botiga_content_class', function() { return 'no-sidebar'; } );
	} elseif ( 'customizer' === $sidebar_layout || empty( $sidebar_layout ) ) {
		if ( ( is_single() && !$enable_post ) || ( is_page() && !$enable_page ) ) {
			add_filter( 'botiga_sidebar', '__return_false' );
			add_filter( 'botiga_content_class', function() { return 'no-sidebar'; } );
		}
	}
}
add_action( 'wp', 'botiga_page_post_sidebar' );

/**
 * Sidebar position
 */
function botiga_sidebar_position() {

	$sidebar_archives_position 	= get_theme_mod( 'sidebar_archives_position', 'sidebar-right' );

	if ( !is_singular() ) {
		$class = $sidebar_archives_position;

		return esc_attr( $class );
	}

	// Blog single
	$blog_single_layout = get_theme_mod( 'blog_single_layout', 'layout1' );

	if( is_singular( 'post' ) && $blog_single_layout === 'layout3' ) {
		return 'no-sidebar';
	}

	global $post;

	if ( !isset( $post ) ) {
		return;
	}

	$sidebar_layout				= get_post_meta( $post->ID, '_botiga_sidebar_layout', true );
	$sidebar_post_position 		= get_theme_mod( 'sidebar_single_post_position', 'sidebar-right' );
	$sidebar_page_position 		= get_theme_mod( 'sidebar_single_page_position', 'sidebar-right' );

	if ( 'customizer' === $sidebar_layout || empty( $sidebar_layout ) ) {
		if ( is_single() ) {
			$class = $sidebar_post_position;
		} elseif ( is_page() ) {
			$class = $sidebar_page_position;
		}
	} else {
		$class = $sidebar_layout;
	}

	return esc_attr( $class );
}
add_filter( 'botiga_content_class', 'botiga_sidebar_position' );

/**
 * Add submenu icons
 */
function botiga_add_submenu_icons( $item_output, $item, $depth, $args ) {
	
	if ( empty( $args->theme_location ) || ( 'primary' !== $args->theme_location && 'mobile' !== $args->theme_location && 'secondary' !== $args->theme_location && 'top-bar-mobile' !== $args->theme_location && 'footer-copyright-menu' !== $args->theme_location ) ) {
		return $item_output;
	}

	if ( ! empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes ) ) {
		return $item_output . '<span tabindex=0 class="dropdown-symbol"><i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-down', false ) . '</i></span>';
	}

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'botiga_add_submenu_icons', 10, 4 );

/**
 * Get SVG code for specific theme icon
 */
function botiga_get_svg_icon( $icon, $echo = false ) {
	$svg_code = wp_kses( //From TwentTwenty. Keeps only allowed tags and attributes
		Botiga_SVG_Icons::get_svg_icon( $icon ),
		array(
			'svg'     => array(
				'class'       => true,
				'xmlns'       => true,
				'width'       => true,
				'height'      => true,
				'viewbox'     => true,
				'aria-hidden' => true,
				'role'        => true,
				'focusable'   => true,
				'fill'      => true,
			),
			'path'    => array(
				'fill'      => true,
				'fill-rule' => true,
				'd'         => true,
				'transform' => true,
				'stroke'	=> true,
				'stroke-width' => true,
				'stroke-linejoin' => true
			),
			'polygon' => array(
				'fill'      => true,
				'fill-rule' => true,
				'points'    => true,
				'transform' => true,
				'focusable' => true,
			),
			'rect'    => array(
				'x'      => true,
				'y'      => true,
				'width'  => true,
				'height' => true,
				'transform' => true
			),				
		)
	);	

	if ( $echo != false ) {
		echo $svg_code; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $svg_code;
	}
}

/**
 * Main content wrapper start
 */
function botiga_main_wrapper_start() {
	global $post;

	if ( isset( $post ) ) {
		$page_builder_mode	= get_post_meta( $post->ID, '_botiga_page_builder_mode', true );

		if ( $page_builder_mode && ! is_singular( 'product' ) ) {
			echo '<div class="content-wrapper">';
		} else {
			echo '<div class="container content-wrapper">';
			echo '<div class="row main-row">';			
		}
	} else {
		echo '<div class="container content-wrapper">';
		echo '<div class="row main-row">';		
	}
}
add_action( 'botiga_main_wrapper_start', 'botiga_main_wrapper_start' );

/**
 * Main content wrapper end
 */
function botiga_main_wrapper_end() {
	global $post;

	if ( isset( $post ) ) {
		$page_builder_mode	= get_post_meta( $post->ID, '_botiga_page_builder_mode', true );

		if ( $page_builder_mode && ! is_singular( 'product' ) ) {
			echo '</div>';
		} else {
			echo '</div>';
			echo '</div>';			
		}
	} else {
		echo '</div>';
		echo '</div>';	
	}
}
add_action( 'botiga_main_wrapper_end', 'botiga_main_wrapper_end' );

/**
 * Page builder mode filters
 */
function botiga_page_builder_mode() {

	global $post;

	if( is_singular( 'product' ) ) {
		return;
	}

	if ( isset( $post ) && is_singular() ) {
		$page_builder_mode	= get_post_meta( $post->ID, '_botiga_page_builder_mode', true );

		if ( $page_builder_mode ) {
			add_filter( 'botiga_entry_header', '__return_false' );
			add_filter( 'botiga_sidebar', '__return_false' );
			add_filter( 'botiga_entry_footer', '__return_false' );
			add_filter( 'body_class', function( $classes ) { $classes[] = 'no-sidebar botiga-page-builder-mode'; return $classes; } );
		}
	}
}
add_action( 'wp', 'botiga_page_builder_mode' );

/**
 * Botiga page options
 * 
 */
function botiga_page_options() {

	global $post;

	if( is_singular( 'product' ) ) {
		return;
	}

	if ( isset( $post ) && is_singular() ) {
		$hide_page_title	= get_post_meta( $post->ID, '_botiga_hide_page_title', true );

		if ( $hide_page_title ) {
			add_filter( 'botiga_entry_header', '__return_false' );
		}
	}
}
add_action( 'wp', 'botiga_page_options' );

/**
 * Get social network
 */
function botiga_get_social_network( $social ) {

	$networks = array( 'facebook', 'twitter', 'instagram', 'github', 'linkedin', 'youtube', 'xing', 'flickr', 'dribbble', 'vk', 'weibo', 'vimeo', 'mix', 'behance', 'spotify', 'soundcloud', 'twitch', 'bandcamp', 'etsy', 'pinterest', 'tiktok' );

	foreach ( $networks as $network ) {
		$found = strpos( $social, $network );

		if ( $found !== false ) {
			return $network;
		}
	}
}

/**
 * Social profile list
 */
function botiga_social_profile( $location ) {
		
	$social_links = get_theme_mod( $location );

	if ( !$social_links ) {
		return;
	}

	$social_links = explode( ',', $social_links );

	$items = '<div class="social-profile">';
	foreach ( $social_links as $social ) {
		$network = botiga_get_social_network( $social );

		if ( $network ) {
			/* translators: 1: social network link. */
			$items .= '<a target="_blank" href="' . esc_url( $social ) . '" title="' . sprintf( esc_attr__( 'Social network %s link.', 'botiga' ), $network ) . '"><i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-' . esc_html( $network ), false ) . '</i></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
	$items .= '</div>';

	echo $items; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Header builder components
 */
function botiga_header_builder_components() {

	$components = array(
		'social' 	=> 'botiga_header_component_social',
		'search' 	=> 'botiga_header_component_search',
		'menu' 		=> 'botiga_header_component_menu',
		'menu-2' 	=> 'botiga_header_component_menu2',
		'cart' 		=> 'botiga_header_component_cart',
		'button-1' 	=> 'botiga_header_component_button1',
		'HTML' 		=> 'botiga_header_component_html',
		'shortcode' => 'botiga_header_component_shortcode',
		'logo' 		=> 'title_tagline',
	);

	return apply_filters( 'botiga_header_builder_components', $components );
}

/**
 * Header builder components
 */
function botiga_mobile_header_builder_components() {

	$components = array(
		'social' 	=> 'botiga_header_component_social',
		'search' 	=> 'botiga_header_component_search',
		'menu' 		=> 'botiga_header_component_menu',
		'menu-2' 	=> 'botiga_header_component_menu2',
		'trigger' 	=> 'botiga_header_component_trigger',
		'cart' 		=> 'botiga_header_component_cart',
		'button-1' 	=> 'botiga_header_component_button1',
		'HTML' 		=> 'botiga_header_component_html',
		'shortcode' => 'botiga_header_component_shortcode',
		'logo' 		=> 'title_tagline',
	);

	return apply_filters( 'botiga_mobile_header_builder_components', $components );
}

/**
 * Global color palettes
 */
function botiga_global_color_palettes() {
	$palettes = array(
		// 						1			2			3			4			5		6			7			8
		'palette1' => array( '#212121', '#757575', '#212121', '#212121', '#212121', '#f5f5f5', '#ffffff', '#ffffff' ),
		'palette2' => array( '#438061', '#214E3A', '#214E3A', '#222222', '#757575', '#ECEEEC', '#FFFFFF', '#ffffff' ),
		'palette3' => array( '#7877E6', '#4B49DE', '#000000', '#222222', '#4F4F4F', '#F4F4F3', '#ffffff', '#ffffff' ),
		'palette4' => array( '#1470AF', '#105787', '#072B43', '#212C34', '#9A9D9F', '#F3F4F4', '#ffffff', '#ffffff' ),
		'palette5' => array( '#FDB336', '#DD8B02', '#FFFFFF', '#948F87', '#1E2933', '#0F141A', '#141B22', '#141B22' ),
		'palette6' => array( '#FF524D', '#E80600', '#40140F', '#5B3F3E', '#ACA2A1', '#F4E3E0', '#FFFFFF', '#FFFFFF' ),
		'palette7' => array( '#E97B6B', '#C84835', '#131B51', '#3E425B', '#A1A3AC', '#F7EAE8', '#FFFFFF', '#FFFFFF' ),
		'palette8' => array( '#0AA99D', '#066B63', '#0B0C0F', '#202833', '#C5C7C8', '#E9F3F2', '#FFFFFF', '#FFFFFF' ),
	);

	return apply_filters( 'botiga_color_palettes', $palettes );
}

/**
 * Custom excerpt length
 */
function botiga_excerpt_length( $length ) {

	if ( is_admin() ) {
		return $length;
	}

	$length = get_theme_mod( 'excerpt_length', 30 );

	return $length;
}
add_filter( 'excerpt_length', 'botiga_excerpt_length', 99 );

/**
 * Blog home page title
 */
function botiga_page_title() {
	if ( is_home() && ! is_front_page() ) :
		?>
		<header class="page-header">
			<h1 class="page-title" <?php botiga_schema( 'headline' ); ?>><?php single_post_title(); ?></h1>
		</header>
		<?php
	endif;
}
add_action( 'botiga_page_header', 'botiga_page_title' );

/**
 * Single post thumbnail
 */
function botiga_single_post_thumbnail() {
	$single_post_show_featured = get_theme_mod( 'single_post_show_featured', 1 );
	if ( $single_post_show_featured ) {
		botiga_post_thumbnail();
	}	
}

/**
 * Default header components
 */
function botiga_get_default_header_components() {
	$components = array(
		'l1'		=> array( 'search', 'woocommerce_icons' ),
		'l3left'	=> array( 'search' ),
		'l3right'	=> array( 'woocommerce_icons' ),
		'l4top'		=> array( 'search' ),
		'l4bottom'	=> array( 'woocommerce_icons' ),
		'l5topleft'	=> array(),
		'l5topright'=> array( 'woocommerce_icons' ),
		'l5bottom'	=> array( 'search' ),
		'l7left'    => array( 'contact_info' ),
		'l7right'   => array( 'search', 'woocommerce_icons', 'hamburger_btn' ),
		'desktop_offcanvas' => array( 'search', 'woocommerce_icons' ),
		'mobile'	=> array( 'mobile_woocommerce_icons' ),
		'offcanvas'	=> array()
	);

	return apply_filters( 'botiga_default_header_components', $components );
}

/**
 * Header layouts
 */
function botiga_header_layouts() {
	$choices = array(			
		'header_layout_1' => array(
			'label' => esc_html__( 'Layout 1', 'botiga' ),
			'url'   => '%s/assets/img/hl1.svg'
		),
		'header_layout_2' => array(
			'label' => esc_html__( 'Layout 2', 'botiga' ),
			'url'   => '%s/assets/img/hl2.svg'
		),		
		'header_layout_3' => array(
			'label' => esc_html__( 'Layout 3', 'botiga' ),
			'url'   => '%s/assets/img/hl3.svg'
		),				
		'header_layout_4' => array(
			'label' => esc_html__( 'Layout 4', 'botiga' ),
			'url'   => '%s/assets/img/hl4.svg'
		),
		'header_layout_5' => array(
			'label' => esc_html__( 'Layout 5', 'botiga' ),
			'url'   => '%s/assets/img/hl5.svg'
		)
	);

	return apply_filters( 'botiga_header_layout_choices', $choices );
}

/**
 * Mobile header layouts
 */
function botiga_mobile_header_layouts() {
	$choices = array(			
		'header_mobile_layout_1' => array(
			'label' => esc_html__( 'Layout 1', 'botiga' ),
			'url'   => '%s/assets/img/mhl1.svg'
		),
		'header_mobile_layout_2' => array(
			'label' => esc_html__( 'Layout 2', 'botiga' ),
			'url'   => '%s/assets/img/mhl2.svg'
		),		
		'header_mobile_layout_3' => array(
			'label' => esc_html__( 'Layout 3', 'botiga' ),
			'url'   => '%s/assets/img/mhl3.svg'
		),
	);

	return apply_filters( 'botiga_mobile_header_layout_choices', $choices );
}

/**
 * Header elements
 */
function botiga_header_elements() {

	$elements = array(
		'search' 			=> esc_html__( 'Search', 'botiga' ),
		'woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button' 			=> esc_html__( 'Button', 'botiga' ),
		'contact_info' 		=> esc_html__( 'Contact info', 'botiga' )
	);

	return apply_filters( 'botiga_header_elements', $elements );
}

function botiga_header_elements_layout_7_8() {

	$elements = array(
		'search' 			=> esc_html__( 'Search', 'botiga' ),
		'woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button' 			=> esc_html__( 'Button', 'botiga' ),
		'contact_info' 		=> esc_html__( 'Contact info', 'botiga' ),
		'hamburger_btn'     => esc_html__( 'Hamburger button', 'botiga' )
	);

	return apply_filters( 'botiga_header_elements_layout_7_8', $elements );
}

/**
 * Mobile Header elements
 */
function botiga_mobile_header_elements() {

	$elements = array(
		'search' 				   => esc_html__( 'Search', 'botiga' ),
		'mobile_woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button' 				   => esc_html__( 'Button', 'botiga' ),
		'contact_info' 			   => esc_html__( 'Contact info', 'botiga' )
	);

	return apply_filters( 'botiga_mobile_header_elements', $elements );
}

/**
 * Mobile Offcanvas Header elements
 */
function botiga_mobile_offcanvas_header_elements() {

	$elements = array(
		'search' 							 => esc_html__( 'Search', 'botiga' ),
		'mobile_offcanvas_woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button' 							 => esc_html__( 'Button', 'botiga' ),
		'contact_info' 						 => esc_html__( 'Contact info', 'botiga' )
	);

	return apply_filters( 'botiga_mobile_offcanvas_header_elements', $elements );
}

/**
 * Default top bar components
 */
function botiga_get_default_topbar_components() {
	$components = array(
		'left'		=> array( 'contact_info' ),
		'right'		=> array( 'text' ),
	);

	return apply_filters( 'botiga_default_topbar_components', $components );
}

/**
 * Top bar elements
 */
function botiga_topbar_elements() {

	$elements = array(
		'social' 			=> esc_html__( 'Social', 'botiga' ),
		'text' 				=> esc_html__( 'Text', 'botiga' ),
		'secondary_nav' 	=> esc_html__( 'Secondary menu', 'botiga' ),
		'contact_info' 		=> esc_html__( 'Contact info', 'botiga' ),
	);

	return apply_filters( 'botiga_topbar_elements', $elements );
}

/**
 * Header transparent customizer choices
 */
function botiga_header_transparent_choices() {

	$choices = array(
		'front-page' 		=> __( 'Front Page', 'botiga' ),
		'pages' 		    => __( 'Pages', 'botiga' ),
		'blog-archive'  	=> __( 'Blog Archive', 'botiga' ),
		'blog-posts' 		=> __( 'Blog Posts', 'botiga' ),
		'post-search' 		=> __( 'Posts Search Results', 'botiga' ),
		'404' 				=> __( '404 Page', 'botiga' )
	);

	// Shop
	if( class_exists( 'Woocommerce' ) ) {
		$choices['shop-catalog'] = __( 'Shop Catalog', 'botiga' );
		$choices['shop-products'] = __( 'Shop Products', 'botiga' );
		$choices['shop-cart'] = __( 'Shop Cart', 'botiga' );
		$choices['shop-checkout'] = __( 'Shop Checkout', 'botiga' );
		$choices['shop-my-account'] = __( 'Shop My Account', 'botiga' );

		// Wishlist
		$wishlist_enable = Botiga_Modules::is_module_active( 'wishlist' );
		$wishlist_layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );

		if( $wishlist_enable && 'layout1' !== $wishlist_layout ) {
			$choices['shop-wishlist'] = __( 'Shop Wishlist', 'botiga' );
		}

	}

	return apply_filters( 'botiga_header_transparent_choices', $choices );
}

/**
 * Masonry data for HTML intialization
 */
function botiga_masonry_data() {

	$layout = get_theme_mod( 'blog_layout', 'layout3' );

	if ( 'layout5' !== $layout ) {
		return; //Output data only for the masonry layout (layout5)
	}

	$data = 'data-masonry=\'{ "itemSelector": "article", "horizontalOrder": true }\'';

	echo apply_filters( 'botiga_masonry_data', wp_kses_post( $data ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Google Fonts URL
 */
function botiga_google_fonts_url() {
	$fonts_url 	= '';
	$subsets 	= 'latin';

	$defaults = json_encode(
		array(
			'font' 			=> 'System default',
			'regularweight' => '400',
			'category' 		=> 'sans-serif'
		)
	);	

	//Get and decode options
	$body_font                       = get_theme_mod( 'botiga_body_font', $defaults );
	$headings_font                   = get_theme_mod( 'botiga_headings_font', $defaults );
	$header_menu_font                = get_theme_mod( 'botiga_header_menu_font', $body_font );
	$button_font                     = get_theme_mod( 'button_font', $defaults );
	$button_font_style               = get_theme_mod( 'button_font_style', 'custom' );
	$loop_post_title_font            = get_theme_mod( 'loop_post_title_font', $defaults );
	$loop_post_title_font_style      = get_theme_mod( 'loop_post_title_font_style', 'heading' );
	$single_post_title_font          = get_theme_mod( 'single_post_title_font', $defaults );
	$single_post_title_font_style    = get_theme_mod( 'single_post_title_font_style', 'heading' );
	$single_product_title_font       = get_theme_mod( 'single_product_title_font', $defaults );
	$single_product_title_font_style = get_theme_mod( 'single_product_title_font_style', 'heading' );
	$shop_product_title_font         = get_theme_mod( 'shop_product_title_font', $defaults );
	$shop_product_title_font_style   = get_theme_mod( 'shop_product_title_font_style', 'heading' );

	$body_font        = json_decode( $body_font, true );
	$headings_font    = json_decode( $headings_font, true );
	$header_menu_font = json_decode( $header_menu_font, true );

	if ( $button_font_style === 'body' ) {
		$button_font = $body_font;
	} else if ( $button_font_style === 'heading' ) {
		$button_font = $headings_font;
	} else {
		$button_font = json_decode( $button_font, true );
	}

	if ( $loop_post_title_font_style === 'body' ) {
		$loop_post_title_font = $body_font;
	} else if ( $loop_post_title_font_style === 'heading' ) {
		$loop_post_title_font = $headings_font;
	} else {
		$loop_post_title_font = json_decode( $loop_post_title_font, true );
	}

	if ( $single_post_title_font_style === 'body' ) {
		$single_post_title_font = $body_font;
	} else if ( $single_post_title_font_style === 'heading' ) {
		$single_post_title_font = $headings_font;
	} else {
		$single_post_title_font = json_decode( $single_post_title_font, true );
	}

	if ( $single_product_title_font_style === 'body' ) {
		$single_product_title_font = $body_font;
	} else if ( $single_product_title_font_style === 'heading' ) {
		$single_product_title_font = $headings_font;
	} else {
		$single_product_title_font = json_decode( $single_product_title_font, true );
	}

	if ( $shop_product_title_font_style === 'body' ) {
		$shop_product_title_font = $body_font;
	} else if ( $shop_product_title_font_style === 'heading' ) {
		$shop_product_title_font = $headings_font;
	} else {
		$shop_product_title_font = json_decode( $shop_product_title_font, true );
	}

	if ( 'System default' === $body_font['font'] && 'System default' === $headings_font['font'] && 'System default' === $header_menu_font['font'] && 'System default' === $button_font['font'] && 'System default' === $loop_post_title_font['font'] && 'System default' === $single_post_title_font['font'] && 'System default' === $single_product_title_font['font']  && 'System default' === $shop_product_title_font['font'] ) {
		return; //return early if defaults are active
	}

	/**
	 * Convert old values of font-weight.
	 * This avoid issues with old Botiga users that imported demos with 
	 * old customizer settings (google fonts v1 pattern).
	 * 
	 * @since 1.1.7
	 */
	$body_font['regularweight']     = str_replace( 
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$body_font['regularweight'] 
	);
	$headings_font['regularweight'] = str_replace(
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$headings_font['regularweight'] 
	);
	$header_menu_font['regularweight'] = str_replace(
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$header_menu_font['regularweight'] 
	);
	$button_font['regularweight'] = str_replace(
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$button_font['regularweight'] 
	);
	$loop_post_title_font['regularweight'] = str_replace(
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$loop_post_title_font['regularweight'] 
	);
	$single_post_title_font['regularweight'] = str_replace(
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$single_post_title_font['regularweight'] 
	);
	$single_product_title_font['regularweight'] = str_replace(
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$single_product_title_font['regularweight'] 
	);
	$shop_product_title_font['regularweight'] = str_replace(
		array( 'regular', 'italic' ),
		array( '400', '' ),
		$shop_product_title_font['regularweight'] 
	);

	$font_families = array(
		$body_font['font'] . ':wght@' . $body_font['regularweight'],
		$headings_font['font'] . ':wght@' . $headings_font['regularweight'],
		$header_menu_font['font'] . ':wght@' . $header_menu_font['regularweight'],
		$button_font['font'] . ':wght@' . $button_font['regularweight'],
		$loop_post_title_font['font'] . ':wght@' . $loop_post_title_font['regularweight'],
		$single_post_title_font['font'] . ':wght@' . $single_post_title_font['regularweight'],
		$single_product_title_font['font'] . ':wght@' . $single_product_title_font['regularweight'],
		$shop_product_title_font['font'] . ':wght@' . $shop_product_title_font['regularweight'],
	);

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	// Load google fonts locally
	$load_locally = Botiga_Modules::is_module_active( 'local-google-fonts' );
	if( $load_locally ) {
		require_once get_theme_file_path( 'vendor/wptt-webfont-loader/wptt-webfont-loader.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

		return wptt_get_webfont_url( $fonts_url );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Custom Google Fonts URL
 */
function botiga_custom_google_fonts_url() {

	$fonts_url     = '';
	$subsets       = 'latin';
	$font_families = array();
	$google_fonts  = array_column( botiga_get_google_fonts(), 'family' );

	$body_custom_font                        = get_theme_mod( 'botiga_body_custom_font', '' );
	$body_custom_font_weight                 = get_theme_mod( 'botiga_body_custom_font_weight', '' );
	$headings_custom_font                    = get_theme_mod( 'botiga_headings_custom_font', '' );
	$headings_custom_font_weight             = get_theme_mod( 'botiga_headings_custom_font_weight', '' );
	$header_menu_custom_font                 = get_theme_mod( 'botiga_header_menu_custom_font', '' );
	$header_menu_custom_font_weight          = get_theme_mod( 'botiga_header_menu_custom_font_weight', '' );
	$button_custom_font                      = get_theme_mod( 'button_custom_font', '' );
	$button_custom_font_weight               = get_theme_mod( 'button_custom_font_weight', '' );
	$button_font_style                       = get_theme_mod( 'button_font_style', 'custom' );
	$loop_post_title_custom_font             = get_theme_mod( 'loop_post_title_custom_font', '' );
	$loop_post_title_custom_font_weight      = get_theme_mod( 'loop_post_title_custom_font_weight', '' );
	$loop_post_title_font_style              = get_theme_mod( 'loop_post_title_font_style', 'heading' );
	$single_post_title_custom_font           = get_theme_mod( 'single_post_title_custom_font', '' );
	$single_post_title_custom_font_weight    = get_theme_mod( 'single_post_title_custom_font_weight', '' );
	$single_post_title_font_style            = get_theme_mod( 'single_post_title_font_style', 'heading' );
	$single_product_title_custom_font        = get_theme_mod( 'single_product_title_custom_font', '' );
	$single_product_title_custom_font_weight = get_theme_mod( 'single_product_title_custom_font_weight', '' );
	$single_product_title_font_style         = get_theme_mod( 'single_product_title_font_style', 'heading' );
	$shop_product_title_custom_font          = get_theme_mod( 'shop_product_title_custom_font', '' );
	$shop_product_title_custom_font_weight   = get_theme_mod( 'shop_product_title_custom_font_weight', '' );
	$shop_product_title_font_style           = get_theme_mod( 'shop_product_title_font_style', 'heading' );

	if ( $button_font_style === 'body' ) {
		$button_custom_font = $body_custom_font;
	} else if ( $button_font_style === 'heading' ) {
		$button_custom_font = $headings_custom_font;
	}

	if ( $loop_post_title_font_style === 'body' ) {
		$loop_post_title_custom_font = $body_custom_font;
	} else if ( $loop_post_title_font_style === 'heading' ) {
		$loop_post_title_custom_font = $headings_custom_font;
	}

	if ( $single_post_title_font_style === 'body' ) {
		$single_post_title_custom_font = $body_custom_font;
	} else if ( $single_post_title_font_style === 'heading' ) {
		$single_post_title_custom_font = $headings_custom_font;
	}

	if ( $single_product_title_font_style === 'body' ) {
		$single_product_title_custom_font = $body_custom_font;
	} else if ( $single_product_title_font_style === 'heading' ) {
		$single_product_title_custom_font = $headings_custom_font;
	}

	if ( $shop_product_title_font_style === 'body' ) {
		$shop_product_title_custom_font = $body_custom_font;
	} else if ( $shop_product_title_font_style === 'heading' ) {
		$shop_product_title_custom_font = $headings_custom_font;
	}

	if ( in_array( $body_custom_font, $google_fonts ) ) {
		$body_custom_font .= ( $body_custom_font_weight ) ? ':wght@'. $body_custom_font_weight : '';
		$font_families[ $body_custom_font ] = $body_custom_font;
	}

	if ( in_array( $headings_custom_font, $google_fonts ) ) {
		$headings_custom_font .= ( $headings_custom_font_weight ) ? ':wght@'. $headings_custom_font_weight : '';
		$font_families[ $headings_custom_font ] = $headings_custom_font;
	}

	if ( in_array( $header_menu_custom_font, $google_fonts ) ) {
		$header_menu_custom_font .= ( $header_menu_custom_font_weight ) ? ':wght@'. $header_menu_custom_font_weight : '';
		$font_families[ $header_menu_custom_font ] = $header_menu_custom_font;
	}

	if ( in_array( $button_custom_font, $google_fonts ) ) {
		$button_custom_font .= ( $button_custom_font_weight ) ? ':wght@'. $button_custom_font_weight : '';
		$font_families[ $button_custom_font ] = $button_custom_font;
	}

	if ( in_array( $loop_post_title_custom_font, $google_fonts ) ) {
		$loop_post_title_custom_font .= ( $loop_post_title_custom_font_weight ) ? ':wght@'. $loop_post_title_custom_font_weight : '';
		$font_families[ $loop_post_title_custom_font ] = $loop_post_title_custom_font;
	}

	if ( in_array( $single_post_title_custom_font, $google_fonts ) ) {
		$single_post_title_custom_font .= ( $single_post_title_custom_font_weight ) ? ':wght@'. $single_post_title_custom_font_weight : '';
		$font_families[ $single_post_title_custom_font ] = $single_post_title_custom_font;
	}

	if ( in_array( $single_product_title_custom_font, $google_fonts ) ) {
		$single_product_title_custom_font .= ( $single_product_title_custom_font_weight ) ? ':wght@'. $single_product_title_custom_font_weight : '';
		$font_families[ $single_product_title_custom_font ] = $single_product_title_custom_font;
	}

	if ( in_array( $shop_product_title_custom_font, $google_fonts ) ) {
		$shop_product_title_custom_font .= ( $shop_product_title_custom_font_weight ) ? ':wght@'. $shop_product_title_custom_font_weight : '';
		$font_families[ $shop_product_title_custom_font ] = $shop_product_title_custom_font;
	}

	if ( empty( $font_families ) ) {
		return;
	}

	// Google API
	$fonts_url  = add_query_arg( array(
		'family'  => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	// Load google fonts locally
	$load_locally = Botiga_Modules::is_module_active( 'local-google-fonts' );

	if ( $load_locally ) {
		require_once get_theme_file_path( 'vendor/wptt-webfont-loader/wptt-webfont-loader.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		return wptt_get_webfont_url( $fonts_url );
	}


	return esc_url_raw( $fonts_url );

}

/**
 * Get google fonts
 */
function botiga_get_google_fonts() {

	$fontFile = get_template_directory_uri() . '/inc/customizer/controls/typography/google-fonts-alphabetical.json';
	$request  = wp_remote_get( $fontFile );
	$status   = wp_remote_retrieve_response_code( $request );

	if( is_wp_error( $request ) || $status !== 200 ) {
		return "error";
	}

	$body    = wp_remote_retrieve_body( $request );
	$content = json_decode( $body, true );
	$fonts   = array();

	if ( ! empty( $content ) && ! empty( $content['items'] ) ) {
		$fonts = $content['items'];
		unset( $fonts[0] ); // Remove system font option
	}

	return $fonts;

}

/**
 * Check if google fonts is being either locally load or not and insert
 * the needed stylesheet version. That's needed because the new google API (css2)
 * isn't compatible with wp_enqueue_style().
 * 
 * Reference: https://core.trac.wordpress.org/ticket/49742#comment:7
 */
function botiga_google_fonts_version() {
	$load_locally = Botiga_Modules::is_module_active( 'local-google-fonts' );
	if( $load_locally ) {
		return BOTIGA_VERSION;
	}

	return NULL;
}

/**
 * Google fonts preconnect
 */
function botiga_preconnect_google_fonts() {

	$fonts_library = get_theme_mod( 'fonts_library', 'google' );
	$load_locally  = Botiga_Modules::is_module_active( 'local-google-fonts' );
	if( $fonts_library !== 'google' || $load_locally ) {
		return;
	}

	//Disable preconnect if popular plugins for local fonts are active
	if ( function_exists( 'omgf_init') || class_exists( 'EverPress\LGF' ) ) {
		return;
	}

	$defaults = json_encode(
		array(
			'font' 			=> 'System default',
			'regularweight' => '400',
			'category' 		=> 'sans-serif'
		)
	);	

	$body_font                       = get_theme_mod( 'botiga_body_font', $defaults );
	$headings_font                   = get_theme_mod( 'botiga_headings_font', $defaults );
	$header_menu_font                = get_theme_mod( 'botiga_headings_font', $body_font );
	$button_font                     = get_theme_mod( 'button_font', $defaults );
	$button_font_style               = get_theme_mod( 'button_font_style', 'custom' );
	$loop_post_title_font            = get_theme_mod( 'loop_post_title_font', $defaults );
	$loop_post_title_font_style      = get_theme_mod( 'loop_post_title_font_style', 'heading' );
	$single_post_title_font          = get_theme_mod( 'single_post_title_font', $defaults );
	$single_post_title_font_style    = get_theme_mod( 'single_post_title_font_style', 'heading' );
	$single_product_title_font       = get_theme_mod( 'single_product_title_font', $defaults );
	$single_product_title_font_style = get_theme_mod( 'single_product_title_font_style', 'heading' );
	$shop_product_title_font         = get_theme_mod( 'shop_product_title_font', $defaults );
	$shop_product_title_font_style   = get_theme_mod( 'shop_product_title_font_style', 'heading' );

	$body_font        = json_decode( $body_font, true );
	$headings_font    = json_decode( $headings_font, true );
	$header_menu_font = json_decode( $header_menu_font, true );

	if ( $button_font_style === 'body' ) {
		$button_font = $body_font;
	} else if ( $button_font_style === 'heading' ) {
		$button_font = $headings_font;
	} else {
		$button_font = json_decode( $button_font, true );
	}

	if ( $loop_post_title_font_style === 'body' ) {
		$loop_post_title_font = $body_font;
	} else if ( $loop_post_title_font_style === 'heading' ) {
		$loop_post_title_font = $headings_font;
	} else {
		$loop_post_title_font = json_decode( $loop_post_title_font, true );
	}

	if ( $single_post_title_font_style === 'body' ) {
		$single_post_title_font = $body_font;
	} else if ( $single_post_title_font_style === 'heading' ) {
		$single_post_title_font = $headings_font;
	} else {
		$single_post_title_font = json_decode( $single_post_title_font, true );
	}

	if ( $single_product_title_font_style === 'body' ) {
		$single_product_title_font = $body_font;
	} else if ( $single_product_title_font_style === 'heading' ) {
		$single_product_title_font = $headings_font;
	} else {
		$single_product_title_font = json_decode( $single_product_title_font, true );
	}

	if ( $shop_product_title_font_style === 'body' ) {
		$shop_product_title_font = $body_font;
	} else if ( $shop_product_title_font_style === 'heading' ) {
		$shop_product_title_font = $headings_font;
	} else {
		$shop_product_title_font = json_decode( $shop_product_title_font, true );
	}

	if ( 'System default' === $body_font['font'] && 'System default' === $headings_font['font'] && 'System default' === $header_menu_font['font'] && 'System default' === $button_font['font'] && 'System default' === $loop_post_title_font['font'] && 'System default' === $single_post_title_font['font'] && 'System default' === $single_product_title_font['font'] && 'System default' === $shop_product_title_font['font'] ) {
		return;
	}

	echo '<link rel="preconnect" href="//fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action( 'wp_head', 'botiga_preconnect_google_fonts' );

/**
 * Get columns class
 */
function botiga_get_column_class( $number_of_columns ) {
	switch ( $number_of_columns ) {
		case 1:
			$class = 'col-12';
			break;

		case 2:
			$class = 'col-md-6';
			break;

		case 3:
			$class = 'col-md-4';
			break;

		case 4:
			$class = 'col-md-6 col-lg-3';
			break;

		case 5:
			$class = 'col-md-6 col-lg-1-5';
			break;

		case 6:
			$class = 'col-md-6 col-lg-2';
			break;
		
		default:
			$class = 'col-md-4';
			break;
	}

	return $class;
}

/**
 * Get social share url
 */
function botiga_get_social_share_url( $social ) {
	global $post;

	if( !$post ) {
		return '';
	}

	$text = get_the_excerpt( $post->ID );
	$url  = get_the_permalink( $post->ID );

	switch ( $social ) {
		case 'twitter':
			$url = 'https://twitter.com/intent/tweet?text='. $text .'&url='. $url;
			break;
		
		case 'facebook':
			$url = 'https://www.facebook.com/sharer/sharer.php?t='. $text .'&u='. $url;
			break;

		case 'linkedin':
			$url = 'https://www.linkedin.com/shareArticle/?title='. $text .'&url='. $url;
			break;
	}

	return esc_url( $url );
}

/**
 * Carousel options to localize
 */
function botiga_localize_carousel_options() {
	$woo_columns_gap = get_theme_mod( 'shop_archive_columns_gap_desktop', 30 );
	return array(
		'margin_desktop' => $woo_columns_gap,
		'autoplayTimeout' => 5000
	);
}

/**
 * Botiga get image
 */
function botiga_get_image( $image_id = '', $size = 'thumbnail', $echo = false ) {
	if( ! $image_id ) {
		return '';
	}

	$output = '';
	
	// check file type
	$image_src = wp_get_attachment_image_src( $image_id );

	if( strpos( $image_src[0], '.svg' ) !== FALSE ) {
		$output .= '<div class="botiga-image is-svg" style="mask: url('. esc_attr( $image_src[0] ) .') no-repeat center / contain; -webkit-mask: url('. esc_attr( $image_src[0] ) .') no-repeat center / contain">';
			$output .= wp_get_attachment_image( $image_id, $size, false, array( 'style' => 'opacity: 0;' ) );
		$output .= '</div>';
	} else {
		$output .= wp_get_attachment_image( $image_id, $size );
	}

	if ( $echo != false ) {
		echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Get Header Search Icon
 */
function botiga_get_header_search_icon( $echo = false ) {
	$icon = get_theme_mod( 'search_icon', 'icon-search' );

	$output = '';
	if( $icon !== 'icon-custom' ) {
		$output .= '<i class="ws-svg-icon icon-search active">' . botiga_get_svg_icon( $icon ) . '</i>';
	} else {
		$image_id = get_theme_mod( 'search_icon_custom_image', 0 );
		$output .= '<i class="ws-svg-icon icon-search active">' . botiga_get_image( $image_id, apply_filters( 'botiga_header_icons_image_size', 'botiga-header-icons' ) ) . '</i>';
	}

	$output .= '<i class="ws-svg-icon icon-cancel">' . botiga_get_svg_icon( 'icon-cancel' ) . '</i>';

	if ( $echo != false ) {
		echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Get Header Icon
 */
function botiga_get_header_icon( $identifier = '', $echo = false ) {
	if( ! $identifier ) {
		return '';
	}

	switch ( $identifier ) {
		case 'cart':
			$icon     	  = get_theme_mod( 'cart_icon', 'icon-cart' );
			$image_id 	  = get_theme_mod( 'cart_icon_custom_image', 0 );
			break;

		case 'account':
			$icon 	  	  = get_theme_mod( 'account_icon', 'icon-user' );
			$image_id 	  = get_theme_mod( 'account_icon_custom_image', 0 );
			break;

		case 'wishlist':
			$icon 	  	  = get_theme_mod( 'wishlist_icon', 'icon-wishlist' );
			$image_id 	  = get_theme_mod( 'wishlist_icon_custom_image', 0 );
			break;
		
	}

	$output = '';
	if( $icon !== 'icon-custom' ) {
		$output .= botiga_get_svg_icon( $icon );
	} else {
		$output .= botiga_get_image( $image_id, apply_filters( 'botiga_header_icons_image_size', 'botiga-header-icons' ) );
	}

	if ( $echo != false ) {
		echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Get Header Search Form Icon
 */
function botiga_get_header_search_form_icon( $echo = false ) {
	$icon = get_theme_mod( 'bhfb_search_form_button_icon', 'icon-search' );

	$output = '';
	if( $icon !== 'icon-custom' ) {
		$output .= botiga_get_svg_icon( $icon );
	} else {
		$image_id = get_theme_mod( 'bhfb_search_form_button_icon_custom_image', 0 );
		$output .= botiga_get_image( $image_id, apply_filters( 'botiga_header_search_form_icon_image_size', 'botiga-header-icons' ) );
	}

	if ( $echo != false ) {
		echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Get Registered Sidebars
 */
function botiga_get_registered_sidebars() {
	global $wp_registered_sidebars;

	$sidebars = array(
		'' => esc_html__( 'Default', 'botiga' ),
	);

	if ( ! empty( $wp_registered_sidebars ) ) {
		foreach ( $wp_registered_sidebars as $sidebar ) {
			$sidebars[ $sidebar['id'] ] = $sidebar['name'];
		}
	}

	return $sidebars;
}

/**
 * Display Conditions
 */
function botiga_get_display_conditions( $maybe_rules, $default = true, $mod_default = '[]' ) {

	$rules  = array();
	$result = $default;

	if ( is_array( $maybe_rules ) && ! empty( $maybe_rules ) ) {
		$rules = $maybe_rules;
	} else {
		$option = get_theme_mod( $maybe_rules, $mod_default );
		$rules  = json_decode( $option, true );
	}

	if ( ! empty( $rules ) ) {

		foreach ( $rules as $rule ) {

			$object_id = ( ! empty( $rule['id'] ) ) ? intval( $rule['id'] ) : 0;
			$condition = ( ! empty( $rule['condition'] ) ) ? $rule['condition'] : '';
			$boolean   = ( ! empty( $rule['type'] ) && $rule['type'] === 'include' ) ? true : false;

			// Entrie Site
			if ( $condition === 'all' ) {
				$result = $boolean;
			}

			// Basic
			if ( $condition === 'singular' && is_singular() ) {
				$result = $boolean;
			}

			if ( $condition === 'archive' && is_archive() ) {
				$result = $boolean;
			}

			// Posts
			if ( $condition === 'single-post' && is_singular( 'post' ) ) {
				$result = $boolean;
			}

			if ( $condition === 'post-archives' && is_archive() ) {
				$result = $boolean;
			}

			if ( $condition === 'post-categories' && is_category() ) {
				$result = $boolean;
			}

			if ( $condition === 'post-tags' && is_tag() ) {
				$result = $boolean;
			}

			if ( $condition === 'cpt-post-id' && get_queried_object_id() === $object_id ) {
				$result = $boolean;
			}

			if ( $condition === 'cpt-term-id' && get_queried_object_id() === $object_id ) {
				$result = $boolean;
			}

			if ( $condition === 'cpt-taxonomy-id' && is_tax( $object_id ) ) {
				$result = $boolean;
			}

			// Pages
			if ( $condition === 'single-page' && is_page() ) {
				$result = $boolean;
			}

			// WooCommerce
			if ( class_exists( 'WooCommerce' ) ) {
	
				if ( $condition === 'single-product' && is_singular( 'product' ) ) {
					$result = $boolean;
				}
	
				if ( $condition === 'product-archives' && ( is_shop() || is_product_tag() || is_product_category() ) ) {
					$result = $boolean;
				}
	
				if ( $condition === 'product-categories' && is_product_category() ) {
					$result = $boolean;
				}
	
				if ( $condition === 'product-tags' && is_product_tag() ) {
					$result = $boolean;
				}

				if ( $condition === 'product-id' && get_queried_object_id() === $object_id ) {
					$result = $boolean;
				}

				if ( $condition === 'product-category-id' && is_product_category() && get_queried_object_id() === $object_id ) {
					$result = $boolean;
				}

			}

			// Specific
			if ( $condition === 'post-id' && get_queried_object_id() === $object_id ) {
				$result = $boolean;
			}

			if ( $condition === 'page-id' && get_queried_object_id() === $object_id ) {
				$result = $boolean;
			}

			if ( $condition === 'category-id' && is_category() && get_queried_object_id() === $object_id ) {
				$result = $boolean;
			}

			if ( $condition === 'tag-id' && is_tag() && get_queried_object_id() === $object_id ) {
				$result = $boolean;
			}

			if ( $condition === 'author-id' && get_the_author_meta( 'ID' ) === $object_id ) {
				$result = $boolean;
			}

			// User Auth
			if ( $condition === 'logged-in' && is_user_logged_in() ) {
				$result = $boolean;
			}

			if ( $condition === 'logged-out' && ! is_user_logged_in() ) {
				$result = $boolean;
			}

			// User Roles
			if ( substr( $condition, 0, 10 ) === 'user_role_' && is_user_logged_in() ) {

				$user_role  = str_replace( 'user_role_', '', $condition );
				$user_id    = get_current_user_id();
				$user_roles = get_userdata( $user_id )->roles;

				if ( in_array( $user_role, $user_roles ) ) {
					$result = $boolean;
				}

			}

			// Others
			if ( $condition === 'front-page' && is_front_page() ) {
				$result = $boolean;
			}

			if ( $condition === 'blog' && is_home() ) {
				$result = $boolean;
			}

			if ( $condition === '404' && is_404() ) {
				$result = $boolean;
			}

			if ( $condition === 'search' && is_search() ) {
				$result = $boolean;
			}

			if ( $condition === 'author' && is_author() ) {
				$result = $boolean;
			}

			if ( $condition === 'privacy-policy-page' && is_page() ) {

				$post_id    = get_the_ID();
				$privacy_id = get_option( 'wp_page_for_privacy_policy' );

				if ( intval( $post_id ) === intval( $privacy_id ) ) {
					$result = $boolean;
				}

			}

		}

	}

	$result = apply_filters( 'botiga_display_conditions_result', $result, $rules );

	return $result;

}

/**
 * Embed Custom Fonts
 * 
 * return @font-face
 */
function botiga_get_custom_fonts() {

	$css = '';

	$custom_fonts = json_decode( get_theme_mod( 'custom_fonts', '[]' ), true );

	if ( ! empty( $custom_fonts ) ) {

		foreach ( $custom_fonts as $font ) {

			if ( ! empty( $font['name'] ) ) {

				$src = array();

				if ( ! empty( $font['eot'] ) ) {
					$src[] = 'url("'. esc_url( $font['eot'] ) .'?#iefix") format("embedded-opentype")';
				}

				if ( ! empty( $font['otf'] ) ) {
					$src[] = 'url("'. esc_url( $font['otf'] ) .'") format("opentype")';
				}

				if ( ! empty( $font['ttf'] ) ) {
					$src[] = 'url("'. esc_url( $font['ttf'] ) .'") format("truetype")';
				}

				if ( ! empty( $font['svg'] ) ) {
					$src[] = 'url("'. esc_url( $font['svg'] ) .'") format("svg")';
				}

				if ( ! empty( $font['woff'] ) ) {
					$src[] = 'url("'. esc_url( $font['woff'] ) .'") format("woff")';
				}

				if ( ! empty( $font['woff2'] ) ) {
					$src[] = 'url("'. esc_url( $font['woff2'] ) .'") format("woff2")';
				}

				if ( ! empty( $src ) ) {

					$css .= '@font-face {';
					$css .= 'font-family: "'. esc_attr( $font['name'] ) .'";';
					if ( ! empty( $font['eot'] ) ) {
						$css .= 'src: url("'. esc_url( $font['eot'] ) .'");';
					}
					$css .= 'src: '. join( ',', $src ) .';';
					$css .= '}';

				}

			}

		}

	}

	return $css;

}