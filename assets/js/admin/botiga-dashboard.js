(function( $ ){

  'use strict';

  $(document).ready( function() {

    // Globals
    var $body = $('body');

    // Dashboard hero re-position
    var $header = $('.wp-header-end');
    var $notice = $('.botiga-dashboard-notice');

    if ( $header.length && $notice.length ) {
      $header.after( $notice );
      $notice.addClass('show');
    }

    // Dashboard hero dismissable
    var $dismissable = $('.botiga-dashboard-dismissable');

    if ( $dismissable.length ) {

      $dismissable.on('click', function() {

        $dismissable.parent().hide();

        $.post( window.botiga_dashboard.ajax_url, {
          action: 'botiga_dismissed_handler',
          nonce: window.botiga_dashboard.nonce,
          notice: $dismissable.data('notice'),
        });

      });

    }

    // License button
    var $license = $('.botiga-license-button');

    if ( $license.length ) {

      $license.on('click', function( e ) {

        var $button = $(this);

        if ( $button.data('type') === 'activate' ) {
          $button.html('<i class="dashicons dashicons-update-alt"></i>'+ window.botiga_dashboard.i18n.activating);
        } else {
          $button.html('<i class="dashicons dashicons-update-alt"></i>'+ window.botiga_dashboard.i18n.deactivating);
        }

      });

    }

    // Dashboard modals
    var $modals = $('.botiga-dashboard-modal');

    if ( $modals.length ) {

      $modals.each( function() {

        var $modal   = $(this);
        var $button  = $modal.find('.botiga-dashboard-modal-button');
        var $close   = $modal.find('.botiga-dashboard-modal-close');
        var $overlay = $modal.find('.botiga-dashboard-modal-overlay');

        $button.on('click', function( e ) {

          e.preventDefault();

          $overlay.addClass('show');
          $body.addClass('botiga-dashboard-modal-opened');

        });

        $close.on('click', function( e ) {

          e.preventDefault();

          $body.removeClass('botiga-dashboard-modal-opened');
          $overlay.removeClass('show');

        });

        $overlay.on('click', function( e ) {

          e.preventDefault();

          if ( e.target.closest('.botiga-dashboard-modal-content') === null ) {
            $body.removeClass('botiga-dashboard-modal-opened');
            $overlay.removeClass('show');
          }

        });

      });

    }

    // Install plugin
    var $plugin = $('.botiga-dashboard-plugin-ajax-button');

    if ( $plugin.length ) {

      $plugin.on('click', function( e ) {

        e.preventDefault();

        var $button  = $(this);
        var href    = $button.attr('href');
        var slug    = $button.data('slug');
        var type    = $button.data('type');
        var path    = $button.data('path');
        var caption = $button.html();

        $button.addClass('botiga-ajax-progress');
        $button.parent().siblings('.botiga-dashboard-hero-warning').remove();

        if ( type === 'install' ) {
          $button.html('<i class="dashicons dashicons-update-alt"></i>'+ window.botiga_dashboard.i18n.installing);
        } else if ( type === 'activate' ) {
          $button.html('<i class="dashicons dashicons-update-alt"></i>'+ window.botiga_dashboard.i18n.activating);
        } else if ( type === 'deactivate' ) {
          $button.html('<i class="dashicons dashicons-update-alt"></i>'+ window.botiga_dashboard.i18n.deactivating);
        }

        $.post( window.botiga_dashboard.ajax_url, {
          action: 'botiga_plugin',
          nonce: window.botiga_dashboard.nonce,
          slug: slug,
          type: type,
          path: path,
        }, function( response ) {

          if ( response.success ) {

            if ( type === 'install' ) {

              $button.html('<i class="dashicons dashicons-saved"></i>'+ window.botiga_dashboard.i18n.activated);

              setTimeout( function() {

                $button.html(window.botiga_dashboard.i18n.redirecting);

                setTimeout( function() {

                  window.location = href;

                }, 1000 );

              }, 500 );

            } else {

              window.location = href;

            }

          } else if ( response.data ) {

            $button.html( caption );
            $button.parent().after('<div class="botiga-dashboard-hero-warning">'+ response.data +'</div>');

          } else {

            $button.html( caption );
            $button.parent().after('<div class="botiga-dashboard-hero-warning">'+ window.botiga_dashboard.i18n.failed_message +'</div>');

          }

        }).fail( function( xhr, textStatus, e ) {

          $button.html( caption );
          $button.parent().after('<div class="botiga-dashboard-hero-warning">'+ window.botiga_dashboard.i18n.failed_message +'</div>');

        });

      });

    }

    // Activate Feature
    var $activate = $('.botiga-dashboard-activate-button');

    if ( $activate.length ) {

      $activate.on('click', function( e ) {

        $(this).html('<i class="dashicons dashicons-update-alt"></i>'+ window.botiga_dashboard.i18n.activating);

      });

    }

    // Deactivate Feature
    var $deactivate = $('.botiga-dashboard-deactivate-button');

    if ( $deactivate.length ) {

      $deactivate.on('click', function( e ) {

        $(this).html('<i class="dashicons dashicons-update-alt"></i>'+ window.botiga_dashboard.i18n.deactivating);

      });

    }

  });

})( jQuery );
