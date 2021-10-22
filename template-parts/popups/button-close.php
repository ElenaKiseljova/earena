<?php
  global $slug_popup;
?>
<button class="popup__close popup__close--cross popup__close--<?= $slug_popup; ?>" type="button" name="close">
  <span class="visually-hidden">
    <?php _e( 'Закрыть', 'earena_2' ); ?>
  </span>
  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M15.4844 4.51562L4.51562 15.4844" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M15.4844 15.4844L4.51562 4.51562" stroke="#CFD8E3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
  </svg>
</button>
