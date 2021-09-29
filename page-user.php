<?php
  /*
    Template Name: Профиль (public)
  */
?>
<?php
  global $wpdb, $icons;

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

  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $earena_2_user_public = $ea_user;

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
  $nicknames = $ea_user->get('nicknames')?:[[[]]];
  $nicknames_by_platforms = [];
  foreach( $nicknames as $game=>$platforms ) {
      foreach( $platforms as $platform=>$nickname ) {
          $nicknames_by_platforms[$platform][$game] = $nickname;
      }
  }

  $games = get_site_option( 'games' );
  $games_by_platforms = [];
  foreach( array_column($games,'platforms') as $game=>$platforms ) {
      foreach( $platforms as $platform ) {
          $games_by_platforms[$platform][] = $game;
      }
  }

  $stream = $ea_user->get('stream')?:'';

  $user_stat = ea_get_user_stat($ea_user->ID);

  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_stat_public;
  $earena_2_user_stat_public = $user_stat;
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="account">
    <div class="account__wrapper">
      <?php
        // Шапка Аккаунта
        get_template_part( 'template-parts/account/header', 'public' );
      ?>

      <?php
        // Переключатели
        get_template_part( 'template-parts/toggles/account', 'public' );
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
