"use strict";

/**
 * Header/Footer Update.
 */
(function ($) {
  'use strict';

  $(document).on('click', '.botiga-update-hf', function (e) {
    e.preventDefault();

    if (confirm(botigaadm.hfUpdate.confirmMessage)) {
      $.ajax({
        type: 'post',
        url: ajaxurl,
        data: {
          action: 'botiga_hf_update_notice_1_1_9_callback',
          nonce: $(this).data('nonce')
        },
        success: function success(response) {
          if (response.success) {
            window.location.reload();
          } else {
            alert(botigaadm.hfUpdate.errorMessage);
          }
        }
      });
    }
  });
})(jQuery);
/**
 * Header/Footer Update Dismiss.
 */


(function ($) {
  'use strict';

  $(document).on('click', '.botiga-update-hf-dismiss', function (e) {
    e.preventDefault();

    if (confirm(botigaadm.hfUpdateDimiss.confirmMessage)) {
      $.ajax({
        type: 'post',
        url: ajaxurl,
        data: {
          action: 'botiga_hf_update_dismiss_notice_1_1_9_callback',
          nonce: $(this).data('nonce')
        },
        success: function success(response) {
          if (response.success) {
            window.location.reload();
          } else {
            alert(botigaadm.hfUpdateDimiss.errorMessage);
          }
        }
      });
    }
  });
})(jQuery);