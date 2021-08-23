'use strict';

(function () {
  /*
    *
    *** Ф-я удаления активного класса у набора элементов
    * Экспортируется в popup.js, toggle-active.js
  */
  window.removeActiveClassElements = function (elements, removeParentActive = false, activeClass = 'active') {
    elements.forEach((element, i) => {
      if (element.classList.contains(activeClass)) {
        element.classList.remove(activeClass);

        if (removeParentActive) {
          element.parentNode.classList.remove(activeClass);
        }
      }
    });
  };
})();
