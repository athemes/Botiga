(function($){

    'use strict';

    /**
     * Admin interaction
     * The code here interact somehow with the admin
     */
    wp.customize.bind( 'preview-ready', function() {
        $( document ).on( 'click', '.bhfb-item-customizer-focus', function(e){
            e.preventDefault();
            e.stopPropagation();

            const 
                id = $( this ).closest( '.bhfb-builder-item' ).data( 'component-id' );

            // Check builder type.
            let currentBuilderSelector = '.botiga-bhfb-header';
            if( $( this ).closest( '.bhfb-footer' ).length ) {
                currentBuilderSelector = '.botiga-bhfb-footer';
            }

            // Go to component section.
            if( $( this ).closest( '.bhfb-header' ).length ) {
                window.parent.wp.customize.section( 'botiga_section_hb_component__' + id ).focus();
            } else {
                window.parent.wp.customize.section( 'botiga_section_fb_component__' + id ).focus();
            }

            // Show grid builder.
            $( window.parent.document ).find( currentBuilderSelector ).addClass( 'show' );
        } );

        // Components Popup
        // The components popup should close when
        // we click on the preview iframe as well
        $( 'html' ).on( 'mouseup', function(){
            $( window.parent.document ).find( '#botiga-bhfb-elements' ).removeClass( 'show' );
        } );

        // Some scripts needs to run again when selective refresh partial is rendered again.
        // To do: detect which element is extactly being rendered and initialize the respective script only. So we don't run it on every selective refresh content rendered.
        let flag = false;
        wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( placement ) {
            if( ! flag ) {

                // Header Search
                botiga.headerSearch.init();

                // Navigation
                setTimeout(function(){
                    botiga.navigation.init();
                }, 500);

                setTimeout(function(){
                    bhfb_hide_empty_rows();
                }, 200);

                flag = true;

                setTimeout(function(){
                    flag = false;
                }, 500);
            }
        } );

        bhfb_hide_empty_rows();
    });

    /**
     * Hide header builder empty rows
     */
    function bhfb_hide_empty_rows() {
        $( '.bhfb-row' ).each(function() {
            if( $(this).hasClass( 'bhfb-is-row-empty' ) ) {
                $( this ).parent().parent().addClass( 'bt-d-none' );
            } else {
                $( this ).parent().parent().removeClass( 'bt-d-none' );
            }
        });
    }

    // CSS
    const
        css = {
            
            // Header Rows Border
            'botiga_header_row__above_header_row_border_bottom_desktop' : {
                'selector'  : '.bhfb-above_header_row',
                'prop'      : 'border-bottom-width',
                'unit'      : 'px'
            },
            'botiga_header_row__main_header_row_border_bottom_desktop' : {
                'selector'  : '.bhfb-main_header_row',
                'prop'      : 'border-bottom-width',
                'unit'      : 'px'
            },
            'botiga_header_row__below_header_row_border_bottom_desktop' : {
                'selector'  : '.bhfb-below_header_row',
                'prop'      : 'border-bottom-width',
                'unit'      : 'px'
            },

            // Footer Rows Border
            'botiga_footer_row__above_footer_row_border_top_desktop' : {
                'selector'  : '.bhfb-above_footer_row',
                'prop'      : 'border-top-width',
                'unit'      : 'px'
            },
            'botiga_footer_row__main_footer_row_border_top_desktop' : {
                'selector'  : '.bhfb-main_footer_row',
                'prop'      : 'border-top-width',
                'unit'      : 'px'
            },
            'botiga_footer_row__below_footer_row_border_top_desktop' : {
                'selector'  : '.bhfb-below_footer_row',
                'prop'      : 'border-top-width',
                'unit'      : 'px'
            },

            // Mobile Offcanvas Wrapper
            'bhfb_mobile_offcanvas_padding' : {
                'selector'  : '.bhfb-mobile_offcanvas',
                'prop'      : 'padding',
                'unit'      : 'px'
            },
            'mobile_menu_elements_spacing' : {
                'selector'  : '.bhfb-mobile_offcanvas .bhfb-builder-item + .bhfb-builder-item',
                'prop'      : 'margin-top',
                'unit'      : 'px'
            },
            'bhfb_mobile_offcanvas_close_offset' : {
                'selector'  : '.bhfb-mobile_offcanvas .mobile-menu-close',
                'prop'      : [ 'top', 'right' ],
                'unit'      : 'px'
            },

            // Mobile Offcanvas Menu
            'link_separator_color': {
                'selector'  : '.botiga-offcanvas-menu .botiga-dropdown ul li',
                'prop'      : 'border-bottom-color'
            },

            // Contact Info Component.
            'bhfb_contact_info_display_inline' : {
                'selector'    : '.bhfb-component-contact_info .header-contact',
                'toggleClass' : 'header-contact-inline'
            },

            // Copyright Component.
            'botiga_section_fb_component__copyright_text_alignment' : {
                'selector'  : '.bhfb-component-copyright .botiga-credits',
                'prop'      : 'text-align',
            }
        };

    // Columns.
    const
        builders = [ 'header', 'footer' ],
        rows     = [ 'above', 'main', 'below' ],
        opts     = [ 'vertical_alignment', 'inner_layout', 'horizontal_alignment' ];

    for( let i=1; i<=6; i++ ) {
        for( const [index, opt] of opts.entries() ) {
            for( const builder of builders ) {
                for( const row of rows ) {
                    
                    const
                        optionID       = 'botiga_'+ builder +'_row__'+ row +'_'+ builder +'_row_column'+ i +'_' + opt, 
                        columnSelector = '.bhfb-'+ builder +' .bhfb-'+ row +'_'+ builder +'_row .bhfb-column-' + i;
    
                    css[ optionID ] = {
                        'selector': columnSelector,
                        'addClass'    : getClassToAdd( optionID ),
                        'removeClass' : getClassToRemove( optionID )
                    };
            
                }
            }
        }
    }

    $.each( css, function( option, props ) {
        wp.customize( option, function( value ) {
            value.bind( function( to ) {
                if( typeof props.toggleClass !== 'undefined' ) {
                    $( props.selector ).toggleClass( props.toggleClass );

                    return false;
                }

                if( typeof props.addClass !== 'undefined' ) {

                    // Remove Class.
                    if( typeof props.removeClass !== 'undefined' ) {
                        if( typeof props.removeClass === 'string' ) {
                            $( props.selector ).removeClass( props.removeClass );
                        } else {
                            $.each( props.removeClass, function( index, value ) {
                                $( props.selector ).removeClass( value );
                            });
                        }
                    }

                    // Add class.
                    $( props.selector ).addClass( props.addClass + to );

                    return false;
                }
                
                $( 'head' ).find( '#botiga-customizer-styles-' + option ).remove();
                
                let output = '';

                if( typeof props.prop === 'string' ) {
                    output += props.selector + ' { '+ props.prop +':' + to + ( props.unit ? props.unit : '' ) + '; }';
                } else {
                    $.each( props.prop, function( key, cssProp ) {
                        output += props.selector + '{ '+ cssProp +': '+ to + ( props.unit ? props.unit : '' ) + '; }';
                    } );
                }

    
                $( 'head' ).append( '<style id="botiga-customizer-styles-' + option +'">' + output + '</style>' );
            } );
        } );
    });

    // Responsive CSS
    const 
        $devices   = { 
            "desktop": "(min-width: 992px)", 
            "tablet": "(min-width: 576px) and (max-width: 991px)", 
            "mobile": "(max-width: 575px)" 
        },
        resp_css = {

            // Header Rows.
            'botiga_header_row__above_header_row_height' : {
                'selector' : '.bhfb-above_header_row',
                'prop'     : 'min-height',
                'unit'     : 'px'
            },
            'botiga_header_row__main_header_row_height' : {
                'selector' : '.bhfb-main_header_row',
                'prop'     : 'min-height',
                'unit'     : 'px'
            },
            'botiga_header_row__below_header_row_height' : {
                'selector' : '.bhfb-below_header_row',
                'prop'     : 'min-height',
                'unit'     : 'px'
            },

            // Footer Rows.
            'botiga_footer_row__above_footer_row_height' : {
                'selector' : '.bhfb-above_footer_row',
                'prop'     : 'min-height',
                'unit'     : 'px'
            },
            'botiga_footer_row__main_footer_row_height' : {
                'selector' : '.bhfb-main_footer_row',
                'prop'     : 'min-height',
                'unit'     : 'px'
            },
            'botiga_footer_row__below_footer_row_height' : {
                'selector' : '.bhfb-below_footer_row',
                'prop'     : 'min-height',
                'unit'     : 'px'
            },

            // Site Logo Size.
            'site_logo_size' : {
                'selector' : '.custom-logo-link img',
                'prop'     : 'width',
                'unit'     : 'px'
            },
        };
    
    $.each( resp_css, function( option, css_data ) {
        $.each( $devices, function( device, mediaSize ) {
            wp.customize( option + '_' + device, function( value ) {
                value.bind( function( to ) {

                    $( 'head' ).find( '#botiga-customizer-styles-' + option + '_' + device ).remove();
        
                    var output = '@media ' + mediaSize + ' {' + css_data.selector + ' { '+ css_data.prop +':' + to + css_data.unit +'; } }';
        
                    $( 'head' ).append( '<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>' );
                } );
            } );
        });
    });

    /**
     * Get column number from the option name.
     */
     function getColumnNumber( optionID ) {
        if( optionID.indexOf( 'column1' ) !== -1 ) {
            return 1;
        }

        if( optionID.indexOf( 'column2' ) !== -1 ) {
            return 2;
        }

        if( optionID.indexOf( 'column3' ) !== -1 ) {
            return 3;
        }

        if( optionID.indexOf( 'column4' ) !== -1 ) {
            return 4;
        }

        if( optionID.indexOf( 'column5' ) !== -1 ) {
            return 5;
        }

        if( optionID.indexOf( 'column6' ) !== -1 ) {
            return 6;
        }
    }

    /**
     * Get class to add
     */
    function getClassToAdd( optionID ) {
        if( optionID.indexOf( 'vertical_alignment' ) !== -1 ) {
            return 'bhfb-vertical-align-';
        }

        if( optionID.indexOf( 'inner_layout' ) !== -1 ) {
            return 'bhfb-inner-layout-';
        }

        if( optionID.indexOf( 'horizontal_alignment' ) !== -1 ) {
            return 'bhfb-horizontal-align-';
        }
    }

    /**
     * Get class to remove
     */
     function getClassToRemove( optionID ) {
        if( optionID.indexOf( 'vertical_alignment' ) !== -1 ) {
            return [ 'bhfb-vertical-align-top', 'bhfb-vertical-align-middle', 'bhfb-vertical-align-bottom' ];
        }

        if( optionID.indexOf( 'inner_layout' ) !== -1 ) {
            return [ 'bhfb-inner-layout-inline', 'bhfb-inner-layout-stack' ];
        }

        if( optionID.indexOf( 'horizontal_alignment' ) !== -1 ) {
            return [ 'bhfb-horizontal-align-start', 'bhfb-horizontal-align-center', 'bhfb-horizontal-align-end' ];
        }
    }

    

})(jQuery);