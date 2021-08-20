'use strict';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    try {
      // Ф-я для вывода результатов выбранных фильтров
      window.filter = {
        createFilterResultList: function () {
          let filterItems = document.querySelectorAll('.filters__list--checkbox .filters__item--checkbox');

          if (filterItems) {
            let templeteResultItem = function (inputId, gameName) {
              return  `
                        <li class="filters__item filters__item--result">
                          <div class="checkbox checkbox--left">
                            <label class="checkbox__label checkbox__label--result checkbox__label--right" for="${inputId}">
                              ${gameName}
                            </label>
                          </div>
                        </li>
                      `;
            };

            // Перебираем все пункты в фильтре
            filterItems.forEach((filterItem, i) => {
              // Чекбокс
              let filterItemCheckbox = filterItem.querySelector('input[type="checkbox"]');

              if (filterItemCheckbox) {
                filterItemCheckbox.addEventListener('change', function () {
                  // Список для вывода результатов
                  let filterListResult = filterItem.closest('.filters__list--checkbox').nextElementSibling;

                  if ( filterListResult && filterItemCheckbox.checked ) {
                    filterListResult.insertAdjacentHTML('beforeend', templeteResultItem(filterItemCheckbox.id, filterItemCheckbox.nextElementSibling.textContent));
                  } else if ( filterListResult && !filterItemCheckbox.checked ) {
                    filterListResult.querySelector(`label[for='${filterItemCheckbox.id}']`).closest('.filters__item--result').remove();
                  }
                });
              }
            });
          }
        },
        formReset: function (formId) {
          // Получение формы
          let filterForm = document.querySelector(`#${formId}`);

          if (filterForm) {
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
        }
      };

      // Инициализация ф-и для вывода результатов выбранных фильтров
      window.filter.createFilterResultList();

      // Сброс формы
      window.filter.formReset('filters-main');
    } catch (e) {
      console.log(e);
    }
  });
})();
