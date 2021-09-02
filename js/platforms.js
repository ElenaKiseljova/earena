'use strict';

(function () {
  try {
    const { __, _x, _n, _nx } = wp.i18n

    // Шаблоны игр/матчей/турниров
    let templates = {
      games : function (game, empty = false) {
        if (game && !empty) {
          let name = game['name'],
              img = game['img'],
              url = '/game',//game['url'],
              platforms = game['platforms'],
              variations = game['variations'];

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
                          <use xlink:href="#icon-platform-${platform}"></use>
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
        if (tournament && !empty) {
          let name = tournament['tournament']['name'],
            img = tournament['tournament']['img'],
            url = '/tournament',//tournament['url'],
            game = tournament['game_name'],
            platforms = tournament['platforms'] ? tournament['platforms'] : '',
            variation = tournament['variations'],
            id = tournament['id'],
            bet = tournament['bet'],
            lock = tournament['lock'] ? 'variations--lock' : '',
            trophy = tournament['trophy'],
            status = tournament['status'],
            vip = tournament['tournament']['vip'],
            my = tournament['my'],
            date = {
              registration : tournament['tournament']['date_registration'],
              start : tournament['tournament']['date_start'],
              end : tournament['tournament']['date_end']
            },
            members = {
              total : tournament['tournament']['users_total'],
              current : tournament['tournament']['users_current']
            },
            winner = tournament['tournament']['winner'];

          // Проверка: существует ли победитель
          let winnerTemplate = '';
          if (winner.name !== undefined && winner.avatar !== undefined) {
            winnerTemplate = `<div class="tournament__winner">
                                    <div class="tournament__winner-image-wrapper">
                                      <div class="tournament__winner-image">
                                        <img src="${winner.avatar}" alt="${winner.name}">
                                      </div>
                                    </div>

                                    <h5 class="tournament__winner-name">
                                      ${winner.name}
                                    </h5>
                                  </div>
                                  `;
          }

          // Вариация
          let variationTemplate = '';
          if (variation) {
            if (variation !== 'Ultimate Team') {
              variation = `
                      <li class="variations__item">
                        ${variation} vs ${variation}
                      </li>
                     `;
            } else {
              variation = `
                      <li class="variations__item">
                        ${variation}
                      </li>
                     `;
            }

            variationTemplate = '<ul class="variations ' + lock + '">' + variation + '</ul>';
          }

          // Таб с Турнирами в профиле пользователя
          let linkToChatTournament = '';
          if (window.location.href.indexOf('account') > -1) {
            linkToChatTournament = `
                                    <a class="tournament__gotochat" href="/account?tournaments=chat&tournament_index=${id}">
                                      <span class="visually-hidden">
                                        ${__( 'В чате турнира сообщений', 'earena_2' )}
                                      </span>
                                      1
                                    </a>
                                    `;
          }

          // Дополнительные классы для Прошедших турниров и турниров личных
          let tournamentLinkClass = '';
          if (status === 'past') {
            tournamentLinkClass = 'tournament__link--past';
          }

          if (my === true) {
            tournamentLinkClass = 'tournament__link--my';
          }

          // Шаблон Турнира в зависимости от его статуса: будет/проходит/прошел
          let statusTemplate = '';
          if (status === 'future') {
            statusTemplate = `
              <div class="tournament__status tournament__status--future">
                ${__( 'Регистрация до', 'earena_2' )} <time>${date.registration}</time>
              </div>
              <div class="tournament__info">
                ${__( 'Начало', 'earena_2' )} <time>${date.start}</time>
              </div>
            `;
          } else if (status === 'present') {
            statusTemplate = `
                                <div class="tournament__status tournament__status--present">
                                  ${__( 'Проходит', 'earena_2' )}
                                </div>
                                <div class="tournament__info">
                                  ${__( 'Начался', 'earena_2' )} <time>${date.start}</time>
                                </div>
                              `;
          } else {
            statusTemplate = `
                                <div class="tournament__status tournament__status--past">
                                  ${__( 'Завершился', 'earena_2' )} <time>${date.end}</time>
                                </div>
                                <div class="tournament__info">
                                  ${__( 'Начался', 'earena_2' )} <time>${date.start}</time>
                                </div>
                              `;
          }

          // ПРоверка: VIP
          let vipTemplate = '';
          if (vip === true) {
            vipTemplate = `
                            <span class="vip">
                              vip
                            </span>
                          `;
          }

          // Процент зарегистрированных пользователей в настоящее время на матч от максимально допустимого кол-ва
          let percentMembers = Math.round(members.current / members.total * 100);

          // Шаблон ставки в зависимости от Free или не Free
          let betTemplate = '';
          if (bet !== 'Free') {
            betTemplate = '$' + bet;
          } else {
            betTemplate = bet;
          }

          return `
                  <div class="tournament">
                    ${linkToChatTournament}

                    <a class="tournament__link ${tournamentLinkClass}" href="${url}">
                      <div class="tournament__top">
                        <div class="tournament__image">
                          <img src="${img}" alt="${name}">
                        </div>

                        ${vipTemplate}

                        <div class="tournament__top-content">
                          ${winnerTemplate}

                          <div class="tournament__trophy">
                            $${trophy}
                          </div>
                        </div>
                      </div>

                      <div class="tournament__center">
                        <h4 class="tournament__name">
                          ${name}
                        </h4>

                        ${statusTemplate}

                        <div class="players">
                          <div class="players__progress">
                            <span class="players__progress-bar" data-width="${percentMembers}"></span>
                          </div>
                          <div class="players__text">
                            ${members.current}/${members.total}
                          </div>
                        </div>
                      </div>

                      <div class="tournament__bottom">
                        <div class="tournament__bottom-left">
                          <h3 class="tournament__game">
                            ${game}
                          </h3>

                          ${variationTemplate}
                        </div>

                        <div class="platform">
                          <svg class="platform__icon" width="40" height="40">
                            <use xlink:href="#icon-platform-${platforms[0]}"></use>
                          </svg>
                        </div>

                        <div class="tournament__id">
                          ID ${id}
                        </div>

                        <div class="tournament__bet">
                          ${betTemplate}
                        </div>
                      </div>
                    </a>
                  </div>
                  `;
        }

        if (!tournament && empty) {
          return `
                  <div class="tournament">
                    <div class="tournament__link tournament__link--disabled">
                    </div>
                  </div>
                  `;
        }
      },
      matches : function (name, img, url, game, platforms, variations, id, bet, lock, status, members = { user1 : { name : false, url: false, img : false, stream : false, result : false}, user1 : { name : false, url: false, img : false, stream : false, result : false} }) {

      },
    };

    // Экспортируется в файл toggle-active.js
    window.platforms = {
      // Ф-я получения активных платформ и подстановки их шаблона игр/матчей/турниров
      getSelected : function (what) {
        // what - может принимать значения : games/matches/tournaments

        // Массив с выбранными платформами
        let platformsSelected = [];

        // Получаем все активные табы
        let platformsActiveTabs = document.querySelectorAll('.tabs__button--platform.active');

        if (platformsActiveTabs && platformsActiveTabs.length > 0) {
          platformsActiveTabs.forEach((platformsActiveTab, i) => {
            platformsSelected.push(platformsActiveTab.dataset.tabType);
          });

          //console.log(platformsSelected);

          // Здесь отправляется запрос на получение игр/матчей/турниров под выбранные платформы
          // Получаем data[what] (для теста задано вручную)
          if (data[what]) {
            // Ф-я с условиями фильтрации массива с играми/матчами/турнирами
            let isPlatform = function (data) {
              // Если активный таб "ВСЕ" - то показываем всё
              if (platformsSelected.includes('all')) {
                return true;
              } else {
                let dataPlatforms = data['platforms'];

                for (let i = 0; i < dataPlatforms.length; i++) {
                  // Если в массиве платформ Игры/Матча/Турнира есть хотя бы одна из активных платформ - показываем Игру/Матч/Турнир и прекращаем перебор списка платформ игры
                  if (platformsSelected.includes(dataPlatforms[i])) {
                    return true;

                    break;
                  }
                }
              }
            };

            // Фильтрация (возможно уже будет сразу получен тужный массив отфильтрованный)
            let dataFiltered = data[what].filter(isPlatform);

            console.log(dataFiltered);

            // Получаем кол-во отфильтрованных элементов и выводим его в заголовок
            let amount = dataFiltered.length;

            window.platforms.showFilteredAmount(what, amount);

            // Получаем контейнер для Игр/Матчей/Турниров
            let container = document.querySelector(`#content-platform-${what}`);

            if (container) {
              // Количество колонок
              let column = 4;

              if (what === 'games') {
                column = 6;
              }

              let dataTemplate = dataFiltered.map(function(dataFilteredItem) {
                return `
                        <li class="section__item section__item--col-${column}">
                          ${templates[what](dataFilteredItem)}
                        </li>
                       `;
              }).join(' ');

              // Если кол-во Игр/Матчей/Турниров не кратно column - заполняется пустыми карточками
              let templateEmpty = templates[what](false, true);

              while ((amount % column) !== 0) {
                dataTemplate += `
                        <li class="section__item section__item--col-${column}">
                          ${templateEmpty}
                        </li>
                       `;

                amount++;
              }

              // Заменяем содержимое контейнера полученными результатами
              container.innerHTML = dataTemplate;

              // Отрисовка полос прогресса
              window.progress('.players__progress-bar');
            }
          }
        }
      },
      showFilteredAmount : function (what, amount) {
        // what - может принимать значения : games/matches/tournaments

        let titleAmountWhat =  document.querySelector(`.section__title--${what} .section__amount`);

        if (titleAmountWhat) {
          titleAmountWhat.textContent = amount;
        }
      }
    };

    document.addEventListener('DOMContentLoaded', function () {
      window.platforms.getSelected('games');
      window.platforms.getSelected('matches');
      window.platforms.getSelected('tournaments');
    });
  } catch (e) {
    console.log(e);
  }
})();
