function modifyDateFormat(date) {
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  var formattedMonth = (month < 10 ? '0' + month : month); // Adding 0, when the month is a single-digit value.
  var formattedDay = (day < 10 ? '0' + day : day);
  var modifiedDate = year + '-' + formattedMonth + '-' + formattedDay;
  return modifiedDate;
}

var today = new Date();
var minDate = modifyDateFormat(today);
document.getElementById('data-transportu').min = minDate;
document.getElementById('data-transportu').value = minDate;

var calendar = document.getElementById('data-transportu');
calendar.addEventListener('input', function() {
  var selectedDate = new Date(calendar.value);
  if (selectedDate.getDay() === 0 || selectedDate.getDay() === 6) {
    alert("Transport odbywa się tylko w dni robocze! Został ustawiony najbliższy termin transportu po wybranej dacie.");
    while (selectedDate.getDay() === 0 || selectedDate.getDay() === 6) {
      selectedDate.setDate(selectedDate.getDate() + 1);
    }
  }
  selectedDate = modifyDateFormat(selectedDate);
  document.getElementById('data-transportu').value = selectedDate;
});
