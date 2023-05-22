var refPopup = null;

function init() {
    console.log("init");
    refPopup = document.getElementById("popup");
}

var data = {
    mail: "Cliquer pour envoyer un E-Mail",
    tel: "Cliquer pour appeler",
    git: "Cliquer pour accéder à mon GitHub",
    repl: "Cliquer pour accéder à mon Replit",
};

function popin(contexte) {
    console.log("popin" + contexte);
    console.log(contexte.target.id);
    console.log("clientX" + contexte.clientX); 
    console.log("screenX" + contexte.screenX); 
    observateur = contexte.target;

    if (data[contexte.target.id] == undefined) return;
    refPopup.innerHTML = data[contexte.target.id];

    refPopup.style.top = parseInt(contexte.clientY) + 10 + "px";

   
    if (contexte.clientX <= window.innerWidth / 2) {
        refPopup.style.left = parseInt(contexte.clientX) + 5 + "px";
        refPopup.style.right = "";
    } else {
        refPopup.style.right =
            window.innerWidth - parseInt(contexte.clientX) + 5 + "px";
        refPopup.style.removeProperty("left");
    }


    refPopup.style.display = "block";
}

function popout() {
    console.log("popout");
    refPopup.style.display = "none";
}