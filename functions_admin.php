<?php
  /* ==============================================
  ********  //Поиск пользователей
  =============================================== */
  add_action('wp_ajax_earena_2_get_users', 'earena_2_get_users');
  function earena_2_get_users($name = '')
  {
      $name = empty($name) ? $_POST['search'] : $name;
      $blogusers = get_users('search=*' . $name . '*');
      if (!empty($blogusers)) {
          ob_start();
          echo '<ul class="search__list">';
          foreach ($blogusers as $user) {
              $user_id = $user->ID;
              ?>
                <li class="search__item">
                  <a class="user user--search" href="<?= ea_user_link($user_id); ?>">
                    <div class="user__avatar user__avatar--search">
                      <?= bp_core_fetch_avatar('item_id=' . $user_id); ?>
                    </div>

                    <div class="user__info user__info--search">
                      <div class="user__name user__name--search">
                        <h5>
                          <?= get_user_meta($user_id, 'nickname', true); ?>
                        </h5>
                      </div>
                      <p class="user__email user__email--search">
                        <?= $user->user_email; ?>
                      </p>
                    </div>

                    <?php if ( (int)get_user_meta($user_id, 'bp_verified_member', true) !== 1 ): ?>
                      <span class="verify verify--false verify--search">
                        <span class="visually-hidden">
                          <?php _e( 'Не верифицированный игрок', 'earena_2' ); ?>
                        </span>
                      </span>
                    <?php else : ?>
                      <span class="verify verify--true verify--search">
                        <span class="visually-hidden">
                          <?php _e( 'Верифицированный игрок', 'earena_2' ); ?>
                        </span>
                      </span>
                    <?php endif; ?>
                  </a>
                </li>
              <?php
          }
          echo '</ul>';
          wp_send_json(json_encode(['success' => 1, 'content' => ob_get_clean()]));
          wp_die();
      } else {
          wp_send_json(json_encode([
              'success' => 0,
              'content' => '<span>' . __('Пользователи', 'earena') . ' "' . $name . '" ' . __('не найдены', 'earena') . '</span>'
          ]));
          wp_die();
      }
  }

  /* ==============================================
  ********  //Верификация пользователя
  =============================================== */
  function ea_get_verification_requests()
  {
      return wp_list_pluck(get_users(
          array(
              'meta_query' => [
                  [
                      'key' => 'verification_request',
                      'value' => 1,
                  ],
                  [
                      'key' => 'verification_files',
                      'compare' => 'EXISTS',
                  ],
              ],
              'fields' => ['ID']
          )), 'ID');
  }

  function ea_count_verification_requests()
  {
      return count(ea_get_verification_requests());
  }

  /* ==============================================
  ********  //Подтверждение верификации
  =============================================== */

  add_action('wp_ajax_ea_apply_verification_request', 'ea_apply_verification_request_callback');
  function ea_apply_verification_request_callback()
  {
      check_ajax_referer('ea_functions_nonce', 'security');
      $ea_user = $_POST['user'];
      if (update_user_meta($ea_user, 'bp_verified_member', 1)) {
          update_user_meta($ea_user, 'verification_request', 0);
          $admin_id = (int)get_site_option('ea_admin_id', 27);
          $username = !empty($_POST['username']) ? $_POST['username'] : get_user_by('id', $ea_user)->nickname;
          $thread_id = ea_get_thread_id($ea_user, $admin_id);
          $message = $username . __(', ваш аккаунт верифицирован.', 'earena');
          ea_admin_tech_msg($message, $thread_id);
          $arr_response['success'] = 1;
          $arr_response['content'] = __('Пользователь верифицирован.', 'earena');
          wp_send_json(json_encode($arr_response));
          wp_die();
      } else {
          $arr_response['success'] = 0;
          $arr_response['content'] = __('Пользователь не верифицирован.', 'earena');
          wp_send_json(json_encode($arr_response));
          wp_die();
      }
  }

  /* ==============================================
  ********  //Отклонение верификации
  =============================================== */

  add_action('wp_ajax_ea_remove_verification_request', 'ea_remove_verification_request_callback');
  function ea_remove_verification_request_callback()
  {
      check_ajax_referer('ea_functions_nonce', __('security', 'earena'));
      $ea_user = $_POST['user'];
      if (update_user_meta($ea_user, 'verification_request', 0)) {
          update_user_meta($ea_user, 'bp_verified_member', 0);
          $admin_id = (int)get_site_option('ea_admin_id', 27);
          $username = !empty($_POST['username']) ? $_POST['username'] : get_user_by('id', $ea_user)->nickname;
          $thread_id = ea_get_thread_id($ea_user, $admin_id);
          $message = $username . __(', ваша заявка на верификацию отклонена.', 'earena');
          ea_admin_tech_msg($message, $thread_id);
          $arr_response['success'] = 1;
          $arr_response['content'] = __('Заявка на верификацию отклонена.', 'earena');
          wp_send_json(json_encode($arr_response));
          wp_die();
      } else {
          $arr_response['success'] = 0;
          $arr_response['content'] = __('Заявка на верификацию не отклонена.', 'earena');
          wp_send_json(json_encode($arr_response));
          wp_die();
      }
  }

  /* ==============================================
  ********  //Разметка списка запросов на верификацию
  =============================================== */

  function earena_2_admin_verification_requests_html () {
    	$requests = ea_get_verification_requests();
    	if ( empty($requests) ) {
    		echo __( 'Нет запросов', 'earena_2' );
    	} else {
    		foreach ($requests as $user_id) {
          $user_friend = get_user_by( 'id', $user_id );
          $verified_friend = $user_friend->get('bp_verified_member')==1?true:false;

          $country_friend = mb_strtolower($user_friend->get('country'));

          if (!$country_friend) {
            $country_friend = ICL_LANGUAGE_CODE;
          }
          ?>
            <li class="section__item section__item--col-1 section__item--verification">
              <div class="user user--friends-page">
                <div class="user__left">
                  <div class="user__image-wrapper user__image-wrapper--friends <?php if ($verified_friend) { echo 'user__image-wrapper--verified'; } ?>">
                    <?php earena_2_verification_html($verified_friend, 'public'); ?>

                    <a class="user__avatar user__avatar--friends account__image--public" href="<?= ea_user_link($user_id); ?>">
                      <?= bp_core_fetch_avatar('item_id=' . $user_id); ?>
                    </a>
                  </div>

                  <div class="user__info user__info--friends">
                    <a class="user__name user__name--friends" href="<?= ea_user_link($user_id); ?>">
                      <h5>
                        <?= get_user_meta($user_id, 'nickname', true); ?>
                      </h5>
                    </a>

                    <div class="user__country user__country--friends">
                      <img width="28" height="20" src="<?php echo get_template_directory_uri(); ?>/assets/img/flags/flag-<?= $country_friend; ?>.svg" alt="Flag">
                    </div>

                    <?php if (is_online($user_id)): ?>
                      <div class="user__status user__status--online user__status--friends">
                        Online
                      </div>
                    <?php else : ?>
                      <div class="user__status user__status--friends">
                        <?php
                          echo __( 'Был(а) ', 'earena_2' ) . human_time_diff( strtotime(bp_get_user_last_activity($user_id)) ).__(' назад', 'earena_2');
                        ?>
                      </div>
                    <?php endif; ?>

                    <div class="user__rating user__rating--friends">
                      <span>
                        <?php _e( 'Рейтинг', 'earena_2' ); ?>
                      </span>: <?= earena_2_rating($user_id); ?>
                    </div>
                  </div>
                </div>
                <div class="user__center">
                  <?php
                    $files = get_user_meta( $user_id, 'verification_files', true );
                    foreach ($files as $file){
                      $parsed = parse_url( wp_get_attachment_url( $file ) );
                      $url    = dirname( $parsed['path'] ) . '/' . rawurlencode( basename( $parsed['path'] ) );
                      //echo '<a href="'.$url.'">'.rawurlencode( basename( $parsed['path'] ) ).'</a>';
                      echo "<a href=\"$url\"><img class=\"verification_image\" style=\"border-radius:unset;max-height:50px;max-width:100px;\" src=\"$url\"></a> ";
                    }
                  ?>
                </div>
                <div class="user__right user__right--new-request">
                  <button class="user__button user__button--verification-apply button button--green openpopup" data-popup="admin-verification" data-user="<?= $user_id; ?>" type="button" name="apply">
                    <span>
                      <?php _e( 'Подтвердить', 'earena_2' ); ?>
                    </span>
                  </button>
                  <button class="user__button user__button--verification-reject button button--gray openpopup" data-popup="admin-verification" data-user="<?= $user_id; ?>" type="button" name="reject">
                    <span>
                      <?php _e( 'Отклонить', 'earena_2' ); ?>
                    </span>
                  </button>
                </div>
              </div>
            </li>
          <?php
    		}
    	}
  }
?>
