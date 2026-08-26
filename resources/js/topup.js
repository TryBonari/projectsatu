/**
 * topup.js — Logika halaman Top-Up Game
 * Tandai paket yang dipilih sebagai selected
 */
(function () {
    document.querySelectorAll('.pkg-card').forEach(function (card) {
        card.addEventListener('click', function () {
            document.querySelectorAll('.pkg-card').forEach(function (c) {
                c.classList.remove('selected');
            });
            this.classList.add('selected');
        });
    });
})();
