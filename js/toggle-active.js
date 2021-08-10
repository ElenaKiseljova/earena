'use strict';

(function () {
  try {
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
              }
            });

            if (overlay) {
              overlay.classList.toggle('active');
            }
          });

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

          window.addEventListener('load', function () {
            // Перебираем все элементы, что должны по клику переключиться
            elementToggleSelectors.forEach((elementToggleSelector, i) => {
              let element = document.querySelector(elementToggleSelector);

              if (element) {
                // При наличии этого класса - транзишн срабатывает
                element.classList.add('loaded');
              }
            });
          });
        }
      },
      nextElementToggle: function (buttonSelector) {
        let buttons = document.querySelectorAll(buttonSelector);

        if (buttons) {
          buttons.forEach((button, i) => {
            button.addEventListener('click', function () {
              button.classList.toggle('active');
              button.nextElementSibling.classList.toggle('active');
            });
          });
        }
      },
      multiple: function (buttonSelector, elementSelector) {
        let buttons = document.querySelectorAll(buttonSelector);
        let elements = document.querySelectorAll(elementSelector);

        if (buttons && elements) {
          buttons.forEach((button, i) => {
            button.addEventListener('click', function () {
              // Удаляю активные классы других кнопок/контента
              removeActiveClassElements(buttons);
              removeActiveClassElements(elements);

              // Переключение класса тогла
              button.classList.toggle('active');

              // Переключение класса контента
              elements[i].classList.toggle('active');
            });
          });
        }
      }
    };

    /* Языки */
    toggleActive.single('.languages__select', ['.languages__list']);

    /* Меню */
    toggleActive.single('.page-header__burger', ['.page-header__bottom', '.page-header__center'], '.overlay--navigation');

    /* Фильтры */
    toggleActive.nextElementToggle('.filters__field--select');

    /* Тогглы */
    toggleActive.multiple('.toggles__item', '.toggles__content');

    /* Аккордеон */
    toggleActive.nextElementToggle('.accordeon__button');
  } catch (e) {
    console.log(e);
  }
})();
