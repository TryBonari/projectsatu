/**
 * saldo-qris.js — Countdown timer halaman QRIS
 * Hitung mundur 15 menit; redirect ke saldo saat habis.
 * Warna berubah ke merah saat < 60 detik.
 *
 * Requires global: SALDO_ROUTE (di-inject dari Blade)
 */
(function () {
    var total      = 15 * 60;
    var el         = document.getElementById('countdown');
    var timerWrap  = document.querySelector('.timer-wrap');

    if (!el) return;

    var timer = setInterval(function () {
        total--;

        var m = String(Math.floor(total / 60)).padStart(2, '0');
        var s = String(total % 60).padStart(2, '0');
        el.textContent = m + ':' + s;

        if (total <= 60) {
            el.style.color = '#f87171';
            if (timerWrap) {
                timerWrap.style.borderColor = 'rgba(239,68,68,0.35)';
                timerWrap.style.background  = 'rgba(239,68,68,0.08)';
            }
        }

        if (total <= 0) {
            clearInterval(timer);
            el.textContent = '00:00';
            if (typeof SALDO_ROUTE !== 'undefined') {
                window.location.href = SALDO_ROUTE;
            }
        }
    }, 1000);
})();
