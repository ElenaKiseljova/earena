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
?>
