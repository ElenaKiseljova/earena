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

      // Если при отправке формы аякс добавлялся класс, который влияет на отображение элементов, то его ужалить при новом открытии попапа
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

    // Ф-я сброса формы регистрации на турнир в дефолтное состояние
    var formRegistrationTournamentDefault = function () {
      let wrapper = document.querySelector('.wrapper-form--tournament');
      let template = document.querySelector('#form-tournament-default');

      if (wrapper && template) {

        wrapper.innerHTML = '';

        let cloneTemplate = template.content.cloneNode(true);

        wrapper.appendChild(cloneTemplate);

        // Запуск валидации формы
        window.form({
          idForm: 'form-tournament',
          selectorForTemplateReplace: '.wrapper-form--tournament', // Содержимое будет очищаться при отправке и заменяться шаблонами
          classForAddClosestWrapperForm: 'sending', // по умолчанию - false
          selectorClosestWrapperForm: '.popup--tournament', // по умолчанию - false
        });
      }
    };

    // Ф-я подмены содержимого шапки и формы в попапе
    let popupContentCreator = function (popup, button, informPopupButtonSelector) {
      // Анализируем имя кнопки, чтобы вставить нужный шаблон в шапку и форму
      let typeLoginPopup = button.name;

      // Получаем элементы шапки
      let popupLoginHeader = popup.querySelector('.popup__header--login');

      // Получаем враппер формы
      let wrapperForm = popup.querySelector('.wrapper-form--login');

      if (popupLoginHeader && wrapperForm) {
        // Очищаем шапку
        popupLoginHeader.innerHTML = '';

        // Очищаем враппер формы
        wrapperForm.innerHTML = '';

        // Получаем нужный шаблон шапки
        let popupLoginHeaderTemplate = popup.querySelector(`#popup-login-header-${typeLoginPopup}`).content;
        let cloneLoginHeaderTemplate = popupLoginHeaderTemplate.cloneNode(true);

        // Получаем нужный шаблон формы
        let wrapperFormTemplate = popup.querySelector(`#form-login-${typeLoginPopup}`).content;
        let cloneWrapperFormTemplate = wrapperFormTemplate.cloneNode(true);

        // Заменяем содержимое шапки
        popupLoginHeader.appendChild(cloneLoginHeaderTemplate);

        // Заменяем содержимое формы
        wrapperForm.appendChild(cloneWrapperFormTemplate);
      }

      // Смена шаблонов по клику на кнопки типа: забыл пароль/войти/зарегистрироваться
      let popupInformButtons = popup.querySelectorAll(informPopupButtonSelector);

      popupInformButtons.forEach((popupInformButton, i) => {
        popupInformButton.addEventListener('click', function () {
          popupContentCreator(popup, popupInformButton, informPopupButtonSelector);
        });
      });

      // Перезапуск валидации формы
      window.form({
        idForm: 'form-login',
        selectorForTemplateReplace: '.wrapper-form--login', // Содержимое будет очищаться при отправке и заменяться шаблонами
        classForAddClosestWrapperForm: 'sending', // по умолчанию - false
        selectorClosestWrapperForm: '.popup--login', // по умолчанию - false
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
              popupContentCreator(popupItem, item, '.popup__button--information');
            }

            if (sufixPopupName === 'tournament') {
              // Форма Регистрации на Турнир в дефолтное состояние
              formRegistrationTournamentDefault();
            }

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
