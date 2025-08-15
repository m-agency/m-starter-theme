document.addEventListener("DOMContentLoaded", () => {
  const initializeBlock = () => {
    if (document.querySelector('.venue-slider') === null) return;

    const slider = new window.splide('.venue-slider', {
      perPage: 1,
      start: 1,
      focus: 'center',
      padding: {
        left: 400,
        right: 400
      },
      gap: 'calc(clamp(1rem, 3.5vw, 4.5rem) * -1)',
      breakpoints: {
        1536: {
          padding: {
            left: 300,
            right: 300
          }
        },
        1280: {
          padding: {
            left: 120,
            right: 120
          }
        },
        1024: {
          padding: {
            left: 100,
            right: 100
          },
        },
        640: {
          padding: {
            left: 25,
            right: 25
          },
        }
      }
    });

    slider.mount();
  };

  const interval = setInterval(() => {
    if (typeof splide !== "undefined") {
      clearInterval(interval);
      initializeBlock();
    }
  }, 250);
});