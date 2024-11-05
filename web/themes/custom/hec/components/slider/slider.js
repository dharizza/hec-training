(function(Drupal, once) {

  Drupal.behaviors.slider = {
    attach(context) {
      once('slider', '.swiper', context).forEach(function (element) {
        alert('hi guys!');

        const swiper = new Swiper('.swiper', {
          // Optional parameters
          direction: 'horizontal',
          loop: true,

          // If we need pagination
          pagination: {
            el: '.swiper-pagination',
          },

          // Navigation arrows
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },

          scrollbar: {
            el: '.swiper-scrollbar',
          },
        });
      })

    },
  };

})(Drupal, once);
