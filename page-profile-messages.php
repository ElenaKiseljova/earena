<?php
  /*
    Template Name: Профиль - Сообщения
  */
?>
<?php
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

  $thread_id = isset($_GET['thread_id']) ? $_GET['thread_id'] : null;

  if(!empty($thread_id)){
    $match_id = EArena_DB::get_ea_match_id_for_thread( $thread_id );
    if ($match_id>0) {
      wp_redirect(add_query_arg( 'match', $match_id, home_url('matches/match/') ));exit;
    }

    $tournament_match_id = EArena_DB::get_ea_tournament_match_id_for_thread( $thread_id );
    if ($tournament_match_id>0) {
      wp_redirect(add_query_arg( 'match', $tournament_match_id, home_url('tournaments/tournament/match/') ));exit;
    }
  }

  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;
  $earena_2_user_private = $ea_user;
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Профиль - Сообщения', 'earena_2' ); ?>
  </h1>

  <section class="account">
    <div class="account__wrapper">
      <?php if (is_ea_admin()): ?>
        <?php
          // Шапка Аккаунта
          get_template_part( 'template-parts/account/header', 'admin' );
        ?>

        <?php
          // Переключатели
          get_template_part( 'template-parts/toggles/account', 'admin' );
        ?>

        <?php
          // Контент Аккаунта
          get_template_part( 'template-parts/account/content', 'messages' );
        ?>
      <?php else: ?>
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
          get_template_part( 'template-parts/account/content', 'messages' );
        ?>
      <?php endif; ?>
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
