/**
 * Botiga Popup
 */

'use strict';

var botiga = botiga || {};

botiga.popup = {
    
    // To ensure better compatibility with plugins like WP Rocket that has
    // options to defer/lazy-load JS files, each JS script should have your own 
    // 'domReady' function. This way the script has no dependecies and can be loaded standalone.
    domReady: function( fn ) {
		if ( typeof fn !== 'function' ) {
			return;
		}
	
		if ( document.readyState === 'interactive' || document.readyState === 'complete' ) {
			return fn();
		}
	
		document.addEventListener( 'DOMContentLoaded', fn, false );
	},

    init: function() {
        const _this = this,
            buttons = document.querySelectorAll( '.has-popup' );

        if( ! buttons.length ) {
            return false;
        }

        // Open the popup if there's some error
        const error = document.querySelector( '.botiga-popup-wrapper .woocommerce-notices-wrapper .woocommerce-error' );

        if( error !== null ) {
            const popupID = error.closest( '.botiga-popup' ).getAttribute( 'id' ),
                popup     = document.getElementById( popupID );

            this.openPopup( popup );
        }

        // Open popup link/button
        for( let i=0;i<buttons.length;i++ ) {
            const 
                button = buttons[i],
                popup  = document.getElementById( button.getAttribute( 'data-popup-id' ) );

            button.addEventListener( 'click', function(e){
                e.preventDefault();
                _this.openPopup( popup );
            } );

            // auto open
            if( button.getAttribute( 'data-auto-open' ) === 'true' ) {
                const delay = button.getAttribute( 'data-auto-open-delay' );
                if( typeof delay === 'string' ) {
                    setTimeout(function(){
                        _this.openPopup( popup );
                    }, parseInt( delay ) * 1000 );
                } else {
                    _this.openPopup( popup );
                }
            }
        }

        // Close popup link/button
        const closebtns = document.querySelectorAll( '.botiga-popup-wrapper__close-button' );
        for( let i=0;i<closebtns.length;i++ ) {
            closebtns[i].addEventListener( 'click', this.closePopup );
        }
    },

    /**
     * Open the popup
     */
    openPopup: function( popup ) {
        const is_customizer = document.getElementById( 'customize-preview-js' ) === null ? false : true; 

        if( ! is_customizer && parseInt( popup.getAttribute( 'data-cookie' ) ) && botiga.helpers.getCookie( popup.getAttribute( 'data-cookie-name' ) ) ) {
            return false;
        }

        // Open the popup inside customizer only when it's handling with Modal Popup customizer section
        if( is_customizer ) {
            const customizer_section = window.parent.window.document.querySelector( '.control-section.open' );
            if( customizer_section === null ) {
                return false;
            }

            const is_modal_popup_section = customizer_section.id.indexOf( 'botiga_section_modal_popup' ) > 0;
            if( ! is_modal_popup_section ) {
                return false;
            }
        }

        popup.classList.add( 'show' );

        setTimeout(function(){
            popup.classList.add( 'transition-effect' );

            window.dispatchEvent( new Event( 'botiga.popup.opened' ) );
        }, 300);

        document.body.classList.add( 'disable-scroll' );
    },

    /**
     * Close the popup
     */
    closePopup: function() {
        event.preventDefault();

        const is_customizer = document.getElementById( 'customize-preview-js' ) === null ? false : true; 

        const popups = document.querySelectorAll( '.botiga-popup' );
        for( let i=0;i<popups.length;i++ ) {
            const popup = popups[i];

            if( ! is_customizer && parseInt( popup.getAttribute( 'data-cookie' ) ) ) {
                botiga.helpers.setCookie( popup.getAttribute( 'data-cookie-name' ), 1, popup.getAttribute( 'data-cookie-expiration' ) );
            }

            popup.classList.remove( 'transition-effect' );

            setTimeout(function(){
                popup.classList.remove( 'show' );
                document.body.classList.remove( 'disable-scroll' );

                window.dispatchEvent( new Event( 'botiga.popup.closed' ) );
            }, 300);
        }
    
    }
}

botiga.popup.domReady( function() {
    botiga.popup.init();
});


 