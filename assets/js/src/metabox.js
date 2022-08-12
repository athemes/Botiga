;(function( $ ) {
  'use strict';

  $.fn.botigaMetabox = function() {
    return this.each( function() {

    	var $this     = $(this);
			var $tabs     = $this.find('.botiga-metabox-tab');
			var $contents = $this.find('.botiga-metabox-content');

			$tabs.each( function() {

				var $tab = $(this);

				$tab.on('click', function( e ) {

					e.preventDefault();

					$tab.addClass('active').siblings().removeClass('active');
					$contents.eq( $tab.index() ).addClass('active').siblings().removeClass('active');

				});

			});

			var $repeater = $contents.find('.botiga-metabox-field-repeater');
			
			if ( $repeater.length ) {

				$repeater.each( function() {

					var $list = $(this).find('ul');

					$list.sortable({
						axis: 'y',
						cursor: 'move',
						helper: 'original',
						handle: '.botiga-metabox-field-repeater-move',
					});

					$repeater.find('.botiga-metabox-field-repeater-add').on('click', function( e ) {

						e.preventDefault();

						var $item  = $list.find('li').first().clone(true);
						var $input = $item.find('input');

						$input.attr('name', $input.data('name'));
						$item.removeClass('hidden');

						$list.append( $item );

					});

					$repeater.find('.botiga-metabox-field-repeater-remove').on('click', function( e ) {
						
						e.preventDefault();
						
						$(this).closest('li').remove();
					
					});

				});
			
			}

			var $uploads = $contents.find('.botiga-metabox-field-uploads');
			
			if ( $uploads.length ) {

				$uploads.each( function() {

					var $list = $(this).find('ul');

					$list.sortable({
						axis: 'y',
						cursor: 'move',
						helper: 'original',
						handle: '.botiga-metabox-field-uploads-move',
					});

					$uploads.find('.botiga-metabox-field-uploads-add').on('click', function( e ) {

						e.preventDefault();

						var $item  = $list.find('li').first().clone(true);
						var $input = $item.find('input');

						$input.attr('name', $input.data('name'));
						$item.removeClass('hidden');

						$list.append( $item );

					});

					var wpMediaFrame;
					var wpMediaInput;

					$uploads.find('.botiga-metabox-field-uploads-upload').on('click', function( e ) {

						e.preventDefault();
						
						wpMediaInput = $(this).closest('li').find('input');

            if ( wpMediaFrame ) {
              wpMediaFrame.open();
              return;
            }

            wpMediaFrame = window.wp.media({
              library: {
                type: $list.data('library') || 'image',
              },
            }).open();

            wpMediaFrame.on('select', function() {
              
              var attachment = wpMediaFrame.state().get( 'selection' ).first().toJSON();
             
              wpMediaInput.val(attachment.url);
            
            });
          
					});

					$uploads.find('.botiga-metabox-field-uploads-remove').on('click', function( e ) {

						e.preventDefault();

						$(this).closest('li').remove();

					});

				});
			
			}

			var $depends = $contents.find('[data-depend-on]');

			if ( $depends.length ) {

				$depends.each( function() {

					var $depend = $(this);
					var $target = $contents.find( '[name="'+  $depend.data('depend-on') +'"]' );

					if ( ! $target.data('depend-on') ) {

						$target.on('change', function() {

							var $dependOn = $contents.find( '[data-depend-on="'+  $depend.data('depend-on') +'"]' );

							if ( $(this).is(':checked') ) {
								$dependOn.removeClass('botiga-metabox-field-hidden');
							} else {
								$dependOn.addClass('botiga-metabox-field-hidden');
							}

						});

						$target.data('depend-on', true);
					
					}

				});

			}

    });
  };

	$(document).ready( function( $ ) {

		$('.botiga-metabox').botigaMetabox();

	});

})( jQuery );
