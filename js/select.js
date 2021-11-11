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

    isAdminTournamentsCreate

    - глобальные переменные, которые используются для составления URI.
      Задаются в header.php
  */
  const { __, _x, _n, _nx } = wp.i18n;

  /*
    Экспортируется в form.js
  */

  window.select = {
    search : function (container) {
      let selects = container.querySelectorAll('.select');

      if (selects) {
        // Перебираю все селекты в контейнере
        selects.forEach((select, selectIndex) => {
          window.select.init(select, container);
        });
      }
    },
    init : function (select, container) {
      /* Создание селекта Игр по выбранной Платформе */
      let containerForSelectGames = container.querySelector('.form__row--games');
      let flagCreateGame = (select.dataset.create === 'games' && containerForSelectGames) ? true : false;
      /* ------------------------- */

      let button = select.querySelector('.select__button');
      let list = select.querySelector('.select__list');

      if (button && list) {
        // Вызов ф-и переключения активного класса для каждого Селекта
        window.toggleActive.single(button, [list]);

        window.select.activateInputs(button, select, flagCreateGame);
      }
    },
    activateInputs : function (button, select, flagCreateGame = false) {
      let radioInputs = select.querySelectorAll('input[type="radio"]');

      // Перебираю инауты и навешиваю на них событие изменения
      radioInputs.forEach((radioInput, i) => {
        // if (radioInput.checked) {
        //   button.classList.add('selected');
        //   button.textContent = radioInput.nextElementSibling.textContent;
        //
        //   console.log(radioInput);
        // }
        radioInput.addEventListener('change', function () {
          if (radioInput.checked) {
            button.classList.add('selected');
            button.textContent = radioInput.nextElementSibling.textContent;

            if (radioInput.name === 'platform' && flagCreateGame) {
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

              let selectGamesHTML = `
                <div class="select select--games">
                  <button class="select__button select__button--games" type="button" name="button">
                    ${__( 'Игра', 'earena_2' )}
                  </button>

                  <ul class="select__list select__list--games">
                    ${templateSelectGamesList}
                  </ul>
                </div>
              `;

              containerForSelectGames.innerHTML = selectGamesHTML;

              // Вызов ф-и активации селекта
              window.select(containerForSelectGames);
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

          if (isAdminTournamentsCreate && radioInput.name === 'game') {
            window.select.reActivateInputs(select.dataset.resetSelects);
          }
          //console.log(radioInput.checked, button.textContent, radioInput.value);
        });
      });
    },
    reActivateInputs : function (selectResetTypes = '', container = false) {
      container = container ? container : document;
      selectResetTypes.split(',').forEach((selectResetType, i) => {
        let selectItem = document.querySelector(`.select[data-type="${selectResetType}"]`);
        console.log('reActivateInputs', selectItem);
        let button = selectItem.querySelector('.select__button');
        window.select.resetButton(button);
        window.select.activateInputs(button, selectItem);
      });
    },
    resetButton : function (button) {
      if (button.classList.contains('selected')) {
        button.textContent = button.dataset.text ? button.dataset.text : '';

        button.classList.remove('selected');
      }
    }
  };

  document.addEventListener('DOMContentLoaded', function () {
    // Вызов ф-и при загрузке стр
    window.select.search(document);
  });
})();
