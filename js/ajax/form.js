'use strict';

(function ($) {
  /*
    is_user_logged_in,
    is_ea_admin,

    dataGames,
    currentGameId,

    isProfile,
    siteURL,
    siteThemeFolderURL,
    ea_icons
    platformsArr

    isAdminTournamentsList

    - глобальные переменные, которые используются для составления URI.
      Задаются в header.php
  */
  document.addEventListener('DOMContentLoaded', () => {
    try {
      const { __, _x, _n, _nx } = wp.i18n;

      let deviceHeight = window.innerHeight && document.documentElement.clientHeight ?
                        Math.min(window.innerHeight, document.documentElement.clientHeight) :
                        window.innerHeight ||
                        document.documentElement.clientHeight ||
                        document.getElementsByTagName('body')[0].clientHeight;
      let inputEventListenerFlag = {};

      // Данные для форм при инициализации формы
      let attrForms = {};

      window.form = {
        init : (attr) => {
          // Данные для форм при инициализации формы для доступа из внутренних ф-й
          attrForms[attr.idForm] = {
            ID : attr.idForm,
            FORM : document.querySelector(`#${attr.idForm}`),
            SELECTOR_FOR_TEMPLATE_REPLACE : attr.selectorForTemplateReplace ? attr.selectorForTemplateReplace : '',
            SELECTOR_WRAPPER_FORM : attr.selectorClosestWrapperForm ? attr.selectorClosestWrapperForm : false,
            CLASS_FOR_ADD_WRAPPER_FORM : attr.classForAddClosestWrapperForm ? attr.classForAddClosestWrapperForm : false,
            _SETTINGS : attr
          };

          if (attrForms[attr.idForm].FORM) {
            // Prefix (используется для выбора шаблона после отправки форм и других отличающий действий)
            attrForms[attr.idForm].prefixForm = attrForms[attr.idForm].FORM.dataset.prefix;

            // Обертка для собержимого шаблонов
            attrForms[attr.idForm].wrapperFormNode = document.querySelector(attrForms[attr.idForm].SELECTOR_FOR_TEMPLATE_REPLACE);

            // Получение кнопки для отправки
            attrForms[attr.idForm].buttonSubmit = attrForms[attr.idForm].FORM.querySelector('button[type="submit"]');

            inputEventListenerFlag[attr.idForm] = false;

            window.form.parseCheckboxes(attr.idForm);

            // Поиск Селектов
            window.select(attrForms[attr.idForm].FORM);

            if (attrForms[attr.idForm].FORM.closest('.popup')) {
              // Ф-я поиска дополнительных кнопок закрытия попапов
              window.form.additionButtonClosePopup(attrForms[attr.idForm].FORM.closest('.popup'));
            }

            // Запуск валидации по клику на форму
            attrForms[attr.idForm].FORM.addEventListener('click', (evt) => {
              if (evt.target.tagName !== 'A') {
                window.form.validateForm(attr.idForm);
              }
            });

            return true;
          } else {
            return false;
          }
        },
        // Ф-я отправки формы
        formSubmitFunction : (formId) => {
          let form = attrForms[formId].FORM;
          let formPrefix = attrForms[formId].prefixForm;
          let buttonSubmit = attrForms[formId].buttonSubmit;
          let wrapperFormNode = attrForms[formId].wrapperFormNode;

          form.addEventListener('submit', (evt) => {
            // Прерываем стандартное действие кнопки для XMLHttpRequest
            evt.preventDefault();

            /*
              *** Префиксы (prefix) ***
              *************************

              --- data-prefix="" в тегах <form>
            */
            let prefix = '';
            if (formPrefix !== '' && formPrefix && formPrefix !== undefined) {
              prefix = `-${formPrefix}`;
            }

            // Объект для отправки на сервер
            let formData = {};
            let dataForm = new FormData(form);

            // Получение всех инпутов
            let inputs = form.querySelectorAll('input');
            // Собираем значения из инпутов
            if (inputs.length > 0) {
              inputs.forEach(inputField => {
                let nameInput = inputField.name;
                let valueInput = inputField.value;

                if (nameInput && valueInput) {
                  if (inputField.type === 'radio') {
                    if (inputField.checked) {
                      formData[`${nameInput}`] = valueInput;
                    }
                  } else if (inputField.type === 'checkbox') {
                    if (!formData[`${nameInput}`] && inputField.checked) {
                      formData[`${nameInput}`] = valueInput;
                    } else if (formData[`${nameInput}`] && !Array.isArray(formData[`${nameInput}`]) && inputField.checked) {
                      let previousValue = formData[`${nameInput}`];

                      formData[`${nameInput}`] = [previousValue, valueInput];
                    } else if (formData[`${nameInput}`] && Array.isArray(formData[`${nameInput}`]) && inputField.checked) {
                      formData[`${nameInput}`].push(valueInput);
                    }
                  } else if (inputField.type === 'file' && dataForm) {
                    //console.log(inputField.files);
                    $.each(inputField.files, function (key, value) {
                      dataForm.append(key, value);
                    });
                  } else {
                    formData[`${nameInput}`] = valueInput;
                  }
                }
              });
            }

            // Полечение всех текстовых обрастей формы
            let textareas = form.querySelectorAll('textarea');
            // Собираем значения из  многострочных полей ввода
            if (textareas.length > 0) {
              textareas.forEach((textareaField, i) => {
                let nameTextarea = textareaField.name;
                let valueTextarea = textareaField.value;

                if (nameTextarea && valueTextarea) {
                  formData[`${nameTextarea}`] = valueTextarea;
                }
              });
            }

            /***** START Actions AJAX *****/
            // LOGIN
            if ( formId.indexOf('login') > -1 ) {
              // Логирование
              if (prefix.indexOf('signin') > -1) {
                // Ф-я логирования
                formData['action'] = 'ajax_login';
              }

              // Регистрация
              if (prefix.indexOf('signup') > -1) {
                // Ф-я регистрации
                formData['action'] = 'earena_2_ajax_register';
              }

              // Восстановление
              if (prefix.indexOf('forgot') > -1) {
                // Ф-я восстановления пароля
                formData['action'] = 'ajax_forgot';
              }

              // Сброс
              if (prefix.indexOf('reset') > -1) {
                // Ф-я сброса пароля
                formData['action'] = 'earena_2_ajax_reset_pass';
              }
            }

            // FRIENDS
            if ( formId.indexOf('friends') > -1) {
              // Друзья - Добавление
              if (prefix.indexOf('add') > -1) {
                // Ф-я добавления в друзья
                formData['action'] = 'earena_2_add_request_friend';
              }

              // Друзья - Подтверждение
              if (prefix.indexOf('apply') > -1) {
                // Ф-я подтверждения добавления в друзья
                formData['action'] = 'accept_friend';
              }

              // Друзья - Отмена
              if (prefix.indexOf('reject') > -1) {
                // Ф-я Отмена добавления в друзья
                formData['action'] = 'del_request_friend';
              }

              // Друзья - Удаление
              if (prefix.indexOf('delete') > -1) {
                // Ф-я удаления из друзей
                formData['action'] = 'remove_friend';
              }
            }

            // MATCH
            if ( formId.indexOf('match') > -1) {
              // Создать
              if (prefix.indexOf('create') > -1) {
                // Получение разметки для шага 2
                formData['action'] = 'earena_2_get_create_match_next_html';
              }

              // Создать (шаг 2)
              if (prefix.indexOf('add') > -1) {
                // Добавление матча
                formData['action'] = 'add_match';

                if (formData['bet'] && (formData['bet'] === '0' || formData['bet'] === 0) && !formData['free']) {
                  delete formData.bet;

                  formData['free'] = '1';

                  // console.log('free=' + formData['free'],  'bet=' + formData['bet']);
                }
              }

              // Удалить
              if (prefix.indexOf('delete') > -1) {
                // Удаление матча
                formData['action'] = 'delete_match';
              }

              // Присоединиться
              if (prefix.indexOf('accept') > -1) {
                // Присоединение к матчу
                formData['action'] = 'join_match';
              }
            }

            // TOURNAMENT
            if ( formId.indexOf('tournament') > -1 ) {
              if (prefix.indexOf('add-player') > -1) {
                // (АДМИН) Добавление игрока к Турниру
                formData['action'] = 'earena_2_add_player_tournament';
              }

              if (prefix.indexOf('leave') > -1) {
                // Отменна регистрации на Турнир
                formData['action'] = 'earena_2_leave_tournament';
              }

              if (prefix.indexOf('join') > -1) {
                // Регистрация на Турнир
                formData['action'] = 'earena_2_join_tournament';
              }

              if (prefix.indexOf('cancel') > -1) {
                // Отмена турнира
                formData['action'] = 'ea_cancel_tournament';
              }

              if (prefix.indexOf('delete-cron') > -1) {
                // Удаление запланированного турнира
                formData['action'] = 'ea_delete_tournament_cron';
              }

              if (prefix.indexOf('delete-tournament') > -1) {
                // Удаление турнира
                formData['action'] = 'ea_delete_tournament';
              }
            }

            // CHAT
            if ( formId.indexOf('chat') > -1 ) {
              dataForm.append('action', 'ajax_match_results_and_fileload');
            }

            // COMPLAINT
            if ( formId.indexOf('complaint') > -1) {
              // Создать
              if (prefix.indexOf('create') > -1) {
                formData['action'] = 'moderate_match';
              }

              // (АДМИН) Удалить
              if (prefix.indexOf('delete') > -1) {
                formData['action'] = 'earena_2_del_moderate';
              }
            }

            // GAME
            if ( formId.indexOf('game') > -1) {
              // Добавление игры
              formData['action'] = 'setPlafroms';
            }

            // VERIFICATION
            if ( formId.indexOf('verification') > -1) {
              // (АДМИН) Подтверждение верификации
              if (prefix.indexOf('apply') > -1) {
                // Ф-я подтверждения верификации
                formData['action'] = 'earena_2_apply_verification_request';
              }

              // (АДМИН) Отказ в верификации
              if (prefix.indexOf('reject') > -1) {
                // Ф-я отказа в верификации
                formData['action'] = 'earena_2_remove_verification_request';
              }

              // Запрос на верификацию
              if (prefix.indexOf('request') > -1) {
                dataForm.append('action', 'verification_fileload');
              }
            }

            // CONTACT
            if ( formId.indexOf('contact') > -1 ) {
              dataForm.append('action', 'earena_2_sendmail');
            }

            // WARNING
            if ( formId.indexOf('warning') > -1 ) {
              if (prefix.indexOf('add') > -1) {
                // (АДМИН) Добавление предупреждения
                formData['action'] = 'ea_add_yc';
              }

              if (prefix.indexOf('delete') > -1) {
                // (АДМИН) Удаление предупреждения
                formData['action'] = 'ea_del_yc';
              }
            }

            // STREAM
            if ( formId.indexOf('stream') > -1 ) {
              if (prefix.indexOf('add') > -1) {
                // Добавление ссылки на стрим
                formData['action'] = 'earena_2_set_translation';
              }
            }

            // VIP
            if ( formId.indexOf('vip') > -1 ) {
              if (prefix.indexOf('buy') > -1) {
                // Покупка VIP
                formData['action'] = 'getVIP';
              }

              if (prefix.indexOf('gift') > -1) {
                // VIP в подарок
                formData['action'] = 'ea_add_vip';
              }
            }

            // BALANCE
            if ( formId.indexOf('balance') > -1 ) {
              if (prefix.indexOf('add') > -1) {
                // Пополнение баланса
                formData['action'] = 'ea_add_money_by_admin';
              }
            }

            // BLOCK
            if ( formId.indexOf('block') > -1 ) {
              if (prefix.indexOf('add') > -1) {
                // (АДМИН) Добавление блокировки
                formData['action'] = 'ea_add_blocked';
              }

              if (prefix.indexOf('delete') > -1) {
                // (АДМИН) Удаление блокировки
                formData['action'] = 'ea_del_blocked';
              }
            }

            /***** END Actions AJAX *****/

            // Popup
            let popup = form.closest('.popup');

            // Обработчик старта отправки
            var onBeforeSend = (status) => {
              buttonSubmit.classList.add('sending');

              // Обрываю стандартное сообщение об старте отправки формы если :
              if (
                  (formId.indexOf('login') > -1 && (prefix.indexOf('signin') > -1 ||
                  prefix.indexOf('signup') > -1  || prefix.indexOf('reset') > -1))  ||
                  (formId.indexOf('verification') > -1 && prefix.indexOf('request') > -1)  ||
                  (formId.indexOf('match') > -1 && prefix.indexOf('accept') > -1) ||
                  (formId.indexOf('stream') > -1 && prefix.indexOf('add') > -1) ||
                  (formId.indexOf('tournament') > -1 && prefix.indexOf('join') > -1)
                ) {
                window.form.showAJAXMessage(popup);

                return;
              }

              let templateBeforeSend = document.querySelector(`#${formId}-beforesend`);

              if (wrapperFormNode && templateBeforeSend) {
                wrapperFormNode.innerHTML = '';

                let templateContentBeforeSend = templateBeforeSend.content;
                let cloneTemplate = templateContentBeforeSend.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);

                // Проверяю - надо ли добавлять активный класс родителю
                if (attrForms[formId].CLASS_FOR_ADD_WRAPPER_FORM) {
                  // Добавляю указанный класс
                  // Если надо как-то родителя при отправке формы изменять
                  wrapperFormNode.closest(attrForms[formId].SELECTOR_WRAPPER_FORM).classList.add(attrForms[formId].CLASS_FOR_ADD_WRAPPER_FORM);
                }
              }

              console.log('Старт: ', status);
            };

            // Обработчик успешной отправки
            var onSuccess = (response) => {
              buttonSubmit.classList.remove('sending');

              // ЛОГИРОВАНИЕ
              if ( formId.indexOf('login') > -1 ) {
                // Логин
                if (prefix.indexOf('signin') > -1) {
                  if (response.data.loggedin === true) {
                    document.location.href = (earena_2_ajax.redirecturl.indexOf('?') > -1) ? (earena_2_ajax.redirecturl + '&login-status=success') : (earena_2_ajax.redirecturl + '?login-status=success');
                  } else {
                    window.form.showAJAXMessage(popup, response.data.message, 2000);

                    return;
                  }
                }

                // Регистрация
                if (prefix.indexOf('signup') > -1) {
                  if (response.data.registered) {
                    document.location.href = 'profile?after_registration=1';
                  } else {
                    let message = '';

                    $.each(response.data.errors, function (key, val) {
                      console.log(key + ' : '+ val);
                      message += val + '<br>';
                    });

                    window.form.showAJAXMessage(popup, message);

                    return;
                  }
                }

                // Сброс
                if (prefix.indexOf('reset') > -1) {
                  if (response.data.error) {
                    window.form.showAJAXMessage(popup, response.data.error);

                    return;
                  }

                  console.log(response);
                }
              }

              // ВЕРИФИКАЦИЯ
              if ( formId.indexOf('verification') > -1 ) {
                if (prefix.indexOf('request') > -1) {
                  if (response.success === false) {
                    window.form.showAJAXMessage(popup, response.data, 2000);

                    return;
                  }
                }
              }

              // MATCH
              if ( formId.indexOf('match') > -1 ) {
                // После успешного создания / удаления / присоединения - обновляем все матчи по клику на таб платформы
                let resetShowResult = function () {
                  let tabAllPlatform = document.querySelector('.tabs button[data-tab-type="-1"]');

                  if (tabAllPlatform) {
                    tabAllPlatform.click();
                  }
                };

                response = JSON.parse(response);

                // Создание шаг 1
                if ((prefix.indexOf('create') > -1)) {
                  if (response.success === 1 && wrapperFormNode) {
                    // Переписываю
                    wrapperFormNode.innerHTML = response.data;

                    // Повторная инициализация формы
                    window.form.init(attrForms[formId]._SETTINGS);

                    if (attrForms[formId].SELECTOR_WRAPPER_FORM) {
                      // Регулировка высоты попапа
                      if (wrapperFormNode.closest(attrForms[formId].SELECTOR_WRAPPER_FORM).offsetHeight >= deviceHeight) {
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_WRAPPER_FORM).classList.add('scroll-content');
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_WRAPPER_FORM).classList.remove('sending');
                      } else {
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_WRAPPER_FORM).classList.remove('scroll-content');
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_WRAPPER_FORM).classList.add('sending');
                      }
                    }

                    console.log(response);

                    return;
                  } else {
                    onError(response, prefix);

                    console.log(response);

                    return;
                  }
                }

                // Создание шаг 2 / Удалить / Присоединиться
                if ((prefix.indexOf('add') > -1) || (prefix.indexOf('delete') > -1)) {
                  if (response.success === 1) {
                    // После успешного создания / удаления - обновляем все матчи по клику на таб платформы
                    resetShowResult();
                  } else {
                    onError(response, prefix);

                    console.log(response);

                    return;
                  }
                }

                if (prefix.indexOf('accept') > -1) {
                  /*
                 		ACCEPT return value :
                 		0 - показывает текст сообщения над полем пароля
                 		1 - УСПЕХ
                 		2 - показывает окно ОШИБКИ (матч не доступен)
                 		3 - окно ошибки со ссылкой на Профиль
                 		4 - замена формы попапа на форму с пополнением
                 	*/

                  if (response.status !== 0) {
                    // После успешного (или статуса 2,3,4) присоединения - обновляем все матчи по клику на таб платформы
                    resetShowResult();
                  }

                  if (response.status === 0) {
                    window.form.showAJAXMessage(popup, response.content, 2000);

                    console.log(response);

                    return;
                  } else if (response.status === 2) {
                    onError(response, prefix);

                    return;
                  } else if (response.status === 3) {
                    onError(response, 'no-game-or-platform');

                    return;
                  } else if (response.status === 4) {
                    let pay = popup.querySelector('.pay');

                    if (pay) {
                      let payBalance = pay.querySelector('.pay__column--balance');
                        payBalance.textContent = '$' + response.balance;
                        payBalance.classList.add('pay__column--red');

                      buttonSubmit.classList.add('hidden');

                      let paySmallBalance = pay.querySelector('.pay__button');
                      if (!paySmallBalance) {
                        let smallBalanceHTML = `
                          <p class="pay__text pay__text--red">
                            ${__( 'На вашем счете недостаточно средств', 'earena_2' )}
                          </p>

                          <a class="pay__button button button--blue" href="${siteURL}/wallet/?wallet_action=add">
                            <span>
                              ${__( 'Пополнить счет', 'earena_2' )}
                            </span>
                          </a>
                        `;

                        pay.insertAdjacentHTML('beforeend', smallBalanceHTML);
                      }
                    }

                    return;
                  }
                }
              }

              // TOURNAMENT
              if ( formId.indexOf('tournament') > -1 ) {
                if ((prefix.indexOf('add-player') > -1) || prefix.indexOf('leave') > -1 || prefix.indexOf('join') > -1) {
                  if (response.success === false && !response.data.error_pass) {
                    onError(response, prefix);

                    return;
                  } else if (response.success === false && response.data.error_pass) {
                    window.form.showAJAXMessage(popup, response.data.message, 2000);

                    console.log(response);
                    return;
                  }
                }

                if ((prefix.indexOf('delete-cron') > -1) || (prefix.indexOf('delete-tournament') > -1) || (prefix.indexOf('cancel') > -1)) {
                  response = JSON.parse(response);

                  if (response.success === 0) {
                    onError(response, prefix);

                    return;
                  }
                }
              }

              // CHAT
              if ( formId.indexOf('chat') > -1 ) {
                if (response.success === true) {
                  window.form.reloadPage();

                  return;
                }
              }

              // CONTACT
              if ( formId.indexOf('contact') > -1 ) {
                let openPopupButtonsSuccessContactForm = document.querySelector('button[name="success"].openpopup');
                let openPopupButtonsErrorContactForm = document.querySelector('button[name="error"].openpopup');

                if (openPopupButtonsSuccessContactForm && openPopupButtonsErrorContactForm) {
                  if (response.success === true) {
                    let filesPreviewList = form.querySelector('.files__preview');
                    if (filesPreviewList) {
                      filesPreviewList.innerHTML = '';
                    }

                    form.reset();

                    openPopupButtonsSuccessContactForm.click();
                  } else {
                    openPopupButtonsErrorContactForm.click();

                    let showErrorMessage = document.querySelector('.popup__information--contact-error');

                    if (showErrorMessage) {
                      showErrorMessage.textContent = response.data;
                    }
                  }
                }
              }

              // COMPLAINT
              if ( formId.indexOf('complaint') > -1) {
                // Создать
                if (prefix.indexOf('create') > -1) {
                  response = JSON.parse(response);
                }

                // Удалить
                if (prefix.indexOf('delete') > -1) {
                  response = JSON.parse(response);

                  if (response.success === 1) {
                    if (wrapperFormNode) {
                      wrapperFormNode.innerHTML = response.content;

                      // ADMIN complait forms
                      let complaintAdminChatForms = wrapperFormNode.querySelectorAll('form[id*="form-complaint-"]');

                      if (complaintAdminChatForms.length > 0) {
                        complaintAdminChatForms.forEach((complaintAdminChatForm, i) => {
                          // Инициализация полученных форм
                          let attrFormComplaint = {
                            idForm: complaintAdminChatForm.id,
                            // Содержимое элемента может очищаться при отправке формы и заменяться содержимым шаблона
                            selectorForTemplateReplace: '#complaint-container',
                          };
                          window.form.init(attrFormComplaint);
                        });
                      }
                    }

                    console.log(response);

                    return;
                  } else {
                    onError(response, prefix);

                    return;
                  }
                }
              }

              // WARNING
              if ( formId.indexOf('warning') > -1 ) {
                response = JSON.parse(response);

                // Добавление
                if ((prefix.indexOf('add') > -1) || (prefix.indexOf('delete') > -1)) {
                  if (response.success !== 1) {
                    onError(response, prefix);

                    console.log(response);

                    return;
                  }
                }
              }

              // STREAM
              if ( formId.indexOf('stream') > -1 ) {
                if (prefix.indexOf('add') > -1) {
                  response = JSON.parse(response);

                  if (response.success === 0) {
                    window.form.showAJAXMessage(popup, response.message, 2000);

                    console.log(response);

                    return;
                  }
                }
              }

              // VIP
              if ( formId.indexOf('vip') > -1 ) {
                response = JSON.parse(response);

                if (prefix.indexOf('buy') > -1) {
                  window.form.showResponseText(attrForms[formId].wrapperFormNode.closest('.popup'), response.message);

                  console.log(response);

                  return;
                }

                if (prefix.indexOf('gift') > -1) {
                  if (response.success !== 1) {
                    onError(response, prefix);

                    console.log(response);

                    return;
                  }
                }
              }

              // BLOCK
              if ( formId.indexOf('block') > -1 ) {
                response = JSON.parse(response);

                // Добавление
                if ((prefix.indexOf('add') > -1)) {
                  if (response.success !== 1) {
                    onError(response, prefix);

                    console.log(response);

                    return;
                  }
                }
              }

              // BALANCE
              if ( formId.indexOf('balance') > -1 ) {
                response = JSON.parse(response);

                if (prefix.indexOf('add') > -1) {
                  if (response.success !== 1) {
                    onError(response, prefix);

                    console.log(response);

                    return;
                  }
                }
              }

              // Получаю шаблон
              let templateSuccess = document.querySelector(`#${formId}-success${prefix}`);

              if (!templateSuccess) {
                templateSuccess = document.querySelector(`#${formId}-success`);
              }

              if (wrapperFormNode && templateSuccess) {
                wrapperFormNode.innerHTML = '';

                let templateContentSuccess = templateSuccess.content;
                let cloneTemplate = templateContentSuccess.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);
              }

              // LOGIN
              if ( formId.indexOf('login') > -1 ) {
                // Восстановление
                if (prefix.indexOf('forgot') > -1) {
                  if (response.data.retrieve_password == true) {
                    window.form.showResponseText(popup, response.data.message);

                    console.log('Успех', response.data.message);
                  } else {
                    window.form.showResponseText(popup, response.data.message);

                    console.log('Ошибка', response.data.message);
                  }
                }

                // Сброс
                if (prefix.indexOf('reset') > -1 && response.data.message) {
                  window.form.showResponseText(popup, response.data.message);
                }
              }

              // VERIFICATION (принять/отклонить)
              // FRIENDS (принять/отклонить/удалить)
              if ( (formId.indexOf('verification') > -1 ) || formId.indexOf('friends') > -1) {
                if (
                    (prefix.indexOf('apply') > -1) ||
                    (prefix.indexOf('reject') > -1) ||
                    (prefix.indexOf('delete') > -1)
                  ) {
                  response = JSON.parse(response);

                  if (response.success === 1) {
                    window.popup.userInfo(false, popup);

                    window.form.reloadPage(200, true);
                  } else {
                    window.form.showResponseText(popup, response.content);
                  }
                }
              }

              // GAME
              if ( formId.indexOf('game') > -1) {
                response = JSON.parse(response);

                let sectionUpdateArea = document.querySelector('#sections-games-profile-update');

                if (sectionUpdateArea && response.success === 1) {
                  sectionUpdateArea.innerHTML = response.data;

                  // Получаем кнопки открытия попапов
                  let openPopupButtons = sectionUpdateArea.querySelectorAll('.openpopup');
                  if (openPopupButtons.length > 0) {
                    openPopupButtons.forEach((openPopupButton, i) => {
                      // Активация кнопки открытия попапа
                      window.popup.activatePopup(openPopupButton);
                    });
                  }
                }
              }

              // MATCH
              if ( formId.indexOf('match') > -1 ) {
                // Присоединиться
                if (prefix.indexOf('accept') > -1) {
                  let matchId = response.match_id;
                  let goToMatchLink = wrapperFormNode.querySelector('#go-to-math-link');

                  if (matchId && goToMatchLink) {
                    goToMatchLink.href = goToMatchLink.href + matchId;
                  }
                }
              }

              // TOURNAMENT
              if ( formId.indexOf('tournament') > -1 ) {
                if (prefix.indexOf('add-player') > -1 ||
                    prefix.indexOf('leave') > -1 ||
                    prefix.indexOf('join') > -1 ||
                    prefix.indexOf('delete-cron') > -1 ||
                    prefix.indexOf('delete-tournament') > -1 ||
                    prefix.indexOf('cancel') > -1
                  ) {
                  window.form.reloadPage(200, true);
                }
              }

              // WARNING
              if ( formId.indexOf('warning') > -1 ) {
                // Добавление/Удаление
                if ((prefix.indexOf('add') > -1) || (prefix.indexOf('delete') > -1)) {
                  window.form.showResponseText(popup, response.content);

                  if (isProfile) {
                    window.form.reloadPage(false, true);
                  }
                }
              }

              // STREAM
              if ( formId.indexOf('stream') > -1 ) {
                if (prefix.indexOf('add') > -1) {
                  // Отображаю новую ссылку
                  let streamLink = document.querySelector('.stream__link');
                  if (streamLink && formData['url']) {
                    streamLink.href = formData['url'];
                    streamLink.textContent = formData['url'];
                  }
                }
              }

              // BLOCK
              if ( formId.indexOf('block') > -1 ) {
                window.form.reloadPage(false, true);
              }

              // BALANCE
              if ( formId.indexOf('balance') > -1 ) {
                window.form.reloadPage(false, true);
              }

              // VIP
              if ( formId.indexOf('vip') > -1 ) {
                if (prefix.indexOf('gift') > -1) {
                  window.form.showResponseText(popup, response.content);

                  window.form.reloadPage(false, true);
                }
              }

              if (popup) {
                // Ф-я поиска дополнительных кнопок закрытия попапов
                window.form.additionButtonClosePopup(popup);
              }

              console.log('Успех: ', response);
            };

            // Обработчик не успешной отправки
            var onError = (response, prefix='') => {
              buttonSubmit.classList.remove('sending');

              if ( formId.indexOf('contact') > -1 ) {
                let openPopupButtonsErrorContactForm = form.querySelector('button[name="error"].openpopup');

                if (openPopupButtonsErrorContactForm) {
                  openPopupButtonsErrorContactForm.click();

                  console.log('Error:', response);

                  return;
                }
              }

              let templateError = document.querySelector(`#${formId}-error${prefix}`);

              if (!templateError) {
                templateError = document.querySelector(`#${formId}-error`);
              }

              if (wrapperFormNode && templateError) {
                wrapperFormNode.innerHTML = '';

                let templateContentError = templateError.content;
                let cloneTemplate = templateContentError.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);

                // MATCH // WARNING // TOURNAMENT
                if (
                    ((formId.indexOf('match') > -1) && (prefix.indexOf('accept') > -1)) ||
                    ((formId.indexOf('warning') > -1) && (prefix.indexOf('add') > -1 || prefix.indexOf('delete') > -1)) ||
                    ((formId.indexOf('tournament') > -1) && (prefix.indexOf('add-player') > -1 || prefix.indexOf('leave') > -1 || prefix.indexOf('join') > -1))
                ) {
                  let text = response.content ? response.content : (response.data ? response.data : false);

                  window.form.showResponseText(popup, text);
                }
              }

              console.log('Ошибка: ', response);

              if (popup) {
                // Ф-я поиска дополнительных кнопок закрытия попапов
                window.form.additionButtonClosePopup(popup);
              }
            };

            // Nonce
            if (!formData['security']) {
              formData['security'] = earena_2_ajax.nonce;
            }

            // Удаляю дефолтный элемент с собранными файлами (файлы через append() добавляются)
            if (dataForm.has('files')) {
              dataForm.delete('files');
            }

            if (((formId.indexOf('verification') > -1) && (prefix.indexOf('request') > -1)) || ( formId.indexOf('contact') > -1) || ( formId.indexOf('chat') > -1)) {
              // dataForm - потомок FormData() [для передачи файлов]
              // for(var pair of dataForm.entries()) {
              //    console.log(pair[0]+ ', '+ pair[1]);
              // }

              // Для передачи файлов
              $.ajax({
                url: earena_2_ajax.url,
                type: 'POST',
                data: dataForm,
                cache: false,
                dataType: 'json',
                // отключаем обработку передаваемых данных, пусть передаются как есть
                processData: false,
                // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
                contentType: false,
                beforeSend: (response) => {
                  onBeforeSend(response.readyState);
                },
                success: (response) => {
                  onSuccess(response);
                },
                error: (response) => {
                  onError(response);
                }
              });
            } else {
              // formData - обычный объект
              console.log(formData);

              // Обычный запрос (без передачи файлов)
              $.ajax({
                url: earena_2_ajax.url,
                data: formData,
                type: 'POST',
                beforeSend: (response) => {
                  onBeforeSend(response.readyState);
                },
                success: (response) => {
                  onSuccess(response);
                },
                error: (response) => {
                  onError(response);
                }
              });
            }
          });
        },
        // Ф-я валидации формы
        validateForm : (formId) => {
          let form = attrForms[formId].FORM;
          let buttonSubmit = attrForms[formId].buttonSubmit;

          // Validate flag
          let notValid = false;

          // Получение всех инпутов
          let allInputs = form.querySelectorAll('input');

          // Полечение всех текстовых обрастей формы
          let allTextarea = form.querySelectorAll('textarea');

          // Проверка инпутов
          if (allInputs.length > 0) {
            allInputs.forEach((item, i) => {
              if (item.type !== 'submit') { // && item.type !== 'file'
                item.autocomplete = 'off';

                // Проверка по возрасту
                if (item.type === 'date') {
                  if (item.valueAsNumber) {
                    var currentDate = new Date();
                    var birthdayUser = new Date(item.valueAsNumber);

                    var goodYear = (currentDate.getFullYear() - birthdayUser.getFullYear()) < 18;
                    var googMonth = (currentDate.getFullYear() - birthdayUser.getFullYear()) === 18 && currentDate.getMonth() < birthdayUser.getMonth();
                    var goodDay = (currentDate.getFullYear() - birthdayUser.getFullYear()) === 18 && currentDate.getMonth() === birthdayUser.getMonth() && currentDate.getDate() < birthdayUser.getDate();

                    if ( goodYear || googMonth || goodDay) {
                      //console.log(birthdayUser.getFullYear(), 'Not old enough!');

                      // Если проверка по возрасту не прошла
                      item.parentNode.nextElementSibling.classList.add('no-old-enough');
                    } else {
                      // Если проверка по возрасту прошла
                      item.parentNode.nextElementSibling.classList.remove('no-old-enough');
                    }
                  }
                }

                if (item.type === 'password' && item.name === 'pass_2') {
                  if ( item.value !== form.querySelector('input[name="pass_1"]').value ) {
                    notValid = true;
                  } else {
                    notValid = false;
                  }
                }

                if (!item.validity.valid || (notValid === true && item.type === 'password' && item.name === 'pass_2')) {
                  notValid = true;

                  if (!item.closest('.invalid')) {
                    // Проверка наличия обертки
                    if (item.closest('.form__row')) {
                      item.closest('.form__row').classList.add('invalid');
                      item.closest('.form__row').classList.remove('valid');
                    }
                  }
                } else {
                  if (item.closest('.invalid')) {
                    // Проверка наличия обертки
                    if (item.closest('.form__row')) {
                      item.closest('.form__row').classList.remove('invalid');
                      item.closest('.form__row').classList.add('valid');
                    }
                  }
                }

                if (inputEventListenerFlag[formId] === false) {
                  // Перезапуск при вводе значений
                  item.addEventListener('input', () => {
                    window.form.validateForm(formId);
                  });
                }
              }
            });
          }

          //Проверка областей текста
          if (allTextarea.length > 0) {
            allTextarea.forEach((item, i) => {
              if (!item.validity.valid) {
                notValid = true;

                // Проверка наличия обертки
                if (item.closest('.form__row')) {
                  item.closest('.form__row').classList.add('invalid');
                  item.closest('.form__row').classList.remove('valid');
                }
              } else {
                if (item.closest('.invalid')) {
                  // Проверка наличия обертки
                  if (item.closest('.form__row')) {
                    item.closest('.form__row').classList.remove('invalid');
                    item.closest('.form__row').classList.add('valid');
                  }
                }
              }

              if (inputEventListenerFlag[formId] === false) {
                item.addEventListener('input', () => {
                  window.form.validateForm(formId);
                });
              }
            });
          }

          //console.log(notValid);

          // Выполнять, если есть кнопка сабмита
          if (buttonSubmit) {
            if (!notValid) {
              buttonSubmit.disabled = false;
              buttonSubmit.classList.remove('disabled');
            } else {
              buttonSubmit.disabled = true;
              buttonSubmit.classList.add('disabled');
            }

            // Проверка на то, был ли уже повешен обработчик клика на кнопку ранее
            if (inputEventListenerFlag[formId] === false) {

              // Если - нет - тогда вешаем
              window.form.formSubmitFunction(formId);
            }
          }

          inputEventListenerFlag[formId] = true;
        },
        // Перебор чекбоксов
        parseCheckboxes : (formId) => {
          let form = attrForms[formId].FORM;

          let checkboxes = form.querySelectorAll('input[type="checkbox"]');
          if (checkboxes.length > 0) {
            checkboxes.forEach((checkboxItem, i) => {
              // Поиск зависимых чекбоксов в форме
              if (checkboxItem.dataset.controlFieldId) {
                let fieldControl = form.querySelector(`#${checkboxItem.dataset.controlFieldId}`);

                if (fieldControl) {
                  // Вызов ф-и изменения связанных полей
                  window.form.checkboxControlField(formId, checkboxItem, fieldControl, checkboxItem.dataset.controlToggle);
                }
              }

              // Поиск чекбокса для включения/отключения трансляции в матче
              if (checkboxItem.dataset.matchId && checkboxItem.dataset.userId && (checkboxItem.name.indexOf('stream') > -1)) {
                let lastStreamTimeout;

                let data = {
                  'action' : 'toggleTranslation',
                  'match_id' : checkboxItem.dataset.matchId,
                  'user_id' : checkboxItem.dataset.userId
                };

                checkboxItem.addEventListener('change', function () {
                  if (lastStreamTimeout) {
                    clearTimeout(lastStreamTimeout);
                  }

                  lastStreamTimeout = setTimeout(function () {
                    $.ajax({
                      url: earena_2_ajax.url,
                      data: data,
                      type: 'POST',
                      beforeSend: (response) => {
                        console.log(response.readyState);
                      },
                      success: (response) => {
                        response = JSON.parse(response);

                        if (response.success === 1) {
                          let wrapperFormNode = attrForms[formId].wrapperFormNode;

                          if (wrapperFormNode && is_ea_admin === false) {
                            wrapperFormNode.innerHTML = response.content;

                            // Загрузка файлов
                            window.files(wrapperFormNode);

                            // Повторная инициализация формы
                            window.form.init(attrForms[formId]._SETTINGS);
                          } else {
                            window.form.reloadPage();
                          }
                        }

                        console.log(response);
                      },
                      error: (response) => {
                        response = JSON.parse(response);
                        console.log(response);
                      }
                    });
                  }, 300);
                });
              }
            });
          }
        },
        // Ф-я отключения полей формы при выбранном/отключенном чекбоксе
        checkboxControlField : (formId, checkboxControl, fieldChange, toggle = 'off') => {
          checkboxControl.addEventListener('change', () => {
            if (toggle === 'off') {
              if (checkboxControl.checked === false) {
                fieldChange.disabled = false;
              } else {
                fieldChange.disabled = true;
              }
            }

            if (toggle === 'on') {
              if (checkboxControl.checked === false) {
                fieldChange.disabled = true;
              } else {
                fieldChange.disabled = false;
              }
            }

            fieldChange.value = '';

            window.form.validateForm(formId);
          });
        },
        // Ф-я поиска дополнительных кнопок закрытия попапов
        additionButtonClosePopup : (container = false) => {
          let formClosePopups;
          if (container === false) {
            formClosePopups = document.querySelectorAll('.button--popup-close');
          } else {
            formClosePopups = container.querySelectorAll('.button--popup-close');
          }

          if (formClosePopups.length > 0) {
            formClosePopups.forEach((formClosePopup, i) => {
              // Активация кнопки
              window.popup.activateClosePopupButton(formClosePopup);
            });
          }
        },
        reloadPage : function (timeout = 200, startByClick = false) {
          // (timeout = false) - перезагрузка без ожидания
          if (timeout && !startByClick) {
            setTimeout(function () {
              // Перезагрузить текущую страницу
              document.location.reload();
            }, timeout);
          } else if (timeout && startByClick) {
            let onDocumentClick = function (evt) {
              setTimeout(function () {
                // Перезагрузить текущую страницу
                document.location.reload();
              }, timeout);

              document.removeEventListener('click', onDocumentClick);
            };

            document.addEventListener('click', onDocumentClick);
          } else if (!timeout && startByClick) {
            let onDocumentClick = function (evt) {
              document.location.reload();

              document.removeEventListener('click', onDocumentClick);
            };

            document.addEventListener('click', onDocumentClick);
          } else if (!timeout && !startByClick) {
            // Перезагрузить текущую страницу
            document.location.reload();
          }
        },
        showResponseText : function (container, message = '') {
          let popupInformation = container.querySelector('.popup__information--template');

          if (popupInformation) {
            popupInformation.innerHTML = message;
          }
        },
        showAJAXMessage : function (container, message = '', timeoutClean = false) {
          let popupAJAXMessageElement = container.querySelector('.popup__ajax-message');

          if (popupAJAXMessageElement) {
            popupAJAXMessageElement.innerHTML = message;

            if (timeoutClean) {
              setTimeout(function () {
                popupAJAXMessageElement.innerHTML = '';
              }, timeoutClean);
            }
          }
        }
      };

      // Инициализация форм, которые есть в разметке при загрузке страницы.
      // Формы, которые подставляются из шаблонов - активируются при открытии попапа.
      // Инициализация проходит в файле popup.js и toggle-active.js

      // CONTACT
      let attrFormContact = {
        idForm: 'form-contact',
        // Содержимое элемента может очищаться при отправке формы и заменяться содержимым шаблона
        selectorForTemplateReplace: '#support-popup',
      };
      window.form.init(attrFormContact);

      // CHAT
      let attrFormChat = {
        idForm: 'form-chat',
        // Содержимое элемента может очищаться при отправке формы и заменяться содержимым шаблона
        selectorForTemplateReplace: '#chat-page-form',
      };
      window.form.init(attrFormChat);

      // COMPLAINT (ADMIN) forms
      let complaintAdminChatForms = document.querySelectorAll('form[id*="form-complaint-"]');

      if (complaintAdminChatForms.length > 0) {
        complaintAdminChatForms.forEach((complaintAdminChatForm, i) => {
          let attrFormComplaint = {
            idForm: complaintAdminChatForm.id,
            // Содержимое элемента может очищаться при отправке формы и заменяться содержимым шаблона
            selectorForTemplateReplace: '#complaint-container',
          };
          window.form.init(attrFormComplaint);
        });
      }

      // VIP forms
      let vipForms = document.querySelectorAll('form[id*="form-vip-"]');

      if (vipForms.length > 0) {
        vipForms.forEach((vipForm, i) => {
          let attrFormVip = {
            idForm: vipForm.id,
            // Содержимое элемента может очищаться при отправке формы и заменяться содержимым шаблона
            selectorForTemplateReplace: '#vip-popup',
          };
          window.form.init(attrFormVip);
        });
      }
    } catch (e) {
      console.log(e);
    }
  });
})(jQuery);
