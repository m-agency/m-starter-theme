(function ($) {
  const initializeBlock = () => {
    let scrollable = new window.smoothScroll('.book-party');
    scrollable.mount('#booking-form');

    $(document).on('click', '.book-party', function () {
      const $packageField = $('.gfield--type-gpb_resource select');

      if ($packageField.length <= 0) return;

      const resourceID = $(this).data('resource-id');

      if (!resourceID) return;

      $packageField.val(resourceID);
    });
  };

  const interval = setInterval(() => {
    if (typeof window.smoothScroll !== "undefined") {
      clearInterval(interval);
      initializeBlock();
    }
  }, 250);
})(jQuery);