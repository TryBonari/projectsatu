/**
 * topup.js — Logika halaman Top-Up Game
 * - Tandai paket yang dipilih sebagai selected
 * - Stepper jumlah pembelian (qty)
 * - Update preview total harga secara live
 */
(function () {
    var cards    = document.querySelectorAll('.pkg-card');
    var qtyInput = document.getElementById('qtyInput');
    var qtyMinus = document.getElementById('qtyMinus');
    var qtyPlus  = document.getElementById('qtyPlus');
    var qtyTotal = document.getElementById('qtyTotal');

    // ── Format angka ke Rupiah ──────────────────────────────────────
    function formatRp(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    // ── Ambil amount dari paket yang sedang dipilih ─────────────────
    function getSelectedAmount() {
        var selected = document.querySelector('.pkg-card.selected');
        if (!selected) return null;
        return parseInt(selected.getAttribute('data-amount'), 10) || null;
    }

    // ── Perbarui tampilan total ─────────────────────────────────────
    function updateTotal() {
        var amount = getSelectedAmount();
        var qty    = parseInt(qtyInput.value, 10) || 1;

        if (!qtyTotal) return;

        if (amount) {
            qtyTotal.textContent = formatRp(amount * qty);
        } else {
            qtyTotal.textContent = '—';
        }

        // Disable tombol sesuai batas
        if (qtyMinus) qtyMinus.disabled = (qty <= 1);
        if (qtyPlus)  qtyPlus.disabled  = (qty >= 10);
    }

    // ── Klik paket ─────────────────────────────────────────────────
    cards.forEach(function (card) {
        card.addEventListener('click', function () {
            cards.forEach(function (c) { c.classList.remove('selected'); });
            this.classList.add('selected');
            updateTotal();
        });
    });

    // ── Stepper minus ───────────────────────────────────────────────
    if (qtyMinus) {
        qtyMinus.addEventListener('click', function () {
            var v = parseInt(qtyInput.value, 10) || 1;
            if (v > 1) { qtyInput.value = v - 1; updateTotal(); }
        });
    }

    // ── Stepper plus ────────────────────────────────────────────────
    if (qtyPlus) {
        qtyPlus.addEventListener('click', function () {
            var v = parseInt(qtyInput.value, 10) || 1;
            if (v < 10) { qtyInput.value = v + 1; updateTotal(); }
        });
    }

    // ── Init ────────────────────────────────────────────────────────
    updateTotal();
})();
