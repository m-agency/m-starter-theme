export function separator() {
  return {
    init() {
      const isAdminPage = document
        .querySelector("body")
        .classList.contains("wp-admin");

      let targetEl = null;

      if (isAdminPage) {
        const parentEl = this.$el.parentElement;
        const previous = parentEl.previousElementSibling;

        if (!previous.classList.contains("acf-block-component")) return;

        targetEl = previous.querySelector("section");
      } else {
        targetEl = this.$el.previousElementSibling;
      }

      if (targetEl && targetEl.nodeName === "SECTION" && isAdminPage) {
        targetEl.style.paddingBottom = "calc(clamp(3.125rem, 15%, 9.375rem))";
        targetEl.parentElement.style.marginBottom = 0;
      } else if (targetEl && targetEl.nodeName === "SECTION") {
        targetEl.style.paddingBottom = "clamp(3.125rem, 15vw, 9.375rem)";
      } else {
        this.$el.remove();
      }
    },
  };
}
