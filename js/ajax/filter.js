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
  document.addEventListener('DOMContentLoaded', () => {
    try {
      const { __, _x, _n, _nx } = wp.i18n;

      let scrollTimeoutLast;
      let filterTimeoutLast;

      let loadFlag = false;

      // Ф-я для вывода результатов выбранных фильтров
      window.filter = {
        init : function (formId, what = 'tournaments') {
          // Получение формы
          let filterForm = document.querySelector(`#${formId}`);
          if (filterForm) {
            let platformsSelected = window.platforms.getSelectedPlatforms();
            if (!platformsSelected) {
              platformsSelected = window.platforms.getCookiesPlatforms();
            }

            // Получаем контейнер для Игр/Матчей/Турниров
            let container = document.querySelector(`#content-platform-${what}`);

            let allInputs = filterForm.querySelectorAll('input');
            if (allInputs.length > 0) {
              allInputs.forEach((itemInput, i) => {
                var onKeyPress = function (evt) {
                  if (evt.keyCode === 13) {
                    evt.preventDefault();

                    evt.target.blur();

                    document.removeEventListener('keydown', onKeyPress);
                  }
                }

                itemInput.addEventListener('focus', function (evt) {
                  if (evt.target.name === 'id') {
                    document.addEventListener('keydown', onKeyPress);
                  }
                });

                itemInput.addEventListener('change', function () {
                  // Обнуление отступа
                  window.platforms.setOffset(what, 0);

                  window.filter.inputChange(itemInput, filterForm, what, container, platformsSelected);
                });

                if ( currentGameId !== false && itemInput.name === 'platform' && platformsSelected.includes(parseInt(itemInput.value, 10)) && itemInput.checked === false ) {
                  itemInput.click();
                }
              });
            }

            window.filter.onScroll(filterForm, what, container, platformsSelected);

            window.filter.formReset(filterForm);
          }
        },
        inputChange : function (itemInput, filterForm, what, container) {
          if (itemInput.type === 'checkbox' && itemInput.closest('.filters__list--checkbox')) {
            window.filter.createFilterResultList(itemInput);
          }

          if (filterForm && what && container) {
            window.filter.getDataAjax(filterForm, what, container);
          }
        },
        getDataAjax : function (filterForm, what, container) {
          // Прелоадер данных
          let preloader = document.querySelector(`.preloader--${what}`);

          let platformsSelected = window.platforms.getSelectedPlatforms();
          if (!platformsSelected) {
            platformsSelected = window.platforms.getCookiesPlatforms();
          }

          let action = '';
          let perPage = 8;
          switch (what) {
            case 'matches':
              action = 'earena_2_get_filtered_matches';
              perPage = (currentGameId === false) ? ((window.platforms.getOffset(what) === 0) ? 23 : 24) : 8;
              break;
            case 'tournaments':
              action = 'earena_2_get_filtered_tournaments';
              perPage = (currentGameId === false) ? 16 : 8;
              break;
            default:
            action = '';
          }

          let data = {
            action : action,
            offset : window.platforms.getOffset(what),
            perpage : perPage
          };

          if ( currentGameId !== false ) {
            data['game'] = currentGameId;
          }

          let dataForm = new FormData(filterForm);

          for (var pair of dataForm.entries()) {
            // Если один элемент
            if (!data[pair[0]]) {
              data[pair[0]] = pair[1];
            } else if (data[pair[0]]) {
              data[pair[0]] += ',' + pair[1];
            }
          }

          // Если в фильтрах на стр есть выбор платформ, тогда платформы пишутся оттуда
          if (!data['platform']) {
            data['platform'] = platformsSelected.includes(-1) ? Array.from(Array(platformsArr.length).keys()).join(',') : platformsSelected.join(',');
          }

          if (filterTimeoutLast) {
            clearTimeout(filterTimeoutLast);
          }

          filterTimeoutLast = setTimeout(function () {
            $.ajax({
              url: earena_2_ajax.url,
              data: data,
              type: 'POST',
              beforeSend: (response) => {
                if (preloader) {
                  preloader.classList.add('active');

                  loadFlag = true;
                }

                console.log(response.readyState, data);
              },
              success: (response) => {
                //console.log('Success :',  response);

                //console.log(response);
                window.platforms.createList(what, response, container);

                window.platforms.setOffset(what, (window.platforms.getOffset(what) + perPage));

                if (preloader) {
                  preloader.classList.remove('active');

                  loadFlag = false;
                }
              },
              error: (response) => {
                console.log('Error :', response);

                loadFlag = false;
              }
            });
          }, 500);
        },
        createFilterResultList: function (itemInput) {
          let templeteResultItem = function (inputId, inputValue) {
            return  `
                      <li class="filters__item filters__item--result">
                        <div class="checkbox checkbox--left">
                          <label class="checkbox__label checkbox__label--result checkbox__label--right" for="${inputId}">
                            ${inputValue}
                          </label>
                        </div>
                      </li>
                    `;
          };

          // Список для вывода результатов
          let filterListResult = itemInput.closest('.filters__list--checkbox').nextElementSibling;

          if ( filterListResult && itemInput.checked ) {
            filterListResult.insertAdjacentHTML('beforeend', templeteResultItem(itemInput.id, itemInput.nextElementSibling.textContent));
          } else if ( filterListResult && !itemInput.checked ) {
            filterListResult.querySelector(`label[for='${itemInput.id}']`).closest('.filters__item--result').remove();
          }
        },
        formReset: function (filterForm) {
          // Отслеживание события Сброса
          filterForm.addEventListener('reset', function () {
            // Получаю все чекбоксы
            let checkboxInputs = filterForm.querySelectorAll('input[type="checkbox"]');

            // Перебираю инпуты
            checkboxInputs.forEach((checkboxInput, i) => {
              // Если есть чекнутые - инициализирую клик по ним, чем вызываю функцию createFilterResultList
              if (checkboxInput.checked) {
                checkboxInput.click();
              }
            });

            // Получаю активные пункты
            let filterSelects = filterForm.querySelectorAll('.filters__field--select.active');

            // Инициалтзирую клик по ним, чтобы получить дефолтное з-е фильтров
            filterSelects.forEach((filterSelect, i) => {
              filterSelect.click();
            });
          });
        },
        onScroll : function (filterForm, what, container) {
          let isInViewPort = document.querySelector( '#isInViewPort' );

          let elementIsInView = function (el) {
            let scroll = window.scrollY || window.pageYOffset;
            let boundsTop = el.getBoundingClientRect().top + scroll;

            let viewport = {
              top: scroll,
              bottom: scroll + document.documentElement.clientHeight,
            }

            let bounds = {
              top: boundsTop,
              bottom: boundsTop + el.clientHeight,
            }
            return (bounds.bottom >= viewport.top && bounds.bottom <= viewport.bottom)
              || (bounds.top <= viewport.bottom && bounds.top >= viewport.top);
          };

          let onScroll = () => {
            if (scrollTimeoutLast) {
              clearTimeout(scrollTimeoutLast);
            }

            scrollTimeoutLast = setTimeout(function () {
              console.log(window.platforms.getAmount(what), window.platforms.getOffset(what));
              if (elementIsInView(isInViewPort) && window.platforms.getOffset(what) > 0 && window.platforms.getAmount(what) > window.platforms.getOffset(what)) {
                if (loadFlag === false && filterForm && what && container) {
                  window.filter.getDataAjax(filterForm, what, container);
                } else {
                  console.log('Идет загрузка. Подождите');
                }
              }
            }, 20);
          };

          window.addEventListener('scroll', onScroll);
        }
      };

      // Инициализация фильтра
      window.filter.init('filters-tournaments', 'tournaments');
      window.filter.init('filters-matches', 'matches');
    } catch (e) {
      console.log(e);
    }
  });
})(jQuery);
