<?php
  /*
    Template Name: Профиль - Админ - Lucky CUP
  */
?>

<?php
  global $tournament_type;
  $tournament_type = 2;
?>

<?php
  get_header(  );
?>

<main class="page-main">
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
