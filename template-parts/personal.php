<?php
  /*
    Меню залогиненного пользователя
  */
?>
<?php
  $ea_user = wp_get_current_user();
  $is_messages = earena_2_current_page( 'message' );
?>

<div class="personal"><!-- <?= $is_messages ? 'personal--hide' : ''; ?> -->
  <ul class="personal__list">
    <?php if ( is_ea_admin() ): ?>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(649)) echo 'active'; ?>" href="<?php echo get_page_link(649); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.0625 9.28125H15.8125" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.1875 9.28125H8.9375" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7.5625 7.90625V10.6562" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.7829 4.79004L7.2192 4.8124C6.16854 4.81248 5.15149 5.18264 4.34658 5.85791C3.54166 6.53317 3.00033 7.47038 2.8176 8.50503L2.81834 8.50516L1.41202 15.7379C1.32319 16.2419 1.39734 16.761 1.62369 17.22C1.85004 17.679 2.2168 18.0538 2.67072 18.2901C3.12463 18.5264 3.64206 18.6119 4.14784 18.534C4.65363 18.4562 5.12144 18.2192 5.48333 17.8574L5.48319 17.8572L9.19875 13.7499L14.7829 13.7275C15.9681 13.7275 17.1047 13.2567 17.9428 12.4187C18.7808 11.5806 19.2516 10.444 19.2516 9.25879C19.2516 8.0736 18.7808 6.93696 17.9428 6.09891C17.1047 5.26085 15.9681 4.79004 14.7829 4.79004V4.79004Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M19.1837 8.48291L20.5888 15.738C20.6777 16.242 20.6035 16.7612 20.3772 17.2201C20.1508 17.6791 19.7841 18.0539 19.3302 18.2902C18.8762 18.5265 18.3588 18.612 17.853 18.5342C17.3472 18.4563 16.8794 18.2193 16.5175 17.8575L16.5177 17.8573L12.8047 13.7356" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="visually-hidden">
            <?php _e( 'Матчи', 'earena_2' ); ?>
          </span>

          <?php
            $count_admin_matches = (int) count_admin_matches_moderate() + (int) count_admin_matches_not_confirmed();
          ?>
          <span class="personal__link-count personal__link-count--matches-admin <?= $count_admin_matches === 0 ? 'zero' : ''; ?>">
            <?= $count_admin_matches; ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(643)) echo 'active'; ?>" href="<?php echo get_page_link(643); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.8125 4.8125V9.54732C4.8125 12.9591 7.54141 15.787 10.9531 15.8123C11.7696 15.8185 12.5792 15.663 13.3353 15.3549C14.0914 15.0467 14.7791 14.5919 15.3586 14.0168C15.9381 13.4416 16.3981 12.7574 16.712 12.0037C17.0259 11.2499 17.1875 10.4415 17.1875 9.625V4.8125C17.1875 4.63016 17.1151 4.4553 16.9861 4.32636C16.8572 4.19743 16.6823 4.125 16.5 4.125H5.5C5.31766 4.125 5.1428 4.19743 5.01386 4.32636C4.88493 4.4553 4.8125 4.63016 4.8125 4.8125Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.25 19.25H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11 15.8125V19.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17.6695 10.7356H17.7639C18.4933 10.7356 19.1927 10.4459 19.7085 9.93014C20.2242 9.41441 20.5139 8.71494 20.5139 7.9856V6.6106C20.5139 6.42826 20.4415 6.25339 20.3125 6.12446C20.1836 5.99553 20.0087 5.9231 19.8264 5.9231H17.5" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M4.98122 11H4.11401C3.38467 11 2.6852 10.7103 2.16947 10.1945C1.65375 9.67882 1.36401 8.97935 1.36401 8.25V6.875C1.36401 6.69266 1.43645 6.5178 1.56538 6.38886C1.69431 6.25993 1.86918 6.1875 2.05151 6.1875H4.80151" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="visually-hidden">
            <?php _e( 'Турниры', 'earena_2' ); ?>
          </span>

          <?php
            $count_admin_tournaments = (int) count_admin_tournaments(1) + (int) count_admin_tournaments(2) + (int) count_admin_tournaments(3);
          ?>
          <span class="personal__link-count personal__link-count--tournaments-admin <?= $count_admin_tournaments === 0 ? 'zero' : ''; ?>">
            <?= $count_admin_tournaments; ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(510)) echo 'active'; ?>" href="<?php echo get_page_link(510); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.90404 15.2107C2.87903 13.4828 2.52006 11.4401 2.89454 9.46627C3.26902 7.49241 4.35119 5.72316 5.93784 4.49073C7.52448 3.2583 9.50646 2.64747 11.5116 2.77294C13.5167 2.89842 15.4071 3.75157 16.8277 5.17219C18.2484 6.59281 19.1015 8.48317 19.227 10.4883C19.3525 12.4935 18.7417 14.4754 17.5093 16.0621C16.2768 17.6487 14.5076 18.7309 12.5337 19.1054C10.5599 19.4799 8.5172 19.1209 6.78928 18.0959L6.7893 18.0959L3.93991 18.91C3.82202 18.9436 3.69727 18.9452 3.57858 18.9144C3.45989 18.8837 3.35159 18.8217 3.26489 18.7351C3.1782 18.6484 3.11626 18.5401 3.08551 18.4214C3.05476 18.3027 3.0563 18.1779 3.08998 18.06L3.9041 15.2106L3.90404 15.2107Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.25 9.625H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.25 12.375H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>


          <span class="visually-hidden">
            <?php _e( 'Сообщения', 'earena_2' ); ?>
          </span>

          <?php
            $count_admin_messages = !empty(messages_get_unread_count()) ? (int) messages_get_unread_count() : 0;
          ?>
          <span class="personal__link-count personal__link-count--messages-admin <?= $count_admin_messages === 0 ? 'zero' : ''; ?>">
            <?= $count_admin_messages; ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(637)) echo 'active'; ?>" href="<?php echo get_page_link(637); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.1666 10.1567V11C20.1655 12.9768 19.5254 14.9002 18.3418 16.4834C17.1582 18.0666 15.4946 19.2248 13.599 19.7853C11.7034 20.3458 9.67741 20.2784 7.82318 19.5934C5.96896 18.9084 4.38585 17.6423 3.30997 15.984C2.23408 14.3257 1.72306 12.3641 1.85312 10.3917C1.98318 8.41922 2.74736 6.54167 4.03168 5.03902C5.31599 3.53637 7.05164 2.48914 8.97976 2.05351C10.9079 1.61787 12.9252 1.81718 14.7308 2.62171" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M20.1667 3.66663L11 12.8425L8.25 10.0925" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="visually-hidden">
            <?php _e( 'Верификация', 'earena_2' ); ?>
          </span>

          <?php
            $count_admin_verification_requests = (int) ea_count_verification_requests();
          ?>
          <span class="personal__link-count personal__link-count--verification-admin <?= $count_admin_verification_requests === 0 ? 'zero' : ''; ?>">
            <?= $count_admin_verification_requests;?>
          </span>
        </a>
      </li>
    <?php else: ?>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(503)) echo 'active'; ?>" href="<?php echo get_page_link(503); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11 19.25C15.5563 19.25 19.25 15.5563 19.25 11C19.25 6.44365 15.5563 2.75 11 2.75C6.44365 2.75 2.75 6.44365 2.75 11C2.75 15.5563 6.44365 19.25 11 19.25Z" stroke="#7B8899" stroke-width="1.5" stroke-miterlimit="10"/>
            <path d="M11 13.75C12.8985 13.75 14.4375 12.211 14.4375 10.3125C14.4375 8.41402 12.8985 6.875 11 6.875C9.10152 6.875 7.5625 8.41402 7.5625 10.3125C7.5625 12.211 9.10152 13.75 11 13.75Z" stroke="#7B8899" stroke-width="1.5" stroke-miterlimit="10"/>
            <path d="M5.48267 17.1337C6.00053 16.1155 6.79005 15.2605 7.76382 14.6633C8.73758 14.0661 9.85761 13.75 10.9999 13.75C12.1422 13.75 13.2623 14.0661 14.236 14.6633C15.2098 15.2605 15.9993 16.1155 16.5172 17.1337" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="visually-hidden">
            <?php _e( 'Аккаунт', 'earena_2' ); ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(518)) echo 'active'; ?>" href="<?php echo get_page_link(518); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.0625 9.28125H15.8125" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M6.1875 9.28125H8.9375" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7.5625 7.90625V10.6562" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.7829 4.79004L7.2192 4.8124C6.16854 4.81248 5.15149 5.18264 4.34658 5.85791C3.54166 6.53317 3.00033 7.47038 2.8176 8.50503L2.81834 8.50516L1.41202 15.7379C1.32319 16.2419 1.39734 16.761 1.62369 17.22C1.85004 17.679 2.2168 18.0538 2.67072 18.2901C3.12463 18.5264 3.64206 18.6119 4.14784 18.534C4.65363 18.4562 5.12144 18.2192 5.48333 17.8574L5.48319 17.8572L9.19875 13.7499L14.7829 13.7275C15.9681 13.7275 17.1047 13.2567 17.9428 12.4187C18.7808 11.5806 19.2516 10.444 19.2516 9.25879C19.2516 8.0736 18.7808 6.93696 17.9428 6.09891C17.1047 5.26085 15.9681 4.79004 14.7829 4.79004V4.79004Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M19.1837 8.48291L20.5888 15.738C20.6777 16.242 20.6035 16.7612 20.3772 17.2201C20.1508 17.6791 19.7841 18.0539 19.3302 18.2902C18.8762 18.5265 18.3588 18.612 17.853 18.5342C17.3472 18.4563 16.8794 18.2193 16.5175 17.8575L16.5177 17.8573L12.8047 13.7356" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="visually-hidden">
            <?php _e( 'Матчи', 'earena_2' ); ?>
          </span>

          <?php
            $count_matches = (int) counter_matches($ea_user->ID);
          ?>
          <span class="personal__link-count personal__link-count--matches <?= $count_matches === 0 ? 'zero' : ''; ?>">
            <?= $count_matches; ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(521)) echo 'active'; ?>" href="<?php echo get_page_link(521); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4.8125 4.8125V9.54732C4.8125 12.9591 7.54141 15.787 10.9531 15.8123C11.7696 15.8185 12.5792 15.663 13.3353 15.3549C14.0914 15.0467 14.7791 14.5919 15.3586 14.0168C15.9381 13.4416 16.3981 12.7574 16.712 12.0037C17.0259 11.2499 17.1875 10.4415 17.1875 9.625V4.8125C17.1875 4.63016 17.1151 4.4553 16.9861 4.32636C16.8572 4.19743 16.6823 4.125 16.5 4.125H5.5C5.31766 4.125 5.1428 4.19743 5.01386 4.32636C4.88493 4.4553 4.8125 4.63016 4.8125 4.8125Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.25 19.25H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11 15.8125V19.25" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M17.6695 10.7356H17.7639C18.4933 10.7356 19.1927 10.4459 19.7085 9.93014C20.2242 9.41441 20.5139 8.71494 20.5139 7.9856V6.6106C20.5139 6.42826 20.4415 6.25339 20.3125 6.12446C20.1836 5.99553 20.0087 5.9231 19.8264 5.9231H17.5" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M4.98122 11H4.11401C3.38467 11 2.6852 10.7103 2.16947 10.1945C1.65375 9.67882 1.36401 8.97935 1.36401 8.25V6.875C1.36401 6.69266 1.43645 6.5178 1.56538 6.38886C1.69431 6.25993 1.86918 6.1875 2.05151 6.1875H4.80151" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="visually-hidden">
            <?php _e( 'Турниры', 'earena_2' ); ?>
          </span>

          <?php
            $count_tournaments = (int) counter_tournaments($ea_user->ID);
          ?>
          <span class="personal__link-count personal__link-count--tournaments <?= $count_tournaments === 0 ? 'zero' : ''; ?>">
            <?= $count_tournaments; ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(510)) echo 'active'; ?>" href="<?php echo get_page_link(510); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.90404 15.2107C2.87903 13.4828 2.52006 11.4401 2.89454 9.46627C3.26902 7.49241 4.35119 5.72316 5.93784 4.49073C7.52448 3.2583 9.50646 2.64747 11.5116 2.77294C13.5167 2.89842 15.4071 3.75157 16.8277 5.17219C18.2484 6.59281 19.1015 8.48317 19.227 10.4883C19.3525 12.4935 18.7417 14.4754 17.5093 16.0621C16.2768 17.6487 14.5076 18.7309 12.5337 19.1054C10.5599 19.4799 8.5172 19.1209 6.78928 18.0959L6.7893 18.0959L3.93991 18.91C3.82202 18.9436 3.69727 18.9452 3.57858 18.9144C3.45989 18.8837 3.35159 18.8217 3.26489 18.7351C3.1782 18.6484 3.11626 18.5401 3.08551 18.4214C3.05476 18.3027 3.0563 18.1779 3.08998 18.06L3.9041 15.2106L3.90404 15.2107Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.25 9.625H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M8.25 12.375H13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>


          <span class="visually-hidden">
            <?php _e( 'Сообщения', 'earena_2' ); ?>
          </span>


          <?php
            $count_messages = !empty(messages_get_unread_count()) ? (int) messages_get_unread_count() : 0;
          ?>
          <span class="personal__link-count personal__link-count--messages <?= $count_messages === 0 ? 'zero' : ''; ?>">
            <?= $count_messages; ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(515)) echo 'active'; ?>" href="<?php echo get_page_link(515); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.5625 13.75C10.0305 13.75 12.0312 11.7493 12.0312 9.28125C12.0312 6.81323 10.0305 4.8125 7.5625 4.8125C5.09448 4.8125 3.09375 6.81323 3.09375 9.28125C3.09375 11.7493 5.09448 13.75 7.5625 13.75Z" stroke="#7B8899" stroke-width="1.5" stroke-miterlimit="10"/>
            <path d="M13.3557 4.97901C13.9704 4.80583 14.615 4.76638 15.2461 4.86331C15.8773 4.96024 16.4804 5.19131 17.0147 5.54094C17.5491 5.89057 18.0023 6.35065 18.3439 6.89019C18.6855 7.42973 18.9074 8.0362 18.9949 8.66876C19.0823 9.30131 19.0332 9.94527 18.8508 10.5572C18.6685 11.1692 18.3571 11.735 17.9376 12.2165C17.5181 12.698 17.0004 13.084 16.4192 13.3485C15.838 13.6131 15.2068 13.75 14.5683 13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1.37476 16.9638C2.07268 15.971 2.99923 15.1608 4.07616 14.6014C5.15309 14.0421 6.3488 13.75 7.56233 13.75C8.77586 13.75 9.97159 14.0419 11.0486 14.6012C12.1255 15.1604 13.0521 15.9706 13.7501 16.9633" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.5684 13.75C15.782 13.7491 16.978 14.0407 18.055 14.6C19.1321 15.1594 20.0585 15.97 20.7559 16.9633" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>


          <span class="visually-hidden">
            <?php _e( 'Друзья', 'earena_2' ); ?>
          </span>

          <?php
            $count_friends_requests = !empty(friends_get_friendship_request_user_ids(get_current_user_id())) ? count(friends_get_friendship_request_user_ids(get_current_user_id())) : 0;
          ?>
          <span class="personal__link-count personal__link-count--friends <?= $count_friends_requests === 0 ? 'zero' : ''; ?>">
            <?= $count_friends_requests; ?>
          </span>
        </a>
      </li>
      <li class="personal__item">
        <a class="personal__link <?php if(is_page(654)) echo 'active'; ?>" href="<?php echo get_page_link(654); ?>">
          <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.9375 6.875L8.9375 17.5071C8.9375 17.6202 8.90956 17.7317 8.85615 17.8315C8.80274 17.9313 8.72553 18.0163 8.63136 18.0791L7.68672 18.7089C7.59505 18.77 7.49004 18.8082 7.38053 18.8202C7.27101 18.8322 7.16021 18.8178 7.05745 18.7781C6.95469 18.7383 6.86299 18.6745 6.79006 18.5919C6.71713 18.5093 6.66511 18.4104 6.63839 18.3036L5.5 13.75" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M5.5 13.75C4.58832 13.75 3.71398 13.3878 3.06932 12.7432C2.42466 12.0985 2.0625 11.2242 2.0625 10.3125C2.0625 9.40081 2.42466 8.52647 3.06932 7.88181C3.71398 7.23716 4.58832 6.87499 5.5 6.87499L8.9375 6.87499C8.9375 6.87499 13.6169 6.87499 18.12 3.09825C18.2202 3.01395 18.3423 2.96001 18.4721 2.94276C18.6018 2.92551 18.7338 2.94567 18.8525 3.00087C18.9712 3.05608 19.0717 3.14402 19.1421 3.25437C19.2125 3.36471 19.2499 3.49287 19.25 3.62377L19.25 17.0012C19.2499 17.1321 19.2125 17.2603 19.1421 17.3706C19.0716 17.481 18.9712 17.5689 18.8525 17.6241C18.7338 17.6793 18.6018 17.6995 18.4721 17.6822C18.3423 17.665 18.2202 17.611 18.12 17.5267C13.6169 13.75 8.9375 13.75 8.9375 13.75L5.5 13.75Z" stroke="#7B8899" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>

          <span class="visually-hidden">
            <?php _e( 'Уведомления', 'earena_2' ); ?>
          </span>

          <?php
            $count_administration = (int) counter_admin();
          ?>
          <span class="personal__link-count personal__link-count--administration <?= $count_administration === 0 ? 'zero' : ''; ?>">
            <?= $count_administration; ?>
          </span>
        </a>
      </li>
    <?php endif; ?>
  </ul>
</div>
