<?php
  // Эта переменная используется в шаблонах 'public'
  global $earena_2_user_public;
  $ea_user = $earena_2_user_public;

  $vip = $ea_user->get('vip');
  if ($vip) {
    $vip_time = date('d.m.y', get_user_meta( $ea_user->ID, 'vt', true ));
  }

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
?>

<header class="account__header <?php if ($vip && !$blocked) {echo 'account__header--vip';} else if ($blocked) {echo 'account__header--blocked';} ?>">
  <div class="account__left">
    <div class="user user--account">
      <div class="user__image-wrapper user__image-wrapper--account <?php if ($verified) echo 'user__image-wrapper--verified'; ?>">
        <?php earena_2_verification_html($verified, 'public'); ?>

        <div class="user__avatar user__avatar--account">
          <?= bp_core_fetch_avatar('item_id=' . $ea_user->ID); ?>
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

        <div class="user__rating user__rating--account user__rating--account-public">
          <span>
            <?php _e( 'Рейтинг', 'earena_2' ); ?>
          </span>: <?= rating(); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="account__right">
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

    <div class="account__buttons">
      <?php
        // Выводит кнопки Удалить из друзей / Добавить в друзья и Сообщение
        earena_2_page_profile_public_friends_buttons($ea_user->ID);
      ?>
    </div>
  </div>
</header>
