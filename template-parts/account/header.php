<?php
  global $ea_user;
  $username = get_query_var('username');
  if (empty($username) && is_user_logged_in()) {
    $ea_user = wp_get_current_user();
  } elseif (!empty($username)) {
    $ea_user = get_user_by('slug',$username);
  //		$ea_user = get_user_by('id',EArena_DB::get_ea_user_id( $username ));
  } else {
    wp_redirect( add_query_arg('action', 'login', home_url() ) );exit;
  }

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

<header class="account__header <?php if ($vip && is_user_logged_in()) echo 'account__header--vip'; ?>">
  <div class="account__left">
    <div class="user user--account">
      <div class="user__image-wrapper <?php if ($verified) { echo 'user__image-wrapper--verified'; } else { echo 'user__image-wrapper--main'; } ?>">
        <?php if (!$verified): ?>
          <button class="verify openpopup" data-popup="verification" type="button" name="verification">
            <span class="visually-hidden">
              <?php _e( 'Верификация', 'earena_2' ); ?>
            </span>
          </button>
        <?php endif; ?>
        <?php if (is_user_logged_in()): ?>
          <div class="user__avatar user__avatar--account">
            <input class="user__avatar-input visually-hidden" type="file" name="account-image" id="account-image">
            <label class="user__avatar-label" for="account-image">
              <span class="visually-hidden">
                <?php _e( 'Загрузить аватар', 'earena_2' ); ?>
              </span>
            </label>
            <?= bp_core_fetch_avatar('item_id=' . $ea_user->ID); ?>
          </div>
        <?php else : ?>
          <div class="user__avatar user__avatar--account account__image--public">
            <!-- <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar.png" alt="<?php the_title(  ); ?>"> -->
            <img width="100" height="100" src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-default.svg" alt="<?php the_title(  ); ?>">
          </div>
        <?php endif; ?>
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
          <span class="user__money-amount user__money-amount--account">
            $<span><?= earena_2_nice_money(balance()); ?></span>
          </span>
        </div>

        <div class="user__rating user__rating--account">
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
        <span>
          😌
        </span>
      </li>
      <li class="account__emoji-item <?php echo ($yellow_cards < 3 && $yellow_cards > 0) ? 'active' : ''; ?>">
        <span>
          😬
        </span>
      </li>
      <li class="account__emoji-item <?php echo $yellow_cards >= 3 ? 'active' : ''; ?>">
        <span>
          😵
        </span>
      </li>
    </ul>

    <div class="account__buttons">
      <?php if (is_user_logged_in()): ?>
        <!-- Пополнить счет -->
        <a class="button button--green" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add">
          <span>
            <?php _e( 'Пополнить счет', 'earena_2' ); ?>
          </span>
        </a>

        <?php if ($vip): ?>
          <div class="account__vip account__vip--active button button--orange">
            <span>
              <?php _e( 'VIP статус до', 'earena_2' ); ?> <time><?= $vip_time; ?></time>
            </span>
          </div>
        <?php else : ?>
          <a class="account__vip <?php if ($vip) echo 'account__vip--active'; ?> button button--orange" href="<?php echo bloginfo( 'url' ); ?>/wallet/?wallet_action=add">
            <span>
              <?php _e( 'VIP статус', 'earena_2' ); ?>
            </span>
          </a>
        <?php endif; ?>

      <?php else : ?>
        <!-- Удалить из друзей / Добавить в друзья -->
        <button class="button button--gray" type="button" name="ended">
          <span>
            <?php _e( 'Добавить в друзья', 'earena_2' ); ?>
          </span>
        </button>

        <button class="account__message button button--blue openpopup" data-popup="add" type="button" name="add">
          <span>
            <?php _e( 'Сообщение', 'earena_2' ); ?>
          </span>
        </button>
      <?php endif; ?>
    </div>
  </div>
</header>
