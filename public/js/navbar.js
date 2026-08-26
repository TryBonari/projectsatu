/**
 * navbar.js — Toggle menu mobile di semua halaman yang punya navbar
 */
(function () {
    var toggle = document.getElementById('navToggle');
    var links  = document.getElementById('navLinks');

    if (toggle && links) {
        toggle.addEventListener('click', function () {
            links.classList.toggle('open');
        });
    }
})();
