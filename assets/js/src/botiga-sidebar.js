/**
 * Botiga Sidebar
 */

'use strict';

botiga.sidebar = {
    init: function() {
        var ev = document.createEvent('HTMLEvents');
            ev.initEvent( 'sidebar-slide-close', true, false);

        window.addEventListener( 'sidebar-slide-open', function(){
            document.querySelector( 'body' ).classList.add( 'sidebar-slide-opened' );
        } );

        window.addEventListener( 'sidebar-slide-close', function(){
            document.querySelector( 'body' ).classList.remove( 'sidebar-slide-opened' );
        } );

        document.addEventListener( 'click', function(e) {
            var sidebar = document.querySelector( '.sidebar-wrapper' ).parentElement;

            if(  e.target.closest( '.sidebar-wrapper' ) === null ) {
                sidebar.classList.remove( 'show' );
                window.dispatchEvent(ev);
            }
        } );
    }
}

botiga.helpers.botigaDomReady( function() {
    botiga.sidebar.init();
});