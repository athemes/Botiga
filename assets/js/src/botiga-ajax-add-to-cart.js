/**
 * Botiga Ajax Add to Cart
 * 
 * jQuery Dependant: true
 * 
 */

'use strict';

var botiga = botiga || {};

botiga.single_ajax_add_to_cart = {

	init: function () {

		jQuery('.single_add_to_cart_button').on('click', function( e ) {

			e.preventDefault();

			var $button = jQuery(this);
			var $form   = $button.closest('form.cart');

			var data = {};
			
			data['add-to-cart'] = $button.val();

			data = $form.serializeArray().reduce( function( obj, item ) {
				obj[ item.name ] = item.value;
				return obj;
			}, data);

			$button.removeClass('added').addClass('loading');

			jQuery.post({
				url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'botiga_single_ajax_add_to_cart' ),
				data: data,
				success: function( response ) {

					if ( ! response ) {
						return;
					}

					if ( response.error && response.product_url ) {
						window.location = response.product_url;
						return;
					}

					if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
						window.location = wc_add_to_cart_params.cart_url;
						return;
					}

					jQuery(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, null]);
					jQuery('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
					jQuery('.woocommerce-notices-wrapper').append(response.fragments.notices);

					$button.removeClass('loading').addClass('added');

				}
			});

		});

	},

}

jQuery(document).ready(function () {
	botiga.single_ajax_add_to_cart.init();
});