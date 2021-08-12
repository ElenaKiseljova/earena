<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--match">
  <div class="popup__template popup__template--match" id="match-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'match' );
    }
  ?>

  <!-- Шаблоны попапов вход/регистрация/восстановление -->
  <template id="popup-match-create">
    <div class="popup__header popup__header--match">
      <h2 class="popup__title popup__title--match">
        <?php _e( 'Новый матч', 'earena_2' ); ?>
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Выберите платформу и игру', 'earena_2' ); ?>
        </span>
      </div>
    </div>

    <div class="popup__content popup__content--match">
      <form class="form form--popup" id="form-match" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" list="platform-list" id="platform" name="platform" required placeholder="<?php _e( 'Платформа', 'earena_2' ); ?>" />
          <span class="form__arrow"></span>

          <datalist id="platform-list">
              <option value="Desktop">
              <option value="Mobile">
              <option value="XBOX">
              <option value="PlayStation">
          </datalist>
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__row">
          <input class="form__field form__field--popup" list="game-list" id="game" name="game" required placeholder="<?php _e( 'Игра', 'earena_2' ); ?>" />
          <span class="form__arrow"></span>

          <datalist id="game-list">
              <option value="Mortal Combat 11 Ultimate">
              <option value="WARZONE">
              <option value="League of Legends">
              <option value="Dota 2">
          </datalist>
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <button class="form__submit form__submit--match-next button button--blue" type="submit" name="match-submit-next">
          <span>
            <?php _e( 'Далее', 'earena_2' ); ?>
          </span>
        </button>
      </form>
    </div>
  </template>
  <template id="popup-match-accept">
    <div class="match match--popup">
      <div class="match__top-left">
        <h3 class="match__game">
          WARZONE
        </h3>
        <ul class="variations variations--lock">
          <li class="variations__item">
            1 vs 1
          </li>
        </ul>
      </div>

      <div class="platform platform--match">
        <svg class="platform__icon" width="40" height="40">
          <use xlink:href="#icon-platform-xbox"></use>
        </svg>
      </div>
    </div>

    <div class="popup__content popup__content--match">
      <div class="pay pay--match">
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

        <a class="pay__button button button--blue" href="purse">
          <span>
            <?php _e( 'Пополнить счет', 'earena_2' ); ?>
          </span>
        </a> -->
        <!-- ---- -->
      </div>
      <form class="form form--popup" id="form-match" action="/" method="post">
        <div class="form__row">
          <input class="form__field form__field--popup" id="password" type="password" name="password" required placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <p class="form__text">
          <?php _e( 'Это приватный матч. Введите пароль.', 'earena_2' ); ?>
        </p>

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray" type="button" name="match-close">
            <span>
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </span>
          </button>

          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="match-submit">
            <span>
              <?php _e( 'Принять', 'earena_2' ); ?>
            </span>
          </button>
        </div>
        <p class="form__text form__text--star">
          <?php _e( 'Отменить участие в матче будет невозможно.', 'earena_2' ); ?>
        </p>
      </form>
    </div>
  </template>
  <template id="popup-match-delete">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Удалить матч', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <span>
          <?php _e( 'Вы действительно хотите удалить этот матч? <br> Восстановить его будет невозможно.', 'earena_2' ); ?>
        </span>
      </div>

      <form class="form form--popup" id="form-match" action="/" method="post">
        <input type="hidden" name="match-status" value="delete">
        <input type="hidden" name="match-id" value="11111111">
        <input type="hidden" name="user-id" value="2222222">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray" type="button" name="match-close">
            <span>
              <?php _e( 'Отменить', 'earena_2' ); ?>
            </span>
          </button>

          <button class="form__submit form__submit--buttons button button--red" type="submit" name="match-submit">
            <span>
              <?php _e( 'Удалить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-match-success">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Вызов принят', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Для того, чтобы начать игру, перейдите в чат матча, и договоритесь с соперником об игре.', 'earena_2' ); ?>
      </div>

      <a class="form__submit form__submit--accept button button--blue" href="#">
        <?php _e( 'Начать диалог', 'earena_2' ); ?>
      </a>
    </div>
  </template>
  <template id="form-match-success-create">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Матч создан', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваш матч успешно создан! Дождитесь соперника, который примет ваше предложение об игре.', 'earena_2' ); ?>
      </div>

      <button class="form__popup-close button button--gray">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-match-success-next">
    <div class="popup__header popup__header--match">
      <h2 class="popup__title popup__title--match">
        <?php _e( 'Новый матч', 'earena_2' ); ?>
      </h2>

      <div class="popup__information">
        <span>
          <?php _e( 'Укажите сумму входа и режимы', 'earena_2' ); ?>
        </span>
      </div>
    </div>
    <div class="popup__content popup__content--match">
      <form class="form form--popup" id="form-match" action="/" method="post">
        <div class="form__checkbox form__checkbox--free checkbox checkbox--left">
          <input class="visually-hidden" data-control-field-id="pay-value" data-control-toggle="off" type="checkbox" name="free-match" value="free-match" id="free-match">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="free-match">
            <?php _e( 'Бесплатный матч', 'earena_2' ); ?>
          </label>
        </div>

        <!-- Обычное поле -->
        <!-- <div class="form__row">
          <input class="form__field form__field--popup" id="pay-value" type="text" name="pay-value" required placeholder="<?php _e( 'Сумма входа', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span> -->

        <!-- Мало лет -->
        <div class="form__row invalid">
          <input class="form__field form__field--popup" id="pay-value" type="text" name="pay-value" required placeholder="<?php _e( 'Сумма входа', 'earena_2' ); ?>" >
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Вам не доступны игры на деньги', 'earena_2' ); ?></span>
        <!-- ---- -->

        <div class="form__text form__text--match">
          <?php _e( 'Это сумма, которую вносит каждый из участников перед матчем, формируя приз победителя.', 'earena_2' ); ?>
        </div>

        <div class="form__row">
          <input class="form__field form__field--popup" list="game-mode-list" id="game-mode" name="game-mode" required placeholder="<?php _e( 'Режим игры', 'earena_2' ); ?>" />
          <span class="form__arrow"></span>

          <datalist id="game-mode-list">
              <option value="1">
              <option value="2">
              <option value="3">
              <option value="4">
          </datalist>
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__row">
          <input class="form__field form__field--popup" list="team-mode-list" id="team-mode" name="team-mode" required placeholder="<?php _e( 'Режим команды', 'earena_2' ); ?>" />
          <span class="form__arrow"></span>

          <datalist id="team-mode-list">
              <option value="1">
              <option value="2">
              <option value="3">
              <option value="4">
          </datalist>
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <div class="form__checkbox form__checkbox--private checkbox checkbox--left">
          <input class="visually-hidden" data-control-field-id="password" data-control-toggle="on" type="checkbox" name="private-match" value="private-match" id="private-match">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="private-match">
            <?php _e( 'Приватный матч', 'earena_2' ); ?>
          </label>
        </div>

        <div class="form__row">
          <input class="form__field form__field--popup" id="password" type="password" name="password" required disabled placeholder="<?php _e( 'Пароль', 'earena_2' ); ?>">
        </div>
        <span class="form__error form__error--popup"><?php _e( 'Error', 'earena_2' ); ?></span>

        <button class="form__submit button button--blue" type="submit" name="match-submit">
          <span>
            <?php _e( 'Создать матч', 'earena_2' ); ?>
          </span>
        </button>
      </form>
    </div>
  </template>
  <template id="form-match-success-no-old-enough">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет доступа', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Принимать участие в играх на деньги могут только игроки, которым исполнилось 18 лет. Вы можете принять участие только в бесплатных играх.', 'earena_2' );
        ?>
      </div>

      <button class="form__popup-close button button--gray" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-match-beforesend">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста <br> подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка <br> отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-match-error">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет платформы', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы не можете принять участие в данном матче, так как у вас нет данной игры и/или платформы. Вы можете добавить их в своем профиле.', 'earena_2' ); ?>
      </div>

      <a class="popup__go-to-button button button--gray" href="#">
        <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
      </a>

      <button class="form__popup-close form__popup-close--cross">
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
