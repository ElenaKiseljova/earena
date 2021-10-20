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

      window.form = (attr) => {
        // ID формы
        let ID_FORM = attr.idForm;

        // Содержимое будет очищаться при отправки и заменяться шаблонами
        let SELECTOR_FOR_TEMPLATE_REPLACE = attr.selectorForTemplateReplace;

        // Элемент, в котором на каком-то уровне лежит форма.
        let SELECTOR_CLOSEST_WRAPPER_FORM =  attr.selectorClosestWrapperForm ? attr.selectorClosestWrapperForm : false;

        // Класс для элемента, в котором на каком-то уровне лежит форма. Если стили надо поменять после/в начала/конце отправки формы. По умолчанию - false
        let CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM = attr.classForAddClosestWrapperForm ? attr.classForAddClosestWrapperForm : false;

        // Получение объекта формы
        let FORM_CHECK = document.querySelector(`#${ID_FORM}`);

        if (FORM_CHECK) {
          // Prefix (используется для выбора шаблона после отправки форм и других отличающий действий)
          let PREFIX_FORM = FORM_CHECK.dataset.prefix;

          // Обертка для собержимого шаблонов
          let wrapperFormNode = document.querySelector(SELECTOR_FOR_TEMPLATE_REPLACE);

          // Получение кнопки для отправки
          let buttonSubmit = FORM_CHECK.querySelector('button[type="submit"]');

          let inputEventListenerFlag = false;

          /******* START functions ********/

            // Ф-я отключения полей формы при выбранном/отключенном чекбоксе
            let checkboxControlField = (checkboxControl, fieldChange, toggle = 'off') => {
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

                validateForm();
              });
            };

            // Ф-я отправки формы
            let formSubmitFunction = (inputs, textareas) => {
              FORM_CHECK.addEventListener('submit', (evt) => {
                // Прерываем стандартное действие кнопки для XMLHttpRequest
                evt.preventDefault();

                /*
                  *** Префиксы (prefix) ***
                  *************************

                  --- data-prefix="" в тегах <form>
                */
                let prefix = '';
                if (PREFIX_FORM !== '' && PREFIX_FORM && PREFIX_FORM !== undefined) {
                  prefix = `-${PREFIX_FORM}`;
                }

                // Объект для отправки на сервер
                let formData = {};
                let dataForm = new FormData();

                if ( (ID_FORM.indexOf('verification') > -1) && (prefix.indexOf('request') > -1) ) {
                  dataForm.append('action', 'verification_fileload');
                }

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
                if ( ID_FORM.indexOf('login') > -1 ) {
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
                if ( ID_FORM.indexOf('friends') > -1) {
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
                if ( ID_FORM.indexOf('match') > -1) {
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

                      console.log('free=' + formData['free'],  'bet=' + formData['bet']);
                    }
                  }
                }

                // GAME
                if ( ID_FORM.indexOf('game') > -1) {
                  // Добавление игры
                  formData['action'] = 'setPlafroms';
                }

                // ADMIN VERIFICATION
                if ( ID_FORM.indexOf('verification') > -1) {
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
                }

                /***** END Actions AJAX *****/

                // Popup message
                let popup = FORM_CHECK.closest('.popup');
                let popupMessage = popup.querySelector('.popup__ajax-message');

                // Обработчик старта отправки
                var onBeforeSend = (status) => {
                  // Логин
                  if (prefix.indexOf('signin') > -1 || prefix.indexOf('signup') > -1  || prefix.indexOf('reset') > -1  || prefix.indexOf('request') > -1) {
                    if (popupMessage) {
                      popupMessage.innerHTML = '';
                    }

                    return;
                  }

                  let templateBeforeSend = document.querySelector(`#${ID_FORM}-beforesend`);

                  if (wrapperFormNode && templateBeforeSend) {
                    wrapperFormNode.innerHTML = '';

                    let templateContentBeforeSend = templateBeforeSend.content;
                    let cloneTemplate = templateContentBeforeSend.cloneNode(true);

                    wrapperFormNode.appendChild(cloneTemplate);

                    // Проверяю - надо ли добавлять активный класс родителю
                    if (CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM) {
                      // Добавляю активный класс. Если надо как-то родителя после отправки формы изменять
                      wrapperFormNode.closest(SELECTOR_CLOSEST_WRAPPER_FORM).classList.add(CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM);
                    }
                  }

                  console.log('Старт: ', status);
                };

                // Обработчик успешной отправки
                var onSuccess = (response) => {
                  // ЛОГИРОВАНИЕ
                  if ( ID_FORM.indexOf('login') > -1 ) {
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
                  if ( ID_FORM.indexOf('verification') > -1 ) {
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

                  // МАТЧ
                  if ( ID_FORM.indexOf('match') > -1 ) {
                    // Создание шаг 1
                    if (prefix.indexOf('create') > -1) {
                      response = JSON.parse(response);

                      if (response.success === 1) {
                        if (wrapperFormNode) {
                          // Переписываю
                          wrapperFormNode.innerHTML = response.data;

                          // Перезапуск/запуск валидации формы
                          window.form({
                            idForm: ID_FORM,
                            selectorForTemplateReplace: SELECTOR_FOR_TEMPLATE_REPLACE, // Содержимое будет очищаться при отправке и заменяться шаблонами
                            classForAddClosestWrapperForm: CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM, // по умолчанию - false
                            selectorClosestWrapperForm: SELECTOR_CLOSEST_WRAPPER_FORM, // по умолчанию - false
                          });

                          if (SELECTOR_CLOSEST_WRAPPER_FORM) {
                            // Регулировка высоты попапа
                            if (wrapperFormNode.closest(SELECTOR_CLOSEST_WRAPPER_FORM).offsetHeight >= deviceHeight) {
                              wrapperFormNode.closest(SELECTOR_CLOSEST_WRAPPER_FORM).classList.add('scroll-content');
                              wrapperFormNode.closest(SELECTOR_CLOSEST_WRAPPER_FORM).classList.remove('sending');
                            } else {
                              wrapperFormNode.closest(SELECTOR_CLOSEST_WRAPPER_FORM).classList.remove('scroll-content');
                              wrapperFormNode.closest(SELECTOR_CLOSEST_WRAPPER_FORM).classList.add('sending');
                            }
                          }
                        }

                        console.log(response);

                        return;
                      } else {
                        onError(response, prefix);

                        console.log(response.message);

                        return;
                      }
                    }

                    // Создание шаг 1
                    if (prefix.indexOf('add') > -1) {
                      response = JSON.parse(response);

                      if (response.success === 0) {
                        onError(response, prefix);

                        console.log(response);

                        return;
                      }
                    }
                  }

                  // Получаю шаблон
                  let templateSuccess = document.querySelector(`#${ID_FORM}-success${prefix}`);

                  if (!templateSuccess) {
                    templateSuccess = document.querySelector(`#${ID_FORM}-success`);
                  }

                  if (wrapperFormNode && templateSuccess) {
                    wrapperFormNode.innerHTML = '';

                    let templateContentSuccess = templateSuccess.content;
                    let cloneTemplate = templateContentSuccess.cloneNode(true);

                    wrapperFormNode.appendChild(cloneTemplate);
                  }

                  if ( ID_FORM.indexOf('login') > -1 ) {
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

                  // Верификация (принять/отклонить) или Друзья (принять/отклонить/удалить)
                  if ( (ID_FORM.indexOf('verification') > -1 ) || ID_FORM.indexOf('friends') > -1) {
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
                  if ( ID_FORM.indexOf('game') > -1) {
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

                  // Ф-я закрытия попапа по клику на кнопку
                  additionButtonClosePopup();

                  console.log('Успех: ', response);
                };

                // Обработчик не успешной отправки
                var onError = (response, prefix='') => {
                  let templateError = document.querySelector(`#${ID_FORM}-error${prefix}`);

                  if (!templateError) {
                    templateError = document.querySelector(`#${ID_FORM}-error`);
                  }

                  if (wrapperFormNode && templateError) {
                    wrapperFormNode.innerHTML = '';

                    let templateContentError = templateError.content;
                    let cloneTemplate = templateContentError.cloneNode(true);

                    wrapperFormNode.appendChild(cloneTemplate);
                  }

                  console.log('Ошибка: ', response);

                  // Ф-я закрытия попапа по клику на кнопку
                  additionButtonClosePopup();
                };

                // Nonce
                if (!formData['security']) {
                  formData['security'] = earena_2_ajax.nonce;
                }

                if ((ID_FORM.indexOf('verification') > -1) && (prefix.indexOf('request') > -1)) {
                  // dataForm - потомок FormData() [для передачи файлов]
                  for(var pair of dataForm.entries()) {
                     console.log(pair[0]+ ', '+ pair[1]);
                  }

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
            };

            // Ф-я закрытия попапа по клику на кнопку
            let additionButtonClosePopup = () => {
              let formClosePopups = document.querySelectorAll('.form__popup-close');

              if (formClosePopups) {
                formClosePopups.forEach((formClosePopup, i) => {
                  formClosePopup.addEventListener('click', (evt) => {
                    evt.preventDefault();

                    window.popup.closePopup();
                  });
                });
              }
            };

            // Ф-я валидации формы
            let validateForm = () => {
              // Validate flag
              let notValid = false;

              // Получение всех инпутов
              let allInputs = FORM_CHECK.querySelectorAll('input');

              // Полечение всех текстовых обрастей формы
              let allTextarea = FORM_CHECK.querySelectorAll('textarea');

              // Проверка инпутов
              if (allInputs) {
                allInputs.forEach((item, i) => {
                  if (item.type !== 'submit' && item.type !== 'file') {
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
                      if ( item.value !== FORM_CHECK.querySelector('input[name="pass_1"]').value ) {
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

                    if (inputEventListenerFlag === false) {
                      // Перезапуск при вводе значений
                      item.addEventListener('input', () => {
                        validateForm();
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

                  if (inputEventListenerFlag === false) {
                    item.addEventListener('input', () => {
                      validateForm();
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
                if (inputEventListenerFlag === false) {

                  // Если - нет - тогда вешаем
                  formSubmitFunction(allInputs, allTextarea);
                }
              }

              inputEventListenerFlag = true;
            };

          /******* END functions ********/

          // Кнопка отмены с заменой шаблона
          var cancelButton = FORM_CHECK.querySelector('button[name*="cancel"]');
          if (cancelButton && wrapperFormNode) {
            // Отмена регистрации на турнир
            var onCancel = () => {
              let templateContentCancel = document.querySelector(`#${ID_FORM}-cancel`).content;

              if (wrapperFormNode && templateContentCancel) {
                wrapperFormNode.innerHTML = '';

                let cloneTemplate = templateContentCancel.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);

                // Проверяю - надо ли добавлять активный класс родителю
                if (CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM) {
                  // Добавляю активный класс. Если надо как-то родителя после отправки формы изменять
                  wrapperFormNode.closest(SELECTOR_CLOSEST_WRAPPER_FORM).classList.add(CLASS_FOR_ADD_CLOSEST_WRAPPER_FORM);
                }

                // Ф-я закрытия попапа по клику на кнопку
                additionButtonClosePopup();
              }

              console.log('Canceled!');
            };

            // Добавляю обработчик клика
            cancelButton.addEventListener('click', onCancel);
          }

          // Поиск зависимых чекбоксов в форме
          let checkboxes = FORM_CHECK.querySelectorAll('input[type="checkbox"]');
          if (checkboxes.length > 0) {
            checkboxes.forEach((checkboxItem, i) => {
              if (checkboxItem.dataset.controlFieldId) {
                let fieldControl = FORM_CHECK.querySelector(`#${checkboxItem.dataset.controlFieldId}`);

                if (fieldControl) {
                  // Вызов ф-и изменения связанных полей
                  checkboxControlField(checkboxItem, fieldControl, checkboxItem.dataset.controlToggle);
                }
              }
            });
          }

          // Поиск Селектов
          window.select(FORM_CHECK);

          // Вызов ф-и закрытия попапа по клику на кнопку
          additionButtonClosePopup();

          // Запуск валидации по клику на форму
          FORM_CHECK.addEventListener('click', (evt) => {
            validateForm();
          });
        }
      };

      // Запуск валидации форм, которые есть в разметке при загрузке страницы.
      // Формы, которые подставляются из шаблонов - активируются при открытии попапа.
      // Инициализация проходит в файле popup.js
      // Либо по смене табов toggle-active.js

      window.form({
        idForm: 'form-delete-history',
        selectorForTemplateReplace: `#history-popup`, // Содержимое будет очищаться при отправке и заменяться шаблонами
        classForAddClosestWrapperForm: 'sending', // по умолчанию - false
        selectorClosestWrapperForm: '.popup--history', // по умолчанию - false
      });
    } catch (e) {
      console.log(e);
    }
  });
})(jQuery);
