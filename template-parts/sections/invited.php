<?php
  // Приглашенные (вкладка)
?>
<?php
  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;
?>

<div class="section section--invited" id="invited">
  <header class="section__header">
    <h2 class="section__title section__title--games-account">
      <?php _e( 'Приглашенные', 'earena_2' ); ?> (<?php $referrals = my_referrals(); echo !empty($referrals) ? count($referrals) : '0'; ?>)
    </h2>

    <div class="section__header-right">
      <span class="visually-hidden" id="invited-link"><?=add_query_arg('ref',$earena_2_user_private->ID,home_url());?></span>

      <button class="section__copy updateclipboard" data-clipboard-target="#invited-link" type="button" name="copy">
        <?=add_query_arg('ref',$earena_2_user_private->ID,home_url());?>
        <span>
          <?php _e( 'Скопировано!', 'earena_2' ); ?>
        </span>
      </button>
    </div>
  </header>

  <?php
    $referrals = my_referrals();

    if ( empty($referrals) ) {
      _e( 'Нет рефералов', 'earena_2' );
    } else {
      global $wpdb;
      ?>
        <ul class="section__list section__list--friends">
          <?php
            foreach ($referrals as $ref) {
              // $money - чо-т не работает... Заменила на earena_2_balance();
              $money = $wpdb->get_var( $wpdb->prepare( "SELECT SUM(amount) FROM `ef_woo_wallet_transactions` WHERE details LIKE %s AND type = 'credit' AND user_id = %d", '%(ref_id='.$ref->ID.')%', $earena_2_user_private->ID ) )?:0;
              ?>
                <li class="section__item section__item--col-2 section__item--friends">
                  <div class="user user--invited">
                    <?php
                      $verified_invited_user = $ref->get('bp_verified_member')==1?true:false;
                      $country_invited_user = mb_strtolower($ref->get('country'));

                      if (!$country_invited_user) {
                        $country_invited_user = ICL_LANGUAGE_CODE;
                      }
                    ?>
                    <div class="user__left">
                      <div class="user__image-wrapper user__image-wrapper--friends <?php if ($verified_invited_user) echo 'user__image-wrapper--verified'; ?>">
                        <?php earena_2_verification_html($verified, 'public'); ?>

                        <a class="user__avatar user__avatar--friends" href="<?=(ea_user_link($ref->ID)?:'#');?>">
                          <?=bp_core_fetch_avatar('item_id='.$ref->ID);?>
                        </a>
                      </div>

                      <div class="user__info user__info--friends">
                        <a class="user__name user__name--friends" href="<?=(ea_user_link($ref->ID)?:'#');?>">
                          <h5>
                            <?=$ref->nickname;?>
                          </h5>
                        </a>

                        <div class="user__country user__country--friends">
                          <img width="28" height="20" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $country_invited_user; ?>.svg" alt="flag">
                        </div>

                        <?php if (is_online($ref->ID)): ?>
                          <div class="user__status user__status--online user__status--friends">
                            Online
                          </div>
                        <?php else : ?>
                          <div class="user__status user__status--friends">
                            <?php
                              echo __( 'Был(а) ', 'earena_2' ) . human_time_diff( strtotime(bp_get_user_last_activity($ref->ID)) ).__(' назад', 'earena_2');
                            ?>
                          </div>
                        <?php endif; ?>

                        <div class="user__rating user__rating--friends">
                          <span>
                            <?php _e( 'Рейтинг', 'earena_2' ); ?>
                          </span>: <?= earena_2_rating($ref)>0 ? earena_2_rating($ref) : 500; ?>
                        </div>
                      </div>
                    </div>
                    <div class="user__right">
                      <div class="user__money user__money--invited">
                        $<?= earena_2_nice_money(earena_2_balance($ref->ID)); ?>
                      </div>
                    </div>
                  </div>
                </li>
              <?php
            }
          ?>
        </ul>
      <?php
    }
  ?>
</div>
