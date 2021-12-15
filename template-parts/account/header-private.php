<?php
  // Эта переменная используется в шаблонах 'private'
  global $earena_2_user_private;
  $ea_user = $earena_2_user_private ?? wp_get_current_user();

  $vip = $ea_user->get('vip') ?: false;
  $vip_time = $ea_user->get('vt') ?: 0;

  $stream = $ea_user->get('stream')?:null;

  $verified = $ea_user->get('bp_verified_member')==1?true:false;

  /* Smiles */
  $blocked = $ea_user->get('blocked')?:false;
  $yellow_cards = $ea_user->get('yc')?:0;
  $blocked = $yellow_cards>=3?true:$blocked;

  $country = mb_strtolower($ea_user->get('country'));

  if (!$country) {
    $country = ICL_LANGUAGE_CODE;
  }

  $is_profile = is_page(503);
?>

<header class="account__header <?= ($vip && !$blocked) ? 'account__header--vip' : ($blocked ? 'account__header--blocked' : ''); ?> <?= $is_profile ? '' : 'account__header--mobile-hide'; ?>">
  <div class="account__left">
    <div class="user user--account">
      <div class="user__image-wrapper user__image-wrapper--account <?= $verified ? 'user__image-wrapper--verified' : ''; ?>">
        <?php earena_2_verification_html($verified, 'private'); ?>

        <div class="user__avatar user__avatar--account">
          <button class="user__avatar-change openpopup" data-popup="avatar" type="button" name="change">
            <span class="visually-hidden">
              <?php _e( 'Открыть попап для выбора аватара', 'earena_2' ); ?>
            </span>
          </button>
          <?= bp_core_fetch_avatar(['item_id' => $ea_user->ID, 'type' => 'full', 'width' => 100, 'height' => 100]); ?>
        </div>
      </div>

      <div class="user__info user__info--account">
        <h1 class="user__name user__name--account">
          <?=$ea_user->nickname;?>
        </h1>

        <div class="user__country user__country--account">
          <img width="28" height="20" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $country; ?>.svg" alt="flag">
        </div>

        <?php if (is_online($ea_user->ID)): ?>
          <div class="user__status user__status--account user__status--online">
            Online
          </div>
        <?php else : ?>
          <div class="user__status user__status--account">
            <?php
              echo __( 'Был(а) ', 'earena_2' ) . human_time_diff( strtotime(bp_get_user_last_activity($ea_user->ID)) ).__(' назад', 'earena_2');
            ?>
          </div>
        <?php endif; ?>

        <div class="user__money user__money--account">
          <span class="user__money-amount user__money-amount--account user__money-amount--account-private">
            $<span><?= earena_2_nice_money(balance()); ?></span>
          </span>
        </div>

        <div class="user__rating user__rating--account">
          <span class="user__rating-text">
            <?php _e( 'Рейтинг', 'earena_2' ); ?>
          </span>:
          <span class="user__rating-value user__rating-value--account-private">
            <?= rating(); ?>
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="account__right">
    <?php if (!$blocked): ?>
      <div class="account__buttons account__buttons--top">
        <ul class="account__emoji">
          <li class="account__emoji-item <?php echo $yellow_cards < 1 ? 'active' : ''; ?>">
            <img width="30" height="30" src="<?php echo get_template_directory_uri(); ?>/assets/img/smile-good.svg" alt="<?php _e( 'Нет предупреждений', 'earena_2' ); ?>">
          </li>
          <li class="account__emoji-item <?php echo ($yellow_cards < 3 && $yellow_cards > 0) ? 'active' : ''; ?>">
            <img width="30" height="30" src="<?php echo get_template_directory_uri(); ?>/assets/img/smile-not-so-bad.svg" alt="<?php _e( 'Есть предупреждения', 'earena_2' ); ?>">
          </li>
          <li class="account__emoji-item <?php echo $yellow_cards >= 3 ? 'active' : ''; ?>">
            <img width="30" height="30" src="<?php echo get_template_directory_uri(); ?>/assets/img/smile-bad.svg" alt="<?php _e( 'Пользователь заблокирован', 'earena_2' ); ?>">
          </li>
        </ul>
      </div>

      <div class="account__buttons account__buttons--bottom">
        <a class="account__topup button button--green" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add">
          <span>
            <?php _e( 'Пополнить счет', 'earena_2' ); ?>
          </span>
        </a>

        <?php if ($vip): ?>
          <div class="account__vip account__vip--active button button--orange">
            <span>
              <?php _e( 'VIP статус до', 'earena_2' ); ?> <time><?= date("d.m.Y", $vip_time); ?></time>
            </span>
          </div>
        <?php else : ?>
          <a class="account__vip <?php if ($vip) echo 'account__vip--active'; ?> button button--orange" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add#vip">
            <span>
              <?php _e( 'VIP статус', 'earena_2' ); ?>
            </span>
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</header>
