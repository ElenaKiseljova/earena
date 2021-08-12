'use strict';

document.addEventListener("DOMContentLoaded", function () {
  let deviceHeight = window.innerHeight && document.documentElement.clientHeight ?
                    Math.min(window.innerHeight, document.documentElement.clientHeight) :
                    window.innerHeight ||
                    document.documentElement.clientHeight ||
                    document.getElementsByTagName('body')[0].clientHeight;

  try {
    let ROOT_ELEMENT = document.documentElement;
    let OVERLAY_POPUP = document.querySelector('.overlay--popup');

    let onPopupEscPress = function (evt) {
      if (evt.keyCode === 27) {
        closePopup();
      }
    }

    let allPopup = document.querySelectorAll('.popup');

    let openPopup = function (popup, sufix) {
      if (allPopup) {
        window.removeActiveClassElements(allPopup);
      }

      if (ROOT_ELEMENT && !ROOT_ELEMENT.classList.contains('active')) {
        ROOT_ELEMENT.classList.add('active');
      }

      if (OVERLAY_POPUP && !OVERLAY_POPUP.classList.contains('active')) {
        OVERLAY_POPUP.classList.add('active');
      }

      // Если при отправке формы аякс добавлялся класс, который влияет на отображение элементов, то его удалить при новом открытии попапа
      if (popup.classList.contains('sending')) {
        popup.classList.remove('sending');
      }

      // Добавить активный класс
      popup.classList.add('active');

      document.addEventListener('keydown', onPopupEscPress, true);
    }

    window.closePopup = function () {
      if (allPopup) {
        window.removeActiveClassElements(allPopup);
      }

      if (ROOT_ELEMENT && ROOT_ELEMENT.classList.contains('active')) {
        ROOT_ELEMENT.classList.remove('active');
      }

      if (OVERLAY_POPUP && OVERLAY_POPUP.classList.contains('active')) {
        OVERLAY_POPUP.classList.remove('active');
        OVERLAY_POPUP.style = '';
      }

      document.removeEventListener('keydown', onPopupEscPress, true);
    }

    // Ф-я подмены содержимого попапа
    let popupContentCreator = function (prefix, popup, button, innerPopupButtonSelector = false) {
      // Анализируем имя кнопки, чтобы вставить нужный шаблон в шапку и форму
      let typePopup = button.name;

      // Получаем контейнер для шаблона
      let popupTemplateContainer = popup.querySelector(`#${prefix}-popup`);

      // Получаем нужный шаблон шапки
      let popupCurrentTemplate = popup.querySelector(`#popup-${prefix}-${typePopup}`);

      if (popupTemplateContainer && popupCurrentTemplate) {
        // Очищаем контейнер
        popupTemplateContainer.innerHTML = '';

        // Получаем контент нужного шаблона
        let popupCurrentTemplateContent = popupCurrentTemplate.content;
        let cloneCurrentTemplateContent = popupCurrentTemplateContent.cloneNode(true);

        // Заменяем содержимое контейнера
        popupTemplateContainer.appendChild(cloneCurrentTemplateContent);
      }

      // Проверка : Заданы ли внутренние кнопки
      if (innerPopupButtonSelector) {
        // Смена шаблонов по клику на кнопки типа: забыл пароль/войти/зарегистрироваться
        let innerPopupButtons = popup.querySelectorAll(innerPopupButtonSelector);

        innerPopupButtons.forEach((innerPopupButton, i) => {
          innerPopupButton.addEventListener('click', function () {
            popupContentCreator(prefix, popup, innerPopupButton, innerPopupButtonSelector);
          });
        });
      }

      // Перезапуск/запуск валидации формы
      window.form({
        idForm: `form-${prefix}`,
        selectorForTemplateReplace: `#${prefix}-popup`, // Содержимое будет очищаться при отправке и заменяться шаблонами
        classForAddClosestWrapperForm: 'sending', // по умолчанию - false
        selectorClosestWrapperForm: `.popup--${prefix}`, // по умолчанию - false
      });

      // Регулировка высоты попапа
      if (popup.offsetHeight >= deviceHeight) {
        popup.classList.add('scroll-content');
      } else {
        popup.classList.remove('scroll-content');
      }
    };

    // Все кнопки, которые открывают попапы
    let popupButtons = document.querySelectorAll('.openpopup');

    if (popupButtons) {
      // Перебираем все кнопки, которые открывают попапы
      popupButtons.forEach(function (item) {
        let sufixPopupName = item.getAttribute('data-popup');
        let popupName = '.popup--' + sufixPopupName;

        let popupItem = document.querySelector(popupName);

        if (popupItem) {
          item.addEventListener('click', function () {
            if (sufixPopupName === 'login') {
              popupContentCreator(sufixPopupName, popupItem, item, '.popup__button--information');
            }

            if (sufixPopupName === 'complaint') {
              popupContentCreator(sufixPopupName, popupItem, item);
            }

            if (sufixPopupName === 'tournament') {
              popupContentCreator(sufixPopupName, popupItem, item);
            }

            if (sufixPopupName === 'match') {
              popupContentCreator(sufixPopupName, popupItem, item);
            }

            // Дефолтное поведение
            openPopup(popupItem, sufixPopupName);
          });

          var onEnterPressOpen = function (evt) {
            if (evt.keyCode === 13) {
              openPopup(popupItem, sufixPopupName);

              document.removeEventListener('keydown', onEnterPressOpen);
            }
          }

          item.addEventListener('focus', function () {
            if (popupItem) {
              document.addEventListener('keydown', onEnterPressOpen);
            }
          });

          item.addEventListener('blur', function () {
            if (popupItem) {
              document.removeEventListener('keydown', onEnterPressOpen);
            }
          });
        }
      });
    }

    let closePopupButtons = document.querySelectorAll('.popup__close');

    if (closePopupButtons) {
      for (var i = 0; i < closePopupButtons.length; i++) {
        closePopupButtons[i].addEventListener('click', closePopup);

        var onEnterPressClose = function (evt) {
          if (evt.keyCode === 13) {
            closePopup();

            document.removeEventListener('keydown', onEnterPressClose);
          }
        }

        closePopupButtons[i].addEventListener('focus', function () {
          document.addEventListener('keydown', onEnterPressClose);
        });

        closePopupButtons[i].addEventListener('blur', function () {
          document.removeEventListener('keydown', onEnterPressClose);
        });
      }
    }

    if (OVERLAY_POPUP) {
      OVERLAY_POPUP.addEventListener('click', closePopup);
    }

  } catch (e) {
    console.log(e);
  }

  // Cookie
  var cookie = document.querySelector('.cookie');

  if (cookie) {
    var cookieButoonClose = cookie.querySelector('.button--cookie');

    cookieButoonClose.addEventListener('click',  function () {
      cookie.classList.add('accepted');
    });
  }
});

window.addEventListener('load', function () {
  let popups = document.querySelectorAll('.popup');
  //console.log(popups);
  if (popups) {
    popups.forEach((popup, i) => {
      popup.classList.add('loaded');
    });
  }
});
