(function($){

    'use strict';

    window.bhfb = {
        init: function() {
            // this.previewIframe = 

            this.builderGridContentFlag = false;
            this.updateGridDelay = 200;

            this.currentDevice      = 'desktop';
            this.currentArea        = 'header';
            this.currentRowInput    = '';
            this.currentRow         = '';
            this.currentColumn      = '';
            this.currentColumnPos   = '';
            this.currentComponent   = '';
            this.currentBuilder     = '';
            this.currentBuilderType = '';

            this.componentsOrder  = '';

            this.preventEmptyRowValues();

            this.customizeNavigation();

            this.elementsPopup();
            this.elementsButton();
            this.storeGlobals();
            this.devicesSwitcher();
            this.elementsPopupContent();
            this.builderGridContent();

            this.elementsSortable();

            this.builderCustomColumns();
            this.builderColumnsLayout();
            this.footerCustomizerOptions();
            this.headerPresets();

            // this.extraNavigation();
            

            this.showHideBuilder();
            this.showHideBuilderTop();
        },

        jsonDecode: function( value ) {
            return JSON.parse(value.replace(/'/g,'"').replace(';',''));
        },

        // In some rare cases, the row values are empty, so we need to prevent that
        // case it is empty, we set the default values
        preventEmptyRowValues: function() {
            const 
                areas = [ 'header', 'footer' ],
                rows  = [ 'above', 'main', 'below' ];

            for( const area of areas ) {
                for( const row of rows ) {
                    const rowInputValue = $( '#_customize-input-botiga_'+ area +'_row__' + row + '_' + area + '_row' ).val();

                    if( rowInputValue == '' ) {
                        $( '#_customize-input-botiga_'+ area +'_row__' + row + '_' + area + '_row' ).val( botiga_hfb.rows.defaults[ row + '_' + area + '_row' ] );
                    }
                }
            }

            // Mobile offcanvas row
            const mobileOffcanvasRowInputValue = $( '#_customize-input-botiga_header_row__mobile_offcanvas' ).val();        
            if( mobileOffcanvasRowInputValue == '' ) {
                $( '#_customize-input-botiga_header_row__mobile_offcanvas' ).val( botiga_hfb.rows.defaults[ 'mobile_offcanvas' ] );
            }
        },

        customizeNavigation: function() {
            const
                sections = [
                    'sub-accordion-section-botiga_section_hb_presets',
                    'sub-accordion-section-botiga_section_hb_above_header_row',
                    'sub-accordion-section-botiga_section_hb_main_header_row',
                    'sub-accordion-section-botiga_section_hb_below_header_row',
                    'sub-accordion-section-botiga_section_hb_mobile_offcanvas',

                    'sub-accordion-section-botiga_section_hb_component__logo',
                    'sub-accordion-section-botiga_section_hb_component__search',
                    'sub-accordion-section-botiga_section_hb_component__social',
                    'sub-accordion-section-botiga_section_hb_component__menu',
                    'sub-accordion-section-botiga_section_hb_component__secondary_menu',
                    'sub-accordion-section-botiga_section_hb_component__contact_info',
                    'sub-accordion-section-botiga_section_hb_component__button',
                    'sub-accordion-section-botiga_section_hb_component__button2',
                    'sub-accordion-section-botiga_section_hb_component__html',
                    'sub-accordion-section-botiga_section_hb_component__html2',
                    'sub-accordion-section-botiga_section_hb_component__shortcode',
                    'sub-accordion-section-botiga_section_hb_component__login_register',
                    'sub-accordion-section-botiga_section_hb_component__woo_icons',
                    'sub-accordion-section-botiga_section_hb_component__pll_switcher',
                    'sub-accordion-section-botiga_section_hb_component__wpml_switcher',
                    'sub-accordion-section-botiga_section_hb_component__mobile_offcanvas_menu',
                    'sub-accordion-section-botiga_section_hb_component__mobile_hamburger',

                    // Footer
                    'sub-accordion-section-botiga_section_fb_above_footer_row',
                    'sub-accordion-section-botiga_section_fb_main_footer_row',
                    'sub-accordion-section-botiga_section_fb_below_footer_row',

                    'sub-accordion-section-botiga_section_fb_component__footer_menu',
                    'sub-accordion-section-botiga_section_fb_component__copyright',
                    'sub-accordion-section-botiga_section_fb_component__social',
                    'sub-accordion-section-botiga_section_fb_component__button',
                    'sub-accordion-section-botiga_section_fb_component__button2',
                    'sub-accordion-section-botiga_section_fb_component__html',
                    'sub-accordion-section-botiga_section_fb_component__html2',
                    'sub-accordion-section-botiga_section_fb_component__shortcode',
                    'sub-accordion-section-botiga_section_fb_component__widget1',
                    'sub-accordion-section-botiga_section_fb_component__widget2',
                    'sub-accordion-section-botiga_section_fb_component__widget3',
                    'sub-accordion-section-botiga_section_fb_component__widget4'
                ];

            // Append columns to the sections array.
            const rows = [ 'above', 'main', 'below' ];
            for( const row of rows ) {
                for( let i=1; i<=6; i++ ) {
                    sections.push( 'sub-accordion-section-botiga_header_row__'+ row +'_header_row_column' + i );
                    sections.push( 'sub-accordion-section-botiga_footer_row__'+ row +'_footer_row_column' + i );
                }
            }

            let
                current_section_id = '';

            $( document ).on( 'mouseover focus', '.customize-section-back', function(e){
                current_section_id = $( '.control-section.open' ).attr( 'id' );
            });

            $( document ).on( 'click keydown', '.customize-section-back', function(e){
                if( sections.includes( current_section_id ) ) {

                    // header columns.
                    if( current_section_id.indexOf( 'above_header_row_column' ) !== -1 ) {
                        wp.customize.section( 'botiga_section_hb_above_header_row' ).focus();
                        return false;
                    }

                    if( current_section_id.indexOf( 'main_header_row_column' ) !== -1 ) {
                        wp.customize.section( 'botiga_section_hb_main_header_row' ).focus();
                        return false;
                    }

                    if( current_section_id.indexOf( 'below_header_row_column' ) !== -1 ) {
                        wp.customize.section( 'botiga_section_hb_below_header_row' ).focus();
                        return false;
                    }

                    // footer columns.
                    if( current_section_id.indexOf( 'above_footer_row_column' ) !== -1 ) {
                        wp.customize.section( 'botiga_section_fb_above_footer_row' ).focus();
                        return false;
                    }

                    if( current_section_id.indexOf( 'main_footer_row_column' ) !== -1 ) {
                        wp.customize.section( 'botiga_section_fb_main_footer_row' ).focus();
                        return false;
                    }

                    if( current_section_id.indexOf( 'below_footer_row_column' ) !== -1 ) {
                        wp.customize.section( 'botiga_section_fb_below_footer_row' ).focus();
                        return false;
                    }

                    // header/footer row and components.
                    if( current_section_id.indexOf( '_hb_' ) !== -1 || current_section_id.indexOf( '_header_' ) !== -1 ) {
                        wp.customize.section( 'botiga_section_hb_wrapper' ).focus();
                    } else {
                        wp.customize.section( 'botiga_section_fb_wrapper' ).focus();
                    }
                }
            } );
        },

        storeGlobals: function() {

            const 
                _this  = this;

            // Current Device.      
            $(' .wp-full-overlay-footer .devices button, .botiga-devices-preview button').on('click', function() {
                let device = $(this).attr('data-device');

                if( device === 'tablet' ) {
                    device = 'mobile';
                }

                if( _this.currentBuilderType === 'footer' ) {
                    device = 'desktop';
                }

                _this.currentDevice = device;
                
                _this.builderGridContent();
            });	

            // Column Area.
            $( document ).on( 'click mouseover', '.botiga-bhfb-area:not(.bhfb-available-components)', function(e){

                if( $( '#botiga-bhfb-elements' ).hasClass( 'show' ) ) {
                    return false;
                }

                _this.currentRowInput  = $( '#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + $( this ).data( 'bhfb-row' ) );
                _this.currentRow       = $( this ).closest( '.botiga-bhfb-row' );
                _this.currentColumnPos = $( this ).index() - 1;
                _this.currentColumn    = $( this );

                if( ! _this.currentRow.length && $( this ).hasClass( 'botiga-bhfb-area-offcanvas' ) ) {
                    _this.currentRowInput  = $( '#_customize-input-botiga_header_row__mobile_offcanvas' );
                    _this.currentRow       = $( '.botiga-bhfb-area-offcanvas' );
                    _this.currentColumnPos = $( this ).index();
                }

            } );

            $( document ).on( 'click mouseover', '.bhfb-button', function(e){
                _this.currentComponent =  $( this ).data( 'bhfb-id' );
            });
        },

        devicesSwitcher: function() {
            const _this = this;

            $(' .wp-full-overlay-footer .devices button, .botiga-devices-preview button').on('click', function() {
                var device = $(this).attr('data-device');
                
                if( device === 'mobile' ) {
                    device = 'tablet';
                }

                $( '.botiga-bhfb-devices .botiga-bhfb-device-link' ).removeClass( 'active' );
                $( '.botiga-bhfb-devices .botiga-bhfb-device-link[data-device="'+ device +'"]' ).addClass( 'active' );
            });	

            $( '.botiga-bhfb-devices .botiga-bhfb-device-link' ).on( 'click', function(e) {
                e.preventDefault();

                const device = $(this).attr('data-device');

                $(' .wp-full-overlay-footer .devices button[data-device="'+ device +'"]' ).trigger( 'click' );
            } );
        },

        getElementsUnused: function() {
            const _this = this;

            let elements    = botiga_hfb.components.desktop,
                mb_elements = botiga_hfb.components.mobile;

            let fields = [ '#_customize-input-botiga_header_row__above_header_row', '#_customize-input-botiga_header_row__main_header_row', '#_customize-input-botiga_header_row__below_header_row', '#_customize-input-botiga_header_row__mobile_offcanvas' ];

            if( _this.currentBuilderType === 'footer' ) {
                elements = botiga_hfb.components.footer;
                fields   = [ '#_customize-input-botiga_footer_row__above_footer_row', '#_customize-input-botiga_footer_row__main_footer_row', '#_customize-input-botiga_footer_row__below_footer_row' ];
            }

            for( var field of fields ) {
                
                // desktop
                for( var el of elements ) {
                    const 
                        input_value = this.jsonDecode( $( field ).val() );

                    if( input_value.desktop.length ) {

                        for( const column of input_value.desktop ) {
                            elements = elements.filter( item => !column.includes( item.id ) );
                        }

                    }

                }

                // mobile
                for( var el of mb_elements ) {
                    const 
                        input_value = this.jsonDecode( $( field ).val() );

                    if( input_value.mobile.length ) {
                     
                        for( const column of input_value.mobile ) {
                            mb_elements = mb_elements.filter( item => !column.includes( item.id ) );
                        }

                    }

                    // off-canvas
                    if( field.indexOf( 'row__mobile_offcanvas' ) !== -1 && input_value.mobile_offcanvas.length ) {
                     
                        for( const column of input_value.mobile_offcanvas ) {
                            mb_elements = mb_elements.filter( item => !column.includes( item.id ) );
                        }

                    }
                }
            }

            return {
                desktop: elements,
                mobile: mb_elements
            };
            
        },

        elementsPopup: function(){

            const 
                _this   = this;

            $( document ).on( 'click', '.botiga-bhfb-area:not(.bhfb-available-components)', function(e){
                const 
                    popup = _this.currentBuilder.find( '#botiga-bhfb-elements' ),
                    rect  = $(this)[0].getBoundingClientRect(),
                    row   = $(this).data( 'bhfb-row' );
                    
                setTimeout(function(){
                    popup.css( 'top', 0 );
                    popup.css( 'left', rect.left );

                    popup.css( 'top', ( rect.top - ( popup.height() + 50 ) ) );
                    if( _this.isElementInViewport( popup ) ) {
                        popup.css( 'left', rect.left );
                        popup.css( 'right', 'auto' );
                    } else {
                        popup.css( 'left', 'auto' );
                        popup.css( 'right', 25 );
                    }

                    if( e.target.classList.contains( 'bhfb-remove-element' ) || e.target.classList.contains( 'bhfb-button' ) ) {
                        return false;
                    }

                    popup.addClass( 'show' );
                }, 200);

                _this.elementsPopupContent( row );
                _this.builderGridContent();
            } );

            $( '#customize-preview iframe' ).on( 'mouseup', function(e) {
                _this.closeElementsPopup(e);
            } );

            $( document ).on( 'mouseup', function(e){
                if( ! _this.currentBuilder ) {
                    return false;
                }

                _this.closeElementsPopup(e);
            } );

        },

        closeElementsPopup: function(e) {
            const 
                _this = this,
                popup = _this.currentBuilder.find( '#botiga-bhfb-elements' );

            if( e.target.closest( '#botiga-bhfb-elements' ) === null ) {
                popup.removeClass( 'show' );
            }
        },

        isElementInViewport: function (el) {

            if (typeof jQuery === "function" && el instanceof jQuery) {
                el = el[0];
            }
        
            var rect = el.getBoundingClientRect();
        
            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || $(window).height()) && 
                rect.right <= (window.innerWidth || $(window).width())
            );
        },

        elementsPopupContent: function( row = '' ){

            const 
                _this                 = this,
                elements              = this.getElementsUnused(),
                elementsWrapper       = $( '.botiga-bhfb-elements-desktop' ),
                mobileElementsWrapper = $( '.botiga-bhfb-elements-mobile' );

            elementsWrapper.html( '' );
            mobileElementsWrapper.html( '' );

            let cprefix = 'hb';
            if( _this.currentBuilderType && _this.currentBuilderType === 'footer' ) {
                cprefix = 'fb';
            }

            if( elements.desktop.length ) {
                for( const element of elements.desktop ) {
    
                    elementsWrapper.append(
                        '<div class="botiga-bhfb-element botiga-bhfb-element-desktop">' +
                            '<a href="#" class="bhfb-button" data-bhfb-id="'+ element.id +'" data-bhfb-focus-section="botiga_section_'+ cprefix +'_component__'+ element.id +'">'+ element.label +'</a>' + 
                        '</div>'
                    );
    
                }
            } else {
                elementsWrapper.append(
                    '<p class="bhfb-elements-message">'+ botiga_hfb.i18n.elementsMessage +'</p>'
                );
            }

            // Remove off-canvas menu when the selected row 
            // isnt't the off-canvas area
            if( row !== 'mobile_offcanvas' ) {
                elements.mobile = elements.mobile.filter( item => item.id !== 'mobile_offcanvas_menu' );
            } else {

                // Remove some components from mobile
                elements.mobile = elements.mobile.filter( item => item.id !== 'secondary_menu' && item.id !== 'mobile_hamburger' );

            }

            if( elements.mobile.length ) {
                for( const element of elements.mobile ) {
    
                    mobileElementsWrapper.append(
                        '<div class="botiga-bhfb-element botiga-bhfb-element-mobile">' +
                            '<a href="#" class="bhfb-button" data-bhfb-id="'+ element.id +'" data-bhfb-focus-section="botiga_section_'+ cprefix +'_component__'+ element.id +'">'+ element.label +'</a>' + 
                        '</div>'
                    );
    
                }
            } else {
                mobileElementsWrapper.append(
                    '<p class="bhfb-elements-message">'+ botiga_hfb.i18n.elementsMessage +'</p>'
                );
            }

            this.addUpsellComponents();

        },

        updateAvailableComponents: function() {
            const _this = this;

            if( _this.currentBuilderType === 'header' ) {

                // Header Desktop Components.
                $( '.botiga-header-builder-available-components' ).html( '' );
                $( '.botiga-header-builder-available-components' ).html( $( '.botiga-bhfb-header .botiga-bhfb-elements-desktop' ).html() );

                // Header Mobile Components.
                $( '.botiga-header-builder-available-mobile-components' ).html( '' );
                $( '.botiga-header-builder-available-mobile-components' ).html( $( '.botiga-bhfb-header .botiga-bhfb-elements-mobile' ).html() );
            }

            if( _this.currentBuilderType === 'footer' ) {

                // Footer Components.
                $( '.botiga-footer-builder-available-footer-components' ).html( '' );
                $( '.botiga-footer-builder-available-footer-components' ).html( $( '.botiga-bhfb-footer .botiga-bhfb-elements-desktop' ).html() );

            }
            
        },

        addUpsellComponents: function() {
            const _this = this;

            if( ! botiga_hfb.upsell_components.enable ) {
                return false;
            }

            let 
                upsellComponentsHTML = '',
                components           = _this.currentBuilderType === 'header' ? botiga_hfb.upsell_components.header : botiga_hfb.upsell_components.footer;

            for( const component of components ) {
                upsellComponentsHTML += `
                    <div class="botiga-bhfb-element botiga-bhfb-element-desktop">
                        <a href="#" class="bhfb-button">${ component.label }</a> 
                    </div>
                `;
            }

            const upsellHTML = `
                <div class="botiga-bhfb-upsell-components-wrapper">
                    <h4>${ botiga_hfb.upsell_components.title }</h4>
                    <div class="botiga-bhfb-upsell-components">${ upsellComponentsHTML }</div>
                    <p>${ botiga_hfb.upsell_components.total }</p>
                    <a href="${ botiga_hfb.upsell_components.link }" target="_blank" class="bhfb-upsell-button">${ botiga_hfb.upsell_components.button }</a>
                </div>
            `;

            $( '#botiga-bhfb-elements .botiga-bhfb-elements-wrapper .botiga-bhfb-upsell-components-wrapper' ).remove();
            $( '#botiga-bhfb-elements .botiga-bhfb-elements-wrapper' ).append( upsellHTML );
        },

        elementsButton: function() {

            const 
                _this   = this;

            $( document ).on( 'click', '.botiga-bhfb-element > a', function(e){
                e.preventDefault();

                const
                    id           = $( this ).data( 'bhfb-id' ),
                    focusSection = $( this ).data( 'bhfb-focus-section' );

                if( $( this ).closest( '#botiga-bhfb-elements' ).length ) {
                    _this.elementsButtonAdd( id );

                    // close elements popup.
                    _this.currentBuilder.find( '#botiga-bhfb-elements' ).removeClass( 'show' );

                } else {
                    if( e.target.classList.contains( 'bhfb-remove-element' ) ) {
                        _this.elementsButtonRemove( id );
                        return false;
                    }
                }

                setTimeout(function(){
                    wp.customize.section( focusSection ).focus();
                }, _this.updateGridDelay );

            } );

        },

        elementsButtonAdd: function( id, hasOrder = false ) {
            const 
                _this = this;

            let 
                current_value = _this.jsonDecode( _this.currentRowInput.val() ),
                value_wrapper = _this.currentDevice;

            if( _this.currentDevice === 'mobile' && _this.currentRow.hasClass( 'botiga-bhfb-area-offcanvas' ) ) {
                value_wrapper = 'mobile_offcanvas';
            }

            // Change the value.
            if( ! hasOrder ) {
                current_value[value_wrapper][ _this.currentColumnPos ].push( id );
            } else {
                current_value[value_wrapper][ _this.currentColumnPos ] = _this.componentsOrder;
            }

            // Do not add specific components on specific areas. 
            // E.g: Don't add 'Mobile Offcanvas Menu' on areas that are not the 'offcanvas wrapper'
            if( _this.currentComponent === 'mobile_offcanvas_menu' && ! _this.currentRow.hasClass( 'botiga-bhfb-area-offcanvas' ) ) {
                return false;
            }

            if( _this.currentComponent === 'mobile_hamburger' && _this.currentRow.hasClass( 'botiga-bhfb-area-offcanvas' ) ) {
                return false;
            }

            // Update the value in the customizer field.
            _this.currentRowInput.val( JSON.stringify( current_value ) );

            // Trigger change in the customizer field (desktop).
            _this.currentRowInput.trigger( 'change' );

            // Trigger change in the customizer field (mobile).
            if( _this.currentBuilderType === 'header' ) {
                _this.currentRowInput.closest( '.customize-control' ).next().find( 'input' ).val( Math.random() ).trigger( 'change' );
            }

            _this.elementsPopupContent();
            _this.builderGridContent();

            $( '#botiga-bhfb-elements' ).removeClass( 'show' );
        },

        elementsButtonRemove: function( id, triggerChange = true ) {
            const
                _this = this;

            let 
                current_value = _this.jsonDecode( _this.currentRowInput.val() ),
                value_wrapper = _this.currentDevice;

            if( _this.currentDevice === 'mobile' && _this.currentRow.hasClass( 'botiga-bhfb-area-offcanvas' ) ) {
                value_wrapper = 'mobile_offcanvas';
            }

            // Change the value.
            current_value[value_wrapper][_this.currentColumnPos] = current_value[value_wrapper][_this.currentColumnPos].filter( item => item !== id );

            // Update the value in the customizer field.
            _this.currentRowInput.val( JSON.stringify( current_value ) );

            // Trigger change in the customizer field.
            if( triggerChange ) {

                // Desktop.
                _this.currentRowInput.trigger( 'change' );

                // Mobile.
                _this.currentRowInput.closest( '.customize-control' ).next().find( 'input' ).val( Math.random() ).trigger( 'change' );

            }

            _this.elementsPopupContent();
            _this.builderGridContent();
        },

        elementsSortable: function(){
            const   
                _this = this;

            $( '.botiga-bhfb-area' ).each(function(){
                $( this ).sortable({
                    placeholder: "botiga-bhfb-element bhfb-ui-state-highlight",
                    connectWith: '.botiga-bhfb-area',
                    scroll: false,
                    cancel: '.bhfb-edit-column',
                    change: function(e, ui) {
                        _this.currentComponent = $( ui.item[0] ).find( '.bhfb-button' ).data( 'bhfb-id' );
                        _this.currentRow      = ! $( ui.placeholder[0] ).closest( '.botiga-bhfb-row' ).length ? $( ui.placeholder[0] ).closest( '.botiga-bhfb-area-offcanvas' ) : $( ui.placeholder[0] ).closest( '.botiga-bhfb-row' );
                        _this.currentRowInput = $( '#_customize-input-botiga_'+ _this.currentBuilderType +'_row__' + ui.placeholder.closest( '.botiga-bhfb-area' ).data( 'bhfb-row' ) );

                        let 
                            order = [];

                        ui.placeholder.closest( '.botiga-bhfb-area' ).find( '.ui-sortable-placeholder' ).attr( 'data-bhfb-id', _this.currentComponent );

                        ui.placeholder.closest( '.botiga-bhfb-area' ).find( '.botiga-bhfb-element' ).each(function(){
                            const cid = typeof $( this ).find( '.bhfb-button' ).data( 'bhfb-id' ) !== 'undefined' ? $( this ).find( '.bhfb-button' ).data( 'bhfb-id' ) : $( this ).data( 'bhfb-id' );

                            if( ! $( this ).hasClass( 'ui-sortable-helper' ) ) {
                                order.push( cid );
                            }
                        });

                        // Save components order (from respective row)
                        _this.componentsOrder = order;

                    },
                    update: function(e, ui) {
                        
                        // When we use "connectWith" param this condition is needed 
                        // to prevent the code being running twice because the 'update' event runs twice
                        if (this === ui.item.parent()[0]) {
                            const 
                                component_id = ui.item.find( '> .bhfb-button' ).data( 'bhfb-id' ),
                                row          = ui.item.closest( '.botiga-bhfb-area' ).data( 'bhfb-row' ),
                                column       = ui.item.closest( '.botiga-bhfb-area' ).index() - 1,
                                prevRow      = ui.sender !== null ? ui.sender.data( 'bhfb-row' ) : null,
                                prevColumn   = ui.sender !== null ? ui.sender.index() - 1 : null;

                            if( ui.sender === null ) {

                                // Add component based on global order "_this.componentsOrder"
                                _this.elementsButtonAdd( '', true );

                                return false;
                            }

                            if( ! ui.sender.hasClass( 'bhfb-available-components' ) ) {
                                _this.currentRowInput = $( '#_customize-input-botiga_'+ _this.currentBuilderType +'_row__' + prevRow );
                            }
                            _this.currentColumnPos = prevColumn;
                            _this.elementsButtonRemove( component_id, true );
                            
                            if( ! ui.sender.hasClass( 'bhfb-available-components' ) ) {
                                _this.currentRowInput  = $( '#_customize-input-botiga_'+ _this.currentBuilderType +'_row__' + row );
                            }
                            _this.currentColumnPos = column;
                            _this.elementsButtonAdd( component_id, true );
                        }

                    }
                });

                $( this ).disableSelection();
            });
        },

        builderGridContent: function(){
            let
                _this  = this,
                fields = [ '#_customize-input-botiga_header_row__above_header_row', '#_customize-input-botiga_header_row__main_header_row', '#_customize-input-botiga_header_row__below_header_row', '#_customize-input-botiga_header_row__mobile_offcanvas' ],
                cprefix = 'hb';

            if( _this.currentBuilderType && _this.currentBuilderType === 'footer' ) {
                fields = [ '#_customize-input-botiga_footer_row__above_footer_row', '#_customize-input-botiga_footer_row__main_footer_row', '#_customize-input-botiga_footer_row__below_footer_row' ];
                cprefix = 'fb';
            }

            if( _this.builderGridContentFlag ) {
                return false;
            }

            _this.builderGridContentFlag = true;

            setTimeout(function(){

                for( var field of fields ) {
                    const value = _this.jsonDecode( $( field ).val() );

                    let current_row = '';

                    // Detect row.
                    if( field.indexOf( 'above_'+ _this.currentBuilderType +'_row' ) !== -1 ) {
                        current_row = 'above';
                    }

                    if( field.indexOf( 'main_'+ _this.currentBuilderType +'_row' ) !== -1 ) {
                        current_row = 'main';
                    }

                    if( field.indexOf( 'below_'+ _this.currentBuilderType +'_row' ) !== -1 ) {
                        current_row = 'below';
                    }

                    if( field.indexOf( 'row__mobile_offcanvas' ) !== -1 ) {
                        current_row = 'mobile_offcanvas';
                    }

                    // Empty columns.
                    $( '.botiga-bhfb-area[data-bhfb-row="'+ current_row +'_'+ _this.currentBuilderType +'_row"]' ).each(function(){
                        $( this ).remove();
                    });

                    // Desktop. 
                    if( _this.currentDevice === 'desktop' ) {
                        let column_id = 1;
                        for( const columns of value.desktop ) {

                            $( '.botiga-bhfb-'+ _this.currentBuilderType +' .botiga-bhfb-' + current_row + '-row' ).append( '<div class="botiga-bhfb-area" data-bhfb-row="'+ current_row +'_'+ _this.currentBuilderType +'_row"><a class="bhfb-edit-column" href="#" onClick="event.stopPropagation(); wp.customize.section(\'botiga_'+ _this.currentBuilderType +'_row__'+ current_row +'_'+ _this.currentBuilderType +'_row_column'+ column_id +'\').focus();"><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="15" fill="#FFF"/><rect x="7" width="2" height="15" fill="#FFF"/><rect y="3" width="3" height="16" transform="rotate(-90 0 3)" fill="#FFF"/><rect y="15" width="2" height="16" transform="rotate(-90 0 15)" fill="#FFF"/><rect x="14" width="2" height="15" fill="#FFF"/></svg></a>' );
    
                            const column = $( '.botiga-bhfb-' + current_row + '-row' ).find( '.botiga-bhfb-area:last-child' );
    
                            if( columns.length ) {
                                for( let element of columns ) {
    
                                    element = _this.getElementData( element );
    
                                    column.append(
                                        '<div class="botiga-bhfb-element">' +
                                            '<a href="#" class="bhfb-button" data-bhfb-id="'+ element.id +'" data-bhfb-focus-section="botiga_section_'+ cprefix +'_component__'+ element.id +'">'+ 
                                                element.label +
                                                '<i class="bhfb-remove-element dashicons dashicons-no-alt"></i>' +
                                            '</a>' + 
                                        '</div>' 
                                    );
                                
                                }
        
                            }
                            
                            column_id++;
                        }
                    }

                    // Mobile.
                    if( _this.currentDevice === 'mobile' ) {

                        let column_id = 1;
                        for( const columns of value.mobile ) {

                            $( '.botiga-bhfb-' + current_row + '-row' ).append( '<div class="botiga-bhfb-area" data-bhfb-row="'+ current_row +'_'+ _this.currentBuilderType +'_row"><a class="bhfb-edit-column" href="#" onClick="event.stopPropagation(); wp.customize.section(\'botiga_'+ _this.currentBuilderType +'_row__'+ current_row +'_'+ _this.currentBuilderType +'_row_column'+ column_id +'\').focus();"><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="15" fill="#FFF"/><rect x="7" width="2" height="15" fill="#FFF"/><rect y="3" width="3" height="16" transform="rotate(-90 0 3)" fill="#FFF"/><rect y="15" width="2" height="16" transform="rotate(-90 0 15)" fill="#FFF"/><rect x="14" width="2" height="15" fill="#FFF"/></svg></a>' );
    
                            const column = $( '.botiga-bhfb-' + current_row + '-row' ).find( '.botiga-bhfb-area:last-child' );
    
                            if( columns.length ) {
                                for( let element of columns ) {
    
                                    element = _this.getElementData( element );
    
                                    column.append(
                                        '<div class="botiga-bhfb-element">' +
                                            '<a href="#" class="bhfb-button" data-bhfb-id="'+ element.id +'" data-bhfb-focus-section="botiga_section_'+ cprefix +'_component__'+ element.id +'">'+ 
                                                element.label +
                                                '<i class="bhfb-remove-element dashicons dashicons-no-alt"></i>' +
                                            '</a>' + 
                                        '</div>' 
                                    );
                                
                                }
        
                            }

                            column_id++;
    
                        }

                        // Mobile Off-Canvas.
                        if( field.indexOf( 'mobile_offcanvas' ) !== -1 ) {

                            $( '.botiga-bhfb-area-offcanvas' ).html( '' );
                            if( value.mobile_offcanvas.length ) {
                                const elements = value.mobile_offcanvas[0];

                                for( var element of elements ) {
                                    element = _this.getElementData( element );

                                    $( '.botiga-bhfb-area-offcanvas' ).append(
                                        '<div class="botiga-bhfb-element">' +
                                            '<a href="#" class="bhfb-button" data-bhfb-id="'+ element.id +'" data-bhfb-focus-section="botiga_section_hb_component__'+ element.id +'">'+ 
                                                element.label +
                                                '<i class="bhfb-remove-element dashicons dashicons-no-alt"></i>' +
                                            '</a>' + 
                                        '</div>' 
                                    );

                                }
                            }

                        }
                    }

                }
                
                if( ! _this.currentBuilder ) {
                    _this.builderGridContentFlag = false;
                    return false;
                }

                if( _this.currentBuilder.hasClass( 'show' ) && ! _this.currentBuilder.hasClass( 'show-bottom' ) ) {
                    $( '.botiga-bhfb' ).css( 'height', 0 );
                    _this.currentBuilder.css( 'height', _this.currentBuilder.find( '.botiga-bhfb-top' ).outerHeight() + 47 );
                } else {
                    _this.currentBuilder.css( 'height', 0 );
                }

                _this.updateAvailableComponents();

                _this.elementsSortable();

                $( window ).trigger( 'bhfb.grid.ready' );

                _this.builderGridContentFlag = false;

            }, _this.updateGridDelay);

        },

        getElementData: function( element ){
            const _this = this;

            let elements = [ 
                ...botiga_hfb.components.desktop,
                ...botiga_hfb.components.mobile
            ];

            if( _this.currentBuilderType === 'footer' ) {
                elements = botiga_hfb.components.footer;
            }

            for( var el of elements ) {
                if( el.id === element ) {
                    return el;
                }
            }

            return '';
        },

        showHideBuilder: function() {
            const self = this;

            const sections = [ 

                // Header
                'botiga_section_hb_wrapper', 
                'botiga_section_hb_presets',
                'botiga_section_hb_above_header_row', 
                'botiga_section_hb_main_header_row', 
                'botiga_section_hb_below_header_row', 
                'botiga_section_hb_mobile_offcanvas',

                'botiga_section_hb_component__logo',
                'botiga_section_hb_component__search',
                'botiga_section_hb_component__social',
                'botiga_section_hb_component__menu',
                'botiga_section_hb_component__secondary_menu',
                'botiga_section_hb_component__contact_info',
                'botiga_section_hb_component__button',
                'botiga_section_hb_component__button2',
                'botiga_section_hb_component__html',
                'botiga_section_hb_component__html2',
                'botiga_section_hb_component__shortcode',
                'botiga_section_hb_component__login_register',
                'botiga_section_hb_component__woo_icons',
                'botiga_section_hb_component__pll_switcher',
                'botiga_section_hb_component__wpml_switcher',
                'botiga_section_hb_component__mobile_offcanvas_menu',
                'botiga_section_hb_component__mobile_hamburger',

                // Footer
                'botiga_section_fb_wrapper', 
                'botiga_section_fb_above_footer_row', 
                'botiga_section_fb_main_footer_row', 
                'botiga_section_fb_below_footer_row',

                'botiga_section_fb_component__social',
                'botiga_section_fb_component__footer_menu',
                'botiga_section_fb_component__copyright',
                'botiga_section_fb_component__button',
                'botiga_section_fb_component__button2',
                'botiga_section_fb_component__html',
                'botiga_section_fb_component__html2',
                'botiga_section_fb_component__shortcode',
                'botiga_section_fb_component__widget1',
                'botiga_section_fb_component__widget2',
                'botiga_section_fb_component__widget3',
                'botiga_section_fb_component__widget4'
            ];

            // Append columns to the sections array.
            const rows = [ 'above', 'main', 'below' ];
            for( const row of rows ) {
                for( let i=1; i<=6; i++ ) {
                    sections.push( 'botiga_header_row__'+ row +'_header_row_column' + i );
                    sections.push( 'botiga_footer_row__'+ row +'_footer_row_column' + i );
                }
            }

            sections.forEach( function( section ){
                if( typeof wp.customize.section( section ) !== 'undefined' ) {
                    wp.customize.section( section ).expanded.bind( 
                        function( is_active ){ 
                            self.currentBuilder     = self.getCurrentBuilderByComponent( section );
                            self.currentBuilderType = self.currentBuilder.hasClass( 'botiga-bhfb-header' ) ? 'header' : 'footer';

                            if( is_active ) {
                                $( 'body' ).addClass( 'bhfb-active' );
                                self.currentBuilder.addClass( 'show' );

                                self.scrollToRespectiveBuilderArea();
                            } else {
                                $( 'body' ).removeClass( 'bhfb-active' );
                                self.currentBuilder.removeClass( 'show' );
                            }

                            setTimeout(function(){
                                self.builderGridContent();

                                // Update available components.
                                if( section === 'botiga_section_hb_wrapper' || section === 'botiga_section_fb_wrapper' ) {
                                    $( '.botiga-bhfb-' + self.currentBuilderType ).find( '.botiga-bhfb-above-row .botiga-bhfb-area' ).trigger( 'click' );
                                    $( '.botiga-bhfb-elements' ).removeClass( 'show' );
                                }

                            }, 100);
                        } 
                    );
                }
            } );

        },

        scrollToRespectiveBuilderArea: function() {
            const 
                _this = this,
                iframeHTMLTag = document.querySelector( '#customize-preview > iframe' ).contentWindow.document.getElementsByTagName('html')[0],
                scrollTo      = _this.currentBuilderType === 'header' ? 0 : 99999;

            $( iframeHTMLTag ).animate( { scrollTop: scrollTo }, 'fast' );
        },

        getCurrentBuilderByComponent: function( component ) {
            if( component.indexOf( '_hb_' ) !== -1 || component.indexOf( '_header_' ) !== -1 ) {
                return $( '.botiga-bhfb-header' );
            } else if( component.indexOf( '_fb_' ) !== -1 || component.indexOf( '_footer_' ) !== -1 ) {
                return $( '.botiga-bhfb-footer' );
            }

            return false;
        },

        showHideBuilderTop: function() {
            const self = this;

            $( '.botiga-bhfb-bottom-display' ).on( 'click', function(e){
                e.preventDefault();

                $( 'body' ).toggleClass( 'bhfb-active-bottom' );
                $( this ).toggleClass( 'show' );
                $( '.botiga-bhfb-top' ).toggleClass( 'show' );
                $( '.botiga-bhfb' ).toggleClass( 'show-bottom' );

                self.builderGridContent();
            } );
        },

        builderCustomColumns: function() {
            const 
                _this          = this,
                options        = [ 
                    'botiga_header_row__above_header_row_columns', 
                    'botiga_header_row__main_header_row_columns', 
                    'botiga_header_row__below_header_row_columns',
                    'botiga_footer_row__above_footer_row_columns_desktop', 
                    'botiga_footer_row__main_footer_row_columns_desktop', 
                    'botiga_footer_row__below_footer_row_columns_desktop' 
                ];

            options.forEach( function( optionID ){
                if( typeof wp.customize.control( optionID ) !== 'undefined' ) {

                    const devices        = optionID.indexOf( 'header' ) !== -1 ? [ 'desktop', 'tablet' ] : [ 'desktop' ];

                    for( const device of devices ) {
                        const deviceSelector = optionID.indexOf( 'header' ) !== -1 ? '_' + device : '';
                        
                        wp.customize( optionID + deviceSelector, function( option ) {
                            option.bind( function( to ) {
                                let 
                                    rows                = [ 'above', 'main', 'below' ],
                                    rowSelector         = '',
                                    $rowInput           = '';

                                for( const row of rows ) {
                                    const
                                        rowOptionID      = 'botiga_'+ _this.currentBuilderType +'_row__'+ row +'_'+ _this.currentBuilderType,
                                        rowInputSelector = '#_customize-input-botiga_'+ _this.currentBuilderType +'_row__'+ row +'_'+ _this.currentBuilderType +'_row';

                                    if( optionID.indexOf( rowOptionID ) !== -1 ) {
                                        rowSelector         = 'botiga-bhfb-'+ row +'-row';
                                        $rowInput           = $( rowInputSelector );
                                        _this.currentRow    = row;
                                    }

                                }

                                if( rowSelector === '' || $rowInput === '' ) {
                                    return false;
                                }

                                // Update builder row columns class.
                                _this.addBuilderRowColumnsClass( device, rowSelector, to );

                                // Update row input value.
                                let 
                                    current_value = _this.jsonDecode( $rowInput.val() );

                                // Add column.
                                if( to < current_value[_this.currentDevice].length ) {
                                    while( current_value[_this.currentDevice].length > to ) {
                                        current_value[_this.currentDevice].pop();
                                    }

                                // Remove column.
                                } else if( to > current_value[_this.currentDevice].length ) {
                                    while( current_value[_this.currentDevice].length < to ) {
                                        current_value[_this.currentDevice].push([]);
                                    }
                                }

                                // Update the value in the customizer field.
                                $rowInput.val( JSON.stringify( current_value ) );

                                // Update the respective row columns layout customizer field.
                                _this.updateColumnsLayoutOption( device, to );

                                // Update 'Available Columns' area.
                                _this.updateAvailableColumnsArea( device, to );

                                // Trigger change in the customizer field (desktop).
                                $rowInput.trigger( 'change' );

                                // Trigger change in the customizer field (mobile).
                                if( _this.currentBuilderType === 'header' && _this.currentDevice === 'mobile' ) {
                                    $rowInput.closest( '.customize-control' ).next().find( 'input' ).val( Math.random() ).trigger( 'change' );
                                }
                                
                                // Update grid.
                                _this.builderGridContent();

                            } );
                        } );

                    }
                    

                    
                }
            } );

            // Main purpose of the below code is update 'Columns Layout' options on the first load.
            const 
                areas = [ 'header', 'footer' ],
                rows  = [ 'above', 'main', 'below' ];

            for( const area of areas ) {
                const prefix = area === 'header' ? 'hb' : 'fb'; 
                for( const row of rows ) {
                    const sectionID = 'botiga_section_'+ prefix +'_'+ row +'_'+ area +'_row';

                    if( typeof wp.customize.section( sectionID ) !== 'undefined' ) {

                        wp.customize.section( sectionID ).expanded.bind( 
                            function( is_active ){
                                if( is_active ) {
                                    if( sectionID.indexOf( 'header' ) !== -1 ) {
                                        _this.currentBuilderType = 'header';
                                    } else if( sectionID.indexOf( 'footer' ) !== -1 ) {
                                        _this.currentBuilderType = 'footer';
                                    }

                                    const devices = _this.currentBuilderType === 'header' ? [ 'desktop', 'tablet' ] : [ 'desktop' ];
                                    for( const device of devices ) {
                                        
                                        setTimeout(function(){
                                            const 
                                                rowSelector = 'botiga-bhfb-'+ row +'-row',
                                                columnsOptionID       = 'botiga_'+ _this.currentBuilderType +'_row__'+ row +'_'+ _this.currentBuilderType +'_row_columns_'+ device;
                                                        
                                                _this.currentRow       = row;
                                                _this.currentRowInput  = $( '#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + row + '_' + _this.currentBuilderType + '_row' );

                                                // Update builder row columns class.
                                                _this.addBuilderRowColumnsClass( device, rowSelector, wp.customize( columnsOptionID ).get() );
                                                
                                                // Update 'Columns Layout' options.
                                                _this.updateColumnsLayoutOption( device, wp.customize( columnsOptionID ).get() );

                                                // Update 'Available Columns' area.
                                                _this.updateAvailableColumnsArea( device, wp.customize( columnsOptionID ).get() );
                                        }, 50);

                                    }
                                }
                            }
                        );
            
                    }
                }
            }

        },

        addBuilderRowColumnsClass: function( device, rowSelector, to ) {
            const _this = this;

            if( device === 'tablet' ) {
                device = 'mobile';
            }

            // Remove all possible columns class.
            for( let i=1; i<=6; i++ ) {
                $( '.botiga-bhfb-'+ _this.currentBuilderType +' .botiga-bhfb-'+ device +' .botiga-bhfb-row.' + rowSelector ).removeClass( 'botiga-bhfb-row-' + i + '-columns' );
            }

            // Add new columns class.
            $( '.botiga-bhfb-'+ _this.currentBuilderType +' .botiga-bhfb-'+ device +' .botiga-bhfb-row.' + rowSelector ).addClass( 'botiga-bhfb-row-' + to + '-columns' );
        },

        updateColumnsLayoutOption: function( device, val ) {
            const 
                _this      = this,
                setting_id = 'botiga_'+ _this.currentBuilderType +'_row__'+ _this.currentRow +'_'+ _this.currentBuilderType +'_row_columns_layout_' + device,
                selector   = setting_id +'-'+ wp.customize( setting_id ).get();

            // Hide the column layout options that doesn't match with 'columns' value.
            $( 'label[for*="'+ setting_id +'"]' ).css( 'display', 'none' );
            $( 'label[for*="'+ setting_id +'-'+ val +'col-"]' ).css( 'display', 'block' );

            if( $( 'label[for="'+ selector +'"]' ).parent().hasClass( 'bhfb-option-updated' ) ) {
                return false;
            }

            // Remove active class from current option.
            // $( 'label[for="'+ selector +'"]' ).removeClass( 'ui-state-active' );

            // Set new value and change active class.
            // wp.customize( setting_id ).set( val + 'col-equal' );
            // $( 'label[for="'+ setting_id +'-'+ val +'col-equal"]' ).trigger( 'click' ).addClass( 'ui-state-active' );
            
            // Add class as a flag.
            $( 'label[for="'+ selector +'"]' ).parent().addClass( 'bhfb-option-updated' );
            
        },

        builderColumnsLayout: function() {
            const 
                _this   = this,
                options = [ 
                    'botiga_header_row__above_header_row_columns_layout', 
                    'botiga_header_row__main_header_row_columns_layout', 
                    'botiga_header_row__below_header_row_columns_layout',
                    'botiga_footer_row__above_footer_row_columns_layout_desktop', 
                    'botiga_footer_row__main_footer_row_columns_layout_desktop', 
                    'botiga_footer_row__below_footer_row_columns_layout_desktop' 
                ];

            options.forEach( function( optionID ){
                if( typeof wp.customize.control( optionID ) !== 'undefined' ) {

                    const devices = optionID.indexOf( 'header' ) !== -1 ? [ 'desktop', 'tablet' ] : [ 'desktop' ];

                    for( let device of devices ) {
                        const deviceSelector = optionID.indexOf( 'header' ) !== -1 ? '_' + device : '';

                        wp.customize( optionID + deviceSelector, function( option ) {
                            option.bind( function( to ) {
                                let current_row = 'above';
    
                                if( optionID.indexOf( 'main' ) !== -1 ) {
                                    current_row = 'main';
                                } else if( optionID.indexOf( 'below' ) !== -1 ) {
                                    current_row = 'below';
                                }

                                // Convert 'tablet' to 'mobile' because html selectors are 'mobile' and not 'tablet'.
                                if( device === 'tablet' ) {
                                    device = 'mobile';
                                }
    
                                _this.currentRowInput = $( '#_customize-input-botiga_'+ _this.currentBuilderType +'_row__'+ current_row +'_'+ _this.currentBuilderType +'_row' );
    
                                const $builderRow = $( '.botiga-bhfb-'+ _this.currentBuilderType +' .botiga-bhfb-'+ device +' .botiga-bhfb-row.botiga-bhfb-' + current_row + '-row' );

                                $builderRow.removeClass( 'botiga-bhfb-row-columns-layout-equal' );
                                $builderRow.removeClass( 'botiga-bhfb-row-columns-layout-bigleft' );
                                $builderRow.removeClass( 'botiga-bhfb-row-columns-layout-bigright' );
    
                                if( to.indexOf( 'equal' ) !== -1 ) {
                                    $builderRow.addClass( 'botiga-bhfb-row-columns-layout-equal');
                                }
    
                                if( to.indexOf( 'bigleft' ) !== -1 ) {
                                    $builderRow.addClass( 'botiga-bhfb-row-columns-layout-bigleft');
                                }
    
                                if( to.indexOf( 'bigright' ) !== -1 ) {
                                    $builderRow.addClass( 'botiga-bhfb-row-columns-layout-bigright');
                                }
    
                                // Trigger change in the customizer field to run the selective refresh on the respective row.
                                const inputValue = _this.currentRowInput.val();
                                _this.currentRowInput.val( '' ).trigger( 'change' );
                                _this.currentRowInput.val( inputValue ).trigger( 'change' );

                                // Trigger change on mobile row field.
                                if( _this.currentBuilderType === 'header' && _this.currentDevice === 'mobile' ) {
                                    _this.currentRowInput.closest( '.customize-control' ).next().find( 'input' ).val( Math.random() ).trigger( 'change' );
                                }
                            });
                        });

                    }

                }
            });
        },

        updateAvailableColumnsArea: function( device, colsNumber ) {
            const 
                _this        = this,
                rowSection   = _this.currentRowInput.closest( '.control-section' ),
                avCompsItems = rowSection.find( '.bhfb-available-columns.bhfb-available-columns-'+ device +' .bhfb-available-columns-item' );

            avCompsItems.addClass( 'hide' );
            for( let i=1; i<=colsNumber; i++ ) {
                avCompsItems.eq( i - 1 ).removeClass( 'hide' );
            }
        },

        footerCustomizerOptions: function() {

            // Rows.
            const rows = [ 'above', 'main', 'below' ];

            for( const row of rows ) {
                const fieldID = 'botiga_footer_row__' + row + '_footer_row';

                // Vertical Aligment.
                wp.customize( fieldID, function( option ) {
                    option.bind( function( to ) {

                        $( '.bhfb-footer' ).remove();

                    } );
                } );

            }
            
        },

        extraNavigation: function() {
            const _this = this;

            wp.customize.panel( 'botiga_panel_footer' ).expanded.bind(function( is_active ){
                if( is_active ) {
                    wp.customize.section( 'botiga_section_fb_wrapper' ).focus();
                }
            });
        },

        headerPresets: function() {
            const _this = this;
            
            wp.customize( 'botiga_section_hb_presets__header_preset_layout', function( option ) {
                option.bind( function( to ) {
                    _this.updateHeaderPreset( to );
                } );
            } );
        },

        updateHeaderPreset: function( preset ) {
            const 
                _this      = this,
                $above_row = $( '#_customize-input-botiga_header_row__above_header_row' ),
                $main_row  = $( '#_customize-input-botiga_header_row__main_header_row' ),
                $below_row = $( '#_customize-input-botiga_header_row__below_header_row' );

            // Set some others customizer settings.
            if( preset === 'header_layout_1' ) {
                wp.customize( 'botiga_header_row__main_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column1_horizontal_alignment_desktop' ).set( 'start' );

                wp.customize( 'botiga_header_row__main_header_row_column2_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column2_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column2_horizontal_alignment_desktop' ).set( 'center' );

                wp.customize( 'botiga_header_row__main_header_row_column3_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column3_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column3_horizontal_alignment_desktop' ).set( 'end' );
            }

            if( preset === 'header_layout_2' ) {
                wp.customize( 'botiga_header_row__main_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column1_horizontal_alignment_desktop' ).set( 'start' );

                wp.customize( 'botiga_header_row__main_header_row_column2_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column2_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column2_horizontal_alignment_desktop' ).set( 'end' );
            }

            if( preset === 'header_layout_3' ) {
                wp.customize( 'botiga_header_row__main_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column1_horizontal_alignment_desktop' ).set( 'start' );

                wp.customize( 'botiga_header_row__main_header_row_column2_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column2_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column2_horizontal_alignment_desktop' ).set( 'center' );

                wp.customize( 'botiga_header_row__main_header_row_column3_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column3_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column3_horizontal_alignment_desktop' ).set( 'end' );

                wp.customize( 'botiga_header_row__below_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__below_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__below_header_row_column1_horizontal_alignment_desktop' ).set( 'center' );
            }

            if( preset === 'header_layout_4' ) {
                wp.customize( 'botiga_header_row__main_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column1_horizontal_alignment_desktop' ).set( 'start' );

                wp.customize( 'botiga_header_row__main_header_row_column2_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column2_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column2_horizontal_alignment_desktop' ).set( 'end' );

                wp.customize( 'botiga_header_row__below_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__below_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__below_header_row_column1_horizontal_alignment_desktop' ).set( 'start' );

                wp.customize( 'botiga_header_row__below_header_row_column2_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__below_header_row_column2_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__below_header_row_column2_horizontal_alignment_desktop' ).set( 'end' );
            }

            if( preset === 'header_layout_5' ) {
                wp.customize( 'botiga_header_row__main_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column1_horizontal_alignment_desktop' ).set( 'start' );

                wp.customize( 'botiga_header_row__main_header_row_column2_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column2_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column2_horizontal_alignment_desktop' ).set( 'center' );

                wp.customize( 'botiga_header_row__main_header_row_column3_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__main_header_row_column3_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__main_header_row_column3_horizontal_alignment_desktop' ).set( 'end' );

                wp.customize( 'botiga_header_row__below_header_row_column1_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__below_header_row_column1_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__below_header_row_column1_horizontal_alignment_desktop' ).set( 'start' );

                wp.customize( 'botiga_header_row__below_header_row_column2_vertical_alignment_desktop' ).set( 'middle' );
                wp.customize( 'botiga_header_row__below_header_row_column2_inner_layout_desktop' ).set( 'inline' );
                wp.customize( 'botiga_header_row__below_header_row_column2_horizontal_alignment_desktop' ).set( 'end' );
            }

            // Mobile (always same layout for all presets).
            wp.customize( 'botiga_header_row__main_header_row_column1_vertical_alignment_tablet' ).set( 'middle' );
            wp.customize( 'botiga_header_row__main_header_row_column1_inner_layout_tablet' ).set( 'inline' );
            wp.customize( 'botiga_header_row__main_header_row_column1_horizontal_alignment_tablet' ).set( 'start' );
            wp.customize( 'botiga_header_row__main_header_row_column1_vertical_alignment_mobile' ).set( 'middle' );
            wp.customize( 'botiga_header_row__main_header_row_column1_inner_layout_mobile' ).set( 'inline' );
            wp.customize( 'botiga_header_row__main_header_row_column1_horizontal_alignment_mobile' ).set( 'start' );

            wp.customize( 'botiga_header_row__main_header_row_column2_vertical_alignment_tablet' ).set( 'middle' );
            wp.customize( 'botiga_header_row__main_header_row_column2_inner_layout_tablet' ).set( 'inline' );
            wp.customize( 'botiga_header_row__main_header_row_column2_horizontal_alignment_tablet' ).set( 'center' );
            wp.customize( 'botiga_header_row__main_header_row_column2_vertical_alignment_mobile' ).set( 'middle' );
            wp.customize( 'botiga_header_row__main_header_row_column2_inner_layout_mobile' ).set( 'inline' );
            wp.customize( 'botiga_header_row__main_header_row_column2_horizontal_alignment_mobile' ).set( 'center' );

            wp.customize( 'botiga_header_row__main_header_row_column3_vertical_alignment_tablet' ).set( 'middle' );
            wp.customize( 'botiga_header_row__main_header_row_column3_inner_layout_tablet' ).set( 'inline' );
            wp.customize( 'botiga_header_row__main_header_row_column3_horizontal_alignment_tablet' ).set( 'end' );
            wp.customize( 'botiga_header_row__main_header_row_column3_vertical_alignment_mobile' ).set( 'middle' );
            wp.customize( 'botiga_header_row__main_header_row_column3_inner_layout_mobile' ).set( 'inline' );
            wp.customize( 'botiga_header_row__main_header_row_column3_horizontal_alignment_mobile' ).set( 'end' );

            // Set row settings and trigger change.
            $above_row.val( botiga_hfb.header_presets[ preset ][ 'above_row' ] ).trigger( 'change' );
            $main_row.val( botiga_hfb.header_presets[ preset ][ 'main_row' ] ).trigger( 'change' );
            $below_row.val( botiga_hfb.header_presets[ preset ][ 'below_row' ] ).trigger( 'change' );

            // Trigger change on mobile row field.
            $above_row.closest( '.customize-control' ).next().find( 'input' ).val( Math.random() ).trigger( 'change' );
            $main_row.closest( '.customize-control' ).next().find( 'input' ).val( Math.random() ).trigger( 'change' );
            $below_row.closest( '.customize-control' ).next().find( 'input' ).val( Math.random() ).trigger( 'change' );

            _this.builderGridContent();
        }
    }

    $( document ).ready(function(){
        bhfb.init();
    });
    
})(jQuery);