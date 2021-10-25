
<div class="popup popup--friends">
  <div class="popup__template popup__template--friends" id="friends-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'friends' );
    }
  ?>

  <!-- Шаблоны попапов добавления / удаления / подтверждения / отказа -->

  <template id="popup-friends-add">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Добавить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Игроку <span class="user-name"></span> будет отправлен Ваш запрос на добавление в друзья.', 'earena_2' );
        ?>
      </div>
      <div class="popup__ajax-message"></div>
      <form class="form" action="" method="post" data-prefix="add" id="form-friends">
        <input class="user-id" type="hidden" name="user" value="">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close" type="button" name="cancel">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="friends-add-submit">
            <span>
              <?php _e( 'Отправить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-friends-delete">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Удалить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Вы уверены, что хотите удалить <br> из друзей игрока <span class="user-name"></span>?', 'earena_2' );
        ?>
      </div>
      <div class="popup__ajax-message"></div>
      <form class="form" action="" method="post" data-prefix="delete" id="form-friends">
        <input class="user-id" type="hidden" name="user" value="">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close">
            <?php _e( 'Отменить', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--red" type="submit" name="friends-delete-submit">
            <span>
              <?php _e( 'Удалить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-friends-apply">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Добавить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Игрок <span class="user-name"></span> отправил Вам запрос на добавление в друзья.', 'earena_2' );
        ?>
      </div>
      <div class="popup__ajax-message"></div>
      <form class="form" action="" method="post" data-prefix="apply" id="form-friends">
        <input class="user-id" type="hidden" name="user" value="">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close" type="button" name="cancel">
            <?php _e( 'Закрыть', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--blue" type="submit" name="friends-apply-submit">
            <span>
              <?php _e( 'Подтвердить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>
  <template id="popup-friends-reject">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Добавить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Игрок <span class="user-name"></span> отправил Вам запрос на добавление в друзья. <br> Вы хотите его отклонить?', 'earena_2' );
        ?>
      </div>
      <div class="popup__ajax-message"></div>
      <form class="form" action="" method="post" data-prefix="reject" id="form-friends">
        <input class="user-id" type="hidden" name="user" value="">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close" type="button" name="cancel">
            <?php _e( 'Закрыть', 'earena_2' ); ?>
          </button>
          <button class="form__submit form__submit--buttons button button--red" type="submit" name="friends-reject-submit">
            <span>
              <?php _e( 'Отклонить', 'earena_2' ); ?>
            </span>
          </button>
        </div>
      </form>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-friends-success-delete">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Удалить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Вы успешно удалили из друзей игрока <span class="user-name"></span>', 'earena_2' );
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--friends button button--gray button--popup-close">
        <?php _e( 'Хорошо', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-friends-success-add">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Добавить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Вы успешно отправили запрос на добавление в друзья игрока <span class="user-name"></span>', 'earena_2' );
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--friends button button--gray button--popup-close">
        <?php _e( 'Хорошо', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-friends-success-apply">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Добавить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Вы успешно добавили в друзья игрока <span class="user-name"></span>', 'earena_2' );
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--friends button button--gray button--popup-close">
        <?php _e( 'Хорошо', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-friends-success-reject">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Добавить друга', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Вы успешно отказали игроку <span class="user-name"></span> в добавлении в друзья', 'earena_2' );
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--friends button button--gray button--popup-close">
        <?php _e( 'Хорошо', 'earena_2' ); ?>
      </button>
    </div>
  </template>

  <template id="form-friends-beforesend">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>

  <template id="form-friends-error">
    <div class="popup__content popup__content--friends">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Возникла ошибка', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Пожалуйста, повторите попытку позже', 'earena_2' ); ?>
      </div>
    </div>
  </template>
</div>
