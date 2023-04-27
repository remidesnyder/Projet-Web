const menuBtn = document.querySelector('.menu-btn');
const menu = document.querySelector('.menu');
const menuNav = document.querySelector('.menu-nav');
const menuBranding = document.querySelector('.menu-branding');
const navItems = document.querySelectorAll('.nav-item');

let showMenu = false;

function toggleMenu() {
    if (!showMenu) {
        menuBtn.classList.add('close');
        menu.classList.add('show');
        menuNav.classList.add('show');
        menuBranding.classList.add('show');
        navItems.forEach(item => item.classList.add('show'));

        // Mettre l'attribut tabindex="0" sur le premier élément focusable dans le menu
        menuNav.querySelector('a').setAttribute('tabindex', '0');

        showMenu = true;
    } else {
        menuBtn.classList.remove('close');
        menu.classList.remove('show');
        menuNav.classList.remove('show');
        menuBranding.classList.remove('show');
        navItems.forEach(item => item.classList.remove('show'));

        // Enlever l'attribut tabindex sur le premier élément focusable dans le menu
        menuNav.querySelector('a').removeAttribute('tabindex');

        showMenu = false;
    }
}

function hideMenu(event) {
    // Si le menu est ouvert et que l'utilisateur clique en dehors du menu, fermer le menu
    if (showMenu && !menu.contains(event.target)) {
        toggleMenu();
    }
}

menuBtn.addEventListener('click', toggleMenu);
window.addEventListener('click', hideMenu);