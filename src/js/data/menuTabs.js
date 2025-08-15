export function menuTabs() {
  return {
    activeTab: 0,
    tabLabels: [],

    setLabels(labels) {
      this.tabLabels = labels;
    },
  };
}
