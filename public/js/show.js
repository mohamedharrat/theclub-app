const players = document.getElementById("players");
const user_name = document.getElementById("user");
const participe = document.getElementById("participe");

for (i = 0; i < players.children.length; i++) {
    if (players.children[i].innerText == user_name.innerText) {
        participe.style.display = "none";
    }
}
