function openTab(evt, Name) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");

  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  tablinks = document.getElementsByClassName("tablinks");

  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  document.getElementById(Name).style.display = "flex";
  evt.currentTarget.className += " active";
}

document.addEventListener("DOMContentLoaded", () => {
  const initializeBlock = () => {
    jQuery(document).on('click', '.tablinks', function ($e) {
      openTab($e, jQuery(this).data('target'));
    });

    jQuery('.tablinks').eq(0).trigger('click');
  };

  const interval = setInterval(() => {
    if (typeof splide !== "undefined") {
      clearInterval(interval);
      initializeBlock();
    }
  }, 250);
});