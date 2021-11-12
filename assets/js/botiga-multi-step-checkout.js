(function($){

    'use strict';

    botiga.mstepc = {
        init: function() {
            var _self = this;

            this.initialized = false;

            setTimeout(function(){
                
                $('.botiga-mstepc-tabs-nav-item:first-child > a').trigger( 'click' );
                
                $( 'form.checkout .required, form.woocommerce-form-login .required' ).each(function(){
                    $( this ).closest( '.form-row' ).find( 'input' ).attr( 'required', true );
                    $( this ).closest( '.form-row' ).find( 'select' ).attr( 'required', true );
                });

                _self.initialized = true;

            }, 1000);
            
            this.events();

            return this;
        },

        events: function() {
            var _self = this;

            $( document ).on( 'updated_checkout', function() {
                $( '.woocommerce-checkout-payment input' ).each(function(){
                    $( this ).attr( 'required', true );
                });
            });
            
            // Tabs Navigation
            $( '.botiga-mstepc-tabs-nav-item > a' ).on( 'click', function(e){
                e.preventDefault();

                var current_step   = $( this ).data( 'step' ), 
                    selectors_to_validate = $( this ).data( 'validate-selector' ).split( ',' ),
                    selectors_to_show = $( this ).data( 'content-selector' ).split( ',' ),
                    tabs           = $( '.botiga-mstepc-tabs-nav-item' ),
                    current_tab    = $( this ).parent(),
                    prev_tab       = $( this ).parent().prev(),
                    next_tab       = $( this ).parent().next(),
                    next_step      = next_tab.find( '> a' ).data( 'step' );

                var is_valid = false;
                selectors_to_validate.forEach(function( selector ){
                    if( $( selector ).is( 'form' ) ) {
                        is_valid = $( selector ).valid();
                    }
                });

                if( ! is_valid && ! prev_tab.hasClass( 'no-validation' ) ) {
                    if( $( '.botiga-mstepc-tabs-nav-item > a[data-step="billiing-shipping"]' ).parent().index === 0 ) {
                        return false;
                    }
                } else {
                    $( this ).parent().prev().addClass( 'completed' );
                }

                if( ! $( this ).parent().prev().hasClass( 'completed' ) && $( this ).parent().index() !== 0 ) {
                    return false;
                }

                if( _self.initialized === true && ! _self.validateBeforeNext( selectors_to_validate ) ) {
                    if( $( '.botiga-mstepc-tabs-nav-item > a[data-step="billiing-shipping"]' ).parent().index === 0 ) {
                        return false;
                    }
                }

                _self.showNextStep( selectors_to_show );

                tabs.removeClass( 'previous-step current-step next-step' );
                current_tab.addClass( 'current-step' );
                prev_tab.addClass( 'previous-step' );
                next_tab.addClass( 'next-step' );

                $( '.botiga-mstepc-footer' ).removeClass( 'login billing-shipping order-payment order-review' ).addClass( current_step );

                if( _self.initialized === true ) {
                    $( '.botiga-mstepc-wrapper .woocommerce-error' ).remove();
                    $( '.botiga-mstepc-wrapper .woocommerce-message' ).remove();
                }

                $( '.botiga-mstepc-next' ).data( 'next-step', next_step );
            } );

            // Next Step Button
            $( '.botiga-mstepc-next' ).on( 'click', function(e){
                e.preventDefault();

                var to      = $( this ).data( 'next-step' ),
                    current = $( '.botiga-mstepc-tabs-nav-item > a[data-step="'+ to +'"]' ).parent().prev().find( '> a' ).data( 'step' ),
                    next    = $( '.botiga-mstepc-tabs-nav-item > a[data-step="'+ to +'"]' ).parent().next().find( '> a' ).data( 'step' );

                if( ! _self.validateBeforeNext( $( '.botiga-mstepc-tabs-nav-item > a[data-step="'+ current +'"]' ).data( 'content-selector' ).split( ',' ) ) ) {
                    return false;
                }

                $( '.botiga-mstepc-tabs-nav-item > a[data-step="'+ to +'"]' ).trigger( 'click' );

                $( this ).data( 'next-step', next );

                $( window ).trigger( 'botiga.mstepc.next' );
            } );

            // Skip Login Button
            $( '.botiga-mstepc-skip-login' ).on( 'click', function(e){
                e.preventDefault();

                _self.showNextStep( ['form.woocommerce-checkout'] );

                $( window ).trigger( 'botiga.mstepc.hide.skip.login' );
            } );

            $( window ).on( 'botiga.mstepc.hide.skip.login', function(){
                $( '.botiga-mstepc-skip-login' ).css( 'display', 'none' );
            } );

            $( window ).on( 'botiga.mstepc.show.skip.login', function(){
                $( '.botiga-mstepc-skip-login' ).css( 'display', 'inline-block' );
            } );

            $( '.botiga-mstepc-place-order' ).on( 'click', function(e){
                e.preventDefault();

                $( '#place_order' ).trigger( 'click' );
            } );
            
            return this;
        },

        validateBeforeNext: function( selectors ) {
            var is_valid = false;

            selectors.forEach(function( selector, index ){
                if( $( selector ).is( 'form' ) ) {
                    is_valid = $( selector ).valid();
                }
            });

            return is_valid;
        },

        showNextStep: function( selectors ) {
            $( '.woocommerce-form-coupon-toggle,.woocommerce-form-login,form.woocommerce-checkout #customer_details,.checkout-wrapper,.woocommerce-form-coupon' ).removeClass( 'show showEffect' );

            selectors.forEach(function( selector, index ){
                $( selector ).addClass( 'show' );
                setTimeout(function(){
                    $( selector ).addClass( 'showEffect' );
                }, 300);
            });
        }
    }

    $( document ).ready(function(){
        botiga.mstepc.init();
    });

})(jQuery);