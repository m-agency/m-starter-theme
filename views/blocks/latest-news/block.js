document.addEventListener("DOMContentLoaded", () => {
  const initializeBlock = () => {
    const arrow = document.getElementsByClassName("faq-accordions-arrow");

    new window.simpleParallax(arrow, {
      delay: 1,
      orientation: 'down right',
    });
  };

  const interval = setInterval(() => {
    if (typeof simpleParallax !== "undefined") {
      clearInterval(interval);
      initializeBlock();
    }
  }, 250);
});