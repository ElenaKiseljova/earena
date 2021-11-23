<?php
/*
Template Name: Статистика пользователей - Маркетолог (админ)
*/

$users = count(get_users(array(
    'role' => 'customer',
    'fields' => 'ID',
)));
/*
global $wpdb;
$prefix = $wpdb->get_blog_prefix();
$quantity_vip = (int)$wpdb->get_var("SELECT COUNT(*) FROM {$prefix}woo_wallet_transactions WHERE type='debit' AND details LIKE 'Покупка VIP%';");

$profit_vip = round((float)$wpdb->get_var("SELECT sum(amount) FROM {$prefix}woo_wallet_transactions WHERE type='debit' AND details LIKE 'Покупка VIP%';"),
    2);
$profit_matches = round((float)$wpdb->get_var("SELECT sum(our_award) FROM {$prefix}earena_matches WHERE status > 100 AND bet > 0 AND our_award <> 0;"),
    2);
$profit_tournaments = round((float)$wpdb->get_var("SELECT sum(our_award) FROM {$prefix}earena_tournaments WHERE status > 100 AND prize > 0 AND our_award <> 0;"),
    2);

$profit_total = $profit_vip + $profit_matches + $profit_tournaments;
*/
?>

<?php get_header(); ?>
<script src="<?= get_template_directory_uri(); ?>/assets/libs/vue_v2.6.14.js"></script>

<script src="<?= get_template_directory_uri(); ?>/assets/libs/axios_0.18.0.min.js"></script>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?php the_title(  ); ?>
  </h1>
  <div class="page-main__wrapper page-main__wrapper--statistic" id="app_create_tournament">
      <a class="top-for-scroll" href="#top-for-scroll"></a>
      <div id="top-for-scroll">
          <div class="page-main__header page-main__header--statistic">
            <h2 v-if="!load" style="flex: 1"
                class="filter-heading-title"><?php _e('Игроки ', 'earena'); ?> <?= $users ?></h2>
            <div class="tabs tabs--statistic">
              <a @click.prevent="activeTab=1" :class="{'active':activeTab===1}" class="tabs__button tabs__button--statistic">
                <?php _e('Общая', 'earena'); ?>
              </a>
              <a href="<?php echo get_page_link(6304); ?>" :class="{'active':activeTab===2}" class="tabs__button tabs__button--statistic">
                <?php _e('Финансовая', 'earena'); ?>
              </a>
            </div>
          </div>

          <div class="form_filter--wrapper" :class="{'stop' : load}">
              <form id="matches-filter" class="filters">
                  <div class="row">
                      <div class="col-lg-3 col-md-4 col-sm-12">
                          <div class="d-flex nick-search-wrapper">
                              <label for="match-id">
                                  <input @change="nickname"
                                         @input="nickname"
                                         id="player"
                                         v-model="formData.nickname"
                                         type="text"
                                         class="input-search-id"
                                         placeholder="<?php _e('Никнейм игрока', 'earena'); ?>">
                              </label>
                              <div style="cursor: pointer;display: flex;flex-direction: column;justify-content: center;margin-left: -20px;"
                                   @click="clearNickname" v-if="formData.nickname !== ''">
                                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                      <path d="M9.99996 18.3334C14.6023 18.3334 18.3333 14.6024 18.3333 10C18.3333 5.39765 14.6023 1.66669 9.99996 1.66669C5.39759 1.66669 1.66663 5.39765 1.66663 10C1.66663 14.6024 5.39759 18.3334 9.99996 18.3334Z"
                                            fill="#CACACA"/>
                                      <path d="M12.5 7.5L7.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                      <path d="M7.5 7.5L12.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                  </svg>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-12">
                          <select @change="changeForm" v-model="formData.country" name="country" id="country"
                                  placeholder="Country"
                                  class="blank">
                              <option value="" selected="selected"><?php _e('Страна', 'earena'); ?></option>
                              <option value="AF"><?php _e('Afghanistan', 'earena_country'); ?></option>
                              <option value="AX"><?php _e('Aland Islands', 'earena_country'); ?></option>
                              <option value="AL"><?php _e('Albania', 'earena_country'); ?></option>
                              <option value="DZ"><?php _e('Algeria', 'earena_country'); ?></option>
                              <option value="AS"><?php _e('American Samoa', 'earena_country'); ?></option>
                              <option value="AD"><?php _e('Andorra', 'earena_country'); ?></option>
                              <option value="AO"><?php _e('Angola', 'earena_country'); ?></option>
                              <option value="AI"><?php _e('Anguilla', 'earena_country'); ?></option>
                              <option value="AQ"><?php _e('Antarctica', 'earena_country'); ?></option>
                              <option value="AG"><?php _e('Antigua and Barbuda', 'earena_country'); ?></option>
                              <option value="AR"><?php _e('Argentina', 'earena_country'); ?></option>
                              <option value="AM"><?php _e('Armenia', 'earena_country'); ?></option>
                              <option value="AW"><?php _e('Aruba', 'earena_country'); ?></option>
                              <option value="AU"><?php _e('Australia', 'earena_country'); ?></option>
                              <option value="AT"><?php _e('Austria', 'earena_country'); ?></option>
                              <option value="AZ"><?php _e('Azerbaijan', 'earena_country'); ?></option>
                              <option value="BS"><?php _e('Bahamas', 'earena_country'); ?></option>
                              <option value="BH"><?php _e('Bahrain', 'earena_country'); ?></option>
                              <option value="BD"><?php _e('Bangladesh', 'earena_country'); ?></option>
                              <option value="BB"><?php _e('Barbados', 'earena_country'); ?></option>
                              <option value="BY"><?php _e('Belarus', 'earena_country'); ?></option>
                              <option value="BE"><?php _e('Belgium', 'earena_country'); ?></option>
                              <option value="BZ"><?php _e('Belize', 'earena_country'); ?></option>
                              <option value="BJ"><?php _e('Benin', 'earena_country'); ?></option>
                              <option value="BM"><?php _e('Bermuda', 'earena_country'); ?></option>
                              <option value="BT"><?php _e('Bhutan', 'earena_country'); ?></option>
                              <option value="BO"><?php _e('Bolivia', 'earena_country'); ?></option>
                              <option value="BQ"><?php _e('Bonaire, Saint Eustatius and Saba',
                                      'earena_country'); ?></option>
                              <option value="BA"><?php _e('Bosnia and Herzegovina', 'earena_country'); ?></option>
                              <option value="BW"><?php _e('Botswana', 'earena_country'); ?></option>
                              <option value="BV"><?php _e('Bouvet Island', 'earena_country'); ?></option>
                              <option value="BR"><?php _e('Brazil', 'earena_country'); ?></option>
                              <option value="IO"><?php _e('British Indian Ocean Territory', 'earena_country'); ?></option>
                              <option value="VG"><?php _e('British Virgin Islands', 'earena_country'); ?></option>
                              <option value="BN"><?php _e('Brunei', 'earena_country'); ?></option>
                              <option value="BG"><?php _e('Bulgaria', 'earena_country'); ?></option>
                              <option value="BF"><?php _e('Burkina Faso', 'earena_country'); ?></option>
                              <option value="BI"><?php _e('Burundi', 'earena_country'); ?></option>
                              <option value="KH"><?php _e('Cambodia', 'earena_country'); ?></option>
                              <option value="CM"><?php _e('Cameroon', 'earena_country'); ?></option>
                              <option value="CA"><?php _e('Canada', 'earena_country'); ?></option>
                              <option value="CV"><?php _e('Cape Verde', 'earena_country'); ?></option>
                              <option value="KY"><?php _e('Cayman Islands', 'earena_country'); ?></option>
                              <option value="CF"><?php _e('Central African Republic', 'earena_country'); ?></option>
                              <option value="TD"><?php _e('Chad', 'earena_country'); ?></option>
                              <option value="CL"><?php _e('Chile', 'earena_country'); ?></option>
                              <option value="CN"><?php _e('China', 'earena_country'); ?></option>
                              <option value="CX"><?php _e('Christmas Island', 'earena_country'); ?></option>
                              <option value="CC"><?php _e('Cocos Islands', 'earena_country'); ?></option>
                              <option value="CO"><?php _e('Colombia', 'earena_country'); ?></option>
                              <option value="KM"><?php _e('Comoros', 'earena_country'); ?></option>
                              <option value="CK"><?php _e('Cook Islands', 'earena_country'); ?></option>
                              <option value="CR"><?php _e('Costa Rica', 'earena_country'); ?></option>
                              <option value="HR"><?php _e('Croatia', 'earena_country'); ?></option>
                              <option value="CU"><?php _e('Cuba', 'earena_country'); ?></option>
                              <option value="CW"><?php _e('Curacao', 'earena_country'); ?></option>
                              <option value="CY"><?php _e('Cyprus', 'earena_country'); ?></option>
                              <option value="CZ"><?php _e('Czech Republic', 'earena_country'); ?></option>
                              <option value="CD"><?php _e('Democratic Republic of the Congo',
                                      'earena_country'); ?></option>
                              <option value="DK"><?php _e('Denmark', 'earena_country'); ?></option>
                              <option value="DJ"><?php _e('Djibouti', 'earena_country'); ?></option>
                              <option value="DM"><?php _e('Dominica', 'earena_country'); ?></option>
                              <option value="DO"><?php _e('Dominican Republic', 'earena_country'); ?></option>
                              <option value="EC"><?php _e('Ecuador', 'earena_country'); ?></option>
                              <option value="EG"><?php _e('Egypt', 'earena_country'); ?></option>
                              <option value="SV"><?php _e('El Salvador', 'earena_country'); ?></option>
                              <option value="GQ"><?php _e('Equatorial Guinea', 'earena_country'); ?></option>
                              <option value="ER"><?php _e('Eritrea', 'earena_country'); ?></option>
                              <option value="EE"><?php _e('Estonia', 'earena_country'); ?></option>
                              <option value="ET"><?php _e('Ethiopia', 'earena_country'); ?></option>
                              <option value="FK"><?php _e('Falkland Islands', 'earena_country'); ?></option>
                              <option value="FO"><?php _e('Faroe Islands', 'earena_country'); ?></option>
                              <option value="FJ"><?php _e('Fiji', 'earena_country'); ?></option>
                              <option value="FI"><?php _e('Finland', 'earena_country'); ?></option>
                              <option value="FR"><?php _e('France', 'earena_country'); ?></option>
                              <option value="GF"><?php _e('French Guiana', 'earena_country'); ?></option>
                              <option value="PF"><?php _e('French Polynesia', 'earena_country'); ?></option>
                              <option value="TF"><?php _e('French Southern Territories', 'earena_country'); ?></option>
                              <option value="GA"><?php _e('Gabon', 'earena_country'); ?></option>
                              <option value="GM"><?php _e('Gambia', 'earena_country'); ?></option>
                              <option value="GE"><?php _e('Georgia', 'earena_country'); ?></option>
                              <option value="DE"><?php _e('Germany', 'earena_country'); ?></option>
                              <option value="GH"><?php _e('Ghana', 'earena_country'); ?></option>
                              <option value="GI"><?php _e('Gibraltar', 'earena_country'); ?></option>
                              <option value="GR"><?php _e('Greece', 'earena_country'); ?></option>
                              <option value="GL"><?php _e('Greenland', 'earena_country'); ?></option>
                              <option value="GD"><?php _e('Grenada', 'earena_country'); ?></option>
                              <option value="GP"><?php _e('Guadeloupe', 'earena_country'); ?></option>
                              <option value="GU"><?php _e('Guam', 'earena_country'); ?></option>
                              <option value="GT"><?php _e('Guatemala', 'earena_country'); ?></option>
                              <option value="GG"><?php _e('Guernsey', 'earena_country'); ?></option>
                              <option value="GN"><?php _e('Guinea', 'earena_country'); ?></option>
                              <option value="GW"><?php _e('Guinea-Bissau', 'earena_country'); ?></option>
                              <option value="GY"><?php _e('Guyana', 'earena_country'); ?></option>
                              <option value="HT"><?php _e('Haiti', 'earena_country'); ?></option>
                              <option value="HM"><?php _e('Heard Island and McDonald Islands',
                                      'earena_country'); ?></option>
                              <option value="HN"><?php _e('Honduras', 'earena_country'); ?></option>
                              <option value="HK"><?php _e('Hong Kong', 'earena_country'); ?></option>
                              <option value="HU"><?php _e('Hungary', 'earena_country'); ?></option>
                              <option value="IS"><?php _e('Iceland', 'earena_country'); ?></option>
                              <option value="IN"><?php _e('India', 'earena_country'); ?></option>
                              <option value="ID"><?php _e('Indonesia', 'earena_country'); ?></option>
                              <option value="IR"><?php _e('Iran', 'earena_country'); ?></option>
                              <option value="IQ"><?php _e('Iraq', 'earena_country'); ?></option>
                              <option value="IE"><?php _e('Ireland', 'earena_country'); ?></option>
                              <option value="IM"><?php _e('Isle of Man', 'earena_country'); ?></option>
                              <option value="IL"><?php _e('Israel', 'earena_country'); ?></option>
                              <option value="IT"><?php _e('Italy', 'earena_country'); ?></option>
                              <option value="CI"><?php _e('Ivory Coast', 'earena_country'); ?></option>
                              <option value="JM"><?php _e('Jamaica', 'earena_country'); ?></option>
                              <option value="JP"><?php _e('Japan', 'earena_country'); ?></option>
                              <option value="JE"><?php _e('Jersey', 'earena_country'); ?></option>
                              <option value="JO"><?php _e('Jordan', 'earena_country'); ?></option>
                              <option value="KZ"><?php _e('Kazakhstan', 'earena_country'); ?></option>
                              <option value="KE"><?php _e('Kenya', 'earena_country'); ?></option>
                              <option value="KI"><?php _e('Kiribati', 'earena_country'); ?></option>
                              <option value="XK"><?php _e('Kosovo', 'earena_country'); ?></option>
                              <option value="KW"><?php _e('Kuwait', 'earena_country'); ?></option>
                              <option value="KG"><?php _e('Kyrgyzstan', 'earena_country'); ?></option>
                              <option value="LA"><?php _e('Laos', 'earena_country'); ?></option>
                              <option value="LV"><?php _e('Latvia', 'earena_country'); ?></option>
                              <option value="LB"><?php _e('Lebanon', 'earena_country'); ?></option>
                              <option value="LS"><?php _e('Lesotho', 'earena_country'); ?></option>
                              <option value="LR"><?php _e('Liberia', 'earena_country'); ?></option>
                              <option value="LY"><?php _e('Libya', 'earena_country'); ?></option>
                              <option value="LI"><?php _e('Liechtenstein', 'earena_country'); ?></option>
                              <option value="LT"><?php _e('Lithuania', 'earena_country'); ?></option>
                              <option value="LU"><?php _e('Luxembourg', 'earena_country'); ?></option>
                              <option value="MO"><?php _e('Macao', 'earena_country'); ?></option>
                              <option value="MK"><?php _e('Macedonia', 'earena_country'); ?></option>
                              <option value="MG"><?php _e('Madagascar', 'earena_country'); ?></option>
                              <option value="MW"><?php _e('Malawi', 'earena_country'); ?></option>
                              <option value="MY"><?php _e('Malaysia', 'earena_country'); ?></option>
                              <option value="MV"><?php _e('Maldives', 'earena_country'); ?></option>
                              <option value="ML"><?php _e('Mali', 'earena_country'); ?></option>
                              <option value="MT"><?php _e('Malta', 'earena_country'); ?></option>
                              <option value="MH"><?php _e('Marshall Islands', 'earena_country'); ?></option>
                              <option value="MQ"><?php _e('Martinique', 'earena_country'); ?></option>
                              <option value="MR"><?php _e('Mauritania', 'earena_country'); ?></option>
                              <option value="MU"><?php _e('Mauritius', 'earena_country'); ?></option>
                              <option value="YT"><?php _e('Mayotte', 'earena_country'); ?></option>
                              <option value="MX"><?php _e('Mexico', 'earena_country'); ?></option>
                              <option value="FM"><?php _e('Micronesia', 'earena_country'); ?></option>
                              <option value="MD"><?php _e('Moldova', 'earena_country'); ?></option>
                              <option value="MC"><?php _e('Monaco', 'earena_country'); ?></option>
                              <option value="MN"><?php _e('Mongolia', 'earena_country'); ?></option>
                              <option value="ME"><?php _e('Montenegro', 'earena_country'); ?></option>
                              <option value="MS"><?php _e('Montserrat', 'earena_country'); ?></option>
                              <option value="MA"><?php _e('Morocco', 'earena_country'); ?></option>
                              <option value="MZ"><?php _e('Mozambique', 'earena_country'); ?></option>
                              <option value="MM"><?php _e('Myanmar', 'earena_country'); ?></option>
                              <option value="NA"><?php _e('Namibia', 'earena_country'); ?></option>
                              <option value="NR"><?php _e('Nauru', 'earena_country'); ?></option>
                              <option value="NP"><?php _e('Nepal', 'earena_country'); ?></option>
                              <option value="NL"><?php _e('Netherlands', 'earena_country'); ?></option>
                              <option value="AN"><?php _e('Netherlands Antilles', 'earena_country'); ?></option>
                              <option value="NC"><?php _e('New Caledonia', 'earena_country'); ?></option>
                              <option value="NZ"><?php _e('New Zealand', 'earena_country'); ?></option>
                              <option value="NI"><?php _e('Nicaragua', 'earena_country'); ?></option>
                              <option value="NE"><?php _e('Niger', 'earena_country'); ?></option>
                              <option value="NG"><?php _e('Nigeria', 'earena_country'); ?></option>
                              <option value="NU"><?php _e('Niue', 'earena_country'); ?></option>
                              <option value="NF"><?php _e('Norfolk Island', 'earena_country'); ?></option>
                              <option value="KP"><?php _e('North Korea', 'earena_country'); ?></option>
                              <option value="MP"><?php _e('Northern Mariana Islands', 'earena_country'); ?></option>
                              <option value="NO"><?php _e('Norway', 'earena_country'); ?></option>
                              <option value="OM"><?php _e('Oman', 'earena_country'); ?></option>
                              <option value="PK"><?php _e('Pakistan', 'earena_country'); ?></option>
                              <option value="PW"><?php _e('Palau', 'earena_country'); ?></option>
                              <option value="PS"><?php _e('Palestinian Territory', 'earena_country'); ?></option>
                              <option value="PA"><?php _e('Panama', 'earena_country'); ?></option>
                              <option value="PG"><?php _e('Papua New Guinea', 'earena_country'); ?></option>
                              <option value="PY"><?php _e('Paraguay', 'earena_country'); ?></option>
                              <option value="PE"><?php _e('Peru', 'earena_country'); ?></option>
                              <option value="PH"><?php _e('Philippines', 'earena_country'); ?></option>
                              <option value="PN"><?php _e('Pitcairn', 'earena_country'); ?></option>
                              <option value="PL"><?php _e('Poland', 'earena_country'); ?></option>
                              <option value="PT"><?php _e('Portugal', 'earena_country'); ?></option>
                              <option value="PR"><?php _e('Puerto Rico', 'earena_country'); ?></option>
                              <option value="QA"><?php _e('Qatar', 'earena_country'); ?></option>
                              <option value="CG"><?php _e('Republic of the Congo', 'earena_country'); ?></option>
                              <option value="RE"><?php _e('Reunion', 'earena_country'); ?></option>
                              <option value="RO"><?php _e('Romania', 'earena_country'); ?></option>
                              <option value="RU"><?php _e('Russia', 'earena_country'); ?></option>
                              <option value="RW"><?php _e('Rwanda', 'earena_country'); ?></option>
                              <option value="BL"><?php _e('Saint Barthelemy', 'earena_country'); ?></option>
                              <option value="SH"><?php _e('Saint Helena', 'earena_country'); ?></option>
                              <option value="KN"><?php _e('Saint Kitts and Nevis', 'earena_country'); ?></option>
                              <option value="LC"><?php _e('Saint Lucia', 'earena_country'); ?></option>
                              <option value="MF"><?php _e('Saint Martin', 'earena_country'); ?></option>
                              <option value="PM"><?php _e('Saint Pierre and Miquelon', 'earena_country'); ?></option>
                              <option value="VC"><?php _e('Saint Vincent and the Grenadines',
                                      'earena_country'); ?></option>
                              <option value="WS"><?php _e('Samoa', 'earena_country'); ?></option>
                              <option value="SM"><?php _e('San Marino', 'earena_country'); ?></option>
                              <option value="ST"><?php _e('Sao Tome and Principe', 'earena_country'); ?></option>
                              <option value="SA"><?php _e('Saudi Arabia', 'earena_country'); ?></option>
                              <option value="SN"><?php _e('Senegal', 'earena_country'); ?></option>
                              <option value="RS"><?php _e('Serbia', 'earena_country'); ?></option>
                              <option value="SC"><?php _e('Seychelles', 'earena_country'); ?></option>
                              <option value="SL"><?php _e('Sierra Leone', 'earena_country'); ?></option>
                              <option value="SG"><?php _e('Singapore', 'earena_country'); ?></option>
                              <option value="SX"><?php _e('Sint Maarten', 'earena_country'); ?></option>
                              <option value="SK"><?php _e('Slovakia', 'earena_country'); ?></option>
                              <option value="SI"><?php _e('Slovenia', 'earena_country'); ?></option>
                              <option value="SB"><?php _e('Solomon Islands', 'earena_country'); ?></option>
                              <option value="SO"><?php _e('Somalia', 'earena_country'); ?></option>
                              <option value="ZA"><?php _e('South Africa', 'earena_country'); ?></option>
                              <option value="GS"><?php _e('South Georgia and the South Sandwich Islands',
                                      'earena_country'); ?></option>
                              <option value="KR"><?php _e('South Korea', 'earena_country'); ?></option>
                              <option value="SS"><?php _e('South Sudan', 'earena_country'); ?></option>
                              <option value="ES"><?php _e('Spain', 'earena_country'); ?></option>
                              <option value="LK"><?php _e('Sri Lanka', 'earena_country'); ?></option>
                              <option value="SD"><?php _e('Sudan', 'earena_country'); ?></option>
                              <option value="SR"><?php _e('Suriname', 'earena_country'); ?></option>
                              <option value="SJ"><?php _e('Svalbard and Jan Mayen', 'earena_country'); ?></option>
                              <option value="SZ"><?php _e('Swaziland', 'earena_country'); ?></option>
                              <option value="SE"><?php _e('Sweden', 'earena_country'); ?></option>
                              <option value="CH"><?php _e('Switzerland', 'earena_country'); ?></option>
                              <option value="SY"><?php _e('Syria', 'earena_country'); ?></option>
                              <option value="TW"><?php _e('Taiwan', 'earena_country'); ?></option>
                              <option value="TJ"><?php _e('Tajikistan', 'earena_country'); ?></option>
                              <option value="TZ"><?php _e('Tanzania', 'earena_country'); ?></option>
                              <option value="TH"><?php _e('Thailand', 'earena_country'); ?></option>
                              <option value="TL"><?php _e('Timor-Leste', 'earena_country'); ?></option>
                              <option value="TG"><?php _e('Togo', 'earena_country'); ?></option>
                              <option value="TK"><?php _e('Tokelau', 'earena_country'); ?></option>
                              <option value="TO"><?php _e('Tonga', 'earena_country'); ?></option>
                              <option value="TT"><?php _e('Trinidad and Tobago', 'earena_country'); ?></option>
                              <option value="TN"><?php _e('Tunisia', 'earena_country'); ?></option>
                              <option value="TR"><?php _e('Turkey', 'earena_country'); ?></option>
                              <option value="TM"><?php _e('Turkmenistan', 'earena_country'); ?></option>
                              <option value="TC"><?php _e('Turks and Caicos Islands', 'earena_country'); ?></option>
                              <option value="TV"><?php _e('Tuvalu', 'earena_country'); ?></option>
                              <option value="VI"><?php _e('U.S. Virgin Islands', 'earena_country'); ?></option>
                              <option value="UG"><?php _e('Uganda', 'earena_country'); ?></option>
                              <option value="UA"><?php _e('Ukraine', 'earena_country'); ?></option>
                              <option value="AE"><?php _e('United Arab Emirates', 'earena_country'); ?></option>
                              <option value="GB"><?php _e('United Kingdom', 'earena_country'); ?></option>
                              <option value="US"><?php _e('United States', 'earena_country'); ?></option>
                              <option value="UM"><?php _e('United States Minor Outlying Islands',
                                      'earena_country'); ?></option>
                              <option value="UY"><?php _e('Uruguay', 'earena_country'); ?></option>
                              <option value="UZ"><?php _e('Uzbekistan', 'earena_country'); ?></option>
                              <option value="VU"><?php _e('Vanuatu', 'earena_country'); ?></option>
                              <option value="VA"><?php _e('Vatican', 'earena_country'); ?></option>
                              <option value="VE"><?php _e('Venezuela', 'earena_country'); ?></option>
                              <option value="VN"><?php _e('Vietnam', 'earena_country'); ?></option>
                              <option value="WF"><?php _e('Wallis and Futuna', 'earena_country'); ?></option>
                              <option value="EH"><?php _e('Western Sahara', 'earena_country'); ?></option>
                              <option value="YE"><?php _e('Yemen', 'earena_country'); ?></option>
                              <option value="ZM"><?php _e('Zambia', 'earena_country'); ?></option>
                              <option value="ZW"><?php _e('Zimbabwe', 'earena_country'); ?></option>
                          </select>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-12">
                          <label class="box_ckeck check_tour" style="margin-top: 15px">
                              <input @change="changeForm" type="checkbox" class="game1" name="online"
                                     required="required"
                                     v-model="formData.online">
                              <span class="checkmark"></span>
                              <?php _e('Игроки онлайн', 'earena'); ?>
                          </label>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-12" v-if="total">
                          <label class="box_ckeck check_tour" style="margin-top: 15px">
                              <?php _e('Пользователей', 'earena'); ?> : {{total}}
                          </label>
                      </div>
                  </div>
                  <div class="row" style="padding-top: 20px">
                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12"><?php _e('На счету', 'earena'); ?>
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.balance.from"
                                         style="padding: 10px 5px"
                                         class="center"
                                         name="balance_from" type="number"
                                         placeholder="<?php _e('От', 'earena'); ?>"/>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.balance.to"
                                         style="padding: 10px 5px"
                                         class="center"
                                         name="balance_to" type="number"
                                         placeholder="<?php _e('До', 'earena'); ?>"/>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12"><?php _e('Ввел', 'earena'); ?>
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.balance_add.from"
                                         style="padding: 10px 5px"
                                         class="center"
                                         name="balance_add_from" type="number"
                                         placeholder="<?php _e('От', 'earena'); ?>"/>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.balance_add.to"
                                         style="padding: 10px 5px"
                                         class="center"
                                         name="balance_add_to" type="number"
                                         placeholder="<?php _e('До', 'earena'); ?>"/>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12"><?php _e('Вывел', 'earena'); ?>
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.balance_withdraw.from"
                                         style="padding: 10px 5px" class="center"
                                         name="balance_withdraw_from" type="number"
                                         placeholder="<?php _e('От', 'earena'); ?>"/>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.balance_withdraw.to"
                                         style="padding: 10px 5px" class="center"
                                         name="balance_withdraw_to" type="number"
                                         placeholder="<?php _e('До', 'earena'); ?>"/>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?php _e('Дата регистрации', 'earena'); ?>
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.user_registered.from"
                                         type="date" name="start_reg"
                                         style="padding: 10px 5px">
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.user_registered.to"
                                         type="date" name="end_reg"
                                         style="padding: 10px 5px">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12"><?php _e('Последний визит', 'earena'); ?>
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.last_activity.from"
                                         type="date"
                                         name="start_visited"
                                         style="padding: 10px 5px">
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.last_activity.to"
                                         type="date"
                                         name="end_visited"
                                         style="padding: 10px 5px">
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row" style="justify-content: end;display: flex;">
                      <div @click="reset" class="reset" style="margin-right: 15px; font-weight: bold;">

                          <?php _e('Сбросить', 'earena'); ?>
                      </div>
                  </div>
              </form>
          </div>

          <div class="table-responsive">
              <table class="table table--statistic table-rezult">
                  <thead>
                  <tr>
                      <th @click="sortBy(0)" :clasbalances=" sort === 0 ? orderBy : ''"><?php _e('Страна',
                              'earena'); ?></th>
                      <th @click="sortBy(1)" :class=" sort === 1 ? orderBy : ''"><?php _e('Никнейм',
                              'earena'); ?></th>
                      <th @click="sortBy(2)" :class=" sort === 2 ? orderBy : ''"><?php _e('На счету',
                              'earena'); ?></th>
                      <th @click="sortBy(3)" :class=" sort === 3 ? orderBy : ''"><?php _e('В игре',
                              'earena'); ?></th>
                      <th @click="sortBy(4)" :class=" sort === 4 ? orderBy : ''"><?php _e('Ввел',
                              'earena'); ?></th>
                      <th @click="sortBy(5)" :class=" sort === 5 ? orderBy : ''"><?php _e('Вывел',
                              'earena'); ?></th>
                      <th @click="sortBy(6)" :class=" sort === 6 ? orderBy : ''"><?php _e('Рейтинг',
                              'earena'); ?></th>
                      <th @click="sortBy(7)" :class=" sort === 7 ? orderBy : ''"><?php _e('Дата регистрации',
                              'earena'); ?></th>
                      <th @click="sortBy(8)" :class=" sort === 8 ? orderBy : ''"><?php _e('Последний визит',
                              'earena'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr class="display: none"></tr>

                  <tr v-key="item.ID" v-for="(item, index) in users">
                      <td>
                          <img class="wpml-ls-flag" :src="gelFlag(item.country)"
                               alt="" width="30" height="30">
                      </td>
                      <td style="text-align: start"><a :href="'<?= home_url('/') ?>user/'+item.ID">{{item.nickname}}</a>
                      </td>
                      <td>{{item.balance}}</td>
                      <td>{{item.money_in_game}}</td>
                      <td>{{item.balance_add}}</td>
                      <td>{{item.balance_withdraw}}</td>
                      <td>{{item.rating}}</td>
                      <td>{{item.registered}}</td>
                      <td style="text-align: start" v-if="item.online"><span
                                  style="color: #00D115; font-size: 65px; line-height: 36px;">·</span></td>
                      <td v-if="!item.online">{{item.last_activity }}</td>
                  </tr>
                  </tbody>
              </table>
          </div>
      </div>
      <div id="isInViewPort">
          <div v-if="load" id="loading-indicator" style="width: 60px; height: 60px;" role="progressbar"
               class="MuiCircularProgress-root MuiCircularProgress-colorPrimary MuiCircularProgress-indeterminate">
              <svg viewBox="22 22 44 44" class="MuiCircularProgress-svg">
                  <circle cx="44" cy="44" r="20.2" fill="none" stroke-width="3.6"
                          class="MuiCircularProgress-circle MuiCircularProgress-circleIndeterminate"></circle>
              </svg>
          </div>
      </div>
  </div>
</main>

<script>
    const app_create_tournament = new Vue({
        el: '#app_create_tournament',
        data: {
            activeTab: 1,
            load: false,
            sort: false,
            page: 1,
            total: 0,
            orderBy: false,
            users: [],
            formData: {
                nickname: '',
                country: '',
                online: '',
                verification: '',
                blocked: '',
                yellow_card_1: '',
                yellow_card_2: '',
                vip: '',
                type: 0,
                balance: {},
                balance_add: {},
                balance_withdraw: {},
                user_registered: {},
                last_activity: {},
            },
            ddflag: {
                0: false,
                1: false,
                2: false,
                3: false,
            },
            playerCount: 0,
            testCount: 0,
            timeout: null,
            hasPages: true,
        },
        methods: {
            reset() {
                this.formData = {
                    nickname: '',
                    country: '',
                    online: '',
                    verification: '',
                    blocked: '',
                    yellow_card_1: '',
                    yellow_card_2: '',
                    vip: '',
                    type: 0,
                    balance: {},
                    balance_add: {},
                    balance_withdraw: {},
                    user_registered: {},
                    last_activity: {},
                }
                this.ajaxSend()
            },
            sortBy(i) {
                if (i === this.sort) {
                    this.orderBy = this.orderBy === 'ASC' ? 'DESC' : 'ASC'
                } else {
                    this.sort = i
                }
                this.ajaxSend()
            },
            gelFlag(id) {
                return '<?= get_template_directory_uri(); ?>/assets/img/flags/flag-' + id + '.svg'
            },
            clearNickname() {
                this.formData.nickname = ''
                this.changeForm()
            },
            nickname() {
                if (this.formData.nickname.length < 3) {
                    return false
                }
                this.changeForm()
            },
            changeForm(e) {
                if (this.load) {
                    e.preventDefault()
                    e.stopPropagation()
                }
                this.ddflag[0] = false
                this.page = 1
                this.hasPages = true
                this.ajaxSend()
            },
            loadMore() {
                if (!this.hasPages || this.load) {
                    return false
                }
                this.page = this.page + 1
                this.ajaxSend()
            },
            ajaxSend() {
                if (this.load) {
                    return false
                }
                this.load = true
                const form_data = new FormData()
                form_data.append('action', 'getStatisticMarketing')
                form_data.append('page', this.page)
                form_data.append('orderby', this.sort)
                form_data.append('order', this.orderBy)
                for (let prop in this.formData) {
                    form_data.append(prop, this.formData[prop])
                }
                form_data.append('balancefrom', this.formData.balance.from)
                form_data.append('balanceto', this.formData.balance.to)
                form_data.append('balance_addfrom', this.formData.balance_add.from)
                form_data.append('balance_addto', this.formData.balance_add.to)
                form_data.append('balance_withdrawfrom', this.formData.balance_withdraw.from)
                form_data.append('balance_withdrawto', this.formData.balance_withdraw.to)
                form_data.append('user_registeredfrom', this.formData.user_registered.from)
                form_data.append('user_registeredto', this.formData.user_registered.to)
                form_data.append('last_activityfrom', this.formData.last_activity.from)
                form_data.append('last_activityto', this.formData.last_activity.to)

                if (this.timeout) clearTimeout(this.timeout)
                this.timeout = setTimeout(() => {
                    this.sendHandler(form_data)
                }, 1500)
            },

            sendHandler(data) {
              for(var pair of data.entries()) {
                 console.log(pair[0]+ ', '+ pair[1]);
              }
                axios.post(earena_2_ajax.url, data)
                    .then((response) => {
                        const data = response.data
                        if (this.page === 1) {
                            this.users = data.users
                        } else {
                            if (data.users.length == 0) {
                                this.hasPages = false
                            }
                            for (let i = 0; i < data.users.length; i++) {
                                this.users.push(data.users[i])
                            }
                        }
                        this.total = data.counters.total
                        this.load = false
                    })
                    .catch(function (error) {
                        console.log(error)
                        this.load = false
                    })

            },
            gambitGalleryIsInView(el) {
                const scroll = window.scrollY || window.pageYOffset
                const boundsTop = el.getBoundingClientRect().top + scroll

                const viewport = {
                    top: scroll,
                    bottom: scroll + document.documentElement.clientHeight,
                }

                const bounds = {
                    top: boundsTop,
                    bottom: boundsTop + el.clientHeight,
                }

                return (bounds.bottom >= viewport.top && bounds.bottom <= viewport.bottom)
                    || (bounds.top <= viewport.bottom && bounds.top >= viewport.top)
            },
        },
        mounted() {
            this.ajaxSend()

            const raf =
                window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function (callback) {
                    window.setTimeout(callback, 1000 / 60)
                }
            const isInViewPort = document.querySelector( '#isInViewPort' )
            const handler = () => raf(() => {
                if (this.gambitGalleryIsInView(isInViewPort)) {
                    this.loadMore()
                }
            })

            handler()
            window.addEventListener('scroll', handler)
        },
        beforeMount() {
        }
    })

</script>
<style>
    #app_create_tournament select,
    #app_create_tournament input {
        margin-top: 0;
    }

    /* .table-rezult.table > thead > tr > th {
        border: none;
        cursor: pointer;
        position: relative;
        padding-left: 12px !important;
        padding-bottom: 10px;
        color: #787878;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
    }

    .table-rezult tbody {
        background: #FFFFFF;
        border-radius: 20px !important;
    } */

    th:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .DESC,
    .ASC {
        text-decoration: underline;
    }

    .DESC:before,
    .ASC:before {
        content: "";
        border-style: solid;
        position: absolute;
        left: 0px;
        top: 50%;
        transform: translateY(-50%);
    }

    .ASC:before {
        border-width: 0 5px 10px 5px;
        border-color: transparent transparent #787878 transparent;
    }

    .DESC:before {
        border-width: 10px 5px 0 5px;
        border-color: #787878 transparent transparent transparent;
    }


    .input-group-addon {
        background-color: transparent;
        border: none;
        z-index: 99999;
        position: absolute;
        bottom: 0;
    }

    table.table-rezult tr td .icons {
        text-align: right !important;
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .icons span {
        width: 20px;
        height: 20px;
        margin: 0;
        padding: 0;
        margin-right: 3px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: bold;
        font-size: 10px;
        line-height: 16px;
        text-align: center;
        color: #D62D30;
        display: block !important;
        float: unset;
        text-align: center;
        background-size: cover;
    }

    .icons span.yellow_cards {
        border: 2px solid #D62D30;
        border-radius: 50px;
    }

    .icons span.vip {
      display: flex;
      justify-content: flex-start;
      align-items: center;
      text-transform: uppercase;
      padding: 6px 10px;
      background: #E37525;
      border-radius: 5px;
      /* button_text text style */
      font-family: 'Roboto', 'Arial', sans-serif;
      font-style: normal;
      font-weight: 500;
      font-size: 14px;
      line-height: 20px;
      text-align: center;
      color: #ffffff;

      background-image: url( <?= get_template_directory_uri(); ?>/assets/img/tournaments-crown.svg);
      background-size: contain;
      background-position: center;
      background-repeat: no-repeat;
    }

    .icons span.block {
        background-image: url(<?= bloginfo('template_url')?>/images/icons/block.svg);
    }

    .icons span.verified {
      position: static;
      padding: 0;
      margin: 0;
      background: none;
      border: none;
      cursor: pointer;
      text-align: center;
      vertical-align: middle;
      outline: none;

      width: 24px;
      height: 24px;
      border-radius: 50%;
      background-color: #4890E4;
      background-image: url( <?= get_template_directory_uri(); ?>/assets/img/check.svg);
      background-size: contain;
      background-position: center;
      background-repeat: no-repeat;
      background-size: 58.33333333%;
    }

    .icons span.test {
        background-image: url(<?= bloginfo('template_url')?>/images/icons/test.svg);
    }

    .select-box {
        margin-top: 15px;
    }

    .stop {
        pointer-events: none;
        opacity: .2;
        cursor: wait;
    }

    .top-for-scroll {
        background-color: #4C2C8F;
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAj0lEQVRIie2TQQqAIBBF/3QxjxNtoqNkm+qy/TYTWWipuIn8IMig7zkwAr8KSSEpKXeaFDiAEcCcKomCk7Q8sxSTeODlJDf45sCPvc2WeOC9I2gdSXonPrjWSZK6z5OE4HdBrCQ0ptQ1iMgUeoyIrAA6PRsf7cJ46pcOnLopMrYhwVOif3JuqqAKPiCoec0OShkJTpttr90AAAAASUVORK5CYII=");
        background-size: cover;
        position: fixed;
        right: 20px;
        bottom: 20px;
        width: 25px;
        height: 25px;
        border-radius: 4px;
    }

    body, html {
        scroll-behavior: smooth;
    }
</style>

<?php
wp_enqueue_style( 'stats-styles', get_template_directory_uri() . '/assets/libs/stats.css' );
get_footer();
?>
