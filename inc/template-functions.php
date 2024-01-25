<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Botiga
 */

/**
 * Add botiga class to nav menu ul sub-menu.
 *
 * @param array $classes Classes for the ul element.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @param int $depth Depth of menu item. Used for padding.
 * @return array $classes Updated classes for the ul element. 
 */
function botiga_nav_menu_submenu_css_class( $classes, $args, $depth ) {
	$classes[] = 'botiga-dropdown-ul';
	return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'botiga_nav_menu_submenu_css_class', 10, 3 );

/**
 * Add botiga class to nav menu li.
 * 
 * @param array $classes Classes for the li element.
 * @param WP_Post $menu_item Menu item data object.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @param int $depth Depth of menu item. Used for padding.
 * @return array $classes Updated classes for the li element.
 */
function botiga_nav_menu_css_class( $classes, $menu_item, $args, $depth ) {
	$classes[] = 'botiga-dropdown-li';
	return $classes;
}
add_filter( 'nav_menu_css_class', 'botiga_nav_menu_css_class', 10, 4 );

/**
 * Add botiga class to nav menu anchor.
 * 
 * @param array $atts Array with attributes.
 * @param WP_Post $menu_item Menu item data object.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @param int $depth Depth of menu item. Used for padding.
 * @return array $atts Updated attributes for the li element.
 */
function botiga_nav_menu_link_attributes( $atts, $menu_item, $args, $depth ) {
	$atts[ 'class' ] = 'botiga-dropdown-link';
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'botiga_nav_menu_link_attributes', 10, 4 );

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

	/**
	 * Hook 'botiga_sidebar'
	 *
	 * @since 1.0.0
	 */
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

	$enable_post    = get_theme_mod( 'sidebar_single_post', 0 );
	$enable_page    = get_theme_mod( 'sidebar_single_page', 0 );

	$sidebar_layout = get_post_meta( $post->ID, '_botiga_sidebar_layout', true );

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

	$sidebar_archives_position  = get_theme_mod( 'sidebar_archives_position', 'sidebar-right' );

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

	$sidebar_layout             = get_post_meta( $post->ID, '_botiga_sidebar_layout', true );
	$sidebar_post_position      = get_theme_mod( 'sidebar_single_post_position', 'sidebar-right' );
	$sidebar_page_position      = get_theme_mod( 'sidebar_single_page_position', 'sidebar-right' );

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
function botiga_get_svg_icon( $icon, $do_echo = false, $wpkses = true ) {
	$svg_code = $wpkses ? wp_kses( //From TwentTwenty. Keeps only allowed tags and attributes
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
				'stroke'    => true,
				'stroke-width' => true,
				'stroke-linejoin' => true,
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
				'transform' => true,
			),              
		)
	) : Botiga_SVG_Icons::get_svg_icon( $icon );

	if ( $do_echo !== false ) {
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
		$page_builder_mode  = get_post_meta( $post->ID, '_botiga_page_builder_mode', true );

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
		$page_builder_mode  = get_post_meta( $post->ID, '_botiga_page_builder_mode', true );

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
		$page_builder_mode  = get_post_meta( $post->ID, '_botiga_page_builder_mode', true );

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
		$hide_page_title    = get_post_meta( $post->ID, '_botiga_hide_page_title', true );

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

	$networks = array( 'facebook', 'twitter', 'instagram', 'github', 'linkedin', 'youtube', 'xing', 'flickr', 'dribbble', 'vk', 'weibo', 'vimeo', 'mix', 'behance', 'spotify', 'soundcloud', 'twitch', 'bandcamp', 'etsy', 'pinterest', 'tiktok', 'discord' );

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
		'social'    => 'botiga_header_component_social',
		'search'    => 'botiga_header_component_search',
		'menu'      => 'botiga_header_component_menu',
		'menu-2'    => 'botiga_header_component_menu2',
		'cart'      => 'botiga_header_component_cart',
		'button-1'  => 'botiga_header_component_button1',
		'HTML'      => 'botiga_header_component_html',
		'shortcode' => 'botiga_header_component_shortcode',
		'logo'      => 'title_tagline',
	);

	/**
	 * Hook 'botiga_header_builder_components'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_header_builder_components', $components );
}

/**
 * Header builder components
 */
function botiga_mobile_header_builder_components() {

	$components = array(
		'social'    => 'botiga_header_component_social',
		'search'    => 'botiga_header_component_search',
		'menu'      => 'botiga_header_component_menu',
		'menu-2'    => 'botiga_header_component_menu2',
		'trigger'   => 'botiga_header_component_trigger',
		'cart'      => 'botiga_header_component_cart',
		'button-1'  => 'botiga_header_component_button1',
		'HTML'      => 'botiga_header_component_html',
		'shortcode' => 'botiga_header_component_shortcode',
		'logo'      => 'title_tagline',
	);

	/**
	 * Hook 'botiga_mobile_header_builder_components'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_mobile_header_builder_components', $components );
}

/**
 * Global color palettes
 */
function botiga_global_color_palettes() {
	$palettes = array(
		//                      1           2           3           4           5       6           7           8
		'palette1' => array( '#212121', '#757575', '#212121', '#212121', '#212121', '#f5f5f5', '#ffffff', '#ffffff' ),
		'palette2' => array( '#438061', '#214E3A', '#214E3A', '#222222', '#757575', '#ECEEEC', '#FFFFFF', '#ffffff' ),
		'palette3' => array( '#7877E6', '#4B49DE', '#000000', '#222222', '#4F4F4F', '#F4F4F3', '#ffffff', '#ffffff' ),
		'palette4' => array( '#1470AF', '#105787', '#072B43', '#212C34', '#9A9D9F', '#F3F4F4', '#ffffff', '#ffffff' ),
		'palette5' => array( '#FDB336', '#DD8B02', '#FFFFFF', '#948F87', '#1E2933', '#0F141A', '#141B22', '#141B22' ),
		'palette6' => array( '#FF524D', '#E80600', '#40140F', '#5B3F3E', '#ACA2A1', '#F4E3E0', '#FFFFFF', '#FFFFFF' ),
		'palette7' => array( '#E97B6B', '#C84835', '#131B51', '#3E425B', '#A1A3AC', '#F7EAE8', '#FFFFFF', '#FFFFFF' ),
		'palette8' => array( '#0AA99D', '#066B63', '#0B0C0F', '#202833', '#C5C7C8', '#E9F3F2', '#FFFFFF', '#FFFFFF' ),
	);

	/**
	 * Hook 'botiga_color_palettes'
	 *
	 * @since 1.0.0
	 */
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
	if ( is_home() && ! is_front_page() && ! get_theme_mod( 'archive_hide_title', 0 ) ) :
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
		'l1'        => array( 'search', 'woocommerce_icons' ),
		'l3left'    => array( 'search' ),
		'l3right'   => array( 'woocommerce_icons' ),
		'l4top'     => array( 'search' ),
		'l4bottom'  => array( 'woocommerce_icons' ),
		'l5topleft' => array(),
		'l5topright'=> array( 'woocommerce_icons' ),
		'l5bottom'  => array( 'search' ),
		'l7left'    => array( 'contact_info' ),
		'l7right'   => array( 'search', 'woocommerce_icons', 'hamburger_btn' ),
		'desktop_offcanvas' => array( 'search', 'woocommerce_icons' ),
		'mobile'    => array( 'mobile_woocommerce_icons' ),
		'offcanvas' => array(),
	);

	/**
	 * Hook 'botiga_default_header_components'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_default_header_components', $components );
}

/**
 * Header layouts
 */
function botiga_header_layouts() {
	$choices = array(           
		'header_layout_1' => array(
			'label' => esc_html__( 'Layout 1', 'botiga' ),
			'url'   => '%s/assets/img/hl1.svg',
		),
		'header_layout_2' => array(
			'label' => esc_html__( 'Layout 2', 'botiga' ),
			'url'   => '%s/assets/img/hl2.svg',
		),      
		'header_layout_3' => array(
			'label' => esc_html__( 'Layout 3', 'botiga' ),
			'url'   => '%s/assets/img/hl3.svg',
		),              
		'header_layout_4' => array(
			'label' => esc_html__( 'Layout 4', 'botiga' ),
			'url'   => '%s/assets/img/hl4.svg',
		),
		'header_layout_5' => array(
			'label' => esc_html__( 'Layout 5', 'botiga' ),
			'url'   => '%s/assets/img/hl5.svg',
		),
	);

	/**
	 * Hook 'botiga_header_layout_choices'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_header_layout_choices', $choices );
}

/**
 * Mobile header layouts
 */
function botiga_mobile_header_layouts() {
	$choices = array(           
		'header_mobile_layout_1' => array(
			'label' => esc_html__( 'Layout 1', 'botiga' ),
			'url'   => '%s/assets/img/mhl1.svg',
		),
		'header_mobile_layout_2' => array(
			'label' => esc_html__( 'Layout 2', 'botiga' ),
			'url'   => '%s/assets/img/mhl2.svg',
		),      
		'header_mobile_layout_3' => array(
			'label' => esc_html__( 'Layout 3', 'botiga' ),
			'url'   => '%s/assets/img/mhl3.svg',
		),
	);

	/**
	 * Hook 'botiga_mobile_header_layout_choices'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_mobile_header_layout_choices', $choices );
}

/**
 * Header elements
 */
function botiga_header_elements() {

	$elements = array(
		'search'            => esc_html__( 'Search', 'botiga' ),
		'woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button'            => esc_html__( 'Button', 'botiga' ),
		'contact_info'      => esc_html__( 'Contact info', 'botiga' ),
	);

	/**
	 * Hook 'botiga_header_elements'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_header_elements', $elements );
}

function botiga_header_elements_layout_7_8() {

	$elements = array(
		'search'            => esc_html__( 'Search', 'botiga' ),
		'woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button'            => esc_html__( 'Button', 'botiga' ),
		'contact_info'      => esc_html__( 'Contact info', 'botiga' ),
		'hamburger_btn'     => esc_html__( 'Hamburger button', 'botiga' ),
	);

	/**
	 * Hook 'botiga_header_elements_layout_7_8'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_header_elements_layout_7_8', $elements );
}

/**
 * Mobile Header elements
 */
function botiga_mobile_header_elements() {

	$elements = array(
		'search'                   => esc_html__( 'Search', 'botiga' ),
		'mobile_woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button'                   => esc_html__( 'Button', 'botiga' ),
		'contact_info'             => esc_html__( 'Contact info', 'botiga' ),
	);

	/**
	 * Hook 'botiga_mobile_header_elements'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_mobile_header_elements', $elements );
}

/**
 * Mobile Offcanvas Header elements
 */
function botiga_mobile_offcanvas_header_elements() {

	$elements = array(
		'search'                             => esc_html__( 'Search', 'botiga' ),
		'mobile_offcanvas_woocommerce_icons' => esc_html__( 'Cart &amp; account icons', 'botiga' ),
		'button'                             => esc_html__( 'Button', 'botiga' ),
		'contact_info'                       => esc_html__( 'Contact info', 'botiga' ),
	);

	/**
	 * Hook 'botiga_mobile_offcanvas_header_elements'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_mobile_offcanvas_header_elements', $elements );
}

/**
 * Default top bar components
 */
function botiga_get_default_topbar_components() {
	$components = array(
		'left'      => array( 'contact_info' ),
		'right'     => array( 'text' ),
	);

	/**
	 * Hook 'botiga_default_topbar_components'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_default_topbar_components', $components );
}

/**
 * Top bar elements
 */
function botiga_topbar_elements() {

	$elements = array(
		'social'            => esc_html__( 'Social', 'botiga' ),
		'text'              => esc_html__( 'Text', 'botiga' ),
		'secondary_nav'     => esc_html__( 'Secondary menu', 'botiga' ),
		'contact_info'      => esc_html__( 'Contact info', 'botiga' ),
	);

	/**
	 * Hook 'botiga_topbar_elements'
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'botiga_topbar_elements', $elements );
}

/**
 * Header transparent customizer choices
 */
function botiga_header_transparent_choices() {

	$choices = array(
		'front-page'        => __( 'Front Page', 'botiga' ),
		'pages'             => __( 'Pages', 'botiga' ),
		'blog-archive'      => __( 'Blog Archive', 'botiga' ),
		'blog-posts'        => __( 'Blog Posts', 'botiga' ),
		'post-search'       => __( 'Posts Search Results', 'botiga' ),
		'404'               => __( '404 Page', 'botiga' ),
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

	/**
	 * Hook 'botiga_header_transparent_choices'
	 *
	 * @since 1.0.0
	 */
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

	/**
	 * Hook 'botiga_masonry_data'
	 *
	 * @since 1.0.0
	 */
	echo apply_filters( 'botiga_masonry_data', wp_kses_post( $data ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Google Fonts URL
 */
function botiga_google_fonts_url() {
	$fonts_url  = '';
	$subsets    = 'latin';

	$defaults = wp_json_encode(
		array(
			'font'          => 'System default',
			'regularweight' => '400',
			'category'      => 'sans-serif',
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
		require_once get_theme_file_path( 'vendor/wptt/webfont-loader/wptt-webfont-loader.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

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
	$google_fonts  = botiga_get_google_fonts();

	
	if( 'error' === $google_fonts ) {
		return;
	}

	$google_fonts  = array_column( $google_fonts, 'family' );

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
	} elseif ( $button_font_style === 'heading' ) {
		$button_custom_font = $headings_custom_font;
	}

	if ( $loop_post_title_font_style === 'body' ) {
		$loop_post_title_custom_font = $body_custom_font;
	} elseif ( $loop_post_title_font_style === 'heading' ) {
		$loop_post_title_custom_font = $headings_custom_font;
	}

	if ( $single_post_title_font_style === 'body' ) {
		$single_post_title_custom_font = $body_custom_font;
	} elseif ( $single_post_title_font_style === 'heading' ) {
		$single_post_title_custom_font = $headings_custom_font;
	}

	if ( $single_product_title_font_style === 'body' ) {
		$single_product_title_custom_font = $body_custom_font;
	} elseif ( $single_product_title_font_style === 'heading' ) {
		$single_product_title_custom_font = $headings_custom_font;
	}

	if ( $shop_product_title_font_style === 'body' ) {
		$shop_product_title_custom_font = $body_custom_font;
	} elseif ( $shop_product_title_font_style === 'heading' ) {
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
		require_once get_theme_file_path( 'vendor/wptt/webfont-loader/wptt-webfont-loader.php' ); // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		return wptt_get_webfont_url( $fonts_url );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Get google fonts
 */
function botiga_get_google_fonts() {
	require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

	$fontFile       = get_parent_theme_file_path( '/inc/customizer/controls/typography/google-fonts-alphabetical.json' );
	$file_system    = new WP_Filesystem_Direct( false );
	$content        = json_decode( $file_system->get_contents( $fontFile ) );

	$fonts   = array();

	if ( isset( $content->items ) && ! empty( $content->items ) ) {
		$fonts = $content->items;
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

	$defaults = wp_json_encode(
		array(
			'font'          => 'System default',
			'regularweight' => '400',
			'category'      => 'sans-serif',
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
		'autoplayTimeout' => 5000,
	);
}

/**
 * Botiga get image
 */
function botiga_get_image( $image_id = '', $size = 'thumbnail', $do_echo = false ) {
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

	if ( $do_echo !== false ) {
		echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Get Header Search Icon
 */
function botiga_get_header_search_icon( $do_echo = false ) {
	$icon = get_theme_mod( 'search_icon', 'icon-search' );

	$output = '';
	if( $icon !== 'icon-custom' ) {
		$output .= '<i class="ws-svg-icon icon-search active">' . botiga_get_svg_icon( $icon ) . '</i>';
	} else {
		$image_id = get_theme_mod( 'search_icon_custom_image', 0 );

		/**
		 * Hook 'botiga_header_icons_image_size'
		 *
		 * @since 1.0.0
		 */
		$output .= '<i class="ws-svg-icon icon-search active">' . botiga_get_image( $image_id, apply_filters( 'botiga_header_icons_image_size', 'botiga-header-icons' ) ) . '</i>';
	}

	$output .= '<i class="ws-svg-icon icon-cancel">' . botiga_get_svg_icon( 'icon-cancel' ) . '</i>';

	if ( $do_echo !== false ) {
		echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Get Header Icon
 */
function botiga_get_header_icon( $identifier = '', $do_echo = false ) {
	if( ! $identifier ) {
		return '';
	}

	switch ( $identifier ) {
		case 'cart':
			$icon         = get_theme_mod( 'cart_icon', 'icon-cart' );
			$image_id     = get_theme_mod( 'cart_icon_custom_image', 0 );
			break;

		case 'account':
			$icon         = get_theme_mod( 'account_icon', 'icon-user' );
			$image_id     = get_theme_mod( 'account_icon_custom_image', 0 );
			break;

		case 'wishlist':
			$icon         = get_theme_mod( 'wishlist_icon', 'icon-wishlist' );
			$image_id     = get_theme_mod( 'wishlist_icon_custom_image', 0 );
			break;
		
	}

	$output = '';
	if( $icon !== 'icon-custom' ) {
		$output .= botiga_get_svg_icon( $icon );
	} else {

		/**
		 * Hook 'botiga_header_icons_image_size'
		 *
		 * @since 1.0.0
		 */
		$output .= botiga_get_image( $image_id, apply_filters( 'botiga_header_icons_image_size', 'botiga-header-icons' ) );
	}

	if ( $do_echo !== false ) {
		echo $output; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	} else {
		return $output;
	}
}

/**
 * Get Header Search Form Icon
 */
function botiga_get_header_search_form_icon( $do_echo = false ) {
	$icon = get_theme_mod( 'bhfb_search_form_button_icon', 'icon-search' );

	$output = '';
	if( $icon !== 'icon-custom' ) {
		$output .= botiga_get_svg_icon( $icon );
	} else {
		$image_id = get_theme_mod( 'bhfb_search_form_button_icon_custom_image', 0 );

		/**
		 * Hook 'botiga_header_search_form_icon_image_size'
		 *
		 * @since 1.0.0
		 */
		$output .= botiga_get_image( $image_id, apply_filters( 'botiga_header_search_form_icon_image_size', 'botiga-header-icons' ) );
	}

	if ( $do_echo !== false ) {
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
 * Embed Custom Fonts
 *
 * 
 * @return void The @font-face CSS rules.
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
					$css .= 'font-display: swap;';
					$css .= '}';

				}

			}

		}

	}

	return $css;
}

/**
 * Wrapper to get_permalink() function. 
 * 
 */
function botiga_get_permalink( $post = 0 ) {
	if ( ! is_object( $post ) ) {
		$post = get_post( $post );
	}

	if ( empty( $post->ID ) ) {
		return false;
	}

	$post_id = $post->ID;

	// Polylang
	if ( function_exists( 'pll_get_post' ) ) {
		$post_id = pll_get_post( $post->ID );
	}

	// WPML
	if ( has_filter( 'wpml_object_id' ) ) {
		/**
		 * Hook 'wpml_object_id'
		 *
		 * @since 1.0.0
		 */
		$post_id = apply_filters( 'wpml_object_id', $post->ID, get_post_type( $post->ID ), true ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	return get_permalink( $post_id );
}

/**
 * Display Conditions
 * 
 * @param array $maybe_rules The display conditions rules.
 * @param bool  $default_value     The default value.
 * @param string $mod_default The default value from the customizer.
 * 
 * @return bool True if the display conditions are met, false otherwise.
 */
function botiga_get_display_conditions( $maybe_rules, $default_value = true, $mod_default = '[]' ) {
	$rules  = array();
	$result = $default_value;

	if ( is_array( $maybe_rules ) && ! empty( $maybe_rules ) ) {
		$rules = $maybe_rules;
	} else {
		$option = empty( $maybe_rules ) ? get_theme_mod( '', $mod_default ) : get_theme_mod( $maybe_rules, $mod_default );
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

				if ( $condition === 'cart-page' && is_cart() ) {
					$result = $boolean;
				}

				if ( $condition === 'checkout-page' && is_checkout() ) {
					$result = $boolean;
				}

				if ( $condition === 'account-page' && is_account_page() ) {
					$result = $boolean;
				}

				if ( $condition === 'view-order-page' && is_view_order_page() ) {
					$result = $boolean;
				}

				if ( $condition === 'edit-account-page' && is_edit_account_page() ) {
					$result = $boolean;
				}

				if ( $condition === 'order-received-page' && is_order_received_page() ) {
					$result = $boolean;
				}

				if ( $condition === 'lost-password-page' && is_lost_password_page() ) {
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

	/**
	 * Hook 'botiga_display_conditions_result'
	 *
	 * @since 1.0.0
	 */
	$result = apply_filters( 'botiga_display_conditions_result', $result, $rules );

	return $result;
}

/**
 * Get display conditions select options
 * 
 * @param string $term Search term
 * @param string $source Source
 * 
 * @return array $options
 */
function botiga_get_display_conditions_select_options( $term, $source ) {
	$options = array();

	switch ( $source ) {

		case 'post-id':
		case 'page-id':
		case 'product-id':
			$post_type = 'post';

			if ( $source === 'page-id' ) {
				$post_type = 'page';
			}

			if ( $source === 'product-id' ) {
				$post_type = 'product';
			}

			$query = new WP_Query( array(
				's'              => $term,
				'post_type'      => $post_type,
				'post_status'    => 'publish',
				'posts_per_page' => 25,
				'order'          => 'DESC',
			) );

			if ( ! empty( $query->posts ) ) {
				foreach( $query->posts as $post ) {
					$options[] = array(
						'id'   => $post->ID,
						'text' => $post->post_title,
					);
				}
			}
			break;

		case 'tag-id':
		case 'category-id':
		case 'product-category-id':
			$taxonomy = 'category';

			if ( $source === 'tag-id' ) {
				$taxonomy = 'post_tag';
			}

			if ( $source === 'product-category-id' ) {
				$taxonomy = 'product_cat';
			}

			$query = new WP_Term_Query( array(
				'search'     => $term,
				'taxonomy'   => $taxonomy,
				'number'     => 25,
				'hide_empty' => false,
			) );
		
			if ( ! empty( $query->terms ) ) {
				foreach ( $query->terms as $term ) {
					$options[] = array(
						'id'   => $term->term_id,
						'text' => $term->name,
					);
				}
			}
			break;

		case 'author':
		case 'author-id':
			$query      = new WP_User_Query( array(
				'search'  => '*'. $term .'*',
				'number'  => 25,
				'order'   => 'DESC',
				'fields'  => array( 'display_name', 'ID' ),
			) );
			
			$authors = $query->get_results();

			if ( ! empty( $authors ) ) {
				foreach ( $authors as $author ) {
					$options[] = array(
						'id'   => $author->ID,
						'text' => $author->display_name,
					);
				}
			}
			break;

		case 'cpt-post-id':
			$post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'objects' );

			if ( ! empty( $post_types ) ) {
				foreach ( $post_types as $post_type_key => $post_type ) {
					if ( in_array( $post_type_key, array( 'post', 'page' ) ) ) {
						continue;
					}
					$query = new WP_Query( array(
						's'              => $term,
						'post_type'      => $post_type_key,
						'post_status'    => 'publish',
						'posts_per_page' => 25,
						'order'          => 'DESC',
					) );
					if ( ! empty( $query->posts ) ) {
						foreach( $query->posts as $post ) {
							$options[] = array(
								'id'   => $post->ID,
								'text' => $post->post_title,
							);
						}
					}
				}
			}
			break;

		case 'cpt-term-id':
			$terms = get_terms( array(
				'search'     => $term,
				'number'     => 25,
				'hide_empty' => false,
			) );

			if ( ! empty( $terms ) ) {
				foreach ( $terms as $term ) {
					if ( in_array( $term->taxonomy, array( 'category', 'post_tag' ) ) ) {
						continue;
					}
					$taxonomy = get_taxonomy( $term->taxonomy );
					if ( $taxonomy->show_in_nav_menus ) {
						$options[] = array(
							'id'   => $term->term_id,
							'text' => $term->name,
						);
					}
				}
			}
			break;

		case 'cpt-taxonomy-id':
			$taxonomies = get_taxonomies( array( 'show_in_nav_menus' => true ), 'objects' );

			if ( ! empty( $taxonomies ) ) {
				foreach ( $taxonomies as $taxonomy_key => $taxonomy ) {
					if ( in_array( $taxonomy_key, array( 'category', 'post_tag', 'post_format' ) ) ) {
						continue;
					}
					if ( preg_match( '/'. strtolower( $term ) .'/', strtolower( $taxonomy->label ) ) ) {
						$options[] = array(
							'id'   => $taxonomy_key,
							'text' => $taxonomy->label,
						);
					}
				}
			}
			break;

	}

	return $options;
}

/**
 * Display conditions transform values (id's) to text
 * 
 * @param array $value The display conditions values.
 * 
 * @return string The text value.
 */
function botiga_get_display_condition_value_text( $value ) {
	switch ($value['condition']) {
		case 'post-id':
		case 'page-id':
		case 'product-id':
		case 'cpt-post-id':
			return get_the_title($value['id']);
			break;

		case 'tag-id':
		case 'category-id':
		case 'product-category-id':
			$term = get_term($value['id']);

			if (!empty($term)) {
				return $term->name;
			}
			break;

		case 'cpt-term-id':
			$term = get_term($value['id']);

			if (!empty($term)) {
				return $term->name;
			}
			break;

		case 'cpt-taxonomy-id':
			$taxonomy = get_taxonomy($value['id']);

			if (!empty($taxonomy)) {
				return $taxonomy->label;
			}
			break;

		case 'author':
		case 'author-id':
			return get_the_author_meta('display_name', $value['id']);
			break;
	}

	// user-roles
	if (substr($value['condition'], 0, 10) === 'user_role_') {
		$user_rules = get_editable_roles();

		if (!empty($user_rules[$value['id']])) {
			return $user_rules[$value['id']]['name'];
		}
	}

	return $value['id'];
}

/**
 * Display conditions script template.
 * 
 * @return void The script template (including <script> tag).
 */
function botiga_display_conditions_script_template() {
	$settings = array();

	$settings['types'][] = array(
		'id'   => 'include',
		'text' => esc_html__( 'Include', 'botiga' ),
	);

	$settings['types'][] = array(
		'id'   => 'exclude',
		'text' => esc_html__( 'Exclude', 'botiga' ),
	);

	$settings['display'][] = array(
		'id'   => 'all',
		'text' => esc_html__( 'Entire Site', 'botiga' ),
	);

	$settings['display'][] = array(
		'id'      => 'basic',
		'text'    => esc_html__( 'Basic', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'singular',
				'text' => esc_html__( 'Singulars', 'botiga' ),
			),
			array(
				'id'   => 'archive',
				'text' => esc_html__( 'Archives', 'botiga' ),
			),
		),
	);

	$settings['display'][] = array(
		'id'      => 'posts',
		'text'    => esc_html__( 'Posts', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'single-post',
				'text' => esc_html__( 'Single Post', 'botiga' ),
			),
			array(
				'id'   => 'post-archives',
				'text' => esc_html__( 'Post Archives', 'botiga' ),
			),
			array(
				'id'   => 'post-categories',
				'text' => esc_html__( 'Post Categories', 'botiga' ),
			),
			array(
				'id'   => 'post-tags',
				'text' => esc_html__( 'Post Tags', 'botiga' ),
			),
		),
	);

	$settings['display'][] = array(
		'id'      => 'pages',
		'text'    => esc_html__( 'Pages', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'single-page',
				'text' => esc_html__( 'Single Page', 'botiga' ),
			),
		),
	);

	if ( class_exists( 'WooCommerce' ) ) {

		$settings['display'][] = array(
			'id'      => 'woocommerce',
			'text'    => esc_html__( 'WooCommerce', 'botiga' ),
			'options' => array(
				array(
					'id'   => 'cart-page',
					'text' => esc_html__( 'Cart', 'botiga' ),
				),
				array(
					'id'   => 'checkout-page',
					'text' => esc_html__( 'Checkout', 'botiga' ),
				),
				array(
					'id'   => 'single-product',
					'text' => esc_html__( 'Single Product', 'botiga' ),
				),
				array(
					'id'   => 'product-archives',
					'text' => esc_html__( 'Product Archives', 'botiga' ),
				),
				array(
					'id'   => 'product-categories',
					'text' => esc_html__( 'Product Categories', 'botiga' ),
				),
				array(
					'id'   => 'product-tags',
					'text' => esc_html__( 'Product Tags', 'botiga' ),
				),
				array(
					'id'   => 'product-id',
					'text' => esc_html__( 'Product Name', 'botiga' ),
					'ajax' => true,
				),
				array(
					'id'   => 'product-category-id',
					'text' => esc_html__( 'Product Category Name', 'botiga' ),
					'ajax' => true,
				),
				array(
					'id'   => 'account-page',
					'text' => esc_html__( 'My Account', 'botiga' ),
				),
				array(
					'id'   => 'edit-account-page',
					'text' => esc_html__( 'Edit Account', 'botiga' ),
				),
				array(
					'id'   => 'order-received-page',
					'text' => esc_html__( 'Order Thank You', 'botiga' ),
				),
				array(
					'id'   => 'view-order-page',
					'text' => esc_html__( 'View Order', 'botiga' ),
				),
				array(
					'id'   => 'lost-password-page',
					'text' => esc_html__( 'Lost Password', 'botiga' ),
				),
			),
		);

	}

	$settings['display'][] = array(
		'id'      => 'specifics',
		'text'    => esc_html__( 'Specific', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'post-id',
				'text' => esc_html__( 'Post Name', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'page-id',
				'text' => esc_html__( 'Page Name', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'category-id',
				'text' => esc_html__( 'Category Name', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'tag-id',
				'text' => esc_html__( 'Tag Name', 'botiga' ),
				'ajax' => true,
			),
			array(
				'id'   => 'author-id',
				'text' => esc_html__( 'Author Name', 'botiga' ),
				'ajax' => true,
			),
		),
	);

	$available_post_types = get_post_types( array( 'show_in_nav_menus' => true ), 'objects' );
	$available_post_types = array_diff( array_keys( $available_post_types ), array( 'post', 'page', 'product' ) );

	if ( ! empty( $available_post_types ) ) {

		$settings['display'][] = array(
			'id'      => 'cpt',
			'text'    => esc_html__( 'Custom Post Types', 'botiga' ),
			'options' => array(
				array(
					'id'   => 'cpt-post-id',
					'text' => esc_html__( 'CPT: Post Name', 'botiga' ),
					'ajax' => true,
				),
				array(
					'id'   => 'cpt-term-id',
					'text' => esc_html__( 'CPT: Term Name', 'botiga' ),
					'ajax' => true,
				),
				array(
					'id'   => 'cpt-taxonomy-id',
					'text' => esc_html__( 'CPT: Taxonomy Name', 'botiga' ),
					'ajax' => true,
				),
			),
		);

	}

	$settings['display'][] = array(
		'id'      => 'other',
		'text'    => esc_html__( 'Other', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'front-page',
				'text' => esc_html__( 'Front Page', 'botiga' ),
			),
			array(
				'id'   => 'blog',
				'text' => esc_html__( 'Blog', 'botiga' ),
			),
			array(
				'id'   => 'search',
				'text' => esc_html__( 'Search', 'botiga' ),
			),
			array(
				'id'   => '404',
				'text' => esc_html__( '404', 'botiga' ),
			),
			array(
				'id'   => 'author',
				'text' => esc_html__( 'Author', 'botiga' ),
			),
			array(
				'id'   => 'privacy-policy-page',
				'text' => esc_html__( 'Privacy Policy Page', 'botiga' ),
			),
		),
	);

	$user_roles = array();
	$user_rules = get_editable_roles();

	if ( ! empty( $user_rules ) ) {
		foreach ( $user_rules as $role_id => $role_data ) {
			$user_roles[] = array(
				'id'   => 'user_role_'. $role_id,
				'text' => $role_data['name'],
			);
		}
	}

	$settings['user'][] = array(
		'id'      => 'user-auth',
		'text'    => esc_html__( 'User Auth', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'logged-in',
				'text' => esc_html__( 'User Logged In', 'botiga' ),
			),
			array(
				'id'   => 'logged-out',
				'text' => esc_html__( 'User Logged Out', 'botiga' ),
			),
		),
	);

	$settings['user'][] = array(
		'id'      => 'user-roles',
		'text'    => esc_html__( 'User Roles', 'botiga' ),
		'options' => $user_roles,
	);

	$settings['user'][] = array(
		'id'      => 'other',
		'text'    => esc_html__( 'Other', 'botiga' ),
		'options' => array(
			array(
				'id'   => 'author',
				'text' => esc_html__( 'Author', 'botiga' ),
				'ajax' => true,
			),
		),
	);

	/**
	 * Hook 'botiga_display_conditions_script_settings'
	 *
	 * @since 1.0.0
	 */
	$settings = apply_filters( 'botiga_display_conditions_script_settings', $settings );

	?>
		<script type="text/javascript">
			var botigaDCSettings = <?php echo wp_json_encode( $settings ); ?>;
		</script>
		<script type="text/template" id="tmpl-botiga-display-conditions-template">
			<div class="botiga-display-conditions-modal">
				<div class="botiga-display-conditions-modal-outer">
					<div class="botiga-display-conditions-modal-header">
						<h3>{{ data.title || data.label }}</h3>
						<i class="botiga-button-close botiga-display-conditions-modal-toggle dashicons dashicons-no-alt"></i>
					</div>
					<div class="botiga-display-conditions-modal-content">
						<ul class="botiga-display-conditions-modal-content-list">
							<li class="botiga-display-conditions-modal-content-list-item hidden">
								<div class="botiga-display-conditions-select2-type" data-type="include">
									<select name="type">
										<# _.each( botigaDCSettings.types, function( type ) { #>
											<option value="{{ type.id }}">{{ type.text }}</option>
										<# }); #>
									</select>
								</div>
								<div class="botiga-display-conditions-select2-groupped">
									<# _.each( ['display', 'user'], function( conditionGroup ) { #>
										<div class="botiga-display-conditions-select2-condition" data-condition-group="{{ conditionGroup }}">
											<select name="condition">
												<# _.each( botigaDCSettings[ conditionGroup ], function( condition ) { #>
													<# if ( _.isEmpty( condition.options ) ) { #>
														<option value="{{ condition.id }}">{{ condition.text }}</option>
													<# } else { #>
														<optgroup label="{{ condition.text }}">
															<# _.each( condition.options, function( option ) { #>
																<# var ajax = ( option.ajax ) ? ' data-ajax="true"' : ''; #>
																<option value="{{ option.id }}"{{{ ajax }}}>{{ option.text }}</option>
															<# }); #>
														</optgroup>
													<# } #>
												<# }); #>
											</select>
										</div>
									<# }); #>
									<div class="botiga-display-conditions-select2-id hidden">
										<select name="id"></select>
									</div>
								</div>
								<div class="botiga-display-conditions-modal-remove">
									<i class="dashicons dashicons-trash"></i>
								</div>
							</li>
							<# _.each( data.values, function( value ) { #>
								<li class="botiga-display-conditions-modal-content-list-item">
									<div class="botiga-display-conditions-select2-type" data-type="{{ value.type }}">
										<select name="type">
											<# _.each( botigaDCSettings.types, function( type ) { #>
												<# var selected = ( value.type == type.id ) ? ' selected="selected"' : ''; #>
												<option value="{{ type.id }}"{{{ selected }}}>{{ type.text }}</option>
											<# }); #>
										</select>
									</div>
									<div class="botiga-display-conditions-select2-groupped">
										<# 
											var currentCondition;
											_.each( botigaDCSettings, function( conditionValues, conditionKey ) {
												_.each( conditionValues, function( condition ) {
													if ( _.isEmpty( condition.options ) ) {
														if ( value.condition == condition.id ) {
															currentCondition = conditionKey;
														}
													} else {
														_.each( condition.options, function( option ) {
															if ( value.condition == option.id ) {
																currentCondition = conditionKey;
															}
														});
													}
												});
											});
										#>
										<# if ( ! _.isEmpty( currentCondition ) ) { #>
											<div class="botiga-display-conditions-select2-condition" data-condition-group="{{ currentCondition }}">
												<select name="condition">
													<# _.each( botigaDCSettings[ currentCondition ], function( condition ) { #>
														<# if ( _.isEmpty( condition.options ) ) { #>
															<option value="{{ condition.id }}">{{ condition.text }}</option>
														<# } else { #>
															<optgroup label="{{ condition.text }}">
																<# _.each( condition.options, function( option ) { #>
																	<# var ajax = ( option.ajax ) ? ' data-ajax="true"' : ''; #>
																	<# var selected = ( value.condition == option.id ) ? ' selected="selected"' : ''; #>
																	<option value="{{ option.id }}"{{{ ajax }}}{{{ selected }}}>{{ option.text }}</option>
																<# }); #>
															</optgroup>
														<# } #>
													<# }); #>
												</select>
											</div>
										<# } #>
										<div class="botiga-display-conditions-select2-id hidden">
											<select name="id">
												<# if ( ! _.isEmpty( value.id ) ) { #>
													<option value="{{ value.id }}" selected="selected">{{ data.labels[ value.id ] }}</option>
												<# } #>
											</select>
										</div>
									</div>
									<div class="botiga-display-conditions-modal-remove">
										<i class="dashicons dashicons-trash"></i>
									</div>
								</li>
							<# }); #>
						</ul>
						<div class="botiga-display-conditions-modal-content-footer">
							<a href="#" class="button botiga-display-conditions-modal-add" data-condition-group="display"><?php esc_html_e( 'Add Display Condition', 'botiga' ); ?></a>
							<a href="#" class="button botiga-display-conditions-modal-add" data-condition-group="user"><?php esc_html_e( 'Add User Condition', 'botiga' ); ?></a>
						</div>
					</div>
					<div class="botiga-display-conditions-modal-footer">
						<a href="#" class="button button-primary botiga-display-conditions-modal-save botiga-display-conditions-modal-toggle"><?php esc_html_e( 'Save Conditions', 'botiga' ); ?></a>
					</div>
				</div>
			</div>
		</script>
	<?php
}
