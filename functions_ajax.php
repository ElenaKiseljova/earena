<?php
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

add_action('wp_ajax_earena_2_set_translation', 'earena_2_set_translation');
add_action('wp_ajax_nopriv_earena_2_set_translation', 'earena_2_set_translation');

function earena_2_set_translation()
{
    if (is_user_logged_in() && isset($_POST['url'])) {
      $response = json_encode( earena_2_add_stream_link($_POST['url']) );
      wp_send_json( $response );
    }
    die();
}

add_action('wp_ajax_toggleTranslation', 'toggleTranslationAction');
add_action('wp_ajax_nopriv_toggleTranslation', 'toggleTranslationAction');

function toggleTranslationAction()
{
    if (is_user_logged_in()) {
      $match_type = $_POST['match_type'] ?? 0;
      $match_id =  $_POST['match_id'] ?? false;
      $user_id =  $_POST['user_id'] ?? false;

      $response = [];
      if ($match_id && $user_id) {
        // ob_start();
        $response['success'] = add_match_stream_function($match_id, $user_id, $match_type);
        $response['message'] = __('Успешно удален/добавлен стрим матча', 'earena_2');

        // earena_2_chat_form_users_html($match_id, $user_id);

        // $response['content'] = ob_get_contents();
        //
        // ob_end_clean();

        wp_send_json( json_encode( $response ) );

        die();
      } else {
        $response['success'] = 0;
        $response['message'] = __('Не переданы данные', 'earena_2');

        wp_send_json( json_encode( $response ) );

        die();
      }
    }
}

// add_action('wp_ajax_get_count', 'getCount');
// add_action('wp_ajax_nopriv_get_count', 'getCount');
//
// function getCount()
// {
//     echo json_encode(ea_count_games_platforms());
//     die();
// }

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

//
add_action('wp_ajax_getFriendsList', 'getFriendsListAction');
add_action('wp_ajax_nopriv_getFriendsList', 'getFriendsListAction');

function getFriendsListAction()
{
    $userNickname = isset($_POST['user']) ? $_POST['user'] : false;
    if (!$userNickname) {
        return false;
    }
    $id = getUserBySlug($userNickname);
    if ($id) {
      $response = [];
      ob_start();
      earena_2_page_profile_public_friends_data($id, 8, 0);
      $response['content'] = ob_get_clean();
      $response['total'] = bp_get_total_friend_count($id)>0?bp_get_total_friend_count($id):'0';

      wp_send_json_success( $response );
    }

    die();
}
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
add_action('wp_ajax_getUserButtons', 'getUserButtonsAction');
add_action('wp_ajax_nopriv_getUserButtons', 'getUserButtonsAction');

function getUserButtonsAction()
{
    $userNickname = isset($_POST['user']) ? $_POST['user'] : false;
    if (!$userNickname) {
        return false;
    }
    echo earena_2_page_profile_public_friends_buttons(getUserBySlug($userNickname));
    die();
}


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
        $counterMatches = counter_matches($id) ?? 0;
        $counterTournaments = counter_tournaments($id) ?? 0;
        $counterAdmin = counter_admin() ?? 0;

        // $red = $counterMatches + $counterTournaments + $counterAdmin;
        // 0 curTime
        // 1 balanceTopCur -
        // 2 balanceTopValue
        // 3 message
        // 4 numRed -
        // 5 friends (request)
        // 6 rating
        // 7 matches
        // 8 tournaments
        // 9 admin
        // 10 friends (total)

        $data[1] = '';//earena_2_nice_money(money_in_games());
        $data[2] = earena_2_nice_money(balance());
        $data[3] = messages_get_unread_count();
        $data[4] =  '';//$red;
        $data[5] = count(friends_get_friendship_request_user_ids($id));
        $data[6] = rating();
        $data[7] = $counterMatches;
        $data[8] = $counterTournaments;
        $data[9] = $counterAdmin;
        $data[10] = bp_get_total_friend_count($id);
    } else {
        echo json_encode([
            0 => $data,
            1 => $dataTournament
        ]);
        die();
    }


    try {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']) {

            $parts = parse_url($_SERVER['HTTP_REFERER']);

            if (isset($parts['query'])) {

                parse_str($parts['query'], $query);

                if (
                    (isset($query['tournament']) && $query['tournament'] > 0) ||
                    (isset($query['lc']) && $query['lc'] > 0) ||
                    (isset($query['cup']) && $query['cup'] > 0)
                    && isset($_POST['time'])
                  ) {
                    $tournament_id = 0;
                    if (isset($query['tournament'])) {
                      $tournament_id = $query['tournament'];
                    } else if (isset($query['lc'])) {
                      $tournament_id = $query['lc'];
                    } else if (isset($query['cup'])) {
                      $tournament_id = $query['cup'];
                    }
                    $time = $_POST['time'];
                    if (strtotime(EArena_DB::get_ea_tournament_field($tournament_id, 'status_time')) > strtotime($time)) {
                        $ea_user = wp_get_current_user();
                        $dataTournament[0] = 1;

                        ob_start();
                        earena_2_tournament_page_data($ea_user, $tournament_id);
                        $dataTournament[1] = ob_get_clean();
                        // 15 - Тестовая штука
                        // $dataTournament[15] = strtotime(EArena_DB::get_ea_tournament_field($tournament_id, 'status_time')) . '------------' . strtotime($time);
                    }
                }

                if (isset($query['match']) && $query['match'] > 0 && isset($_POST['time']) && $parts['path'] == '/tournaments/tournament/match/') {
                    $match_id = $query['match'];
                    $match = EArena_DB::get_ea_tournament_match($match_id);
                    $match_type = EArena_DB::get_ea_tournament_field($match->tid, 'type');

                    $time = $_POST['time'];
                    if (strtotime(EArena_DB::get_ea_tournament_match_field($match_id, 'status_time')) > strtotime($time)) {
                        $ea_user = wp_get_current_user();
                        $dataTournament[0] = 1;
                        ob_start();
                        earena_2_match_page_data($ea_user, $match_id, $match_type);
                        $dataTournament[1] = ob_get_clean();
                        // 15 - Тестовая штука
                        // $dataTournament[15] = strtotime(EArena_DB::get_ea_tournament_match_field($match_id, 'status_time')) . '------------' . strtotime($time);
                    }
                } else if (isset($query['match']) && $query['match'] > 0 && isset($_POST['time']) && $parts['path'] == '/matches/match/') {
                  $match_id = $query['match'];
                  $match_type = 0;

                  $time = $_POST['time'];
                  if (strtotime(EArena_DB::get_ea_match_field($match_id, 'status_time')) > strtotime($time)) {
                      $ea_user = wp_get_current_user();
                      $dataTournament[0] = 1;
                      ob_start();
                      earena_2_match_page_data($ea_user, $match_id, $match_type);
                      $dataTournament[1] = ob_get_clean();
                      // 15 - Тестовая штука
                      // $dataTournament[15] = strtotime(EArena_DB::get_ea_match_field($match_id, 'status_time')) . '------------' . strtotime($time);
                  }
                }
            }
            if (isset($_POST['time']) && $parts['path'] == '/profile/friends/') {
                $time = $_POST['time'];
                $user_id = get_current_user_id();
                if (intval(get_user_meta($user_id, 'friend_update', true)) > strtotime($time)) {
                    $dataTournament[0] = 1;
                    ob_start();
                    earena_2_page_profile_friends_data($user_id, 'private');
                    $dataTournament[1] = ob_get_clean();
                    $dataTournament[4] = true;
                }
            } else if (isset($_POST['time']) && $parts['path'] == '/profile/') {
                $time = $_POST['time'];
                $user_id = get_current_user_id();
                if (intval(get_user_meta($user_id, 'friend_update', true)) > strtotime($time)) {
                    $dataTournament[4] = true;
                }
            }

            if (isset($_POST['time']) && strpos($parts['path'], 'user') !== false) {
                $slug = str_replace('/', '', str_replace('/user/', '', $parts['path']));

                $time = $_POST['time'];
                $user_id = getUserBySlug($slug);
                if (intval(get_user_meta($user_id, 'friend_update', true)) > strtotime($time)) {
                    ob_start();
                    earena_2_page_profile_friends_data($user_id, 'public');
                    $dataTournament[3] = ob_get_clean();
                }
            } elseif (substr_replace($_SERVER['HTTP_REFERER'], "", -1) === get_site_url()) {
                $dataTournament[5][] = counter1_value();
                $dataTournament[5][] = counter2_value();
            }
        }
    } catch (Exception $e) {
        $dataTournament[0] = 0;
        $dataTournament[1] = $e;
    }

    echo json_encode([
        0 => $data,
        1 => $dataTournament,
    ]);
    die();
}


function getUserBySlug($slug)
{
    $user = '';
    $user = get_user_by('slug', $slug);
    return $user ? $user->ID : null;
}

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
    $is_profile = isset($_POST['is_profile']) ? true : false;

    $matches_db_collection = [];

    if ($id) {
        $game = null;
        if (isset($_POST['game'])) {
            $game = $_POST['game'];
        }
        $matches_db_collection = EArena_DB::get_ea_matches_by_filter_id($id, $per_page, $offset, $game, $mode = 'new');
    } else {
        $dataFilter = array();

        if (isset($_POST['player_id'])) {
          $dataFilter['player_id'] = $_POST['player_id'];
        }

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
            $dataFilter['private'][] = $_POST['private'] === '1' ?: '0';
        }
        if (isset($_POST['vip']) && $_POST['vip'] && $_POST['vip'] !== "null" && $_POST['vip'] !== "false") {
            $dataFilter['vip'][] = $_POST['vip'] === '1' ?: '0';
        }

        $order = 'DESC';
        $order_by = 'ID';
        if (isset($_POST['sort']) && $_POST['sort'] !== "") {
            $order = mb_strtoupper($_POST['sort']);
            $order_by = 'date';
        }

        // (array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID')
        $matches_db_collection = EArena_DB::get_ea_matches_by_filters($dataFilter, $per_page, $offset, $order, $order_by, $mode = 'new');
    }

    $response = [];

    ob_start();

    $game_count = 0;
    foreach ($matches_db_collection['array'] as $match) {
      ?>
        <li class="section__item section__item--col-4">
          <?php earena_2_show_match($match, $is_profile); ?>
        </li>
      <?php
      $game_count++;
    }

    $response['success'] = 1;
    $response['amount'] = $game_count;
    $response['total'] = $matches_db_collection['total'];
    $response['data'] = ob_get_contents();

    ob_end_clean();

    wp_send_json( json_encode($response) );

    die();
}

function earena_2_show_match ($match_item, $profile = false) {
  global $match;
  $match = $match_item;

  get_template_part( 'template-parts/match/archive' );
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
    $is_profile = isset($_POST['is_profile']) ? true : false;

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
            $dataFilter['private'][] = $_POST['private'] === '1' ?: '0';
        }
        if (isset($_POST['vip']) && $_POST['vip'] && $_POST['vip'] !== "null" && $_POST['vip'] !== "false") {
            $dataFilter['vip'][] = $_POST['vip'] === '1' ?: '0';
        }

        if (isset($_POST['player_id'])) {
            $dataFilter['player_id'] = $_POST['player_id'];
        }

        $order = 'DESC';
        $order_by = 'ID';
        if (isset($_POST['sort']) && $_POST['sort'] !== "") {
            $order = mb_strtoupper($_POST['sort']);
            $order_by = 'date';
        }

        // ( array $filters, $length = 0, $offset = 0, $order = 'DESC', $order_by = 'ID', $mode = 'old')
        $tournaments_db_collection = EArena_DB::get_ea_tournaments_by_filters($dataFilter, $per_page, $offset, $order, $order_by, $mode = 'new');
    }

    $response = [];

    ob_start();

    $game_count = 0;
    foreach ($tournaments_db_collection['array'] as $tournament) {
      ?>
        <li class="section__item section__item--col-4">
          <?php earena_2_show_tournament($tournament, $is_profile); ?>
        </li>
      <?php

      $game_count++;
    }

    $response['success'] = 1;
    $response['amount'] = $game_count;
    $response['total'] = $tournaments_db_collection['total'];
    $response['data'] = ob_get_contents();

    ob_end_clean();

    wp_send_json( json_encode($response) );

    die();
}

function earena_2_show_tournament ($tournament_item, $profile = false) {
  global $tournament, $is_profile;
  $tournament = $tournament_item;
  $is_profile = $profile;

  get_template_part( 'template-parts/tournament/archive' );
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
    $game = isset($_POST['game']) ? $_POST['game'] : false;

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

    if ($game !== false && $platform !== '') {
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
    $arr_response['match_id'] = (int) $_POST['id'];
    $arr_response['status'] = join_match_function();
    $arr_response['balance'] = balance();
    $arr_response['content'] = ob_get_contents();
    ob_end_clean();
    wp_send_json(json_encode($arr_response));
    wp_die();
}

/* ==============================================
********  //Модерация матча (жалоба)
=============================================== */

add_action('wp_ajax_moderate_match', 'moderate_match_callback');
//add_action('wp_ajax_nopriv_moderate_match', 'moderate_match_callback');
function moderate_match_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
//	$args = array('id' => $_POST['id'],);
    $arr_response = moderate_match_function();
    wp_send_json(json_encode($arr_response));
    wp_die();
}

/* ==============================================
********  //Жалоба рассмотрена
=============================================== */
add_action('wp_ajax_earena_2_del_moderate', 'earena_2_del_moderate_callback');
function earena_2_del_moderate_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
    $match_id = $_POST['match_id'];
    $tid = $_POST['match_thread_id'];
    $tournament = $_POST['tournament'];
    $complaint_index = (int)$_POST['complaint_index'];

    if (empty($match_id)) {
        return;
    }
    $where = array("ID" => $match_id);

    $complaint = $tournament == 1 ? EArena_DB:: get_ea_tournament_match_field($match_id, 'complaint') : (EArena_DB:: get_ea_match_field($match_id, 'complaint') ?? []);
    $complaint = json_decode( $complaint, true );

    $message = __('Ваша жалоба: "', 'earena_2') .
              $complaint[$complaint_index]['content'] .'" - ' .
              __('рассмотрена Администратором', 'earena_2');
    if (isset($complaint[$complaint_index])) {
      unset($complaint[$complaint_index]);
    }

    $complaint = array_values($complaint);

    if (empty($complaint)) {
      $match_data['moderate'] = false;
    }

    $match_data['complaint'] = json_encode($complaint);

    $result = $tournament == 1 ? EArena_DB::upd_ea_tournament_match($match_data,
        $where) : EArena_DB::upd_ea_match($match_data, $where);
    if ($result) {
        $admin_id = (int)get_site_option('ea_admin_id', 27);
        global $wpdb;
        $table_name = $wpdb->get_blog_prefix() . 'bp_messages_recipients';
        if ($wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE thread_id = %d AND user_id=%d", $tid,
                $admin_id)) == null) {
            $wpdb->insert($table_name, ['user_id' => $admin_id, 'thread_id' => $tid]);
        }
        ea_messages_new_message(array(
            'sender_id' => $admin_id,
            'thread_id' => $tid,
            'content' => $message,
        ));

        $arr_response['success'] = 1;
        $arr_response['complaint'] = $complaint;
        $arr_response['complaint_index'] = $complaint_index;

        wp_send_json(json_encode($arr_response));

        wp_die();
    } else {
        $arr_response['success'] = 0;
        $arr_response['result'] = $result;
        $arr_response['complaint'] = $complaint;
        $arr_response['complaint_index'] = $complaint_index;

        wp_send_json(json_encode($arr_response));
        wp_die();
    }
}

/* ==============================================
********  //Присоединиться к турниру
=============================================== */
add_action('wp_ajax_earena_2_join_tournament', 'earena_2_join_tournament_callback');
function earena_2_join_tournament_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
    $tournament_price = htmlspecialchars($_POST['tournament_price']) ?? 0;
    $tournament_pass = isset($_POST['tournament_pass']) ? $_POST['tournament_pass'] : '';

    $add_status = add_ea_tournament_player($_POST['tournament_id'], get_current_user_id(), $tournament_pass);

    if ($add_status == 1 && $tournament_price != 0) {
      wp_send_json_success( __('Вы успешно зарегистрированы в турнире.<br/>Средства в размере $', 'earena_js') . $tournament_price . __(' были списаны с Вашего счёта.', 'earena_js') );
    } else if ($add_status == 1 && $tournament_price == 0) {
      wp_send_json_success( __('Вы успешно зарегистрированы в турнире.', 'earena_js') );
    }

    if ($add_status == -4) {
      wp_send_json_error( __('Игроки, которым нет 18-ти лет не могут участвовать в играх на деньги. Для игры доступны только бесплатные турниры.', 'earena_js') );
    }

    if ($add_status == -3) {
      wp_send_json_error( __('Не удалось идентифицировать пользователя. Обновите страницу.', 'earena_js') );
    }

    if ($add_status == -2) {
      $response = [
        'error_pass' => true,
        'message' => __('Неверный пароль.', 'earena_js')
      ];
      wp_send_json_error( $response );
    }

    if ($add_status == -1) {
      wp_send_json_error( __('Не получилось списать средства.', 'earena_js') );
    }

    if ($add_status == 0) {
      wp_send_json_error( __('Что-то пошло не так... <br>Попробуйте снова позже или обратитесь в техподдержку.', 'earena_js') );
    }

    wp_die();
}

/* ==============================================
********  //Покинуть турнир
=============================================== */
add_action('wp_ajax_earena_2_leave_tournament', 'earena_2_leave_tournament_callback');
function earena_2_leave_tournament_callback()
{
    check_ajax_referer('ea_functions_nonce', 'security');
    $tournament_price = htmlspecialchars($_POST['tournament_price']) ?? 0;

    $leave_status = del_ea_tournament_player($_POST['tournament_id'], get_current_user_id());
    if ($leave_status == 1 && $tournament_price !== 0) {
      wp_send_json_success( __('Вы отменили участие в турнире.<br/>Средства в размере $', 'earena_js') . $tournament_price . __(' были возвращены обратно на ваш счёт.', 'earena_js') );
    } else if ($leave_status == 1 && $tournament_price == 0) {
      wp_send_json_success( __('Вы успешно отменили участие в турнире.', 'earena_js') );
    }

    if ($leave_status == -1) {
      wp_send_json_error( __('Не получилось вернуть средства. <br>Пожалуйста, повторите попытку позже или обратитесь в техподдержку.', 'earena_js') );
    }

    if ($leave_status == 0) {
      wp_send_json_error( __('Что-то пошло не так... <br>Пожалуйста, повторите попытку позже или обратитесь в техподдержку.', 'earena_js') );
    }

    wp_die();
}
