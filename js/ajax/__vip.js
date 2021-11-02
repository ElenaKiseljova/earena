(function ($) {
  $('.byeVIP').on('click', function (e) {
      e.preventDefault();

      // Очистка при перезапуске
      $('.section__result--vip').html('');

      let formData = {
        action: 'getVIP',
        month: $(this).data('month'),
        security: earena_2_ajax.nonce
      };

      $.ajax({
        url: earena_2_ajax.url,
        data: formData,
        type: 'POST',
        beforeSend: (response) => {
          console.log(response.readyState);
        },
        success: (response) => {
          const resp = JSON.parse(response);
          $('.section__result--vip').html(resp['message']);

          setTimeout(function () {
              $('.section__result--vip').html('');

              if (resp['success'] === 1) {
                // globalThrottlingg
                $('body').trigger('vip-update');

                // $('.update-container').html(resp['data']);
              }
          }, 2000);

          console.log('success', resp);
        },
        error: (response) => {
          console.log('error', response);
        }
      });
  });
})(jQuery);
