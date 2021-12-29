'use strict';

(function () {
  window.cookieEdit = {
    set : function (name, value, options = {}) {
      options = {
        path: '/',
      }

      if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
      }

      let updatedCookie = encodeURIComponent(name) + '=' + encodeURIComponent(value);

      for (let optionKey in options) {
        updatedCookie += '; ' + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
          updatedCookie += '=' + optionValue;
        }
      }
      document.cookie = updatedCookie;
    },
    get : function (name = false) {
      let cookieObj = document.cookie.split('; ').reduce((prev, current) => {
        const [name, ...value] = current.split('=');
        prev[name] = value.join('=');
        return prev;
      }, {});

      if (name) {
        if (cookieObj[name]) {
          let cookieItem = cookieObj[name].split('%2C');

          return cookieItem;
        } else {
          return false;
        }
      }

      return cookieObj;
    }
  };
})();
