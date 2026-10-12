/* MegaMart theme behaviour: side drawer and hero slider. */
(function ($) {
  'use strict';

  // Side drawer
  function openDrawer() {
    $('body').addClass('mm-drawer-open');
    $('#mm-drawer').attr('aria-hidden', 'false');
  }
  function closeDrawer() {
    $('body').removeClass('mm-drawer-open');
    $('#mm-drawer').attr('aria-hidden', 'true');
  }
  $(document).on('click', '[data-mm-drawer-open]', function (e) {
    e.preventDefault();
    openDrawer();
  });
  $(document).on('click', '[data-mm-drawer-close]', closeDrawer);
  $(document).on('keydown', function (e) {
    if (e.key === 'Escape') closeDrawer();
  });

  // Hero slider (only when a block has more than one slide)
  $(function () {
    if (!$.fn.slick) return;
    $('.js-mm-hero').each(function () {
      var $slider = $(this);
      var $wrap = $slider.closest('.mm-hero-wrap');
      $slider.slick({
        dots: true,
        arrows: true,
        prevArrow: $wrap.find('.mm-hero__arrow--prev'),
        nextArrow: $wrap.find('.mm-hero__arrow--next'),
        autoplay: true,
        autoplaySpeed: 5000,
        adaptiveHeight: false,
        rtl: $('html').attr('dir') === 'rtl'
      });
    });
  });
})(jQuery);
