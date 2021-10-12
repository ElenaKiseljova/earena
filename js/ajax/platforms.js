'use strict';

(function ($) {
  /*
    dataGames,

    siteURL,
    siteThemeFolderURL,
    ea_icons

    - глобальные переменные, которые используются для составления URI.
      Задаются в header.php
  */
  try {
    const { __, _x, _n, _nx } = wp.i18n;

    // Экспортируется в файл toggle-active.js
    window.platforms = {
      drawSelected : function (what) {
        let platformsSelected = window.platforms.getSelectedPlatforms();

        if (!platformsSelected) {
          return;
        }

        console.log('Выбрано:', platformsSelected + '(' + what +')');

        let dataFiltered;
        if (what === 'games' && dataGames) {
          dataFiltered = window.platforms.getFilteredGames(dataGames, platformsSelected);

          window.platforms.createList(what, dataFiltered);

          return;
        } else {
          dataFiltered = window.platforms.getDataAjax(what, platformsSelected, []);
        }
      },
      createList : function (what, dataFiltered) {
        // Получаем контейнер для Игр/Матчей/Турниров
        let container = document.querySelector(`#content-platform-${what}`);
        if (container) {
          let amount;
          let dataTemplate;

          // Количество колонок
          let column = 4;

          if (what === 'games') {
            // Получаем кол-во отфильтрованных элементов и выводим его в заголовок
            amount = dataFiltered.length;

            column = 6;

            dataTemplate = dataFiltered.map(function(dataFilteredItem) {
              return `
                      <li class="section__item section__item--col-${column}">
                        ${templates[what](dataFilteredItem)}
                      </li>
                     `;
            }).join(' ');
          } else {
            dataFiltered = dataFiltered.split('~~~');

            // Получаем кол-во полученных элементов
            amount = dataFiltered.length - 1;

            dataTemplate = dataFiltered.map(function(dataFilteredItem) {
              return `
                      <li class="section__item section__item--col-${column}">
                        ${dataFilteredItem}
                      </li>
                     `;
            }).join(' ');
          }

          // Если кол-во Игр/Матчей/Турниров не кратно column - заполняется пустыми карточками
          let templateEmpty = templates[what](false, true);
          let itemsCount  = amount;

          while ((itemsCount % column) !== 0) {
            dataTemplate += `
                    <li class="section__item section__item--col-${column}">
                      ${templateEmpty}
                    </li>
                   `;

            itemsCount++;
          }

          // Заменяем содержимое контейнера полученными результатами
          container.innerHTML = dataTemplate;

          // Получаем кнопки открытия попапов
          let popupOpenButtons = container.querySelectorAll('.openpopup');

          if (popupOpenButtons) {
            popupOpenButtons.forEach((popupOpenButton, i) => {
              // Активация попапа по клику на указанную кнопку
              window.popup.activatePopup(popupOpenButton);
            });
          }

          // Отрисовка полос прогресса
          window.progress('.players__progress-bar');

          // Получаем кол-во отфильтрованных элементов и выводим его в заголовок
          let amountSpan = container.querySelector(`#count_filtered_${what}`);
          if (amountSpan) {
            amount = parseInt(amountSpan.textContent, 10);
          }

          window.platforms.showFilteredAmount(what, amount);
        }

        console.log('Created: ', what);
      },
      getFilteredGames : function (data, platformsSelected) {
        // Ф-я с условиями фильтрации массива с играми/матчами/турнирами
        let isPlatform = function (data) {
          // Если активный таб "ВСЕ" - то показываем всё
          if (platformsSelected.includes(-1)) {
            return true;
          } else {
            let dataPlatforms = data['platforms'];

            for (let i = 0; i < dataPlatforms.length; i++) {
              // Если в массиве платформ Игры есть хотя бы одна из активных платформ - показываем Игру и прекращаем перебор списка платформ игры
              if (platformsSelected.includes(dataPlatforms[i].toString()) || platformsSelected.includes(dataPlatforms[i])) {
                return true;

                break;
              }
            }
          }
        };

        // Фильтрация (возможно уже будет сразу получен тужный массив отфильтрованный)
        let dataFiltered = data.filter(isPlatform);
        //console.log(dataFiltered);

        return dataFiltered;
      },
      // Ф-я получения активных платформ и подстановки их шаблона игр/матчей/турниров
      getSelectedPlatforms : function () {
        // what - может принимать значения : games/matches/tournaments

        // Массив с выбранными платформами
        let platformsSelected = [];

        // Получаем все активные табы
        let platformsActiveTabs = document.querySelectorAll('.tabs__button--platform.active');

        if (platformsActiveTabs.length > 0) {
          platformsActiveTabs.forEach((platformsActiveTab, i) => {
            platformsSelected.push(parseInt(platformsActiveTab.dataset.tabType, 10));
          });
          //console.log(platformsSelected);

          setTimeout(() => {
            window.platforms.setCookie('ea_current_platform', platformsSelected);
          }, 300);

          return platformsSelected;
        } else {
          return false;
        }
      },
      setCookie : function (name, value, options = {}) {
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
      getCookiesPlatforms : function () {
        let cookieObj = document.cookie.split('; ').reduce((prev, current) => {
          const [name, ...value] = current.split('=');
          prev[name] = value.join('=');
          return prev;
        }, {});
        if (!cookieObj.ea_current_platform) {
          window.platforms.setCookie('ea_current_platform', window.platforms.getSelectedPlatforms());
          return window.platforms.getSelectedPlatforms();
        }
        let cookiesPlatforms = cookieObj.ea_current_platform.split('%2C');
        cookiesPlatforms = cookiesPlatforms.map(elem => {return parseInt(elem)});
        if (cookiesPlatforms.includes(-1)) {
          cookiesPlatforms = Array.from(Array(platformsArr.length).keys());
        }
        return cookiesPlatforms;
      },
      getDataAjax : function (what = 'matches', selectedPlatforms = [], games = []) {
        let action = '';
        switch (what) {
          case 'matches':
            action = 'earena_2_get_matches_html';
            break;
          case 'tournaments':
            action = 'earena_2_get_tournaments_html';
            break;
          default:
          action = 'earena_2_get_matches_object';
        }

        let data = {
          action : action,
          platform : selectedPlatforms.includes(-1) ? Array.from(Array(platformsArr.length).keys()) : selectedPlatforms,
          game : games
        };

        $.ajax({
          url: earena_2_ajax.url,
          data: data,
          type: 'POST',
          beforeSend: (response) => {
            console.log(response.readyState, data);
          },
          success: (response) => {
            console.log('Success :',  response);

            window.platforms.createList(what, response);
          },
          error: (response) => {
            console.log('Error :', response);
          }
        });
      },
      showFilteredAmount : function (what, amount) {
        // what - может принимать значения : games/matches/tournaments

        let titleAmountWhat =  document.querySelector(`.section__title--${what} .section__amount`);

        if (titleAmountWhat) {
          titleAmountWhat.textContent = amount;
        }
      }
    };

    // Шаблоны игр/матчей/турниров
    let templates = {
      games : function (game, empty = false) {
        if (game && !empty && siteURL && siteThemeFolderURL && ea_icons) {

          let name = game['name'],
              img = siteThemeFolderURL + '/assets/img/games/archive/' + ea_icons['game'][game['key']] + '.jpg',
              url = siteURL + '/games?game=' + game['key'],
              platforms = game['platforms'],
              variations = game['game_modes'];

          // Вариации
          let variationsTemplate = '';
          if (variations) {
            variationsTemplate = '<ul class="variations">' + variations.map(function(variation) {
              return `
                      <li class="variations__item">
                        ${variation} vs ${variation}
                      </li>
                     `;
            }).join(' ') + '</ul>';
          }

          // Платформы
          let platformsTemplate = '';
          if (platforms) {
            platformsTemplate = '<ul class="game__platforms">' + platforms.map(function(platform) {
              return `
                      <li class="platform platform--game">
                        <svg class="platform__icon" width="30" height="30">
                          <use xlink:href="#icon-platform-${ea_icons['platform'][platform]}"></use>
                        </svg>
                      </li>
                     `;
            }).join(' ') + '</ul>';
          }

          return `
                  <div class="game">
                    <a class="game__link" href="${url}">
                      <div class="game__image game__image--archive">
                        <img src="${img}" alt="${name}">
                      </div>

                      ${variationsTemplate}

                      <h3 class="game__name">
                        ${name}
                      </h3>

                      ${platformsTemplate}

                    </a>
                  </div>
                  `;
        }

        if (!game && empty) {
          return `
                  <div class="game">
                    <span class="game__link game__link--disabled">
                    </span>
                  </div>
                  `;
        }
      },
      tournaments : function (tournament, empty = false) {
        // if (tournament && !empty) {
        //   let name = tournament['tournament']['name'],
        //     img = tournament['tournament']['img'],
        //     url = '/tournament',//tournament['url'],
        //     game = tournament['game_name'],
        //     platforms = tournament['platforms'] ? tournament['platforms'] : '',
        //     variation = tournament['variations'],
        //     id = tournament['id'],
        //     bet = tournament['bet'],
        //     lock = tournament['lock'] ? 'variations--lock' : '',
        //     trophy = tournament['trophy'],
        //     status = tournament['status'],
        //     vip = tournament['tournament']['vip'],
        //     my = tournament['my'],
        //     date = {
        //       registration : tournament['tournament']['date_registration'],
        //       start : tournament['tournament']['date_start'],
        //       end : tournament['tournament']['date_end']
        //     },
        //     members = {
        //       total : tournament['tournament']['users_total'],
        //       current : tournament['tournament']['users_current']
        //     },
        //     winner = tournament['tournament']['winner'];
        //
        //   // Проверка: существует ли победитель
        //   let winnerTemplate = '';
        //   if (winner.name !== undefined && winner.avatar !== undefined) {
        //     winnerTemplate = `<div class="tournament__winner">
        //                             <div class="tournament__winner-image-wrapper">
        //                               <div class="tournament__winner-image">
        //                                 <img src="${winner.avatar}" alt="${winner.name}">
        //                               </div>
        //                             </div>
        //
        //                             <h5 class="tournament__winner-name">
        //                               ${winner.name}
        //                             </h5>
        //                           </div>
        //                           `;
        //   }
        //
        //   // Вариация
        //   let variationTemplate = '';
        //   if (variation) {
        //     if (variation !== 'Ultimate Team') {
        //       variation = `
        //               <li class="variations__item">
        //                 ${variation} vs ${variation}
        //               </li>
        //              `;
        //     } else {
        //       variation = `
        //               <li class="variations__item">
        //                 ${variation}
        //               </li>
        //              `;
        //     }
        //
        //     variationTemplate = '<ul class="variations ' + lock + '">' + variation + '</ul>';
        //   }
        //
        //   // Таб с Турнирами в профиле пользователя
        //   let linkToChatTournament = '';
        //   if (window.location.href.indexOf('account') > -1) {
        //     linkToChatTournament = `
        //                             <a class="tournament__gotochat" href="/profile?tournaments=chat&tournament_index=${id}">
        //                               <span class="visually-hidden">
        //                                 ${__( 'В чате турнира сообщений', 'earena_2' )}
        //                               </span>
        //                               1
        //                             </a>
        //                             `;
        //   }
        //
        //   // Дополнительные классы для Прошедших турниров и турниров личных
        //   let tournamentLinkClass = '';
        //   if (status === 'past') {
        //     tournamentLinkClass = 'tournament__link--past';
        //   }
        //
        //   if (my === true) {
        //     tournamentLinkClass = 'tournament__link--my';
        //   }
        //
        //   // Шаблон Турнира в зависимости от его статуса: будет/проходит/прошел
        //   let statusTemplate = '';
        //   if (status === 'future') {
        //     statusTemplate = `
        //       <div class="tournament__status tournament__status--future">
        //         ${__( 'Регистрация до', 'earena_2' )} <time>${date.registration}</time>
        //       </div>
        //       <div class="tournament__info">
        //         ${__( 'Начало', 'earena_2' )} <time>${date.start}</time>
        //       </div>
        //     `;
        //   } else if (status === 'present') {
        //     statusTemplate = `
        //                         <div class="tournament__status tournament__status--present">
        //                           ${__( 'Проходит', 'earena_2' )}
        //                         </div>
        //                         <div class="tournament__info">
        //                           ${__( 'Начался', 'earena_2' )} <time>${date.start}</time>
        //                         </div>
        //                       `;
        //   } else {
        //     statusTemplate = `
        //                         <div class="tournament__status tournament__status--past">
        //                           ${__( 'Завершился', 'earena_2' )} <time>${date.end}</time>
        //                         </div>
        //                         <div class="tournament__info">
        //                           ${__( 'Начался', 'earena_2' )} <time>${date.start}</time>
        //                         </div>
        //                       `;
        //   }
        //
        //   // ПРоверка: VIP
        //   let vipTemplate = '';
        //   if (vip === true) {
        //     vipTemplate = `
        //                     <span class="vip">
        //                       vip
        //                     </span>
        //                   `;
        //   }
        //
        //   // Процент зарегистрированных пользователей в настоящее время на матч от максимально допустимого кол-ва
        //   let percentMembers = Math.round(members.current / members.total * 100);
        //
        //   // Шаблон ставки в зависимости от Free или не Free
        //   let betTemplate = '';
        //   if (bet !== 'Free') {
        //     betTemplate = '$' + bet;
        //   } else {
        //     betTemplate = bet;
        //   }
        //
        //   return `
        //           <div class="tournament">
        //             ${linkToChatTournament}
        //
        //             <a class="tournament__link ${tournamentLinkClass}" href="${url}">
        //               <div class="tournament__top">
        //                 <div class="tournament__image">
        //                   <img src="${img}" alt="${name}">
        //                 </div>
        //
        //                 ${vipTemplate}
        //
        //                 <div class="tournament__top-content">
        //                   ${winnerTemplate}
        //
        //                   <div class="tournament__trophy">
        //                     $${trophy}
        //                   </div>
        //                 </div>
        //               </div>
        //
        //               <div class="tournament__center">
        //                 <h4 class="tournament__name">
        //                   ${name}
        //                 </h4>
        //
        //                 ${statusTemplate}
        //
        //                 <div class="players">
        //                   <div class="players__progress">
        //                     <span class="players__progress-bar" data-width="${percentMembers}"></span>
        //                   </div>
        //                   <div class="players__text">
        //                     ${members.current}/${members.total}
        //                   </div>
        //                 </div>
        //               </div>
        //
        //               <div class="tournament__bottom">
        //                 <div class="tournament__bottom-left">
        //                   <h3 class="tournament__game">
        //                     ${game}
        //                   </h3>
        //
        //                   ${variationTemplate}
        //                 </div>
        //
        //                 <div class="platform">
        //                   <svg class="platform__icon" width="40" height="40">
        //                     <use xlink:href="#icon-platform-${platforms[0]}"></use>
        //                   </svg>
        //                 </div>
        //
        //                 <div class="tournament__id">
        //                   ID ${id}
        //                 </div>
        //
        //                 <div class="tournament__bet">
        //                   ${betTemplate}
        //                 </div>
        //               </div>
        //             </a>
        //           </div>
        //           `;
        // }

        if (!tournament && empty) {
          return `
                  <div class="tournament">
                    <div class="tournament__link tournament__link--disabled">
                    </div>
                  </div>
                  `;
        }
      },
      matches : function (match, empty = false) {
        // if (match && !empty) {
        //   let statusMatch = {
        //     'waiting' : (match.status == 100) ? true : false,
        //     'end' : (match.status > 100) ? true : false,
        //     'present' : (match.status > 1 && match.status < 100) ? true : false
        //   };
        //
        //   let myMatch = (match.player1 == userID || match.player2 == userID) ? true : false;
        //
        //   let variation = match.game_mode,
        //       team_mode = match.team_mode,
        //       lock = (match.private == '1') ? 'variations--lock' : '',
        //       img = siteThemeFolderURL + '/assets/img/games/matches/' + ea_icons['game'][match.game] + '.png',
        //       game = dataGames[match.game]['name'],
        //       platforms = ea_icons['platform'][match.platform],
        //       id = match.ID,
        //       bet = match.bet,
        //       members = {
        //         0 : {
        //           name : 'Bessie Cooper',//test
        //           url: '/profile',//test
        //           img : match['user_avatar_1'],
        //           stream : match['stream_1'],
        //           result : match['result_user_1'],
        //         },
        //         1 : {
        //           name : 'Bessie Cooper',//test
        //           url: '/profile',//test
        //           img : match['user_avatar_2'],
        //           stream : match['stream_2'],
        //           result : match['result_user_2'],
        //         }
        //       };
        //
        //   // Вариация
        //   let variationTemplate = '';
        //   if (variation) {
        //     if (variation !== 'Ultimate Team') {
        //       variation = `
        //               <li class="variations__item">
        //                 ${variation} vs ${variation}
        //               </li>
        //              `;
        //     } else {
        //       variation = `
        //               <li class="variations__item">
        //                 ${variation}
        //               </li>
        //              `;
        //     }
        //
        //     variationTemplate = '<ul class="variations ' + lock + '">' + variation + '</ul>';
        //   }
        //
        //   // Стрим
        //   let streamTemplate = function (user_number) {
        //     if (members[user_number].stream !== undefined && members[user_number].stream !== null) {
        //       return `
        //                 <a class="user__stream" href="${members[user_number].stream}">
        //                   <svg class="user__stream-icon" width="16" height="13">
        //                     <use xlink:href="#icon-play"></use>
        //                   </svg>
        //                 </a>
        //               `;
        //     } else {
        //       return '';
        //     }
        //   };
        //
        //   // Avatar
        //   let avatarTemplate = function (user_number) {
        //     if (members[user_number].img !== null && members[user_number].img !== undefined) {
        //       return `
        //               <a class="user__avatar user__avatar--match" href="${members[user_number].url}">
        //                 <img width="80" height="80" src="${members[user_number].img}" alt="${members[user_number].name}">
        //               </a>
        //             `;
        //     } else {
        //       return `
        //               <a class="user__avatar user__avatar--match user__avatar--loader" href="${members[user_number].url}">
        //                 <img width="24" height="24" src="${templateURL}/assets/img/loader.svg" alt="${members[user_number].name}">
        //               </a>
        //             `;
        //     }
        //   };
        //
        //   // Статус
        //   let resultTemplate = `
        //                         <div class="match__vs match__vs--start">
        //                           <span>
        //                             vs
        //                           </span>
        //                         </div>
        //                        `;
        //   if (status === 'past') {
        //     resultTemplate = `
        //                       <div class="match__vs match__vs--end">
        //                         <span>
        //                           ${members[0].result} : ${members[1].result}
        //                         </span>
        //                       </div>
        //                      `;
        //   }
        //
        //   // Шаблон ставки в зависимости от Free или не Free
        //   let betTemplate = '';
        //   if (bet !== 'Free') {
        //     betTemplate = '$' + bet;
        //   } else {
        //     betTemplate = bet;
        //   }
        //
        //   // Действие
        //   let actionTemplate = function () {
        //     switch (status) {
        //       case 'future':
        //         if (my === true) {
        //           return `
        //             <button class="button button--red openpopup" data-popup="match" type="button" name="delete">
        //               <span>
        //                 ${__( 'Удалить', 'earena_2' )}
        //               </span>
        //             </button>
        //             `;
        //         } else {
        //           return `
        //             <button class="button button--blue openpopup" data-popup="match" type="button" name="accept">
        //               <span>
        //                 ${__( 'Принять', 'earena_2' )}
        //               </span>
        //             </button>
        //             `;
        //         }
        //
        //         break;
        //       case 'present':
        //         if (my === true) {
        //           return `
        //               <a class="button button--gray" href="/chat?type=match">
        //                 <span class="button__chat button__chat--left">
        //                   24
        //                 </span>
        //                 <span>
        //                   ${__( 'В чат', 'earena_2' )}
        //                 </span>
        //               </a>
        //             `;
        //         } else {
        //           return `
        //               <button class="button button--blue openpopup" disabled data-popup="match" type="button" name="accept">
        //                 <span>
        //                   ${__( 'Проходит', 'earena_2' )}
        //                 </span>
        //               </button>
        //             `;
        //         }
        //
        //         break;
        //       case 'past':
        //         return `
        //             <button class="button button--gray openpopup" disabled data-popup="match" type="button" name="accept">
        //               <span>
        //                 ${__( 'Завершен', 'earena_2' )}
        //               </span>
        //             </button>
        //           `;
        //
        //         break;
        //       default:
        //       console.log('Нет шаблона!');
        //     }
        //   };
        //
        //   return `
        //   <div class="match <?php if ($matches[$match_index]['my'] === true) echo 'match--my'; if ($matches[$match_index]['past'] === true) echo 'match--past'; ?>">
        //     <div class="match__image">
        //       <img src="${img}" alt="${game}">
        //     </div>
        //
        //     <div class="match__top">
        //       <div class="match__top-left">
        //         <h3 class="match__game">
        //           ${game}
        //         </h3>
        //         ${variationTemplate}
        //       </div>
        //
        //       <div class="platform platform--match">
        //         <svg class="platform__icon" width="40" height="40">
        //           <use xlink:href="#icon-platform-${platforms[0]}"></use>
        //         </svg>
        //       </div>
        //     </div>
        //
        //     <div class="match__center">
        //       <div class="user user--match">
        //         ${streamTemplate(0)}
        //         ${avatarTemplate(0)}
        //
        //         <a class="user__name user__name--match" href="${members[0].url}">
        //           <h5>
        //             ${members[0].name}
        //           </h5>
        //         </a>
        //       </div>
        //
        //       ${resultTemplate}
        //
        //       <div class="user user--match">
        //         ${streamTemplate(1)}
        //         ${avatarTemplate(1)}
        //
        //         <a class="user__name user__name--match" href="${members[1].url}">
        //           <h5>
        //             ${members[1].name}
        //           </h5>
        //         </a>
        //       </div>
        //     </div>
        //
        //     <div class="match__bottom">
        //       <div class="match__bet">
        //         ${betTemplate}
        //       </div>
        //
        //       <div class="match__button-wrapper">
        //         ${actionTemplate()}
        //
        //         <div class="match__id">
        //           ID ${id}
        //         </div>
        //       </div>
        //     </div>
        //   </div>
        //   `;
        // }

        if (!match && empty) {
          return `
                  <div class="match match--empty">
                  </div>
                  `;
        }
      },
    };

    document.addEventListener('DOMContentLoaded', function () {
      window.platforms.drawSelected('games');
      window.platforms.drawSelected('matches');
      window.platforms.drawSelected('tournaments');
    });
  } catch (e) {
    console.log(e);
  }
})(jQuery);
