"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
(function ($) {
  'use strict';

  window.bhfb = {
    init: function init() {
      // this.previewIframe = 

      this.builderGridContentFlag = false;
      this.updateGridDelay = 200;
      this.currentDevice = 'desktop';
      this.currentArea = 'header';
      this.currentRowInput = '';
      this.currentRow = '';
      this.currentColumn = '';
      this.currentColumnPos = '';
      this.currentComponent = '';
      this.currentBuilder = '';
      this.currentBuilderType = '';
      this.componentsOrder = '';
      this.addBodyClass();
      this.preventEmptyRowValues();
      this.customizeNavigation();
      this.elementsPopup();
      this.elementsButton();
      this.storeGlobals();
      this.devicesSwitcher();
      this.elementsPopupContent();
      this.builderGridContent();
      this.elementsSortable();
      this.builderCustomColumns();
      this.builderColumnsLayout();
      this.footerCustomizerOptions();
      this.headerPresets();
      this.extraNavigation();
      this.showHideBuilder();
      this.showHideBuilderTop();
    },
    jsonDecode: function jsonDecode(value) {
      return JSON.parse(value.replace(/'/g, '"').replace(';', ''));
    },
    // identify customizer with the builder.
    addBodyClass: function addBodyClass() {
      $('body').addClass('has-bhfb-builder');
    },
    // In some rare cases, the row values are empty, so we need to prevent that
    // case it is empty, we set the default values
    preventEmptyRowValues: function preventEmptyRowValues() {
      var areas = ['header', 'footer'],
        rows = ['above', 'main', 'below'];
      for (var _i = 0, _areas = areas; _i < _areas.length; _i++) {
        var area = _areas[_i];
        var _iterator = _createForOfIteratorHelper(rows),
          _step;
        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var row = _step.value;
            var rowInputValue = $('#_customize-input-botiga_' + area + '_row__' + row + '_' + area + '_row').val();
            if (rowInputValue == '') {
              $('#_customize-input-botiga_' + area + '_row__' + row + '_' + area + '_row').val(botiga_hfb.rows.defaults[row + '_' + area + '_row']);
            }
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }
      }

      // Mobile offcanvas row
      var mobileOffcanvasRowInputValue = $('#_customize-input-botiga_header_row__mobile_offcanvas').val();
      if (mobileOffcanvasRowInputValue == '') {
        $('#_customize-input-botiga_header_row__mobile_offcanvas').val(botiga_hfb.rows.defaults['mobile_offcanvas']);
      }
    },
    customizeNavigation: function customizeNavigation() {
      if (typeof wp.customize.section('botiga_section_fb_wrapper') !== 'undefined') {
        // Navigate directly to the header builder when we click on the main panel item 'Header'
        $('#accordion-panel-botiga_panel_header').on('click keyup', function (e) {
          if (e.keyCode && e.keyCode !== 13) {
            return false;
          }
          e.preventDefault();
          wp.customize.section('botiga_section_hb_wrapper').focus();
        });

        // Navigate directly to the footer builder when we click on the main panel item 'Footer'
        $('#accordion-panel-botiga_panel_footer').on('click keyup', function (e) {
          if (e.keyCode && e.keyCode !== 13) {
            return false;
          }
          e.preventDefault();
          wp.customize.section('botiga_section_fb_wrapper').focus();
        });
      }
      var sections = ['sub-accordion-section-botiga_section_hb_presets', 'sub-accordion-section-botiga_section_hb_above_header_row', 'sub-accordion-section-botiga_section_hb_main_header_row', 'sub-accordion-section-botiga_section_hb_below_header_row', 'sub-accordion-section-botiga_section_hb_mobile_offcanvas', 'sub-accordion-section-header_image', 'sub-accordion-section-botiga_section_hb_component__logo', 'sub-accordion-section-botiga_section_hb_component__search', 'sub-accordion-section-botiga_section_hb_component__social', 'sub-accordion-section-botiga_section_hb_component__menu', 'sub-accordion-section-botiga_section_hb_component__secondary_menu', 'sub-accordion-section-botiga_section_hb_component__contact_info', 'sub-accordion-section-botiga_section_hb_component__button', 'sub-accordion-section-botiga_section_hb_component__button2', 'sub-accordion-section-botiga_section_hb_component__html', 'sub-accordion-section-botiga_section_hb_component__html2', 'sub-accordion-section-botiga_section_hb_component__shortcode', 'sub-accordion-section-botiga_section_hb_component__shortcode2', 'sub-accordion-section-botiga_section_hb_component__shortcode3', 'sub-accordion-section-botiga_section_hb_component__login_register', 'sub-accordion-section-botiga_section_hb_component__woo_icons', 'sub-accordion-section-botiga_section_hb_component__pll_switcher', 'sub-accordion-section-botiga_section_hb_component__wpml_switcher', 'sub-accordion-section-botiga_section_hb_component__mobile_offcanvas_menu', 'sub-accordion-section-botiga_section_hb_component__mobile_hamburger',
      // Footer
      'sub-accordion-section-botiga_section_fb_above_footer_row', 'sub-accordion-section-botiga_section_fb_main_footer_row', 'sub-accordion-section-botiga_section_fb_below_footer_row', 'sub-accordion-section-botiga_section_fb_component__footer_menu', 'sub-accordion-section-botiga_section_fb_component__copyright', 'sub-accordion-section-botiga_section_fb_component__social', 'sub-accordion-section-botiga_section_fb_component__button', 'sub-accordion-section-botiga_section_fb_component__button2', 'sub-accordion-section-botiga_section_fb_component__html', 'sub-accordion-section-botiga_section_fb_component__html2', 'sub-accordion-section-botiga_section_fb_component__shortcode', 'sub-accordion-section-botiga_section_fb_component__widget1', 'sub-accordion-section-botiga_section_fb_component__widget2', 'sub-accordion-section-botiga_section_fb_component__widget3', 'sub-accordion-section-botiga_section_fb_component__widget4'];

      // Append columns to the sections array.
      var rows = ['above', 'main', 'below'];
      for (var _i2 = 0, _rows = rows; _i2 < _rows.length; _i2++) {
        var row = _rows[_i2];
        for (var i = 1; i <= 6; i++) {
          sections.push('sub-accordion-section-botiga_header_row__' + row + '_header_row_column' + i);
          sections.push('sub-accordion-section-botiga_footer_row__' + row + '_footer_row_column' + i);
        }
      }
      var current_section_id = '';
      $(document).on('mouseover focus', '.customize-section-back', function (e) {
        current_section_id = $('.control-section.open').attr('id');
      });
      $(document).on('click keydown', '.customize-section-back', function (e) {
        if (e.keyCode && e.keyCode !== 13 && e.keyCode !== 27) {
          return false;
        }
        if (sections.includes(current_section_id)) {
          // header columns.
          if (current_section_id.indexOf('above_header_row_column') !== -1) {
            wp.customize.section('botiga_section_hb_above_header_row').focus();
            return false;
          }
          if (current_section_id.indexOf('main_header_row_column') !== -1) {
            wp.customize.section('botiga_section_hb_main_header_row').focus();
            return false;
          }
          if (current_section_id.indexOf('below_header_row_column') !== -1) {
            wp.customize.section('botiga_section_hb_below_header_row').focus();
            return false;
          }

          // footer columns.
          if (current_section_id.indexOf('above_footer_row_column') !== -1) {
            wp.customize.section('botiga_section_fb_above_footer_row').focus();
            return false;
          }
          if (current_section_id.indexOf('main_footer_row_column') !== -1) {
            wp.customize.section('botiga_section_fb_main_footer_row').focus();
            return false;
          }
          if (current_section_id.indexOf('below_footer_row_column') !== -1) {
            wp.customize.section('botiga_section_fb_below_footer_row').focus();
            return false;
          }

          // header/footer row and components.
          if (current_section_id.indexOf('_hb_') !== -1 || current_section_id.indexOf('_header_') !== -1 || current_section_id.indexOf('header_image') !== -1) {
            wp.customize.section('botiga_section_hb_wrapper').focus();
          } else {
            wp.customize.section('botiga_section_fb_wrapper').focus();
          }
        }
      });
    },
    storeGlobals: function storeGlobals() {
      var _this = this;

      // Current Device.      
      $('.wp-full-overlay-footer .devices button, .botiga-devices-preview button').on('click', function () {
        var device = $(this).attr('data-device');
        if (device === 'tablet') {
          device = 'mobile';
        }
        if (_this.currentBuilderType === 'footer') {
          device = 'desktop';
        }
        _this.currentDevice = device;
        _this.builderGridContent();
      });

      // Column Area.
      $(document).on('click mouseover', '.botiga-bhfb-area:not(.bhfb-available-components)', function (e) {
        if ($('#botiga-bhfb-elements').hasClass('show')) {
          return false;
        }
        _this.currentRowInput = $('#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + $(this).data('bhfb-row'));
        _this.currentRow = $(this).closest('.botiga-bhfb-row');
        _this.currentColumnPos = $(this).index() - 1;
        _this.currentColumn = $(this);
        if (!_this.currentRow.length && $(this).hasClass('botiga-bhfb-area-offcanvas')) {
          _this.currentRowInput = $('#_customize-input-botiga_header_row__mobile_offcanvas');
          _this.currentRow = $('.botiga-bhfb-area-offcanvas');
          _this.currentColumnPos = $(this).index();
        }
      });
      $(document).on('click mouseover', '.bhfb-button', function (e) {
        _this.currentComponent = $(this).data('bhfb-id');
      });
    },
    devicesSwitcher: function devicesSwitcher() {
      var _this = this;
      $(' .wp-full-overlay-footer .devices button, .botiga-devices-preview button').on('click', function () {
        var device = $(this).attr('data-device');
        if (device === 'mobile') {
          device = 'tablet';
        }
        $('.botiga-bhfb-devices .botiga-bhfb-device-link').removeClass('active');
        $('.botiga-bhfb-devices .botiga-bhfb-device-link[data-device="' + device + '"]').addClass('active');
      });
      $('.botiga-bhfb-devices .botiga-bhfb-device-link').on('click', function (e) {
        e.preventDefault();
        var device = $(this).attr('data-device');
        $(' .wp-full-overlay-footer .devices button[data-device="' + device + '"]').trigger('click');
      });
    },
    getElementsUnused: function getElementsUnused() {
      var _this = this;
      var elements = botiga_hfb.components.desktop,
        mb_elements = botiga_hfb.components.mobile;
      var fields = ['#_customize-input-botiga_header_row__above_header_row', '#_customize-input-botiga_header_row__main_header_row', '#_customize-input-botiga_header_row__below_header_row', '#_customize-input-botiga_header_row__mobile_offcanvas'];
      if (_this.currentBuilderType === 'footer') {
        elements = botiga_hfb.components.footer;
        fields = ['#_customize-input-botiga_footer_row__above_footer_row', '#_customize-input-botiga_footer_row__main_footer_row', '#_customize-input-botiga_footer_row__below_footer_row'];
      }
      for (var _i3 = 0, _fields = fields; _i3 < _fields.length; _i3++) {
        var field = _fields[_i3];
        // desktop
        var _iterator2 = _createForOfIteratorHelper(elements),
          _step2;
        try {
          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
            var el = _step2.value;
            var input_value = this.jsonDecode($(field).val());
            if (input_value.desktop.length) {
              var _iterator4 = _createForOfIteratorHelper(input_value.desktop),
                _step4;
              try {
                var _loop = function _loop() {
                  var column = _step4.value;
                  elements = elements.filter(function (item) {
                    return !column.includes(item.id);
                  });
                };
                for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
                  _loop();
                }
              } catch (err) {
                _iterator4.e(err);
              } finally {
                _iterator4.f();
              }
            }
          }

          // mobile
        } catch (err) {
          _iterator2.e(err);
        } finally {
          _iterator2.f();
        }
        var _iterator3 = _createForOfIteratorHelper(mb_elements),
          _step3;
        try {
          for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
            var el = _step3.value;
            var _input_value = this.jsonDecode($(field).val());
            if (_input_value.mobile.length) {
              var _iterator5 = _createForOfIteratorHelper(_input_value.mobile),
                _step5;
              try {
                var _loop2 = function _loop2() {
                  var column = _step5.value;
                  mb_elements = mb_elements.filter(function (item) {
                    return !column.includes(item.id);
                  });
                };
                for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
                  _loop2();
                }
              } catch (err) {
                _iterator5.e(err);
              } finally {
                _iterator5.f();
              }
            }

            // off-canvas
            if (field.indexOf('row__mobile_offcanvas') !== -1 && _input_value.mobile_offcanvas.length) {
              var _iterator6 = _createForOfIteratorHelper(_input_value.mobile_offcanvas),
                _step6;
              try {
                var _loop3 = function _loop3() {
                  var column = _step6.value;
                  mb_elements = mb_elements.filter(function (item) {
                    return !column.includes(item.id);
                  });
                };
                for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
                  _loop3();
                }
              } catch (err) {
                _iterator6.e(err);
              } finally {
                _iterator6.f();
              }
            }
          }
        } catch (err) {
          _iterator3.e(err);
        } finally {
          _iterator3.f();
        }
      }
      return {
        desktop: elements,
        mobile: mb_elements
      };
    },
    elementsPopup: function elementsPopup() {
      var _this = this;
      $(document).on('click', '.botiga-bhfb-area:not(.bhfb-available-components)', function (e) {
        var popup = _this.currentBuilder.find('#botiga-bhfb-elements'),
          rect = $(this)[0].getBoundingClientRect(),
          row = $(this).data('bhfb-row');
        setTimeout(function () {
          popup.css('top', 0);
          popup.css('left', rect.left);
          popup.css('top', rect.top - (popup.height() + 50));
          if (_this.isElementInViewport(popup)) {
            popup.css('left', rect.left);
            popup.css('right', 'auto');
          } else {
            popup.css('left', 'auto');
            popup.css('right', 25);
          }
          if (e.target.classList.contains('bhfb-remove-element') || e.target.classList.contains('bhfb-button')) {
            return false;
          }
          popup.addClass('show');
        }, 200);
        _this.elementsPopupContent(row);
        _this.builderGridContent();
      });
      $('#customize-preview iframe').on('mouseup', function (e) {
        if (!_this.currentBuilder) {
          return false;
        }
        _this.closeElementsPopup(e);
      });
      $(document).on('mouseup', function (e) {
        if (!_this.currentBuilder) {
          return false;
        }
        _this.closeElementsPopup(e);
      });
    },
    closeElementsPopup: function closeElementsPopup(e) {
      var _this = this,
        popup = _this.currentBuilder.find('#botiga-bhfb-elements');
      if (e.target.closest('#botiga-bhfb-elements') === null) {
        popup.removeClass('show');
      }
    },
    isElementInViewport: function isElementInViewport(el) {
      if (typeof jQuery === "function" && el instanceof jQuery) {
        el = el[0];
      }
      var rect = el.getBoundingClientRect();
      return rect.top >= 0 && rect.left >= 0 && rect.bottom <= (window.innerHeight || $(window).height()) && rect.right <= (window.innerWidth || $(window).width());
    },
    elementsPopupContent: function elementsPopupContent() {
      var row = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
      var _this = this,
        elements = this.getElementsUnused(),
        elementsWrapper = $('.botiga-bhfb-elements-desktop'),
        mobileElementsWrapper = $('.botiga-bhfb-elements-mobile');
      elementsWrapper.html('');
      mobileElementsWrapper.html('');
      var cprefix = 'hb';
      if (_this.currentBuilderType && _this.currentBuilderType === 'footer') {
        cprefix = 'fb';
      }
      if (elements.desktop.length) {
        var _iterator7 = _createForOfIteratorHelper(elements.desktop),
          _step7;
        try {
          for (_iterator7.s(); !(_step7 = _iterator7.n()).done;) {
            var element = _step7.value;
            elementsWrapper.append('<div class="botiga-bhfb-element botiga-bhfb-element-desktop">' + '<a href="#" class="bhfb-button" data-bhfb-id="' + element.id + '" data-bhfb-focus-section="botiga_section_' + cprefix + '_component__' + element.id + '">' + element.label + '</a>' + '</div>');
          }
        } catch (err) {
          _iterator7.e(err);
        } finally {
          _iterator7.f();
        }
      } else {
        elementsWrapper.append('<p class="bhfb-elements-message">' + botiga_hfb.i18n.elementsMessage + '</p>');
      }

      // Remove off-canvas menu when the selected row 
      // isnt't the off-canvas area
      if (row !== 'mobile_offcanvas') {
        elements.mobile = elements.mobile.filter(function (item) {
          return item.id !== 'mobile_offcanvas_menu';
        });
      } else {
        // Remove some components from mobile
        elements.mobile = elements.mobile.filter(function (item) {
          return item.id !== 'secondary_menu' && item.id !== 'mobile_hamburger';
        });
      }
      if (elements.mobile.length) {
        var _iterator8 = _createForOfIteratorHelper(elements.mobile),
          _step8;
        try {
          for (_iterator8.s(); !(_step8 = _iterator8.n()).done;) {
            var _element = _step8.value;
            mobileElementsWrapper.append('<div class="botiga-bhfb-element botiga-bhfb-element-mobile">' + '<a href="#" class="bhfb-button" data-bhfb-id="' + _element.id + '" data-bhfb-focus-section="botiga_section_' + cprefix + '_component__' + _element.id + '">' + _element.label + '</a>' + '</div>');
          }
        } catch (err) {
          _iterator8.e(err);
        } finally {
          _iterator8.f();
        }
      } else {
        mobileElementsWrapper.append('<p class="bhfb-elements-message">' + botiga_hfb.i18n.elementsMessage + '</p>');
      }
      this.addUpsellComponents();
    },
    updateAvailableComponents: function updateAvailableComponents() {
      var _this = this;
      if (_this.currentBuilderType === 'header') {
        // Header Desktop Components.
        $('.botiga-header-builder-available-components').html('');
        $('.botiga-header-builder-available-components').html($('.botiga-bhfb-header .botiga-bhfb-elements-desktop').html());

        // Header Mobile Components.
        $('.botiga-header-builder-available-mobile-components').html('');
        $('.botiga-header-builder-available-mobile-components').html($('.botiga-bhfb-header .botiga-bhfb-elements-mobile').html());
      }
      if (_this.currentBuilderType === 'footer') {
        // Footer Components.
        $('.botiga-footer-builder-available-footer-components').html('');
        $('.botiga-footer-builder-available-footer-components').html($('.botiga-bhfb-footer .botiga-bhfb-elements-desktop').html());
      }
    },
    addUpsellComponents: function addUpsellComponents() {
      var _this = this;
      if (!botiga_hfb.upsell_components.enable) {
        return false;
      }
      var upsellComponentsHTML = '',
        components = _this.currentBuilderType === 'header' ? botiga_hfb.upsell_components.header : botiga_hfb.upsell_components.footer;
      var _iterator9 = _createForOfIteratorHelper(components),
        _step9;
      try {
        for (_iterator9.s(); !(_step9 = _iterator9.n()).done;) {
          var component = _step9.value;
          upsellComponentsHTML += "\n                    <div class=\"botiga-bhfb-element botiga-bhfb-element-desktop\">\n                        <a href=\"#\" class=\"bhfb-button\">".concat(component.label, "</a> \n                    </div>\n                ");
        }
      } catch (err) {
        _iterator9.e(err);
      } finally {
        _iterator9.f();
      }
      var upsellHTML = "\n                <div class=\"botiga-bhfb-upsell-components-wrapper\">\n                    <h4>".concat(botiga_hfb.upsell_components.title, "</h4>\n                    <div class=\"botiga-bhfb-upsell-components\">").concat(upsellComponentsHTML, "</div>\n                    <p>").concat(botiga_hfb.upsell_components.total, "</p>\n                    <a href=\"").concat(botiga_hfb.upsell_components.link, "\" target=\"_blank\" class=\"bhfb-upsell-button\">").concat(botiga_hfb.upsell_components.button, "</a>\n                </div>\n            ");
      $('#botiga-bhfb-elements .botiga-bhfb-elements-wrapper .botiga-bhfb-upsell-components-wrapper').remove();
      $('#botiga-bhfb-elements .botiga-bhfb-elements-wrapper').append(upsellHTML);
    },
    elementsButton: function elementsButton() {
      var _this = this;
      $(document).on('click', '.botiga-bhfb-element > a', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var id = $(this).data('bhfb-id'),
          focusSection = $(this).data('bhfb-focus-section');
        if ($(this).closest('#botiga-bhfb-elements').length) {
          _this.elementsButtonAdd(id);

          // close elements popup.
          _this.currentBuilder.find('#botiga-bhfb-elements').removeClass('show');
        } else {
          if (e.target.classList.contains('bhfb-remove-element')) {
            _this.elementsButtonRemove(id);
            return false;
          }
        }
        setTimeout(function () {
          wp.customize.section(focusSection).focus();
        }, _this.updateGridDelay);
      });
    },
    elementsButtonAdd: function elementsButtonAdd(id) {
      var hasOrder = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
      var _this = this;
      var current_value = _this.jsonDecode(_this.currentRowInput.val()),
        value_wrapper = _this.currentDevice;
      if (_this.currentDevice === 'mobile' && _this.currentRow.hasClass('botiga-bhfb-area-offcanvas')) {
        value_wrapper = 'mobile_offcanvas';
      }

      // Change the value.
      if (!hasOrder) {
        current_value[value_wrapper][_this.currentColumnPos].push(id);
      } else {
        current_value[value_wrapper][_this.currentColumnPos] = _this.componentsOrder;
      }

      // Do not add specific components on specific areas. 
      // E.g: Don't add 'Mobile Offcanvas Menu' on areas that are not the 'offcanvas wrapper'
      if (_this.currentComponent === 'mobile_offcanvas_menu' && !_this.currentRow.hasClass('botiga-bhfb-area-offcanvas')) {
        return false;
      }
      if (_this.currentComponent === 'mobile_hamburger' && _this.currentRow.hasClass('botiga-bhfb-area-offcanvas')) {
        return false;
      }

      // Update the value in the customizer field.
      _this.currentRowInput.val(JSON.stringify(current_value));

      // Trigger change in the customizer field (desktop).
      _this.currentRowInput.trigger('change');

      // Trigger change in the customizer field (mobile).
      if (_this.currentBuilderType === 'header') {
        _this.currentRowInput.closest('.customize-control').next().find('input').val(Math.random()).trigger('change');
      }
      _this.elementsPopupContent();
      _this.builderGridContent();
      $('#botiga-bhfb-elements').removeClass('show');
    },
    elementsButtonRemove: function elementsButtonRemove(id) {
      var triggerChange = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;
      var _this = this;
      var current_value = _this.jsonDecode(_this.currentRowInput.val()),
        value_wrapper = _this.currentDevice;
      if (_this.currentDevice === 'mobile' && _this.currentRow.hasClass('botiga-bhfb-area-offcanvas')) {
        value_wrapper = 'mobile_offcanvas';
      }

      // Change the value.
      current_value[value_wrapper][_this.currentColumnPos] = current_value[value_wrapper][_this.currentColumnPos].filter(function (item) {
        return item !== id;
      });

      // Update the value in the customizer field.
      _this.currentRowInput.val(JSON.stringify(current_value));

      // Trigger change in the customizer field.
      if (triggerChange) {
        // Desktop.
        _this.currentRowInput.trigger('change');

        // Mobile.
        _this.currentRowInput.closest('.customize-control').next().find('input').val(Math.random()).trigger('change');
      }
      _this.elementsPopupContent();
      _this.builderGridContent();
    },
    elementsSortable: function elementsSortable() {
      var _this = this;
      $('.botiga-bhfb-area').each(function () {
        $(this).sortable({
          placeholder: "botiga-bhfb-element bhfb-ui-state-highlight",
          connectWith: '.botiga-bhfb-area',
          scroll: false,
          cancel: '.bhfb-edit-column',
          change: function change(e, ui) {
            _this.currentComponent = $(ui.item[0]).find('.bhfb-button').data('bhfb-id');
            _this.currentRow = !$(ui.placeholder[0]).closest('.botiga-bhfb-row').length ? $(ui.placeholder[0]).closest('.botiga-bhfb-area-offcanvas') : $(ui.placeholder[0]).closest('.botiga-bhfb-row');
            _this.currentRowInput = $('#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + ui.placeholder.closest('.botiga-bhfb-area').data('bhfb-row'));
            var order = [];
            ui.placeholder.closest('.botiga-bhfb-area').find('.ui-sortable-placeholder').attr('data-bhfb-id', _this.currentComponent);
            ui.placeholder.closest('.botiga-bhfb-area').find('.botiga-bhfb-element').each(function () {
              var cid = typeof $(this).find('.bhfb-button').data('bhfb-id') !== 'undefined' ? $(this).find('.bhfb-button').data('bhfb-id') : $(this).data('bhfb-id');
              if (!$(this).hasClass('ui-sortable-helper')) {
                order.push(cid);
              }
            });

            // Save components order (from respective row)
            _this.componentsOrder = order;
          },
          update: function update(e, ui) {
            // When we use "connectWith" param this condition is needed 
            // to prevent the code being running twice because the 'update' event runs twice
            if (this === ui.item.parent()[0]) {
              var component_id = ui.item.find('> .bhfb-button').data('bhfb-id'),
                row = ui.item.closest('.botiga-bhfb-area').data('bhfb-row'),
                column = ui.item.closest('.botiga-bhfb-area').index() - 1,
                prevRow = ui.sender !== null ? ui.sender.data('bhfb-row') : null,
                prevColumn = ui.sender !== null ? ui.sender.index() - 1 : null;
              if (ui.sender === null) {
                // Add component based on global order "_this.componentsOrder"
                _this.elementsButtonAdd('', true);
                return false;
              }
              if (!ui.sender.hasClass('bhfb-available-components')) {
                _this.currentRowInput = $('#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + prevRow);
              }
              _this.currentColumnPos = prevColumn;
              _this.elementsButtonRemove(component_id, true);
              if (!ui.sender.hasClass('bhfb-available-components')) {
                _this.currentRowInput = $('#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + row);
              }
              _this.currentColumnPos = column;
              _this.elementsButtonAdd(component_id, true);
            }
          }
        });
        $(this).disableSelection();
      });
    },
    builderGridContent: function builderGridContent() {
      var _this = this,
        fields = ['#_customize-input-botiga_header_row__above_header_row', '#_customize-input-botiga_header_row__main_header_row', '#_customize-input-botiga_header_row__below_header_row', '#_customize-input-botiga_header_row__mobile_offcanvas'],
        cprefix = 'hb';
      if (_this.currentBuilderType && _this.currentBuilderType === 'footer') {
        fields = ['#_customize-input-botiga_footer_row__above_footer_row', '#_customize-input-botiga_footer_row__main_footer_row', '#_customize-input-botiga_footer_row__below_footer_row'];
        cprefix = 'fb';
      }
      if (_this.builderGridContentFlag) {
        return false;
      }
      _this.builderGridContentFlag = true;
      setTimeout(function () {
        for (var _i4 = 0, _fields2 = fields; _i4 < _fields2.length; _i4++) {
          var field = _fields2[_i4];
          var value = _this.jsonDecode($(field).val());
          var current_row = '';

          // Detect row.
          if (field.indexOf('above_' + _this.currentBuilderType + '_row') !== -1) {
            current_row = 'above';
          }
          if (field.indexOf('main_' + _this.currentBuilderType + '_row') !== -1) {
            current_row = 'main';
          }
          if (field.indexOf('below_' + _this.currentBuilderType + '_row') !== -1) {
            current_row = 'below';
          }
          if (field.indexOf('row__mobile_offcanvas') !== -1) {
            current_row = 'mobile_offcanvas';
          }

          // Empty columns.
          $('.botiga-bhfb-area[data-bhfb-row="' + current_row + '_' + _this.currentBuilderType + '_row"]').each(function () {
            $(this).remove();
          });

          // Desktop. 
          if (_this.currentDevice === 'desktop') {
            var column_id = 1;
            var _iterator10 = _createForOfIteratorHelper(value.desktop),
              _step10;
            try {
              for (_iterator10.s(); !(_step10 = _iterator10.n()).done;) {
                var columns = _step10.value;
                $('.botiga-bhfb-' + _this.currentBuilderType + ' .botiga-bhfb-' + current_row + '-row').append('<div class="botiga-bhfb-area" data-bhfb-row="' + current_row + '_' + _this.currentBuilderType + '_row"><a class="bhfb-edit-column" href="#" onClick="event.stopPropagation(); wp.customize.section(\'botiga_' + _this.currentBuilderType + '_row__' + current_row + '_' + _this.currentBuilderType + '_row_column' + column_id + '\').focus();"><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="15" fill="#FFF"/><rect x="7" width="2" height="15" fill="#FFF"/><rect y="3" width="3" height="16" transform="rotate(-90 0 3)" fill="#FFF"/><rect y="15" width="2" height="16" transform="rotate(-90 0 15)" fill="#FFF"/><rect x="14" width="2" height="15" fill="#FFF"/></svg></a>');
                var column = $('.botiga-bhfb-' + current_row + '-row').find('.botiga-bhfb-area:last-child');
                if (columns.length) {
                  var _iterator11 = _createForOfIteratorHelper(columns),
                    _step11;
                  try {
                    for (_iterator11.s(); !(_step11 = _iterator11.n()).done;) {
                      var _element2 = _step11.value;
                      _element2 = _this.getElementData(_element2);
                      if (_typeof(_element2) !== 'object') {
                        continue;
                      }
                      column.append('<div class="botiga-bhfb-element">' + '<a href="#" class="bhfb-button" data-bhfb-id="' + _element2.id + '" data-bhfb-focus-section="botiga_section_' + cprefix + '_component__' + _element2.id + '">' + '<span class="bhfb-title-element">' + _element2.label + '</span>' + '<i class="bhfb-edit-element dashicons dashicons-admin-generic"></i>' + '<i class="bhfb-remove-element dashicons dashicons-no-alt"></i>' + '</a>' + '</div>');
                    }
                  } catch (err) {
                    _iterator11.e(err);
                  } finally {
                    _iterator11.f();
                  }
                }
                column_id++;
              }
            } catch (err) {
              _iterator10.e(err);
            } finally {
              _iterator10.f();
            }
          }

          // Mobile.
          if (_this.currentDevice === 'mobile') {
            var _column_id = 1;
            var _iterator12 = _createForOfIteratorHelper(value.mobile),
              _step12;
            try {
              for (_iterator12.s(); !(_step12 = _iterator12.n()).done;) {
                var _columns = _step12.value;
                $('.botiga-bhfb-' + current_row + '-row').append('<div class="botiga-bhfb-area" data-bhfb-row="' + current_row + '_' + _this.currentBuilderType + '_row"><a class="bhfb-edit-column" href="#" onClick="event.stopPropagation(); wp.customize.section(\'botiga_' + _this.currentBuilderType + '_row__' + current_row + '_' + _this.currentBuilderType + '_row_column' + _column_id + '\').focus();"><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg"><rect width="2" height="15" fill="#FFF"/><rect x="7" width="2" height="15" fill="#FFF"/><rect y="3" width="3" height="16" transform="rotate(-90 0 3)" fill="#FFF"/><rect y="15" width="2" height="16" transform="rotate(-90 0 15)" fill="#FFF"/><rect x="14" width="2" height="15" fill="#FFF"/></svg></a>');
                var _column = $('.botiga-bhfb-' + current_row + '-row').find('.botiga-bhfb-area:last-child');
                if (_columns.length) {
                  var _iterator14 = _createForOfIteratorHelper(_columns),
                    _step14;
                  try {
                    for (_iterator14.s(); !(_step14 = _iterator14.n()).done;) {
                      var _element3 = _step14.value;
                      _element3 = _this.getElementData(_element3);
                      if (_typeof(_element3) !== 'object') {
                        continue;
                      }
                      _column.append('<div class="botiga-bhfb-element">' + '<a href="#" class="bhfb-button" data-bhfb-id="' + _element3.id + '" data-bhfb-focus-section="botiga_section_' + cprefix + '_component__' + _element3.id + '">' + '<span class="bhfb-title-element">' + _element3.label + '</span>' + '<i class="bhfb-edit-element dashicons dashicons-admin-generic"></i>' + '<i class="bhfb-remove-element dashicons dashicons-no-alt"></i>' + '</a>' + '</div>');
                    }
                  } catch (err) {
                    _iterator14.e(err);
                  } finally {
                    _iterator14.f();
                  }
                }
                _column_id++;
              }

              // Mobile Off-Canvas.
            } catch (err) {
              _iterator12.e(err);
            } finally {
              _iterator12.f();
            }
            if (field.indexOf('mobile_offcanvas') !== -1) {
              $('.botiga-bhfb-area-offcanvas').html('');
              if (value.mobile_offcanvas.length) {
                var elements = value.mobile_offcanvas[0];
                var _iterator13 = _createForOfIteratorHelper(elements),
                  _step13;
                try {
                  for (_iterator13.s(); !(_step13 = _iterator13.n()).done;) {
                    var element = _step13.value;
                    element = _this.getElementData(element);
                    if (_typeof(element) !== 'object') {
                      continue;
                    }
                    $('.botiga-bhfb-area-offcanvas').append('<div class="botiga-bhfb-element">' + '<a href="#" class="bhfb-button" data-bhfb-id="' + element.id + '" data-bhfb-focus-section="botiga_section_hb_component__' + element.id + '">' + '<span class="bhfb-title-element">' + element.label + '</span>' + '<i class="bhfb-edit-element dashicons dashicons-admin-generic"></i>' + '<i class="bhfb-remove-element dashicons dashicons-no-alt"></i>' + '</a>' + '</div>');
                  }
                } catch (err) {
                  _iterator13.e(err);
                } finally {
                  _iterator13.f();
                }
              }
            }
          }
        }
        if (!_this.currentBuilder) {
          _this.builderGridContentFlag = false;
          return false;
        }
        if (_this.currentBuilder.hasClass('show') && !_this.currentBuilder.hasClass('show-bottom')) {
          $('.botiga-bhfb').css('height', 0);
          _this.currentBuilder.css('height', _this.currentBuilder.find('.botiga-bhfb-top').outerHeight() + 47);
        } else {
          _this.currentBuilder.css('height', 0);
        }
        _this.updateAvailableComponents();
        _this.elementsSortable();
        $(window).trigger('bhfb.grid.ready');
        _this.builderGridContentFlag = false;
      }, _this.updateGridDelay);
    },
    getElementData: function getElementData(element) {
      var _this = this;
      var elements = [].concat(_toConsumableArray(botiga_hfb.components.desktop), _toConsumableArray(botiga_hfb.components.mobile));
      if (_this.currentBuilderType === 'footer') {
        elements = botiga_hfb.components.footer;
      }
      var _iterator15 = _createForOfIteratorHelper(elements),
        _step15;
      try {
        for (_iterator15.s(); !(_step15 = _iterator15.n()).done;) {
          var el = _step15.value;
          if (el.id === element) {
            return el;
          }
        }
      } catch (err) {
        _iterator15.e(err);
      } finally {
        _iterator15.f();
      }
      return '';
    },
    showHideBuilder: function showHideBuilder() {
      var self = this;
      var sections = [
      // Header
      'botiga_section_hb_wrapper', 'botiga_section_hb_presets', 'botiga_section_hb_above_header_row', 'botiga_section_hb_main_header_row', 'botiga_section_hb_below_header_row', 'botiga_section_hb_mobile_offcanvas', 'header_image', 'botiga_section_hb_component__logo', 'botiga_section_hb_component__search', 'botiga_section_hb_component__social', 'botiga_section_hb_component__menu', 'botiga_section_hb_component__secondary_menu', 'botiga_section_hb_component__contact_info', 'botiga_section_hb_component__button', 'botiga_section_hb_component__button2', 'botiga_section_hb_component__html', 'botiga_section_hb_component__html2', 'botiga_section_hb_component__shortcode', 'botiga_section_hb_component__shortcode2', 'botiga_section_hb_component__shortcode3', 'botiga_section_hb_component__login_register', 'botiga_section_hb_component__woo_icons', 'botiga_section_hb_component__pll_switcher', 'botiga_section_hb_component__wpml_switcher', 'botiga_section_hb_component__mobile_offcanvas_menu', 'botiga_section_hb_component__mobile_hamburger',
      // Footer
      'botiga_section_fb_wrapper', 'botiga_section_fb_above_footer_row', 'botiga_section_fb_main_footer_row', 'botiga_section_fb_below_footer_row', 'botiga_section_fb_component__social', 'botiga_section_fb_component__footer_menu', 'botiga_section_fb_component__copyright', 'botiga_section_fb_component__button', 'botiga_section_fb_component__button2', 'botiga_section_fb_component__html', 'botiga_section_fb_component__html2', 'botiga_section_fb_component__shortcode', 'botiga_section_fb_component__widget1', 'botiga_section_fb_component__widget2', 'botiga_section_fb_component__widget3', 'botiga_section_fb_component__widget4'];

      // Append columns to the sections array.
      var rows = ['above', 'main', 'below'];
      for (var _i5 = 0, _rows2 = rows; _i5 < _rows2.length; _i5++) {
        var row = _rows2[_i5];
        for (var i = 1; i <= 6; i++) {
          sections.push('botiga_header_row__' + row + '_header_row_column' + i);
          sections.push('botiga_footer_row__' + row + '_footer_row_column' + i);
        }
      }
      sections.forEach(function (section) {
        if (typeof wp.customize.section(section) !== 'undefined') {
          wp.customize.section(section).expanded.bind(function (is_active) {
            self.currentBuilder = self.getCurrentBuilderByComponent(section);
            self.currentBuilderType = self.currentBuilder.hasClass('botiga-bhfb-header') ? 'header' : 'footer';
            if (is_active) {
              $('body').addClass('bhfb-active');
              self.currentBuilder.addClass('show');
              self.scrollToRespectiveBuilderArea();
            } else {
              $('body').removeClass('bhfb-active');
              self.currentBuilder.removeClass('show');
            }
            setTimeout(function () {
              self.builderGridContent();

              // Update available components.
              if (section === 'botiga_section_hb_wrapper' || section === 'botiga_section_fb_wrapper') {
                // $( '.botiga-bhfb-' + self.currentBuilderType ).find( '.botiga-bhfb-above-row .botiga-bhfb-area' ).trigger( 'click' );
                self.updateAvailableComponents();
                setTimeout(function () {
                  $('.botiga-bhfb-elements').removeClass('show');
                }, 200);
              }
            }, 100);
          });
        }
      });
    },
    scrollToRespectiveBuilderArea: function scrollToRespectiveBuilderArea() {
      var _this = this,
        iframe = document.querySelector('#customize-preview > iframe'),
        iframeHTMLTag = iframe ? iframe.contentWindow.document.getElementsByTagName('html')[0] : null,
        scrollTo = _this.currentBuilderType === 'header' ? 0 : 99999;
      if (iframeHTMLTag === null) {
        return false;
      }
      $(iframeHTMLTag).animate({
        scrollTop: scrollTo
      }, 'fast');
    },
    getCurrentBuilderByComponent: function getCurrentBuilderByComponent(component) {
      if (component.indexOf('_hb_') !== -1 || component.indexOf('_header_') !== -1 || component.indexOf('header_image') !== -1) {
        return $('.botiga-bhfb-header');
      } else if (component.indexOf('_fb_') !== -1 || component.indexOf('_footer_') !== -1) {
        return $('.botiga-bhfb-footer');
      }
      return false;
    },
    showHideBuilderTop: function showHideBuilderTop() {
      var self = this;
      $('.botiga-bhfb-bottom-display').on('click', function (e) {
        e.preventDefault();
        $('body').toggleClass('bhfb-active-bottom');
        $(this).toggleClass('show');
        $('.botiga-bhfb-top').toggleClass('show');
        $('.botiga-bhfb').toggleClass('show-bottom');
        self.builderGridContent();
      });
    },
    builderCustomColumns: function builderCustomColumns() {
      var _this = this,
        options = ['botiga_header_row__above_header_row_columns', 'botiga_header_row__main_header_row_columns', 'botiga_header_row__below_header_row_columns', 'botiga_footer_row__above_footer_row_columns_desktop', 'botiga_footer_row__main_footer_row_columns_desktop', 'botiga_footer_row__below_footer_row_columns_desktop'];
      options.forEach(function (optionID) {
        if (typeof wp.customize.control(optionID) !== 'undefined') {
          var devices = optionID.indexOf('header') !== -1 ? ['desktop', 'tablet'] : ['desktop'];
          var _loop4 = function _loop4() {
            var device = _devices[_i6];
            var deviceSelector = optionID.indexOf('header') !== -1 ? '_' + device : '';
            wp.customize(optionID + deviceSelector, function (option) {
              option.bind(function (to) {
                var rows = ['above', 'main', 'below'],
                  rowSelector = '',
                  $rowInput = '';
                for (var _i7 = 0, _rows3 = rows; _i7 < _rows3.length; _i7++) {
                  var row = _rows3[_i7];
                  var rowOptionID = 'botiga_' + _this.currentBuilderType + '_row__' + row + '_' + _this.currentBuilderType,
                    rowInputSelector = '#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + row + '_' + _this.currentBuilderType + '_row';
                  if (optionID.indexOf(rowOptionID) !== -1) {
                    rowSelector = 'botiga-bhfb-' + row + '-row';
                    $rowInput = $(rowInputSelector);
                    _this.currentRow = row;
                  }
                }
                if (rowSelector === '' || $rowInput === '') {
                  return false;
                }

                // Update builder row columns class.
                _this.addBuilderRowColumnsClass(device, rowSelector, to);

                // Update row input value.
                var current_value = _this.jsonDecode($rowInput.val());

                // Add column.
                if (to < current_value[_this.currentDevice].length) {
                  while (current_value[_this.currentDevice].length > to) {
                    current_value[_this.currentDevice].pop();
                  }

                  // Remove column.
                } else if (to > current_value[_this.currentDevice].length) {
                  while (current_value[_this.currentDevice].length < to) {
                    current_value[_this.currentDevice].push([]);
                  }
                }

                // Update the value in the customizer field.
                $rowInput.val(JSON.stringify(current_value));

                // Update the respective row columns layout customizer field.
                _this.updateColumnsLayoutOption(device, to);

                // Update 'Available Columns' area.
                _this.updateAvailableColumnsArea(device, to);

                // Trigger change in the customizer field (desktop).
                $rowInput.trigger('change');

                // Trigger change in the customizer field (mobile).
                if (_this.currentBuilderType === 'header' && _this.currentDevice === 'mobile') {
                  $rowInput.closest('.customize-control').next().find('input').val(Math.random()).trigger('change');
                }

                // Update grid.
                _this.builderGridContent();
              });
            });
          };
          for (var _i6 = 0, _devices = devices; _i6 < _devices.length; _i6++) {
            _loop4();
          }
        }
      });

      // Main purpose of the below code is update 'Columns Layout' options on the first load.
      var areas = ['header', 'footer'],
        rows = ['above', 'main', 'below'];
      for (var _i8 = 0, _areas2 = areas; _i8 < _areas2.length; _i8++) {
        var area = _areas2[_i8];
        var prefix = area === 'header' ? 'hb' : 'fb';
        var _iterator16 = _createForOfIteratorHelper(rows),
          _step16;
        try {
          var _loop5 = function _loop5() {
            var row = _step16.value;
            var sectionID = 'botiga_section_' + prefix + '_' + row + '_' + area + '_row';
            if (typeof wp.customize.section(sectionID) !== 'undefined') {
              wp.customize.section(sectionID).expanded.bind(function (is_active) {
                if (is_active) {
                  if (sectionID.indexOf('header') !== -1) {
                    _this.currentBuilderType = 'header';
                  } else if (sectionID.indexOf('footer') !== -1) {
                    _this.currentBuilderType = 'footer';
                  }
                  var devices = _this.currentBuilderType === 'header' ? ['desktop', 'tablet'] : ['desktop'];
                  var _loop6 = function _loop6() {
                    var device = _devices2[_i9];
                    setTimeout(function () {
                      var rowSelector = 'botiga-bhfb-' + row + '-row',
                        columnsOptionID = 'botiga_' + _this.currentBuilderType + '_row__' + row + '_' + _this.currentBuilderType + '_row_columns_' + device;
                      _this.currentRow = row;
                      _this.currentRowInput = $('#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + row + '_' + _this.currentBuilderType + '_row');

                      // Update builder row columns class.
                      _this.addBuilderRowColumnsClass(device, rowSelector, wp.customize(columnsOptionID).get());

                      // Update 'Columns Layout' options.
                      _this.updateColumnsLayoutOption(device, wp.customize(columnsOptionID).get());

                      // Update 'Available Columns' area.
                      _this.updateAvailableColumnsArea(device, wp.customize(columnsOptionID).get());
                    }, 50);
                  };
                  for (var _i9 = 0, _devices2 = devices; _i9 < _devices2.length; _i9++) {
                    _loop6();
                  }
                }
              });
            }
          };
          for (_iterator16.s(); !(_step16 = _iterator16.n()).done;) {
            _loop5();
          }
        } catch (err) {
          _iterator16.e(err);
        } finally {
          _iterator16.f();
        }
      }
    },
    addBuilderRowColumnsClass: function addBuilderRowColumnsClass(device, rowSelector, to) {
      var _this = this;
      if (device === 'tablet') {
        device = 'mobile';
      }

      // Remove all possible columns class.
      for (var i = 1; i <= 6; i++) {
        $('.botiga-bhfb-' + _this.currentBuilderType + ' .botiga-bhfb-' + device + ' .botiga-bhfb-row.' + rowSelector).removeClass('botiga-bhfb-row-' + i + '-columns');
      }

      // Add new columns class.
      $('.botiga-bhfb-' + _this.currentBuilderType + ' .botiga-bhfb-' + device + ' .botiga-bhfb-row.' + rowSelector).addClass('botiga-bhfb-row-' + to + '-columns');
    },
    updateColumnsLayoutOption: function updateColumnsLayoutOption(device, val) {
      var _this = this,
        setting_id = 'botiga_' + _this.currentBuilderType + '_row__' + _this.currentRow + '_' + _this.currentBuilderType + '_row_columns_layout_' + device,
        selector = setting_id + '-' + wp.customize(setting_id).get();

      // Hide the column layout options that doesn't match with 'columns' value.
      $('label[for*="' + setting_id + '"]').css('display', 'none');
      $('label[for*="' + setting_id + '-' + val + 'col-"]').css('display', 'block');
      if ($('label[for="' + selector + '"]').parent().hasClass('bhfb-option-updated')) {
        return false;
      }

      // Remove active class from current option.
      // $( 'label[for="'+ selector +'"]' ).removeClass( 'ui-state-active' );

      // Set new value and change active class.
      // wp.customize( setting_id ).set( val + 'col-equal' );
      // $( 'label[for="'+ setting_id +'-'+ val +'col-equal"]' ).trigger( 'click' ).addClass( 'ui-state-active' );

      // Add class as a flag.
      $('label[for="' + selector + '"]').parent().addClass('bhfb-option-updated');
    },
    builderColumnsLayout: function builderColumnsLayout() {
      var _this = this,
        options = ['botiga_header_row__above_header_row_columns_layout', 'botiga_header_row__main_header_row_columns_layout', 'botiga_header_row__below_header_row_columns_layout', 'botiga_footer_row__above_footer_row_columns_layout_desktop', 'botiga_footer_row__main_footer_row_columns_layout_desktop', 'botiga_footer_row__below_footer_row_columns_layout_desktop'];
      options.forEach(function (optionID) {
        if (typeof wp.customize.control(optionID) !== 'undefined') {
          var devices = optionID.indexOf('header') !== -1 ? ['desktop', 'tablet'] : ['desktop'];
          var _loop7 = function _loop7() {
            var device = _devices3[_i10];
            var deviceSelector = optionID.indexOf('header') !== -1 ? '_' + device : '';
            wp.customize(optionID + deviceSelector, function (option) {
              option.bind(function (to) {
                var current_row = 'above';
                if (optionID.indexOf('main') !== -1) {
                  current_row = 'main';
                } else if (optionID.indexOf('below') !== -1) {
                  current_row = 'below';
                }

                // Convert 'tablet' to 'mobile' because html selectors are 'mobile' and not 'tablet'.
                if (device === 'tablet') {
                  device = 'mobile';
                }
                _this.currentRowInput = $('#_customize-input-botiga_' + _this.currentBuilderType + '_row__' + current_row + '_' + _this.currentBuilderType + '_row');
                var $builderRow = $('.botiga-bhfb-' + _this.currentBuilderType + ' .botiga-bhfb-' + device + ' .botiga-bhfb-row.botiga-bhfb-' + current_row + '-row');
                $builderRow.removeClass('botiga-bhfb-row-columns-layout-equal');
                $builderRow.removeClass('botiga-bhfb-row-columns-layout-bigleft');
                $builderRow.removeClass('botiga-bhfb-row-columns-layout-bigright');
                if (to.indexOf('equal') !== -1) {
                  $builderRow.addClass('botiga-bhfb-row-columns-layout-equal');
                }
                if (to.indexOf('bigleft') !== -1) {
                  $builderRow.addClass('botiga-bhfb-row-columns-layout-bigleft');
                }
                if (to.indexOf('bigright') !== -1) {
                  $builderRow.addClass('botiga-bhfb-row-columns-layout-bigright');
                }

                // Trigger change in the customizer field to run the selective refresh on the respective row.
                var inputValue = _this.currentRowInput.val();
                _this.currentRowInput.val('').trigger('change');
                _this.currentRowInput.val(inputValue).trigger('change');

                // Trigger change on mobile row field.
                if (_this.currentBuilderType === 'header' && _this.currentDevice === 'mobile') {
                  _this.currentRowInput.closest('.customize-control').next().find('input').val(Math.random()).trigger('change');
                }
              });
            });
          };
          for (var _i10 = 0, _devices3 = devices; _i10 < _devices3.length; _i10++) {
            _loop7();
          }
        }
      });
    },
    updateAvailableColumnsArea: function updateAvailableColumnsArea(device, colsNumber) {
      var _this = this,
        rowSection = _this.currentRowInput.closest('.control-section'),
        avCompsItems = rowSection.find('.bhfb-available-columns.bhfb-available-columns-' + device + ' .bhfb-available-columns-item');
      avCompsItems.addClass('hide');
      for (var i = 1; i <= colsNumber; i++) {
        avCompsItems.eq(i - 1).removeClass('hide');
      }
    },
    footerCustomizerOptions: function footerCustomizerOptions() {
      // Rows.
      var rows = ['above', 'main', 'below'];
      for (var _i11 = 0, _rows4 = rows; _i11 < _rows4.length; _i11++) {
        var row = _rows4[_i11];
        var fieldID = 'botiga_footer_row__' + row + '_footer_row';

        // Vertical Aligment.
        wp.customize(fieldID, function (option) {
          option.bind(function (to) {
            $('.bhfb-footer').remove();
          });
        });
      }
    },
    extraNavigation: function extraNavigation() {
      var _this = this;
      wp.customize.section('botiga_section_hb_mobile_offcanvas').expanded.bind(function (is_active) {
        if (!is_active) {
          return false;
        }
        var currentDevice = $('.wp-full-overlay-footer .devices button.active').data('device');
        if (currentDevice === 'desktop') {
          $('.wp-full-overlay-footer .devices button[data-device="tablet"]').trigger('click');
        }
      });
    },
    headerPresets: function headerPresets() {
      var _this = this;
      wp.customize('botiga_section_hb_presets__header_preset_layout', function (option) {
        option.bind(function (to) {
          _this.updateHeaderPreset(to);
        });
      });
    },
    updateHeaderPreset: function updateHeaderPreset(preset) {
      var _this = this,
        $above_row = $('#_customize-input-botiga_header_row__above_header_row'),
        $main_row = $('#_customize-input-botiga_header_row__main_header_row'),
        $below_row = $('#_customize-input-botiga_header_row__below_header_row');

      // Set some others customizer settings.
      if (preset === 'header_layout_1') {
        wp.customize('botiga_header_row__main_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column1_horizontal_alignment_desktop').set('start');
        wp.customize('botiga_header_row__main_header_row_column2_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column2_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column2_horizontal_alignment_desktop').set('center');
        wp.customize('botiga_header_row__main_header_row_column3_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column3_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column3_horizontal_alignment_desktop').set('end');
      }
      if (preset === 'header_layout_2') {
        wp.customize('botiga_header_row__main_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column1_horizontal_alignment_desktop').set('start');
        wp.customize('botiga_header_row__main_header_row_column2_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column2_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column2_horizontal_alignment_desktop').set('end');
      }
      if (preset === 'header_layout_3') {
        wp.customize('botiga_header_row__main_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column1_horizontal_alignment_desktop').set('start');
        wp.customize('botiga_header_row__main_header_row_column2_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column2_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column2_horizontal_alignment_desktop').set('center');
        wp.customize('botiga_header_row__main_header_row_column3_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column3_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column3_horizontal_alignment_desktop').set('end');
        wp.customize('botiga_header_row__below_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__below_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__below_header_row_column1_horizontal_alignment_desktop').set('center');
      }
      if (preset === 'header_layout_4') {
        wp.customize('botiga_header_row__main_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column1_horizontal_alignment_desktop').set('start');
        wp.customize('botiga_header_row__main_header_row_column2_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column2_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column2_horizontal_alignment_desktop').set('end');
        wp.customize('botiga_header_row__below_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__below_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__below_header_row_column1_horizontal_alignment_desktop').set('start');
        wp.customize('botiga_header_row__below_header_row_column2_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__below_header_row_column2_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__below_header_row_column2_horizontal_alignment_desktop').set('end');
      }
      if (preset === 'header_layout_5') {
        wp.customize('botiga_header_row__main_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column1_horizontal_alignment_desktop').set('start');
        wp.customize('botiga_header_row__main_header_row_column2_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column2_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column2_horizontal_alignment_desktop').set('center');
        wp.customize('botiga_header_row__main_header_row_column3_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__main_header_row_column3_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__main_header_row_column3_horizontal_alignment_desktop').set('end');
        wp.customize('botiga_header_row__below_header_row_column1_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__below_header_row_column1_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__below_header_row_column1_horizontal_alignment_desktop').set('start');
        wp.customize('botiga_header_row__below_header_row_column2_vertical_alignment_desktop').set('middle');
        wp.customize('botiga_header_row__below_header_row_column2_inner_layout_desktop').set('inline');
        wp.customize('botiga_header_row__below_header_row_column2_horizontal_alignment_desktop').set('end');
      }

      // Mobile (always same layout for all presets).
      wp.customize('botiga_header_row__main_header_row_column1_vertical_alignment_tablet').set('middle');
      wp.customize('botiga_header_row__main_header_row_column1_inner_layout_tablet').set('inline');
      wp.customize('botiga_header_row__main_header_row_column1_horizontal_alignment_tablet').set('start');
      wp.customize('botiga_header_row__main_header_row_column1_vertical_alignment_mobile').set('middle');
      wp.customize('botiga_header_row__main_header_row_column1_inner_layout_mobile').set('inline');
      wp.customize('botiga_header_row__main_header_row_column1_horizontal_alignment_mobile').set('start');
      wp.customize('botiga_header_row__main_header_row_column2_vertical_alignment_tablet').set('middle');
      wp.customize('botiga_header_row__main_header_row_column2_inner_layout_tablet').set('inline');
      wp.customize('botiga_header_row__main_header_row_column2_horizontal_alignment_tablet').set('center');
      wp.customize('botiga_header_row__main_header_row_column2_vertical_alignment_mobile').set('middle');
      wp.customize('botiga_header_row__main_header_row_column2_inner_layout_mobile').set('inline');
      wp.customize('botiga_header_row__main_header_row_column2_horizontal_alignment_mobile').set('center');
      wp.customize('botiga_header_row__main_header_row_column3_vertical_alignment_tablet').set('middle');
      wp.customize('botiga_header_row__main_header_row_column3_inner_layout_tablet').set('inline');
      wp.customize('botiga_header_row__main_header_row_column3_horizontal_alignment_tablet').set('end');
      wp.customize('botiga_header_row__main_header_row_column3_vertical_alignment_mobile').set('middle');
      wp.customize('botiga_header_row__main_header_row_column3_inner_layout_mobile').set('inline');
      wp.customize('botiga_header_row__main_header_row_column3_horizontal_alignment_mobile').set('end');

      // Set row settings and trigger change.
      $above_row.val(botiga_hfb.header_presets[preset]['above_row']).trigger('change');
      $main_row.val(botiga_hfb.header_presets[preset]['main_row']).trigger('change');
      $below_row.val(botiga_hfb.header_presets[preset]['below_row']).trigger('change');

      // Trigger change on mobile row field.
      $above_row.closest('.customize-control').next().find('input').val(Math.random()).trigger('change');
      $main_row.closest('.customize-control').next().find('input').val(Math.random()).trigger('change');
      $below_row.closest('.customize-control').next().find('input').val(Math.random()).trigger('change');
      _this.builderGridContent();
    }
  };
  $(document).ready(function () {
    bhfb.init();
  });
})(jQuery);