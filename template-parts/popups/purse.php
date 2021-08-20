<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--purse">
  <div class="popup__template popup__template--purse" id="purse-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>

  <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
  <template id="form-purse-success-transaction">
    <div class="popup__content popup__content--purse">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Перевод выполнен', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          $user_transaction_name = 'Alexey234';
          $user_transaction_amount = '$50';

          echo sprintf(
            __( 'Средства, в размере %s успешно переведены на счет игрока %s.', 'earena_2' ),
            $user_transaction_amount,
            $user_transaction_name
          );
        ?>
      </div>

      <button class="form__popup-close button button--gray">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-purse-success-withdrawal">
    <div class="popup__content popup__content--purse">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Заявка принята', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php
          $withdrawal_amount = '$50';

          echo sprintf(
            __( 'Ваша заявка на вывод суммы в размере %s успешно принята. Мы рассмотрим ее в течение 24-х часов и переведем средства на ваш счет. ', 'earena_2' ),
            $withdrawal_amount
          );
        ?>
      </div>

      <button class="form__popup-close button button--gray">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-purse-beforesend">
    <div class="popup__content popup__content--purse">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Пожалуйста подождите', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Ваша заявка отправляется...', 'earena_2' ); ?>
      </div>
    </div>
  </template>
  <template id="form-purse-error-transaction">
    <div class="popup__content popup__content--purse">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ошибка перевода', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Попробуйте повторить позже', 'earena_2' ); ?>
      </div>

      <button class="form__popup-close button button--gray">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
  <template id="form-purse-error-withdrawal">
    <div class="popup__content popup__content--purse">
      <h2 class="popup__title popup__title--template">
        <?php _e( 'Ошибка вывода', 'earena_2' ); ?>
      </h2>

      <div class="popup__information popup__information--template">
        <?php _e( 'Попробуйте повторить позже', 'earena_2' ); ?>
      </div>

      <button class="form__popup-close button button--gray">
        <?php _e( 'Закрыть', 'earena_2' ); ?>
      </button>
    </div>
  </template>
</div>
