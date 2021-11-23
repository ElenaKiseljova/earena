'use strict';

(function () {
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

    - глобальные переменные, которые используются для составления URI.
      Задаются в header.php
  */

  document.addEventListener('DOMContentLoaded', function () {
    try {
      const { __, _x, _n, _nx } = wp.i18n;

      var timeoutComplaint;

      // Данные о юзере, что запросил верификацию (получаются из кнопки открытия попапа)
      var userVerificationId,
        userVerificationName;

      // Более точная высота экрана
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
        closePopup : function (evt) {
          evt.preventDefault();
          // Все попапы
          let allPopup = document.querySelectorAll('.popup');

          if (allPopup.length > 0) {
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

          if (allPopup.length > 0) {
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
        // Поиск всех кнопок открытия попапов, что есть в указанном контейнере
        searchOpenPopupButton : function (container) {
          let popupButtons = container.querySelectorAll('.openpopup');
          if (popupButtons.length > 0) {
            // Перебираем все кнопки, которые открывают попапы
            popupButtons.forEach(function (popupButton) {
              // Активация кнопки открытия попапа
              window.popup.activateOpenPopupButton(popupButton);
            });
          }
        },
        // Активация кнопки открытия попапа
        activateOpenPopupButton : function (popupButton) {
          let sufixPopupName = popupButton.dataset.popup;
          let popupName = '.popup--' + sufixPopupName;

          let popupItem = document.querySelector(popupName);

          if (popupItem) {
            popupButton.addEventListener('click', function () {
              // У формы логирования есть дополнительные кнопки, которые меняют шаблон
              // Поэтому для нее задан еще один параметр
              if (sufixPopupName === 'login') {
                window.popup.contentCreator(sufixPopupName, popupItem, popupButton, '.popup__button--information');
              }

              // Подстановка шаблона при открытии - не дефолтное поведение при открытии попапа.
              // Поэтому здесь перечислены те попапы, к которым эта ф-я применяется
              if (
                  sufixPopupName === 'complaint' ||
                  sufixPopupName === 'tournament' ||
                  sufixPopupName === 'match' ||
                  sufixPopupName === 'game' ||
                  sufixPopupName === 'stream' ||
                  sufixPopupName === 'verification' ||
                  sufixPopupName === 'friends' ||
                  sufixPopupName === 'purse' ||
                  sufixPopupName === 'warning' ||
                  sufixPopupName === 'block' ||
                  sufixPopupName === 'balance' ||
                  sufixPopupName === 'vip' ||
                  sufixPopupName === 'contact' ||
                  sufixPopupName === 'create'
                ) {

                window.popup.contentCreator(sufixPopupName, popupItem, popupButton);
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
            if (closePopupButtons.length > 0) {
              closePopupButtons.forEach((closePopupButton, i) => {
                // Активация кнопки закрытия попапа
                window.popup.activateClosePopupButton(closePopupButton);
              });
            }
          }
        },
        // Добавление св-ва закрытия попапа по клику на указанный элемент
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
        },
        // Ф-я подстановки содержимого попапа
        contentCreator : function (prefix, popup, button, innerPopupButtonSelector = false) {
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
          } else if (popupTemplateContainer && (prefix === 'match') && (typePopup === 'join')) {
            let getTemplateJoinMatchFormHTML = function () {
              let hiddenInputsHTML = `
                <input type="hidden" name="id" value="${button.dataset.id}">
                <input type="hidden" name="security" value="${button.dataset.security}">
              `;

              let privateMatchHTML = `
                <div class="popup__ajax-message"></div>
                <div class="form__row">
                  <input class="form__field form__field--popup" id="password" type="password" name="match_pass" required placeholder="${__( 'Пароль', 'earena_2' )}">
                </div>
                <span class="form__error form__error--popup">${__( 'Error', 'earena_2' )}</span>

                <p class="form__text">
                  ${__( 'Это приватный матч. Введите пароль.', 'earena_2' )}
                </p>
              `;

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

              let teamModeHTML = `
                <li class="variations__item">
                  ${button.dataset.teamMode}
                </li>
              `;

              let variationsHTML = `
                <ul class="variations ${((button.dataset.private == '1') ? 'variations--lock' : '')}">
                  <li class="variations__item">
                    ${button.dataset.gameMode}
                  </li>
                  ${((button.dataset.teamMode !== '') ? teamModeHTML : '')}
                </ul>
              `;

              let templateJoinFormHTML = `
                <div class="match match--popup">
                  <div class="match__top-left">
                    <h3 class="match__game">
                      ${button.dataset.game}
                    </h3>
                    ${variationsHTML}
                  </div>

                  <div class="platform platform--match">
                    <svg class="platform__icon" width="40" height="40">
                      <use xlink:href="#icon-platform-${button.dataset.platform}"></use>
                    </svg>
                  </div>
                </div>

                <div class="popup__content popup__content--match">
                  <div class="pay pay--match">
                    <table class="pay__table">
                      <tbody class="pay__body">
                        <tr class="pay__row">
                          <td class="pay__column">
                            ${__( 'Доступный баланс:', 'earena_2' )}
                          </td>
                          <td class="pay__column pay__column--balance pay__column--right ${(button.dataset.balance < button.dataset.bet) ? 'pay__column--red' : ''}">
                            ${('$' + button.dataset.balance)}
                          </td>
                        </tr>
                        <tr class="pay__row">
                          <td class="pay__column">
                            ${__( 'Со счета будет списано:', 'earena_2' )}
                          </td>
                          <td class="pay__column pay__column--right">
                            ${('$' + button.dataset.bet)}
                          </td>
                        </tr>
                      </tbody>
                    </table>

                    ${(button.dataset.balance < button.dataset.bet) ? smallBalanceHTML : ''}
                  </div>
                  <form class="form form--popup" data-prefix="accept" id="form-match" action="/" method="post">
                    ${(button.dataset.private == '1') ? privateMatchHTML : ''}

                    ${hiddenInputsHTML}

                    <div class="form__buttons">
                      <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close" type="button" name="match-close">
                        <span>
                          ${__( 'Отменить', 'earena_2' )}
                        </span>
                      </button>

                      <button class="form__submit form__submit--buttons button button--blue ${(button.dataset.balance < button.dataset.bet) ? 'hidden' : ''}"" type="submit" name="match-submit ${(button.dataset.balance < button.dataset.bet) ? 'disabled' : ''}">
                        <span>
                          ${__( 'Принять', 'earena_2' )}
                        </span>
                      </button>
                    </div>
                    <p class="form__text form__text--star">
                      ${__( 'Отменить участие в матче будет невозможно.', 'earena_2' )}
                    </p>
                  </form>
                </div>
              `;

              return templateJoinFormHTML;
            };

            popupTemplateContainer.innerHTML = getTemplateJoinMatchFormHTML();
          }

          // Проверка : Заданы ли внутренние кнопки
          if (innerPopupButtonSelector) {
            // Смена шаблонов по клику на кнопки типа: забыл пароль/войти/зарегистрироваться
            let innerPopupButtons = popup.querySelectorAll(innerPopupButtonSelector);

            innerPopupButtons.forEach((innerPopupButton, i) => {
              innerPopupButton.addEventListener('click', function () {
                window.popup.contentCreator(prefix, popup, innerPopupButton, innerPopupButtonSelector);
              });
            });
          }

          // Проверка на то, что форма не находится на странице.
          // Чтобы избежать дублей событий
          if ((prefix !== 'contact') && (prefix !== 'chat') && (prefix !== 'create')) {
            // Инициализация формы
            let attrForm = {
              idForm: `form-${prefix}`,
              selectorForTemplateReplace: `#${prefix}-popup`, // Содержимое будет очищаться при отправке и заменяться шаблонами
              classForAddClosestWrapperForm: 'sending', // по умолчанию - false
              selectorClosestWrapperForm: `.popup--${prefix}`, // по умолчанию - false
            };

            let formInitTrue = window.form.init(attrForm);
            if (formInitTrue === false) {
              // Вызов ф-и для активации дополнительных кнопок закрытия попапа,
              // если формы нет в шаблоне
              window.form.additionButtonClosePopup(popup);
            }
          } else if (prefix === 'contact' || prefix === 'chat' || prefix === 'create') {
            // Вызов ф-и для активации дополнительных кнопок закрытия попапа,
            // если формы нет в шаблоне
            window.form.additionButtonClosePopup(popup);
          }

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
            let nicknamesTemplate = button.querySelector('[id*="nicknames"]');
            let formGame = popup.querySelector(`#form-${prefix}`);
            if (nicknamesTemplate && formGame) {
              let nicknamesContent = nicknamesTemplate.content.cloneNode(true);
              formGame.appendChild(nicknamesContent);
            }

            let gameLinks = popup.querySelectorAll('.game__link');

            if (gameLinks.length > 0) {
              gameLinks.forEach((gameLink, i) => {
                gameLink.addEventListener('click', function (evt) {
                  evt.preventDefault();

                  // Убираю класс скролла
                  popup.classList.remove('scroll-content');

                  let gameList = popup.querySelector('.popup__list--game');

                   if (formGame && gameList && dataGames) {
                     formGame.classList.add('active');
                     gameList.classList.add('active');

                     // Получаем заголовок попапа
                     let popupTitle = popup.querySelector('.popup__title--game');
                     // Получаем название Игры
                     let gameTitle = dataGames[gameLink.dataset.game].name;
                     // Получаем иконку платформы
                     let popupPlatform = popup.querySelector('.platform');
                     // Получаем Инпут с никнеймом
                     let nicknameInputField = formGame.querySelector('#game-nickname');
                     // Получаем подзаголовок
                     let popupSubTitle = popup.querySelector('.popup__information--game');

                     if (popupTitle && popupSubTitle && gameTitle && popupPlatform) {
                       popupTitle.textContent = gameTitle;

                       popupPlatform.classList.add('active');
                       popupSubTitle.classList.add('active');

                       if (nicknameInputField) {
                         let oldNicknameField = formGame.querySelector(`input[name="nicknames[${gameLink.dataset.game}][${gameLink.dataset.platform}]"]`);

                         if (oldNicknameField) {
                           //console.log('Clone removed -> ', oldNicknameField);
                           oldNicknameField.remove();
                         }

                         nicknameInputField.name = `nicknames[${gameLink.dataset.game}][${gameLink.dataset.platform}]`;
                       }
                     }
                   }
                });
              });
            }
          }

          if (prefix === 'verification') {
            if (typePopup === 'request') {
              window.files(popup);
            }
          }

          if (prefix === 'match') {
            if (typePopup === 'delete') {
              window.popup.setInputValue(popupTemplateContainer, ['id'], [button.dataset.id]);
            }
          }

          if (prefix === 'warning') {
            if (typePopup === 'add' || typePopup === 'delete') {
              let inputValues = [
                button.dataset.userId ? button.dataset.userId : null,
                button.dataset.userName ? button.dataset.userName : null,
                button.dataset.matchId ? button.dataset.matchId : null,
                button.dataset.matchThreadId ? button.dataset.matchThreadId : null
              ];

              let inputNames = [
                'user',
                'username',
                'match_id',
                'match_thread_id'
              ];

              window.popup.setInputValue(popupTemplateContainer, inputNames, inputValues);
            }
          }

          if (prefix === 'tournament') {
            if (typePopup === 'delete-cron') {
              window.popup.setInputValue(popupTemplateContainer, ['cron', 'crontime'], [button.dataset.cron, button.dataset.crontime]);
            }

            if (typePopup === 'delete-tournament' || typePopup === 'cancel') {
              window.popup.setInputValue(popupTemplateContainer, ['id'], [button.dataset.id]);
            }
          }

          if (prefix === 'complaint') {
            button.disabled = true;

            if (timeoutComplaint) {
              clearTimeout(timeoutComplaint);
            }

            let timeoutTime = 1000 * 60; // 1m
            timeoutComplaint = setTimeout(function () {
              button.disabled = false;
            }, timeoutTime);
          }

          // Подстановка Имени и ИД в формы попапа (есди в кнопке есть дата атрибуты с именем и ИД)
          window.popup.userInfo(button, popup);
        },
        // Подстановка информации о пользователе в попап по клику на кнопку
        userInfo : function (button = false, popup) {
          //console.log('window.popup.userInfo', button, popup);
          if (button) {
            if (button.dataset.userId && button.dataset.userName) {
              userVerificationId = button.dataset.userId;
              userVerificationName = button.dataset.userName;
            }
          }

          if (popup && userVerificationId && userVerificationName) {
            popup.querySelectorAll('.user-name').forEach((userNameField, i) => {
              if (userNameField.tagName === 'INPUT') {
                userNameField.value = userVerificationName;
              } else {
                userNameField.textContent = userVerificationName;
              }
            });

            popup.querySelectorAll('.user-id').forEach((userIdField, i) => {
              if (userIdField.tagName === 'INPUT') {
                userIdField.value = userVerificationId;
              } else {
                userIdField.textContent = userVerificationId;
              }
            });
          }
        },
        // Установка значений инпутам
        setInputValue : function (container, inputNames = [], values = []) {
          inputNames.forEach((inputName, i) => {
            let input = container.querySelector(`input[name="${inputName}"]`);
            if (input) {
              input.value = values[i];
            }
          });
        }
      };

      window.popup.searchOpenPopupButton(document);

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
    if (popups.length > 0) {
      popups.forEach((popup, i) => {
        popup.classList.add('loaded');
      });
    }
  });
})();
