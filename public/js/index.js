var swiperPopular = new Swiper(".movietrend-content", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: "#movietrend-next",
        prevEl: "#movietrend-prev",
    },
    breakpoints: {
        280: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        510: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        758: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});

var swiperWatch = new Swiper(".watch-content", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: "#watch-next",
        prevEl: "#watch-prev",
    },
    breakpoints: {
        280: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        510: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        758: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});

var swiperToWatch = new Swiper(".towatch-content", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: "#towatch-next",
        prevEl: "#towatch-prev",
    },
    breakpoints: {
        280: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        510: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        758: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});

var swiperActor = new Swiper(".casting-content", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: "#casting-next",
        prevEl: "#casting-prev",
    },
    breakpoints: {
        280: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        510: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        758: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});

var swiperActorMovies = new Swiper(".actorMovies-content", {
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
        delay: 5500,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: "#actorMovies-next",
        prevEl: "#actorMovies-prev",
    },
    breakpoints: {
        280: {
            slidesPerView: 1,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        510: {
            slidesPerView: 2,
            spaceBetween: 10,
        },
        758: {
            slidesPerView: 3,
            spaceBetween: 15,
        },
        900: {
            slidesPerView: 4,
            spaceBetween: 20,
        },
    },
});


var refPopup = null;

function init() {
    console.log("init");
    refPopup = document.getElementById("popup");
}

var data = {
    home: "Revenir à l'accueil",
    pop: "Voir les films populaires",
    fav: "Voir les films favoris",
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