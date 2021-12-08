<?php
  global $tournament, $tournament_id, $games, $icons, $ea_icons, $ea_user;

  $is_admin_tournaments_list = is_page(555);
?>
<div class="popup popup--tournament">
  <div class="popup__template popup__template--tournament" id="tournament-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'tournament' );
    }
  ?>
  <?php if (isset($tournament) && isset($tournament_id)): ?>
    <!-- Шаблон подставляется по открытию попапа -->
    <template id="popup-tournament-join">
      <div class="popup__header popup__header--tournament">
        <div class="tournament tournament--popup">
          <header class="tournament__header tournament__header--popup">
            <div class="tournament__center tournament__center--popup">
              <h3 class="tournament__game tournament__game--popup">
                <?= $games[$tournament->game]['name']; ?>
              </h3>

              <ul class="variations variations--lock">
                <li class="variations__item">
                  <?= $tournament->game_mode; ?> vs <?= $tournament->game_mode; ?>
                </li>
                <?php if ($tournament->team_mode > 0): ?>
                  <li class="variations__item">
                    <?= team_mode_to_string($tournament->team_mode); ?>
                  </li>
                <?php endif; ?>
              </ul>
            </div>

            <div class="tournament__labels tournament__labels--tournament-popup">
              <?php if ( $tournament->verification ): ?>
                <span class="verify verify--true verify--tournament-popup"></span>
              <?php endif; ?>

              <?php if ( $tournament->vip ): ?>
                <span class="vip vip--tournament-popup">
                  vip
                </span>
              <?php endif; ?>
            </div>

            <div class="platform platform--tournament-popup">
              <svg class="platform__icon" width="40" height="40">
                <use xlink:href="#icon-platform-<?= $ea_icons['platform'][(int)$tournament->platform]; ?>"></use>
              </svg>
            </div>
          </header>
          <h2 class="tournament__name tournament__name--popup">
            <?= $tournament->name; ?>
          </h2>

          <div class="pay">
            <table class="pay__table">
              <tbody class="pay__body">
                <tr class="pay__row">
                  <td class="pay__column">
                    <?php _e( 'Доступный баланс:', 'earena_2' ); ?>
                  </td>
                  <!-- Если недостаточно/достаточно средств +/- pay__column--red -->
                  <td class="pay__column pay__column--right <?= (balance() < (!empty($tournament->price) ? $tournament->price : 0)) ? 'pay__column--red' : ''; ?>">
                    $<?= earena_2_nice_money(balance()); ?>
                  </td>
                </tr>
                <tr class="pay__row">
                  <td class="pay__column">
                    <?php _e( 'Со счета будет списано:', 'earena_2' ); ?>
                  </td>
                  <td class="pay__column pay__column--right">
                    $<?= !empty($tournament->price) ? $tournament->price : 0; ?>
                  </td>
                </tr>
              </tbody>
            </table>

            <?php if (balance() < (!empty($tournament->price) ? $tournament->price : 0)): ?>
              <p class="pay__text pay__text--red">
                <?php _e( 'На вашем счете недостаточно средств', 'earena_2' ); ?>
              </p>

              <a class="pay__button button button--blue" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add">
                <span>
                  <?php _e( 'Пополнить счет', 'earena_2' ); ?>
                </span>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <div class="popup__content popup__content--tournament">
        <form class="form form--popup" data-prefix="join" id="form-tournament" action="/" method="post">
          <div class="popup__ajax-message"></div>
          <?php if ($tournament->private): ?>
            <div class="form__row">
              <input class="form__field form__field--popup" id="password" type="password" name="tournament_pass" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
            </div>
            <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

            <p class="form__text">
              <?php _e( 'Это приватный турнир. Введите пароль.', 'earena_2' ); ?>
            </p>
          <?php endif; ?>

          <input type="hidden" name="tournament_price" value="<?= !empty($tournament->price) ? earena_2_nice_money( $tournament->price ) : 'Free'; ?>">
          <input type="hidden" name="tournament_id" value="<?= $tournament_id; ?>">
          <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">

          <div class="form__buttons">
            <button class="form__submit form__submit--buttons button button--gray button--popup-close" type="button" name="leave">
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
    <template id="popup-tournament-leave">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Отмена регистрации', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php
            if (!empty($tournament->price)) {
              $money_value = earena_2_nice_money( $tournament->price );

              echo sprintf( __( 'Вы действительно хотите отменить участие в турнире? <br>Средства в размере $%s будут возвращены обратно на ваш счет.', 'earena_2' ), $money_value );
            } else {
              _e( 'Вы действительно хотите отменить участие в турнире? Участие в турнире - бесплатное.', 'earena_2' );
            }
          ?>
        </div>

        <form class="form form--popup" data-prefix="leave" id="form-tournament" action="/" method="post">
          <input type="hidden" name="tournament_price" value="<?= !empty($tournament->price) ? earena_2_nice_money( $tournament->price ) : 'Free'; ?>">
          <input type="hidden" name="tournament_id" value="<?= $tournament_id; ?>">
          <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">

          <div class="form__buttons">
            <button class="form__submit form__submit--buttons button button--gray button--popup-close">
              <?php _e( 'Закрыть', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--red" type="submit" name="tournament-submit">
              <span>
                <?php _e( 'Отменить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
      </div>
    </template>
    <!-- ADMIN -->
    <template id="popup-tournament-add-player">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Добавить игрока', 'earena_2' ); ?>
        </h2>

        <form class="form form--popup" data-prefix="add-player" id="form-tournament" action="/" method="post">
          <div class="form__row">
            <input class="form__field form__field--popup" id="user-email" type="email" name="user_email" required placeholder="<?php _e( 'Email игрокаа', 'earena_2' ); ?>" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}">
          </div>
          <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

          <input type="hidden" name="tournament_id" value="<?= $tournament_id; ?>">
          <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">

          <div class="popup__ajax-message"></div>
          <div class="form__buttons form__buttons--add-player">
            <button class="form__submit form__submit--buttons button button--gray button--popup-close">
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--blue" type="submit" name="tournament-submit">
              <span>
                <?php _e( 'Добавить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
      </div>
    </template>

    <!-- Errors -->
    <template id="popup-tournament-no-old-enough">
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
    <template id="popup-tournament-no-game-or-platform">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Ошибка регистрации', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Вы не можете принять участие в этом турнире, так как у вас нет данной игры и/или платформы. <br>Вы можете добавить ее в профиле.', 'earena_2' ); ?>
        </div>

        <a class="popup__go-to-button button button--gray" href="<?= bloginfo( 'url' ) . '/profile'?>">
          <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
        </a>
      </div>
    </template>
    <template id="popup-tournament-no-vip">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Ошибка регистрации', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Вы не можете принять участие в этом турнире, так как у вас нет VIP-статуса. <br>Вы можете купить его в Кошельке.', 'earena_2' ); ?>
        </div>

        <a class="popup__go-to-button button button--gray" href="<?= bloginfo( 'url' ) . '/wallet/?wallet_action=add#vip'; ?>">
          <?php _e( 'Перейти в Кошелёк', 'earena_2' ); ?>
        </a>
      </div>
    </template>
    <template id="popup-tournament-no-verification-tour">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Ошибка регистрации', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Вы не можете принять участие в этом турнире, так как ваш аккаунт не верифицирован. <br/>Вы можете отправить запрос на верификацию в профиле.', 'earena_2' ); ?>
        </div>

        <a class="popup__go-to-button button button--gray" href="<?= ea_user_link(get_current_user_id()); ?>">
          <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
        </a>
      </div>
    </template>

    <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
    <template id="form-tournament-success-join">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Регистрация', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Вы успешно зарегистрировались в турнир ', 'earena_2' ); ?><?= $tournament->name; ?>.
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <template id="form-tournament-success-leave">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Отмена регистрации', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php
            if (!empty($tournament->price)) {
              $money_value = earena_2_nice_money( $tournament->price );

              echo sprintf( __( 'Вы отменили участие в турнире. <br>Средства в размере $%s были возвращены обратно на ваш счет.', 'earena_2' ), $money_value );
            } else {
              _e( 'Вы отменили участие в турнире.', 'earena_2' );
            }
          ?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <template id="form-tournament-success-add-player">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Добавить игрока', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Вы успешно добавили игрока к турниру!', 'earena_2' );?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>

    <template id="form-tournament-error-join">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Регистрация', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Что-то пошло не так... <br>Пожалуйста, повторите попытку позже.', 'earena_2' );?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <template id="form-tournament-error-leave">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Отмена регистрации', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Что-то пошло не так... <br>Пожалуйста, повторите попытку позже.', 'earena_2' );?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <template id="form-tournament-error-add-player">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Добавить игрока', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Что-то пошло не так... <br>Пожалуйста, повторите попытку позже.', 'earena_2' );?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
  <?php endif; ?>

  <?php if ($is_admin_tournaments_list): ?>
    <!-- Список Турниров (АДМИН) -->
    <template id="popup-tournament-cancel">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Отменить турнир', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php
            _e( 'Вы действительно хотите отменить турнир?', 'earena_2' );
          ?>
        </div>

        <form class="form form--popup" data-prefix="cancel" id="form-tournament" action="/" method="post">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">

          <div class="form__buttons">
            <button class="form__submit form__submit--buttons button button--gray button--popup-close">
              <?php _e( 'Закрыть', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--red" type="submit" name="tournament-submit">
              <span>
                <?php _e( 'Отменить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
      </div>
    </template>
    <template id="popup-tournament-delete-cron">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Удалить турнир', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php
            _e( 'Вы действительно хотите удалить запланированный турнир?', 'earena_2' );
          ?>
        </div>

        <form class="form form--popup" data-prefix="delete-cron" id="form-tournament" action="/" method="post">
          <input type="hidden" name="cron" value="">
          <input type="hidden" name="crontime" value="">
          <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">

          <div class="form__buttons">
            <button class="form__submit form__submit--buttons button button--gray button--popup-close">
              <?php _e( 'Закрыть', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--red" type="submit" name="tournament-submit">
              <span>
                <?php _e( 'Удалить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
      </div>
    </template>
    <template id="popup-tournament-delete-tournament">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Удалить турнир', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php
            _e( 'Вы действительно хотите удалить турнир?', 'earena_2' );
          ?>
        </div>

        <form class="form form--popup" data-prefix="delete-tournament" id="form-tournament" action="/" method="post">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">

          <div class="form__buttons">
            <button class="form__submit form__submit--buttons button button--gray button--popup-close">
              <?php _e( 'Закрыть', 'earena_2' ); ?>
            </button>

            <button class="form__submit form__submit--buttons button button--red" type="submit" name="tournament-submit">
              <span>
                <?php _e( 'Удалить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
      </div>
    </template>

    <template id="form-tournament-success">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Удалить/отменить <br>турнир', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Турнир успешно удален/отменён! <br>После закрытия попапа страница будет перезагружена.', 'earena_2' );?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
    <template id="form-tournament-error">
      <div class="popup__content popup__content--tournament">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Удалить/отменить <br>турнир', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php _e( 'Турнир не удален/отменён! <br>Попробуйте повторить позже...', 'earena_2' );?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--tournament button button--gray button--popup-close">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
      </div>
    </template>
  <?php endif; ?>

  <!-- Общий -->
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
</div>
