"use strict";

;

(function ($) {
  'use strict';

  $.fn.botigaMetabox = function () {
    return this.each(function () {
      var $this = $(this);
      var $tabs = $this.find('.botiga-metabox-tab');
      var $contents = $this.find('.botiga-metabox-content');
      $tabs.each(function () {
        var $tab = $(this);
        $tab.on('click', function (e) {
          e.preventDefault();
          $tab.addClass('active').siblings().removeClass('active');
          $contents.eq($tab.index()).addClass('active').siblings().removeClass('active');
        });
      });
      var $repeater = $contents.find('.botiga-metabox-field-repeater');

      if ($repeater.length) {
        $repeater.each(function () {
          var $list = $(this).find('ul');
          $list.sortable({
            axis: 'y',
            cursor: 'move',
            helper: 'original',
            handle: '.botiga-metabox-field-repeater-move'
          });
          $repeater.find('.botiga-metabox-field-repeater-add').on('click', function (e) {
            e.preventDefault();
            var $item = $list.find('li').first().clone(true);
            var $input = $item.find('input');
            $input.attr('name', $input.data('name'));
            $item.removeClass('hidden');
            $list.append($item);
          });
          $repeater.find('.botiga-metabox-field-repeater-remove').on('click', function (e) {
            e.preventDefault();
            $(this).closest('li').remove();
          });
        });
      }

      var $uploads = $contents.find('.botiga-metabox-field-uploads');

      if ($uploads.length) {
        $uploads.each(function () {
          var $list = $(this).find('ul');
          $list.sortable({
            axis: 'y',
            cursor: 'move',
            helper: 'original',
            handle: '.botiga-metabox-field-uploads-move'
          });
          $uploads.find('.botiga-metabox-field-uploads-add').on('click', function (e) {
            e.preventDefault();
            var $item = $list.find('li').first().clone(true);
            var $input = $item.find('input');
            $input.attr('name', $input.data('name'));
            $item.removeClass('hidden');
            $list.append($item);
          });
          var wpMediaFrame;
          var wpMediaInput;
          $uploads.find('.botiga-metabox-field-uploads-upload').on('click', function (e) {
            e.preventDefault();
            wpMediaInput = $(this).closest('li').find('input');

            if (wpMediaFrame) {
              wpMediaFrame.open();
              return;
            }

            wpMediaFrame = window.wp.media({
              library: {
                type: $list.data('library') || 'image'
              }
            }).open();
            wpMediaFrame.on('select', function () {
              var attachment = wpMediaFrame.state().get('selection').first().toJSON();
              wpMediaInput.val(attachment.url);
            });
          });
          $uploads.find('.botiga-metabox-field-uploads-remove').on('click', function (e) {
            e.preventDefault();
            $(this).closest('li').remove();
          });
        });
      }

      var $sizeChart = $contents.find('.botiga-metabox-field-size-chart');

      if ($sizeChart.length) {
        $sizeChart.on('multidimensional', function (event, $table) {
          var $wrap = $table || $sizeChart;
          $wrap.find('input').each(function () {
            var $input = $(this);
            var liIndex = Math.max(0, $input.closest('li').index() - 1);
            var trIndex = Math.max(0, $input.closest('tr').index() - 1);
            var tdIndex = Math.max(0, $input.closest('td').index());
            this.name = this.name.replace(/(\[\d+\])\[sizes\](\[\d+\])(\[\d+\])/, '[' + liIndex + '][sizes][' + trIndex + '][' + tdIndex + ']');
            this.name = this.name.replace(/(\[\d+\])\[name\]/, '[' + liIndex + '][name]');
          });
        });
        $sizeChart.each(function () {
          var $list = $(this).find('ul');
          $sizeChart.on('click', '.botiga-add', function (e) {
            e.preventDefault();
            var $item = $list.find('li').first().clone(true);
            var $input = $item.find('input');
            $input.each(function () {
              $(this).attr('name', $(this).data('name'));
              $(this).removeAttr('data-name');
            });
            $item.removeClass('hidden');
            $list.append($item);
            $sizeChart.trigger('multidimensional', [$item]);
          });
          $sizeChart.on('click', '.botiga-add-col', function (e) {
            e.preventDefault();
            var $td = $(this).closest('td');
            var $table = $(this).closest('table');
            var $columns = $(this).closest('tbody').find('tr td:nth-child(' + ($td.index() + 1) + ')');
            $columns.each(function () {
              var $column = $(this);
              var $clone = $column.clone(true);
              $clone.find('input').val('');
              $column.after($clone);
            });
            $sizeChart.trigger('multidimensional', [$table]);
          });
          $sizeChart.on('click', '.botiga-del-col', function (e) {
            e.preventDefault();
            var $td = $(this).closest('td');
            var $table = $(this).closest('table');
            var $count = $(this).closest('tr').find('td').length;
            var $target = $(this).closest('tbody').find('tr td:nth-child(' + ($td.index() + 1) + ')');

            if ($count > 2) {
              $target.remove();
            } else {
              $target.find('input').val('');
            }

            $sizeChart.trigger('multidimensional', [$table]);
          });
          $sizeChart.on('click', '.botiga-add-row', function (e) {
            e.preventDefault();
            var $tr = $(this).closest('tr');
            var $table = $(this).closest('table');
            var $clone = $tr.clone(true);
            $clone.find('input').val('');
            $tr.after($clone);
            $sizeChart.trigger('multidimensional', [$table]);
          });
          $sizeChart.on('click', '.botiga-del-row', function (e) {
            e.preventDefault();
            var $tr = $(this).closest('tr');
            var $table = $(this).closest('table');
            var $count = $(this).closest('tbody').find('tr').length;

            if ($count > 2) {
              $tr.remove();
            } else {
              $tr.find('input').val('');
            }

            $sizeChart.trigger('multidimensional', [$table]);
          });
          $sizeChart.on('click', '.botiga-remove', function (e) {
            e.preventDefault();
            $(this).closest('li').remove();
            $sizeChart.trigger('multidimensional');
          });
          $sizeChart.on('click', '.botiga-duplicate', function (e) {
            e.preventDefault();
            var $li = $(this).closest('li');
            var $clone = $li.clone(true);
            $li.after($clone);
            $sizeChart.trigger('multidimensional');
          });
        });
      }

      var $mediaField = $('.botiga-metabox-field-media');

      if ($mediaField.length) {
        $mediaField.each(function () {
          var $field = $(this);
          var $input = $field.find('.botiga-metabox-field-media-input');
          var $image = $field.find('.botiga-metabox-field-media-preview img');
          var $upload = $field.find('.botiga-metabox-field-media-upload');
          var $remove = $field.find('.botiga-metabox-field-media-remove');
          var placeholder = $image.data('placeholder');
          var wpMediaFrame;
          $upload.on('click', function (e) {
            e.preventDefault();

            if (wpMediaFrame) {
              wpMediaFrame.open();
              return;
            }

            wpMediaFrame = window.wp.media({
              library: {
                type: 'image'
              }
            });
            wpMediaFrame.on('select', function () {
              var attachment = wpMediaFrame.state().get('selection').first().toJSON();
              var thumbnail;

              if (attachment && attachment.sizes && attachment.sizes.thumbnail) {
                thumbnail = attachment.sizes.thumbnail.url;
              } else {
                thumbnail = attachment.url;
              }

              $input.val(attachment.id);
              $image.attr('src', thumbnail);
              $remove.removeClass('hidden');
            });
            wpMediaFrame.open();
          });
          $remove.on('click', function (e) {
            e.preventDefault();
            $input.val('');
            $image.attr('src', placeholder);
            $remove.addClass('hidden');
          });
        });
      }

      var $depends = $contents.find('[data-depend-on]');

      if ($depends.length) {
        $depends.each(function () {
          var $depend = $(this);
          var $target = $contents.find('[name="' + $depend.data('depend-on') + '"]');

          if (!$target.data('depend-on')) {
            $target.on('change', function () {
              var $dependOn = $contents.find('[data-depend-on="' + $depend.data('depend-on') + '"]');

              if ($(this).is(':checked')) {
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

  $(document).ready(function ($) {
    $('.botiga-metabox').botigaMetabox();
  });
})(jQuery);