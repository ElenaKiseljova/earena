<?php
  if (!is_ea_admin()) {
    return;
  }
?>
<div class="section section--friends" id="verification-requests">
  <ul class="section__list section__list--friends" id="verification-requests-list">
    <?php
      earena_2_admin_verification_requests_html();
    ?>
  </ul>
</div>
