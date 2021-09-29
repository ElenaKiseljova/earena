<?php
  global $games, $game_id, $ea_icons, $matches, $tournaments;

  $count_tournaments = count($tournaments);


  global $filter_section;
  global $header_right_section;

  // Стр Аккаунта (таб Турниров)
  global $is_tab_global;
  if ($is_tab_global === 'tournaments') {
    $is_tournaments_tab = true;
  }

  // Турниры
  global $tournaments;

  global $tournaments_all;

  $tournaments_all = [
    0 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => 'Free', // anything or 'Free'
      'trophy' => earena_2_nice_money(1256.11), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    1 => [
      'game_name' => 'Dota 2', // $games_all
      'variations' => '5', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'present', // present, past, future
      'my' => true, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => true, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => true, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Championship 2020',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    2 => [
      'game_name' => 'CS:GO', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => true, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
          'avatar' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
          'name' => 'Bessie_Cooper'
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    3 => [
      'game_name' => 'Mortal Combat 11 Ultimate', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => true, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => true, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    4 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['mobile'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    5 => [
      'game_name' => 'CS:GO', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
          'avatar' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
          'name' => 'Bessie_Cooper'
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    6 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    7 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    8 => [
      'game_name' => 'CS:GO', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
          'avatar' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
          'name' => 'Bessie_Cooper'
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    9 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => 'Ultimate Team', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => 'Free', // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    10 => [
      'game_name' => 'Dota 2', // $games_all
      'variations' => '5', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'present', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => true, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Championship 2020',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    11 => [
      'game_name' => 'CS:GO', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [ // array or array empty
          'avatar' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
          'name' => 'Bessie_Cooper'
        ],
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    12 => [
      'game_name' => 'Mortal Combat 11 Ultimate', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['playstation'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => true, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => true, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    13 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['mobile'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    14 => [
      'game_name' => 'CS:GO', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
          'avatar' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
          'name' => 'Bessie_Cooper'
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    15 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    16 => [
      'game_name' => 'WARZONE', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['xbox'], // xbox, desktop, mobile, playstation
      'status' => 'future', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
    17 => [
      'game_name' => 'CS:GO', // $games_all
      'variations' => '1', // 2, 3, 4, 5 ... or 'Ultimate Team'
      'platforms' => ['desktop'], // xbox, desktop, mobile, playstation
      'status' => 'past', // present, past, future
      'my' => false, // true or false
      'bet' => earena_2_nice_money(mt_rand(5, 2000)), // anything or 'Free'
      'trophy' => earena_2_nice_money(mt_rand(5, 2000)), // anything
      'lock' => false, // false or true
      'id' => '30204874239',
      'tournament' => [
        'winner' => [
          'avatar' => get_template_directory_uri() . '/assets/img/avatar-' . mt_rand(1, 8) . '.png', // URL or null
          'name' => 'Bessie_Cooper'
        ],// array or array empty
        'vip' => false, // true or false
        'img' => get_template_directory_uri() . '/assets/img/games/tournaments/game-' . mt_rand(0, 7) . '.jpg', // URL
        'name' => 'Myanmar Championship 2020 Season 2 Premium',
        'date_start' => '25/10/2022 (13:00)', // time or null
        'date_end' => '25/10/2023 (13:00)', // time or null
        'date_registration' => '25/10/2021 (13:00)', // time or null
        'users_total' => mt_rand(180, 200), // total count users who can gaming on this tournament
        'users_current' => mt_rand(5, 180), // current count users who now a registrated
      ]
    ],
  ];

  ?>
    <script type="text/javascript">
      data['tournaments'] = <?php echo json_encode( $tournaments_all ) ?>;
    </script>
  <?php

  // Записываю все Турниры в глобальную переменную
  $tournaments = $tournaments_all;

  // Типы матчей по платформам
  global $tournaments_desktop;
  global $tournaments_mobile;
  global $tournaments_xbox;
  global $tournaments_playstation;

  $tournaments_desktop = [];
  $tournaments_mobile =  [];
  $tournaments_xbox = [];
  $tournaments_playstation = [];

  for ($k=0; $k < count($tournaments); $k++) {
    if (isset($tournaments[$k]['platforms']) && in_array('desktop', $tournaments[$k]['platforms'])) {
      array_push($tournaments_desktop, $tournaments[$k]);
    }

    if (isset($tournaments[$k]['platforms']) && in_array('mobile', $tournaments[$k]['platforms'])) {
      array_push($tournaments_mobile, $tournaments[$k]);
    }

    if (isset($tournaments[$k]['platforms']) && in_array('xbox', $tournaments[$k]['platforms'])) {
      array_push($tournaments_xbox, $tournaments[$k]);
    }

    if (isset($tournaments[$k]['platforms']) && in_array('playstation', $tournaments[$k]['platforms'])) {
      array_push($tournaments_playstation, $tournaments[$k]);
    }
  }

  // Количество Турниров
  $tournaments_amount = count($tournaments);
?>
<section class="section section--tournaments" id="tournaments">
  <?php if (! earena_2_current_page( 'profile' ) && ! earena_2_current_page( 'user' ) ): ?>
    <div class="section__wrapper">
  <?php endif; ?>

    <?php if ($_GET['tournaments'] === 'chat'): ?>
      <header class="section__header section__header--tournaments-account-chat">
        <a class="section__back button button--gray" href="<?php echo bloginfo( 'url' ); ?>/profile?tournaments">
          <span>
            <?php _e( 'Назад к турнирам', 'earena_2' ); ?>
          </span>
        </a>

        <div class="section__header-right section__header-right--tournaments-account-chat">
          <h3 class="section__title section__title--tournaments-account-chat">
            Myanmar Championship 2020 Season 2 Premium
          </h3>
        </div>
      </header>
    <?php else: ?>
      <header class="section__header">
        <h2 class="section__title section__title--tournaments <?php if ( is_page(  ) && ! is_front_page() ) echo 'section__title--page'; ?>">
          <?php _e( 'Турниры', 'earena_2' ); ?>

          <span class="section__amount">
            <?= $tournaments_amount; ?>
          </span>
        </h2>

        <div class="section__header-right <?php if ($is_tournaments_tab) echo 'section__header-right--account-tabs'; ?>">
          <?php if ($header_right_section === 'all_button'): ?>
            <a class="button button--more" href="<?php echo bloginfo( 'url' ); ?>/?type=tournaments">
              <span>
                <?php _e( 'Все турниры', 'earena_2' ); ?>
              </span>
            </a>
          <?php elseif ($header_right_section === 'tabs') : ?>
            <!-- Табы игровых платформ -->
            <?php get_template_part( 'template-parts/tabs/platform' ); ?>
          <?php elseif ($header_right_section === 'filters') : ?>
            <!-- Фильтры ( стр Аккаунта ) -->
            <?php get_template_part( 'template-parts/filters', 'account' ); ?>
          <?php endif; ?>
        </div>
      </header>
    <?php endif; ?>

    <?php
      if ($filter_section) {
        get_template_part( 'template-parts/filters' );

        if ( is_front_page() && $header_right_section === 'tabs' ) {
          // Если front-page.php с показом Всех Турниров
          ?>
            <div class="section__content" id="content-platform">
              <!-- Подстановка содержимого из шаблона -->
            </div>

            <template id="platform-all">
              <ul class="section__list">
                <?php
                  global $tournaments;
                  global $tournament_index;

                  // Записываю все турниры в глобальную переменную
                  $tournaments = $tournaments_all;

                  $tournament_index = 0;
                  $row_index = 1;

                  // Перебираем матчи все
                  foreach ($tournaments as $tournament) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $tournament_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-desktop">
              <ul class="section__list">
                <?php
                  global $tournaments;
                  global $tournament_index;

                  $tournament_index = 0;
                  $tournaments = $tournaments_desktop;

                  $row_index = 1;

                  // Перебираем матчи десктопные
                  foreach ($tournaments as $tournament) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $tournament_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-mobile">
              <ul class="section__list">
                <?php
                  global $tournaments;
                  global $tournament_index;

                  $tournament_index = 0;
                  $tournaments = $tournaments_mobile;

                  $row_index = 1;

                  // Перебираем матчи мобильные
                  foreach ($tournaments as $tournament) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $tournament_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-xbox">
              <ul class="section__list">
                <?php
                  global $tournaments;
                  global $tournament_index;

                  $tournament_index = 0;
                  $tournaments = $tournaments_xbox;

                  $row_index = 1;

                  // Перебираем матчи xbox
                  foreach ($tournaments as $tournament) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $tournament_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
            <template id="platform-playstation">
              <ul class="section__list">
                <?php
                  global $tournaments;
                  global $tournament_index;

                  $tournament_index = 0;
                  $tournaments = $tournaments_playstation;

                  $row_index = 1;

                  // Перебираем матчи playstation
                  foreach ($tournaments as $tournament) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive' ); ?>
                      </li>
                    <?php
                    if ($row_index % 4 === 0) {
                      $row_index = 1;
                    } else {
                      $row_index++;
                    }

                    $tournament_index++;
                  }

                  // Оставшееся (до 4 шт) заполняется пустыми карточками
                  while ( $row_index <= 4 && $row_index > 1 ) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive', 'empty' ); ?>
                      </li>
                    <?php
                    $row_index++;
                  }
                ?>
              </ul>
            </template>
          <?php
        } else {
          // Турниры на стр Игры (все Турниры).
          // 10 - тестовое число, которое показывает количество Турниров этой игровы
          // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
          ?>
            <div class="section__content">
              <ul class="section__list">
                <?php
                  global $tournament_index;
                  global $tournaments;

                  // Записываю все Турниры в глобальную переменную
                  $tournaments = $tournaments_all;

                  $row_index = 1;

                  for ($tournament_index=0; $tournament_index < 10; $tournament_index++) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive' ); ?>
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
                        <?php get_template_part( 'template-parts/tournament/archive', 'empty' ); ?>
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
          <div class="section__content">
            <ul class="section__list" id="content-platform-tournaments">
              <!-- Подстановка содержимого из шаблона -->
            </ul>
          </div>
        <?php
      } else {
        // Если другие варианты есть
        // стр Игры (матчи + турниры)
        ?>
          <div class="section__content">
            <ul class="section__list">
              <?php
                global $tournaments;
                global $tournament_index;

                // Записываю все турниры в глобальную переменную
                $tournaments = $tournaments_all;

                $row_index = 1;

                // Таб с турнирами
                if ($is_tournaments_tab) {
                  if ($_GET['tournaments'] === 'chat') {
                    $tournament_index = $_GET['tournament_index'];
                    ?>
                    <li class="section__item section__item--col-4">
                      <?php get_template_part( 'template-parts/tournament/archive' ); ?>
                    </li>
                    <li class="section__item section__item--col-3-4">
                      <?php
                        get_template_part( 'template-parts/accordeon', 'tournaments-account-chat' );
                      ?>
                    </li>
                    <?php
                  } else {
                    for ($tournament_index=0; $tournament_index < count($tournaments); $tournament_index++) {
                      if ($tournaments[$tournament_index]['my'] === true) {
                        ?>
                          <li class="section__item section__item--col-4">
                            <?php get_template_part( 'template-parts/tournament/archive' ); ?>
                          </li>
                        <?php
                        if ($row_index % 4 === 0) {
                          $row_index = 1;
                        } else {
                          $row_index++;
                        }
                      }
                    }
                  }
                } else {
                  // Турниры на других страницах ( к примеру - стр Аккаунта)
                  // 4 - тестовое число
                  // А настоящее перебором основного реального массива потом получить надо или как-то по-другому
                  for ($tournament_index=0; $tournament_index < 4; $tournament_index++) {
                    ?>
                      <li class="section__item section__item--col-4">
                        <?php get_template_part( 'template-parts/tournament/archive' ); ?>
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
                      <?php get_template_part( 'template-parts/tournament/archive', 'empty' ); ?>
                    </li>
                  <?php
                  $row_index++;
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
