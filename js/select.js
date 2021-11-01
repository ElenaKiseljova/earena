'use strict';

(function () {
  /*
    *
    *** Ф-я кастомного селекта
    * Экспортируется в form.js
  */
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
  const { __, _x, _n, _nx } = wp.i18n;

  window.select = function (container) {
    let selects = container.querySelectorAll('.select');

    if (selects) {
      // Перебираю все селекты в контейнере
      selects.forEach((select, i) => {
        /* Создание селекта Платформ */
        let containerForSelectPlatform = container.querySelector('.form__row--platforms');
        let flagCreatePlatform = (select.dataset.create === 'platforms' && containerForSelectPlatform) ? true : false;
        /* ------------------------- */

        let button = select.querySelector('.select__button');
        let list = select.querySelector('.select__list');
        let radioInputs = select.querySelectorAll('input[type="radio"]');

        if (button && list && radioInputs) {
          // Вызов ф-и переключения активного класса для каждого Селекта
          window.toggleActive.single(button, [list]);

          // Перебираю инауты и навешиваю на них событие изменения
          radioInputs.forEach((radioInput, i) => {
            if (radioInput.checked) {
              button.classList.add('selected');
              button.textContent = radioInput.nextElementSibling.textContent;
            }

            radioInput.addEventListener('change', function () {
              if (radioInput.checked) {
                button.classList.add('selected');
                button.textContent = radioInput.nextElementSibling.textContent;

                if (radioInput.name === 'platform' && flagCreatePlatform) {
                  let templateSelectGamesList = window.platforms.getFilteredGames(dataGames, radioInput.value).map(function (game) {
                    let templateSelectItemHTML = `
                      <li class="select__item">
                        <input class="visually-hidden" type="radio" name="game" value="${game.key}" id="select-game-${game.key}" required>
                        <label class="select__label" for="select-game-${game.key}">
                          ${dataGames[game.key].name}
                        </label>
                      </li>
                    `;

                    return templateSelectItemHTML;
                  }).join('');

                  let selectPlatformsHTML = `
                    <div class="select select--games">
                      <button class="select__button select__button--games" type="button" name="button">
                        ${__( 'Игра', 'earena_2' )}
                      </button>

                      <ul class="select__list select__list--games">
                        ${templateSelectGamesList}
                      </ul>
                    </div>
                  `;

                  containerForSelectPlatform.innerHTML = selectPlatformsHTML;

                  // Вызов ф-и активации селекта
                  window.select(containerForSelectPlatform);
                }

                if (radioInput.name === 'game-statistics') {
                  let statisticsContent = document.querySelector('.statistics__content--account');
                  if (statisticsContent) {
                    window.statistics.init(statisticsContent, 'matches', radioInput.value);
                    window.statistics.init(statisticsContent, 'tournaments', radioInput.value);
                    window.statistics.init(statisticsContent, 'rounds', radioInput.value);
                  }
                }
              }
              //console.log(radioInput.checked, button.textContent, radioInput.value);
            });
          });
        }
      });
    }
  };

  document.addEventListener('DOMContentLoaded', function () {
    // Вызов ф-и при загрузке стр
    window.select(document);
  });
})();
