export function hover() {
  return {
    hover: false,
    getHover() {
      return this.hover;
    },
    setHover(val) {
      this.hover = val;
    },
  };
}
