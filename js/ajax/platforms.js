'use strict';

(function ($) {
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
  try {
    const { __, _x, _n, _nx } = wp.i18n;

    // Смещение для пагинации/скролла-подгрузки
    let offset = {
      'games' : 0,
      'tournaments' : 0,
      'matches' : 0
    };

    // Количество найденных элементов
    let amount = {
      'games' : 0,
      'tournaments' : 0,
      'matches' : 0
    };

    // Проверка наличия фильтров на странице
    let filtersSections = document.querySelectorAll('.filters');
    let filtersSection = (filtersSections.length > 0) ? true : false;

    // Экспортируется в файл toggle-active.js
    window.platforms = {
      drawSelected : function (what) {
        let platformsSelected = window.platforms.getSelectedPlatforms();

        if (!platformsSelected && currentGameId === false && !filtersSection) {
          return;
        } else if (currentGameId !== false && !filtersSection) {
          platformsSelected = Array.from(Array(platformsArr.length).keys());
        }

        //console.log('Выбрано:', platformsSelected + '(' + what +')');

        // Получаем контейнер для Игр/Матчей/Турниров
        let container = document.querySelector(`#content-platform-${what}`);

        if (what === 'games' && dataGames && container) {
          let dataFiltered = window.platforms.getFilteredGames(dataGames, platformsSelected);

          window.platforms.createList(what, dataFiltered, container);

          return;
        } else if (what !== 'games' && container) {
          window.platforms.getDataAjax(what, platformsSelected, container);
        }
      },
      createList : function (what, dataFiltered, container) {
        let dataTemplate = '';

        // Количество колонок
        let column = 4;

        if (what === 'games') {
          // Получаем кол-во отфильтрованных элементов и выводим его в заголовок
          amount[what] = dataFiltered.length;

          column = 6;

          dataTemplate = dataFiltered.map(function(dataFilteredItem) {
            return `
                    <li class="section__item section__item--col-${column}">
                      ${templates[what](dataFilteredItem)}
                    </li>
                   `;
          }).join(' ');
        } else {
          if (window.platforms.createMatchHTMLTemplate(what, dataFiltered) !== false) {
            // Добавляю кнопку создания матча в список матчей
            dataFiltered = window.platforms.createMatchHTMLTemplate(what, dataFiltered);
          }

          dataFiltered = dataFiltered.split('~~~');
          //console.log(dataFiltered.length);

          // Получаем кол-во полученных элементов
          amount[what] = dataFiltered.length - 1;

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
        let itemsCount  = amount[what];

        while ((itemsCount % column) !== 0) {
          dataTemplate += `
                  <li class="section__item section__item--col-${column}">
                    ${templateEmpty}
                  </li>
                 `;

          itemsCount++;
        }

        if (window.platforms.getOffset(what) === 0) {
          // Заменяем содержимое контейнера полученными результатами
          container.innerHTML = dataTemplate;
        } else {
          // Дополняем содержимое контейнера полученными результатами
          dataTemplate = container.innerHTML + dataTemplate;
          container.innerHTML = dataTemplate;
        }

        // Получаем кнопки открытия попапов
        let popupOpenButtons = container.querySelectorAll('.openpopup');

        if (popupOpenButtons.length > 0) {
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
          amount[what] = ( amountSpan[amountSpan.length - 1].textContent !== '') ? parseInt(amountSpan[amountSpan.length - 1].textContent, 10) : 0;

          if (amount[what] === 0 && window.platforms.createMatchHTMLTemplate(what, dataFiltered) === false) {
            container.innerHTML = '<li class="section__item section__item--empty">' + __('Ничего не найдено', 'earena_2') + '</li>';
          }
        }

        window.platforms.showFilteredAmount(what, amount[what]);

        console.log('Created: ', what);
      },
      createMatchHTMLTemplate : function (what, response) {
        if (filtersSection && currentGameId === false && what === 'matches' && isProfile === false && window.platforms.getOffset(what) === 0) {
          // ~~~ - тильды для обертки карточки создания матча в элемент списка при парсинге response в window.platforms.createList()
          let matchHTMLTemplate = function () {
            if (is_ea_admin === false && is_user_logged_in === true) {
              return `
                <div class="match match--create">
                  <div class="match__image">
                    <img src="${siteThemeFolderURL}/assets/img/games/matches/create.jpg" alt="Game create">
                  </div>

                  <button class="match__create openpopup" data-popup="match" type="button" name="create">
                    ${__( 'Создать <br> новый матч', 'earena_2' )}
                  </button>
                </div>
                ~~~
                `;
            } else if (is_ea_admin === true) {
              return `
                <div class="match match--create">
                  <div class="match__image">
                    <img src="${siteThemeFolderURL}/assets/img/games/matches/create.jpg" alt="Game create">
                  </div>

                  <button class="match__create openpopup" data-popup="match" type="button" name="create" disabled>
                    ${__( 'Администратор не может<br/>создать свой матч', 'earena_2' )}
                  </button>
                </div>
                ~~~
                `;
            } else {
              return `
                <div class="match match--create">
                  <div class="match__image">
                    <img src="${siteThemeFolderURL}/assets/img/games/matches/create.jpg" alt="Game create">
                  </div>

                  <button class="match__create openpopup" data-popup="login" type="button" name="signin">
                    ${__( 'Создать <br> новый матч', 'earena_2' )}
                  </button>
                </div>
                ~~~
                `;
            }
          }

          response = matchHTMLTemplate() + response;

          return response;
        } else {
          return false;
        }
      },
      getAmount : function (what) {
        return amount[what];
      },
      getOffset : function (what) {
        return offset[what];
      },
      setOffset : function (what, value) {
        offset[what] = value;
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
      getDataAjax : function (what = 'matches', selectedPlatforms = [], container) {
        // Прелоадер данных
        let preloader = document.querySelector(`.preloader--${what}`);

        if (!filtersSection) {
          let action = '';
          switch (what) {
            case 'matches':
              action = 'earena_2_get_filtered_matches';
              break;
            case 'tournaments':
              action = 'earena_2_get_filtered_tournaments';
              break;
            default:
            action = 'earena_2_get_filtered_matches';
          }

          let data = {
            action : action,
            platform : selectedPlatforms.includes(-1) ? Array.from(Array(platformsArr.length).keys()).join(',') : selectedPlatforms.join(',')
          };

          if (currentGameId !== false) {
            data['game'] = currentGameId;
          }

          if (isProfile === true) {
            data['is_profile'] = isProfile;
          }

          $.ajax({
            url: earena_2_ajax.url,
            data: data,
            type: 'POST',
            beforeSend: (response) => {
              if (preloader) {
                preloader.classList.add('active');
              }

              console.log(response.readyState, data);
            },
            success: (response) => {
              //console.log('Success :',  response);
              if (preloader) {
                preloader.classList.remove('active');
              }

              window.platforms.createList(what, response, container);
            },
            error: (response) => {
              console.log('Error :', response);
            }
          });
        } else {
          let filterForm = document.querySelector(`#filters-${what}`);
          // Обнуление отступа
          window.platforms.setOffset(what, 0);

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
