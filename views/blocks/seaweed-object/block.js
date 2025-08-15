document.addEventListener("DOMContentLoaded", () => {
  const initializeBlock = () => {
    const path = document.querySelector('#path-right');
    const pathLength = path.getTotalLength();

    path.style.strokeDasharray = pathLength + ' ' + pathLength;
    path.style.strokeDashoffset = pathLength;

    path.getBoundingClientRect();

    window.addEventListener("scroll", function (e) {
      const offset1 = document.documentElement.scrollTop + document.body.scrollTop;
      const offset2 = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrollPercentage = offset1 / offset2 * 4;
      const drawLength = pathLength * scrollPercentage;

      path.style.strokeDashoffset = pathLength - drawLength;

      if (scrollPercentage >= 0.99) {
        path.style.strokeDasharray = "none";
      } else {
        path.style.strokeDasharray = pathLength + ' ' + pathLength;
      }
    });
    const parallax = document.getElementsByClassName("svg-right-parallax");
    new window.simpleParallax(parallax, {
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