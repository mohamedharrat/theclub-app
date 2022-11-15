// filtre date //

const date = document.getElementById("date");
const today = new Date().toISOString().split("T")[0];

date.min = today;
// date.value = today;

const foot = document.getElementById("foot");

// console.log(foot.value);

// filtre mes evenements //

// const mesEvenementsBtn = document.getElementById("myEvents");
// const participeBtn = document.getElementById("Eparticipe");
// const myEvent = document.getElementById("mes-evenements");
// const eParticipe = document.getElementById("e-participe");

// mesEvenementsBtn.addEventListener("click", function mesEvenement() {
//     // myEvent.style.display = "block";
//     // eParticipe.style.display = "none";
//     console.log("ok");
// });

// participeBtn.addEventListener("click", function participe() {
//     // myEvent.style.display = "none";
//     // eParticipe.style.display = "block";
//     console.log("333");
// });
