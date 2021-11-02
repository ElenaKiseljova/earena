<section class="section section--vip" id="vip">
  <div class="section__wrapper">
    <header class="section__header">
      <h2 class="section__title section__title--vip">
        <?php _e( 'VIP статус', 'earena_2' ); ?>
      </h2>

      <div class="section__header-right">
        <a class="section__link" href="<?= get_permalink(571) ?>">
           <?php _e( 'Что такое VIP статус', 'earena_2' ); ?>
        </a>
      </div>
    </header>

    <div class="section__content">
      <ul class="section__list">
        <li class="section__item section__item--col-3">
          <div class="vip vip--block">
            <h4 class="vip__title">
              <?php _e( '1 месяц', 'earena_2' ); ?>
            </h4>
            <p class="vip__price">
              $2
            </p>

            <form class="form form--vip" data-prefix="buy" id="form-vip-0" action="/" method="post">
              <input type="hidden" name="month" value="1">

              <button class="vip__button button button--orange openpopup" data-popup="vip" type="submit" name="buy">
                <span>
                  <?php _e( 'Активировать за', 'earena_2' ); ?> $2
                </span>
              </button>
            </form>
          </div>
        </li>
        <li class="section__item section__item--col-3">
          <div class="vip vip--block">
            <h4 class="vip__title">
              <?php _e( '3 месяца', 'earena_2' ); ?>
            </h4>
            <p class="vip__price">
              $4
            </p>

            <form class="form form--vip" data-prefix="buy" id="form-vip-1" action="/" method="post">
              <input type="hidden" name="month" value="3">

              <button class="vip__button button button--orange openpopup" data-popup="vip" type="submit" name="buy">
                <span>
                  <?php _e( 'Активировать за', 'earena_2' ); ?> $4
                </span>
              </button>
            </form>
          </div>
        </li>
        <li class="section__item section__item--col-3">
          <div class="vip vip--block">
            <h4 class="vip__title">
              <?php _e( '12 месяцев', 'earena_2' ); ?>
            </h4>
            <p class="vip__price">
              $10
            </p>

            <form class="form form--vip" data-prefix="buy" id="form-vip-2" action="/" method="post">
              <input type="hidden" name="month" value="12">

              <button class="vip__button button button--orange openpopup" data-popup="vip" type="submit" name="buy">
                <span>
                  <?php _e( 'Активировать за', 'earena_2' ); ?> $10
                </span>
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
