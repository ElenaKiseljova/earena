<?php
global $match_id, $ea_user;

if (empty($match_id)) {
    wp_redirect(home_url('matches'));
    exit;
}
$match = EArena_DB::get_ea_match($match_id);
if (!$match || empty($match->player1) || empty($match->player2)) {
    wp_redirect(home_url('matches'));
    exit;
}
if ($ea_user->ID !== (int)$match->player1 && $ea_user->ID !== (int)$match->player2 && !is_ea_admin()) {
    wp_redirect(home_url('matches'));
    exit;
}
?>

<?php if (is_ea_admin() && $match->moderate): ?>
  <div class="complaint">
      <div class="name"><?php _e('Жалобы', 'earena'); ?>:</div>
      <p><?= json_decode($match->details); ?></p>
      <button id="del-moderate" class="button button-purple center"><?php _e('Жалоба рассмотрена',
              'earena'); ?></button>
  </div>
<?php elseif (is_ea_admin()): ?>
  <!--ADMIN CONTENT-->
  <input type="hidden" name="tournament" value="0">
  <input type="hidden" name="match_thread_id" value="<?= $match->thread_id; ?>">
  <input type="hidden" name="match_id" value="<?= $match->ID; ?>">
  <div class="create-tour-tab admin-match-results">
      <ul class="menu-tab">
          <li><a href="#tab-1"><?= ea_game_nick($match->game, $match->platform, $match->player1); ?></a></li>
          <li><a href="#tab-2"><?= ea_game_nick($match->game, $match->platform, $match->player2); ?></a></li>
      </ul>

      <!--Player 1-->
      <div class="content-tab" id="tab-1">
          <div class="batl-players">
              <div class="row">
                  <div class="col-sm-3 col-xs-6 pl-st">
                      <?= bp_core_fetch_avatar([
                          'item_id' => $match->player1,
                          'type' => 'full',
                          'width' => 100,
                          'height' => 100,
                          'extra_attr' => 'style="border: 5px solid #00B012;"'
                      ]); ?>
                      <br><a href="#" data-toggle="modal" data-target="#yellowCard"
                             class="add-yellow-card-modal btn-mess button-white"
                             data-user="<?= $match->player1; ?>"><img class="svg yes"
                                                                      src="<?php bloginfo('template_url'); ?>/images/icons/alert-red.svg"
                                                                      alt=""></a>
                  </div>

                  <div class="hidden-lg hidden-md hidden-sm col-xs-6">
                      <?= bp_core_fetch_avatar([
                          'item_id' => $match->player2,
                          'type' => 'full',
                          'class' => 'left',
                          'width' => 100,
                          'height' => 100
                      ]); ?>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="playrs-score">
                          <input name="player" type="hidden" value="<?= $match->player1; ?>">
                          <div>
                              <input class="only-digits" name="score1" type="text" placeholder="<?php _e('Счет', 'earena'); ?>"
                                     value="<?= isset($match->score1) ? $match->score1 : ''; ?>" <?= disabled((isset($match->reporter) && (int)$match->player1 !== (int)$match->reporter),
                                  true, false); ?>>
                              <a href="<?= ea_user_link($match->player1); ?>"><?= ea_game_nick($match->game,
                                      $match->platform, $match->player1); ?></a>
                          </div>
                          <span>:</span>
                          <div>
                              <input class="only-digits" name="score2" type="text" placeholder="<?php _e('Счет', 'earena'); ?>"
                                     value="<?= isset($match->score2) ? $match->score2 : ''; ?>" <?= disabled((isset($match->reporter) && (int)$match->player1 !== (int)$match->reporter),
                                  true, false); ?>>
                              <a href="<?= ea_user_link($match->player2); ?>"><?= ea_game_nick($match->game,
                                      $match->platform, $match->player2); ?></a>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-3 hidden-xs">
                      <?= bp_core_fetch_avatar([
                          'item_id' => $match->player2,
                          'type' => 'full',
                          'class' => 'right',
                          'width' => 100,
                          'height' => 100
                      ]); ?>
                  </div>
              </div>
          </div>

          <div style="text-align:center; max-width:600px; margin:auto;/* padding: 0 25px; align-items:center; display:block;*/"
               class="verification">
              <div style="float:left; width:90px; height: 90px; margin: 10px 0;">
                  <?php if (!empty($match->verification1)): ?>
                      <a href="<?= wp_get_attachment_url($match->verification1); ?>" class="fancybox image"><img
                                  class="verification_image" width="90px"
                                  src="<?= wp_get_attachment_url($match->verification1); ?>"></a>
                  <?php endif; ?>
              </div>
              <div style="float:right; width:90px;  height: 90px; margin: 10px 0;">
                  <?php if (!empty($match->verification2)): ?>
                      <a href="<?= wp_get_attachment_url($match->verification2); ?>" class="fancybox image"><img
                                  class="verification_image" width="90px"
                                  src="<?= wp_get_attachment_url($match->verification2); ?>"></a>
                  <?php endif; ?>
              </div>
          </div>
          <?php if (!isset($match->winner)): ?>
              <div id="fileuploader" class="fileuploader">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M16.0797 8.28768L9.18723 15.1802C8.34285 16.0246 7.19762 16.4989 6.00348 16.4989C4.80934 16.4989 3.66411 16.0246 2.81973 15.1802C1.97535 14.3358 1.50098 13.1906 1.50098 11.9964C1.50098 10.8023 1.97535 9.65707 2.81973 8.81268L9.71223 1.92018C10.2752 1.35726 11.0386 1.04102 11.8347 1.04102C12.6308 1.04102 13.3943 1.35726 13.9572 1.92018C14.5202 2.48311 14.8364 3.24659 14.8364 4.04268C14.8364 4.83878 14.5202 5.60226 13.9572 6.16518L7.05723 13.0577C6.77577 13.3391 6.39403 13.4973 5.99598 13.4973C5.59793 13.4973 5.21619 13.3391 4.93473 13.0577C4.65327 12.7762 4.49514 12.3945 4.49514 11.9964C4.49514 11.5984 4.65327 11.2166 4.93473 10.9352L11.3022 4.57518"
                            stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span><?php _e('Прикрепить фото', 'earena'); ?></span>
              </div>

              <?php
              if (!isset($match->reporter)) {
                  echo '<button data-id="' . $match->ID . '" id="send-result-match"  class="button button-purple center">' . __('Отправить результат',
                          'earena') . '</button>';
              } elseif (isset($match->reporter) && $match->player1 == (int)$match->reporter) {
                  echo '<button data-id="' . $match->ID . '" id="resend-result-match"  class="button button-purple center">' . __('Изменить результат',
                          'earena') . '</button>';
              } elseif (isset($match->reporter) && $match->player2 == (int)$match->reporter) {
                  echo '<button data-id="' . $match->ID . '" id="confirm-result-match"  class="button button-purple center">' . __('Подтвердить результат',
                          'earena') . '</button>';
              }
              ?>
              <div style="text-align:center;" class="ajax-reply"></div>
          <?php else: ?>
              <div style="text-align:center; max-width:600px; height:100px; margin: auto ;padding:0 25px; align-items:center;"
                   class="winner">
                  <strong><?= ea_game_nick($match->game, $match->platform,
                          $match->winner) . " " . __('победил со счётом',
                          'earena') . "  $match->score1 : $match->score2"; ?></strong>
              </div>
          <?php endif; ?>
      </div>

      <!--Player 2-->
      <div class="content-tab" id="tab-2">
          <div class="batl-players">
              <div class="row">
                  <div class="col-sm-3 col-xs-6 pl-st">
                      <?= bp_core_fetch_avatar([
                          'item_id' => $match->player1,
                          'type' => 'full',
                          'width' => 100,
                          'height' => 100
                      ]); ?>
                  </div>

                  <div class="hidden-lg hidden-md hidden-sm col-xs-6">
                      <?= bp_core_fetch_avatar([
                          'item_id' => $match->player2,
                          'type' => 'full',
                          'class' => 'left',
                          'width' => 100,
                          'height' => 100,
                          'extra_attr' => 'style="border: 5px solid #00B012;"'
                      ]); ?>
                      <br><a href="#" data-toggle="modal" data-target="#yellowCard"
                             class="add-yellow-card-modal btn-mess button-white"
                             data-user="<?= $match->player2; ?>"><img class="svg yes"
                                                                      src="<?php bloginfo('template_url'); ?>/images/icons/alert-red.svg"
                                                                      alt=""></a>
                  </div>

                  <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="playrs-score">
                          <input name="player" type="hidden" value="<?= $match->player2; ?>">
                          <div>
                              <input class="only-digits" name="score1" type="text"
                                     placeholder="<?php _e('Счет', 'earena'); ?>"
                                     value="<?= isset($match->score1) ? $match->score1 : ''; ?>" <?= disabled((isset($match->reporter) && (int)$match->player2 !== (int)$match->reporter),
                                  true, false); ?>>
                              <a href="<?= ea_user_link($match->player1); ?>"><?= ea_game_nick($match->game,
                                      $match->platform, $match->player1); ?></a>
                          </div>
                          <span>:</span>
                          <div>
                              <input class="only-digits" name="score2" type="text"
                                     placeholder="<?php _e('Счет', 'earena'); ?>"
                                     value="<?= isset($match->score2) ? $match->score2 : ''; ?>" <?= disabled((isset($match->reporter) && (int)$match->player2 !== (int)$match->reporter),
                                  true, false); ?>>
                              <a href="<?= ea_user_link($match->player2); ?>"><?= ea_game_nick($match->game,
                                      $match->platform, $match->player2); ?></a>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-3 hidden-xs">
                      <?= bp_core_fetch_avatar([
                          'item_id' => $match->player2,
                          'type' => 'full',
                          'class' => 'right',
                          'width' => 100,
                          'height' => 100,
                          'extra_attr' => 'style="border: 5px solid #00B012;"'
                      ]); ?>
                      <br><a href="#" data-toggle="modal" data-target="#yellowCard"
                             class="add-yellow-card-modal btn-mess button-white"
                             data-user="<?= $match->player2; ?>"><img class="svg yes"
                                                                      src="<?php bloginfo('template_url'); ?>/images/icons/alert-red.svg"
                                                                      alt=""></a>
                  </div>
              </div>
          </div>

          <div style="text-align:center; max-width:600px; margin:auto;/* padding: 0 25px; align-items:center; display:block;*/"
               class="verification">
              <div style="float:left; width:90px; height: 90px; margin: 10px 0;">
                  <?php if (!empty($match->verification1)): ?>
                      <a href="<?= wp_get_attachment_url($match->verification1); ?>" class="fancybox image"><img
                                  class="verification_image" width="90px"
                                  src="<?= wp_get_attachment_url($match->verification1); ?>"></a>
                  <?php endif; ?>
              </div>
              <div style="float:right; width:90px;  height: 90px; margin: 10px 0;">
                  <?php if (!empty($match->verification2)): ?>
                      <a href="<?= wp_get_attachment_url($match->verification2); ?>" class="fancybox image"><img
                                  class="verification_image" width="90px"
                                  src="<?= wp_get_attachment_url($match->verification2); ?>"></a>
                  <?php endif; ?>
              </div>
          </div>
          <?php if (!isset($match->winner)): ?>
              <div id="fileuploader" class="fileuploader">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M16.0797 8.28768L9.18723 15.1802C8.34285 16.0246 7.19762 16.4989 6.00348 16.4989C4.80934 16.4989 3.66411 16.0246 2.81973 15.1802C1.97535 14.3358 1.50098 13.1906 1.50098 11.9964C1.50098 10.8023 1.97535 9.65707 2.81973 8.81268L9.71223 1.92018C10.2752 1.35726 11.0386 1.04102 11.8347 1.04102C12.6308 1.04102 13.3943 1.35726 13.9572 1.92018C14.5202 2.48311 14.8364 3.24659 14.8364 4.04268C14.8364 4.83878 14.5202 5.60226 13.9572 6.16518L7.05723 13.0577C6.77577 13.3391 6.39403 13.4973 5.99598 13.4973C5.59793 13.4973 5.21619 13.3391 4.93473 13.0577C4.65327 12.7762 4.49514 12.3945 4.49514 11.9964C4.49514 11.5984 4.65327 11.2166 4.93473 10.9352L11.3022 4.57518"
                            stroke="#787878" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span><?php _e('Прикрепить фото', 'earena'); ?></span>
              </div>

              <?php
              if (!isset($match->reporter)) {
                  echo '<button data-id="' . $match->ID . '" id="send-result-match"  class="button button-purple center">' . __('Отправить результат',
                          'earena') . '</button>';
              } elseif (isset($match->reporter) && $match->player2 == (int)$match->reporter) {
                  echo '<button data-id="' . $match->ID . '" id="resend-result-match"  class="button button-purple center">' . __('Изменить результат',
                          'earena') . '</button>';
              } elseif (isset($match->reporter) && $match->player1 == (int)$match->reporter) {
                  echo '<button data-id="' . $match->ID . '" id="confirm-result-match"  class="button button-purple center">' . __('Подтвердить результат',
                          'earena') . '</button>';
              }
              ?>
              <div style="text-align:center;" class="ajax-reply"></div>
          <?php else: ?>
              <div style="text-align:center; max-width:600px; height:100px; margin: auto ;padding:0 25px; align-items:center;"
                   class="winner">
                  <strong><?= ea_game_nick($match->game, $match->platform,
                          $match->winner) . " " . __('победил со счётом',
                          'earena') . " $match->score1 : $match->score2"; ?></strong>
              </div>
          <?php endif; ?>
      </div>
  </div>

  <div id="yellowCard" class="modal fade bs-example-modal-sm" data-toggle="yellowCard">
      <div class="vertical-alignment-helper">
          <div class="vertical-align-center">
              <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                      <div class="modal-body">
                          <div class="title"><?php _e('Предупреждение', 'earena'); ?></div>
                          <p class="ajax-reply"></p>
                          <form class="form" id="add-yellow-card">
                              <select name="reason" id="reason">
                                  <option value="0"><?php _e('Причина', 'earena'); ?></option>
                                  <option value="1"><?php _e('Неуважение соперника', 'earena'); ?></option>
                                  <option value="2"><?php _e('Нарушение правил', 'earena'); ?></option>
                              </select>

                              <div class="center">
                                  <div class="row">
                                      <div class="col-lg-6">
                                          <button data-dismiss="modal"
                                                  class="button button-white button-submit left"><?php _e('Отменить',
                                                  'earena'); ?></button>
                                      </div>

                                      <div class="col-lg-6">
                                          <button class="button button-purple button-submit right add-yellow-card"
                                                  data-user=""><?php _e('Выдать', 'earena'); ?></button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>

                      <!--				<button type="button" class="close button-white" data-dismiss="modal" aria-hidden="true">×</button>-->
                  </div>
              </div>
          </div>
      </div>
  </div>
<?php else: ?>
  <form class="form form--chat" data-prefix="" id="form-chat" action="index.html" method="post">
    <div class="form__left form__left--chat">
      <div class="user user--form">
        <?php if ( $match->stream1 != '' ): ?>
          <a class="user__stream user__stream--right" href="<?= $match->stream1; ?>">
            <svg class="user__stream-icon" width="16" height="13">
              <use xlink:href="#icon-play"></use>
            </svg>
          </a>
        <?php endif; ?>
        <a class="user__avatar user__avatar--form" href="<?= ea_user_link($match->player1); ?>">
          <?= bp_core_fetch_avatar(['item_id' => $match->player1, 'type' => 'full', 'width' => 80, 'height' => 80]); ?>
        </a>
        <a class="user__name user__name--form" href="<?= ea_user_link($match->player1); ?>">
          <h5>
            <?= ea_game_nick($match->game, $match->platform, $match->player1); ?>
          </h5>
        </a>
      </div>

      <?php if (!isset($match->score1) && !isset($match->score2)): ?>
        <div class="form__row form__row--chat">
          <label class="visually-hidden" for="score1">
            <?php _e( 'Результат первого участника', 'earena_2' ) ?>
          </label>
          <input class="form__field form__field--chat" type="number" min="0" id="score1" name="score1" required value="<?= isset($match->score1) ? $match->score1 : ''; ?>" <?= disabled((isset($match->reporter) && $ea_user->ID !== (int)$match->reporter), true, false); ?>>
        </div>

        <div class="chat-page__broadcasting checkbox checkbox--left">
          <input class="visually-hidden" type="checkbox" name="broadcasting" id="broadcasting">
          <label class="checkbox__label checkbox__label--checkbox checkbox__label--left" for="broadcasting">
            <?php _e( 'Трансляция', 'earena_2' ); ?>
          </label>
        </div>
      <?php endif; ?>
    </div>
    <div class="form__center form__center--chat">
      <?php if (!isset($match->score1) && !isset($match->score2)): ?>
        <span class="form__vs">
          vs
        </span>
      <?php elseif (isset($match->score1) && isset($match->score2)): ?>
        <span class="form__vs form__vs--change">
          <?= isset($match->score1) ? $match->score1 : 0; ?> : <?= isset($match->score2) ? $match->score2 : 0; ?>
        </span>
      <?php endif; ?>

      <?php if (!isset($match->winner)): ?>
        <div class="form__row form__row--files">
          <div class="files files--chat-page">
            <label class="files__label files__label--chat-page" for="files-chat-page">
              <?php _e( 'Прикрепить фото', 'earena_2' ); ?>
            </label>
            <input class="files__input visually-hidden" type="file" id="files-chat-page" name="files" required accept=".png, .jpg, .jpeg" value="">

            <div class="files__preview">
            </div>

            <?php if (!empty($match->verification1) || !empty($match->verification2) ): ?>
              <?php
                $extensions = ['.jpg', '.png', '.jpeg', '.pjpeg'];
              ?>
              <div class="files__preview files__preview--change">
                <ul>
                  <?php if (!empty($match->verification1)): ?>
                    <li>
                      <p>
                        <a href="<?= wp_get_attachment_url($match->verification1); ?>" data-fancybox="attachments">
                          <?= earena_2_only_filename(rawurlencode( basename ( get_attached_file( $match->verification1 ) ) ), $extensions) ?>
                        </a>
                      </p>
                    </li>
                  <?php endif; ?>
                  <?php if (!empty($match->verification2)): ?>
                    <li>
                      <p>
                        <a href="<?= wp_get_attachment_url($match->verification2); ?>" data-fancybox="attachments">
                          <?= earena_2_only_filename(rawurlencode( basename ( get_attached_file( $match->verification2 ) ) ), $extensions) ?>
                        </a>
                      </p>
                    </li>
                  <?php endif; ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <div class="form__right form__right--chat">
      <div class="user user--form">
        <?php if ( $match->stream2 != '' ): ?>
          <a class="user__stream user__stream--right" href="<?= $match->stream2; ?>">
            <svg class="user__stream-icon" width="16" height="13">
              <use xlink:href="#icon-play"></use>
            </svg>
          </a>
        <?php endif; ?>
        <a class="user__avatar user__avatar--form" href="<?= ea_user_link($match->player2); ?>">
          <?= bp_core_fetch_avatar(['item_id' => $match->player2, 'type' => 'full', 'width' => 80, 'height' => 80]); ?>                </a>
        <a class="user__name user__name--form" href="<?= ea_user_link($match->player2); ?>">
          <h5>
            <?= ea_game_nick($match->game, $match->platform, $match->player2); ?>
          </h5>
        </a>
      </div>

      <?php if (!isset($match->score1) && !isset($match->score2)): ?>
        <div class="form__row form__row--chat">
          <label class="visually-hidden" for="score2">
            <?php _e( 'Результат первого участника', 'earena_2' ) ?>
          </label>
          <input class="form__field form__field--chat" type="number" min="0" id="score2" name="score2" required value="<?= isset($match->score2) ? $match->score2 : ''; ?>" <?= disabled((isset($match->reporter) && $ea_user->ID !== (int)$match->reporter), true, false); ?>>
        </div>
      <?php endif; ?>
    </div>

    <?php if (!isset($match->winner)): ?>
      <?php if (!isset($match->reporter)): ?>
        <button class="form__submit form__submit--chat button button--blue disabled" data-id="<?= $match->ID; ?>" type="submit" name="chat-page-result-submit">
          <span>
            <?php _e( 'Отправить результат', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif (isset($match->reporter) && $ea_user->ID == (int)$match->reporter): ?>
        <button class="form__submit form__submit--chat button button--gray" data-id="<?= $match->ID; ?>" type="submit" name="chat-page-result-submit">
          <span>
            <?php _e( 'Изменить результат', 'earena_2' ); ?>
          </span>
        </button>
      <?php elseif (isset($match->reporter) && $ea_user->ID !== (int)$match->reporter): ?>
        <button class="form__submit form__submit--chat button button--blue" data-id="<?= $match->ID; ?>" type="submit" name="chat-page-result-submit">
          <span>
            <?php _e( 'Подтвердить результат', 'earena_2' ); ?>
          </span>
        </button>
      <?php endif; ?>
    <?php endif; ?>
  </form>
<?php endif; ?>
