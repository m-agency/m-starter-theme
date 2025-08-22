export function availabilityData(availability) {
  return {
    time: "",
    day: "",
    hours: "",
    days: [
      "sunday",
      "monday",
      "tuesday",
      "wednesday",
      "thursday",
      "friday",
      "saturday",
    ],
    availability: availability,
    currentAvailability: "we're...",
    opened: true,

    init() {
      setInterval(() => {
        this.getTime();
      }, 1);

      this.getDay();
      this.getAvailability();

      setInterval(() => {
        this.getDay();
        this.getAvailability();
      }, 60000);
    },

    getTime() {
      let time = new Date();
      this.time = time.toLocaleString("en-US", {
        hour: "numeric",
        minute: "numeric",
        hour12: true,
        timeZone: "America/Los_Angeles",
      });
    },

    getDay() {
      let date = new Date();
      let day = this.days[date.getDay()];
      this.day = day ? day.charAt(0).toUpperCase() + day.slice(1) : "";
    },

    getAvailability() {
      let day = this.availability[this.day.toLowerCase()];
      let pass = day.opened;
      if (!pass) {
        this.opened = false;
        this.currentAvailability = "closed";
        return;
      } else {
        this.currentAvailability = "open";
        this.hours = "from " + day.start + " - " + day.end;
      }

      let start = day.start;
      let end = day.end;

      let dt = new Date();
      let pst = dt.toLocaleString("en-US", { timeZone: "America/Los_Angeles" });
      let date = new Date(pst);

      let s = start.split(":");
      let dt1 = new Date(
        date.getFullYear(),
        date.getMonth(),
        date.getDate(),
        parseInt(s[0]),
        parseInt(s[1]),
        parseInt(s[2]),
      );

      let e = end.split(":");
      let dt2 = new Date(
        date.getFullYear(),
        date.getMonth(),
        date.getDate(),
        parseInt(e[0]),
        parseInt(e[1]),
        parseInt(e[2]),
      );
    },
  };
}
