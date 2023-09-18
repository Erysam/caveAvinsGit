var currentDate = new Date();
var dateString = currentDate.toISOString().split('T')[0];
document.getElementById('datejour').value = dateString;