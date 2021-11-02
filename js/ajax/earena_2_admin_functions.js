/**
 * admin_functions
 */

jQuery('document').ready(function($) {
  //SEARCH USERS
  const adminSearchUsers = function () {
    var reply = $('.search__result', 'body');

      $("input[name=search-field]").bind('change click keyup', function () {
        var search = $("input[name=search-field]").val();
          //console.log(search.length);
          if (search.length < 3) {
              reply.html('');
              return;
          }
          event.preventDefault();
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
      });
  };

  adminSearchUsers();
});
