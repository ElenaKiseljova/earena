<?php
  global $is_chat_page;
  global $is_account_page;
?>
<div class="chat <?php if ($is_account_page || $is_chat_page) echo 'chat--chat-page'; ?>">
  <div class="chat__conversation">
    <div class="chat__conversation-list">
      <?php
        for ($i=1; $i < 9; $i++) {
          $is_online = rand(0, 1);
          ?>
          <div class="chat__conversation-item">
            <div class="user user--chats">
              <div class="user__image-wrapper user__image-wrapper--chat <?php if ($is_online) echo 'user__image-wrapper--online'; ?>">
                <a class="user__avatar user__avatar--chats" href="#">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-<?= $i; ?>.png" alt="Avatar">
                </a>
              </div>

              <div class="user__info user__info--chats">
                <a class="user__name user__name--chats" href="#">
                  <h5>
                    AnnetteBlack
                  </h5>
                </a>

                <time class="user__time <?php echo $is_chat_page ? 'user__time--chat-page' : ''; ?>">
                  17:21
                </time>

                <div class="user__message <?php echo $is_chat_page ? 'user__message--chat-page' : ''; ?>">
                  <p>
                    Download ✌🏻✌🏻✌🏻 or copy themes in formats 😀
                  </p>
                </div>
              </div>
            </div>
          </div>
          <?php
          if ($i === 7) {
            ?>
              <div class="chat__separator">
                <time>20 August 2021</time>
              </div>
              <div class="chat__conversation-item">
                <div class="user user--chats">
                  <div class="user__image-wrapper user__image-wrapper--chat <?php if ($is_online) echo 'user__image-wrapper--online'; ?> user__image-wrapper--admin">
                    <a class="user__avatar user__avatar--chats" href="#">
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/avatar-<?= $i; ?>.png" alt="Avatar">
                    </a>
                  </div>

                  <div class="user__info user__info--chats">
                    <a class="user__name user__name--chats user__name--admin" href="#">
                      <h5>
                        Administrator
                      </h5>
                    </a>

                    <time class="user__time <?php echo $is_chat_page ? 'user__time--chat-page' : ''; ?>">
                      17:21
                    </time>

                    <div class="user__message <?php echo $is_chat_page ? 'user__message--chat-page' : ''; ?>">
                      <p>
                        Download ✌🏻✌🏻✌🏻 or copy themes in formats 😀
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            <?php
          }
        }
      ?>
    </div>
  </div>
  <div class="chat__message">
    <textarea class="chat__message-text" name="message" placeholder="Сообщение...">
    </textarea>

    <button class="chat__smiles" type="button" name="smile">
      <svg width="28" height="28">
        <use xlink:href="#icon-smile" />
      </svg>
    </button>
    <button class="chat__send" type="button" name="send">
      <svg width="22" height="22">
        <use xlink:href="#icon-message" />
      </svg>
    </button>
  </div>
</div>
