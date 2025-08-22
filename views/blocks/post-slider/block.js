document.addEventListener("DOMContentLoaded", () => {
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