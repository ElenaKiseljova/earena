'use strict';

document.addEventListener('DOMContentLoaded', () => {
  try {
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
        // Получение кнопки для отправки
        let buttonSubmit = formCheck.querySelector('button[type="submit"]');

        let inputEventListenerFlag = false;

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

                if (item.type === 'date') {
                  if (item.valueAsNumber) {
                    var currentDate = new Date();
                    var birthdayUser = new Date(item.valueAsNumber);

                    if ((currentDate.getFullYear() - birthdayUser.getFullYear()) < 18) {
                      console.log(birthdayUser.getFullYear(), 'Not old enough!');

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
                    // Попап формы
                    if (item.closest('.form__row')) {
                      item.closest('.form__row').classList.add('invalid');
                      item.closest('.form__row').classList.remove('valid');
                    }
                  }
                } else {
                  if (item.closest('.invalid')) {
                    // Попап формы
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
              }
            });
          }

          //Проверка областей текста
          if (allTextarea) {
            allTextarea.forEach((item, i) => {
              if (!item.validity.valid) {
                notValid = true;

                // Попап формы
                if (item.closest('.form__row')) {
                  item.closest('.form__row').classList.add('invalid');
                  item.closest('.form__row').classList.remove('valid');
                }
              } else {
                if (item.closest('.invalid')) {
                  // Попап формы
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

              // Проверка на то, был ли уже повешен обработчик клика на кнопку ранее
              if (inputEventListenerFlag === false) {

                // Если - нет - тогда вешаем
                formCheck.addEventListener('submit', function (evt) {
                  // Прерываем стандартное действие кнопки для XMLHttpRequest
                  evt.preventDefault();

                  // Объект для отправки на сервер
                  let formData = {};

                  // Собираем значения из инпутов
                  if (allInputs) {
                    allInputs.forEach(inputField => {
                      let nameInput = inputField.name;
                      let valueInput = inputField.value;

                      if (nameInput && valueInput) {
                        formData[`${nameInput}`] = valueInput;
                      }
                    });
                  }

                  // Собираем значения из  многострочных полей ввода
                  if (allTextarea) {
                    allTextarea.forEach((textareaField, i) => {
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

                  //let popupCall = document.querySelector('.popup--call');
                  let wrapperFormNode = document.querySelector(selectorForTemplateReplace);

                  // Обработчик старта отправки
                  var onBeforeSend = function (status) {
                    let templateContentBeforeSend = document.querySelector(`#${idForm}-beforesend`).content;

                    if (wrapperFormNode) {
                      wrapperFormNode.innerHTML = '';

                      let cloneTemplate = templateContentBeforeSend.cloneNode(true);

                      wrapperFormNode.appendChild(cloneTemplate);

                      // Проверяю - надо ди добавлять активный класс родителю
                      if (classForAddClosestWrapperForm) {
                        // Добавляю активный класс. Если надо как-то родителя после отправки формы изменять
                        wrapperFormNode.closest(selectorClosestWrapperForm).classList.add(classForAddClosestWrapperForm);
                        //popupCall.style.height = 'auto';
                      }
                    }

                    console.log('Send: ', status);
                  };

                  // Обработчик успешной отправки
                  var onSuccess = function (response) {
                    let templateContentSuccess = document.querySelector(`#${idForm}-success`).content;

                    if (wrapperFormNode) {
                      wrapperFormNode.innerHTML = '';

                      let cloneTemplate = templateContentSuccess.cloneNode(true);

                      wrapperFormNode.appendChild(cloneTemplate);
                    }

                    console.log('Done: ', response);
                  };

                  // Обработчик успешной отправки при восстановлении пароля
                  var onSuccessForgot = function (response) {
                    let templateContentSuccess = document.querySelector(`#${idForm}-success-forgot`).content;

                    if (wrapperFormNode) {
                      wrapperFormNode.innerHTML = '';

                      let cloneTemplate = templateContentSuccess.cloneNode(true);

                      wrapperFormNode.appendChild(cloneTemplate);
                    }

                    let formPopupClose = document.querySelector('.form__popup-close');

                    if (formPopupClose) {
                      formPopupClose.addEventListener('click', function () {
                        window.closePopup();
                      });
                    }

                    console.log('Done (forgot): ', response);
                  };

                  // Обработчик не успешной отправки
                  var onError = function (error) {
                    let templateContentError = document.querySelector(`#${idForm}-error`).content;

                    if (wrapperFormNode) {
                      wrapperFormNode.innerHTML = '';

                      let cloneTemplate = templateContentError.cloneNode(true);

                      wrapperFormNode.appendChild(cloneTemplate);
                    }

                    console.log('Error: ', error);
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
                  //onBeforeSend('good');
                });
              }
            }
          }

          inputEventListenerFlag = true;
        };

        formCheck.addEventListener('click', function (evt) {
          validateForm();
        });
      }
    };

    // Login
    window.form({
      idForm: 'form-login',
      selectorForTemplateReplace: '.wrapper-form--login', // Содержимое будет очищаться при отправке и заменяться шаблонами
      classForAddClosestWrapperForm: 'sending', // по умолчанию - false
      selectorClosestWrapperForm: '.popup--login', // по умолчанию - false
    });

  } catch (e) {
    console.log(e);
  }
})
