
<div class="popup popup--tournament">
  <div class="popup__template popup__template--tournament" id="tournament-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'tournament' );
    }
  ?>
  <!-- Шаблон подставляется по открытию попапа -->
  <template id="popup-tournament-registration">
    <div class="popup__header popup__header--tournament">
      <div class="tournament tournament--popup">
        <header class="tournament__header tournament__header--popup">
          <div class="tournament__center tournament__center--popup">
            <h3 class="tournament__game tournament__game--popup">
              WARZONE
            </h3>

            <ul class="variations variations--lock">
              <li class="variations__item">
                1 vs 1
              </li>
            </ul>
          </div>

          <span class="vip vip--popup">
            vip
          </span>

          <div class="platform platform--popup">
            <svg class="platform__icon" width="40" height="40">
              <use xlink:href="#icon-platform-xbox"></use>
            </svg>
          </div>
        </header>
        <h2 class="tournament__name tournament__name--popup">
          <?php the_title(  ); ?>
        </h2>

        <div class="pay">
          <table class="pay__table">
            <tbody class="pay__body">
              <tr class="pay__row">
                <td class="pay__column">
                  <?php _e( 'Доступный баланс:', 'earena_2' ); ?>
                </td>
                <!-- Если недостаточно/достаточно средств +/- pay__column--red -->
                <td class="pay__column pay__column--right">
                  $1 300
                </td>
              </tr>
              <tr class="pay__row">
                <td class="pay__column">
                  <?php _e( 'Со счета будет списано:', 'earena_2' ); ?>
                </td>
                <td class="pay__column pay__column--right">
                  $300
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Если недостаточно средств -->
          <!-- <p class="pay__text pay__text--red">
            <?php _e( 'На вашем счете недостаточно средств', 'earena_2' ); ?>
          </p>

          <a class="pay__button button button--blue" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add">
            <span>
              <?php _e( 'Пополнить счет', 'earena_2' ); ?>
            </span>
          </a> -->
          <!-- ---- -->
        </div>
      </div>
    </div>

    <div class="popup__content popup__content--tournament">
      <form class="form form--popup" data-prefix="" id="form-tournament" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" id="password" type="password" name="password" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <p class="form__text">
          <?php _e( 'Это приватный турнир. Введите пароль.', 'earena_2' ); ?>
        </p>

        <div class="form__buttons">
          <button class="form__submit form__submit--buttons button button--gray" type="button" name="tournament-cancel">
            <span>
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </span>
          </button>

          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="tournament-submit">
            <span>
              <?php _e( 'Регистрация', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-tournament-success">
    <div class="popup__content popup__content--tournament">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Регистрация', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы успешно зарегистрировались в турнир', 'earena_2' ); ?>
        Championship 2020 Season 2 Premium.
      </div>

      <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-tournament-success-no-old-enough">
    <div class="popup__content popup__content--tournament">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет доступа', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Принимать участие в играх на деньги могут только игроки, которым исполнилось 18 лет. Вы можете принять участие только в бесплатных играх.', 'earena_2' );
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-tournament-cancel">
    <div class="popup__content popup__content--tournament">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Отмена регистрации', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          $money_value = '$50';

          echo sprintf( __( 'Вы отменили участие в турнире. <br>Средства в размере %s были возвращены обратно на ваш счет.', 'earena_2' ), $money_value );
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-tournament-beforesend">
    <div class="popup__content popup__content--tournament">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-tournament-error">
    <div class="popup__content popup__content--tournament">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ошибка регистрации', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы не можете принять участие в этом турнире, так как у вас нет данной игры и/или платформы. <br>Вы можете добавить ее в профиле.', 'earena_2' ); ?>
      </div>

      <a class="popup__go-to-button button button--gray" href="#">
        <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
      </a>

      <button class="popup__close popup__close--cross button button--popup-close">
        <span class="visually-hidden">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </span>
        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </template>
</div>
