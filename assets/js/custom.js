"use strict";

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

var botiga = botiga || {};
/**
 * Is the DOM ready?
 *
 * This implementation is coming from https://gomakethings.com/a-native-javascript-equivalent-of-jquerys-ready-method/
 *
 * @param {Function} fn Callback function to run.
 */

botiga.helpers = {
  botigaDomReady: function botigaDomReady(fn) {
    if (typeof fn !== 'function') {
      return;
    }

    if (document.readyState === 'interactive' || document.readyState === 'complete') {
      return fn();
    }

    document.addEventListener('DOMContentLoaded', fn, false);
  }
};
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

    var focusableEls = offCanvas.querySelectorAll('a[href]:not([disabled]):not(.mobile-menu-close)');
    var firstFocusableEl = focusableEls[0];
    button.addEventListener('click', function (e) {
      e.preventDefault();
      button.classList.add('open');
      offCanvas.classList.add('toggled');
      document.body.classList.add('mobile-menu-visible'); //Toggle submenus

      var submenuToggles = offCanvas.querySelectorAll('.dropdown-symbol');

      var _iterator = _createForOfIteratorHelper(submenuToggles),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var submenuToggle = _step.value;
          submenuToggle.addEventListener('touchstart', submenuToggleHandler);
          submenuToggle.addEventListener('click', submenuToggleHandler);
          submenuToggle.addEventListener('keydown', function (e) {
            var isTabPressed = e.key === 'Enter' || e.keyCode === 13;

            if (!isTabPressed) {
              return;
            }

            e.preventDefault();
            var parent = submenuToggle.parentNode.parentNode;
            parent.getElementsByClassName('sub-menu')[0].classList.toggle('toggled');
          });
        } //Trap focus inside modal

      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      firstFocusableEl.focus();
    });

    function submenuToggleHandler(e) {
      e.preventDefault();
      var parent = e.target.closest('li');
      parent.querySelector('.sub-menu').classList.toggle('toggled');
    }

    var focusableEls = offCanvas.querySelectorAll('a[href]:not([disabled])');
    var firstFocusableEl = focusableEls[0];
    var lastFocusableEl = focusableEls[focusableEls.length - 1];
    var KEYCODE_TAB = 9;
    lastFocusableEl.addEventListener('keydown', function (e) {
      var isTabPressed = e.key === 'Tab' || e.keyCode === KEYCODE_TAB;

      if (!isTabPressed) {
        return;
      }

      if (e.shiftKey)
        /* shift + tab */
        {} else
        /* tab */
        {
          firstFocusableEl.focus();
        }
    });
    closeButton.addEventListener('click', function (e) {
      e.preventDefault();
      button.focus();
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
 * Desktop offcanvas menu navigation
 */

botiga.desktopOffcanvasNav = {
  init: function init() {
    var buttons = document.querySelectorAll('.desktop-menu-toggle'),
        closeButton = document.getElementsByClassName('desktop-menu-close')[0],
        offcanvas = document.getElementsByClassName('botiga-desktop-offcanvas')[0];

    if (!buttons.length) {
      return false;
    }

    for (var i = 0; i < buttons.length; i++) {
      buttons[i].addEventListener('click', function (e) {
        e.preventDefault();
        offcanvas.classList.add('botiga-desktop-offcanvas-show');
      });
    }

    closeButton.addEventListener('click', function (e) {
      e.preventDefault();
      offcanvas.classList.remove('botiga-desktop-offcanvas-show');
    });
  }
};
/**
 * Header search
 */

botiga.headerSearch = {
  init: function init() {
    var self = this,
        button = document.querySelectorAll('.header-search'),
        form = window.matchMedia('(max-width: 1024px)').matches ? document.querySelector('#masthead-mobile .header-search-form') : document.querySelector('#masthead .header-search-form'),
        overlay = document.getElementsByClassName('search-overlay')[0],
        searchInput = form.getElementsByClassName('search-field')[0],
        searchBtn = form.getElementsByClassName('search-submit')[0];

    if (button.length === 0) {
      return;
    }

    var _iterator5 = _createForOfIteratorHelper(button),
        _step5;

    try {
      for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
        var buttonEl = _step5.value;
        buttonEl.addEventListener('click', function (e) {
          e.preventDefault(); // Hide other search icons 

          if (button.length > 1) {
            var _iterator6 = _createForOfIteratorHelper(button),
                _step6;

            try {
              for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
                var btn = _step6.value;
                btn.classList.toggle('hide');
              }
            } catch (err) {
              _iterator6.e(err);
            } finally {
              _iterator6.f();
            }
          }

          form.classList.toggle('active');
          overlay.classList.toggle('active');
          e.target.closest('.header-search').getElementsByClassName('icon-search')[0].classList.toggle('active');
          e.target.closest('.header-search').getElementsByClassName('icon-cancel')[0].classList.toggle('active');
          e.target.closest('.header-search').classList.add('active');
          e.target.closest('.header-search').classList.remove('hide');
          searchInput.focus();

          if (e.target.closest('.botiga-offcanvas-menu') !== null) {
            e.target.closest('.botiga-offcanvas-menu').classList.remove('toggled');
          }
        });
      }
    } catch (err) {
      _iterator5.e(err);
    } finally {
      _iterator5.f();
    }

    overlay.addEventListener('click', function () {
      form.classList.remove('active');
      overlay.classList.remove('active'); // Back buttons to default state

      self.backButtonsToDefaultState(button);
    });
    searchBtn.addEventListener('keydown', function (e) {
      var isTabPressed = e.key === 'Tab' || e.keyCode === KEYCODE_TAB;

      if (!isTabPressed) {
        return;
      }

      form.classList.remove('active');
      overlay.classList.remove('active'); // Back buttons to default state

      self.backButtonsToDefaultState(button);
      button.focus();
    });
    var desktop_offcanvas = document.getElementsByClassName('header-desktop-offcanvas-layout2')[0] !== null ? document.getElementsByClassName('botiga-desktop-offcanvas')[0] : false;

    if (desktop_offcanvas) {
      desktop_offcanvas.addEventListener('click', function (e) {
        if (e.target.closest('.header-search') === null) {
          form.classList.remove('active');
          overlay.classList.remove('active'); // Back buttons to default state

          self.backButtonsToDefaultState(button);
        }
      });
    }

    return this;
  },
  backButtonsToDefaultState: function backButtonsToDefaultState(button) {
    var _iterator7 = _createForOfIteratorHelper(button),
        _step7;

    try {
      for (_iterator7.s(); !(_step7 = _iterator7.n()).done;) {
        var btn = _step7.value;
        btn.classList.remove('hide');
        btn.querySelector('.icon-cancel').classList.remove('active');
        btn.querySelector('.icon-search').classList.add('active');
      }
    } catch (err) {
      _iterator7.e(err);
    } finally {
      _iterator7.f();
    }
  }
};
/**
 * Sticky header
 */

botiga.stickyHeader = {
  init: function init() {
    var sticky = document.getElementsByClassName('sticky-header')[0],
        body = document.getElementsByTagName('body')[0];

    if ('undefined' === typeof sticky) {
      return;
    }

    if (sticky.classList.contains('sticky-scrolltop')) {
      var lastScrollTop = 0;
      window.addEventListener('scroll', function () {
        var scroll = window.pageYOffset || document.documentElement.scrollTop;

        if (scroll > lastScrollTop) {
          sticky.classList.remove('is-sticky');
          body.classList.remove('sticky-header-active');
        } else {
          sticky.classList.add('is-sticky');
          body.classList.add('sticky-header-active');
        }

        lastScrollTop = scroll <= 0 ? 0 : scroll;
      }, false);
    } else {
      window.addEventListener('scroll', function () {
        var vertDist = window.scrollY;

        if (vertDist > 1) {
          sticky.classList.add('sticky-shadow');
          body.classList.add('sticky-header-active');
        } else {
          sticky.classList.remove('sticky-shadow');
          body.classList.remove('sticky-header-active');
        }
      }, false);
    }
  }
};
/**
 * Botiga scroll direction
 */

botiga.scrollDirection = {
  init: function init() {
    var elements = document.querySelectorAll('.botiga-single-sticky-add-to-cart-wrapper.hide-when-scroll'),
        body = document.getElementsByTagName('body')[0];

    if ('null' === typeof elements) {
      return;
    }

    var lastScrollTop = 0;
    window.addEventListener('scroll', function () {
      var scroll = window.pageYOffset || document.documentElement.scrollTop;

      if (scroll > lastScrollTop) {
        body.classList.remove('botiga-scrolling-up');
        body.classList.add('botiga-scrolling-down');
      } else {
        body.classList.remove('botiga-scrolling-down');
        body.classList.add('botiga-scrolling-up');
      }

      lastScrollTop = scroll <= 0 ? 0 : scroll;
    }, false);
  }
};
/**
 * Botiga wishlist
 */

botiga.wishList = {
  init: function init() {
    this.addRemoveButton();
  },
  addRemoveButton: function addRemoveButton() {
    var button = document.querySelectorAll('.botiga-wishlist-button, .botiga-wishlist-remove-item');

    if (!button.length) {
      return false;
    }

    for (var i = 0; i < button.length; i++) {
      button[i].addEventListener('click', function (e) {
        e.preventDefault();
        var button = this,
            productId = this.getAttribute('data-product-id'),
            wishlistLink = this.getAttribute('data-wishlist-link'),
            type = this.getAttribute('data-type'),
            nonce = this.getAttribute('data-nonce');

        if (button.classList.contains('active')) {
          window.location = wishlistLink;
          return false;
        }

        var ajax = new XMLHttpRequest();
        ajax.open('POST', botiga.ajaxurl, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        if ('remove' === type) {
          button.closest('tr').classList.add('removing');
          button.classList.add('botigaAnimRotate');
          button.classList.add('botiga-anim-infinite');
        }

        ajax.onload = function () {
          if (this.status >= 200 && this.status < 400) {
            if ('add' === type) {
              button.classList.add('active');

              if (button.closest('.single-product') !== null) {
                var single_wishlist_button_text = button.querySelector('.botiga-wishlist-text');
                single_wishlist_button_text.innerHTML = single_wishlist_button_text.getAttribute('data-wishlist-view-text');
              }
            } else {
              button.closest('tr').classList.add('removing');
              setTimeout(function () {
                button.closest('tr').remove();
              }, 800);
            }
          }
        };

        ajax.send('action=botiga_button_wishlist&product_id=' + productId + '&nonce=' + nonce + '&type=' + type);
      });
    }
  }
};
/**
 * Botiga custom add to cart button
 * 
 */

botiga.customAddToCartButton = {
  init: function init() {
    var button = document.querySelectorAll('.botiga-custom-addtocart');

    if (!button.length) {
      return false;
    }

    for (var i = 0; i < button.length; i++) {
      button[i].addEventListener('click', function (e) {
        e.preventDefault();
        var button = this,
            productId = this.getAttribute('data-product-id'),
            initial_text = this.innerHTML,
            loading_text = this.getAttribute('data-loading-text'),
            added_text = this.getAttribute('data-added-text'),
            nonce = this.getAttribute('data-nonce');
        var ajax = new XMLHttpRequest();
        ajax.open('POST', botiga.ajaxurl, true);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        button.innerHTML = loading_text;

        ajax.onload = function () {
          if (this.status >= 200 && this.status < 400) {
            button.innerHTML = added_text;
            setTimeout(function () {
              button.innerHTML = initial_text;
            }, 1500);
            jQuery(document.body).trigger('wc_fragment_refresh');
          }
        };

        ajax.send('action=botiga_custom_addtocart&product_id=' + productId + '&nonce=' + nonce);
      });
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

            botiga.qtyButton.init('quick-view');
            botiga.wishList.init();
            botiga.productSwatch.init();
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
 * Quantity button
 */

botiga.qtyButton = {
  init: function init(type) {
    this.events(type);
    this.wooEvents();
  },
  events: function events(type) {
    var qty = document.querySelectorAll('form.cart .quantity, .botiga-quick-view-popup .quantity, .woocommerce-cart-form__cart-item.cart_item .quantity, .botiga-single-sticky-add-to-cart-wrapper-content .quantity');

    if (type === 'quick-view') {
      qty = document.querySelectorAll('.botiga-quick-view-popup .quantity');
    }

    if (qty.length < 1) {
      return false;
    }

    for (var i = 0; i < qty.length; i++) {
      var plus = qty[i].querySelector('.botiga-quantity-plus'),
          minus = qty[i].querySelector('.botiga-quantity-minus');
      plus.classList.add('show');
      minus.classList.add('show');
      plus.addEventListener('click', function (e) {
        var input = this.parentNode.querySelector('.qty'),
            changeEvent = document.createEvent('HTMLEvents');
        e.preventDefault();
        input.value = input.value === '' ? 0 : parseInt(input.value) + 1;
        changeEvent.initEvent('change', true, false);
        input.dispatchEvent(changeEvent);
      });
      minus.addEventListener('click', function (e) {
        var input = this.parentNode.querySelector('.qty'),
            changeEvent = document.createEvent('HTMLEvents');
        e.preventDefault();
        input.value = parseInt(input.value) > 0 ? parseInt(input.value) - 1 : 0;
        changeEvent.initEvent('change', true, false);
        input.dispatchEvent(changeEvent);
      });
    }
  },
  wooEvents: function wooEvents() {
    var _self = this;

    if (typeof jQuery !== 'undefined') {
      jQuery('body').on('updated_cart_totals', function () {
        _self.events();
      });
    }
  }
};
/**
 * Carousel 
 */

botiga.carousel = {
  init: function init() {
    if (document.querySelector('.botiga-carousel') === null && document.querySelector('.has-cross-sells-carousel') === null) {
      return false;
    }

    var carouselEls = document.querySelectorAll('.botiga-carousel, .cross-sells'),
        products = document.querySelectorAll('.botiga-carousel .botiga-carousel-stage, .cross-sells .products');

    var _iterator8 = _createForOfIteratorHelper(carouselEls),
        _step8;

    try {
      for (_iterator8.s(); !(_step8 = _iterator8.n()).done;) {
        var carouselEl = _step8.value;
        var perPage = carouselEl.getAttribute('data-per-page'),
            wrapper = document.createElement('div'),
            next = document.createElement('a'),
            nextSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg"),
            prev = document.createElement('a'),
            prevSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");

        var _iterator9 = _createForOfIteratorHelper(products),
            _step9;

        try {
          for (_iterator9.s(); !(_step9 = _iterator9.n()).done;) {
            var product = _step9.value;
            wrapper.className = 'botiga-carousel-wrapper';
            wrapper.innerHTML = product.outerHTML;
            product.remove();
          }
        } catch (err) {
          _iterator9.e(err);
        } finally {
          _iterator9.f();
        }

        carouselEl.append(wrapper); // Next button

        next.role = 'button';
        next.href = '#';
        next.className = 'botiga-carousel-nav botiga-carousel-nav-next';
        next.addEventListener('click', function (e) {
          e.preventDefault();
          carousel.next();
        });
        nextSVG.setAttribute('width', 18);
        nextSVG.setAttribute('height', 18);
        nextSVG.setAttribute('viewBox', '0 0 10 16');
        nextSVG.setAttribute('fill', 'none');
        nextSVG.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        nextSVG.innerHTML = '<path d="M1.5 14.667L8.16667 8.00033L1.5 1.33366" stroke="#242021" stroke-width="1.5"></path>';
        next.append(nextSVG);
        wrapper.append(next); // Prev button

        prev.role = 'button';
        prev.href = '#';
        prev.className = 'botiga-carousel-nav botiga-carousel-nav-prev';
        prev.addEventListener('click', function (e) {
          e.preventDefault();
          carousel.prev();
        });
        prevSVG.setAttribute('width', 18);
        prevSVG.setAttribute('height', 18);
        prevSVG.setAttribute('viewBox', '0 0 10 16');
        prevSVG.setAttribute('fill', 'none');
        prevSVG.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
        prevSVG.innerHTML = '<path d="M8.5 1.33301L1.83333 7.99967L8.5 14.6663" stroke="#242021" stroke-width="1.5"></path>';
        prev.append(prevSVG);
        wrapper.append(prev);
      }
    } catch (err) {
      _iterator8.e(err);
    } finally {
      _iterator8.f();
    }

    var carousel = new Siema({
      selector: document.querySelector('.cross-sells') !== null ? '.cross-sells .products' : '.botiga-carousel .botiga-carousel-stage',
      duration: 200,
      easing: 'ease-out',
      perPage: perPage !== null ? {
        0: 1,
        768: 2,
        1025: parseInt(perPage)
      } : 2,
      startIndex: 0,
      draggable: false,
      multipleDrag: false,
      threshold: 20,
      loop: true,
      rtl: false,
      margin: 30,
      onInit: function onInit() {
        // Show the carousel
        this.selector.classList.add('show');
      }
    });
  }
};
/**
 * Copy link to clipboard
 */

botiga.copyLinkToClipboard = {
  init: function init(event, el) {
    event.preventDefault();
    navigator.clipboard.writeText(window.location.href);
    el.classList.add('copied');
    el.setAttribute('data-botiga-tooltip', botiga.i18n.botiga_sharebox_copy_link_copied);
    setTimeout(function () {
      el.setAttribute('data-botiga-tooltip', botiga.i18n.botiga_sharebox_copy_link);
      el.classList.remove('copied');
    }, 1000);
  }
};
/**
 * Toggle class
 */

botiga.toggleClass = {
  init: function init(event, el, triggerEvent) {
    event.preventDefault();
    event.stopPropagation();
    var selector = document.querySelector(el.getAttribute('data-botiga-selector')),
        classname = el.getAttribute('data-botiga-toggle-class'),
        classes = selector.classList;
    classes.toggle(classname);

    if (triggerEvent) {
      var ev = document.createEvent('HTMLEvents');
      ev.initEvent(triggerEvent, true, false);
      window.dispatchEvent(ev);
    }
  }
};
/**
 * Product Swatch
 */

botiga.productSwatch = {
  init: function init() {
    var wrapper = document.querySelectorAll('.botiga-variations-wrapper');

    if (!wrapper.length) {
      return false;
    }

    for (var i = 0; i < wrapper.length; i++) {
      this.variations(wrapper[i]);
    }

    this.resetVariationsEvent();
  },
  variations: function variations(wrapper) {
    var self = this,
        select = wrapper.querySelector('select'),
        items = wrapper.querySelectorAll('.botiga-variation-item');

    for (var i = 0; i < items.length; i++) {
      if (select.value) {
        var variation_item_selected = wrapper.querySelector('.botiga-variation-item[value="' + select.value + '"]');
        variation_item_selected.classList.add('active');
        variation_item_selected.dispatchEvent(new Event('botiga.variations.selected'));
      }

      items[i].addEventListener('click', function (e) {
        e.preventDefault();
        var value = this.getAttribute('value');
        jQuery(select).val(value).trigger('change');
        self.removeActiveClass(this);
        this.classList.add('active');
        self.matchVariations(this);
      });
      items[i].addEventListener('botiga.variations.selected', function (e) {
        var _self = this;

        setTimeout(function () {
          self.matchVariations(_self);
        }, 300);
      });
    }
  },
  matchVariations: function matchVariations(variation) {
    var wrapper = variation.closest('.variations').querySelectorAll('.botiga-variations-wrapper');
    var arr = [];

    for (var i = 0; i < wrapper.length; i++) {
      var items = wrapper[i].querySelectorAll('.botiga-variation-item'),
          selectOptions = wrapper[i].querySelector('select').options;

      for (var u = 0; u < selectOptions.length; u++) {
        arr.push(selectOptions[u].value);
      }

      arr = arr.filter(function (e) {
        return e;
      });
      console.log(arr);

      for (var a = 0; a < items.length; a++) {
        if (arr.includes(items[a].getAttribute('value'))) {
          items[a].classList.remove('disabled');
        } else {
          items[a].classList.add('disabled');
        }
      }
    }
  },
  removeActiveClass: function removeActiveClass(item) {
    var items = typeof item !== 'undefined' ? item.closest('div').querySelectorAll('.botiga-variation-item') : document.querySelectorAll('.botiga-variations-wrapper .botiga-variation-item');

    for (var u = 0; u < items.length; u++) {
      items[u].classList.remove('active');
      items[u].classList.remove('disabled');
    }
  },
  resetVariationsEvent: function resetVariationsEvent() {
    var self = this,
        resetbtn = document.querySelectorAll('.reset_variations');

    for (var i = 0; i < resetbtn.length; i++) {
      resetbtn[i].addEventListener('click', function () {
        self.removeActiveClass(this);
      });
    }
  }
};
botiga.helpers.botigaDomReady(function () {
  botiga.navigation.init();
  botiga.desktopOffcanvasNav.init();
  botiga.headerSearch.init();
  botiga.customAddToCartButton.init();
  botiga.wishList.init();
  botiga.quickView.init();
  botiga.stickyHeader.init();
  botiga.scrollDirection.init();
  botiga.backToTop.init();
  botiga.qtyButton.init();
  botiga.carousel.init();
  botiga.productSwatch.init();
});