'use strict';

(function ($) {
  /*
    currentUserId
    is_user_logged_in,
    is_ea_admin,
    admin_ids

    dataGames,
    currentGameId,

    isProfile,
    siteURL,
    siteThemeFolderURL,
    ea_icons
    platformsArr

    isAdminTournamentsList

    - глобальные переменные, которые используются для составления URI.
      Задаются в header.php
  */

  document.addEventListener('readystatechange', function () {
    if (document.readyState === 'interactive') {
      const rewriteThreadClickEvent = function () {
        let threads = document.querySelectorAll('.thread:not(.rewrited)');
        threads.forEach((thread, i) => {
          thread.classList.add('rewrited');

          let deleteButton = thread.querySelector('.delete');

          thread.addEventListener('click', function (evt) {
            if (evt.target !== deleteButton && evt.target.tagName !== 'A') {
              evt.stopPropagation();
              evt.preventDefault();

              document.location.href = thread.dataset.href;
            }
          });

          searchAdminFromThreads(thread);
        });
      };

      const checkUser = function (userIdData, parent) {
        if (userIdData) {
          const userId = userIdData.dataset.userId;
          if (admin_ids.includes(parseInt(userId, 10))) {
            parent.classList.add('is-ea-admin');
          }
        }
      };

      const searchAdminFromThreads = function (thread) {
        const userIdData = thread.querySelector('.pic a img');

        checkUser(userIdData, thread);
      };

      const searchAdminIncoming = function () {
        const incomings = document.querySelectorAll('.messages-stack:not(.finded)');

        incomings.forEach((incoming) => {
          incoming.classList.add('finded');

          checkUser(incoming, incoming);
        });
      };

      rewriteThreadClickEvent();
      searchAdminIncoming();

      $(document).on("bp-better-messages-refresh-thread", function(e) {
        // console.log('bp-better-messages-refresh-thread');
        rewriteThreadClickEvent();
        searchAdminIncoming();
      });

      $(document).on("bp-better-messages-reinit-start", function(e) {
        // console.log('bp-better-messages-reinit-start');
        rewriteThreadClickEvent();
        searchAdminIncoming();
      });

      $(document).on("bp-better-messages-update-unread", function(e) {
        // console.log('bp-better-messages-update-unread');
        rewriteThreadClickEvent();
        searchAdminIncoming();
      });
    }
  });
})(jQuery);
