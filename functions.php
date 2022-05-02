<?php
/**
 * Botiga functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Botiga
 */

if ( ! defined( 'BOTIGA_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'BOTIGA_VERSION', '1.1.3' );
}

if ( ! function_exists( 'botiga_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function botiga_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Botiga, use a find and replace
		 * to change 'botiga' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'botiga', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'botiga-extra-large', 1140, 9999 );
		add_image_size( 'botiga-large', 920, 9999 );
		add_image_size( 'botiga-big', 575, 9999 );
		add_image_size( 'botiga-medium', 380, 9999 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'	=> esc_html__( 'Primary', 'botiga' ),
				'secondary' => esc_html__( 'Top Bar Menu', 'botiga' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'botiga_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => ''
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Wide alignments
		 *
		 */		
		add_theme_support( 'align-wide' );

		/**
		 * Color palettes
		 */
		$selected_palette 	= get_theme_mod( 'color_palettes', 'palette1' );
		$palettes 			= botiga_global_color_palettes();

		$colors = array();
		
		$custom_palette_toggle = get_theme_mod( 'custom_palette_toggle', 0 );
		if( $custom_palette_toggle ) {
			for ( $i = 1; $i < 9; $i++ ) { 
				$colors[] = array(
					/* translators: %s: color palette */
					'name'  => sprintf( esc_html__( 'Color %s', 'botiga' ), $i ),
					'slug'  => 'palette' . $i . '-color-' . $i,
					'color' => get_theme_mod( 'custom_color' . $i, '#212121' )
				);
			}
		} else {
			for ( $i = 0; $i < 8; $i++ ) { 
				$colors[] = array(
					/* translators: %s: color palette */
					'name'  => sprintf( esc_html__( 'Color %s', 'botiga' ), $i ),
					'slug'  => $selected_palette . '-color-' . $i,
					'color' => $palettes[$selected_palette][$i],
				);
			}
		}
		

		add_theme_support(
			'editor-color-palette',
			$colors
		);	
		
		/**
		 * Editor font sizes
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'botiga' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'botiga' ),
					'size'      => 14,
					'slug'      => 'small',
				),				
				array(
					'name'      => esc_html__( 'Normal', 'botiga' ),
					'shortName' => esc_html_x( 'N', 'Font size', 'botiga' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'botiga' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'botiga' ),
					'size'      => 18,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Larger', 'botiga' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'botiga' ),
					'size'      => 24,
					'slug'      => 'larger',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'botiga' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'botiga' ),
					'size'      => 32,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'botiga' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'botiga' ),
					'size'      => 48,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'botiga' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'botiga' ),
					'size'      => 64,
					'slug'      => 'gigantic',
				),
			)
		);		

		/**
		 * Responsive embeds
		 */
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'botiga_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function botiga_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'botiga_content_width', 1140 ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
add_action( 'after_setup_theme', 'botiga_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function botiga_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'botiga' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'botiga' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			'before_sidebar' => '<div class="sidebar-wrapper"><a href="#" role="button" class="close-sidebar" onclick="botiga.toggleClass.init(event, this, \'sidebar-slide-close\');" data-botiga-selector=".sidebar-slide+.widget-area" data-botiga-toggle-class="show">'. botiga_get_svg_icon( 'icon-cancel' ) .'</a>',
				'after_sidebar'  => '</div>'
		)
	);

	for ( $i = 1; $i <= 4; $i++ ) { 
		register_sidebar(
			array(
				/* translators: %s = footer widget area number */
				'name'          => sprintf( esc_html__( 'Footer %s', 'botiga' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => esc_html__( 'Add widgets here.', 'botiga' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'botiga_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function botiga_scripts() {
	$fonts_library = get_theme_mod( 'fonts_library', 'google' );
	
	if( $fonts_library === 'google' ) {
		wp_enqueue_style( 'botiga-google-fonts', botiga_google_fonts_url(), array(), botiga_google_fonts_version() );
	} else {
		$kits = get_option( 'botiga_adobe_fonts_kits', array() );

		foreach ( $kits as $kit_id => $kit_data ) {

			if ( $kit_data['enable'] == false ) {
				continue;
			}

			wp_enqueue_style( 'botiga-typekit-' . $kit_id, 'https://use.typekit.com/' . $kit_id . '.css', array(), BOTIGA_VERSION );
		}
	}

	wp_enqueue_script( 'botiga-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array(), BOTIGA_VERSION, true );
	wp_localize_script( 'botiga-custom', 'botiga', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'i18n'    => array(
			'botiga_sharebox_copy_link' => __( 'Copy link', 'botiga' ),
			'botiga_sharebox_copy_link_copied' => __( 'Copied!', 'botiga' )
		)
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'botiga-carousel', get_template_directory_uri() . '/assets/js/botiga-carousel.min.js', NULL, BOTIGA_VERSION, true );
	wp_register_script( 'botiga-popup', get_template_directory_uri() . '/assets/js/botiga-popup.min.js', NULL, BOTIGA_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'botiga_scripts', 10 );

/**
 * Enqueue style css
 * Ensure compatibility with Botiga Pro, since pro scripts are enqueued with order "10"
 * We always need the custom.min.css as the last stylesheet enqueued
 */
function botiga_style_css() {
	wp_enqueue_style( 'botiga-style', get_stylesheet_uri(), array(), BOTIGA_VERSION );
	wp_enqueue_style( 'botiga-style-min', get_template_directory_uri() . '/assets/css/styles.min.css', array(), BOTIGA_VERSION );
}
add_action( 'wp_enqueue_scripts', 'botiga_style_css', 11 );

/**
 * Page Templates
 */
function botiga_remove_page_templates( $page_templates ) {
	if( ! defined( 'BOTIGA_PRO_VERSION' ) ) {
		unset( $page_templates['page-templates/template-wishlist.php'] );
	}
   
	return $page_templates;
}
add_filter( 'theme_page_templates', 'botiga_remove_page_templates' );

/**
 * Deactivate Elementor Wizard
 */
function botiga_deactivate_ele_onboarding() {
	update_option( 'elementor_onboarded', true );
}
add_action( 'after_switch_theme', 'botiga_deactivate_ele_onboarding' );

/**
 * Gutenberg editor
 */
require get_template_directory() . '/inc/editor.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/plugins/jetpack/jetpack.php';
}

/**
 * Load Max Mega Menu compatibility file.
 */
if ( class_exists( 'Mega_Menu' ) ) {
	require get_template_directory() . '/inc/plugins/max-mega-menu/max-mega-menu.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/plugins/woocommerce/woocommerce.php';
}

/**
 * Load Dokan compatibility file.
 */
if( defined( 'ELEMENTOR_VERSION' ) ) {
	require get_template_directory() . '/inc/plugins/elementor/elementor.php';
}

/**
 * Load Elementor compatibility file.
 */
if( defined( 'DOKAN_PLUGIN_VERSION' ) ) {
	require get_template_directory() . '/inc/plugins/dokan/dokan.php';
}

/**
 * Upsell
 */
if( ! defined( 'BOTIGA_PRO_VERSION' ) ) {
	require get_template_directory() . '/inc/customizer/upsell/class-customize.php';
}

/**
 * Theme classes
 */
require get_template_directory() . '/inc/classes/class-botiga-topbar.php';
require get_template_directory() . '/inc/classes/class-botiga-header.php';
require get_template_directory() . '/inc/classes/class-botiga-footer.php';
require get_template_directory() . '/inc/classes/class-botiga-posts-archive.php';
require get_template_directory() . '/inc/classes/class-botiga-svg-icons.php';
require get_template_directory() . '/inc/classes/class-botiga-page-metabox.php';
require get_template_directory() . '/inc/classes/class-botiga-custom-css.php';

/**
 * Theme ajax callbacks
 */
require get_template_directory() . '/inc/ajax-callbacks.php';

/**
 * Autoload
 */
require_once get_parent_theme_file_path( 'vendor/autoload.php' );

/**
 * Theme dashboard.
 */
require get_template_directory() . '/theme-dashboard/class-theme-dashboard.php';

/**
 * Theme dashboard settings.
 */
require get_template_directory() . '/inc/theme-dashboard-settings.php';

/**
 * Review notice
 */
require get_template_directory() . '/inc/notices/class-botiga-review.php';

/**
 * Theme update migration functions
 */
require get_template_directory() . '/inc/theme-update.php';

/**
 * Botiga custom get template part
 */
function botiga_get_template_part( $slug, $name = null, $args = array() ) {
	if ( version_compare( get_bloginfo( 'version' ), '5.5', '>=' ) ) {
		return get_template_part( $slug, $name, $args );
	} else {
		extract($args);
	
		$templates = array();
		$name = (string) $name;
		if ( '' !== $name ) {
			$templates[] = "{$slug}-{$name}.php";
		}
		$templates[] = "{$slug}.php";
	 
		return include( locate_template($templates) );
	}
}