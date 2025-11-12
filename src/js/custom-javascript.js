// Add your custom JS here.
AOS.init({
  easing: "ease-out",
  once: true,
  duration: 600,
});

// (function () {
//   // Hide header on scroll
//   var doc = document.documentElement;
//   var w = window;

//   var prevScroll = w.scrollY || doc.scrollTop;
//   var curScroll;
//   var direction = 0;
//   var prevDirection = 0;

//   var header = document.getElementById("wrapper-navbar");

//   var checkScroll = function () {
//     // Find the direction of scroll (0 - initial, 1 - up, 2 - down)
//     curScroll = w.scrollY || doc.scrollTop;
//     if (curScroll > prevScroll) {
//       // Scrolled down
//       direction = 2;
//     } else if (curScroll < prevScroll) {
//       // Scrolled up
//       direction = 1;
//     }

//     if (direction !== prevDirection) {
//       toggleHeader(direction, curScroll);
//     }

//     prevScroll = curScroll;
//   };

//   var toggleHeader = function (direction, curScroll) {
//     if (direction === 2 && curScroll > 125) {
//       // Replace 52 with the height of your header in px
//       if (!document.getElementById("navbar").classList.contains("show")) {
//         header.classList.add("hide");
//         prevDirection = direction;
//       }
//     } else if (direction === 1) {
//       header.classList.remove("hide");
//       prevDirection = direction;
//     }
//   };

//   window.addEventListener("scroll", checkScroll);
// })();

// Add background to navbar on scroll
(function () {
  var navbar = document.getElementById("wrapper-navbar");

  var addNavbarBackground = function () {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  };

  window.addEventListener("scroll", addNavbarBackground);
})();

// Add background to navbar when mobile menu is opened
(function () {
  var navbar = document.getElementById("wrapper-navbar");
  var mobileToggle = document.querySelector(".navbar-toggler");
  var mobileMenu = document.getElementById("navbar");

  if (!mobileToggle || !mobileMenu) return;

  var handleMobileMenuToggle = function () {
    // Check if the mobile menu is shown (Bootstrap 5 uses 'show' class)
    if (mobileMenu.classList.contains("show")) {
      navbar.classList.add("mobile-menu-open");
    } else {
      navbar.classList.remove("mobile-menu-open");
    }
  };

  // Listen for Bootstrap collapse events
  mobileMenu.addEventListener("shown.bs.collapse", function () {
    navbar.classList.add("mobile-menu-open");
  });

  mobileMenu.addEventListener("hidden.bs.collapse", function () {
    navbar.classList.remove("mobile-menu-open");
  });

  // Fallback: Listen for click events on toggle button
  mobileToggle.addEventListener("click", function () {
    // Use a small delay to let Bootstrap finish the toggle
    setTimeout(handleMobileMenuToggle, 50);
  });
})();

// Page Hero: Set background image on mobile for blend mode effect
(function () {
  var pageHero = document.querySelector(".page-hero");
  var heroImage = document.querySelector(".page-hero__image");

  if (!pageHero || !heroImage) return;

  var setMobileBackground = function () {
    if (window.innerWidth <= 767) {
      var imageSrc = heroImage.src || heroImage.getAttribute("data-src");
      if (imageSrc) {
        // Set multiple backgrounds: gradient overlay + image
        var gradient =
          "linear-gradient(135deg, hsl(224 48% 18% / 0.9) 0%, hsl(224 48% 18% / 0.8) 50%, hsl(224 48% 18% / 0.6) 100%)";
        pageHero.style.backgroundImage = `${gradient}, url(${imageSrc})`;
      }
    } else {
      pageHero.style.backgroundImage = "";
    }
  };

  // Set on load
  setMobileBackground();

  // Update on resize
  window.addEventListener("resize", setMobileBackground);
})();

// // Header background
// document.addEventListener("scroll", function () {
//   var nav = document.getElementById("navbar");
//   //   var primaryNav = document.getElementById('primaryNav');
//   //   if (!primaryNav.classList.contains('show')) {
//   //       nav.classList.toggle('scrolled', window.scrollY > nav.offsetHeight);
//   //   }
//   document.querySelectorAll(".dropdown-menu").forEach(function (dropdown) {
//     dropdown.classList.remove("show");
//   });
//   document.querySelectorAll(".dropdown-toggle").forEach(function (toggle) {
//     toggle.classList.remove("show");
//     toggle.blur();
//   });
// });
