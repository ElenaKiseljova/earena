'use strict';

(function ($) {
  document.addEventListener('DOMContentLoaded', () => {
    try {
      // Смещение для пагинации/скролла-подгрузки
      let offset = {
        'tournaments' : 0,
        'match' : 0
      };

      let filterTimeoutLast;
      // Ф-я для вывода результатов выбранных фильтров
      window.filter = {
        init : function (formId, what = 'tournaments') {
          // Получение формы
          let filterForm = document.querySelector(`#${formId}`);
          if (filterForm) {
            let platformsSelected = window.platforms.getSelectedPlatforms();
            if (!platformsSelected) {
              platformsSelected = Array.from(Array(platformsArr.length).keys());
            }

            // Получаем контейнер для Игр/Матчей/Турниров
            let container = document.querySelector(`#content-platform-${what}`);

            let allInputs = filterForm.querySelectorAll('input');
            if (allInputs.length > 0) {
              allInputs.forEach((itemInput, i) => {
                itemInput.addEventListener('change', function () {
                  window.filter.inputChange(itemInput, filterForm, what, container, platformsSelected);
                });
              });
            }

            window.filter.formReset(filterForm);
          }
        },
        inputChange : function (itemInput, filterForm, what, container, selectedPlatforms) {
          if (itemInput.type === 'checkbox' && itemInput.closest('.filters__list--checkbox')) {
            window.filter.createFilterResultList(itemInput);
          }

          if (filterForm, what && container && selectedPlatforms) {
            window.filter.getDataAjax(filterForm, what, container, selectedPlatforms);
          }
        },
        getDataAjax : function (filterForm, what, container, selectedPlatforms) {
          let action = '';
          switch (what) {
            case 'matches':
              action = '';
              break;
            case 'tournaments':
              action = 'earena_2_get_filtered_tournaments';
              break;
            default:
            action = '';
          }

          let data = {
            action : action,
            offset : offset[what]
          };

          let dataForm = new FormData(filterForm);
          let i = 1;
          for (var pair of dataForm.entries()) {
            // Если один элемент
            if (!data[pair[0]]) {
              data[pair[0]] = pair[1];
            } else if (data[pair[0]] && !Array.isArray(data[pair[0]])) {
              // Если массив, но это его второй элемент
              let firstElement = data[pair[0]];
              data[pair[0]] = [];
              data[pair[0]][0] = firstElement;
              data[pair[0]][i] = pair[1];
              i++;
            } else if (data[pair[0]] && Array.isArray(data[pair[0]])) {
              // Если массив, и это его элементы после 2-го
              data[pair[0]][i] = pair[1];
              i++;
            }
          }

          // Если в фильтрах на стр есть выбор платформ, тогда платформы пишутся оттуда
          if (!data['platform']) {
            data['platform'] = selectedPlatforms.includes(-1) ? Array.from(Array(platformsArr.length).keys()) : selectedPlatforms;
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

            // Инициалтзирую клик по ним, чтобы получить дефолтное с-е фильтров
            filterSelects.forEach((filterSelect, i) => {
              filterSelect.click();
            });
          });
        }
      };

      // Инициализация фильтра
      window.filter.init('filters-main');
    } catch (e) {
      console.log(e);
    }
  });
})(jQuery);
