<?php
  /*
    Текстовая страница (page)
  */
?>

<?php
  get_header(  );
?>

<main class="page-main">
  <section class="content <?= is_checkout() ? 'content--checkout' : ''; ?>">
    <div class="content__wrapper">
      <?php if (has_post_thumbnail()): ?>
        <header class="content__header">
          <div class="content__description">
            <h1 class="content__title content__title--havethumbnail">
              <?php the_title(  ); ?>
            </h1>

            <?php if (get_field( 'page_text_subtitle' )): ?>
              <div class="content__subtitle">
                <?php the_field( 'page_text_subtitle' ); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="content__image">
            <picture class="content__picture">
              <?php the_post_thumbnail(); ?>
            </picture>
          </div>
        </header>
        <div class="content__inner">
          <?php the_content(); ?>
        </div>
      <?php else: ?>
        <div class="content__inner content__inner--nothumbnail">
          <h1 class="content__title content__title--nothumbnail <?= is_checkout() ? 'content__title--checkout' : ''; ?>">
            <?php the_title(  ); ?>
          </h1>

          <?php the_content(); ?>
        </div>
      <?php endif; ?>

      <?php if (is_page(5724) || earena_2_current_page( 'nuzhna-pomoshh' )): ?>
        <form class="form form--contact" data-prefix="" id="form-contact" action="/" method="post">
          <div class="form__left form__left--contact">
            <div class="form__row">
              <input class="form__field form__field--contact" id="subject" type="text" name="subject" required placeholder="<?php _e( 'Тема обращения', 'earena_2' ); ?>">
            </div>
            <span class="form__error form__error--contact"><?php _e( 'Error', 'earena_2' ); ?></span>

            <div class="form__row">
              <input class="form__field form__field--contact" id="name" type="text" name="name" required placeholder="<?php _e( 'Ваше имя', 'earena_2' ); ?>">
            </div>
            <span class="form__error form__error--contact"><?php _e( 'Error', 'earena_2' ); ?></span>

            <div class="form__row">
              <input class="form__field form__field--contact" id="email" type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}" required placeholder="<?php _e( 'Электронная почта', 'earena_2' ); ?>">
            </div>
            <span class="form__error form__error--contact"><?php _e( 'Error', 'earena_2' ); ?></span>
          </div>

          <div class="form__right form__right--contact">
            <div class="form__row form__row--message-contact">
              <textarea class="form__field form__field--message-contact" name="message" placeholder="Сообщение" required></textarea>
            </div>

            <div class="files files--contact">
              <label class="files__label files__label--contact" for="files-contact">
                <?php _e( 'Прикрепить фото', 'earena_2' ); ?>
              </label>
              <input class="files__input visually-hidden" type="file" id="files-contact" name="files" accept=".png, .jpg, .jpeg" multiple>

              <!-- Сюда попадают скрины, что загрузил игрок подтверждающий себя -->
              <div class="files__preview">
              </div>
            </div>

            <button class="form__submit form__submit--contact button button--blue disabled" type="submit" name="contact-submit">
              <span>
                <?php _e( 'Отправить', 'earena_2' ); ?>
              </span>
            </button>
          </div>
        </form>
        <button class="visually-hidden openpopup" data-popup="contact" type="button" name="success">
          <span>
            <?php _e( 'Открыть попап успешной отправки формы', 'earena_2' ); ?>
          </span>
        </button>
        <button class="visually-hidden openpopup" data-popup="contact" type="button" name="error">
          <span>
            <?php _e( 'Открыть попап не успешной отправки формы', 'earena_2' ); ?>
          </span>
        </button>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php
  get_footer(  );
?>
