<?php
  /*
    Template Name: Профиль - Админ - Турниры
  */
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

      <!-- <a href="<?php echo get_page_link(646); ?>" class="toggles__item toggles__item--account <?php if(is_page(646)) echo 'active'; ?>">
        <?php _e( 'Lucky CUP', 'earena_2' ); ?> (<?=count_admin_tournaments(2);?>)
      </a>
      <a href="<?php echo get_page_link(640); ?>" class="toggles__item toggles__item--account <?php if(is_page(640)) echo 'active'; ?>">
        <?php _e( 'Кубки', 'earena_2' ); ?> (<?=count_admin_tournaments(3);?>)
      </a> -->
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
