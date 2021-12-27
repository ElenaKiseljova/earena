
<div class="popup popup--purse">
  <div class="popup__template popup__template--purse" id="purse-popup">
    <!-- Шаблон подставляется по открытию попапа -->
  </div>
  <?php
    if (WC()->session->get( 'withdrawal', 'not found' ) === 'success') {
      $withdrawal_amount = WC()->session->get( 'withdrawal_amount', '0' );
      ?>
        <button id="withdrawal-button" class="visually-hidden openpopup" data-popup="purse" type="button" name="withdrawal">
          <?php _e( 'Открыть попап', 'earena_2' ); ?>
        </button>
        <script type="text/javascript">
          window.addEventListener('load', function () {
            document.querySelector('#withdrawal-button').click();

            document.addEventListener('click', function (evt) {
              evt.stopPropagation();
              evt.preventDefault();

              document.location.href =  '<?= bloginfo( 'url' ); ?>/wallet/?wallet_action=withdraw';
            });
          });
        </script>
      <?php
        WC()->session->__unset( 'withdrawal' );
        WC()->session->__unset( 'withdrawal_amount' );
    }
  ?>
  <?php
    if (WC()->session->get( 'transaction', 'not found' ) === 'success') {
      $transaction_amount = WC()->session->get( 'transaction_amount', '0' );
      $transaction_user_id = WC()->session->get( 'transaction_user_id', '0' );
      ?>
        <button class="popup__close popup__close--purse button button--gray">
          <?php _e( 'Закрыть', 'earena_2' ); ?>
        </button>
        <button id="transaction-button" class="visually-hidden openpopup" data-popup="purse" type="button" name="transaction">
          <?php _e( 'Открыть попап', 'earena_2' ); ?>
        </button>
        <script type="text/javascript">
          window.addEventListener('load', function () {
            document.querySelector('#transaction-button').click();
          });
        </script>
      <?php
        WC()->session->__unset( 'transaction' );
        WC()->session->__unset( 'transaction_amount' );
        WC()->session->__unset( 'transaction_user_id' );
    }
  ?>
  <?php if (isset($transaction_user_id) && isset($transaction_amount)): ?>
    <!-- Для корректной работы ajax - приставка в id template должна совпадать с id form -->
    <template id="popup-purse-transaction">
      <div class="popup__content popup__content--purse">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Перевод выполнен', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php
            $user_transaction = get_user_by( 'id', $transaction_user_id );

            $user_transaction_name  = '';

            if ($user_transaction instanceof WP_User) {
              $user_transaction_name = $user_transaction->nickname;
            }

            $user_transaction_amount = '$' . $transaction_amount;

            echo sprintf(
              __( 'Средства, в размере %s успешно переведены на счет игрока %s.', 'earena_2' ),
              $user_transaction_amount,
              $user_transaction_name
            );
          ?>
        </div>
      </div>
    </template>
  <?php endif; ?>
  <?php if (isset($withdrawal_amount)): ?>
    <template id="popup-purse-withdrawal">
      <div class="popup__content popup__content--purse">
        <h2 class="popup__title popup__title--template">
          <?php _e( 'Заявка принята', 'earena_2' ); ?>
        </h2>

        <div class="popup__information popup__information--template">
          <?php
            echo sprintf(
              __( 'Ваша заявка на вывод суммы в размере $%s успешно принята. Мы рассмотрим ее в течение 24-х часов и переведем средства на ваш счет. ', 'earena_2' ),
              $withdrawal_amount
            );
          ?>
        </div>

        <button class="popup__go-to-button popup__go-to-button--purse button button--gray" name="close" type="button">
          <?php _e( 'Хорошо', 'earena_2' ); ?>
        </button>
      </div>
    </template>
  <?php endif; ?>
</div>
