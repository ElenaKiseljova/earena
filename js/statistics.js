'use strict';

(function () {
  document.addEventListener('DOMContentLoaded', function () {
    window.statistics = {
      init : function (container, type, key) {
        if (window.curUserStat) {
          let statisticsObject = JSON.parse(window.curUserStat);
          // console.log(statisticsObject[key]);
          if (statisticsObject[key]) {
            let win, loses, draw;
            if (type === 'matches') {
              win = statisticsObject[key].m_wins;
              loses = statisticsObject[key].m_loses;

              window.statistics.draw(container, type, win, loses);
            }

            if (type === 'tournaments') {
              win = statisticsObject[key].t_wins;
              loses = statisticsObject[key].t_loses;
              draw = statisticsObject[key].t_draw;

              window.statistics.draw(container, type, win, loses, draw);
            }

            if (type === 'rounds') {
              win = statisticsObject[key].gf;
              loses = statisticsObject[key].gt;

              window.statistics.draw(container, type, win, loses);
            }
          }
        }
      },
      draw : function (container, type, win, loses, draw = false) {
        win = parseInt(win, 10);
        loses = parseInt(loses, 10);

        let total = win + loses + ((draw !== false) ? parseInt(draw, 10) : 0);

        let totalElement = container.querySelector(`#statistics-${type}-total`);
        let winElement = container.querySelector(`#statistics-${type}-win`);
        let losesElement = container.querySelector(`#statistics-${type}-loses`);
        let drawElement = container.querySelector(`#statistics-${type}-draw`);

        let winElementPB = container.querySelector(`#statistics-progress-bar-${type}-win`);
        let losesElementPB = container.querySelector(`#statistics-progress-bar-${type}-loses`);
        let drawElementPB = container.querySelector(`#statistics-progress-bar-${type}-draw`);

        if (totalElement && winElement && losesElement && winElementPB && losesElementPB) {
          totalElement.textContent = total;
          winElement.textContent = win;
          losesElement.textContent = loses;

          winElementPB.dataset.width = ((win / total) * 100) ? ((win / total) * 100) : 0;
          losesElementPB.dataset.width = ((loses / total) * 100) ? ((loses / total) * 100) : 0;

          if (drawElement && drawElementPB) {
            drawElement.textContent = draw;
            drawElementPB.dataset.width = ((draw / total) * 100) ? ((draw / total) * 100) : 0;
          }

          window.progress('.players__progress-bar', container);
        }
      }
    };
  });
})();
