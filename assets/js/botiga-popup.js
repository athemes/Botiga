/**
 * Botiga Popup
 */
'use strict';

botiga.popup = {
  /**
   * Initiallize
   */
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
    popup.classList.add('show');
    setTimeout(function () {
      popup.classList.add('transition-effect');
    }, 300);
    document.body.classList.add('disable-scroll');
  },

  /**
   * Close the popup
   */
  closePopup: function closePopup() {
    event.preventDefault();
    var popups = document.querySelectorAll('.botiga-popup');

    var _loop2 = function _loop2(i) {
      var popup = popups[i];
      popup.classList.remove('transition-effect');
      setTimeout(function () {
        popup.classList.remove('show');
        document.body.classList.remove('disable-scroll');
      }, 300);
    };

    for (var i = 0; i < popups.length; i++) {
      _loop2(i);
    }
  }
};
botiga.helpers.botigaDomReady(function () {
  botiga.popup.init();
});