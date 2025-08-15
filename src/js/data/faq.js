export function faqData() {
  return {
    opened: 0,

    setOpened(index) {
      this.opened = index;
    },
    isOpened(index) {
      return this.opened === index;
    },
  };
}
