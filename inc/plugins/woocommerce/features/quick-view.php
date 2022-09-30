<?php
/**
 * Quick View
 *
 * @package Botiga
 */

/**
 * Enqueue quick view scripts 
 */
function botiga_quick_view_scripts() {

    //Enqueue gallery scripts for quick view
	$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
	
	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() || botiga_page_has_woo_blocks() || is_cart() || is_404() || $shop_cart_show_cross_sell ) {
		$quick_view_layout = get_theme_mod( 'shop_product_quickview_layout', 'layout1' );
		
		if( 'layout1' !== $quick_view_layout ) {
			$register_scripts = array();
			
			if ( current_theme_supports( 'wc-product-gallery-slider' ) ) {
				$register_scripts['flexslider'] = array(
					'src'     => plugins_url( 'assets/js/flexslider/jquery.flexslider.min.js', WC_PLUGIN_FILE ),
					'deps'    => array( 'jquery' )
				);
			}
			if ( current_theme_supports( 'wc-product-gallery-lightbox' ) ) {
				$register_styles = array(
					'photoswipe' => array(
						'src'     => plugins_url( 'assets/css/photoswipe/photoswipe.min.css', WC_PLUGIN_FILE ),
						'deps'    => array()
					),
					'photoswipe-default-skin' => array(
						'src'     => plugins_url( 'assets/css/photoswipe/default-skin/default-skin.min.css', WC_PLUGIN_FILE ),
						'deps'    => array( 'photoswipe' )
					)
				);
				foreach ( $register_styles as $name => $props ) {
					wp_enqueue_style( $name, $props['src'], $props['deps'], BOTIGA_VERSION );
				}

				$register_scripts['photoswipe'] = array(
					'src'     => plugins_url( 'assets/js/photoswipe/photoswipe.min.js', WC_PLUGIN_FILE ),
					'deps'    => array()
				);
				$register_scripts['photoswipe-ui-default'] = array(
					'src'     => plugins_url( 'assets/js/photoswipe/photoswipe-ui-default.min.js', WC_PLUGIN_FILE ),
					'deps'    => array( 'photoswipe' )
				);
			}

			$register_scripts['wc-single-product'] = array(
				'src'     => plugins_url( 'assets/js/frontend/single-product.min.js', WC_PLUGIN_FILE ),
				'deps'    => array( 'jquery' )
			);

			if ( current_theme_supports( 'wc-product-gallery-zoom' ) ) {
				$register_scripts['zoom'] = array(
					'src'     => plugins_url( 'assets/js/zoom/jquery.zoom.min.js', WC_PLUGIN_FILE ),
					'deps'    => array( 'jquery' )
				);
			}

			// Enqueue variation scripts.
			$register_scripts['wc-add-to-cart-variation'] = array(
				'src'     => plugins_url( 'assets/js/frontend/add-to-cart-variation.min.js', WC_PLUGIN_FILE ),
				'deps'    => array( 'jquery', 'wp-util', 'jquery-blockui' )
			);

			foreach ( $register_scripts as $name => $props ) {
				wp_enqueue_script( $name, $props['src'], $props['deps'], BOTIGA_VERSION );
			}

		}
	}
}
add_action( 'wp_enqueue_scripts', 'botiga_quick_view_scripts', 9 );

/**
 * Quick view button
 */
function botiga_quick_view_button( $product = false, $echo = true ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id        = $product->get_id(); 
	$quick_view_layout = get_theme_mod( 'shop_product_quickview_layout', 'layout1' ); 
	if( 'layout1' == $quick_view_layout ) {
		return '';
	} 
	
	if( $echo == false ) {
		ob_start();
	} ?>

	<a href="#" class="button botiga-quick-view-show-on-hover botiga-quick-view botiga-quick-view-<?php echo esc_attr( $quick_view_layout ); ?>" aria-label="<?php /* translators: %s: quick view product title */ echo esc_attr( sprintf( __( 'Quick view the %s product', 'botiga' ), get_the_title( $product_id ) ) ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'botiga-qview-nonce' ) ); ?>">
		<?php esc_html_e( 'Quick View', 'botiga' ); ?>
	</a>
	<?php
	if( $echo == false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Quick view popup
 */
function botiga_quick_view_popup() { ?>
	<div class="single-product botiga-quick-view-popup">
		<div class="botiga-quick-view-loader">
			<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 512 512" aria-hidden="true" focusable="false">
				<path fill="#FFF" d="M288 39.056v16.659c0 10.804 7.281 20.159 17.686 23.066C383.204 100.434 440 171.518 440 256c0 101.689-82.295 184-184 184-101.689 0-184-82.295-184-184 0-84.47 56.786-155.564 134.312-177.219C216.719 75.874 224 66.517 224 55.712V39.064c0-15.709-14.834-27.153-30.046-23.234C86.603 43.482 7.394 141.206 8.003 257.332c.72 137.052 111.477 246.956 248.531 246.667C393.255 503.711 504 392.788 504 256c0-115.633-79.14-212.779-186.211-240.236C302.678 11.889 288 23.456 288 39.056z" />
			</svg>
		</div>
		<div class="botiga-quick-view-popup-content">
			<a href="#" class="botiga-quick-view-popup-close-button" title="<?php echo esc_attr__( 'Close quick view popup', 'botiga' ); ?>">
				<i class="ws-svg-icon"><?php botiga_get_svg_icon( 'icon-cancel', true ); ?></i>
			</a>
			<div class="botiga-quick-view-popup-content-ajax"></div>
		</div>
	</div>
	
	<?php
}

/**
 * Quick view add to cart wrapper
 */
add_action( 'botiga_quick_view_before_add_to_cart_button', 'botiga_single_addtocart_wrapper_open' );
add_action( 'botiga_quick_view_after_add_to_cart_button', 'botiga_single_addtocart_wrapper_close' );

/**
 * Quick view ajax callback
 */
function botiga_quick_view_content_callback_function() {
	check_ajax_referer( 'botiga-qview-nonce', 'nonce' );
	
	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	$args = array(
		'product_id' => absint( $_POST['product_id'] )
	);
	
	botiga_get_template_part( 'template-parts/content', 'quick-view', $args );
	
	wp_die();
}
add_action( 'wp_ajax_botiga_quick_view_content', 'botiga_quick_view_content_callback_function' );
add_action( 'wp_ajax_nopriv_botiga_quick_view_content', 'botiga_quick_view_content_callback_function' );

/**
 * Quick View Summary Title
 */
function botiga_quick_view_summary_title( $product = null ) { ?>
	<?php do_action( 'botiga_quick_view_product_title_start' ); ?>
	<h2 class="product_title entry-title">
		<?php echo esc_html( get_the_title( $product->get_id() ) ); ?>
	</h2>
	<?php do_action( 'botiga_quick_view_product_title_end' ); ?>
<?php
}

/**
 * Quick View Summary Rating
 */
function botiga_quick_view_summary_rating( $product = null ) { ?>
	<?php do_action( 'botiga_quick_view_product_rating_start' ); ?>
	<?php if ( wc_review_ratings_enabled() ) :
		$product_id   = $product->get_id();
		$rating_count = $product->get_rating_count();
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();

		if ( $rating_count > 0 ) : ?>

			<div class="woocommerce-product-rating">
				<?php echo wc_get_rating_html( $average, $rating_count ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<?php if ( comments_open( $product_id ) ) : ?>
					<a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>#reviews" class="woocommerce-review-link" rel="nofollow">(<?php /* translators: %s: customer review text */ printf( _n( '%s customer review', '%s customer reviews', $review_count, 'botiga' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>)</a>
				<?php endif ?>
			</div>

		<?php endif; ?>
	<?php endif; ?>
	<?php do_action( 'botiga_quick_view_product_rating_end' ); ?>
<?php
}

/**
 * Quick View Summary Price
 */
function botiga_quick_view_summary_price( $product = null ) { ?>
	<?php do_action( 'botiga_quick_view_product_price_start' ); ?>
	<p class="<?php echo esc_attr( apply_filters( 'botiga_quick_view_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
	<?php do_action( 'botiga_quick_view_product_price_end' ); ?>
<?php
}

/**
 * Quick View Summary Description
 */
function botiga_quick_view_summary_excerpt( $product = null ) {
	$short_description = apply_filters( 'botiga_quick_view_short_description', $product->get_short_description() );
	if ( $short_description ) : ?>
		<?php do_action( 'botiga_quick_view_product_excerpt_start' ); ?>
		<div class="woocommerce-product-details__short-description">
			<p><?php echo wp_kses_post( $short_description ); ?></p>
		</div>
		<?php do_action( 'botiga_quick_view_product_excerpt_end' ); ?>
	<?php endif; ?>
<?php
}

/**
 * Quick View Summary Add To Cart
 */
function botiga_quick_view_summary_add_to_cart( $product = null ) {
	do_action( 'botiga_quick_view_product_add_to_cart_start' );
	switch ( $product->get_type() ) {
		case 'grouped':
			botiga_grouped_add_to_cart( $product, 'quick_view' );
			break;
		
		case 'variable':
			botiga_variable_add_to_cart( $product, 'quick_view' );
			break;

		case 'external':
			botiga_external_add_to_cart( $product, 'quick_view' );
			break;
		
		default:
			botiga_simple_add_to_cart( $product, 'quick_view' );
			break;
	}
	do_action( 'botiga_quick_view_product_add_to_cart_end' );
}

/**
 * Quick View Summary Wishlist
 */
function botiga_quick_view_summary_wishlist( $product = null ) {
	$wishlist_layout = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' );
	if( 'layout1' !== $wishlist_layout ) {
		botiga_single_wishlist_button( $product, true );
	}
}

/**
 * Quick View Summary Meta
 */
function botiga_quick_view_summary_meta( $product = null ) { ?>
	<div class="product_meta">
		<?php do_action( 'botiga_quick_view_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

			<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'botiga' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? esc_html( $sku ) : esc_html__( 'N/A', 'botiga' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>

		<?php endif; ?>

		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'botiga' ) . ' ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'botiga' ) . ' ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

		<?php do_action( 'botiga_quick_view_product_meta_end' ); ?>
	</div>
<?php
}

/**
 * Quick View Summary Share
 */
function botiga_quick_view_summary_share( $product = null ) { ?>
	<p class="<?php echo esc_attr( apply_filters( 'botiga_quick_view_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
<?php
}