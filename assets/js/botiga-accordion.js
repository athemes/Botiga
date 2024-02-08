"use strict";

/**
 * Botiga Accordion
 * 
 * jQuery Dependant: true
 * 
 */
(function ($) {
  'use strict';

  var botiga = botiga || {};
  botiga.accordion = {
    /**
     * Init
     * 
     * @return {void}
     */
    init: function init() {
      var self = this;
      $('.botiga-accordion').each(function () {
        var toggle = $(this).find('.botiga-accordion-toggle');
        var content = $(this).find('.botiga-accordion-body');
        toggle.on('click', function () {
          self.slideToggleEffect($(this), content);
        });
        toggle.on('keyup', function (e) {
          if (e.keyCode === 13) {
            self.slideToggleEffect($(this), content);
          }
        });
      });
    },
    /**
     * Slide Toggle Effect
     * 
     * @param {object} triggerEl
     * @param {object} content
     * 
     * @return {void}
     */
    slideToggleEffect: function slideToggleEffect(triggerEl, content) {
      content.slideToggle(300);
      triggerEl.toggleClass('active');
    }
  };
  $(document).ready(function () {
    botiga.accordion.init();
  });
})(jQuery);