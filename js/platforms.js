'use strict';

(function () {
  try {
    // Шаблоны игр/матчей/турниров
    let templates = {
      games : function (game) {
        let name = game['name'],
            img = game['img'],
            url = '/game',//game[''],
            platforms = game['platforms'],
            variations = game['variations'];

        // Вариации игры
        let variationsTemplate = '';
        if (variations) {
          variationsTemplate = '<ul class="variations">' + variations.map(function(variation) {
            return `
                    <li class="variations__item">
                      ${variation} vs ${variation}
                    </li>
                   `;
          }).join(' ') + '</ul>';
        }

        // Платформы
        let platformsTemplate = '';
        if (platforms) {
          platformsTemplate = '<ul class="game__platforms">' + platforms.map(function(platform) {
            return `
                    <li class="platform platform--game">
                      <svg class="platform__icon" width="30" height="30">
                        <use xlink:href="#icon-platform-${platform}"></use>
                      </svg>
                    </li>
                   `;
          }).join(' ') + '</ul>';
        }

        return `
                <div class="game">
                  <a class="game__link" href="${url}">
                    <div class="game__image game__image--archive">
                      <img src="${img}" alt="${name}">
                    </div>

                    ${variationsTemplate}

                    <h3 class="game__name">
                      ${name}
                    </h3>

                    ${platformsTemplate}

                  </a>
                </div>
                `;
      },
      tournaments : function (name, img, url, game,  platforms, variations, id, bet, lock, trophy, status, date = {registration : false, start : false,  end : false}, members = {all : 0, current : 0}, winner = {name : false, img : false}) {

      },
      matches : function (name, img, url, game, platforms, variations, id, bet, lock, status, members = { user1 : { name : false, url: false, img : false, stream : false, result : false}, user1 : { name : false, url: false, img : false, stream : false, result : false} }) {

      },
    };

    // Экспортируется в файл toggle-active.js
    window.platforms = {
      // Ф-я получения активных платформ и подстановки их шаблона игр/матчей/турниров
      getSelected : function (what) {
        // what - может принимать значения : games/matches/tournaments

        // Массив с выбранными платформами
        let platformsSelected = [];

        // Получаем все активные табы
        let platformsActiveTabs = document.querySelectorAll('.tabs__button--platform.active');

        if (platformsActiveTabs) {
          platformsActiveTabs.forEach((platformsActiveTab, i) => {
            platformsSelected.push(platformsActiveTab.dataset.tabType);
          });

          //console.log(platformsSelected);

          // Здесь отправляется запрос на получение игр/матчей/турниров под выбранные платформы
          // И получаем что-то типа такого для примера
          let amount = 21;
          if (platformsSelected.includes('all') || (platformsSelected.includes('desktop') && platformsSelected.includes('mobile') && platformsSelected.includes('xbox') && platformsSelected.includes('playstation'))) {
            amount = 21;
          } else if (platformsSelected.includes('desktop') && platformsSelected.includes('mobile') && platformsSelected.includes('xbox')) {
            amount = 17;
          } else if (platformsSelected.includes('desktop') && platformsSelected.includes('mobile')) {
            amount = 8;
          } else if (platformsSelected.includes('desktop')) {
            amount = 7;
          }

          window.platforms.showFilteredAmount(what, amount);

          if (games) {
            let isPlatform = function (game) {
              if (platformsSelected.includes('all')) {
                return true;
              } else {
                let gamePlatforms = game['platforms'];

                for (let i = 0; i < gamePlatforms.length; i++) {
                  if (platformsSelected.includes(gamePlatforms[i])) {
                    return true;

                    break;
                  }
                }
              }
            };

            let gamesFiltered = games.filter(isPlatform);

            console.log(gamesFiltered);

            let container = document.querySelector(`#content-platform-${what}`);

            if (container) {
              let gamesTemplate = gamesFiltered.map(function(gameFiltered) {
                return `
                        <li class="section__item section__item--col-6">
                          ${templates.games(gameFiltered)}
                        </li>
                       `;
              }).join(' ');

              container.innerHTML = gamesTemplate;
            }
          }
        }
      },
      showFilteredAmount : function (what, amount) {
        // what - может принимать значения : games/matches/tournaments

        let titleAmountWhat =  document.querySelector(`.section__title--${what} .section__amount`);

        if (titleAmountWhat) {
          titleAmountWhat.textContent = amount;
        }
      }
    };

    document.addEventListener('DOMContentLoaded', function () {
      window.platforms.getSelected('games');
    });
  } catch (e) {
    console.log(e);
  }
})();
