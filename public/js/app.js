const date = document.getElementById("date");
const today = new Date().toISOString().split("T")[0];

date.min = today;
// date.value = today;

const foot = document.getElementById("foot");

// console.log(foot.value);
