const players = document.getElementById("players");
const user_name = document.getElementById("user");
const participe = document.getElementById("participe");
const annuler = document.getElementById("annuler");

for (i = 0; i < players.children.length; i++) {
    if (players.children[i].innerText == user_name.innerText) {
        participe.style.display = "none";
    }
}

if (players.children.length == 0) {
    annuler.style.display = "none";
}
console.log(players.children.length);
