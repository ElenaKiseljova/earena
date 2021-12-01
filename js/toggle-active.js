'use strict';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    try {
      /*
        *
        *** Ф-я переключения активного класса по клику
        * Экспортируется в select.js
        */

      window.toggleActive = {
        // Для переключения одного/нескольких элементов по клику на один
        single: function (button, elements = [], overlay = false) {
          button.addEventListener('click', function () {
            button.classList.toggle('active');

            // Перебираем все элементы, что должны по клику переключиться
            elements.forEach((element, i) => {
              element.classList.toggle('active');

              // Класс для транзишн
              if (!element.classList.contains('loaded')) {
                element.classList.add('loaded');
              }
            });

            if (overlay) {
              overlay.classList.toggle('active');
            }
          });

          if (elements.length > 0) {
            // Переключение по клику на document
            document.addEventListener('click', function (evt) {
              if (button.classList.contains('active') && evt.target !== button) {
                button.classList.toggle('active');

                // Перебираем все элементы, что должны по клику переключиться
                elements.forEach((element, i) => {
                  element.classList.toggle('active');
                });

                if (overlay) {
                  overlay.classList.toggle('active');
                }
              }
            });
          }
        },

        // Для переключения следующего эл-та по клику на предыдущий
        multiple: function (attr = {}) {
          /*let attr = {
            container : document,
            buttonSelector : false,
            callback : false,
            toggleNextElement : false,
            unActiveAnother : false,
            selectorContent : false,
            setCookie : false,
            closeByDocumentClick : false
          };*/
          let container = document;
          if (attr.container) {
            container = attr.container;
          }

          if (attr.buttonSelector) {
            let buttons = container.querySelectorAll(attr.buttonSelector);

            buttons.forEach((button, i) => {
              button.addEventListener('click', function () {
                if (attr.unActiveAnother) {
                  // Удаляю активные классы других кнопок/контента
                  window.removeActiveClassElements(buttons);
                }

                button.classList.toggle('active');

                if (attr.callback) {
                  attr.callback(i, attr.selectorContent, attr.setCookie);
                }

                if (attr.toggleNextElement) {
                  button.nextElementSibling.classList.toggle('active');
                }
              });

              if (attr.closeByDocumentClick) {
                // Переключение по клику на document
                document.addEventListener('click', function (evt) {
                  if (button.classList.contains('active') && evt.target !== button) {
                    button.classList.toggle('active');

                    if (attr.toggleNextElement) {
                      button.nextElementSibling.classList.toggle('active');
                    }
                  }
                });
              }
            });
          }
        },

        // Возможность выбора нескольких табов или таба "Все"
        several: function (buttonSelector) {
          let buttons = document.querySelectorAll(buttonSelector);

          if (buttons.length > 0) {
            // Индекс кнопки "Все"
            let allButtonIndex = 0;

            let flagAllSelected = 0;

            buttons.forEach((button, i) => {
              flagAllSelected = button.classList.contains('active') ? (flagAllSelected + 1) : flagAllSelected;

              button.addEventListener('click', function () {
                if (parseInt(button.dataset.tabType, 10) === -1 || button.dataset.tabType === -1) {
                  // Переприсваиваем значение индекса (если кнопка "Все" - не под 0 индексом)
                  allButtonIndex = i;

                  // Удаляю активные классы других кнопок/контента
                  window.removeActiveClassElements(buttons);

                  // Флаг контроля кол-ва выбранных платформ
                  flagAllSelected = 0;
                } else if (! button.classList.contains('active')) {
                  // Увеличиваем кол-во выбранных платформ на 1
                  flagAllSelected += 1;

                  if (flagAllSelected === 4) {
                    // Если выбрано 4 платформы - прерываем стандартное действие и запрашиваем ВСЕ
                    buttons[allButtonIndex].click();

                    return;
                  }
                } else if (button.classList.contains('active') && flagAllSelected > 0) {
                  flagAllSelected -= 1;

                  if (flagAllSelected === 0) {
                    // Если не выбрано ни одной платформы
                    buttons[allButtonIndex].click();

                    return;
                  }
                }

                //console.log(flagAllSelected);

                if (buttons[allButtonIndex].classList.contains('active') && (parseInt(button.dataset.tabType, 10) !== -1 && button.dataset.tabType !== -1)) {
                  buttons[allButtonIndex].classList.remove('active');
                }

                // Переключение класса тогла
                button.classList.toggle('active');

                // Импортируется из файла platforms.js
                window.platforms.drawSelected('games');
                window.platforms.drawSelected('matches');
                window.platforms.drawSelected('tournaments');
                window.platforms.drawSelected('admin-tournaments');
              });
            });
          }
        },
        //                       //
        //    --- КОЛЛБЕКИ ---   //
        //                       //
        methods : {
          /* Табы ( пользователи ) - Чат (Админ) */
          toggleUserContent : function (index) {
            let userFormContainer = document.querySelector('#container-current-user');
            let userFormTemplate = document.querySelector(`#user-${index}`);

            if (userFormTemplate && userFormContainer) {
              userFormContainer.innerHTML = '';

              userFormContainer.appendChild(userFormTemplate.content.cloneNode(true));

              window.files(userFormContainer);

              let attrFormChat = {
                idForm: 'form-chat',
                // Содержимое элемента может очищаться при отправке формы и заменяться содержимым шаблона
                selectorForTemplateReplace: '#chat-page-form',
              };
              window.form.init(attrFormChat);

              let userFormOpenPopupButtons = userFormContainer.querySelectorAll('.openpopup');
              if (userFormOpenPopupButtons.length > 0) {
                userFormOpenPopupButtons.forEach((userFormOpenPopupButton, i) => {
                  window.popup.activateOpenPopupButton(userFormOpenPopupButton);
                });
              }
            }
          },
          /* Переключатели на стр Турнира (Кубка / Лаки Кубка)*/
          toggleTournamentContent : function (index) {
            let tournamentTabContents = document.querySelectorAll('.toggles__content--tournament');

            if (tournamentTabContents[index]) {
              removeActiveClassElements(tournamentTabContents);

              tournamentTabContents[index].classList.add('active');
            }
          },
          /* Переключатели на стр Матчей/Турниров Админа */
          toggleAdminContent : function (index, selectorContent, setCookie) {
            if (selectorContent) {
              let adminTabContents = document.querySelectorAll(selectorContent);

              if (adminTabContents[index]) {
                removeActiveClassElements(adminTabContents);

                adminTabContents[index].classList.add('active');
              }
            }

            if (setCookie.name) {
              window.cookieEdit.set(setCookie.name, index);
            }
          }
        }
      };

      // Вызов при загрузке страницы
      window.toggleActive.methods.toggleUserContent(0);

      //                       //
      // --- ИНИЦИАЛИЗАЦИЯ --- //
      //                       //

      /* Табы ( платформы ) */
      window.toggleActive.several('.tabs__button--platform');

      /* Фильтры */
      let attrFilter = {
        buttonSelector : '.filters__field--select',
        toggleNextElement : true,
        closeByDocumentClick : true,
      };
      window.toggleActive.multiple(attrFilter);

      /* Аккордеон */
      let attrAcordeon = {
        buttonSelector : '.accordeon__button',
        toggleNextElement : true,
      };
      window.toggleActive.multiple(attrAcordeon);

      /* Переключатели на стр Турнира (Кубка / Лаки Кубка) */
      let attrTabTournament = {
        buttonSelector : '.toggles__item--tournament',
        callback : window.toggleActive.methods.toggleTournamentContent,
        unActiveAnother : true,
      };
      window.toggleActive.multiple(attrTabTournament);

      /* Табы ( пользователи ) - Чат (Админ) */
      let attrTabMatchAdmin = {
        buttonSelector : '.tabs__button--users',
        callback : window.toggleActive.methods.toggleUserContent,
        unActiveAnother : true,
      };
      window.toggleActive.multiple(attrTabMatchAdmin);

      /* Переключатели Матчей на стр Профиля Админа */
      let attrTabMatchesProfileAdmin = {
        buttonSelector : '.tabs__button--matches-admin',
        callback : window.toggleActive.methods.toggleAdminContent,
        unActiveAnother : true,
        selectorContent : '.section__content--matches-admin',
        setCookie : {name: 'admin_tab_active_index'},
      };
      window.toggleActive.multiple(attrTabMatchesProfileAdmin);

      /* Переключатели Турниров на стр Профиля Админа */
      let attrTabTournamentsProfileAdmin = {
        buttonSelector : '.tabs__button--tournaments-admin',
        callback : window.toggleActive.methods.toggleAdminContent,
        unActiveAnother : true,
        selectorContent : '.section__content--tournaments-adminn',
        setCookie : {name: 'admin_tab_active_index'},
      };
      window.toggleActive.multiple(attrTabTournamentsProfileAdmin);

      /* Языки */
      let languages = document.querySelectorAll('.languages');

      if (languages) {
        languages.forEach((language, i) => {
          let button = language.querySelector('.wpml-ls-item-toggle');
          let list = language.querySelector('.wpml-ls-sub-menu');

          if (button && list) {
            // Вызов ф-и переключения активного класса для каждого Селекта
            window.toggleActive.single(button, [list]);
          }
        });
      }

      /* Меню */
      let menuMobile = document.querySelector('.page-header__burger');
      let menuMobileElement1 = document.querySelector('.page-header__bottom');
      let menuMobileElement2 = document.querySelector('.page-header__center');
      let menuMobileOverlay = document.querySelector('.overlay--navigation');

      if (menuMobile && menuMobileElement1 && menuMobileElement2 && menuMobileOverlay) {
        // Вызов ф-и переключения активного класса для каждого связанного эл меню
        window.toggleActive.single(menuMobile, [menuMobileElement1, menuMobileElement2], menuMobileOverlay);
      }
    } catch (e) {
      console.log(e);
    }
  });
})();
