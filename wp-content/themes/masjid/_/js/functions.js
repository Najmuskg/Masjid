// conflict bugg solution
var $ = jQuery.noConflict();

$(function () {
  // $('.banner--wrapper .scroll--down__arrow').on('click', function (e) {
  //   // var href = $(this).attr('href');
  //   e.preventDefault();

  //   $('html, body').animate({
  //     scrollTop: $('section:nth-child(2)').offset().top
  //   }, '5000');
  // });

  /* Show Header when scroll up */
  /* ------------------------------------------- */
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
  /* ------------------------------------------- */
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
  /* ------------------------------------------- */
  $(".toggle-menu").on("click", function () {
    $("body").toggleClass("menu-extended");
    $("header").toggleClass("nav-open");
    $(".main--menu").removeClass("sub-menu-open");
    $(".menu-item-has-children").removeClass("open");
  });

  // End of Sticky Menu

  /* Filter drop down */
  /* ------------------------------------------- */
  $(".filter-title").click(function () {
    $(this).data("clicked", true);
    var $this = $(this);

    $(".filter-title").not($this).next().removeClass("filter-active");
    $(this).next().toggleClass("filter-active");
  });

  /* Themes Select */
  /* ------------------------------------------- */

  // Retrieve the stored checkbox state from localStorage
  var isChecked = localStorage.getItem("checkboxState");

  if (isChecked === "true") {
    $(".themeSelect input[type=checkbox]").prop("checked", true);
    $("body").addClass("themeLight");
  }

  $(".themeSelect input[type=checkbox]").change(function () {
    if (this.checked) {
      $("body").addClass("themeLight");
      // Store the checkbox state as checked in localStorage
      localStorage.setItem("checkboxState", true);
    } else {
      $("body").removeClass("themeLight");
      // Store the checkbox state as unchecked in localStorage
      localStorage.setItem("checkboxState", false);
    }
  });

  /* Themes Select */
  /* ------------------------------------------- */

  $(".cloak").click(function () {
    $(this).parent().removeClass("filter-active");
  });
  // End of Filter drop down

  /* Footer Menu Slide Mobile */
  /* ------------------------------------------- */

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
  /* ------------------------------------------- */
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
  /* ------------------------------------------- */

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


  // $('.tab-link').click( function() {

  //   var tabID = $(this).attr('data-tab');

  //   $(this).addClass('active').siblings().removeClass('active');

  //   $('#tab-'+tabID).addClass('active').siblings().removeClass('active');
  // });

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
$(window).on("load", function () {
  // setTimeout(function () {
  $("html").removeClass("loading").addClass("loaded");
  // }, 10000);
});

/* manually doing in-view stuff */
/* ------------------------------------------- */

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