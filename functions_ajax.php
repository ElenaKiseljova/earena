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
add_action('wp_ajax_get_count', 'getCount');
add_action('wp_ajax_nopriv_get_count', 'getCount');

function getCount()
{
    echo json_encode(ea_count_games_platforms());
    die();
}

/* ==============================================
********  //Добавление игры в профиле
=============================================== */

add_action('wp_ajax_setPlafroms', 'setPlafromsAction');
add_action('wp_ajax_nopriv_setPlafroms', 'setPlafromsAction');

function setPlafromsAction()
{
    if (is_user_logged_in()) {
        $data = $_POST;
        unset($data['action']);
        foreach ($data as $key => $val) {
            $data[$key] = array_filter($val, function ($value) {
                return !is_null($value) && $value !== '';
            });
        }

        if (ea_edit_nicknames($data['nicknames']) == 'Сохранено') {
          global $profile;

          $profile = true;

          $response = [];
          ob_start();

          if ( function_exists( 'earena_2_get_section' ) ) {
            // Игры
            earena_2_get_section( 'games' );
          }

          $response['success'] = 1;
          $response['message'] = __('Всё ОК ) Игра добавлена', 'earena_2');
          $response['data'] = ob_get_contents();

          ob_end_clean();

          wp_send_json( json_encode($response) );
        }
    }
    die();
}

function ea_edit_nicknames($nicknames)
{
    $filtered = [];
    foreach ($nicknames as $k => $v) {
        $filtered[$k] = array_filter($v, 'strlen');
    }
    if (!update_user_meta(get_current_user_id(), 'nicknames', $filtered)) {
        return 0;
    } else {
        return "Сохранено";
    }
}

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
********  //Матчи (фильтр)
=============================================== */

add_action('wp_ajax_earena_2_get_filtered_matches', 'earena_2_get_filtered_matches');
add_action('wp_ajax_nopriv_earena_2_get_filtered_matches', 'earena_2_get_filtered_matches');

function earena_2_get_filtered_matches()
{
    $id = (isset($_POST['id']) && $_POST['id'] && $_POST['id'] !== null && $_POST['id'] !== "null" && $_POST['id'] > "") ? $_POST['id'] : false;
    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
    $per_page = isset($_POST['perpage']) ? (int)$_POST['perpage'] : 8;
    $matches_db_collection = [];

    if ($id) {
        $game = null;
        if (isset($_POST['game'])) {
            $game = $_POST['game'];
        }
        $matches_db_collection = EArena_DB::get_ea_matches_by_filter_id($id, $per_page, $offset, $game, $mode = 'new');
    } else {
        $dataFilter = array();
        if (isset($_POST['game'])) {
            $game = explode(',', $_POST['game']);
            $dataFilter['game'] = $game;
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
            $type = explode(',', $_POST['type']);
            $dataFilter['type'] = $type;
        }
        if (isset($_POST['fast']) && $_POST['fast'] !== "") {
            $fast = explode(',', $_POST['fast']);
            $dataFilter['fast'] = $fast;
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
        if (isset($_POST['sort']) && $_POST['sort'] !== "") {
            $sort = mb_strtoupper($_POST['sort']);

            // (array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID')
            $matches_db_collection = EArena_DB::get_ea_matches_by_filters($dataFilter, $per_page, $offset, $sort, 'date', $mode = 'new');
        } else {
          // (array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID')
          $matches_db_collection = EArena_DB::get_ea_matches_by_filters($dataFilter, $per_page, $offset, 'DESC', 'ID', $mode = 'new');
        }
    }
    $game_matches_str = '';

    $count_matches_db_collection_html = '<span class="visually-hidden count_filtered_matches">' . $matches_db_collection['total'] . '</span>';

    foreach ($matches_db_collection['array'] as $matches) {
      $game_matches_str .= earena_2_show_match($matches);
    }

    echo $game_matches_str . $count_matches_db_collection_html;

    die();
}

function earena_2_show_match ($match, $profile = false) {
  $var_match = $match;

  // В шаблоне одноименная глобальная используется, поэтому переписываю ее значением из ф-и
  global $match;
  $match = $var_match;

  get_template_part( 'template-parts/match/archive' );
  ?>
  ~~~
  <?php
  // ~~~ - эти тильды ВАЖНЫ (используются для разбиения стрроки на массив в js)
}

/* ==============================================
********  //Турниры (фильтр)
=============================================== */

add_action('wp_ajax_earena_2_get_filtered_tournaments', 'earena_2_get_filtered_tournaments');
add_action('wp_ajax_nopriv_earena_2_get_filtered_tournaments', 'earena_2_get_filtered_tournaments');

function earena_2_get_filtered_tournaments()
{
    $id = (isset($_POST['id']) && $_POST['id'] && $_POST['id'] !== null && $_POST['id'] !== "null" && $_POST['id'] > "") ? $_POST['id'] : false;
    $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
    $per_page = isset($_POST['perpage']) ? (int)$_POST['perpage'] : 8;
    $tournaments_db_collection = [];

    if ($id) {
        $game = null;
        if (isset($_POST['game'])) {
            $game = $_POST['game'];
        }
        $tournaments_db_collection = EArena_DB::get_ea_tournaments_by_filter_id($id, $per_page, $offset, $game, $mode = 'new');
    } else {
        $dataFilter = array();
        if (isset($_POST['game'])) {
            $game = explode(',', $_POST['game']);
            $dataFilter['game'] = $game;
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
            $type = explode(',', $_POST['type']);
            $dataFilter['type'] = $type;
        }
        if (isset($_POST['fast']) && $_POST['fast'] !== "") {
            $fast = explode(',', $_POST['fast']);
            $dataFilter['fast'] = $fast;
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
        if (isset($_POST['sort']) && $_POST['sort'] !== "") {
            $sort = mb_strtoupper($_POST['sort']);

            // ( array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID', $mode = 'old')
            $tournaments_db_collection = EArena_DB::get_ea_tournaments_by_filters($dataFilter, $per_page, $offset, $sort, 'date', $mode = 'new');
        } else {
          // ( array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID', $mode = 'old')
          $tournaments_db_collection = EArena_DB::get_ea_tournaments_by_filters($dataFilter, $per_page, $offset, 'DESC', 'ID', $mode = 'new');
        }
    }
    $game_tournaments_str = '';

    $count_tournaments_db_collection_html = '<span class="visually-hidden count_filtered_tournaments">' . $tournaments_db_collection['total'] . '</span>';

    foreach ($tournaments_db_collection['array'] as $tournament) {
      $game_tournaments_str .= earena_2_show_tournament($tournament);
    }

    echo $game_tournaments_str . $count_tournaments_db_collection_html;

    die();
}

function earena_2_show_tournament ($tournament, $profile = false) {
  $var_tournament = $tournament;

  // В шаблоне одноименная глобальная используется, поэтому переписываю ее значением из ф-и
  global $tournament;
  $tournament = $var_tournament;

  get_template_part( 'template-parts/tournament/archive' );
  ?>
  ~~~
  <?php
  // ~~~ - эти тильды ВАЖНЫ (используются для разбиения стрроки на массив в js)
}

//
//
// add_action('wp_ajax_get_tournaments', 'get_tournaments');
// add_action('wp_ajax_nopriv_get_tournaments', 'get_tournaments');
//
// function get_tournaments()
// {
//     $id = isset($_POST['id']) && $_POST['id'] && $_POST['id'] !== null && $_POST['id'] !== "null" ? $_POST['id'] : false;
//     $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
//     $perPage = 9;
//     $matches_db_collection = [];
//     if ($id) {
//         $game = null;
//         if (isset($_POST['game'])) {
//             $game[] = $_POST['game'];
//         }
//         $matches_db_collection = EArena_DB::get_ea_tournaments_by_filter_id($id, $perPage, $offset, $game);
//     } else {
//         $dataFilter = array();
//         if (isset($_POST['game'])) {
//             $dataFilter['game'][] = $_POST['game'];
//         }
//         if (isset($_POST['game_mode']) && $_POST['game_mode'] !== "") {
//             $game_mode = explode(',', $_POST['game_mode']);
//             $dataFilter['game_mode'] = $game_mode;
//         }
//         if (isset($_POST['team_mode']) && $_POST['team_mode'] !== "") {
//             $team_mode = explode(',', $_POST['team_mode']);
//             $dataFilter['team_mode'] = $team_mode;
//         }
//         if (isset($_POST['type']) && $_POST['type'] !== "") {
//             $status = explode(',', $_POST['type']);
//             $dataFilter['type'] = $status;
//         }
//         if (isset($_POST['fast']) && $_POST['fast'] !== "") {
//             $status = explode(',', $_POST['fast']);
//             $dataFilter['fast'] = $status;
//         }
//         if (isset($_POST['status']) && $_POST['status'] !== "") {
//             $status = explode(',', $_POST['status']);
//             $dataFilter['status'] = $status;
//         }
//         if (isset($_POST['bet']) && $_POST['bet'] !== "") {
//             $bet = explode(',', $_POST['bet']);
//             $dataFilter['bet'] = $bet;
//         }
//         if (isset($_POST['platform']) && $_POST['platform'] !== "") {
//             $platform = explode(',', $_POST['platform']);
//             $dataFilter['platform'] = $platform;
//         }
//         if (isset($_POST['private']) && $_POST['private'] && $_POST['private'] !== "null" && $_POST['private'] !== "false") {
//             $dataFilter['private'][] = $_POST['private'] === 'true' ? '1' : '0';
//         }
//         if (isset($_POST['vip']) && $_POST['vip'] && $_POST['vip'] !== "null" && $_POST['vip'] !== "false") {
//             $dataFilter['vip'][] = $_POST['vip'] === 'true' ? '1' : '0';
//         }
//         $matches_db_collection = EArena_DB::get_ea_tournaments_by_filters($dataFilter, $perPage, $offset);
//     }
//     $game_matches_str = '';
//     foreach ($matches_db_collection as $tournament) {
//         $game_matches_str .= show_tournament($tournament);
//     }
//     echo $game_matches_str;
//     die();
// }
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

/* ==============================================
********  //Получение разметки для попапа создания матча
          // (кнопка Далее)
=============================================== */

add_action('wp_ajax_earena_2_get_create_match_next_html', 'earena_2_get_create_match_next_html');
add_action('wp_ajax_nopriv_earena_2_get_create_match_next_html', 'earena_2_get_create_match_next_html');

function earena_2_get_create_match_next_html()
{
    $game = $_POST['game'] ? $_POST['game'] : false;

    if ($game === false) {
      $response = [
            'success' => 0,
            'message' => __('Не выбрана игра', 'earena_2')
          ];

      wp_send_json( json_encode($response) );

      die();
    }

    $platform = isset($_POST['platform']) ? $_POST['platform'] : '';

    if ($platform === '') {
      $response = [
            'success' => 0,
            'message' => __('Не выбрана платформа', 'earena_2')
          ];

      wp_send_json( json_encode($response) );

      die();
    }

    if ($game && $platform !== '') {
      $user_games = ea_my_games();

      if (in_array($game, $user_games)) {
        $user_game_platforms = ea_my_platforms($game);

        if (in_array($platform, $user_game_platforms)) {
          global $game_create_match, $platform_create_match;
          $game_create_match = $game;
          $platform_create_match = $platform;

          $response = [];
          ob_start();
          get_template_part( 'template-parts/match/create', 'next' );

          $response['success'] = 1;
          $response['message'] = __('Всё ОК ) Можно создавать матч', 'earena_2');
          $response['data'] = ob_get_contents();

          ob_end_clean();

          wp_send_json( json_encode($response) );

          die();
        } else {
          $response = [
                'success' => 0,
                'message' => __('Платформа не добавлена', 'earena_2')
              ];

          wp_send_json( json_encode($response) );

          die();
        }
      } else {
        $response = [
              'success' => 0,
              'message' => __('Игра не добавлена', 'earena_2')
            ];

        wp_send_json( json_encode($response) );

        die();
      }
    }
}

/* ==============================================
********  //Создание матча
=============================================== */

add_action('wp_ajax_add_match', 'add_match_callback');
function add_match_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
    ob_start();
    $arr_response['success'] = add_match_function();
    $arr_response['content'] = ob_get_contents();
    ob_end_clean();
    wp_send_json(json_encode($arr_response));
    wp_die();
}

/* ==============================================
********  //Удаление матча
=============================================== */

add_action('wp_ajax_delete_match', 'delete_match_callback');
//add_action('wp_ajax_nopriv_delete_match', 'delete_match_callback');
function delete_match_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
//	$args = array('id' => $_POST['id'],);
    ob_start();
    $arr_response['success'] = delete_match_function();
    $arr_response['content'] = ob_get_contents();
    ob_end_clean();
    wp_send_json(json_encode($arr_response));
    wp_die();
}

/* ==============================================
********  //Присоединение к матчу
=============================================== */

add_action('wp_ajax_join_match', 'join_match_callback');
//add_action('wp_ajax_nopriv_join_match', 'join_match_callback');
function join_match_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
//	$args = array('id' => $_POST['id'],);
    ob_start();
    join_match_function();
    $arr_response['content'] = ob_get_contents();
    ob_end_clean();
    wp_send_json(json_encode($arr_response));
    wp_die();
}

/* ==============================================
********  //Модерация матча
=============================================== */

add_action('wp_ajax_moderate_match', 'moderate_match_callback');
//add_action('wp_ajax_nopriv_moderate_match', 'moderate_match_callback');
function moderate_match_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
//	$args = array('id' => $_POST['id'],);
    ob_start();
    $arr_response['title'] = moderate_match_function();
    $arr_response['content'] = ob_get_contents();
    ob_end_clean();
    wp_send_json(json_encode($arr_response));
    wp_die();
}

/* ==============================================
********  //Отправка письма на мейл (с вложением)
=============================================== */

add_action('wp_ajax_earena_2_sendmail', 'earena_2_sendmail');
add_action('wp_ajax_nopriv_earena_2_sendmail', 'earena_2_sendmail');

function earena_2_sendmail () {
  //var_dump($_FILES, $_POST);
  $contactAttachments = [];

  if (count($_FILES) > 3) {
      wp_send_json_error(__('Загружайте не более 3 файлов, пожалуйста.', 'earena'));
      wp_die();
  } else {
      for ($i = 0; $i < count($_FILES); $i++) {
        // ограничим вес загружаемой картинки
        $filesize = $_FILES[$i]['size'];
        $max_filesize_mb = 4;
        $max_filesize = $max_filesize_mb * 1024 * 1024;
        if ($filesize > $max_filesize) {
          wp_send_json_error(__('Фото не должно быть больше ', 'earena') . $max_filesize_mb . 'Mb.');
          wp_die();
        }
        // ограничим размер загружаемой картинки
        $sizedata = getimagesize($_FILES[$i]['tmp_name']);
        $max_size = 4000;
        if ($sizedata[0]/*width*/ > $max_size || $sizedata[1]/*height*/ > $max_size) {
            wp_send_json_error(__('Фото не должно быть больше ',
                    'earena') . $max_size . __('px в ширину или высоту.', 'earena'));
            wp_die();
        }
        //разрешим только картинки
        if ($_FILES[$i]['type'] !== 'image/jpeg' && $_FILES[$i]['type'] !== 'image/png') {
            wp_send_json_error($_FILES[$i]['type'] . '-' . __('Тип файла не подходит по соображениям безопасности.', 'earena'));
            wp_die();
        }

        $uploaddir = WP_CONTENT_DIR  . '/uploads/form_files/';
        $uploadfile = $uploaddir . basename($_FILES[$i]['name']);

        if (move_uploaded_file($_FILES[$i]['tmp_name'], $uploadfile)) {
          array_push($contactAttachments, $uploadfile);
        } else {
          wp_send_json_error(__('Возможная атака с помощью файловой загрузки!', 'earena_2'));
          wp_die();
        }
      }
  }

  $contactName = isset($_POST['name']) ? ('<p>Имя - ' . esc_html( $_POST['name'] ) . '<p>') : '';
  $contactEmail = isset($_POST['email']) ? ('<p>E-mail - ' . esc_html( $_POST['email'] ) . '') : '<p>';
  $contactMessage = isset($_POST['message']) ? ('<p>Сообщение - ' . esc_html( $_POST['message'] ) . '<p>') : '';
  $contactSubject = isset($_POST['subject']) ? esc_html( $_POST['subject'] ) : 'Поддержка игроков';

  $contactMail = $contactName . $contactEmail . $contactMessage;

  $to = (get_field( 'support_mail', 5724 ) && get_field( 'support_mail', 5724 ) !== '') ? get_field( 'support_mail', 5724 ) : 'e.a.kiseljova@gmail.com';
  $site_name = 'From: ' . get_bloginfo( 'name' ) . ' <' . get_option('admin_email') . '>';

  // удалим фильтры, которые могут изменять заголовок $headers
  remove_all_filters( 'wp_mail_from' );
  remove_all_filters( 'wp_mail_from_name' );

  $headers = array(
    $site_name,
    'content-type: text/html',
  );

  if (count($contactAttachments) > 0) {
    wp_mail( $to, $contactSubject, $contactMail, $headers, $contactAttachments );
  } else {
    wp_mail( $to, $contactSubject, $contactMail, $headers );
  }

  // Удаляю загруженный файлы
  $errors_delete = [];
  foreach ($contactAttachments as $contactAttachment) {
    if (unlink($contactAttachment) === false) {
      $errors_delete[] = $contactAttachment . ' ::: ' . __('Файл не может быть удален.', 'earena_2');
    }
  }

  if (count($errors_delete) > 0) {
    wp_send_json_error($errors_delete);
  }

  $response = [
    'success' => 1,
    'files' => $_FILES,
    'post' => $_POST,
    'mail' => $contactMail,
    'attachments' => $contactAttachments,
    'removed' => true,
    'mail' => $to
  ];

  wp_send_json_success($response);

  wp_die();
}
