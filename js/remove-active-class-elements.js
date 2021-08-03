'use strict';

(function () {
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
