/**
 * Alpine.js
 */
import Alpine from "alpinejs";
import resize from "@alpinejs/resize";
import collapse from "@alpinejs/collapse";

import { headerData, menuItemData, childMenuData } from "./data/header";

import { faqData } from "./data/faq";
import { hover } from "./data/hover";
import { separator } from "./data/separator";
import { tabs } from "./data/tabs";
import { menuTabs } from "./data/menuTabs";
import { availabilityData } from "./data/availability";

window.Alpine = Alpine;

Alpine.plugin(resize);
Alpine.plugin(collapse);

Alpine.data("header", headerData);
Alpine.data("menuItem", menuItemData);
Alpine.data("childMenu", childMenuData);
Alpine.data("faq", faqData);
Alpine.data("hover", hover);
Alpine.data("separator", separator);
Alpine.data("tabs", tabs);
Alpine.data("menuTabs", menuTabs);
Alpine.data("availability", availabilityData);

Alpine.start();

/**
 * Smooth Anchor Link Scrolling
 */
import SmoothScroll from "./classes/SmoothScroll";
window.smoothScroll = SmoothScroll;

/**
 * Booking Companion
 */
import { BookingCompanion } from "./classes/BookingCompanion";

document.addEventListener("DOMContentLoaded", () => {
  const path = window.location.pathname;
  const $ = jQuery;

  if (document.querySelector('a[href^="#"]')) {
    let scrollable = new SmoothScroll('a[href^="#"]');
    scrollable.mount();
  }

  if (document.querySelector('a[href^="' + path + '#"]')) {
    let innerScrollable = new SmoothScroll('a[href^="' + path + '#"]');
    innerScrollable.mount();
  }

  $(document).scroll(function () {
    const $nav = $("header");
    $nav.toggleClass("scrolled", $(this).scrollTop() > $nav.height());
  });

  /**
   * Gravity Forms
   * Booking Companion Implementation
   */
  if ($("#booking-form").length) {
    const companion = new BookingCompanion("#booking-companion");

    // Reset preview when user navigates back to day selection.
    $(document).on("click", ".gpb-booking-time-picker__back", function () {
      companion.setDate("");
      companion.setTime("");
      companion.update();
    });

    // Update booking preview when user selects a time slot.
    $(document).on("click", ".gpb-booking-time-picker__slot", function () {
      companion.timeSlotSelect($(this));
    });

    // Store the year in memory when the year dropdown changes.
    $(document).on("change", ".rdp-dropdown.rdp-years_dropdown", function () {
      companion.setYear($(this).val());
    });

    // Ensure the preview is accurate despite any unexpected user behavior.
    $(document).on("gform_page_loaded", function () {
      companion.pageLoadSync();
    });
  } /* End of Booking Form Adjustments */
});

/**
 * Parallax
 */
import SimpleParallax from "simple-parallax-js/vanilla";
window.simpleParallax = SimpleParallax;

/**
 * Sliders
 */
import "@splidejs/splide/css/core";
import Splide from "@splidejs/splide";
window.splide = Splide;
