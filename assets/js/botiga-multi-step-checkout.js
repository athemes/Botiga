(function($){

    'use strict';

    botiga.mstepc = {
        init: function() {
            this.events();
        },

        events: function() {
            $('.botiga-mstepc-tabs-nav-item > a').on( 'click', function(e){
                e.preventDefault();
                
                $( '.woocommerce-form-coupon-toggle,.woocommerce-form-login,#customer_details,.checkout-wrapper' ).removeClass( 'show' );

                var selectors = $( this ).data( 'content-selector' ).split( ',' );
                selectors.forEach(function( selector, index ){
                    $( selector ).addClass( 'show' );
                });

            } );
            
            return this;
        }
    }

    $( document ).ready(function(){
        botiga.mstepc.init();
    });

})(jQuery);