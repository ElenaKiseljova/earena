<?php
  /*
    Template Name: BAN
  */
?>
<?php
  $ea_user = wp_get_current_user();
  $blocked = $ea_user->get('blocked')?:false;
  $yellow_cards = $ea_user->get('yc')?:0;
  $blocked = $yellow_cards>=3?true:$blocked;
  //print_r($_SERVER['REQUEST_URI']);
  if(!$blocked && !is_ea_admin()){
    wp_redirect( home_url() );
    exit;
  }
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="content <?= is_checkout() ? 'content--checkout' : ''; ?>">
    <div class="content__wrapper">
      <?php if (has_post_thumbnail()): ?>
        <header class="content__header">
          <div class="content__description">
            <h1 class="content__title content__title--havethumbnail">
              <?php _e( 'Аккаунт заблокирован', 'earena'); ?>
            </h1>

            <?php if (get_field( 'page_text_subtitle' )): ?>
              <div class="content__subtitle">
                <?php the_field( 'page_text_subtitle' ); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="content__image">
            <picture class="content__picture">
              <?php the_post_thumbnail(); ?>
            </picture>
          </div>
        </header>
        <div class="content__inner">
          <p>
            <?php _e( 'Ваш аккаунт заблокирован!', 'earena'); ?>
          </p>
          <p>
            <?php _e( 'Вы можете написать Администрации, чтобы получить детальную информацию по поводу причин блокировки.', 'earena'); ?>
          </p>

          <p>
            <a class="content__button button button--blue" href="<?= bloginfo( 'url' ) . '/profile/administration/'; ?>">
              <?php _e( 'Администрация', 'earena'); ?>
            </a>
          </p>
        </div>
      <?php else: ?>
        <div class="content__inner content__inner--nothumbnail">
          <h1 class="content__title content__title--nothumbnail <?= is_checkout() ? 'content__title--checkout' : ''; ?>">
            <?php _e( 'Аккаунт заблокирован', 'earena'); ?>
          </h1>

          <p>
            <?php _e( 'Ваш аккаунт заблокирован!', 'earena'); ?>
          </p>
          <p>
            <?php _e( 'Вы можете написать Администрации, чтобы получить детальную информацию по поводу причин блокировки.', 'earena'); ?>
          </p>

          <p>
            <a class="content__button button button--blue" href="<?= bloginfo( 'url' ) . '/profile/administration/'; ?>">
              <?php _e( 'Администрация', 'earena'); ?>
            </a>
          </p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
