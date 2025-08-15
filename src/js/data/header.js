export function headerData() {
  return {
    open: false,
    mobile: window.innerWidth < 1280,
    toggleMenu(val) {
      this.open = typeof val === `boolean` ? val : !this.open;
    },
    checkForSmallScreen($width) {
      this.mobile = $width < 1280;
    },
  };
}

export function menuItemData() {
  return {
    active: false,
    expanded: false,
    pos: "right",

    setActive(val, el) {
      this.setPos(el);
      this.active = typeof val === `boolean` ? val : !this.active;
    },
    setExpanded(val) {
      this.expanded = typeof val === `boolean` ? val : !this.expanded;
    },
    setPos(el) {
      const rect = el.getBoundingClientRect();
      const halfway = window.innerWidth / 2;

      if (rect.left > halfway) {
        this.pos = "left";
      } else {
        this.pos = "right";
      }
    },
    openSubNav($event) {
      this.expanded = !this.expanded;
      this.active = !this.active;
      $event.preventDefault();
    },
  };
}

export function childMenuData() {
  return {
    open: false,
    expanded: false,

    setOpen(val) {
      this.open = typeof val === `boolean` ? val : !this.open;
    },
    openSubNav($event) {
      this.expanded = !this.expanded;
      this.open = !this.open;
      $event.preventDefault();
    },
  };
}
