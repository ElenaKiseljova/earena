<?php
  /*
    Статистика на Главной
  */
?>
<?php
  $promo_matches = get_field('promo_matches', $front_page_id);
  $promo_payed = get_field('promo_payed', $front_page_id);
?>
<div class="statistics statistics--front">
  <ul class="statistics__variation">
    <li class="statistics__variation-item statistics__variation-item--one">
      <?php _e( 'Играй один', 'earena_2' ); ?>
    </li>
    <li class="statistics__variation-item statistics__variation-item--two">
      <?php _e( 'Вдвоем', 'earena_2' ); ?>
    </li>
    <li class="statistics__variation-item statistics__variation-item--team">
      <?php _e( 'Командой', 'earena_2' ); ?>
    </li>
  </ul>

  <dl class="statistics__achives">
    <dt class="statistics__achives-termin">
      <?= do_shortcode( $promo_matches ); ?>
    </dt>
    <dd class="statistics__achives-description">
      <?php _e( 'Сыграно матчей', 'earena_2' ); ?>
    </dd>

    <dt class="statistics__achives-termin">
      $<?= do_shortcode( $promo_payed ); ?>
    </dt>
    <dd class="statistics__achives-description">
      <?php _e( 'Выплачено игрокам', 'earena_2' ); ?>
    </dd>
  </dl>
</div>
