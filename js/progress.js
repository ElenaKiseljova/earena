'use strict';

(function () {
  try {
    // Отрисовка полос прогресса
    window.progress = function (elementSelector, container = document) {
      let progressBars = container.querySelectorAll(elementSelector);

      if (progressBars && progressBars.length > 0) {
        progressBars.forEach((progressBar, i) => {
          progressBar.style.width = progressBar.dataset.width + '%';
        });
      }
    };

    document.addEventListener('DOMContentLoaded', () => {
      // Вызов ф-и
      window.progress('.players__progress-bar');
    });
  } catch (e) {
    console.log(e);
  }
})();
