'use strict';

(function () {
  document.addEventListener("DOMContentLoaded", function () {
    try {
      let deviceHeight = window.innerHeight && document.documentElement.clientHeight ?
                        Math.min(window.innerHeight, document.documentElement.clientHeight) :
                        window.innerHeight ||
                        document.documentElement.clientHeight ||
                        document.getElementsByTagName('body')[0].clientHeight;

      let ROOT_ELEMENT = document.documentElement;
      let OVERLAY_POPUP = document.querySelector('.overlay--popup');

      let onPopupEscPress = function (evt) {
        if (evt.keyCode === 27) {
          window.popup.closePopup();
        }
      };

      // Экспортируемый объект
      window.popup = {
        // Закрытие попапа
        closePopup : function () {
          // Все попапы
          let allPopup = document.querySelectorAll('.popup');

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
        },
        // Открытие попапа
        openPopup : function (popup, sufix) {
          // Все попапы
          let allPopup = document.querySelectorAll('.popup');

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
        },
        // Ф-я активации попапа по клику на указанную кнопку
        activatePopup : function (popupButton) {
          let sufixPopupName = popupButton.dataset.popup;
          let popupName = '.popup--' + sufixPopupName;

          let popupItem = document.querySelector(popupName);

          if (popupItem) {
            popupButton.addEventListener('click', function () {
              if (sufixPopupName === 'login') {
                popupContentCreator(sufixPopupName, popupItem, popupButton, '.popup__button--information');
              }

              if (sufixPopupName === 'complaint') {
                popupContentCreator(sufixPopupName, popupItem, popupButton);
              }

              if (sufixPopupName === 'tournament') {
                popupContentCreator(sufixPopupName, popupItem, popupButton);
              }

              if (sufixPopupName === 'match') {
                popupContentCreator(sufixPopupName, popupItem, popupButton);
              }

              if (sufixPopupName === 'game') {
                popupContentCreator(sufixPopupName, popupItem, popupButton);
              }

              if (sufixPopupName === 'stream') {
                popupContentCreator(sufixPopupName, popupItem, popupButton);
              }

              // Дефолтное поведение
              window.popup.openPopup(popupItem, sufixPopupName);
            });

            var onEnterPressOpen = function (evt) {
              if (evt.keyCode === 13) {
                window.popup.openPopup(popupItem, sufixPopupName);

                document.removeEventListener('keydown', onEnterPressOpen);
              }
            }

            popupButton.addEventListener('focus', function () {
              if (popupItem) {
                document.addEventListener('keydown', onEnterPressOpen);
              }
            });

            popupButton.addEventListener('blur', function () {
              if (popupItem) {
                document.removeEventListener('keydown', onEnterPressOpen);
              }
            });

            // Все кнопки закрытия попапа
            let closePopupButtons = popupItem.querySelectorAll('.popup__close');

            if (closePopupButtons) {
              closePopupButtons.forEach((closePopupButton, i) => {
                // Активация кнопки закрытия попапа
                window.popup.activateClosePopupButton(closePopupButton);
              });
            }
          }
        },
        activateClosePopupButton : function (closeButton) {
          closeButton.addEventListener('click', window.popup.closePopup);

          var onEnterPressClose = function (evt) {
            if (evt.keyCode === 13) {
              window.popup.closePopup();

              document.removeEventListener('keydown', onEnterPressClose);
            }
          }

          closeButton.addEventListener('focus', function () {
            document.addEventListener('keydown', onEnterPressClose);
          });

          closeButton.addEventListener('blur', function () {
            document.removeEventListener('keydown', onEnterPressClose);
          });
        }
      };

      // Ф-я подмены содержимого попапа
      let popupContentCreator = function (prefix, popup, button, innerPopupButtonSelector = false) {
        // Анализируем имя кнопки, чтобы вставить нужный шаблон в шапку и форму
        let typePopup = button.name;

        // Получаем контейнер для шаблона
        let popupTemplateContainer = popup.querySelector(`#${prefix}-popup`);

        // Получаем нужный шаблон
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
        let scrollContorllFunction = function () {
          //console.log(popup.offsetHeight, popupTemplateContainer.offsetHeight, deviceHeight);
          if ( popup.offsetHeight >= deviceHeight || popupTemplateContainer.offsetHeight >= deviceHeight ) {
            popup.classList.add('scroll-content');
          } else {
            if (prefix !== 'game') {
              popup.classList.remove('scroll-content');
            }
          }
        };

        scrollContorllFunction();

        if (prefix === 'game') {
          let gameLinks = popup.querySelectorAll('.game__link');

          if (gameLinks) {
            gameLinks.forEach((gameLink, i) => {
              gameLink.addEventListener('click', function (evt) {
                evt.preventDefault();

                // Убираю класс скролла
                popup.classList.remove('scroll-content');

                let formGame = popup.querySelector('#form-game');
                let gameList = popup.querySelector('.popup__list--game');

                 if (formGame && gameList) {
                   formGame.classList.add('active');
                   gameList.classList.add('active');

                   // Получаем заголовок попапа
                   let popupTitle = popup.querySelector('.popup__title--game');

                   // Получаем название Игры
                   let gameTitle = gameLink.querySelector('.game__name');

                   // Получаем иконку платформы
                   let popupPlatform = popup.querySelector('.platform');

                   if (popupTitle && gameTitle && popupPlatform) {
                     popupTitle.textContent = gameTitle.textContent;

                     popupPlatform.classList.add('active');
                   }
                 }
              });
            });
          }
        }
      };

      // Все кнопки, которые открывают попапы
      let popupButtons = document.querySelectorAll('.openpopup');

      if (popupButtons) {
        // Перебираем все кнопки, которые открывают попапы
        popupButtons.forEach(function (popupButton) {
          // Активация кнопки открытия попапа
          window.popup.activatePopup(popupButton);
        });
      }

      if (OVERLAY_POPUP) {
        OVERLAY_POPUP.addEventListener('click', window.popup.closePopup);
      }

    } catch (e) {
      console.log(e);
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
})();
