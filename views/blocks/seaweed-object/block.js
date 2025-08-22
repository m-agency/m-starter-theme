document.addEventListener("DOMContentLoaded", () => {
  const initializeBlock = () => {
    const parallax2 = document.getElementsByClassName("svg-right-parallax");
    new window.simpleParallax(parallax2, {
      delay: 1,
      transition: "cubic-bezier(0,0,0,1)",
    });
  };

  const interval = setInterval(() => {
    if (typeof simpleParallax !== "undefined") {
      clearInterval(interval);
      initializeBlock();
    }
  }, 250);
});