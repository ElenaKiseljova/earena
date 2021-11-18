/**
 * Admin_functions
 */

jQuery('document').ready(function($) {
  const {__, _x, _n, _nx} = wp.i18n;

  //SEARCH USERS
  let searchTimeout;
  const adminSearchUsers = function () {
    var reply = $('.search__result', 'body');

      $("input[name=search-field]").bind('change keyup', function () {
        var search = $("input[name=search-field]").val();
          //console.log(search.length);
          if (search.length < 3) {
              reply.html('');
              return;
          }
          event.preventDefault();
          if (searchTimeout) {
            clearTimeout(searchTimeout);
          }

          searchTimeout = setTimeout(function () {
            var data = {
                'action': 'earena_2_get_users',
                'security': earena_2_ajax.nonce,
                'search': search,
            };
            reply.html('<span class="search__text">' + __('Загрузка...', 'earena_js') + '</span>');
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                reply.html('');
                if (response.success == 1) {
                    //console.log('ea_get_users success');
                    reply.html(response.content);
                } else {
                    reply.html('<span class="search__text search__text--error">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
                    //console.log('ea_get_users NOT success');
                }
            });
          }, 300);
      });
  };

  adminSearchUsers();

  //TIME TOUR CALCULATE
  const adminCalculateTimeTour = function () {
    $.fn.sum = function () {
      var sum = 0
      $(this).each(function (index, element) {
        if ($(element).val() != '')
          sum += parseFloat($(element).val())
      })
      return sum
    }

    $('.js_day1, .js_hour1, .js_minutes1').keyup(function () {
      var value1 = $('.js_day1').sum()
      var value3 = $('.js_hour1').sum()
      var value5 = $('.js_minutes1').sum()

      if (value5 >= 60) {
        var value3 = value3 + parseInt((value5 / 60), 10)
        var value5 = value5 % 60
      }

      if (value3 >= 24) {
        var value1 = value1 + parseInt((value3 / 24), 10)
        var value3 = value3 % 24
      }

      $('.js_day1_main').text(value1)
      $('.js_hour1_main').text(value3)
      $('.js_minutes1_main').text(value5)
    })
  };

  adminCalculateTimeTour();
});
