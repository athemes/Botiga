/**
 * Botiga Popup
 */
'use strict';

var botiga = botiga || {};
botiga.popup = {
  // To ensure better compatibility with plugins like WP Rocket that has
  // options to defer/lazy-load JS files, each JS script should have your own 
  // 'domReady' function. This way the script has no dependecies and can be loaded standalone.
  domReady: function domReady(fn) {
    if (typeof fn !== 'function') {
      return;
    }

    if (document.readyState === 'interactive' || document.readyState === 'complete') {
      return fn();
    }

    document.addEventListener('DOMContentLoaded', fn, false);
  },
  init: function init() {
    var _this = this,
        buttons = document.querySelectorAll('.has-popup');

    if (!buttons.length) {
      return false;
    } // Open the popup if there's some error


    var error = document.querySelector('.botiga-popup-wrapper .woocommerce-notices-wrapper .woocommerce-error');

    if (error !== null) {
      var popupID = error.closest('.botiga-popup').getAttribute('id'),
          popup = document.getElementById(popupID);
      this.openPopup(popup);
    } // Open popup link/button


    var _loop = function _loop(i) {
      var button = buttons[i];
      button.addEventListener('click', function (e) {
        e.preventDefault();
        var popup = document.getElementById(this.getAttribute('data-popup-id'));

        _this.openPopup(popup);
      }); // auto open

      if (button.getAttribute('data-auto-open') === 'true') {
        var delay = button.getAttribute('data-auto-open-delay');

        if (typeof delay === 'string') {
          setTimeout(function () {
            button.dispatchEvent(new Event('click'));
          }, parseInt(delay) * 1000);
        } else {
          button.dispatchEvent(new Event('click'));
        }
      }
    };

    for (var i = 0; i < buttons.length; i++) {
      _loop(i);
    } // Close popup link/button


    var closebtns = document.querySelectorAll('.botiga-popup-wrapper__close-button');

    for (var _i = 0; _i < closebtns.length; _i++) {
      closebtns[_i].addEventListener('click', this.closePopup);
    }
  },

  /**
   * Open the popup
   */
  openPopup: function openPopup(popup) {
    var is_customizer = document.getElementById('customize-preview-js') === null ? false : true;

    if (!is_customizer && parseInt(popup.getAttribute('data-cookie')) && botiga.helpers.getCookie(popup.getAttribute('data-cookie-name'))) {
      return false;
    } // Open the popup inside customizer only when it's handling with Modal Popup customizer section


    if (is_customizer) {
      var customizer_section = window.parent.window.document.querySelector('.control-section.open');

      if (customizer_section === null) {
        return false;
      }

      var is_modal_popup_section = customizer_section.id.indexOf('botiga_section_modal_popup') > 0;

      if (!is_modal_popup_section) {
        return false;
      }
    }

    popup.classList.add('show');
    setTimeout(function () {
      popup.classList.add('transition-effect');
      window.dispatchEvent(new Event('botiga.popup.opened'));
    }, 300);
    document.body.classList.add('disable-scroll');
  },

  /**
   * Close the popup
   */
  closePopup: function closePopup() {
    event.preventDefault();
    var is_customizer = document.getElementById('customize-preview-js') === null ? false : true;
    var popups = document.querySelectorAll('.botiga-popup');

    var _loop2 = function _loop2(i) {
      var popup = popups[i];

      if (!is_customizer && parseInt(popup.getAttribute('data-cookie'))) {
        botiga.helpers.setCookie(popup.getAttribute('data-cookie-name'), 1, popup.getAttribute('data-cookie-expiration'));
      }

      popup.classList.remove('transition-effect');
      setTimeout(function () {
        popup.classList.remove('show');
        document.body.classList.remove('disable-scroll');
        window.dispatchEvent(new Event('botiga.popup.closed'));
      }, 300);
    };

    for (var i = 0; i < popups.length; i++) {
      _loop2(i);
    }
  }
};
botiga.popup.domReady(function () {
  botiga.popup.init();
});