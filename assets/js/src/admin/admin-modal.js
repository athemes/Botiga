/**
 * Botiga Admin Modal
 * 
 */
(function($){

	'use strict';

	var adminBotiga = adminBotiga || {};

	window.adminBotiga = adminBotiga;

	adminBotiga.modal = {
		triggerSelector: '.botiga-admin-modal-trigger',

		init: function() {
			const self = this;

			this.$modalPopup       = $('.botiga-admin-modal');
			this.$modalTrigger     = $( this.triggerSelector );
			this.$modalCloseButton = $('.botiga-admin-close-modal');

			this.$modalTrigger.on( 'click', this.openModal.bind( this ) );
			this.$modalCloseButton.on( 'click', this.closeModal.bind( this ) );
			this.$modalPopup.on( 'click', function(e) {
				if ( ! $( e.target ).closest( '.botiga-admin-modal-content' ).length ) {
					self.closeModal();
				}
			} );

			$( window ).trigger( 'botiga-admin-modal-after-init' );
		},

		/**
		 * Open Modal.
		 * 
		 * @return {void}
		 */
		openModal: function() {
			const e = event;
			e.preventDefault();

			const self = this;

			this.$modalPopup.addClass('active');

			setTimeout(function(){
				self.$modalPopup.trigger( 'botiga-admin-modal-opened', [ self.$modalPopup, $( e.target ).parent().find( self.triggerSelector ) ] );
			}, 200);
		},

		/**
		 * Close Modal.
		 * 
		 * @return {void}
		 */
		closeModal: function() {
			event.preventDefault();

			const self = this;

			this.$modalPopup.removeClass('active');

			setTimeout(function(){
				self.$modalPopup.trigger( 'botiga-admin-modal-closed' );
			}, 200);
		}
	}

	$( document ).ready(function() {
		adminBotiga.modal.init();
	});

})(jQuery);