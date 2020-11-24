let today = new Date();
let todayDate = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);

let minDate = new Date();

let minDay = minDate.getDate();
let minMonth = minDate.getMonth() + 1;
let minYear = minDate.getFullYear();

if (minDay <= 10) {
  minDay = '0' + minDay;
}

if (minMonth < 10) {
  minMonth = '0' + minMonth;
}

let maxDay = minDay;
let maxMonth = minMonth;
let maxYear = minYear + 1;

minDate = minYear + '-' + minMonth + '-' + minDay;
let maxDate = maxYear + '-' + maxMonth + '-' + maxDay;

let allDates = document.getElementsByClassName('mdate');

Array.from(allDates).forEach(e => {
  e.setAttribute('min', minDate);
  e.setAttribute('max', maxDate);

  if (e.getAttribute('id') != 'updateDate')
  {
    e.setAttribute('value', todayDate);  
  }
})