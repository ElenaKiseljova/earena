'use strict';

document.addEventListener('DOMContentLoaded', () => {
  try {
    let deviceHeight = window.innerHeight && document.documentElement.clientHeight ?
                      Math.min(window.innerHeight, document.documentElement.clientHeight) :
                      window.innerHeight ||
                      document.documentElement.clientHeight ||
                      document.getElementsByTagName('body')[0].clientHeight;

    window.form = (attr) => {
      // ID формы
      var idForm = attr.idForm;

      // Содержимое будет очищаться при отправки и заменяться шаблонами
      var selectorForTemplateReplace = attr.selectorForTemplateReplace;

      // Элемент, в котором на каком-то уровне лежит форма.
      var selectorClosestWrapperForm =  attr.selectorClosestWrapperForm ? attr.selectorClosestWrapperForm : false;

      // Класс для элемента, в котором на каком-то уровне лежит форма. Если стили надо поменять после/в начала/конце отправки формы. По умолчанию - false
      var classForAddClosestWrapperForm = attr.classForAddClosestWrapperForm ? attr.classForAddClosestWrapperForm : false;

      // Получение объекта формы
      let formCheck = document.querySelector(`#${idForm}`);

      if (formCheck) {
        // Обертка для собержимого шаблонов
        let wrapperFormNode = document.querySelector(selectorForTemplateReplace);

        // Получение кнопки для отправки
        let buttonSubmit = formCheck.querySelector('button[type="submit"]');

        let inputEventListenerFlag = false;

        // Ф-я отключения полей формы при выбранном/отключенном чекбоксе
        let checkboxControlField = (checkboxControl, fieldChange, toggle = 'off') => {
          checkboxControl.addEventListener('change', function () {
            if (checkboxControl.checked === true) {
              if (toggle === 'off') {
                fieldChange.disabled = true;
              }

              if (toggle === 'on') {
                fieldChange.disabled = false;
              }
            }

            if (checkboxControl.checked === false) {
              if (toggle === 'off') {
                fieldChange.disabled = false;
              }

              if (toggle === 'on') {
                fieldChange.disabled = true;
              }
            }
          });
        };

        // Ф-я отправки формы
        let formSubmitFunction = function (inputs, textareas) {
          formCheck.addEventListener('submit', function (evt) {
            // Прерываем стандартное действие кнопки для XMLHttpRequest
            evt.preventDefault();

            // Объект для отправки на сервер
            let formData = {};

            // Собираем значения из инпутов
            if (inputs) {
              inputs.forEach(inputField => {
                let nameInput = inputField.name;
                let valueInput = inputField.value;

                if (nameInput && valueInput) {
                  formData[`${nameInput}`] = valueInput;
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

            formData = JSON.stringify(formData);

            /*
              * На сервере будут приняты только поля с атрибутом
              * name = 'name', 'phone', 'message', 'email'
              * Если их не достаточно - надо поправить ф-ю 'sendmail' в
              * functions.php под то, что требуется
            */
            console.log(formData);

            // Обработчик старта отправки
            var onBeforeSend = function (status) {
              let templateBeforeSend = document.querySelector(`#${idForm}-beforesend`);

              if (wrapperFormNode && templateBeforeSend) {
                wrapperFormNode.innerHTML = '';

                let templateContentBeforeSend = templateBeforeSend.content;
                let cloneTemplate = templateContentBeforeSend.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);

                // Проверяю - надо ли добавлять активный класс родителю
                if (classForAddClosestWrapperForm) {
                  // Добавляю активный класс. Если надо как-то родителя после отправки формы изменять
                  wrapperFormNode.closest(selectorClosestWrapperForm).classList.add(classForAddClosestWrapperForm);
                }
              }

              console.log('Send: ', status);
            };

            /*
              *** Префиксы ***
              ****************

              // Обработчик успешной отправки при восстановлении пароля
              forgot

              // Обработчик успешной отправки при переходе на следующий шаг создания матча
              next

              // Обработчик успешного создания матча
              create

              // Обработчик успешной отправки при недостаточном возрасте
              no-old-enough

              // Purse
              transaction
              withdrawal
            */
            // Обработчик успешной отправки
            var onSuccess = function (response, prefix = false) {
              // Создаю префикс или заменяю его на ''
              if (prefix) {
                prefix = `-${prefix}`;
              } else {
                prefix = '';
              }

              // Получаю шаблон
              let templateSuccess = document.querySelector(`#${idForm}-success${prefix}`);

              if (wrapperFormNode && templateSuccess) {
                wrapperFormNode.innerHTML = '';

                let templateContentSuccess = templateSuccess.content;
                let cloneTemplate = templateContentSuccess.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);

                // Обработчик успешной отправки при переходе на следующий шаг
                // регистрации матча
                if (prefix.indexOf('next') > -1) {
                  // Перезапуск/запуск валидации формы
                  window.form({
                    idForm: idForm,
                    selectorForTemplateReplace: selectorForTemplateReplace, // Содержимое будет очищаться при отправке и заменяться шаблонами
                    classForAddClosestWrapperForm: classForAddClosestWrapperForm, // по умолчанию - false
                    selectorClosestWrapperForm: selectorClosestWrapperForm, // по умолчанию - false
                  });
                }
              }

              // Обработчик успешной отправки при переходе на следующий шаг
              // регистрации матча
              if (prefix.indexOf('next') > -1 && selectorClosestWrapperForm) {
                // Регулировка высоты попапа
                if (wrapperFormNode.closest(selectorClosestWrapperForm).offsetHeight >= deviceHeight) {
                  wrapperFormNode.closest(selectorClosestWrapperForm).classList.add('scroll-content');
                  wrapperFormNode.closest(selectorClosestWrapperForm).classList.remove('sending');
                } else {
                  wrapperFormNode.closest(selectorClosestWrapperForm).classList.remove('scroll-content');
                  wrapperFormNode.closest(selectorClosestWrapperForm).classList.add('sending');
                }
              }

              // Ф-я закрытия попапа по клику на кнопку
              additionButtonClosePopup();

              console.log(`Done (${prefix}) : ${response}`);
            };

            // Обработчик не успешной отправки
            var onError = function (error) {
              let templateError = document.querySelector(`#${idForm}-error`);

              if (wrapperFormNode && templateError) {
                wrapperFormNode.innerHTML = '';

                let templateContentError = templateError.content;
                let cloneTemplate = templateContentError.cloneNode(true);

                wrapperFormNode.appendChild(cloneTemplate);
              }

              console.log('Error: ', error);

              // Ф-я закрытия попапа по клику на кнопку
              additionButtonClosePopup();
            };

            // Создание запроса
            var xhr = new XMLHttpRequest();

            // Тип передаваемых данных
            xhr.responseType = 'json';

            // Открытие запроса
            xhr.open('POST', earena_2_ajax.url + '?action=sendmail', true);

            // Установка заголовков запроса
            xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

            // Обработка запроса
            xhr.addEventListener('load', function () {
              var error;

              switch (xhr.status) {
                case 200:
                  onSuccess(xhr.response);

                  break;
                case 400:
                  error = 'Неверный запрос';
                  break;
                case 401:
                  error = 'Пользователь не авторизован';
                  break;
                case 404:
                  error = 'Ничего не найдено';
                  break;
                default:
                  error = 'Статус ответа: ' + xhr.status + ' ' + xhr.statusText;
              }

              if (error) {
                onError(error);
                /*
                  // Обработчик успешной отправки при восстановлении пароля
                  forgot

                  // Обработчик успешной отправки при переходе на следующий шаг создания матча
                  next

                  // Обработчик успешного создания матча
                  create

                  // Обработчик успешной отправки при недостаточном возрасте
                  no-old-enough

                  // Purse
                  transaction
                  withdrawal
                */
                /*Test ---> */

                //onSuccess(error, 'withdrawal');

                /* --- end test ; */
              }
            });

            // Ошибка соединения (нет интернета)
            xhr.addEventListener('error', function () {
              onError('Произошла ошибка соединения');
            });

            // Превышен таймаут
            xhr.addEventListener('timeout', function () {
              onError('Запрос не успел выполниться за ' + xhr.timeout + ' мс');
            });

            // Установка таймаута
            xhr.timeout = 10000; // 10 с

            // Отправка запроса
            xhr.send(formData);

            // Выполнение действий при старте отправки формы
            onBeforeSend(xhr.readyState);
          });
        };

        // Ф-я закрытия попапа по клику на кнопку
        let additionButtonClosePopup = function () {
          let formClosePopups = document.querySelectorAll('.form__popup-close');

          if (formClosePopups) {
            formClosePopups.forEach((formClosePopup, i) => {
              formClosePopup.addEventListener('click', function () {
                window.closePopup();
              });
            });
          }
        };

        // Валидация формы
        let validateForm = function () {
          // Validate flag
          let notValid = false;

          // Получение всех инпутов
          let allInputs = formCheck.querySelectorAll('input');

          // Полечение всех текстовых обрастей формы
          let allTextarea = formCheck.querySelectorAll('textarea');

          // Проверка инпутов
          if (allInputs) {
            allInputs.forEach((item, i) => {
              if (item.type !== 'radio' && item.type !== 'checkbox' && item.type !== 'submit') {
                item.autocomplete = 'off';

                // Проверка по возрасту
                if (item.type === 'date') {
                  if (item.valueAsNumber) {
                    var currentDate = new Date();
                    var birthdayUser = new Date(item.valueAsNumber);

                    if ((currentDate.getFullYear() - birthdayUser.getFullYear()) < 18) {
                      //console.log(birthdayUser.getFullYear(), 'Not old enough!');

                      // Если проверка по возрасту не прошла
                      item.parentNode.nextElementSibling.classList.add('no-old-enough');
                    } else {
                      // Если проверка по возрасту прошла
                      item.parentNode.nextElementSibling.classList.remove('no-old-enough');
                    }
                  }
                }

                if (!item.validity.valid) {
                  notValid = true;

                  if (!item.closest('.invalid')) {
                    // Проверка наличия обертки
                    if (item.closest('.form__row')) {
                      // Поле в фокус невалидное
                      item.focus();

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
                  // Поле в фокус невалидное
                  item.focus();

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
            } else {
              buttonSubmit.disabled = true;
            }

            // Проверка на то, был ли уже повешен обработчик клика на кнопку ранее
            if (inputEventListenerFlag === false) {

              // Если - нет - тогда вешаем
              formSubmitFunction(allInputs, allTextarea);
            }
          }

          inputEventListenerFlag = true;
        };

        // Кнопка отмены с заменой шаблона
        var cancelButton = formCheck.querySelector('button[name*="cancel"]');

        if (cancelButton && wrapperFormNode) {
          // Отмена регистрации на турнир
          var onCancel = function () {
            let templateContentCancel = document.querySelector(`#${idForm}-cancel`).content;

            if (wrapperFormNode && templateContentCancel) {
              wrapperFormNode.innerHTML = '';

              let cloneTemplate = templateContentCancel.cloneNode(true);

              wrapperFormNode.appendChild(cloneTemplate);

              // Проверяю - надо ли добавлять активный класс родителю
              if (classForAddClosestWrapperForm) {
                // Добавляю активный класс. Если надо как-то родителя после отправки формы изменять
                wrapperFormNode.closest(selectorClosestWrapperForm).classList.add(classForAddClosestWrapperForm);
              }

              // Ф-я закрытия попапа по клику на кнопку
              additionButtonClosePopup();
            }

            console.log('Canceled!');
          };

          // Добавляю обработчик клика
          cancelButton.addEventListener('click', onCancel);
        }

        // Вызов ф-и закрытия попапа по клику на кнопку
        additionButtonClosePopup();

        // Поиск зависимых чекбоксов в форме
        let checkboxes = formCheck.querySelectorAll('input[type="checkbox"]');

        if (checkboxes) {
          checkboxes.forEach((checkboxItem, i) => {
            if (checkboxItem.dataset.controlFieldId) {
              let fieldControl = formCheck.querySelector(`#${checkboxItem.dataset.controlFieldId}`);

              if (fieldControl) {
                // Вызов ф-и изменения связанных полей
                checkboxControlField(checkboxItem, fieldControl, checkboxItem.dataset.controlToggle);
              }
            }
          });
        }

        // Запуск валидации по клику на форму
        formCheck.addEventListener('click', function (evt) {
          validateForm();
        });
      }
    };

    // Запуск валидации форм, которые есть в разметке при загрузке страницы.
    // Формы, которые подставляются из шаблонов - активируются при открытии попапа.
    // Инициализация проходит в файле popup.js
    window.form({
      idForm: 'form-delete-friends',
      selectorForTemplateReplace: `#friends-popup`, // Содержимое будет очищаться при отправке и заменяться шаблонами
      classForAddClosestWrapperForm: 'sending', // по умолчанию - false
      selectorClosestWrapperForm: '.popup--friends', // по умолчанию - false
    });

    window.form({
      idForm: 'form-delete-history',
      selectorForTemplateReplace: `#history-popup`, // Содержимое будет очищаться при отправке и заменяться шаблонами
      classForAddClosestWrapperForm: 'sending', // по умолчанию - false
      selectorClosestWrapperForm: '.popup--history', // по умолчанию - false
    });
  } catch (e) {
    console.log(e);
  }
})
