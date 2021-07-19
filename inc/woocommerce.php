<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Botiga
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function botiga_woocommerce_setup() {

	$enable_zoom 	= get_theme_mod( 'single_zoom_effects', 1 );
	$enable_gallery = get_theme_mod( 'single_gallery_slider', 1 );

	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 350,
			'single_image_width'    => 800,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);
	
	if ( $enable_zoom ) {
		add_theme_support( 'wc-product-gallery-zoom' );
	}

	if ( $enable_gallery ) {
		add_theme_support( 'wc-product-gallery-slider' );
	}

	add_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'botiga_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function botiga_woocommerce_scripts() {
	wp_enqueue_style( 'botiga-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.min.css', array(), BOTIGA_VERSION );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'botiga-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'botiga_woocommerce_scripts', 9 );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function botiga_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'botiga_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function botiga_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'botiga_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Layout
 */
function botiga_wc_archive_layout() {

	$archive_sidebar 	= get_theme_mod( 'shop_archive_sidebar', 'no-sidebar' );

	if ( 'no-sidebar' === $archive_sidebar ) {
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}	
	
	$layout = get_theme_mod( 'shop_archive_layout', 'product-grid' );	

	return $archive_sidebar . ' ' . $layout;
}

/**
 * Loop product structure
 */
function botiga_loop_product_structure() {
	$elements 	= get_theme_mod( 'shop_card_elements', array( 'woocommerce_template_loop_product_title', 'woocommerce_template_loop_price' ) );
	$layout		= get_theme_mod( 'shop_product_card_layout', 'layout1' );

	if ( 'layout1' === $layout ) {
		foreach ( $elements as $element ) {
			call_user_func( $element );
		}
	} else {
		$elements = array_diff( $elements, array( 'woocommerce_template_loop_price' ) );

		echo '<div class="row">';
		echo '<div class="col-md-7">';
		foreach ( $elements as $element ) {
			call_user_func( $element );
		}		
		echo '</div>';
		echo '<div class="col-md-5 loop-price-inline">';
			woocommerce_template_loop_price();
		echo '</div>';
		echo '</div>';
	}

}

/**
 * Hook into Woocommerce
 */
function botiga_wc_hooks() {
	$layout = get_theme_mod( 'shop_archive_layout', 'product-grid' );	

	//No sidebar for checkout, cart, account
	if ( is_cart() ) {
		add_filter( 'botiga_content_class', function() { $layout = get_theme_mod( 'shop_cart_layout', 'layout1' ); return 'no-sidebar cart-' . esc_attr( $layout ); } );
		add_filter( 'botiga_sidebar', '__return_false' );
	} elseif ( is_checkout() ) {
		add_filter( 'botiga_content_class', function() { $layout = get_theme_mod( 'shop_checkout_layout', 'layout1' ); return 'no-sidebar checkout-' . esc_attr( $layout ); } );
		add_filter( 'botiga_sidebar', '__return_false' );
	} elseif( is_account_page() ) {
		add_filter( 'botiga_content_class', function() { return 'no-sidebar'; } );
		add_filter( 'botiga_sidebar', '__return_false' );
	}

	//Archive layout
	if ( is_shop() || is_product_category() || is_product_tag()	) {
		add_filter( 'botiga_content_class', 'botiga_wc_archive_layout' );

		if ( 'product-list' === $layout ) {
			add_action( 'woocommerce_before_shop_loop_item', function() { echo '<div class="row valign"><div class="col-md-4">'; }, 1 );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { echo '</div><div class="col-md-8">'; }, 11 );
			add_action( 'woocommerce_after_shop_loop_item', function() { echo '</div>'; }, PHP_INT_MAX );
		}
	}

	//Single product settings
	if ( is_product() ) {
		$single_breadcrumbs = get_theme_mod( 'single_breadcrumbs', 1 );
		$single_tabs		= get_theme_mod( 'single_product_tabs', 1 );
		$single_related		= get_theme_mod( 'single_related_products', 1 );
		$single_upsell		= get_theme_mod( 'single_upsell_products', 1 );

		//Remove sidebar
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
		add_filter( 'botiga_sidebar', '__return_false' );
		add_filter( 'botiga_content_class', function() { return 'no-sidebar'; } );

		//Breadcrumbs
		if ( !$single_breadcrumbs ) {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		}

		//Product tabs
		if ( !$single_tabs ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
		}

		//Related products
		if ( !$single_related ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}	
		
		//Upsell products
		if ( !$single_upsell ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}	
		
		//Move sale tag
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash' );
		add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', -1 );
	}

	//Move cart collaterals
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals' );
	add_action( 'woocommerce_before_cart_collaterals', 'woocommerce_cart_totals' );

	//Results and sorting
	$shop_results_count 	= get_theme_mod( 'shop_results_count', 1 );
	$shop_product_sorting 	= get_theme_mod( 'shop_product_sorting', 1 );

	if ( !$shop_product_sorting ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	}

	if ( !$shop_results_count ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}	

	/**
	 * Loop product structure
	 */
	$button_layout = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );

	//Move link close tag
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 12 );

	if ( 'product-grid' === $layout ) {
		//Wrap loop image
		add_action( 'woocommerce_before_shop_loop_item_title', function() { echo '<div class="loop-image-wrap">'; }, 9 );
		add_action( 'woocommerce_before_shop_loop_item_title', function() { echo '</div>'; }, 11 );

		//Move button inside image wrap
		if ( 'layout4' === $button_layout ) {
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
			add_action( 'woocommerce_before_shop_loop_item_title', function() { botiga_wrap_loop_button_start(); woocommerce_template_loop_add_to_cart(); echo '</div>'; } );
		}
	}

	//Remove product title, rating, price
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title' );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price' );

	//Add elements from sortable option
	add_action( 'woocommerce_after_shop_loop_item', 'botiga_loop_product_structure', 9 );

	//Wrap loop button
	if ( 'layout4' !== $button_layout ) {
		add_action( 'woocommerce_after_shop_loop_item', 'botiga_wrap_loop_button_start', 9 );
		add_action( 'woocommerce_after_shop_loop_item', function() { echo '</div>'; }, 11 );
	}

	//Remove button
	if ( 'layout1' === $button_layout ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
	}

}
add_action( 'wp', 'botiga_wc_hooks' );

/**
 * Wrap loop button
 */
function botiga_wrap_loop_button_start() {
	$button_layout = get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	echo '<div class="loop-button-wrap button-' . esc_attr( $button_layout ) . '">';
}

/**
 * Page header
 */
function botiga_woocommerce_page_header() {
	if ( !is_shop() && !is_product_category() && !is_product_tag() ) {
		return;
	}

	$shop_page_title = get_theme_mod( 'shop_page_title', 1 );

	//Remove elements
	add_filter( 'woocommerce_show_page_title', '__return_false' );
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
	remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' );
	remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' );

	?>
		<header class="woocommerce-page-header">
			<div class="container">
				<?php woocommerce_breadcrumb(); ?>
				<?php if ( ( $shop_page_title && is_shop() ) || !is_shop() ) : ?>
					<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>
				<?php woocommerce_taxonomy_archive_description(); ?>
				<?php woocommerce_product_archive_description(); ?>
			</div>
		</header>
	<?php
}
add_action( 'botiga_page_header', 'botiga_woocommerce_page_header' );

/**
 * Loop product category
 */
function botiga_loop_product_category() {
	echo '<div class="product-category">' . wc_get_product_category_list( get_the_id() ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Loop product description
 */
function botiga_loop_product_description() {
	$content = get_the_excerpt();

	echo wp_kses_post( wp_trim_words( $content, 12, '&hellip;' ) );
}

if ( ! function_exists( 'botiga_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function botiga_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main <?php echo esc_attr( apply_filters( 'botiga_content_class', '' ) ); ?>">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'botiga_woocommerce_wrapper_before' );

if ( ! function_exists( 'botiga_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function botiga_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'botiga_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'botiga_woocommerce_header_cart' ) ) {
			botiga_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'botiga_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function botiga_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		?>

		<span class="cart-count"><i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-cart', true ); ?></i><span class="count-number"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span></span>

		<?php
		$fragments['.cart-count'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'botiga_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'botiga_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function botiga_woocommerce_cart_link() {

		$link = '<a class="cart-contents" href="' . esc_url( wc_get_cart_url() ) . '" title="' . esc_attr__( 'View your shopping cart', 'botiga' ) . '">';
		$link .= '<span class="cart-count"><i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i><span class="count-number">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span></span>';
		$link .= '</a>';

		return $link;
	}
}

if ( ! function_exists( 'botiga_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function botiga_woocommerce_header_cart() {
		$show_cart 		= get_theme_mod( 'enable_header_cart', 1 );
		$show_account 	= get_theme_mod( 'enable_header_account', 1 );

		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>

		<?php if ( $show_account ) : ?>
		<?php echo '<a class="header-item wc-account-link" href="' . esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) . '" title="' . esc_html__( 'Your account', 'botiga' ) . '"><i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-user', false ) . '</i></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>	

		<?php if ( $show_cart ) : ?>
		<div id="site-header-cart" class="site-header-cart header-item">
			<div class="<?php echo esc_attr( $class ); ?>">
				<?php echo botiga_woocommerce_cart_link();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php
			$instance = array(
				'title' => esc_html__( 'Your cart', 'botiga' ),
			);

			the_widget( 'WC_Widget_Cart', $instance );
			?>
		</div>
		<?php endif; ?>
		<?php
	}
}

/**
 * Wrap products results and ordering before
 */
function botiga_wrap_products_results_ordering_before() {
	echo '<div class="woocommerce-sorting-wrapper">';
	echo '<div class="row">';
	echo '<div class="col-md-6 col-6">';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_wrap_products_results_ordering_before', 19 );

/**
 * Add a button to toggle filters on shop archives
 */
function botiga_add_filters_button() {
	echo '</div>';
	echo '<div class="col-md-6 col-6 text-align-right">';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_add_filters_button', 22 );

/**
 * Wrap products results and ordering after
 */
function botiga_wrap_products_results_ordering_after() {
	echo '</div>';
	echo '</div>';
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'botiga_wrap_products_results_ordering_after', 31 );

/**
 * Single product top area wrapper
 */
function botiga_single_product_wrap_before() {
	$single_product_gallery = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	echo '<div class="product-gallery-summary ' . esc_attr( $single_product_gallery ) . '">';
}
add_action( 'woocommerce_before_single_product_summary', 'botiga_single_product_wrap_before', -99 );

/**
 * Single product top area wrapper
 */
function botiga_single_product_wrap_after() {
	echo '</div>';
}
add_action( 'woocommerce_after_single_product_summary', 'botiga_single_product_wrap_after', 9 );

/**
 * Filter single product Flexslider options
 */
function botiga_product_carousel_options( $options ) {

	$layout = get_theme_mod( 'single_product_gallery', 'gallery-default' );

	if ( 'gallery-single' === $layout ) {
		$options['controlNav'] = false;
		$options['directionNav'] = true;
	}

	return $options;
}
add_filter( 'woocommerce_single_product_carousel_options', 'botiga_product_carousel_options' );

/**
 * Checkout wrapper
 */
function botiga_wrap_order_review_before() {
	echo '<div class="checkout-wrapper">';
}
add_action( 'woocommerce_checkout_before_order_review_heading', 'botiga_wrap_order_review_before', 5 );

/**
 * Checkout wrapper end
 */
function botiga_wrap_order_review_after() {
	echo '</div>';
}
add_action( 'woocommerce_checkout_after_order_review', 'botiga_wrap_order_review_after', 15 );

/**
 * Woocommerce tabs titles
 */
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_false' );

/**
 * Loop add to cart
 */
function botiga_filter_loop_add_to_cart( $button, $product, $args ) {
	global $product;

	//Return if not button layout 4
	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$layout 		= get_theme_mod( 'shop_archive_layout', 'product-grid' );	

	if ( 'layout4' !== $button_layout || 'product-grid' !== $layout ) {
		return $button;
	}

	if ( $product->is_type( 'simple' ) ) {
		$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i>';
	} else {
		$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-eye', false ) . '</i>';
	}

	$button = sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		$text
	);

	return $button;
}
add_filter( 'woocommerce_loop_add_to_cart_link', 'botiga_filter_loop_add_to_cart', 10, 3 );

/**
 * Sales badge text
 */
function botiga_sale_badge( $html, $post, $product ) {

	if ( !$product->is_on_sale() ) {
		return;
	}

	$text 			= get_theme_mod( 'sale_badge_text', esc_html__( 'Sale!', 'botiga' ) );
	$enable_perc 	= get_theme_mod( 'sale_badge_percent', 0 );
	$perc_text 		= get_theme_mod( 'sale_percentage_text', '-{value}%' );

	if ( !$enable_perc ) {
		$badge = '<span class="onsale">' . esc_html( $text ) . '</span>';
	} else {
		if ( $product->is_type('variable' ) ) {
			$percentages = array();
			$prices = $product->get_variation_prices();
	  
			foreach( $prices['price'] as $key => $price ){
				if( $prices['regular_price'][$key] !== $price ){
					$percentages[] = round( 100 - ( floatval($prices['sale_price'][$key]) / floatval($prices['regular_price'][$key]) * 100 ) );
				}
			}
			$percentage = max( $percentages );
	  
		} elseif ( $product->is_type('grouped') ) {
			$percentages 	= array();
			$children_ids 	= $product->get_children();
	  
			foreach ( $children_ids as $child_id ) {
				$child_product = wc_get_product($child_id);
	  
				$regular_price = (float) $child_product->get_regular_price();
				$sale_price    = (float) $child_product->get_sale_price();
	  
				if ( $sale_price != 0 || ! empty($sale_price) ) {
					$percentages[] = round(100 - ($sale_price / $regular_price * 100));
				}
			}
			$percentage = max($percentages) ;
		} else {
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();
	  
			if ( $sale_price != 0 || ! empty($sale_price) ) {
				$percentage = round(100 - ($sale_price / $regular_price * 100) );
			} else {
				return $html;
			}
		}

		$perc_text = str_replace( '{value}', $percentage, $perc_text );

		$badge = '<span class="onsale">' . esc_html( $perc_text ) . '</span>';

	}
	
	return $badge;
}
add_filter( 'woocommerce_sale_flash', 'botiga_sale_badge', 10, 3 );

/**
 * Filter Woocommerce blocks
 * replaces default block product structure to allow theme options
 */
function botiga_filter_woocommerce_blocks( $html, $data, $product ){

	global $post;

	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );
	$layout			= get_theme_mod( 'shop_product_card_layout', 'layout1' );

	$markup = "<li class=\"wc-block-grid__product product-grid\">
				<div class=\"loop-image-wrap\">
					<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
						{$data->image}
					</a>"
				. botiga_sale_badge( $html = '', $post, $product );

	//Add button inside image wrapper for layout4
	if ( 'layout4' === $button_layout ) {
		$markup .= "<div class=\"loop-button-wrap button-" . esc_attr( $button_layout ) . "\">"
				. botiga_gb_add_to_cart_button( $product ) .
				"</div>";
	}				

	$markup .= "</div>";
	
	if ( 'layout2' === $layout ) {
		$markup .= "<div class=\"row\">
					<div class=\"col-md-7\">";
	}

	$markup .= "<a href=\"{$data->permalink}\" class=\"wc-block-grid__product-link\">
					{$data->title}
				</a>";
	
	$markup .= "{$data->rating}";

	if ( 'layout1' === $layout ) {
		$markup .= "{$data->price}";
	} else {
		$markup .= "</div><div class=\"col-md-5 loop-price-inline\">
		{$data->price}
		</div>
		</div>";
	}
	
		
	//Add button outside image wrapper		
	if ( 'layout4' !== $button_layout ) {
		$markup .= "<div class=\"loop-button-wrap button-" . esc_attr( $button_layout ) . "\">"
		. botiga_gb_add_to_cart_button( $product ) .
		"</div>";
	}	

	$markup .= "</li>";

	return $markup;
}
add_filter( 'woocommerce_blocks_product_grid_item_html', 'botiga_filter_woocommerce_blocks', 10, 3 );

/**
 * Gutenberg blocks add to cart
 * replaces default add to cart block function to allow theme options
 */
function botiga_gb_add_to_cart_button( $product ) { 

	$button_layout 	= get_theme_mod( 'shop_product_add_to_cart_layout', 'layout3' );

	//Button text
	if ( 'layout4' !== $button_layout ) {
		$text = esc_html( $product->add_to_cart_text() );
	} else {
		if ( $product->is_type( 'simple' ) ) {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-cart', false ) . '</i>';
		} else {
			$text = '<i class="ws-svg-icon">' . botiga_get_svg_icon( 'icon-eye', false ) . '</i>';
		}
	}

	//Start markup
	$markup = '<div class="wp-block-button wc-block-grid__product-add-to-cart">';
	
	$attributes = array(
		'aria-label'       => $product->add_to_cart_description(),
		'data-quantity'    => '1',
		'data-product_id'  => $product->get_id(),
		'data-product_sku' => $product->get_sku(),
		'rel'              => 'nofollow',
		'class'            => 'wp-block-button__link add_to_cart_button',
	);

	if (
		$product->supports( 'ajax_add_to_cart' ) &&
		$product->is_purchasable() &&
		( $product->is_in_stock() || $product->backorders_allowed() )
	) {
		$attributes['class'] .= ' ajax_add_to_cart';
	}

	$markup .= sprintf(
		'<a href="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		wc_implode_html_attributes( $attributes ),
		$text
	);	
	
	$markup .= '</div>';

	return $markup;
}