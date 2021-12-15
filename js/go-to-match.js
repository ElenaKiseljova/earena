'use strict';

(function ($) {
  document.addEventListener('DOMContentLoaded', function () {
    let rewriteThreadClickEvent = function () {
      let threads = document.querySelectorAll('.thread:not(.rewrited)');
      threads.forEach((thread, i) => {
        thread.classList.add('rewrited');

        thread.addEventListener('click', function (evt) {
          evt.stopPropagation();
          evt.preventDefault();

          document.location.href = thread.dataset.href;
        });
      });
    };

    rewriteThreadClickEvent();

    $(document).on("bp-better-messages-refresh-thread", function(e) {
      console.log('bp-better-messages-refresh-thread');
      rewriteThreadClickEvent();
    });

    $(document).on("bp-better-messages-reinit-start", function(e) {
      console.log('bp-better-messages-reinit-start');
      rewriteThreadClickEvent();
    });

    $(document).on("bp-better-messages-update-unread", function(e) {
      console.log('bp-better-messages-update-unread');
      rewriteThreadClickEvent();
    });
  });
})(jQuery);
