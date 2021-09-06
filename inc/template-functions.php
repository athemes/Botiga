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

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class for blog single post layout.
	if( is_singular( 'post' ) ) {
		$classes[] = 'blog-single-' . get_theme_mod( 'blog_single_layout', 'layout1' );
	}

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

	if ( !isset( $post ) || !is_singular( array( 'post', 'page' ) ) ) {
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
	
	if ( empty( $args->theme_location ) || 'primary' !== $args->theme_location ) {
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
 * Get social network
 */
function botiga_get_social_network( $social ) {

	$networks = array( 'facebook', 'twitter', 'instagram', 'github', 'linkedin', 'youtube', 'xing', 'flickr', 'dribbble', 'vk', 'weibo', 'vimeo', 'mix', 'behance', 'spotify', 'soundcloud', 'twitch', 'bandcamp', 'etsy', 'pinterest' );

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
			$items .= '<a target="_blank" href="' . esc_url( $social ) . '"><i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-' . esc_html( $network ), false ) . '</i></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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

	$length = get_theme_mod( 'excerpt_length', '12' );

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
			<h1 class="page-title"><?php single_post_title(); ?></h1>
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
		'mobile'	=> array( 'woocommerce_icons' ),
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
		),
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
		'contact_info' 		=> esc_html__( 'Contact info', 'botiga' ),
	);

	return apply_filters( 'botiga_header_elements', $elements );
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
			'regularweight' => 'regular',
			'category' 		=> 'sans-serif'
		)
	);	

	//Get and decode options
	$body_font		= get_theme_mod( 'botiga_body_font', $defaults );
	$headings_font 	= get_theme_mod( 'botiga_headings_font', $defaults );

	$body_font 		= json_decode( $body_font, true );
	$headings_font 	= json_decode( $headings_font, true );

	if ( 'System default' === $body_font['font'] && 'System default' === $headings_font['font'] ) {
		return; //return early if defaults are active
	}

	$font_families = array();

	$font_families[] = $body_font['font'] . ':' . $body_font['regularweight'];
		
	$font_families[] = $headings_font['font'] . ':' . $headings_font['regularweight'];

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( $subsets ),
		'display' => urlencode( 'swap' ),
	);

	$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );

	return esc_url_raw( $fonts_url );
}

/**
 * Google fonts preconnect
 */
function botiga_preconnect_google_fonts() {

	$defaults = json_encode(
		array(
			'font' 			=> 'System default',
			'regularweight' => 'regular',
			'category' 		=> 'sans-serif'
		)
	);	

	$body_font		= get_theme_mod( 'botiga_body_font', $defaults );
	$headings_font 	= get_theme_mod( 'botiga_headings_font', $defaults );

	$body_font 		= json_decode( $body_font, true );
	$headings_font 	= json_decode( $headings_font, true );

	if ( 'System default' === $body_font['font'] && 'System default' === $headings_font['font'] ) {
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