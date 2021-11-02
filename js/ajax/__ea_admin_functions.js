/**
 * admin_functions
 */
//console.log('ea_admin_functions begin OK');

jQuery('document').ready(function($) {
    const {__, _x, _n, _nx} = wp.i18n;
    const reload = function () {
//console.log ('reload');
        //location = location;
        location.reload();
//https://www.phpied.com/files/location-location/location-location.html
    };

//ADD PLAYER TOURNAMENT
    const adminAddTournamentPlayer = function () {
        $('body').on('click', '#addPlayer button.button-purple.button-submit', function () {
            event.preventDefault();
//console.log('click');
            if ($('#addPlayer button.button-purple.button-submit').prop('disabled') == true) {
//console.log('anti-click');
                return;
            }
//console.log('2click');

            $('#addPlayer button.button-purple.button-submit').addClass('opacity_5');
            $('#addPlayer button.button-purple.button-submit').prop('disabled', true);
            setTimeout(function () {
                $('#addPlayer button.button-purple.button-submit').removeClass('opacity_5');
                $('#addPlayer button.button-purple.button-submit').prop('disabled', false);
            }, 5000);
//console.log ($(this).data('id'));
            var user_id = $('#addPlayer').find('input[name=id_player]').val();
            var data = {
                'action': 'add_player_tournament',
                'security': ea_functions_object.nonce,
                'id': $(this).data('id'),
                'user_id': user_id,
            };
//console.log(data);
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
//console.log(response);
//			$('#addPlayer .modal-body').html(response.content);
                if (response.content == 1) {
                    $('#addPlayer .status-ap').html(__('Вы успешно зарегистрировали игрока с ID ', 'earena_js') + user_id + __(' в турнире.', 'earena_js'));
                    $('body').trigger('tournament-update');
                } else if (response.content == -3) {
                    $('#addPlayer .status-ap').html(__('ОШИБКА! Пользователь не найден.', 'earena_js'));
                } else if (response.content == -1) {
                    $('#addPlayer .status-ap').html(__('ОШИБКА! Не получилось списать средства.', 'earena_js'));
                } else if (response.content == 0) {
                    $('#addPlayer .status-ap').html(__('ОШИБКА! Обновите страницу.', 'earena_js'));
                } else {
                    $('#addPlayer .status-ap').html(response.content);
                }
            });
        });
    };

//SEND RESULT
//     const adminSendMatchResult = function () {
//         // ссылка на файл AJAX  обработчик
//         var ajaxurl = ea_functions_object.url;
//         var nonce = ea_functions_object.nonce;
//
//         var files; // переменная. будет содержать данные файлов
//
//         // заполняем переменную данными, при изменении значения поля file
//         const adminUpdateFileInputValue = function () {
// //console.log(1);
// //files=null;
// //console.log(2);
//             let $fileInput = $('input[type=file]', 'body');
//             $fileInput.on('change', function () {
//                 files = this.files;
//             });
//         };
//         adminUpdateFileInputValue();
//         $('body').on('match-updated', adminUpdateFileInputValue);
// //$('body').on('click', '.admin-match-results ul.menu-tab li a', adminUpdateFileInputValue);
//
//
//         //ORDINARY MATCH
//         $('body').on('click', '#send-result-match, #resend-result-match, #confirm-result-match', function (event) {
// //console.log(files);
//             var score1 = $(this).parent().find('input[name=score1]').val();
//             var score2 = $(this).parent().find('input[name=score2]').val();
//             var player = $(this).parent().find('input[name=player]').val();
//             var reply = $(this).parent().find('.ajax-reply');
// //console.log(player);
//             event.stopPropagation(); // остановка всех текущих JS событий
//             event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега
//
//             if (!isInteger(score1) || !isInteger(score2)) {
//                 reply.html('<span style="color:red;">' + __('Укажите счёт', 'earena_js') + '</span>');
//                 return;
//             }
//             // создадим данные файлов в подходящем для отправки формате
//             var data = new FormData();
//
//             $.each(files, function (key, value) {
//                 data.append(key, value);
//             });
//
//             // добавим переменную идентификатор запроса
//             data.append('action', 'ajax_match_results_and_fileload');
//             data.append('security', nonce);
//             data.append('score1', score1);
//             data.append('score2', score2);
//             data.append('player', player);
//             data.append('id', $('#send-result-match, #resend-result-match, #confirm-result-match', 'body').data('id'));
//
//
//             // AJAX запрос
//             reply.text(__('Загрузка...', 'earena_js'));
//             $('#send-result-match', 'body').text(__('Загрузка...', 'earena_js'))
//             $.ajax({
//                 url: ajaxurl,
//                 type: 'POST',
//                 data: data,
//                 cache: false,
//                 dataType: 'json',
//                 // отключаем обработку передаваемых данных, пусть передаются как есть
//                 processData: false,
//                 // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
//                 contentType: false,
//                 // функция успешного ответа сервера
//                 success: function (respond, status, jqXHR) {
//                     // ОК
//                     if (respond.success) {
//                         reply.text('');
//                         $('#send-result-match', 'body').attr('id', 'resend-result-match')
//                         $('#resend-result-match', 'body').text(__('Изменить результат', 'earena_js'))
//                         $.each(respond.data, function (key, val) {
//                             reply.append('<p>' + val + '</p>');
//                         });
//                     }
//                     // error
//                     else {
//                         reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + respond.error + '</span>');
//                     }
//                 },
//                 // функция ошибки ответа сервера
//                 error: function (jqXHR, status, errorThrown) {
//                     reply.html('<span style="color:red;">' + __('ОШИБКА AJAX запроса: ', 'earena_js') + status + '</span>');
//                 }
//
//             });
//
//         });
//
//
// //TOURNAMENT_MATCH
//         $('body').on('click', '#send-result-tournament-match, #resend-result-tournament-match, #confirm-result-tournament-match', function (event) {
//             var score1 = $(this).parent().find('input[name=score1]').val();
//             var score2 = $(this).parent().find('input[name=score2]').val();
//             var player = $(this).parent().find('input[name=player]').val();
//             var reply = $(this).parent().find('.ajax-reply');
// //console.log(player);
//             event.stopPropagation(); // остановка всех текущих JS событий
//             event.preventDefault();  // остановка дефолтного события для текущего элемента - клик для <a> тега
//
//             if (!isInteger(score1) || !isInteger(score2)) return;
//
//             // создадим данные файлов в подходящем для отправки формате
//             var data = new FormData();
//             $.each(files, function (key, value) {
//                 data.append(key, value);
//             });
//
//             // добавим переменную идентификатор запроса
//             data.append('action', 'ajax_tournament_match_results_and_fileload');
//             data.append('security', nonce);
//             data.append('score1', score1);
//             data.append('score2', score2);
//             data.append('player', player);
//             data.append('id', $('#send-result-tournament-match, #resend-result-tournament-match, #confirm-result-tournament-match', 'body').data('id'));
//
//             // AJAX запрос
//             reply.text(__('Загрузка...', 'earena_js'));
//             $('#send-result-tournament-match').text(__('Загрузка...', 'earena_js'))
//             $.ajax({
//                 url: ajaxurl,
//                 type: 'POST',
//                 data: data,
//                 cache: false,
//                 dataType: 'json',
//                 // отключаем обработку передаваемых данных, пусть передаются как есть
//                 processData: false,
//                 // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
//                 contentType: false,
//                 // функция успешного ответа сервера
//                 success: function (respond, status, jqXHR) {
//                     // ОК
//                     if (respond.success) {
//                         reply.text('');
//                         $('#send-result-tournament-match', 'body').attr('id', 'resend-result-tournament-match')
//                         $('#resend-result-tournament-match', 'body').text(__('Изменить результат', 'earena_js'))
//                         $.each(respond.data, function (key, val) {
//                             reply.append('<p>' + val + '</p>');
//                         });
//                     }
//                     // error
//                     else {
//                         reply.text(__('ОШИБКА: ', 'earena_js') + respond.data);
//                     }
//                 },
//                 // функция ошибки ответа сервера
//                 error: function (jqXHR, status, errorThrown) {
//                     reply.text(__('ОШИБКА AJAX запроса: ', 'earena_js') + status);
//                 }
//
//             });
//
//         });
//     };


//USER BLOCK
    const adminBlockedActions = function () {
        var username = $('#username').html();
        $('body').on('click', '.add-blocked', function () {
            event.preventDefault();
            var $reply = $('.about-user .ajax-reply', 'body');
            var data = {
                'action': 'ea_add_blocked',
                'security': ea_functions_object.nonce,
                'user': $(this).data('user'),
                'username': username,
            };
            $reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_add_blocked success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js')+ '</a></p>');
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_add_blocked NOT success');
                }
            });
        });

        $('body').on('click', '.del-blocked', function () {
            event.preventDefault();
            var $reply = $('.about-user .ajax-reply', 'body');
            var data = {
                'action': 'ea_del_blocked',
                'security': ea_functions_object.nonce,
                'user': $(this).data('user'),
                'username': username,
            };
            $reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_del_blocked success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_del_blocked NOT success');
                }
            });
        });
    };


//YELLOW CARDS
    const adminYellowCardsActions = function () {
        var username = $('#username').html();
        $('body').on('click', '.add-yellow-card-modal', function (e) {
            e.preventDefault();
            var dataUserId = $(this).data('user');
            $("#yellowCard").find('.add-yellow-card').attr('data-user', dataUserId);
//console.log('ea_add_yc to '+dataUserId);
        });
        $('body').on('click', '.add-yellow-card', function () {
            event.preventDefault();
            $(this).addClass('opacity_5');
            $(this).prop('disabled', true);
            var $reply = $('#yellowCard .ajax-reply', 'body');
            var dataUser = $('.add-yellow-card').attr('data-user');
//console.log(dataUser);
            var data = {
                'action': 'ea_add_yc',
                'security': ea_functions_object.nonce,
                'user': dataUser,
                'username': username,
                'reason': $('#yellowCard #reason').val(),
                'match_id': $('input[name=match_id]').val(),
                'match_thread_id': $('input[name=match_thread_id]').val(),
                'tournament': $('input[name=tournament]').val(),
            };
//console.log(data);
            $reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_add_yc success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                    setTimeout(function () {
                        $('#yellowCard').modal('hide');
                        $('.add-yellow-card').removeClass('opacity_5');
                        $('.add-yellow-card').prop('disabled', false);
                        $reply.html('');
                    }, 2000);
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_add_yc NOT success');
                    $('.add-yellow-card').removeClass('opacity_5');
                    $('.add-yellow-card').prop('disabled', false);
                }
            });
        });

        $('body').on('click', '.del-yellow-card', function () {
            event.preventDefault();
            $(this).addClass('opacity_5');
            $(this).prop('disabled', true);
            var $reply = $('#yellowCardDel .ajax-reply', 'body');
            var data = {
                'action': 'ea_del_yc',
                'security': ea_functions_object.nonce,
                'user': $(this).data('user'),
                'username': username,
            };
            $reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_del_yc success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                    setTimeout(function () {
                        $('#yellowCardDel').modal('hide');
                        $('.del-yellow-card').removeClass('opacity_5');
                        $('.del-yellow-card').prop('disabled', false);
                        $reply.html('');
                    }, 2000);
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_del_yc NOT success');
                    $('.del-yellow-card').removeClass('opacity_5');
                    $('.del-yellow-card').prop('disabled', false);
                }
            });
        });

    };

//ADD BALANCE
    const adminAddBalance = function () {
        var username = $('#username').html();
        $('body').on('click', '.add-money-by-admin', function () {
            event.preventDefault();
            $(this).addClass('opacity_5');
            $(this).prop('disabled', true);
            var $reply = $('#addBalance .ajax-reply', 'body');
            var data = {
                'action': 'ea_add_money_by_admin',
                'security': ea_functions_object.nonce,
                'user': $(this).data('user'),
                'username': username,
                'amount': $('#addBalance input[name=amount]').val(),
            };
            $reply.html( __('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_add_money_by_admin success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                    setTimeout(function () {
                        $('#addBalance').modal('hide');
                        $('.add-money-by-admin').removeClass('opacity_5');
                        $('.add-money-by-admin').prop('disabled', false);
                        $reply.html('');
                    }, 2000);
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_add_money_by_admin NOT success');
                    $('.add-money-by-admin').removeClass('opacity_5');
                    $('.add-money-by-admin').prop('disabled', false);
                }
            });
        });
    };


//VERIFICATION REQUESTS
    const adminVerificationActions = function () {
        $('body').on('click', '.btn-apply-verification', function (e) {
            e.preventDefault();
            var dataUserId = $(this).data('user');
            var dataUsername = $(this).data('username');
            $("#applyRequest").find('#apply-verification-request').attr('data-user', dataUserId);
            $("#applyRequest").find('#apply-alert').text(__('Вы действительно хотите одобрить заявку пользователя ', 'earena_js') + dataUsername + '?');
//console.log('ea_apply_verification_request to '+dataUserId);
        });
        $('body').on('click', '#apply-verification-request', function () {
            event.preventDefault();
            $(this).addClass('opacity_5');
            $(this).prop('disabled', true);
            var $reply = $('#applyRequest .apply-ajax-reply', 'body');
            var data = {
                'action': 'ea_apply_verification_request',
                'security': ea_functions_object.nonce,
                'user': $(this).data('user'),
                'username': $(this).data('username'),
            };
            $reply.html('Загрузка...');
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_apply_verification_request success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                    setTimeout(function () {
                        $('#applyRequest').modal('hide');
                        $('#apply-verification-request').removeClass('opacity_5');
                        $('#apply-verification-request').prop('disabled', false);
                        $reply.html('');
                    }, 2000);
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_apply_verification_request NOT success');
                    $('#apply-verification-request').removeClass('opacity_5');
                    $('#apply-verification-request').prop('disabled', false);
                }
            });
        });

        $('body').on('click', '.btn-remove-verification', function (e) {
            e.preventDefault();
            var dataUserId = $(this).data('user');
            var dataUsername = $(this).data('username');
            $("#removeRequest").find('#remove-verification-request').attr('data-user', dataUserId);
            $("#removeRequest").find('#remove-alert').text(__('Вы действительно хотите отклонить заявку пользователя ', 'earena_js') + dataUsername + '?');
//console.log('ea_remove_verification_request to '+dataUserId);
        });
        $('body').on('click', '#remove-verification-request', function () {
            event.preventDefault();
            $(this).addClass('opacity_5');
            $(this).prop('disabled', true);
            var $reply = $('#removeRequest .remove-ajax-reply', 'body');
            var data = {
                'action': 'ea_remove_verification_request',
                'security': ea_functions_object.nonce,
                'user': $(this).data('user'),
                'username': $(this).data('username'),
            };
            $reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_remove_verification_request success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                    setTimeout(function () {
                        $('#removeRequest').modal('hide');
                        $('#remove-verification-request').removeClass('opacity_5');
                        $('#remove-verification-request').prop('disabled', false);
                        $reply.html('');
                    }, 2000);
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_remove_verification_request NOT success');
                    $('#remove-verification-request').removeClass('opacity_5');
                    $('#remove-verification-request').prop('disabled', false);
                }
            });
        });
    };

//MATCH DEL MODERATE
    const adminDelModerateActions = function () {
        $('body').on('click', '#del-moderate', function () {
            event.preventDefault();
            $(this).addClass('opacity_5');
            $(this).prop('disabled', true);
            var data = {
                'action': 'ea_del_moderate',
                'security': ea_functions_object.nonce,
                'match_id': $('input[name=match_id]').val(),
                'match_thread_id': $('input[name=match_thread_id]').val(),
                'tournament': $('input[name=tournament]').val(),
            };
            $(this).html('Загрузка...');
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                if (response.success == 1) {
//console.log('ea_del_moderate success');
                    $('#del-moderate').html(__('Жалоба рассмотрена', 'earena_js'));
                    setTimeout(function () {
                        $('#del-moderate').removeClass('opacity_5');
                        $('#del-moderate').prop('disabled', false);
                    }, 2000);
                } else {
//console.log('ea_del_moderate NOT success');
                    $('#del-moderate').html(__('Жалоба не рассмотрена', 'earena_js'));
                    $('#del-moderate').removeClass('opacity_5');
                    $('#del-moderate').prop('disabled', false);
                }
            });
        });
    };

//PROFILE ADD VIP
    const adminVipActions = function () {
        var username = $('#username').html();
        $('body').on('click', '.add-vip', function () {
            event.preventDefault();
            var $reply = $('.about-user .ajax-reply', 'body');
            var data = {
                'action': 'ea_add_vip',
                'security': ea_functions_object.nonce,
                'user': $(this).data('user'),
                'username': username,
            };
            $reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                $reply.html('');
                if (response.success == 1) {
//console.log('ea_add_vip success');
                    $reply.append('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                } else {
                    $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_add_vip NOT success');
                }
            });
        });
    };

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

//TOURNAMENT LIST ACTIONS
    const tournamentListActions = function () {

        $('body').on('click', '.delete-tournament-cron', function () {
            event.preventDefault();
            var parentId = $(this).data('parentid');
            var reply = $('#' + parentId, 'body');
            var data = {
                'action': 'ea_delete_tournament_cron',
                'security': ea_functions_object.nonce,
                'cron': $(this).data('cron'),
                'crontime': $(this).data('crontime'),
            };
            reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                reply.html('');
                if (response.success == 1) {
//console.log('ea_delete_tournament_cron success');
                    reply.html('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                } else {
                    reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_delete_tournament_cron NOT success');
                }
            });
        });

        $('body').on('click', '.delete-tournament', function () {
            event.preventDefault();
            var parentId = $(this).data('parentid');
            var reply = $('#' + parentId, 'body');
            var data = {
                'action': 'ea_delete_tournament',
                'security': ea_functions_object.nonce,
                'id': $(this).data('id'),
            };
            reply.html(__('Загрузка...', 'earena_js'));
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                reply.html('');
                if (response.success == 1) {
//console.log('ea_delete_tournament success');
                    reply.html('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                } else {
                    reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_delete_tournament NOT success');
                }
            });
        });

        $('body').on('click', '.cancel-tournament', function () {
            event.preventDefault();
            var parentId = $(this).data('parentid');
            var reply = $('#' + parentId, 'body');
            var data = {
                'action': 'ea_cancel_tournament',
                'security': ea_functions_object.nonce,
                'id': $(this).data('id'),
            };
            reply.html('Загрузка...');
            $.post(ajaxurl, data, function (response) {
                response = JSON.parse(response);
                reply.html('');
                if (response.success == 1) {
//console.log('ea_cancel_tournament success');
                    reply.html('<p style="color:green;">' + response.content + '<br><a href="#" onclick="reload();">' + __('Обновите страницу', 'earena_js') + '</a></p>');
                } else {
                    reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + response.content + '</span>');
//console.log('ea_cancel_tournament NOT success');
                }
            });
        });

    };
    // adminAddTournamentPlayer();
    // adminSendMatchResult();
    // adminBlockedActions();
    // adminYellowCardsActions();
    // adminAddBalance();
    // adminVerificationActions();
    // adminDelModerateActions();
    // $('body').on('match-updated', adminYellowCardsActions);
    // $('body').on('match-updated', adminDelModerateActions);
    // adminVipActions();
    adminSearchUsers();
    // tournamentListActions();
});
//console.log('ea_admin_functions end loading OK');
