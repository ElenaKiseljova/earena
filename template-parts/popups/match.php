<?php
  global $games, $ea_icons, $icons;

  $platforms = get_site_option('platforms') ?? [];
  $games = $games ?? [];
?>

<div class="popup popup--match">
  <div class="popup__template popup__template--match" id="match-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'match' );
    }
  ?>

  <!-- Шаблоны попапов создания / подтверждения / удаления -->
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
      <form class="form form--popup" data-prefix="create" id="form-match" action="/" method="post">
        <div class="form__row">
          <div class="select select--platforms" data-create="games">

            <button class="select__button select__button--platforms" type="button" name="button">
              <?php _e( 'Платформа', 'earena_2' ); ?>
            </button>

            <ul class="select__list">
              <?php foreach ($platforms as $key => $platform): ?>
                <li class="select__item">
                  <input class="visually-hidden" type="radio" name="platform" value="<?= $key; ?>" id="select-platform-<?= $key; ?>" required>
                  <label class="select__label" for="select-platform-<?= $key; ?>">
                    <?= $platform; ?>
                  </label>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
        <span class="form__error form__error--create"><?php _e( 'Выберите платформу', 'earena_2' ); ?></span>

        <div class="form__row form__row--games">
          <!-- Содержимое перепишется после выбора платформы -->
          <div class="select select--games">
            <button class="select__button select__button--games" type="button" name="button" disabled>
              <?php _e( 'Игра', 'earena_2' ); ?>
            </button>
          </div>
        </div>
        <span class="form__error form__error--popup">
          <?php _e( 'Error', 'earena_2' ); ?>
        </span>

        <button class="form__submit form__submit--match-next button button--blue disabled" type="submit" name="match-submit-next">
          <span>
            <?php _e( 'Далее', 'earena_2' ); ?>
          </span>
        </button>
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

      <form class="form form--popup" data-prefix="delete" id="form-match" action="/" method="post">
        <input type="hidden" name="id" value="">
        <input type="hidden" name="security" value="<?= wp_create_nonce( 'ea_functions_nonce' ); ?>">

        <div class="form__buttons">
          <button class="form__popup-close form__popup-close--buttons button button--gray button--popup-close" type="button" name="match-close">
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

  <template id="popup-match-no-old-enough">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет доступа', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          _e( 'Принимать участие в играх на деньги могут только игроки, которым исполнилось 18 лет. Вы можете принять участие только в бесплатных играх.', 'earena_2' );
        ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--match button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="popup-match-no-game-or-platform">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет платформы', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы не можете принять участие в данном матче, так как у вас нет данной игры и/или платформы. Вы можете добавить их в своем профиле.', 'earena_2' ); ?>
      </div>

      <a class="popup__go-to-button popup__go-to-button--match button button--gray" href="<?= bloginfo( 'url' ); ?>/profile">
        <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
      </a>
    </div>
  </template>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-match-success-accept">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Вызов принят', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Для того, чтобы начать игру, перейдите в чат матча, и договоритесь с соперником об игре.', 'earena_2' ); ?>
      </div>

      <a class="form__submit form__submit--accept button button--blue" id="go-to-math-link" href="<?= bloginfo( 'url' ); ?>/matches/match/?match=">
        <?php _e( 'Начать диалог', 'earena_2' ); ?>
      </a>
    </div>
  </template>
  <template id="form-match-success-delete">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Удалить матч', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы успешно удалили матч.', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--match button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-match-success-add">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Матч создан', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваш матч успешно создан! Дождитесь соперника, который примет ваше предложение об игре.', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--match button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-match-success">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Успех', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Запрос прошел успешно.', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--match button button--gray button--popup-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>

  <template id="form-match-beforesend">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>

  <template id="form-match-error-create">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет платформы', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы не можете принять участие в данном матче, так как у вас нет данной игры и/или платформы. Вы можете добавить их в своем профиле.', 'earena_2' ); ?>
      </div>

      <a class="popup__go-to-button popup__go-to-button--match button button--gray" href="<?= bloginfo( 'url' ); ?>/profile">
        <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
      </a>
    </div>
  </template>
  <template id="form-match-error-delete">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет матча', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Что-то пошло не так... Повторите попытку или напишите нам в техподдержкую', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--match button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-match-error-no-game-or-platform">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Нет платформы', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Вы не можете принять участие в данном матче, так как у вас нет данной игры и/или платформы. Вы можете добавить их в своем профиле.', 'earena_2' ); ?>
      </div>

      <a class="popup__go-to-button popup__go-to-button--match button button--gray" href="<?= bloginfo( 'url' ); ?>/profile">
        <?php _e( 'Перейти в профиль', 'earena_2' ); ?>
      </a>
    </div>
  </template>
  <template id="form-match-error">
    <div class="popup__content popup__content--match">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ошибка', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Что-то пошло не так...', 'earena_2' ); ?>
      </div>

      <button class="popup__go-to-button popup__go-to-button--match button button--gray button--popup-close" type="button" name="match-close">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
</div>
