'use strict';

(function () {
  document.addEventListener('DOMContentLoaded', function () {
    // Ф-я обновления содержимого буфера обмена (работает только с https)
    let updateClipboard = function (newClip) {
      if (window.isSecureContext) {
        window.navigator.clipboard.writeText(newClip).then(function() {
          /* clipboard successfully set */
          // console.log('clipboard successfully set');
        }, function() {
          /* clipboard write failed */
          // console.log('clipboard write failed');
        });
      } else {
        console.log('Соединение не защищено');
      }
    };

    // Элементы с классом updateclipboard будут обнровлять содержимое буфера обмена
    let updateClipboardElements = document.querySelectorAll('.updateclipboard');

    if (updateClipboardElements) {
      updateClipboardElements.forEach((updateClipboardElement, i) => {
        updateClipboardElement.addEventListener('click', function () {
          updateClipboard(updateClipboardElement.textContent);
        });
      });
    }
  });
})();
