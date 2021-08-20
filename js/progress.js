'use strict';

(function () {
  document.addEventListener('DOMContentLoaded', () => {
    // Отрисовка полос прогресса
    let drawProgressLine = function (elementSelector) {
      let progressBars = document.querySelectorAll(elementSelector);

      if (progressBars) {
        progressBars.forEach((progressBar, i) => {
          progressBar.style.width = progressBar.dataset.width + '%';
        });
      }
    };

    // Вызов ф-и
    drawProgressLine('.players__progress-bar');
  });
})();
