<!-- Для переключения состояния - добавляется active класс  -->
<div class="popup popup--tournament">
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
              <td class="pay__column pay__column--right pay__column--red">
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
        <p class="pay__text pay__text--red">
          <?php _e( 'На вашем счете недостаточно средств', 'earena_2' ); ?>
        </p>

        <button class="pay__button button button--blue openpopup" data-popup="pay" type="button" name="pay">
          <span>
            <?php _e( 'Пополнить счет', 'earena_2' ); ?>
          </span>
        </button>
      </div>
    </div>
  </div>

  <div class="popup__content popup__content--tournament">
    <?php get_template_part( 'template-parts/form', 'tournament' ); ?>
  </div>

  <?php
    if ( function_exists( 'earena_2_get_popup_close_button_html' ) ) {
      earena_2_get_popup_close_button_html( 'tournament' );
    }
  ?>
</div>
