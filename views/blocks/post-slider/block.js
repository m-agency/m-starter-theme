document.addEventListener("DOMContentLoaded", () => {
  if (document.querySelector('#path-left')) {
    var path1 = document.querySelector('#path-left');
    var path2 = document.querySelector('#path-right');

    var pathLength1 = path1.getTotalLength();
    var pathLength2 = path2.getTotalLength();

    // Make very long dashes (the length of the path itself)
    path1.style.strokeDasharray = pathLength1 + ' ' + pathLength1;
    path2.style.strokeDasharray = pathLength2 + ' ' + pathLength2;

    // Offset the dashes so the it appears hidden entirely
    path1.style.strokeDashoffset = pathLength1;
    path2.style.strokeDashoffset = pathLength2;

    // Jake Archibald says so
    // https://jakearchibald.com/2013/animated-line-drawing-svg/
    path1.getBoundingClientRect();
    path2.getBoundingClientRect();

    // When the page scrolls...
    window.addEventListener("scroll", function (e) {
      var scrollPercentage = (document.documentElement.scrollTop + document.body.scrollTop) / (document.documentElement.scrollHeight - document.documentElement.clientHeight) * 4;
      // Length to offset the dashes
      var drawLength1 = pathLength1 * scrollPercentage;
      var drawLength2 = pathLength2 * scrollPercentage;
      // Draw in reverse
      path1.style.strokeDashoffset = pathLength1 - drawLength1;
      path2.style.strokeDashoffset = pathLength2 - drawLength2;

      // When complete, remove the dash array, otherwise shape isn't quite sharp
      // Accounts for fuzzy math
      if (scrollPercentage >= 0.99) {
        path1.style.strokeDasharray = "none";
        path2.style.strokeDasharray = "none";
      } else {
        path1.style.strokeDasharray = pathLength1 + ' ' + pathLength1;
        path2.style.strokeDasharray = pathLength2 + ' ' + pathLength2;
      }
    });
  }

  const initializeBlock = () => {
    if (document.querySelector('.post-slider') === null) return;

    const slider = new window.splide('.post-slider', {
      perPage: 3,
      padding: {
        left: 128,
        right: 300
      },
      gap: 30,
      breakpoints: {
        1536: {
          gap: 20,
          padding: {
            left: 96,
            right: 200
          }
        },
        1280: {
          padding: {
            left: 32,
            right: 180
          }
        },
        1024: {
          perPage: 2,
          padding: {
            left: 24,
            right: 150
          },
        },
        640: {
          gap: 15,
          perPage: 1,
          padding: {
            left: 16,
            right: 100
          },
        }
      }
    });

    slider.mount();

    const parallax1 = document.getElementsByClassName("svg-left-parallax");
    new window.simpleParallax(parallax1, {
      delay: 1,
      transition: "cubic-bezier(0,0,0,1)",
    });

    const parallax2 = document.getElementsByClassName("svg-right-parallax");
    new window.simpleParallax(parallax2, {
      delay: 1,
      transition: "cubic-bezier(0,0,0,1)",
    });
  };

  const interval = setInterval(() => {
    if (typeof splide !== "undefined") {
      clearInterval(interval);
      initializeBlock();
    }
  }, 250);
});