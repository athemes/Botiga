(function($){

    /*
     * Customize
     * Botiga Custom Accordion Control
     *
     */

    'use strict';

    var Botiga_Accordion = {
        init: function(){

            if( !this.initialized ) {
                this.events();
            }

            this.initialized = true;
            
        },
        events: function(){
            var self = this;

            $( document ).on('click', '.botiga-accordion-title', function(){
                var $this = $(this);
                $(this).closest('.control-section.open').data('last-selected', $(this).data('until'));

                if( $(this).hasClass('expanded') ) {
                    self.showOrHide( $(this), 'hide' );
                    $(this).removeClass('expanded').addClass('collapse');

                    setTimeout(function(){
                        $this.removeClass('collapse');
                    }, 300);
                }
            });

            $( document ).on('click', '.control-section', function(e){
                var $section = $('.control-section.open'),
                    lastSelected = $section.data('last-selected');

                $section.find('.botiga-accordion-title').each(function(i){
                    if( !$(this).hasClass('collapse') ) {
                        if( lastSelected == $(this).data('until') ) {
                            self.showOrHide( $(this), 'show' );
                            $(this).addClass('expanded');
                        } else {
                            self.showOrHide( $(this), 'hide' );
                            $(this).removeClass('expanded');
                        }
                    }
                    
                    if( typeof lastSelected === "undefined" && i == 0 ) {
                        $(this).addClass('expanded');
                        $(this).closest('.customize-control').next().removeClass('botiga-accordion-hide');
                    }
                });
            });

            return this;
        },

        showOrHide: function( $this, status ) {
            var current = '';
            current = $this.closest('.customize-control').next();
            
            var elements = [];
            if( current.attr( 'id' ) == 'customize-control-' + $this.data('until') ) {
                elements.push( current[0].id );
            } else {
                while( current.attr( 'id' ) != 'customize-control-' + $this.data('until') ) {
                    elements.push( current[0].id );

                    current = current.next();
                }
            }

            if( elements.length >= 1 ) {
                elements.push( current[0].id );
            }
            
            for( var i = 0; i < elements.length; i++ ) {
                // Identify accordion items
                $( '#'+elements[i] ).addClass('botiga-accordion-item');

                // Hide or show the accordion content
                if( status == 'hide' ) {
                    $( '#'+elements[i] ).addClass('botiga-accordion-hide');
                } else {
                    $( '#'+elements[i] ).removeClass('botiga-accordion-hide');
                }

                // Identify first accordion item
                if( i == 0 ) {
                    $( '#'+elements[i] ).addClass('botiga-accordion-first-item')
                }

                // Identify last accordion item
                if( i == elements.length - 1 && elements.length > 1 || elements.length == 1 ) {
                    $( '#'+elements[i] ).addClass('botiga-accordion-last-item')
                }
            }


            return this;
        }
    }

    $(document).ready(function(){
        Botiga_Accordion.init();
    });

})(jQuery);