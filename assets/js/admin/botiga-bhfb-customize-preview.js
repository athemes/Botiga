"use strict";

function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
(function ($) {
  'use strict';

  /**
   * Admin interaction
   * The code here interact somehow with the admin
   */
  wp.customize.bind('preview-ready', function () {
    $(document).on('click', '.bhfb-item-customizer-focus', function (e) {
      e.preventDefault();
      e.stopPropagation();

      // Go to section.
      if ($(this).parent().data('section-id')) {
        window.parent.wp.customize.section($(this).parent().data('section-id')).focus();
        return false;
      }
      var id = $(this).closest('.bhfb-builder-item').data('component-id');

      // Check builder type.
      var currentBuilderSelector = '.botiga-bhfb-header';
      if ($(this).closest('.bhfb-footer').length) {
        currentBuilderSelector = '.botiga-bhfb-footer';
      }

      // Go to component section.
      if ($(this).closest('.bhfb-header').length || $(this).closest('.bhfb-mobile_offcanvas').length) {
        window.parent.wp.customize.section('botiga_section_hb_component__' + id).focus();
      } else {
        window.parent.wp.customize.section('botiga_section_fb_component__' + id).focus();
      }

      // Show grid builder.
      $(window.parent.document).find(currentBuilderSelector).addClass('show');
    });

    // Components Popup
    // The components popup should close when
    // we click on the preview iframe as well
    $('html').on('mouseup', function () {
      $(window.parent.document).find('#botiga-bhfb-elements').removeClass('show');
    });

    // Some scripts needs to run again when selective refresh partial is rendered again.
    // To do: detect which element is extactly being rendered and initialize the respective script only. So we don't run it on every selective refresh content rendered.
    var flag = false;
    wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
      if (!flag) {
        // Header Search
        botiga.headerSearch.init();

        // Navigation
        setTimeout(function () {
          botiga.navigation.init();
        }, 500);
        setTimeout(function () {
          bhfb_hide_empty_rows();
        }, 200);
        flag = true;
        setTimeout(function () {
          flag = false;
        }, 500);
      }
    });
    bhfb_hide_empty_rows();
  });

  /**
   * Hide header builder empty rows
   */
  function bhfb_hide_empty_rows() {
    $('.bhfb-row').each(function () {
      if ($(this).hasClass('bhfb-is-row-empty')) {
        $(this).parent().parent().addClass('bt-d-none');
      } else {
        $(this).parent().parent().removeClass('bt-d-none');
      }
    });
  }

  // CSS
  var css = {
    // Header Rows Border
    'botiga_header_row__above_header_row_border_bottom_desktop': {
      'selector': '.bhfb-above_header_row',
      'prop': 'border-bottom-width',
      'unit': 'px'
    },
    'botiga_header_row__main_header_row_border_bottom_desktop': {
      'selector': '.bhfb-main_header_row',
      'prop': 'border-bottom-width',
      'unit': 'px'
    },
    'botiga_header_row__below_header_row_border_bottom_desktop': {
      'selector': '.bhfb-below_header_row',
      'prop': 'border-bottom-width',
      'unit': 'px'
    },
    // Footer Rows Border
    'botiga_footer_row__above_footer_row_border_top_desktop': {
      'selector': '.bhfb-above_footer_row',
      'prop': 'border-top-width',
      'unit': 'px'
    },
    'botiga_footer_row__main_footer_row_border_top_desktop': {
      'selector': '.bhfb-main_footer_row',
      'prop': 'border-top-width',
      'unit': 'px'
    },
    'botiga_footer_row__below_footer_row_border_top_desktop': {
      'selector': '.bhfb-below_footer_row',
      'prop': 'border-top-width',
      'unit': 'px'
    },
    // Mobile Offcanvas Wrapper
    'bhfb_mobile_offcanvas_padding': {
      'selector': '.bhfb-mobile_offcanvas',
      'prop': 'padding',
      'unit': 'px'
    },
    'mobile_menu_elements_spacing': {
      'selector': '.bhfb-mobile_offcanvas .bhfb-builder-item + .bhfb-builder-item',
      'prop': 'margin-top',
      'unit': 'px'
    },
    'bhfb_mobile_offcanvas_close_offset': {
      'selector': '.bhfb-mobile_offcanvas .mobile-menu-close',
      'prop': ['top', 'right'],
      'unit': 'px'
    },
    // Mobile Offcanvas Menu
    'link_separator_color': {
      'selector': '.botiga-offcanvas-menu .botiga-dropdown ul li',
      'prop': 'border-bottom-color'
    },
    // Contact Info Component.
    'bhfb_contact_info_display_inline': {
      'selector': '.bhfb-component-contact_info .header-contact',
      'toggleClass': 'header-contact-inline'
    }
  };
  $.each(css, function (option, props) {
    wp.customize(option, function (value) {
      value.bind(function (to) {
        if (typeof props.cssvariable !== 'undefined') {
          document.querySelector(":root").style.setProperty('--' + option, to + 'px');
          return false;
        }
        if (typeof props.toggleClass !== 'undefined') {
          $(props.selector).toggleClass(props.toggleClass);
          return false;
        }
        if (typeof props.addClass !== 'undefined') {
          // Remove Class.
          if (typeof props.removeClass !== 'undefined') {
            if (typeof props.removeClass === 'string') {
              $(props.selector).removeClass(props.removeClass);
            } else {
              $.each(props.removeClass, function (index, value) {
                $(props.selector).removeClass(value);
              });
            }
          }

          // Add class.
          $(props.selector).addClass(props.addClass + to);
          return false;
        }
        $('head').find('#botiga-customizer-styles-' + option).remove();
        var output = '';
        if (typeof props.prop === 'string') {
          output += props.selector + ' { ' + props.prop + ':' + to + (props.unit ? props.unit : '') + '; }';
        } else {
          $.each(props.prop, function (key, cssProp) {
            output += props.selector + '{ ' + cssProp + ': ' + to + (props.unit ? props.unit : '') + '; }';
          });
        }
        $('head').append('<style id="botiga-customizer-styles-' + option + '">' + output + '</style>');
      });
    });
  });

  // Responsive CSS
  var $devices = {
      "desktop": "(min-width: 992px)",
      "tablet": "(min-width: 576px) and (max-width: 991px)",
      "mobile": "(max-width: 575px)"
    },
    resp_css = {
      // Header Rows.
      'botiga_header_row__above_header_row_height': {
        'selector': '.bhfb-above_header_row',
        'prop': 'min-height',
        'unit': 'px'
      },
      'botiga_header_row__main_header_row_height': {
        'selector': '.bhfb-main_header_row',
        'prop': 'min-height',
        'unit': 'px'
      },
      'botiga_header_row__below_header_row_height': {
        'selector': '.bhfb-below_header_row',
        'prop': 'min-height',
        'unit': 'px'
      },
      // Footer Rows.
      'botiga_footer_row__above_footer_row_height': {
        'selector': '.bhfb-above_footer_row',
        'prop': 'min-height',
        'unit': 'px'
      },
      'botiga_footer_row__main_footer_row_height': {
        'selector': '.bhfb-main_footer_row',
        'prop': 'min-height',
        'unit': 'px'
      },
      'botiga_footer_row__below_footer_row_height': {
        'selector': '.bhfb-below_footer_row',
        'prop': 'min-height',
        'unit': 'px'
      },
      // Site Logo Size.
      'site_logo_size': {
        'selector': '.custom-logo-link img',
        'prop': 'width',
        'unit': 'px'
      },
      // Site Logo Text Alignment.
      'botiga_section_hb_component__logo_text_alignment': {
        'selector': '.bhfb.bhfb-header .bhfb-component-logo',
        'prop': 'text-align'
      },
      // Header HTML Component Text Alignment.
      'botiga_section_hb_component__html_text_align': {
        'selector': '.bhfb.bhfb-header .bhfb-component-html',
        'prop': 'text-align'
      },
      // Header HTML 2 Component Text Alignment.
      'botiga_section_hb_component__html2_text_align': {
        'selector': '.bhfb.bhfb-header .bhfb-component-html2',
        'prop': 'text-align'
      },
      // Header Shortcode Component Text Alignment.
      'botiga_section_hb_component__shortcode_text_align': {
        'selector': '.bhfb.bhfb-header .bhfb-component-shortcode',
        'prop': 'text-align'
      },
      // Header Shortcode 2 Component Text Alignment.
      'botiga_section_hb_component__shortcode2_text_align': {
        'selector': '.bhfb.bhfb-header .bhfb-component-shortcode2',
        'prop': 'text-align'
      },
      // Header Shortcode 3 Component Text Alignment.
      'botiga_section_hb_component__shortcode3_text_align': {
        'selector': '.bhfb.bhfb-header .bhfb-component-shortcode3',
        'prop': 'text-align'
      },
      // Footer HTML Component Text Alignment.
      'botiga_section_fb_component__html_text_align': {
        'selector': '.bhfb.bhfb-footer .bhfb-component-html',
        'prop': 'text-align'
      },
      // Footer HTML 2 Component Text Alignment.
      'botiga_section_fb_component__html2_text_align': {
        'selector': '.bhfb.bhfb-footer .bhfb-component-html2',
        'prop': 'text-align'
      },
      // Footer Shortcode Component Text Alignment.
      'botiga_section_fb_component__shortcode_text_align': {
        'selector': '.bhfb.bhfb-footer .bhfb-component-shortcode',
        'prop': 'text-align'
      }
    };

  // Columns.
  var builders = ['header', 'footer'],
    rows = ['above', 'main', 'below'],
    opts = ['vertical_alignment', 'inner_layout', 'horizontal_alignment', 'elements_spacing'];
  for (var i = 1; i <= 6; i++) {
    var _iterator = _createForOfIteratorHelper(opts),
      _step;
    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var opt = _step.value;
        var _iterator2 = _createForOfIteratorHelper(builders),
          _step2;
        try {
          for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
            var builder = _step2.value;
            var _iterator3 = _createForOfIteratorHelper(rows),
              _step3;
            try {
              for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
                var row = _step3.value;
                var optionID = 'botiga_' + builder + '_row__' + row + '_' + builder + '_row_column' + i + '_' + opt,
                  columnSelector = '.bhfb-' + builder + ' .bhfb-' + row + '_' + builder + '_row .bhfb-column-' + i;
                if (opt.indexOf('elements_spacing') !== -1) {
                  columnSelector += ' .bhfb-builder-item + .bhfb-builder-item';
                }
                resp_css[optionID] = {
                  'selector': columnSelector,
                  'prop': getCSSProp(optionID)
                };
                if (opt.indexOf('elements_spacing') !== -1) {
                  resp_css[optionID].unit = 'px';
                }
              }
            } catch (err) {
              _iterator3.e(err);
            } finally {
              _iterator3.f();
            }
          }
        } catch (err) {
          _iterator2.e(err);
        } finally {
          _iterator2.f();
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  }
  $.each(resp_css, function (option, css_data) {
    $.each($devices, function (device, mediaSize) {
      wp.customize(option + '_' + device, function (value) {
        value.bind(function (to) {
          var unit = typeof css_data.unit !== 'undefined' ? css_data.unit : '',
            css_prop = '',
            extra_css = '';

          // Convert alignments to flex-alignments.
          switch (to) {
            case 'top':
            case 'start':
              to = 'flex-start';
              break;
            case 'middle':
              to = 'center';
              break;
            case 'bottom':
            case 'end':
              to = 'flex-end';
              break;
            case 'stack':
              to = 'column';
              break;
            case 'inline':
              to = 'row';
              break;
          }

          // Change 'prop' value according the direction and only when it's needed.
          if (option.indexOf('vertical_alignment') !== -1 || option.indexOf('horizontal_alignment') !== -1) {
            var columnDirection = $(css_data.selector).css('flex-direction');
            css_prop = css_data.prop;
            if (columnDirection === 'column') {
              if (css_prop === 'align-items') {
                css_prop = 'justify-content';
              } else if (css_prop === 'justify-content') {
                css_prop = 'align-items';
              }
            }
          }

          // Trigger change on vertical and horizontal settings to avoid conflicts. 
          if (option.indexOf('inner_layout') !== -1) {
            var _opts = ['vertical_alignment', 'horizontal_alignment'];
            var _loop = function _loop() {
              var opt = _opts2[_i];
              var optName = option.replace('inner_layout', opt + '_' + device),
                current_value = wp.customize(optName).get();
              wp.customize(optName).set('');
              setTimeout(function () {
                wp.customize(optName).set(current_value);
              }, 1);
            };
            for (var _i = 0, _opts2 = _opts; _i < _opts2.length; _i++) {
              _loop();
            }
          }
          if (option.indexOf('elements_spacing') !== -1) {
            var _columnDirection = $(css_data.selector).parent().css('flex-direction');
            css_prop = css_data.prop;
            if (_columnDirection === 'column') {
              if (css_prop === 'margin-left') {
                css_prop = 'margin-top';
                extra_css = 'margin-left: 0;';
              }
            } else {
              extra_css = 'margin-top: 0;';
            }
          }
          $('head').find('#botiga-customizer-styles-' + option + '_' + device).remove();
          var output = '@media ' + mediaSize + ' {' + css_data.selector + ' { ' + (css_prop !== '' ? css_prop : css_data.prop) + ':' + to + unit + ';' + extra_css + ' } }';
          $('head').append('<style id="botiga-customizer-styles-' + option + '_' + device + '">' + output + '</style>');
        });
      });
    });
  });

  /**
   * Get column number from the option name.
   */
  function getColumnNumber(optionID) {
    if (optionID.indexOf('column1') !== -1) {
      return 1;
    }
    if (optionID.indexOf('column2') !== -1) {
      return 2;
    }
    if (optionID.indexOf('column3') !== -1) {
      return 3;
    }
    if (optionID.indexOf('column4') !== -1) {
      return 4;
    }
    if (optionID.indexOf('column5') !== -1) {
      return 5;
    }
    if (optionID.indexOf('column6') !== -1) {
      return 6;
    }
  }

  /**
   * Get CSS property from the option name.
   */
  function getCSSProp(optionID) {
    if (optionID.indexOf('vertical_alignment') !== -1) {
      return 'align-items';
    }
    if (optionID.indexOf('inner_layout') !== -1) {
      return 'flex-direction';
    }
    if (optionID.indexOf('horizontal_alignment') !== -1) {
      return 'justify-content';
    }
    if (optionID.indexOf('elements_spacing') !== -1) {
      return 'margin-left';
    }
  }
})(jQuery);