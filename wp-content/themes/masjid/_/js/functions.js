// conflict bugg solution
var $ = jQuery.noConflict();

$(function () {
  var lastScrollTop = 0;
  var $header = $("header");
  var headerHeight = $header.outerHeight();

  $(window).scroll(function () {
    var windowTop = $(window).scrollTop();

    if (windowTop >= headerHeight) {
      $header.addClass("header-sticky");
    } else {
      $header.removeClass("header-sticky");
      $header.removeClass("header-show");
    }

    if ($header.hasClass("header-sticky")) {
      if (windowTop < lastScrollTop) {
        $header.addClass("header-show");
      } else {
        $header.removeClass("header-show");
      }
    }
    lastScrollTop = windowTop;
  });

  $(".jarallax").jarallax();

  $(".tabs li:first-child").addClass("active");
  $(".content-wrapper > div:first-child").addClass("active");

  $(".tabs li a").click(function (e) {
    $(".tabs li, .content-wrapper .active").removeClass("active");
    $(this).parent().addClass("active");
    var currentTab = $(this).attr("href");
    $(currentTab).addClass("active");
    if ($(window).width() >= 700) {
      e.preventDefault();
    }
  });
  // End of Tabs

  new Swiper(".announcements--slider", {
    slidesPerView: "auto",
    spaceBetween: 30,
//     autoplay: {
//       delay: 5000,
//     },
    effect: "slide",
    pagination: {
      el: ".announcements-progress",
      type: "progressbar",
    },

    navigation: {
      nextEl: ".announcements-next",
      prevEl: ".announcements-prev",
    },
  });
});
