(function ($) {
  $('.byeVIP').on('click', function (e) {
      e.preventDefault();

      // Очистка при перезапуске
      $('.section__result--vip').html('');

      $.post(
          earena_2_ajax.url,
          {
              action: 'getVIP',
              month: $(this).data('month'),
              security: earena_2_ajax.nonce
          },
          function (response) {
              const resp = JSON.parse(response);
              if (resp['success'] == 1) {
                  $('.section__result--vip').html(resp['message']);
                  //$('.section__result-date--vip').html(resp['date']);
                  setTimeout(function () {
                      // $('#modalVIP').modal('hide');
                      $('.section__result--vip').html('');

                      // globalThrottlingg
                      $('body').trigger('vip-update');

                      // $('.update-container').html(resp['data']);
                  }, 2000);
              } else {
                  $('.section__result-text--vip').html(resp['message']);
              }
          }
      )
  });
})(jQuery);
