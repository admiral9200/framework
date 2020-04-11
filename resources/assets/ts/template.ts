/**
 * Template script file.
 *
 * Every javascript single action must write here.
 */
import axios from "axios";
import jquery from "jquery";
import flatpickr from "flatpickr";
import "select2";

const $: JQueryStatic = jquery;

// Remove items on CRUD
const element = document.getElementById('remove-item');
if (element) {
  const span: any = element.firstElementChild;
  const url: any = element.getAttribute('data-url');

  element.addEventListener('click', (e) => {
    e.preventDefault();
    span.classList.remove('hidden');
    axios.delete(url, {
      headers: {
        "X-Requested-With": "XMLHttpRequest"
      }
    }).then((response) => {
      setTimeout(() => {
        window.location.href = response.data.redirect_url;
      }, 1000);
    });
  });
}

flatpickr(".timepicker", {
  enableTime: true,
  noCalendar: true,
  dateFormat: "H:i",
  time_24hr: true
});

flatpickr(".datepicker", {
  minDate: "today"
});

// jQuery Script
$(() => {
  $('.select-2').select2({
    placeholder: "Search...",
  });
});
