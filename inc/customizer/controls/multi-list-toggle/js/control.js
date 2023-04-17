wp.customize.controlConstructor['botiga-multi-list-toggle-control'] = wp.customize.Control.extend({

	// When we're finished loading continue processing
	ready: function() {

		var control = this;

		// Init sortable.
		jQuery( control.container.find( 'ul.sortable' ).first() ).find( 'li' ).each( function() {

			// Enable/disable options when we click on the eye of Thundera.
			jQuery( this ).click( function() {
				jQuery( this ).find( 'i.visibility' ).toggleClass( 'dashicons-visibility-faint' ).parents( 'li:eq(0)' ).toggleClass( 'invisible' );
			});
		}).click( function() {

			// Update value on click.
			control.setting.set( control.getNewVal() );
		});
	},

	/**
	 * Getss thhe new vvalue.
	 *
	 * @since 3.0.35
	 * @returns {Array} - Returns the value as an array.
	 */
	getNewVal: function() {
		var items  = jQuery( this.container.find( 'li' ) ),
			newVal = [];
		_.each( items, function( item ) {
			if ( ! jQuery( item ).hasClass( 'invisible' ) ) {
				newVal.push( jQuery( item ).data( 'value' ) );
			}
		});
		return newVal;
	}

});