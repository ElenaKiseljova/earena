<?php
// add_action('wp_ajax_getVIP', 'getVIPAction');
// add_action('wp_ajax_nopriv_getVIP', 'getVIPAction');
//
// function getVIPAction()
// {
//     if (is_user_logged_in() && isset($_POST['month'])) {
//         $ea_user = wp_get_current_user();
//         $arr = buy_vip($_POST['month'], $ea_user->ID);
//         if ($arr['success'] == 1) {
//             $arr['data'] = get_include_contents(get_stylesheet_directory() . '/profile-header.php');
//         }
//         print json_encode($arr);
//     }
//     die();
// }
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
    /*$dataTournament = [];
    $dataTournament[0] = 0;
    $dataTournament[3] = 0;
    $dataTournament[4] = 0;*/

    if (is_user_logged_in()) {
        $id = get_current_user_id();
        /*$counterMatches = counter_matches();
        $counterTournaments = counter_tournaments();
        $counteArdmin = counter_admin();

        $red = $counterMatches + $counterTournaments + $counteArdmin;*/
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

        $data[1] = money_in_games();
        $data[2] = balance();
        /*$data[3] = messages_get_unread_count();
        $data[4] = $red;
        $data[5] = count(friends_get_friendship_request_user_ids($id));
        $data[6] = rating();
        $data[7] = $counterMatches;
        $data[8] = $counterTournaments;
        $data[9] = $counteArdmin;
        $data[10] = bp_get_total_friend_count($id);*/
    } else {
        echo json_encode([
            0 => $data,
            /*1 => $dataTournament,*/
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
        //1 => $dataTournament,
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
// add_action('wp_ajax_get_match', 'get_match');
// add_action('wp_ajax_nopriv_get_match', 'get_match');
//
// function get_match()
// {
//     $id = isset($_POST['id']) && $_POST['id'] && $_POST['id'] !== null && $_POST['id'] !== "null" ? $_POST['id'] : false;
//     $offset = isset($_POST['offset']) ? (int)$_POST['offset'] : 0;
//     $perPage = $offset === 0 ? 11 : 12;
//     if ($id) {
//         $game = null;
//         if (isset($_POST['game'])) {
//             $game[] = $_POST['game'];
//         }
//         $matches_db_collection = EArena_DB::get_ea_matches_by_filter_id($id, $perPage, $offset, $game);
//         matchesListResponse($matches_db_collection);
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
//         if (isset($_POST['private']) && $_POST['private'] && $_POST['private'] !== "null") {
//             $dataFilter['private'][] = $_POST['private'] === 'true' ? '1' : '0';
//         }
//         $matches_db_collection = EArena_DB::get_ea_matches_by_filters($dataFilter, $perPage, $offset);
//         matchesListResponse($matches_db_collection);
//     }
//     die();
// }
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
