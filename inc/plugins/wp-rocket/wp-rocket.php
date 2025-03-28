<?php

/**
 * WP Rocket compatibility file.
 * 
 * @package Botiga
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'WP_ROCKET_VERSION' ) ) {
    return;
}

class Botiga_WP_Rocket {

    /**
     * Used CSS parameters.
     * 
     * @var array
     */
    protected static $used_css_params = array(
        'rocket_rucss_safelist' => array(
            // '/path/to/safelisted.css',   // safelist everything in this file
            // '.classname',   // a class indicated by leading dott
            // '#idname',   // an id indicated by leading hash
            // 'h1',   // any valid html tag
            // '[title]',   // an attribute indicated by enclosed square brackets
            // '#id-(.*)',   // matches #id-1213ab3, #id-anythingyouwant, etc
            // '.class(.*)me',   // matches .class123me, .classClassyme, etc
            // '#id.classname',   // invalid, two things in the same entry -- will be ignored
            // '[title="image-title"]',   // invalid, only attributes are considered -- will be ignored
		),
        'rocket_rucss_external_exclusions' => array(
            // '/wp-content/plugins/plugin-name/css/file.css',
        ),
        'rocket_rucss_inline_content_exclusions' => array(
            // '.col-lg-6',
        ),
        'rocket_rucss_inline_atts_exclusions' => array(
            // 'data-example-1',
            // 'data-example-2="the-value"',
            // "data-example-3='the-value'",
        ),
        'rocket_rucss_skip_styles_with_attr' => array(
            // 'data-example-1',
            // 'data-example-2="the-value"',
            // "data-example-3='the-value'",
        ),
        'prepend_css' => array(
            // '.new_css{background:red;}',
        ),
        'append_css' => array(
            // '.new_css{background:red;}',
        ),
        'filter_css' => array(
            // '.to-be-removed{padding:10px};'
            // =>
            // '.to-be-inserted{padding:20px};',
        ),
    );

    /**
     * Theme areas selectors.
     * 
     * @var array
     */
    protected static $theme_areas_selectors = array(
        'single-product-gallery' => array(
            '.product-gallery-summary.gallery-full-width .woocommerce-product-gallery .flex-control-thumbs.botiga-slides',
            '.product-gallery-summary.gallery-showcase',
            '.product-gallery-summary.gallery-showcase .flex-control-thumbs:not(.botiga-slides)',
            '.product-gallery-summary.gallery-grid .woocommerce-product-gallery__wrapper',
            '.product-gallery-summary.gallery-scrolling .woocommerce-product-gallery__wrapper',
            '.product-gallery-summary.gallery-grid .woocommerce-product-gallery__wrapper>div',
            '.product-gallery-summary.gallery-scrolling .woocommerce-product-gallery__wrapper>div',
            '.product-gallery-summary.gallery-grid .woocommerce-product-gallery__wrapper>div:not(:first-child)',
            '.product-gallery-summary.gallery-scrolling .woocommerce-product-gallery__wrapper>div:not(:first-child)',
            '.product-gallery-summary.gallery-grid .woocommerce-product-gallery__wrapper>div+div',
            '.product-gallery-summary.gallery-grid .woocommerce-product-gallery__wrapper>div+.onsale+div',
            '.product-gallery-summary.gallery-scrolling .woocommerce-product-gallery__wrapper>div+div',
            '.product-gallery-summary.gallery-scrolling .woocommerce-product-gallery__wrapper>div+.onsale+div',
            '.product-gallery-summary.gallery-grid .woocommerce-product-gallery__wrapper>div a:hover img',
            '.product-gallery-summary.gallery-scrolling .woocommerce-product-gallery__wrapper>div a:hover img',
            '.product-gallery-summary.gallery-grid .woocommerce-product-gallery__wrapper>div a img',
            '.product-gallery-summary.gallery-scrolling .woocommerce-product-gallery__wrapper>div a img',
            '.single-product div.product',
            '.single-product div.product .woocommerce-product-gallery',
            '.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger',
            '.single-product div.product .woocommerce-product-gallery .flex-control-thumbs',
            '.single-product div.product .woocommerce-product-gallery .flex-control-thumbs:not(.botiga-slides)',
            '.single-product div.product .woocommerce-product-gallery .flex-control-thumbs li',
            '.single-product div.product .woocommerce-product-gallery .flex-control-thumbs li img',
            '.single-product div.product .woocommerce-product-gallery .flex-control-thumbs li img:hover',
            '.single-product div.product .woocommerce-product-gallery .flex-control-thumbs li img.flex-active',
            '.single-product div.product.sold-individually form.cart .quantity',
            '.single-product div.product.has-only-one-instock form.cart .quantity',
            '.single-product.no-single-breadcrumbs .gallery-showcase',
            '.single-product.no-single-breadcrumbs .gallery-full-width',
            '.single-product div.product .gallery-vertical .woocommerce-product-gallery',
            '.single-product div.product .gallery-showcase .woocommerce-product-gallery',
            '.single-product div.product .gallery-vertical .flex-viewport',
            '.single-product div.product .gallery-showcase .flex-viewport',
            '.single-product div.product .gallery-vertical .flex-control-thumbs',
            '.single-product div.product .gallery-showcase .flex-control-thumbs',
            '.single-product div.product .gallery-vertical .flex-control-thumbs li',
            '.single-product div.product .gallery-showcase .flex-control-thumbs li',
            '.single-product div.product .gallery-vertical .flex-control-thumbs li.swiper-slide',
            '.single-product div.product .gallery-showcase .flex-control-thumbs li.swiper-slide',
            '.single-product div.product .gallery-vertical .flex-nav-prev',
            '.single-product div.product .gallery-showcase .flex-nav-prev',
            '.single-product div.product .gallery-vertical .flex-nav-next',
            '.single-product div.product .gallery-showcase .flex-nav-next',
            '.single-product div.product .gallery-showcase',
            '.single-product div.product .gallery-showcase .entry-summary',
            '.single-product div.product .gallery-showcase .swiper-vertical',
            '.botiga-swiper',
            '.botiga-swiper.swiper-vertical .swiper-wrapper',
            '.botiga-swiper.swiper-backface-hidden .swiper-slide',
            '.botiga-swiper .swiper-wrapper',
            '.botiga-swiper .swiper-pointer-events',
            '.botiga-swiper .swiper-pointer-events.swiper-vertical',
            '.botiga-swiper .swiper-slide',
            '.botiga-swiper .swiper-slide img',
            '.botiga-swiper-button',
            '.botiga-swiper-button:before',
            '.botiga-swiper-button:focus',
            '.botiga-swiper-button:active',
            '.botiga-swiper-button.swiper-button-disabled',
            '.botiga-swiper-button.swiper-button-lock',
            '.botiga-swiper-button-prev',
            '.botiga-swiper-button-prev:before',
            '.botiga-swiper-button-next',
            '.botiga-swiper-button-next:before',
            '.swiper-vertical',
            '.swiper-vertical .botiga-swiper-button',
            '.swiper-vertical .botiga-swiper-button-prev',
            '.swiper-vertical .botiga-swiper-button-prev:before',
            '.swiper-vertical .botiga-swiper-button-next',
            '.swiper-vertical .botiga-swiper-button-next:before',
            '.swiper-horizontal',
        ),
        'star-rating-wrapper' => array(
            '.woocommerce-product-rating .star-rating', 
            '.comment_container .star-rating', 
            '.woocommerce-product-rating', 
            '.woocommerce-product-rating .woocommerce-review-link', 
        ),
        'variation-swatches' => array(
            '.botiga-ptitle-variation-name',
            '.single-product .variations select',
            'ul.products li.product .variations select',
            '.botiga_widget_product_swatch_filter .variations select',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-color>a',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-color',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-color > a',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-color > a:hover',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-color > a.active',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-color>a',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-color',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-color > a',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-color > a:hover',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-color > a.active',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-color>a',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-color',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-color > a',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-color > a:hover',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-color > a.active',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-button',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-button > a',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-button > a:hover',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-button > a.active',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-button',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-button > a',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-button > a:hover',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-button > a.active',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-button',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-button > a',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-button > a:hover',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-button > a.active',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-select',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-select > a',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-select > a:hover',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-select > a.active',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-image>a',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-image',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-image > a',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-image > a:hover',
            '.single-product .botiga-variations-wrapper .botiga-variation-type-image > a.active',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-image>a',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-image',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-image > a',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-image > a:hover',
            'ul.products li.product .botiga-variations-wrapper .botiga-variation-type-image > a.active',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-image>a',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-image',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-image > a',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-image > a:hover',
            '.botiga_widget_product_swatch_filter .botiga-variations-wrapper .botiga-variation-type-image > a.active',
            '.botiga-variations-wrapper select',
            '.botiga-variations-wrapper .botiga-variation-type-image',
            '.botiga-variations-wrapper .botiga-variation-type-image>a',
            '.botiga-variations-wrapper .botiga-variation-type-image>a>span',
            '.botiga-variations-wrapper .botiga-variation-type-image>a:hover',
            '.botiga-variations-wrapper .botiga-variation-type-image>a.active',
            '.botiga-variations-wrapper .botiga-variation-type-color',
            '.botiga-variations-wrapper .botiga-variation-type-color>a',
            '.botiga-variations-wrapper .botiga-variation-type-color>a>span',
            '.botiga-variations-wrapper .botiga-variation-type-color>a:hover',
            '.botiga-variations-wrapper .botiga-variation-type-color>a.active',
            '.botiga-variations-wrapper .botiga-variation-type-button',
            '.botiga-variations-wrapper .botiga-variation-type-button>a',
            '.botiga-variations-wrapper .botiga-variation-type-button>a:hover',
            '.botiga-variations-wrapper .botiga-variation-type-button>a.active',
            '.botiga-variations-wrapper .botiga-variation-type-select',
            '.botiga-variations-wrapper .botiga-variation-type-select>a',
            '.botiga-variations-wrapper .botiga-variation-type-select>a:hover',
            '.botiga-variations-wrapper .botiga-variation-type-select>a.active',
            '.botiga-variations-wrapper .botiga-variation-tooltip',
            '.botiga-product-swatches',
            '.botiga-product-swatches .woocommerce-variation-price',
            '.botiga-product-swatches .woocommerce-variation-description',
            '.botiga-product-swatches .woocommerce-variation-availability p',
            '.botiga-product-swatches .botiga-variations-wrapper',
            '.botiga-product-swatches table.variations',
            '.botiga-product-swatches table.variations th.label',
        ),
        'product-video-and-audio' => array(
            '.botiga-video-ratio',
            '.botiga-video-ratio embed',
            '.botiga-video-ratio audio',
            '.botiga-video-ratio video',
            '.botiga-video-ratio iframe',
            '.botiga-video-ratio video[poster]',
            '.botiga-video-ratio-16-9',
            '.botiga-video-ratio-9-16',
            '.botiga-video-ratio-4-3',
            '.botiga-video-ratio-3-2',
            '.botiga-video-ratio-1-1',
            '.botiga-video-ratio-auto embed',
            '.botiga-video-ratio-auto audio',
            '.botiga-video-ratio-auto video',
            '.botiga-video-ratio-auto iframe',
            '.botiga-product-video+.loop-image-wrap',
            '.botiga-product-video+.woocommerce-loop-product__link',
            '.botiga-product-audio+.loop-image-wrap',
            '.botiga-product-audio+.woocommerce-loop-product__link',
            '.botiga-product-audio audio',
            '.botiga-product-video-gallery .onsale',
            '.botiga-product-video-gallery.active-slide-has-video .woocommerce-product-gallery__trigger',
            '.botiga-flex-video-thumb',
            '.botiga-flex-video-thumb:after',
            '.botiga-flex-video-thumb:before',
            '.botiga-flex-video-thumb:before',
            '.botiga-flex-video-thumb:after',
        ),
        'product-filter' => array(
            '.botiga_widget_product_swatch_active_filter:empty',
            '.botiga_widget_product_swatch_active_filter ul',
            '.botiga_widget_product_swatch_active_filter ul li',
            '.botiga_widget_product_swatch_active_filter ul li:last-child',
            '.botiga_widget_product_swatch_active_filter ul li:last-child a:hover',
            '.botiga_widget_product_swatch_active_filter ul li strong',
            '.botiga_widget_product_swatch_active_filter ul li a:not(.botiga-clear)',
            '.botiga_widget_product_swatch_active_filter ul li a:not(.botiga-clear):hover',
            '.botiga_widget_product_swatch_active_filter ul li a:not(.botiga-clear):after',
            '.botiga_widget_product_swatch_active_filter ul li a:not(.botiga-clear):before',
            '.botiga_widget_product_swatch_active_filter.horizontal-style ul',
            '.botiga_widget_product_swatch_active_filter.horizontal-style ul li',
            '.botiga_widget_product_swatch_active_filter.horizontal-style ul li a',
            '.botiga_widget_product_swatch_active_filter.horizontal-style ul li:last-of-type',
        ),
        'real-time-search' => array(
            '.botiga-ajax-search',
            '.botiga-ajax-search-products',
            '.botiga-ajax-search-products::-webkit-scrollbar',
            '.botiga-ajax-search-products::-webkit-scrollbar-track',
            '.botiga-ajax-search-products::-webkit-scrollbar-thumb',
            '.botiga-ajax-search-products.has-scrollbar',
            '.botiga-ajax-search-products + .botiga-ajax-search__heading-title',
            '.botiga-ajax-search__heading-title',
            '.botiga-ajax-search__divider',
            '.botiga-ajax-search__wrapper',
            '.botiga-ajax-search__wrapper.reverse',
            '.botiga-ajax-search__item',
            '.botiga-ajax-search__item:hover',
            '.botiga-ajax-search__item + .botiga-ajax-search__item',
            '.botiga-ajax-search__item + .botiga-ajax-search__item:before',
            '.botiga-ajax-search__item-image',
            '.botiga-ajax-search__item-info',
            '.botiga-ajax-search__item-info h3',
            '.botiga-ajax-search__item-info h3 + p',
            '.botiga-ajax-search__item-info p',
            '.botiga-ajax-search__item-price',
            '.botiga-ajax-search__item-price .woocommerce-Price-amount',
            '.botiga-ajax-search__item-price ins',
            '.botiga-ajax-search__item-price del',
            '.botiga-ajax-search__item-price del .woocommerce-Price-amount',
            '.botiga-ajax-search__see-all',
            '.botiga-ajax-search__see-all .bas-arrow',
            '.botiga-ajax-search__see-all:hover .bas-arrow',
            '.botiga-ajax-search-categories',
            '.botiga-ajax-search__item-category',
            '.botiga-ajax-search__item-category:before',
            '.botiga-ajax-search__item-category .botiga-ajax-search__item-info h3',
            '.botiga-ajax-search__no-results',
            '.botiga-ajax-search__wrapper',
            '.botiga-ajax-search__item-image',
            '.botiga-ajax-search__wrapper',
        ),
    );

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        $has_quick_view = get_theme_mod( 'shop_product_quickview_layout', 'layout1' ) !== 'layout1';
        $has_wishlist = class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'wishlist' ) ? true : false; 
        $has_variation_swatches = class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'product-swatches' ) ? true : false;
        $has_add_to_cart_notifications = class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'add-to-cart-notifications' ) ? true : false;
        $has_video_gallery = class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'video-gallery' ) ? true : false;
        $has_side_cart = get_theme_mod( 'mini_cart_style', 'default' ) === 'side' ? true : false;
        $has_floating_mini_cart_icon = get_theme_mod( 'side_mini_cart_floating_icon', 0 ) ? true : false;
        $has_grid_list_view = get_theme_mod( 'shop_grid_list_view', 0 ) ? true : false;
        $has_product_filter = class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'shop-filters' ) ? true : false;
        $has_real_time_search = get_theme_mod( 'shop_search_enable_ajax', 0 ) ? true : false;
        $has_free_shipping_progress_bar = class_exists( 'Botiga_Modules' ) && Botiga_Modules::is_module_active( 'free-shipping-progress-bar' );

        // Product Filter.
        if ( $has_product_filter ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '/plugins/botiga-pro/assets/css/modules/shop-filters/shop-filters.css';
            self::$used_css_params['rocket_rucss_safelist'][] = '/plugins/botiga-pro/assets/css/modules/shop-filters/shop-filters.min.css';

            foreach( self::$theme_areas_selectors as $theme_area => $selectors ) {
                if ( $theme_area === 'product-filter' ) {
                    self::$used_css_params['rocket_rucss_safelist'] = array_merge( self::$used_css_params['rocket_rucss_safelist'], $selectors );
                }
            }
        }

        // Grid List View.
        if ( $has_grid_list_view ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '.col-md-4';
            self::$used_css_params['rocket_rucss_safelist'][] = '.col-md-8';
            self::$used_css_params['rocket_rucss_safelist'][] = '.row';
            self::$used_css_params['rocket_rucss_safelist'][] = '.valign';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list ul.products';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list ul.products li.product';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list ul.products li.product .loop-image-wrap';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list ul.products li.product .loop-button-wrap.button-layout4';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list ul.products li.product:hover .loop-button-wrap.button-layout4';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list ul.products li.product .row .col-md-8';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list .wc-block-grid__product-onsale';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-list span.onsale';
        }

        // Quick view.
        if ( $has_quick_view ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '.col-lg-6';
            self::$used_css_params['rocket_rucss_safelist'][] = '/themes/botiga/assets/css/quick-view.css';
            self::$used_css_params['rocket_rucss_safelist'][] = '/themes/botiga/assets/css/quick-view.min.css';

            self::$used_css_params['rocket_rucss_safelist'][] = '.quantity';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-quantity(.*)';

            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-reasons-list(.*)';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-trust-badge(.*)';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-gallery-summary .botiga-trust-badge-wrapper+div.botiga-trust-badge-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-gallery-summary .botiga-reasons-list+div.botiga-trust-badge-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-product-brand-image';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-gallery-summary .botiga-trust-badge-wrapper+div';
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-gallery-summary .botiga-reasons-list+div';
            
            self::$used_css_params['rocket_rucss_safelist'][] = '.product-gallery-summary .woocommerce-product-rating';
            self::$used_css_params['rocket_rucss_safelist'][] = '.woocommerce-product-rating';
            self::$used_css_params['rocket_rucss_safelist'][] = '.woocommerce-product-rating .star-rating, .comment_container .star-rating';
            self::$used_css_params['rocket_rucss_safelist'][] = '.star-rating';
            self::$used_css_params['rocket_rucss_safelist'][] = '.star-rating span';
            self::$used_css_params['rocket_rucss_safelist'][] = '.woocommerce-product-rating .woocommerce-review-link';

            foreach( self::$theme_areas_selectors as $theme_area => $selectors ) {
                if ( $theme_area === 'single-product-gallery' ) {
                    self::$used_css_params['rocket_rucss_safelist'] = array_merge( self::$used_css_params['rocket_rucss_safelist'], $selectors );
                }

                if ( $theme_area === 'star-rating-wrapper' ) {
                    self::$used_css_params['rocket_rucss_safelist'] = array_merge( self::$used_css_params['rocket_rucss_safelist'], $selectors );
                }

                if ( $has_variation_swatches && $theme_area === 'variation-swatches' ) {
                    self::$used_css_params['rocket_rucss_safelist'] = array_merge( self::$used_css_params['rocket_rucss_safelist'], $selectors );
                }

                if ( $has_video_gallery && $theme_area === 'product-video-and-audio' ) {
                    self::$used_css_params['rocket_rucss_safelist'] = array_merge( self::$used_css_params['rocket_rucss_safelist'], $selectors );
                }
            }
        }

        // Wishlist.
        if ( $has_wishlist ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '/plugins/botiga-pro/assets/css/botiga-wishlist.css';
            self::$used_css_params['rocket_rucss_safelist'][] = '/plugins/botiga-pro/assets/css/botiga-wishlist.min.css';
        }

        // Add to cart notifications.
        if ( $has_add_to_cart_notifications ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '/plugins/botiga-pro/assets/css/botiga-add-to-cart-notifications.css';            
            self::$used_css_params['rocket_rucss_safelist'][] = '/plugins/botiga-pro/assets/css/botiga-add-to-cart-notifications.min.css';            
        }

        // Side cart.
        if ( $has_side_cart ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-side-mini-cart .botiga-side-mini-cart-empty';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-side-mini-cart .botiga-side-mini-cart-empty .icon svg';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-side-mini-cart .botiga-side-mini-cart-empty .button';
        }

        // Floating mini cart icon.
        if ( $has_floating_mini_cart_icon ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-floating-mini-cart-icon(.*)';
        }

        // Real time search.
        if ( $has_real_time_search ) {
            foreach( self::$theme_areas_selectors as $theme_area => $selectors ) {
                if ( $theme_area === 'real-time-search' ) {
                    self::$used_css_params['rocket_rucss_safelist'] = array_merge( self::$used_css_params['rocket_rucss_safelist'], $selectors );
                }
            }
        }

        // Free shipping progress bar.
        if ( $has_free_shipping_progress_bar ) {
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-sc-form .botiga-freespb-row-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.merchant-pro-sc-form .botiga-freespb-row-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-freespb-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-freespb-text';
            self::$used_css_params['rocket_rucss_safelist'][] = '.widget_shopping_cart .botiga-freespb-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.widget_shopping_cart .botiga-freespb-text';
            self::$used_css_params['rocket_rucss_safelist'][] = '.admin-bar .botiga-side-mini-cart .widget_shopping_cart_content';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-side-mini-cart .widget_shopping_cart_content';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-side-mini-cart .widget_shopping_cart_content .botiga-freespb-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-side-mini-cart .widget_shopping_cart_content .botiga-freespb-wrapper + p:empty';
            self::$used_css_params['rocket_rucss_safelist'][] = '.widget_shopping_cart .botiga-freespb-wrapper';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-freespb-text';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-freespb-progress-bar';
            self::$used_css_params['rocket_rucss_safelist'][] = '.botiga-freespb-progress-bar-inner';
        }

        // RUCSS safelist.
        add_filter( 'rocket_rucss_safelist', array( $this, 'exclusions' ) );

        // Exclude external stylesheets from being removed by WP Rocket's Remove Unused CSS optimization.
        add_filter( 'rocket_rucss_external_exclusions', array( $this, 'exclusions' ) );

        // Exclude inline styles from being removed by WP Rocket's Remove Unused CSS optimization.
        add_filter( 'rocket_rucss_inline_content_exclusions', array( $this, 'exclusions' ) );

        // Exclude inline styles from being removed by WP Rocket's Remove Unused CSS optimization.
        add_filter( 'rocket_rucss_inline_atts_exclusions', array( $this, 'exclusions' ) );

        // Completely remove styles with target attributes from page.
        add_filter( 'rocket_rucss_skip_styles_with_attr', array( $this, 'exclusions' ) );

        // Filter the CSS for prepend, append and filter.
        add_filter( 'rocket_usedcss_content', array( $this, 'filter_css' ) );
    }

    /**
     * Exclusions.
     * 
     * @param array $exclusions
     * @return array
     */
    public static function exclusions( $exclusions = array() ) {
        $current_filter = current_filter();

        if ( empty( self::$used_css_params[$current_filter] ) ) {
            return $exclusions;
        }

        foreach ( self::$used_css_params[$current_filter] as $exclusion ) {
            $exclusions[] = $exclusion;
        }

        

        return $exclusions;
    }

    /**
     * Filter CSS.
     * 
     * @param string $css
     * @return string
     */
    public static function filter_css( $css ) {
        if ( ! empty( self::$used_css_params['prepend_css'] ) ) {
            foreach ( self::$used_css_params['prepend_css'] as $prepend_css ) {
                $css = $prepend_css . $css;
            }
        }
      
        if ( ! empty( self::$used_css_params['append_css'] ) ) {
            foreach ( self::$used_css_params['append_css'] as $append_css ) {
                $css = $css . $append_css;
            }
        }
      
        if ( ! empty( self::$used_css_params['filter_css'] ) ) {
            foreach ( self::$used_css_params['filter_css'] as $to_be_removed => $to_be_inserted ) {
                $css = str_replace( $to_be_removed, $to_be_inserted, $css );
            }
        }
      
        return $css;
    }
}

new Botiga_WP_Rocket();