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
  // Button Selectors
  var buttonSelector = 'button, a.button, .wp-block-button__link, ul.wc-block-grid__products li.wc-block-grid__product .wp-block-button__link, ul.wc-block-grid__products li.wc-block-grid__product .button, ul.products li.product .button, input[type="button"], input[type="reset"], input[type="submit"]';
  var loopPostTitleSelector = '.posts-archive .entry-title';
  var singlePostTitleSelector = '.single .entry-header .entry-title';
  var singleProductTitleSelector = '.product-gallery-summary .entry-title';
  var shopProductTitleSelector = 'ul.products li.product .botiga-wc-loop-product__title, ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-title, ul.wc-block-grid__products li.wc-block-grid__product .woocommerce-loop-product__title, ul.wc-block-grid__products li.product .wc-block-grid__product-title, ul.wc-block-grid__products li.product .woocommerce-loop-product__title, ul.products li.wc-block-grid__product .wc-block-grid__product-title, ul.products li.wc-block-grid__product .woocommerce-loop-product__title, ul.products li.product .wc-block-grid__product-title, ul.products li.product .woocommerce-loop-product__title, ul.products li.product .woocommerce-loop-category__title, .woocommerce-loop-product__title .botiga-wc-loop-product__title'; //Responsive Devices Variable

  var $devices = {
    "desktop": "(min-width: 992px)",
    "tablet": "(min-width: 576px) and (max-width: 991px)",
    "mobile": "(max-width: 575px)"
  }; // Site title and description.

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
      $('.botiga-offcanvas-menu .botiga-dropdown ul li').css('text-align', to);
    });
  });
  wp.customize('mobile_menu_link_spacing', function (value) {
    value.bind(function (to) {
      $('.botiga-offcanvas-menu .botiga-dropdown a').css('padding-top', to / 2);
      $('.botiga-offcanvas-menu .botiga-dropdown a').css('padding-bottom', to / 2);
    });
  });
  wp.customize('mobile_menu_elements_spacing', function (value) {
    value.bind(function (to) {
      $('.botiga-offcanvas-menu .header-item + .header-item:not(.separator)').css('margin-top', to + 'px');
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
      $('.botiga-offcanvas-menu .botiga-dropdown ul li').css('border-bottom-width', to + 'px');
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
      $('.header_layout_7 .botiga-desktop-offcanvas .botiga-dropdown .menu > li > a, .header_layout_8 .botiga-desktop-offcanvas .botiga-dropdown .menu > li > a').css({
        'padding-top': to + 'px',
        'padding-bottom': to + 'px'
      });
    });
  });
  wp.customize('desktop_offcanvas_link_separator_color', function (value) {
    value.bind(function (to) {
      var desktop_offcanvas_menu_link_separator = window.parent.window.wp.customize.control('desktop_offcanvas_menu_link_separator').setting.get();

      if (desktop_offcanvas_menu_link_separator) {
        $('.header_layout_7 .botiga-desktop-offcanvas .botiga-dropdown .menu > li + li, .header_layout_8 .botiga-desktop-offcanvas .botiga-dropdown .menu > li + li').css({
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
      var footer_width = window.parent.window.wp.customize.control('footer_credits_divider_width').setting.get();

      if (footer_width === 'contained') {
        $('.site-info').css('border-width', to);
      } else {
        $('.site-footer').css('border-width', to);
      }
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
  $.each($devices, function (device, mediaSize) {
    wp.customize('scrolltop_side_offset' + '_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-scrolltop_side_offset_' + device).remove();
        var output = '@media ' + mediaSize + ' { .back-to-top.position-right { right:' + to + 'px; } }';
        output += '@media ' + mediaSize + ' { .back-to-top.position-left { left:' + to + 'px; } }';
        $('head').append('<style id="botiga-customizer-styles-scrolltop_side_offset_' + device + '">' + output + '</style>');
      });
    });
    wp.customize('scrolltop_bottom_offset' + '_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-scrolltop_bottom_offset_' + device).remove();
        var output = '@media ' + mediaSize + ' { .back-to-top.display { bottom:' + to + 'px; } }';
        $('head').append('<style id="botiga-customizer-styles-scrolltop_bottom_offset_' + device + '">' + output + '</style>');
      });
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
      $('ul.products li.product .product-description-column:not(:empty), ul.products li.wc-block-grid__product .product-description-column:not(:empty), ul.wc-block-grid__products li.wc-block-grid__product .product-description-column:not(:empty)').css('margin-top', to + 'px');
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
      var margin_side = 'right';

      if ($('html[dir="rtl"]').length) {
        margin_side = 'left';
      }

      $('.botiga-single-sticky-add-to-cart-wrapper .botiga-single-sticky-add-to-cart-wrapper-content .botiga-single-sticky-add-to-cart-item').css("margin-".concat(margin_side), to + 'px');
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
  }); // Floating Mini Cart Icon Size

  wp.customize('side_mini_cart_floating_icon_size', function (value) {
    value.bind(function (to) {
      $('.botiga-floating-mini-cart-icon').css('font-size', to + 'px');
    });
  }); // Floating Mini Cart Icon Position

  wp.customize('side_mini_cart_floating_icon_position', function (value) {
    value.bind(function (to) {
      var corner_offset = wp.customize('side_mini_cart_floating_icon_corner_offset').get();

      if (to === 'left') {
        $('.botiga-floating-mini-cart-icon').css('bottom', corner_offset + 'px');
        $('.botiga-floating-mini-cart-icon').css('left', corner_offset + 'px');
        $('.botiga-floating-mini-cart-icon').css('right', 'auto');
      } else {
        $('.botiga-floating-mini-cart-icon').css('bottom', corner_offset + 'px');
        $('.botiga-floating-mini-cart-icon').css('right', corner_offset + 'px');
        $('.botiga-floating-mini-cart-icon').css('left', 'auto');
      }
    });
  }); // Floating Mini Cart Icon Corner Offset

  $.each($devices, function (device, mediaSize) {
    wp.customize('side_mini_cart_floating_icon_corner_offset' + '_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-side_mini_cart_floating_icon_corner_offset_' + device).remove();
        var output = '@media ' + mediaSize + ' { .botiga-floating-mini-cart-icon { bottom:' + to + 'px; } }';

        if (typeof wp.customize('side_mini_cart_floating_icon_position') !== 'undefined') {
          if (wp.customize('side_mini_cart_floating_icon_position').get() === 'left') {
            $('.botiga-floating-mini-cart-icon').css('left', to + 'px');
            output += '@media ' + mediaSize + ' { .botiga-floating-mini-cart-icon { left:' + to + 'px; } }';
          } else {
            output += '@media ' + mediaSize + ' { .botiga-floating-mini-cart-icon { right:' + to + 'px; } }';
          }
        }

        $('head').append('<style id="botiga-customizer-styles-side_mini_cart_floating_icon_corner_offset_' + device + '">' + output + '</style>');
      });
    });
  }); // Floating Mini Cart Icon Border Radius

  wp.customize('side_mini_cart_floating_icon_border_radius', function (value) {
    value.bind(function (to) {
      $('.botiga-floating-mini-cart-icon .botiga-floating-mini-cart-icon-icon').css('border-radius', to + 'px');
    });
  }); // Floating Mini Cart Icon Shadow

  wp.customize('side_mini_cart_floating_icon_shadow', function (value) {
    value.bind(function (to) {
      if (to) {
        $('.botiga-floating-mini-cart-icon .botiga-floating-mini-cart-icon-icon').css('box-shadow', 'inset 0 0 2px rgb(0 0 0 / 3%), 0 4px 10px rgb(0 0 0 / 17%)');
      } else {
        $('.botiga-floating-mini-cart-icon .botiga-floating-mini-cart-icon-icon').css('box-shadow', 'none');
      }
    });
  });
  var $topBottPad = {
    "breadcrumbs_padding": ".botiga-breadcrumb-trail",
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
  var $marginBottom = {
    "breadcrumbs_margin_bottom": ".botiga-breadcrumb-trail"
  };
  $.each($marginBottom, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { margin-bottom:' + to + 'px; } }';
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
    "header_menu_font_size": ".top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation",
    "h1_font_size": "h1:not(.site-title)",
    "h2_font_size": "h2",
    "h3_font_size": "h3",
    "h4_font_size": "h4",
    "h5_font_size": "h5",
    "h6_font_size": "h6",
    "single_product_title_size": ".product-gallery-summary .entry-title, .botiga-tb-sp-title h1",
    "single_product_price_size": ".product-gallery-summary .price",
    "loop_post_text_size": ".posts-archive .entry-content",
    "loop_post_meta_size": ".posts-archive .entry-meta",
    "loop_post_title_size": ".posts-archive .entry-title",
    "single_post_title_size": ".single .entry-header .entry-title",
    "single_post_meta_size": ".single .entry-meta",
    "footer_widgets_title_size": ".widget-column .widget .widget-title",
    "shop_product_title_size": shopProductTitleSelector
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
      var buttonFontStyle = window.parent.window.wp.customize.control('button_font_style').setting.get();

      if (buttonFontStyle === 'body') {
        $(buttonSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(buttonSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var loopPostTitleFontStyle = window.parent.window.wp.customize.control('loop_post_title_font_style').setting.get();

      if (loopPostTitleFontStyle === 'body') {
        $(loopPostTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(loopPostTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var singlePostTitleFontStyle = window.parent.window.wp.customize.control('single_post_title_font_style').setting.get();

      if (singlePostTitleFontStyle === 'body') {
        $(singlePostTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(singlePostTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var singleProductTitleFontStyle = window.parent.window.wp.customize.control('single_product_title_font_style').setting.get();

      if (singleProductTitleFontStyle === 'body') {
        $(singleProductTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(singleProductTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var shopProductTitleFontStyle = window.parent.window.wp.customize.control('shop_product_title_font_style').setting.get();

      if (shopProductTitleFontStyle === 'body') {
        $(shopProductTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(shopProductTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }
    });
  });
  wp.customize('botiga_headings_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-headings-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-headings-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-headings-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $('h1,h2,h3,h4,h5,h6,.site-title').css('font-family', jQuery.parseJSON(to)['font']);
      $('h1,h2,h3,h4,h5,h6,.site-title').css('font-weight', jQuery.parseJSON(to)['regularweight']);
      var buttonFontStyle = window.parent.window.wp.customize.control('button_font_style').setting.get();

      if (buttonFontStyle === 'heading') {
        $(buttonSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(buttonSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var loopPostTitleFontStyle = window.parent.window.wp.customize.control('loop_post_title_font_style').setting.get();

      if (loopPostTitleFontStyle === 'heading') {
        $(loopPostTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(loopPostTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var singlePostTitleFontStyle = window.parent.window.wp.customize.control('single_post_title_font_style').setting.get();

      if (singlePostTitleFontStyle === 'heading') {
        $(singlePostTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(singlePostTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var singleProductTitleFontStyle = window.parent.window.wp.customize.control('single_product_title_font_style').setting.get();

      if (singleProductTitleFontStyle === 'heading') {
        $(singleProductTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(singleProductTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }

      var shopProductTitleFontStyle = window.parent.window.wp.customize.control('shop_product_title_font_style').setting.get();

      if (shopProductTitleFontStyle === 'heading') {
        $(shopProductTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
        $(shopProductTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
      }
    });
  });
  wp.customize('botiga_header_menu_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-header-menu-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-header-menu-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-header-menu-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('font-family', jQuery.parseJSON(to)['font']);
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('button_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-button-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-button-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-button-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $(buttonSelector).css('font-family', jQuery.parseJSON(to)['font']);
      $(buttonSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('loop_post_title_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-loop-post-title-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-loop-post-title-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-loop-post-title-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $(loopPostTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
      $(loopPostTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('loop_post_title_text_transform', function (value) {
    value.bind(function (to) {
      $(loopPostTitleSelector).css('text-transform', to);
    });
  });
  wp.customize('loop_post_title_text_decoration', function (value) {
    value.bind(function (to) {
      $(loopPostTitleSelector).css('text-decoration', to);
    });
  });
  wp.customize('single_post_title_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-single-post-title-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-single-post-title-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-single-post-title-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $(singlePostTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
      $(singlePostTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('single_post_title_text_transform', function (value) {
    value.bind(function (to) {
      $(singlePostTitleSelector).css('text-transform', to);
    });
  });
  wp.customize('single_post_title_text_decoration', function (value) {
    value.bind(function (to) {
      $(singlePostTitleSelector).css('text-decoration', to);
    });
  });
  wp.customize('single_product_title_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-single-product-title-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-single-product-title-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-single-product-title-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $(singleProductTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
      $(singleProductTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('single_product_title_text_transform', function (value) {
    value.bind(function (to) {
      $(singleProductTitleSelector).css('text-transform', to);
    });
  });
  wp.customize('single_product_title_text_decoration', function (value) {
    value.bind(function (to) {
      $(singleProductTitleSelector).css('text-decoration', to);
    });
  });
  wp.customize('shop_product_title_font', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-preview-google-fonts-shop-product-title-css').remove();
      $('head').append('<link id="botiga-preview-google-fonts-shop-product-title-css" href="" rel="stylesheet">');
      $('#botiga-preview-google-fonts-shop-product-title-css').attr('href', 'https://fonts.googleapis.com/css?family=' + jQuery.parseJSON(to)['font'].replace(/ /g, '+') + ':' + jQuery.parseJSON(to)['regularweight'] + '&display=swap');
      $(shopProductTitleSelector).css('font-family', jQuery.parseJSON(to)['font']);
      $(shopProductTitleSelector).css('font-weight', jQuery.parseJSON(to)['regularweight']);
    });
  });
  wp.customize('shop_product_title_text_transform', function (value) {
    value.bind(function (to) {
      $(shopProductTitleSelector).css('text-transform', to);
    });
  });
  wp.customize('shop_product_title_text_decoration', function (value) {
    value.bind(function (to) {
      $(shopProductTitleSelector).css('text-decoration', to);
    });
  }); //Typography - Custom Fonts

  var embedCustomFonts = function embedCustomFonts(data) {
    data = JSON.parse(data) || [];
    $.each(data, function (index, font) {
      if (font.name && (font.woff2 || font.woff || font.ttf || font.eot || font.otf || font.svg)) {
        var fontFaceStyle = font.name.replace(/ /g, '-').toLowerCase();

        if ($('#' + fontFaceStyle).length) {
          $('#' + fontFaceStyle).remove();
        }

        var src = [];

        if (font.woff2) {
          src.push('url("' + font.woff2 + '") format("woff2");');
        }

        if (font.woff) {
          src.push('url("' + font.woff + '") format("woff");');
        }

        if (font.svg) {
          src.push('url("' + font.svg + '") format("svg");');
        }

        if (font.ttf) {
          src.push('url("' + font.ttf + '") format("truetype");');
        }

        if (font.otf) {
          src.push('url("' + font.otf + '") format("opentype");');
        }

        if (font.eot) {
          src.push('url("' + font.eot + '?#iefix") format("embedded-opentype");');
        }

        if (src.length) {
          var css = '';
          css += '@font-face{ font-family: "' + font.name + '";';

          if (font.eot) {
            css += 'src: url(' + font.eot + ');';
          }

          css += 'src: ' + src.join(',') + ';';
          css += '}';
          $('head').append('<style id="' + fontFaceStyle + '" type="text/css">' + css + '</style>');
        }
      }
    });
  };

  var customFontsControl = window.parent.window.wp.customize.control('custom_fonts');

  if (customFontsControl) {
    embedCustomFonts(customFontsControl.setting.get());
  }

  wp.customize('custom_fonts', function (value) {
    value.bind(function (to) {
      embedCustomFonts(to);
    });
  });

  var embedCustomGoogleFonts = function embedCustomGoogleFonts($selector, option, type) {
    var control = window.parent.window.wp.customize.control(option + '_typography');
    var settings = window.parent.window._wpCustomizeSettings.controls[option + '_typography'];
    var family = control.settings['font-family'].get();
    var weight = control.settings['font-weight'].get();
    $selector.css('font-weight', 'normal');

    if (settings && settings.google_fonts) {
      $.map(settings.google_fonts, function (obj, index) {
        if (obj.family === family) {
          if (type === 'family') {
            weight = obj.variants[0];
          }

          var styleId = family.replace(/ /g, '-').toLowerCase() + '-' + weight;
          var styleHref = 'https://fonts.googleapis.com/css?family=' + family.replace(/ /g, '+') + ':' + weight + '&display=swap';

          if ($('#' + styleId).length === 0) {
            $('head').append('<link id="' + styleId + '" href="' + styleHref + '" rel="stylesheet">');
          }

          $selector.css('font-weight', weight);
        }
      });
    }

    $selector.css('font-family', family);
  };

  wp.customize('botiga_headings_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $('h1,h2,h3,h4,h5,h6,.site-title');
      embedCustomGoogleFonts($selector, 'botiga_headings_custom_font', 'family');
    });
  });
  wp.customize('botiga_headings_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $('h1,h2,h3,h4,h5,h6,.site-title');
      embedCustomGoogleFonts($selector, 'botiga_headings_custom_font', 'weight');
    });
  });
  wp.customize('botiga_body_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $('body');
      embedCustomGoogleFonts($selector, 'botiga_body_custom_font', 'family');
    });
  });
  wp.customize('botiga_body_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $('body');
      embedCustomGoogleFonts($selector, 'botiga_body_custom_font', 'weight');
    });
  });
  wp.customize('botiga_header_menu_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation');
      embedCustomGoogleFonts($selector, 'botiga_header_menu_custom_font', 'family');
    });
  });
  wp.customize('botiga_header_menu_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation');
      embedCustomGoogleFonts($selector, 'botiga_header_menu_custom_font', 'weight');
    });
  });
  wp.customize('button_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $(buttonSelector);
      embedCustomGoogleFonts($selector, 'button_custom_font', 'family');
    });
  });
  wp.customize('button_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $(buttonSelector);
      embedCustomGoogleFonts($selector, 'button_custom_font', 'weight');
    });
  });
  wp.customize('loop_post_title_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $(loopPostTitleSelector);
      embedCustomGoogleFonts($selector, 'loop_post_title_custom_font', 'family');
    });
  });
  wp.customize('loop_post_title_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $(loopPostTitleSelector);
      embedCustomGoogleFonts($selector, 'loop_post_title_custom_font', 'weight');
    });
  });
  wp.customize('single_post_title_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $(singlePostTitleSelector);
      embedCustomGoogleFonts($selector, 'single_post_title_custom_font', 'family');
    });
  });
  wp.customize('single_post_title_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $(singlePostTitleSelector);
      embedCustomGoogleFonts($selector, 'single_post_title_custom_font', 'weight');
    });
  });
  wp.customize('single_product_title_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $(singleProductTitleSelector);
      embedCustomGoogleFonts($selector, 'single_product_title_custom_font', 'family');
    });
  });
  wp.customize('single_product_title_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $(singleProductTitleSelector);
      embedCustomGoogleFonts($selector, 'single_product_title_custom_font', 'weight');
    });
  });
  wp.customize('shop_product_title_custom_font', function (value) {
    value.bind(function (to) {
      var $selector = $(shopProductTitleSelector);
      embedCustomGoogleFonts($selector, 'shop_product_title_custom_font', 'family');
    });
  });
  wp.customize('shop_product_title_custom_font_weight', function (value) {
    value.bind(function (to) {
      var $selector = $(shopProductTitleSelector);
      embedCustomGoogleFonts($selector, 'shop_product_title_custom_font', 'weight');
    });
  }); //Typography - Adobe Type Kit Fonts

  wp.customize('botiga_headings_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $('h1,h2,h3,h4,h5,h6,.site-title').css('font-family', family);
      $('h1,h2,h3,h4,h5,h6,.site-title').css('font-weight', weight);
    });
  });
  wp.customize('botiga_body_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $('body').css('font-family', family);
      $('body').css('font-weight', weight);
    });
  });
  wp.customize('botiga_header_menu_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('font-family', family);
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('font-weight', weight);
    });
  });
  wp.customize('button_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $(buttonSelector).css('font-family', family);
      $(buttonSelector).css('font-weight', weight);
    });
  });
  wp.customize('loop_post_title_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $(loopPostTitleSelector).css('font-family', family);
      $(loopPostTitleSelector).css('font-weight', weight);
    });
  });
  wp.customize('single_post_title_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $(singlePostTitleSelector).css('font-family', family);
      $(singlePostTitleSelector).css('font-weight', weight);
    });
  });
  wp.customize('single_product_title_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $(singleProductTitleSelector).css('font-family', family);
      $(singleProductTitleSelector).css('font-weight', weight);
    });
  });
  wp.customize('shop_product_title_adobe_font', function (value) {
    value.bind(function (to) {
      var family = to.split('|')[0],
          weight = to.split('|')[1];
      $(shopProductTitleSelector).css('font-family', family);
      $(shopProductTitleSelector).css('font-weight', weight);
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
  wp.customize('header_menu_font_style', function (value) {
    value.bind(function (to) {
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('font-style', to);
    });
  });
  wp.customize('header_menu_line_height', function (value) {
    value.bind(function (to) {
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('line-height', to);
    });
  });
  wp.customize('header_menu_letter_spacing', function (value) {
    value.bind(function (to) {
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('letter-spacing', to + 'px');
    });
  });
  wp.customize('header_menu_text_transform', function (value) {
    value.bind(function (to) {
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('text-transform', to);
    });
  });
  wp.customize('header_menu_text_decoration', function (value) {
    value.bind(function (to) {
      $('.top-bar .secondary-navigation, #masthead .main-navigation, .botiga-offcanvas-menu .main-navigation, .bottom-header-row .main-navigation, .bhfb-header .main-navigation, .bhfb-header .secondary-navigation').css('text-decoration', to);
    });
  }); // Shop Header Style

  wp.customize('shop_archive_header_padding_top', function (value) {
    value.bind(function (to) {
      $('.woocommerce-page-header').css('padding-top', to + 'px');
    });
  });
  wp.customize('shop_archive_header_padding_bottom', function (value) {
    value.bind(function (to) {
      $('.woocommerce-page-header').css('padding-bottom', to + 'px');
    });
  });
  wp.customize('shop_archive_header_button_border_radius', function (value) {
    value.bind(function (to) {
      $('.woocommerce-page-header .category-button').css('border-radius', to + 'px');
    });
  }); // Breadcrumbs

  wp.customize('breadcrumbs_align', function (value) {
    value.bind(function (to) {
      $('.botiga-breadcrumb-trail').css('text-align', to);
    });
  }); // Modal Popup

  wp.customize('modal_popup_content_padding', function (value) {
    value.bind(function (to) {
      $('.botiga-popup-wrapper').css('padding', to + 'px');
    });
  }); // Predefined palettes listener.

  wp.customize('color_palettes', function (value) {
    value.bind(function (to) {
      if (to === '') {
        return;
      }

      var palettes = $('#customize-control-color_palettes', window.parent.document).find('.radio-buttons').data('palettes');

      for (var i = 0; i < 8; i++) {
        $('.has-color-' + i + '-color').css('color', palettes[to][i]);
        $('.has-color-' + i + '-background-color').css('background-color', palettes[to][i]);
      }
    });
  }); // Custom color palette listener.

  $.each([0, 1, 2, 3, 4, 5, 6, 7, 8], function (i) {
    wp.customize('custom_color' + (i + 1), function (value) {
      value.bind(function (to) {
        $('.has-color-' + i + '-color').css('color', to);
        $('.has-color-' + i + '-background-color').css('background-color', to);
      });
    });
  }); // Button options

  wp.customize('button_letter_spacing', function (value) {
    value.bind(function (to) {
      $(buttonSelector).css('letter-spacing', to + 'px');
    });
  });
  wp.customize('button_text_transform', function (value) {
    value.bind(function (to) {
      $(buttonSelector).css('text-transform', to);
    });
  });
  wp.customize('button_text_decoration', function (value) {
    value.bind(function (to) {
      $(buttonSelector).css('text-decoration', to);
    });
  });
  wp.customize('button_border_radius', function (value) {
    value.bind(function (to) {
      $(buttonSelector).css('border-radius', to + 'px');
    });
  });
  var $buttonFontSize = {
    'button_font_size': buttonSelector
  };
  $.each($buttonFontSize, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { font-size:' + to + 'px !important; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  });
  var $buttonTBPadding = {
    'button_top_bottom_padding': buttonSelector
  };
  $.each($buttonTBPadding, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { padding-top:' + to + 'px !important; padding-bottom:' + to + 'px !important; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  });
  var $buttonLRPadding = {
    'button_left_right_padding': buttonSelector
  };
  $.each($buttonLRPadding, function (option, selector) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + selector + ' { padding-left:' + to + 'px !important; padding-right:' + to + 'px !important; } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  }); // Header Search Form

  wp.customize('bhfb_search_form_button_margin_left', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-bhfb_search_form_button_margin_left').remove();
      var output = '.header-search-form form button { margin-left:' + to + 'px !important; }';

      if (to < 0) {
        output += '.header-search-form form .search-field { padding-right:' + Math.abs(to) + 'px !important; }';
      } else {
        output += '.header-search-form form .search-field { padding-right: 1em !important; }';
      }

      $('head').append('<style id="botiga-customizer-styles-bhfb_search_form_button_margin_left">' + output + '</style>');
    });
  });
  wp.customize('bhfb_search_form_size', function (value) {
    value.bind(function (to) {
      $('.header-search-form form button, .header-search-form form .search-field, .header-search-form .botiga-select, .header-search-form .botiga-select select').css('font-size', to + 'rem');
    });
  });
  wp.customize('bhfb_search_form_input_border_radius', function (value) {
    value.bind(function (to) {
      $('.header-search-form form .search-field, .header-search-form .botiga-select select').css('border-radius', to + 'px');
    });
  });
  wp.customize('bhfb_search_form_button_border_radius', function (value) {
    value.bind(function (to) {
      $('.header-search-form form button').css('border-radius', to + 'px');
    });
  });
  $.each($devices, function (device, mediaSize) {
    wp.customize('bhfb_search_form_width' + '_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-bhfb_search_form_width_' + device).remove();
        var output = '@media ' + mediaSize + ' { .header-search-form { width:' + to + 'px; } }';
        $('head').append('<style id="botiga-customizer-styles-bhfb_search_form_width_' + device + '">' + output + '</style>');
      });
    });
  });
  wp.customize('bhfb_search_form_product_cat_dropdown_margin_right', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-bhfb_search_form_product_cat_dropdown_margin_right').remove();
      var output = '.header-search-form .botiga-select { margin-right:' + to + 'px !important; }';
      $('head').append('<style id="botiga-customizer-styles-bhfb_search_form_product_cat_dropdown_margin_right">' + output + '</style>');
    });
  }); // Product Swatches
  // Swatch button

  $.each($devices, function (device, mediaSize) {
    wp.customize('product_swatch_button_left_right_padding_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + 'product_swatch_button_left_right_padding_' + device).remove();
        var output = '@media ' + mediaSize + ' { .botiga-variations-wrapper .botiga-variation-type-button > a { padding-left:' + to + 'px !important; padding-right:' + to + 'px !important; } }';
        $('head').append('<style id="botiga-customizer-styles-' + 'product_swatch_button_left_right_padding_' + device + '">' + output + '</style>');
      });
    });
  });
  $.each($devices, function (device, mediaSize) {
    wp.customize('product_swatch_button_top_bottom_padding_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + 'product_swatch_button_top_bottom_padding_' + device).remove();
        var output = '@media ' + mediaSize + ' { .botiga-variations-wrapper .botiga-variation-type-button > a { padding-top:' + to + 'px !important; padding-bottom:' + to + 'px !important; } }';
        $('head').append('<style id="botiga-customizer-styles-' + 'product_swatch_button_top_bottom_padding_' + device + '">' + output + '</style>');
      });
    });
  });
  $.each($devices, function (device, mediaSize) {
    wp.customize('product_swatch_button_spacing_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + 'product_swatch_button_spacing_' + device).remove();
        var output = '@media ' + mediaSize + ' { .botiga-variations-wrapper .botiga-variation-type-button { grid-gap:' + to + 'px !important; } }';
        $('head').append('<style id="botiga-customizer-styles-' + 'product_swatch_button_spacing_' + device + '">' + output + '</style>');
      });
    });
  });
  wp.customize('product_swatch_button_border_width', function (value) {
    value.bind(function (to) {
      $('.botiga-variations-wrapper .botiga-variation-type-button > a').css('border-width', to + 'px');
    });
  });
  wp.customize('product_swatch_button_border_radius', function (value) {
    value.bind(function (to) {
      $('.botiga-variations-wrapper .botiga-variation-type-button > a').css('border-radius', to + 'px');
    });
  }); // Swatch image

  $.each($devices, function (device, mediaSize) {
    wp.customize('product_swatch_image_width_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + 'product_swatch_image_width_' + device).remove();
        var output = '@media ' + mediaSize + ' { .botiga-variations-wrapper .botiga-variation-type-image > a { width:' + to + 'px !important; } }';
        $('head').append('<style id="botiga-customizer-styles-' + 'product_swatch_image_width_' + device + '">' + output + '</style>');
      });
    });
  });
  $.each($devices, function (device, mediaSize) {
    wp.customize('product_swatch_image_height_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + 'product_swatch_image_height_' + device).remove();
        var output = '@media ' + mediaSize + ' { .botiga-variations-wrapper .botiga-variation-type-image > a { height:' + to + 'px !important; } }';
        $('head').append('<style id="botiga-customizer-styles-' + 'product_swatch_image_height_' + device + '">' + output + '</style>');
      });
    });
  });
  $.each($devices, function (device, mediaSize) {
    wp.customize('product_swatch_image_spacing_' + device, function (value) {
      value.bind(function (to) {
        $('head').find('#botiga-customizer-styles-' + 'product_swatch_image_spacing_' + device).remove();
        var output = '@media ' + mediaSize + ' { .botiga-variations-wrapper .botiga-variation-type-image { grid-gap:' + to + 'px !important; } }';
        $('head').append('<style id="botiga-customizer-styles-' + 'product_swatch_image_spacing_' + device + '">' + output + '</style>');
      });
    });
  });
  wp.customize('product_swatch_image_border_width', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-product_swatch_image_border_width').remove();
      var output = '.botiga-variations-wrapper .botiga-variation-type-image > a { border-width:' + to + 'px !important; }';
      $('head').append('<style id="botiga-customizer-styles-product_swatch_image_border_width">' + output + '</style>');
    });
  });
  wp.customize('product_swatch_image_border_radius', function (value) {
    value.bind(function (to) {
      $('head').find('#botiga-customizer-styles-product_swatch_image_border_radius').remove();
      var selector = '.botiga-variations-wrapper .botiga-variation-type-image > a,';
      selector += '.botiga-variations-wrapper .botiga-variation-type-image > a img,';
      selector += '.botiga-variations-wrapper .botiga-variation-type-image > a:not(.disabled):before';
      $('head').append('<style id="botiga-customizer-styles-product_swatch_image_border_radius">' + selector + '{ border-radius:' + to + 'px !important; }</style>');
    });
  }); // Add To Cart Notifications
  // Force the display of notification when the the respective feature section is active
  // This will provide better UX while customizing

  if (typeof window.parent.wp.customize.section('botiga_section_adtcnotif') !== 'undefined') {
    window.parent.wp.customize.section('botiga_section_adtcnotif').expanded.bind(function (isExpanded) {
      if (isExpanded) {
        $('.botiga-adtcnotif').addClass('active');
      } else {
        $('.botiga-adtcnotif').removeClass('active');
      }
    });
  }

  wp.customize.bind('preview-ready', function () {
    if (jQuery(window.parent.document).find('#sub-accordion-section-botiga_section_adtcnotif').hasClass('open')) {
      $('.botiga-adtcnotif').addClass('active');
    }
  }); // Theme options

  var $theme_options = botiga_theme_options;
  $.each($theme_options, function (key, css) {
    wp.customize(css.option, function (value) {
      value.bind(function (to, prev) {
        var output = '';
        $.each($theme_options, function (key, css2) {
          if (css.option === css2.option) {
            var unit = typeof css2.unit !== 'undefined' ? css2.unit : '';

            if (typeof css2.condition !== 'undefined') {
              if (typeof window.parent.window.wp.customize(css2.condition) !== 'undefined') {
                if (window.parent.window.wp.customize.control(css2.condition).setting._value !== css2.cond_value) {
                  return;
                }
              }
            }

            if (!to) {
              return;
            }

            if (!unit && css2.type !== 'dimensions') {
              to = typeof css2.rgba !== 'undefined' ? hexToRGB(to, css2.rgba) : to;
            } // convert 'to' value to a dimensions format


            if (css2.type === 'dimensions') {
              if (!isJsonString(to)) {
                return;
              }

              to = JSON.parse(to);

              if (to.top === '' && to.right === '' && to.bottom === '' && to.left === '') {
                return;
              }

              to.top = to.top === '' ? 0 : to.top;
              to.right = to.right === '' ? 0 : to.right;
              to.bottom = to.bottom === '' ? 0 : to.bottom;
              to.left = to.left === '' ? 0 : to.left;
              to = to.top + to.unit + ' ' + to.right + to.unit + ' ' + to.bottom + to.unit + ' ' + to.left + to.unit;
            } // Check and convert value to be compatible with 'display' css property


            if (css2.type === 'display') {
              if (to === 'hidden') {
                to = 'none';
              } else {
                to = 'flex';
                css2.important = true;
              }
            }

            if (typeof css2.pseudo === 'undefined') {
              if (typeof css2.prop === 'string') {
                $(css2.selector).css(css2.prop, to + unit);
              } else {
                $.each(css2.prop, function (propkey, propvalue) {
                  $(css2.selector).css(propvalue, to + unit);
                });
              }
            } else {
              if (css2.is_responsive) {
                if (typeof css2.prop === 'string') {
                  output += '@media ' + $devices[css2.device] + ' { ' + css2.selector + ' { ' + css2.prop + ': ' + to + unit + ' ' + (css2.important ? '!important' : '') + '; } }';
                } else {
                  $.each(css2.prop, function (propkey, propvalue) {
                    output += '@media ' + $devices[css2.device] + ' { ' + css2.selector + ' { ' + propvalue + ': ' + to + unit + ' ' + (css2.important ? '!important' : '') + '; } }';
                  });
                }
              } else {
                if (typeof css2.prop === 'string') {
                  output += css2.selector + '{ ' + css2.prop + ': ' + to + unit + ' ' + (css2.important ? '!important' : '') + '; }';
                } else {
                  $.each(css2.prop, function (propkey, propvalue) {
                    if (typeof propvalue === 'string') {
                      output += css2.selector + '{ ' + propvalue + ': ' + to + unit + ' ' + (css2.important ? '!important' : '') + '; }';
                    } else {
                      output += css2.selector + '{ ' + propvalue.prop + ': ' + to + (propvalue.unit ? propvalue.unit : unit) + ' ' + (css2.important ? '!important' : '') + '; }';
                    }
                  });
                }
              }
            }
          }
        });
        var $style = $('#botiga-customizer-styles-misc-' + css.option);

        if (output) {
          if ($style.length) {
            $style.text(output);
          } else {
            $('head').append('<style id="botiga-customizer-styles-misc-' + css.option + '">' + output + '</style>');
          }
        } else if (!output && $style.length) {
          $style.remove();
        }
      });
    });
  }); // Padded Color

  wp.customize('background_color', function (value) {
    value.bind(function (to) {
      $(':root').css('--botiga_background_color', to);
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
  if (hex.indexOf('rgba') !== -1) {
    return hex;
  }

  var r = parseInt(hex.slice(1, 3), 16),
      g = parseInt(hex.slice(3, 5), 16),
      b = parseInt(hex.slice(5, 7), 16);

  if (alpha) {
    return "rgba(" + r + ", " + g + ", " + b + ", " + alpha + ")";
  } else {
    return "rgb(" + r + ", " + g + ", " + b + ")";
  }
}

function isJsonString(str) {
  try {
    JSON.parse(str);
  } catch (e) {
    return false;
  }

  return true;
}