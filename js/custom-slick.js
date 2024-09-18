
jQuery(document).ready(function ($) {
    $('.primary-hero-section .hero-item-wrap').slick({
      cssEase: 'linear', // Easing function for fade effect
      adaptiveHeight: true, // Adjust height dynamically
      arrows: true,
      responsive: [
        {
            breakpoint: 1199,
            settings: {
                arrows: false,
                dots: true
            }
        }
    ]
  });
});
