/**
 * Botiga Ajax Search
 * 
 * jQuery Dependant: true
 * 
 */
'use strict';

var botiga = botiga || {};
botiga.ajaxSearch = {
  ajax: function ajax(action, nonce, extraParams, successCallback) {
    var ajax = new XMLHttpRequest();
    ajax.open('POST', botiga.ajaxurl, true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onload = function () {
      if (this.status >= 200 && this.status < 400) {
        successCallback.apply(this);
      }
    };

    var extraParamsStr = '';
    extraParams = Object.entries(extraParams);

    for (var i = 0; i < extraParams.length; i++) {
      extraParamsStr += '&' + extraParams[i].join('=');
    }

    ajax.send('action=' + action + '&nonce=' + nonce + extraParamsStr);
  },
  init: function init() {
    var _this2 = this;

    var _this = this,
        woo_search_fields = document.querySelectorAll('.wc-search-field, .wc-block-product-search__field');

    if (woo_search_fields.length) {
      var _loop = function _loop(i) {
        // Disable default html autocomplete
        woo_search_fields[i].setAttribute('autocomplete', 'off');
        woo_search_fields[i].addEventListener('keyup', _this2.debounce(function () {
          _this.searchFormHandler(woo_search_fields[i]);
        }, 300));
        woo_search_fields[i].addEventListener('focus', _this2.debounce(function () {
          _this.searchFormHandler(woo_search_fields[i]);
        }, 300));
      };

      for (var i = 0; i < woo_search_fields.length; i++) {
        _loop(i);
      }

      document.addEventListener('click', function (e) {
        if (e.target.closest('.botiga-ajax-search__wrapper') === null) {
          _this.destroy();
        }
      });
    }
  },
  searchFormHandler: function searchFormHandler(el) {
    if (el.value.length < 3) {
      return false;
    }

    var _this = this,
        search_term = el.value,
        clist = el.classList,
        type = clist.contains('wc-block-product-search__field') || clist.contains('wc-search-field') ? 'product' : 'post';

    _this.ajax('botiga_ajax_search_callback', botiga_ajax_search.nonce, {
      search_term: search_term,
      type: type,
      posts_per_page: botiga_ajax_search.query_args.posts_per_page,
      order: botiga_ajax_search.query_args.order,
      orderby: botiga_ajax_search.query_args.orderby,
      show_categories: botiga_ajax_search.query_args.show_categories
    }, function () {
      var response = JSON.parse(this.response); // Create ajax search wrapper for the results

      var ajax_search_wrapper = el.parentNode.getElementsByClassName('botiga-ajax-search__wrapper')[0];

      if (typeof ajax_search_wrapper === 'undefined') {
        ajax_search_wrapper = document.createElement('div');
        ajax_search_wrapper.className = 'botiga-ajax-search__wrapper';
        el.parentNode.append(ajax_search_wrapper);
        el.parentNode.classList.add('botiga-ajax-search');
      }

      ajax_search_wrapper.innerHTML = response.output;
      var products_wrapper = document.querySelector('.botiga-ajax-search-products');

      if (products_wrapper !== null && _this.scrollbarVisible(products_wrapper)) {
        products_wrapper.classList.add('has-scrollbar');
      } // Check if element is out of screen (horizontal)


      if (_this.elementIsOutOfScreenHorizontal(ajax_search_wrapper)) {
        ajax_search_wrapper.classList.add('reverse');
      }

      window.dispatchEvent(new Event('botiga.ajax.search.results.loaded'));
    });
  },
  destroy: function destroy() {
    var wrappers = document.querySelectorAll('.botiga-ajax-search__wrapper');

    if (wrappers.length) {
      for (var i = 0; i < wrappers.length; i++) {
        wrappers[i].remove();
      }
    }
  },
  debounce: function debounce(callback, wait) {
    var timeoutId = null;
    return function () {
      for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
        args[_key] = arguments[_key];
      }

      window.clearTimeout(timeoutId);
      timeoutId = window.setTimeout(function () {
        callback.apply(null, args);
      }, wait);
    };
  },
  scrollbarVisible: function scrollbarVisible(el) {
    return el.scrollHeight > el.clientHeight;
  },
  elementIsOutOfScreenHorizontal: function elementIsOutOfScreenHorizontal(el) {
    var rect = el.getBoundingClientRect();
    return rect.x + rect.width > window.innerWidth;
  }
};
jQuery(document).ready(function () {
  botiga.ajaxSearch.init();
});