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

    isAdminTournamentsList

    - глобальные переменные, которые используются для составления URI.
      Задаются в header.php
  */
  document.addEventListener('DOMContentLoaded', () => {
    try {
      const { __, _x, _n, _nx } = wp.i18n;

      const deviceWidthDefault = window.innerWidth && document.documentElement.clientWidth ?
                        Math.min(window.innerWidth, document.documentElement.clientWidth) :
                        window.innerWidth ||
                        document.documentElement.clientWidth ||
                        document.getElementsByTagName('body')[0].clientWidth;

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

            // Мобильная кнопка сворачивания фильтра
            const roll = filterForm.closest('.filters').querySelector('.filters__roll');

            if (deviceWidthDefault < 768 && roll) {
              window.filter.roll(roll);
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

                  window.filter.inputChange(itemInput, filterForm, what, container);

                  // Мобильная кнопка сворачивания фильтра
                  if (deviceWidthDefault < 768 && roll) {
                    window.filter.roll(roll, true);
                  }
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
              perPage = ((window.platforms.getOffset(what) === 0) && isProfile === false) ? 23 : 24;
              break;
            case 'tournaments':
              action = 'earena_2_get_filtered_tournaments';
              perPage = (currentGameId === false) ? 16 : 8;
              break;
            default:
            action = '';
          }

          let data = {};

          if (isAdminTournamentsList === false) {
            data['action'] = action;
            data['offset'] = window.platforms.getOffset(what);
            data['perpage'] = perPage;
          }

          if ( currentGameId !== false ) {
            data['game'] = currentGameId;
          }

          if (isProfile === true) {
            data['player_id'] = [filterForm.dataset.playerId];
            data['is_profile'] = isProfile;
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
            data['platform'] = (platformsSelected.includes(-1) || isProfile === true || currentGameId !== false) ? Array.from(Array(platformsArr.length).keys()).join(',') : platformsSelected.join(',');
          }

          for (var key in data) {
            if (data[key].length === 0) {
              delete data[key];
            }
          }

          if (filterTimeoutLast) {
            clearTimeout(filterTimeoutLast);
          }

          filterTimeoutLast = setTimeout(function () {
            if (isAdminTournamentsList === false) {
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

                  const total = JSON.parse(response).total;
                  const offset = (total > 0) ? window.platforms.getOffset(what) + perPage : 0;

                  window.platforms.setOffset(what, offset);

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
            } else {
              window.filter.getFilteredAdminTournamentsList(data);
            }
          }, 500);
        },
        getFilteredAdminTournamentsList : function (data) {
          const search = data.id ?? '';

          console.log(data);

          if (search != '') {
            $('#content-platform-admin-tournaments > li').hide().filter(function () {
              const str = $(this).children().data('id') + '';
              return $(this).children().data('id') != null && str.includes(search);
            }).show();
          } else {
            $('#content-platform-admin-tournaments > li').hide().filter(function () {
              var show = true;
              for (var key in data) {
                show = show && data[key].includes($(this).children().data(key));
              }
              return show;
            }).show();
          }
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
            if (filterListResult.querySelector(`label[for='${itemInput.id}']`)) {
              filterListResult.querySelector(`label[for='${itemInput.id}']`).closest('.filters__item--result').remove();
            }
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
              console.log(window.platforms.getTotal(what), window.platforms.getOffset(what));
              if (elementIsInView(isInViewPort) && window.platforms.getOffset(what) > 0 && window.platforms.getTotal(what) > window.platforms.getOffset(what)) {
                if (loadFlag === false && filterForm && what && container) {
                  window.filter.getDataAjax(filterForm, what, container);
                } else {
                  console.log('Идет загрузка. Подождите');
                }
              }
            }, 20);
          };

          if (isInViewPort) {
            window.addEventListener('scroll', onScroll);
          } else {
            console.log('Элемент для отслеживания положения прокрутки не задан.');
          }
        },
        roll : function (roll, inputsChanged = false) {
          const filter = roll.closest('.filters');
          const filterForm = filter.querySelector('.filters__form');

          if (inputsChanged) {
            const inputsChecked = filter.querySelectorAll('.filters__element');
            const countApliedFilters = [].filter.call(inputsChecked, function (inputChanged) {
              return inputChanged.querySelectorAll('input:checked').length > 0;
            }).length;

            if (countApliedFilters > 0) {
              roll.classList.add('selected');
            } else {
              roll.classList.remove('selected');
            }

            roll.dataset.count = countApliedFilters;

            if (roll.classList.contains('active')) {
              filterForm.style = '';
            }
          } else {
            let filterFormHeight = filterForm.offsetHeight;

            const filterTop = filter.querySelector('.filters__container--top');
            const filterTopHeight = filterTop.offsetHeight;

            filterForm.style.height = filterTopHeight + 'px';

            roll.addEventListener('click', function () {
              if (roll.classList.contains('active')) {
                filterFormHeight = filterForm.offsetHeight;
                filterForm.style.height = filterFormHeight + 'px';

                filterForm.classList.remove('active');

                setTimeout(function () {
                  filterForm.style.height = filterTopHeight + 'px';

                  roll.classList.remove('active');
                }, 100);
              } else {
                filterForm.style.height = filterFormHeight + 'px';

                roll.classList.add('active');

                setTimeout(function () {
                  filterForm.classList.add('active');
                }, 500);
              }
            });
          }
        }
      };

      // Инициализация фильтра
      window.filter.init('filters-tournaments', 'tournaments');
      window.filter.init('filters-matches', 'matches');
      window.filter.init('filters-admin-tournaments', 'admin-tournaments');
    } catch (e) {
      console.log(e);
    }
  });
})(jQuery);
