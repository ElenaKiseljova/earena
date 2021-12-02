const minInterval = 10000,
    maxInterval = 300000
let baseInterval = 1000;
const getLastUpdt = () => new Date().toLocaleString("en-US", {timeZone: 'UTC'});

jQuery(document).ready(function ($) {

    const initObj = {
        0: ['.page-header .time span'],
        1: [],
        2: ['.user__money-amount--header span', '.user__money-amount--account-private span'],
        3: ['.personal__link-count--messages', '.toggles__counter--messages', '.section__title-count--message'],
        4: ['.game-matches-count'],
        5: ['.personal__link-count--friends'],
        6: ['.user__rating-value--account-private'],
        7: ['.personal__link-count--matches', '.toggles__counter--matches'],
        8: ['.personal__link-count--tournaments', '.toggles__counter--tournaments'],
        9: ['.personal__link-count--administration', '.toggles__counter--administration'],
        10: ['.toggles__counter--friends-private', '.section__title-count--friends-private'],
    }
    // 0 curTime
    // 1 balanceTopCur
    // 2 balanceTopValue
    // 3 message
    // 4 countGameMatches
    // 5 friends (request)
    // 6 rating
    // 7 matches
    // 8 tournaments
    // 9 admin
    // 10 friends (total)

    const initData = {
        0: initing(0),
        1: initing(1),
        2: initing(2),
        3: initing(3),
        4: initing(4),
        5: initing(5),
        6: initing(6),
        7: initing(7),
        8: initing(8),
        9: initing(9),
        10: initing(10),
    }

    function initing(i) {
        return $(initObj[i][0]).html()
    }

    const data = {
        action: 'globalHeader',
        time: getLastUpdt(),
        offset: new Date().getTimezoneOffset(),
    }

    // let run = setInterval(window.globalThrottlingg.getDataFunction, minInterval)
    let run ;
    window.globalThrottlingg = {
      getDataFunction : function () {
          $.post(
              earena_2_ajax.url,
              data,
               (response) => {
                  const resp = JSON.parse(response)
                  if (minInterval !== baseInterval) {
                      baseInterval = minInterval
                      clearInterval(run)
                      run = setInterval(window.globalThrottlingg.getDataFunction, baseInterval)
                  }
                  if (resp) {
                    // console.log(resp);
                      if (0 in resp) {
                          const respData = resp[0]
                          for (const [key, value] of Object.entries(respData)) {
                              if (key >= 11) {
                                  break
                              }
                              if (value !== initData[key]) {
                                  initData[key] = value
                                  for (const elem of initObj[key]) {
                                      $(elem).html(value)
                                      if (value == 0) {
                                        $(elem).addClass('zero')
                                      }
                                  }
                              }
                          }
                      }
                      if (1 in resp && 0 in resp[1] && resp[1][0] == 1) {
                          data.time = getLastUpdt()
                          if ($('#ajax-container-tournament').length) {
                              $('#ajax-container-tournament').html(resp[1][1])
                              // console.log(resp[1][15]);
                              $('body').trigger('tournament-page-updated')
                          }
                          if ($('#chat-page-form').length) {
                              $('#chat-page-form').html(resp[1][1])
                              // console.log(resp[1][15]);
                              $('body').trigger('match-page-updated')
                          }
                          // Список друзей во вкладке Друзья в Профиле
                          if ($('#private-friend-list').length) {
                              $('#private-friend-list').html(resp[1][1])
                              $('body').trigger('private-friend-list-updated')
                          }
                      }
                      if (resp[1][3]) {
                          data.time = getLastUpdt()
                          $('body').trigger('edit-public-user-list')
                          $('body').trigger('edit-public-user-button')

                          // Список друзей во вкладке Друзья в Профиле
                          if ($('#public-friend-list').length) {
                              $('#public-friend-list').html(resp[1][3])
                              $('body').trigger('public-friend-list-updated')
                          }
                      }
                      if (resp[1][4]) {
                          data.time = getLastUpdt()
                          $('body').trigger('edit-private-user-list')
                      }
                      if (resp[1][5]) {
                          $('.ea-banner-counter1').html(resp[1][5][0])
                          $('.ea-banner-counter2').html(resp[1][5][1])
                      }
                  } else { return }
              }
          ).fail(function (response) {
              if (baseInterval < maxInterval) {
                  baseInterval = baseInterval * 2
                  clearInterval(run)
                  run = setInterval(window.globalThrottlingg.getDataFunction, baseInterval)
              }
              console.log(response)
          })
      }
    };

    window.globalThrottlingg.getDataFunction()
})
