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

  /* Main Nav */
  if ($(window).width() < 1080) {
    $(".main--menu .menu-item-has-children span").on("click", function (event) {
      event.preventDefault();
      event.stopPropagation();
      $(this).toggleClass("menuOpen");
      $(this).parent().siblings(".sub-menu").slideToggle("slow");
    });
  }

  if ($(window).width() < 1080) {
    $(".main--menu .menu-item-has-children").append("<span></span>");
    $(".menu-item-has-children > span").on("click", function (event) {
      event.preventDefault();
      event.stopPropagation();
      $(this).parent(".menu-item-has-children").siblings().removeClass("open");
      $(this).parent(".menu-item-has-children").toggleClass("open");
    });
  }

  /* Sticky Menu */

  $(".toggle-menu").on("click", function () {
    $("body").toggleClass("menu-extended");
    $("header").toggleClass("nav-open");
    $(".main--menu").removeClass("sub-menu-open");
    $(".menu-item-has-children").removeClass("open");
  });

  // End of Sticky Menu

  /* Filter drop down */

  $(".filter-title").click(function () {
    $(this).data("clicked", true);
    var $this = $(this);

    $(".filter-title").not($this).next().removeClass("filter-active");
    $(this).next().toggleClass("filter-active");
  });

  // End of Filter drop down

  /* Footer Menu Slide Mobile */
  if ($(window).width() < 768) {
    $(".filters--title").on("click", function () {
      $(this).toggleClass("filter-open");
      $(this).siblings(".filters--list").slideToggle("slow");
    });

    $(".footer--title").on("click", function (e) {
      e.preventDefault();
      $(this).siblings(".footer--menu").slideToggle("slow");
    });

    $(".scroller__title").on("click", function () {
      $(this).toggleClass("scroll-nav-open");
      $(this).siblings(".scroller__nav").slideToggle();
    });
  }
  // End of Footer Menu Slide Mobile

  /* Footer Menu Slide Mobile */
  $('.scroll--nav a[href^="#"]').on("click", function (event) {
    var target = $(this.getAttribute("href"));
    if (target.length) {
      event.preventDefault();
      $("html, body")
        .stop()
        .animate(
          {
            scrollTop: target.offset().top - 0,
          },
          1000
        );
    }
  });
  // End of Footer Menu Slide Mobile

  /* Language Selector */
  $(".nav-toggle").on("click", function () {
    $(this).toggleClass("footer-menu-expand");
    $(".footer--nav").slideToggle();
  });
  // End of Language Selector

  /* Parallax Effect on scroll */
  /* ------------------------------------------- */
  $(".jarallax").jarallax();

  /* Custom Tabs */
  /* ------------------------------------------- */

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

  var inf_scrll = jQuery(".next");
  //console.log(inf_scrll.length);
  if (inf_scrll.length) {
    var infScroll = new InfiniteScroll(".ctal-item--container", {
      // the wrapper/container
      path: ".next",
      append: ".grid__items",
      // append: ".news",
      status: ".page-load-status",
      hideNav: ".pagination",
      // load pages on button click - switch scrollThreshold to FALSE
      button: ".load-more",
      scrollThreshold: false,
      history: false,
      // status: ".page-load-status",
    });

    // Do stuff when new items arrive
    var $container = jQuery(".ctal-item--container");
    $container.on(
      "append.infiniteScroll",
      function (event, response, path, items) {
        const scrollers = document.querySelectorAll("[data-scroll]");
        const observer = new IntersectionObserver(check);
        scrollers.forEach((scroller) => observer.observe(scroller));
      }
    );
  }
  // ENd of

  // Map Toggle
  $(".map-toggle").on("click", function () {
    $(this).toggleClass("close");
    $("#mapid").toggleClass("close");
  });
});

/* window load class helper */
/* ------------------------------------------- */
/* manually doing in-view stuff */

const scrollers = document.querySelectorAll("[data-scroll]");

function check(entries) {
  entries.map((entry) => {
    if (entry.isIntersecting) {
      entry.target.classList.add("in-view");
      observer.unobserve(entry.target);
    }
  });
}

const observer = new IntersectionObserver(check);
scrollers.forEach((scroller) => observer.observe(scroller));

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

$(window).on("load", function () {
  /* =============================================================================
  ---------------------------------  Preloader  ----------------------------------
  ============================================================================= */

  var body = $("body");
  body.addClass("loaded");
  setTimeout(function () {
    body.removeClass("loaded");
  }, 1500);
});

/* =============================================================================
  -----------------------------  Button scroll up   ------------------------------
  ============================================================================= */

$(document).ready(function () {
  "use strict";

  var progressPath = document.querySelector(".progress-wrap path");
  var pathLength = progressPath.getTotalLength();
  progressPath.style.transition = progressPath.style.WebkitTransition = "none";
  progressPath.style.strokeDasharray = pathLength + " " + pathLength;
  progressPath.style.strokeDashoffset = pathLength;
  progressPath.getBoundingClientRect();
  progressPath.style.transition = progressPath.style.WebkitTransition =
    "stroke-dashoffset 10ms linear";
  var updateProgress = function () {
    var scroll = $(window).scrollTop();
    var height = $(document).height() - $(window).height();
    var progress = pathLength - (scroll * pathLength) / height;
    progressPath.style.strokeDashoffset = progress;
  };
  updateProgress();
  $(window).scroll(updateProgress);
  var offset = 150;
  var duration = 550;
  jQuery(window).on("scroll", function () {
    if (jQuery(this).scrollTop() > offset) {
      jQuery(".progress-wrap").addClass("active-progress");
    } else {
      jQuery(".progress-wrap").removeClass("active-progress");
    }
  });
  jQuery(".progress-wrap").on("click", function (event) {
    event.preventDefault();
    jQuery("html, body").animate({ scrollTop: 0 }, duration);
    return false;
  });
});

/* =============================================================================
  -----------------------------  Progress   ------------------------------
  ============================================================================= */

$(document).scroll(function () {
  var scrollTop = $(document).scrollTop();
  var scrollHeight = $(document).height();
  var windowHeight = $(window).height();
  var scrollBottom = scrollHeight - windowHeight;
  var scrollPercent = (scrollTop / scrollBottom) * 100 + "%";
  $("#progress").css("--scroll", scrollPercent);
});
