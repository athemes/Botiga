"use strict";

/* global wp, jQuery */

/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
(function ($) {
  // Site title and description.
  wp.customize('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  });
  wp.customize('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  }); // Header text color.

  wp.customize('header_textcolor', function (value) {
    value.bind(function (to) {
      if ('blank' === to) {
        $('.site-title, .site-description').css({
          clip: 'rect(1px, 1px, 1px, 1px)',
          position: 'absolute'
        });
      } else {
        $('.site-title, .site-description').css({
          clip: 'auto',
          position: 'relative'
        });
        $('.site-title a, .site-description').css({
          color: to
        });
      }
    });
  }); //Background colors

  var $bg_color_options = {
    "main_header_submenu_background": ".main-navigation ul ul li, .main-navigation ul ul li, .header-login-register nav, .top-bar-login-register nav",
    "background_color": ".wc_payment_methods,.site-header-cart .widget_shopping_cart, .botiga-popup-wrapper",
    "content_cards_background": ".checkout_coupon,.woocommerce-checkout .woocommerce-form-login,.woocommerce-account .botiga-wc-account-view-order+.woocommerce-notices-wrapper+p,.shop_table.order_details, .shop_table.woocommerce-MyAccount-orders,.botiga-quick-view-popup .botiga-quick-view-popup-content,.woocommerce-message, .woocommerce-info, .woocommerce-error, .woocommerce-noreviews, p.no-comments,.comments-area,.woocommerce-cart .cart_totals,.checkout-wrapper .woocommerce-checkout-review-order,.woocommerce-info, .woocommerce-noreviews, p.no-comments,.site-header-cart .widget_shopping_cart .woocommerce-mini-cart__total, .site-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons,.woocommerce-account.logged-in .entry-content>.woocommerce .woocommerce-MyAccount-navigation ul .is-active a,.sidebar-top+.widget-area .sidebar-wrapper,.woocommerce-Reviews #comments .review .comment_container .comment-text .description, .woocommerce-Reviews #review_form_wrapper,.botiga-mstepc-wrapper .woocommerce-billing-fields__field-wrapper, .botiga-mstepc-wrapper .woocommerce-shipping-fields__field-wrapper, .botiga-mstepc-wrapper .woocommerce-account-fields, .botiga-mstepc-wrapper .woocommerce-additional-fields__field-wrapper, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item .step, .botiga-mstepc-wrapper .botiga-mstep-order-review",
    "color_forms_background": "input[type=\"text\"],input[type=\"email\"],input[type=\"url\"],input[type=\"password\"],input[type=\"search\"],input[type=\"number\"],input[type=\"tel\"],input[type=\"range\"],input[type=\"date\"],input[type=\"month\"],input[type=\"week\"],input[type=\"time\"],input[type=\"datetime\"],input[type=\"datetime-local\"],input[type=\"color\"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,.woocommerce-cart .woocommerce-cart-form .actions .coupon input[type=\"text\"]",
    "offcanvas_menu_background": ".botiga-offcanvas-menu",
    "mobile_header_background": "#masthead-mobile",
    "button_background_color": "button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"],.widget_product_tag_cloud .tag-cloud-link,.widget_price_filter .ui-slider .ui-slider-handle,.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev",
    "single_product_sale_background_color": ".wc-block-grid__product-onsale, span.onsale",
    "shop_product_card_background": "ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product",
    "main_header_bottom_background": ".bottom-header-row",
    "main_header_background": ".site-header,.header-search-form",
    "scrolltop_bg_color": ".back-to-top",
    "topbar_background": ".top-bar",
    "footer_credits_background": ".site-footer",
    "footer_widgets_background": ".footer-widgets",
    "header_top_row_background": ".header-top",
    "header_middle_row_background": ".header-middle",
    "header_bottom_row_background": ".header-bottom",
    "color_body_text": ".widget_price_filter .ui-slider .ui-slider-range",
    "single_sticky_add_to_cart_style_color_background": ".botiga-single-sticky-add-to-cart-wrapper, .botiga-single-sticky-add-to-cart-wrapper input[type=\"number\"] ,.botiga-single-sticky-add-to-cart-wrapper select",
    "desktop_offcanvas_menu_background_color": ".botiga-desktop-offcanvas, .botiga-desktop-offcanvas .site-header-cart .count-number, .botiga-desktop-offcanvas .header-wishlist-icon .count-number",
    "main_header_sticky_active_background": ".sticky-header-active .site-header, .sticky-header-active .header-search-form, .sticky-header-active .site-header-cart .count-number, .sticky-header-active .header-wishlist-icon .count-number",
    "shop_product_wishlist_icon_background_color": ".botiga-wishlist-button"
  };
  $.each($bg_color_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $(selector).css('background-color', to);
      });
    });
  }); //Background color rgba

  var $background_color_rgba_options = {
    "color_body_text": ".site-header-cart .widget_shopping_cart .widgettitle:after, .site-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons:before,.site-header-cart .widget_shopping_cart .botiga-woocommerce-mini-cart__cross-sell:before,.botiga-mstepc-wrapper .divider"
  };
  $.each($background_color_rgba_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + option).remove();
        var output = selector + ' { background-color:' + hexToRGB(to, 0.1) + '!important; }';
        $('head').append('<style id="botiga-customizer-styles-' + option + '">' + output + '</style>');
      });
    });
  }); //Colors

  var $color_options = {
    "main_header_submenu_color": ".main-navigation ul ul a",
    "background_color": ".site-header-cart .product_list_widget li a.remove",
    "shop_product_product_title": "ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title, ul.wc-block-grid__products li.product .wc-block-grid__product-title, ul.wc-block-grid__products li.product .woocommerce-loop-product__title, ul.products li.wc-block-grid__product .wc-block-grid__product-title, ul.products li.wc-block-grid__product .woocommerce-loop-product__title, ul.products li.product .wc-block-grid__product-title, ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-category__title, .woocommerce-loop-product__title .botiga-wc-loop-product__title",
    "site_description_color": ".site-description",
    "site_title_color": ".site-header .site-title a",
    "color_body_text": "body,.site-header-cart .count-number, .wp-block-columns p a, .woocommerce-account.logged-in .entry-content>.woocommerce .woocommerce-MyAccount-navigation ul a,.shop_table.order_details, .shop_table.woocommerce-MyAccount-orders,.mini_cart_item a:nth-child(2),.woocommerce-cart .product-name a,.woocommerce-cart .product-remove a,.widget a:not(.wc-forward),.botiga-related-posts .related-post h3 a, .botiga-mstepc-wrapper a",
    "color_link_default": "a:not(.button):not(.wc-forward):not(.wp-block-button__link):not(.botiga-quantity-plus):not(.botiga-quantity-minus):not(.remove_from_cart_button):not(.botiga-wc-loop-product__title),.woocommerce-account.logged-in .entry-content>.woocommerce .woocommerce-MyAccount-navigation ul .is-active a,.woocommerce-table__product-name.product-name a,.woocommerce-orders-table__cell-order-number a,.woocommerce-MyAccount-content p a,.site-header-cart .widget_shopping_cart .woocommerce-mini-cart__buttons .button:not(.checkout),.botiga-related-posts .related-post .posted-on a",
    "color_heading_1": "h1",
    "color_heading_2": "h2,.wp-block-search .wp-block-search__label",
    "color_heading_3": "h3",
    "color_heading_4": "h4,.product-gallery-summary .product_meta,.product-gallery-summary .product_meta a,.woocommerce-breadcrumb,.woocommerce-breadcrumb a,.woocommerce-tabs ul.tabs li a,.product-gallery-summary .woocommerce-Price-amount,.woocommerce-mini-cart-item .quantity,.woocommerce-mini-cart__total .woocommerce-Price-amount,.order-total .woocommerce-Price-amount",
    "color_heading_5": "h5:not(.sticky-addtocart-title)",
    "color_heading_6": "h6",
    "color_forms_text": "input[type=\"text\"],input[type=\"email\"],input[type=\"url\"],input[type=\"password\"],input[type=\"search\"],input[type=\"number\"],input[type=\"tel\"],input[type=\"range\"],input[type=\"date\"],input[type=\"month\"],input[type=\"week\"],input[type=\"time\"],input[type=\"datetime\"],input[type=\"datetime-local\"],input[type=\"color\"],textarea,select,.woocommerce .select2-container .select2-selection--single,input[type=\"text\"]:focus,input[type=\"email\"]:focus,input[type=\"url\"]:focus,input[type=\"password\"]:focus,input[type=\"search\"]:focus,input[type=\"number\"]:focus,input[type=\"tel\"]:focus,input[type=\"range\"]:focus,input[type=\"date\"]:focus,input[type=\"month\"]:focus,input[type=\"week\"]:focus,input[type=\"time\"]:focus,input[type=\"datetime\"]:focus,input[type=\"datetime-local\"]:focus,input[type=\"color\"]:focus,textarea:focus,select:focus,.woocommerce .select2-container .select2-selection--single:focus,.woocommerce-page .select2-container .select2-selection--single,.select2-container--default .select2-selection--single .select2-selection__rendered",
    "offcanvas_menu_color": ".botiga-offcanvas-menu, .botiga-offcanvas-menu a:not(.button)",
    "mobile_header_color": "#masthead-mobile,#masthead-mobile a:not(.button)",
    "button_color": "button,.button:not(.wc-forward),a.button:not(.wc-forward),.checkout-button.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"],.widget_product_tag_cloud .tag-cloud-link,.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev",
    "single_product_sale_color": ".wc-block-grid__product-onsale, span.onsale",
    "single_product_title_color": ".product-gallery-summary .product_title",
    "single_product_price_color": ".product-gallery-summary .price",
    "loop_post_text_color": ".posts-archive .entry-content",
    "loop_post_title_color": ".posts-archive .entry-title a",
    "loop_post_meta_color": ".posts-archive .entry-meta a",
    "single_post_meta_color": ".single .entry-meta a",
    "single_post_title_color": ".single .entry-header .entry-title",
    "main_header_bottom_color": ".bottom-header-row, .bottom-header-row .header-contact a,.bottom-header-row .main-navigation .menu > li > a",
    "main_header_color": ".site-header .site-title a,.site-header .main-navigation .menu > li > a, .site-header .header-contact a, .header-login-register>a, .header-login-register nav>a, .top-bar-login-register>a, .top-bar-login-register nav>a",
    "scrolltop_color": ".back-to-top",
    "topbar_color": ".top-bar, .top-bar a",
    "footer_credits_text_color": ".site-info",
    "footer_credits_links_color": ".site-info a",
    "footer_credits_links_color_hover": ".site-info a:hover",
    "footer_widgets_links_color": ".widget-column .widget a",
    "footer_widgets_text_color": ".widget-column .widget",
    "footer_widgets_title_color": ".widget-column .widget .widget-title",
    "single_sticky_add_to_cart_style_color_content": ".botiga-single-sticky-add-to-cart-wrapper .price, .botiga-single-sticky-add-to-cart-wrapper .price del, .botiga-single-sticky-add-to-cart-wrapper .botiga-single-sticky-add-to-cart-wrapper-content .variations_form table.variations .label, .botiga-single-sticky-add-to-cart-wrapper select",
    "single_sticky_add_to_cart_style_color_title": ".botiga-single-sticky-add-to-cart-wrapper h5",
    "desktop_offcanvas_menu_text_color": ".botiga-desktop-offcanvas .main-navigation .menu li a, .botiga-desktop-offcanvas .site-title a, .botiga-desktop-offcanvas .site-description, .botiga-desktop-offcanvas .site-header-cart .count-number, .botiga-desktop-offcanvas .header-wishlist-icon .count-number, .botiga-desktop-offcanvas .header-contact a",
    "main_header_sticky_active_color": ".sticky-header-active .site-header .site-title a, .sticky-header-active .site-header .site-description, .sticky-header-active .site-header .main-navigation .menu > li > a, .sticky-header-active .site-header .header-contact a, .sticky-header-active .site-header-cart .count-number, .sticky-header-active .header-wishlist-icon .count-number"
  };
  $.each($color_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $(selector).css('color', to);
      });
    });
  }); //Fill

  var $fill_options = {
    "offcanvas_menu_color": ".botiga-offcanvas-menu svg:not(.stroke-based)",
    "mobile_header_color": "#masthead-mobile svg:not(.stroke-based)",
    "main_header_bottom_color": ".bottom-header-row .header-item svg:not(.stroke-based),.dropdown-symbol .ws-svg-icon svg",
    "main_header_color": ".site-header .header-item svg:not(.stroke-based), .site-header .dropdown-symbol .ws-svg-icon svg",
    "topbar_color": ".top-bar svg:not(.stroke-based)",
    "footer_credits_text_color": ".site-info .ws-svg-icon svg",
    "desktop_offcanvas_menu_text_color": ".botiga-desktop-offcanvas .header-item svg:not(.stroke-based), .botiga-desktop-offcanvas .dropdown-symbol .ws-svg-icon svg, .desktop-menu-close svg",
    "color_body_text": ".sidebar-slide .sidebar-open-wrapper .sidebar-open svg, .sidebar-slide+.widget-area .sidebar-wrapper .close-sidebar svg, .botiga-popup-wrapper .botiga-popup-wrapper__close-button svg",
    "main_header_sticky_active_color": ".sticky-header-active .site-header .header-item svg:not(.stroke-based), .sticky-header-active .site-header .dropdown-symbol .ws-svg-icon svg"
  };
  $.each($fill_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $(selector).css('fill', to);
      });
    });
  }); //Stroke

  var $stroke_options = {
    "scrolltop_color": ".back-to-top svg",
    "color_link_hover": ".has-cross-sells-carousel .cross-sells .botiga-carousel-wrapper .botiga-carousel-nav svg path",
    "main_header_color": ".site-header .header-item svg.stroke-based",
    "offcanvas_menu_color": ".botiga-offcanvas-menu svg.stroke-based",
    "mobile_header_color": "#masthead-mobile svg.stroke-based",
    "main_header_bottom_color": ".bottom-header-row .header-item svg.stroke-based",
    "desktop_offcanvas_menu_text_color": ".botiga-desktop-offcanvas .header-item svg.stroke-based",
    "main_header_sticky_active_color": ".sticky-header-active .site-header .header-item svg.stroke-based",
    "button_color": ".woocommerce-product-search .search-submit svg",
    "button_color_hover": ".woocommerce-product-search .search-submit:hover svg"
  };
  $.each($stroke_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $(selector).css('stroke', to);
      });
    });
  }); //Border color

  var $border_color_options = {
    "color_forms_borders": "input[type=\"text\"],input[type=\"email\"],input[type=\"url\"],input[type=\"password\"],input[type=\"search\"],input[type=\"number\"],input[type=\"tel\"],input[type=\"range\"],input[type=\"date\"],input[type=\"month\"],input[type=\"week\"],input[type=\"time\"],input[type=\"datetime\"],input[type=\"datetime-local\"],input[type=\"color\"],textarea,select,.woocommerce .select2-container .select2-selection--single,.woocommerce-page .select2-container .select2-selection--single,.woocommerce-account fieldset,.woocommerce-account .woocommerce-form-login, .woocommerce-account .woocommerce-form-register,.woocommerce-cart .woocommerce-cart-form .actions .coupon input[type=\"text\"],.select2-dropdown",
    "link_separator_color": ".botiga-offcanvas-menu .main-navigation ul li",
    "button_border_color": "button,a.button,.wp-block-button__link,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"]",
    "shop_product_card_border_color": "ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product",
    "footer_credits_divider_color": ".site-info,.site-footer",
    "footer_widgets_divider_color": ".footer-widgets,.footer-widgets-grid",
    "color_link_default": ".single-product div.product .gallery-vertical .flex-control-thumbs li img:hover, .single-product div.product .gallery-vertical .flex-control-thumbs li img.flex-active",
    "single_sticky_add_to_cart_style_color_content": ".botiga-single-sticky-add-to-cart-wrapper select",
    "main_header_color": ".site-header-cart .count-number, .header-wishlist-icon .count-number",
    "desktop_offcanvas_menu_text_color": ".botiga-desktop-offcanvas .site-header-cart .count-number, .botiga-desktop-offcanvas .header-wishlist-icon .count-number",
    "main_header_sticky_active_color": ".sticky-header-active .site-header-cart .count-number, .sticky-header-active .header-wishlist-icon .count-number"
  };
  $.each($border_color_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $(selector).css('border-color', to);
      });
    });
  }); //Border color rgba

  var $border_color_rgba_options = {
    "color_body_text": ".shop_table th, .shop_table td, .shop_table tr,.woocommerce-sorting-wrapper,.widget-area .widget,ul.products li.product",
    "single_sticky_add_to_cart_style_color_border": ".botiga-single-sticky-add-to-cart-wrapper"
  };
  $.each($border_color_rgba_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $(selector).css('border-color', hexToRGB(to, 0.1));
      });
    });
  }); //Color hover

  var $color_hover_options = {
    "color_link_hover": "a:not(.button):not(.wc-forward):not(.wp-block-button__link):not(.botiga-quantity-plus):not(.botiga-quantity-minus):not(.remove_from_cart_button):not(.category-button):not(.woocommerce-review-link):hover,.wp-block-columns p a:hover,.woocommerce-cart .product-name a:hover,.woocommerce-cart .product-remove a:hover,.woocommerce-orders-table__cell-order-number a:hover, .woocommerce-MyAccount-content p a:hover,.widget a:not(.wc-forward):hover,.botiga-related-posts .related-post h3 a:hover,.botiga-related-posts .related-post .posted-on a:hover",
    "button_color_hover": "button:hover,a.button:not(.wc-forward):hover,.a.button.checkout,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover,.widget_product_tag_cloud .tag-cloud-link:hover,.woocommerce-pagination li .page-numbers:hover,.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next:hover, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev:hover",
    "scrolltop_color_hover": ".back-to-top:hover",
    "footer_widgets_links_hover_color": ".widget-column .widget a:hover",
    "footer_credits_links_color_hover": ".site-info a:hover",
    "shop_product_product_title_hover": "ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title:hover, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title:hover, ul.wc-block-grid__products li.product .wc-block-grid__product-title:hover, ul.wc-block-grid__products li.product .woocommerce-loop-product__title:hover, ul.products li.wc-block-grid__product .wc-block-grid__product-title:hover, ul.products li.wc-block-grid__product .woocommerce-loop-product__title:hover, ul.products li.product .wc-block-grid__product-title:hover, ul.products li.product .woocommerce-loop-product__title:hover, ul.products li.product .woocommerce-loop-category__title:hover, .woocommerce-loop-product__title .botiga-wc-loop-product__title:hover"
  };
  $.each($color_hover_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + option).remove();
        var output = selector + ' { color:' + to + '!important; }';
        $('head').append('<style id="botiga-customizer-styles-' + option + '">' + output + '</style>');
      });
    });
  }); //Stroke hover

  var $stroke_hover_options = {
    "scrolltop_color_hover": ".back-to-top:hover svg",
    "color_link_default": ".has-cross-sells-carousel .cross-sells .botiga-carousel-wrapper .botiga-carousel-nav:hover svg path"
  };
  $.each($stroke_hover_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + option).remove();
        var output = selector + ' { stroke:' + to + '!important; }';
        $('head').append('<style id="botiga-customizer-styles-' + option + '">' + output + '</style>');
      });
    });
  }); //Background hover

  var $bg_hover_options = {
    "button_background_color_hover": "button:hover,a.button:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover,.widget_product_tag_cloud .tag-cloud-link:hover,.widget_price_filter .ui-slider .ui-slider-handle:hover,.botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-next:hover, .botiga-carousel.botiga-carousel-nav2 .botiga-carousel-nav-prev:hover",
    "scrolltop_bg_color_hover": ".back-to-top:hover"
  };
  $.each($bg_hover_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + option).remove();
        var output = selector + ' { background-color:' + to + '!important; }';
        $('head').append('<style id="botiga-customizer-styles-' + option + '">' + output + '</style>');
      });
    });
  }); //Border hover

  var $border_hover_options = {
    "button_border_color_hover": "button:hover,a.button:hover,.wp-block-button__link:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover"
  };
  $.each($border_hover_options, function (option, selector) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + option).remove();
        var output = selector + ' { border-color:' + to + '!important; }';
        $('head').append('<style id="botiga-customizer-styles-' + option + '">' + output + '</style>');
      });
    });
  }); //Header

  wp.customize('center_top_bar_contents', function (value) {
    value.bind(function (to) {
      if (false === to) {
        $('.top-bar-inner > .row').css('display', 'flex');
        $('.top-bar-inner .col').css('justify-content', 'flex-start');
        $('.top-bar-inner .col:last-of-type').css('justify-content', 'flex-end');
      } else {
        $('.top-bar-inner > .row').css('display', 'block');
        $('.top-bar-inner .col').css('justify-content', 'center');
        $('.top-bar-inner .col').css('text-align', 'center');
      }
    });
  });
  wp.customize('topbar_padding', function (value) {
    value.bind(function (to) {
      $('.top-bar-inner').css({
        paddingTop: to + 'px',
        paddingBottom: to + 'px'
      });
    });
  });
  wp.customize('topbar_divider_size', function (value) {
    value.bind(function (to) {
      $('.top-bar,.top-bar-inner').css('border-width', to);
    });
  });
  wp.customize('topbar_divider_color', function (value) {
    value.bind(function (to) {
      $('.top-bar,.top-bar-inner').css('border-color', to);
    });
  });
  wp.customize('main_header_padding', function (value) {
    value.bind(function (to) {
      $('.site-header-inner, .top-header-row').css({
        paddingTop: to + 'px',
        paddingBottom: to + 'px'
      });
    });
  });
  wp.customize('main_header_bottom_padding', function (value) {
    value.bind(function (to) {
      $('.bottom-header-inner').css({
        paddingTop: to + 'px',
        paddingBottom: to + 'px'
      });
    });
  });
  wp.customize('main_header_divider_color', function (value) {
    value.bind(function (to) {
      $('.site-header, .bottom-header-row,.top-header-row,.site-header-inner, .bottom-header-inner').css('border-color', to);
    });
  });
  wp.customize('mobile_menu_alignment', function (value) {
    value.bind(function (to) {
      $('.botiga-offcanvas-menu .main-navigation ul li').css('text-align', to);
    });
  });
  wp.customize('mobile_menu_link_spacing', function (value) {
    value.bind(function (to) {
      $('.botiga-offcanvas-menu .main-navigation a').css('padding-top', to / 2);
      $('.botiga-offcanvas-menu .main-navigation a').css('padding-bottom', to / 2);
    });
  });
  wp.customize('mobile_header_padding', function (value) {
    value.bind(function (to) {
      $('.mobile-header').css({
        paddingTop: to + 'px',
        paddingBottom: to + 'px'
      });
    });
  });
  wp.customize('mobile_header_separator_width', function (value) {
    value.bind(function (to) {
      $('.botiga-offcanvas-menu .main-navigation ul li').css('border-bottom-width', to + 'px');
    });
  });
  wp.customize('main_header_areas_spacing_l6', function (value) {
    value.bind(function (to) {
      $('.header_layout_6 .botiga-desktop-offcanvas > .row > div').css({
        'margin-top': to + 'px'
      });
    });
  });
  wp.customize('main_header_elements_spacing_l6', function (value) {
    value.bind(function (to) {
      $('.header_layout_6 .header-item').css({
        'margin-bottom': to + 'px'
      });
      $('.header_layout_6 .header-item.header-contact a + a').css({
        'margin-top': to + 'px'
      });
    });
  });
  wp.customize('main_header_padding', function (value) {
    value.bind(function (to) {
      $('.header_layout_6 .botiga-desktop-offcanvas').css({
        padding: to + 'px'
      });
    });
  });
  wp.customize('desktop_offcanvas_padding', function (value) {
    value.bind(function (to) {
      $('.header_layout_7 .botiga-desktop-offcanvas, .header_layout_8 .botiga-desktop-offcanvas').css({
        padding: to + 'px'
      });
    });
  });
  wp.customize('desktop_offcanvas_menu_link_spacing', function (value) {
    value.bind(function (to) {
      $('.header_layout_7 .botiga-desktop-offcanvas .main-navigation .menu > li > a, .header_layout_8 .botiga-desktop-offcanvas .main-navigation .menu > li > a').css({
        'padding-top': to + 'px',
        'padding-bottom': to + 'px'
      });
    });
  });
  wp.customize('desktop_offcanvas_link_separator_color', function (value) {
    value.bind(function (to) {
      var desktop_offcanvas_menu_link_separator = window.parent.window.wp.customize.control('desktop_offcanvas_menu_link_separator').setting.get();

      if (desktop_offcanvas_menu_link_separator) {
        $('.header_layout_7 .botiga-desktop-offcanvas .main-navigation .menu > li + li, .header_layout_8 .botiga-desktop-offcanvas .main-navigation .menu > li + li').css({
          'border-top': '1px solid ' + hexToRGB(to, 0.1)
        });
      }
    });
  });
  wp.customize('desktop_offcanvas_content_areas_spacing', function (value) {
    value.bind(function (to) {
      $('.header_layout_7 .botiga-desktop-offcanvas > .row > div ,.header_layout_8 .botiga-desktop-offcanvas > .row > div').css({
        'margin-top': to + 'px'
      });
    });
  });
  wp.customize('header_components_desktop_offcanvas_elements_spacing', function (value) {
    value.bind(function (to) {
      $('.header_layout_7 .botiga-desktop-offcanvas .header-item, .header_layout_8 .botiga-desktop-offcanvas .header-item').css({
        'margin-bottom': to + 'px'
      });
      $('.header_layout_7 .botiga-desktop-offcanvas .header-item.header-contact a + a, .header_layout_8 .botiga-desktop-offcanvas .header-item.header-contact a + a').css({
        'margin-top': to + 'px'
      });
    });
  }); //Blog

  wp.customize('archive_featured_image_size_desktop', function (value) {
    value.bind(function (to) {
      $('.posts-archive .list-image').css('width', to + '%');
      $('.posts-archive .list-content').css('width', 100 - to + '%');
    });
  });
  wp.customize('archive_featured_image_size_desktop', function (value) {
    value.bind(function (to) {
      $('.posts-archive .list-image').css('width', to + '%');
      $('.posts-archive .list-content').css('width', 100 - to + '%');
    });
  });
  wp.customize('archive_meta_spacing', function (value) {
    value.bind(function (to) {
      $('.posts-archive .entry-meta').css('margin', to + 'px 0');
    });
  });
  wp.customize('archive_title_spacing', function (value) {
    value.bind(function (to) {
      $('.posts-archive .entry-header').css('margin-bottom', to + 'px');
    });
  });
  wp.customize('single_post_header_spacing', function (value) {
    value.bind(function (to) {
      $('.single .entry-header').css('margin-bottom', to + 'px');
    });
  });
  wp.customize('single_post_image_spacing', function (value) {
    value.bind(function (to) {
      $('.single .post-thumbnail').css('margin-bottom', to + 'px');
    });
  });
  wp.customize('single_post_meta_spacing', function (value) {
    value.bind(function (to) {
      $('.entry-meta-above').css('margin-bottom', to + 'px');
      $('.entry-meta-below').css('margin-top', to + 'px');
    });
  }); //Footer

  wp.customize('footer_widgets_column_spacing_desktop', function (value) {
    value.bind(function (to) {
      $('.footer-widgets-grid').css('gap', to + 'px');
    });
  });
  wp.customize('footer_widgets_divider_size', function (value) {
    value.bind(function (to) {
      $('.footer-widgets,.footer-widgets-grid').css('border-width', to);
    });
  });
  wp.customize('footer_credits_divider_size', function (value) {
    value.bind(function (to) {
      $('.site-info,.site-footer').css('border-width', to);
    });
  });
  wp.customize('footer_credits_padding_desktop', function (value) {
    value.bind(function (to) {
      $('.site-info').css('padding-top', to + 'px');
    });
  });
  wp.customize('footer_credits_padding_bottom_desktop', function (value) {
    value.bind(function (to) {
      $('.site-info').css('padding-bottom', to + 'px');
    });
  });
  wp.customize('color_heading_4', function (value) {
    value.bind(function (to) {
      var color = hexToRGB(to, 0.1);
      $('table, table th, table td, table tr, .woocommerce-tabs ul.tabs,.product-gallery-summary .product_meta').css('border-color', color);
      $('.site-header-cart .product_list_widget li a.remove').css('background-color', to);
      $('.woocommerce-tabs ul.tabs li.active a').css('border-color', to);
    });
  }); //Footer copyright

  wp.customize('footer_copyright_elements_spacing_desktop', function (value) {
    value.bind(function (to) {
      $('.footer-copyright-elements>div+div').css('margin-top', to + 'px');
    });
  }); //Back to top

  wp.customize('scrolltop_radius', function (value) {
    value.bind(function (to) {
      $('.back-to-top.display').css('border-radius', to + 'px');
    });
  });
  wp.customize('scrolltop_side_offset', function (value) {
    value.bind(function (to) {
      $('.back-to-top.position-right').css('right', to + 'px');
      $('.back-to-top.position-left').css('left', to + 'px');
    });
  });
  wp.customize('scrolltop_bottom_offset', function (value) {
    value.bind(function (to) {
      $('.back-to-top').css('bottom', to + 'px');
    });
  });
  wp.customize('scrolltop_icon_size', function (value) {
    value.bind(function (to) {
      $('.back-to-top .ws-svg-icon').css('width', to + 'px');
      $('.back-to-top .ws-svg-icon').css('height', to + 'px');
    });
  });
  wp.customize('scrolltop_padding', function (value) {
    value.bind(function (to) {
      $('.back-to-top').css('padding', to + 'px');
    });
  }); //Woocommerce

  wp.customize('shop_product_element_spacing', function (value) {
    value.bind(function (to) {
      $('ul.wc-block-grid__products li.wc-block-grid__product .col-md-7>*, ul.wc-block-grid__products li.wc-block-grid__product .col-md-8>*, ul.wc-block-grid__products li.wc-block-grid__product>*, ul.wc-block-grid__products li.product .col-md-7>*, ul.wc-block-grid__products li.product .col-md-8>*, ul.wc-block-grid__products li.product>*, ul.products li.wc-block-grid__product .col-md-7>*, ul.products li.wc-block-grid__product .col-md-8>*, ul.products li.wc-block-grid__product>*, ul.products li.product .col-md-7>*, ul.products li.product .col-md-8>*, ul.products li.product>*').css('margin-bottom', to + 'px');
    });
  });
  wp.customize('shop_sale_tag_radius', function (value) {
    value.bind(function (to) {
      $('.wc-block-grid__product-onsale, span.onsale').css('border-radius', to + 'px');
    });
  });
  wp.customize('shop_product_card_radius', function (value) {
    value.bind(function (to) {
      $('ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product').css('border-radius', to + 'px');
    });
  });
  wp.customize('shop_product_card_thumb_radius', function (value) {
    value.bind(function (to) {
      $('ul.wc-block-grid__products li.wc-block-grid__product .loop-image-wrap, ul.wc-block-grid__products li.product .loop-image-wrap, ul.products li.wc-block-grid__product .loop-image-wrap, ul.products li.product .loop-image-wrap').css('border-radius', to + 'px');
    });
  });
  wp.customize('shop_product_card_border_size', function (value) {
    value.bind(function (to) {
      $('ul.wc-block-grid__products li.wc-block-grid__product, ul.wc-block-grid__products li.product, ul.products li.wc-block-grid__product, ul.products li.product').css('border-width', to + 'px');
    });
  });
  wp.customize('shop_categories_radius', function (value) {
    value.bind(function (to) {
      var shop_categories_layout = window.parent.window.wp.customize.control('shop_categories_layout').setting.get();
      $('ul.products li.product-category > a, ul.products li.product-category > a > img').css('border-radius', to + 'px');

      if ('layout4' === shop_categories_layout) {
        $('.product-category-item-layout4 ul.products li.product-category > a h2').css('border-radius', '0 0 ' + to + 'px ' + to + 'px');
      }
    });
  }); //Woocommerce wishlist

  wp.customize('color_link_default', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-wishlist-color_link_default').remove();
      var output = '';
      output += '.botiga-wishlist-button svg path { stroke: ' + to + '; }';
      output += '.botiga-wishlist-button.botiga-wishlist-button-tooltip:not(.active):after { border-left-color: ' + to + '; }';
      output += '.botiga-wishlist-button.botiga-wishlist-button-tooltip:not(.active):before { background-color: ' + to + '; }';

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-wishlist-color_link_default">' + output + '</style>');
      }
    });
  });
  wp.customize('shop_product_wishlist_icon_active_color', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-wishlist-shop_product_wishlist_icon_active_color').remove();
      var output = '';
      output += '.botiga-wishlist-button:hover svg path, .botiga-wishlist-button.active svg path { fill: ' + to + '; stroke: ' + to + '; }';

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-wishlist-shop_product_wishlist_icon_active_color">' + output + '</style>');
      }
    });
  }); // hide/show "wishlist button" choice from single product elements

  $(window.parent.document).on('click', '.control-section', function (e) {
    var $section = $(window.parent.document).find('.control-section.open');

    if ($section.find('#customize-control-single_product_elements_order').length) {
      wp.customize('shop_product_wishlist_layout', function (value) {
        if ('layout1' === value.get()) {
          $section.find('#customize-control-single_product_elements_order .kirki-sortable-item[data-value="botiga_single_wishlist_button"]').css('display', 'none');
        } else {
          $section.find('#customize-control-single_product_elements_order .kirki-sortable-item[data-value="botiga_single_wishlist_button"]').css('display', 'block');
        }
      });
    }
  }); //Woocommerce single image gallery

  wp.customize('single_product_gallery_styles_background_color', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-single_product_gallery_styles_background_color').remove();
      var output = '';
      output += '.product-gallery-summary.gallery-showcase:before, .product-gallery-summary.gallery-full-width:before { background-color: ' + to + '; }';

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-single_product_gallery_styles_background_color">' + output + '</style>');
      }
    });
  });
  wp.customize('single_product_gallery_styles_padding_top_bottom', function (value) {
    value.bind(function (to) {
      $('.product-gallery-summary.gallery-showcase, .product-gallery-summary.gallery-full-width').css({
        paddingTop: to + 'px',
        paddingBottom: to + 'px'
      });
    });
  }); //Woocommerce single tabs

  wp.customize('single_product_tabs_border_color_active', function (value) {
    value.bind(function (to) {
      var single_product_tabs_layout = window.parent.window.wp.customize.control('single_product_tabs_layout').setting.get();
      $('head').find('#botiga-customizer-styles-single_product_tabs_border_color_active').remove();
      var output = '';

      switch (single_product_tabs_layout) {
        case 'style1':
        case 'style4':
          output += '.botiga-tabs-style1 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style1 .woocommerce-tabs ul.tabs li:hover a, .botiga-tabs-style4 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style4 .woocommerce-tabs ul.tabs li:hover a { border-color: ' + to + ' !important; }';
          break;

        case 'style2':
          output += '.botiga-tabs-style2 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style2 .woocommerce-tabs ul.tabs li:hover a { border-top-color: ' + to + ' !important; }';
          break;

        default:
          output = '';
          break;
      }

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-single_product_tabs_border_color_active">' + output + '</style>');
      }
    });
  });
  wp.customize('single_product_tabs_background_color', function (value) {
    value.bind(function (to) {
      var single_product_tabs_layout = window.parent.window.wp.customize.control('single_product_tabs_layout').setting.get();
      $('head').find('#botiga-customizer-styles-single_product_tabs_background_color').remove();
      var output = '';

      switch (single_product_tabs_layout) {
        case 'style3':
          output += '.botiga-tabs-style3 .woocommerce-tabs ul.tabs li:not(.active) a, .botiga-tabs-style3 .woocommerce-tabs ul.tabs li:not(.active):hover a { background-color: ' + hexToRGB(to, 0.5) + ' !important; }';
          break;

        case 'style4':
          output += '.botiga-tabs-style4 .woocommerce-tabs ul.tabs li:not(.active) a { background-color: ' + to + ' !important; }';
          break;

        case 'style5':
          output += '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li:not(.active) a { background-color: ' + hexToRGB(to, 0.4) + ' !important; }';
          break;

        default:
          output = '';
          break;
      }

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-single_product_tabs_background_color">' + output + '</style>');
      }
    });
  });
  wp.customize('single_product_tabs_background_color_active', function (value) {
    value.bind(function (to) {
      var single_product_tabs_layout = window.parent.window.wp.customize.control('single_product_tabs_layout').setting.get();
      $('head').find('#botiga-customizer-styles-single_product_tabs_background_color_active').remove();
      var output = '';

      switch (single_product_tabs_layout) {
        case 'style3':
          output += '.botiga-tabs-style3 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style3 .woocommerce-tabs ul.tabs li:hover a { background-color: ' + to + ' !important; }';
          break;

        case 'style4':
          output += '.botiga-tabs-style4 .woocommerce-tabs ul.tabs li.active a { background-color: ' + to + ' !important; }';
          break;

        case 'style5':
          output += '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li.active a, .botiga-tabs-style5 .woocommerce-tabs .panel { background-color: ' + hexToRGB(to, 1) + ' !important; }';
          break;

        default:
          output = '';
          break;
      }

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-single_product_tabs_background_color_active">' + output + '</style>');
      }
    });
  });
  wp.customize('single_product_tabs_text_color', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-single_product_tabs_text_color').remove();
      var output = '.woocommerce-tabs ul.tabs li:not(.active) a ,.woocommerce-tabs ul.tabs li:not(.active) a:hover { color: ' + to + ' !important; }';

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-single_product_tabs_text_color">' + output + '</style>');
      }
    });
  });
  wp.customize('single_product_tabs_text_color_active', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-single_product_tabs_text_color_active').remove();
      var output = '.woocommerce-tabs ul.tabs li.active a,.woocommerce-tabs ul.tabs li.active a:hover { color: ' + to + ' !important; }';

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-single_product_tabs_text_color_active">' + output + '</style>');
      }
    });
  });
  wp.customize('single_product_tabs_remaining_borders', function (value) {
    value.bind(function (to) {
      var single_product_tabs_layout = window.parent.window.wp.customize.control('single_product_tabs_layout').setting.get();
      $('head').find('#botiga-customizer-styles-single_product_tabs_remaining_borders').remove();
      var output = '';

      switch (single_product_tabs_layout) {
        case 'style2':
          output += '.botiga-tabs-style2 .woocommerce-tabs ul.tabs li a, .botiga-tabs-style2 .woocommerce-tabs ul.tabs, .botiga-tabs-style2 .woocommerce-tabs ul.tabs li:not(.active):not(:hover) a { border-color: ' + hexToRGB(to, 0.3) + ' !important; }';
          break;

        case 'style1':
        case 'style3':
          output += '.botiga-tabs-style1 .woocommerce-tabs ul.tabs, .botiga-tabs-style3 .woocommerce-tabs ul.tabs { border-bottom-color: ' + hexToRGB(to, 0.3) + ' !important; }';
          break;

        case 'style4':
          output += '.botiga-tabs-style4 .woocommerce-tabs ul.tabs:before { border-color: ' + hexToRGB(to, 0.3) + ' !important; } .botiga-tabs-style4 .woocommerce-tabs ul.tabs li:not(.active) a { border-color: ' + hexToRGB(to, 0.3) + ' !important; }';
          break;

        case 'style5':
          output += '.botiga-tabs-style5 .woocommerce-tabs ul.tabs li a, .botiga-tabs-style5 .woocommerce-tabs .panel { border-color: ' + hexToRGB(to, 0.3) + ' !important; } .botiga-tabs-style5 .woocommerce-tabs ul.tabs li:not(.active) a { border-right: 1px solid ' + to + ' }';
          break;

        default:
          output = '';
          break;
      }

      if (output) {
        $('head').append('<style id="botiga-customizer-styles-single_product_tabs_remaining_borders">' + output + '</style>');
      }
    });
  });
  wp.customize('single_product_tabs_layout', function (value) {
    value.bind(function (layout) {
      $('.site-main').removeClass('botiga-tabs-style1 botiga-tabs-style2 botiga-tabs-style3 botiga-tabs-style4 botiga-tabs-style5');
      $('.site-main').addClass('botiga-tabs-' + layout); //Run the colors code again in this option change
      //It is like trigger a "change" in the colors options of respective opened section

      $(window.parent.document).find('.control-section.open .alpha-color-control').each(function () {
        var id = $(this).closest('li').attr('id'),
            element = $(this).data('customize-setting-link'),
            color = $(this).val();

        if (typeof window.parent.window.wp.customize(element) !== 'undefined') {
          window.parent.window.wp.customize(element).set('');
          window.parent.window.wp.customize(element).set(color);
          $('#' + id).find('.wp-color-result').css('background-color', color);
        }
      }); // hide and show options based in the selected layout since it's a postMessage option
      // works together with active_callback in the backend
      // active_callback works in the first load or when the customize "refresh"

      switch (layout) {
        case 'style1':
          hideControls(['single_product_tabs_background_color', 'single_product_tabs_background_color_active']);
          showControls(['single_product_tabs_border_color_active']);
          break;

        case 'style2':
          hideControls(['single_product_tabs_background_color', 'single_product_tabs_background_color_active']);
          showControls(['single_product_tabs_border_color_active']);
          break;

        case 'style3':
          hideControls(['single_product_tabs_border_color_active']);
          showControls(['single_product_tabs_background_color', 'single_product_tabs_background_color_active']);
          break;

        case 'style4':
          showControls(['single_product_tabs_border_color_active', 'single_product_tabs_background_color', 'single_product_tabs_background_color_active']);
          break;

        case 'style5':
          hideControls(['single_product_tabs_border_color_active']);
          showControls(['single_product_tabs_background_color', 'single_product_tabs_background_color_active']);
          break;
      }
    });
  });
  wp.customize('single_product_tabs_alignment', function (value) {
    value.bind(function (to) {
      $('.site-main').removeClass('botiga-tabs-align-left botiga-tabs-align-center botiga-tabs-align-right');
      $('.site-main').addClass('botiga-tabs-align-' + to);
      $('.woocommerce-tabs ul.tabs').css('text-align', to);
    });
  }); //Woocommerce single sticky add to cart

  wp.customize('single_sticky_add_to_cart_elements_spacing', function (value) {
    value.bind(function (to) {
      $('.botiga-single-sticky-add-to-cart-wrapper .botiga-single-sticky-add-to-cart-wrapper-content .botiga-single-sticky-add-to-cart-item').css('margin-right', to + 'px');
    });
  }); //Cart

  wp.customize('shop_cart_show_coupon_form', function (value) {
    value.bind(function (to) {
      if (!to) {
        $('.woocommerce-cart .coupon').css('display', 'none');
      } else {
        $('.woocommerce-cart .coupon').css('display', 'block');
      }
    });
  }); //Responsive

  var $devices = {
    "desktop": "(min-width: 992px)",
    "tablet": "(min-width: 576px) and (max-width: 991px)",
    "mobile": "(max-width: 575px)"
  };
  var $topBottPad = {
    "footer_widgets_padding": ".footer-widgets-grid"
  };
  $.each($topBottPad, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { padding-top:' + to + 'px;padding-bottom:' + to + 'px; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  });
  var $maxWidth = {
    "site_logo_size": ".custom-logo-link img",
    "modal_popup_max_width": "#modalPopup .botiga-popup-wrapper"
  };
  $.each($maxWidth, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { max-width:' + to + 'px; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  });
  var $maxWidthPercent = {
    "modal_popup_side_image_max_width": "#modalPopup .botiga-popup-wrapper__content-side-image"
  };
  $.each($maxWidthPercent, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { max-width:' + to + '%; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  });
  var $fontSizes = {
    "body_font_size": "body",
    "h1_font_size": "h1:not(.site-title)",
    "h2_font_size": "h2",
    "h3_font_size": "h3",
    "h4_font_size": "h4",
    "h5_font_size": "h5",
    "h6_font_size": "h6",
    "single_product_title_size": ".product-gallery-summary .entry-title",
    "single_product_price_size": ".product-gallery-summary .price",
    "loop_post_text_size": ".posts-archive .entry-content",
    "loop_post_meta_size": ".posts-archive .entry-meta",
    "loop_post_title_size": ".posts-archive .entry-title",
    "single_post_title_size": ".single .entry-header .entry-title",
    "single_post_meta_size": ".single .entry-meta",
    "footer_widgets_title_size": ".widget-column .widget .widget-title"
  };
  $.each($fontSizes, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { font-size:' + to + 'px; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  });
  var $shop_archive_columns_gap = {
    "shop_archive_columns_gap": "ul.wc-block-grid__products, ul.products"
  };
  $.each($shop_archive_columns_gap, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { gap:' + to + 'px; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  }); //Placeholders

  wp.customize('color_forms_placeholder', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-color_forms_placeholder').remove();
      var output = '::placeholder {color:' + to + ';opacity:1;} :-ms-input-placeholder {color:' + to + ';} ::-ms-input-placeholder {color:' + to + ';}';
      $('head').append('<style id="botiga-customizer-styles-color_forms_placeholder">' + output + '</style>');
    });
  }); //Typography

  wp.customize('botiga_body_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-body-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-body-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-body-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $('body').css('font-family', jQuery.parseJSON(to)['font']);
      $('body').css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('botiga_headings_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-headings-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-headings-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-headings-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $('h1,h2,h3,h4,h5,h6,.site-title').css('font-family', jQuery.parseJSON(to)['font']);
      $('h1,h2,h3,h4,h5,h6,.site-title').css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('headings_font_style', function (value) {
    value.bind(function (to) {
      $('h1,h2,h3,h4,h5,h6,.site-title').css('font-style', to);
    });
  });
  wp.customize('headings_line_height', function (value) {
    value.bind(function (to) {
      $('h1,h2,h3,h4,h5,h6,.site-title').css('line-height', to);
    });
  });
  wp.customize('headings_letter_spacing', function (value) {
    value.bind(function (to) {
      $('h1,h2,h3,h4,h5,h6,.site-title').css('letter-spacing', to + 'px');
    });
  });
  wp.customize('headings_text_transform', function (value) {
    value.bind(function (to) {
      $('h1,h2,h3,h4,h5,h6,.site-title').css('text-transform', to);
    });
  });
  wp.customize('headings_text_decoration', function (value) {
    value.bind(function (to) {
      $('h1,h2,h3,h4,h5,h6,.site-title').css('text-decoration', to);
    });
  });
  wp.customize('body_font_style', function (value) {
    value.bind(function (to) {
      $('body').css('font-style', to);
    });
  });
  wp.customize('body_line_height', function (value) {
    value.bind(function (to) {
      $('body').css('line-height', to);
    });
  });
  wp.customize('body_letter_spacing', function (value) {
    value.bind(function (to) {
      $('body').css('letter-spacing', to + 'px');
    });
  });
  wp.customize('body_text_transform', function (value) {
    value.bind(function (to) {
      $('body').css('text-transform', to);
    });
  });
  wp.customize('body_text_decoration', function (value) {
    value.bind(function (to) {
      $('body').css('text-decoration', to);
    });
  });
  var $color_options = [//Woocommerce header style
  {
    option: "shop_archive_header_background_color",
    selector: ".woocommerce-page-header",
    prop: "background-color"
  }, {
    option: "shop_archive_header_title_color",
    selector: ".woocommerce-page-header h1",
    prop: "color"
  }, {
    option: "shop_archive_header_description_color",
    selector: ".woocommerce-page-header .page-description, .woocommerce-page-header .term-description",
    prop: "color"
  }, {
    option: "shop_archive_header_button_color",
    selector: ".woocommerce-page-header .category-button",
    prop: "color"
  }, {
    option: "shop_archive_header_button_color_hover",
    selector: ".woocommerce-page-header .category-button:hover",
    prop: "color",
    pseudo: true
  }, {
    option: "shop_archive_header_button_background_color",
    selector: ".woocommerce-page-header .category-button",
    prop: "background-color"
  }, {
    option: "shop_archive_header_button_background_color_hover",
    selector: ".woocommerce-page-header .category-button:hover",
    prop: "background-color",
    pseudo: true
  }, {
    option: "shop_archive_header_button_border_color",
    selector: ".woocommerce-page-header .category-button",
    prop: "border-color"
  }, {
    option: "shop_archive_header_button_border_color_hover",
    selector: ".woocommerce-page-header .category-button:hover",
    prop: "border-color",
    pseudo: true
  }, {
    option: "shop_archive_header_button_border_radius",
    selector: ".woocommerce-page-header .category-button",
    prop: "border-radius",
    unit: "px"
  }, // Multi Step Checkout
  {
    option: "color_link_default",
    selector: ".botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.current-step:before, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.completed:before",
    prop: "border-top-color",
    pseudo: true
  }, {
    option: "color_link_default",
    selector: ".botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item:hover .step, .botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.current-step .step",
    prop: "border-color",
    pseudo: true
  }, {
    option: "color_link_default",
    selector: ".botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.current-step .step",
    prop: "background-color",
    pseudo: true
  }, {
    option: "color_link_default",
    selector: ".botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item.completed .step",
    prop: ["background-color", "border-color"],
    pseudo: true
  }, {
    option: "color_heading_1",
    selector: ".botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item:not(.current-step):not(.completed):hover .step .step-number",
    prop: "color",
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item:before",
    prop: "border-top-color",
    rgba: 0.1,
    pseudo: true
  }, {
    option: "background_color",
    selector: ".botiga-mstepc-wrapper .botiga-mstepc-tabs-nav .botiga-mstepc-tabs-nav-item .step svg",
    prop: "fill",
    pseudo: true
  }, // Woocommerce Ajax Search
  {
    option: "content_cards_background",
    selector: ".botiga-ajax-search__wrapper",
    prop: "background-color",
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".botiga-ajax-search__item-info p, .botiga-ajax-search__item-price",
    prop: "color",
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".botiga-ajax-search__wrapper ,.botiga-ajax-search__item+.botiga-ajax-search__item:before",
    prop: "border-color",
    rgba: 0.1,
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".botiga-ajax-search__divider",
    prop: "background-color",
    rgba: 0.1,
    pseudo: true
  }, // Quantity input
  // Style 1
  {
    option: "color_body_text",
    selector: ".quantity, .quantity .botiga-quantity-plus, .quantity .botiga-quantity-minus",
    prop: ["border-color", "color"],
    condition: "shop_general_quantity_style",
    cond_value: "style1"
  }, // Style 2
  {
    option: "content_cards_background",
    selector: ".quantity-button-style2 .quantity",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style2"
  }, {
    option: "button_background_color",
    selector: ".quantity-button-style2 .botiga-quantity-plus:hover, .quantity-button-style2 .botiga-quantity-minus:hover",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style2",
    pseudo: true
  }, {
    option: "button_color",
    selector: ".quantity-button-style2 .botiga-quantity-plus:hover, .quantity-button-style2 .botiga-quantity-minus:hover",
    prop: "color",
    condition: "shop_general_quantity_style",
    cond_value: "style2",
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".quantity-button-style2 .quantity, .quantity-button-style2 .botiga-quantity-plus, .quantity-button-style2 .botiga-quantity-minus",
    prop: ["border-color"],
    condition: "shop_general_quantity_style",
    cond_value: "style2",
    rgba: 0.3
  }, {
    option: "color_body_text",
    selector: ".quantity .botiga-quantity-plus, .quantity .botiga-quantity-minus",
    prop: "color",
    condition: "shop_general_quantity_style",
    cond_value: "style2"
  }, // style 3
  {
    option: "color_body_text",
    selector: ".quantity-button-style3 .quantity, .quantity-button-style-arrows .botiga-quantity-plus:before, .quantity-button-style-arrows .botiga-quantity-minus:before",
    prop: "border-color",
    condition: "shop_general_quantity_style",
    cond_value: "style3",
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".quantity .botiga-quantity-plus, .quantity .botiga-quantity-minus",
    prop: "color",
    condition: "shop_general_quantity_style",
    cond_value: "style3"
  }, // style 4
  {
    option: "color_body_text",
    selector: ".quantity-button-style4 .quantity",
    prop: "border-color",
    condition: "shop_general_quantity_style",
    cond_value: "style4",
    rgba: 0.1
  }, {
    option: "content_cards_background",
    selector: ".quantity-button-style4 .quantity .qty",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style4",
    pseudo: true
  }, {
    option: "button_background_color",
    selector: ".quantity-button-style4 .quantity .botiga-quantity-plus, .quantity-button-style4 .quantity .botiga-quantity-minus",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style4"
  }, {
    option: "button_background_color_hover",
    selector: ".quantity-button-style4 .quantity .botiga-quantity-plus:hover, .quantity-button-style4 .quantity .botiga-quantity-minus:hover",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style4",
    pseudo: true
  }, {
    option: "button_color",
    selector: ".quantity-button-style4 .quantity .botiga-quantity-plus, .quantity-button-style4 .quantity .botiga-quantity-minus",
    prop: "color",
    condition: "shop_general_quantity_style",
    cond_value: "style4"
  }, // style 5
  {
    option: "content_cards_background",
    selector: ".quantity-button-style5 .quantity .qty",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style5",
    pseudo: true
  }, {
    option: "content_cards_background",
    selector: ".quantity-button-style5 .quantity .botiga-quantity-plus, .quantity-button-style5 .quantity .botiga-quantity-minus",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style5"
  }, {
    option: "content_cards_background",
    selector: ".quantity-button-style5 .quantity .botiga-quantity-plus:hover, .quantity-button-style5 .quantity .botiga-quantity-minus:hover",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style5",
    rgba: 0.3,
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".quantity .botiga-quantity-plus, .quantity .botiga-quantity-minus",
    prop: "color",
    condition: "shop_general_quantity_style",
    cond_value: "style5"
  }, // style 6
  {
    option: "content_cards_background",
    selector: ".quantity-button-style6 .quantity .qty",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style6",
    pseudo: true
  }, {
    option: "content_cards_background",
    selector: ".quantity-button-style6 .quantity .botiga-quantity-plus, .quantity-button-style6 .quantity .botiga-quantity-minus",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style6"
  }, {
    option: "content_cards_background",
    selector: ".quantity-button-style6 .quantity .botiga-quantity-plus:hover, .quantity-button-style6 .quantity .botiga-quantity-minus:hover",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style6",
    rgba: 0.3,
    pseudo: true
  }, {
    option: "color_body_text",
    selector: ".quantity .botiga-quantity-plus, .quantity .botiga-quantity-minus",
    prop: "color",
    condition: "shop_general_quantity_style",
    cond_value: "style6"
  }, {
    option: "color_body_text",
    selector: ".quantity-button-style6 .quantity .qty, .quantity-button-style6 .quantity .botiga-quantity-plus, .quantity-button-style6 .quantity .botiga-quantity-minus",
    prop: "border-color",
    condition: "shop_general_quantity_style",
    cond_value: "style6",
    rgba: 0.3,
    pseudo: true
  }, // style 7
  {
    option: "color_body_text",
    selector: ".quantity-button-style7 .quantity",
    prop: "border-color",
    condition: "shop_general_quantity_style",
    cond_value: "style7",
    rgba: 0.3
  }, {
    option: "button_color",
    selector: ".quantity-button-style-arrows .botiga-quantity-plus:before, .quantity-button-style-arrows .botiga-quantity-minus:before",
    prop: "border-color",
    condition: "shop_general_quantity_style",
    cond_value: "style7",
    pseudo: true
  }, {
    option: "button_background_color",
    selector: ".quantity-button-style7 .quantity .botiga-quantity-plus, .quantity-button-style7 .quantity .botiga-quantity-minus",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style7"
  }, // style 8
  {
    option: "color_body_text",
    selector: ".quantity-button-style8 .quantity",
    prop: "border-color",
    condition: "shop_general_quantity_style",
    cond_value: "style8",
    rgba: 0.5
  }, {
    option: "button_background_color",
    selector: ".quantity-button-style8 .quantity .botiga-quantity-plus, .quantity-button-style8 .quantity .botiga-quantity-minus",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style8"
  }, {
    option: "button_background_color_hover",
    selector: ".quantity-button-style8 .quantity .botiga-quantity-plus:hover, .quantity-button-style8 .quantity .botiga-quantity-minus:hover",
    prop: "background-color",
    condition: "shop_general_quantity_style",
    cond_value: "style8",
    pseudo: true
  }, // style 9
  {
    option: "color_body_text",
    selector: ".quantity, .quantity-button-style-arrows .botiga-quantity-plus:before, .quantity-button-style-arrows .botiga-quantity-minus:before",
    prop: "border-color",
    condition: "shop_general_quantity_style",
    cond_value: "style9",
    pseudo: true
  }, // Header Login/Register
  {
    option: "main_header_color",
    selector: ".header-login-register nav>a+a, .top-bar-login-register nav>a+a",
    prop: "border-top-color",
    pseudo: true,
    rgba: 0.08
  }, {
    option: "main_header_color",
    selector: ".header-login-register>a:after, .top-bar-login-register>a:after",
    prop: ["border-top-color", "border-right-color"],
    pseudo: true
  }];
  $.each($color_options, function (key, css) {
    var unit = typeof css.unit !== 'undefined' ? css.unit : '';

    if (typeof css.condition !== 'undefined') {
      if (typeof window.parent.window.wp.customize(css.condition) !== 'undefined') {
        if (window.parent.window.wp.customize.control(css.condition).setting._value !== css.cond_value) {
          return;
        }
      }
    }

    wp.customize(css.option, function (value) {
      value.bind(function (to) {
        if (!unit) {
          to = css.rgba !== 'undefined' ? hexToRGB(to, css.rgba) : to;
        }

        if (typeof css.pseudo === 'undefined') {
          if (typeof css.prop === 'string') {
            $(css.selector).css(css.prop, to + unit);
          } else {
            $.each(css.prop, function (propkey, propvalue) {
              $(css.selector).css(propvalue, to + unit);
            });
          }
        } else {
          var output = '';

          if (typeof css.prop === 'string') {
            output += css.selector + '{ ' + css.prop + ': ' + to + '!important; }';
          } else {
            $.each(css.prop, function (propkey, propvalue) {
              output += css.selector + '{ ' + propvalue + ': ' + to + '!important; }';
            });
          }

          if (output) {
            if ($('#botiga-customizer-styles-misc-' + css.option).get(0)) {
              var current = $('#botiga-customizer-styles-misc-' + css.option).text();
              $('#botiga-customizer-styles-misc-' + css.option).text(current + output);
            } else {
              $('head').append('<style id="botiga-customizer-styles-misc-' + css.option + '">' + output + '</style>');
            }
          }
        }
      });
    });
  });
})(jQuery);

function hideControls(options) {
  for (var i = 0; i < options.length; i++) {
    window.parent.window.wp.customize.control(options[i]).toggle(false);
    jQuery(window.parent.window.wp.customize.control(options[i]).container[0]).css('display', 'none');
  }
}

function showControls(options) {
  for (var i = 0; i < options.length; i++) {
    window.parent.window.wp.customize.control(options[i]).toggle(true);
  }
}

function hexToRGB(hex, alpha) {
  var r = parseInt(hex.slice(1, 3), 16),
      g = parseInt(hex.slice(3, 5), 16),
      b = parseInt(hex.slice(5, 7), 16);

  if (alpha) {
    return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
  } else {
    return "rgb(" + r + ", " + g + ", " + b + ")";
  }
}