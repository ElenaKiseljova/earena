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
        nextElementToggle: function (buttonSelector) {
          let buttons = document.querySelectorAll(buttonSelector);

          if (buttons) {
            buttons.forEach((button, i) => {
              button.addEventListener('click', function () {
                button.classList.toggle('active');

                if (button.nextElementSibling) {
                  button.nextElementSibling.classList.toggle('active');
                }
              });
            });
          }
        },

        // Переключение состояния всех связанных элементов по клику на 1 из них
        /*multiple: function (buttonSelector, elementSelector = false) {
          // Ф-я подстановки шаблона в контейнер
          let templateReplaseFunction = (containerID, contentID) => {
            let container = document.querySelector(`#${containerID}`);
            let template = document.querySelector(`#${contentID}`);

            if (container && template) {
              // Очистка контейнера
              container.innerHTML = '';

              let cloneTemplate = template.content.cloneNode(true);

              // Загружаем шаблон в контейнер
              container.appendChild(cloneTemplate);

              // Получаем кнопки открытия попапов
              let popupOpenButtons = container.querySelectorAll('.openpopup');

              if (popupOpenButtons) {
                popupOpenButtons.forEach((popupOpenButton, i) => {
                  // Активация попапа по клику на указанную кнопку
                  window.popup.activatePopup(popupOpenButton);
                });
              }
            }
          };

          // Получение всех кнопок
          let buttons = document.querySelectorAll(buttonSelector);

          if (buttons) {
            // Если есть класс связанного контента получаем элементы
            if (elementSelector) {
              var elements = document.querySelectorAll(elementSelector);
            }

            buttons.forEach((button, i) => {
              // При загрузке страницы подставлять шаблон активного таба
              // if (button.classList.contains('active') && button.dataset.containerId && button.dataset.contentId) {
              //   // Ф-я подстановки шаблона в контейнер
              //   templateReplaseFunction(button.dataset.containerId, button.dataset.contentId);
              // }

              button.addEventListener('click', function () {
                // Удаляю активные классы других кнопок/контента
                window.removeActiveClassElements(buttons);

                // Переключение класса тогла
                button.classList.toggle('active');

                // Если есть элементы, полученные из класса связанного контента
                if (elements) {
                  window.removeActiveClassElements(elements);

                  // Переключение класса контента
                  elements[i].classList.toggle('active');
                }

                // Если есть дата-атрибуты переключения Шаблонов
                // if (button.dataset.contentId && button.dataset.containerId) {
                //   // Ф-я подстановки шаблона в контейнер
                //   templateReplaseFunction(button.dataset.containerId, button.dataset.contentId);
                // }
              });
            });
          }
        },*/

        // Возможность выбора нескольких табов или таба "Все"
        several: function (buttonSelector) {
          let buttons = document.querySelectorAll(buttonSelector);

          if (buttons) {
            // Индекс кнопки "Все"
            let allButtonIndex = 0;

            let flagAllSelected = 0;

            buttons.forEach((button, i) => {
              button.addEventListener('click', function () {
                if (button.dataset.tabType === 'all') {
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

                if (buttons[allButtonIndex].classList.contains('active')) {
                  buttons[allButtonIndex].classList.remove('active');
                }

                // Переключение класса тогла
                button.classList.toggle('active');

                // Импортируется из файла platforms.js
                window.platforms.getSelected('games');
                window.platforms.getSelected('matches');
                window.platforms.getSelected('tournaments');
              });
            });
          }
        }
      };

      //                       //
      // --- ИНИЦИАЛИЗАЦИЯ --- //
      //                       //

      /* Фильтры */
      window.toggleActive.nextElementToggle('.filters__field--select');

      /* Аккордеон */
      window.toggleActive.nextElementToggle('.accordeon__button');

      /* Тогглы */
      // window.toggleActive.multiple('.toggles__item--tournament', '.toggles__content--tournament');

      /* Табы ( кошелёк ) */
      // window.toggleActive.multiple('.tabs__button--purse');

      /* Табы ( платформы ) */
      window.toggleActive.several('.tabs__button--platform');

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
