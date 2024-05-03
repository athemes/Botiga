/**
 * Botiga Gallery
 * 
 * jQuery Dependant: true
 * 
 */

(function($){

	'use strict';

	let botiga = botiga || {};

	botiga.gallery = {
		productGallerySelector: '.woocommerce-product-gallery',

		/**
		 * Initialize.
		 * 
		 * @return {void}
		 */
		init: function () {
			$(document).on( 'wc-product-gallery-before-init', this.productGallerySelector, this.beforeProductGalleryInitHandler.bind( this ) );
			$(document).on( 'wc-product-gallery-after-init', this.productGallerySelector, this.afterProductGalleryInitHandler.bind( this ) );
		},

		/**
		 * Before Product Gallery Init Handler.
		 * 
		 * @param {Event} e
		 * @param {HTMLElement} galleryEl
		 * @return {void}
		 */
		beforeProductGalleryInitHandler: function (e, galleryEl) {
			const gallery = $(galleryEl);
			if ( ! gallery.parent().is('.gallery-quickview') ) {
				return;
			}

			wc_single_product_params.flexslider.controlNav = 'thumbnails';
		},

		/**
		 * After Product Gallery Init Handler.
		 * 
		 * @param {Event} e
		 * @param {HTMLElement} galleryEl
		 * @return {void}
		 */
		afterProductGalleryInitHandler: function (e, galleryEl) {
			const gallery = $(galleryEl);
			if ( ! gallery.parent().is('.gallery-default, .gallery-vertical, .gallery-quickview, .gallery-showcase, .gallery-full-width') ) {
				return;
			}

			const flexdata = gallery.data('product_gallery');
			if ( ! flexdata || ! flexdata.$images) {
				return;
			}

			var flexThumbs = gallery.find('.flex-control-thumbs');
			if ( flexThumbs.find('li').length <= 5 ) {
				return;
			}

			if ( gallery.parent().is('.gallery-vertical, .gallery-showcase') ) {
				flexThumbs.addClass('swiper-wrapper botiga-slides');
				flexThumbs.find('li').addClass('swiper-slide');
				flexThumbs.wrapAll('<div class="swiper botiga-swiper"></div>');

				const swiper = gallery.find('.botiga-swiper');
				swiper.append('<div class="botiga-swiper-button botiga-swiper-button-next"></div>');
				swiper.append('<div class="botiga-swiper-button botiga-swiper-button-prev"></div>');

				const swiperInstance = new Swiper(swiper.get(0), {
					direction: 'vertical',
					slidesPerView: 6,
					spaceBetween: 20,
					navigation: {
						nextEl: '.botiga-swiper-button-next',
						prevEl: '.botiga-swiper-button-prev',
					},
				});

				$(window).on('resize botiga.resize', function () {
					const winWidth = (window.innerWidth || document.documentElement.clientWidth);

					if ( winWidth < 991 && swiperInstance.params.direction !== 'horizontal' ) {
						swiperInstance.changeDirection('horizontal');
						swiperInstance.params.slidesPerView = 5;
						swiperInstance.update();
					} else if ( winWidth > 991 && swiperInstance.params.direction !== 'vertical' ) {
						swiperInstance.changeDirection('vertical');
						swiperInstance.params.slidesPerView = 6;
						swiperInstance.update();
					}
				}).trigger('botiga.resize');
			} else if (gallery.parent().is('.gallery-default, .gallery-quickview, .gallery-full-width')) {
				flexThumbs.addClass('botiga-slides');
				flexThumbs.wrapAll('<div class="botiga-flexslider"></div>');
				
				const slider = gallery.find('.botiga-flexslider');
				const itemWidth = (gallery.parent().is('.gallery-quickview')) ? 85 : 95;

				slider.flexslider({
					namespace: 'botiga-flex-',
					selector: '.botiga-slides > li',
					animation: 'slide',
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					itemWidth: itemWidth,
					itemMargin: 20,
					keyboard: false,
					asNavFor: gallery.get(0),
				});

				const next_text = $( '.botiga-flexslider .botiga-flex-next' ).text();
				$( '.botiga-flexslider .botiga-flex-next' ).text('').append( '<span>'+ next_text +'</span>' );

				const prev_text = $( '.botiga-flexslider .botiga-flex-prev' ).text();
				$( '.botiga-flexslider .botiga-flex-prev' ).text('').append( '<span>'+ prev_text +'</span>' );
			}
		},
	}

	$(document).ready(function () {
		botiga.gallery.init();
	});

})(jQuery);