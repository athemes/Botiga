"use strict";

/* Typography */
jQuery(document).ready(function ($) {
  "use strict";

  $('.google-fonts-list').each(function (i, obj) {
    if (!$(this).hasClass('select2-hidden-accessible')) {
      $(this).select2();
    }
  });
  $('.google-fonts-list').on('change', function () {
    var elementRegularWeight = $(this).parent().parent().find('.google-fonts-regularweight-style');
    var selectedFont = $(this).val();
    var customizerControlName = $(this).attr('control-name'); // Clear Weight/Style dropdowns

    elementRegularWeight.empty(); // Make sure Italic & Bold dropdowns are enabled
    // Get the Google Fonts control object

    var bodyfontcontrol = _wpCustomizeSettings.controls[customizerControlName]; // Find the index of the selected font

    var indexes = $.map(bodyfontcontrol.botigafontslist, function (obj, index) {
      if (obj.family === selectedFont) {
        return index;
      }
    });
    var index = indexes[0]; // For the selected Google font show the available weight/style variants

    $.each(bodyfontcontrol.botigafontslist[index].variants, function (val, text) {
      elementRegularWeight.append($('<option></option>').val(text).html(text)); //Set default value

      if ($(elementRegularWeight).find('option[value="regular"]').length > 0) {
        $(elementRegularWeight).val('regular');
      } else if ($(elementRegularWeight).find('option[value="400"]').length > 0) {
        $(elementRegularWeight).val('400');
      } else if ($(elementRegularWeight).find('option[value="300"]').length > 0) {
        $(elementRegularWeight).val('300');
      }
    }); // Update the font category based on the selected font

    $(this).parent().parent().find('.google-fonts-category').val(bodyfontcontrol.botigafontslist[index].category);
    botigaGetAllSelects($(this).parent().parent().parent().parent());
  });
  $('.google_fonts_select_control select').on('change', function () {
    botigaGetAllSelects($(this).parent().parent().parent().parent());
  });

  function botigaGetAllSelects($element) {
    var selectedFont = {
      font: $element.find('.google-fonts-list').val(),
      regularweight: $element.find('.google-fonts-regularweight-style').val(),
      category: $element.find('.google-fonts-category').val()
    }; // Important! Make sure to trigger change event so Customizer knows it has to save the field

    $element.find('.customize-control-google-font-selection').val(JSON.stringify(selectedFont)).trigger('change');
  }
});
jQuery(document).ready(function ($) {
  "use strict";

  $('.botiga-devices-preview').find('button').on('click', function (event) {
    if ($(this).hasClass('preview-desktop')) {
      $('.botiga-devices-preview').find('.preview-desktop').addClass('active');
      $('.botiga-devices-preview').find('.preview-tablet').removeClass('active');
      $('.botiga-devices-preview').find('.preview-mobile').removeClass('active');
      $('.font-size-desktop').addClass('active');
      $('.font-size-tablet').removeClass('active');
      $('.font-size-mobile').removeClass('active');
      $('.wp-full-overlay-footer .devices button[data-device="desktop"]').trigger('click');
    } else if ($(this).hasClass('preview-tablet')) {
      $('.botiga-devices-preview').find('.preview-tablet').addClass('active');
      $('.botiga-devices-preview').find('.preview-desktop').removeClass('active');
      $('.botiga-devices-preview').find('.preview-mobile').removeClass('active');
      $('.font-size-desktop').removeClass('active');
      $('.font-size-tablet').addClass('active');
      $('.font-size-mobile').removeClass('active');
      $('.wp-full-overlay-footer .devices button[data-device="tablet"]').trigger('click');
    } else {
      $('.botiga-devices-preview').find('.preview-mobile').addClass('active');
      $('.botiga-devices-preview').find('.preview-desktop').removeClass('active');
      $('.botiga-devices-preview').find('.preview-tablet').removeClass('active');
      $('.font-size-desktop').removeClass('active');
      $('.font-size-tablet').removeClass('active');
      $('.font-size-mobile').addClass('active');
      $('.wp-full-overlay-footer .devices button[data-device="mobile"]').trigger('click');
    }
  });
  $(' .wp-full-overlay-footer .devices button ').on('click', function () {
    var device = $(this).attr('data-device');
    $('.botiga-devices-preview').find('.preview-' + device).trigger('click');
  });
});
/**
 * Repeater
 */

jQuery(document).ready(function ($) {
  "use strict"; // Update the values for all our input fields and initialise the sortable repeater

  $('.botiga-sortable_repeater_control').each(function () {
    // If there is an existing customizer value, populate our rows
    var defaultValuesArray = $(this).find('.customize-control-sortable-repeater').val().split(',');
    var numRepeaterItems = defaultValuesArray.length;

    if (numRepeaterItems > 0) {
      // Add the first item to our existing input field
      $(this).find('.repeater-input').val(defaultValuesArray[0]); // Create a new row for each new value

      if (numRepeaterItems > 1) {
        var i;

        for (i = 1; i < numRepeaterItems; ++i) {
          botigaAppendRow($(this), defaultValuesArray[i]);
        }
      }
    }
  }); // Make our Repeater fields sortable

  $(this).find('.botiga-sortable_repeater.sortable').sortable({
    update: function update(event, ui) {
      botigaGetAllInputs($(this).parent());
    }
  }); // Remove item starting from it's parent element

  $('.botiga-sortable_repeater.sortable').on('click', '.customize-control-sortable-repeater-delete', function (event) {
    event.preventDefault();
    var numItems = $(this).parent().parent().find('.repeater').length;

    if (numItems > 1) {
      $(this).parent().slideUp('fast', function () {
        var parentContainer = $(this).parent().parent();
        $(this).remove();
        botigaGetAllInputs(parentContainer);
      });
    } else {
      $(this).parent().find('.repeater-input').val('');
      botigaGetAllInputs($(this).parent().parent().parent());
    }
  }); // Add new item

  $('.customize-control-sortable-repeater-add').click(function (event) {
    event.preventDefault();
    botigaAppendRow($(this).parent());
    botigaGetAllInputs($(this).parent());
  }); // Refresh our hidden field if any fields change

  $('.botiga-sortable_repeater.sortable').change(function () {
    botigaGetAllInputs($(this).parent());
  }); // Add https:// to the start of the URL if it doesn't have it

  $('.botiga-sortable_repeater.sortable').on('blur', '.repeater-input', function () {
    var url = $(this);
    var val = url.val();

    if (val && !val.match(/^.+:\/\/.*/)) {
      // Important! Make sure to trigger change event so Customizer knows it has to save the field
      url.val('https://' + val).trigger('change');
    }
  }); // Append a new row to our list of elements

  function botigaAppendRow($element) {
    var defaultValue = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '';
    var newRow = '<div class="repeater" style="display:none"><input type="text" value="' + defaultValue + '" class="repeater-input" placeholder="https://" /><span class="dashicons dashicons-menu"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a></div>';
    $element.find('.sortable').append(newRow);
    $element.find('.sortable').find('.repeater:last').slideDown('slow', function () {
      $(this).find('input').focus();
    });
  } // Get the values from the repeater input fields and add to our hidden field


  function botigaGetAllInputs($element) {
    var inputValues = $element.find('.repeater-input').map(function () {
      return $(this).val();
    }).toArray(); // Add all the values from our repeater fields to the hidden field (which is the one that actually gets saved)

    $element.find('.customize-control-sortable-repeater').val(inputValues); // Important! Make sure to trigger change event so Customizer knows it has to save the field

    $element.find('.customize-control-sortable-repeater').trigger('change');
  }
});
/**
 * Alpha color picker
 */

jQuery(document).ready(function ($) {
  $('.alpha-color-control').each(function () {
    // Scope the vars.
    var $control, startingColor, paletteInput, showOpacity, defaultColor, palette, colorPickerOptions, $container, $alphaSlider, alphaVal, sliderOptions; // Store the control instance.

    $control = $(this); // Get a clean starting value for the option.

    startingColor = $control.val().replace(/\s+/g, ''); // Get some data off the control.

    paletteInput = $control.attr('data-palette');
    showOpacity = $control.attr('data-show-opacity');
    defaultColor = $control.attr('data-default-color'); // Process the palette.

    if (paletteInput.indexOf('|') !== -1) {
      palette = paletteInput.split('|');
    } else if ('false' == paletteInput) {
      palette = false;
    } else {
      palette = true;
    } // Set up the options that we'll pass to wpColorPicker().


    colorPickerOptions = {
      change: function change(event, ui) {
        var key, value, alpha, $transparency;
        key = $control.attr('data-customize-setting-link');
        value = $control.wpColorPicker('color'); // Set the opacity value on the slider handle when the default color button is clicked.

        if (defaultColor == value) {
          alpha = acp_get_alpha_value_from_color(value);
          $alphaSlider.find('.ui-slider-handle').text(alpha);
        } // Send ajax request to wp.customize to trigger the Save action.


        wp.customize(key, function (obj) {
          obj.set(value);
        });
        $transparency = $container.find('.transparency'); // Always show the background color of the opacity slider at 100% opacity.

        $transparency.css('background-color', ui.color.toString('no-alpha'));
      },
      palettes: palette // Use the passed in palette.

    }; // Create the colorpicker.

    $control.wpColorPicker(colorPickerOptions);
    $container = $control.parents('.wp-picker-container:first'); // Insert our opacity slider.

    $('<div class="alpha-color-picker-container">' + '<div class="min-click-zone click-zone"></div>' + '<div class="max-click-zone click-zone"></div>' + '<div class="alpha-slider"></div>' + '<div class="transparency"></div>' + '</div>').appendTo($container.find('.wp-picker-holder'));
    $alphaSlider = $container.find('.alpha-slider'); // If starting value is in format RGBa, grab the alpha channel.

    alphaVal = acp_get_alpha_value_from_color(startingColor); // Set up jQuery UI slider() options.

    sliderOptions = {
      create: function create(event, ui) {
        var value = $(this).slider('value'); // Set up initial values.

        $(this).find('.ui-slider-handle').text(value);
        $(this).siblings('.transparency ').css('background-color', startingColor);
      },
      value: alphaVal,
      range: 'max',
      step: 1,
      min: 0,
      max: 100,
      animate: 300
    }; // Initialize jQuery UI slider with our options.

    $alphaSlider.slider(sliderOptions); // Maybe show the opacity on the handle.

    if ('true' == showOpacity) {
      $alphaSlider.find('.ui-slider-handle').addClass('show-opacity');
    } // Bind event handlers for the click zones.


    $container.find('.min-click-zone').on('click', function () {
      acp_update_alpha_value_on_color_control(0, $control, $alphaSlider, true);
    });
    $container.find('.max-click-zone').on('click', function () {
      acp_update_alpha_value_on_color_control(100, $control, $alphaSlider, true);
    }); // Bind event handler for clicking on a palette color.

    $container.find('.iris-palette').on('click', function () {
      var color, alpha;
      color = $(this).css('background-color');
      alpha = acp_get_alpha_value_from_color(color);
      acp_update_alpha_value_on_alpha_slider(alpha, $alphaSlider); // Sometimes Iris doesn't set a perfect background-color on the palette,
      // for example rgba(20, 80, 100, 0.3) becomes rgba(20, 80, 100, 0.298039).
      // To compensante for this we round the opacity value on RGBa colors here
      // and save it a second time to the color picker object.

      if (alpha != 100) {
        color = color.replace(/[^,]+(?=\))/, (alpha / 100).toFixed(2));
      }

      $control.wpColorPicker('color', color);
    }); // Bind event handler for clicking on the 'Clear' button.

    $container.find('.button.wp-picker-clear').on('click', function () {
      var key = $control.attr('data-customize-setting-link'); // The #fff color is delibrate here. This sets the color picker to white instead of the
      // defult black, which puts the color picker in a better place to visually represent empty.

      $control.wpColorPicker('color', '#ffffff'); // Set the actual option value to empty string.

      wp.customize(key, function (obj) {
        obj.set('');
      });
      acp_update_alpha_value_on_alpha_slider(100, $alphaSlider);
    }); // Bind event handler for clicking on the 'Default' button.

    $container.find('.button.wp-picker-default').on('click', function () {
      var alpha = acp_get_alpha_value_from_color(defaultColor);
      acp_update_alpha_value_on_alpha_slider(alpha, $alphaSlider);
    }); // Bind event handler for typing or pasting into the input.

    $control.on('input', function () {
      var value = $(this).val();
      var alpha = acp_get_alpha_value_from_color(value);
      acp_update_alpha_value_on_alpha_slider(alpha, $alphaSlider);
    }); // Update all the things when the slider is interacted with.

    $alphaSlider.slider().on('slide', function (event, ui) {
      var alpha = parseFloat(ui.value) / 100.0;
      acp_update_alpha_value_on_color_control(alpha, $control, $alphaSlider, false); // Change value shown on slider handle.

      $(this).find('.ui-slider-handle').text(ui.value);
    });
  });
  /**
   * Override the stock color.js toString() method to add support for outputting RGBa or Hex.
   */

  Color.prototype.toString = function (flag) {
    // If our no-alpha flag has been passed in, output RGBa value with 100% opacity.
    // This is used to set the background color on the opacity slider during color changes.
    if ('no-alpha' == flag) {
      return this.toCSS('rgba', '1').replace(/\s+/g, '');
    } // If we have a proper opacity value, output RGBa.


    if (1 > this._alpha) {
      return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
    } // Proceed with stock color.js hex output.


    var hex = parseInt(this._color, 10).toString(16);

    if (this.error) {
      return '';
    }

    if (hex.length < 6) {
      for (var i = 6 - hex.length - 1; i >= 0; i--) {
        hex = '0' + hex;
      }
    }

    return '#' + hex;
  };
  /**
   * Given an RGBa, RGB, or hex color value, return the alpha channel value.
   */


  function acp_get_alpha_value_from_color(value) {
    var alphaVal; // Remove all spaces from the passed in value to help our RGBa regex.

    value = value.replace(/ /g, '');

    if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
      alphaVal = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]).toFixed(2) * 100;
      alphaVal = parseInt(alphaVal);
    } else {
      alphaVal = 100;
    }

    return alphaVal;
  }
  /**
   * Force update the alpha value of the color picker object and maybe the alpha slider.
   */


  function acp_update_alpha_value_on_color_control(alpha, $control, $alphaSlider, update_slider) {
    var iris, colorPicker, color;
    iris = $control.data('a8cIris');
    colorPicker = $control.data('wpWpColorPicker'); // Set the alpha value on the Iris object.

    iris._color._alpha = alpha; // Store the new color value.

    color = iris._color.toString(); // Set the value of the input.

    $control.val(color); // Update the background color of the color picker.

    colorPicker.toggler.css({
      'background-color': color
    }); // Maybe update the alpha slider itself.

    if (update_slider) {
      acp_update_alpha_value_on_alpha_slider(alpha, $alphaSlider);
    } // Update the color value of the color picker object.


    $control.wpColorPicker('color', color);
  }
  /**
   * Update the slider handle position and label.
   */


  function acp_update_alpha_value_on_alpha_slider(alpha, $alphaSlider) {
    $alphaSlider.slider('value', alpha);
    $alphaSlider.find('.ui-slider-handle').text(alpha.toString());
  }
});
/**
 * Tab control
 */

jQuery(document).ready(function ($) {
  "use strict";

  $('.customize-control-botiga-tab-control').each(function () {
    $(this).parent().find('li').not('.section-meta').not('.customize-control-botiga-tab-control').addClass('botiga-hide-control');
    var generals = $(this).find('.control-tab-general').data('connected');
    $.each(generals, function (i, v) {
      $(this).removeClass('botiga-hide-control'); //show
    });
    $(this).find('.control-tab').on('click', function () {
      var visibles = $(this).data('connected');
      $(this).addClass('active');
      $(this).siblings().removeClass('active');
      $(this).parent().parent().parent().find('li').not('.section-meta').not('.customize-control-botiga-tab-control').addClass('botiga-hide-control');
      $.each(visibles, function (i, v) {
        $(this).removeClass('botiga-hide-control'); //show
      });
    });
  });
});
/**
 * TinyMCE control
 */

jQuery(document).ready(function ($) {
  "use strict";

  $('.customize-control-tinymce-editor').each(function () {
    // Get the toolbar strings that were passed from the PHP Class
    var tinyMCEToolbar1String = _wpCustomizeSettings.controls[$(this).attr('id')].botigatb1;

    var tinyMCEToolbar2String = _wpCustomizeSettings.controls[$(this).attr('id')].botigatb2;

    var tinyMCEMediaButtons = _wpCustomizeSettings.controls[$(this).attr('id')].botigatmb;

    wp.editor.initialize($(this).attr('id'), {
      tinymce: {
        wpautop: true,
        toolbar1: tinyMCEToolbar1String,
        toolbar2: tinyMCEToolbar2String
      },
      quicktags: true,
      mediaButtons: true
    });
  });
  $(document).on('tinymce-editor-init', function (event, editor) {
    editor.on('change', function (e) {
      tinyMCE.triggerSave();
      $('#' + editor.id).trigger('change');
    });
  });
});
/**
 * Footer widget areas links
 */

jQuery(document).ready(function ($) {
  var footerCols = $('#customize-control-footer_widgets').find('input:checked');
  toggleLinks(footerCols);
  $('#customize-control-footer_widgets').find('input').change(function () {
    toggleLinks($(this));
  });

  function toggleLinks(el) {
    if ('col3' === $(el).val() || 'col3-bigleft' === $(el).val() || 'col3-bigright' === $(el).val()) {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2, .footer-widget-area-link-3').show();
      $('.footer-widget-area-link-4').hide();
    } else if ('col4' === $(el).val() || 'col4-bigleft' === $(el).val() || 'col4-bigright' === $(el).val()) {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2, .footer-widget-area-link-3, .footer-widget-area-link-4').show();
    } else if ('col2' === $(el).val() || 'col2-bigleft' === $(el).val() || 'col2-bigright' === $(el).val()) {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2').show();
      $('.footer-widget-area-link-4, .footer-widget-area-link-3').hide();
    } else if ('col1' === $(el).val()) {
      $('.footer-widget-area-link-1').show();
      $('.footer-widget-area-link-4, .footer-widget-area-link-2, .footer-widget-area-link-3').hide();
    } else {
      $('.footer-widget-area-link-1, .footer-widget-area-link-2, .footer-widget-area-link-3, .footer-widget-area-link-4').hide();
    }
  }
});
/**
 * Palettes
 */

wp.customize('color_palettes', function (control) {
  var palettes = jQuery('#customize-control-color_palettes').find('.radio-buttons').data('palettes');
  control.bind(function () {
    var palette = control.get(); //Color 1 Button color, Link color

    var elements1 = ['custom_color1', 'scrolltop_bg_color', 'button_background_color', 'button_border_color', 'color_link_default'];

    for (var _i = 0, _elements = elements1; _i < _elements.length; _i++) {
      var element = _elements[_i];
      wp.customize(element).set(palettes[palette][0]);
      jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', palettes[palette][0]);
    } //Color 2 Hover color for - Button, Headings, Titles, Text links, Nav links


    var elements2 = ['custom_color2', 'footer_widgets_links_hover_color', 'scrolltop_bg_color_hover', 'button_background_color_hover', 'button_border_color_hover', 'color_link_hover'];

    for (var _i2 = 0, _elements2 = elements2; _i2 < _elements2.length; _i2++) {
      var _element = _elements2[_i2];
      wp.customize(_element).set(palettes[palette][1]);
      jQuery('#customize-control-' + _element).find('.wp-color-result').css('background-color', palettes[palette][1]);
    } //Color 3 Heading (1-6), Small text, Nav links, Site title, 


    var elements3 = ['single_post_title_color', 'custom_color3', 'main_header_submenu_color', 'offcanvas_menu_color', 'mobile_header_color', 'footer_widgets_title_color', 'single_product_title_color', 'color_forms_text', 'shop_product_product_title', 'loop_post_meta_color', 'loop_post_title_color', 'main_header_color', 'site_title_color', 'site_description_color', 'color_heading_1', 'color_heading_2', 'color_heading_3', 'color_heading_4', 'color_heading_5', 'color_heading_6'];

    for (var _i3 = 0, _elements3 = elements3; _i3 < _elements3.length; _i3++) {
      var _element2 = _elements3[_i3];
      wp.customize(_element2).set(palettes[palette][2]);
      jQuery('#customize-control-' + _element2).find('.wp-color-result').css('background-color', palettes[palette][2]);
    } //Color 4 Paragraph, Paragraph small, Breadcrums, Icons


    var elements4 = ['custom_color4', 'footer_widgets_links_color', 'footer_widgets_text_color', 'color_body_text', 'footer_credits_text_color', 'color_forms_placeholder', 'topbar_color', 'main_header_bottom_color'];

    for (var _i4 = 0, _elements4 = elements4; _i4 < _elements4.length; _i4++) {
      var _element3 = _elements4[_i4];
      wp.customize(_element3).set(palettes[palette][3]);
      jQuery('#customize-control-' + _element3).find('.wp-color-result').css('background-color', palettes[palette][3]);
    } //Color 5 Input, tag borders


    var elements5 = ['custom_color5', 'color_forms_borders'];

    for (var _i5 = 0, _elements5 = elements5; _i5 < _elements5.length; _i5++) {
      var _element4 = _elements5[_i5];
      wp.customize(_element4).set(palettes[palette][4]);
      jQuery('#customize-control-' + _element4).find('.wp-color-result').css('background-color', palettes[palette][4]);
    } //Color 6 Footer background, Subtle backgrounds


    var elements6 = ['custom_color6', 'footer_widgets_background', 'footer_credits_background', 'content_cards_background'];

    for (var _i6 = 0, _elements6 = elements6; _i6 < _elements6.length; _i6++) {
      var _element5 = _elements6[_i6];
      wp.customize(_element5).set(palettes[palette][5]);
      jQuery('#customize-control-' + _element5).find('.wp-color-result').css('background-color', palettes[palette][5]);
    } //Color 7 Default background, Text on dark BG


    var elements7 = ['custom_color7', 'background_color', 'button_color', 'button_color_hover', 'scrolltop_color', 'scrolltop_color_hover', 'color_forms_background', 'topbar_background'];

    for (var _i7 = 0, _elements7 = elements7; _i7 < _elements7.length; _i7++) {
      var _element6 = _elements7[_i7];
      wp.customize(_element6).set(palettes[palette][6]);
      jQuery('#customize-control-' + _element6).find('.wp-color-result').css('background-color', palettes[palette][6]);
    } //Color 8 header background


    var elements8 = ['custom_color8', 'main_header_submenu_background', 'main_header_background', 'main_header_bottom_background', 'mobile_header_background', 'offcanvas_menu_background'];

    for (var _i8 = 0, _elements8 = elements8; _i8 < _elements8.length; _i8++) {
      var _element7 = _elements8[_i8];
      wp.customize(_element7).set(palettes[palette][7]);
      jQuery('#customize-control-' + _element7).find('.wp-color-result').css('background-color', palettes[palette][7]);
    }
  });
});
/**
 * Custom palette
 */

wp.customize.bind('ready', function () {
  wp.customize('custom_color1', function (control) {
    control.bind(function (value) {
      var elements1 = ['scrolltop_bg_color', 'button_background_color', 'button_border_color', 'color_link_default'];

      for (var _i9 = 0, _elements9 = elements1; _i9 < _elements9.length; _i9++) {
        var element = _elements9[_i9];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
  wp.customize('custom_color2', function (control) {
    control.bind(function (value) {
      var elements2 = ['footer_widgets_links_hover_color', 'scrolltop_bg_color_hover', 'button_background_color_hover', 'button_border_color_hover', 'color_link_hover'];

      for (var _i10 = 0, _elements10 = elements2; _i10 < _elements10.length; _i10++) {
        var element = _elements10[_i10];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
  wp.customize('custom_color3', function (control) {
    control.bind(function (value) {
      var elements3 = ['main_header_submenu_color', 'offcanvas_menu_color', 'mobile_header_color', 'footer_widgets_title_color', 'single_product_title_color', 'color_forms_text', 'shop_product_product_title', 'loop_post_meta_color', 'loop_post_title_color', 'main_header_color', 'site_title_color', 'site_description_color', 'color_heading_1', 'color_heading_2', 'color_heading_3', 'color_heading_4', 'color_heading_5', 'color_heading_6'];

      for (var _i11 = 0, _elements11 = elements3; _i11 < _elements11.length; _i11++) {
        var element = _elements11[_i11];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
  wp.customize('custom_color4', function (control) {
    control.bind(function (value) {
      var elements4 = ['footer_widgets_links_color', 'footer_widgets_text_color', 'color_body_text', 'footer_credits_text_color', 'color_forms_placeholder'];

      for (var _i12 = 0, _elements12 = elements4; _i12 < _elements12.length; _i12++) {
        var element = _elements12[_i12];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
  wp.customize('custom_color5', function (control) {
    control.bind(function (value) {
      var elements5 = ['color_forms_borders'];

      for (var _i13 = 0, _elements13 = elements5; _i13 < _elements13.length; _i13++) {
        var element = _elements13[_i13];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
  wp.customize('custom_color6', function (control) {
    control.bind(function (value) {
      var elements6 = ['footer_widgets_background', 'footer_credits_background', 'content_cards_background'];

      for (var _i14 = 0, _elements14 = elements6; _i14 < _elements14.length; _i14++) {
        var element = _elements14[_i14];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
  wp.customize('custom_color7', function (control) {
    control.bind(function (value) {
      var elements7 = ['background_color', 'button_color', 'button_color_hover', 'scrolltop_color', 'scrolltop_color_hover', 'color_forms_background'];

      for (var _i15 = 0, _elements15 = elements7; _i15 < _elements15.length; _i15++) {
        var element = _elements15[_i15];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
  wp.customize('custom_color8', function (control) {
    control.bind(function (value) {
      var elements8 = ['main_header_submenu_background', 'main_header_background', 'main_header_bottom_background', 'mobile_header_background', 'offcanvas_menu_background'];

      for (var _i16 = 0, _elements16 = elements8; _i16 < _elements16.length; _i16++) {
        var element = _elements16[_i16];
        wp.customize(element).set(value);
        jQuery('#customize-control-' + element).find('.wp-color-result').css('background-color', value);
      }
    });
  });
});
/* Non-refresh custom palette toggle */

wp.customize.bind('ready', function () {
  wp.customize.control('custom_palette', function (control) {
    var setting = wp.customize('custom_palette_toggle');
    setting.bind(function (value) {
      control.active.set(value);
    });
  });
});
/**
 * Move color picker text field in popup
 */

jQuery(document).ready(function ($) {
  $('.wp-picker-input-wrap').each(function () {
    $(this).prependTo($(this).next('.wp-picker-holder'));
  });
});
/**
 * Transform palettes radio into dropdown
 */

jQuery(document).ready(function ($) {
  var saved = $('.saved-palette');
  $('.saved-palette').on('click', function () {
    $('.palette-radio-buttons').toggleClass('open');
  });
  $('.palette-radio-buttons').find('.palette').on('click', function () {
    saved.empty();
    $('.palette-radio-buttons').removeClass('open');
    var clone = $(this).parent().clone();
    clone.unwrap().appendTo(saved).find('input').remove();
  });
});
/**
 * Accordion control
 */

(function ($) {
  var Botiga_Accordion = {
    init: function init() {
      this.firstTime = true;

      if (!this.initialized) {
        this.events();
      }

      this.initialized = true;
    },
    events: function events() {
      var self = this; // Toggle accordion

      $(document).on('click', '.botiga-accordion-title', function () {
        var $this = $(this);

        if ($(this).hasClass('expanded')) {
          self.showOrHide($(this), 'hide');
          $(this).removeClass('expanded').addClass('collapse');
          setTimeout(function () {
            $this.removeClass('collapse');
          }, 300);
        }

        if (!$(this).hasClass('collapse')) {
          // Open one accordion item per time 
          $('.botiga-accordion-item').addClass('botiga-accordion-hide');
          $('.botiga-accordion-title').removeClass('expanded'); // Show accordion content

          self.showOrHide($(this), 'show');
          $this.addClass('expanded');
        }
      }); // Mount the accordion when enter in the section (with accordions inside)
      // Also used to collapse all accordions when navigating between others tabs

      $(document).on('click', '.control-section', function (e) {
        var $section = $('.control-section.open');

        if (self.firstTime && $section.find('.botiga-accordion-title').length) {
          $section.find('.botiga-accordion-title').each(function () {
            if ($(this).data('start-after')) {
              $(this).closest('li').next().css('margin-top', '15px');
              $(this).closest('li').insertAfter($('#customize-control-' + $(this).data('start-after')));
            }

            self.showOrHide($(this), 'hide');
            $(this).removeClass('expanded');
            self.firstTime = false;
          });
        }
      }); // Reset the first time

      $(document).on('click', '.customize-section-back', function () {
        self.firstTime = true;
      });
      return this;
    },
    showOrHide: function showOrHide($this, status) {
      var current = '';
      current = $this.closest('.customize-control').next();
      var elements = [];

      if (current.attr('id') == 'customize-control-' + $this.data('until')) {
        elements.push(current[0].id);
      } else {
        while (current.attr('id') != 'customize-control-' + $this.data('until')) {
          elements.push(current[0].id);
          current = current.next();
        }
      }

      if (elements.length >= 1) {
        elements.push(current[0].id);
      }

      for (var i = 0; i < elements.length; i++) {
        // Identify accordion items
        $('#' + elements[i]).addClass('botiga-accordion-item active'); // Hide or show the accordion content

        if (status == 'hide') {
          $('#' + elements[i]).addClass('botiga-accordion-hide');
        } else {
          $('#' + elements[i]).removeClass('botiga-accordion-hide');
        } // Identify first accordion item


        if (i == 0) {
          $('#' + elements[i]).addClass('botiga-accordion-first-item');
        } // Identify last accordion item


        if (i == elements.length - 1 && elements.length > 1 || elements.length == 1) {
          $('#' + elements[i]).addClass('botiga-accordion-last-item');
        }
      }

      return this;
    }
  };
  $(document).ready(function ($) {
    Botiga_Accordion.init();
    $('.botiga-accordion-title, input').on('mouseover', function () {
      var $section = $('.control-section.open');

      if ($section.find('.botiga-accordion-title').length) {
        $section.find('.botiga-accordion-title').each(function () {
          if ($(this).data('start-after')) {
            $(this).closest('li').insertAfter($('#customize-control-' + $(this).data('start-after')));
          }
        });
      }
    });
  });
  wp.customize.bind('change', function () {
    setJsPriority();
  });
  wp.customize.bind('saved', function () {
    setJsPriority();
    setTimeout(function () {
      $('.botiga-accordion-title').each(function () {
        if ($(this).data('start-after')) {
          $(this).closest('li').insertAfter($('#customize-control-' + $(this).data('start-after')));
        }
      });
    }, 1500);
  });

  function setJsPriority() {
    var $section = $('.control-section.open');

    if ($section.find('.botiga-accordion-title').length) {
      $section.find('.botiga-accordion-title').each(function () {
        if ($(this).data('set-js-priority')) {
          wp.customize.control($(this).data('option-name')).priority($(this).data('set-js-priority'));
        }
      });
    }
  }
})(jQuery);