var refPopup = null;
var profileName = null;
var dropdownProfil = null;

function init() {
    refPopup = document.getElementById("popup");
    profileName = document.getElementById("profileName");
    dropdownProfil = document.getElementById("dropdownProfil");
}

var data = {
    home: "Revenir à l'accueil",
    pop: "Voir les films populaires",
    fav: "Mes films favoris",
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

function showOrHideDropdown() {
    if (dropdownProfil.classList.contains("hidden")) {
        dropdownProfil.classList.remove("hidden");
    } else {
        dropdownProfil.classList.add("hidden");
    }
}