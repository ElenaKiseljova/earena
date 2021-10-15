'use strict';

(function ($) {
  /*
    dataGames,
    currentGameId,

    siteURL,
    siteThemeFolderURL,
    ea_icons
    platformsArr

    - глобальные переменные, которые используются для составления URI.
      Задаются в header.php
  */
  try {
    const { __, _x, _n, _nx } = wp.i18n;

    // Экспортируется в файл toggle-active.js
    window.platforms = {
      drawSelected : function (what) {
        let platformsSelected = window.platforms.getSelectedPlatforms();

        if (!platformsSelected) {
          return;
        }

        //console.log('Выбрано:', platformsSelected + '(' + what +')');

        let dataFiltered;
        // Получаем контейнер для Игр/Матчей/Турниров
        let container = document.querySelector(`#content-platform-${what}`);

        if (what === 'games' && dataGames && container) {
          dataFiltered = window.platforms.getFilteredGames(dataGames, platformsSelected);

          window.platforms.createList(what, dataFiltered, container);

          return;
        } else if (what !== 'games' && container) {
          dataFiltered = window.platforms.getDataAjax(what, platformsSelected, '', container);
        }
      },
      createList : function (what, dataFiltered, container) {
        let amount;
        let dataTemplate;

        // Количество колонок
        let column = 4;

        if (what === 'games') {
          // Получаем кол-во отфильтрованных элементов и выводим его в заголовок
          amount = dataFiltered.length;

          column = 6;

          dataTemplate = dataFiltered.map(function(dataFilteredItem) {
            return `
                    <li class="section__item section__item--col-${column}">
                      ${templates[what](dataFilteredItem)}
                    </li>
                   `;
          }).join(' ');
        } else {
          dataFiltered = dataFiltered.split('~~~');

          // Получаем кол-во полученных элементов
          amount = dataFiltered.length - 1;

          dataTemplate = dataFiltered.map(function(dataFilteredItem, index) {
            if (index === (dataFiltered.length - 1)) {
              return `
                      <li class="visually-hidden">
                        ${dataFilteredItem}
                      </li>
                     `;
            } else {
              return `
                      <li class="section__item section__item--col-${column}">
                        ${dataFilteredItem}
                      </li>
                     `;
            }
          }).join(' ');
        }

        // Если кол-во Игр/Матчей/Турниров не кратно column - заполняется пустыми карточками
        let templateEmpty = templates[what](false, true);
        let itemsCount  = amount;

        while ((itemsCount % column) !== 0) {
          dataTemplate += `
                  <li class="section__item section__item--col-${column}">
                    ${templateEmpty}
                  </li>
                 `;

          itemsCount++;
        }

        // Заменяем содержимое контейнера полученными результатами
        container.innerHTML = dataTemplate;

        // Получаем кнопки открытия попапов
        let popupOpenButtons = container.querySelectorAll('.openpopup');

        if (popupOpenButtons) {
          popupOpenButtons.forEach((popupOpenButton, i) => {
            // Активация попапа по клику на указанную кнопку
            window.popup.activatePopup(popupOpenButton);
          });
        }

        // Отрисовка полос прогресса
        window.progress('.players__progress-bar');

        // Получаем кол-во отфильтрованных элементов и выводим его в заголовок
        let amountSpan = container.querySelectorAll(`.count_filtered_${what}`);
        if (amountSpan.length > 0) {
          amount = parseInt(amountSpan[amountSpan.length - 1].textContent, 10);

          if (amount === 0) {
            container.innerHTML = __('Ничего не найдено', 'earena_2');
          }
        }

        window.platforms.showFilteredAmount(what, amount);

        console.log('Created: ', what);
      },
      getFilteredGames : function (data, platformsSelected) {
        // Ф-я с условиями фильтрации массива с играми/матчами/турнирами
        let isPlatform = function (data) {
          // Если активный таб "ВСЕ" - то показываем всё
          if (platformsSelected.includes(-1)) {
            return true;
          } else {
            let dataPlatforms = data['platforms'];

            for (let i = 0; i < dataPlatforms.length; i++) {
              // Если в массиве платформ Игры есть хотя бы одна из активных платформ - показываем Игру и прекращаем перебор списка платформ игры
              if (platformsSelected.includes(dataPlatforms[i].toString()) || platformsSelected.includes(dataPlatforms[i])) {
                return true;

                break;
              }
            }
          }
        };

        // Фильтрация (возможно уже будет сразу получен тужный массив отфильтрованный)
        let dataFiltered = data.filter(isPlatform);
        //console.log(dataFiltered);

        return dataFiltered;
      },
      // Ф-я получения активных платформ и подстановки их шаблона игр/матчей/турниров
      getSelectedPlatforms : function () {
        // what - может принимать значения : games/matches/tournaments

        // Массив с выбранными платформами
        let platformsSelected = [];

        // Получаем все активные табы
        let platformsActiveTabs = document.querySelectorAll('.tabs__button--platform.active');

        if (platformsActiveTabs.length > 0) {
          platformsActiveTabs.forEach((platformsActiveTab, i) => {
            platformsSelected.push(parseInt(platformsActiveTab.dataset.tabType, 10));
          });
          //console.log(platformsSelected);

          setTimeout(() => {
            window.platforms.setCookie('ea_current_platform', platformsSelected);
          }, 300);

          return platformsSelected;
        } else {
          return false;
        }
      },
      setCookie : function (name, value, options = {}) {
        options = {
          path: '/',
        }

        if (options.expires instanceof Date) {
          options.expires = options.expires.toUTCString();
        }

        let updatedCookie = encodeURIComponent(name) + '=' + encodeURIComponent(value);

        for (let optionKey in options) {
          updatedCookie += '; ' + optionKey;
          let optionValue = options[optionKey];
          if (optionValue !== true) {
            updatedCookie += '=' + optionValue;
          }
        }
        document.cookie = updatedCookie;
      },
      getCookiesPlatforms : function () {
        let cookieObj = document.cookie.split('; ').reduce((prev, current) => {
          const [name, ...value] = current.split('=');
          prev[name] = value.join('=');
          return prev;
        }, {});
        if (!cookieObj.ea_current_platform) {
          window.platforms.setCookie('ea_current_platform', window.platforms.getSelectedPlatforms());
          return window.platforms.getSelectedPlatforms();
        }
        let cookiesPlatforms = cookieObj.ea_current_platform.split('%2C');
        cookiesPlatforms = cookiesPlatforms.map(elem => {return parseInt(elem)});
        if (cookiesPlatforms.includes(-1)) {
          cookiesPlatforms = Array.from(Array(platformsArr.length).keys());
        }
        return cookiesPlatforms;
      },
      getDataAjax : function (what = 'matches', selectedPlatforms = [], games = '', container) {
        // Проверка наличия фильтров на странице
        let filtersSection = document.querySelector('.filters');
        if (!filtersSection) {
          let action = '';
          switch (what) {
            case 'matches':
              action = 'earena_2_get_matches_html';
              break;
            case 'tournaments':
              action = 'earena_2_get_tournaments_html';
              break;
            default:
            action = 'earena_2_get_matches_object';
          }

          let data = {
            action : action,
            platform : selectedPlatforms.includes(-1) ? Array.from(Array(platformsArr.length).keys()).join(',') : selectedPlatforms.join(','),
            game : games
          };

          $.ajax({
            url: earena_2_ajax.url,
            data: data,
            type: 'POST',
            beforeSend: (response) => {
              console.log(response.readyState, data);
            },
            success: (response) => {
              //console.log('Success :',  response);

              window.platforms.createList(what, response, container);
            },
            error: (response) => {
              console.log('Error :', response);
            }
          });
        } else {
          let filterForm = filtersSection.querySelector('form');

          window.filter.getDataAjax(filterForm, what, container, selectedPlatforms);
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

    // Шаблоны игр/матчей/турниров
    let templates = {
      games : function (game, empty = false) {
        if (game && !empty && siteURL && siteThemeFolderURL && ea_icons) {

          let name = game['name'],
              img = siteThemeFolderURL + '/assets/img/games/archive/' + ea_icons['game'][game['key']] + '.jpg',
              url = siteURL + '/games?game=' + game['key'],
              platforms = game['platforms'],
              variations = game['game_modes'];

          // Вариации
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
                          <use xlink:href="#icon-platform-${ea_icons['platform'][platform]}"></use>
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
        }

        if (!game && empty) {
          return `
                  <div class="game">
                    <span class="game__link game__link--disabled">
                    </span>
                  </div>
                  `;
        }
      },
      tournaments : function (tournament, empty = false) {
        if (!tournament && empty) {
          return `
                  <div class="tournament">
                    <div class="tournament__link tournament__link--disabled">
                    </div>
                  </div>
                  `;
        }
      },
      matches : function (match, empty = false) {
        if (!match && empty) {
          return `
                  <div class="match match--empty">
                  </div>
                  `;
        }
      },
    };

    document.addEventListener('DOMContentLoaded', function () {
      window.platforms.drawSelected('games');
      window.platforms.drawSelected('matches');
      window.platforms.drawSelected('tournaments');
    });
  } catch (e) {
    console.log(e);
  }
})(jQuery);
