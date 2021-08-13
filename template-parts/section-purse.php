<section class="section section--purse" id="purse">
  <div class="section__wrapper">
    <header class="section__header">
      <h1 class="section__title section__title--purse">
        <?php the_title(  ); ?>
      </h1>

      <div class="section__header-right section__header-right--purse">
        <!-- Табы действий с Кошельком -->
        <?php get_template_part( 'template-parts/tabs/tabs', 'purse' ); ?>
      </div>
    </header>

    <div class="section__content" id="content-purse">
      <!-- Подстановка содержимого из шаблона -->
    </div>
  </div>

  <template id="purse-refill">
    <div class="purse">
      <h3 class="purse__title">
        <?php _e( 'Пополнение счета', 'earena_2' ); ?>
      </h3>

      <div class="purse__content">
        <form class="form form--purse" action="index.html" method="post" id="form-purse">
          <div class="form__left form__left--purse-refill">
            <div class="form__row-wrapper">
              <div class="form__row form__row--purse">
                <input class="form__field form__field--purse" id="money" type="text" name="money" required placeholder="<?php _e( 'Сумма ($)', 'earena_2' ); ?>">
              </div>
              <span class="form__error form__error--purse"><?php _e( 'Error', 'earena_2' ); ?></span>
            </div>
          </div>

          <p  class="form__text form__text--purse">
            <?php _e( 'Укажите сумму для пополнения.<br>Вы сможете вывести свои внесенные средства в любой момент.', 'earena_2' ); ?>
          </p>

          <button class="form__submit form__submit--purse button button--green" type="submit" disabled name="purse-refill-submit">
            <span>
              <?php _e( 'Пополнить счет', 'earena_2' ); ?>
            </span>
          </button>
        </form>
      </div>
    </div>
  </template>
  <template id="purse-withdrawal">
    <div class="purse">
      <h3 class="purse__title">
        <?php _e( 'Вывод средств', 'earena_2' ); ?>
      </h3>

      <div class="purse__content">
        <form class="form form--purse" action="index.html" method="post" id="form-purse">
          <div class="form__left form__left--purse-withdrawal">
            <div class="form__row-wrapper">
              <div class="form__row form__row--purse">
                <input class="form__field form__field--purse" id="money" type="text" name="money" required placeholder="<?php _e( 'Сумма ($)', 'earena_2' ); ?>">
              </div>
              <span class="form__error form__error--purse"><?php _e( 'Error', 'earena_2' ); ?></span>
            </div>
          </div>

          <p  class="form__text form__text--purse">
            <?php _e( 'Минимальная сумма для вывода $50 <br>При выводе средств, комиссия взымается в соответствии с тарифами платёжной системы.', 'earena_2' ); ?>
          </p>

          <button class="form__submit form__submit--purse button button--green" type="submit" disabled name="withdrawal">
            <span>
              <?php _e( 'Вывести средства', 'earena_2' ); ?>
            </span>
          </button>
        </form>
      </div>
    </div>
    <div class="purse">
      <h3 class="purse__title">
        <?php _e( 'Заявки на вывод средств', 'earena_2' ); ?>
      </h3>

      <div class="purse__table-wrapper">
        <div class="purse__table">
          <table class="purse__table">
            <thead class="purse__table-head">
              <tr class="purse__table-row">
                <th class="purse__table-col purse__table-col--th purse__table-col--1">
                  <?php _e( 'ID', 'earena_2' ); ?>
                </th>
                <th class="purse__table-col purse__table-col--th purse__table-col--2">
                  <?php _e( 'Сумма', 'earena_2' ); ?>
                </th>
                <th class="purse__table-col purse__table-col--th purse__table-col--3">
                  <?php _e( 'Дата', 'earena_2' ); ?>
                </th>
                <th class="purse__table-col purse__table-col--th purse__table-col--4">
                  <span class="visually-hidden"><?php _e( 'Удалить', 'earena_2' ); ?></span>
                </th>
              </tr>
            </thead>
            <tbody class="purse__table-body">
              <tr class="purse__table-row">
                <td class="purse__table-col purse__table-col--td purse__table-col--1">
                  #93046
                </td>
                <td class="purse__table-col purse__table-col--td purse__table-col--2">
                  $50
                </td>
                <td class="purse__table-col purse__table-col--td purse__table-col--3">
                  <time>23.09.2019</time>
                </td>
                <td class="purse__table-col purse__table-col--td purse__table-col--4">
                  <button class="purse__delete" type="button" name="delete">
                    <span class="visually-hidden">
                      <?php _e( 'Удалить', 'earena_2' ); ?>
                    </span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </td>
              </tr>
              <tr class="purse__table-row">
                <td class="purse__table-col purse__table-col--td purse__table-col--1">
                  #93046
                </td>
                <td class="purse__table-col purse__table-col--td purse__table-col--2">
                  $50
                </td>
                <td class="purse__table-col purse__table-col--td purse__table-col--3">
                  <time>23.09.2019</time>
                </td>
                <td class="purse__table-col purse__table-col--td purse__table-col--4">
                  <button class="purse__delete" type="button" name="delete">
                    <span class="visually-hidden">
                      <?php _e( 'Удалить', 'earena_2' ); ?>
                    </span>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>
  <template id="purse-transaction">
    <div class="purse">
      <h3 class="purse__title">
        <?php _e( 'Перевести средства игроку', 'earena_2' ); ?>
      </h3>

      <div class="purse__content">
        <form class="form form--purse-transaction" action="index.html" method="post" id="form-purse">
          <div class="form__left form__left--grid">
            <div class="form__row-wrapper form__row-wrapper--grid">
              <div class="form__row">
                <input class="form__field form__field--purse" id="user-login" type="text" name="user-login" required placeholder="<?php _e( 'Логин игрока', 'earena_2' ); ?>">
              </div>
              <span class="form__error"><?php _e( 'Error', 'earena_2' ); ?></span>
            </div>
            <div class="form__row-wrapper form__row-wrapper--grid">
              <div class="form__row">
                <input class="form__field form__field--purse" id="money" type="text" name="money" required placeholder="<?php _e( 'Сумма ($)', 'earena_2' ); ?>">
              </div>
              <span class="form__error"><?php _e( 'Недостаточно средств <br>Необходимо иметь на счету', 'earena_2' ); ?> $5 050</span>
            </div>
            <div class="form__row-wrapper form__row-wrapper--grid">
              <div class="form__row form__row--message-transaction">
                <textarea class="form__field form__field--purse form__field--message-transaction" name="message" placeholder="<?php _e( 'Комментарий (необязательно)', 'earena_2' ); ?>"></textarea>
              </div>
              <span class="form__error"><?php _e( 'Error', 'earena_2' ); ?></span>
            </div>
            <p  class="form__text form__text--purse form__text--grid">
              <?php _e( 'Комиссия сервиса', 'earena_2' ); ?> – 5%
            </p>
          </div>

          <button class="form__submit form__submit--purse button button--green" type="submit" disabled name="transaction">
            <span>
              <?php _e( 'Перевести', 'earena_2' ); ?>
            </span>
          </button>
        </form>
      </div>
    </div>
  </template>
  <template id="purse-history">
    <div class="purse">
      <h3 class="purse__title">
        <?php _e( 'История операций', 'earena_2' ); ?>
      </h3>

      <div class="purse__table-wrapper">
        <table class="purse__table">
          <thead class="purse__table-head">
            <tr class="purse__table-row">
              <th class="purse__table-col purse__table-col--th purse__table-col--1-history">
                <?php _e( 'ID', 'earena_2' ); ?>
              </th>
              <th class="purse__table-col purse__table-col--th purse__table-col--2-history">
                <?php _e( 'Операция', 'earena_2' ); ?>
              </th>
              <th class="purse__table-col purse__table-col--th purse__table-col--3-history">
                <?php _e( 'Сумма', 'earena_2' ); ?>
              </th>
              <th class="purse__table-col purse__table-col--th purse__table-col--4-history">
                <?php _e( 'Подробности', 'earena_2' ); ?>
              </th>
              <th class="purse__table-col purse__table-col--th purse__table-col--5-history">
                <?php _e( 'Дата', 'earena_2' ); ?>
              </th>
            </tr>
          </thead>
          <tbody class="purse__table-body">
            <tr class="purse__table-row purse__table-row--history">
              <td class="purse__table-col purse__table-col--td purse__table-col--1-history">
                #43359
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--2-history">
                <?php _e( 'Пополнение', 'earena_2' ); ?>
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--3-history">
                $11.70
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--4-history">
                <?php _e( 'Пополнение счета через кассу', 'earena_2' ); ?> #4545543
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--5-history">
                <time>23.09.2019</time>
              </td>
            </tr>
            <tr class="purse__table-row purse__table-row--history">
              <td class="purse__table-col purse__table-col--td purse__table-col--1-history">
                #43359
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--2-history">
                <?php _e( 'Списание', 'earena_2' ); ?>
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--3-history">
                $11.70
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--4-history">
                <?php _e( 'Create match', 'earena_2' ); ?> #9875
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--5-history">
                <time>23.09.2019</time>
              </td>
            </tr>
            <tr class="purse__table-row purse__table-row--history">
              <td class="purse__table-col purse__table-col--td purse__table-col--1-history">
                #43359
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--2-history">
                <?php _e( 'Пополнение', 'earena_2' ); ?>
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--3-history">
                $11.70
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--4-history">
                <?php _e( 'Win match', 'earena_2' ); ?> #4545543
              </td>
              <td class="purse__table-col purse__table-col--td purse__table-col--5-history">
                <time>23.09.2019</time>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="purse">
      <h3 class="purse__title">
        <?php _e( 'История операций', 'earena_2' ); ?>
      </h3>

      <p class="purse__empty-history">
        <?php _e( 'Пока не было ни одной операциий', 'earena_2' ); ?>
      </p>
    </div>
  </template>
</section>
