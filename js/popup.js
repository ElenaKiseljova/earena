'use strict';

document.addEventListener("DOMContentLoaded", function () {
  try {
    let ROOT_ELEMENT = document.documentElement;
    let OVERLAY_POPUP = document.querySelector('.popup__overlay');

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

    let popupButtons = document.querySelectorAll('.openpopup');

    if (popupButtons) {
      popupButtons.forEach(function (item) {
        let sufixPopupName = item.getAttribute('data-popup');
        let popupName = '.popup--' + sufixPopupName;

        let popupItem = document.querySelector(popupName);

        if (popupItem) {
          item.addEventListener('click', function () {
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
