<?php
  /*
    Табы игровых платформ
  */
?>
<div class="tabs">
  <!-- Для переключения состояния - добавляется active класс  -->
  <button class="tabs__button tabs__button--platform active" data-tab-type="all" type="button" name="tab-all">
    <?php _e( 'Все', 'earena_2' ); ?>
  </button>
  <button class="tabs__button tabs__button--platform" data-tab-type="desktop" type="button" name="tab-desktop">
    <svg class="tabs__icon" width="30" height="30">
      <use xlink:href="#icon-platform-desktop"></use>
    </svg>
    <span class="tabs__text">
      Desktop
    </span>
  </button>
  <button class="tabs__button tabs__button--platform" data-tab-type="mobile" type="button" name="tab-mobile">
    <svg class="tabs__icon" width="30" height="30">
      <use xlink:href="#icon-platform-mobile"></use>
    </svg>
    <span class="tabs__text">
      Mobile
    </span>
  </button>
  <button class="tabs__button tabs__button--platform" data-tab-type="xbox" type="button" name="tab-XBOX">
    <svg class="tabs__icon" width="30" height="30">
      <use xlink:href="#icon-platform-xbox"></use>
    </svg>
    <span class="tabs__text">
      XBOX
    </span>
  </button>
  <button class="tabs__button tabs__button--platform" data-tab-type="playstation" type="button" name="tab-playstation">
    <svg class="tabs__icon" width="30" height="30">
      <use xlink:href="#icon-platform-playstation"></use>
    </svg>
    <span class="tabs__text">
      PlayStation
    </span>
  </button>
</div>
