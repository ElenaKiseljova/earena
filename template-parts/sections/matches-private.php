<?php
  global $filter_section;
  global $header_right_section;

  // Стр Аккаунта (таб Турниров)
  global $is_tab_global;
  if ($is_tab_global === 'matches') {
    $is_matches_tab = true;
  }

  // Матчи
  global $matches;

  global $matches_all;

  // Никнеймы и ссылки на профиль опущены в тестовом массиве для упрощения.
  // AnnetteBlack - в имя везде ставится
  // /profile - в ссылку на аккаунт
  $matches_all = [
    0 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => null, // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    1 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'present', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => 'https://youtube.com', // null or link example: 'https://youtube.com'
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    2 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => 3, // 1 etc.
      'result_user_2' => 10, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    3 => [
      'game_name' => 'Dota 2', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '5', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'present', // present, past, future
      'my' => true, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239', 'chat' => true, // false or true
    ],
    4 => [
      'game_name' => 'CS:GO', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => 'Free', // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    5 => [
      'game_name' => 'Mortal Combat 11 Ultimate', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['mobile'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => true, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    6 => [
      'game_name' => 'League of Legends', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => 'Ultimate Team', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    7 => [
      'game_name' => 'Heroes III', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => null, // URL or null
      'bet' => 'Free', // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    8 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => null, // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    9 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'present', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    10 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => 3, // 1 etc.
      'result_user_2' => 10, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    11 => [
      'game_name' => 'Dota 2', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '5', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => true, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => 5, // 1 etc.
      'result_user_2' => 7, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239', 'chat' => true, // false or true
    ],
    12 => [
      'game_name' => 'CS:GO', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => 'Free', // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    13 => [
      'game_name' => 'Mortal Combat 11 Ultimate', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['mobile'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => true, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    14 => [
      'game_name' => 'League of Legends', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => 'Ultimate Team', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    15 => [
      'game_name' => 'Heroes III', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => null, // URL or null
      'bet' => 'Free', // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    16 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => null, // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    17 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'present', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => 'https://youtube.com', // null or link example: 'https://youtube.com'
      'stream_2' => 'https://youtube.com', // null or link example: 'https://youtube.com'
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    18 => [
      'game_name' => 'WARZONE', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => 3, // 1 etc.
      'result_user_2' => 10, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    19 => [
      'game_name' => 'Dota 2', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '5', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'present', // present, past, future
      'my' => true, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239', 'chat' => true, // false or true
    ],
    20 => [
      'game_name' => 'CS:GO', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => 'Free', // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
    21 => [
      'game_name' => 'Mortal Combat 11 Ultimate', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['mobile'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => true, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    22 => [
      'game_name' => 'League of Legends', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => 'Ultimate Team', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => true, // false or true
      'id' => '30204874239',
    ],
    23 => [
      'game_name' => 'Heroes III', // $games_all
      'game_img' => get_template_directory_uri() . '/assets/img/games/matches/game-' . mt_rand(0, 15) . '.png', // URL
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'user_avatar_1' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
      'user_avatar_2' => null, // URL or null
      'bet' => 'Free', // anything or 'Free'
      'result_user_1' => null, // 1 etc.
      'result_user_2' => null, // 1 etc.
      'stream_1' => null, // null or link
      'stream_2' => null, // null or link
      'lock' => false, // false or true
      'id' => '30204874239',
    ],
  ];

  ?>
    <script type="text/javascript">
      // Для получения картинок, если не задан аватар
      var templateURL = '<?php echo get_template_directory_uri(); ?>'

      data['matches'] = <?php echo json_encode( $matches_all ) ?>;
    </script>
  <?php

  // Записываю все матчи в глобальную переменную
  $matches = $matches_all;

  // Типы матчей по платформам
  global $matches_desktop;
  global $matches_mobile;
  global $matches_xbox;
  global $matches_playstation;

  $matches_desktop = [];
  $matches_mobile =  [];
  $matches_xbox = [];
  $matches_playstation = [];

  for ($k=0; $k < count($matches); $k++) {
    if (isset($matches[$k]['platforms']) && in_array('desktop', $matches[$k]['platforms'])) {
      array_push($matches_desktop, $matches[$k]);
    }

    if (isset($matches[$k]['platforms']) && in_array('mobile', $matches[$k]['platforms'])) {
      array_push($matches_mobile, $matches[$k]);
    }

    if (isset($matches[$k]['platforms']) && in_array('xbox', $matches[$k]['platforms'])) {
      array_push($matches_xbox, $matches[$k]);
    }

    if (isset($matches[$k]['platforms']) && in_array('playstation', $matches[$k]['platforms'])) {
      array_push($matches_playstation, $matches[$k]);
    }
  }

  // Количество матчей
  $matches_amount = count($matches);
?>
<section class="section section--matches" id="matches">
  <?php if (! earena_2_current_page( 'profile' ) && ! earena_2_current_page( 'user' ) ): ?>
    <div class="section__wrapper">
  <?php endif; ?>
    <header class="section__header">
      <h2 class="section__title section__title--matches <?php if ( is_page(  ) && ! is_front_page() ) echo 'section__title--page'; ?>">
        <?php _e( 'Матчи <br> на деньги', 'earena_2' ); ?>
        <span class="section__amount">
          <?= $matches_amount; ?>
        </span>
      </h2>

      <div class="section__header-right <?php if($is_tab_global) echo 'section__header-right--account-tabs'; ?>">
        <?php if ($header_right_section === 'all_button'): ?>
          <a class="button button--more" href="?type=matches">
            <span>
              <?php _e( 'Все матчи', 'earena_2' ); ?>
            </span>
          </a>
        <?php elseif ($header_right_section === 'tabs') : ?>
          <!-- Табы платформ -->
          <?php get_template_part( 'template-parts/tabs/platform' ); ?>
        <?php elseif ($header_right_section === 'filters') : ?>
          <!-- Фильтры ( стр Аккаунта ) -->
          <?php get_template_part( 'template-parts/filters', 'account' ); ?>
        <?php endif; ?>
      </div>
    </header>

    <?php
      if ($filter_section) {
        get_template_part( 'template-parts/filters' );

        if ( is_front_page() && $header_right_section === 'tabs' ) {
          // Если front-page.php с показом Всех Матчей
          ?>
            <div class="section__content" id="content-platform">
              <!-- Подстановка содержимого из шаблона -->
            </div>

            <template id="platform-all">
              <ul class="section__list">
                <!-- Кнопка создания матча -->
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/create' ); ?>
                </li>
                <?php
                  global $matches;
                  global $match_index;

                  $match_index = 0;
                  $row_index = 2;

                  // Перебираем матчи все
                  foreach ($matches as $match) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $match_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-desktop">
              <ul class="section__list">
                <!-- Кнопка создания матча -->
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/create' ); ?>
                </li>
                <?php
                  global $matches;
                  global $match_index;

                  $match_index = 0;
                  $matches = $matches_desktop;

                  $row_index = 2;

                  // Перебираем матчи десктопные
                  foreach ($matches as $match) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $match_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-mobile">
              <ul class="section__list">
                <!-- Кнопка создания матча -->
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/create' ); ?>
                </li>
                <?php
                  global $matches;
                  global $match_index;

                  $match_index = 0;
                  $matches = $matches_mobile;

                  $row_index = 2;

                  // Перебираем матчи мобильные
                  foreach ($matches as $match) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $match_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-xbox">
              <ul class="section__list">
                <!-- Кнопка создания матча -->
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/create' ); ?>
                </li>
                <?php
                  global $matches;
                  global $match_index;

                  $match_index = 0;
                  $matches = $matches_xbox;

                  $row_index = 2;

                  // Перебираем матчи xbox
                  foreach ($matches as $match) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $match_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-playstation">
              <ul class="section__list">
                <!-- Кнопка создания матча -->
                <li class="section__item section__item--col-4">
                  <?php get_template_part( 'template-parts/match/create' ); ?>
                </li>
                <?php
                  global $matches;
                  global $match_index;

                  $match_index = 0;
                  $matches = $matches_playstation;

                  $row_index = 2;

                  // Перебираем матчи playstation
                  foreach ($matches as $match) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $match_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
          <?php
        } else {
          // Матчи на стр Игры (все Матчи).
          // 10 - тестовое число, которое показывает количество матчей этой игровы
          // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
          ?>
            <div class="section__content">
              <ul class="section__list">
                <?php
                  // Записываю все матчи в глобальную переменную
                  $matches = $matches_all;
                  global $match_index;

                  $row_index = 1;

                  for ($match_index=0; $match_index < 10; $match_index++) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </div>
          <?php
        }
      } else if ( is_front_page() && $header_right_section !== 'tabs' ) {
        // Если front-page.php
        ?>
          <ul class="section__list" id="content-platform-matches">
            <!-- Подстановка содержимого из шаблона -->
          </ul>
        <?php
      } else {
        // Если другие варианты есть
        // стр Игры (матчи + турниры)
        ?>
          <div class="section__content">
            <ul class="section__list">
              <?php
                // Записываю все матчи в глобальную переменную
                $matches = $matches_all;
                global $match_index;

                $row_index = 1;

                if ($is_matches_tab) {
                  for ($match_index=0; $match_index < count($matches); $match_index++) {
                    if ($matches[$match_index]['my'] === true) {
                      ?>
                        <li class="section__item section__item--col-4">
                          <?php get_template_part( 'template-parts/match/archive' ); ?>
                        </li>
                      <?php
                      if ($row_index % 4 === 0) {
                        $row_index = 1;
                      } else {
                        $row_index++;
                      }
                    }
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                } else {
                  // Матчи на стр других
                  // 4 - тестовое число, которое показывает количество матчей этой игровы
                  // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
                  for ($match_index=0; $match_index < 4; $match_index++) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/match/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                }
              ?>
            </ul>
          </div>
        <?php
      }
    ?>
  <?php if (! earena_2_current_page( 'profile' ) && ! earena_2_current_page( 'user' ) ): ?>
    </div>
  <?php endif; ?>
</section>
