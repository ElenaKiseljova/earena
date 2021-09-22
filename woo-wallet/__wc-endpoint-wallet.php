<?php
/**
 * The Template for displaying wallet recharge form
 *
 * This template can be overridden by copying it to yourtheme/woo-wallet/wc-endpoint-wallet.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @author 	Subrata Mal
 * @version     1.1.8
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

global $wp;
do_action( 'woo_wallet_before_my_wallet_content' );
$is_rendred_from_myaccount = wc_post_content_has_shortcode( 'woo-wallet' ) ? false : is_account_page();
$menu_items = apply_filters('woo_wallet_nav_menu_items', array(
    'top_up' => array(
        'title' => apply_filters( 'woo_wallet_account_topup_menu_title', __( 'Wallet topup', 'woo-wallet' ) ),
        'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'add', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'add'),
        'icon' => 'dashicons dashicons-plus-alt'
    ),
    'transfer' => array(
        'title' => apply_filters('woo_wallet_account_transfer_amount_menu_title', __( 'Перевод игроку', 'earena_2' )),
        'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'transfer', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'transfer'),
        'icon' => 'dashicons dashicons-randomize'
    )
), $is_rendred_from_myaccount);
?>

<div class="woo-wallet-my-wallet-container">
    <div class="woo-wallet-sidebar">
        <h3 class="woo-wallet-sidebar-heading"><a href="<?php echo $is_rendred_from_myaccount ? esc_url( wc_get_account_endpoint_url( get_option( 'woocommerce_woo_wallet_endpoint', 'woo-wallet' ) ) ) : get_permalink(); ?>"><?php echo apply_filters( 'woo_wallet_account_menu_title', __( 'My Wallet', 'woo-wallet' ) ); ?></a></h3>
        <ul>
            <?php foreach ($menu_items as $item => $menu_item) : ?>
                <?php if (apply_filters('woo_wallet_is_enable_' . $item, true)) : ?>
                    <li class="card"><a href="<?php echo $menu_item['url']; ?>" ><span class="<?php echo $menu_item['icon'] ?>"></span><p><?php echo $menu_item['title']; ?></p></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php do_action('woo_wallet_menu_items'); ?>
        </ul>
    </div>
    <div class="woo-wallet-content">
        <div class="woo-wallet-content-heading">
            <h3 class="woo-wallet-content-h3"><?php _e( 'Balance', 'woo-wallet' ); ?></h3>
            <p class="woo-wallet-price"><?php echo woo_wallet()->wallet->get_wallet_balance( get_current_user_id() ); ?></p>
        </div>
        <div style="clear: both"></div>
        <hr/>
        <?php if ( ( isset( $wp->query_vars['woo-wallet'] ) && ! empty( $wp->query_vars['woo-wallet'] ) ) || isset( $_GET['wallet_action'] ) ) { ?>
            <?php if ( apply_filters( 'woo_wallet_is_enable_top_up', true ) && ( ( isset( $wp->query_vars['woo-wallet'] ) && 'add' === $wp->query_vars['woo-wallet'] ) || ( isset( $_GET['wallet_action'] ) && 'add' === $_GET['wallet_action'] ) ) ) { ?>
                <form method="post" action="">
                    <div class="woo-wallet-add-amount">
                        <label for="woo_wallet_balance_to_add"><?php _e( 'Enter amount', 'woo-wallet' ); ?></label>
                        <?php
                        $min_amount = woo_wallet()->settings_api->get_option( 'min_topup_amount', '_wallet_settings_general', 0 );
                        $max_amount = woo_wallet()->settings_api->get_option( 'max_topup_amount', '_wallet_settings_general', '' );
                        ?>
                        <input type="number" step="0.01" min="<?php echo $min_amount; ?>" max="<?php echo $max_amount; ?>" name="woo_wallet_balance_to_add" id="woo_wallet_balance_to_add" class="woo-wallet-balance-to-add" required="" />
                        <?php wp_nonce_field( 'woo_wallet_topup', 'woo_wallet_topup' ); ?>
                        <input type="submit" name="woo_add_to_wallet" class="woo-add-to-wallet" value="<?php _e( 'Add', 'woo-wallet' ); ?>" />
                    </div>
                </form>
            <?php } else if ( apply_filters( 'woo_wallet_is_enable_transfer', 'on' === woo_wallet()->settings_api->get_option( 'is_enable_wallet_transfer', '_wallet_settings_general', 'on' ) ) && ( ( isset( $wp->query_vars['woo-wallet'] ) && 'transfer' === $wp->query_vars['woo-wallet'] ) || ( isset( $_GET['wallet_action'] ) && 'transfer' === $_GET['wallet_action'] ) ) ) { ?>
                <form method="post" action="" id="woo_wallet_transfer_form">
                    <p class="woo-wallet-field-container form-row form-row-wide">
                        <label for="woo_wallet_transfer_user_id"><?php _e( 'Select whom to transfer', 'woo-wallet' ); ?> <?php
                            if ( apply_filters( 'woo_wallet_user_search_exact_match', true ) ) {
                                _e( '(Email)', 'woo-wallet' );
                            }
                            ?></label>
                        <select name="woo_wallet_transfer_user_id" class="woo-wallet-select2" required=""></select>
                    </p>
                    <p class="woo-wallet-field-container form-row form-row-wide">
                        <label for="woo_wallet_transfer_amount"><?php _e( 'Amount', 'woo-wallet' ); ?></label>
                        <input type="number" step="0.01" min="<?php echo woo_wallet()->settings_api->get_option('min_transfer_amount', '_wallet_settings_general', 0); ?>" name="woo_wallet_transfer_amount" required=""/>
                    </p>
                    <p class="woo-wallet-field-container form-row form-row-wide">
                        <label for="woo_wallet_transfer_note"><?php _e( 'What\'s this for', 'woo-wallet' ); ?></label>
                        <textarea name="woo_wallet_transfer_note"></textarea>
                    </p>
                    <p class="woo-wallet-field-container form-row">
                        <?php wp_nonce_field( 'woo_wallet_transfer', 'woo_wallet_transfer' ); ?>
                        <input type="submit" class="button" name="woo_wallet_transfer_fund" value="<?php _e( 'Proceed to transfer', 'woo-wallet' ); ?>" />
                    </p>
                </form>
            <?php } ?>
            <?php do_action( 'woo_wallet_menu_content' ); ?>
        <?php } else if ( apply_filters( 'woo_wallet_is_enable_transaction_details', true ) ) { ?>
            <?php $transactions = get_wallet_transactions( array( 'limit' => apply_filters( 'woo_wallet_transactions_count', 10 ) ) ); ?>
            <?php if ( ! empty( $transactions ) ) { ?>
                <ul class="woo-wallet-transactions-items">
                    <?php foreach ( $transactions as $transaction ) : ?>
                        <li>
                            <div>
                                <p><?php echo $transaction->details; ?></p>
                                <small><?php echo wc_string_to_datetime( $transaction->date )->date_i18n( wc_date_format() ); ?></small>
                            </div>
                            <div class="woo-wallet-transaction-type-<?php echo $transaction->type; ?>"><?php
                                echo $transaction->type == 'credit' ? '+' : '-';
                                echo wc_price( apply_filters( 'woo_wallet_amount', $transaction->amount, $transaction->currency, $transaction->user_id ), woo_wallet_wc_price_args($transaction->user_id) );
                                ?></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php
            } else {
                _e( 'No transactions found', 'woo-wallet' );
            }
        }
        ?>
    </div>
</div>

<section class="section section--purse" id="purse">
  <div class="section__wrapper">
    <header class="section__header">
      <h1 class="section__title section__title--purse">
        <?php the_title(  ); ?>
      </h1>

      <div class="section__header-right section__header-right--purse">
        <div class="tabs tabs--purse">
          <?php foreach ($menu_items as $item => $menu_item) : ?>
              <?php if (apply_filters('woo_wallet_is_enable_' . $item, true)) : ?>
                <a class="tabs__button tabs__button--purse <?= earena_2_current_page($menu_item['url']) ? 'active' : ''; ?> card" href="<?php echo $menu_item['url']; ?> card" href="<?php echo $menu_item['url']; ?>" >
                  <?php echo $menu_item['title']; ?>
                </a>
              <?php endif; ?>
          <?php endforeach; ?>
          <?php do_action('woo_wallet_menu_items'); ?>
        </div>
      </div>
    </header>

    <div class="section__content">
      <?php if ( ( isset( $wp->query_vars['woo-wallet'] ) && ! empty( $wp->query_vars['woo-wallet'] ) ) || isset( $_GET['wallet_action'] ) ) { ?>
          <?php if ( apply_filters( 'woo_wallet_is_enable_top_up', true ) && ( ( isset( $wp->query_vars['woo-wallet'] ) && 'add' === $wp->query_vars['woo-wallet'] ) || ( isset( $_GET['wallet_action'] ) && 'add' === $_GET['wallet_action'] ) ) ) { ?>
            <div class="purse">
              <h3 class="purse__title">
                <?php _e( 'Пополнение счета', 'earena_2' ); ?>
              </h3>

              <div class="purse__content">
                <form class="form form--purse" method="post" action="">
                  <div class="form__left form__left--purse-refill">
                    <div class="form__row-wrapper">
                      <div class="form__row form__row--purse">
                        <?php
                        $min_amount = woo_wallet()->settings_api->get_option( 'min_topup_amount', '_wallet_settings_general', 0 );
                        $max_amount = woo_wallet()->settings_api->get_option( 'max_topup_amount', '_wallet_settings_general', '' );
                        ?>
                        <input class="form__field form__field--purse woo-wallet-balance-to-add" type="number" step="0.01" min="<?php echo $min_amount; ?>" max="<?php echo $max_amount; ?>" name="woo_wallet_balance_to_add" id="woo_wallet_balance_to_add" placeholder="<?php _e( 'Сумма ($)', 'earena_2' ); ?>" required="" />
                      </div>
                    </div>
                  </div>

                  <label class="form__text form__text--purse" for="woo_wallet_balance_to_add">
                    <?php _e( 'Укажите сумму для пополнения.<br>Вы сможете вывести свои внесенные средства в любой момент.', 'earena_2' ); ?>
                  </label>

                  <?php wp_nonce_field( 'woo_wallet_topup', 'woo_wallet_topup' ); ?>
                  <input class="form__submit form__submit--purse button button--green oo-add-to-wallet" type="submit" name="woo_add_to_wallet" value="<?php _e( 'Пополнить счет', 'earena_2' ); ?>" />
                </form>
              </div>
            </div>
          <?php } else if ( apply_filters( 'woo_wallet_is_enable_transfer', 'on' === woo_wallet()->settings_api->get_option( 'is_enable_wallet_transfer', '_wallet_settings_general', 'on' ) ) && ( ( isset( $wp->query_vars['woo-wallet'] ) && 'transfer' === $wp->query_vars['woo-wallet'] ) || ( isset( $_GET['wallet_action'] ) && 'transfer' === $_GET['wallet_action'] ) ) ) { ?>
            <div class="purse">
              <h3 class="purse__title">
                <?php _e( 'Перевести средства игроку', 'earena_2' ); ?>
              </h3>

              <div class="purse__content">
                <form class="form form--purse-transaction" method="post" action="" id="woo_wallet_transfer_form">
                  <div class="form__left form__left--grid">
                    <div class="form__row-wrapper form__row-wrapper--grid">
                      <div class="form__row">
                        <input class="form__field form__field--purse" id="transfer-name" type="text" name="transfer-name" required placeholder="<?php _e( 'Логин игрока', 'earena_2' ); ?>">
                        <label class="visually-hidden" for="woo_wallet_transfer_user_id">
                          <?php _e( 'Select whom to transfer', 'woo-wallet' ); ?>
                          <?php
                            if ( apply_filters( 'woo_wallet_user_search_exact_match', true ) ) {
                                _e( '(Email)', 'woo-wallet' );
                            }
                          ?>
                        </label>
                        <select name="woo_wallet_transfer_user_id" class="visually-hidden woo-wallet-select2" required=""></select>
                      </div>
                    </div>
                    <div class="form__row-wrapper form__row-wrapper--grid">
                      <div class="form__row">
                        <input class="form__field form__field--purse" type="number" step="0.01" min="<?php echo woo_wallet()->settings_api->get_option('min_transfer_amount', '_wallet_settings_general', 0); ?>" name="woo_wallet_transfer_amount" required="" placeholder="<?php _e( 'Сумма ($)', 'earena_2' ); ?>" />
                      </div>
                      <span class="form__error"><?php _e( 'Недостаточно средств <br>Необходимо иметь на счету', 'earena_2' ); ?> $5 050</span>
                    </div>
                    <div class="form__row-wrapper form__row-wrapper--grid">
                      <div class="form__row form__row--message-transaction">
                        <textarea class="form__field form__field--purse form__field--message-transaction" name="woo_wallet_transfer_note" placeholder="<?php _e( 'Комментарий (необязательно)', 'earena_2' ); ?>"></textarea>
                      </div>
                    </div>
                    <p  class="form__text form__text--purse form__text--grid">
                      <?php _e( 'Комиссия сервиса', 'earena_2' ); ?> – 5%
                    </p>
                  </div>

                  <?php wp_nonce_field( 'woo_wallet_transfer', 'woo_wallet_transfer' ); ?>
                  <input class="form__submit form__submit--purse button button--green" type="submit" name="woo_wallet_transfer_fund" value="<?php _e( 'Перевести', 'earena_2' ); ?>" />
                </form>
              </div>
            </div>
          <?php } ?>
          <?php do_action( 'woo_wallet_menu_content' ); ?>
      <?php } else if ( apply_filters( 'woo_wallet_is_enable_transaction_details', true ) ) { ?>
          <?php $transactions = get_wallet_transactions( array( 'limit' => apply_filters( 'woo_wallet_transactions_count', 10 ) ) ); ?>
          <?php if ( ! empty( $transactions ) ) { ?>
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
                      <?php foreach ( $transactions as $transaction ) : ?>
                        <tr class="purse__table-row purse__table-row--history">
                          <td class="purse__table-col purse__table-col--td purse__table-col--1-history">
                            <?= $transaction->transaction_id; ?>
                          </td>
                          <td class="purse__table-col purse__table-col--td purse__table-col--2-history">
                            <?php
                              echo $transaction->type == 'credit' ? __( 'Пополнение', 'earena_2' ) : __( 'Списание', 'earena_2' );
                            ?>
                          </td>
                          <td class="purse__table-col purse__table-col--td purse__table-col--3-history">
                            <?php echo wc_price( apply_filters( 'woo_wallet_amount', $transaction->amount, $transaction->currency, $transaction->user_id ), woo_wallet_wc_price_args($transaction->user_id) ); ?>
                          </td>
                          <td class="purse__table-col purse__table-col--td purse__table-col--4-history">
                            <?php echo $transaction->details; ?>
                          </td>
                          <td class="purse__table-col purse__table-col--td purse__table-col--5-history">
                            <time><?php echo wc_string_to_datetime( $transaction->date )->date_i18n( wc_date_format() ); ?></time>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            <?php
          } else {
            ?>
              <div class="purse">
                <h3 class="purse__title">
                  <?php _e( 'История операций', 'earena_2' ); ?>
                </h3>

                <p class="purse__empty-history">
                  <?php _e( 'Пока не было ни одной операциий', 'earena_2' ); ?>
                </p>
              </div>
            <?php
          }
      }
      ?>
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

          <button class="form__submit form__submit--purse button button--green openpopup" data-popup="purse" type="submit" disabled name="purse-refill-submit">
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

          <button class="form__submit form__submit--purse button button--green openpopup" data-popup="purse" type="submit" disabled name="withdrawal">
            <span>
              <?php _e( 'Вывести средства', 'earena_2' ); ?>
            </span>
          </button>
        </form>
      </div>
    </div>
    <!-- Табличка ниже - не перенесена в рабочий кошелёк. Она (вроде как) не нужна. -->
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

          <button class="form__submit form__submit--purse button button--green openpopup" data-popup="purse" type="submit" disabled name="transaction">
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

<?php do_action( 'woo_wallet_after_my_wallet_content' );
