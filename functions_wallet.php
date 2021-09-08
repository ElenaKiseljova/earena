<?php
  //КАССА ВЫВОД СРЕДСТВ
  add_filter('woo_wallet_nav_menu_items', 'add_woo_wallet_nav_menu_items', 11, 2);
  function add_woo_wallet_nav_menu_items($arr, $is_rendred_from_myaccount)
  {
      $arr['transactions'] = array(
          'title' => apply_filters('woo_wallet_account_topup_menu_title', __('История счета', 'earena_2')),
          'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'transactions', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'transactions', home_url('/wallet/')),
          'icon' => 'dashicons dashicons-list-view'
      );
    $arr['withdraw'] = array(
          'title' => apply_filters('woo_wallet_account_topup_menu_title', __('Вывести', 'earena_2')),
          'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'withdraw', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'withdraw', home_url('/wallet/')),
          'icon' => 'dashicons dashicons-arrow-up-alt'
      );
    unset($arr['transaction_details']);
      return $arr;
  }

  if (apply_filters( 'woo_wallet_is_enable_top_up', true ) && ( ( isset( $wp->query_vars['woo-wallet'] ) && 'add' === $wp->query_vars['woo-wallet'] ) || ( isset( $_GET['wallet_action'] ) && 'add' === $_GET['wallet_action'] ) )) {
    add_filter('the_content', 'filter_function_name_add', 1);
    function filter_function_name_add($content)
    {
      ob_start();
        global $wp;
        do_action('woo_wallet_before_my_wallet_content');
        $is_rendred_from_myaccount = wc_post_content_has_shortcode('woo-wallet') ? false : is_account_page();
        $menu_items = apply_filters('woo_wallet_nav_menu_items', array(
            'top_up' => array(
                'title' => apply_filters('woo_wallet_account_topup_menu_title', __('Wallet topup', 'woo-wallet')),
                'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'add', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'add', home_url('/wallet/')),
                'icon' => 'dashicons dashicons-plus-alt'
            ),
            'transfer' => array(
                'title' => apply_filters('woo_wallet_account_transfer_amount_menu_title',
                    __('Wallet transfer', 'woo-wallet')),
                'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint',
                    'woo-wallet'), 'transfer', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action',
                    'transfer', home_url('/wallet/')),
                'icon' => 'dashicons dashicons-randomize'
            ),
        ), $is_rendred_from_myaccount);
        ?>
        <div class="section__content">
          <?php wc_print_notices();?>

          <header class="section__header">
            <h1 class="section__title section__title--wallet">
              <?php the_title(  ); ?>
            </h1>

            <div class="section__header-right section__header-right--wallet">
              <div class="tabs tabs--wallet">
                <?php foreach ($menu_items as $item => $menu_item) : ?>
                    <?php if (apply_filters('woo_wallet_is_enable_' . $item, true)) : ?>
                      <a class="tabs__button tabs__button--wallet <?php if(function_exists('earena_2_current_page')) earena_2_current_page($menu_item['url']); ?> card" href="<?php echo $menu_item['url']; ?>" ><?php echo $menu_item['title']; ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php do_action('woo_wallet_menu_items'); ?>
              </div>
            </div>
          </header>

          <div class="purse">
            <h3 class="purse__title">
              <?php _e( 'Пополнение счета', 'earena_2' ); ?>
            </h3>

            <div class="purse__content">
              <form class="form form--wallet" method="post" action="">
                <div class="form__left form__left--wallet-refill">
                  <div class="form__row-wrapper">
                    <div class="form__row form__row--wallet">
                      <?php
                      $min_amount = woo_wallet()->settings_api->get_option( 'min_topup_amount', '_wallet_settings_general', 0 );
                      $max_amount = woo_wallet()->settings_api->get_option( 'max_topup_amount', '_wallet_settings_general', '' );
                      ?>
                      <input class="form__field form__field--wallet woo-wallet-balance-to-add" type="number" step="0.01" min="<?php echo $min_amount; ?>" max="<?php echo $max_amount; ?>" name="woo_wallet_balance_to_add" id="woo_wallet_balance_to_add" placeholder="<?php _e( 'Сумма ($)', 'earena_2' ); ?>" required="" />
                    </div></div></div>
                <p class="form__text form__text--wallet">
                  <?php _e( 'Укажите сумму для пополнения.<br>Вы сможете вывести свои внесенные средства в любой момент.', 'earena_2' ); ?>
                </p>
                <div class="form__buttons form__buttons--wallet">
                  <?php wp_nonce_field( 'woo_wallet_topup', 'woo_wallet_topup' ); ?>
                  <input class="purse__submit button button--green oo-add-to-wallet" type="submit" name="woo_add_to_wallet" value="<?php _e( 'Пополнить счет', 'earena_2' ); ?>" />
                </div></form>
            </div></div></div>
        <?php
      return ob_get_clean();
    }
  }
  elseif (apply_filters('woo_wallet_is_enable_top_up', true) && ((isset($wp->query_vars['woo-wallet']) && 'withdraw' === $wp->query_vars['woo-wallet']) || (isset($_GET['wallet_action']) && 'withdraw' === $_GET['wallet_action']))) {
      add_filter('the_content', 'filter_function_name_withdraw', 1);
      function filter_function_name_withdraw($content)
      {
      ob_start();
          global $wp;
          do_action('woo_wallet_before_my_wallet_content');
          $is_rendred_from_myaccount = wc_post_content_has_shortcode('woo-wallet') ? false : is_account_page();
          $menu_items = apply_filters('woo_wallet_nav_menu_items', array(
              'top_up' => array(
                  'title' => apply_filters('woo_wallet_account_topup_menu_title', __('Wallet topup', 'woo-wallet')),
                  'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'add', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'add', home_url('/wallet/')),
                  'icon' => 'dashicons dashicons-plus-alt'
              ),
              'transfer' => array(
                  'title' => apply_filters('woo_wallet_account_transfer_amount_menu_title',
                      __('Wallet transfer', 'woo-wallet')),
                  'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint',
                      'woo-wallet'), 'transfer', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action',
                      'transfer', home_url('/wallet/')),
                  'icon' => 'dashicons dashicons-randomize'
              ),
          ), $is_rendred_from_myaccount);


                  $amount = !empty($_POST['woo_wallet_balance_to_withdraw']) ? (float)$_POST['woo_wallet_balance_to_withdraw'] : 0;
                  $min_amount = (float)get_site_option('ea_min_withdraw', 50);
                  $max_amount = (float)balance();
  /*                if (empty($max_amount)) {
            echo '<p style="text-align:center;">' . __('Нет средств на счету.', 'earena_2') . ' (<a href="' . ( $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'add', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'add') ) . '">' . apply_filters('woo_wallet_account_topup_menu_title', __('Wallet topup', 'woo-wallet')) . '</a>)' . '</p>';
          } else*/
          if (!empty($amount) && $amount <= $max_amount && $amount >= $min_amount && wp_verify_nonce($_POST['woo_wallet_withdraw'], 'ef-nonce-withdraw')) {
                      $ea_user = wp_get_current_user();
                      $withdraw = woo_wallet()->wallet->debit($ea_user->ID, (float)$amount, __('Вывод средств', 'earena_2'));
                      $headers = 'From: ' . $ea_user->nickname . ' <' . $ea_user->user_email . '>' . "\r\n";
  //                    $message = __('Пользователь', 'earena_2') . ' ' . $ea_user->nickname . ' ' . __('запросил вывод средств (транзакция #', 'earena_2') . ' ' . $withdraw . __('), на сумму $', 'earena_2') . $amount;
            $message = sprintf( __( 'Пользователь %s запросил вывод средств (транзакция #%d), на сумму', 'earena_2' ), $ea_user->nickname, $withdraw) . ' $'.$amount;
                      @wp_mail((isset($_SERVER['SERVER_NAME'])?'admin@'.$_SERVER['SERVER_NAME']:get_option('admin_email')), __('Запрос на вывод средств #', 'earena_2') . $withdraw, $message, $headers);
                      $admin_id = (int)get_site_option('ea_admin_id', 27);
                      $thread_id = ea_get_thread_id($admin_id);
                      ea_messages_new_message(array(
                          'sender_id' => $ea_user->ID,
                          'thread_id' => $thread_id,
                          'content' => $message,
                      ));
            wc_add_notice(__('Ваша заявка отправлена в обработку', 'earena_2'), 'success');
  //                    echo '<div style="text-align:center;"><p class="reply">' . __('Ваша заявка отправлена в обработку', 'earena_2') . '</p></div>';
  //                    $total_withdraw = (float)get_site_option('total_withdraw');
  //                    update_site_option('total_withdraw', $total_withdraw + $amount);
                  } else {
                              if (isset($_POST['woo_wallet_balance_to_withdraw']) && empty($amount)) {
                      wc_add_notice(__('Укажите сумму', 'earena_2'), 'notice');
          //                        echo '<p style="text-align:center;">' . __('Укажите сумму', 'earena_2') . '</p>';
                              } elseif (isset($_POST['woo_wallet_balance_to_withdraw']) && $amount > $max_amount) {
                      wc_add_notice(__('Сумма больше максимальной', 'earena_2'), 'error');
          //                       echo '<p style="text-align:center;">' . __('Сумма больше максимальной', 'earena_2') . '</p>';
                              } elseif (isset($_POST['woo_wallet_balance_to_withdraw']) && $amount < $min_amount) {
                      wc_add_notice(__('Сумма меньше минимальной', 'earena_2'), 'error');
          //                       echo '<p style="text-align:center;">' . __('Сумма меньше минимальной', 'earena_2') . '</p>';
                              }
                  }
                    ?>
                      <div class="section__content">
                        <?php wc_print_notices();?>

                        <header class="section__header">
                          <h1 class="section__title section__title--wallet">
                            <?php the_title(  ); ?>
                          </h1>
                          <div class="section__header-right section__header-right--wallet">
                            <div class="tabs tabs--wallet">
                              <?php foreach ($menu_items as $item => $menu_item) : ?>
                                  <?php if (apply_filters('woo_wallet_is_enable_' . $item, true)) : ?>
                                    <a class="tabs__button tabs__button--wallet <?php if(function_exists('earena_2_current_page')) earena_2_current_page($menu_item['url']); ?> card" href="<?php echo $menu_item['url']; ?>" ><?php echo $menu_item['title']; ?></a>
                                  <?php endif; ?>
                              <?php endforeach; ?>
                              <?php do_action('woo_wallet_menu_items'); ?>
                            </div>
                          </div>
                        </header>
                        <div class="purse">
                          <h3 class="purse__title">
                            <?php _e( 'Вывод средств', 'earena_2' ); ?>
                          </h3>
                          <div class="purse__content">
                            <form class="form form--wallet" action="" method="post" id="ea_withdraw">
                              <div class="form__left form__left--wallet-withdrawal">
                                <div class="form__row-wrapper">
                                  <div class="form__row form__row--wallet"><input type="number" step="0.1" min="<?php echo $min_amount; ?>"
                                           <?=$max_amount>$min_amount ? 'max="'.$max_amount.'"' : ''; ?> name="woo_wallet_balance_to_withdraw"
                                           id="woo_wallet_balance_to_withdraw" class="form__field form__field--wallet woo-wallet-balance-to-withdraw"
                                           required="" placeholder="<?php _e('Сумма ($)', 'earena_2'); ?>"/></div></div>
                              </div>
                              <p class="form__text form__text--wallet">
                                <?php _e( 'Минимальная сумма для вывода', 'earena_2'); ?>
                                $<?= $min_amount; ?>
                                <br>
                                <?php _e('При выводе средств, комиссия взымается в соответствии с тарифами платёжной системы.', 'earena_2' ); ?>
                              </p>
                              <div class="form__buttons form__buttons--wallet">
                                <?php wp_nonce_field('ef-nonce-withdraw', 'woo_wallet_withdraw'); ?>
                                <input type="submit" name="woo_add_to_wallet" class="purse__submit button button--green woo-add-to-wallet woo-withdraw"
                                       value="<?php _e('Вывести средства', 'earena_2'); ?>"/>
                              </div></form></div></div>
                        <script>
                          (function ($) {
                            const withdrawClick = function () {
                              $('body').on('click', 'input[name=woo_add_to_wallet]', function () {
                                if ($('input[name=woo_add_to_wallet]').prop('disabled') == true) {
                                  return;
                                }
                                $('input[name=woo_add_to_wallet]').addClass('opacity_5');
                                $('input[name=woo_add_to_wallet]').prop('disabled', true);
                                setTimeout(function () {
                                  $('input[name=woo_add_to_wallet]').removeClass('opacity_5');
                                  $('input[name=woo_add_to_wallet]').prop('disabled', false);
                                }, 5000);
                                $('#ea_withdraw').submit();
                              });
                            };
                            withdrawClick();
                          })(jQuery);
                        </script>
              </div>
          <?php
      return ob_get_clean();
      }
  } elseif (apply_filters('woo_wallet_is_enable_top_up', true) && ((isset($wp->query_vars['woo-wallet']) && 'transactions' === $wp->query_vars['woo-wallet']) || (isset($_GET['wallet_action']) && 'transactions' === $_GET['wallet_action']))) {
      add_filter('the_content', 'filter_function_name_transactions', 1);
      function filter_function_name_transactions($content)
      {
      ob_start();
          global $wp;
          do_action('woo_wallet_before_my_wallet_content');
          $is_rendred_from_myaccount = wc_post_content_has_shortcode('woo-wallet') ? false : is_account_page();
          $menu_items = apply_filters('woo_wallet_nav_menu_items', array(
              'top_up' => array(
                  'title' => apply_filters('woo_wallet_account_topup_menu_title', __('Wallet topup', 'woo-wallet')),
                  'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'add', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'add', home_url('/wallet/')),
                  'icon' => 'dashicons dashicons-plus-alt'
              ),
              'transfer' => array(
                  'title' => apply_filters('woo_wallet_account_transfer_amount_menu_title',
                      __('Wallet transfer', 'woo-wallet')),
                  'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint',
                      'woo-wallet'), 'transfer', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action',
                      'transfer', home_url('/wallet/')),
                  'icon' => 'dashicons dashicons-randomize'
              ),
          ), $is_rendred_from_myaccount);
          ?>
          <div class="section__content">
            <?php wc_print_notices();?>

            <header class="section__header">
              <h1 class="section__title section__title--wallet">
                <?php the_title(  ); ?>
              </h1>

              <div class="section__header-right section__header-right--wallet">
                <div class="tabs tabs--wallet">
                  <?php foreach ($menu_items as $item => $menu_item) : ?>
                      <?php if (apply_filters('woo_wallet_is_enable_' . $item, true)) : ?>
                        <a class="tabs__button tabs__button--wallet <?php if(function_exists('earena_2_current_page')) earena_2_current_page($menu_item['url']); ?> card" href="<?php echo $menu_item['url']; ?>" ><?php echo $menu_item['title']; ?></a>
                      <?php endif; ?>
                  <?php endforeach; ?>
                  <?php do_action('woo_wallet_menu_items'); ?>
                </div>
              </div>
            </header>
            <div class="">
              <?php
                    global $wpdb, $wallet_offset;
                    $user_id = get_current_user_id();
                    // $part = $_REQUEST['part'] ?? 1;
                    $total_count = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->base_prefix}woo_wallet_transactions WHERE user_id={$user_id}" );
                    // $wallet_limit = isset($_REQUEST['limit']) ? (int)$_REQUEST['limit'] : 10;
                    // $wallet_offset = isset($part) ? ((int)$part-1)*$wallet_limit : 0;
              //				$wallet_offset = isset($_REQUEST['offset']) ? (int)$_REQUEST['offset'] : 0;
                    /*if ( !empty($wallet_offset) ) {
                      add_filter( 'woo_wallet_transactions_query', 'ea_woo_wallet_transactions_query_offset' );
                      function ea_woo_wallet_transactions_query_offset($query){
                        global $wallet_offset;
                        $query['limit'] = isset($query['limit']) ? $query['limit']." OFFSET " . $wallet_offset : "OFFSET " . $wallet_offset;
                        return $query;
                      }
                    }*/
                    $transactions = get_wallet_transactions( array( 'limit' => apply_filters( 'woo_wallet_transactions_count', $wallet_limit ) ) );
                    if ( ! empty( $transactions ) ) { ?>
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
                    ?>
            </div>
          </div>
          <?php
      return ob_get_clean();
      }
  }
  elseif ( apply_filters( 'woo_wallet_is_enable_transfer', 'on' === woo_wallet()->settings_api->get_option( 'is_enable_wallet_transfer', '_wallet_settings_general', 'on' ) ) && ( ( isset( $wp->query_vars['woo-wallet'] ) && 'transfer' === $wp->query_vars['woo-wallet'] ) || ( isset( $_GET['wallet_action'] ) && 'transfer' === $_GET['wallet_action'] ) ) ) {
    add_filter( 'woocommerce_is_account_page', function(){
      return true;
    } );
    add_action('wp_enqueue_scripts', function(){
      $scripts = new Woo_Wallet_Frontend;
      $scripts->woo_wallet_styles();
    }, 20);
    add_filter('the_content', 'filter_function_name_transfer', 1);
      function filter_function_name_transfer($content)
      {
      ob_start();
          do_action('woo_wallet_before_my_wallet_content');
          $is_rendred_from_myaccount = wc_post_content_has_shortcode('woo-wallet') ? false : is_account_page();
          $menu_items = apply_filters('woo_wallet_nav_menu_items', array(
              'top_up' => array(
                  'title' => apply_filters('woo_wallet_account_topup_menu_title', __('Wallet topup', 'woo-wallet')),
                  'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint', 'woo-wallet'), 'add', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action', 'add', home_url('/wallet/')),
                  'icon' => 'dashicons dashicons-plus-alt'
              ),
              'transfer' => array(
                  'title' => apply_filters('woo_wallet_account_transfer_amount_menu_title',
                      __('Wallet transfer', 'woo-wallet')),
                  'url' => $is_rendred_from_myaccount ? esc_url(wc_get_endpoint_url(get_option('woocommerce_woo_wallet_endpoint',
                      'woo-wallet'), 'transfer', wc_get_page_permalink('myaccount'))) : add_query_arg('wallet_action',
                      'transfer', home_url('/wallet/')),
                  'icon' => 'dashicons dashicons-randomize'
              ),
          ), $is_rendred_from_myaccount);
          ?>
          <div class="section__content">
            <?php wc_print_notices();?>

            <header class="section__header">
              <h1 class="section__title section__title--wallet">
                <?php the_title(  ); ?>
              </h1>

              <div class="section__header-right section__header-right--wallet">
                <div class="tabs tabs--wallet">
                  <?php foreach ($menu_items as $item => $menu_item) : ?>
                      <?php if (apply_filters('woo_wallet_is_enable_' . $item, true)) : ?>
                        <a class="tabs__button tabs__button--wallet <?php if(function_exists('earena_2_current_page')) earena_2_current_page($menu_item['url']); ?> card" href="<?php echo $menu_item['url']; ?>" ><?php echo $menu_item['title']; ?></a>
                      <?php endif; ?>
                  <?php endforeach; ?>
                  <?php do_action('woo_wallet_menu_items'); ?>
                </div>
              </div>
            </header>
            <div class="purse">
              <h3 class="purse__title">
                <?php _e( 'Перевести средства игроку', 'earena_2' ); ?>
              </h3>

              <div class="purse__content">
                <form class="form form--wallet-transaction" action="" method="post" id="woo_wallet_transfer_form">
                  <div class="form__left form__left--grid">
                    <div class="form__row-wrapper form__row-wrapper--grid">
                      <div class="form__row form__row--transaction">
                        <label for="woo_wallet_transfer_user_id"><?php _e( 'Email игрока', 'earena_2' ); ?></label><select name="woo_wallet_transfer_user_id" class="woo-wallet-select2" required=""></select>
                      </div>
                    </div>
                    <div class="form__row-wrapper form__row-wrapper--grid">
                      <div class="form__row">
                        <input class="form__field form__field--wallet" type="number"
                          step="0.1"
                          min="<?php echo woo_wallet()->settings_api->get_option('min_transfer_amount', '_wallet_settings_general', 0); ?>"
              						<?=balance()>=(float)woo_wallet()->settings_api->get_option('min_transfer_amount', '_wallet_settings_general', 0)*105/100 ? 'max="' . floor(balance()*10000/105)/100 . '"' : ''; ?>
                          name="woo_wallet_transfer_amount" required="" placeholder="<?php _e('Сумма ($)', 'earena_2'); ?>" id="ea-transfer-amount">
                      </div>
                      <span class="form__error"><?php _e( 'Недостаточно средств <br>Необходимо иметь на счету', 'earena_2' ); ?> $5 050</span>
                    </div>
                    <div class="form__row-wrapper form__row-wrapper--grid">
                      <div class="form__row form__row--message-transaction">
                        <textarea class="form__field form__field--wallet form__field--message-transaction" name="woo_wallet_transfer_note" placeholder="<?php _e( 'Комментарий (необязательно)', 'earena_2' ); ?>"></textarea>
                      </div>
                      <span class="form__error"><?php _e( 'Error', 'earena_2' ); ?></span>
                    </div>
                    <p class="form__text form__text--wallet form__text--grid">
                      <?php _e( 'Комиссия сервиса', 'earena_2' ); ?> – 5%
                    </p>
                  </div>

                  <div class="form__buttons form__buttons--wallet">
                    <?php wp_nonce_field( 'woo_wallet_transfer', 'woo_wallet_transfer' ); ?>
                    <input type="submit" class="purse__submit button button--green" name="woo_wallet_transfer_fund" value="<?php _e( 'Proceed to transfer', 'woo-wallet' ); ?>" />
                  </div>
                </form>
              </div>
            </div>
          </div>
          <script>
            (function ($) {
              const transferTotal = function () {
                  $('.ef-wallet #ea-transfer-amount').on('change click keyup blur select', function () {
                      var amount = Number($(this).val());
                      var total = Math.round(amount.toFixed(3) * 105) / 100;
                      if (total == 0) {
                        result = '--'
                      } else {
                        result = '<strong>$'+total+'</strong>'
                      }
                      //var total = amount * 1.05
                      //console.log(result);
                      $('.ef-wallet #ea-transfer-amount-with-comission').html(result);
                  })
              }
              transferTotal();
            })(jQuery);
          </script>
      <?php do_action( 'woo_wallet_after_my_wallet_content' );
      return ob_get_clean();
    }
  }

  add_action( 'template_redirect', function(){
  if ( is_page(298) && ( !isset($_GET['wallet_action']) || '' === $_GET['wallet_action'] ) ) {
    wp_redirect(add_query_arg('wallet_action', 'transactions'));die();
  }
  });

  // Покупка VIP
  function buy_vip($m = 0, $id = 0)
  {
      if (!is_user_logged_in()) {
          return ['success' => 0, 'message' => __('Пользователь не залогинился', 'earena_2')];
      }
      $ea_user = $id == 0 ? wp_get_current_user() : get_user_by('id', $id);
      if (!($ea_user instanceof WP_User)) {
          return ['success' => 0, 'message' => __('Пользователь не определён', 'earena_2')];
      }
      $price = 0;
      switch ($m) {
          case 0:
              return ['success' => 0, 'message' => __('Не указано время', 'earena_2')];//'0 месяцев'
              break;
          case 1:
              $price = 2;
              break;
          case 3:
              $price = 4;
              break;
          case 12:
              $price = 10;
              break;
      }
      $balance = woo_wallet()->wallet->get_wallet_balance($ea_user->ID, '');
      if (empty($price) || (float)$price > (float)$balance) {
          return ['success' => 0, 'message' => __('Недостаточно средств', 'earena_2')];
      }
      $bet = woo_wallet()->wallet->debit($ea_user->ID, (float)$price,
          __('Покупка VIP на', 'earena_2') . ' ' . pluralize($m, __('месяц', 'earena_2'), __('месяца', 'earena_2'),
              __('месяцев', 'earena_2')));
      if (!$bet) {
          return ['success' => 0, 'message' => __('Не получилось списать средства.', 'earena_2')];
      }
      $time = (!empty($ea_user->get('vt')) && $ea_user->get('vt') > time()) ? $ea_user->get('vt') : time();
      $process = $time > time() ? __('VIP продлен', 'earena_2') : __('Куплен VIP', 'earena_2');
      $vt = mktime(23, 59, 59, date("m", $time) + $m, date("d", $time), date("Y", $time));
      update_metadata('user', $ea_user->ID, 'vip', 1);
      update_metadata('user', $ea_user->ID, 'vt', $vt);
      if ($vt == $ea_user->get('vt')) {
          return [
              'date' => date('d.m.Y', $vt),
              'success' => 1,
              'message' => $process . ' ' . __('на', 'earena_2') . ' ' . pluralize($m, __('месяц', 'earena_2'), __('месяца', 'earena_2'),
                      __('месяцев', 'earena_2')) . ' ' . __('по', 'earena_2') . ' ' . date('d.m.Y', $vt)
          ];
      }

      return ['success' => 0, 'message' => __('Ошибка', 'earena_2')];
  }
?>
