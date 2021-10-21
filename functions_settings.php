<?php
  /* ==============================================
  ********  //Игры
  =============================================== */
  $games = [
      0 => [
          'key' => 0,
          'news-slug' => 'counter-strike-global-offensive',
          'name' => 'Counter Strike',
          'details' => 'Global Offensive',
          'shortname' => 'CS:GO',
          'id' => 'cs-go',
          'platforms' => [0],
          'game_modes' => [1, 2, 5],
          'team_modes' => [0],
          'rules_page' => get_page_link(5491)
      ],
      // 1 => [
      //     'key' => 1,
      //     'news-slug' => 'counter-strike-1-6',
      //     'name' => 'Counter Strike',
      //     'details' => 'Version 1.6',
      //     'shortname' => 'CS 1.6',
      //     'id' => 'cs-16',
      //     'platforms' => [0],
      //     'game_modes' => [1, 2, 5],
      //     'team_modes' => [0],
      //     'rules_page' => get_page_link(5502)
      // ],
      1 => [
          'key' => 1,
          'news-slug' => 'mortal-combat-11',
          'name' => 'Mortal Combat 11 Ultimate',
          'details' => 'Mortal Combat 11 Ultimate',
          'shortname' => 'Mortal Combat 11',
          'id' => 'mortal-combat-11',
          'platforms' => [0, 1, 2, 3],
          'game_modes' => [1],
          'team_modes' => [0],
          'rules_page' => get_page_link(5678)
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
      // 11 => [
      //     'key' => 11,
      //     'news-slug' => 'command-conquer-generals-zero-hour',
      //     'name' => 'Command & Conquer:',
      //     'details' => 'Generals — Zero Hour',
      //     'shortname' => 'Generals ZH',
      //     'id' => 'cc-zh',
      //     'platforms' => [0],
      //     'game_modes' => [1, 2, 3],
      //     'team_modes' => [0],
      //     'rules_page' => get_page_link(5513)
      // ],
      11 => [
        'key' => 11,
        'news-slug' => 'heroes-3',
        'name' => 'Heroes III',
        'details' => 'Heroes III',
        'shortname' => 'Heroes III',
        'id' => 'heroes-3',
        'platforms' => [0, 1],
        'game_modes' => [1, 2],
        'team_modes' => [0],
        'rules_page' => get_page_link(5664)
      ],
      12 => [
        'key' => 12,
        'news-slug' => 'playerunknowns-battlegrounds',
        'name' => 'Playerunknown\'s Battlegrounds',
        'details' => 'Playerunknown\'s Battlegrounds',
        'shortname' => 'PB',
        'id' => 'playerunknowns-battlegrounds',
        'platforms' => [0, 1],
        'game_modes' => [1, 2],
        'team_modes' => [0],
        'rules_page' => get_page_link(5667)
      ],
      13 => [
        'key' => 13,
        'news-slug' => 'heartstone',
        'name' => 'Heartstone',
        'details' => 'Heartstone',
        'shortname' => 'Heartstone',
        'id' => 'heartstone',
        'platforms' => [0, 1],
        'game_modes' => [1, 2, 5],
        'team_modes' => [0],
        'rules_page' => get_page_link(5672)
      ],
      14 => [
        'key' => 14,
        'news-slug' => 'tekken-7',
        'name' => 'TEKKEN 7',
        'details' => 'TEKKEN 7',
        'shortname' => 'TEKKEN 7',
        'id' => 'tekken-7',
        'platforms' => [0, 2, 3],
        'game_modes' => [1],
        'team_modes' => [0],
        'rules_page' => get_page_link(5674)
      ],
      15 => [
        'key' => 15,
        'news-slug' => 'world-of-tanks-blitz',
        'name' => 'World Of Tanks Blitz',
        'details' => 'World Of Tanks Blitz',
        'shortname' => 'World Of Tanks Blitz',
        'id' => 'world-of-tanks-blitz',
        'platforms' => [1],
        'game_modes' => [1, 3, 7],
        'team_modes' => [0],
        'rules_page' => get_page_link(5676)
      ],
  ];
  update_site_option('games', $games);
  update_site_option('platforms', [0 => 'Desktop', 1 => 'Mobile', 2 => 'XBOX', 3 => 'PlayStation']);
  update_site_option('game_modes', [1 => '1x1', 2 => '2x2', 3 => '3x3', 5 => '5x5', 7 => '7x7']);
  update_site_option('team_modes', [0 => null, 1 => __('Обычные', 'earena'), 2 => 'MyClub', 3 => 'UltimateTeam']);

  /* ==============================================
  ********  //Иконки
  =============================================== */
  $ea_icons = [
      'game' => [
          0 => 'cs-go',
          // 1 => 'cs-16',
          1 => 'mortal-combat-11',
          2 => 'dota-2',
          3 => 'wot',
          4 => 'wc-3',
          5 => 'cod-wz',
          6 => 'pes-21',
          7 => 'fifa-21',
          8 => 'fifa-online-4',
          9 => 'lol',
          10 => 'sc-2',
          // 11 => 'cc-zh'
          11 => 'heroes-3',
          12 => 'playerunknowns-battlegrounds',
          13 => 'heartstone',
          14 => 'tekken-7',
          15 => 'world-of-tanks-blitz'
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

  /* ==============================================
  ********  //Страны
  =============================================== */

  $countries = [
    1 => ['slug' => 'AF', 'name' => __('Afghanistan', 'earena_country')],
    2 => ['slug' => 'AX', 'name' => __('Aland Islands', 'earena_country')],
    3 => ['slug' => 'AL', 'name' => __('Albania', 'earena_country')],
    4 => ['slug' => 'DZ', 'name' => __('Algeria', 'earena_country')],
    5 => ['slug' => 'AS', 'name' => __('American Samoa', 'earena_country')],
    6 => ['slug' => 'AD', 'name' => __('Andorra', 'earena_country')],
    7 => ['slug' => 'AO', 'name' => __('Angola', 'earena_country')],
    8 => ['slug' => 'AI', 'name' => __('Anguilla', 'earena_country')],
    9 => ['slug' => 'AQ', 'name' => __('Antarctica', 'earena_country')],
    10 => ['slug' => 'AG', 'name' => __('Antigua and Barbuda', 'earena_country')],
    11 => ['slug' => 'AR', 'name' => __('Argentina', 'earena_country')],
    12 => ['slug' => 'AM', 'name' => __('Armenia', 'earena_country')],
    13 => ['slug' => 'AW', 'name' => __('Aruba', 'earena_country')],
    14 => ['slug' => 'AU', 'name' => __('Australia', 'earena_country')],
    15 => ['slug' => 'AT', 'name' => __('Austria', 'earena_country')],
    16 => ['slug' => 'AZ', 'name' => __('Azerbaijan', 'earena_country')],
    17 => ['slug' => 'BS', 'name' => __('Bahamas', 'earena_country')],
    18 => ['slug' => 'BH', 'name' => __('Bahrain', 'earena_country')],
    19 => ['slug' => 'BD', 'name' => __('Bangladesh', 'earena_country')],
    20 => ['slug' => 'BB', 'name' => __('Barbados', 'earena_country')],
    21 => ['slug' => 'BY', 'name' => __('Belarus', 'earena_country')],
    22 => ['slug' => 'BE', 'name' => __('Belgium', 'earena_country')],
    23 => ['slug' => 'BZ', 'name' => __('Belize', 'earena_country')],
    24 => ['slug' => 'BJ', 'name' => __('Benin', 'earena_country')],
    25 => ['slug' => 'BM', 'name' => __('Bermuda', 'earena_country')],
    26 => ['slug' => 'BT', 'name' => __('Bhutan', 'earena_country')],
    27 => ['slug' => 'BO', 'name' => __('Bolivia', 'earena_country')],
    28 => ['slug' => 'BQ', 'name' => __('Bonaire, Saint Eustatius and Saba', 'earena_country')],
    29 => ['slug' => 'BA', 'name' => __('Bosnia and Herzegovina', 'earena_country')],
    30 => ['slug' => 'BW', 'name' => __('Botswana', 'earena_country')],
    31 => ['slug' => 'BV', 'name' => __('Bouvet Island', 'earena_country')],
    32 => ['slug' => 'BR', 'name' => __('Brazil', 'earena_country')],
    33 => ['slug' => 'IO', 'name' => __('British Indian Ocean Territory', 'earena_country')],
    34 => ['slug' => 'VG', 'name' => __('British Virgin Islands', 'earena_country')],
    35 => ['slug' => 'BN', 'name' => __('Brunei', 'earena_country')],
    36 => ['slug' => 'BG', 'name' => __('Bulgaria', 'earena_country')],
    37 => ['slug' => 'BF', 'name' => __('Burkina Faso', 'earena_country')],
    38 => ['slug' => 'BI', 'name' => __('Burundi', 'earena_country')],
    39 => ['slug' => 'KH', 'name' => __('Cambodia', 'earena_country')],
    40 => ['slug' => 'CM', 'name' => __('Cameroon', 'earena_country')],
    41 => ['slug' => 'CA', 'name' => __('Canada', 'earena_country')],
    42 => ['slug' => 'CV', 'name' => __('Cape Verde', 'earena_country')],
    43 => ['slug' => 'KY', 'name' => __('Cayman Islands', 'earena_country')],
    44 => ['slug' => 'CF', 'name' => __('Central African Republic', 'earena_country')],
    45 => ['slug' => 'TD', 'name' => __('Chad', 'earena_country')],
    46 => ['slug' => 'CL', 'name' => __('Chile', 'earena_country')],
    47 => ['slug' => 'CN', 'name' => __('China', 'earena_country')],
    48 => ['slug' => 'CX', 'name' => __('Christmas Island', 'earena_country')],
    49 => ['slug' => 'CC', 'name' => __('Cocos Islands', 'earena_country')],
    50 => ['slug' => 'CO', 'name' => __('Colombia', 'earena_country')],
    51 => ['slug' => 'KM', 'name' => __('Comoros', 'earena_country')],
    52 => ['slug' => 'CK', 'name' => __('Cook Islands', 'earena_country')],
    53 => ['slug' => 'CR', 'name' => __('Costa Rica', 'earena_country')],
    54 => ['slug' => 'HR', 'name' => __('Croatia', 'earena_country')],
    55 => ['slug' => 'CU', 'name' => __('Cuba', 'earena_country')],
    56 => ['slug' => 'CW', 'name' => __('Curacao', 'earena_country')],
    57 => ['slug' => 'CY', 'name' => __('Cyprus', 'earena_country')],
    58 => ['slug' => 'CZ', 'name' => __('Czech Republic', 'earena_country')],
    59 => ['slug' => 'CD', 'name' => __('Democratic Republic of the Congo', 'earena_country')],
    60 => ['slug' => 'DK', 'name' => __('Denmark', 'earena_country')],
    61 => ['slug' => 'DJ', 'name' => __('Djibouti', 'earena_country')],
    62 => ['slug' => 'DM', 'name' => __('Dominica', 'earena_country')],
    63 => ['slug' => 'DO', 'name' => __('Dominican Republic', 'earena_country')],
    64 => ['slug' => 'EC', 'name' => __('Ecuador', 'earena_country')],
    65 => ['slug' => 'EG', 'name' => __('Egypt', 'earena_country')],
    66 => ['slug' => 'SV', 'name' => __('El Salvador', 'earena_country')],
    67 => ['slug' => 'GQ', 'name' => __('Equatorial Guinea', 'earena_country')],
    68 => ['slug' => 'ER', 'name' => __('Eritrea', 'earena_country')],
    69 => ['slug' => 'EE', 'name' => __('Estonia', 'earena_country')],
    70 => ['slug' => 'ET', 'name' => __('Ethiopia', 'earena_country')],
    71 => ['slug' => 'FK', 'name' => __('Falkland Islands', 'earena_country')],
    72 => ['slug' => 'FO', 'name' => __('Faroe Islands', 'earena_country')],
    73 => ['slug' => 'FJ', 'name' => __('Fiji', 'earena_country')],
    74 => ['slug' => 'FI', 'name' => __('Finland', 'earena_country')],
    75 => ['slug' => 'FR', 'name' => __('France', 'earena_country')],
    76 => ['slug' => 'GF', 'name' => __('French Guiana', 'earena_country')],
    77 => ['slug' => 'PF', 'name' => __('French Polynesia', 'earena_country')],
    78 => ['slug' => 'TF', 'name' => __('French Southern Territories', 'earena_country')],
    79 => ['slug' => 'GA', 'name' => __('Gabon', 'earena_country')],
    80 => ['slug' => 'GM', 'name' => __('Gambia', 'earena_country')],
    81 => ['slug' => 'GE', 'name' => __('Georgia', 'earena_country')],
    82 => ['slug' => 'DE', 'name' => __('Germany', 'earena_country')],
    83 => ['slug' => 'GH', 'name' => __('Ghana', 'earena_country')],
    84 => ['slug' => 'GI', 'name' => __('Gibraltar', 'earena_country')],
    85 => ['slug' => 'GR', 'name' => __('Greece', 'earena_country')],
    86 => ['slug' => 'GL', 'name' => __('Greenland', 'earena_country')],
    87 => ['slug' => 'GD', 'name' => __('Grenada', 'earena_country')],
    88 => ['slug' => 'GP', 'name' => __('Guadeloupe', 'earena_country')],
    89 => ['slug' => 'GU', 'name' => __('Guam', 'earena_country')],
    90 => ['slug' => 'GT', 'name' => __('Guatemala', 'earena_country')],
    91 => ['slug' => 'GG', 'name' => __('Guernsey', 'earena_country')],
    92 => ['slug' => 'GN', 'name' => __('Guinea', 'earena_country')],
    93 => ['slug' => 'GW', 'name' => __('Guinea-Bissau', 'earena_country')],
    94 => ['slug' => 'GY', 'name' => __('Guyana', 'earena_country')],
    95 => ['slug' => 'HT', 'name' => __('Haiti', 'earena_country')],
    96 => ['slug' => 'HM', 'name' => __('Heard Island and McDonald Islands', 'earena_country')],
    97 => ['slug' => 'HN', 'name' => __('Honduras', 'earena_country')],
    98 => ['slug' => 'HK', 'name' => __('Hong Kong', 'earena_country')],
    99 => ['slug' => 'HU', 'name' => __('Hungary', 'earena_country')],
    100 => ['slug' => 'IS', 'name' => __('Iceland', 'earena_country')],
    101 => ['slug' => 'IN', 'name' => __('India', 'earena_country')],
    102 => ['slug' => 'ID', 'name' => __('Indonesia', 'earena_country')],
    103 => ['slug' => 'IR', 'name' => __('Iran', 'earena_country')],
    104 => ['slug' => 'IQ', 'name' => __('Iraq', 'earena_country')],
    105 => ['slug' => 'IE', 'name' => __('Ireland', 'earena_country')],
    106 => ['slug' => 'IM', 'name' => __('Isle of Man', 'earena_country')],
    107 => ['slug' => 'IL', 'name' => __('Israel', 'earena_country')],
    108 => ['slug' => 'IT', 'name' => __('Italy', 'earena_country')],
    109 => ['slug' => 'CI', 'name' => __('Ivory Coast', 'earena_country')],
    110 => ['slug' => 'JM', 'name' => __('Jamaica', 'earena_country')],
    111 => ['slug' => 'JP', 'name' => __('Japan', 'earena_country')],
    112 => ['slug' => 'JE', 'name' => __('Jersey', 'earena_country')],
    113 => ['slug' => 'JO', 'name' => __('Jordan', 'earena_country')],
    114 => ['slug' => 'KZ', 'name' => __('Kazakhstan', 'earena_country')],
    115 => ['slug' => 'KE', 'name' => __('Kenya', 'earena_country')],
    116 => ['slug' => 'KI', 'name' => __('Kiribati', 'earena_country')],
    117 => ['slug' => 'XK', 'name' => __('Kosovo', 'earena_country')],
    118 => ['slug' => 'KW', 'name' => __('Kuwait', 'earena_country')],
    119 => ['slug' => 'KG', 'name' => __('Kyrgyzstan', 'earena_country')],
    120 => ['slug' => 'LA', 'name' => __('Laos', 'earena_country')],
    121 => ['slug' => 'LV', 'name' => __('Latvia', 'earena_country')],
    122 => ['slug' => 'LB', 'name' => __('Lebanon', 'earena_country')],
    123 => ['slug' => 'LS', 'name' => __('Lesotho', 'earena_country')],
    124 => ['slug' => 'LR', 'name' => __('Liberia', 'earena_country')],
    125 => ['slug' => 'LY', 'name' => __('Libya', 'earena_country')],
    126 => ['slug' => 'LI', 'name' => __('Liechtenstein', 'earena_country')],
    127 => ['slug' => 'LT', 'name' => __('Lithuania', 'earena_country')],
    128 => ['slug' => 'LU', 'name' => __('Luxembourg', 'earena_country')],
    129 => ['slug' => 'MO', 'name' => __('Macao', 'earena_country')],
    130 => ['slug' => 'MK', 'name' => __('Macedonia', 'earena_country')],
    131 => ['slug' => 'MG', 'name' => __('Madagascar', 'earena_country')],
    132 => ['slug' => 'MW', 'name' => __('Malawi', 'earena_country')],
    133 => ['slug' => 'MY', 'name' => __('Malaysia', 'earena_country')],
    134 => ['slug' => 'MV', 'name' => __('Maldives', 'earena_country')],
    135 => ['slug' => 'ML', 'name' => __('Mali', 'earena_country')],
    136 => ['slug' => 'MT', 'name' => __('Malta', 'earena_country')],
    137 => ['slug' => 'MH', 'name' => __('Marshall Islands', 'earena_country')],
    138 => ['slug' => 'MQ', 'name' => __('Martinique', 'earena_country')],
    139 => ['slug' => 'MR', 'name' => __('Mauritania', 'earena_country')],
    140 => ['slug' => 'MU', 'name' => __('Mauritius', 'earena_country')],
    141 => ['slug' => 'YT', 'name' => __('Mayotte', 'earena_country')],
    142 => ['slug' => 'MX', 'name' => __('Mexico', 'earena_country')],
    143 => ['slug' => 'FM', 'name' => __('Micronesia', 'earena_country')],
    144 => ['slug' => 'MD', 'name' => __('Moldova', 'earena_country')],
    145 => ['slug' => 'MC', 'name' => __('Monaco', 'earena_country')],
    146 => ['slug' => 'MN', 'name' => __('Mongolia', 'earena_country')],
    147 => ['slug' => 'ME', 'name' => __('Montenegro', 'earena_country')],
    148 => ['slug' => 'MS', 'name' => __('Montserrat', 'earena_country')],
    149 => ['slug' => 'MA', 'name' => __('Morocco', 'earena_country')],
    150 => ['slug' => 'MZ', 'name' => __('Mozambique', 'earena_country')],
    151 => ['slug' => 'MM', 'name' => __('Myanmar', 'earena_country')],
    152 => ['slug' => 'NA', 'name' => __('Namibia', 'earena_country')],
    153 => ['slug' => 'NR', 'name' => __('Nauru', 'earena_country')],
    154 => ['slug' => 'NP', 'name' => __('Nepal', 'earena_country')],
    155 => ['slug' => 'NL', 'name' => __('Netherlands', 'earena_country')],
    156 => ['slug' => 'AN', 'name' => __('Netherlands Antilles', 'earena_country')],
    157 => ['slug' => 'NC', 'name' => __('New Caledonia', 'earena_country')],
    158 => ['slug' => 'NZ', 'name' => __('New Zealand', 'earena_country')],
    159 => ['slug' => 'NI', 'name' => __('Nicaragua', 'earena_country')],
    160 => ['slug' => 'NE', 'name' => __('Niger', 'earena_country')],
    161 => ['slug' => 'NG', 'name' => __('Nigeria', 'earena_country')],
    162 => ['slug' => 'NU', 'name' => __('Niue', 'earena_country')],
    163 => ['slug' => 'NF', 'name' => __('Norfolk Island', 'earena_country')],
    164 => ['slug' => 'KP', 'name' => __('North Korea', 'earena_country')],
    165 => ['slug' => 'MP', 'name' => __('Northern Mariana Islands', 'earena_country')],
    166 => ['slug' => 'NO', 'name' => __('Norway', 'earena_country')],
    167 => ['slug' => 'OM', 'name' => __('Oman', 'earena_country')],
    168 => ['slug' => 'PK', 'name' => __('Pakistan', 'earena_country')],
    169 => ['slug' => 'PW', 'name' => __('Palau', 'earena_country')],
    170 => ['slug' => 'PS', 'name' => __('Palestinian Territory', 'earena_country')],
    171 => ['slug' => 'PA', 'name' => __('Panama', 'earena_country')],
    172 => ['slug' => 'PG', 'name' => __('Papua New Guinea', 'earena_country')],
    173 => ['slug' => 'PY', 'name' => __('Paraguay', 'earena_country')],
    174 => ['slug' => 'PE', 'name' => __('Peru', 'earena_country')],
    175 => ['slug' => 'PH', 'name' => __('Philippines', 'earena_country')],
    176 => ['slug' => 'PN', 'name' => __('Pitcairn', 'earena_country')],
    177 => ['slug' => 'PL', 'name' => __('Poland', 'earena_country')],
    178 => ['slug' => 'PT', 'name' => __('Portugal', 'earena_country')],
    179 => ['slug' => 'PR', 'name' => __('Puerto Rico', 'earena_country')],
    180 => ['slug' => 'QA', 'name' => __('Qatar', 'earena_country')],
    181 => ['slug' => 'CG', 'name' => __('Republic of the Congo', 'earena_country')],
    182 => ['slug' => 'RE', 'name' => __('Reunion', 'earena_country')],
    183 => ['slug' => 'RO', 'name' => __('Romania', 'earena_country')],
    184 => ['slug' => 'RU', 'name' => __('Russia', 'earena_country')],
    185 => ['slug' => 'RW', 'name' => __('Rwanda', 'earena_country')],
    186 => ['slug' => 'BL', 'name' => __('Saint Barthelemy', 'earena_country')],
    187 => ['slug' => 'SH', 'name' => __('Saint Helena', 'earena_country')],
    188 => ['slug' => 'KN', 'name' => __('Saint Kitts and Nevis', 'earena_country')],
    189 => ['slug' => 'LC', 'name' => __('Saint Lucia', 'earena_country')],
    190 => ['slug' => 'MF', 'name' => __('Saint Martin', 'earena_country')],
    191 => ['slug' => 'PM', 'name' => __('Saint Pierre and Miquelon', 'earena_country')],
    192 => ['slug' => 'VC', 'name' => __('Saint Vincent and the Grenadines', 'earena_country')],
    193 => ['slug' => 'WS', 'name' => __('Samoa', 'earena_country')],
    194 => ['slug' => 'SM', 'name' => __('San Marino', 'earena_country')],
    195 => ['slug' => 'ST', 'name' => __('Sao Tome and Principe', 'earena_country')],
    196 => ['slug' => 'SA', 'name' => __('Saudi Arabia', 'earena_country')],
    197 => ['slug' => 'SN', 'name' => __('Senegal', 'earena_country')],
    198 => ['slug' => 'RS', 'name' => __('Serbia', 'earena_country')],
    199 => ['slug' => 'SC', 'name' => __('Seychelles', 'earena_country')],
    200 => ['slug' => 'SL', 'name' => __('Sierra Leone', 'earena_country')],
    201 => ['slug' => 'SG', 'name' => __('Singapore', 'earena_country')],
    202 => ['slug' => 'SX', 'name' => __('Sint Maarten', 'earena_country')],
    203 => ['slug' => 'SK', 'name' => __('Slovakia', 'earena_country')],
    204 => ['slug' => 'SI', 'name' => __('Slovenia', 'earena_country')],
    205 => ['slug' => 'SB', 'name' => __('Solomon Islands', 'earena_country')],
    206 => ['slug' => 'SO', 'name' => __('Somalia', 'earena_country')],
    207 => ['slug' => 'ZA', 'name' => __('South Africa', 'earena_country')],
    208 => ['slug' => 'GS', 'name' => __('South Georgia and the South Sandwich Islands', 'earena_country')],
    209 => ['slug' => 'KR', 'name' => __('South Korea', 'earena_country')],
    210 => ['slug' => 'SS', 'name' => __('South Sudan', 'earena_country')],
    211 => ['slug' => 'ES', 'name' => __('Spain', 'earena_country')],
    212 => ['slug' => 'LK', 'name' => __('Sri Lanka', 'earena_country')],
    213 => ['slug' => 'SD', 'name' => __('Sudan', 'earena_country')],
    214 => ['slug' => 'SR', 'name' => __('Suriname', 'earena_country')],
    215 => ['slug' => 'SJ', 'name' => __('Svalbard and Jan Mayen', 'earena_country')],
    216 => ['slug' => 'SZ', 'name' => __('Swaziland', 'earena_country')],
    217 => ['slug' => 'SE', 'name' => __('Sweden', 'earena_country')],
    218 => ['slug' => 'CH', 'name' => __('Switzerland', 'earena_country')],
    219 => ['slug' => 'SY', 'name' => __('Syria', 'earena_country')],
    220 => ['slug' => 'TW', 'name' => __('Taiwan', 'earena_country')],
    221 => ['slug' => 'TJ', 'name' => __('Tajikistan', 'earena_country')],
    222 => ['slug' => 'TZ', 'name' => __('Tanzania', 'earena_country')],
    223 => ['slug' => 'TH', 'name' => __('Thailand', 'earena_country')],
    224 => ['slug' => 'TL', 'name' => __('Timor-Leste', 'earena_country')],
    225 => ['slug' => 'TG', 'name' => __('Togo', 'earena_country')],
    226 => ['slug' => 'TK', 'name' => __('Tokelau', 'earena_country')],
    227 => ['slug' => 'TO', 'name' => __('Tonga', 'earena_country')],
    228 => ['slug' => 'TT', 'name' => __('Trinidad and Tobago', 'earena_country')],
    229 => ['slug' => 'TN', 'name' => __('Tunisia', 'earena_country')],
    230 => ['slug' => 'TR', 'name' => __('Turkey', 'earena_country')],
    231 => ['slug' => 'TM', 'name' => __('Turkmenistan', 'earena_country')],
    232 => ['slug' => 'TC', 'name' => __('Turks and Caicos Islands', 'earena_country')],
    233 => ['slug' => 'TV', 'name' => __('Tuvalu', 'earena_country')],
    234 => ['slug' => 'VI', 'name' => __('U.S. Virgin Islands', 'earena_country')],
    235 => ['slug' => 'UG', 'name' => __('Uganda', 'earena_country')],
    236 => ['slug' => 'UA', 'name' => __('Ukraine', 'earena_country')],
    237 => ['slug' => 'AE', 'name' => __('United Arab Emirates', 'earena_country')],
    238 => ['slug' => 'GB', 'name' => __('United Kingdom', 'earena_country')],
    239 => ['slug' => 'US', 'name' => __('United States', 'earena_country')],
    240 => ['slug' => 'UM', 'name' => __('United States Minor Outlying Islands', 'earena_country')],
    241 => ['slug' => 'UY', 'name' => __('Uruguay', 'earena_country')],
    242 => ['slug' => 'UZ', 'name' => __('Uzbekistan', 'earena_country')],
    243 => ['slug' => 'VU', 'name' => __('Vanuatu', 'earena_country')],
    244 => ['slug' => 'VA', 'name' => __('Vatican', 'earena_country')],
    245 => ['slug' => 'VE', 'name' => __('Venezuela', 'earena_country')],
    246 => ['slug' => 'VN', 'name' => __('Vietnam', 'earena_country')],
    247 => ['slug' => 'WF', 'name' => __('Wallis and Futuna', 'earena_country')],
    248 => ['slug' => 'EH', 'name' => __('Western Sahara', 'earena_country')],
    249 => ['slug' => 'YE', 'name' => __('Yemen', 'earena_country')],
    250 => ['slug' => 'ZM', 'name' => __('Zambia', 'earena_country')],
    251 => ['slug' => 'ZW', 'name' => __('Zimbabwe', 'earena_country')],
  ];
  update_site_option('countries', $countries);
?>
