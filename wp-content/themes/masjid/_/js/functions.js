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

$(function () {
  "use strict";

  var wind = $(window);

  /* =============================================================================
    -------------------------------  Preloader svg   -------------------------------
    ============================================================================= */

  const svg = document.getElementById("svg");
  const tl = gsap.timeline();
  const curve = "M0 502S175 272 500 272s500 230 500 230V0H0Z";
  const flat = "M0 2S175 1 500 1s500 1 500 1V0H0Z";

  tl.to(".loader-wrap-heading .load-text , .loader-wrap-heading .cont", {
    delay: 1.5,
    y: -100,
    opacity: 0,
  });
  tl.to(svg, {
    duration: 0.5,
    attr: { d: curve },
    ease: "power2.easeIn",
  }).to(svg, {
    duration: 0.5,
    attr: { d: flat },
    ease: "power2.easeOut",
  });
  tl.to(".loader-wrap", {
    y: -1500,
  });
  tl.to(".loader-wrap", {
    zIndex: -1,
    display: "none",
  });
  tl.from(
    "header",
    {
      y: 200,
    },
    "-=1.5"
  );
  tl.from(
    "header .container",
    {
      y: 40,
      opacity: 0,
      delay: 0.3,
    },
    "-=1.5"
  );
});
