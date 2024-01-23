/**
 * Botiga Ajax Add to Cart
 * 
 * jQuery Dependant: true
 * 
 */

'use strict';

var botiga = botiga || {};
botiga.single_ajax_add_to_cart = {
  init: function init() {
    var self = this;
    jQuery(document).on('click', '.single_add_to_cart_button', function (e) {
      e.preventDefault();
      var $button = jQuery(this),
        $form = $button.closest('form.cart'),
        data = {};
      data['add-to-cart'] = $button.val();
      data = $form.serializeArray().reduce(function (obj, item) {
        obj[item.name] = item.value;
        return obj;
      }, data);
      $button.removeClass('added').addClass('loading');
      jQuery.post({
        url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'botiga_single_ajax_add_to_cart'),
        data: data,
        success: function success(response) {
          if (!response) {
            return;
          }
          if (response.error && response.product_url) {
            window.location = response.product_url;
            return;
          }
          if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
            window.location = wc_add_to_cart_params.cart_url;
            return;
          }
          jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $button]);
          jQuery('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
          jQuery('.woocommerce-notices-wrapper').append(response.fragments.notices);
          $button.removeClass('loading').addClass('added');
        }
      });
    });
    jQuery('.botiga-single-addtocart-wrapper .quantity .qty').on('change', this.quantityValidation);
  },
  quantityValidation: function quantityValidation() {
    var qtyInput = jQuery(this);
    if (!qtyInput.length) {
      return false;
    }
    var min = qtyInput.attr('min') !== '' ? parseFloat(qtyInput.attr('min')) : false,
      max = qtyInput.attr('max') !== '' ? parseFloat(qtyInput.attr('max')) : false,
      step = qtyInput.attr('step') !== '' ? parseFloat(qtyInput.attr('step')) : 1,
      qtyVal = Math.floor((parseFloat(qtyInput.val()) - min) / step) * step + min;

    // Empty.
    if (qtyInput.val() === '') {
      qtyInput.val(min);
      return false;
    }

    // Min.
    if (min && qtyVal < min) {
      qtyInput.val(min);
      return false;
    }

    // Max.
    if (max && qtyVal > max) {
      qtyInput.val(max);
      return false;
    }
    qtyInput.val(qtyVal);
  }
};
jQuery(document).ready(function () {
  botiga.single_ajax_add_to_cart.init();
});