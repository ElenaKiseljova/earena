<?php
  /* ==============================================
  ********  //Пусть тут полежит
  =============================================== */
  $games = [
      0 => [
          'key' => 0,
          'news-slug' => 'counter-strike-global-offensive',
          'name' => 'Counter Strike',
          'details' => 'Global Offensive',
          'shortname' => 'CS GO',
          'id' => 'cs-go',
          'platforms' => [0],
          'game_modes' => [1, 2, 5],
          'team_modes' => [0],
      'rules_page' => get_page_link(5491)
      ],
      1 => [
          'key' => 1,
          'news-slug' => 'counter-strike-1-6',
          'name' => 'Counter Strike',
          'details' => 'Version 1.6',
          'shortname' => 'CS 1.6',
          'id' => 'cs-16',
          'platforms' => [0],
          'game_modes' => [1, 2, 5],
          'team_modes' => [0],
      'rules_page' => get_page_link(5502)
      ],
      2 => [
          'key' => 2,
          'news-slug' => 'dota2',
          'name' => 'DOTA II',
          'details' => __('Многопользовательская', 'earena'),
          'shortname' => 'DOTA II',
          'id' => 'dota-2',
          'platforms' => [0],
          'game_modes' => [1, 5],
          'team_modes' => [0],
      'rules_page' => get_page_link(5505)
      ],
      3 => [
          'key' => 3,
          'news-slug' => 'world-of-tanks',
          'name' => 'World Of Tanks',
          'details' => __('Многопользовательская', 'earena'),
          'shortname' => 'World of Tanks',
          'id' => 'wot',
          'platforms' => [0],
          'game_modes' => [1, 3, 7],
          'team_modes' => [0],
      'rules_page' => get_page_link(5507)
      ],
      4 => [
          'key' => 4,
          'news-slug' => 'warcraft-3',
          'name' => 'Warcraft III',
          'details' => __('Многопользовательская', 'earena'),
          'shortname' => 'Warcraft III',
          'id' => 'wc-3',
          'platforms' => [0],
          'game_modes' => [1, 2],
          'team_modes' => [0],
      'rules_page' => get_page_link(5506)
      ],
      5 => [
          'key' => 5,
          'news-slug' => 'call-of-duty-war-zone',
          'name' => 'Call Of Duty',
          'details' => 'WAR ZONE',
          'shortname' => 'WARZONE',
          'id' => 'cod-wz',
          'platforms' => [0, 2, 3],
          'game_modes' => [1],
          'team_modes' => [0],
      'rules_page' => get_page_link(5508)
      ],
      6 => [
          'key' => 6,
          'news-slug' => 'pes-21-pro-evolution-soccer',
          'name' => 'PES 21',
          'details' => 'Pro Evolution Soccer',
          'shortname' => 'PES 21',
          'id' => 'pes-21',
          'platforms' => [0, 1, 2, 3],
          'game_modes' => [1, 2, 3],
          'team_modes' => [1, 2],
      'rules_page' => get_page_link(5510)
      ],
      7 => [
          'key' => 7,
          'news-slug' => 'fifa-21-ea-sports',
          'name' => 'FIFA 21',
          'details' => 'EA SPORTS',
          'shortname' => 'FIFA 21',
          'id' => 'fifa-21',
          'platforms' => [0, 1, 2, 3],
          'game_modes' => [1, 2],
          'team_modes' => [1, 3],
      'rules_page' => get_page_link(5509)
      ],
      8 => [
          'key' => 8,
          'news-slug' => 'fifa-online-4-ea-sports',
          'name' => 'FIFA ONLINE 4',
          'details' => 'EA SPORTS',
          'shortname' => 'FIFA ONLINE 4',
          'id' => 'fifa-online-4',
          'platforms' => [0],
          'game_modes' => [1],
          'team_modes' => [1, 3],
      'rules_page' => get_page_link(5511)
      ],
      9 => [
          'key' => 9,
          'news-slug' => 'league-of-legends',
          'name' => 'League Of Legends',
          'details' => 'Cтратегия в реальном времени',
          'shortname' => 'LoL',
          'id' => 'lol',
          'platforms' => [0, 1],
          'game_modes' => [1, 2, 5],
          'team_modes' => [0],
      'rules_page' => get_page_link(5512)
      ],
      10 => [
          'key' => 10,
          'news-slug' => 'starcraft-2',
          'name' => 'StarCraft II',
          'details' => 'Cтратегия в реальном времени',
          'shortname' => 'StarCraft II',
          'id' => 'sc-2',
          'platforms' => [0],
          'game_modes' => [1, 2],
          'team_modes' => [0],
      'rules_page' => get_page_link(5514)
      ],
      11 => [
          'key' => 11,
          'news-slug' => 'command-conquer-generals-zero-hour',
          'name' => 'Command & Conquer:',
          'details' => 'Generals — Zero Hour',
          'shortname' => 'Generals ZH',
          'id' => 'cc-zh',
          'platforms' => [0],
          'game_modes' => [1, 2, 3],
          'team_modes' => [0],
      'rules_page' => get_page_link(5513)
      ],
  ];
  update_site_option('games', $games);
  update_site_option('platforms', [0 => 'Desktop', 1 => 'Mobile', 2 => 'XBOX', 3 => 'PlayStation']);
  update_site_option('game_modes', [1 => '1x1', 2 => '2x2', 3 => '3x3', 5 => '5x5', 7 => '7x7']);
  update_site_option('team_modes', [0 => null, 1 => __('Обычные', 'earena'), 2 => 'MyClub', 3 => 'UltimateTeam']);
  $ea_icons = [
      'game' => [
          0 => 'cs-go',
          1 => 'cs-16',
          2 => 'dota-2',
          3 => 'wot',
          4 => 'wc-3',
          5 => 'cod-wz',
          6 => 'pes-21',
          7 => 'fifa-21',
          8 => 'fifa-online-4',
          9 => 'lol',
          10 => 'sc-2',
          11 => 'cc-zh'
      ],
      'platform' => [0 => 'desktop', 1 => 'mobile', 2 => 'xbox', 3 => 'ps']
  ];
  update_site_option('ea_icons', $ea_icons);


  update_site_option('ea_admin_id', 27);
  update_site_option('ea_dollar_value', 80);
  update_site_option('ea_our_percent', 2);
  update_site_option('ea_ref_percent', 20);
  update_site_option('ea_min_match_price', 1);
  update_site_option('ea_min_withdraw', 50);
  //update_site_option( 'total_win', 0 );
?>
