<?php
  // Уведомления (вкладка)
?>

<div class="section section--requests" id="requests">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Уведомления', 'earena_2' ); ?>
    </h2>

    <div class="section__header-right">
    </div>
  </header>

  <ul class="section__list section__list--messages">
    <li class="section__item section__item--col-2 section__item--messages">
      <div class="user user--friends">
        <?php
          $avatar = rand(0, 1);
          $verified = rand(0, 1);
        ?>
        <div class="user__left user__left--friends">
          <div class="user__image-wrapper user__image-wrapper--friends user__image-wrapper--admin">
            <div class="user__avatar user__avatar--friends">
              <?php if ($avatar): ?>
                <img width="70" height="70" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>">
              <?php else : ?>
                <img width="70" height="70" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-default.svg" alt="<?php the_title(  ); ?>">
              <?php endif; ?>
            </div>
          </div>

          <div class="user__info user__info--friends">
            <a class="user__name user__name--friends user__name--admin" href="#">
              <h5>
                Administrator
              </h5>
            </a>

            <?php
              $online = rand(0, 1);
            ?>
            <?php if ($online): ?>
              <div class="user__status user__status--online user__status--friends">
                Online
              </div>
            <?php else : ?>
              <div class="user__status user__status--friends">
                <?php
                  _e( 'Был(а) 1 час назад', 'earena_2' );
                ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </li>
    <li class="section__item section__item--col-2 section__item--chat">
      <div class="section__item-top">
        <h2 class="section__item-title">
          <?php _e( 'Диалог с Администратором', 'earena_2' ); ?>
        </h2>

        <a class="section__close"  href="<?php echo bloginfo( 'url' ); ?>/profile?requests">
          <span class="visually-hidden">
            <?php _e( 'Удалить', 'earena_2' ); ?>
          </span>
          <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </a>
      </div>
      <!-- Чат -->
      <?php
        get_template_part( 'template-parts/chat' );
      ?>
    </li>
  </ul>
</div>
