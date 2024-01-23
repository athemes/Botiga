/**
 * Botiga Quick View
 * 
 * jQuery Dependant: true
 * 
 */

'use strict';

var botiga = botiga || {};
botiga.quickView = {
  init: function init() {
    this.build();
    this.events();
  },
  build: function build() {
    var _this = this,
      button = document.querySelectorAll('.botiga-quick-view'),
      popup = document.querySelector('.botiga-quick-view-popup'),
      closeButton = document.querySelector('.botiga-quick-view-popup-close-button'),
      popupContent = document.querySelector('.botiga-quick-view-popup-content-ajax');
    if (null === popup) {
      return false;
    }
    closeButton.addEventListener('click', function (e) {
      e.preventDefault();
    });
    popup.addEventListener('click', function (e) {
      if (null === e.target.closest('.botiga-quick-view-popup-content-ajax')) {
        popup.classList.remove('opened');
      }
    });
    for (var i = 0; i < button.length; i++) {
      button[i].addEventListener('click', function (e) {
        e.preventDefault();
        var productId = e.target.getAttribute('data-product-id'),
          nonce = e.target.getAttribute('data-nonce');
        popup.classList.add('opened');
        popup.classList.add('loading');
        var ajax = new XMLHttpRequest();
        ajax.open('POST', botiga.ajaxurl, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        ajax.onload = function () {
          if (this.status >= 200 && this.status < 400) {
            // If successful
            popupContent.innerHTML = this.response;
            var $wrapper = jQuery(popupContent);

            // Initialize gallery 
            var $gallery = $wrapper.find('.woocommerce-product-gallery');
            if ($gallery.length) {
              $gallery.trigger('wc-product-gallery-before-init', [$gallery.get(0), wc_single_product_params]);
              $gallery.wc_product_gallery(wc_single_product_params);
              $gallery.trigger('wc-product-gallery-after-init', [$gallery.get(0), wc_single_product_params]);
            }

            // Initialize variation gallery 
            if (botiga.variationGallery) {
              botiga.variationGallery.init($wrapper);
            }

            // Initialize size chart 
            if (botiga.sizeChart) {
              botiga.sizeChart.init($wrapper);
            }

            // Initialize product swatches mouseover 
            if (botiga.productSwatch && botiga.productSwatch.variationMouseOver) {
              botiga.productSwatch.variationMouseOver();
            }

            // Initialize product variable
            var variationsForm = document.querySelector('.botiga-quick-view-summary .variations_form');
            if (typeof wc_add_to_cart_variation_params !== 'undefined') {
              jQuery(variationsForm).wc_variation_form();
            }
            botiga.qtyButton.init('quick-view');
            if (typeof botiga.wishList !== 'undefined') {
              botiga.wishList.init();
            }
            $wrapper.find('.variations_form').each(function () {
              if (jQuery(this).data('misc-variations') === true) {
                return false;
              }

              // Move reset button
              botiga.misc.moveResetVariationButton(jQuery(this));

              // First load
              botiga.misc.checkIfHasVariationSelected(jQuery(this));

              // on change variation select
              jQuery(this).on('woocommerce_variation_select_change', function () {
                botiga.misc.checkIfHasVariationSelected(jQuery(this));
              });
              jQuery(this).data('misc-variations', true);
            });
            window.dispatchEvent(new Event('botiga.quickview.ajax.loaded'));
            popup.classList.remove('loading');
          }
        };
        ajax.send('action=botiga_quick_view_content&product_id=' + productId + '&nonce=' + nonce);
      });
    }
  },
  events: function events() {
    var _this = this;
    window.addEventListener('botiga.carousel.initialized', function () {
      _this.build();
    });
  }
};
jQuery(document).ready(function () {
  botiga.quickView.init();
});