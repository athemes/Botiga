"use strict";

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var botiga = botiga || {};
/**
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

botiga.navigation = {
  init: function init() {
    var siteNavigation = document.getElementById('site-navigation');
    var offCanvas = document.getElementsByClassName('botiga-offcanvas-menu')[0]; // Return early if the navigation don't exist.

    if (!siteNavigation) {
      return;
    }

    var button = document.getElementsByClassName('menu-toggle')[0];
    var closeButton = document.getElementsByClassName('mobile-menu-close')[0]; // Return early if the button don't exist.

    if ('undefined' === typeof button) {
      return;
    }

    var menu = siteNavigation.getElementsByTagName('ul')[0];
    var mobileMenuClose = siteNavigation.getElementsByClassName('mobile-menu-close')[0]; // Hide menu toggle button if menu is empty and return early.

    if ('undefined' === typeof menu) {
      button.style.display = 'none';
      return;
    }

    if (!menu.classList.contains('nav-menu')) {
      menu.classList.add('nav-menu');
    }

    button.addEventListener('click', function () {
      button.classList.add('open');
      offCanvas.classList.add('toggled');
      document.body.classList.add('mobile-menu-visible'); //Toggle submenus

      var submenuToggles = offCanvas.querySelectorAll('.dropdown-symbol');

      var _iterator = _createForOfIteratorHelper(submenuToggles),
          _step;

      try {
        var _loop = function _loop() {
          var submenuToggle = _step.value;
          submenuToggle.addEventListener('touchstart', function (e) {
            e.preventDefault();
            var parent = submenuToggle.parentNode.parentNode;
            parent.getElementsByClassName('sub-menu')[0].classList.toggle('toggled');
          });
          submenuToggle.addEventListener('click', function (e) {
            e.preventDefault();
            var parent = submenuToggle.parentNode.parentNode;
            parent.getElementsByClassName('sub-menu')[0].classList.toggle('toggled');
          });
          submenuToggle.addEventListener('keydown', function (e) {
            var isTabPressed = e.key === 'Enter' || e.keyCode === 13;

            if (!isTabPressed) {
              return;
            }

            e.preventDefault();
            submenuToggle.getElementsByTagName('span')[0].classList.toggle('submenu-exp');
            var parent = submenuToggle.parentNode.parentNode;
            parent.getElementsByClassName('sub-menu')[0].classList.toggle('toggled');
          });
        };

        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          _loop();
        } //Trap focus inside modal

      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      var focusableEls = offCanvas.querySelectorAll('a[href]:not([disabled])'),
          firstFocusableEl = focusableEls[0];
      lastFocusableEl = focusableEls[focusableEls.length - 1];
      KEYCODE_TAB = 9;
      offCanvas.addEventListener('keydown', function (e) {
        var isTabPressed = e.key === 'Tab' || e.keyCode === KEYCODE_TAB;

        if (!isTabPressed) {
          return;
        }

        if (e.shiftKey)
          /* shift + tab */
          {
            if (document.activeElement === firstFocusableEl) {
              button.focus();
              e.preventDefault();
              offCanvas.classList.remove('toggled');
              document.body.style.overflowY = 'visible';
            }
          } else
          /* tab */
          {
            if (document.activeElement === lastFocusableEl) {
              button.click();
              e.preventDefault();
              offCanvas.classList.remove('toggled');
              document.body.style.overflowY = 'visible';
            }
          }
      });
      button.addEventListener('keydown', function (e) {
        var isTabPressed = e.key === 'Tab' || e.keyCode === KEYCODE_TAB;

        if (!isTabPressed) {
          return;
        }

        if (e.shiftKey)
          /* shift + tab */
          {
            if (document.activeElement === button) {
              button.click();
            }
          }
      });
      mobileMenuClose.addEventListener('click', function (e) {
        siteNavigation.classList.remove('toggled');
        document.body.style.overflowY = 'visible';
      });
      mobileMenuClose.addEventListener('keyup', function (e) {
        if (e.keyCode === 13) {
          e.preventDefault();
          siteNavigation.classList.remove('toggled');
          document.body.style.overflowY = 'visible';
        }
      });
    });
    closeButton.addEventListener('click', function () {
      button.classList.remove('open');
      offCanvas.classList.remove('toggled');
      document.body.classList.remove('mobile-menu-visible');
    }); // Get all the link elements within the menu.

    var links = menu.getElementsByTagName('a'); // Get all the link elements with children within the menu.

    var linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a'); // Toggle focus each time a menu link is focused or blurred.

    var _iterator2 = _createForOfIteratorHelper(links),
        _step2;

    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var link = _step2.value;
        link.addEventListener('focus', toggleFocus, true);
        link.addEventListener('blur', toggleFocus, true);
      } // Toggle focus each time a menu link with children receive a touch event.

    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }

    var _iterator3 = _createForOfIteratorHelper(linksWithChildren),
        _step3;

    try {
      for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
        var _link = _step3.value;

        _link.addEventListener('touchstart', toggleFocus, false);
      }
      /**
       * Sets or removes .focus class on an element.
       */

    } catch (err) {
      _iterator3.e(err);
    } finally {
      _iterator3.f();
    }

    function toggleFocus() {
      if (event.type === 'focus' || event.type === 'blur') {
        var self = this; // Move up through the ancestors of the current link until we hit .nav-menu.

        while (!self.classList.contains('nav-menu')) {
          // On li elements toggle the class .focus.
          if ('li' === self.tagName.toLowerCase()) {
            self.classList.toggle('focus');
          }

          self = self.parentNode;
        }
      }

      if (event.type === 'touchstart') {
        var menuItem = this.parentNode;
        event.preventDefault();

        var _iterator4 = _createForOfIteratorHelper(menuItem.parentNode.children),
            _step4;

        try {
          for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
            var link = _step4.value;

            if (menuItem !== link) {
              link.classList.remove('focus');
            }
          }
        } catch (err) {
          _iterator4.e(err);
        } finally {
          _iterator4.f();
        }

        menuItem.classList.toggle('focus');
      }
    }
  }
};
/**
 * Header search
 */

botiga.headerSearch = {
  init: function init() {
    if (window.matchMedia('(max-width: 1024px)').matches) {
      var header = document.getElementById('masthead-mobile');
    } else {
      var header = document.getElementById('masthead');
    }

    var button = header.getElementsByClassName('header-search')[0];
    var form = header.getElementsByClassName('header-search-form')[0];
    var overlay = document.getElementsByClassName('search-overlay')[0];

    if ('undefined' === typeof button) {
      return;
    }

    button.addEventListener('click', function () {
      form.classList.toggle('active');
      overlay.classList.toggle('active');
      button.getElementsByClassName('icon-search')[0].classList.toggle('active');
      button.getElementsByClassName('icon-cancel')[0].classList.toggle('active');
    });
    overlay.addEventListener('click', function () {
      form.classList.remove('active');
      overlay.classList.remove('active');
      button.getElementsByClassName('icon-search')[0].classList.toggle('active');
      button.getElementsByClassName('icon-cancel')[0].classList.toggle('active');
    });
  }
};
/**
 * Sticky header
 */

botiga.stickyHeader = {
  init: function init() {
    var sticky = document.getElementsByClassName('sticky-header')[0];

    if ('undefined' === typeof sticky) {
      return;
    }

    if (sticky.classList.contains('sticky-scrolltop')) {
      var lastScrollTop = 0;
      window.addEventListener('scroll', function () {
        var scroll = window.pageYOffset || document.documentElement.scrollTop;

        if (scroll > lastScrollTop) {
          sticky.classList.remove('is-sticky');
        } else {
          sticky.classList.add('is-sticky');
        }

        lastScrollTop = scroll <= 0 ? 0 : scroll;
      }, false);
    } else {
      window.addEventListener('scroll', function () {
        var vertDist = window.scrollY;

        if (vertDist > 1) {
          sticky.classList.add('sticky-shadow');
        } else {
          sticky.classList.remove('sticky-shadow');
        }
      }, false);
    }
  }
};
/**
 * Botiga quick view
 */

botiga.quickView = {
  init: function init() {
    var button = document.querySelectorAll('.botiga-quick-view'),
        popup = document.querySelector('.botiga-quick-view-popup'),
        closeButton = document.querySelector('.botiga-quick-view-popup-close-button'),
        popupContent = document.querySelector('.botiga-quick-view-popup-content-ajax'); // If quick view is not enabled

    if (null === popup) {
      return false;
    }

    closeButton.addEventListener('click', function (e) {
      e.preventDefault();
    });
    popup.addEventListener('click', function (e) {
      if (null === e.target.closest('.botiga-quick-view-popup-content-ajax')) {
        popup.classList.remove('opened');
      }
    });

    for (var i = 0; i < button.length; i++) {
      button[i].addEventListener('click', function (e) {
        e.preventDefault();
        var productId = e.target.getAttribute('data-product-id'),
            nonce = e.target.getAttribute('data-nonce');
        popup.classList.add('opened');
        var ajax = new XMLHttpRequest();
        ajax.open('POST', botiga.ajaxurl, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        ajax.onload = function () {
          if (this.status >= 200 && this.status < 400) {
            // If successful
            popupContent.innerHTML = this.response; // Initialize gallery 

            var productGallery = document.querySelector('.woocommerce-product-gallery');

            if ('undefined' !== typeof productGallery) {
              productGallery.dispatchEvent(new Event('wc-product-gallery-before-init'));
              jQuery(productGallery).wc_product_gallery(wc_single_product_params);
              productGallery.dispatchEvent(new Event('wc-product-gallery-after-init'));
            } // Initialize product variable


            var variationsForm = document.querySelector('.botiga-quick-view-summary .variations_form');

            if (typeof wc_add_to_cart_variation_params !== 'undefined') {
              jQuery(variationsForm).wc_variation_form();
            }
          }
        };

        ajax.send('action=botiga_quick_view_content&product_id=' + productId + '&nonce=' + nonce);
      });
    }
  }
};
/**
 * Back to top button
 */

botiga.backToTop = {
  init: function init() {
    this.backToTop();
    window.addEventListener('scroll', function () {
      this.backToTop();
    }.bind(this));
  },
  backToTop: function backToTop() {
    var button = document.getElementsByClassName('back-to-top')[0];

    if ('undefined' !== typeof button) {
      var scrolled = window.scrollY;

      if (scrolled > 300) {
        button.classList.add('display');
      } else {
        button.classList.remove('display');
      }

      button.addEventListener('click', function () {
        window.scrollTo({
          top: 0,
          left: 0,
          behavior: 'smooth'
        });
      });
    }
  }
};
/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */

function botigaDomReady(fn) {
  if (typeof fn !== 'function') {
    return;
  }

  if (document.readyState === 'interactive' || document.readyState === 'complete') {
    return fn();
  }

  document.addEventListener('DOMContentLoaded', fn, false);
}

botigaDomReady(function () {
  botiga.navigation.init();
  botiga.headerSearch.init();
  botiga.quickView.init();
  botiga.stickyHeader.init();
  botiga.backToTop.init();
});