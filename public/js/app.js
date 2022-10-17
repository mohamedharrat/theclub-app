const date = document.getElementById("date");
const today = new Date().toISOString().split("T")[0];
console.log(today);

date.min = today;
// date.value = "";
