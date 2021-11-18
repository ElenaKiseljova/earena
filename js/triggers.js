'use strict';

(function ($) {
  /*
    currentUserId
    is_user_logged_in,
    is_ea_admin,

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

  try {
    // MATCHES
    $('body').on('matches-list-updated', function () {
      console.log('matches-list-updated');
      window.platforms.drawSelected('matches');
    });

    // TOURNAMENTS
    // $('body').on('tournaments-list-updated', function () {
    //   console.log('tournaments-list-updated');
    //   window.platforms.drawSelected('tournaments');
    // });

    // TOURNAMENT
    $('body').on('tournament-page-updated', function () {
      console.log('tournament-page-updated');
      window.popup.searchOpenPopupButton($('#ajax-container-tournament')[0]);
      /* Переключатели на стр Турнира (Кубка / Лаки Кубка) */
      let attrTabTournament = {
        container : $('#ajax-container-tournament')[0],
        buttonSelector : '.toggles__item--tournament',
        callback : window.toggleActive.methods.toggleTournamentContent,
        unActiveAnother : true,
      };
      window.toggleActive.multiple(attrTabTournament);
      /* Аккордеон */
      let attrAcordeon = {
        container : $('#ajax-container-tournament')[0],
        buttonSelector : '.accordeon__button',
        toggleNextElement : true,
      };
      window.toggleActive.multiple(attrAcordeon);
      // Вызов ф-и
      window.progress('.players__progress-bar', $('#ajax-container-tournament')[0]);
    });

    // MATCH
    $('body').on('match-page-updated', function () {
      console.log('match-page-updated');
    });

    // FRIENDS
    $('body').on('edit-public-user-button', function () {
      const user = window.location.pathname.replace('/user/', '').replace('/', '')
      $.ajax({
        url: earena_2_ajax.url,
        type: 'POST',
        data: {
          action: 'getUserButtons',
          user: user,
        },
        success: function (data) {
          if ($('.account__buttons--bottom').length) {
            $('.account__buttons--bottom').html(data)
            window.popup.searchOpenPopupButton($('.account__buttons--bottom')[0]);
          }
        },
      })
    });

    $('body').on('edit-public-user-list', function () {
      const user = window.location.pathname.replace('/user/', '').replace('/', '')

      $.ajax({
        url: earena_2_ajax.url,
        type: 'POST',
        data: {
          action: 'getFriendsList',
          user: user,
        },
        success: function (response) {
          console.log(response);
          if ($('.statistics__list--friends-public').length && $('.statistics__count--friends-public').length) {
            $('.statistics__list--friends-public').html(response.data.content)
            $('.statistics__count--friends-public').html(response.data.total)
          }

          if ($('.toggles__counter--friends-public').length) {
            $('.toggles__counter--friends-public').html(response.data.total)
          }

          if ($('.section__title-count--friends-public').length) {
            $('.section__title-count--friends-public').html(response.data.total)
          }
        },
      })
    });

    $('body').on('edit-private-user-list', function () {
      if (currentUserId) {
        $.ajax({
          url: earena_2_ajax.url,
          type: 'POST',
          data: {
            action: 'getFriendsList',
            user: currentUserId,
          },
          success: function (response) {
            console.log(response);
            if ($('.statistics__list--friends-private').length && $('.statistics__count--friends-private').length) {
              $('.statistics__list--friends-private').html(response.data.content)
              $('.statistics__count--friends-private').html(response.data.total)
            }
          },
        })
      }
    });

    $('body').on('private-friend-list-updated', function () {
      window.popup.searchOpenPopupButton($('#private-friend-list')[0]);
    });

    $('body').on('public-friend-list-updated', function () {
      window.popup.searchOpenPopupButton($('#public-friend-list')[0]);
    });

    // GLOBAL THROTTLINGG
    $('body').on('vip-update tournament-update match-update', function () {
      window.globalThrottlingg.getDataFunction();
    });
  } catch (e) {
    console.log(e);
  } finally {

  }
})(jQuery);
