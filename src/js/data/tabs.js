export function tabs() {
  return {
    activeTab: 0,

    setActive(index) {
      this.activeTab = index;
    },

    isActive(index) {
      return this.activeTab === index;
    },

    tabClasses(index, active, inactive) {
      return this.activeTab === index ? active : inactive;
    },
  };
}
