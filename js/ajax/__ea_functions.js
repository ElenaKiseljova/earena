/**
 * functions_for_funk_soul_brothers
 * load_more_amore_e_morte
 * copyleft 2021 abel from baker street
 * just smile=)
 */
//console.log('ea_functions begin OK');
jQuery('document').ready(function($) {

const {__, _x, _n, _nx } = wp.i18n;
const isInteger = value => parseInt(value) == value
let globalUserIdToDetele = 0
const onlyDigits = function () {
  jQuery(document).on('input', '.only-digits', function () {
    this.value = this.value.replace(/\D/g, '')
  })
}

const $_GET = function (key) {
  var p = window.location.search
  p = p.match(new RegExp(key + '=([^&=]+)'))
  return p ? p[1] : false
}

const userActions = function () {
  if ($_GET('login') == 'failed') {
    $('#login').modal('show')
  }
  if ($_GET('action') == 'login') {
    $('#login').modal('show')
  }
  if ($_GET('action') == 'forgot') {
    $('#forgot').modal('show')
  }
  if ($_GET('action') == 'rp') {
    $('#forgot').modal('show')
  }
  if ($_GET('action') == 'register') {
    $('#register').modal('show')
  }
  if ($_GET('wallet_action') == 'add') {
    $('div.ef-wallet .woo-wallet-sidebar ul li:nth-child(1)').addClass('active')
  }
  if ($_GET('wallet_action') == 'transfer') {
    $('div.ef-wallet .woo-wallet-sidebar ul li:nth-child(2)').addClass('active')
  }
  if ($_GET('wallet_action') == 'transactions') {
    $('div.ef-wallet .woo-wallet-sidebar ul li:nth-child(3)').addClass('active')
  }
  if ($_GET('wallet_action') == 'withdraw') {
    $('div.ef-wallet .woo-wallet-sidebar ul li:nth-child(4)').addClass('active')
  }
  if (window.location.pathname.includes('/profile/') && $_GET('after_registration') == 1) {
    afterRegFunction()
  }
}

//FORGOT PASS
const forgotPasswordActions = function () {
  $('#forgot #forgot_form').on('submit', function (e) {
    e.preventDefault()
    $('#forgot .status_forgot').show().html(ea_functions_object.loadingmessage)
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ea_functions_object.url,
      data: {
        'action': 'ajaxforgot',
        'forgot_security': $('#forgot_form #forgot_security').val(),
        'user_login': $('#forgot_form input[name=email]').val()
      },
      success: function (respond, status, jqXHR) {
        if (respond.data.retrieve_password == true) {
          $('#forgot .status_forgot').html(respond.data.message)
        } else {
          $('#forgot .status_forgot').html(respond.data.message)
        }
      },
      error: function (jqXHR, status, errorThrown) {
        $('#forgot .status_forgot').html(respond.data.error)
        $('#forgot .status_forgot').append(status + __('. Попробуйте обновить страницу.', 'earena_js'))
      }
    })
  })

  $('#forgot #reset_pass_form').on('submit', function (e) {
    e.preventDefault()
    $('#forgot .status_rp').show().html(ea_functions_object.loadingmessage)
    var submit = $('#reset_pass_form #resetpass-button'),
      data = {
        action: 'ajaxreset_pass',
        rp_security: $('#reset_pass_form #rp_security').val(),
        pass1: this.pass1.value,
        pass2: this.pass2.value,
        user_key: this.key.value,
        user_login: this.user_login.value
      }

    // disable button onsubmit to avoid double submision
    submit.attr('disabled', 'disabled').addClass('disabled')

    $.post(ea_functions_object.url, data, function (respond) {
      // display return data
      $('#forgot .status_rp').html(respond)
      console.log(respond)
      console.log(ea_functions_object.invalidkey)
      submit.removeAttr('disabled').removeClass('disabled')
      if (respond == ea_functions_object.invalidkey) {
        $('#forgot .status_rp').append('<br><a href="' + ea_functions_object.redirecturl_rp + '"></a>.')
      }
    })

    return false
  })
}

//LOGIN
const loginActions = function () {
  $('#login #login_form').on('submit', function (e) {
    e.preventDefault()
    $('#login .status_login').show().html(ea_functions_object.loadingmessage)
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: ea_functions_object.url,
      data: {
        'action': 'ajaxlogin',
        'username': $('#login input[name=log]').val(),
        'password': $('#login input[name=pwd]').val(),
        'login_security': $('#login #login_security').val()
      },
      success: function (respond, status, jqXHR) {
        if (respond.data.loggedin == true) {
          document.location.href = ea_functions_object.redirecturl
        } else {
          $('#login .status_login').html(__('ОШИБКА: ', 'earena_js') + respond.data.message)
        }
      },
      error: function (jqXHR, status, errorThrown) {
        $('#login .status_login').html(__('ОШИБКА: ', 'earena_js') + status + __('. Попробуйте обновить страницу.', 'earena_js'))
      }
    })
  })
}

//SEND RESULT
const sendMatchResultActions = function () {
  // ссылка на файл AJAX  обработчик
  var ajaxurl = ea_functions_object.url
  var nonce = ea_functions_object.nonce

  var files // переменная. будет содержать данные файлов

  // заполняем переменную данными, при изменении значения поля file
  const updateFileInputValue = function () {
    let $fileInput = $('input[type=file]', 'body')
    $fileInput.on('change', function () {
      files = this.files
    })
  }
  updateFileInputValue()

  $('body').on('match-updated', updateFileInputValue)

  //ORDINARY MATCH
  $('body').on('click', '#send-result-match, #resend-result-match, #confirm-result-match', function (event) {
//console.log(files);
    var score1 = $('body').find('#score1').val()
    var score2 = $('body').find('#score2').val()
    var $reply = $('.ajax-reply', 'body')

    event.stopPropagation() // остановка всех текущих JS событий
    event.preventDefault()  // остановка дефолтного события для текущего элемента - клик для <a> тега

    if (!isInteger(score1) || !isInteger(score2)) {
      $reply.html('<span style="color:red;">' + __('Укажите счёт', 'earena_js') + '</span>')
      return
    }
    // создадим данные файлов в подходящем для отправки формате
    var data = new FormData()

    $.each(files, function (key, value) {
      data.append(key, value)
    })

    // добавим переменную идентификатор запроса
    data.append('action', 'ajax_match_results_and_fileload')
    data.append('security', nonce)
    data.append('score1', score1)
    data.append('score2', score2)
//data.append('user_id', ea_functions_object.user_id);
    data.append('id', $('#send-result-match, #resend-result-match, #confirm-result-match', 'body').data('id'))

    // AJAX запрос
    $reply.text(__('Загрузка...', 'earena_js'))
    $('#send-result-match', 'body').text(__('Загрузка...', 'earena_js'))
    $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      // отключаем обработку передаваемых данных, пусть передаются как есть
      processData: false,
      // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
      contentType: false,
      // функция успешного ответа сервера
      success: function (respond, status, jqXHR) {
        // ОК
        if (respond.success) {
          $reply.text('')
          $('#send-result-match', 'body').attr('id', 'resend-result-match')
          $('#resend-result-match', 'body').text(__('Изменить результат', 'earena_js'))
          $.each(respond.data, function (key, val) {
            $reply.append('<p>' + val + '</p>')
          })
        }
        // error
        else {
          $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + respond.data + '</span>')
        }
      },
      // функция ошибки ответа сервера
      error: function (jqXHR, status, errorThrown) {
        $reply.html('<span style="color:red;">' + __('ОШИБКА AJAX запроса: ', 'earena_js') + status + '</span>')
      }

    })

  })

//TOURNAMENT_MATCH
  $('body').on('click', '#send-result-tournament-match, #resend-result-tournament-match, #confirm-result-tournament-match', function (event) {
    var score1 = $('body').find('#score1').val()
    var score2 = $('body').find('#score2').val()
    event.stopPropagation() // остановка всех текущих JS событий
    event.preventDefault()  // остановка дефолтного события для текущего элемента - клик для <a> тега

    if (!isInteger(score1) || !isInteger(score2)) return

    // создадим данные файлов в подходящем для отправки формате
    var data = new FormData()
    $.each(files, function (key, value) {
      data.append(key, value)
    })

    // добавим переменную идентификатор запроса
    data.append('action', 'ajax_tournament_match_results_and_fileload')
    data.append('security', nonce)
    data.append('score1', score1)
    data.append('score2', score2)
//data.append('user_id', ea_functions_object.user_id);
    data.append('id', $('#send-result-tournament-match, #resend-result-tournament-match, #confirm-result-tournament-match', 'body').data('id'))

    var $reply = $('.ajax-reply', 'body')

    // AJAX запрос
    $reply.text(__('Загрузка...', 'earena_js'))
    $('#send-result-tournament-match').text(__('Загрузка...', 'earena_js'))
    $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      // отключаем обработку передаваемых данных, пусть передаются как есть
      processData: false,
      // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
      contentType: false,
      // функция успешного ответа сервера
      success: function (respond, status, jqXHR) {
        // ОК
        if (respond.success) {
          $reply.text('')
          $('#send-result-tournament-match', 'body').attr('id', 'resend-result-tournament-match')
          $('#resend-result-tournament-match', 'body').text(__('Изменить результат', 'earena_js'))
          $.each(respond.data, function (key, val) {
            $reply.append('<p>' + val + '</p>')
          })
        }
        // error
        else {
          $reply.text(__('ОШИБКА: ', 'earena_js') + respond.data)
        }
      },
      // функция ошибки ответа сервера
      error: function (jqXHR, status, errorThrown) {
        $reply.text(__('ОШИБКА AJAX запроса: ', 'earena_js') + status)
      }

    })

  })
}

//MODERATE MATCH
const moderateMatchActions = function () {
  $('body').on('click', '#moderate-match', function () {
    event.preventDefault()
    var data = {
      'action': 'moderate_match',
      'security': ea_functions_object.nonce,
      'user_id': ea_functions_object.user_id,
      'id': $(this).data('id'),
      'type': $(this).data('type'),
      'message': $('body').find('#moderate-match-form textarea[name=messages]').val(),
    }

    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      $('#moderate-match-form').html(response.content)
      if (response.title) {
        $('a[data-target=\"\#writeAppeal\"]').text(response.title)
      }
    })
  })
}

//DELETE MATCH
const deleteMatchActions = function () {
  $('body').on('click', '.btn-delete-match', function (e) {
    e.preventDefault()
    var dataId = $(this).attr('data-id')
    $('#delMatch').find('#del-match').attr('data-id', dataId)
  })

  $('body').on('click', '#del-match', function (e) {
    event.preventDefault()
    if ($('#del-match').prop('disabled') == true) {
      return
    }

    $('#del-match').addClass('opacity_5')
    $('#del-match').prop('disabled', true)
    setTimeout(function () {
      $('#del-match').removeClass('opacity_5')
      $('#del-match').prop('disabled', false)
    }, 5000)
    var data = {
      'action': 'delete_match',
      'security': ea_functions_object.nonce,
      'id': $(this).attr('data-id'),
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      if (response.success === 1) {
        $('body').trigger('matches-list-updated')
        $('body').trigger('matches-list-updated-profile')
        $('body').trigger('get-matches-homepage')
        $('#delMatch').modal('hide')
        if (typeof app !== 'undefined') {
          app.sendMatchesAjax()
        }
        if (typeof app_match !== 'undefined') {
          app_match.getDefault()
        }
      } else {
        $('#del-alert').remove()
        $('#delete-match-form').html(response.content)
      }
    })
  })
}

//JOIN MATCH
const joinMatchActions = function () {
  $('body').on('click', '.btn-accept-match', function (e) {
    e.preventDefault()
    let dataId = $(this).attr('data-id')
    let platform = $(this).attr('data-image-platform')
    let dataGame = $(this).attr('data-game')
    let dataPrice = $(this).attr('data-price')
    let dataPrivate = $(this).attr('data-private')
    let dataImage = $(this).attr('data-image-game')
    let dataMode = $(this).attr('data-mode')
    let dataCommand = $(this).attr('data-command')
    let r = /\d+/
    let balanceValue = $('#balance-value').text()
    let balance = parseFloat(balanceValue.replace('$', ''))

    if (balance < parseFloat(dataPrice)) {
      $('#goMatch').find('#join-match-balance').html('<a href="/wallet/?wallet_action=add"><b>' + __('Пополнить', 'earena_js') + '</b></a> <span class="red">$' + balance + '</span>')
      $('#goMatch').find('#join-match').attr('disabled', 'disabled')
      $('#goMatch').find('#join-match').addClass('opacity_5')
    } else {
      $('#goMatch').find('#join-match-balance').html('$' + balance)
      $('#goMatch').find('#join-match').removeAttr('disabled')
      $('#goMatch').find('#join-match').removeClass('opacity_5')
    }

	if (dataPrice == 0) {
		dataPriceText = 'free'
	} else {
		dataPriceText = '$'+dataPrice
	}

    $('#goMatch').find('#join-match').attr('data-id', dataId.match(r))
    $('#goMatch').find('div.id').html('ID ' + dataId)
    $('#goMatch').find('span.name').html(dataGame)
    $('#goMatch').find('.price').html(dataPriceText)
    $('#goMatch').find('img.platform').attr('src', platform)
    $('#goMatch').find('img.imgss').attr('src', dataImage)
    $('#goMatch').find('span.spanMode').html(dataMode)

    if (dataCommand === '' || dataCommand === 0 ) {
      $('#goMatch').find('.command-line').hide()
    } else {
      $('#goMatch').find('span.spanCommand').html(dataCommand)
    }


    if (dataPrivate == true) {
      $('#goMatch #join-match-private').show()
      $('#goMatch #join-match-private #password').attr('required', 'required')
      $('#goMatch #join-match-private #password').removeAttr('disabled')
      $('#goMatch #join-match').addClass('disabled')
      $('#goMatch #join-match').attr('disabled', 'disabled')
      $('#goMatch #password').keyup(function(event) {
        if($(event.currentTarget).val().length !== 0) {
          $('#goMatch #join-match').removeAttr('disabled', 'disabled')
          $('#goMatch #join-match').removeClass('disabled')
        } else {
          $('#goMatch #join-match').attr('disabled', 'disabled')
          $('#goMatch #join-match').addClass('disabled')
        }
      })
      $('#goMatch .toggle-password').mousedown(function(event) {
        $('#goMatch #password').attr('type', 'text')
        $(event.currentTarget).addClass('show')
      })
      $('#goMatch .toggle-password').mouseup(function(event) {
        $('#goMatch #password').attr('type', 'password')
        $(event.currentTarget).removeClass('show')
      })


    } else {
      $('#goMatch #join-match-private').hide()
      $('#goMatch #join-match-private #password').removeAttr('required')
      $('#goMatch #join-match-private #password').attr('disabled', 'disabled')

    }
  })

  $('body').on('click', '#join-match', function () {
    event.preventDefault()
//console.log('click');
    if ($('#join-match').prop('disabled') == true) {
//console.log('anti-click');
      return
    }
//console.log('2click');

    $('#join-match').addClass('opacity_5')
    $('#join-match').prop('disabled', true)
    setTimeout(function () {
      $('#join-match').removeClass('opacity_5')
      $('#join-match').prop('disabled', false)
    }, 5000)
    var data = {
      'action': 'join_match',
      'security': ea_functions_object.nonce,
      'id': $(this).data('id'),
      'match_pass': $('body').find('#join-match-form input[name=password]').val(),
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
//      $('#ea_msg').html(response.content)
      $('#join-match-form').html(response.content)
      $('body').trigger('get-matches-homepage')
      if (typeof app !== 'undefined') {
        app.sendMatchesAjax()
      }
      if (typeof app_match !== 'undefined') {
        app_match.getDefault()
      }
    })
  })
}

//ADD MATCH
const addMatchActions = function () {
  $('body').on('click', '#add-match-btn', function (e) {
    e.preventDefault()
    const btnEl = $('#add-match-btn')
    if (btnEl.prop('disabled') === true) {
      return
    }
    btnEl.addClass('opacity_5').prop('disabled', true)

    const formEl = $('#add-match-form')
    var data = {
      'action': 'add_match',
      'security': ea_functions_object.nonce,
      'bet': formEl.find('input[name=bet]').val(),
      'platform': formEl.find('input[name=platform]:checked').val(),
      'game_mode': formEl.find('select[name=game_mode]').val(),
      'team_mode': formEl.find('select[name=team_mode]').val(),
      'game': formEl.find('input[name=game]').val(),
    }
    if(formEl.find('input[name=free]').val() == 'false'){
      data.bet = formEl.find('input[name=bet]').val()
    }else{
      data.free = 1
    }
    console.log(formEl.find('input[name=free]').val())

    var privateEl = $('input[name=private]')
    if (privateEl.is(':checked')) {
      data.password = $('body').find('#add-match-form input[name=password]').val()
    }
    $.post(
      ajaxurl,
      data,
      (response) => {
        response = JSON.parse(response)
        const add_msg = $('#add-msg')
        if (response.success == 1) {
          if (typeof app !== 'undefined') {
            app.sendMatchesAjax()
          }
          if (typeof app_match !== 'undefined') {
            app_match.getDefault()
          }
          add_msg.show().html('<span style="color:green;">' + response.content + '</span>')
          setTimeout(function () {
            add_msg.hide()
            $('#createMatch2').modal('hide')
          }, 2000)
          $('body').trigger('matches-list-updated')
        } else if (response.success == 0) {
          add_msg.show().html('<span style="color:red;">' + response.content + '</span>')
        } else {
          add_msg.html(response.content)
        }
      })
/*      .done(() => {
        btnEl.removeClass('opacity_5').prop('disabled', false)
      })*/
  })
}

//JOIN TOURNAMENT
const joinTournamentActions = function () {
  $('#btn-accept-tournament').click(function (e) {
    e.preventDefault()
    const dataId = $(this).attr('data-id')
    const dataTitle = $(this).attr('data-title')
    const dataGame = $(this).attr('data-game')
    const platform = $(this).attr('data-image-platform')
    const dataPrice = $(this).attr('data-price')
    const dataPrivate = $(this).attr('data-private')
    const dataImage = $(this).attr('data-image-game')
    const dataMode = $(this).attr('data-mode')
    const dataCommand = $(this).attr('data-command')
    const r = /\d+/
    const balanceValue = $('#balance-value').text()
    const balance = parseFloat(balanceValue.replace('$', ''))

    if (balance < parseFloat(dataPrice)) {
      $('#goTour').find('#join-tournament-balance').html('<a href="/wallet/?wallet_action=add"><b>' + __('Пополнить', 'earena_js') + '</b></a> <span class="red">$' + balance + '</span>')
      $('#goTour').find('#join-tournament').attr('disabled', 'disabled')
      $('#goTour').find('#join-tournament').addClass('opacity_5')
    } else {
      $('#goTour').find('#join-tournament-balance').html('$' + balance)
      $('#goTour').find('#join-tournament').removeAttr('disabled')
      $('#goTour').find('#join-tournament').removeClass('opacity_5')
    }

	if (dataPrice == 0) {
		dataPriceText = 'free'
	} else {
		dataPriceText = '$'+dataPrice
	}

    $('#goTour').find('#join-tournament').attr('data-id', dataId.match(r))
    $('#goTour').find('#join-tournament').attr('data-title', dataTitle)
    $('#goTour').find('div.id').html('ID ' + dataId)
    $('#goTour').find('div.tournament-name').html(dataTitle)
    $('#goTour').find('span.name').html(dataGame)
    $('#goTour').find('.price').html(dataPriceText)
    $('#goTour').find('img.imgss').attr('src', dataImage)
    $('#goTour').find('img.platform').attr('src', platform)
    $('#goTour').find('span.spanMode').html(dataMode)
    if (dataCommand === '') {
      $('#goTour').find('span.spanCommand').hide()
    } else {
      $('#goTour').find('span.spanCommand').html(dataCommand)
    }

    if (dataPrivate == true) {
      $('#goTour #join-tournament-private').show()
      $('#goTour #join-tournament-private #password').attr('required', 'required')
      $('#goTour #join-tournament-private #password').removeAttr('disabled')
    } else {
      $('#goTour #join-tournament-private').hide()
      $('#goTour #join-tournament-private #password').removeAttr('required')
      $('#goTour #join-tournament-private #password').attr('disabled', 'disabled')
    }
  })

  $('body').on('click', '#join-tournament', function () {
    event.preventDefault()
//console.log('click');
    if ($('#join-tournament').prop('disabled') == true) {
//console.log('anti-click');
      return
    }
//console.log('2click');

    $('#join-tournament').addClass('opacity_5')
    $('#join-tournament').prop('disabled', true)
    setTimeout(function () {
      $('#join-tournament').removeClass('opacity_5')
      $('#join-tournament').prop('disabled', false)
    }, 5000)
    var title = $(this).data('title')
    var data = {
      'action': 'join_tournament',
      'security': ea_functions_object.nonce,
      'id': $(this).data('id'),
      'tournament_pass': $('body').find('#join-tournament-form input[name=password]').val(),
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      if (response.content == 1) {
        $('body').trigger('tournament-update')
        $('#thanksTour .modal-body p').html(__('Вы успешно зарегистрированы в турнире', 'earena_js') + '<br/><b>' + title + '</b>')
        $('#goTour').modal('hide')
        $('#thanksTour').modal({ show: true })
        /*setTimeout(function(){
            location.reload();
        }, 2000);*/
      } else if (response.content == -4) {
        $('#ea_msg').html(__('Игроки, которым нет 18-ти лет не могут участвовать в играх на деньги. Для игры доступны только бесплатные турниры.', 'earena_js'))
      } else if (response.content == -3) {
        $('#ea_msg').html(__('ОШИБКА! Не удалось идентифицировать пользователя. Обновите страницу.', 'earena_js'))
      } else if (response.content == -2) {
        $('#ea_msg').html(__('ОШИБКА! Неверный пароль.', 'earena_js'))
      } else if (response.content == -1) {
        $('#ea_msg').html(__('ОШИБКА! Не получилось списать средства.', 'earena_js'))
      } else if (response.content == 0) {
        $('#ea_msg').html(__('ОШИБКА! Обновите страницу.', 'earena_js'))
      } else {
        $('#ea_msg').html(__('ОШИБКА! Обновите страницу.', 'earena_js'))
      }
    })
  })
}

//LEAVE TOURNAMENT
const leaveTournamentActions = function () {
  $('body').on('click', '.btn-delete-tournament', function (e) {
    e.preventDefault()
//console.log('click');
    if ($('.btn-delete-tournament').prop('disabled') == true) {
//console.log('anti-click');
      return
    }
//console.log('2click');
    $('.btn-delete-tournament').addClass('opacity_5')
    $('.btn-delete-tournament').prop('disabled', true)
    setTimeout(function () {
      $('.btn-delete-tournament').removeClass('opacity_5')
      $('.btn-delete-tournament').prop('disabled', false)
    }, 5000)
    var price = $(this).data('price')
    var data = {
      'action': 'leave_tournament',
      'security': ea_functions_object.nonce,
      'id': $(this).data('id'),
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      if (response.content == 1) {
        $('body').trigger('tournament-update')
        $('#tourCancel .modal-body p').html(__('Вы отменили участие в турнире.<br/>Средства в размере $', 'earena_js') + price + __(' были возвращены обратно на ваш счёт.', 'earena_js'))
        $('#tourCancel').modal({ show: true })
      } else if (response.content == -1) {
        $('#tourCancel .modal-body p').html(__('ОШИБКА! Не получилось вернуть средства.', 'earena_js'))
      } else if (response.content == 0) {
        $('#tourCancel .modal-body p').html(__('ОШИБКА! Обновите страницу.', 'earena_js'))
      } else {
        $('#tourCancel .modal-body p').html(__('ОШИБКА! Обновите страницу.', 'earena_js'))
      }
    })
  })
}

//FRIEND
const friendActions = function () {
  let $buttonNode
  $('body').on('click', '.btn-remove-friend', function (e) {
    e.preventDefault()
    $buttonNode = $(e.target)
    var dataUserId = $(this).attr('data-user')
    var dataUserName = $(this).attr('data-username')
    globalUserIdToDetele = dataUserId
    $('#removeFriend').find('#del-alert').text(__('Вы действительно хотите удалить из друзей ', 'earena_js') + dataUserName + '?')
  })

  $('body').on('click', '#del-user', function (e) {
    if (globalUserIdToDetele == 0) {
      return false
    }
    event.preventDefault()
    var data = {
      'action': 'remove_friend',
      'security': ea_functions_object.nonce,
      'user': globalUserIdToDetele,
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      if (response.success == 1) {
        $('#removeFriend').modal('hide')
        if ($('.links-user-profile').length) {
          $('body').trigger('edit-public-user-button')
          $('body').trigger('edit-public-user-list')
          $('.links-user-profile .btn-remove-friend').addClass('d-none')
          $('.links-user-profile .btn-add-friend').removeClass('d-none')
        }
        if ($('.links-friends').length) {
          $buttonNode.closest('tr').addClass('d-none')
        }
      }
    })
  })

  $('body').on('click', '.btn-reject-friend', function (e) {
    event.preventDefault()
    const $buttonNode = $(e.target)
    var data = {
      'action': 'del_request_friend',
      'security': ea_functions_object.nonce,
      'user': $(this).data('user'),
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      if (response.success == 1) {
        if ($('.links-user-profile').length) {
          $('body').trigger('edit-public-user-button')
          $('.links-user-profile .btn-add-friend').removeClass('d-none')
          $('.links-user-profile .btn-reject-friend').addClass('d-none')
          $('.links-user-profile .btn-apply-friend').addClass('d-none')
        }
        if ($('.links-friends').length) {
          $buttonNode.closest('tr').addClass('d-none')
        }
//console.log('del_request_friend success');
      }
    })
  })

  $('body').on('click', '.btn-add-friend', function () {
    event.preventDefault()
    var data = {
      'action': 'add_request_friend',
      'security': ea_functions_object.nonce,
      'user': $(this).data('user'),
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      if (response.success == 1) {
        if ($('.links-user-profile').length) {
          $('body').trigger('edit-public-user-button')
          $('.links-user-profile .btn-add-friend').addClass('d-none')
          $('.links-user-profile .btn-reject-friend').removeClass('d-none')
        }
//console.log('add_request_friend success');
      }
    })
  })

  $('body').on('click', '.btn-apply-friend', function (e) {
    event.preventDefault()
    const $buttonNode = $(e.target)
    var data = {
      'action': 'accept_friend',
      'security': ea_functions_object.nonce,
      'user': $(this).data('user'),
    }
    $.post(ajaxurl, data, function (response) {
      response = JSON.parse(response)
      if (response.success == 1) {
        if ($('.links-user-profile').length) {
          $('body').trigger('edit-public-user-button')
          $('body').trigger('edit-public-user-list')
          $('.links-user-profile .btn-apply-friend').addClass('d-none')
          $('.links-user-profile .btn-reject-friend').addClass('d-none')
          $('.links-user-profile .btn-remove-friend').removeClass('d-none')
        }
        if ($('.links-friends').length) {
          $buttonNode.closest('tr').find('.friends-request-text').addClass('d-none')
          $buttonNode.closest('.links-friends').find('.btn-apply-friend').addClass('d-none')
          $buttonNode.closest('.links-friends').find('.btn-reject-friend').addClass('d-none')
          $buttonNode.closest('.links-friends').find('.btn-message-friend').removeClass('d-none')
          $buttonNode.closest('.links-friends').find('.btn-remove-friend').removeClass('d-none')
        }
//console.log('accept_friend success');
      }
    })
  })

  $('body').on('edit-public-user-button', function () {
    const user = window.location.pathname.replace('/user/', '').replace('/', '')
    $.ajax({
      url: footAjax.admin_url,
      type: 'POST',
      data: {
        action: 'getUserButtons',
        user: user,
      },
      success: function (data) {
        $('.links-user-profile').html(data)
      },
    })
  })

  $('body').on('edit-public-user-list', function () {
    const user = window.location.pathname.replace('/user/', '').replace('/', '')
    $.ajax({
      url: footAjax.admin_url,
      type: 'POST',
      data: {
        action: 'getFriendsList',
        user: user,
      },
      success: function (data) {
        $('.setFriend').html(data)
      },
    })
    $.ajax({
      url: footAjax.admin_url,
      type: 'POST',
      data: {
        action: 'getFriendsListMobile',
        user: user,
      },
      success: function (data) {
        $('.setFriendMobile').html(data)
      },
    })
    $.ajax({
      url: footAjax.admin_url,
      type: 'POST',
      data: {
        action: 'getFriendsListCount',
        user: user,
      },
      success: function (data) {
        $('.friendCount').html(data)
      },
    })
  })
}

//VERIFICATION
const sendValidationAction = function () {
  // ссылка на файл AJAX  обработчик
  var ajaxurl = ea_functions_object.url
  var nonce = ea_functions_object.nonce

  var files // переменная. будет содержать данные файлов

  // заполняем переменную данными, при изменении значения поля file
  const validationUpdateFileInputValue = function () {
    let $fileInput = $('#modalVerify input[type=file]', 'body')
    $fileInput.on('change', function () {
      files = this.files
//console.log(files);
    })
  }
  validationUpdateFileInputValue()

  $('body').on('click', '#verification-button', function (event) {
//console.log('click');
    var $reply = $('.ajax-reply', 'body')
    event.stopPropagation() // остановка всех текущих JS событий
    event.preventDefault()  // остановка дефолтного события для текущего элемента - клик для <a> тега
    // создадим данные файлов в подходящем для отправки формате
    var data = new FormData()
    $.each(files, function (key, value) {
      data.append(key, value)
    })
    // добавим переменную идентификатор запроса
    data.append('action', 'verification_fileload')
    data.append('security', nonce)

    // AJAX запрос
    $reply.text(__('Загрузка...', 'earena_js'))
    $('#verification-button', 'body').text(__('Загрузка...', 'earena_js'))
    $.ajax({
      url: ajaxurl,
      type: 'POST',
      data: data,
      cache: false,
      dataType: 'json',
      // отключаем обработку передаваемых данных, пусть передаются как есть
      processData: false,
      // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
      contentType: false,
      // функция успешного ответа сервера
      success: function (respond, status, jqXHR) {
        // ОК
        if (respond.success) {
          $reply.text('')
          $('#modalVerify #verification-button', 'body').text(__('Отправить', 'earena_js'))
          $.each(respond.data, function (key, val) {
            $reply.append('<p style="color:green;">' + val + '</p>')
          })
          setTimeout(function () {
            $('#modalVerify').modal('hide')
            $('#thanksVerify').modal('show')
          }, 2000)
        }
        // error
        else {
          $reply.html('<span style="color:red;">' + __('ОШИБКА: ', 'earena_js') + respond.data + '</span>')
        }
      },
      // функция ошибки ответа сервера
      error: function (jqXHR, status, errorThrown) {
        $reply.html('<span style="color:red;">' + __('ОШИБКА AJAX запроса: ', 'earena_js') + status + '</span>')
      }
    })
  })
}

const setTimeOffsetCookie = function () {
  var offset = new Date().getTimezoneOffset()
  $.cookie('ea_user_time_offset', offset)
}
/*
$( ".match-single .messenger .message" ).bind('change click keyup', function() {
	var btn = $('.match-single .messenger input[type=submit]');
	var txt = $('.match-single .messenger textarea');
	var txt2 = $('.match-single .messenger .bp-emojionearea-editor p');
//console.log('1');
	if (txt.val() == "") {
//console.log('2');
		btn.addClass('opacity_5');
		btn.prop('disabled', true);
	}else if (txt2.html() == "") {
//console.log('3');
		btn.addClass('opacity_5');
		btn.prop('disabled', true);
	}else if (txt2.val() == "") {
//console.log('4');
		btn.addClass('opacity_5');
		btn.prop('disabled', true);
	}else if (txt2.html() !== "") {
//console.log('5');
		btn.addClass('opacity_5');
		btn.prop('disabled', true);
	}else if (txt2.val() !== "") {
//console.log('6');
		btn.addClass('opacity_5');
		btn.prop('disabled', true);
	}else{
//console.log('7');
		$('#add-match-btn').removeClass('opacity_5');
		$('#add-match-btn').prop('disabled', false);
	}

});
*/
/*
const avatarUploadActions = function () {
$('#avatar-upload').on('change', function () {
	readFile(this);
});
$('.upload-result').on('click', function (ev) {
$uploadCrop.croppie('result', {
	type: 'canvas',
	size: 'viewport',
}).then(function (resp) {
	$('.fn_user_avatar').val(resp);
	$(".fn_delete_avatar").val(1);
	$(".user_page__user_info__photo__holder img").attr('src', resp);
});
$('.fn_resize_canvas').fadeOut(500);
});
$uploadCrop = $('#upload-demo').croppie({
enableExif: true,
viewport: {
	width: 200,
	height: 200,
	type: 'circle'
},
boundary: {
width: 300,
height: 300
}
});

function readFile(input) {
$('.fn_resize_canvas').fadeIn(500);
if (input.files && input.files[0]) {
	var reader = new FileReader();
	reader.onload = function (e) {
		$('.upload-demo').addClass('ready');
		$uploadCrop.croppie('bind', {
			url: e.target.result
		}).then(function () {
//console.log('jQuery bind complete');
		});
	};
	reader.readAsDataURL(input.files[0]);
} else
{
swal("Sorry - you're browser doesn't support the FileReader API");
}
}
};
*/
jQuery(document).ready(function ($) {
//	setTimeOffsetCookie();
  onlyDigits()
  userActions()
  forgotPasswordActions()
  loginActions()
  sendMatchResultActions()
  moderateMatchActions()
  deleteMatchActions()
  addMatchActions()
  joinMatchActions()
  joinTournamentActions()
  leaveTournamentActions()
  friendActions()
  sendValidationAction()
//	avatarUploadActions();
  $('body').on('tournament-updated', joinTournamentActions)
})

var afterRegFunction = function () {
    if (jQuery('.games_nicknames').length) {
      window.scrollTo(0, 0);
      let posLeft = jQuery('.games_nicknames').offset().left
      jQuery('body').prepend('<div class="popup_info--starting"><h3 class="popup_info--header">' + __('Платформы', 'earena_js') + '</h3><p class="popup_info--text">' + __('Чтобы добавить игры на нужной вам платформе, просто щелкните по иконке редактирования, выберите подходящие игры и сохраните изменения.', 'earena_js') + '</p><div class="popup_info--button_wrapper"><button class="popup_info--js_ok">' + __('Понятно', 'earena_js') + '</button></div></div>')
      let posTop = jQuery('.games_nicknames').offset().top - jQuery('.popup_info--starting').outerHeight() - 30;
      posLeft += (jQuery('.games_nicknames').width() / 2)
      posLeft -= (jQuery('.popup_info--starting').outerWidth() / 2)
      console.log(jQuery('.games_nicknames').offset().top)

      let scrollPopup = posTop;
      jQuery('.games_nicknames').css('z-index', 13)
      jQuery('.games_nicknames').css('position', 'relative')
      jQuery('.popup_info--starting').css('top', posTop + 'px')
      jQuery('.popup_info--starting').css('left', posLeft + 'px')
      jQuery('.popup_info--starting').fadeIn()
      jQuery('body').prepend('<div class="games_nicknames--background"></div>')
      jQuery('.games_nicknames--background').fadeIn()
      var body = $("html, body");
      let quter = $("html, body").outerWidth() > 1000 ? 6 : 2;
      setTimeout(() => {
        scrollPopup -= jQuery('.popup_info--starting').outerHeight() / quter
        body.animate({scrollTop: scrollPopup}, 500, 'swing', function () {
        });
      }, 200)
      jQuery('.popup_info--js_ok').click(function () {
        jQuery('.games_nicknames--background').fadeOut()
        jQuery('.popup_info--starting').fadeOut()
        let url = new URL(window.location.href)
        let params = url.searchParams
        params.delete('after_registration')
        // window.location = url
      })
      // body.stop().animate({scrollTop: scrollPopup}, 500, 'swing', function() {});
    }
}
})
