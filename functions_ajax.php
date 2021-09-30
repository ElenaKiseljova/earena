<?php
add_action('wp_ajax_getVIP', 'getVIPAction');
add_action('wp_ajax_nopriv_getVIP', 'getVIPAction');

function getVIPAction()
{
    // Первым делом проверяем параметр безопасности
    check_ajax_referer('form.js_nonce', 'security');

    if (is_user_logged_in() && isset($_POST['month'])) {
        $ea_user = wp_get_current_user();
        $arr = buy_vip($_POST['month'], $ea_user->ID);
        if ($arr['success'] == 1) {
            //$arr['data'] = get_include_contents(get_stylesheet_directory() . '/profile-header.php');
        }

        print json_encode($arr);
    }
    die();
}
//
// add_action('wp_ajax_setTranslation', 'setTranslationAction');
// add_action('wp_ajax_nopriv_setTranslation', 'setTranslationAction');
//
// function setTranslationAction()
// {
//     if (is_user_logged_in() && isset($_POST['url'])) {
//         print add_stream_link($_POST['url']);
//     }
//     die();
// }
//
// add_action('wp_ajax_setPlafroms', 'setPlafromsAction');
// add_action('wp_ajax_nopriv_setPlafroms', 'setPlafromsAction');
//
// function getCount()
// {
//     echo json_encode(ea_count_games_platforms());
//     die();
// }
//
// add_action('wp_ajax_get_count', 'getCount');
// add_action('wp_ajax_nopriv_get_count', 'getCount');
//
// function setPlafromsAction()
// {
//     if (is_user_logged_in()) {
//         $data = $_POST;
//         unset($data['action']);
//         foreach ($data as $key => $val) {
//             $data[$key] = array_filter($val, function ($value) {
//                 return !is_null($value) && $value !== '';
//             });
//         }
//         if (ea_edit_nicknames($data['nicknames']) == 'Сохранено') {
//             echo ea_page_profile_nicknames_data(get_current_user_id());
//         }
//     }
//     die();
// }
//
// add_action('wp_ajax_getFriendsList', 'getFriendsListAction');
// add_action('wp_ajax_nopriv_getFriendsList', 'getFriendsListAction');
//
// function getFriendsListAction()
// {
//     $userNickname = isset($_POST['user']) ? $_POST['user'] : false;
//     if (!$userNickname) {
//         return false;
//     }
//     $id = getUserBySlug($userNickname);
//     if ($id) {
//         echo ea_page_profile_public_friends_data($id, 6, 0);
//     }
//     die();
// }
//
// add_action('wp_ajax_getFriendsListMobile', 'getFriendsListMobileAction');
// add_action('wp_ajax_nopriv_getFriendsListMobile', 'getFriendsListMobileAction');
//
// function getFriendsListMobileAction()
// {
//     $userNickname = isset($_POST['user']) ? $_POST['user'] : false;
//     if (!$userNickname) {
//         return false;
//     }
//     $id = getUserBySlug($userNickname);
//     if ($id) {
//         echo ea_page_profile_public_friends_data($id, 0, 0);
//     }
//     die();
// }
//
// add_action('wp_ajax_getFriendsListCount', 'getFriendsListCountAction');
// add_action('wp_ajax_nopriv_getFriendsListCount', 'getFriendsListCountAction');
//
// function getFriendsListCountAction()
// {
//     $userNickname = isset($_POST['user']) ? $_POST['user'] : false;
//     if (!$userNickname) {
//         return false;
//     }
//     echo bp_get_total_friend_count(getUserBySlug($userNickname));
//     die();
// }
//
// add_action('wp_ajax_getUserButtons', 'getUserButtonsAction');
// add_action('wp_ajax_nopriv_getUserButtons', 'getUserButtonsAction');
//
// function getUserButtonsAction()
// {
//     $userNickname = isset($_POST['user']) ? $_POST['user'] : false;
//     if (!$userNickname) {
//         return false;
//     }
//     echo ea_page_profile_public_friends_buttons(getUserBySlug($userNickname));
//     die();
// }
//

add_action('wp_ajax_globalHeader', 'globalHeader');
add_action('wp_ajax_nopriv_globalHeader', 'globalHeader');

function globalHeader()
{

    if (isset($_POST['offset']) && (!isset($_COOKIE['ea_user_time_offset']) || $_COOKIE['ea_user_time_offset'] !== $_POST['offset'])) {
        setcookie('ea_user_time_offset', $_POST['offset'], time() + 60 * 60 * 24, "/");
    }
    /*
        if( isset($_POST['offset']) ){
            $_SESSION['user_time_offset'] = $_POST['offset'];
        }
    */
    $data = [];
    $data[0] = ea_header_time();
    $dataTournament = [];
    $dataTournament[0] = 0;
    $dataTournament[3] = 0;
    $dataTournament[4] = 0;

    if (is_user_logged_in()) {
        $id = get_current_user_id();
        $counterMatches = counter_matches();
        $counterTournaments = counter_tournaments();
        $counteArdmin = counter_admin();

        $red = $counterMatches + $counterTournaments + $counteArdmin;
        // 0 curTime
        // 1 balanceTopCur
        // 2 balanceTopValue
        // 3 numGreen
        // 4 numRed
        // 5 numBlue
        // 6 rating
        // 7 matches
        // 8 tournaments
        // 9 admin
        // 10 friends

        $data[1] = earena_2_nice_money(money_in_games());
        $data[2] = earena_2_nice_money(balance());
        $data[3] = messages_get_unread_count();
        $data[4] = $red;
        $data[5] = count(friends_get_friendship_request_user_ids($id));
        $data[6] = rating();
        $data[7] = $counterMatches;
        $data[8] = $counterTournaments;
        $data[9] = $counteArdmin;
        $data[10] = bp_get_total_friend_count($id);
    } else {
        echo json_encode([
            0 => $data,
            1 => $dataTournament,
        ]);
        die();
    }

    /*
    try {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {

            $parts = parse_url($_SERVER['HTTP_REFERER']);

            if (isset($parts['query'])) {

                parse_str($parts['query'], $query);

                if (isset($query['tournament']) && $query['tournament'] > 0 && isset($_POST['time'])) {
                    $tournament_id = $query['tournament'];
                    $time = $_POST['time'];
                    if (strtotime(EArena_DB:: get_ea_tournament_field($tournament_id,
                            'status_time')) > strtotime($time)) {
                        $ea_user = wp_get_current_user();
                        $dataTournament[0] = 1;
                        ob_start();
                        ea_tournament_page_data($ea_user, $tournament_id);
                        $dataTournament[1] = ob_get_clean();
                    }
                }

                if (isset($query['lc']) && $query['lc'] > 0 && isset($_POST['time'])) {
                    $lc_id = $query['lc'];
                    $time = $_POST['time'];
                    if (strtotime(EArena_DB:: get_ea_tournament_field($lc_id, 'status_time')) > strtotime($time)) {
                        $ea_user = wp_get_current_user();
                        $dataTournament[0] = 1;
                        ob_start();
                        ea_lc_page_data($ea_user, $lc_id);
                        $dataTournament[1] = ob_get_clean();
                    }
                }

                if (isset($query['match']) && $query['match'] > 0 && isset($_POST['time']) && $parts['path'] == '/tournaments/tournament/match/') {
                    $match_id = $query['match'];
                    $time = $_POST['time'];
                    if (strtotime(EArena_DB:: get_ea_tournament_match_field($match_id,
                            'status_time')) > strtotime($time)) {
                        $ea_user = wp_get_current_user();
                        $dataTournament[0] = 1;
                        ob_start();
                        ea_tournament_match_page_data($ea_user, $match_id);
                        $dataTournament[1] = ob_get_clean();
                    }
                }

                if (isset($query['match']) && $query['match'] > 0 && isset($_POST['time']) && $parts['path'] == '/matches/match/') {
                    $match_id = $query['match'];
                    $time = $_POST['time'];
                    if (strtotime(EArena_DB:: get_ea_match_field($match_id, 'status_time')) > strtotime($time)) {
                        $ea_user = wp_get_current_user();
                        $dataTournament[0] = 1;
                        ob_start();
                        ea_match_page_data($ea_user, $match_id);
                        $dataTournament[1] = ob_get_clean();
                    }
                } elseif (isset($query['cup']) && $query['cup'] > 0 && isset($_POST['time'])) {
                    $tournament_id = $query['cup'];
                    $time = $_POST['time'];
                    if (strtotime(EArena_DB:: get_ea_tournament_field($tournament_id,
                            'status_time')) > strtotime($time)) {
                        $ea_user = wp_get_current_user();
                        $dataTournament[0] = 1;
                        ob_start();
                        ea_cup_page_data($ea_user, $tournament_id);
                        $dataTournament[1] = ob_get_clean();
                    }
                }
            }
            if (isset($_POST['time']) && $parts['path'] == '/profile/friends/') {
                $time = $_POST['time'];
                $user_id = get_current_user_id();
                if (intval(get_user_meta($user_id, 'friend_update', true)) > strtotime($time)) {
                    $dataTournament[0] = 1;
                    ob_start();
                    ea_page_profile_friends_data($user_id);
                    $dataTournament[1] = ob_get_clean();
                }
            }
            if (isset($_POST['time']) && strpos($parts['path'], 'user') !== false) {
                $slug = str_replace('/', '', str_replace('/user/', '', $parts['path']));

                $time = $_POST['time'];
                $user_id = getUserBySlug($slug);
                if (intval(get_user_meta($user_id, 'friend_update', true)) > strtotime($time)) {
                    $dataTournament[3] = true;
                    $dataTournament[4] = true;
                }
            } elseif (substr_replace($_SERVER['HTTP_REFERER'], "", -1) === get_site_url()) {
                $dataTournament[5][] = counter1_value();
                $dataTournament[5][] = counter2_value();
            }
        }
    } catch (Exception $e) {
        $dataTournament[0] = 0;
        $dataTournament[1] = $e;
    }*/

    echo json_encode([
        0 => $data,
        1 => $dataTournament,
    ]);
    die();
}
//
//
// function getUserBySlug($slug)
// {
//     $user = '';
//     $user = get_user_by('slug', $slug);
//     return $user ? $user->ID : null;
// }

/* ==============================================
********  //Матчи (фильтр по платформе и игре)
=============================================== */

add_action('wp_ajax_earena_2_get_matches_html', 'earena_2_get_matches_html');
add_action('wp_ajax_nopriv_earena_2_get_matches_html', 'earena_2_get_matches_html');

function earena_2_get_matches_html ($limit = 8) {
  $data = [];

  if (isset($_POST['game_key'])) {
    $data['game'] = $_POST['game_key'] ?? [];
  }

  $data['platform'] = $_POST['platform'] ?? [];

  $matches = EArena_DB::get_ea_matches_by_filters($data, $limit === '' ? 8 : $limit, 0);

  if ( is_wp_error($matches) ) {
    $response = [
      'success' => 0,
      'error' => $matches->get_error_message()
    ];

    wp_send_json( json_encode($response) );

    die();
  } else {
    $game_match_html = '';

    foreach ($matches as $match) {
      $game_match_html .= earena_2_show_match($match);
    }

    echo $game_match_html;

    die();
  }
}

function earena_2_show_match ($match, $profile = false) {
  $ea_user = is_user_logged_in() ? wp_get_current_user() : null;
  if (isset($ea_user)) {
    $ea_user_id = $ea_user->ID;
  }

  global $icons, $ea_icons;
  $games = get_site_option('games');
  if (is_page(518) || earena_2_current_page( 'profile' )) {
      $profile = true;
  }

  // Status
  $match_waiting = ($match->status == 1 ) ? true : false;
  $match_end = ($match->status > 100) ? true : false;
  $match_present = ($match->status > 1 && $match->status < 100) ? true : false;

  $match_my = ($match->player1 == $ea_user_id || $match->player2 == $ea_user_id) ? true : false;
  ?>
  <div class="match <?php if ($match_my == true) echo 'match--my'; if ($match_end == true) echo 'match--past'; ?>" data-status="<?= $match->status; ?>">
    <div class="match__image">
      <img src="<?= get_template_directory_uri() . '/assets/img/games/matches/' . $ea_icons['game'][$match->game] . '.png'; ?>" alt="<?= $games[$match->game]['name']; ?>">
    </div>

    <div class="match__top">
      <div class="match__top-left">
        <h3 class="match__game">
          <?= $games[$match->game]['name']; ?>
        </h3>
        <ul class="variations <?php if ($match->private == '1') echo 'variations--lock'; ?>">
          <li class="variations__item">
            <?php if ($match->team_mode > 0): ?>
              <?= team_mode_to_string($match->team_mode); ?>
            <?php else : ?>
              <?= $match->game_mode; ?> vs <?= $match->game_mode; ?>
            <?php endif; ?>
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-<?= $ea_icons['platform'][$match->platform]; ?>"></use>
        </svg>
      </div>
    </div>

    <div class="match__center">
      <div class="user user--match">
        <?php if ( $match->stream1 !== '' ): ?>
          <a class="user__stream" href="<?= $match->stream1; ?>">
            <svg class="user__stream-icon" width="16" height="13">
              <use xlink:href="#icon-play"></use>
            </svg>
          </a>
        <?php endif; ?>
        <a class="user__avatar user__avatar--match" href="<?= ea_user_link($match->player1); ?>">
          <?= bp_core_fetch_avatar(['item_id' => $match->player1, 'type' => 'full', 'width' => 80, 'height' => 80]); ?>
        </a>
        <a class="user__name user__name--match" href="<?= ea_user_link($match->player1); ?>">
          <h5>
            <?= ea_game_nick($match->game, $match->platform, $match->player1); ?>
          </h5>
        </a>
      </div>
      <?php if (!$match_end): ?>
        <div class="match__vs match__vs--start">
          <span>
            vs
          </span>
        </div>
      <?php else : ?>
        <div class="match__vs match__vs--end">
          <span>
            <?= isset($match->score1) ? $match->score1 : '0'; ?> : <?= isset($match->score2) ? $match->score2 : '0'; ?>
          </span>
        </div>
      <?php endif; ?>

      <div class="user user--match">
        <?php if (!$match_waiting): ?>
          <?php if ( $match->stream2 !== '' ): ?>
            <a class="user__stream" href="<?= $match->stream2; ?>">
              <svg class="user__stream-icon" width="16" height="13">
                <use xlink:href="#icon-play"></use>
              </svg>
            </a>
          <?php endif; ?>
          <a class="user__avatar user__avatar--match" href="<?= ea_user_link($match->player2); ?>">
            <?= bp_core_fetch_avatar(['item_id' => $match->player2, 'type' => 'full', 'width' => 80, 'height' => 80]); ?>
          </a>
          <a class="user__name user__name--match" href="<?= ea_user_link($match->player2); ?>">
            <h5>
              <?= ea_game_nick($match->game, $match->platform, $match->player2); ?>
            </h5>
          </a>
        <?php else: ?>
          <div class="user__avatar user__avatar--match user__avatar--loader">
            <img width="24" height="24" src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.svg" alt="User">
          </div>
          <div class="user__name user__name--match">
            <h5>
              NULL
            </h5>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="match__bottom">
      <div class="match__bet">
        <?php
          if (!empty($match->bet)) {
            echo '$';
            if (function_exists( 'earena_2_nice_money' )) {
              echo earena_2_nice_money($match->bet);
            }
          } else {
            echo 'Free';
          }
        ?>
      </div>

      <div class="match__button-wrapper">
        <?php if ($match_waiting && ((int)$ea_user_id !== (int)$match->player1 || !is_ea_admin())): ?>
          <?php
            if (!is_user_logged_in()) {
                $join_target = 'login';
            } elseif (is_user_logged_in() && !in_array($match->game, ea_my_games())) {
                $join_target = 'noGameMatch';
            } elseif (is_user_logged_in() && !in_array($match->platform, ea_my_platforms($match->game))) {
                $join_target = 'noPlatformMatch';
            } elseif (is_user_logged_in() && (int)$match->bet > 0 && isset($ea_user) && !ea_check_user_age($ea_user->ID)) {
                $join_target = 'no18Match';
            } else {
                $join_target = 'goMatch';
            }
          ?>
          <button class="button button--blue openpopup"
                  data-popup="match"
                  data-target="#<?= $join_target; ?>"
                  data-id="<?= $match->ID; ?>"
                  data-price="<?= $match->bet; ?>"
                  data-private="<?= $match->private; ?>"
                  data-game="<?= $games[$match->game]['shortname']; ?>"
                  data-mode="<?= game_mode_to_string($match->game_mode); ?>"
                  data-command="<?= $match->team_mode > 0 ? team_mode_to_string($match->team_mode) : ''; ?>"
                  data-image-game="<?php bloginfo('template_url'); ?>/images/icons/<?= $ea_icons['game'][(int)$match->game]; ?>.svg"
                  data-image-platform="<?php bloginfo('template_url'); ?>/images/icons/<?= $ea_icons['platform'][(int)$match->platform]; ?>.svg"
                  type="button" name="accept">
            <span>
              <?php _e( 'Принять', 'earena_2' ); ?>
            </span>
          </button>
        <?php elseif ($match_waiting && ((int)$ea_user_id == (int)$match->player1 || is_ea_admin())): ?>
          <button class="button button--red openpopup"
                  data-popup="match"
                  data-id="<?= $match->ID; ?>"
                  type="button" name="delete">
            <span>
              <?php _e( 'Удалить', 'earena_2' ); ?>
            </span>
          </button>
        <?php elseif ($match_present && $match_my == false): ?>
          <?php if (is_ea_admin()): ?>
            <a class="button button--blue" href="/matches/match/?match=<?= $match->ID; ?>">
              <span>
                <?php _e( 'Проходит', 'earena_2' ); ?>
              </span>
            </a>
          <?php else: ?>
            <button class="button button--blue openpopup" disabled data-popup="match" type="button" name="accept">
              <span>
                <?php _e( 'Проходит', 'earena_2' ); ?>
              </span>
            </button>
          <?php endif; ?>
        <?php elseif ($match_present && $match_my == true): ?>
          <a class="button button--gray" href="/matches/match/?match=<?= $match->ID; ?>">
            <span class="button__chat button__chat--left">
              <?= ea_count_unread($match->thread_id) > 0 ? ea_count_unread($match->thread_id) : ''; ?>
            </span>
            <span>
              <?php _e( 'В чат', 'earena_2' ); ?>
            </span>
          </a>
        <?php elseif ($match_end): ?>
          <button class="button button--gray openpopup" disabled data-popup="match" type="button" name="accept">
            <span>
              <?php _e( 'Завершен', 'earena_2' ); ?>
            </span>
          </button>
        <?php elseif ($match_waiting): ?>
          <button class="button button--gray" disabled type="button" name="waiting">
            <span>
              <?php _e( 'Ожидает соперника', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>

        <div class="match__id">
          ID <?= $match->ID; ?>
        </div>
      </div>
    </div>
  </div>
  ~~~
  <?php
}

/* ==============================================
********  //Турниры (фильтр по платформе и игре)
=============================================== */

add_action('wp_ajax_earena_2_get_tournaments_html', 'earena_2_get_tournaments_html');
add_action('wp_ajax_nopriv_earena_2_get_tournaments_html', 'earena_2_get_tournaments_html');

function earena_2_get_tournaments_html ($limit = 8) {
  $data = [];

  if (isset($_POST['game_key'])) {
    $data['game'] = $_POST['game_key'] ?? [];
  }

  $data['platform'] = $_POST['platform'] ?? [];

  $tournaments = EArena_DB::get_ea_tournaments_by_filters($data, $limit === '' ? 8 : $limit);

  if ( is_wp_error($tournaments) ) {
    $response = [
      'success' => 0,
      'error' => $tournaments->get_error_message()
    ];

    wp_send_json( json_encode($response) );

    die();
  } else {
    $game_tournaments_html = '';

    foreach ($tournaments as $tournament) {
      $game_tournaments_html .= earena_2_show_tournament($tournament);
    }

    echo $game_tournaments_html;

    die();
  }
}

function earena_2_show_tournament ($tournament, $profile = false) {
  global $icons, $ea_icons;
  $games = get_site_option('games');
  if (is_page(521)) {
      $profile = true;
  }
  ?>
  <div class="<?php if (is_page(521) || $profile == true) {
      echo 'col-lg-6 col-md-6 col-sm-6';
  } else {
      echo 'col-lg-4 col-md-4 col-sm-6';
  } ?>">
      <!--							<div class="<?php if ($profile == true) {
          echo 'col-lg-6 col-md-6 col-sm-6';
      } else {
          echo 'col-lg-4 col-md-4 col-sm-6';
      } ?>">-->
      <!--							<div class="<?php echo 'col-lg-6 col-md-6 col-sm-6'; ?>">-->
      <div class="item <?= in_array(get_current_user_id(),
          json_decode($tournament->players, true) ?: []) ? 'my-item' : ''; ?>">
          <div class="top-info">
              <div class="left">
                  <img src="<?php bloginfo('template_url'); ?>/images/icons/<?= $ea_icons['platform'][(int)$tournament->platform]; ?>.svg"
                       class="svg platform-icon" alt="">
                  <img src="<?php bloginfo('template_url'); ?>/images/icons/<?= $ea_icons['game'][(int)$tournament->game]; ?>.svg"
                       class="svg game-icon" alt="">
                  <div class="txt">
                      <span><?= $games[$tournament->game]['shortname']; ?></span>
                      <div class="id">ID <?= $tournament->ID; ?></div>
                  </div>
              </div>

              <?php if ($tournament->vip): ?>
                  <div class="vip">VIP</div>
              <?php endif; ?>

              <div class="right">
                  <div class="price"><?= !empty($tournament->price) ? '$'.$tournament->price : 'free'; ?></div>
                  <?php if ($tournament->private): ?>
                      <div class="lock right"><img src="<?php bloginfo('template_url'); ?>/images/icons/icon-lock.svg"
                                                   alt=""></div>
                  <?php endif; ?>
              </div>
          </div>

          <?php if ((int)$tournament->type == 1): ?>
              <a href="<?= (stripos($_SERVER['REQUEST_URI'],
                      '/profile/tours/') !== false) ? '/profile/tours/tour/?tournament=' . $tournament->ID : '/tournaments/tournament/?tournament=' . $tournament->ID; ?>"
                 class="text-tour<?= $tournament->status > 101 ? ' tour-end' : ''; ?>"
                 style="background: linear-gradient(180deg, rgba(57, 57, 57, 0) 0%, #000000 100%), url(<?= wp_get_attachment_url($tournament->cover1); ?>) center no-repeat;">
                  <?php if ((int)$tournament->status !== 103) { ?>
                      <div class="start-time"><?php _e('Начало', 'earena'); ?> <?= date('d.m.Y',
                              utc_to_usertime(strtotime($tournament->start_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                              utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)
                      </div>
                      <?php if ((int)$tournament->status > 101): ?>
                          <div class="start-time"><?php _e('Завершен', 'earena'); ?> <?= date('d.m.Y',
                                  utc_to_usertime(strtotime($tournament->end_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                                  utc_to_usertime(strtotime($tournament->end_time))); ?> (UTC<?= utc_value(); ?>)
                          </div>
                      <?php endif; ?>
                  <?php } ?>

                  <div class="texts">
                      <div class="infos">
                          <?php if ($tournament->status < 2): ?>
                              <div class="btn-end button inproc"><?php _e('Ожидает публикации', 'earena'); ?></div>
                          <?php elseif ($tournament->status >= 2 && $tournament->status < 4): ?>
                              <div class="btn-reg button button-purple"><?php _e('Регистрация', 'earena'); ?></div>
                          <?php elseif ($tournament->status >= 4 && $tournament->status <= 101): ?>
                              <div class="btn-now button inproc"><?php _e('Проходит', 'earena'); ?></div>
                          <?php elseif ($tournament->status > 101 && $tournament->status < 103): ?>
                              <div class="btn-end button inproc"><?php _e('Завершен', 'earena'); ?></div>
                          <?php elseif ($tournament->status == 103): ?>
                              <div class="btn-cancel button button-red"><?php _e('Отменен', 'earena'); ?></div>
                          <?php endif; ?>
                          <div class="party button button-white"><img class="svg"
                                                                      src="<?php bloginfo('template_url'); ?>/images/icons/icon-users.svg"
                                                                      alt=""> <?= count(json_decode($tournament->players,
                                  true) ?: []); ?>/<?= $tournament->max_players; ?></div>
                          <div class="prize"><img class="svg"
                                                  src="<?php bloginfo('template_url'); ?>/images/icons/icon-prize.svg"
                                                  alt=""> $<?= max($tournament->prize, $tournament->garant); ?></div>
                      </div>
                      <div class="name"><?= $tournament->name; ?></div>
                  </div>
              </a>

          <?php elseif ((int)$tournament->type == 2): ?>
              <a href="<?= (stripos($_SERVER['REQUEST_URI'],
                      '/profile/tours/') !== false) ? '/profile/tours/tour/?tournament=' . $tournament->ID : '/tournaments/lucky-cup/?lc=' . $tournament->ID; ?>"
                 class="text-tour<?= $tournament->status > 101 ? ' tour-end' : ''; ?>"
                 style="background: linear-gradient(180deg, rgba(57, 57, 57, 0) 0%, #000000 100%), url(<?= wp_get_attachment_url($tournament->cover1); ?>) center no-repeat;">
                  <span class="title">LUCKY CUP</span>
                  <div class="prize"><img class="svg"
                                          src="<?php bloginfo('template_url'); ?>/images/icons/icon-prize.svg" alt=""><?php _e('до', 'earena'); ?>
                      $<?= $tournament->garant; ?></div>

                  <div class="texts">
                      <div class="infos">
                          <?php if ($tournament->status < 4): ?>
                              <div class="btn-reg button button-purple"><?php _e('Регистрация', 'earena'); ?></div>
                          <?php elseif ($tournament->status >= 4 && $tournament->status <= 101): ?>
                              <div class="btn-reg button inproc"><?php _e('Проходит', 'earena'); ?></div>
                          <?php elseif ($tournament->status > 101): ?>
                              <div class="btn-reg button inproc"><?php _e('Завершен', 'earena'); ?></div>
                          <?php endif; ?>
                          <div class="party button button-white"><img class="svg"
                                                                      src="<?php bloginfo('template_url'); ?>/images/icons/icon-users.svg"
                                                                      alt=""> <?= count(json_decode($tournament->players,
                                  true) ?: []); ?>/<?= $tournament->max_players; ?></div>
                      </div>
                      <div class="name"><?= $tournament->name; ?></div>
                  </div>
              </a>

          <?php elseif ((int)$tournament->type == 3): ?>
              <a href="<?= (stripos($_SERVER['REQUEST_URI'],
                      '/profile/tours/') !== false) ? '/profile/tours/tour/?tournament=' . $tournament->ID : '/tournaments/cup/?cup=' . $tournament->ID; ?>"
                 class="text-tour<?= $tournament->status > 101 ? ' tour-end' : ''; ?>"
                 style="background: linear-gradient(180deg, rgba(57, 57, 57, 0) 0%, #000000 100%), url(<?= wp_get_attachment_url($tournament->cover1); ?>) center no-repeat;">
                  <?php if ((int)$tournament->status !== 103) { ?>
                      <div class="start-time"><?php _e('Начало', 'earena'); ?> <?= date('d.m.Y',
                              utc_to_usertime(strtotime($tournament->start_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                              utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)
                      </div>
                      <?php if ((int)$tournament->status > 101): ?>
                          <div class="start-time"><?php _e('Завершен', 'earena'); ?> <?= date('d.m.Y',
                                  utc_to_usertime(strtotime($tournament->end_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                                  utc_to_usertime(strtotime($tournament->end_time))); ?> (UTC<?= utc_value(); ?>)
                          </div>
                      <?php endif; ?>
                  <?php } ?>

                  <div class="texts">
                      <div class="infos">
                          <?php if ($tournament->status < 2): ?>
                              <div class="btn-end button inproc"><?php _e('Ожидает публикации', 'earena'); ?></div>
                          <?php elseif ($tournament->status >= 2 && $tournament->status < 4): ?>
                              <div class="btn-reg button button-purple"><?php _e('Регистрация', 'earena'); ?></div>
                          <?php elseif ($tournament->status >= 4 && $tournament->status <= 101): ?>
                              <div class="btn-now button inproc"><?php _e('Проходит', 'earena'); ?></div>
                          <?php elseif ($tournament->status > 101 && $tournament->status < 103): ?>
                              <div class="btn-end button inproc"><?php _e('Завершен', 'earena'); ?></div>
                          <?php elseif ($tournament->status == 103): ?>
                              <div class="btn-cancel button button-red"><?php _e('Отменен', 'earena'); ?></div>
                          <?php endif; ?>
                          <div class="party button button-white"><img class="svg"
                                                                      src="<?php bloginfo('template_url'); ?>/images/icons/icon-users.svg"
                                                                      alt=""> <?= count(json_decode($tournament->players,
                                  true) ?: []); ?><?= !empty($tournament->max_players) ? '/' . $tournament->max_players : ''; ?>
                          </div>
                          <div class="prize"><img class="svg"
                                                  src="<?php bloginfo('template_url'); ?>/images/icons/icon-prize.svg"
                                                  alt=""> $<?= max($tournament->prize, $tournament->garant); ?></div>
                      </div>
                      <div class="name"><?= $tournament->name; ?></div>
                  </div>
              </a>

          <?php endif; ?>
          <?php if ($tournament->status > 101 && !empty($tournament->winner)): ?>
              <a href="<?= ea_user_link(json_decode($tournament->winner)[0]); ?>" class="winner">
                  <?= bp_core_fetch_avatar('item_id=' . json_decode($tournament->winner)[0]); ?>
                  <span>WINNER</span>
              </a>
          <?php endif; ?>

          <div class="bottom-info">
              <div><span><?php _e('Режим игры', 'earena'); ?></span>
                  <span><?= game_mode_to_string($tournament->game_mode); ?></span></div>
              <div><span><?php if ($tournament->team_mode > 0) : ?><?php _e('Команда', 'earena'); ?></span>
                  <span><?= team_mode_to_string($tournament->team_mode); ?><?php else: ?>&nbsp;<?php endif; ?></span>
              </div>
          </div>
      </div>
  </div>
  ~~~
  <?php
}

//
// add_action('wp_ajax_get_mathces_html', 'get_mathces_html');
// add_action('wp_ajax_nopriv_get_mathces_html', 'get_mathces_html');
//
// function get_mathces_html($limit = 7)
// {
//     $data = [];
//     if (isset($_POST['game_key'])) {
//         $data['game'] = $_POST['game_key'] ?? [];
//     }
//     $data['platform'] = $_POST['platform'] ?? [];
//
//     $matches = EArena_DB::get_ea_matches_by_filters($data, $limit === '' ? 7 : $limit, 0);
//     $game_matches_str = '';
//     foreach ($matches as $match) {
//         $game_matches_str .= show_match($match);
//     }
//     echo $game_matches_str;
//     die();
// }
//
// add_action('wp_ajax_get_mathces_html_home', 'get_mathces_html_home');
// add_action('wp_ajax_nopriv_get_mathces_html_home', 'get_mathces_html_home');
// function get_mathces_html_home()
// {
//     get_mathces_html(8);
// }
//
// add_action('wp_ajax_get_tournament_html', 'get_tournament_html');
// add_action('wp_ajax_nopriv_get_tournament_html', 'get_tournament_html');
//
// function get_tournament_html()
// {
//     $data = [];
//     if (isset($_POST['game_key'])) {
//         $data['game'] = $_POST['game_key'] ?? [];
//     }
//     $data['platform'] = $_POST['platform'] ?? [];
//
//     $tournaments = EArena_DB::get_ea_tournaments_by_filters($data, 6);
//     $game_matches_str = '';
//     foreach ($tournaments as $tournament) {
//         $game_matches_str .= show_tournament($tournament);
//     }
//     echo $game_matches_str;
//     die();
// }
//
add_action('wp_ajax_get_match', 'get_match');
add_action('wp_ajax_nopriv_get_match', 'get_match');

function get_match()
{
    $id = isset($_POST['id']) && $_POST['id'] && $_POST['id'] !== null && $_POST['id'] !== "null" ? $_POST['id'] : false;
    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
    $perPage = $offset === 0 ? 11 : 12;
    if ($id) {
        $game = null;
        if (isset($_POST['game'])) {
            $game[] = $_POST['game'];
        }
        $matches_db_collection = EArena_DB::get_ea_matches_by_filter_id($id, $perPage, $offset, $game);
        matchesListResponse($matches_db_collection);
    } else {
        $dataFilter = array();
        if (isset($_POST['game'])) {
            $dataFilter['game'][] = $_POST['game'];
        }
        if (isset($_POST['game_mode']) && $_POST['game_mode'] !== "") {
            $game_mode = explode(',', $_POST['game_mode']);
            $dataFilter['game_mode'] = $game_mode;
        }
        if (isset($_POST['team_mode']) && $_POST['team_mode'] !== "") {
            $team_mode = explode(',', $_POST['team_mode']);
            $dataFilter['team_mode'] = $team_mode;
        }
        if (isset($_POST['status']) && $_POST['status'] !== "") {
            $status = explode(',', $_POST['status']);
            $dataFilter['status'] = $status;
        }
        if (isset($_POST['bet']) && $_POST['bet'] !== "") {
            $bet = explode(',', $_POST['bet']);
            $dataFilter['bet'] = $bet;
        }
        if (isset($_POST['platform']) && $_POST['platform'] !== "") {
            $platform = explode(',', $_POST['platform']);
            $dataFilter['platform'] = $platform;
        }
        if (isset($_POST['private']) && $_POST['private'] && $_POST['private'] !== "null") {
            $dataFilter['private'][] = $_POST['private'] === 'true' ? '1' : '0';
        }
        $matches_db_collection = EArena_DB::get_ea_matches_by_filters($dataFilter, $perPage, $offset);
        matchesListResponse($matches_db_collection);
    }
    die();
}
//
//
add_action('wp_ajax_get_tournaments', 'get_tournaments');
add_action('wp_ajax_nopriv_get_tournaments', 'get_tournaments');

function get_tournaments()
{
    $id = isset($_POST['id']) && $_POST['id'] && $_POST['id'] !== null && $_POST['id'] !== "null" ? $_POST['id'] : false;
    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
    $perPage = 9;
    $matches_db_collection = [];
    if ($id) {
        $game = null;
        if (isset($_POST['game'])) {
            $game[] = $_POST['game'];
        }
        $matches_db_collection = EArena_DB::get_ea_tournaments_by_filter_id($id, $perPage, $offset, $game);
    } else {
        $dataFilter = array();
        if (isset($_POST['game'])) {
            $dataFilter['game'][] = $_POST['game'];
        }
        if (isset($_POST['game_mode']) && $_POST['game_mode'] !== "") {
            $game_mode = explode(',', $_POST['game_mode']);
            $dataFilter['game_mode'] = $game_mode;
        }
        if (isset($_POST['team_mode']) && $_POST['team_mode'] !== "") {
            $team_mode = explode(',', $_POST['team_mode']);
            $dataFilter['team_mode'] = $team_mode;
        }
        if (isset($_POST['type']) && $_POST['type'] !== "") {
            $status = explode(',', $_POST['type']);
            $dataFilter['type'] = $status;
        }
        if (isset($_POST['fast']) && $_POST['fast'] !== "") {
            $status = explode(',', $_POST['fast']);
            $dataFilter['fast'] = $status;
        }
        if (isset($_POST['status']) && $_POST['status'] !== "") {
            $status = explode(',', $_POST['status']);
            $dataFilter['status'] = $status;
        }
        if (isset($_POST['bet']) && $_POST['bet'] !== "") {
            $bet = explode(',', $_POST['bet']);
            $dataFilter['bet'] = $bet;
        }
        if (isset($_POST['platform']) && $_POST['platform'] !== "") {
            $platform = explode(',', $_POST['platform']);
            $dataFilter['platform'] = $platform;
        }
        if (isset($_POST['private']) && $_POST['private'] && $_POST['private'] !== "null" && $_POST['private'] !== "false") {
            $dataFilter['private'][] = $_POST['private'] === 'true' ? '1' : '0';
        }
        if (isset($_POST['vip']) && $_POST['vip'] && $_POST['vip'] !== "null" && $_POST['vip'] !== "false") {
            $dataFilter['vip'][] = $_POST['vip'] === 'true' ? '1' : '0';
        }
        $matches_db_collection = EArena_DB::get_ea_tournaments_by_filters($dataFilter, $perPage, $offset);
    }
    $game_matches_str = '';
    foreach ($matches_db_collection as $tournament) {
        $game_matches_str .= show_tournament($tournament);
    }
    echo $game_matches_str;
    die();
}
//
//
// add_action('wp_ajax_get_last_tournament_winner', 'get_last_tournament_winner');
// add_action('wp_ajax_nopriv_get_last_tournament_winner', 'get_last_tournament_winner');
//
// function get_last_tournament_winner()
// {
//     echo show_last_tournament_winner($_POST['game_key'] ?? '', $_POST['platform'] ?? []);
//     die();
// }
//
// add_action('wp_ajax_get_best_players', 'get_best_players');
// add_action('wp_ajax_nopriv_get_best_players', 'get_best_players');
//
// function get_best_players()
// {
//     $game_key = $_POST['game_key'];
//     echo json_encode(ea_month_ratings_for_game($game_key));
//     die();
// }
//
// add_action('wp_ajax_get_news_html', 'get_news_html');
// add_action('wp_ajax_nopriv_get_news_html', 'get_news_html');
//
// function get_news_html()
// {
//     $game_slug = $_POST['game_slug'];
//     $game_key = $_POST['game_key'];
//     $html = '';
//     add_filter('excerpt_length', function () {
//         return 11;
//     });
//     add_filter('excerpt_more', function ($more) {
//         return '...';
//     });
//     $postslist = get_posts(array(
//         'posts_per_page' => 10,
//         'order' => 'DESC',
//         'orderby' => 'date',
//         'category_name' => $game_slug
//     ));
//     global $post;
//     $html .= '<div class="news-after-list owl-carousel owl-theme">';
//     foreach ($postslist as $post) {
//         setup_postdata($post);
//         $html .= '<div class="news-after-item">';
//         $html .= '<a href="' . get_permalink($post->ID) . '" class="news-after-link">';
//         $html .= '<span class="news-after-image image" width="278" height="190" style="background: url(' . get_the_post_thumbnail_url($post->ID,
//                 'full') . ' ) center top no-repeat;"></span>';
//         $html .= '<div class="news-after-text text">';
//         $html .= '<span class="news-after-title title">' . get_the_title($post->ID) . '</span>';
//         $html .= '<span class="news-after-txt txt">' . get_the_excerpt($post->ID) . '</span></div></a></div>';
//     }
//     $html .= '</div>';
//     wp_reset_postdata();
//     echo $html;
//     die();
// }
