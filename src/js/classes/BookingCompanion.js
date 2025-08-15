/**
 * BookingCompanion manages booking details and UI updates for a booking widget.
 */
export class BookingCompanion {
  /**
   * CSS selector for the booking widget container.
   */
  selector = "";
  /**
   * Set the selector for the booking widget container.
   * @param {string} val - The CSS selector string.
   */
  setSelector(val) {
    this.selector = val;
  }

  /**
   * Selected package name.
   */
  package = "";
  /**
   * Set the selected package name.
   * @param {string} val - The package name.
   */
  setPackage(val) {
    this.package = val;
  }

  /**
   * Selected booking date.
   */
  date = "";
  /**
   * Set the booking date.
   * @param {string} val - The date string.
   */
  setDate(val) {
    this.date = val;
  }

  /**
   * Selected booking time.
   */
  time = "";
  /**
   * Set the booking time.
   * @param {string} val - The time string.
   */
  setTime(val) {
    this.time = val;
  }

  /**
   * Selected booking year.
   * Defaults to current year.
   */
  year = new Date().getFullYear();
  /**
   * Set the booking year.
   * @param {number|string} val - The year value.
   */
  setYear(val) {
    this.year = val;
  }

  /**
   * Booking capacity (default: 24).
   */
  capacity = "24";
  /**
   * Set the booking capacity.
   * @param {number|string} val - The capacity value.
   */
  setCapacity(val) {
    this.capacity = val.toString();
  }

  /**
   * Create a BookingCompanion instance.
   * @param {string} selector - The CSS selector for the booking widget container.
   */
  constructor(selector) {
    this.setSelector(selector);
  }

  /**
   * Update the booking details UI in the widget.
   */
  update() {
    const $ = jQuery;
    const $rows = $(this.selector).find("#booking-rows");

    $rows.html("");

    if (this.package) {
      const pack = this.createBookingRow("Package", this.package);
      $rows.append(pack);
    }

    if (this.date && this.time && this.year) {
      const dateTime = `${this.date}, ${this.year} ${this.time}`;
      const pack = this.createBookingRow("Date and Time", dateTime);
      $rows.append(pack);
    }

    this.syncCapacityField();
  }

  /**
   * Create a booking row DOM element for display.
   * @param {string} title - The label for the row.
   * @param {string} input - The value to display.
   * @returns {HTMLDivElement} The booking row element.
   */
  createBookingRow(title, input) {
    const row = document.createElement("div");
    row.classList.add("booking-row");

    const label = document.createElement("div");
    label.classList.add("booking-label");
    label.textContent = title;

    const val = document.createElement("div");
    val.classList.add("booking-value");
    val.textContent = input;

    row.appendChild(label);
    row.appendChild(val);
    return row;
  }

  /**
   * Handle time slot selection in the booking widget.
   * @param {jQuery} $this - The jQuery object for the selected time slot.
   */
  timeSlotSelect($this) {
    const unavailable = "gpb-booking-time-picker__slot--unavailable";
    if ($this.hasClass(unavailable)) return;

    const $ = jQuery;

    const date = $(".gpb-booking-time-picker__header h4").text();
    this.setDate(date);

    const time = $this.attr("aria-label").replace("Selected time:", "");
    this.setTime(time);

    this.update();
  }

  /**
   * Synchronize booking details on page load.
   */
  pageLoadSync() {
    const $ = jQuery;

    if ($(this.selector).length <= 0) return;

    const $resourceCtn = $(".gfield--type-gpb_resource");

    if ($resourceCtn.length > 0) {
      const selectedPackage = $resourceCtn.find("select option:selected");
      this.setPackage(selectedPackage.text());
    }

    const $resourceSelect = $resourceCtn.find("select");

    $.get(`/wp-json/wp/v2/gpb_resource/${$resourceSelect.val()}`, (data) => {
      this.setCapacity(data.acf.participant_capacity);
      this.update();
    });
  }

  /**
   * Synchronize stored capacity with capacity select field.
   */
  syncCapacityField() {
    const $ = jQuery;
    const $limiter = $(".capacity-select select");

    if ($limiter.length > 0) {
      let num = 0;
      const capacity = this.capacity;

      $limiter.find("option").each(function () {
        if (num < capacity) {
          $(this).show();
        } else {
          $(this).hide();
        }

        num++;
      });
    }
  }
}
