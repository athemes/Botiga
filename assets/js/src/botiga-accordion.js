/**
 * Botiga Accordion
 * 
 * jQuery Dependant: true
 * 
 */
(function($){

	'use strict';

	let botiga = botiga || {};

	botiga.accordion = {

		/**
		 * Init
		 * 
		 * @return {void}
		 */
		init: function () {
			const self = this;

			$( '.botiga-accordion' ).each( function() {
				const toggle = $( this ).find( ' > .botiga-accordion-toggle' );
				const content = $( this ).find( '> .botiga-accordion-body' );

				toggle.on( 'click', function(e) { 
					e.preventDefault();

					self.slideToggleEffect( $( this ), content ); 
				});
				toggle.on( 'keyup', function(e) {
					if ( e.keyCode === 13 ) {
						self.slideToggleEffect( $( this ), content );
					}
				});
			});
		},
		
		/**
		 * Slide Toggle Effect
		 * 
		 * @param {object} triggerEl
		 * @param {object} content
		 * 
		 * @return {void}
		 */
		slideToggleEffect: function (triggerEl, content) {
			content.slideToggle( 300 );
			triggerEl.toggleClass( 'active' );
		}
	}

	$(document).ready(function () {
		botiga.accordion.init();
	});

})(jQuery);