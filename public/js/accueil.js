const body = document.body;
const rFoot = document.getElementById("resultatFoot");
const rTennis = document.getElementById("resultatTennis");
const rBasket = document.getElementById("resultatBasket");
let rF = 0;
let rT = 0;
let rB = 0;
setInterval(raifall, 1000);

function raifall() {
    const waterDrop = document.createElement("img");

    waterDrop.src = "photo-accueil/foot.png";
    waterDrop.classList.add("img-c");
    //   waterDrop.classList.add("fa-tint");
    //   waterDrop.style.fontSize = Math.random() * 7 + "px";
    //   waterDrop.style.height = "10px";
    //   waterDrop.style.width = "10px";
    waterDrop.style.animationDuration = Math.random() * 10 + "s";
    waterDrop.style.opacity = Math.random() + 0.3;
    waterDrop.style.left = Math.random() * window.innerWidth + "px";
    body.appendChild(waterDrop);

    waterDrop.addEventListener("click", function remove() {
        waterDrop.remove();
        rFoot.innerText = rF += 1;
    });
    setTimeout(() => {
        waterDrop.remove();
    }, 8000);
}
setInterval(raifalltennis, 1000);

function raifalltennis() {
    const waterDrop = document.createElement("img");

    waterDrop.src = "photo-accueil/tennis.png";
    waterDrop.classList.add("img-c");
    //   waterDrop.classList.add("fa-tint");
    //   waterDrop.style.fontSize = Math.random() * 7 + "px";
    //   waterDrop.style.height = "10px";
    //   waterDrop.style.width = "10px";
    waterDrop.style.animationDuration = Math.random() * 10 + "s";
    waterDrop.style.opacity = Math.random() + 0.3;
    waterDrop.style.left = Math.random() * window.innerWidth + "px";
    body.appendChild(waterDrop);
    waterDrop.addEventListener("click", function remove() {
        waterDrop.remove();
        rTennis.innerText = rT += 1;
    });
    setTimeout(() => {
        waterDrop.remove();
    }, 8000);
}
setInterval(raifallbasket, 1000);

function raifallbasket() {
    const waterDrop = document.createElement("img");

    waterDrop.src = "photo-accueil/basket.png";
    waterDrop.classList.add("img-c");
    //   waterDrop.classList.add("fa-tint");
    //   waterDrop.style.fontSize = Math.random() * 7 + "px";
    //   waterDrop.style.height = "10px";
    //   waterDrop.style.width = "10px";
    waterDrop.style.animationDuration = Math.random() * 10 + "s";
    waterDrop.style.opacity = Math.random() + 0.3;
    waterDrop.style.left = Math.random() * window.innerWidth + "px";
    body.appendChild(waterDrop);
    waterDrop.addEventListener("click", function remove() {
        waterDrop.remove();
        rBasket.innerText = rB += 1;
    });
    setTimeout(() => {
        waterDrop.remove();
    }, 8000);
}
