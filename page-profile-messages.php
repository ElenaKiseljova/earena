<?php
  /*
    Template Name: Профиль - Сообщения
  */
?>
<?php
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
        get_template_part( 'template-parts/account/content-messages' );
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
