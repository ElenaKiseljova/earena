<?php
  /*
    Template Name: Профиль - Админ - Кубки
  */
?>

<?php
  global $tournament_type;
  $tournament_type = 3;
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?= _e( 'Админ - Турниры (Кубки)', 'earena_2' ); ?>
  </h1>

  <section class="account">
    <div class="account__wrapper">
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
        get_template_part( 'template-parts/account/content-tournaments', 'private' );
      ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
