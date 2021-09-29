<?php
  /*
    Template Name: Профиль
  */
?>
<?php
  global $wpdb, $icons;
  $ref = $wpdb->get_var($wpdb->prepare(
      "SELECT COUNT(*) FROM `ef_usermeta` WHERE meta_key='ref' and meta_value=%s", $ea_user->ID
  ));

  $username = get_query_var('username');
  if (empty($username) && is_user_logged_in()) {
    $ea_user = wp_get_current_user();
  } elseif ( $username == 1 ) {
    wp_redirect(home_url());exit;
  } elseif ( $username == 89 ) {
    wp_redirect(home_url('matches'));exit;
  } elseif ( $username == 88 || $username == 87 ) {
    wp_redirect(home_url('tournaments'));exit;
  } elseif (!empty($username)) {
    $ea_user = get_user_by('slug',$username);
  //		$ea_user = get_user_by('id',EArena_DB::get_ea_user_id( $username ));
  } else {
    wp_redirect( add_query_arg('action', 'login', home_url() ) );exit;
  }

  if ( !($ea_user instanceof WP_User) ) {wp_redirect( home_url('404') );exit;}

  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;
  $earena_2_user_private = $ea_user;

  //		$rating = $ea_user->get('rating');
  //		$month_ratings = EArena_DB::get_ea_month_ratings($ea_user->ID);

  $m_wins = EArena_DB::get_ea_matches_win($ea_user->ID);
  $m_loses = EArena_DB::get_ea_matches_lose($ea_user->ID);

  $t_wins = EArena_DB::get_ea_tournament_matches_win($ea_user->ID);
  $t_loses = EArena_DB::get_ea_tournament_matches_lose($ea_user->ID);
  $t_draw = EArena_DB::get_ea_tournament_matches_draw($ea_user->ID);

  $gf = EArena_DB::get_ea_matches_goals_from($ea_user->ID)+EArena_DB::get_ea_tournament_matches_goals_from($ea_user->ID);
  $gt = EArena_DB::get_ea_matches_goals_to($ea_user->ID)+EArena_DB::get_ea_tournament_matches_goals_to($ea_user->ID);


  //    $ea_user = wp_get_current_user();

  $stream = $ea_user->get('stream')?:'';

  $user_stat = ea_get_user_stat($ea_user->ID);

  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_stat_private;
  $earena_2_user_stat_private = $user_stat;

  // Страница Акаунта
  global $is_account_page;

  $is_account_page = true;
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="account">
    <div class="account__wrapper">
      <?php
        // Шапка Аккаунта
        get_template_part( 'template-parts/account/header', 'private' );
      ?>

      <?php
        // Переключатели
        get_template_part( 'template-parts/toggles/account', 'private' );
      ?>

      <?php
        // Контент Аккаунта
        get_template_part( 'template-parts/account/content-profile', 'private' );
      ?>
    </div>
  </section>

  <?php
    // Партнеры
    get_template_part( 'template-parts/partners' );
  ?>
</main>

<?php
  get_footer(  );
?>
