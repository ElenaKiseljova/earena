'use strict';

(function () {
  /*
    *
    *** Ф-я кастомного селекта
    * Экспортируется в form.js
  */
  window.select = function (container) {
    let selects = container.querySelectorAll('.select');

    if (selects) {
      selects.forEach((select, i) => {
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
              }
              //console.log(radioInput.checked, button.textContent);
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
