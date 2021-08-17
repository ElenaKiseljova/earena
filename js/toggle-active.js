'use strict';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    try {
      let toggleCheckersFlag = false;

      /* Ф-я переключения активного класса по клику */
      let toggleActive = {
        single: function (buttonSelector, elementToggleSelectors = [], overlaySelector = false) {
          let button = document.querySelector(buttonSelector);

          // Фон
          let overlay;
          if (overlaySelector) {
            overlay = document.querySelector(overlaySelector);
          }

          if (button) {
            button.addEventListener('click', function () {
              button.classList.toggle('active');

              // Перебираем все элементы, что должны по клику переключиться
              elementToggleSelectors.forEach((elementToggleSelector, i) => {
                let element = document.querySelector(elementToggleSelector);

                if (element) {
                  element.classList.toggle('active');

                  // Класс для транзишн
                  if (!element.classList.contains('loaded')) {
                    element.classList.add('loaded');
                  }
                }
              });

              if (overlay) {
                overlay.classList.toggle('active');
              }
            });

            if (elementToggleSelectors.length > 0) {
              document.addEventListener('click', function (evt) {
                if (button.classList.contains('active') && evt.target !== button) {
                  button.classList.toggle('active');

                  // Перебираем все элементы, что должны по клику переключиться
                  elementToggleSelectors.forEach((elementToggleSelector, i) => {
                    let element = document.querySelector(elementToggleSelector);

                    if (element) {
                      element.classList.toggle('active');
                    }
                  });

                  if (overlay) {
                    overlay.classList.toggle('active');
                  }
                }
              });
            }
          }
        },
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
        multiple: function (buttonSelector, elementSelector = false) {
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

              // Форма в Кошельке
              if (document.querySelector('#form-purse')) {
                // Перезапуск/запуск валидации формы
                window.form({
                  idForm: 'form-purse',
                  selectorForTemplateReplace: '#purse-popup', // Содержимое будет очищаться при отправке и заменяться шаблонами
                  classForAddClosestWrapperForm: false, // по умолчанию - false
                  selectorClosestWrapperForm: false, // по умолчанию - false
                });

                /* Кошелек */
                toggleActive.single('.form__submit--purse', ['.popup--purse'], '.overlay--purse');
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
              if (button.classList.contains('active') && button.dataset.containerId && button.dataset.contentId) {
                // Ф-я подстановки шаблона в контейнер
                templateReplaseFunction(button.dataset.containerId, button.dataset.contentId);
              }

              button.addEventListener('click', function () {
                // Удаляю активные классы других кнопок/контента
                removeActiveClassElements(buttons);

                // Переключение класса тогла
                button.classList.toggle('active');

                // Если есть элкменты, полученные из класса связанного контента
                if (elements) {
                  removeActiveClassElements(elements);

                  // Переключение класса контента
                  elements[i].classList.toggle('active');
                }

                // Если есть дата-атрибуты
                if (button.dataset.contentId && button.dataset.containerId) {
                  // Ф-я подстановки шаблона в контейнер
                  templateReplaseFunction(button.dataset.containerId, button.dataset.contentId);
                }
              });
            });

            // Если в разметке присущи кнопки, переключающие табы, но они - не табы.
            // Им добавлен класс "togglechecker"
            // Проверка: подвешено ли уже событие на кнопку
            if (!toggleCheckersFlag) {
              let toggleCheckers = document.querySelectorAll('.togglechecker');

              if (toggleCheckers) {
                toggleCheckers.forEach((toggleChecker, i) => {
                  toggleChecker.addEventListener('click', function () {
                    if (toggleChecker.dataset.toggleIndex) {
                      // Переход ко вкладке с индексом в дата-атрибуту кнопки тогл-чекера
                      buttons[toggleChecker.dataset.toggleIndex].click();
                    }
                  });

                  toggleCheckersFlag = true;
                });

              }
            }
          }
        }
      };

      /* Языки */
      toggleActive.single('.languages__select', ['.languages__list']);

      /* Меню */
      toggleActive.single('.page-header__burger', ['.page-header__bottom', '.page-header__center'], '.overlay--navigation');

      /* Фильтры */
      toggleActive.nextElementToggle('.filters__field--select');

      /* Аккордеон */
      toggleActive.nextElementToggle('.accordeon__button');

      /* Тогглы */
      toggleActive.multiple('.toggles__item', '.toggles__content');

      /* Табы */
      toggleActive.multiple('.tabs__button');
    } catch (e) {
      console.log(e);
    }
  });
})();
