'use strict';

(function () {
  document.addEventListener('readystatechange', function () {
    if (document.readyState === 'interactive') {
      // Promo
      try {
        let promoSlider = document.querySelector('.promo__slider.swiper-container');

        if (promoSlider) {
          var argsSwiperPromo = {
            // autoplay: {
            //   delay: 5000,
            // },
            autoHeight: true,
            speed: 300,
            loop: true,
            slidesPerView: 1,
            resizeObserver: true,
            pagination: {
              el: '.promo__slider-pagination',
              clickable: true
            },
          };

          let promoSwiper = new Swiper(promoSlider, argsSwiperPromo);
        }

        // alert('swiper worked');
      } catch (e) {
        console.log(e);
      }
    }
  });
})();
