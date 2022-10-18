/**
 * Botiga Gallery
 * 
 * jQuery Dependant: true
 * 
 */
'use strict';

var botiga = botiga || {};
botiga.gallery = {
  init: function init() {
    // fix quickview gallery thumbnails in "layout 2" mode
    jQuery(document).on('wc-product-gallery-after-init', '.woocommerce-product-gallery', function (event, gallery) {
      var $gallery = jQuery(gallery);

      if (!$gallery.parent().is('.gallery-quickview')) {
        return;
      }

      wc_single_product_params.flexslider.controlNav = 'thumbnails';
    });
    jQuery(document).on('wc-product-gallery-after-init', '.woocommerce-product-gallery', function (event, gallery) {
      var $gallery = jQuery(gallery);

      if (!$gallery.parent().is('.gallery-default, .gallery-vertical, .gallery-quickview')) {
        return;
      }

      var flexdata = $gallery.data('product_gallery');

      if (!flexdata || !flexdata.$images) {
        return;
      }

      var $flexItems = flexdata.$images;
      var $flexThumbs = $gallery.find('.flex-control-thumbs'); // pass carousel sliders if less than 5 items

      if ($flexItems.length <= 5) {
        return;
      }

      if ($gallery.parent().is('.gallery-vertical')) {
        $flexThumbs.addClass('swiper-wrapper botiga-slides');
        $flexThumbs.find('li').addClass('swiper-slide');
        $flexThumbs.wrapAll('<div class="swiper botiga-swiper"></div>');
        var $swiper = $gallery.find('.botiga-swiper');
        $swiper.append('<div class="botiga-swiper-button botiga-swiper-button-next"></div>');
        $swiper.append('<div class="botiga-swiper-button botiga-swiper-button-prev"></div>');
        var swiper = new Swiper($swiper.get(0), {
          direction: 'vertical',
          slidesPerView: 6,
          spaceBetween: 20,
          navigation: {
            nextEl: '.botiga-swiper-button-next',
            prevEl: '.botiga-swiper-button-prev'
          }
        });
        jQuery(window).on('resize botiga.resize', function () {
          var winWidth = window.innerWidth || document.documentElement.clientWidth;

          if (winWidth < 991 && swiper.params.direction !== 'horizontal') {
            swiper.changeDirection('horizontal');
            swiper.params.slidesPerView = 5;
            swiper.update();
          } else if (winWidth > 991 && swiper.params.direction !== 'vertical') {
            swiper.changeDirection('vertical');
            swiper.params.slidesPerView = 6;
            swiper.update();
          }
        }).trigger('botiga.resize');
      } else if ($gallery.parent().is('.gallery-default, .gallery-quickview')) {
        $flexThumbs.addClass('botiga-slides');
        $flexThumbs.wrapAll('<div class="botiga-flexslider"></div>');
        var $slider = $gallery.find('.botiga-flexslider');
        var itemWidth = $gallery.parent().is('.gallery-quickview') ? 85 : 95;
        $slider.flexslider({
          namespace: 'botiga-flex-',
          selector: '.botiga-slides > li',
          animation: 'slide',
          controlNav: false,
          animationLoop: false,
          slideshow: false,
          itemWidth: itemWidth,
          itemMargin: 20,
          keyboard: false,
          asNavFor: $gallery.get(0)
        });
        var next_text = jQuery('.botiga-flexslider .botiga-flex-next').text();
        jQuery('.botiga-flexslider .botiga-flex-next').text('').append('<span>' + next_text + '</span>');
        var prev_text = jQuery('.botiga-flexslider .botiga-flex-prev').text();
        jQuery('.botiga-flexslider .botiga-flex-prev').text('').append('<span>' + prev_text + '</span>');
      }
    });
  }
};
jQuery(document).ready(function () {
  botiga.gallery.init();
});