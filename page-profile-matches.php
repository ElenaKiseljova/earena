<?php
  /*
    Template Name: Профиль - Матчи
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

  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;
  $earena_2_user_private = $ea_user;
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
        get_template_part( 'template-parts/account/content-matches', 'private' );
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
