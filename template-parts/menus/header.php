<nav class="navigation navigation--header">
  <h5 class="visually-hidden">
    <?php _e( 'Меню', 'earena_2' ); ?>
  </h5>

  <ul class="navigation__list navigation__list--header">
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header navigation__link--blue-hover <?php if (is_front_page() && !$_GET) echo 'active'; ?>" href="<?php echo bloginfo( 'url' ); ?>">
        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.25 6.75L9 1.5L15.75 6.75V15C15.75 15.3978 15.592 15.7794 15.3107 16.0607C15.0294 16.342 14.6478 16.5 14.25 16.5H3.75C3.35218 16.5 2.97064 16.342 2.68934 16.0607C2.40804 15.7794 2.25 15.3978 2.25 15V6.75Z" stroke="#CFD8E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M6.75 16.5V9H11.25V16.5" stroke="#CFD8E3" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>
          <?= __('Главная', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header navigation__link--blue-hover <?= earena_2_current_page( 'matches' ) ? 'active' : ''; ?>" href="<?php echo bloginfo( 'url' ); ?>/matches">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M13.0625 9.28125H15.8125" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M6.1875 9.28125H8.9375" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M7.5625 7.90625V10.6562" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M14.7829 4.79004L7.2192 4.8124C6.16854 4.81248 5.15149 5.18264 4.34658 5.85791C3.54166 6.53317 3.00033 7.47038 2.8176 8.50503L2.81834 8.50516L1.41202 15.7379C1.32319 16.2419 1.39734 16.761 1.62369 17.22C1.85004 17.679 2.2168 18.0538 2.67072 18.2901C3.12463 18.5264 3.64206 18.6119 4.14784 18.534C4.65363 18.4562 5.12144 18.2192 5.48333 17.8574L5.48319 17.8572L9.19875 13.7499L14.7829 13.7275C15.9681 13.7275 17.1047 13.2567 17.9428 12.4187C18.7808 11.5806 19.2516 10.444 19.2516 9.25879C19.2516 8.0736 18.7808 6.93696 17.9428 6.09891C17.1047 5.26085 15.9681 4.79004 14.7829 4.79004V4.79004Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M19.1837 8.48291L20.5888 15.738C20.6777 16.242 20.6035 16.7612 20.3772 17.2201C20.1508 17.6791 19.7841 18.0539 19.3302 18.2902C18.8762 18.5265 18.3588 18.612 17.853 18.5342C17.3472 18.4563 16.8794 18.2193 16.5175 17.8575L16.5177 17.8573L12.8047 13.7356" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>
          <?= __('Матчи на деньги', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header navigation__link--blue-hover <?= earena_2_current_page( 'tournaments' ) ? 'active' : ''; ?>" href="<?php echo bloginfo( 'url' ); ?>/tournaments">
        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4.8125 4.8125V9.54732C4.8125 12.9591 7.54141 15.787 10.9531 15.8123C11.7696 15.8185 12.5792 15.663 13.3353 15.3549C14.0914 15.0467 14.7791 14.5919 15.3586 14.0168C15.9381 13.4416 16.3981 12.7574 16.712 12.0037C17.0259 11.2499 17.1875 10.4415 17.1875 9.625V4.8125C17.1875 4.63016 17.1151 4.4553 16.9861 4.32636C16.8572 4.19743 16.6823 4.125 16.5 4.125H5.5C5.31766 4.125 5.1428 4.19743 5.01386 4.32636C4.88493 4.4553 4.8125 4.63016 4.8125 4.8125Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M8.25 19.25H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M11 15.8125V19.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M17.6695 10.7356H17.7639C18.4933 10.7356 19.1927 10.4459 19.7085 9.93014C20.2242 9.41441 20.5139 8.71494 20.5139 7.9856V6.6106C20.5139 6.42826 20.4415 6.25339 20.3125 6.12446C20.1836 5.99553 20.0087 5.9231 19.8264 5.9231H17.5" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4.98122 11H4.11401C3.38467 11 2.6852 10.7103 2.16947 10.1945C1.65375 9.67882 1.36401 8.97935 1.36401 8.25V6.875C1.36401 6.69266 1.43645 6.5178 1.56538 6.38886C1.69431 6.25993 1.86918 6.1875 2.05151 6.1875H4.80151" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span>
          <?=  __('Турниры', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header <?= is_page(874) ? 'active' : '' ?>" href="<?php echo get_page_link(874); ?>">
        <span>
          <?=  __('Команда Earena', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header" href="/text">
        <span>
          <?=  __('Кибершкола', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header" href="/text">
        <span>
          <?=  __('Магазин', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header <?= is_page(877) ? 'active' : '' ?>" href="<?php echo get_page_link(877); ?>">
        <span>
          <?=  __('Сотрудничество', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header" href="/text">
        <span>
          <?=  __('Поддержка игроков', 'earena_2'); ?>
        </span>
      </a>
    </li>
    <li class="navigation__item navigation__item--header">
      <a class="navigation__link navigation__link--header" href="/text">
        <span>
          <?=  __('Новости киберспорта', 'earena_2'); ?>
        </span>
      </a>
    </li>
  </ul>
</nav>
