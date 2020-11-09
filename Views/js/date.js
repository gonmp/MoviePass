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

document.getElementById('date').setAttribute('min', minDate);
document.getElementById('date').setAttribute('max', maxDate);