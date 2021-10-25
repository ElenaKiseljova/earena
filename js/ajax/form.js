'use strict';

(function ($) {
  /**
    * List of inner functions on window.form() function
    *
    * checkboxControlField
    * formSubmitFunction
    * additionButtonClosePopup
    * validateForm
    *
  */
  document.addEventListener('DOMContentLoaded', () => {
    try {
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
            SELECTOR_CLOSEST_WRAPPER_FORM : attr.selectorClosestWrapperForm ? attr.selectorClosestWrapperForm : false,
            CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM : attr.classForAddClosestWrapperForm ? attr.classForAddClosestWrapperForm : false
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

            // Возврат к предыдущему шаблону
            window.form.cancelTemplate(attr.idForm);

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
        // Ф-я отправки формы
        formSubmitFunction : (formId, inputs, textareas) => {
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

            // Собираем значения из инпутов
            if (inputs) {
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

            // Собираем значения из  многострочных полей ввода
            if (textareas) {
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

            // COMPLAINT
            if ( formId.indexOf('complaint') > -1) {
              // Создать (0)
              if (prefix.indexOf('create') > -1) {
                formData['action'] = 'moderate_match';
              }
            }

            // GAME
            if ( formId.indexOf('game') > -1) {
              // Добавление игры
              formData['action'] = 'setPlafroms';
            }

            // VERIFICATION
            if ( formId.indexOf('verification') > -1) {
              // Подтверждение верификации
              if (prefix.indexOf('apply') > -1) {
                // Ф-я подтверждения верификации
                formData['action'] = 'earena_2_apply_verification_request';
              }

              // Отказ в верификации
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

            /***** END Actions AJAX *****/

            // Popup message
            let popup = form.closest('.popup');
            let popupMessage;

            if (popup) {
              popupMessage = popup.querySelector('.popup__ajax-message');
            }

            // Обработчик старта отправки
            var onBeforeSend = (status) => {
              buttonSubmit.classList.add('sending');

              // Логин
              if ((formId.indexOf('login') > -1 && (prefix.indexOf('signin') > -1 || prefix.indexOf('signup') > -1  || prefix.indexOf('reset') > -1))  || (formId.indexOf('verification') > -1 && prefix.indexOf('request') > -1)  || (formId.indexOf('match') > -1 && prefix.indexOf('accept') > -1)) {
                if (popupMessage) {
                  popupMessage.innerHTML = '';
                }

                return;
              }

              let templateBeforeSend = document.querySelector(`#${formId}-beforesend`);

              if (wrapperFormNode && templateBeforeSend) {
                wrapperFormNode.innerHTML = '';

                let templateContentBeforeSend = templateBeforeSend.content;
                let cloneTemplate = templateContentBeforeSend.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);

                // Проверяю - надо ли добавлять активный класс родителю
                if (attrForms[formId].CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM) {
                  // Добавляю активный класс. Если надо как-то родителя после отправки формы изменять
                  wrapperFormNode.closest(attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM).classList.add(attrForms[formId].CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM);
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
                    if (popupMessage) {
                      popupMessage.innerHTML = response.data.message;

                      setTimeout(function () {
                        popupMessage.innerHTML = '';
                      }, 2000);
                    }

                    return;
                  }
                }

                // Регистрация
                if (prefix.indexOf('signup') > -1) {
                  if (response.data.registered) {
                    document.location.href = 'profile?after_registration=1';
                  } else {
                    let message = '';

                    if (popupMessage) {
                      $.each(response.data.errors, function (key, val) {
                          console.log(key + ' : '+ val);
                          message += val + '<br>';

                          popupMessage.innerHTML = message;
                      });
                    }

                    return;
                  }
                }

                // Сброс
                if (prefix.indexOf('reset') > -1) {
                  if (response.data.error) {
                    if (popupMessage) {
                      popupMessage.innerHTML = response.data.error;
                    }

                    return;
                  }

                  console.log(response);
                }
              }

              // ВЕРИФИКАЦИЯ
              if ( formId.indexOf('verification') > -1 ) {
                if (prefix.indexOf('request') > -1) {
                  if (response.success === false) {
                    if (popupMessage) {
                      popupMessage.innerHTML = response.data;

                      setTimeout(function () {
                        popupMessage.innerHTML = '';
                      }, 2000);
                    }

                    return;
                  }
                }
              }

              // MATCH
              if ( formId.indexOf('match') > -1 ) {
                // После успешного создания / удаления / присоединения - выводим все матчи по клику на таб платформы
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

                    // Перезапуск/запуск валидации формы
                    let reinitFormAttr = {
                      idForm: formId,
                      selectorForTemplateReplace: attrForms[formId].SELECTOR_FOR_TEMPLATE_REPLACE, // Содержимое будет очищаться при отправке и заменяться шаблонами
                      classForAddClosestWrapperForm: attrForms[formId].CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM, // по умолчанию - false
                      selectorClosestWrapperForm: attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM, // по умолчанию - false
                    };

                    window.form.init(reinitFormAttr);

                    if (attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM) {
                      // Регулировка высоты попапа
                      if (wrapperFormNode.closest(attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM).offsetHeight >= deviceHeight) {
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM).classList.add('scroll-content');
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM).classList.remove('sending');
                      } else {
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM).classList.remove('scroll-content');
                        wrapperFormNode.closest(attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM).classList.add('sending');
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
                    // После успешного создания / удаления / присоединения - выводим все матчи по клику на таб платформы
                    resetShowResult();
                  } else {
                    onError(response, prefix);

                    console.log(response);

                    return;
                  }
                }

                if (prefix.indexOf('accept') > -1) {
                  if ((response.content.indexOf('thanks.svg') > -1) || response.success === 1) {
                    // После успешного создания / удаления / присоединения - выводим все матчи по клику на таб платформы
                    resetShowResult();
                  } else {
                    if (popupMessage) {
                      popupMessage.innerHTML = response.content;

                      setTimeout(function () {
                        popupMessage.innerHTML = '';
                      }, 2000);
                    }

                    console.log(response);

                    //onError(response, prefix);

                    return;
                  }
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
                // Создать (0)
                if (prefix.indexOf('create') > -1) {
                  response = JSON.parse(response);
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
                  let popupInformation = popup.querySelector('.popup__information--template');
                  if (response.data.retrieve_password == true) {
                    popupInformation.innerHTML = response.data.message;

                    console.log('Успех', response.data.message);
                  } else {
                    popupInformation.innerHTML = response.data.message;

                    console.log('Ошибка', response.data.message);
                  }
                }

                // Сброс
                if (prefix.indexOf('reset') > -1 && response.data.message) {
                  $('.popup__information--template').html(response.data.message);
                }
              }

              // Верификация (принять/отклонить) или
              // Друзья (принять/отклонить/удалить)
              if ( (formId.indexOf('verification') > -1 ) || formId.indexOf('friends') > -1) {
                if ((prefix.indexOf('apply') > -1) || (prefix.indexOf('reject') > -1) || (prefix.indexOf('delete') > -1)) {
                  response = JSON.parse(response);

                  if (response.success === 1) {
                    window.popup.userInfo(false, popup);

                    // Для теста. Пока не подключено обновление контента
                    setTimeout(function () {
                      // Перезагрузить текущую страницу
                      document.location.reload();
                    }, 300);
                  } else {
                    let popupInformation = popup.querySelector('.popup__information--template');

                    popupInformation.innerHTML = response.content;
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

                if ((prefix.indexOf('accept') > -1) && (formId.indexOf('match') > -1)) {
                  let popupInformation = popup.querySelector('.popup__information--template');
                  if (popupInformation) {
                    popupInformation.innerHTML = response.content;
                  }
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

            if (((formId.indexOf('verification') > -1) && (prefix.indexOf('request') > -1)) ||( formId.indexOf('contact') > -1)) {
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
          if (allInputs) {
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
          if (allTextarea) {
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
              window.form.formSubmitFunction(formId, allInputs, allTextarea, buttonSubmit);
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
            });
          }
        },
        // Возврат к предыдущему шаблону
        cancelTemplate : (formId) => {
          let form = attrForms[formId].FORM;
          let wrapperFormNode = attrForms[formId].wrapperFormNode;

          // Кнопка отмены с заменой шаблона
          var cancelButton = form.querySelector('button[name*="cancel"]');
          if (cancelButton && wrapperFormNode) {
            // Отмена регистрации на турнир
            var onCancel = () => {
              let templateContentCancel = document.querySelector(`#${formId}-cancel`).content;

              if (wrapperFormNode && templateContentCancel) {
                wrapperFormNode.innerHTML = '';

                let cloneTemplate = templateContentCancel.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);

                // Проверяю - надо ли добавлять активный класс родителю
                if (attrForms[formId].CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM) {
                  // Добавляю активный класс. Если надо как-то родителя после отправки формы изменять
                  wrapperFormNode.closest(attrForms[formId].SELECTOR_CLOSEST_WRAPPER_FORM).classList.add(attrForms[formId].CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM);
                }

                if (form.closest('.popup')) {
                  // Ф-я поиска дополнительных кнопок закрытия попапов
                  window.form.additionButtonClosePopup(form.closest('.popup'));
                }
              }

              console.log('Canceled!');
            };

            // Добавляю обработчик клика
            cancelButton.addEventListener('click', onCancel);
          }
        }
      };

      // Запуск валидации форм, которые есть в разметке при загрузке страницы.
      // Формы, которые подставляются из шаблонов - активируются при открытии попапа.
      // Инициализация проходит в файле popup.js

      let attrFormContact = {
        idForm: 'form-contact',
        // Содержимое элемента будет очищаться при отправке формы и заменяться содержимым шаблона
        selectorForTemplateReplace: '#support-popup',
      };
      window.form.init(attrFormContact);

      let attrFormChat = {
        idForm: 'form-chat',
        // Содержимое элемента будет очищаться при отправке формы и заменяться содержимым шаблона
        selectorForTemplateReplace: '#chat-page-form',
      };
      window.form.init(attrFormChat);

      // Закоммиченная форма была в разметке, а вот на бою - не уверена, что она есть
      // let attrFormHistory = {
      //   idForm: 'form-delete-history',
      //   selectorForTemplateReplace: `#history-popup`, // Содержимое будет очищаться при отправке и заменяться шаблонами
      //   classForAddClosestWrapperForm: 'sending', // по умолчанию - false
      //   selectorClosestWrapperForm: '.popup--history', // по умолчанию - false
      // };
      //
      // window.form.init(attrFormHistory);
    } catch (e) {
      console.log(e);
    }
  });
})(jQuery);
