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
    });
  };

  $(document).ready(function ($) {
    $('.botiga-metabox').botigaMetabox();
  });
})(jQuery);